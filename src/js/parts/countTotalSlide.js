// スライドのナンバリングとナビゲーションの自動生成
export function countTotalSlide() {
  document.addEventListener("DOMContentLoaded", () => {
    // スライドの総数をカウントし、htmlに「ナンバリング」と「総数」を挿入する---
    const slider = document.querySelectorAll(".js-appeal");
    const totalSlider = slider.length;

    slider.forEach((slide, index) => {
      const numberContainer = slide.querySelector(".js-appeal-num");
      if (numberContainer) {
        numberContainer.textContent = `${index + 1}/${totalSlider}`;
      }
    });

    // ナビゲーションをスライドの総数分生成。html要素として追加----

    // ナビゲーションバー 要素を取得
    const sliderNav = document.querySelector(".js-appeal-nav");

    // スライドのの数だけ <span> 要素を ナビゲーションバーの中に追加
    for (let i = 0; i < totalSlider; i++) {
      const span = document.createElement("span");
      span.classList.add("nav-list");

      // 最初の <span> 要素に .is-active クラスを追加
      if (i === 0) {
        span.classList.add("is-active");
      }

      sliderNav.appendChild(span);
    }
  });
}

export function countTotalSlide02() {
  document.addEventListener("DOMContentLoaded", () => {
    // スライドの総数をカウントし、htmlに「ナンバリング」と「総数」を挿入する---
    const slider = document.querySelectorAll(".js-service");
    const totalSlider = slider.length;

    slider.forEach((slide, index) => {
      const numberContainer = slide.querySelector(".js-service-contents-num");
      if (numberContainer) {
        numberContainer.textContent = `${index + 1}/${totalSlider}`;
      }
    });

    // ナビゲーションをスライドの総数分生成。html要素として追加----

    // ナビゲーションバー 要素を取得
    const sliderNav = document.querySelector(".js-service-nav");

    // スライドのの数だけ <span> 要素を ナビゲーションバーの中に追加
    for (let i = 0; i < totalSlider; i++) {
      const span = document.createElement("span");
      span.classList.add("nav-list");

      // 最初の <span> 要素に .is-active クラスを追加
      if (i === 0) {
        span.classList.add("is-active");
      }

      sliderNav.appendChild(span);
    }
  });
}
