export function hamburgerMenu() {
  // ハンバーガーメニューの処理を開始===========
  document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".js-hum");
    const navigation = document.querySelector(".js-humnav");
    const overlay = document.querySelector(".js-overlay");

    // ハンバーガーメニューのクリックイベント
    hamburger.addEventListener("click", function () {
      const expanded = this.getAttribute("aria-expanded") === "true";
      this.setAttribute("aria-expanded", !expanded);
      navigation.setAttribute("aria-hidden", String(!expanded));

      // メニューとナビゲーションの状態をトグル
      this.classList.toggle("is-active");
      navigation.classList.toggle("is-active");
      overlay.classList.toggle("is-active");

      // ナビゲーション内のリンクのタブインデックスを更新-----------
      const links = navigation.querySelectorAll("a");
      for (let link of links) {
        link.setAttribute("tabindex", expanded ? "0" : "-1");
      }
    });

    // ナビゲーション内のリンクがクリックされたときのイベント--------
    // navigation.querySelectorAll("a").forEach(function (link) {
    //   link.addEventListener("click", function () {
    //     // メニューとナビゲーションの状態を非アクティブに
    //     hamburger.setAttribute("aria-expanded", "false");
    //     navigation.setAttribute("aria-hidden", "true");
    //     hamburger.classList.remove("is-active");
    //     navigation.classList.remove("is-active");
    //     overlay.classList.remove("is-active");

    //     // ナビゲーション内のリンクのタブインデックスを更新
    //     const links = navigation.querySelectorAll("a");
    //     for (let link of links) {
    //       link.setAttribute("tabindex", "-1");
    //     }
    //   });
    // });
  });
}
