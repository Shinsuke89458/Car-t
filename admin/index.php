<?php
require_once(__DIR__ . '/../config/config.php');


?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <nav class="list list-menu text-center">
        <ul>
          <li><a href="admin/media.php">メディア</a></li>
          <li><a href="admin/itemlist.php?cat_id=1">新車</a></li>
          <li><a href="admin/itemlist.php?cat_id=2">中古車</a></li>
          <li><a href="admin/itemlist.php?cat_id=3">タイヤ＆ホイール</a></li>
          <li><a href="admin/itemlist.php?cat_id=4">カーアクセサリー</a></li>
          <li><a href="admin/itemlist.php?cat_id=5">カーパーツ</a></li>
        </ul>
      </nav>

    </div>



<?php require(__DIR__ . '/tmp/footer.php'); ?>
