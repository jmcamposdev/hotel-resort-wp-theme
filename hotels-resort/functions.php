<?php

add_theme_support('post-thumbnails'); // Allow us to add a featured image to the posts

/**
 * Add CSS, JS files to our thme
 */
function my_theme_scripts()
{
  // Add  secondary css stylesheet
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

  wp_enqueue_style('plugins', get_template_directory_uri() . '/css/plugins.css');
  wp_enqueue_style('frontend', get_template_directory_uri() . '/css/style.css');
  wp_enqueue_style('dashicons');

  // Add main css stylesheet - /hotels-resort/style.css
  wp_enqueue_style('style', get_stylesheet_uri());

  // Add js files
  // JQuery
  wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.6.3.min.js', [], null, false);
  wp_enqueue_script('jquery');
  // Migrate
  wp_register_script('jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate-3.0.0.min.js', ['jquery'], null, true);
  wp_enqueue_script('jquery-migrate');

  wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', ['jquery'], null, false);
  wp_enqueue_script('modernizr');

  wp_register_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', ['jquery'], null, false);
  wp_enqueue_script('imagesloaded');

  wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.v3.0.2.js', ['jquery'], null, false);
  wp_enqueue_script('isotope');

  wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.v3.0.2.js', ['jquery'], null, false);
  wp_enqueue_script('isotope');

  wp_register_script('pace', get_template_directory_uri() . '/js/pace.js', ['jquery'], null, false);
  wp_enqueue_script('pace');

  wp_register_script('popper', get_template_directory_uri() . '/js/popper.min.js', ['jquery'], null, false);
  wp_enqueue_script('popper');


  wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], null, false);
  wp_enqueue_script('bootstrap');

  wp_register_script('scrollIt', get_template_directory_uri() . '/js/scrollIt.min.js', ['jquery'], null, false);
  wp_enqueue_script('scrollIt');

  wp_register_script('waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', ['jquery'], null, false);
  wp_enqueue_script('waypoints');

  wp_register_script('carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', ['jquery'], null, false);
  wp_enqueue_script('carousel');

  wp_register_script('stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', ['jquery'], null, false);
  wp_enqueue_script('stellar');

  wp_register_script('magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.js', ['jquery'], null, false);
  wp_enqueue_script('magnific-popup');

  wp_register_script('YouTubePopUp', get_template_directory_uri() . '/js/YouTubePopUp.js', ['jquery'], null, false);
  wp_enqueue_script('YouTubePopUp');

  wp_register_script('select2', get_template_directory_uri() . '/js/select2.js', ['jquery'], null, false);
  wp_enqueue_script('select2');

  wp_register_script('datepicker', get_template_directory_uri() . '/js/datepicker.js', ['jquery'], null, false);
  wp_enqueue_script('datepicker');

  wp_register_script('smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.min.js', ['jquery'], null, false);
  wp_enqueue_script('smooth-scroll');

  wp_register_script('wow', get_template_directory_uri() . '/js/wow.min.js', ['jquery'], null, false);
  wp_enqueue_script('wow');

  wp_register_script('custom', get_template_directory_uri() . '/js/custom.js', ['jquery'], null, false);
  wp_enqueue_script('custom');

  wp_register_script('progressbar', get_template_directory_uri() . '/js/progressbar.min.js', ['jquery'], null, false);
  wp_enqueue_script('progressbar');

  wp_register_script('progressbarInit', get_template_directory_uri() . '/js/progressbarInit.js', [], null, false);
  wp_enqueue_script('progressbarInit');

  wp_enqueue_script('masonry');  // Active masonry library

  wp_register_script('masonry-init', get_template_directory_uri() . '/js/masonry-init.js', ['jquery'], null, false);
  wp_enqueue_script('masonry-init');

  wp_register_script('comment-redirect', get_template_directory_uri() . '/js/comment-redirect.js', ['jquery'], null, false);
  wp_enqueue_script('comment-redirect');
}

// Cuando se carga el hook 'wp_enqueue_scripts' se ejecuta la función 'my_theme_scripts'
add_action('wp_enqueue_scripts', 'my_theme_scripts');


function add_admin_scripts()
{
  wp_register_script('profileImagePreview', get_template_directory_uri() . '/js/profileImagePreview.js', [], null, false);
  wp_enqueue_script('profileImagePreview');
}

add_action('admin_enqueue_scripts', 'add_admin_scripts');

