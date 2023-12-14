//【jQuery不要】ページ遷移でアンカーリンク先に飛ばす時、追従ヘッダーに被らないようにしたい。
//DOMが読み込まれてから実行
window.addEventListener("load", function(){
  //現在ページのURLのハッシュ部分を取得
  const url = window.location.hash;//#issue 

  if(url){
    const target = url.slice(1);//issue

    //targetで取得したid名を持ったオブジェクトを取得
    const link = document.getElementById(target);//<div id="issue" ...</div

    //ヘッダーの高さ取得
    const headerHeight = document.getElementById("js-header").clientHeight;
    console.log("headerHeight" + headerHeight);

    //ストロール位置からヘッダーの高さを引く
    let linkTop = link.offsetTop - headerHeight;
    //指定された要素内を指定された座標までスクロール。（第一引数はx軸、第二引数はy軸）
    window.scrollTo(0, linkTop);
  }
});