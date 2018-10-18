<?php
require_once(__DIR__ . '/../config/config.php');

$_SESSION['inmedia'] = $_SERVER['REQUEST_URI'];

$token = new MyApp\Controller\Token();
$uploader = new MyApp\Controller\ImageUploader();

$images = $uploader->getImages();
$imagesNum = $images['imagesNum'];
$imagesList = $images['imagesList'];

if (count($images) !== 0) {

  $viewMedia = '';
  foreach($imagesList as $image) {
    $viewMedia .= '
    <li class="grid-item">
    ';
    if (preg_match('/^\/admin\/media.php/', $_SESSION['inmedia'])) {
      $viewMedia .= '
      <a href="' . h(SITE_URL.'/src/images/'.basename($image)) . '" target="_blank">
        <img src="' . h(SITE_URL.'/src/'.$image) . '" alt="">
      </a>
      ';
    } else {
      $viewMedia .= '
      <img src="' . h(SITE_URL.'/src/'.$image) . '" alt="">
      <div class="buttonarea list-inline">
        <div class="list-inline-item btn btn-dark"><a href="' . h(SITE_URL.'/src/images/'.basename($image)) . '" target="_blank">画像を見る</a></div>
        <div class="list-inline-item btn btn-dark btn-imgselect">画像を選択</div>
      </div>
      ';
    }
    $viewMedia .= '
    </li>
    ';
  }

} else {
  $viewMedia = 'アップロードされているメディアはありません';
}

if (
  $imagesNum !== 0 &&
  $imagesNum > MEDIA_PER_PAGE
) {

  /*
  create $pageList
  ceil(2 / 5) ... 1
  ceil(5 / 5) ... 1
  ceil(7 / 5) ... 2
  */
  $allPageNum = ceil($imagesNum / MEDIA_PER_PAGE);
  $pageList = '<li class="pager-item list-inline-item" data-page="1">最初へ</li>';
  for ($pageNum = 1; $pageNum <= $allPageNum; $pageNum++) {
    $class = 'pager-item pager-item' . $pageNum . ' list-inline-item';
    if ($pageNum == 1) $class .= ' pager-item-current';
    $pageList .= '<li class="' . $class . '" data-page="' . $pageNum . '">' . $pageNum . '</li>';
  }
  $pageList .= '<li class="pager-item list-inline-item" data-page="' . $allPageNum . '">最後へ</li>';

} else {

  $pageList = '';

}

?>

<?php require_once(__DIR__ . '/tmp/header.php'); ?>

  <div id="imgupload_form_wrap" class="container">

    <div id="imgupload_form" class="imgupload_form">
        <div class="imgupload_form_area_wrap">
          <form action="mediaupload.php" method="post" enctype="multipart/form-data" id="imgupload_form_area" class="imgupload_form_area">
          <?php /*<p>ここにファイルをドラッグ＆ドロップ</p>*/ ?>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?= h(MAX_FILE_SIZE); ?>">
          <input type="file" name="image[]" accept=".jpg, .jpeg, .png" id="imgupload_file_area" class="imgupload_file_area" multiple>
          <?php // <input type="submit" value="upload"> ?>
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
          </form>
        </div>
        <div class="imgupload_form_btn_wrap centerbox">
          <form action="mediaupload.php" method="post" enctype="multipart/form-data" id="imgupload_form_btn" class="imgupload_form_btn">
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

    <?php
    if (!preg_match('/^\/admin\/media.php/', $_SESSION['inmedia']) &&
        !preg_match('/^\/admin\/mediaupload.php/', $_SESSION['inmedia'])
        ) {
      require(__DIR__ . '/tmp/msg.php');
    }
    ?>

    <ul id="media" class="grid grid-media clearfix">
      <?= $viewMedia; ?>
    </ul>

    <ul id="pager_media" class="pager list-inline">
      <?= $pageList; ?>
    </ul>

  </div>

<?php require_once(__DIR__ . '/tmp/footer.php'); ?>
