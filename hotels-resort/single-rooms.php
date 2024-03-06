<?php
get_header();
// Load the post 
// Because if we dont load the post the_title() will work because this exist in the page but the_content() will not work because this is not a page it is in the post
the_post();

if (has_post_thumbnail()) {
  $thumb_url = get_the_post_thumbnail_url();
} else {
  $thumb_url = get_template_directory_uri() . '/img/news/1.jpg';
}


$post_id = get_the_ID();

// Update the number of visits
increment_num_visits($post_id);

// Get an array with the categories id
$categories = get_the_terms($post_id, 'room_category');
if (!$categories) {
  $categories = [];
} else {
  $categories = array_map(function ($category) {
    return $category->term_id;
  }, $categories);
}

$terms = wp_get_post_terms($post_id, 'room_category', array('fields' => 'ids'));
var_dump($terms);


// Get the author id
$author_id = $post->post_author;

$slider_images = get_post_meta($post_id, 'jmc_slider_images', true);
?>

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
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
    </svg>
  </div>
  <!-- Navbar -->
<?php get_template_part('nav'); ?>

<?php
// Load
$thumb_url = get_template_directory_uri() . '/img/news/1.jpg';
if (has_post_thumbnail()) {
  $thumb_url = get_the_post_thumbnail_url();
}

$prize = get_post_meta($post->ID, 'jmc_price', true);
$square_meters = get_post_meta($post->ID, 'jmc_square_meters', true);
$adults = get_post_meta($post->ID, 'jmc_adults', true);
$bed_type = get_post_meta($post->ID, 'jmc_bed_type', true);
$include_breakfast = get_post_meta($post->ID, 'jmc_include_breakfast', true);
$include_wifi = get_post_meta($post->ID, 'jmc_include_wifi', true);
$orientation = get_post_meta($post->ID, 'jmc_orientation', true);

