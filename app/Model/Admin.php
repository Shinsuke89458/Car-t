<?php

namespace MyApp\Model;

class Admin extends \MyApp\Model {

  public function insertdb($values) {

    // $this->_insertproducts($values);
    $this->_insertcat($values);

  }

  private function _insertproducts($values) {

    $stmt = $this->db->prepare("INSERT INTO products(product_ttl, product_exp, product_price, product_imgpath, product_indate) VALUES(:product_ttl, :product_exp, :product_price, :product_imgpath, now())");
    $res = $stmt->execute([
      ':product_ttl' => $values['product_ttl'],
      ':product_exp' => $values['product_exp'],
      ':product_price' => $values['product_price'],
      ':product_imgpath' => $values['product_imgpath']
    ]);

    if (!$res) {
      throw new \Exception('DB ERR! [products]');
      exit;
    }

  }

  private function _insertcat($values) {

    var_dump($values['cat_name_en']);

    // get cat_id from cat table
    $stmt = $this->db->prepare("SELECT cat_id from cat where cat_name_en = :cat_name_en");
    $stmt->execute([
      ':cat_name_en' => $values['cat_name_en']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    var_dump($stmt->fetch());
    exit;

    // get product_id from products table

    // insert productcat
    // $stmt = $this->db->prepare("INSERT INTO productcat(cat_id, product_id) VALUES(:cat_id, :product_id)");
    // $res = $stmt->execute([
    //   ':cat_id' => $values['cat_id'],
    //   ':product_id' => $values['product_id']
    // ]);
    //
    // if (!$res) {
    //   throw new \Exception('DB ERR! [products]');
    //   exit;
    // }

  }


}
