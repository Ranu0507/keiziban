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

      //  $m_name=$post['m_name'];
        //$pass=$post['pass'];
        //$email=$post['email'];

        $hash=password_hash($_POST['pass'],PASSWORD_BCRYPT);

        require_once("../mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);

        $sql="INSERT INTO member(id,m_name,pass,email)
              VALUES('',:m_name,:pass,:email)";
        $stmt=$s->prepare($sql);
        $stmt->bindValue(':m_name',$_REQUEST['m_name'],PDO::PARAM_STR);
        $stmt->bindValue(':pass',$hash,PDO::PARAM_STR);
        $stmt->bindValue(':email',$_REQUEST['email'],PDO::PARAM_STR);
        $stmt->execute();

        $m_name=$_REQUEST['m_name'];
        print'登録ありがとうございます。';
        print $m_name;
        print'さんを追加しました。<br>';
        print'お手数ですが、ログイン画面よりログインしてから掲示板をご利用ください。<br>';
        print'<a href="login.php">ログイン画面へ</a><br>';

      }catch(Exception $e){
        print'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>

  </body>
</html>
