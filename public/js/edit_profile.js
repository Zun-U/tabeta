'use  strict';

$('input[type=file]').change(function () {

   //アップロードするファイルのデータ取得
  const file = $(this).prop('files')[0];

  if (!file.type.match('image.*')) {
    // クリア
    $(this).val('');
    $('.imgfile').html('');
    return;
  }

  const reader = new FileReader();

  reader.onload = function () {

    const img_src = $('<img>').attr('src', reader.result);

    $('.imgfile').html(img_src);

    $('.imgarea').removeClass('noimage');

  }

  reader.readAsDataURL(file);

});
