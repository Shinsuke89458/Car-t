<?php
require_once(__DIR__ . '/../config/config.php');

$navView = '';
?>

<?php require(__DIR__ . '/tmp/header.php'); ?>

<?php
foreach ($cats as $cat) {
$navView .= '
            <li><a href="admin/itemlist.php?cat_id=' . $cat->{'cat_id'} . '">' . $cat->{'cat_name_ja'} . '</a></li>
';
}
?>

    <div id="contents" class="container">

      <nav class="list list-menu text-center">
        <ul>
          <li><a href="admin/media.php">メディア</a></li>
          <?php echo $navView; ?>
        </ul>
      </nav>
      
    </div>

<?php require(__DIR__ . '/tmp/footer.php'); ?>
