<?php
/*******************************
 * Template Name: Archives
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
<!-- Progress scroll to top -->
<div class="progress-wrap cursor-pointer">
  <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
  </svg>
</div>
<!-- Navbar -->
<?php get_template_part('nav'); ?>
<!-- Header Banner -->
<div class="banner-header section-padding valign bg-img bg-fixed bg-position-bottom" data-overlay-dark="5"
  data-background="<?php echo bloginfo('template_directory'); ?>/img/headers/Archives.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center caption">
        <h5>Site Index</h5>
        <h1>Archives</h1>
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
    <div class="grid">
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Last Entries</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry">
            <?php
            $args = array(
              'type' => 'postbypost', // Retrieve posts title
              'limit' => 20, // Limit to 20 posts
              'format' => 'custom',
              'before' => '<li><p>',
              'after' => '</p></li>',
              'show_post_count' => false,
            );
            wp_get_archives($args);
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Rooms</h3>
        </div>
        <div class="card-body">
        <ul class="card-list-masonry">
            <?php
              $args = [
                'posts_per_page' => 20,
                'post_type' => ['rooms'],
              ];

              $popular = get_posts($args);

              if (empty($popular)) {
                echo "<p>No posts visited...</p>";
              } else {
                foreach ($popular as $post) {
                  echo '<li><p><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '<span class="count">'.'</span></a></p></li>';
                }
              }
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Tags List</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry">
            <?php
            // Listamos las etiquetas cada una con un elemento <li>
            // Esto es igual a 
            // wp_list_categories("title_li=&show_count=1&echo=0")
            $tags = wp_list_categories([
              'title_li' => '',
              'show_count' => true,
              'echo' => false,
              'taxonomy' => 'post_tag',
              'number' => 20,
              'orderby' => 'count',
              'order' => 'DESC',
            ]);

            // Añadimos un span con la clase 'count' para que se muestre el número de posts de cada categoría
            $tags = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">$1</span></a>', $tags);

            echo $tags;
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Categories</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry">
            <?php
            // Listamos las categorías cada una con un elemento <li>
            // Esto es igual a 
            // wp_list_categories("title_li=&show_count=1&echo=0")
            $categories = wp_list_categories([
              'title_li' => '',
              'show_count' => true,
              'echo' => false,
            ]);

            // Añadimos un span con la clase 'count' para que se muestre el número de posts de cada categoría
            $categories = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">$1</span></a>', $categories);

            echo $categories;
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Authors</h3>
        </div>
        <div class="card-body">
        <ul class="card-list-masonry">
        <?php 
        $authors = wp_list_authors([
          'optioncount' => true, // Visualiza el número de posts publicados por cada autor
          'hide_empty' => false, // Mostrar autores aunque no tengan posts
          'orderby' => 'post_count', // Ordenar por número de posts
          'order' => 'DESC', // Ordenar de mayor número de posts publicados a menos número de posts publicados
          'number' => 5, // Mostrar 5 autores
          'echo' => false,
        ]);

        // Añadimos un span con la clase 'count' para que se muestre el número de posts de cada autor
        $authors = preg_replace('/<\/a> \(([0-9]+)\)/', ' <span class="count">$1</span></a>', $authors);

        echo $authors;
        ?>
      </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Daily Posts</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry time-list">
          <?php
            $args = [
              'type' => 'daily', // Retrieve posts title
              'show_post_count' => true, // Show number of posts per author
              'limit' => 20, // Limit to 20 posts
              'echo' => false, // Return the output instead of displaying it directly
            ];

            $daily = wp_get_archives($args);
            
            // Remove the () from the number of posts
            $daily = preg_replace('/&nbsp;\((\d+)\)/', ' <span class="count">$1</span></a>', $daily);

            echo $daily;
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Monthly Posts</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry time-list">
          <?php
            $args = [
              'type' => 'monthly', // Retrieve posts title
              'show_post_count' => true, // Show number of posts per author
              'limit' => 20, // Limit to 20 posts
              'echo' => false, // Return the output instead of displaying it directly
            ];

            $monthly = wp_get_archives($args);
            
            // Remove the () from the number of posts
            $monthly = preg_replace('/&nbsp;\((\d+)\)/', ' <span class="count">$1</span></a>', $monthly);

            echo $monthly;
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Yearly Posts</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry time-list">
          <?php
            $args = [
              'type' => 'yearly', // Retrieve posts title
              'show_post_count' => true, // Show number of posts per author
              'limit' => 20, // Limit to 20 posts
              'echo' => false, // Return the output instead of displaying it directly
            ];

            $yearly = wp_get_archives($args);
            
            // Remove the () from the number of posts
            $yearly = preg_replace('/&nbsp;\((\d+)\)/', ' <span class="count">$1</span></a>', $yearly);
            $yearly = preg_replace('/<a(.*?)>(.*?)<\/a><span class="count">(.*?)<\/span>/', '<a$1>$2 <span class="count">$3</span></a>', $yearly);

            echo $yearly;
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Most Commented Posts</h3>
        </div>
        <div class="card-body">
        <ul class="card-list-masonry">
            <?php
              $args = [
                'posts_per_page' => 10,
                'orderby' => 'comment_count',
                'order' => 'DESC',
              ];

              $popular = get_posts($args);

              if (empty($popular)) {
                echo "<p>No posts commented...</p>";
              } else {
                foreach ($popular as $post) { 
                  echo '<li><p><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '<span class="count">'.$post->comment_count.'</span></a></p></li>';
                }
              }
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->
      <!-- Begin Card -->
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title">Most Popular Posts</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry">
            <?php
              $args = [
                'posts_per_page' => 20,
                'meta_key' => 'num_visits', 
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
              ];

              $popular = get_posts($args);

              if (empty($popular)) {
                echo "<p>No posts visited...</p>";
              } else {
                foreach ($popular as $post) {
                  echo '<li><p><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '<span class="count">'.$post->num_visits.'</span></a></p></li>';
                }
              }
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <!-- End Card -->

      <!-- Begin Card -->
      <?php
        // Author loop
        // We need ID and name of each author
        $args = ['display_name', 'ID'];
        $authors = get_users($args); // Retrieve an author object collection with display_name and ID properties

        foreach ($authors as $author) {
          $author_id = $author->ID;
          $author_name = $author->display_name;
          $author_posts = get_posts([
            'author' => $author_id,
            'posts_per_page' => 20,
          ]);

      ?>
      <div class="grid-item sizer masonry-card">
        <div class="card-header">
          <h3 class="card-title"><?php echo $author_name ?> Posts</h3>
        </div>
        <div class="card-body">
          <ul class="card-list-masonry">
            <?php

              if (empty($author_posts)) {
                echo "<p>No posts...</p>";
              } else {
              foreach ($author_posts as $post) {
                echo '<li><p><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></p></li>';
              }
            }
            ?>
          </ul>
        </div>
        <div class="card-footer"></div>
      </div>
      <?php 
        }
      ?>
      <!-- End Card -->
    </div>
  </div>
</section>
<?php get_footer(); ?>