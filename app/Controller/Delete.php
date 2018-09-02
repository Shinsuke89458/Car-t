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
      // redirect
      header('Location: ' . ADMITEMLIST . '?cat_id=' . $_GET['cat_id']);
      exit;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  private function _delete() {
    $admin = new \MyApp\Model\Admin();
    $admin->deleteDB([
      'product_id' => $_GET['product_id']
    ]);
  }



}
