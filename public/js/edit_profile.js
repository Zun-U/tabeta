'use  strict';

$(function () {

  // Ajaxでプロフィール画像編集
  let profile = $('#edit-profile');

  profile.on('change', function () {

    console.log("image is changed");

    // アップロードするデータの取得
    let fileData = $(this).prop('files')[0];

    // console.log(fileData);
    // return;

    // フォームデータの作成
    let editProfile = new FormData();

    // フォームデータにアップロードファイルの情報追加
    editProfile.append('file', fileData);

    $.ajax({

      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      method: 'POST',

      url: '/myprofile',

      //画像データを渡す
      data: editProfile,

      contentType: false,
      processData: false



    })

      .done(function (data) {
        // 帰ってきた結果を適用する。
        $('.prof-image').attr('src', data.user_image.image);
        $('.header-profile').attr('src', data.user_image.image);
      })

      .fail(function () {
        console.log('fail');
      });
  });






  // パスワードの表示非表示

  //目のアイコン情報を取得 
  let eyeIcon = $('#input-group-addon');

  // console.log(eyeIcon);

  // パスワードのinputタグを取得
  let passInput = $('#edit-password');

  eyeIcon.on('click', function () {

    console.log('eye control success');

    if (passInput.attr('type') === "text") {
      passInput.attr('type', 'password');
      eyeIcon.attr('class', 'fa-solid fa-eye-slash');
    }
    else {
      passInput.attr('type', 'text');
      eyeIcon.attr('class', 'fa-regular fa-eye');

    }
  });



      // フラッシュメッセージのフェードアウト
      $(function(){
        $('.flash_message').fadeOut(3000);
    });

});