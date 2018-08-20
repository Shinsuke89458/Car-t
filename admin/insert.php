<?php
require_once(__DIR__ . '/../config/config.php');

$insert = new MyApp\Controller\Insert();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $insert->run();
}
