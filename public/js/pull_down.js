'use  strict';

// 調理時間プルダウンメニュー自動生成
window.addEventListener('DOMContentLoaded', function(){

  let cooking_time = document.getElementById('cooking_time');

  // 60分までメニュー作成
  for (let i = 1; i <= 60; i++) {
    let option = document.createElement("option");
    option.setAttribute("value", i);
    option.insertAdjacentHTML('beforeend', i + '分');
    cooking_time.appendChild(option);
  }
});
