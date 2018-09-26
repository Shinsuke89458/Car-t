<?php

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function setSession($array) {
  $_SESSION = array_merge($_SESSION, $array);
}

function resetSession($pattern) {
  foreach ($_SESSION as $key => $value) {
    if (preg_match($pattern, $key)) unset($_SESSION[$key]);
  }
}
