<?php
require_once(__DIR__ . '/../config/config.php');


?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <form action="" method="post">
        <p class="cms-thumb"><img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=%E3%83%80%E3%83%9F%E3%83%BC%E7%94%BB%E5%83%8F" width="200"></p>
        <div>
          <p>画像</p>
          <?php /*<p><input type="file" name="fname" class="cms-item"></p>*/ ?>
          <p>画像ファイル名<input type="text" name="ttl" value="画像ファイル名"></p>
        </div>
        <p>商品名:<br>
          <input type="text" name="ttl" value="商品名１">
        </p>
        <p>商品説明:<br>
          <textarea name="exp">商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１<商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１商品１</textarea>
        </p>
        <p>価格:<br>
          <input type="text" name="price" value="">
        </p>
        <p>タグ:<br>
          <input type="text" name="tag" value="">
        </p>
        <input type="hidden" name="cat-id" value="">
        <input type="hidden" name="store-id" value="">
        <p><input type="submit" value="更新"></p>
      </form>

    </div>



<?php require(__DIR__ . '/tmp/footer.php'); ?>
