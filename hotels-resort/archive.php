<?php get_header(); 

$words = '';
// If is category or a category from a custom post type
if (is_category() || is_tax()) {
  // If is is_tax() look if is a category or a tag from a custom post type
  if (is_tax()) {
    $term = get_queried_object(); // Get the term object
    $taxonomy = get_taxonomy($term->taxonomy); // Get the taxonomy object
    $words = $term->name .' '.  $taxonomy->labels->singular_name; // Get the taxonomy singular name and the term name
  } else {
    $words = single_cat_title('', false)  . ' Category';
  }
} else if (is_tag()) {
  $words = single_tag_title('', false)  . ' Tag';
} else if (is_author()) {
  $words = get_the_author(); // Obtenemos el autor de los posts
} else if (is_day()) {
  $words = get_the_date();  
} else if (is_month()) {
  $words = get_the_date('F Y');
} else if (is_year()) {
  $words = get_the_date('Y');
} else {
  $words = 'Archive';
}

// Hallar el número de resultados de la busqueda
if ( have_posts()) {
  // wp_the_query() es una de las formas de referenciar a la consulta principal de WP
  $total_posts = $wp_query->found_posts; // Almacenamos el números de posts encontrados
  if ($total_posts != 1) {
    $postText = 'Posts';
  } else {
    $postText = 'Post';
  }
} else {
  $total_posts = null;
  $postText = 'No Posts';
}

?>

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
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5" data-background="<?php echo bloginfo('template_directory'); ?>/img/headers/Archive-1.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center caption">
        <h5><?php echo $total_posts." ".$postText ?> found</h5>
        <h1>Results for: <?php echo $words ?></h1>
      </div>
    </div>
  </div>
  <!-- button scroll -->
  <a href="#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
      <span class="mouse-wheel"></span> </span>
  </a>
</div>
<!-- Blog -->
<section class="blog section-padding" data-scroll-index="1">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">

          <!-- Recent Post -->
          <div class="col-md-12">
            <div class="recent-entry-container">
              <?php
              if (have_posts()) :
                while (have_posts()) :
                  the_post();
                  if (has_post_thumbnail()) {
                    $thumbnail = get_the_post_thumbnail_url();
                  } else {
                    if (get_post_type() == 'page') {
                      $thumbnail = get_template_directory_uri() . '/img/pages/' . get_the_title() . '.jpg';
                    } else {
                      $thumbnail = get_template_directory_uri() . '/img/rooms/1.jpg';
                    }
                  }

                  // Check if the post is a page
                  if (get_post_type() == 'page') {
                    $dateText = 'PAGE';
                  } else {
                    $dateText = get_the_time('F j, Y');
                  }
              ?>
                  <div class="recent-entry">
                    <a class="recent-entry-image" href="<?php the_permalink() ?>">
                      <img src="<?php echo $thumbnail ?>" alt="<?php the_title() ?>">
                    </a>
                    <div class="recent-info">
                      <div>
                        <h4>
                          <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                        </h4>
                        <!-- Mostrar December 15, 2023 -->
                        <?php
                        if (get_post_type() !== 'rooms') { ?>
                          <div class="recent-info-date"><?php echo $dateText ?></div>
                        <?php } ?>

                        <?php
                        // Show the prize if the post is a room
                        if (get_post_type() == 'rooms') {
                          $price = get_post_meta(get_the_ID(), 'jmc_price', true);
                          echo '<span class="price text-black">$' . $price . '<i class="text-black">/ per night</i></span>';
                        }
                        ?>
                      </div>
                      <?php 
                        if (get_post_type() === 'rooms') {
                          ?>
                            <a href="<?php the_permalink() ?>" class="butn-dark2"><span>Book</span></a>
                          <?php
                        }
                      ?>
                    </div>
                  </div>
              <?php
                endwhile;
              else :
                ?>
                <div class="no-post-found-container">
                  <h3>No posts found...</h3>
                </div>
              <?php
              endif;
              ?>
            </div>
          </div>

          <!-- Pagination -->
          <div class="col-md-12">  
            <ul class="blog-pagination-wrap align-center mb-30 mt-30">
              <?php
                $args =  [
                  'type' => 'list',
                  'prev_text' => '<i class="ti-angle-left"></i>',
                  'next_text' => '<i class="ti-angle-right"></i>',
                ];
                the_posts_pagination($args);
              ?>
            </ul>
          </div>
        </div>
      </div>
      <!-- Sidebar -->
      <div class="col-lg-4">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>