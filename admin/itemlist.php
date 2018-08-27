<?php
require_once(__DIR__ . '/../config/config.php');

$utility = new MyApp\Controller\Utility();

$viewItem = '';

if (isset($_GET['cat_id'])) {

    $cat_name_ja = $utility->getCatNameJa();
    $products = $utility->getProducts();

    if ($products !== 'none') {

      foreach ($products as $product) {
        $product_price = ($product->{'product_price'} != 0)? h($product->{'product_price'}): 'お問い合わせ価格';
        $viewItem .= '
        <li class="row align-items-center">
          <div class="col-sm-3">
            <p class="cms-thumb"><img src="' . h(SITE_URL.'/src/thumbs/'.$product->{'product_imgpath'}) . '" alt=""></p>
          </div>
          <div class="col-sm-7">
            <h2>' . h($product->{'product_ttl'}) . '</h2>
            <p>' . h($product->{'product_exp'}) . '</p>
            <p class="price">' . $product_price . '</p>
          </div>
          <div class="col-sm-1">
            <p><a href="item.php?cat_id=' . h($_GET['cat_id']) . '&product_id=' . h($product->{'product_id'}) . '">編集</a></p>
          </div>
          <div class="col-sm-1">
            <p><a href="delete.php?cat_id=' . h($_GET['cat_id']) . '&product_id=' . h($product->{'product_id'}) . '">削除</a></p>
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
        <h2 class="col-sm-10">投稿一覧<?php if (isset($_GET['cat_id'])) echo '('.h($cat_name_ja).')'; ?></h2>
        <div class="col-sm-2">
          <div class="float-right">
            <p><a href="item.php<?php if (isset($_GET['cat_id'])) echo '?cat_id=' . h($_GET['cat_id']); ?>" class="btn btn-dark">新規追加</a></p>
          </div>
        </div>
      </div>

      <ul class="list list-product">
        <?= $viewItem; ?>
      </ul>

      <ul class="pager list-inline">
        <?php
        /*
        2/5 1
        5/5 1
        7/5 2
        */
        $qsCat = (isset($_GET['cat_id']))? '?cat_id=' . h($_GET['cat_id']): '';
        $allPageNum = count($products) / POST_PER_PAGE;
        var_dump(count($products));
        ?>
        <li class="pager-item list-inline-item"><a href="itemlist.php<?= $qsCat . '&page=1'; ?>">最初へ</a></li>
        <?php
        for ($pageNum = 1; $pageNum <= $allPageNum; $pageNum++):
        ?>
        <li class="pager-item list-inline-item"><a href="itemlist.php?page=<?= $qsCat . '&page=' . $pageNum;?>"><?= $pageNum; ?></a></li>
        <?php
        endfor;
        ?>
        <li class="pager-item list-inline-item"><a href="itemlist.php<?= $qsCat . '&page=' . $allPageNum;?>">最後へ</a></li>
      </ul>

    </div>

<?php require(__DIR__ . '/tmp/footer.php'); ?>
