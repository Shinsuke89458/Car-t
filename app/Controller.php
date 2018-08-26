<?php

namespace MyApp;

class Controller {

  public function __construct() {

  }

  protected function validateInputval() {
    // not set
    // if (!isset($_POST['product_imgpath']) ||$_POST['product_imgpath'] === '') throw new \Exception('Not set product_imgpath!');
    if (!isset($_POST['product_ttl']) || $_POST['product_ttl'] === '') throw new \Exception('Not set product_ttl!');
    if (!isset($_POST['product_price'])) throw new \Exception('Not set product_price!');
    // validate product_price val
    if ($_POST['product_price'] !== '') {
      $_POST['product_price'] = mb_convert_kana($_POST['product_price'], 'a');
      if (is_numeric($_POST['product_price'])) {
        $_POST['product_price'] = intval($_POST['product_price']);
      } else {
        throw new \Exception('Price is not numeric!');
      }
    }
    // validate tag

  }


}
