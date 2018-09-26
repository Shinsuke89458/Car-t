<?php

namespace MyApp\Controller;

class Update extends \MyApp\Controller {

  public function run() {
    try {
      // validate
      $this->validateInputval();
      // update
      $this->_update();

      $_SESSION['success'] .= $this->successMessage;
      if ($this->errorMessage !== '') throw new \Exception($this->errorMessage);
    } catch (\Exception $e) {
      $_SESSION['error'] .= $e->getMessage();
    }

    // redirect
    header('Location: ' . ADMITEM . '?cat_id=' . $_GET['cat_id'] . '&product_id=' . $_GET['product_id']);
    exit;
  }

  private function _update() {
    $admin = new \MyApp\Model\Admin();
    $admin->updateDB([
      'cat_id' => $_POST['cat_id'],
      'product_id' => $_POST['product_id'],
      'product_ttl' => $_POST['product_ttl'],
      'product_exp' => $_POST['product_exp'],
      'product_price' => $_POST['product_price'],
      'product_imgpath' => $_POST['product_imgpath']
    ]);

    $this->successMessage .= '<p>'.$_POST['product_ttl'].' is Update Done!</p>';
  }



}
