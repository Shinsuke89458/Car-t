<?php
require_once(__DIR__ . '/../config/config.php');


?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <div class="row heading-post">
        <h2 class="col-sm-10">投稿一覧<?= '('.h($_GET['cat']).')'; ?></h2>
        <div class="col-sm-2">
          <div class="float-right">
            <p><a href="item.php?cat=<?= h($_GET['cat']); ?>" class="btn btn-dark">新規追加</a></p>
          </div>
        </div>
      </div>


      <ul class="list list-product">
        <li class="row align-items-center">
          <div class="col-sm-3">
            <p class="cms-thumb"><img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="200"></p>
          </div>
          <div class="col-sm-7">
            <h2>商品１</h2>
            <p>商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１<商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１...</p>
            <p class="price">¥ 2,000,000</p>
          </div>
          <div class="col-sm-1">
            <p><a href="item.php">編集</a></p>
          </div>
          <div class="col-sm-1">
            <p>削除</p>
          </div>
        </li>
      </ul>

    </div>


<?php require(__DIR__ . '/tmp/footer.php'); ?>
