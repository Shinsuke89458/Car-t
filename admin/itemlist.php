<?php
require_once(__DIR__ . '/../config/config.php');

$utility = new MyApp\Controller\Utility();
$cat_name_ja = $utility->getCatNameJa();
$products = $utility->getProducts();
foreach ($products as $product) {
  $viewItem = '
  <li class="row align-items-center">
    <div class="col-sm-3">
      <p class="cms-thumb"><img src="' . h(SITE_URL.'/src/'.$product->{'imagename'}) . '" alt=""></p>
    </div>
    <div class="col-sm-7">
      <h2>' . h($product->{'product_ttl'}) . '</h2>
      <p>' . h($product->{'product_ttl'}) . '</p>
      <p class="price">' . h($product->{'product_price'}) . '</p>
    </div>
    <div class="col-sm-1">
      <p><a href="item.php">編集</a></p>
    </div>
    <div class="col-sm-1">
      <p>削除</p>
    </div>
  </li>
  ';
}


?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <div class="row heading-post">
        <h2 class="col-sm-10">投稿一覧<?= '('.h($cat_name_ja).')'; ?></h2>
        <div class="col-sm-2">
          <div class="float-right">
            <p><a href="item.php?cat=<?= h($_GET['cat']); ?>" class="btn btn-dark">新規追加</a></p>
          </div>
        </div>
      </div>

      <ul class="list list-product">
        <?= $viewItem; ?>
      </ul>

    </div>

<?php require(__DIR__ . '/tmp/footer.php'); ?>
