//ページをめくるように切り替わるスライダー（2つ同時に動く）===============
//参考サイト：https://nekoshoku.jp/

// ※GSAPプラグインの追加が必要
// https://gsap.com/docs/v3/Installation/
// ↓これをHTMLのhead内に追加。ダウンロードしてからパスを指定する方が安全。
/* <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script> */

export function gsapFvSlider() {
  let index = 1; //最初の数
  const slides = document.querySelectorAll(".js-fv-slide");
  const slideNum = slides.length; //スライドの数を取得
  let prevNum;

  //ヘルパー関数setStyleを使用してこれらの要素にスタイルを適用し、jQueryの.css()メソッドの動作を再現。
  const setStyle = (elements, styles) => {
    elements.forEach((el) => {
      for (const property in styles) {
        el.style[property] = styles[property];
      }
    });
  };

  //２つのスライドの初期化----------------------
  const slideInit = function () {
    setStyle(slides, { zIndex: "1" });
    setStyle(document.querySelectorAll(".js-fv-slide--1"), { zIndex: "3" });
    setStyle(document.querySelectorAll(".js-fv-slider--left .js-fv-slide"), {
      width: "100%",
    });
    setStyle(document.querySelectorAll(".js-fv-slider--right .js-fv-slide"), {
      height: "100%",
    });

    // TweenMax animations
    //ページをめくるように切り替わるアニメーションはCSSで設定
    TweenMax.fromTo(
      document.querySelectorAll(".js-fv-slide__bg"),
      1.6,
      { scale: 1.1 },
      { scale: 1, ease: Power1.easeInOut }
    );
  };
  slideInit();

  //次のスライドに切り替える----------------------
  const slideNext = function (index) {
    prevNum = index - 1;
    setStyle(slides, { zIndex: "1" });
    if (prevNum === 0) {
      setStyle(document.querySelectorAll(".js-fv-slide--" + slideNum), {
        zIndex: "2",
      });
    } else {
      setStyle(document.querySelectorAll(".js-fv-slide--" + prevNum), {
        zIndex: "2",
      });
    }
    setStyle(document.querySelectorAll(".js-fv-slide--" + index), {
      zIndex: "3",
    });

    // TweenMax animations
    TweenMax.fromTo(
      document.querySelectorAll(".js-fv-slide--" + index + " .js-fv-slide__bg"),
      1.6,
      { scale: 1.1 },
      { scale: 1, ease: Power1.easeInOut }
    );
    TweenMax.fromTo(
      document.querySelectorAll(".js-fv-slider--left .js-fv-slide--" + index),
      1.6,
      { width: 0 },
      { width: "100%", ease: Power4.easeInOut }
    );
    TweenMax.fromTo(
      document.querySelectorAll(".js-fv-slider--right .js-fv-slide--" + index),
      1.6,
      { height: 0 },
      { height: "100%", ease: Power4.easeInOut }
    );
  };

  //スライドの切り替える時間を設定------------
  setInterval(function () {
    index++;
    if (index === slideNum + 1) {
      index = 1;
    }
    slideNext(index);
  }, 5000);
}
