<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="あなたが出会った動物たちをアップロード！皆でオンラインの動物園を作りましょう！">
    <title>ログイン | zoonline</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/login.css">
  </head>
 <body>
   <div class="content">
     <img src="images/logo.png" alt="zoonline">
     <p class="login">ログインフォーム</p>
     <form class="login-form" method="POST">
       <!-- メールアドレス入力 -->
       <input type="text" class="input-form <?php if($validation->exists_error("email")) { echo "red-border"; }?>" name="email" value="<?php if( !empty($_POST['email']) ){ echo $_POST['email']; } ?>" placeholder="メールアドレス" >
       <?php if($validation->exists_error("email")): ?>
       <p class="red"><?= $validation->get_error_message("email"); ?></p>
       <?php endif ?>
       <br>
       <!-- パスワード入力 -->
       <input type="password" name="password" class="input-form <?php if($validation->exists_error("password")) { echo "red-border"; }?>" placeholder="パスワード">
       <?php if($validation->exists_error("password")): ?>
       <p class="red"><?= $validation->get_error_message("password"); ?></p>
       <?php endif ?>
       <br>
       <!-- エラーメッセージ表示 -->
       <p class="login_error"><?php if(isset($login_error)) { echo $login_error; } ?></p>
       <input type="hidden" name="login-token" value="<?= $_SESSION["login_token"]; ?>" >
       <input type="submit" class="btn-login" name="btn-login" value="ログイン">
     </form>
   </div>
 </body>
</html>
