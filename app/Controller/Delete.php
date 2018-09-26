<?php

namespace MyApp\Controller;

class Delete extends \MyApp\Controller {

  public function run() {
    try {
      // validate
      if (!isset($_GET['product_id']) || $_GET['product_id'] === '') {
        throw new \Exception('Not set qs product_id!');
      }
      // delete
      $this->_delete();

      $_SESSION['success'] .= $this->successMessage;
      if ($this->errorMessage !== '') throw new \Exception($this->errorMessage);
    } catch (\Exception $e) {
      $_SESSION['error'] .= $e->getMessage();
    }

    // redirect
    header('Location: ' . ADMITEMLIST . '?cat_id=' . $_GET['cat_id'] . '&page=1');
    exit;
  }

  private function _delete() {
    $admin = new \MyApp\Model\Admin();
    $admin->deleteDB([
      'product_id' => $_GET['product_id']
    ]);

    $this->successMessage .= '<p>'.$_GET['product_ttl'].' is Delete Done!</p>';
  }



}
