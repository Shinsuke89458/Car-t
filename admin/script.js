$(function() {
  $('.msg').fadeOut(10000);
  $('#imgupload_file_area').on('change', function() {
    $('#imgupload_form_area').submit();
  });
  $('#imgupload_file_btn').on('change', function() {
    $('#imgupload_form_btn').submit();
  });
});

/* Isotope js */
$('.grid').isotope({
  // options
  itemSelector: '.grid-item',
  layoutMode: 'fitRows'
});

var elem = document.querySelector('.grid');
var iso = new Isotope( elem, {
  // options
  itemSelector: '.grid-item',
  layoutMode: 'fitRows'
});

// element argument can be a selector string
//   for an individual element
var iso = new Isotope( '.grid', {
  // options
});