<?php
require_once(__DIR__ . '/../config/config.php');

$update = new MyApp\Controller\Update();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $update->run();
}
