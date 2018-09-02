<?php
require_once(__DIR__ . '/../config/config.php');

$token = new MyApp\Controller\Token();
$uploader = new MyApp\Controller\ImageUploader();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token->post();
  $uploader->upload();
  $token->resetToken();
}
list($success, $error) = $uploader->getResults();
$images = $uploader->getImages();

?>

<?php require_once(__DIR__ . '/tmp/header.php'); ?>

  <div id="imgupload_form_wrap" class="container">

    <div id="imgupload_form" class="imgupload_form">
        <div class="imgupload_form_area_wrap">
          <form action="" method="post" enctype="multipart/form-data" id="imgupload_form_area" class="imgupload_form_area">
          <?php /*<p>ここにファイルをドラッグ＆ドロップ</p>*/ ?>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE); ?>">
          <input type="file" name="image[]" accept=".jpg, .jpeg, .png" id="imgupload_file_area" class="imgupload_file_area" multiple>
          <?php // <input type="submit" value="upload"> ?>
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          </form>
        </div>
        <div class="imgupload_form_btn_wrap centerbox">
          <form action="" method="post" enctype="multipart/form-data" id="imgupload_form_btn" class="imgupload_form_btn">
          <p>ここにファイルをドラッグ＆ドロップ</p>
          <p>または</p>
          <label for="imgupload_file_btn">
            ファイルを選択
            <input type="file" name="image[]" accept=".jpg, .jpeg, .png" id="imgupload_file_btn" class="imgupload_file_btn" multiple>
          </label>
          <?php // <input type="submit" value="upload"> ?>
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          </form>
        </div>
    </div>

    <div class="msg-container">
      <?php if (isset($success)): ?>
        <div class="msg success"><?= $success; ?></div>
      <?php endif; ?>
      <?php if (isset($error)): ?>
        <div class="msg error"><?= $error; ?></div>
      <?php endif; ?>
    </div>

    <ul class="grid clearfix">
      <?php foreach ($images as $image): ?>
        <li class="grid-item">
          <?php
          if ($_SERVER['REQUEST_URI'] === '/admin/media.php') {
            echo'
            <a href="' . h(SITE_URL.'/src/images/'.basename($image)) . '" target="_blank">
              <img src="' . h(SITE_URL.'/src/'.$image) . '" alt="">
            </a>
            ';
          } else {
            echo'
            <img src="' . h(SITE_URL.'/src/'.$image) . '" alt="">
            <div class="buttonarea list-inline">
              <div class="list-inline-item btn btn-dark"><a href="' . h(SITE_URL.'/src/images/'.basename($image)) . '" target="_blank">画像を見る</a></div>
              <div class="list-inline-item btn btn-dark btn-imgselect">画像を選択</div>
            </div>
            ';
          }
          ?>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>

<?php require_once(__DIR__ . '/tmp/footer.php'); ?>
