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
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Mincho" rel="stylesheet">
  </head>
  <body>
    <?php

      try{
        require_once("../mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);
        $m_name=$_SESSION['m_name'];

        $code=$_GET['code'];

        if(preg_match("/[^0-9]/",$code)){
          print'不正な値が入力されています<br>';
          print'<a href="keizi_top.php">';
          print'ここをクリックしてスレッド一覧に戻ってください。</a>';

        }elseif(preg_match("/[0-9]/",$code)){
        $re=$s->query("SELECT sure_name FROM sure WHERE code=$code");
        $kekka=$re->fetch();
        $sure_com="「".$code.":".$kekka[0]."」";
        print'<h1>';
        print $sure_com;
        print'スレッド</h1>';
        print'<h2>';
        print $sure_com;
        print'のレス一覧</h2>';
        print'<hr>';

        $re=$s->query("SELECT * FROM resu WHERE code=$code ORDER BY time");

        $i=1;
        while($kekka=$re->fetch()){
          print "$i:$kekka[1]:$kekka[4]<br>";
          print nl2br($kekka[2]);
          $pic_name=$kekka[3];
          if($pic_name==''){
            $disp_pic='';
          }else{
              $disp_pic='<img src="../picture/'.$kekka[3].'">';
              print'<br>';
              print $disp_pic;
          }
          print'<br><br>';
          $i++;
        }

        //いくらなんでもゴリ押しが酷すぎますね。反省です。
        print'<hr>';
        print $sure_com;
        print'に、メッセージを書くときはこちらからどうぞ';
        print'<form method="POST" action="keizi_resu.php" enctype="multipart/form-data">';
        print'名前<br>';
        print'<input type="text" name="name" value="';
        print $m_name;
        print'"><br>';
        print'メッセージ<br>';
        print'<textarea name="mess" row="10" cols="70"></textarea><br>';
        print'画像を選択してください(ファイル名は英数字のみかつ１Ｍ以下のサイズでお願いします)<br>';
        print'<input type="file" name="pic" style="width:400px">';
        print'<input type="hidden" name="code" value=';
        print $code;
        print'><br>';
        print'<input type="submit" value="送信">';
        print'</form>';
        print'<hr>';
        print'<a href="keizi_top.php">スレッド一覧に戻る</a>';

        //$codeに数字も数字以外も含まれていない場合です。
        }else{
          print'スレッドを選択してください。<br>';
          print'<a href="keizi_top.php">';
          print'ここをクリックしてスレッド一覧に戻ってください</a>';
        }

      }catch(Exception $e){
        print'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>
  </body>
</html>
