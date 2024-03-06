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
<!-- Slider -->
<header class="header slider-fade">
  <div class="owl-carousel owl-theme">
    <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
    <div class="text-center item bg-img" data-overlay-dark="6" data-background="<?php echo bloginfo('template_directory'); ?>/img/slider/1.jpg">
      <div class="v-middle caption">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-6"> <span>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
              </span>
              <h4>Resort & Spa Hotel</h4>
              <h1>Stay With Us, Feel At Home</h1>
              <div class="butn-light mt-30 mb-30"> <a href="<?php echo get_page_link(get_page_object('Facilities')->ID) ?>"><span>Explore More</span></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center item bg-img" data-overlay-dark="6" data-background="<?php echo bloginfo('template_directory'); ?>/img/slider/6.jpg">
      <div class="v-middle caption">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-7"> <span>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
              </span>
              <h4>Welcome to</h4>
              <h1>Patara Luxury Resort Spa Hotel</h1>
              <div class="butn-light mt-30 mb-30"> <a href="<?php echo get_page_link(get_page_object('Facilities')->ID) ?>"><span>Explore More</span></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center item bg-img" data-overlay-dark="4" data-background="<?php echo bloginfo('template_directory'); ?>/img/slider/5.jpg">
      <div class="v-middle caption">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-7"> <span>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
                <i class="star-rating"></i>
              </span>
              <h4>Resort & Spa Hotel</h4>
              <h1>The Perfect Base For You</h1>
              <div class="butn-light mt-30 mb-30"> <a href="<?php echo get_page_link(get_page_object('Facilities')->ID) ?>"><span>Explore More</span></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Booking Search -->
<div class="booking-wrapper">
  <div class="container">
    <div class="booking-inner clearfix">
      <form class="form1 clearfix">
        <div class="col1 c1">
          <div class="input1_wrapper border-l border-b border-t border-r">
            <label>Check in</label>
            <div class="input1_inner">
              <input type="text" class="form-control input datepicker" placeholder="Check in">
            </div>
          </div>
        </div>
        <div class="col1 c2">
          <div class="input1_wrapper border-l border-b border-t border-r">
            <label>Check out</label>
            <div class="input1_inner">
              <input type="text" class="form-control input datepicker" placeholder="Check out">
            </div>
          </div>
        </div>
        <div class="col2 c3">
          <div class="select1_wrapper border-l border-b border-t border-r">
            <label>Adults</label>
            <div class="select1_inner">
              <select class="select2 select" style="width: 100%">
                <option value="1">1 Adult</option>
                <option value="2">2 Adults</option>
                <option value="3">3 Adults</option>
                <option value="4">4 Adults</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col2 c4">
          <div class="select1_wrapper border-l border-b border-t  border-r">
            <label>Children</label>
            <div class="select1_inner">
              <select class="select2 select" style="width: 100%">
                <option value="1">Children</option>
                <option value="1">1 Child</option>
                <option value="2">2 Children</option>
                <option value="3">3 Children</option>
                <option value="4">4 Children</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col2 c5">
          <div class="select1_wrapper border-l border-b border-t  border-r">
            <label>Rooms</label>
            <div class="select1_inner">
              <select class="select2 select" style="width: 100%">
                <option value="1">1 Room</option>
                <option value="2">2 Rooms</option>
                <option value="3">3 Rooms</option>
                <option value="4">4 Rooms</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col3 c6">
          <button type="submit" class="btn-form1-submit">Check Now</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- About -->
