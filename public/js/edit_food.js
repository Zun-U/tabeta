'use  strict';

// viewのforeach文中のゴミ箱アイコン表示

// 画面が読み込まれたら
window.addEventListener('DOMContentLoaded', function () {

  // 削除ボタンの要素取得
  let foodCount = document.querySelectorAll('.count-foodstuff');
  let contentCount = document.querySelectorAll('.count-content');

  console.log(foodCount);
  console.log(contentCount);

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
      count.className = "btn btn-outline-primary count-content"
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
      count.className = "btn btn-outline-primary count-content"
      flgContent = flgContent + 1;
    }

    console.log(count);

  });




});