<?php
get_header();

// Get the author information
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
$author_id = $curauth->ID;
$nickname = get_the_author_meta('nickname', $curauth->ID);
$author_name = get_the_author_meta('first_name', $curauth->ID) . ' ' . get_the_author_meta('last_name', $curauth->ID);
$roles = get_author_roles($curauth->ID);
$description = $curauth->description;
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
          <?php echo $nickname ?>
        </h5>
        <h1 class="author-name">
          <?php echo $author_name ?>
        </h1>
        <h5>
          <?php echo $roles ?>
        </h5>
        <div class="author-socials">
          <a href="<?php echo get_the_author_meta('facebook', $author_id) ?>">
            <i class="fa-brands fa-facebook"></i>
          </a>
          <a href="<?php echo get_the_author_meta('twitter', $author_id) ?>">
            <i class="fa-brands fa-twitter"></i>
          </a>
          <a href="<?php echo get_the_author_meta('instagram', $author_id) ?>">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="<?php echo get_the_author_meta('linkedin', $author_id) ?>">
            <i class="fa-brands fa-linkedin"></i>
          </a>
        </div>
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
        <div class="sub-title border-bot-light">About Me</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Know me a little better</div>
        <div class="row">
          <div class="col-md-6">
            <p>
              <?php echo nl2br($description) ?>
            </p>
          </div>
          <div class="col-md-6 author-main-picture" style="background-image: url('<?php echo bloginfo('template_directory'); ?>/img/team/katsune-picture.jpg');">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END About Me -->

<!-- Skills -->
<section class="skills-section section-padding pt-0" data-scroll-index="1">
  <div class="container">
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">My Skills</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">My Unique Abilities</div>
        <p>Get to know my skills, because they are what bring my stories to life. By immersing yourself in my experiences, I invite you to discover Marbella through my personal lens, where each skill becomes a gift to enrich your own adventures.</p>
        <div class="row text-center mb-5 mt-5">
          <div class="col-md-6">
            <h4  class="mb-0 text-start">
              <?php echo get_the_author_meta('skill1', $author_id) ?>
            </h4>
            <div id="line-bar-1" data-progress="<?php echo get_the_author_meta('skill1v', $author_id) ?>"
              class="line-bar"></div>
          </div>
          <div class="col-md-6">
            <h4 class="mb-0 text-start">
              <?php echo get_the_author_meta('skill2', $author_id) ?>
            </h4>
            <div id="line-bar-2" data-progress="<?php echo get_the_author_meta('skill2v', $author_id) ?>"
              class="line-bar"></div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-md-6">
            <h4  class="mb-0 text-start">
              <?php echo get_the_author_meta('skill3', $author_id) ?>
            </h4>
            <div id="line-bar-3" data-progress="<?php echo get_the_author_meta('skill3v', $author_id) ?>"
              class="line-bar"></div>
          </div>
          <div class="col-md-6">
            <h4  class="mb-0 text-start">
              <?php echo get_the_author_meta('skill4', $author_id) ?>
            </h4>
            <div id="line-bar-4" data-progress="<?php echo get_the_author_meta('skill4v', $author_id) ?>"
              class="line-bar"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END Skills -->

<!-- Recent Post -->
<section class="blog-home section-padding">
  <div class="container">
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">Our Blog</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Latest News</div>
        <p>Hotel ut nisl quam nestibulum ac quam nec odio elementum sceisue the aucan ligula. Orci varius natoque senatibus et magnis narturient monte nascete ridiculus mus nellentesque habitant morbine.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
          <?php
          // Load the 3 latest posts

          // WP_Query arguments
          $args = array(
            'posts_per_page' => 3,
            'author' => $author_id,
          );
          // Create the WP_Query object
          $query = new WP_Query($args);

          // Check if we have posts
          if ($query->have_posts()) :
            ?>
            <div class="owl-carousel owl-theme">
            <?php
            // While we have posts, show them to us
            while ($query->have_posts()) :
              // Let's load the posts
              $query->the_post();
              // Load
              $thumn_url = get_template_directory_uri() . '/img/news/1.jpg';
              if (has_post_thumbnail()) {
                $thumn_url = get_the_post_thumbnail_url();
              }
          ?>
              <div class="item bg-img" data-background="<?php echo $thumn_url ?>">
                <div class="content">
                  <div class="info">
                    <div class="category-list">
                    <a> <span><i class="ti-list" aria-hidden="true"></i></span></a>
                    <?php the_category() ?>
                    </div>
                    <a> <span><i class="ti-time" aria-hidden="true"></i><?php echo get_the_time('F, j Y') ?></span></a>
                    
                  </div>
                  <a>
                    <h5><a href="<?php the_permalink()?>"><?php echo get_the_title() ?></a></h5>
                  </a>
                  <p><?php echo get_the_excerpt() ?></p>
                  <div class="arrow"> <a href="<?php the_permalink()?>"><span class="ti-arrow-right"></span></a> </div>
                </div>
              </div>

          <?php
            endwhile;
          else :
            echo "<h2 class='nopost-title'>No posts publiched yet</h2>";
          endif;

          // Resetear la consulta
          wp_reset_query()
          ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- END Recent Post -->

<!-- Testiominals -->
<section class="testimonials ">
  <div class="background bg-img bg-fixed section-padding pb-0"
    data-background="<?php echo bloginfo('template_directory'); ?>/img/rooms/18.jpg" data-overlay-dark="4">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h3 class="sub-title border-bot-dark">Testiominals</h3>
        </div>
        <div class="col-md-8">
          <div class="section-title whte">Unforgettable Experiences</div>
          <div class="testimonials-box">
            <div class="owl-carousel owl-theme">
              <div class="item">
                <span>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                </span>
                <h5>"My stay at this wonderful hotel was simply unforgettable. The customer service, impeccable
                  facilities, and prime location made my trip exceptional. I will definitely be back!"</h5>
                <div class="info">
                  <div class="author-img"><img src="<?php echo bloginfo('template_directory'); ?>/img/team/2.jpg"
                      alt=""></div>
                  <div class="cont">
                    <h6>Emily Johnson</h6> <span>Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <span>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                </span>
                <h5>"As a frequent traveler, I've experienced various hotels, but this one exceeded my expectations.
                  From the friendly staff to the luxurious rooms, every detail contributed to a unique and relaxing
                  experience."</h5>
                <div class="info">
                  <div class="author-img"><img src="<?php echo bloginfo('template_directory'); ?>/img/team/1.jpg"
                      alt=""></div>
                  <div class="cont">
                    <h6>Daniel Taylor</h6> <span>Entrepreneur</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <span>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                </span>
                <h5>"Incredible. From the moment I walked in, I knew I was in a special place. The architecture, the
                  cuisine, and the ambiance created an experience I will remember for a long time. Highly recommended!"
                </h5>
                <div class="info">
                  <div class="author-img"><img src="<?php echo bloginfo('template_directory'); ?>/img/team/3.jpg"
                      alt=""></div>
                  <div class="cont">
                    <h6>Michael Martinez</h6> <span>Travel Journalist</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <span>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                </span>
                <h5>"I work in the hospitality industry, and I can confidently say that this hotel is exceptional. The
                  attention to detail and commitment to excellence are evident in every aspect. A true pleasure to stay
                  here."</h5>
                <div class="info">
                  <div class="author-img"><img src="<?php echo bloginfo('template_directory'); ?>/img/team/b.jpg"
                      alt=""></div>
                  <div class="cont">
                    <h6>Sarah Anderson</h6> <span>Hotel Director</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<!-- END Testimonials -->


<?php get_footer(); ?>