<?php
get_header();

// Get the author information
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
$author_id = $curauth->ID;
$nickname = get_the_author_meta('nickname', $curauth->ID);
$author_name = get_the_author_meta('first_name', $curauth->ID) . ' ' . get_the_author_meta('last_name', $curauth->ID);
$roles = get_author_roles($curauth->ID);
$description = $curauth->description;
$user_picture = get_user_meta($author_id, 'user_pic', true);
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

  <!-- Header Banner -->
  <div class="author-banner banner-header section-padding valign bg-img bg-fixed bg-position-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 justify-content-center d-flex flex-column caption">
          <h5 class="author-nickname"> <?php echo $nickname ?> </h5>
          <h1 class="author-name"> <?php echo $author_name ?> </h1>
          <h5> <?php echo $roles ?> </h5>
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
        <div class="col-md-6 text-center caption">
          <img class="author-picture"
               src="<?php echo $user_picture?>" alt="">
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
          <div class="section-title">Unveiling Marbella's Insidero</div>
          <p><?php echo nl2br($description) ?></p>
          <div class="ldBar auto" data-value="<?php echo get_user_meta('skill1v', $author_id) ?>"
               data-duration="3" data-transition-in="ease"></div>
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
          <div class="sub-title border-bot-light">Expertise at a Glance</div>
        </div>
        <div class="col-md-9">
          <div class="section-title">Skills That Set Our Founder Apart</div>
          <p>Delve into the expertise driving our blog's insights and excellence. Our founder embodies a
            unique blend of skills, honed through years of dedicated commitment to the hospitality realm.
            Here's a glimpse into the core proficiencies that define our author's prowess:</p>
          <div class="row text-center mb-5 mt-5">
            <div class="col-md-6">
              <h4><?php echo get_the_author_meta('skill1', $author_id) ?></h4>
              <div id="circle-bar-1"
                  data-progress="<?php echo get_the_author_meta('skill1v', $author_id) ?>"
                  class="circle-bar"></div>
            </div>
            <div class="col-md-6">
              <h4><?php echo get_the_author_meta('skill2', $author_id) ?></h4>
              <div id="circle-bar-2"
                  data-progress="<?php echo get_the_author_meta('skill2v', $author_id) ?>"
                  class="circle-bar"></div>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-md-6">
              <h4><?php echo get_the_author_meta('skill3', $author_id) ?></h4>
              <div id="circle-bar-3"
                  data-progress="<?php echo get_the_author_meta('skill3v', $author_id) ?>"
                  class="circle-bar"></div>
            </div>
            <div class="col-md-6">
              <h4><?php echo get_the_author_meta('skill4', $author_id) ?></h4>
              <div id="circle-bar-4"
                  data-progress="<?php echo get_the_author_meta('skill4v', $author_id) ?>"
                  class="circle-bar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END Skills -->

  <!-- Recent Post -->
  <section class="blog-home section-padding pt-0">
    <div class="container">
      <div class="row mb-30">
        <div class="col-md-3">
          <div class="sub-title border-bot-light">Latest Posts</div>
        </div>
        <div class="col-md-9">
          <div class="section-title">My Last Posts</div>
          <p>Here you'll find the latest insights and thoughts shared by [Author Name]. Explore the world
            through my eyes as I cover topics ranging from technology trends and innovation to lifestyle and
            personal experiences.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <?php
          $args = array(
            'posts_per_page' => 3,
            'author' => $author_id,
            'post_type' => ['post', 'rooms']
          );

          $query = new WP_Query($args);

          if ($query->have_posts()) :
            $post_num = 0;

            while ($query->have_posts()) :
              $post_category = 'left';
              $post_num++;
              $query->the_post();
              $thumb_url = get_template_directory_uri() . '/img/news/1.jpg';

              if (has_post_thumbnail()) {
                $thumb_url = get_the_post_thumbnail_url();
              }

              if ($post_num % 2 == 0) {
                $post_category = 'right';
              }
              ?>
              <div class="services2 <?php echo $post_category ?> mb-90 post-destacado">
                <figure>
                  <a href="<?php the_permalink() ?>">
                    <img src="<?php echo $thumb_url ?>" alt="<?php echo the_title() ?>"
                         class="img-fluid">
                  </a>
                </figure>
                <div class="caption padding-left">
                  <?php the_category() ?>
                  <div class="info">
                    <span>Published on <?php the_time('F j, Y') ?></span>
                    <br>
                  </div>
                  <h4><a href="<?php the_permalink() ?>"><?php echo the_title() ?></a></h4>
                  <p><?php the_excerpt() ?></p>
                  <p></p>
                  <div class="info-wrapper mt-20">
                    <div class="butn-dark">
                      <a href="<?php the_permalink() ?>">
                        <span><?php echo get_post_type() === 'rooms' ? 'Book Now' : 'Read More' ?></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            endwhile;
          else :
            echo "<h2 class='nopost-title'>No posts publiched yet</h2>";
          endif;

          wp_reset_query()
          ?>
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
                    <div class="author-img"><img
                        src="<?php echo bloginfo('template_directory'); ?>/img/team/2.jpg"
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
                  <h5>"As a frequent traveler, I've experienced various hotels, but this one exceeded my expectations. From the friendly staff to the luxurious rooms, every detail contributed to a unique and relaxing experience."</h5>
                  <div class="info">
                    <div class="author-img"><img
                        src="<?php echo bloginfo('template_directory'); ?>/img/team/1.jpg"
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
                  <h5>"Incredible. From the moment I walked in, I knew I was in a special place. The architecture, the cuisine, and the ambiance created an experience I will remember for a long time. Highly recommended!"</h5>
                  <div class="info">
                    <div class="author-img"><img
                        src="<?php echo bloginfo('template_directory'); ?>/img/team/3.jpg"
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
                  <h5>"I work in the hospitality industry, and I can confidently say that this hotel is exceptional. The attention to detail and commitment to excellence are evident in every aspect. A true pleasure to stay here."</h5>
                  <div class="info">
                    <div class="author-img"><img
                        src="<?php echo bloginfo('template_directory'); ?>/img/team/b.jpg"
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