function get_page_url($title)
{
  $array_of_objects = get_posts([
    'title' => $title,
    'post_type' => 'page',
  ]);

  $id = $array_of_objects[0];
  $id = $id->ID;
  $link = get_permalink($id);
  return $link;
}

/**
 * Retrieves a page object based on the title of the page
 * @param $title string Page title
 * @return $page Page Object
 */
function get_page_object($title)
{
  $query = new WP_Query(
    array(
      'post_type'              => 'page',   /* Solo queremos posts tipo página */
      'title'                  =>  $title,  /* Título de la página suministrado como parámetro*/
      'post_status'            => 'all',    /* esté on o publicada */
      'posts_per_page'         => 1,        /* solo queremos 1 página */
      'no_found_rows'          => true,
      'ignore_sticky_posts'    => true,
      'update_post_term_cache' => false,
      'update_post_meta_cache' => false,
      'orderby'                => 'post_date ID',
      'order'                  => 'ASC',
    )
  );

  if (!empty($query->post)) {
    $page = $query->post;
  } else {
    $page  = null;
  }
  return $page;
}

/**
 * List post tags
 * @param $post_id int Post ID
 */
function get_post_tags($post_id)
{
  $tags = get_the_tags($post_id);
  if (!empty($tags)) {
    foreach ($tags as $tag) {
      echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag">' . $tag->name . '</a>';
    }
  }

  return $tags;
}

/**
 * List post tags
 * @param $limit int Limit of tags to show
 * @return $tags string List of tags
 */

function get_tag_list($limit)
{
  $args = [
    'number' => $limit,
    'orderby' => 'count',
    'order' => 'DESC',
  ];

  $tags = get_tags($args);

  $tag_list = '';

  foreach ($tags as $tag) {
    $tag_list .= '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '<span class="count">' . $tag->count . '</span></a></li>';
  }
}

/**
 * Register widgets zone for tag-cloud & calendar in sidebar
 */
function register_widgets_zones()
{
  // Zona para la nube de etiquetas
  $tag_cloud_args = [
    'name'          => 'Tag Cloud - Sidebar', // Nombre que se muestra en el sidebar.php
    'id'            => 'tag-cloud-sidebar', // ID del div del widget
    'description'   => 'Widgets zone for tag-cloud',
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<div class="widget-title"><h6>',
    'after_title'   => '</h6></div>',
  ];
  register_sidebar($tag_cloud_args);

  // Nueva zona de widgets (Ejemplo: Zona para el calendario)
  $calendar_args = [
    'name'          => 'Calendar - Sidebar', // Nombre para la nueva zona de widgets
    'id'            => 'calendar-sidebar', // ID del div del widget para el calendario
    'description'   => 'Widgets zone for calendar', // Descripción de la nueva zona
    'before_widget' => '<div class="widget calendar-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<div class="widget-title"><h6>',
    'after_title'   => '</h6></div>',
  ];
  register_sidebar($calendar_args);
}

add_action('widgets_init', 'register_widgets_zones'); // Añaadimos la función 'register_widgets_zone' al hook 'widgets_init' para que se ejecute cuando se cargue el hook



/**
 * Retrive the number of visits of a post
 * @param int post_id
 * @return string number of visits
 */
function get_num_visits($post_id)
{
  // Get the number of visits of a post
  $num_visits = get_post_meta($post_id, 'num_visits', true);

  // If the post has not been visited yet, the number of visits is 0
  if (empty($num_visits)) {
    $num_visits = 0;
  }

  // Set the text depending on the number of visits
  if ($num_visits == 1) {
    $num_visits .= ' visit';
  } else {
    $num_visits .= ' visits';
  }

  // Return the number of visits
  return $num_visits;
}

/**
 * Increment the number of visits of a post
 * @param int post_id
 */
function increment_num_visits($post_id)
{
  $num_visits = get_num_visits($post_id);

  // Get only the first part of the string (the number)
  $num_visits = explode(' ', $num_visits)[0];

  if ($num_visits == 0) { // If the post has not been visited yet, we add the post meta
    add_post_meta($post_id, 'num_visits', 1, true);
  } else { // If the post has been visited, we update the post meta
    update_post_meta($post_id, 'num_visits', ++$num_visits);
  }
}


/* ------------------------------------ AUTHOR ------------------------------ */

/**
 * Get the author roles
 */
function get_author_roles($author_id)
{
  // Get the author object
  $author = get_userdata($author_id);
  // Get the roles of the author
  $roles = $author->roles;
  // Transform the array into a string
  return implode(', ', $roles);
}


