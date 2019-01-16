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
			$id=$_GET['id'];
      $m_name=$_SESSION['m_name'];
      $email=$_SESSION['email'];
		?>

			<h2>会員情報修正</h2>
	    <div>会員ID:<?php print $id; ?></div><br>
		  <form method="post" action="member_edit_check.php">
        <input type="hidden" name="id" value="<?php print $id; ?>">
        <div>新しい会員名を入力してください。</div>
        <input type="text" name="m_name" value="<?php print $m_name; ?>">
        <div>新しいパスワードを入力してください。</div>
        <input type="password" name="pass">
        <div>新しいパスワードをもう一度入力してください。</div>
        <input type="password" name="pass2">
        <div>新しいメールアドレスを入力してください。</div>
        <input type="text" name="email" value="<?php print $email; ?>"><br><br>
			  <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
		  </form>
          <a href="../main/keizi_top.php">トップへ戻る</a>
		</body>
</html>
