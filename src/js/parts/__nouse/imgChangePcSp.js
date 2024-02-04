export function imgChangePcSp() {
  function changeImage() {
    // '.js-change-img'クラスを持つ要素を全て取得
    const images = document.querySelectorAll(".js-change-img");

    // 各画像に対して処理を実行
    images.forEach((image) => {
      let src = image.getAttribute("src");

      if (window.innerWidth >= 769) {
        // ウィンドウサイズが769px以上の場合、拡張子前の_spを_pcに置換
        src = src.replace(/_sp(\.\w+)$/, "_pc$1");
      } else {
        // ウィンドウサイズが769px未満の場合、拡張子前の_pcを_spに置換
        src = src.replace(/_pc(\.\w+)$/, "_sp$1");
      }

      image.setAttribute("src", src);
    });
  }

  // ウィンドウのリサイズイベントに対応
  window.addEventListener("resize", changeImage);

  // ページロード時にも実行
  changeImage();
}
