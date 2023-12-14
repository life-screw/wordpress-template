export function spSetHeight() {
  /*  高さをウィンドウサイズに合わせる（スマホの時）
	-----------------------------------------------------------------*/
  //ウィンドウサイズを取得
  let w =
    window.innerWidth ||
    document.documentElement.clientWidth ||
    document.body.clientWidth;

  //ウィンドウサイズが768px以上の場合
  if (w <= 768) {
    //高さをウィンドウサイズに合わせる
    window.addEventListener("load", setHeight);
    // window.addEventListener("resize", setHeight);//スマホの可変領域に合わせて高さが変わってしまうので削除。

    function setHeight() {
      let wH =
        window.innerHeight ||
        document.documentElement.clientHeight ||
        document.body.clientHeight;
      // wH += 100; //高さ100pxを足す
      let elements = document.querySelectorAll(".js-fv");
      elements.forEach(function (element) {
        element.style.height = `${wH}px`;
      });
    }
  }
}
