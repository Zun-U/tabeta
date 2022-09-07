'use  strict';

$(function () {

  // 画像を表示
  $('#image-upload').change(function () {

    console.log("image is changed");




    //アップロードファイルを取得
    const file = $(this).prop('files')[0];

    // 画像の表示
    const reader = new FileReader();

    // 画像が読み込まれたら
    reader.onload = function () {


      const img_src = $('<img>').attr('src', reader.result).addClass("img-fluid");

      $('.imagefile').html(img_src);




    }

    reader.readAsDataURL(file);

  }
  );


  // 動的に追加した画像投稿欄の表示
  $(document).on('change', '.howto-image', function () {

    console.log("image is changed");

    const file = $(this).prop('files')[0];

    // 選択している要素の兄弟要素を指定(その要素だけを選択)
    const bro = $(this).prev();

    console.log(file);

    const reader = new FileReader();

    reader.onload = function () {


      const img_src = $('<img>').attr('src', reader.result).addClass("img-fluid rounded-3 shadow");



      // $('.howto-put').html(img_src);

      bro.html(img_src);




    }

    reader.readAsDataURL(file);

  }
  );

});