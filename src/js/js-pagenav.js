jQuery.noConflict();
(function ($) {
  //今開いているページ（カレントページ）であるメニューliの子要素のhrefを取得して、liにクラスをつける
  $(function(){
      $('.js-link').each(function(){
          var $href = $('a',this).attr('href');
          if(location.href.match($href)) {
          $(this).addClass('is-active');
          } else {
          $(this).removeClass('is-active');
          }
      });
  });

})(jQuery);