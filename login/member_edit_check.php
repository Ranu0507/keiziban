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
  </head>
  <body>
    <?php

      require_once('../common/common.php');
      $post=sanitize($_POST);

      $id=$_POST['id'];
      $m_name=$post['m_name'];
      $pass=$post['pass'];
      $pass2=$post['pass2'];
      $email=$post['email'];

      if($m_name==''){
        print'会員名が入力されていません<br>';
      }else{
        print'会員名：';
        print $m_name;
        print'<br>';
      }

      if($pass==''){
        print'パスワードが入力されていません<br>';
      }

      if($pass!=$pass2){
        print'パスワードが一致しません。<br>';
      }

      if(preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|',$email)==0){
        print'メールアドレスを正確に入力してください<br>';
      }else{
        print'メールアドレス：';
        print $email;
        print'<br>';
      }

      if($m_name==''||$pass==''||$pass!=$pass2||
          preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|',$email)==0){
        print'<form>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'</form>';
      }else{
        print'以下の情報でよろしいですか？よろしければ「OK」を';
        print'修正する場合は「戻る」をクリックしてください。';
        print'<form method="post" action="member_edit_done.php">';
        print'<input type="hidden" name="id" value="'.$id.'">';
        print'<input type="hidden" name="m_name" value="'.$m_name.'">';
        print'<input type="hidden" name="pass" value="'.$pass.'">';
        print'<input type="hidden" name="email" value="'.$email.'">';
        print'<br>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input type="submit" value="OK">';
        print'</form>';
      }

    ?>
  </body>
</html>
