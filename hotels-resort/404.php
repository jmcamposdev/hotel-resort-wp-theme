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
    <!-- Comming soon -->
    <section class="comming section-padding">
        <div class="v-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>404</h1>
                        <h2>We Can't Find That Page!</h2>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6 offset-md-3 text-center">
                        <p>The page you are looking for was moved, removed, renamed or never existed.</p>
                        <form method="GET" action="<?php echo home_url('/') ?>">
                            <input type="text" name="s" placeholder="Search">
                            <button>Search</button>
                        </form> 
                        <a href="<?php echo get_page_link(get_page_object('Home')->ID) ?>" class="butn-dark2"><span>Go to Home</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php get_footer(); ?>