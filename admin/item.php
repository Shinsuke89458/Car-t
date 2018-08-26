<?php
require_once(__DIR__ . '/../config/config.php');

$utility = new MyApp\Controller\Utility();
if (isset($_GET['cat_id'])) {
    $cat_name_ja = $utility->getCatNameJa();
}
if (isset($_GET['product_id'])) {
  $product = $utility->getProduct();
}


$formUrl = (!isset($_GET['product_id']))? 'insert.php': 'update.php';
if (isset($_GET['cat_id'])) {
  $formUrl .= '?cat_id=' . h($_GET['cat_id']);
}
if (isset($_GET['product_id'])) {
  $formUrl .= '&product_id=' . h($_GET['product_id']);
}
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

      <form action="<?= $formUrl; ?>" method="post">
        <p class="cms-thumb"><img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="200"></p>
        <div>
          <p>画像</p>
          <?php /*<p><input type="file" name="fname" class="cms-item"></p>*/ ?>
          <p>画像ファイル名<input type="text" name="product_imgpath" value="<?php if (isset($_GET['product_id'])) echo $product['product_imgpath']; ?>"></p>
        </div>
        <p>商品名:<br>
          <input type="text" name="product_ttl" value="<?php if (isset($_GET['product_id'])) echo $product['product_ttl']; ?>">
        </p>
        <p>商品説明:<br>
          <textarea name="product_exp"><?php if (isset($_GET['product_id'])) echo $product['product_exp']; ?></textarea>
        </p>
        <p>価格:<br>
          <input type="text" name="product_price" value="<?php if (isset($_GET['product_id'])) echo $product['product_price']; ?>">
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
      </form>

    </div>



<?php require(__DIR__ . '/tmp/footer.php'); ?>
