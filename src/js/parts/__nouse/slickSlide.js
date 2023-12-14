export function slickSlide() {
  jQuery.noConflict();
  (function ($) {
    $(function () {
      //スライド
      $(".js-slick01").slick({
        infinite: true, //スライドのループ有効化
        dots: false, //ドットのナビゲーションを表示
        //arrows: false, //前・次の矢印表示
        slidesToShow: 3, //表示するスライドの数
        variableWidth: true, //スライドの幅を、中の要素に合わせる
        centerMode: true, //要素を中央寄せ
        // centerPadding: 0, //両サイドの見えている部分のサイズ
        autoplaySpeed: 2500,
        autoplay: true, //自動再生
        swipeToSlide: true,
        responsive: [
          {
            breakpoint: 778, //ブレークポイントが778px以下
            settings: {
              //   centerMode: false,
              swipeToSlide: true,
              slidesToShow: 1, //表示するスライドの数
            },
          },
        ],
      });
    });
  })(jQuery);
}
