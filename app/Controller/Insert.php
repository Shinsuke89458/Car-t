<?php

namespace MyApp\Controller;

class Insert extends \MyApp\Controller {

  private $_productId = NULL;

  public function run() {
    try {
      setSession($_POST);
      $this->validateInputval();
      $this->_insert();

      $_SESSION['success'] .= $this->successMessage;
      if ($this->errorMessage !== '') throw new \Exception($this->errorMessage);
    } catch (\Exception $e) {
      $_SESSION['error'] .= $e->getMessage();
    }

    $location = 'Location: ' . ADMITEM . '?cat_id=' . $_GET['cat_id'];
    if ($this->_productId !== NULL) $location .= '&product_id=' . $this->_productId;
    $_SESSION['redirect'] = 1; // 0: direct , 1: redirect

    header($location);
    exit;
  }

  private function _insert() {
    if (isset($_POST['show'])) $product_state = 'show';
    if (isset($_POST['draft'])) $product_state = 'draft';
    $admin = new \MyApp\Model\Admin();
    $this->_productId = $admin->insertDB([
      'cat_id' => $_POST['cat_id'],
      'product_ttl' => $_POST['product_ttl'],
      'product_exp' => $_POST['product_exp'],
      'product_price' => $_POST['product_price'],
      'product_state' => $product_state,
      'product_imgpath' => $_POST['product_imgpath']
    ]);

    $this->successMessage .= '<p>'.$_POST['product_ttl'].' is Insert Done!</p>';
  }



}
