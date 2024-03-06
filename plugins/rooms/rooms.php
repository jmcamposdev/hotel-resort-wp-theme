<?

/**
 * Plugin Name
 * 
 * @pakage:         Rooms
 * @author          jmcamposdev
 * @copyriht        2024 JM Campos
 * @license         GPL-2.0+
 * 
 * @wordpress-plugin
 * Plugin Name:     Rooms
 * Plugin URI:      https://jmcampos.dev
 * Description:     Rooms custom post type
 * Requires at least: 5.2
 * Requires PHP:    7.2
 * Author:          jmcamposdev
 * Author URI:      https://jmcampos.dev
 * Text Domain:     rooms
 * License:         GPL v2 or later
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Version:         1.0.0
 */

// Exit if accessed directly.
// Avoid execute plugin from direction input in browser
defined('ABSPATH') || die('You are not allowed to access this file directly');

class Room
{
  function __construct()
  {
    add_shortcode('jmc_show_main_fields', array($this, 'jmc_show_main_fields'));
    add_shortcode('jmc_show_all_fields', array($this, 'jmc_show_all_fields'));
    add_shortcode('jmc_show_categories', array($this, 'jmc_show_categories'));
    add_shortcode('jmc_get_categories', array($this, 'jmc_get_categories'));
    add_shortcode('jmc_show_tags', array($this, 'jmc_show_tags'));
    add_shortcode('jmc_are_pet_allowed', array($this, 'jmc_are_pet_allowed'));
    add_shortcode('jmc_show_amenities', array($this, 'jmc_show_amenities'));
  }

  function execute_actions()
  {

    // Register Room Custom Post Type
    add_action('init', array($this, 'jmc_register_rooms'));

    // Create a meta-box to display the custom post-fields
    add_action('add_meta_boxes', array($this, 'jmc_add_metabox'));

    // Save the custom post-fields
    add_action('save_post', array($this, 'jmc_save_custom_fields'));

    // Add CSS and JS script to admin area
    add_action('admin_enqueue_scripts', array($this, 'jmc_admin_scripts'));

    // Add CSS and JS script to front-end
    add_action('wp_enqueue_scripts', array($this, 'jmc_frontend_scripts'));
    add_action('wp_enqueue_scripts', array($this, 'jmc_frontend_injection_style'));

    // Add a settings page to the plugin in admin-area
    add_action('admin_menu', array($this, 'jmc_rooms_settings_menu'));

    // Register rooms settings
    add_action('admin_init', array($this, 'jmc_register_rooms_settings'));

    // Action erros laucher
    add_action('admin_notices', array($this, 'jmc_rooms_settings_errors_activation'));
  }

