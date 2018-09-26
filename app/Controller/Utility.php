<?php

namespace MyApp\Controller;

class Utility extends \MyApp\Controller {

  // public function __construct() {
  //   $this->_initResults();
  // }

  /********** getResults **********/
  public function getResults() {
    $success = $error = NULL;
    if (isset($_SESSION['success'])) $success = $_SESSION['success'];
    if (isset($_SESSION['error'])) $error = $_SESSION['error'];
    return [$success, $error];
  }

  public function resetResults() {
    if (isset($_SESSION['success'])) unset($_SESSION['success']);
    if (isset($_SESSION['error'])) unset($_SESSION['error']);
  }

  // private function _initResults() {
  //   if (!isset($_SESSION['success'])) $_SESSION['success'] = '';
  //   if (!isset($_SESSION['error'])) $_SESSION['error'] = '';
  // }

  public function getCats() {
    try {
      $admin = new \MyApp\Model\Admin();
      $cats = $admin->getCatsDB();
      return $cats;
    } catch (\Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }
  }

  public function getProduct() {
    try {
      // validate
      if (!isset($_GET['product_id']) || $_GET['product_id'] === '') throw new \Exception('Not set qs product_id!');
      // getProductDB
      $admin = new \MyApp\Model\Admin();
      $product = $admin->getProductDB([
        'product_id' => $_GET['product_id']
      ]);
      setSession((array)$product[0]);
      // return $product;
    } catch (\Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }
  }

  public function getProducts() {
    try {
      // validate
      if (!isset($_GET['cat_id']) || $_GET['cat_id'] === '') throw new \Exception('Not set qs cat_id!');
      if (!isset($_GET['page']) || $_GET['page'] === '') throw new \Exception('Not set qs page!');
      // getProductsDB
      $admin = new \MyApp\Model\Admin();
      $products = $admin->getProductsDB([
        'cat_id' => $_GET['cat_id'],
        'page' => $_GET['page']
      ]);
      return $products;
    } catch (\Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }
  }

  public function getCatNameJa() {
    try {
      // validate
      if (!isset($_GET['cat_id']) || $_GET['cat_id'] === '') throw new \Exception('Not set qs cat_id!');
      // getCatNameJaDB
      $admin = new \MyApp\Model\Admin();
      $cat_name_ja = $admin->getCatNameJaDB([
        'cat_id' => $_GET['cat_id']
      ]);
      return $cat_name_ja;
    } catch (\Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }
  }


}
