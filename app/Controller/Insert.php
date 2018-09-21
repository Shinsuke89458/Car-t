<?php

namespace MyApp\Controller;

class Insert extends \MyApp\Controller {

  private $_productId = NULL;

  public function run() {
    try {
      $this->setSession($_POST);
      $this->validateInputval();
      $this->_insert();

      $_SESSION['success'] .= $this->successMessage;
      if ($this->errorMessage !== '') throw new \Exception($this->errorMessage);
    } catch (\Exception $e) {
      $_SESSION['error'] .= $e->getMessage();
    }

    $location = 'Location: ' . ADMITEM . '?cat_id=' . $_GET['cat_id'];
    if ($this->_productId !== NULL) $location .= '&product_id=' . $this->_productId;

    header($location);
    exit;
  }

  private function _insert() {
    $admin = new \MyApp\Model\Admin();
    $this->_productId = $admin->insertDB([
      'cat_id' => $_POST['cat_id'],
      'product_ttl' => $_POST['product_ttl'],
      'product_exp' => $_POST['product_exp'],
      'product_price' => $_POST['product_price'],
      'product_imgpath' => $_POST['product_imgpath']
    ]);
  }



}
