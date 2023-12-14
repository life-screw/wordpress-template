export function loadingAnim() {
  // ページの完全なロードが完了した後に、フェードインアニメーションを起動

  window.addEventListener("load", function () {
    //.js-loadingがある場合のみ実行
    if (document.getElementsByClassName("js-loading")[0]) {
      // 300ms後に画像・テキストをフェードアウト
      setTimeout(function () {
        document.querySelectorAll(".js-loading").forEach(function (el) {
          el.classList.add("is-show");
        });
      }, 3000);

      // 400ms後にslideUpの代わりとなる処理を行う
      setTimeout(function () {
        document.querySelectorAll(".js-loading").forEach(function (el) {
          //   el.classList.add("is-show");
          el.style.transition =
            "margin 0.5s ease, height 0.5s ease, opacity 0.5s ease";
          el.style.marginTop = "-100%";
          el.style.height = "0";
          el.style.opacity = "0";
        });
      }, 4000);
    }
  });
}
