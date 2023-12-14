//スクロールすると、周りの要素が消え、スクロールのコンテンツが切り替わる(写真・文字入り)
// デモ：https://codepen.io/lifescrewdesign/pen/dyQpbrp
export function scrollStickySlide() {
  // 【.js-service-contentsの上下の要素】 ウィンドウサイズが変わっても、余白をある程度一定になるように調整する============================
  // function adjustElementMargins() {
  //   const windowHeight = window.innerHeight;
  //   const contentElement = document.querySelector(".js-service-sticky__content");
  //   const targetElement = document.querySelector(".js-service-contents");

  //   //コンテンツの高さを取得する
  //   const contentElementHeight = contentElement.getBoundingClientRect().height;

  //   ウィンドウの高さ - コンテンツの高さ / 2 -------
  //     const marginTop = (windowHeight - contentElementHeight) / 2;
  //     const marginBottom = (windowHeight - contentElementHeight) / 2;

  //   上下に余白ができる場合は、マイナスマージンで調整する
  //     if (marginTop > 0) {
  //       targetElement.style.marginTop = -1 * marginTop + "px";
  //     }
  //     if (marginBottom > 0) {
  //       targetElement.style.marginBottom = -1 * marginBottom + "px";
  //     }
  // }

  // .js-service-contentsをスクロールして表示させる============================
  function stickyElement() {
    // 要素を取得する
    const targetElement = document.querySelector(".js-service-contents");

    // スクロール量を取得する
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    // targetElementのページ上での縦位置を取得する
    const targetOffsetTop =
      targetElement.getBoundingClientRect().top + scrollTop;
    // targetElementの高さを取得する
    const targetInnerHeight = targetElement.clientHeight;

    // スクロール量を計算する 0.75は、.js-service-contentsの高さの75%を指す
    const scrollRatio =
      (scrollTop - targetOffsetTop) / (0.75 * targetInnerHeight);

    // .js-service-contentsのdata-scroll属性をスクロール時に更新する
    if (scrollRatio >= 0 && scrollRatio < 1) {
      // スクロール量（scrollRatio）に、コンテンツの数をかけて、小数点以下を切り上げる
      // 4は、.js-service-contents内のコンテンツの数
      const scrollNumber = Math.ceil(4 * scrollRatio);
      // scrollNumberの先頭に0を付ける
      const scrollNumberString = "0" + scrollNumber;
      // targetElementのdata-scroll属性を、scrollNumberStringの値に更新
      targetElement.setAttribute("data-scroll", scrollNumberString);
    }
  }

  // 共通のイベントハンドラ関数を定義する
  function handleEvent() {
    //   adjustElementMargins();
    stickyElement();
  }

  // load, scroll, resizeイベントで処理を実行する
  window.addEventListener("load", handleEvent);
  window.addEventListener("scroll", stickyElement); //stickyElementのみ
  window.addEventListener("resize", handleEvent);

  // DOMContentLoadedイベントで adjustElementMargins のみ実行する
  // document.addEventListener("DOMContentLoaded", adjustElementMargins);
}
