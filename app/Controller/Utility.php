<?php

namespace MyApp\Controller;

class Utility extends \MyApp\Controller {

  public function getProduct() {
    try {
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
      $admin = new \MyApp\Model\Admin();
      $products = $admin->getProductsDB([
        'cat_name_en' => $_GET['cat']
      ]);
      return $products;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }

  public function getCatNameJa() {
    try {
      $admin = new \MyApp\Model\Admin();
      $cat_name_ja = $admin->getCatNameJaDB([
        'cat_name_en' => $_GET['cat']
      ]);
      return $cat_name_ja;
    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }
  }


}