<section class="about section-padding bg-white" id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">Welcome to</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Patara Luxury Hotel</div>
        <div class="row">
          <div class="col-md-6">
            <p>Be captivated by an exceptional experience at our exclusive retreat on the Costa del Sol.</p>
            <p>At Patara, we fuse timeless elegance with contemporary charm to create a sanctuary of indulgence and sophistication.</p>
            <p>From the moment you walk through our doors, you will be immersed in a world where every detail reflects our commitment to excellence.</p>
            <!-- Rating -->
            <div class="ratting-point mt-30 mb-30">
              <div class="features-ratting">
                <h3>4.9</h3>
              </div>
              <div class="features-caption">
                <h3>Rating based on 2500+ reviews</h3>
                <div class="rating"> <span>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                    <i class="star-rating"></i>
                  </span> </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row g-3">
              <div class="col-6 text-end"> <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="<?php echo bloginfo('template_directory'); ?>/img/about-1.jpg" style="margin-top: 25%;"> </div>
              <div class="col-6 text-start"> <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="<?php echo bloginfo('template_directory'); ?>/img/about-2.jpg"> </div>
              <div class="col-6 text-end"> <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="<?php echo bloginfo('template_directory'); ?>/img/about-3.jpg"> </div>
              <div class="col-6 text-start"> <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="<?php echo bloginfo('template_directory'); ?>/img/about-4.jpg"> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Rooms -->
<section class="rooms1 section-padding" id="rooms">
  <div class="container">
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">Discover</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Rooms <span>&amp;</span> Suites</div>
        <p>Discover a corner of luxury and comfort in each of our rooms and suites in Patara. Each space has been meticulously designed to provide an unparalleled lodging experience. From the panoramic views to the most delicate details, your stay will be a celebration of sophistication and well-being.</p>
      </div>
    </div>
    <div class="rooms1-carousel owl-theme owl-carousel">
      <?php
      $args = [
        'post_per_page' => '8',
        'post_type' => ['rooms'],
      ];

      $query = new WP_Query($args);

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();

          $thumb_url = get_template_directory_uri() . '/img/rooms/15.jpg;';
          if (has_post_thumbnail()) {
            $thumb_url = get_the_post_thumbnail_url();
          }
          $square_meters = get_post_meta($post->ID, 'jmc_square_meters', true);
          $adults = get_post_meta($post->ID, 'jmc_adults', true);
          $children = get_post_meta($post->ID, 'jmc_children', true);
          $prize = get_post_meta($post->ID, 'jmc_price', true);
      ?>
          <div class="rooms1-single">
            <div class="rooms1-img"> <img src="<?php echo $thumb_url ?>" alt=""> </div>
            <div class="rooms1-content">
              <div class="row">
                <div class="col-md-6">
                  <div class="rooms1-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
                  <div class="rooms1-tagline"><?php echo $square_meters ?> m<sup>2</sup> / <?php echo $adults ?> adults <?php echo $children ?> children</div>
                </div>
                <div class="col-md-6">
                  <div class="book">
                    <div><a href="<?php the_permalink() ?>" class="butn-dark2"><span>Book</span></a></div>
                    <div><span>from</span><span class="price">$<?php echo $prize ?></span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      }

      wp_reset_query();
      ?>
    </div>
  </div>
</section>
<!-- Promo Video -->
<section class="video-wrapper video section-padding bg-img bg-fixed" data-overlay-dark="5" data-background="<?php echo bloginfo('template_directory'); ?>/img/slider/1.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-8 offset-md-2 text-center"> <span><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i></span>
        <div class="section-subtitle"><span>Patara Resort & Spa Hotel</span></div>
        <div class="section-title"><span>Hotel Promotional Video</span></div>
      </div>
    </div>
    <div class="row">
      <div class="text-center col-md-12">
        <a class="vid" href="https://youtu.be/QTwg1l8FqXw">
          <div class="vid-butn"> <span class="icon">
              <i class="ti-control-play"></i>
            </span> </div>
        </a>
      </div>
    </div>
  </div>
