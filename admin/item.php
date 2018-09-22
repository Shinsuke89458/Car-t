<?php
require_once(__DIR__ . '/../config/config.php');

$token = new MyApp\Controller\Token();
$utility = new MyApp\Controller\Utility();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   $token->post();
//   $token->resetToken();
// }

if (isset($_GET['cat_id'])) {
    $cat_name_ja = $utility->getCatNameJa();
}
if (isset($_GET['product_id'])) {
    $utility->getProduct()[0];
    // $product = $utility->getProduct()[0];

    if (array_key_exists('product_imgpath', $_SESSION)) {
      $product_imgpath = h($_SESSION['product_imgpath']);
      $product_imgthumb = '<img src="'.SITE_URL.'/src/thumbs/'.$product_imgpath.'">';
    } else {
      $product_imgpath = '';
      $product_imgthumb = '<img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="200">';
    }
    $product_ttl = (array_key_exists('product_ttl', $_SESSION)) ? h($_SESSION['product_ttl']): '';
    $product_exp = (array_key_exists('product_exp', $_SESSION)) ? h($_SESSION['product_exp']): '';
    $product_price = (array_key_exists('product_price', $_SESSION)) ? h($_SESSION['product_price']): '';
} else {
    $product_imgthumb = '<img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="200">';
    $product_imgpath = $product_ttl = $product_exp = $product_price = '';
}

$formUrl = (!isset($_GET['product_id']))? 'insert.php': 'update.php';
if (isset($_GET['cat_id'])) {
  $formUrl .= '?cat_id=' . h($_GET['cat_id']);
}
if (isset($_GET['product_id'])) {
  $formUrl .= '&product_id=' . h($_GET['product_id']);
}

$imgModalHead = '
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mediaModalLabel">画像一覧</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
';
$imgModalFoot = '
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-closed" data-dismiss="modal">閉じる</button>
        <button type="button" class="btn btn-primary btn-imgsetted" data-dismiss="modal">画像を設定</button>
      </div>
    </div>
  </div>
</div>
';

?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <div class="row heading-post">
        <h2 class="col-sm-10">投稿詳細<?php if (isset($_GET['cat_id'])) echo '('.h($cat_name_ja).')'; ?></h2>
        <div class="col-sm-2">
          <div class="float-right">
            <p><a href="item.php<?php if (isset($_GET['cat_id'])) echo '?cat_id=' . h($_GET['cat_id']); ?>" class="btn btn-dark">新規追加</a></p>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#mediaModal">
        画像を選択
      </button>
      <?= $imgModalHead; ?>
      <?php require(__DIR__ . '/media.php'); ?>
      <?= $imgModalFoot; ?>

      <form action="<?= $formUrl; ?>" method="post">
        <p class="cms-thumb"><?= $product_imgthumb; ?></p>
        <p class="form-parts">
          <input type="hidden" name="product_imgpath" value="<?= $product_imgpath; ?>">
        </p>
        <p class="form-parts">商品名:<br>
          <input type="text" name="product_ttl" value="<?= $product_ttl; ?>">
        </p>
        <p class="form-parts">商品説明:<br>
          <textarea name="product_exp"><?= $product_exp; ?></textarea>
        </p>
        <p class="form-parts">価格:<br>
          <input type="text" name="product_price" value="<?= $product_price; ?>">
        </p>
        <?php /*
        <p>タグ:<br>
          <input type="text" name="product_tag" value="">
        </p>
        */ ?>
        <input type="hidden" name="cat_id" value="<?php if (isset($_GET['cat_id'])) echo h($_GET['cat_id']); ?>">
        <input type="hidden" name="product_id" value="<?php if (isset($_GET['product_id'])) echo h($_GET['product_id']); ?>">
        <input type="hidden" name="store_id" value="">
        <p><input type="submit" value="<?= (!isset($_GET['product_id'])) ? '公開': '更新'; ?>"></p>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      </form>

    </div>

<?php
// $successFlag = (!isset($success) || $success === '');
// $errorFlag = (!isset($error) || $error === '');
// if ($errorFlag) {
//     unset($_SESSION['product_imgpath']);
//     unset($_SESSION['product_ttl']);
//     unset($_SESSION['product_exp']);
//     unset($_SESSION['product_price']);
// }

?>

<?php require(__DIR__ . '/tmp/footer.php'); ?>
