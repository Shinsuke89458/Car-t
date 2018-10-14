<?php
require_once(__DIR__ . '/../config/config.php');

$_SESSION['inmedia'] = $_SERVER['REQUEST_URI'];

// var_dump(reset($qsArr));
// var_dump($inmedia_rmqs);
// var_dump(in_array('page', array_keys($_GET)));
// var_dump($_SERVER['QUERY_STRING']);
// var_dump($_SESSION['inmedia']);
// var_dump(strtok($_SESSION['inmedia'], '?'));

$token = new MyApp\Controller\Token();
$uploader = new MyApp\Controller\ImageUploader();

if (
  preg_match('/^\/admin\/media.php/', $_SESSION['inmedia']) &&
  !isset($_GET['page'])
) {
    header('Location: ' . ADMMEDIA . '?page=1');
  }

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
  // $qsCat = (isset($_GET['cat_id']))? '?cat_id=' . h($_GET['cat_id']): '';
  $allPageNum = ceil($imagesNum / MEDIA_PER_PAGE);
  $pageList = '<li class="pager-item list-inline-item"><a href="media.php?page=1">最初へ</a></li>';
  $qsArr = $_GET;
  unset($qsArr['page']);
  $inmedia_rmqs = strtok($_SESSION['inmedia'], '?');
  foreach($qsArr as $key => $value) {
    $inmedia_rmqs .= (reset($qsArr) === $value)? '?': '&';
    $inmedia_rmqs .= $key . '=' . $value;
  }
  for ($pageNum = 1; $pageNum <= $allPageNum; $pageNum++) {
    $class = 'pager-item list-inline-item';
    if ($_GET['page'] == $pageNum) $class .= ' pager-item-current';
    // if (in_array('page', array_keys($_GET))) {
    //   $addqs = '?page=' . $pageNum;
    // } else {
    //   $addqs = '&page=' . $pageNum;
    // }
    $qsPage = (empty($qsArr) || !isset($qsArr))? '?': '&';
    $qsPage .= 'page=' .  $pageNum;
    $pageList .= '<li class="' . $class . '"><a href="' . $inmedia_rmqs . $qsPage . '">' . $pageNum . '</a></li>';
  }
  $pageList .= '<li class="pager-item list-inline-item"><a href="media.php?page=' . $allPageNum . '">最後へ</a></li>';

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
    if (preg_match('/^\/admin\/media.php/', $_SESSION['inmedia']) &&
        preg_match('/^\/admin\/mediaupload.php/', $_SESSION['inmedia'])
        ) {
      require(__DIR__ . '/tmp/msg.php');
    }
    ?>

    <ul class="grid grid-media clearfix">
      <?= $viewMedia; ?>
    </ul>

    <ul class="pager list-inline">
      <?= $pageList; ?>
    </ul>

  </div>

<?php require_once(__DIR__ . '/tmp/footer.php'); ?>
