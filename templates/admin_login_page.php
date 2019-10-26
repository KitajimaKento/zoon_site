<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="あなたが出会った動物たちをアップロード！皆でオンラインの動物園を作りましょう！">
    <title>管理者ページ | zoonline</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>

    <header>
      <a href="index.html"><img src="images/logo.png" alt="zoonline"></a>
      <p>あなたが出会った動物達をアップロード !<br>皆で<strong>オンラインの動物園</strong>を作りましょう !</p>
    </header>

    <nav>
      <p>管理者ページ(ログイン中)</p>
    </nav>

    <div class="content">
        <p>☆投稿一覧☆</p>
          <table class="db_table">
            <tr>
              <th>id</th>
              <th>お名前</th>
              <th>ふりがな</th>
              <th>都道府県</th>
              <th>メッセージ</th>
              <th>日時</th>
            <tr>
          <?php foreach($contacts->load() as $value): ?>
            <tr>
              <td><?= $value["id"]?></td>
              <td><?= $value["name"]?></td>
              <td><?= $value["phonetic"]?></td>
              <td><?= $value["prefecture"]?></td>
              <td><?= $value["message"]?></td>
              <td><?= $value["created_at"]?></td>
              <td>
              <form method="POST">
              <input type="hidden" name="id" value="<?= $value["id"]?>">
              <input type="hidden" name="delete-token" value="<?= $_SESSION["delete_token"]; ?>" >
              <input type="submit" name="btn-delete" value="削除">
              </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </table>
          <form class="logout" method="POST">
          <input type="submit" name="logout" value="ログアウト">
          </form>
    </div>
<!-- ヘッダー -->
    <footer>
      <p>Copyright &#169; 2014 <span>conol</span>. All Rights Reserved.</p>
    </footer>
  </body>
</html>
