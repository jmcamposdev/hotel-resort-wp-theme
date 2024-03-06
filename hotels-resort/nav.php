<?php

function is_active($title)
{
  $is_active = false;
  if ($title === get_the_title()) {
    $is_active = true;
  }
  return $is_active;
}
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <!-- Logo -->
    <div class="logo-wrapper">
      <a class="logo" href="<?php echo get_page_link(get_page_object('Home')->ID) ?>"> <img src="<?php echo bloginfo('template_directory'); ?>/img/logo-light.png" class="logo-img" alt="" data-path="<?php echo bloginfo('template_directory'); ?>/"> </a>
    </div>
    <!-- Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="ti-menu"></i></span> </button>
    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbar">
      <ul class="navbar-nav ms-auto">
      <li class="nav-item">
          <a class="nav-link <?php echo is_active('Home') ? 'active' : '';  ?>" href="<?php echo get_page_link(get_page_object('Home')->ID) ?>">
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo is_active('About') ? 'active' : '';  ?>" href="<?php echo home_url(); ?>#about">
            About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo is_home() ? 'active' : '';  ?>" href="<?php echo get_page_link(get_page_object('Blog')->ID) ?>">
            Blog
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo is_active('Facilities') ? 'active' : '';  ?>" href="<?php echo get_page_link(get_page_object('Facilities')->ID) ?>">
            Facilities
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo is_active('Archives') ? 'active' : '';  ?>" href="<?php echo get_page_link(get_page_object('Archives')->ID) ?>">
            Archives
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo is_active('Contact') ? 'active' : '';  ?>" href="<?php echo get_page_link(get_page_object('Contact')->ID) ?>">
            Contact
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo is_active('Private') ? 'active' : '';  ?>" href="<?php echo get_page_link(get_page_object('Private')->ID) ?>">
            Log in
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>