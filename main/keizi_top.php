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
    <h1>掲示板『Master of Engineer』</h1>
    <p>掲示板『Master of Engineer』にようこそ。<br>
       見たいスレッドをクリックして、楽しくご利用くださいね。</p>
    <hr>
    <h2>お知らせ</h2>
    <p>現在お知らせはありません</p>
    <hr>
    <h2>スレッド一覧</h2>
    <?php

      try{
        require_once("../../../../xampp/mysql/mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);

        $re=$s->query("SELECT * FROM sure");
        while($kekka=$re->fetch()){
          print'<a href="keizi.php?code=';
          print $kekka[0];
          print'">';
          print $kekka[0];
          print':';
          print $kekka[1];
          print'</a><br>';
          print $kekka[2];
          print'作成<br><br>';
        }

      }catch(Exception $e){
        print'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>
    <hr>
    <h2>スレッド作成</h2>
    <p>新しいスレッドを作るときはこちらでどうぞ</p>
    <form method="GET" action="keizi_branch.php">
      <p>新しく作るスレッドのタイトル</p>
      <input type="text" name="sure" size="50">
      <input type="submit" value="作成">
    </form>
    <hr>
    <h2>レス検索</h2>
    <a href="keizi_search.php">検索するときはここをクリック</a>
    <hr>
    <h2>ダウンロード</h2>
    <a href="../downform/download.php">レスをダウンロードするときはここをクリック</a>
    <hr>
    <h2>お問い合わせ</h2>
    <a href="../downform/form.php">削除依頼等はここをクリック</a>
  </body>
</html>
