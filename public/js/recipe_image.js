'use  strict';


// 画像を表示
$('#image-upload').change(function () {

  console.log("image is changed");




  //アップロードファイルを取得
  const file = $(this).prop('files')[0];

  // 画像以外は処理を停止
  // if (!file.type.match('image.*')) {
  //   // クリア
  //   $(this).val('');
  //   $('.imgfile').html('');
  //   return;
  // }

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
