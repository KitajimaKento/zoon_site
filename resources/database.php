<?php
require_once 'resources/config.php';

class Database {
  private $pdo;
  private $table_name;
  //呼び出し時にデータベースに接続
  public function __construct($db_sql, $user_name, $password, $table_name) {
    $this->pdo = new PDO($db_sql, $user_name, $password);
    $this->table_name = $table_name;
  }

  //SQL書き込みメソッド
  public function insert($input) {
    try
    {
      //初期化
      $columns_list = "";
      $placeholders = "";
      //現在時刻のデータ取得,$inputに追加
      date_default_timezone_set('Asia/Tokyo');
      $time = date("Y-m-d H:i:s");
      $input = array_merge($input, array("created_at"=>$time));
      $input = array_merge($input, array("updated_at"=>$time));
      //送られてきたデータから差分を取り,不要なデータを摘出
      $diff = $this->get_diff($input);
      //クエリ文をループで作成
      foreach($input as $key => $value) {
        if($key === $diff)continue;
        $columns_list .= $key.",";
        $placeholders .= ":".$key.",";
      }
      //末尾の,を削除
      $columns_list = rtrim($columns_list, ',');
      $placeholders = rtrim($placeholders, ',');
      //クエリ文へ代入
      $sql = "INSERT INTO $this->table_name($columns_list) VALUES($placeholders)";
      $stmt = $this->pdo->prepare($sql);
      //値をループでbindValueする
      foreach($input as $key => $value) {
        if($key === $diff)continue;
        $stmt->bindValue(":".$key, $value, PDO::PARAM_STR);
      }
      $stmt->execute();
    }
    //例外処理
    catch(PDOException $e)
    {
      get_catch_content("データベースに書き込みできませんでした");
    }
  }

  //DBテーブルのカラム名を取得するメソッド
  private function get_column_names() {
    try
    {
      $sql = $this->get_select_query();
      $stmt = $this->pdo->query($sql);
      for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $column_names[] = $stmt->getColumnMeta($i)['name'];
      }
      return $column_names;
    }
    //例外処理
    catch(PDOException $e)
    {
      get_catch_content("カラム名を取得できませんでした");
    }
  }

  //差分を取得するメソッド
  private function get_diff($input) {
    $db_column_array = $this->get_column_names(); //DBのテーブルのカラム名を取得
    $db_column_name = [];
    $input_key = [];

    $count = count($db_column_array);
    for($i=1; $i<$count; $i++) { //入力値の個数を数える
      $db_column_name[] = $db_column_array[$i];
    }
    foreach($input as $key => $value) { //入力値のkey名を取得
      $input_key[] = $key;
    }
    $array_diff_extracted = array_diff($input_key, $db_column_name); //差分を抽出
    foreach($array_diff_extracted as $value) {
      $diff = $value;
    }
    return $diff;
  }

  //データベースの内容を表示するためのメソッド
  public function load() {
    try
    {
      $sql = $this->get_select_query($this->table_name);
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $row = $stmt->fetchAll();
      return $row;
    }
    //例外処理
    catch(PDOException $e)
    {
      get_catch_content("データベースを取得できませんでした");
    }
  }

  //データベースの内容を削除するメソッド
  public function delete($id) {
    try
    {
      $sql = "DELETE FROM $this->table_name WHERE id='$id'";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
    }
    //例外処理
    catch(PDOException $e)
    {
      get_catch_content("データを取得できませんでした");
    }
  }

  //select * from を返す関数
  private function get_select_query() {
    return "SELECT * FROM $this->table_name";
  }

  //データベースのサーチメソッド
  public function search($input) {
    try
    {
      $target_data = "";
      foreach($input as $column => $input_value) {
        $sql = "SELECT * FROM $this->table_name WHERE $column = '$input_value'";
      }
      $stmt = $this->pdo->query($sql);
      $target_data = $stmt->fetch(PDO::FETCH_ASSOC);
      return $target_data;
    }
    //例外処理
    catch(PDOException $e)
    {
      get_catch_content("データを取得できませんでした");
    }
  }

  //catchの中身のメソッド
  private function get_catch_content($message) {
    return print $message.$e->getMessage(); exit();
  }
}