</section>
<!-- Amenities -->
<section class="amenities section-padding">
  <div class="container">
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">Our Services</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Hotel Amenities</div>
        <p>At Patara, excellence is in the details. Our amenities have been carefully selected to offer you a unique luxury experience. From the indulgent spa options to the gastronomic delights of our restaurants.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme">
          <div class="item"> <span class="number">01</span>
            <div class="icon"><i class="flaticon-world"></i></div>
            <h5><a>Pick Up &amp; Drop</a></h5>
            <p>Arrive and depart with total comfort. Our Pick Up & Drop service assures you a smooth transfer.</p>
          </div>
          <div class="item"> <span class="number">02</span>
            <div class="icon"><i class="flaticon-car"></i></div>
            <h5><a>Parking Space</a></h5>
            <p>Your vehicle safe and accessible. Ample parking space available for your peace of mind.</p>
          </div>
          <div class="item"> <span class="number">03</span>
            <div class="icon"><i class="flaticon-bed"></i></div>
            <h5><a>Room Service</a></h5>
            <p>Indulgence in every service. Delight your palate with our room service, where exquisiteness meets your door.</p>
          </div>
          <div class="item"> <span class="number">04</span>
            <div class="icon"><i class="flaticon-swimming"></i></div>
            <h5><a>Swimming Pool</a></h5>
            <p>Relax in our carefully designed pools. Immerse yourself and rejuvenate under the Marbella sun.</p>
          </div>
          <div class="item"> <span class="number">05</span>
            <div class="icon"><i class="flaticon-wifi"></i></div>
            <h5><a>Fibre Internet</a></h5>
            <p>Get connected without delay. Enjoy the speed and reliability of our fiber-optic Internet connection.</p>
          </div>
          <div class="item"> <span class="number">06</span>
            <div class="icon"><i class="flaticon-breakfast"></i></div>
            <h5><a>Breakfast</a></h5>
            <p>Start your day off right. Indulge in our gourmet breakfast before exploring Marbella.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Testiominals -->
<section class="testimonials">
  <div class="background bg-img bg-fixed section-padding pb-0" data-background="<?php echo bloginfo('template_directory'); ?>/img/rooms/18.jpg" data-overlay-dark="4">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h3 class="sub-title border-bot-dark">Testiominals</h3>
        </div>
        <div class="col-md-8">
          <div class="section-title whte">What Client's Say?</div>
          <div class="testimonials-box">
            <div class="owl-carousel owl-theme">
              <div class="item"> <span>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                </span>
                <h5>"My stay in Patara was simply exceptional. From the moment I walked in, I was impressed by the attention to detail and the warmth of the staff. The room was an oasis of comfort, with spectacular views that truly captured the essence of Marbella. Room service was impeccable, and every meal was a unique culinary experience. The facilities, from the pool to the parking lot, were impeccably maintained."</h5>
                <div class="info">
                  <div class="author-img"> <img src="<?php echo bloginfo('template_directory'); ?>/img/team/1.jpg" alt=""> </div>
                  <div class="cont">
                    <h6>Demeail S.</h6> <span>Customer Review</span>
                  </div>
                </div>
              </div>
              <div class="item"> <span>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                  <i class="star-rating"></i>
                </span>
                <h5>"As a frequent traveler, I can say that Patara raises the standard for luxury hotels. The personalized attention from my arrival was impressive, making me feel at home from the very first moment. The room was a masterpiece of elegance and comfort, with thoughtful details in every corner. The shuttle service to and from the hotel was very convenient, and the staff was always willing to help with local recommendations."</h5>
                <div class="info">
                  <div class="author-img"> <img src="<?php echo bloginfo('template_directory'); ?>/img/team/3.jpg" alt=""> </div>
                  <div class="cont">
                    <h6>Ray Smith</h6> <span>Customer Review</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Services -->
