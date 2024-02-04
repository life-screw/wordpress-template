//スクロールでフェードインするアニメーション
export function scrollFadeIn() {
  document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".js-fadein");
    // .js-fadeinが存在する場合のみ実行
    if (elements.length > 0) {
      // ページ読み込み時にファーストビュー内の要素に is-show を付与
      elements.forEach(function (element) {
        let fadeTop = Math.floor(element.getBoundingClientRect().top);
        const windowHeight = window.innerHeight;
        //要素がビューポートの高さの約95%（windowHeight / 1.05）以内にあればクラスつける
        if (windowHeight / 1.05 > fadeTop) {
          //少し遅延してからis-showを付与
          setTimeout(function () {
            element.classList.add("is-show");
          }, 120);
        }
      });
    }
  });

  window.addEventListener("scroll", function () {
    const elements = document.querySelectorAll(".js-fadein");
    // .js-fadeinが存在する場合のみ実行
    if (elements.length > 0) {
      let scrollTop = window.pageYOffset;
      // スクロール時にフェードインする
      elements.forEach(function (element) {
        let fadeTop = Math.floor(element.getBoundingClientRect().top);
        let elementBottom = fadeTop + scrollTop; // 要素のtop位置 + スクロール位置

        // スクロール位置から、ビューポートの高さ95%の位置に要素が入ったらクラスを付与（500ms遅延）
        if (scrollTop + window.innerHeight / 1.05 > elementBottom) {
          setTimeout(function () {
            element.classList.add("is-show");
          }, 500);
        }
      });
    }
  });
}