  /**
   * Register Room Custom Post Type
   */
  function jmc_register_rooms()
  {
    $supports = [
      'title',       // Display the title panel in the admin-area
      'editor',      // Display the editor panel in the admin-area
      'excerpt',     // Display the excerpt panel in the admin-area
      'thumbnail',   // Display the thumbnail panel in the admin-area
      'author',      // Display the author panel in the admin-area
      'comments',    // Display the comments panel in the admin-area
    ];

    $labels = [
      'name' => _x('Rooms', 'plural'),
      'singular_name' => _x('Room', 'singular'),
      'menu_name' => _x('Rooms', 'admin menu'),
      'name_admin_bar' => _x('Room', 'admin bar'),
      'add_new' => _x('Add New Room', 'add_new'),
      'all_items' => __('All Rooms'),
      'add_new_item' => __('Add New Project'),
      'view_item' => __('View Room'),
      'search' => __('Search Room'),
      'not_found' => __('No rooms found...'),
    ];

    $args = [
      'supports' => $supports,                    // Add support to admin-are
      'labels' => $labels,                        // Change labels in admin-area for custom post type
      'public' => true,                           // Custom Post Type reacheble in admin-area and front-end
      'wp_query' => true,                         // We can loop with WP_Query class
      'query_var' => true,                        // Access to query vars with custom post type
      'hierarchical' => false,                    // Custom Post Type is not hierarchical 
      'show_in_rest' => true,                     // Enable Gutenberg editor
      'rewrite' => ['slug' => 'rooms'],           // Change slug for custom post type
      'has_archive' => true,                      // Enable archive page for custom post type (archive.php)
      'show_in_menu' => true,                     // Show custom post type in admin menu
      'menu_position' => 5,                       // Position in admin menu (5 is below Posts) (This count the submenus too)
      'menu_icon' => 'dashicons-admin-multisite', // Change icon in admin menu
    ];

    register_post_type('rooms', $args);

    // Add category and/or tags panels to custom post type shared with posts
    //                                <taxonomy>, <post_type>
    // This share the same category and tags with the custom post type and the posts
    //register_taxonomy_for_object_type('category', 'rooms');
    //register_taxonomy_for_object_type('post_tag', 'rooms');

    // Add particular category and tags panels to custom post type
    register_taxonomy(
      'room_category', // The name of the taxonomy
      'rooms',         // The name of the custom post type
      [
        'hierarchical' => true, // The taxonomy is hierarchical
        'labels' => [
          'name' => _x('Room Categories', 'taxonomy general name'),
          'singular_name' => _x('Room Category', 'taxonomy singular name'),
          'search_items' => __('Search Room Categories'),
          'all_items' => __('All Room Categories'),
          'parent_item' => __('Parent Room Category'),
          'parent_item_colon' => __('Parent Room Category:'),
          'edit_item' => __('Edit Room Category'),
          'update_item' => __('Update Room Category'),
          'add_new_item' => __('Add New Room Category'),
          'new_item_name' => __('New Room Category Name'),
          'menu_name' => __('Room Categories'),
        ],
        'show_ui' => true,
        'show_admin_column' => true, // Show the taxonomy in the admin-area
        'query_var' => true, // Include new taxonomy in query vars
        'show_in_rest' => true, // Enable Gutenberg editor
        'rewrite' => ['slug' => 'room-category'], // Change slug for custom post type
      ]
    );

    // Add particular tags panels to custom post type
    register_taxonomy(
      'room_tag', // The name of the taxonomy
      'rooms',    // The name of the custom post type
      [
        'hierarchical' => false, // The taxonomy is not hierarchical
        'labels' => [
          'name' => _x('Room Tags', 'taxonomy general name'),
          'singular_name' => _x('Room Tag', 'taxonomy singular name'),
          'search_items' => __('Search Room Tags'),
          'all_items' => __('All Room Tags'),
          'parent_item' => __('Parent Room Tag'),
          'parent_item_colon' => __('Parent Room Tag:'),
          'edit_item' => __('Edit Room Tag'),
          'update_item' => __('Update Room Tag'),
          'add_new_item' => __('Add New Room Tag'),
          'new_item_name' => __('New Room Tag Name'),
          'menu_name' => __('Room Tags'),
        ],
        'show_ui' => true,
        'show_admin_column' => true, // Show the taxonomy in the admin-area
        'query_var' => true, // Include new taxonomy in query vars
        'show_in_rest' => true, // Enable Gutenberg editor
        'rewrite' => ['slug' => 'room-tag'], // Change slug for custom post type
      ]
    );



    flush_rewrite_rules(); // Flush the rewrite rules to avoid 404 error
  }

  /**
   * Create a meta-box to display the custom post-fields
   * @param $screens The custom post type
   */
  function jmc_add_metabox($screens)
  {
    $screens = ['rooms']; // Filter the custom post type to display the meta-box (only get the rooms custom post type)

    // Iterate the custom post type to display the meta-box
    foreach ($screens as $screen) {
      //            <id>, <title>, <callback>, <screen>, <context>
      add_meta_box(
        'jmc-rooms-metabox', // Unique ID
        'Rooms Details',      // Box title
        array($this, 'jmc_metabox_callback'), // Content callback, must be of type callable
        $screen,             // Post type
        'advanced',          // Position
      );
    }
  }

