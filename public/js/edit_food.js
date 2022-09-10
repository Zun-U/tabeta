'use  strict';

// viewのforeach文中のゴミ箱アイコン表示

// 画面が読み込まれたら
window.addEventListener('DOMContentLoaded', function () {

  // 削除ボタンの要素取得
  let foodCount = document.querySelectorAll('.count-foodstuff');
  let contentCount = document.querySelectorAll('.count-content');

  // 最初の要素はカウントしない
  let flgFood = 0;
  let flgContent = 0;


  // 材料・分量フォームの削除ボタン再割り当て
  foodCount.forEach(function (count) {

    if (flgFood === 0) {
      console.log('一つ目のカウントは実行されません');
      flgFood = flgFood + 1;
    }
    else {
      console.log(flgFood);
      count.className = "btn btn-outline-primary count-content";
      flgFood = flgFood + 1;
    }

    console.log(count);

  });


  // 作り方フォームの削除ボタン再割り当て
  contentCount.forEach(function (count) {

    if (flgContent === 0) {
      console.log('一つ目のカウントは実行されません');
      flgContent = flgContent + 1;
    }
    else {
      console.log(flgContent);
      count.className = "btn btn-outline-primary count-content";
      flgContent = flgContent + 1;
    }

    console.log(count);

  });




  // 未入力欄なら要素削除
  document.getElementById('create-recipe').addEventListener("click", function (event) {

    // 現在のフォーム欄の「材料・分量」入力欄の取得(一個下の祖先要素を指定)
    let inputCheckAll = document.getElementById('current-foodstuff').querySelectorAll('.row');

    // 作り方記入欄の取得
    let inputHowtoAll = document.getElementById('current-content').querySelectorAll('.row');



    // 食材記入欄2つの空欄チェック
    inputCheckAll.forEach(function (parent) {
      var flg = 0;
        parent.querySelectorAll('.col-3 input').forEach(function (element) {
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



    // 作り方欄の空白空欄チェック
    inputHowtoAll.forEach(function (howto) {

      flag = 0;

      howto.querySelectorAll('.howto input').forEach(function (element) {

        if (element.classList.contains('recipe-input')) {
          if (element.value == '') {
            flag = flag + 1;
          };
        } else if (element.classList.contains('howto-image')) {
          // console.log('値が取れていない');
          if (element.files.length === 0) {
            flag = flag + 1;
          }
        }
        if (flag == 2) {
          howto.remove();
        }
      });

    });

    // event.preventDefault();


  });




});