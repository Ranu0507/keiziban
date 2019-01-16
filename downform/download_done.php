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

      require_once("../common/common.php");
      require_once("../../../../xampp/mysql/mysql_data/db_info.php");
      $dbh=new PDO("mysql:host=$SERV;dbname=$DBNAME",$USER,$PASS);
      $dbh->query('SET NAMES utf8');

      $year=$_POST['year'];
      $month=$_POST['month'];
      $day=$_POST['day'];

      $sql='
      SELECT
        s.code,
        s.sure_name,
        r.name,
        r.mess,
        r.time
      FROM resu AS r,sure AS s
      WHERE r.code=s.code
        AND substr(r.time,1,4)=?
        AND substr(r.time,6,2)=?
        AND substr(r.time,9,2)=?
      ';

      $stmt=$dbh->prepare($sql);
      $data[]=$year;
      $data[]=$month;
      $data[]=$day;
      $stmt->execute($data);

      $csv='スレッド番号,スレッド名,レス投稿者名,レス内容,レス投稿時間';
      $csv.="\n";
      while(true){
        $rec=$stmt->fetch(PDO::FETCH_ASSOC);
        if($rec==false){
          break;
        }
        $csv.=$rec['code'];
        $csv.=',';
        $csv.=$rec['sure_name'];
        $csv.=',';
        $csv.=$rec['name'];
        $csv.=',';
        $csv.=$rec['mess'];
        $csv.=',';
        $csv.=$rec['time'];
        $csv.="\n";
      }

      //print nl2br($csv);
      $file=fopen('./res.csv','w');
      $csv=mb_convert_encoding($csv,'SJIS','UTF-8');
      fputs($file,$csv);
      fclose($file);

		?>
    <a href="res.csv">レスのダウンロード</a><br><br>
    <a href="download.php">日付選択へ</a><br><br>
    <a href="../main/keizi_top.php">トップへ戻る</a><br>
		</body>
</html>