/* ==== MÉTODO SIMPLE PARA AÑADIR CAMPOS A EDITAR LOS USUARIOS ==== */
/**
 * Add social media fields to author profile
 * @param $user_methods array User profile fields - Provided by 'user_contactmethods' hook
 * @return $user_methods array User profile fields
 */
function add_social_media_fields($user_methods)
{
  // Add social media fields to user profile
  // The index of the array is the name of the field in the database
  $user_methods['facebook'] = 'Facebook';
  $user_methods['twitter'] = 'Twitter';
  $user_methods['instagram'] = 'Instagram';
  $user_methods['linkedin'] = 'LinkedIn';

  return $user_methods;
}

add_action('user_contactmethods', 'add_social_media_fields');


/**
 * Insert enc-type to user profile form in admin area
 */
function add_enctype_to_user_form()
{
  echo 'enctype="multipart/form-data"';
}

add_action('user_edit_form_tag', 'add_enctype_to_user_form');


/**
 * Add skills fields in user profile
 * @param $user user object, Nos lo prove el hooks ('show_user_profile', 'edit_user_profile')
 */
function add_user_skill_info($user)
{
  // Draw the form fields for skills with 

  // If we have a pic updated get the url, on the contrary display transparent miniature
  if (!empty(get_user_meta($user->ID, 'user_pic', true))) {
    $src = get_user_meta($user->ID, 'user_pic', true);
  } else {
    $src = get_template_directory_uri() . '/img/icons/transparente.png';
  }
?>

  <h3>User Profile Picture</h1>
    <div class="flex-profile-pic">
      <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
      <input type="file" name="user_pic" id="user_pic">
    </div>
    <div>
      <img src="<?php echo $src ?>" id="user_pic_preview" height="150px" />
      <p><?php echo $src ?></p>
    </div>
    <h3>User Skills</h3>
    <table class="form-table">
      <tr>
        <th>
          <label for="skill1">Skill 1:</label>
        </th>
        <td>
          <input type="text" name="skill1" id="skill1" value="<?php echo get_user_meta($user->ID, 'skill1', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your skills.</span>
        </td>
        <th>
          <label for="skill1v">Skill 1 Value:</label>
        </th>
        <td>
          <input type="text" name="skill1v" id="skill1v" value="<?php echo get_user_meta($user->ID, 'skill1v', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your value of the skill.</span>
        </td>
      </tr>
      <tr>
        <th>
          <label for="skill2">Skill 2:</label>
        </th>
        <td>
          <input type="text" name="skill2" id="skill2" value="<?php echo get_user_meta($user->ID, 'skill2', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your skills.</span>
        </td>
        <th>
          <label for="skill2v">Skill 2 Value:</label>
        </th>
        <td>
          <input type="text" name="skill2v" id="skill2v" value="<?php echo get_user_meta($user->ID, 'skill2v', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your value of the skill.</span>
        </td>
      </tr>
      <tr>
        <th>
          <label for="skill3">Skill 3:</label>
        </th>
        <td>
          <input type="text" name="skill3" id="skill3" value="<?php echo get_user_meta($user->ID, 'skill3', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your skills.</span>
        </td>
        <th>
          <label for="skill3v">Skill 3 Value:</label>
        </th>
        <td>
          <input type="text" name="skill3v" id="skill3v" value="<?php echo get_user_meta($user->ID, 'skill3v', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your value of the skill.</span>
        </td>
      </tr>
      <tr>
        <th>
          <label for="skill4">Skill 4:</label>
        </th>
        <td>
          <input type="text" name="skill4" id="skill4" value="<?php echo get_user_meta($user->ID, 'skill4', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your skills.</span>
        </td>
        <th>
          <label for="skill4v">Skill 4 Value:</label>
        </th>
        <td>
          <input type="text" name="skill4v" id="skill4v" value="<?php echo get_user_meta($user->ID, 'skill4v', true); ?>" class="regular-text" /><br />
          <span class="description">Please enter your value of the skill.</span>
        </td>
      </tr>
    </table>
  <?php
}

add_action('show_user_profile', 'add_user_skill_info');
add_action('edit_user_profile', 'add_user_skill_info');

/**
 * Save the skills fields in user profile (Database)
 * @param $user_id user object Nos los proveen dos hooks ('personal_options_update', 'edit_user_profile_update')
 */
