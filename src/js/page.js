//トップページ以外の下層ページ==================================

// 【下層ページ用】ページの完全なロードが完了した後に、フェードアウトアニメーションを起動
import { loadingAnimPage } from "./parts/loadingAnimPage";
loadingAnimPage();
// スクロールするとフェードインする
import { scrollFadeIn } from "./parts/scrollFadeIn";
scrollFadeIn();

// ページ内リンクのスムーススクロール
import { clickSmoothScroll } from "./parts/clickSmoothScroll";
clickSmoothScroll();
