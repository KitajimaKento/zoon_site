<?php
require_once "resources/config.php";
require_once "resources/validation.php";
require_once "resources/functions.php";
require_once "resources/database.php";

//セッション開始
session_start();
//ログアウトボタンを押したならば
if(!empty($_POST["logout"])) {
  //セッションを初期化し,セッションを破棄
  $_SESSION = [];
  session_destroy();
}
//トークンをセッションに追加
$_SESSION["login_token"] = get_csrf_token();
$_SESSION["delete_token"] = get_csrf_token();
//データベース接続
$contacts = new Database(DB_SQL,USER_NAME,PASSWORD,"contacts");
//削除ボタンが押された且つトークンが取得できたならばDBからデータ消す
if(!empty($_POST["btn-delete"]) && isset($_POST["delete-token"])) {
  $contacts->delete($_POST["id"]);
}
//サニタイズデータ初期化
$sanitized_login_post = null;
//ログイン入力値サニタイズ
if(!empty($_POST["btn-login"])) {
  $sanitized_login_post = sanitize($_POST);
}
//インスタンス化
$validation = new Validation($sanitized_login_post,$validation_login_conditions);
//ハッシュ値にてパスワードの比較,確認
if(!empty($_POST["btn-login"]) && !$validation->get_error_flag()) {
  //DB接続
  $admins = new Database(DB_SQL,USER_NAME,PASSWORD,"admins");
  //入力されたパスワード
  $input_password = $sanitized_login_post["password"];
  //DBのメールアドレスを検索(カラム名,入力されたemailが引数)
  $db_password = $admins->search(array("email" => $_POST["email"]));
  //入力値とハッシュ値の比較成功且つログイントークンが有るならば
  if(password_verify($input_password, $db_password["passward_digest"]) && !empty($_POST["login-token"]) && $_POST["login-token"] != $_SESSION["login_token"]) {
    $_SESSION["login"] = true;
  } else {
    $login_error = "ログインに失敗しました。メールアドレスパスワードをご確認ください。";
  }
}

//定数による条件分岐
//初期値
$page = Constants::LOGIN_FORM;
//ログイン状態の条件
if(!empty($_SESSION["login"])) {
  $page = Constants::LOGIN_PAGE;
} else {
  $page = Constants::LOGIN_FORM;
}
?>

<!DOCTYPE html>
<?php
//ログイン条件を満たしていれば管理者ページへ,そうでなければフォームへ
if($page === Constants::LOGIN_PAGE) {
  include("templates/admin_login_page.php");
} elseif($page === Constants::LOGIN_FORM) {
  include("templates/admin_login_form.php");
}
?>
