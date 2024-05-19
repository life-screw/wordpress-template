//ファーストビューをスクロールしたらヘッダーにクラスを追加（上端にfixしたheader）
export function scrollHeaderAddClass() {

  const fv = document.querySelector(".p-fv");
  const header = document.querySelector(".js-header");
  //ヘッダーのクラスを制御する関数
  function scrollHeaderControl() {
    //fvの高さを取得
    let fvHeight = fv.clientHeight;
    //ブラウザの上端からの縦方向ページのスクロール量
    let scroll = window.pageYOffset;

    if (scroll > fvHeight) {
      header.classList.add("js-scroll-header");
    } else {
      header.classList.remove("js-scroll-header");
    }
  }
    //スクロール時に実行
  window.addEventListener("scroll", scrollHeaderControl);

  //ページ読み込み時にも実行
  document.addEventListener("DOMContentLoaded", scrollHeaderControl);
}


//ファーストビューをスクロールしたらヘッダーにクラスを追加
//（上端から少し離れた要素の位置を取得する場合）
//（ウィンドウサイズが1000px以上の場合のみ実行）
// export function scrollHeaderAddClass() {
//   const fv = document.querySelector(".p-fv");
//   const header = document.querySelector(".js-header");
//   const humnav = document.querySelector(".l-humnav__inner");
//   //ヘッダーのクラスを制御する関数
//   function scrollHeaderControl() {
//     //ウィンドウサイズが1000px以上の場合のみ実行
//     if (window.innerWidth >= 1000) {
//       //fvの高さを取得
//       let fvHeight = fv.clientHeight;
//       //ハンバーガーメニューの高さを取得
//       let humnavScrollTop =
//         Math.floor(humnav.getBoundingClientRect().top) + window.pageYOffset;

//       if (humnavScrollTop > fvHeight) {
//         header.classList.add("js-scroll-header");
//       } else {
//         header.classList.remove("js-scroll-header");
//       }
//     } else {
//       //ウィンドウサイズが1000px未満の場合はクラスを削除
//       header.classList.remove("js-scroll-header");
//     }
//   }

//   //スクロール時とリサイズ時に実行
//   window.addEventListener("scroll", scrollHeaderControl);
//   window.addEventListener("resize", scrollHeaderControl);

//   //ページ読み込み時にも実行
//   document.addEventListener("DOMContentLoaded", scrollHeaderControl);
// }
