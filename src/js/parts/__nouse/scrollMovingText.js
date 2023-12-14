export function scrollMovingText() {
  //.js-aboutが画面に入ったら、その中の.js-about__textをスクロール量に合わせてtranslateXで左に動くようにする。============

  // Intersection Observerの設定・初期化
  const observerOptions01 = {
    root: null, // ビューポートをルートとして使用
    rootMargin: "0px", //交差判定を要素の周囲を拡大(pxで指定)
    threshold: 0.1, // 交差した割合をどのくらいに設定するか
  };

  // .js-aboutがビューポートに入った時のコールバック関数
  const observerCallback01 = (entries01, observer01) => {
    entries01.forEach((entry01) => {
      // ターゲットがビューポートに入ったら
      if (entry01.isIntersecting) {
        // スクロールイベントを登録
        window.addEventListener("scroll", () => {
          const targetText = entry01.target.querySelectorAll(".js-about__text");
          const scrollPosition =
            window.pageYOffset || document.documentElement.scrollTop;

          // ターゲットの順番に基づいて方向を設定（順番が偶数の時は-1、奇数の時は1）
          targetText.forEach((element, index) => {
            const directionTargetText = index % 2 === 0 ? -1 : 1;
            element.style.transform = `translateX(${
              (directionTargetText * scrollPosition) / 3
            }px)`;
          });
        });
      }
    });
  };

  // Intersection Observerをインスタンス化
  const observer01 = new IntersectionObserver(
    observerCallback01,
    observerOptions01
  );

  // .js-aboutを全て監視対象にする
  const targetElements01 = document.querySelectorAll(".js-about");
  targetElements01.forEach((el) => observer01.observe(el));
}
