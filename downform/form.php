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
      $id=$_SESSION['id'];
      $m_name=$_SESSION['m_name'];
      $email=$_SESSION['email'];
    ?>
    <h1>お問い合わせ</h1>
    <p>ここでは掲示板におけるレスの削除要請などを始めとした、<br>
         管理人に様々なことを問い合わせることができます。</p>
    <form method="post" action="form_check.php">
      <input type="hidden" name="name" value="<?php print $m_name; ?>">
      <input type="hidden" name="email" value="<?php print $email; ?>">
      <p>お問い合わせ内容</p>
      <textarea name="comment" cols="50" rows="20"></textarea><br>
      <input type="submit" value="OK">
    </form>
    <a href="../main/keizi_top.php">トップへ戻る</a>
		</body>
</html>