?>
  <!-- Header Banner -->
  <div class="room-details2 section-padding valign bg-img bg-fixed" data-overlay-dark="7"
       data-background="<?php echo $thumb_url ?>">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="wrap">
            <!-- IMAGE SLIDER -->
            <figure>
              <div class="owl-carousel owl-theme">
                <?php
                if ($slider_images) {
                  foreach ($slider_images as $imageUrl) {
                    ?>
                    <div class="img"><img src="<?php echo esc_url($imageUrl) ?>" alt=""></div>
                    <?php
                  }
                } else { ?>
                  <div class="img"><img src="<?php echo bloginfo('template_directory'); ?>/img/default/logo-default.jpg"
                                        alt=""></div>
                  <?php
                }
                ?>
              </div>
            </figure>
            <!-- END IMAGE SLIDER -->
            <div class="caption">
              <div class="title white mb-10"><?php the_title() ?></div>
              <span>
              <i class="star-rating"></i>
              <i class="star-rating"></i>
              <i class="star-rating"></i>
              <i class="star-rating"></i>
              <i class="star-rating"></i>
            </span>
              <p><?php echo get_the_excerpt() ?></p>
              <div class="row">
                <div class="col-md-12 pl-0 pr-0">
                  <ul class="row">
                    <!-- Adults -->
                    <li class="col-md-6 flex align-items-center">
                      <div class="icon">
                        <span class="flaticon-group"></span>
                      </div>
                      <div class="text">
                        <p><?php echo $adults ?> Packs</p>
                      </div>
                    </li>
                    <!-- Square Meters -->
                    <li class="col-md-6 flex align-items-center">
                      <div class="icon">
                        <span class="flaticon-clock-1"></span>
                      </div>
                      <div class="text">
                        <p><?php echo $square_meters ?> sqft room</p>
                      </div>
                    </li>
                    <!-- Bed Type -->
                    <li class="col-md-6 flex align-items-center">
                      <div class="icon">
                        <span class="flaticon-bed"></span>
                      </div>
                      <div class="text">
                        <p><?php echo $bed_type ?></p>
                      </div>
                    </li>
                    <!-- Orientation -->
                    <li class="col-md-6 flex align-items-center">
                      <div class="icon">
                        <span class="flaticon-world"></span>
                      </div>
                      <div class="text">
                        <p><?php echo $orientation ?></p>
                      </div>
                    </li>
                    <!-- Include Wifi and Breakfast -->
                    <?php if ($include_wifi) { ?>
                      <li class="col-md-6 flex align-items-center">
                        <div class="icon"><span class="flaticon-wifi"></span></div>
                        <div class="text">
                          <p>Free Wifi</p>
                        </div>
                      </li> <?php } ?>
                    <?php if ($include_breakfast) { ?>
                      <li class="col-md-6 flex align-items-center">
                        <div class="icon"><span class="flaticon-breakfast"></span></div>
                        <div class="text">
                          <p>Breakfast</p>
                        </div>
                      </li> <?php } ?>
                  </ul>
                </div>
              </div>
              <div class="row rooms3 mt-2">
                <div class="room-actions">
                  <span class="price text-white">$<?php echo $prize ?> <i class="text-white">/ per night</i></span>
                  <div class="butn-dark">
                    <a href="#">
                      <span>Book Now</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- button scroll -->
    <a href="#" data-scroll-nav="1" class="mouse smoothscroll"> <span class="mouse-icon">
      <span class="mouse-wheel"></span> </span>
    </a>
  </div>

  <!-- Post -->
  <section class="room-content section-padding" data-scroll-index="1">
    <div class="container">
      <div class="row">
        <!-- Room Content -->
        <div class="col-lg-8 single__content blog__post room-details1">
          <div class="post-stats">
            <div class="post-stat-container">
              <i class="fa-solid fa-comment"></i>
              <?php comments_number('No comments yet', '1 comment', '% comments'); ?>
            </div>
            <div class="post-stat-container">
              <i class="fa-solid fa-eye"></i>
              <?php echo get_num_visits($post_id) ?>
            </div>
          </div>
          <?php do_shortcode('[jmc_show_categories]') ?>
          <div class="section-title"><?php the_title() ?></div>
          <?php do_shortcode('[jmc_show_amenities id="' . $post->ID . '"]') ?>
          <?php the_content(); ?>
          <div class="row room-default-content">
            <div class="col-md-6">
              <h6>Check-in</h6>
              <ul class="list-unstyled page-list mb-30">
                <li>
                  <div class="page-list-icon"><span class="ti-check"></span></div>
                  <div class="page-list-text">
                    <p>Check-in from 9:00 AM - anytime</p>
                  </div>
                </li>
                <li>
                  <div class="page-list-icon"><span class="ti-check"></span></div>
                  <div class="page-list-text">
                    <p>Early check-in subject to availability</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-md-6">
              <h6>Check-out</h6>
              <ul class="list-unstyled page-list mb-30">
                <li>
                  <div class="page-list-icon"><span class="ti-check"></span></div>
                  <div class="page-list-text">
                    <p>Check-out before noon</p>
                  </div>
                </li>
                <li>
                  <div class="page-list-icon"><span class="ti-check"></span></div>
                  <div class="page-list-text">
                    <p>Express check-out</p>
                  </div>
                </li>
              </ul>
            </div>
            <div class="col-md-12">
              <h6>Special check-in instructions</h6>
              <p>Guests will receive an email 5 days before arrival with check-in instructions; front desk staff will
                greet guests on arrival For more details, please contact the property using the information on the
                booking confirmation.</p>
            </div>
            <div class="col-md-12">
              <h6>Pets</h6>
              <?php do_shortcode('[jmc_are_pet_allowed id="' . $post->ID . '"]') ?>
            </div>
            <div class="col-md-12">
              <h6>Children and extra beds</h6>
              <p>Children are welcome Kids stay free! Children stay free when using existing bedding; children may not
                be eligible for complimentary breakfast Rollaway/extra beds are available for $ 10 per day.</p>
            </div>
          </div>

          <div class="tags">
            <?php do_shortcode('[jmc_show_tags id="' . $post->ID . '"]') ?>
          </div>

          <!-- Related Posts -->
          <div class="related-posts-container row">
            <h1>You might also like</h1>
            <?php
            $args = array(
              'post_type' => ['rooms'], // Only show the rooms post type
              'posts_per_page' => 3,
              'post__not_in' => array($post_id),
              'tax_query' => array(
                array(
                  'taxonomy' => 'room_category',
                  'field' => 'term_id',
                  'terms' => $categories,
                ),
              ),
            );

            $related_posts = new WP_Query($args);

            if ($related_posts->have_posts()) :
              $posts_count = $related_posts->post_count;

              // Choose the correct column class
              $column_class = 'col-md-4';
              if ($posts_count == 1) {
                $column_class = 'col-md-12';
              } else if ($posts_count == 2) {
                $column_class = 'col-md-6';
              }

              while ($related_posts->have_posts()) :
                $related_posts->the_post();
                $thumb_url = get_template_directory_uri() . '/img/news/1.jpg';
                if (has_post_thumbnail()) {
                  $thumb_url = get_the_post_thumbnail_url();
                }
                ?>
                <div class="related-post-item <?php echo $column_class ?>">
                  <div class="post-img">
                    <a href="<?php the_permalink() ?>"> <img class="related-post-image" src="<?php echo $thumb_url ?>"
                                                             alt="<?php the_title() ?>"> </a>
                  </div>
                  <div class="post-cont">
                    <h4><a href="<?php the_permalink() ?>">
                        <?php the_title() ?>
                      </a></h4>
                    <?php the_category() ?>
                    <div class="related-post-details">
                      <p class="author__paragraph">
                        <?php echo the_author_posts_link() ?>
                      </p>
                      <p class="date">
                        <?php echo get_the_time('F, j Y') ?>
                      </p>
                    </div>
                    <div class="butn-dark"><a href="<?php the_permalink() ?>"><span>Read More</span></a></div>
                  </div>
                </div>
              <?php
              endwhile;
            else:
              echo '<h3 class="text-center mt-5 mb-3">No related posts</h3>';
            endif;

            wp_reset_postdata();
            ?>
          </div>

          <!-- Comments -->
          <div class="post-comment-section">
            <div class="row">
              <!-- Comment -->
              <div class="col-md-12">
                <div class="blog-post-comment-wrap">
                  <div class="post-user-comment">
                    <?php
                    echo get_avatar($author_id, 100, '', '', array('class' => 'avatar'));
                    ?>
                  </div>
                  <div class="post-user-content"> <span>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                  </span>
                    <h3><?php the_author_posts_link() ?><span> 29 October 2023</span></h3>
                    <p><?php 
                    echo nl2br(get_the_author_meta('description', $author_id)) 
                    ?></p>
                  </div>
                </div>
              </div>
              <!-- Contact Form -->
              <div class="col-md-12 mb-30">
                <h6 class="mb-30"><?php comments_number('No comments', '1 Comment', '% Comments') ?></h6>
                <?php comments_template() ?>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
          <?php get_sidebar('single'); ?>
        </div>
      </div>
    </div>
  </section>
<?php get_footer(); ?>