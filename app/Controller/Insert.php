<?php

namespace MyApp\Controller;

class Insert extends \MyApp\Controller {

  public function run() {

    try {

      // validate
      $this->_validateInputval();
      // insert
      $this->_insert();
      // redirect
      header('Location: ' . ADMITEM);
      exit;

    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }

  }

  private function _validateInputval() {
    $_POST['product_price'] = mb_convert_kana($_POST['product_price'], 'a');
    if (is_numeric($_POST['product_price'])) {
      $_POST['product_price'] = intval($_POST['product_price']);
    } else {
      throw new \Exception('Price is not numeric!');
    }
    // validate tag

  }

  private function _insert() {
    $admin = new \MyApp\Model\Admin();
    $admin->insertdb([
      'cat_name_en' => $_POST['cat_name_en'],
      'product_ttl' => $_POST['product_ttl'],
      'product_exp' => $_POST['product_exp'],
      'product_price' => $_POST['product_price'],
      'product_imgpath' => $_POST['product_imgpath']
    ]);
  }



}
