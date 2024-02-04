//.js-aboutが画面に入ったら、その中の.js-about__textをスクロール量に合わせてtranslateXでに動くようにする

// ※GSAPとScrollTriggerプラグインの追加が必要
// https://gsap.com/docs/v3/Installation/
// ↓これをHTMLのhead内に追加。ダウンロードしてからパスを指定する方が安全。
/* <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/ScrollTrigger.min.js"></script> */

//ピン留めのアニメーション設定のコツ
//1.一つのピン留めに対して、複数のアニメーションを設定する場合は、startのタイミングを同じにするとがたつきにくくなる。

export function gsapScrollMovingText() {
  //ScrollTriggerと連携
  //ScrollTriggerを使いたい全てのGSAPプロジェクトで一度だけ実行する必要があります。
  gsap.registerPlugin(ScrollTrigger);

  // スクロールアニメーションを初期化する関数=================================
  function initScrollAnimation() {
    // 既存の全てのScrollTriggerイベントをクリア（リサイズした時にリセットする）
    ScrollTrigger.getAll().forEach((st) => st.kill());

    // about部分のスクロールアニメーション--------------------------
    // .js-about要素のピン留め
    ScrollTrigger.create({
      //   markers: true, //マーカー
      trigger: ".js-about",
      start: "top top",
      end: "bottom top", // トリガーの下端が、ビューポートの上端に達した時に終了
      pin: true, //trigger要素をピン留め
      pinSpacing: false, //ピン留めされた要素の間隔を設定（falseは間隔なし）
      anticipatePin: 1, //高速スクロール時画面ずれ防止。ピン留めの動作が発生する前に少し前もって対応するアニメーションを開始するために使用
    });

    // 1番目の.js-about__textのアニメーション（左から右へ）
    if (document.querySelectorAll(".js-about__headline--01").length) {
      gsap.fromTo(
        ".js-about__headline--01",
        { xPercent: -100 }, //初期位置（-100だと画面ギリギリのところで隠れる）
        {
          xPercent: 120,
          scrollTrigger: {
            trigger: ".js-about",
            start: "top bottom",
            end: "top+=70%", //トリガーの上端が、ビューポートの上端から70%の位置に達した時に終了
            scrub: true, //スクロール量に合わせてアニメーションのスピードを変化させる
          },
        }
      );
    }

    // 2番目の.js-about__textのアニメーション（右から左へ）
    if (document.querySelectorAll(".js-about__headline--02").length) {
      gsap.fromTo(
        ".js-about__headline--02",
        { xPercent: 100 }, //初期位置（100だと画面ギリギリのところで隠れる）
        {
          xPercent: -160,
          scrollTrigger: {
            trigger: ".js-about",
            start: "top bottom",
            end: "top+=70%",
            scrub: true, //スクロール量に合わせてアニメーションのスピードを変化させる
          },
        }
      );
    }

    // .js-about__titleのアニメーション（下から上へフェードイン）
    if (document.querySelectorAll(".js-about__title").length) {
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
            start: "top bottom",
            scrub: true, //スクロール量に合わせてアニメーションのスピードを変化させる
          },
        }
      );
    }

    //.js-about__linkのアニメーション(フェードインしながら大きくなる)
    if (document.querySelectorAll(".js-about__link").length) {
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
          delay: 1, //アニメーションの遅延時間
          ease: "power1.out", // イージング関数
          scrollTrigger: {
            trigger: ".js-about",
            start: "top 80%",
            //toggleActions: "play none none none", // スクロール時のアニメーション動作を設定
          },
        }
      );
    }

    // PRODUCE部分のスクロールアニメーション--------------------------
    // .js-appeal-navをピン留め----------
    // 最初のセクションと最後のセクションを取得
    const firstAppeal = document.querySelector(".js-appeal:first-of-type");
    const lastAppeal = document.querySelector(".js-appeal:last-of-type");
    const appealNav = document.querySelector(".js-appeal-nav");

    // .js-appeal-navをピン留めするScrollTriggerを作成
    ScrollTrigger.create({
      trigger: firstAppeal,
      start: "top top", // 最初のセクションが上部に来たときに開始
      endTrigger: lastAppeal, // 最後のセクションに基づいて終了を決定
      end: "bottom bottom", // 最後のセクションが下部に来たときに終了
      pin: appealNav, // ピン留めする要素
      pinSpacing: false, // ピン留めされた要素の間隔を無くす
    });

    // .js-appeal-wrap関連の変数定義
    const appealWrap = document.querySelector(".js-appeal-wrap");
    const appealInner = document.querySelector(".js-appeac-inner");
    const appeals = document.querySelectorAll(".js-appeal");

    // .js-appeal-wrapをピン留め--------
    ScrollTrigger.create({
      trigger: appealWrap,
      start: "top top",
      end: "bottom top",
      pin: true,
      pinSpacing: false, // ピン留めされた要素の間隔を無くす
      anticipatePin: 1, //高速スクロール時画面ずれ防止。ピン留めの動作が発生する前に少し前もって対応するアニメーションを開始するために使用
    });

    //.js-appeac-innerのアニメーション----
    // .js-appeal-wrapがビューポートの50%に入ったら、.js-appeac-innerのclip-pathを変更
    if (appealInner) {
      gsap.fromTo(
        appealInner,
        {
          clipPath: "inset(0 8% 0 8%)", // 両端がすこし隠れた状態で開始
        },
        {
          clipPath: "inset(0 0% 0 0%)", // 完全に展開
          ease: "none",
          scrollTrigger: {
            trigger: appealWrap,
            start: "top 50%",
            end: "top top", // .js-appeal-wrapの先端がビューポート上部に到達するまで
            scrub: true,
            onEnterBack: () => {
              //onEnterBackは、スクロールが上向き（ユーザーがページを上にスクロールしている時）のときにトリガー要素がビューポートの上部に入るときに発火します。
              appealInner.classList.remove("is-active");
              appealNav.classList.remove("is-active");
              startAppealAnimation(); //このアニメーションが終わったら、各.js-appealのアニメーションを開始
            },
            onLeave: () => {
              // onLeaveは、スクロールが下向き（通常、ユーザーがページを下にスクロールしている時）のときにトリガー要素がビューポートの上部を通過して離れるときに発火します。
              appealInner.classList.add("is-active");
              appealNav.classList.add("is-active");
            },

            //   onLeaveBack: () => appealInner.classList.remove("is-active"), //onLeaveBackは、スクロールが上向き（通常、ユーザーがページを上にスクロールしている時）のときにトリガー要素がビューポートの下部を通過して離れるときに発火します。
          },
        }
      );
    }

    // ナビゲーション項目（.js-appeal-navの子要素）の取得
    const appealNavItems = document.querySelectorAll(
      ".js-appeal-nav .nav-list"
    );

    // 各.js-appeal要素のアニメーション--------
    //appealInnerに連動させるために、timelineでアニメーションを作成
    function startAppealAnimation() {
      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: appealWrap,
          start: "top top",
          end: "bottom top",
          scrub: true,
        },
      });

      appeals.forEach((appeal, index) => {
        const isLastElement = index === appeals.length - 1;
        // .js-appealのclipPathアニメーション
        // 最後の要素でなければ、clipPathアニメーションを実行
        if (!isLastElement) {
          tl.to(
            appeal,
            {
              clipPath: "inset(0 0 100% 0)",
              duration: 0.2, //アニメーションの時間
              ease: "none",
              delay: 1, //アニメーションの遅延時間
              onStart: () => setActiveAppealNavItem(index + 1), //アニメーション開始したら、アクティブなナビゲーション項目を設定
              onReverseComplete: () => setActiveAppealNavItem(index), //アニメーションが逆再生完了したら前のナビゲーション項目をアクティブにする
            },
            index * 1.5
          ); // 各要素のアニメーションを1.5秒ごとにずらす
        }

        // .js-appeal__imgのscaleアニメーション
        const img = appeal.querySelector(".js-appeal__img");
        tl.to(
          img,
          {
            scale: 1.05,
            duration: 1,
            ease: "none",
          },
          index * 1.5
        ); // clipPathアニメーションと同じタイミングにする

        // .js-appeal__textareaのアニメーション
        const textarea = appeal.querySelector(".js-appeal__textarea");
        tl.to(
          textarea,
          {
            opacity: 1,
            duration: 0.2,
            ease: "none",
          },
          index * 1.5 // clipPathアニメーションと同じタイミングにする
        );
      });
    }

    //アクティブなナビゲーション項目を設定する関数
    function setActiveAppealNavItem(activeIndex) {
      appealNavItems.forEach((navItem, index) => {
        if (index === activeIndex) {
          navItem.classList.add("is-active"); // 対応するナビゲーション項目に.is-activeを追加
        } else {
          navItem.classList.remove("is-active"); // 対応するナビゲーション項目から.is-activeを削除
        }
      });
    }

    // .js-appeac-innerのアニメーションが終わったらアニメーションを開始
    startAppealAnimation();

    // service部分のスクロールアニメーション--------------------------
    // .js-service-navをピン留め----------
    // 最初のセクションと最後のセクションを取得
    const firstSection = document.querySelector(".js-service:first-of-type");
    const lastSection = document.querySelector(".js-service:last-of-type");

    // .js-service-navをピン留めするScrollTriggerを作成
    ScrollTrigger.create({
      trigger: firstSection,
      start: "top top", // 最初のセクションが上部に来たときに開始
      endTrigger: lastSection, // 最後のセクションに基づいて終了を決定
      end: "bottom top", // 最後のセクションが下部に来たときに終了
      pin: ".js-service-nav", // ピン留めする要素
      pinSpacing: false, // ピン留めされた要素の間隔を無くす
    });

    // .js-serviceの各セクションをアニメーション設定---------
    // ナビゲーション項目（.js-service-navの子要素）の取得
    const sectionNavItems = document.querySelectorAll(
      ".js-service-nav .nav-list"
    );
    // .js-serviceの各セクションのピン留めとフェードインのアニメーションを作成
    document.querySelectorAll(".js-service").forEach((section, index) => {
      gsap.timeline({
        scrollTrigger: {
          trigger: section,
          start: "top top", // セクションが画面の上部に来たときに開始
          end: "bottom top", // セクションが画面の下部に達したときに終了
          pin: true, // セクションをピン留め
          pinSpacing: false, // ピン留めされたセクション間のスペースを無くす

          //   invalidateOnRefresh: true, //画面リサイズ時の値再計算
          anticipatePin: 1, //高速スクロール時画面ずれ防止。ピン留めの動作が発生する前に少し前もって対応するアニメーションを開始するために使用
          scrub: true, // スクロールに合わせてアニメーションを調整
          onEnter: () => {
            section.classList.add("is-active"); // セクションがビューポートに入るときに.is-activeを追加
            setActiveSectionNavItem(index); // 下にスクロール時にアクティブなナビゲーション項目を設定
          },
          onLeaveBack: () => {
            section.classList.remove("is-active"); // セクションがビューポートから離れるときに.is-activeを削除
            // if (index === 0) {
            //   setActiveSectionNavItem(-1); //最初のセクションで上にスクロール時に全てのナビゲーションから.is-activeを削除
            // }
          },
          onEnterBack: () => {
            setActiveSectionNavItem(index); // 上にスクロール時にアクティブなナビゲーション項目を設定
          },
        },
      });
    });

    //アクティブなナビゲーション項目を設定する関数
    function setActiveSectionNavItem(activeIndex) {
      sectionNavItems.forEach((sectionNavItem, index) => {
        if (index === activeIndex) {
          sectionNavItem.classList.add("is-active"); // 対応するナビゲーション項目に.is-activeを追加
        } else {
          sectionNavItem.classList.remove("is-active"); // 対応するナビゲーション項目から.is-activeを削除
        }
      });
    }

    //.js-grand-menuのピン留めアニメーション---------
    ScrollTrigger.create({
      trigger: ".js-grand-menu",
      start: "top top", // 最初のセクションが上部に来たときに開始
      end: "bottom bottom", // 最後のセクションが下部に来たときに終了
      pin: ".js-grand-menu", // ピン留めする要素
      pinSpacing: "30svh", // ピン留めされた要素の間隔を無くす
      anticipatePin: 1, //高速スクロール時画面ずれ防止。ピン留めの動作が発生する前に少し前もって対応するアニメーションを開始するために使用
    });

    //.js-pin-area--02のピン留めアニメーション---------
    ScrollTrigger.create({
      trigger: ".js-pin-area--02",
      start: "top top", // 最初のセクションが上部に来たときに開始
      end: "bottom bottom", // 最後のセクションが下部に来たときに終了
      //   pin: ".js-pin-area--02", // ピン留めする要素
      //   pinSpacing: false, // ピン留めされた要素の間隔を無くす
    });

    //.js-footerのピン留めアニメーション---------
    ScrollTrigger.create({
      trigger: ".js-footer",
      start: "top top", // 最初のセクションが上部に来たときに開始
      end: "bottom bottom", // 最後のセクションが下部に来たときに終了
      //   pin: ".js-footer", // ピン留めする要素
      //   pinSpacing: false, // ピン留めされた要素の間隔を無くす
    });
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

  // リサイズイベントが発生するとアニメーションをリフレッシュ（PCの時のみ）
  const debouncedResize = debounce(() => {
    // PCのときに実行
    if (window.matchMedia("(min-width: 769px)").matches) {
      initScrollAnimation();
    }
  }, 250);

  window.addEventListener("resize", debouncedResize);
  // ドキュメントの読み込みが完了したらアニメーションを初期化
  //   document.addEventListener("DOMContentLoaded", initScrollAnimation);
}
