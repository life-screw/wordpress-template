//.js-aboutが画面に入ったら、その中の.js-about__textをスクロール量に合わせてtranslateXでに動くようにする

// ※GSAPとScrollTriggerプラグインの追加が必要
// https://gsap.com/docs/v3/Installation/
// ↓これをHTMLのhead内に追加。ダウンロードしてからパスを指定する方が安全。
/* <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script> */

export function gsapMaxScrollMovingText() {
  //ScrollTriggerと連携
  //ScrollTriggerを使いたい全てのGSAPプロジェクトで一度だけ実行する必要があります。
  gsap.registerPlugin(ScrollTrigger);

  // スクロールアニメーションを初期化する関数=================================
  function initScrollAnimation() {
    // 既存の全てのScrollTriggerイベントをクリア
    ScrollTrigger.getAll().forEach((st) => st.kill());

    // about部分のスクロールアニメーション--------------------------
    // .js-about要素のピン留め
    ScrollTrigger.create({
      markers: true, //マーカー
      trigger: ".js-about",
      start: "top top",
      //   end: "bottom top-=100%", //+スクロール量後に終了
      end: "bottom top",
      pin: true, //trigger要素をピン留め
      pinSpacing: false, //ピン留めされた要素の間隔を設定（falseは間隔なし）
    });

    // 1番目の.js-about__textのアニメーション（左から右へ）
    gsap.fromTo(
      ".js-about__headline--01",
      { xPercent: -120 }, //初期位置（-100だと画面ギリギリのところで隠れる）
      {
        xPercent: 120,
        scrollTrigger: {
          trigger: ".js-about",
          scrub: true, //スクロール量に合わせてアニメーションのスピードを変化させる
        },
      }
    );

    // 2番目の.js-about__textのアニメーション（右から左へ）
    gsap.fromTo(
      ".js-about__headline--02",
      { xPercent: 120 }, //初期位置（100だと画面ギリギリのところで隠れる）
      {
        xPercent: -150,
        scrollTrigger: {
          trigger: ".js-about",
          scrub: true, //スクロール量に合わせてアニメーションのスピードを変化させる
        },
      }
    );

    // .js-about__titleのアニメーション（下から上へフェードイン）
    gsap.fromTo(
      ".js-about__title",
      {
        y: 30, // 50ピクセル下から開始
        opacity: 0, // 透明度を0に設定
      },
      {
        y: 0, // 元の位置まで移動
        opacity: 1, // 完全に不透明に
        duration: 0.2, // アニメーションの時間（秒）
        //ease: "power1.out", // イージング関数
        scrollTrigger: {
          trigger: ".js-about",
          scrub: true, //スクロール量に合わせてアニメーションのスピードを変化させる
        },
      }
    );

    //.js-about__linkのアニメーション(フェードインしながら大きくなる)
    gsap.fromTo(
      ".js-about__link",
      {
        scale: 1, // 大きさを0.8倍に
        opacity: 0, // 透明度を0に設定
      },
      {
        scale: 1.4, // 大きさ
        opacity: 1, // 完全に不透明に
        duration: 0.5, // アニメーションの時間（秒）
        ease: "power1.out", // イージング関数
        scrollTrigger: {
          trigger: ".js-about",
          start: "top 50%", // ビューポートの上部が要素の下80%に達した時に開始
          //toggleActions: "play none none none", // スクロール時のアニメーション動作を設定
        },
      }
    );
  }
  //ページ上のすべてのリソースが読み込まれてから実行
  window.addEventListener("load", initScrollAnimation);

  // リサイズイベントに対応するためのdebounce関数を設定する------------------
  //（debounceは、特定の関数の頻繁な呼び出しを制限するためのテクニックのこと。リサイズなどで短い時間間隔で何度も発生するイベントの処理に効果があります。）
  function debounce(func, wait, immediate) {
    var timeout;
    return function () {
      var context = this,
        args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(function () {
        timeout = null;
        if (!immediate) func.apply(context, args);
      }, wait);
      if (immediate && !timeout) func.apply(context, args);
    };
  }

  // リサイズイベントが発生するとアニメーションをリフレッシュ
  const debouncedResize = debounce(() => {
    initScrollAnimation();
  }, 250);

  window.addEventListener("resize", debouncedResize);
  // ドキュメントの読み込みが完了したらアニメーションを初期化
  //   document.addEventListener("DOMContentLoaded", initScrollAnimation);
}
