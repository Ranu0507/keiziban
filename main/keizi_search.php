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
    <h1>レス検索</h1>
    <hr>
    <h2>スレッド一覧</h2>
    <?php

      try{
        require_once("../mysql_data/db_info.php");
        $s=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);

        $search=isset($_GET['search'])? htmlspecialchars($_GET['search']):null;

        if($search<>''){
          $re=$s->query("SELECT R.res,R.name,R.mess,R.pic,S.sure_name
                         FROM resu AS R JOIN sure AS S ON R.code=S.code
                         WHERE R.mess LIKE '%$search%'");

          while($kekka=$re->fetch()){
            print"$kekka[0]:$kekka[1]:$kekka[2]:($kekka[4])";
            $pic_name=$kekka[3];
            if($pic_name==''){
              $disp_pic='';
            }else{
                $disp_pic='<img src="../picture/'.$kekka[3].'">';
                print'<br>';
                print $disp_pic;
            }
            print"<br><br>";
          }

        }

      }catch(Exception $e){
        print'ただいま障害により大変ご迷惑をおかけしております。';
        exit();
      }

    ?>
    <hr>
    <h2>スレッド作成</h2>
    <p>メッセージに含まれる文字を入力してください</p>
    <form method="GET" action="keizi_search.php">
    <p>検索する文字列</p>
    <input type="text" name="search">
    <input type="submit" value="検索">
    </form>
    <br>
    <a href="keizi_top.php">スレッド一覧に戻る</a>
    <hr>
  </body>
</html>
