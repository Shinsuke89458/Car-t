<?php
if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
  $utility = new MyApp\Controller\Utility();

  list($success, $error) = $utility->getResults();
  $utility->resetResults();
}

?>

<div class="msg-container">
  <?php if (isset($success)): ?>
    <div class="msg success"><?= $success; ?></div>
  <?php endif; ?>
  <?php if (isset($error)): ?>
    <div class="msg error"><?= $error; ?></div>
  <?php endif; ?>
</div>
