<?php
require_once(__DIR__ . '/../config/config.php');

$utility = new MyApp\Controller\Utility();
$token = new MyApp\Controller\Token();
$uploader = new MyApp\Controller\ImageUploader();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token->post();
  $uploader->upload();
}

$token->resetToken();
