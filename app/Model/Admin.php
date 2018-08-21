<?php

namespace MyApp\Model;

class Admin extends \MyApp\Model {

  public function insertdb($values) {

      $this->db->beginTransaction();

          // insert products
          $this->_insertProducts($values);
          // get product_id
          $product_id = $this->_getProductId($values);
          // get cat_id
          $cat_id = $this->_getCatId($values);
          // insert productcat
          $this->_insertProductCat($values, $product_id, $cat_id);

      $this->db->commit();

  }

  /*****************/
  private function _insertProducts($values) {
      $stmt = $this->db->prepare("INSERT INTO products(product_ttl, product_exp, product_price, product_imgpath, product_indate) VALUES(:product_ttl, :product_exp, :product_price, :product_imgpath, now())");
      $res = $stmt->execute([
        ':product_ttl' => $values['product_ttl'],
        ':product_exp' => $values['product_exp'],
        ':product_price' => $values['product_price'],
        ':product_imgpath' => $values['product_imgpath']
      ]);
      if (!$res) {
        throw new \Exception('DB ERR! [insert products]');
        exit;
      }
  }

  private function _getProductId($values) {
      $stmt = $this->db->prepare("SELECT product_id FROM products WHERE product_ttl = :product_ttl");
      $res = $stmt->execute([
        ':product_ttl' => $values['product_ttl']
      ]);
      if (!$res){
          throw new \Exception('DB ERR! [get product_id from products]');
          exit;
      }
      $row = $stmt->fetch();

      return $row['product_id'];
  }

  private function _getCatId($values) {
      $stmt = $this->db->prepare("SELECT cat_id FROM cat WHERE cat_name_en = :cat_name_en");
      $res = $stmt->execute([
        ':cat_name_en' => $values['cat_name_en']
      ]);
      if (!$res){
          throw new \Exception('DB ERR! [get cat_id from cat]');
          exit;
      }
      $row= $stmt->fetch();
      return $row['cat_id'];
  }

  private function _insertProductCat($values, $product_id, $cat_id) {
      $stmt = $this->db->prepare("INSERT INTO productcat(cat_id, product_id) VALUES(:cat_id, :product_id)");
      $res = $stmt->execute([
        ':cat_id' => $cat_id,
        ':product_id' => $product_id
      ]);
      if (!$res) {
        throw new \Exception('DB ERR! [insert productcat]');
        exit;
      }
  }


}
