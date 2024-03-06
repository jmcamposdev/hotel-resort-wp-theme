<?php
  // Mostrar Formulario de Comentarios
  $args = [
    'class_submit' => 'butn-test',
  ];
  comment_form($args);
  ?>

  <ul class="comments-list">
    <?php
      // Mostrar lista de Comentarios
      // El boton replay no funciona
      wp_list_comments([
        'style' => 'ul',
        'short_ping' => true,
        'avatar_size' => 50,
      ]);
    ?>
  </ul>
  


<!-- <ul class="comments-list"></ul>

<h3 class="mb-30">Leave a Reply</h3>
<form method="post" class="row">
  <div class="col-md-6">
    <input type="text" name="name" id="name" placeholder="Full Name *" required="">
  </div>
  <div class="col-md-6">
    <input type="email" name="email" id="email" placeholder="Email Address *" required="">
  </div>
  <div class="col-md-12">
    <textarea name="message" id="message" cols="40" rows="4" placeholder="Your Comment *" required=""></textarea>
  </div>
  <div class="col-md-12 mt-20">
    <button type="submit" class="butn-dark2"><span>Send</span></button>
  </div>
</form> -->