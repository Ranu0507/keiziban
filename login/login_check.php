<?php

  try{

    require_once('../common/common.php');
    $post=sanitize($_POST);
    $member=$post['member'];
    $pass=$post['pass'];
    $pass=md5($pass);

    require_once("../../../../xampp/mysql/mysql_data/db_info.php");
    $dbh=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);
    $dbh->query("SET NAMES utf8");

    $sql="SELECT id,email FROM member WHERE m_name=? AND pass=?";
    $stmt=$dbh->prepare($sql);
    $data[]=$member;
    $data[]=$pass;
    $stmt->execute($data);

    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    if($rec==false){
      print'登録名かパスワードが間違っています。<br>';
      print'<a href="login.html">戻る</a>';
    }else{
      session_start();
      $_SESSION['login']=1;
      $_SESSION['id']=$rec['id'];
      $_SESSION['m_name']=$member;
      $_SESSION['email']=$rec['email'];
      header('Location: ../main/keizi_top.php');
    }

  }catch(Exception $e){
    print'ただいま障害により大変ご迷惑をおかけしております。';
    exit;
  }
?>