<section class="services section-padding">
  <div class="container">
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">Discover</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Our Services</div>
        <p>Explore a unique experience with our services: delight your palate at the Restaurant & Bar, immerse yourself in the serenity of the Spa & Wellness, and make your events unforgettable with our Events & Meetings service.</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="item">
          <div class="item-wrap">
            <div class="img"> <img src="<?php echo bloginfo('template_directory'); ?>/img/news/1.jpg" alt=""> </div>
            <div class="con">
              <div class="title-box">
                <h3><a>Restaurant & Bar</a></h3>
              </div>
              <div class="arrow"> <a><span class="ti-arrow-right"></span></a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="item">
          <div class="item-wrap">
            <div class="img"> <img src="<?php echo bloginfo('template_directory'); ?>/img/news/2.jpg" alt=""> </div>
            <div class="con">
              <div class="title-box">
                <h3><a>Spa & Wellness</a></h3>
              </div>
              <div class="arrow"> <a><span class="ti-arrow-right"></span></a> </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="item">
          <div class="item-wrap">
            <div class="img"> <img src="<?php echo bloginfo('template_directory'); ?>/img/news/5.jpg" alt=""> </div>
            <div class="con">
              <div class="title-box">
                <h3><a>Events & Meetings</a></h3>
              </div>
              <div class="arrow"> <a><span class="ti-arrow-right"></span></a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Booking Search -->
<section class="section-padding bg-img bg-fixed" data-overlay-dark="3" data-background="<?php echo bloginfo('template_directory'); ?>/img/rooms/18.jpg">
  <div class="container">
    <div class="booking-inner clearfix">
      <form class="form1 clearfix">
        <div class="col1 c1">
          <div class="input1_wrapper border-l border-b border-t border-r">
            <label>Check in</label>
            <div class="input1_inner">
              <input type="text" class="form-control input datepicker" placeholder="Check in">
            </div>
          </div>
        </div>
        <div class="col1 c2">
          <div class="input1_wrapper border-l border-b border-t border-r">
            <label>Check out</label>
            <div class="input1_inner">
              <input type="text" class="form-control input datepicker" placeholder="Check out">
            </div>
          </div>
        </div>
        <div class="col2 c3">
          <div class="select1_wrapper border-l border-b border-t border-r">
            <label>Adults</label>
            <div class="select1_inner">
              <select class="select2 select" style="width: 100%">
                <option value="1">1 Adult</option>
                <option value="2">2 Adults</option>
                <option value="3">3 Adults</option>
                <option value="4">4 Adults</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col2 c4">
          <div class="select1_wrapper border-l border-b border-t border-r">
            <label>Children</label>
            <div class="select1_inner">
              <select class="select2 select" style="width: 100%">
                <option value="1">Children</option>
                <option value="1">1 Child</option>
                <option value="2">2 Children</option>
                <option value="3">3 Children</option>
                <option value="4">4 Children</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col2 c5">
          <div class="select1_wrapper border-l border-b border-t border-r">
            <label>Rooms</label>
            <div class="select1_inner">
              <select class="select2 select" style="width: 100%">
                <option value="1">1 Room</option>
                <option value="2">2 Rooms</option>
                <option value="3">3 Rooms</option>
                <option value="4">4 Rooms</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col3 c6">
          <button type="submit" class="btn-form1-submit">Check Now</button>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- Blog Home -->
<section class="blog-home section-padding">
  <div class="container">
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">Our Blog</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Latest News</div>
        <p>Discover the best kept secrets of Marbella and its surroundings through Patara News. From the most idyllic beaches to fascinating routes and exclusive recommendations, our portal immerses you in the vibrant essence of the Costa del Sol. </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme">

          <?php
          // Load the 3 latest posts

          // WP_Query arguments
          $args = array(
            'posts_per_page' => 5,
          );
          // Create the WP_Query object
          $query = new WP_Query($args);

          // Check if we have posts
          if ($query->have_posts()) :
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
                    <h5><a href="<?php the_permalink() ?>"><?php echo get_the_title() ?></a></h5>
                  </a>
                  <p><?php echo get_the_excerpt() ?></p>
                  <div class="arrow"> <a href="<?php the_permalink() ?>"><span class="ti-arrow-right"></span></a> </div>
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
<?php get_footer(); ?>