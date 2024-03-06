<?
/**
 * Plugin Name
 * 
 * @pakage:         MyMessage
 * @author          jmcamposdev
 * @copyriht        2024 JM Campos
 * @license         GPL-2.0+
 * 
 * @wordpress-plugin
 * Plugin Name:     MyMessage
 * Plugin URI:      https://jmcampos.dev
 * Description:     Messages custom post type
 * Requires at least: 5.2
 * Requires PHP:    7.2
 * Author:          jmcamposdev
 * Author URI:      https://jmcampos.dev
 * Text Domain:     mymessage
 * License:         GPL v2 or later
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Version:         1.0.0
 */

// Exit if accessed directly.
// Avoid execute plugin from direction input in browser
defined( 'ABSPATH' ) || die('You are not allowed to access this file directly');

class MyMessage {
  // Declare shortcodes
  function __construct() {
    add_shortcode('mmm_show_message', array($this, 'mmm_show_message'));
    
  }

  // Execute Action in order to create a new Custom Post Type
  function mmm_execute_actions() {
    // Register custom post type for message
    add_action('init', array($this, 'mmm_register_custom_message'));
    // Enqueue styles and scripts
    add_action('wp_enqueue_scripts', array($this, 'mmm_enqueue_front_css'));
    // Add a metabox
    add_action('add_meta_boxes', array($this, 'mmm_add_message_metabox'));
    // Save message
    add_action('save_post', array($this, 'mmm_save_message_metabox'));
  }

  function mmm_register_custom_message() {
    $supports = [
      'title',
      'editor',
      'thumbnail'
    ];
    $labels = [
      'name' => _x('Messages', 'plural'),
      'singular_name' => _x('Message', 'singular'),
      'menu_name' => _x('Messages', 'admin menu'),
      'name_admin_bar' => _x('Message', 'admin bar'),
      'add_new' => _x('Add New Message', 'add_new'),
      'all_items' => __('All Messages'),
      'add_new_item' => __('Add New Message'),
      'view_item' => __('View Message'),
      'search' => __('Search Message'),
      'not_found' => __('No Messages found...')
    ];

    $args = [
      'supports' => $supports,
      'labels' => $labels,
      'query_var' => true,
      'show_in_rest' => true,
      'show_in_menu' => true,
      'menu_position' => 7,
      'menu_icon' => 'dashicons-email-alt',
      'public' => true,
      'exclude_from_search' => true,             // Include custom post type in search results
    ];
    register_post_type('mmm_message', $args);

    
    // Add author roles as categories new Taxonomy
    register_taxonomy('to', 'mmm_message', [
      'hierarchical' => true,
      'label' => 'To',
      'query_var' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'rewrite' => ['slug' => 'to'] // The slug for the query var
    ]);

    // Add default terms
    $terms = [
      'All Users',
      'Administrator',
      'Editor',
      'Author',
      'Colaborator',
      'Subscriber'
    ];
    // Insert terms
    foreach($terms as $term) {
      wp_insert_term($term, 'to');
    }
    
    flush_rewrite_rules();
  }

  function mmm_show_message($atts)  {
    $authorid = shortcode_atts(['id' => 0], $atts);
    $author_id = $authorid['id'];

    // Get the author role
    $rol = trim(implode('', get_userdata($author_id)->roles));


    // Make sure the user is logged in
    if (!is_user_logged_in()) {
      return "<h5 class='privatezone-role mt-2'>Please login to access the private zone</h5>";
    }
    // Query to determine if there is a message for him
    $args = [
      'post_type' => ['mmm_message'],
      'post_status' => 'publish',
      'posts_per_page' => 1,
      'tax_query' => [
        [
          // Searching taxonomy slug
          'taxonomy' => 'to',
          // Field type
          'field' => 'slug',
          // Searching value
          'terms' => $rol,
          // Action INCLUDE or NOT INCLUDE in the query
          'operator' => 'IN'
        ]
      ]
    ];

    $msg = new WP_Query($args);

    // Make message HTML structure
    if ($msg->have_posts()) {
      // Get the picture or a default one
      $msg->the_post();
       // Load
       $thumb_url = get_template_directory_uri() . '/img/news/1.jpg';
       if (has_post_thumbnail()) {
         $thumb_url = get_the_post_thumbnail_url();
       }
      $message = get_the_content();
      $title = get_the_title();
      // Get the exp date
      $expiredDateString = get_post_meta(get_the_ID(), 'mmm_exp_date', true);
      $expiredDate = new DateTime($expiredDateString, new DateTimeZone('Europe/Berlin'));
      $currentDateTime = new DateTime('now', new DateTimeZone('Europe/Berlin'));
      if (date_diff($expiredDate, $currentDateTime)->invert > 0) {
        ?>
          <div class="motd-box">
            <div class="message-pic" style="background-image: url(<?php echo $thumb_url ?>)"></div>
            <div class="message-content">
              <h3><?php echo $title ?></h3>
              <p><?php echo $message ?></p>
            </div>
          </div>
      <?php
      } else {
      ?>
      <h5 class='privatezone-role mt-2'>No messages for you</h5>
      <?php
    }

    wp_reset_postdata();

  } else {
    echo "<h5 class='privatezone-role mt-2'>No messages for you</h5>";
  }
}

  function mmm_enqueue_front_css() {
    wp_register_style( 'mmm-front-css', plugins_url( 'mmm_front.css', __FILE__ ) );
    wp_enqueue_style( 'mmm-front-css' );
  }

  function mmm_add_message_metabox($screens) {
    $screens = array('mmm_message'); // Filter the post type

    foreach($screens as $screen) {
      add_meta_box('mmm-message', 'Message Details', array($this, 'mmm_metabox_callback'), $screen, 'advanced');
    }
  }

  function mmm_metabox_callback($post) {
    // Add a nonce field so we can check for it later.
    wp_nonce_field( basename(__FILE__), 'mmm_message_nonce' );
    
    $expired_date = get_post_meta($post->ID, 'mmm_exp_date', true);

    if (!$expired_date) {
       // Expired Date is 24 hours from now
      $expired_date = new DateTime('now', new DateTimeZone('Europe/Berlin'));
      // Add 24 hours
      $expired_date->add(new DateInterval('P1D'));
      // Transform to string
      $expired_date = $expired_date->format('Y-m-d\TH:i');
    }

    ?>
      <div class="custom-field">
        <label for="mmm_exp_date">Expired Date & Time</label>
        <input type="datetime-local" id="mmm_exp_date" name="mmm_exp_date" value="<?php echo $expired_date ?>">
      </div>
    <?php
  }

  function mmm_save_message_metabox( $post_id ) {
    // Check if nonce field is set
    if ( isset( $_POST['mmm_message_nonce'] ) ) {
        // Check if we are in autosave
        $is_autosave = wp_is_post_autosave( $post_id );
        // Check if we are in revision
        $is_revision = wp_is_post_revision( $post_id );
        // Check if the nonce field is valid
        // Param 1: The nonce field name
        // Param 2: The action name
        $is_valid_nonce = wp_verify_nonce( $_POST['mmm_message_nonce'], basename(__FILE__) );

        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }

        // Check if user has permissions to save data
        if ( !current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $expired_date = sanitize_text_field( $_POST['mmm_exp_date'] );

        update_post_meta( $post_id, 'mmm_exp_date', $expired_date );
    }
}


}

if ( class_exists( 'MyMessage' ) ) {
    $mymessage = new MyMessage();
    $mymessage->mmm_execute_actions();
}