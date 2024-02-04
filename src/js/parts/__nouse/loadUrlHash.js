export function loadUrlHash() {
  //【jQuery不要】ページ遷移でアンカーリンク先に飛ばす時、追従ヘッダーに被らないようにしたい。
  //DOMが読み込まれてから実行
  window.addEventListener("load", function () {
    // 現在ページのURLのハッシュ部分を取得
    const urlHash = window.location.hash; // 例: #issue

    if (urlHash) {
      // ハッシュから#を取り除き、対象の要素のIDを取得
      const targetId = urlHash.slice(1); // 例: 'issue'

      // 対象の要素を取得
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        // ヘッダーの高さを取得
        const headerHeight = document.querySelector(".js-hum").clientHeight;

        // 対象要素のページ上の位置を取得
        const elementPosition =
          targetElement.getBoundingClientRect().top + window.pageYOffset;

        // スクロール位置をヘッダーの高さ分だけ上に設定
        const offsetPosition = elementPosition - headerHeight;

        // スムーススクロール
        window.scrollTo({
          top: offsetPosition,
          behavior: "smooth",
        });
      }
    }
  });
}

// 修正前のコード============================================
// window.addEventListener("load", function () {
//   //現在ページのURLのハッシュ部分を取得
//   const url = window.location.hash; //#issue

//   if (url) {
//     const target = url.slice(1); //issue

//     //targetで取得したid名を持ったオブジェクトを取得
//     const link = document.getElementById(target); //<div id="issue" ...</div

//     //ヘッダーの高さ取得
//     const headerHeight = document.getElementById("header").clientHeight;
//     console.log("headerHeight" + headerHeight);

//     //ストロール位置からヘッダーの高さを引く
//     let linkTop = link.offsetTop - headerHeight;
//     //指定された要素内を指定された座標までスクロール。（第一引数はx軸、第二引数はy軸）
//     window.scrollTo(0, linkTop);
//   }
// });
