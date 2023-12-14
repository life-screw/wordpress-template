// background-attachment: fixedのように、スクロール範囲に合わせて画像・動画を固定する
export function bgFixImages() {
  // IntersectionObserverのコールバック関数
  function handleIntersect(entries, observer) {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const dataImgValue = entry.target.getAttribute("data-img");
        const elements = document.querySelectorAll(".js-bg-fix-image");

        elements.forEach((el) => {
          if (el.getAttribute("data-img") === dataImgValue) {
            el.classList.add("is-active");
          } else {
            el.classList.remove("is-active");
          }
        });
      }
    });
  }

  // IntersectionObserverの設定
  let options = {
    root: null,
    rootMargin: "-50% 0px",
    threshold: 0,
  };

  // IntersectionObserverを初期化
  const observer = new IntersectionObserver(handleIntersect, options);

  // 監視対象の要素（data-img属性を持つ要素）を全て選択
  const targets = document.querySelectorAll("[data-img]");

  // 各要素を監視対象に追加
  targets.forEach((target) => {
    observer.observe(target);
  });
}
