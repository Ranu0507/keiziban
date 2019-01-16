<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print'ログインされていません<br>';
    print'<a href="../login/login.html">ログイン場面へ</a>';
    exit();
  }else{
    print $_SESSION['m_name'];
    print'さんログイン中 ';
    print'<a href="../login/member_disp.php?id=';
    print $_SESSION['id'];
    print'"';
    print'>[マイページ]</a>';
    print' ';
    print'<a href="../login/logout.php">[ログアウト]</a><br><br>';
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
        $comment=$post['comment'];
        $id=$_SESSION['id'];
        $m_name=$_SESSION['m_name'];
        $email=$_SESSION['email'];

        require_once("../../../../xampp/mysql/mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);
        $s->query("INSERT INTO form VALUES (0,'$comment',now(),'$id')");

        print $m_name.'様<br>';
        print'お問い合わせありがとうございました。<br>';
        print $email.'にメールを送りましたのでご確認ください。<br>';


        $main='';
        $main.=$m_name."様\n\nこの度はお問い合わせありがとうございました。\n\n";
        $main.="\n";
        $main.="お問い合わせ内容\n";
        $main.="---------------\n";
        $main.=$comment;
        $main.="\n";
        $main.="---------------\n";
        $main.="掲示板『Master of Engineer』管理人\n";
        $main.="メール sonsyu0103@yahoo.co.jp\n";

        /*print'<br>';
        print nl2br($main);*/

        //問合わせた人へのメール
        $title='お問い合わせありがとうございました。';
        $header='From: sonsyu0103@yahoo.co.jp';
        $main=html_entity_decode($main,ENT_QUOTES,'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail($email,$title,$main,$header);

        //管理人へのメール
        $title='お問い合わせがありました。';
        $header='From:'.$email;
        $main=html_entity_decode($main,ENT_QUOTES,'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail('sonsyu0103@yahoo.co.jp',$title,$main,$header);

      }catch(Exception $e){
        print'ただいま障害により大変ご迷惑をおかけしております。';
        exit;
      }

    ?>
    <a href="../main/keizi_top.php">トップへ戻る</a>
  </body>
</html>
