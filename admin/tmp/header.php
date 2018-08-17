<?php

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
  $_SERVER['REQUEST_URI'] === '/admin'
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
  $_SERVER['REQUEST_URI'] === '/admin/item.php' ||
  $_SERVER['REQUEST_URI'] === '/admin/itemlist.php'
):

  $headerView .= '
  <header id="header">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-sm-10">

        <div class="row align-items-center">
          <div class="col-sm-4">
            <h1><a href="index.php">Car-t 管理画面</a></h1>
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
      <div class="col-sm-2">
        <div class="float-right">
          <p class="btn btn-dark">新規追加</p>
        </div>
      </div>
    </div>
    </div>
  </header>
  ';

endif;

echo $headerView;
