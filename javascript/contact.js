function validate(e) {
  var errorCount = 0;
  const $form_object = e.target.elements;//ダイレクトにtargetの部分だけ取得する。
  const $form_array = Object.keys($form_object).map(function (key) {return form[key]});//objectをarrayに変換

  $form_array.forEach(function(field) {
    
    //上記宣言の e.target.elements にて、inputを全て取得してるので下記ifにてsubmitの値を取得し条件外の場合、初期化の関数を実行する。
    if(field.type !== 'submit') {
      initializeErrorMessage(field);
    }

    switch(field.id) {
      case 'name':
        if(checkBlankError(field) || checkCountError(field,10)) {
          errorCount++;
        }
        break;

      case 'namekana':
        if(checkBlankError(field) || checkKanaError(field) || checkCountError(field,20)) {
          errorCount++;
        }
        break;

      case 'prefecture':
        if(checkSelectError(field)) {
          errorCount++;
        }
        break;

      case 'text':
        if(checkBlankError(field) || checkCountError(field,1000)) {
          errorCount++;
        }
        break;

      default:
        if(errorCount == 0) {
          alert('正常に入力されました。送信します。');
          window.open('index.html');
        } else {
          e.preventDefault(); //addEventListenerによるreturn falseの代役
        }
        break;
    }
  });
}

// ------------------------------------------------------------------------------------
//formのonsubmitをJSで表現。
const form = document.querySelector('.contact-form');
form.addEventListener('submit', validate);
// ------------------------------------------------------------------------------------
//未入力のときの処理
function checkBlankError(field) {
  if(field.value == '') {
    outputErrorMessage(field,'必須項目です');
    return true;
  }
  return false;
}

//文字数オーバーのときの処理
function checkCountError(field,max_count) {
  if(field.value.length > max_count) {
    outputErrorMessage(field, max_count + '文字以内で入力してください');
    return true;
  }
  return false;
}

//かな文字以外が入力されたときの処理
function checkKanaError(field) {
  if(!field.value.match(/^[ぁ-んー　]*$/)) {
    outputErrorMessage(field,'ひらがなで入力してください');
    return true;
  }
  return false;
}

//selectで選択していないときの処理
function checkSelectError(field) {
  if(field.value == '選択してください') {
    outputErrorMessage(field,'選択してください');
    return true;
  }
  return false;
}
// ------------------------------------------------------------------------------------
//未入力時、エラーメッセージの出力
function outputErrorMessage(field,error_message) {
  // 赤枠にする
  field.style.border = '1px solid rgb(205,50,50)';
  //各種エラーメッセージ
  field.nextElementSibling.innerHTML = error_message;
  // display:blockにして表示させる
  field.nextElementSibling.style.display = 'block';
}

//問題ないときの初期化の処理
function initializeErrorMessage(field) {
  // 問題ない場合は元の要素を埋め込み元通りにする
  field.style.border = '1px solid rgb(204,204,204)';
  field.nextElementSibling.style.display = 'none';
}
