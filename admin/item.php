<?php
require_once(__DIR__ . '/../config/config.php');

$utility = new MyApp\Controller\Utility();
if (isset($_GET['cat'])) {
    $cat_name_ja = $utility->getCatNameJa();
}
if (isset($_GET['product_id'])) {
  $product = $utility->getProduct();
}
?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <div class="row heading-post">
        <h2 class="col-sm-10">投稿詳細<?php if (isset($_GET['cat'])) echo '('.h($cat_name_ja).')'; ?></h2>
        <div class="col-sm-2">
          <div class="float-right">
            <p><a href="item.php<?php if (isset($_GET['cat'])) echo '?cat=' . h($_GET['cat']); ?>" class="btn btn-dark">新規追加</a></p>
          </div>
        </div>
      </div>

      <form action="<?= (!isset($_GET['product_id'])) ? 'insert.php': 'update.php'; ?>" method="post">
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
        <input type="hidden" name="cat_name_en" value="<?php if (isset($_GET['cat'])) echo h($_GET['cat']); ?>">
        <input type="hidden" name="store_id" value="">
        <p><input type="submit" value="<?= (!isset($_GET['product_id'])) ? '公開': '更新'; ?>"></p>
      </form>

    </div>



<?php require(__DIR__ . '/tmp/footer.php'); ?>
