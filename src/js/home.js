//ローディングアニメーション=========
import { loadingAnim } from "./parts/loadingAnim";
loadingAnim();

//ページを更新（リフレッシュ）した際に、ページの一番上から表示を始めるようにする
// import { reloadScrollTop } from "./parts/reloadScrollTop";
// reloadScrollTop();

// // 高さをウィンドウサイズに合わせる（スマホの時）======
// import { spSetHeight } from "./parts/spSetHeight";
// spSetHeight();

//ページをめくるように切り替わるスライダー（2つ同時に動く）===============
import { gsapFvSlider } from "./parts/gsapFvSlider";
gsapFvSlider();

//background-attachment: fixedのように、スクロール範囲に合わせて画像・動画を固定する
import { bgFixImages } from "./parts/bgFixImages";
bgFixImages();

// GSAPのscrollTriggerスライドのナンバリングとナビゲーションの自動生成
import { countTotalSlide, countTotalSlide02 } from "./parts/countTotalSlide";
countTotalSlide();
countTotalSlide02();

// import Swiper JS（v11.0.5）====================
//【無限ループさせるときの注意】
// スライドの枚数ですが、一度に表示させるスライド数よりも多く設定する必要がある。
// 例えば、一度に表示させるスライド数が3枚の場合、4枚以上のスライドを用意する必要がある。
// 参考：https://swiperjs.com/swiper-api#param-loop（loop部分）

// core version + navigation, pagination modules:
import Swiper from "swiper";
import { Autoplay, Navigation } from "swiper/modules";
// import Swiper and modules styles
import "swiper/css";
import "swiper/css/autoplay";
// import "swiper/css/free-mode";
import "swiper/css/navigation";

// init Swiper:
const swiper01 = new Swiper(".js-swiper-main", {
  // configure Swiper to use modules
  modules: [Navigation, Autoplay],
  //Parameter(no modules)----------------
  slidesPerView: 1, // コンテナ内に表示させるスライド数（CSSでサイズ指定する場合は 'auto'）
  spaceBetween: 0, // スライド間の余白（px、%の場合は"20%"で囲む）
  centeredSlides: true, // アクティブなスライドを中央に配置する

  loop: true, // 無限ループさせる
  loopAdditionalSlides: 1, // 無限ループさせる場合に複製するスライド数

  allowTouchMove: true, // マウスドラッグによるスライド移動を有効にする
  breakpoints: {
    // ブレークポイント
    769: {
      // 画面幅769px以上で適用
      slidesPerView: 2, //centeredSlidesで偶数だと、両橋が切れるようになる
      //   spaceBetween: 0, // スライド間の余白（px、%の場合は"20%"で囲む）
      navigation: {
        enabled: false,
      },
    },
  },
  //Navigation--------------
  speed: 500, // スライドアニメーションのスピード（ミリ秒）

  // Navigation arrows
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  //Autoplay--------------
  autoplay: {
    // 自動再生させる
    delay: 5000, // 次のスライドに切り替わるまでの時間（ミリ秒）
    disableOnInteraction: false, // ユーザーが操作しても自動再生を止めない
    waitForTransition: false, // アニメーションの間も自動再生を止めない（最初のスライドの表示時間を揃えたいときに）
  },
});

// 横方向に流れ続ける無限ループスライダー
// 参考：https://junpei-sugiyama.com/swiper-loop/
const swiper02 = new Swiper(".js-swiper-sub", {
  // configure Swiper to use modules
  modules: [Autoplay],
  //Parameter(no modules)----------------
  slidesPerView: 5, //CSSでスライドのサイズ指定する場合は 'auto'
  loop: true,
  allowTouchMove: false,
  speed: 2000,
  breakpoints: {
    // ブレークポイント
    769: {
      // 画面幅769px以上で適用
      slidesPerView: 11,
    },
  },
  //Autoplay--------------
  autoplay: {
    delay: 0,
    disableOnInteraction: false, // ユーザーが操作しても自動再生を止めない
    reverseDirection: true, // 逆方向有効化
  },
});

// GSAPのscrollTriggerを使ったスクロールアニメーション
//【注意】⚠️ピン留め注意
//・高さ計測やスクロール量を取得するのJavaScriptに干渉し、上手く動かなくなるので注意!!!!!!!!!!!!!
//・ピン留めするアニメーションの要素は、下の要素の下に潜り込むので、「親要素にoverflow:hidden;」をつけたり、「下の要素に、z - index: 1; position: relative」をつけるなどして対応する必要がある。!!!!!!!!!!!!!
import { gsapScrollMovingText } from "./parts/gsapScrollMovingText";
gsapScrollMovingText();