  /**
   * Callback function for display custom fields using HTML tags
   * @param $post The post object 
   */
  function jmc_metabox_callback($post)
  {
    // Create a validation mechanism to prevent execution outsite my website using a nonce field
    wp_nonce_field(basename(__FILE__), 'jmc_rooms_nonce');

    // Data Harvesting
    $adults = get_post_meta($post->ID, 'jmc_adults', true);
    $children = get_post_meta($post->ID, 'jmc_children', true);
    $price = get_post_meta($post->ID, 'jmc_price', true);
    $bed_type = get_post_meta($post->ID, 'jmc_bed_type', true);
    $orientation = get_post_meta($post->ID, 'jmc_orientation', true);
    $square_meters = get_post_meta($post->ID, 'jmc_square_meters', true);
    $dogs = get_post_meta($post->ID, 'jmc_dogs', true);
    $include_breakfast = get_post_meta($post->ID, 'jmc_include_breakfast', true);
    $include_wifi = get_post_meta($post->ID, 'jmc_include_wifi', true);
    $room_type = get_post_meta($post->ID, 'jmc_room_type', true);
    $slider_images = get_post_meta($post->ID, 'jmc_slider_images', true);

    // Amenities
    $custom_array_values = get_post_meta($post->ID, 'jmc_custom_array_field', true);


    // Display fields with HTML tags
?>
    <div class="flex-metabox">
      <div class="details">
        <h2>Rooms Details</h2>
        <div class="flex-item item-1">
          <label for="jmc_adults">Number of Adults:</label>
          <input type="number" name="jmc_adults" id="jmc_adults" size="2" value="<?php echo $adults ?>">
        </div>
        <div class="flex-item item-2">
          <label for="jmc_children">Number of Childrens:</label>
          <input type="number" name="jmc_children" id="jmc_children" size="2" value="<?php echo $children ?>">
        </div>
        <div class="flex-item item-3">
          <label for="jmc_price">Price:</label>
          <input type="number" name="jmc_price" id="jmc_price" size="5" value="<?php echo $price ?>">
        </div>
        <div class="flex-item item-4">
          <label for="jmc_bed_type">Bed Type:</label>
          <select name="jmc_bed_type" id="jmc_bed_type">
            <option value="Select a Type" <?php if ($bed_type == 'Select a Type') echo "selected" ?>>Select a bed type</option>
            <option value="King Size Bed" <?php selected($bed_type, 'King Size Bed') ?>>King Size Bed</option>
            <option value="Double Bed" <?php selected($bed_type, 'Double Bed') ?>>Double Bed</option>
            <option value="Twin Beds" <?php selected($bed_type, 'Twin Beds') ?>>Twin Beds</option>
            <option value="Single Bed" <?php selected($bed_type, 'Single Bed') ?>>Single Bed</option>
            <option value="Water Bed" <?php selected($bed_type, 'Water Bed') ?>>Water Bed</option>
          </select>
        </div>
        <div class="flex-item item-5">
          <label for="jmc_orientation">Orientation:</label>
          <select name="jmc_orientation" id="jmc_orientation">
            <option value="Select a Orientation" <?php if ($orientation == 'Select a Orientation') echo "selected" ?>>Select a Orientation</option>
            <option value="North" <?php selected($orientation, 'North') ?>>North</option>
            <option value="South" <?php selected($orientation, 'South') ?>>South</option>
            <option value="East" <?php selected($orientation, 'East') ?>>East</option>
            <option value="West" <?php selected($orientation, 'West') ?>>West</option>
          </select>
        </div>
        <div class="flex-item item-6">
          <label for="jmc_square_meters">Square Meters:</label>
          <input type="number" name="jmc_square_meters" id="jmc_square_meters" size="5" value="<?php echo $square_meters ?>">
        </div>
        <div class="flex-item item-7">
          <label for="jmc_dogs">Dogs:</label>
          <input type="checkbox" name="jmc_dogs" id="jmc_dogs" value="1" <?php checked($dogs, 1) ?>>
        </div>
        <div class="flex-item item-7">
          <label for="jmc_include_breakfast">Include BreakFast:</label>
          <input type="checkbox" name="jmc_include_breakfast" id="jmc_include_breakfast" value="1" <?php checked($include_breakfast, 1) ?>>
        </div>
        <div class="flex-item item-7">
          <label for="jmc_include_wifi">Include Free Wifi:</label>
          <input type="checkbox" name="jmc_include_wifi" id="jmc_include_wifi" value="1" <?php checked($include_wifi, 1) ?>>
        </div>
        <!-- <div class="flex-item item-8">
          <label for="jmc_room_type">Room Type:</label>
          <select name="jmc_room_type" id="jmc_room_type">
            <option value="Select a Type" <?php if ($room_type == 'Select a Type') echo "selected" ?>>Select a room type</option>
            <option value="Standard" <?php selected($room_type, 'Standard') ?>>Standard</option>
            <option value="Superior" <?php selected($room_type, 'Superior') ?>>Superior</option>
            <option value="Suite" <?php selected($room_type, 'Suite') ?>>Suite</option>
          </select>
        </div> -->
        <div class="flex-item item-9">
          <?php
          echo '<div class="slider-images">';
            if (!empty($slider_images)) {
              foreach ($slider_images as $image_url) {
                echo '<div class="slider-image">';
                echo '<img src="' . esc_url($image_url) . '" class="thumbnail">';
                echo '<span class="dashicons dashicons-dismiss remove-image"></span>';
                echo '</div>';
              }
            }
          echo '</div>';

          // Permitir la carga de nuevas imágenes
          echo '<input type="file" name="jmc_slider_images[]" id="jmc_new_slider_images" multiple>';
          ?>
        </div>
      </div>
      <div class="project-staff">
        <h2>Amenities</h2>
        <?php
        require_once(plugin_dir_path(__FILE__) . 'admin/includes/amenities.php');
        ?>
      </div>
    </div>
  <?php

  }

