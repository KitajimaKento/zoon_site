<?php
//別ファイルに保存
require_once "resources/config.php";
require_once "resources/validation.php";
require_once "resources/functions.php";
require_once "resources/database.php";

// サニタイズ / サニタイズ初期化
$sanitized_post = sanitize($_POST);
//インスタンス化
$validation = new Validation($sanitized_post, $validation_conditions);
//サニタイズされたものを変数に格納
$name = $sanitized_post['name'];
$phonetic = $sanitized_post['phonetic'];
$prefecture = $sanitized_post['prefecture'];
$message = $sanitized_post['message'];
//ページのフラグ(初期値)
$page = Constants::CONTACT;
//確認ページ用
if(!empty($_POST["confirm_button"]) && !$validation->get_error_flag()) { //確認画面ボタン
  $page = Constants::CONFIRM;
} elseif(!empty($_POST["send_button"])) { //送信ボタン
  $page = Constants::THANKS;
  //二重送信防止の設定
  session_start();
  if(!empty($_SESSION['ticket']) && $_SESSION['ticket'] === true) {
    // セッションの削除
    unset($_SESSION['ticket']);
    //データベース(zoonlineのcontactsテーブル)に接続,データベースに入力値格納まで
    $db = new Database(DB_SQL,USER_NAME,PASSWORD,"contacts");
    $db->insert($sanitized_post);
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="あなたが出会った動物たちをアップロード！皆でオンラインの動物園を作りましょう！">
    <title>お問い合わせページ | zoonline</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/responsive.css">
  </head>
  <body>
    <header>
      <a href="index.html"><img src="images/logo.png" alt="zoonline"></a>
      <p>あなたが出会った動物達をアップロード !<br>皆で<strong>オンラインの動物園</strong>を作りましょう  !</p>
    </header>
    <nav>
      <ul class="menu-block">
        <li><a href="#">concept</a></li>
        <li class="pull-down">animals
          <ul class="pull-down-list">
            <li><a href="#">アシカ科</a></li>
            <li><a href="#">イタチ科</a></li>
            <li><a href="cat.html">ネコ科</a></li>
            <li><a href="#">ネズミ科</a></li>
            <li><a href="#">ヒト科</a></li>
            <li><a href="#">ハリネズミ科</a></li>
            <li><a href="#">マルクチ<br>サラマンダー科</a></li>
            <li><a href="#">マングース科</a></li>
            <li><a href="#">ヤマアラシ科</a></li>
            <li><a href="#">リス科</a></li>
            <li><a href="#">レッサーパンダ科</a></li>
          </ul>
        </li>
        <li><a href="#">upload</a></li>
        <li><a href="contact.php">contact</a></li>
      </ul>
    </nav>
    <!-- ページ n種類 -->
    <div class="content">
      <section>
      <?php
      switch($page) {
        case Constants::CONFIRM:
          // セッションの書き込み(二重送信防止)
          session_start();
          $_SESSION['ticket'] = true;
          include_once('templates/contact_confirm.php');
          break;
        case Constants::THANKS:
          include_once('templates/contact_thanks.php');
          break;
        case Constants::CONTACT;
          include_once('templates/contact_input.php');
          break;
      }
      ?>
      </section>
    </div>
    <footer>
      <p>Copyright &#169; 2014 <span>conol</span>. All Rights Reserved.</p>
    </footer>
  </body>
</html>
