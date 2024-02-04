export function reloadScrollTop() {
  //ページを更新（リフレッシュ）した際に、ページの一番上から表示を始めるようにする
  //ページ上の全てのリソースが読み込まれた後に実行（window.onload）
  //×  window.addEventListener("load", function (){・・・});だと、iPhone safariでリロードした際に、ページの一番上に移動しないことがあるので、下記のようにしています。
  //（しかし、iOS 17.2最新版にすると、iPhoneのsafariではページの一番上に移動しない）
  window.addEventListener("load", function () {
    if (sessionStorage.getItem("reload")) {
      sessionStorage.removeItem("reload");
      setTimeout(() => {
        window.scrollTo(0, 0);
      }, 2500); // 2500ミリ秒後にスクロール（ページのレンダリングが安定したタイミングで、かつローディングアニメーションが終わる直前に、ページの一番上に移動）
    }
  });

  window.onbeforeunload = function () {
    sessionStorage.setItem("reload", "true");
  };
}