  /**
   * Function for saving custom post fields
   * @param $post_id The post ID
   */
  function jmc_save_custom_fields($post_id)
  {
    if (isset($_POST['jmc_rooms_nonce'])) {
      // Check if we are in autosave
      $is_autosave = wp_is_post_autosave($post_id);
      // Check if we are in revision
      $is_revision = wp_is_post_revision($post_id);
      // Check if the nonce field is valid
      // Param 1: The nonce field name
      // Param 2: The action name
      $is_valid_nonce = wp_verify_nonce($_POST['jmc_rooms_nonce'], basename(__FILE__));

      if ($is_autosave || $is_revision || !$is_valid_nonce) {
        return;
      }

      // Check if user has permissions to save data
      if (!current_user_can('edit_post', $post_id)) {
        return;
      }

      // Sanitize fields to avoid code injection
      $adults = sanitize_text_field($_POST['jmc_adults']);
      $children = sanitize_text_field($_POST['jmc_children']);
      $price = sanitize_text_field($_POST['jmc_price']);
      $bed_type = sanitize_text_field($_POST['jmc_bed_type']);
      $orientation = sanitize_text_field($_POST['jmc_orientation']);
      $square_meters = sanitize_text_field($_POST['jmc_square_meters']);
      $dogs = sanitize_text_field($_POST['jmc_dogs']);
      $include_breackfast = sanitize_text_field($_POST['jmc_include_breakfast']);
      $include_wifi = sanitize_text_field($_POST['jmc_include_wifi']);
      $room_type = sanitize_text_field($_POST['jmc_room_type']);
      $slider_images = sanitize_text_field($_POST['jmc_slider_images']);

      if (!$slider_images) {
        $slider_images = [];
        add_post_meta($post_id, 'jmc_slider_images', $slider_images, true);
      }

      // Store STAFF
      // If we have values in array structure
      if (isset($_POST['jmc_custom_array_field'])) {
        $array_aux = [];
        // Iterate the array
        foreach ($_POST['jmc_custom_array_field'] as $row) {
          // Must have values in one of the fields
          if (!empty($row['key1'])) {
            $array_aux[] = [
              'key1' => sanitize_text_field($row['key1']),
            ];
          }
        }
        update_post_meta($post_id, 'jmc_custom_array_field', $array_aux);
      }

      // Update the meta-fields in the database
      update_post_meta($post_id, 'jmc_adults', $adults);
      update_post_meta($post_id, 'jmc_children', $children);
      update_post_meta($post_id, 'jmc_price', $price);
      update_post_meta($post_id, 'jmc_bed_type', $bed_type);
      update_post_meta($post_id, 'jmc_orientation', $orientation);
      update_post_meta($post_id, 'jmc_square_meters', $square_meters);
      update_post_meta($post_id, 'jmc_dogs', $dogs);
      update_post_meta($post_id, 'jmc_include_breakfast', $include_breackfast);
      update_post_meta($post_id, 'jmc_include_wifi', $include_wifi);
      update_post_meta($post_id, 'jmc_room_type', $room_type);
    }
  }

