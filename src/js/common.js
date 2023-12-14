//ハンバーガーメニュー===========
import { hamburgerMenu } from "./parts/hamburgerMenu";
hamburgerMenu();

//ハンバーガーメニューのSVGパスのアニメーション===============
import { gsapHamburgerAnimation } from "./parts/gsapHamburgerAnimation";
gsapHamburgerAnimation();

// マウスストーカーのアニメーション（PCのみ）===================
import { mousePointer } from "./parts/mousePointer";
mousePointer();

//ページ上部へスムーススクロール.js=========================
import { smoothScrollToTop } from "./parts/smoothScrollToTop";
smoothScrollToTop();

// document.addEventListener("DOMContentLoaded", function (e) {
//   const loaded = document.getElementById("load");
//   loaded.classList.add("js-loadanim");
// });

// jQuery.noConflict();
// (function ($) {
// $(window).scroll(function () {
//   //スクロールするとフェードインする
//   $(".js-fadein").each(function () {
//     var elemPos = $(this).offset().top;
//     var scroll = $(window).scrollTop();
//     var windowHeight = $(window).height();
//     if (scroll > elemPos - windowHeight + 200) {
//       $(this).addClass("js-scrollin");
//     }
//   });
// });
//   $(function () {
//     //トップへ戻るボタン
//     const pagetop = $(".l-pagetop");
//     pagetop.click(function () {
//       $("body, html").animate({ scrollTop: 0 }, 500);
//       return false;
//     });

//     //.l-contact内の電話のリンクを取得して飛ばす
//     $(".js-transition").on("click", function (e) {
//       //伝播をストップ
//       e.stopPropagation();
//       e.preventDefault();
//       //リンクを取得して飛ばす
//       location.href = $(this).attr("data-url");
//     });
//   });
// })(jQuery);