function save_skills_info($user_id)
{

  // Save our profile picture
  $user_info = get_userdata($user_id);
  $user_name = $user_info->user_login;

  // If the user has uploaded and no errors a new profile picture, we save it
  if ($_FILES['user_pic']['error'] == UPLOAD_ERR_OK) {
    $upload_dir = wp_upload_dir(); // Get the upload directory 
    $subdir = "/team/"; // Subdirectory where we want to save the file
    $upload_path = $upload_dir['basedir'] . $subdir; // Path to the upload directory
    $file_name = $user_name . '-' . $_FILES['user_pic']['name']; // File name
    $file_temp = $_FILES['user_pic']['tmp_name']; // Temporary file
    $file_dest = $upload_path . $file_name; // Path to the file

    // If the directory does not exist, we create it
    if (move_uploaded_file($file_temp, $file_dest)) {
      // The file has been uploaded successfully
      $file_url = $upload_dir['baseurl'] . $subdir . $file_name;
      update_user_meta($user_id, 'user_pic', $file_url);
    } else {
      // The file has not been uploaded
      update_user_meta($user_id, 'user_pic', '<strong>Something bad happens, the pic has not been uploaded</strong>', true);
    }
  }

  update_user_meta($user_id, 'skill1', $_POST['skill1']);
  update_user_meta($user_id, 'skill1v', $_POST['skill1v']);

  update_user_meta($user_id, 'skill2', $_POST['skill2']);
  update_user_meta($user_id, 'skill2v', $_POST['skill2v']);

  update_user_meta($user_id, 'skill3', $_POST['skill3']);
  update_user_meta($user_id, 'skill3v', $_POST['skill3v']);

  update_user_meta($user_id, 'skill4', $_POST['skill4']);
  update_user_meta($user_id, 'skill4v', $_POST['skill4v']);
}

add_action('personal_options_update', 'save_skills_info');
add_action('edit_user_profile_update', 'save_skills_info');


// COMENTARIOS

/**
 * Quitar el campo website (url) del formulario de comentarios
 * @param $fields array lista de campos de form -> nos los suministra el hook comment_form_default_fields
 * @return $fields array lista de campos de form
 */
function delete_url_form_comment_form($fields)
{
  unset($fields['url']);
  return $fields;
}
add_action('comment_form_default_fields', 'delete_url_form_comment_form');

// add_filter('comment_form_fiedl_url', function ($url) {
//   return;
// });

/**
 * Reorder comment form fields
 * @param $fields array lista de campos de form -> nos los suministra el hook comment_form_fields
 * @return $fields array lista de campos de form
 */

function redorder_comment_form_fields($fields)
{
  // If the user is logged id we have different fields
  if (!is_user_logged_in()) {
    $aux = [];
    array_push($aux, $fields['author']);
    array_push($aux, $fields['email']);
    array_push($aux, $fields['comment']);
    array_push($aux, $fields['cookies']);
    array_push($aux, $fields['consent']);

    return $aux;
  } else {
    return $fields;
  }
}

add_action('comment_form_fields', 'redorder_comment_form_fields');

/**
 * Add a new field to comment form
 * @param $fields array lista de campos de form -> nos los suministra el hook comment_form_default_fields
 * @return $fields array lista de campos de form
 */
function add_conset_field($field)
{
  $field['consent'] = '<p>
                        <input type="checkbox" name="consent" id="consent" value="yes">
                        <label for="consent">Check this box to allow us to post your content. Doing so, your are accepting our <a href="' . get_page_link(get_page_object('Privacy Policy')->ID) . '">privacy policy</a></label>
                      </p>';

  return $field;
}
add_action('comment_form_default_fields', 'add_conset_field');

/**
 * Save comment consent field in DDBB
 * @param $comment_id integer Comment consent form field ID -> provided by the hook comment_post
 */
function save_consent_field($comment_id)
{
  if (isset($_POST['consent'])) {
    $value = 'Consent checkbox is checked. I accept the privacy policy';
  } else {
    if (is_user_logged_in()) {
      $value = 'Logged user. Privacy Policy have been alredy accepted.';
    } else {
      $value = 'Consent checkbox is NOT checked. Privacy Policy have NOT been accepted.';
    }
  }

  update_comment_meta($comment_id, 'consent', $value);
}
add_action('comment_post', 'save_consent_field');

/**
 * Add new column in admin area for consent comment form field
 * @param $columns array lista de columnas de los comentarios en el admin area -> nos los suministra el hook manage_edit-comments_columns
 * @return $columns array lista de columnas de los comentarios en el admin area
 */
