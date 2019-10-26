<!-- 都道府県 -->
<?php
  $prefectures = [
    "北海道",
    "青森県",
    "秋田県",
    "岩手県",
    "山形県",
    "宮城県",
    "福島県",
    "山梨県",
    "長野県",
    "新潟県",
    "富山県",
    "石川県",
    "福井県",
    "茨城県",
    "栃木県",
    "群馬県",
    "埼玉県",
    "千葉県",
    "東京都",
    "神奈川県",
    "愛知県",
    "静岡県",
    "岐阜県",
    "三重県",
    "大阪府",
    "兵庫県",
    "京都府",
    "滋賀県",
    "奈良県",
    "和歌山県",
    "岡山県",
    "広島県",
    "鳥取県",
    "島根県",
    "山口県",
    "徳島県",
    "香川県",
    "愛媛県",
    "高知県",
    "福岡県",
    "佐賀県",
    "長崎県",
    "熊本県",
    "大分県",
    "宮崎県",
    "鹿児島県",
    "沖縄県",
  ];

  //多次元配列にて空,かな文字,文字数を管理
  $validation_conditions = [
    //$key
    "name" => [ //$conditions
            //$condition_name
            "max_length" => 10,
            "required" => true
     ],
    "phonetic" => [
            "max_length" => 20,
            "furigana" => true,
            "required" => true
     ],
    "prefecture" => [
             "select" => "選択してください"
     ],
    "message" => [
            "max_length" => 1000,
            "required" => true
     ]
  ];

  //ログイン情報の条件
  $validation_login_conditions = [
    //$key
    "email" => [ //$conditions
            //$condition_name
            "max_length" => 255,
            "email" => true,
            "required" => true
     ],
    "password" => [
            "min_length" => 7,
            "max_length" => 255,
            "required" => true
     ]
  ];

  //ページの切り替えのための定数
  class Constants {
   const CONTACT = 0;
   const CONFIRM = 1;
   const THANKS = 2;
   const LOGIN_PAGE = 3;
   const LOGIN_FORM = 4;
  }

 //データベース関連
  define("DB_SQL", "mysql:host=127.0.0.1; dbname=zoonline; charset=utf8");
  define("USER_NAME","root");
  define("PASSWORD","");
