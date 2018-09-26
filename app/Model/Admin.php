<?php

namespace MyApp\Model;

class Admin extends \MyApp\Model {

  /***********
    utility
  ***********/
  public function getCatsDB() {
    $stmt = $this->db->query("SELECT * FROM cat");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  public function getProductDB($values) {
    $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :product_id");
    $res = $stmt->execute([
      ':product_id' => $values['product_id']
    ]);
    if (!$res) {
      $this->errorMessage .= '<p>DB ERR! [get product]</p>';
      throw new \Exception($this->errorMessage);
    }
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
    // $row = $stmt->fetch();
    // return [
    //   'product_ttl' => $row['product_ttl'],
    //   'product_exp' => $row['product_exp'],
    //   'product_price' => $row['product_price'],
    //   'product_imgpath' => $row['product_imgpath']
    // ];
  }

  public function getProductsDB($values) {
    // get product_id
    $products_id = $this->_getProductIdByCatId($values);
    // get products
    return $this->_getProducts($values, $products_id);
  }

  private function _getProductIdByCatId($values) {
    $stmt = $this->db->prepare("SELECT product_id FROM productcat WHERE cat_id = :cat_id");
    $res = $stmt->execute([
      ':cat_id' => $values['cat_id']
    ]);
    if (!$res) {
      $this->errorMessage .= '<p>DB ERR! [get product_id]</p>';
      throw new \Exception($this->errorMessage);
    }
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  private function _getProducts($values, $products_id) {
    $products_id_arr = [];
    foreach ($products_id as $product) {
      array_push($products_id_arr, $product->{'product_id'});
    }
    $inClause = '';
    for ($i = 0; $i < count($products_id_arr); $i++) {
      $inClause .= ',:id'.$i;
    }
    $inClause = substr($inClause, 1);
    $productsNum = $this->_getProductsNum($values, $products_id, $products_id_arr, $inClause);
    $productsList = $this->_getProductsMain($values, $products_id, $products_id_arr, $inClause);
    return [
      'productsNum' => $productsNum,
      'productsList' => $productsList
    ];
  }

  private function _getProductsNum($values, $products_id, $products_id_arr, $inClause) {
    $query = sprintf("SELECT * FROM products WHERE product_id IN (%s)", $inClause);
    $stmt = $this->db->prepare($query);
    for ($i = 0; $i < count($products_id_arr); $i++) {
      $stmt->bindValue(':id'.$i, $products_id_arr[$i], \PDO::PARAM_STR);
    }
    $res = $stmt->execute();
    if ($res) {
      $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      return count($stmt->fetchAll());
    } else {
      return 0;
    }
  }

  private function _getProductsMain($values, $products_id, $products_id_arr, $inClause) {
    // page=1 limit 0, 10  ... 0~9
    // page=2 limit 10, 10 ... 10~19
    // page=3 limit 20, 10 ... 20~29
    // page=n limit (n - 1) * 10, 10 ... n~n+9
    $query = sprintf("SELECT * FROM products WHERE product_id IN (%s) ORDER BY product_indate DESC LIMIT :st, :ed", $inClause);
    $stmt = $this->db->prepare($query);
    for ($i = 0; $i < count($products_id_arr); $i++) {
      $stmt->bindValue(':id'.$i, $products_id_arr[$i], \PDO::PARAM_STR);
    }
    $stmt->bindValue(':st', ($values['page'] - 1) * POST_PER_PAGE, \PDO::PARAM_INT);
    $stmt->bindValue(':ed', POST_PER_PAGE, \PDO::PARAM_INT);
    $res = $stmt->execute();
    if ($res) {
      $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
      return $stmt->fetchAll();
    } else {
      return 'none';
    }
  }

  public function getCatNameJaDB($values) {
    $stmt = $this->db->prepare("SELECT cat_name_ja FROM cat WHERE cat_id = :cat_id");
    $res = $stmt->execute([
      ':cat_id' => $values['cat_id']
    ]);
    if (!$res) {
      $this->errorMessage .= '<p>DB ERR! [get cat_name_ja]</p>';
      throw new \Exception($this->errorMessage);
    }
    $row = $stmt->fetch();
    return $row['cat_name_ja'];
  }

  /***********
    deleteDB
  ***********/
  public function deleteDB($values) {
    $this->db->beginTransaction();
      $this->_deleteProducts($values);
      $this->_deleteProductCat($values);
    $this->db->commit();
  }

  public function _deleteProducts($values) {
    $stmt = $this->db->prepare("DELETE FROM products WHERE product_id = :product_id");
    $res = $stmt->execute([
      ':product_id' => $values['product_id'],
    ]);
    if (!$res) {
      $this->errorMessage .= '<p>DB ERR! [delete from products]</p>';
      throw new \Exception($this->errorMessage);
    }
  }

  public function _deleteProductCat($values) {
    $stmt = $this->db->prepare("DELETE FROM productcat WHERE product_id = :product_id");
    $res = $stmt->execute([
      ':product_id' => $values['product_id'],
    ]);
    if (!$res) {
      $this->errorMessage .= '<p>DB ERR! [delete from productcat]</p>';
      throw new \Exception($this->errorMessage);
    }
  }

  /***********
    updateDB
  ***********/
  public function updateDB($values) {
    $this->db->beginTransaction();

      // update products
      $this->_updateProducts($values);

    $this->db->commit();
  }

  private function _updateProducts($values) {
    $stmt = $this->db->prepare("UPDATE products SET product_ttl = :product_ttl, product_exp = :product_exp, product_price = :product_price, product_imgpath = :product_imgpath, product_indate = now() WHERE product_id = :product_id");
    $res = $stmt->execute([
      ':product_id' => $values['product_id'],
      ':product_ttl' => $values['product_ttl'],
      ':product_exp' => $values['product_exp'],
      ':product_price' => $values['product_price'],
      ':product_imgpath' => $values['product_imgpath']
    ]);
    if (!$res) {
      $this->errorMessage .= '<p>DB ERR! [update products]</p>';
      throw new \Exception($this->errorMessage);
    }
  }

  /***********
    insertDB
  ***********/
  public function insertDB($values) {
      $this->db->beginTransaction();

          // insert products
          $this->_insertProducts($values);
          // get product_id
          $product_id = $this->_getProductId($values);
          // insert productcat
          $this->_insertProductCat($values, $product_id);

      $this->db->commit();

      return $product_id;
  }

  private function _insertProducts($values) {
      $stmt = $this->db->prepare("INSERT INTO products(product_ttl, product_exp, product_price, product_imgpath, product_indate) VALUES(:product_ttl, :product_exp, :product_price, :product_imgpath, now())");
      $res = $stmt->execute([
        ':product_ttl' => $values['product_ttl'],
        ':product_exp' => $values['product_exp'],
        ':product_price' => $values['product_price'],
        ':product_imgpath' => $values['product_imgpath']
      ]);
      if (!$res) {
        $this->errorMessage .= '<p>DB ERR! [insert products]</p>';
        throw new \Exception($this->errorMessage);
      }
  }

  private function _getProductId($values) {
      $stmt = $this->db->prepare("SELECT product_id FROM products WHERE product_ttl = :product_ttl");
      $res = $stmt->execute([
        ':product_ttl' => $values['product_ttl']
      ]);
      if (!$res){
        $this->errorMessage .= '<p>DB ERR! [get product_id from products]</p>';
        throw new \Exception($this->errorMessage);
      }
      $row = $stmt->fetch();
      return $row['product_id'];
  }

  private function _insertProductCat($values, $product_id) {
      $stmt = $this->db->prepare("INSERT INTO productcat(cat_id, product_id) VALUES(:cat_id, :product_id)");
      $res = $stmt->execute([
        ':cat_id' => $values['cat_id'],
        ':product_id' => $product_id
      ]);
      if (!$res) {
        $this->errorMessage .= '<p>DB ERR! [insert productcat]</p>';
        throw new \Exception($this->errorMessage);
      }
  }


}
