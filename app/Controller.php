<?php

namespace MyApp;

class Controller {

  protected $errorMessage = '';
  protected $successMessage = '';

  public function __construct() {

  }

  protected function setSession($array) {
    $_SESSION = array_merge($_SESSION, $array);
  }

  protected function validateInputval() {
    // not set
    // if (!isset($_POST['product_imgpath']) ||$_POST['product_imgpath'] === '') throw new \Exception('Not set product_imgpath!');
    if (!isset($_POST['product_ttl']) || $_POST['product_ttl'] === '') $this->errorMessage .= '<p>Not set product_ttl!</p>';
    if (!isset($_POST['product_price'])) $this->errorMessage .= '<p>Not set product_price!</p>';
    // validate product_price val
    if ($_POST['product_price'] !== '') {
      $_POST['product_price'] = mb_convert_kana($_POST['product_price'], 'a');
      if (is_numeric($_POST['product_price'])) {
        $_POST['product_price'] = intval($_POST['product_price']);
      } else {
        $this->errorMessage .= '<p>Price is not numeric!</p>';
      }
    }
    // validate tag

    if ($this->errorMessage !== '') throw new \Exception($this->errorMessage);
  }


}
