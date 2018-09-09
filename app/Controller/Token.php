<?php

namespace MyApp\Controller;

class Token extends \MyApp\Controller {

  private $_errorMessage = '';

  public function __construct() {
    $this->_createToken();
  }

  public function post() {
    try {
      $this->_validateToken();

      if ($this->_errorMessage !== '') throw new \Exception($this->_errorMessage);
    } catch (\Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }

  }

  public function resetToken() {
    $_SESSION['token'] = $_POST['token'] = NULL;
  }

  private function _createToken() {
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }
  }

  private function _validateToken() {
    if (
      !isset($_SESSION['token']) ||
      !isset($_POST['token']) ||
      $_SESSION['token'] !== $_POST['token']
    ) {
      $this->_errorMessage .= 'invalid token!';
    }
  }


}
