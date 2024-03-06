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
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5"
  data-background="<?php echo bloginfo('template_directory'); ?>/img/headers/Blog-1.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center caption">
        <h5>Hotel Blog</h5>
        <h1>Our News</h1>
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
    <!--- Inicio del Post Destacado -->
    <?php
    $args = array(
      'posts_per_page' => 1,
    );

    $post_destacado = new WP_Query($args);

    if ($post_destacado->have_posts()):
      while ($post_destacado->have_posts()):
        $post_destacado->the_post(); // Nos da acceso a todas las funciones the_* y al objecto $post
    
        // Load
        $thumb_url = get_template_directory_uri() . '/img/news/1.jpg';
        if (has_post_thumbnail()) {
          $thumb_url = get_the_post_thumbnail_url();
        }

        // Store the post ID to exclude in the main LOOP
        $post_destacado_id = get_the_ID();
        ?>
        <div class="row">
          <div class=" services2 left post-destacado">
            <figure>
              <a href="<?php the_permalink() ?>">
                <img src="<?php echo $thumb_url ?>" alt="<?php echo the_title() ?>" class="img-fluid">
              </a>
            </figure>
            <div class="caption padding-left">
              <?php the_category() ?>
              <div class="info">
                <span>Published on
                  <?php the_time('F j, Y') ?>
                </span>
                <span>by
                  <?php echo the_author_posts_link() ?>
                </span>
                <br>
              </div>
              <h4><a href="<?php the_permalink() ?>">
                  <?php echo the_title() ?>
                </a></h4>
              <p>
                <?php the_excerpt() ?>
              </p>
              <p></p>
              <div class="info-wrapper mt-20">
                <div class="butn-dark"> <a href="<?php the_permalink() ?>"><span>Read More</span></a> </div>
              </div>
            </div>
          </div>
        </div>
        <?php
      endwhile;
    endif;

    // Reset the query
    wp_reset_postdata();
    ?>
    <!--- Fin del Post Destacado -->
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <!--- LOOP Posts -->
          <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $args = array(
            'paged' => $paged, // Es paged porque WP tiene una paginacion en esta página
            'posts_per_page' => 5,
            'post__not_in' => array($post_destacado_id), // Exclude the post ID
          );

          $query = new WP_Query($args);

          if ($query->have_posts()):
            while ($query->have_posts()):
              $query->the_post(); // Nos da acceso a todas las funciones the_* y al objecto $post
          
              // Load
              $thumb_url = get_template_directory_uri() . '/img/news/1.jpg';
              if (has_post_thumbnail()) {
                $thumb_url = get_the_post_thumbnail_url();
              }
              ?>
              <div class="col-md-12 blog__post">
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
                    <?php the_category() ?>
                    <p class="author__paragraph">Published by
                      <?php echo the_author_posts_link() ?>
                    </p>
                    <h5><a href="<?php the_permalink() ?>">
                        <?php the_title() ?>
                      </a></h5>
                    <p>
                      <?php the_excerpt() ?>
                    </p>
                    <div class="tags">
                      <?php the_tags("", "") ?>
                    </div>
                    <div class="butn-dark"> <a href="<?php the_permalink() ?>"><span>Read More</span></a> </div>
                  </div>
                </div>
              </div>
              <?php
            endwhile;
          else:
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
              $args =  [
                'type' => 'list',
                'prev_text' => '<i class="ti-angle-left"></i>',
                'next_text' => '<i class="ti-angle-right"></i>',
              ];
              the_posts_pagination($args);
              // echo paginate_links(
              //   array(
              //     'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
              //     'total' => $query->max_num_pages,
              //     'current' => max(1, get_query_var('paged')),
              //     'format' => '?paged=%#%',
              //     'show_all' => false,
              //     'type' => 'plain',
              //     'end_size' => 2,
              //     'mid_size' => 1,
              //     'prev_next' => true,
              //     'prev_text' => '<i class="ti-angle-left"></i>',
              //     'next_text' => '<i class="ti-angle-right"></i>',
              //     'add_args' => false,
              //     'add_fragment' => '',
              //   ));
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