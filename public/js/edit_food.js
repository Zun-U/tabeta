'use  strict';


let count = 1;
let countProcedure = 1;

// 食材・分量の追加・削除
// 追加ボタンを押したときにイベント発生
document.querySelector('#btn-add').addEventListener('click', function () {

  // フォーム入力欄を丸ごと取得
  let inputArea = document.getElementById('input-area');

  // コピー
  let cloneElements = inputArea.cloneNode(true);

  // 複製した要素のid編集（IDの重複防止）
  cloneElements.id = "clone-area" + count;



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






// 「onclick="removeForm(this)"」の取得。
function removeForm(button) {
  // 「closest」　祖先要素を取得
  let ancestor = button.closest(".row");
  ancestor.remove();
}

// ※2022/7/28 課題
// 1.追加・削除ボタンを押した時の挙動の違和感をなくしたい。
// ⇒追加ボタンを押していくとページのレイアウトが微妙にずれる。
// ⇒削除ボタンを押すと画面が不自然にスクロールする。

// 2.UX／UIを整える。
// ⇒直感的で、美しいデザイン。

// ※2022/8/5
// function 〇〇(button)の挙動の理解




// 作り方、写真投稿欄の追加
document.querySelector('#add-procedure').addEventListener('click', function () {


  let procedureArea = document.getElementById('procedure-area');
  let cloneForm = procedureArea.cloneNode(true);

  cloneForm.id = "clone-procedure" + countProcedure;

  cloneForm.dataset.insertDB = countProcedure;

  let procedureContent = cloneForm.querySelectorAll('input');
  procedureContent.forEach((text) => {
    text.value = "";
  });

  let cloneProcedure = document.getElementById('clone-procedure')
  cloneProcedure.appendChild(cloneForm);

  let removeButton = cloneForm.querySelector('button');
  removeButton.className = "btn btn-outline-primary"

  removeButton.id = "btn-remove" + countProcedure;

  countProcedure++;
});


// 削除ボタン
function removeProcedure(button) {
  let ancestor = button.closest(".row");
  ancestor.remove();
}




// 未入力欄なら要素削除(UX向上) ⇒　両方nullableにして、両方未入力なら投稿禁止にする。
document.getElementById('create-recipe').addEventListener("click", function (event) {


  // 追加フォーム欄の「材料・分量」入力欄の取得(一個下の祖先要素を指定)
  let inputCheckAll = document.getElementById('clone-area').querySelectorAll('.row');



  inputCheckAll.forEach(function (parent) {
    var flg = 0;
    parent.querySelectorAll('.col-sm input').forEach(function (element) {
      if (element.classList.contains('check-food')) {
        if (element.value == '') {
          flg = flg + 1;
        };
      } else if (element.classList.contains('check-amount')) {
        if (element.value == '') {
          flg = flg + 1;
        };
      }
      if (flg == 2) {
        parent.remove();
      }
    });
  });



  // event.preventDefault();
});

