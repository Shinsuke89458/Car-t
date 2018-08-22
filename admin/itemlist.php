<?php
require_once(__DIR__ . '/../config/config.php');

$utility = new MyApp\Controller\Utility();

$viewItem = '';

if (isset($_GET['cat'])) {

    $cat_name_ja = $utility->getCatNameJa();
    $products = $utility->getProducts();

    if ($products !== 'none') {

      foreach ($products as $product) {
        $viewItem .= '
        <li class="row align-items-center">
          <div class="col-sm-3">
            <p class="cms-thumb"><img src="' . h(SITE_URL.'/src/thumbs/'.$product->{'product_imgpath'}) . '" alt=""></p>
          </div>
          <div class="col-sm-7">
            <h2>' . h($product->{'product_ttl'}) . '</h2>
            <p>' . h($product->{'product_exp'}) . '</p>
            <p class="price">' . h($product->{'product_price'}) . '</p>
          </div>
          <div class="col-sm-1">
            <p><a href="item.php?cat=' . h($_GET['cat']) . '&product_id=' . h($product->{'product_id'}) . '">編集</a></p>
          </div>
          <div class="col-sm-1">
            <p>削除</p>
          </div>
        </li>
        ';
      }

    } else {

      $viewItem = '登録されている商品はありません';

    }
}

?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <div class="row heading-post">
        <h2 class="col-sm-10">投稿一覧<?php if (isset($_GET['cat'])) echo '('.h($cat_name_ja).')'; ?></h2>
        <div class="col-sm-2">
          <div class="float-right">
            <p><a href="item.php<?php if (isset($_GET['cat'])) echo '?cat=' . h($_GET['cat']); ?>" class="btn btn-dark">新規追加</a></p>
          </div>
        </div>
      </div>

      <ul class="list list-product">
        <?= $viewItem; ?>
      </ul>

    </div>

<?php require(__DIR__ . '/tmp/footer.php'); ?>
