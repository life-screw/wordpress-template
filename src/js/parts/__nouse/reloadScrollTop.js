export function reloadScrollTop() {
  //ページを更新（リフレッシュ）した際に、ページの一番上から表示を始めるようにする
  window.onload = function () {
    if (sessionStorage.getItem("reload")) {
      sessionStorage.removeItem("reload");
      window.scrollTo(0, 0);
    }
  };

  window.onbeforeunload = function () {
    sessionStorage.setItem("reload", "true");
  };
}
