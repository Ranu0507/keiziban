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

      require_once('../common/common.php');
      $post=sanitize($_POST);

      $name=$_POST['name'];
      $email=$_POST['email'];
      $comment=$post['comment'];

      print'お名前:';
      print $name;
      print'<br>';
      print'メールアドレス:';
      print $email;
      print'<br>';
      if($comment==''){
        print'お問い合わせ内容が書かれていません<br>';
        print'<a href="form.php">戻る</a>';
      }else{
        print'お問い合わせ内容：';
        print $comment;
        print'<br><br>';

        print'上記の内容でよければ「OK」のボタンを<br>';
        print'修正する場合は「戻る」のボタンを押してください<br>';
        print'<form method="post" action="form_done.php">';
        print'<input type="hidden" name="comment" value="'.$comment.'">';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input type="submit" value="OK">';
        print'</form>';
      }
    ?>
  </body>
</html>
