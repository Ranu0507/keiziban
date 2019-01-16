<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print'ログインされていません<br>';
    print'<a href="../login/login.html">ログイン場面へ</a>';
    exit();
  }

  require_once("../../../../xampp/mysql/mysql_data/db_info.php");
  $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);
  $id=$_SESSION['id'];

  //スレの作成。
  $sure=isset($_GET['sure'])? htmlspecialchars($_GET['sure']):null;

  //elseだとレスの書き込みの時にも反応するのでわけています。
  if($sure==''){
    header('Location: keizi_top.php');
  }

  if($sure<>''){
    $s->query("INSERT INTO sure VALUES (0,'$sure',now(),'$id')");
    header('Location: keizi_top.php');
  }

  //レスの書き込み。
  $code=$_POST['code'];
  $name=isset($_POST['name'])? htmlspecialchars($_POST['name']):null;
  $mess=isset($_POST['mess'])? htmlspecialchars($_POST['mess']):null;
  $pic=isset($_FILES['pic'])? $_FILES['pic']:null;

  if($name==''){
    header('Location: keizi.php?code='.$code);
  }

  //上手くできなかった戒めのために正規表現を残しています。いずれ上手に扱います。
  if($pic['size']>0){
    if($pic['size']>1000001){//||preg_match("/^[0-9a-zA-Z._-]+$/",$pic['name'])==false){
      header('Location: pic_out.php');
      exit;
    }else{
      move_uploaded_file($pic['tmp_name'],'../picture/'.$pic['name']);
    }
  }

  //"も'使って$pic['name']が使えないので、入れ直しました。
  if($name<>''){
    $pic=$pic['name'];
    $s->query("INSERT INTO resu
               VALUES (0,'$name','$mess','$pic',now(),$code,'$id')");
    header('Location: keizi.php?code='.$code);
  }
?>
