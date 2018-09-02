<?php
require_once(__DIR__ . '/../config/config.php');

$token = new MyApp\Controller\Token();
$insert = new MyApp\Controller\Insert();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token->post();
  $insert->run();
}

$token->resetToken();
