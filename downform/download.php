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
		<?php
      require_once("../common/common.php")
		?>
    <h1>ダウンロード</h1>
      <p>ここでは指定した日付のレスをCSVファイルでダウンロードできます。<br>
           なお、画像はダウンロードできませんのでご了承ください。</p>
      <form method="post" action="download_done.php">
        <?php pulldown_year(); ?>
        年
        <?php pulldown_month(); ?>
        月
        <?php pulldown_day(); ?>
        日<br>
        <input type="submit" value="ダウンロードへ">
      </form>
      <a href="../main/keizi_top.php">トップへ戻る</a>
		</body>
</html>
