<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Master of Engineer</title>
    <link rel="stylesheet" href="../common/common.css">
  </head>
  <body>
    <?php

      try{

        require_once('../common/common.php');
        $post=sanitize($_POST);

        $m_name=$post['m_name'];
        $pass=$post['pass'];
        $email=$post['email'];

        require_once("../../../../xampp/mysql/mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);

        $s->query("INSERT INTO member VALUES (0,'$m_name','$pass','$email')");

        print'登録ありがとうございます。';
        print $m_name;
        print'さんを追加しました。<br>';
        print'お手数ですが、ログイン画面よりログインしてから掲示板をご利用ください。<br>';
        print'<a href="login.html">ログイン画面へ</a><br>';

      }catch(Exception $e){
        print'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>

  </body>
</html>
