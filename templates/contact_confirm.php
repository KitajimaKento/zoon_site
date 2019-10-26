<form class="contact-form" action= "" method="post">
  <table class="contact">
    <p class="confirmation">この入力内容でよろしいでしょうか？</p>
    <tr>
      <td class="contact-input-title">お名前</td>
      <td class="contact-input">
        <?= $name ?>
      </td>
    </tr>
    <tr>
      <td class="contact-input-title">ふりがな</td>
      <td class="contact-input">
        <?= $phonetic; ?>
      </td>
    </tr>
    <tr class="contact-prefectures">
      <td class="contact-input-title">都道府県</td>
      <td class="contact-input">
        <?= $prefecture; ?>
      </td>
    </tr>
    <tr>
      <td class="contact-messagebox">メッセージ</td>
      <td class="contact-input-textarea">
        <?= $message; ?>
      </td>
    </tr>
  </table>
  <div class="contact-button">
    <form action="contact_thanks.php" method="post">
      <input type="hidden" name="name" value="<?= $name ?>">
      <input type="hidden" name="phonetic" value="<?= $phonetic ?>">
      <input type="hidden" name="prefecture" value="<?= $prefecture ?>">
      <input type="hidden" name="message" value="<?= $message ?>">
      <input class="contact-back-button" type="submit" name="back_button" value="戻る">
      <input type="submit" name ="send_button" value="送信する">
    </form>
  </div>
</form>
