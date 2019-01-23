<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print'ログインされていません<br>';
    print'<a href="../login/login.php">ログイン場面へ</a>';
    exit();
  }else{
    print $_SESSION['m_name'];
    print'さんログイン中 ';
    print'<a href="../login/member_disp.php?id=';
    print $_SESSION['id'];
    print'"';
    print'>[マイページ]</a>';
    print' ';
    print'<a href="../login/logout.php">[ログアウト]</a><br>';
  }
?>

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

        $id=$_SESSION['id'];
        $m_name=$post['m_name'];
        $pass=$post['pass'];
        $email=$post['email'];

        $hash=password_hash($_POST['pass'],PASSWORD_BCRYPT);

        require_once("../mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);

        $sql="UPDATE member SET m_name=:m_name,pass=:pass,email=:email
              WHERE id=$id";
        $stmt=$s->prepare($sql);
        $stmt->bindValue(':m_name',$_REQUEST['m_name'],PDO::PARAM_STR);
        $stmt->bindValue(':pass',$hash,PDO::PARAM_STR);
        $stmt->bindValue(':email',$_REQUEST['email'],PDO::PARAM_STR);
        $stmt->execute();


        /*require_once("../mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);

        $s->query("UPDATE member SET m_name='$m_name',pass='$pass',email='$email'
                   WHERE id='$id'");*/

      }catch(Exception $e){
        print'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>
    <p>修正しました。</p>
    <a href="../main/keizi_top.php">トップ画面へ</a>
  </body>
</html>
