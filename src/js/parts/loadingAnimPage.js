export function loadingAnimPage() {
  // 【下層ページ用】DOMを読み込んだ後に、フェードアウトアニメーションを起動
  //（WEBフォントのちらつきを見せないようにする）
  document.addEventListener("DOMContentLoaded", function () {
    //.js-loadingがある場合のみ実行
    if (document.getElementsByClassName("js-loading")[0]) {
      setTimeout(function () {
        document.querySelectorAll(".js-loading").forEach(function (el) {
          el.classList.add("is-show"); //クラスを付与する
          el.style.transition = "opacity 0.2s ease";
          el.style.marginTop = "-100%";
          el.style.height = "0";
          el.style.opacity = "0";
        });
      }, 30);
    }
  });
}
