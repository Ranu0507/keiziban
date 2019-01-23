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
        print'<form method="post" action="member_add_done.php">';
        print'<input type="hidden" name="m_name" value="'.$m_name.'">';
        print'<input type="hidden" name="pass" value="'.$pass.'">';
        print'<input type="hidden" name="email" value="'.$email.'"><br>';
        print'<input type="button" onclick="history.back()" value="戻る">';
        print'<input type="submit" value="OK">';
        print'</form>';
      }

    ?>
  </body>
</html>
