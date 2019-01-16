<?php
  session_start();
  $_SESSION = array();
  if(isset($_COOKIE[session_name()])==true){
    setcookie(session_name(), '', time()-1800, '/');
  }
  session_destroy();
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Master of Engineer</title>
    <link rel="stylesheet" href="../common/common.css">
  </head>
  <body>
    <p>ご利用ありがとうございました。</p>
    <p>ログアウトしました。</p>
    <p>またのご利用をお待ちしております。</p>
    <a href="login.html">ログイン画面へ</a>
  </body>
</html>
