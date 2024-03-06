<?php

/*******************************
 * Template Name: Facilities
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
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5" data-background="<?php echo bloginfo('template_directory'); ?>/img/headers/Rooms.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center caption">
        <h5>TIMELESS ELEGANCE IN MARBELLA</h5>
        <h1>Patara Rooms</h1>
      </div>
    </div>
  </div>
  <!-- button scroll -->
  <a href="#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
      <span class="mouse-wheel"></span> </span>
  </a>
</div>
<!-- Blog -->
<section class="room4 blog section-padding" data-scroll-index="1">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <!--- LOOP Posts -->
          <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array(
            'paged' => $paged, // Es paged porque WP tiene una paginacion en esta página
            'post_type' => ['rooms'], // Only show the rooms post type
            'posts_per_page' => 6,
            'paged' => get_query_var('paged'),
          );

          $query = new WP_Query($args);

          if ($query->have_posts()) :
            while ($query->have_posts()) :
              $query->the_post(); // Nos da acceso a todas las funciones the_* y al objecto $post

              // Load
              $thumb_url = get_template_directory_uri() . '/img/rooms/1.jpg';
              if (has_post_thumbnail()) {
                $thumb_url = get_the_post_thumbnail_url();
              }
              $prize = get_post_meta( $post->ID, 'jmc_price', true);
              $adults = get_post_meta($post->ID, 'jmc_adults', true);
              $bed_type = get_post_meta($post->ID, 'jmc_bed_type', true);
              $include_breakfast = get_post_meta($post->ID, 'jmc_include_breakfast', true);
              $include_wifi = get_post_meta($post->ID, 'jmc_include_wifi', true);
          ?>
              <div class="col-md-6 mb-30">
                <div class="rooms3">
                  <div class="room-img"><img src="<?php echo $thumb_url?>" alt="" class="w-100"></div>
                  <div class="room-header">
                    <h3 class="room-label"><?php the_title() ?></h3>
                  </div>
                  <div class="room-wrap">
                    <div class="room-cont">
                      <?php do_shortcode('[jmc_show_categories id="'.$post->ID.'"]') ?>
                      <h4 class="room-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                      <p class="room-text"><?php echo get_the_excerpt() ?></p>
                      <div class="row room-facilities mb-30">
                        <div class="col-md-12 pl-0 pr-0">
                          <ul class="row">
                            <li class="col-md-6"><i class="flaticon-group"></i> <?php echo $adults ?> Packs</li>
                            <li class="col-md-6"><i class="flaticon-bed"></i> <?php echo $bed_type ?></li>
                            <?php if ($include_wifi) {?> <li class="col-md-6"><i class="flaticon-wifi"></i> Free Wifi</li> <?php } ?>
                            <?php if ($include_breakfast) {?> <li class="col-md-6"><i class="flaticon-breakfast"></i> Breakfast</li> <?php } ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="room-actions"><span class="price">$<?php echo $prize  ?> <i>/ per night</i></span> <a href="<?php the_permalink() ?>" class="icon-btn"><i class="ti-angle-right"></i></a></div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-12 blog__post">
                <div class="item">
                  <div class="post-img">
                    <a href="<?php the_permalink() ?>"> <img src="<?php echo $thumb_url ?>" alt="<?php the_title() ?>">
                    </a>
                    <div class="date">
                      <a> <span>
                          <?php the_time('M'); ?>
                        </span> <i>
                          <?php the_time('j') ?>
                        </i> </a>
                    </div>
                  </div>
                  <div class="post-cont">
                    <?php do_shortcode('[jmc_show_categories]') ?>
                    <p class="author__paragraph">Published by
                      <?php echo the_author_posts_link() ?>
                    </p>
                    <h5><a href="<?php the_permalink() ?>">
                        <?php the_title() ?>
                      </a></h5>
                    <p>
                      <?php do_shortcode('[jmc_show_main_fields id="' . $post->ID . '"]') ?>

                      <?php do_shortcode('[jmc_show_tags]') ?>
                      <?php the_excerpt() ?>
                    </p>
                    <div class="tags">
                      <?php the_tags("", "") ?>
                    </div>
                    <div class="butn-dark"> <a href="<?php the_permalink() ?>"><span>Read More</span></a> </div>
                  </div>
                </div>
              </div> -->
          <?php
            endwhile;
          else :
            echo '<p>No hay posts</p>';
          endif;

          // Reset the query
          wp_reset_postdata();
          ?>
          <!--- Fin LOOP Posts -->
          <!-- Pagination -->
          <div class="col-md-12">
            <ul class="blog-pagination-wrap align-center mb-30 mt-30">
              <?php
              // $args =  [
              //   'type' => 'list',
              //   'prev_text' => '<i class="ti-angle-left"></i>',
              //   'next_text' => '<i class="ti-angle-right"></i>',
              // ];
              // the_posts_pagination($args);
              echo paginate_links(
                array(
                  'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                  'total' => $query->max_num_pages,
                  'current' => max(1, get_query_var('paged')),
                  'format' => '?paged=%#%',
                  'show_all' => false,
                  'type' => 'plain',
                  'end_size' => 2,
                  'mid_size' => 1,
                  'prev_next' => true,
                  'prev_text' => '<i class="ti-angle-left"></i>',
                  'next_text' => '<i class="ti-angle-right"></i>',
                  'add_args' => false,
                  'add_fragment' => '',
                ));
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