  function jmc_admin_scripts()
  {
    wp_register_style('jmc-admin-style', plugins_url('admin/css/admin-styles.css', __FILE__));
    wp_enqueue_style('jmc-admin-style');

    wp_register_script('jmc-admin-script', plugins_url('admin/includes/js/amenities.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_script('jmc-admin-script');
  }

  function jmc_frontend_scripts()
  {
    wp_register_style('jmc-front-style', plugins_url('admin/css/front-styles.css', __FILE__));
    wp_enqueue_style('jmc-front-style');
  }

  function jmc_frontend_injection_style()
  {
    // Harvest the settings
    $options = get_option('jmc_rooms_settings');
    $color = $options['jmc_color'];
    // Store all the style in a variable
    $styles = '
      .box1, .box2, .box3, .box4 {
        border: 1px solid ' . $color . ';
      }

      .box1::before, box2::before {
        color: ' . $color . ';
      }

      .page-list-icon span {
        color: ' . $color . ' !important;
      }
    ';
    // Register and enqueue the style to be injected in the front-end
    wp_register_style('jmc-injection-style', false);
    wp_enqueue_style('jmc-injection-style');
    // Inject styles
    wp_add_inline_style('jmc-injection-style', $styles);
  }


  /**
   * ---------------------------------------------------------------------------------------------
   * SETTINGS PAGE
   * ---------------------------------------------------------------------------------------------
   */


  function jmc_rooms_settings_menu()
  {
    add_menu_page(
      'Rooms Settings', // Page title
      'Rooms Settings', // Menu title
      'manage_options', // Capability
      'jmc-rooms-settings', // Menu slug
      array($this, 'jmc_rooms_settings_callback'), // Callback function
      'dashicons-admin-settings', // Icon
      6 // Position
    );
  }

  function jmc_rooms_settings_callback()
  {
    require_once(plugin_dir_path(__FILE__) . 'admin/admin_settings.php');
  }

  /**
   * Function that register the rooms settings with admin_init hook
   * in wp_options table
   */
  function jmc_register_rooms_settings()
  {
    // 
    // Array of settings name, settings group name, callback function
    register_setting('jmc_rooms_settings', 'jmc_rooms_settings', array($this, 'jmc_rooms_settings_validation'));
  }

  /**
   * Function for rooms settings validation
   * @param $settings Array Rooms settings
   */
  function jmc_rooms_settings_validation($settings)
  {

    if (!isset($settings['jmc_color'])) {
      $settings['jmc_color'] = '#aa8453';
    }

    if (!isset($settings['jmc_allow_rating'])) {
      $settings['jmc_allow_rating'] = 'no';
    }

    if (!isset($settings['jmc_rating_max']) ||  $settings['jmc_rating_max'] < 0 || $settings['jmc_rating_max'] > 10) {
      $settings['jmc_rating_max'] = 5;
    }

    return $settings;
  }

  function jmc_rooms_settings_errors_activation()
  {
    settings_errors();
  }

  /**
   * ---------------------------------------------------------------------------------------------
   * SHORTCODES
   * ---------------------------------------------------------------------------------------------
   */

  /**
   * Function for display custom post fields using shortcodes
   * @param $attr Array of attributes is an array always
   */
  function jmc_show_main_fields($attr)
  {
    $args = shortcode_atts(array(
      'id' => 0,
    ), $attr);
    $post_id = $args['id'];
  ?>
    <div class="data-fields box1">
      <div class="field fiedl1"><span>Price:</span> <span><?php echo get_post_meta($post_id, 'jmc_price', true) ?></span></div>
      <div class="field fiedl2"><span>Adults:</span> <span><?php echo get_post_meta($post_id, 'jmc_adults', true) ?></span></div>
      <div class="field fiedl4"><span>Bed Type:</span> <span><?php echo get_post_meta($post_id, 'jmc_bed_type', true) ?></span></div>
    </div>
  <?php
  }

  function jmc_show_all_fields($attr)
  {
    $args = shortcode_atts(array(
      'id' => 0,
    ), $attr);
    $post_id = $args['id'];
  ?>
    <div class="data-fields box2">
      <div class="field fiedl1"><span>Price:</span> <span> <?php echo get_post_meta($post_id, 'jmc_price', true) ?></span></div>
      <div class="field fiedl2"><span>Adults:</span> <span> <?php echo get_post_meta($post_id, 'jmc_adults', true) ?></span></div>
      <div class="field fiedl4"><span>Bed Type:</span> <span> <?php echo get_post_meta($post_id, 'jmc_bed_type', true) ?></span></div>
      <div class="field fiedl5"><span>Orientation:</span> <span> <?php echo get_post_meta($post_id, 'jmc_orientation', true) ?></span></div>
      <div class="field fiedl6"><span>Square Meters:</span> <span> <?php echo get_post_meta($post_id, 'jmc_square_meters', true) ?></span></div>
      <div class="field fiedl7"><span>Dogs:</span> <span> <?php echo get_post_meta($post_id, 'jmc_dogs', true) ?></span></div>
      <div class="field fiedl8"><span>Room Type:</span> <span> <?php echo get_post_meta($post_id, 'jmc_room_type', true) ?></span></div>
    </div>

    <div class="data-fields box3">
      <div class="field fiedl8"><span>Room Type:</span> <span> <?php echo get_post_meta($post_id, 'jmc_room_type', true) ?></span></div>
    </div>

    <div class="data-fields box4">
      <h3>Amenities:</h3>
      <div class="staff-header">
        <span class="staff-lbl">Name</span>
        <span class="staff-lbl">Role</span>
      </div>

      <?php
      $custom_array_values = get_post_meta($post_id, 'jmc_custom_array_field', true);
      if (!empty($custom_array_values)) {
        foreach ($custom_array_values as $row) {
      ?>
          <div class="staff-row">
            <span class="staff-lbl key1 staff-name">
              <?php echo $row['key1'] ?>
            </span>
          </div>
      <?php
        }
      }
      ?>
    </div>
  <?php
  }

  function jmc_show_amenities($attr)
  {
    $args = shortcode_atts(['id' => 0], $attr);
    $post_id = $args['id'];
    $custom_array_values = get_post_meta($post_id, 'jmc_custom_array_field', true);
  ?>
    <div class="blog-sidebar">
      <div class="widget">
        <div class="widget-title">
          <h6>Amenities</h6>
        </div>
        <ul class="amenities_list row">
          <?php
          if (!empty($custom_array_values)) {
            foreach ($custom_array_values as $row) {
          ?>
              <li class="col-md-6 flex align-items-center">
                <div class="page-list-icon"> <span class="ti-check"></span> </div>
                <div class="page-list-text">
                  <p><?php echo $row['key1'] ?></p>
                </div>
              </li>
          <?php
            }
          } else {
            echo '<li>No amenities yet...</li>';
          }
          ?>
        </ul>
      </div>
    </div>
<?php
  }

  function jmc_show_categories($attr)
  {
    $args = shortcode_atts(array(
      'id' => 0,
    ), $attr);
    $post_id = $args['id'];

    $terms = get_the_terms($post_id, 'room_category');
    
    if (!empty($terms)) {
      echo '<ul class="post-categories room-title">';
      foreach ($terms as $term) {
        echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
      }

      echo '</ul>';
    }
  }

  function jmc_get_categories($attr) {
    $args = shortcode_atts(array(
      'id' => 0,
    ), $attr);
    $post_id = $args['id'];
    $terms = get_the_terms($post_id, 'room_category');
    if (!empty($terms)) {
      $categories = [];
      foreach ($terms as $term) {
        $categories[] = $term->name;
      }
      return $categories;
    }
    return [];
  }

  function jmc_show_tags($attr)
  {
    $args = shortcode_atts(array(
      'id' => 0,
    ), $attr);
    $post_id = $args['id'];
    $terms = get_the_terms($post_id, 'room_tag');
    if (!empty($terms)) {
      echo '<div class="tags">';
      foreach ($terms as $term) {
        echo '<a href="' . get_term_link($term) . '">' . $term->name . '</a>';
      }
      echo '</div>';
    }
  }

  /**
   * Function for display if pets are allowed using shortcodes
   * @param $attr Array of attributes is an array always
   */
  function jmc_are_pet_allowed($attr)
  {
    $args = shortcode_atts(['id' => 0], $attr);
    $post_id = $args['id'];
    $include_pets = get_post_meta($post_id, 'jmc_dogs', true);

    if ($include_pets) {
      echo '<p class="pets-allowed">Pets are allowed</p>';
    } else {
      echo '<p class="pets-not-allowed">Pets are not allowed</p>';
    }
  }
}

if (class_exists('Room')) {
  $room = new Room(); // Instance of Room class
  $room->execute_actions(); // Execute actions of Room class

  // Register Activation and Desactivation Hooks
}
