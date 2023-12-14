jQuery.noConflict();
(function($) {
  //MW WP FORM
  //エラー用classを付与する
  if ( $('.error')[0] ) {
    $('.mw_wp_form').addClass('mw_wp_form_error');
    $('body').addClass('body__mw_wp_form_error');
  }
  //確認画面用classを付与する
  if( $('.mw_wp_form_confirm')[0]){
    $('body').addClass('body__mw_wp_form_confirm');
  }

  // ajaxzip3で住所を自動入力
  $("#zip").keyup(function() {
    AjaxZip3.zip2addr(this, "", "prefecture", "address1"); // 郵便番号の入力枠が1つなので、第2引数は空白;
  });
})(jQuery);
