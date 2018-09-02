/***********
  imgupload
***********/
$(function() {
  $('.msg').fadeOut(10000);
  $('#imgupload_file_area').on('change', function() {
    $('#imgupload_form_area').submit();
  });
  $('#imgupload_file_btn').on('change', function() {
    $('#imgupload_form_btn').submit();
  });
  $('.btn-imgselect').on('click', function() {
    $(this).parents('li').addClass('selected-img');
    $(this).parents('li').siblings().removeClass('selected-img');
  });
  $('.btn-imgsetted').on('click', function() {
    var imgsrc = $('li.selected-img img').attr('src');
    var imgname = basename(imgsrc);
    $('.cms-thumb img').attr('src', imgsrc);
    $('input[name=product_imgpath]').attr('value', imgname);
    $('#imgupload_form_wrap li').removeClass('selected-img');
  });
  $('.btn-closed').on('click', function() {
    $('#imgupload_form_wrap li').removeClass('selected-img');
  });
});

function basename(path) {
    return path.replace(/\\/g,'/').replace( /.*\//, '' );
}

function dirname(path) {
    return path.replace(/\\/g,'/').replace(/\/[^\/]*$/, '');
}

/*************
  Isotope js
*************/
// $('.grid').isotope({
//   // options
//   itemSelector: '.grid-item',
//   layoutMode: 'fitRows'
// });
//
// var elem = document.querySelector('.grid');
// var iso = new Isotope( elem, {
//   // options
//   itemSelector: '.grid-item',
//   layoutMode: 'fitRows'
// });
//
// // element argument can be a selector string
// //   for an individual element
// var iso = new Isotope( '.grid', {
//   // options
// });

/***********
  modal
***********/
// $('#myModal').on('shown.bs.modal', function () {
//   $('#myInput').trigger('focus')
// })
// if (<?= $_SERVER['MODAL_STATUS'] ?> === 1) {
//     $(window).on('load',function(){
//         $('#exampleModal').modal('show');
//     });
// }
