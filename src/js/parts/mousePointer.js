export function mousePointer() {
  // マウスストーカーのアニメーション（PCのみ）===================
  if (getUserAgent() == "pc") {
    //htmlにnot-touchクラスを付与
    document.documentElement.classList.add("not-touch");

    //要素を取得
    const pointer = document.querySelector(".js-pointer");
    const pointerCursor = document.querySelector(".js-pointer__cursor");
    const pointerText = document.querySelector(".js-pointer__text");

    //カーソルが動いた時のイベント
    window.addEventListener("mousemove", (e) => {
      const x = e.clientX;
      const y = e.clientY;
      pointer.style.transform = `translate3d(${x}px, ${y}px, 0)`;
    });

    //カーソルが.js-pointer-areaに乗った時のイベント
    document.querySelectorAll(".js-pointer-area").forEach((el) => {
      el.addEventListener("mouseover", () => {
        //.js-pointer-areaにdata-cursor属性がある場合は、その値のクラス名を追加する
        if (el.dataset.cursor) {
          pointerCursor.classList.add(`is-mouseover--${el.dataset.cursor}`);
        }
        //.js-pointer-areaにdata-cursor-text属性がある場合は、その値をカーソルのテキストを入れる
        if (el.dataset.cursorText) {
          pointerText.textContent = el.dataset.cursorText;
        }
        pointerCursor.classList.add("is-mouseover");
      });

      //マウスが離れたらリセット
      el.addEventListener("mouseout", () => {
        pointerText.textContent = "";
        pointerCursor.classList.remove("is-mouseover");
        if (el.dataset.cursor) {
          pointerCursor.classList.remove(`is-mouseover--${el.dataset.cursor}`);
        }
      });
    });
  }

  //メニューのhover　ブラウザ、実機ごとでのアクション補助=========
  //ブラウザ判別
  function getUserAgent() {
    var ua = navigator.userAgent;
    if (
      ua.indexOf("iPhone") > 0 ||
      ua.indexOf("iPod") > 0 ||
      (ua.indexOf("Android") > 0 && ua.indexOf("Mobile") > 0)
    ) {
      return "sp";
    } else if (ua.indexOf("iPad") > 0 || ua.indexOf("Android") > 0) {
      return "tb";
    } else {
      return "pc";
    }
  }
}
