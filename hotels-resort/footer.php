<!-- Footer -->
<footer class="footer">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-30">
                    <div class="sub-title border-footer-light whte">Contact Us!</div>
                </div>
                <div class="col-md-4 offset-md-1">
                    <div class="item">
                        <h3>Get in touch</h3>
                        <p>Calle del Sol, 54 <br>
                            29602 Marbella <br>
                            Málaga, Spain
                        </p>
                        <a href="tel:+34 675 638 345" class="phone">+34 675 638 345</a>
                        <a href="mailto:info@patarahotel.com" class="mail">info@patarahotel.com</a>
                        <div class="social mt-2"> <a href="#"><i class="ti-twitter"></i></a> <a
                                href="#"><i class="ti-instagram"></i></a> <a href="#"><i
                                    class="ti-linkedin"></i></a> </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="item">
                        <h3>Pages</h3>
                        <ul class="footer-explore-list list-unstyled">
                            <li><a href="<?php echo get_page_link(get_page_object('Home')->ID) ?>">Home</a></li>
                            <li><a href="<?php echo home_url(); ?>#about">About</a></li>
                            <li><a href="<?php echo get_page_link(get_page_object('Blog')->ID) ?>">Blog</a></li>
                            <li><a href="<?php echo get_page_link(get_page_object('Facilities')->ID) ?>">Facilities</a></li>
                            <li><a href="<?php echo get_page_link(get_page_object('Archives')->ID) ?>">Archives</a></li>
                            <li><a href="<?php echo get_page_link(get_page_object('Contact')->ID) ?>">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>© 2023 PATARA - Resort & Spa Hotel. All right reserved.</p>
                </div>
                <div class="col-md-8">
                    <p class="right"><a href="<?php echo get_page_link(get_page_object('Privacy Policy')->ID) ?>">Privacy Policy</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); //   "percha" donde enganchar los hooks en el footer    ?>
</body>

</html>