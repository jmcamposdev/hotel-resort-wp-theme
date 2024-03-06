<?php
/*******************************
 * Template Name: Private
 ******************************/
?>
<?php get_header(); ?>
<!-- Preloader -->
<div class="preloader-bg"></div>
<div id="preloader">
  <div id="preloader-status">
    <div class="preloader-position loader"> <span></span> </div>
  </div>
</div>
<!-- Progress scroll totop -->
<div class="progress-wrap cursor-pointer">
  <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>
<!-- Navbar -->
<?php get_template_part('nav'); ?>
<!-- Header Banner -->
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5" data-background="<?php echo bloginfo('template_directory'); ?>/img/pages/Login.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 caption text-center">
        <h4>Access Restricted</h4>
        <h1>Private Zone</h1>
      </div>
    </div>
  </div>
  <!-- button scroll -->
  <a href="#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
      <span class="mouse-wheel"></span> </span>
  </a>
</div>
<!-- Contact -->
<section class="contact section-padding" data-scroll-index="1">
  <div class="container">
    <div class="row mb-30 justify-content-center">
      <div class="col-md-9">
        <div class="row text-center justify-content-center">
                <?php
                  if (!is_user_logged_in()) {
                    // User is not logged in, show the login form...
                    echo "<div class='section-title'>Login</div>";
                    echo "<h5 class='privatezone-role mt-2'>Please login to access the private zone</h5>";
                    echo "<div class='col-md-6 mt-5'>";
                      wp_login_form();
                    echo "</div>";
                ?>
                <?php
                  } else {
                    // User is logged in, show the admin area logout 
                    $user = wp_get_current_user(); // Retrive an user object
                    $user_name = $user->display_name; // Get the user display name
                    $rol = get_author_roles($user->ID); // Get the user role
                    
                    echo "<div class='section-title'>Hello, $user_name!</div>";
                    echo "<h5 class='privatezone-role mt-2'>$rol</h5>";

                    do_shortcode('[mmm_show_message id="'.$user->ID.'"]');
                    // Display admin-area button
                    echo "<div class='row col-md-6 mt-5'>";

                    echo "<div class='col'>";
                      echo "<div class='butn-dark'>";
                         echo "<a href='".get_admin_url()."'><span>Admin Area</span></a>";
                      echo "</div>";
                    echo "</div>";


                    echo "<div class='col'>";
                      echo "<div class='butn-dark'>";
                        echo "<a href='".wp_logout_url("private")."'><span>Logout</span></a>";
                      echo "</div>";
                    echo "</div>";

                  }
                ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
<script>
 jQuery(document).ready(function() {
    const rememberContainer = jQuery('.login-remember');
    const rememberInput = jQuery('.login-remember input');
    // Move the input to the label
    rememberInput.prependTo(rememberContainer);

    const rememberLabel = jQuery('.login-remember label');
    // Add for atrribute to the label
    rememberLabel.attr('for', 'rememberme');
  });
</script>