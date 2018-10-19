$(function() {
  'use strict';

  /* msg */
  $('.msg').fadeOut(3000);

  /* item form change caution */
  var isChanged = false;
  if (location.pathname.match(/\/admin\/item.php/) !== null) {
    $(window).bind('beforeunload', function() {
      if (isChanged) {
        return 'このページを離れようとしています。';
      }
    });
    $('form').change(function() {
      isChanged = true;
    });
    $('input[type="submit"]').click(function() {
      isChanged = false;
    });
  }

  /* media */
  $('#imgupload_file_area').on('change', function() {
    $('#imgupload_form_area').submit();
  });
  $('#imgupload_file_btn').on('change', function() {
    $('#imgupload_form_btn').submit();
  });
  mediaEvent();

  /* media ajax */
  $('#pager_media li').on('click', function() {
    var page = $(this).data('page');

    if ($('#pager_media li').hasClass('pager-item-current')) {
      $('#pager_media li').removeClass('pager-item-current');
    }
    $('#pager_media li.pager-item' + page).addClass('pager-item-current');


    $.get('_ajax.php', {
      page: page,
      // token:
    }, function(res) {
      if (res !== 0) {
        var imagesNum = res['imagesNum'];
        var imagesList = res['imagesList'];
        $('#media li').remove();
        if (location.href.match(/\/admin\/media.php/) !== null) {
          imagesList.forEach(function($value) {
            $('#media').append('<li class="grid-item"><a href="http://192.168.33.12:8000/src/images/' + basename($value) + '" target="_blank"><img src="http://192.168.33.12:8000/src/' + $value + '" alt=""></a></li>');
          });
        } else {
          imagesList.forEach(function($value) {
            $('#media').append('<li class="grid-item"><img src="http://192.168.33.12:8000/src/' + $value + '" alt=""><div class="buttonarea list-inline"><div class="list-inline-item btn btn-dark"><a href="http://192.168.33.12:8000/src/images/' + basename($value) + '" target="_blank">画像を見る</a></div><div class="list-inline-item btn btn-dark btn-imgselect">画像を選択</div></div></li>');
            mediaEvent();
          });
        }

      }
    });
  });

});


function mediaEvent() {
  $('.btn-imgselect').on('click', function() {
    $(this).parents('li').addClass('selected-img');
    $(this).parents('li').siblings().removeClass('selected-img');
  });
  $('.btn-imgsetted').on('click', function() {
    var imgsrc = $('li.selected-img img').attr('src');
    var imgname = basename(imgsrc);
    $('.cms-thumb img').attr('src', imgsrc);
    $('input[name=product_imgpath]').attr('value', imgname).change(); // item form change caution ignition
    $('#imgupload_form_wrap li').removeClass('selected-img');
  });
  $('.btn-closed').on('click', function() {
    $('#imgupload_form_wrap li').removeClass('selected-img');
  });
}

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
