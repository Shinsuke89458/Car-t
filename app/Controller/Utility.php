<?php

namespace MyApp\Controller;

class Utility extends \MyApp\Controller {

  public function getCats() {
    try {
      $admin = new \MyApp\Model\Admin();
      $cats = $admin->getCatsDB();
      return $cats;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
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
      return $product;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  public function getProducts() {
    try {
      // validate
      if (!isset($_GET['cat_id']) || $_GET['cat_id'] === '') throw new \Exception('Not set qs cat_id!');
      // getProductsDB
      $admin = new \MyApp\Model\Admin();
      $products = $admin->getProductsDB([
        'cat_id' => $_GET['cat_id'],
        'page' => $_GET['page']
      ]);
      return $products;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
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
      echo $e->getMessage();
      exit;
    }
  }


}