function create_consent_column($columns)
{
  $column = [
    'cb' => '<input type="checkbox" />',
    'author' => 'Author',
    'comment' => 'Comment',
    'consent' => 'Consent',
    'response' => 'In response to',
    'date' => 'Submitted on',
  ];

  return $column;
}
add_filter('manage_edit-comments_columns', 'create_consent_column');

/**
 * Fill the consent column with the value of the consent comment form field
 * @param $column string nombre de la columna -> nos los suministra el hook manage_comments_custom_column
 * @param $comment_id array Comment ID
 */
function fill_consent_column($column, $comment_id)
{
  if ($column == 'consent') {
    echo get_comment_meta($comment_id, 'consent', true);
  }
}
add_action('manage_comments_custom_column', 'fill_consent_column', 1, 2);


function custom_comment_reply_link($link, $args, $comment, $post)
{
  // Añade tu icono a la etiqueta de enlace
  $link = str_replace('Reply</a>', 'Reply <i class="ti-back-left"></i></a>', $link);

  return $link;
}

add_filter('comment_reply_link', 'custom_comment_reply_link', 10, 4);

/* ========================== CUSTOMIZE LOGIN PAGE ========================== */

/**
 * Customize login template LOGO
 */

function custom_login_logo()
{
  ?>
    <style>
      #login h1 a,
      .login h1 a {
        background-image: url(<?php echo get_template_directory_uri(); ?>/img/logo-light.png);
        width: 300px;
        background-size: contain;
        background-position: center;
        background-repeat: no-repeat;
        padding-bottom: 30px;
      }

      .login {
        background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1)), url(<?php echo get_template_directory_uri(); ?>/img/pages/Login.jpg);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white !important;
      }

      #loginform {
        background: transparent !important;
        border: none;
        box-shadow: none
      }

      #loginform input[type="text"],
      #loginform input[type="password"] {
        max-width: 100%;
        margin-bottom: 0px;
        padding: 10px 0;
        height: auto;
        background-color: transparent;
        -webkit-box-shadow: none;
        box-shadow: none;
        border-width: 0 0 1px;
        border-style: solid;
        display: block;
        width: 100%;
        line-height: 1.5em;
        font-family: 'Outfit', sans-serif;
        font-size: 15px;
        font-weight: 300;
        color: #3b3b3b;
        background-image: none;
        border-bottom: 1px solid #e5dddc;
        border-color: ease-in-out .15s, box-shadow ease-in-out .15s;
        border-radius: 0;
        margin-bottom: 15px;
        color: white;
      }

      #loginform input[type="submit"] {
        font-weight: 300;
        font-family: 'Outfit', sans-serif;
        background: #aa8453;
        color: #fff;
        padding: 8px 24px;
        margin: 0;
        position: relative;
        font-size: 15px;
        border-radius: 0;
        border: none;
        width: fit-content;
        transition: all .3s ease-in-out;
      }

      #loginform input[type="submit"]:hover {
        background: #99764a;
        color: #fff;
      }

      #login_error {
        color: black !important;
      }

      #loginform .submit {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 4rem !important;
      }

      #nav a,
      #backtoblog a {
        color: white !important;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
      }

      .privacy-policy-link {
        color: white;
      }

      .privacy-policy-link:hover {
        color:
      }

      /* Check Box */
      #rememberme {
        position: relative;
        flex: 0;
        cursor: pointer;
      }

      #rememberme:focus,
      #rememberme:active {
        border: none !important;
        outline: 0 !important;
        box-shadow: none !important;
      }

      .forgetmenot label {
        cursor: pointer;
        position: relative;
        padding-left: 15px;
        line-height: normal;
        user-select: none;
      }

      .forgetmenot label::before {
        content: '';
        position: absolute;
        height: 18px;
        width: 18px;
        border-radius: 50%;
        background-color: #87B8D0;
        background-size: contain;
        top: 1px;
        left: -25px;
        border: 1px solid #aa8453;
      }

      .forgetmenot label::after {
        content: '';
        width: 10px;
        height: 10px;
        background: #aa8453;
        display: inline-block;
        border-radius: 10px;
        position: absolute;
        top: 6px;
        left: -20px;
        transform: scale(1);
        opacity: 0;
        transition: all 0.2s cubic-bezier(0.35, 0.9, 0.4, 0.9);
      }

      #rememberme:checked+label::after {
        opacity: 1;
        transform: scale(1.1);
      }
    </style>
  <?php

}
add_action('login_enqueue_scripts', 'custom_login_logo');

