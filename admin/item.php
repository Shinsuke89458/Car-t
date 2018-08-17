<?php
require_once(__DIR__ . '/../config/config.php');


?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <form action="" method="post">
        <div>
          <p>画像:</p>
          <p>メディアを選択</p>
        </div>
        <p>商品名:<br>
          <input type="text" name="ttl" value="">
        </p>
        <p>商品説明:<br>
          <textarea name="exp"></textarea>
        </p>
        <p>価格:<br>
          <input type="text" name="price" value="">
        </p>
        <p><input type="submit" value="更新"></p>
      </form>

    </div>



<?php require(__DIR__ . '/tmp/footer.php'); ?>
