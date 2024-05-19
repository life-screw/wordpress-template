export function clickSmoothScroll() {
  // スムーススクロール================================
  // 「ページトップ」と「ページ内リンク」へのスムーススクロール
  // すべての '#' リンクにイベントリスナーを追加
  // 参考サイト：https://global-web-design.com/1305/
  
  const headerHeight = document.querySelector(".l-header").offsetHeight;

  //querySelectorAllメソッドを使用してページ内のhref属性が#で始まるものを選択
  //forEachメソッドを使って、各アンカータグにクリックされた時の処理
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      // クリックされたときのデフォルトの挙動を防ぐ
      e.preventDefault();

      // クリックされたアンカータグのhref属性を取得
      const href = anchor.getAttribute("href");

      // hrefが単に'#'である場合、ページのトップにスムーススクロールする
      if (href === "#") {
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      } else {
        // href属性の#を取り除いた部分と一致するIDを取得
        const target = document.getElementById(href.replace("#", ""));

        // 取得した要素が存在する場合のみスクロールを実行
        if (target) {
          //取得した要素の位置を取得するために、getBoundingClientRect()を呼び出し、ページ上の位置を計算。
          //headerの高さを引いて、スクロール位置がヘッダーの下になるように調整します。
          const targetPosition =
            target.getBoundingClientRect().top +
            window.pageYOffset -
            headerHeight;

          // window.scrollTo()を呼び出して、スクロール位置を設定します。behaviorオプションをsmoothに設定することで、スムーズなスクロールを実現します。
          window.scrollTo({
            top: targetPosition,
            behavior: "smooth",
          });
        }
      }
    });
  });
}