/**
 * Redirect login logo url
 */

function redirect_login_logo_url()
{
  return home_url();
}
add_filter('login_headerurl', 'redirect_login_logo_url');

/**
 * Customize login error message
 */

function custom_login_error_message()
{
  return 'The username or password you entered is incorrect. Please try again.';
}

add_filter('login_errors', 'custom_login_error_message');

/** -----------------------------------------------
 * Shortcode 
 * ----------------------------------------------- */

function br_callback()
{
  return '<br>';
}

add_shortcode('br', 'br_callback');


/** -----------------------------------------------
 * AYAX CALLS
 * ----------------------------------------------- */

// Función para manejar la carga de imágenes del slider
add_action('wp_ajax_upload_slider_image', 'upload_slider_image');

function upload_slider_image()
{
  // Get the post ID and the slider images
  $post_id = $_POST['post_id'];
  $slider_images = get_post_meta($post_id, 'jmc_slider_images', true);

  // Check if the file has been uploaded
  if (isset($_FILES['file']) && !empty($_FILES['file']['tmp_name'])) {
    // Get the file name and the target directory
    $file_name = uniqid() . '_' . $_FILES['file']['name'];
    // Get the uploads directory
    $uploads_dir = wp_upload_dir();
    // Get the target directory
    $target_dir = trailingslashit($uploads_dir['basedir']) . 'rooms/' . $post_id . '/';
    // Get the target path
    $target_path = $target_dir . $file_name;

    // If the target directory does not exist, create it
    if (!file_exists($target_dir)) {
      wp_mkdir_p($target_dir);
    }

    // Move the file to the target directory
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
      // Add the image to the slider images array
      $image_url = $uploads_dir['baseurl'] . '/rooms/' . $post_id . '/' . $file_name;
      $slider_images[] = $image_url;
      // Update the post meta
      update_post_meta($post_id, 'jmc_slider_images', $slider_images);
      // Return the image URL
      echo $image_url; // Devolver la URL de la imagen cargada
    }
  }
  wp_die();
}

// Función para manejar la eliminación de imágenes del slider
add_action('wp_ajax_delete_slider_image', 'delete_slider_image');

function delete_slider_image()
{
  // Get the post ID and the image URL
  $post_id = $_POST['post_id'];
  $removed_image = $_POST['image_url'];
  // Get the slider images from the post meta
  $slider_images = get_post_meta($post_id, 'jmc_slider_images', true);

  // Find the image in the array and remove it
  $image_index = array_search($removed_image, $slider_images);

  // If the image is found, remove it from the array and delete the file
  if ($image_index !== false) {
    // Remove the image from the array
    unset($slider_images[$image_index]);
    // Get the file path
    $file_path = str_replace(wp_upload_dir()['baseurl'], wp_upload_dir()['basedir'], $removed_image);
    // Delete the file
    unlink($file_path);
    // Update the post meta
    update_post_meta($post_id, 'jmc_slider_images', $slider_images);
  }

  wp_die();
}

/**
 * Exclude mm_message post type from search and archive pages
 */
// function exclude_mmm_message_from_search_and_archive( $query ) {
//   if ( ! is_admin() && $query->is_main_query() && ( is_search() || is_archive() ) ) {
//     $query->set( 'post_type', array( 'post', 'page', 'rooms' ) );
//   }
// }

// add_action( 'pre_get_posts', 'exclude_mmm_message_from_search_and_archive' );

/**
 * Show custom number of posts per page depending on template
 * @param $query object WP Query -> Provided by the hook pre_get_posts
 */
function custom_posts_per_page($query)
{
  if ((is_search() || is_archive()) && $query->is_main_query()) {
    // Modify WP Query argument 'post_per_page'
    $query->set('posts_per_page', 15);
  }
};

add_action('pre_get_posts', 'custom_posts_per_page');


// Get the categories of a post outside of the loop

function get_all_post_categories($post_id) {
  $categories = get_the_category($post_id);
  foreach($categories as $category) {
    echo $category->name;
    echo get_category_link($category->term_id);
  }
}

// Get the categories of a CPT
function get_all_cpt_categories($post_id) {
  $categories = get_the_terms($post_id, 'room_category');
  foreach($categories as $category) {
    echo $category->name;
    echo get_category_link($category->term_id);
  }
}

function get_all_cpt_categories_global() {
  $categories = wp_list_categories([
    'title_li' => '',
    'taxonomy' => 'room_category',
    'show_count' => true,
  ]);
  var_dump($categories);
}