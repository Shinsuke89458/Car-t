<?php
require_once(__DIR__ . '/../config/config.php');

$uploader = new MyApp\Controller\ImageUploader();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uploader->upload();
}
list($success, $error) = $uploader->getResults();
$images = $uploader->getImages();

// $imageDir = @opendir(IMAGES_DIR);
// var_dump($imageDir);
?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

  <div class="area">
    <p>ここにファイルをドラッグ＆ドロップ</p>
    <form action="" method="post" enctype="multipart/form-data" id="my_form_area">
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo h(MAX_FILE_SIZE); ?>">
      <input type="file" name="image[]" accept=".jpg, .jpeg, .png" id="my_file_area" multiple>
      <?php /*<input type="submit" value="upload">*/ ?>
    </form>
  </div>
  <div class="btn">
    Upload!
    <form action="" method="post" enctype="multipart/form-data" id="my_form_btn">
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo h(MAX_FILE_SIZE); ?>">
      <input type="file" name="image[]" accept=".jpg, .jpeg, .png" id="my_file_btn" multiple>
      <?php /*<input type="submit" value="upload">*/ ?>
    </form>
  </div>

  <div class="msg-container">
    <?php if (isset($success)): ?>
      <div class="msg success"><?php echo $success; ?></div>
    <?php endif; ?>
    <?php if (isset($error)): ?>
      <div class="msg error"><?php echo $error; ?></div>
    <?php endif; ?>
  </div>

  <ul class="grid clearfix">
    <?php foreach ($images as $image): ?>
    <li class="gird-item">
      <a href="<?php echo h(basename(IMAGES_DIR).'/'.basename($image)); ?>">
        <img src="<?php echo h($image); ?>" alt="">
      </a>
    </li>
    <?php endforeach; ?>
  </ul>

<?php require(__DIR__ . '/tmp/footer.php'); ?>
