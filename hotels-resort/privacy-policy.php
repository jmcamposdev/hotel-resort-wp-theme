<?php
/*******************************
 * Template Name: Privacy Policy
 ******************************/
?>

<?php get_header();?>
<!-- Preloader -->
<div class="preloader-bg"></div>
<div id="preloader">
  <div id="preloader-status">
    <div class="preloader-position loader"><span></span></div>
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
<div class="author-banner banner-header section-padding valign bg-img bg-fixed bg-position-bottom">
  <div class="container">
    <div class="row">
      <div class="col-md-12 justify-content-center d-flex flex-column caption align-items-center">
        <h5 class="author-nickname">
          
        </h5>
        <h1 class="author-name">
          <?php the_title() ?>
        </h1>
      </div>
    </div>
  </div>
</div>
<!-- END Header Banner -->

<!-- About Me -->
<section class="about-me-section section-padding" data-scroll-index="1">
  <div class="container">
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light"><?php the_title() ?></div>
      </div>
      <div class="col-md-9">
        <div class="row">
          <?php the_content();?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END About Me -->

<?php get_footer(); ?>