<?php
require_once(__DIR__ . '/../config/config.php');


?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

    <div id="contents" class="container">

      <nav class="list list-menu text-center">
        <ul>
          <li><a href="media.php">メディア</a></li>
          <li><a href="itemlist.php?cat=ncar">新車</a></li>
          <li><a href="itemlist.php?cat=ucar">中古車</a></li>
          <li><a href="itemlist.php?cat=tirewheel">タイヤ＆ホイール</a></li>
          <li><a href="itemlist.php?cat=caracce">カーアクセサリー</a></li>
          <li><a href="itemlist.php?cat=carparts">カーパーツ</a></li>
        </ul>
      </nav>

    </div>



<?php require(__DIR__ . '/tmp/footer.php'); ?>
