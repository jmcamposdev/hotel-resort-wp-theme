jQuery(function ($) {
  // init Masonry
  var$grid = $('.grid').masonry({
    // options
    itemSelector: '.grid-item',
    columnWidth: '.sizer',
    gutter: 20 // Ajusta el valor según tus necesidades
  });
});