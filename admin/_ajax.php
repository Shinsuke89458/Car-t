<?php
require_once(__DIR__ . '/../config/config.php');

$uploader = new MyApp\Controller\ImageUploader();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  try {
    $images = $uploader->getImages();
    header('Content-Type: application/json');
    echo json_encode($images);
    exit;
  } catch (Exception $e) {
    header($_SERVER['SERVER_PROTOCOL'].' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}
