<?php

namespace MyApp\Controller;

class Insert extends \MyApp\Controller {

  public function run() {
    try {
      // validate
      $this->validateInputval();
      // insert
      $this->_insert();
      // redirect
      header('Location: ' . ADMITEM . '?cat_id=' . $_GET['cat_id']);
      exit;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  private function _insert() {
    $admin = new \MyApp\Model\Admin();
    $admin->insertDB([
      'cat_id' => $_POST['cat_id'],
      'product_ttl' => $_POST['product_ttl'],
      'product_exp' => $_POST['product_exp'],
      'product_price' => $_POST['product_price'],
      'product_imgpath' => $_POST['product_imgpath']
    ]);
  }



}
