'use  strict';

// $('input[type=file]').change(function () {

//    //アップロードするファイルのデータ取得
//   const file = $(this).prop('files')[0];

//   if (!file.type.match('image.*')) {
//     // クリア
//     $(this).val('');
//     $('.imgfile').html('');
//     return;
//   }

//   const reader = new FileReader();

//   reader.onload = function () {

//     const img_src = $('<img>').attr('src', reader.result);

//     $('.imgfile').html(img_src);

//     $('.imgarea').removeClass('noimage');

//   }

//   reader.readAsDataURL(file);

// });


$(function () {

  $('#edit-profile').change(function () {

    console.log("image is changed");

    const file = $(this).prop('files')[0];

    const reader = new FileReader();


    reader.onload = function () {

      const img_src = $('<img>').attr('src', reader.result).addClass("img-fluid circle rounded-3 prof-hover");

      $('.edit-here').html(img_src);

    }

    reader.readAsDataURL(file);

  }
  );




  // let profile = $('#edit-profile');

  // profile.on('change', function () {


  //   // アップロードするデータの取得
  //   let fileData = document.getElementById('#edit-profile').files[0];

  //   console.log(fileData);
    


  //   // フォームデータの作成
  //   let editProfile = new FormData();

  //   editProfile.append('file', fileData);

  //   $.ajax({

  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //     },

  //     method: 'POST',

  //     url: '/myprofile',


  //     data: {
  //       //画像データを渡す
  //       editProfile,
  //       contentType: false,
  //       processData: false
  //     },

  //   })

  //     .done(function (data) {
  //       // $this.toggleClass('liked'); //likedクラスのON/OFF切り替え。
  //       // $this.next('.like-counter').html(data.recipe_likes_count);
  //     })

  //     .fail(function () {
  //       console.log('fail');
  //     });
  // });
})