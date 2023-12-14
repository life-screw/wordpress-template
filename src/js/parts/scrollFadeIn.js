//スクロールでフェードインするアニメーション
export function scrollFadeIn() {
  document.addEventListener("DOMContentLoaded", function () {
    // ページ読み込み時にファーストビュー内の要素に is-show を付与
    document.querySelectorAll(".js-fadein").forEach(function (element) {
      var fadeTop = Math.floor(element.getBoundingClientRect().top);
      var windowHeight = window.innerHeight;
      if (windowHeight / 1.05 > fadeTop) {
        //少し遅延してからis-showを付与
        setTimeout(function () {
          element.classList.add("is-show");
        }, 120);
      }
    });
  });

  window.addEventListener("scroll", function () {
    var scrollTop = window.pageYOffset;
    // スクロール時にフェードインする
    document.querySelectorAll(".js-fadein").forEach(function (element) {
      var fadeTop = Math.floor(element.getBoundingClientRect().top);
      //ビューポートの下端からの位置が、指定した要素（fadeTop）が画面内に完全に入った時に、クラスを付与
      if (
        scrollTop + window.innerHeight / 1.05 > fadeTop &&
        fadeTop > scrollTop //window.innerHeight / 1.05 はビューポートの高さよりわずかに小さくしている
      ) {
        element.classList.add("is-show");
      }
    });
  });
}
