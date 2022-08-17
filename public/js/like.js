'use  strict';

$(function () {

  let like = $('.like-toggle');

  let likeRecipeId;

  like.on('click', function () {

    // プロトコルやポートを含めたURLを取得
    // var origin = location.origin;

    // イベントの引き金になっているもの
    let $this = $(this);

    // カスタムデータ属性の値を取得
    likeRecipeId = $this.data('recipe-id');


    //ajax処理スタート
    $.ajax({

      // csrf対策
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

      // POST送信
      method: 'POST',

      //通信先アドレス
      url: '/like',

      //サーバーに送信するデータ
      data: {
        //いいねされた投稿のidを送る
        'recipe_id': likeRecipeId
      },

    })

      //通信成功した時の処理
      .done(function (data) {
        $this.toggleClass('liked'); //likedクラスのON/OFF切り替え。
        $this.next('.like-counter').html(data.recipe_likes_count);
      })
      //通信失敗した時の処理
      .fail(function () {
        console.log('fail');
      });
  });
});