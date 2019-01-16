<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Master of Engineer</title>
    <link rel="stylesheet" href="../common/common.css">
  </head>
  <body>
    <p>会員登録をお願いします。</p>
    <form method="post" action="member_add_check.php">
      <div>会員名を入力してください。</div>
      <input type="text" name="m_name">
      <div>パスワードを入力してください。</div>
      <input type="password" name="pass">
      <div>パスワードをもう一度入力してください。</div>
      <input type="password" name="pass2"><br>
      <div>メールアドレスを入力してください。</div>
      <input type="text" name="email"><br><br>
      <input type="button" onclick="history.back()" value="戻る">
      <input type="submit" value="OK">
    </form>
  </body>
</html>
