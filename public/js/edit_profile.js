'use  strict';

$(function () {

  //   $('#edit-profile').change(function () {

  //     console.log("image is changed");

  //     const file = $(this).prop('files')[0];

  //     const reader = new FileReader();

  //     reader.onload = function () {

  //       const img_src = $('<img>').attr('src', reader.result).addClass("img-fluid circle rounded-3 prof-hover");

  //       $('.edit-here').html(img_src);

  //     }

  //     reader.readAsDataURL(file);

  //   }
  //   );



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
        console.log(data);
        // 帰ってきた結果を適用する。
        $('.prof-image').attr('src', data.user_image.image)

      })

      .fail(function () {
        console.log('fail');
      });
  });
});