export function smoothScrollToTop() {
  // すべての '#' リンクにイベントリスナーを追加
  document.querySelectorAll('a[href="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      // デフォルトのアンカー動作を無効化
      e.preventDefault();

      // ページの最上部にスムーススクロールを実行
      window.scrollTo({
        top: 0, // スクロール先のY座標
        behavior: "smooth", // スムーススクロールを指定
      });
    });
  });
}