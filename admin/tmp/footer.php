
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js" integrity="sha384-pjaaA8dDz/5BgdFUPX6M/9SUZv4d12SUPF0axWc+VRZkx5xU3daN+lYb49+Ax+Tl" crossorigin="anonymous"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="/admin/script.js"></script>

<script type="text/javascript">
if (<?= $_SESSION['modal'] ?> === 1) {
    $(window).on('load', function(){
        $('#mediaModal').modal('show');
    });
}
// if (<?php //echo $_SERVER['REQUEST_URI'] ?> === '/admin/item.php') {
//   $('a').on('click', function() {
//     if (window.confirm('入力内容が破棄されます。このまま、ページを切り替えてもいいでしょうか？')) {
//       window.alert('はい');
//     } else {
//       window.alert('いいえ');
//     }
//   });
// }

</script>
<?php
$_SESSION['modal'] = 0; // 0: close , 1: open
?>

</body>
</html>
