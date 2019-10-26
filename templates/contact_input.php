<form class="contact-form" action= "" method="post">
  <table class="contact">
    <tr>
      <td class="contact-input-title">お名前</td>
      <td class="contact-input">
        <!-- 入力欄 -->
        <input class="<?php if($validation->exists_error("name")) { echo "red-border"; } ?>" type="text" name="name" size="20" placeholder="コノルるの子" <?= add_input_value($name); ?>>
        <!-- エラー処理 -->
        <?php if($validation->exists_error("name")): ?>
        <p class="red"><?= $validation->get_error_message("name"); ?></p>
        <?php endif ?>
      </td>
    </tr>
    <tr>
      <td class="contact-input-title">ふりがな</td>
      <td class="contact-input">
        <!-- 入力欄 -->
        <input class="<?php if($validation->exists_error("phonetic")) { echo "red-border"; } ?>" type="text" name="phonetic" size="20" placeholder="このるるのこ" <?= add_input_value($phonetic); ?>>
        <!-- エラー処理 -->
        <?php if($validation->exists_error("phonetic")): ?>
        <p class="red"><?= $validation->get_error_message("phonetic"); ?></p>
        <?php endif ?>
      </td>
    </tr>
    <tr class="contact-prefectures">
      <td class="contact-input-title">都道府県</td>
      <td class="contact-input">
        <div class="triangle">
          <!-- 入力欄 -->
          <select class="<?php if($validation->exists_error("prefecture")) { echo "red-border"; } ?>" name="prefecture">
            <option selected value="選択してください">選択してください</option>
            <?php foreach($prefectures as $value): ?>
            <option <?php if($prefecture === $value){ echo 'selected'; } ?>><?= $value; ?></option>
            <?php endforeach ?>
          </select>
          <!-- エラー処理 -->
          <?php if($validation->exists_error("prefecture")): ?>
          <p class="red"><?= $validation->get_error_message("prefecture"); ?></p>
          <?php endif ?>
        </div>
      </td>
    </tr>
    <tr>
      <td class="contact-messagebox">メッセージ</td>
      <td class="contact-input-textarea">
        <!-- 入力欄 -->
        <textarea class="<?php if($validation->exists_error("message")) { echo "red-border"; } ?>" size="15" name="message" rows="15" cols="70"><?= $message; ?></textarea>
        <!-- エラー処理 -->
        <?php if($validation->exists_error("message")): ?>
        <p class="red"><?= $validation->get_error_message("message") ?></p>
        <?php endif ?>
      </td>
    </tr>
  </table>
  <div class="contact-button"><input type="submit" name="confirm_button" value="確認画面へ"></div>
</form>
