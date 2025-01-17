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
}
$product_imgpath = (isset($_SESSION['product_imgpath']))? $_SESSION['product_imgpath']: '';
$product_ttl = (isset($_SESSION['product_ttl']))? $_SESSION['product_ttl']: '';
$product_exp = (isset($_SESSION['product_exp']))? $_SESSION['product_exp']: '';
$product_price = (isset($_SESSION['product_price']))? $_SESSION['product_price']: '';
$product_state = (isset($_SESSION['product_state']))? $_SESSION['product_state']: '';

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

      <form id="itemForm" action="<?= $formUrl; ?>" method="post">
        <p class="cms-thumb">
          <?php
          if ($product_imgpath !== '') {
            echo '<img src="'.h(SITE_URL.'/src/thumbs/'.$product_imgpath).'">';
          } else {
            echo '<img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="200">';
          }
          ?>
        </p>
        <p class="form-parts">
          <input type="hidden" name="product_imgpath" value="<?= h($product_imgpath); ?>">
        </p>
        <p class="form-parts">商品名:<br>
          <input type="text" name="product_ttl" value="<?= h($product_ttl); ?>">
        </p>
        <p class="form-parts">商品説明:<br>
          <textarea name="product_exp"><?= h($product_exp); ?></textarea>
        </p>
        <p class="form-parts">価格:<br>
          <input type="text" name="product_price" value="<?= h($product_price); ?>">
        </p>
        <?php /*
        <p>タグ:<br>
          <input type="text" name="product_tag" value="">
        </p>
        */ ?>
        <?php
        if (isset($_GET['product_id'])) {
          $state_view = '
          <p class="form-parts">公開状態:<br>
            <select name="product_state">';
          $product_state_arr = [
            'show' => '公開中',
            'draft' => '下書き',
          ];
          foreach ($product_state_arr as $key => $value) {
            $selected = (h($product_state) === $key)? ' selected': '';
            $state_view .= '
              <option value="' . $key . '"' . $selected . '>' . $value . '</option>
            ';
          }
          $state_view .= '
            </select>
          </p>
          ';
          echo $state_view;
        }
        ?>
        <input type="hidden" name="cat_id" value="<?php if (isset($_GET['cat_id'])) echo h($_GET['cat_id']); ?>">
        <input type="hidden" name="product_id" value="<?php if (isset($_GET['product_id'])) echo h($_GET['product_id']); ?>">
        <?php /*<input type="hidden" name="store_id" value="">*/ ?>
        <?php
        if (!isset($_GET['product_id'])) {
          echo '
          <div class="form-inline">
          ';
        }
        ?>
        <p class="form-btn"><input type="submit" class="btn btn-primary" name="<?= (!isset($_GET['product_id'])) ? 'show': 'update'; ?>" value="<?= (!isset($_GET['product_id'])) ? '公開': '更新'; ?>"></p>
        <?php
        if (!isset($_GET['product_id'])) {
          echo '
            <p><input type="submit" class="btn btn-dark" name="draft" value="下書きとして保存"></p>
          </div>
          ';
        }
        ?>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
      </form>

    </div>



<?php require(__DIR__ . '/tmp/footer.php'); ?>
