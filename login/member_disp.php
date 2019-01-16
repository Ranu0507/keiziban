<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print'ログインされていません<br>';
    print'<a href="../login/login.php">ログイン場面へ</a>';
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
			$id=$_GET['id'];
			$m_name=$_SESSION['m_name'];
			$email=$_SESSION['email'];
		?>
		<h2>マイページ</h2>
      <p>会員ID:<?php print $id; ?></p>
      <p>会員名:<?php print $m_name; ?></p>
      <p>メールアドレス:<?php print $email; ?></p>
		  <form method="get" action="member_edit.php">
			  <input type="button" onclick="history.back()" value="戻る">
        <input type="hidden" name="id" value="<?php print $id; ?>">
        <input type="submit" value="会員情報修正">
		  </form>
      <a href="../main/keizi_top.php">トップへ戻る</a>
		</body>
</html>
