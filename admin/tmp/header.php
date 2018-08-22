<?php

$qsstart = strpos($_SERVER['REQUEST_URI'], '?');
$url = ($qsstart)? substr($_SERVER['REQUEST_URI'], 0, $qsstart++): $_SERVER['REQUEST_URI'];

$headerView = '
<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Car-t 管理画面</title>
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/admin/styles.css">
  </head>
  <body>
';

if (
  $url === '/admin' ||
  $url === '/admin/index.php'
):
  $headerView .= '
  <header id="header">
    <div class="container">
    <div class="row">
      <div class="col-sm-8">
        <h1><a href="#">Car-t 管理画面</a></h1>
      </div>
      <div class="col-sm-4">
        <p class="sitetop-link"><a href="/">サイトトップへ</a></p>
      </div>
    </div>
    </div>
  </header>
  ';

endif;

if (
  $url === '/admin/media.php' ||
  $url === '/admin/item.php' ||
  $url === '/admin/itemlist.php'
):

  $headerView .= '
  <header id="header">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-10">

        <div class="row align-items-center">
          <div class="col-sm-4">
            <h1><a href="/admin">Car-t 管理画面</a></h1>
          </div>
          <div class="col-sm-8">
            <nav>
              <ul class="list-inline">
                <li class="list-inline-item"><a href="media.php">メディア</a></li>
                <li class="list-inline-item"><a href="itemlist.php?cat=ncar">新車</a></li>
                <li class="list-inline-item"><a href="itemlist.php?cat=ucar">中古車</a></li>
                <li class="list-inline-item"><a href="itemlist.php?cat=tirewheel">タイヤ＆ホイール</a></li>
                <li class="list-inline-item"><a href="itemlist.php?cat=caracce">カーアクセサリー</a></li>
                <li class="list-inline-item"><a href="itemlist.php?cat=carparts">カーパーツ</a></li>
              </ul>
            </nav>
          </div>
        </div>

      </div>

    </div>
    </div>
  </header>
  ';

endif;

echo $headerView;
