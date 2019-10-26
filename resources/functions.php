<?php
//サニタイズの処理の条件分岐
function sanitize($input) {
  // ボタンを押してないときの初期化
  if(!$input) {
    return; //初期画面ならそのまま返す。
  } else {
    foreach($input as $key => $value ) { //ボタンを押した時点で、サニタイジングのループ
     $input[$key] = htmlspecialchars($value, ENT_QUOTES); //配列を作成
   }
   return $input; //配列を返す
  }
}
//inputのvalueの部分が空でないか確認
function add_input_value($value) {
  if($value) {
    return "value=".$value;
  }
}

//32バイトのCSRFトークンを作成
function get_csrf_token() {
  $TOKEN_LENGTH = 16;
  $bytes = openssl_random_pseudo_bytes($TOKEN_LENGTH);
  return bin2hex($bytes);
}
?>
