<?php

  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print'ログインされていません<br>';
    print'<a href="../login/login.php">ログイン場面へ</a>';
    exit();
  }

  require_once("../mysql_data/db_info.php");
  $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);
  $id=$_SESSION['id'];

  //スレの作成。
  $sure=isset($_GET['sure'])? htmlspecialchars($_GET['sure']):null;

  //elseだとレスの書き込みの時にも反応するのでわけています。
  if($sure==''){
    header('Location: keizi_top.php');
    exit();
  }else{
    $s->query("INSERT INTO sure VALUES (0,'$sure',now(),'$id')");
    header('Location: keizi_top.php');
    exit();
  }

?>
