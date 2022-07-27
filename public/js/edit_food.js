'use  strict';


let count = 1;



// 追加ボタンを押したときにイベント発生
document.querySelector('#btn-add').addEventListener('click', function () {

  // フォーム入力欄を丸ごと取得
  let inputArea = document.getElementById('input-area');

  // コピー
  let cloneElements = inputArea.cloneNode(true);

  // 複製した要素のid編集
  cloneElements.id = "input-area" + count;

  // 入力欄を空白にする。※querySelectorAllには複数のノードがしまわれる。
  let inputContent = cloneElements.querySelectorAll('input');
  inputContent.forEach((text) => {
    text.value = "";
  });


  // 複製した要素を挿入
  let cloneArea = document.getElementById('clone-area')
  cloneArea.appendChild(cloneElements);


  // 複製した削除アイコン情報を取得、表示
  let removeButton = cloneElements.querySelector('button');
  removeButton.className = "btn btn-outline-primary"


  // 削除アイコンのidの編集
  removeButton.id = "btn-remove" + count;

  // IDの重複対策
  count++;
});





// 削除ボタンを押したときにイベント発生
document.querySelector('#btn-del').addEventListener('click', function () {

  if()

});
