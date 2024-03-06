<?php

/*******************************
 * Template Name: Contact
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
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5" data-background="<?php echo bloginfo('template_directory'); ?>/img/headers/Contact.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 caption text-center">
        <h4>Get in touch</h4>
        <h1>Contact Us</h1>
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
    <div class="row mb-30">
      <div class="col-md-3">
        <div class="sub-title border-bot-light">Location</div>
      </div>
      <div class="col-md-9">
        <div class="section-title">Contact Us</div>
        <p class="mb-30">At Patara, we value every interaction. If you have questions, special requests or simply want to share your feedback, we're here for you. Fill out the form below or use the contact details below.</p>
        <div class="row">
          <div class="col-md-4">
            <div class="row">
              <div class="col-md-12">
                <div class="reservations mb-15">
                  <div class="icon"><span class="flaticon-call"></span></div>
                  <div class="text">
                    <p>Reservation</p> <a href="tel:+34 675 638 345">+34 675 638 345</a>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="reservations mb-15">
                  <div class="icon"><span class="flaticon-envelope"></span></div>
                  <div class="text">
                    <p>Email Info</p> <a href="mailto:info@patarahotel.com">info@patarahotel.com</a>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="reservations mb-15">
                  <div class="icon"><span class="flaticon-location-pin"></span></div>
                  <div class="text">
                    <p>Address</p> Calle del Sol, 54 
                            29602 Marbella
                            Málaga, Spain
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-7 offset-md-1">
            <div class="row">
              <div class="col-md-12">
                <h3>Get in touch</h3>
                <form class="contact__form" >
                  <!-- form message -->
                  <div class="row">
                    <div class="col-12">
                      <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                    </div>
                  </div>
                  <!-- form elements -->
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="text" placeholder="Your Name *" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="email" placeholder="Your Email *" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="phone" type="text" placeholder="Your Number *" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="subject" type="text" placeholder="Subject *" required>
                    </div>
                    <div class="col-md-12 form-group">
                      <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                    </div>
                    <div class="col-md-12 mt-10">
                      <a  class="butn-dark2"><span>Send Message</span></a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Map -->
<section class="map">
  <div class="full-width">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3206.9416125689677!2d-4.901177983406438!3d36.507271498927985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd7329045621883d%3A0x4faf874d6c5a3d08!2sMarbella%204%20Days%20Walking!5e0!3m2!1ses!2ses!4v1705261924934!5m2!1ses!2ses" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
  </div>
</section>
<?php get_footer(); ?>