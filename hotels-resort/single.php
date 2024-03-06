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
$categories = wp_get_post_categories($post_id);

// Get the author id
$author_id = $post->post_author;
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

<?php
// Load
$thumb_url = get_template_directory_uri() . '/img/news/1.jpg';
if (has_post_thumbnail()) {
  $thumb_url = get_the_post_thumbnail_url();
}
?>
<!-- Header Banner -->
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom single__header"
  data-overlay-dark="4" data-background="<?php echo $thumb_url ?>">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-left caption">
        <h5><a href="<?php echo get_page_link(get_page_object('Blog')->ID) ?>">Blog</a></h5>
        <h2>
          <?php the_title(); ?>
        </h2>
        <div class="post">
          <div class="author"> <img src="<?php echo bloginfo('template_directory'); ?>/img/team/1.jpg" alt=""
              class="avatar"> <span>
              <?php echo the_author_posts_link() ?>
            </span> </div>
          <div class="date-comment"> <i class="ti-calendar"></i><span>
              <?php the_time('j M Y') ?>
            </span></div>
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
<section class="section-padding" data-scroll-index="1">
  <div class="container">
    <div class="row">
      <?php  get_all_post_categories(get_the_ID())?>
      <div class="col-lg-8 single__content blog__post">
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
        <?php the_category() ?>
        <?php the_content(); ?>
        <div class="tags">
          <?php the_tags("", "") ?>
        </div>

        <!-- Related Posts -->

        <div class="related-posts-container row">
          <h1>You might also like</h1>
          <?php
          $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post__not_in' => array($post_id),
            'category__in' => $categories,
          );

          $related_posts = new WP_Query($args);

          if ($related_posts->have_posts()):
            $posts_count = $related_posts->post_count;

            // Choose the correct column class
            $column_class = 'col-md-4';
            if ($posts_count == 1) {
              $column_class = 'col-md-12';
            } else if ($posts_count == 2) {
              $column_class = 'col-md-6';
            }

            while ($related_posts->have_posts()):
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
                  <div class="butn-dark"> <a href="<?php the_permalink() ?>"><span>Read More</span></a> </div>
                </div>
              </div>
              <?php
            endwhile;
          endif;

          wp_reset_postdata();
          ?>
        </div>

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
                  <p><?php echo nl2br(get_the_author_meta('description', $author_id)) ?></p> 
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