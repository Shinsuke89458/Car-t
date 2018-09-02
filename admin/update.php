<?php
require_once(__DIR__ . '/../config/config.php');

$token = new MyApp\Controller\Token();
$update = new MyApp\Controller\Update();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token->post();
  $update->run();
}

$token->resetToken();
