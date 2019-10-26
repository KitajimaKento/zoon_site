<?php
//クラス表現
Class Validation {
  private $error_message = [];
  private $error_flag = false;
  //コンストラクタ
  public function __construct($sanitized_data, $validation_conditions) {
    //初期画面や値がnullならば返す
    if($sanitized_data === null) {
      return;
    }
    $this->check($sanitized_data, $validation_conditions);
  }

//チェックする関数
  private function check($check_value, $validation_conditions) {
    //foreachにより$validation_conditionsのarrayを取得。その後中のarrayを取得するためもう一度foreachする
    foreach($validation_conditions as $key => $conditions) {
      foreach($conditions as $condition_name => $condition_value) {
        switch($condition_name) {
          case "required":
            $this->check_required($check_value[$key], $key);
            break;
          case "max_length":
              $this->check_max_length($check_value[$key], $condition_value, $key);
              break;
          case "min_length":
                $this->check_min_length($check_value[$key], $condition_value, $key);
                break;
          case "furigana":
            $this->check_furigana($check_value[$key], $key);
            break;
          case "select":
            $this->check_select($check_value[$key], $key);
            break;
          case "email":
            $this->check_mail($check_value[$key], $key);
            break;
          default:
            break;
        }
      }
    }
  }

  //空チェック
  private function check_required($check_value, $key) {
    if(empty($check_value)) {
      $this->add_error_message($key, "必須項目です");
      $this->error_flag = true;
    }
  }

  //文字数チェック(最大の値)
  private function check_max_length($check_value, $length, $key) {
    if($length < mb_strlen($check_value)) {
      $this->add_error_message($key, "{$length}字以内で入力してください");
      $this->error_flag = true;
    }
  }
  //文字数チェック(最小の値)
  private function check_min_length($check_value, $length, $key) {
    if($length > mb_strlen($check_value)) {
      $this->add_error_message($key,"{$length}文字以上で入力してください");
      $this->error_flag = true;
    }
  }

  //ふりがなチェック
  private function check_furigana($check_value, $key) {
    if(!preg_match("/^[ぁ-んー]*$/", $check_value)) {
      $this->add_error_message($key, "ひらがなで入力してください。");
      $this->error_flag = true;
    }
  }

  //セレクトチェック
  private function check_select($check_value, $key) {
    if($check_value === '選択してください') {
      $this->add_error_message($key, "選択してください");
      $this->error_flag = true;
    }
  }

  //メールチェック
  private function check_mail($check_value, $key) {
    if(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD',$check_value)) {
      $this->add_error_message($key,"メールアドレスの形式が不正です");
      $this->error_flag = true;
    }
  }

  //エラーメッセージの代入する関数
  private function add_error_message($key, $message) {
    return $this->error_message[$key] = $message;
  }

  // エラー配列のゲッター
  public function get_error_message($key) {
    return $this->error_message[$key];
  }

  // フラグのゲッター
  public function get_error_flag() {
    return $this->error_flag;
  }

  //エラーメッセージ分岐のためのBooleanゲッター
  public function exists_error($key) {
    return isset($this->error_message[$key]);
  }
}
?>
