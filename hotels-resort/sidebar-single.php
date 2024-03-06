<div class="blog-sidebar row">
  <div class="col-md-12">
    <div class="widget search">
      <form method="GET" action="<?php echo home_url('/') ?>">
        <input type="text" name="s" id="s" placeholder="Type here ...">
        <button type="submit"><i class="ti-search" aria-hidden="true"></i></button>
      </form>
    </div>
  </div>
  <!-- Tag Cloud - Widget -->
  <div class="col-md-12 widgets">
      <?php
      if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Tag Cloud - Sidebar')) : // Preguntamos si existe un area de widgets definida en el back end
      ?>
      <div class="widget">
        <p>Sorry, no widgets installed for this theme!</p> <!-- Texto para cuando no haya definida un área de widgets -->
      </div>
      <?php endif; ?>
  </div>

    <!-- Calendar - Widget -->
    <div class="col-md-12 widgets">
      <?php
      if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Calendar - Sidebar')) : // Preguntamos si existe un area de widgets definida en el back end
      ?>
      <div class="widget">
        <p>Sorry, no widgets installed for this theme!</p> <!-- Texto para cuando no haya definida un área de widgets -->
      </div>
      <?php endif; ?>
  </div>

  <!-- Categorías -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-title">
        <h6>Categories</h6>
      </div>
      <ul class="category__list">
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
  </div>

  <!-- Authors -->
  <div class="col-md-12 ">
    <div class="widget">
      <div class="widget-title">
        <h6>Authors</h6>
      </div>
      <ul class="authors__list">
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
  </div>
  <!-- Páginas -->
  <div class="col-md-12 ">
    <div class="widget">
      <div class="widget-title">
        <h6>Pages</h6>
      </div>
      <ul class="authors__list">
        <?php
        // Listamos las páginas pero descluir la de politica de privacidad
        $pages = get_pages();
        foreach ($pages as $page) :
          if (!in_array($page->post_title, array('Home', 'Blog','Facilities', 'Archives', 'Contact'))) :
            $excludes_pages[] = $page->ID;
          endif;
        endforeach;
        $args = [
          'title_li' => '',
          'exclude' => implode(',', $excludes_pages)
        ];
        wp_list_pages($args);
        ?>
      </ul>
    </div>
  </div>
</div>