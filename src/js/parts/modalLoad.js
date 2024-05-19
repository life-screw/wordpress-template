//ロードした時ののポップアップ（モーダル）-------
export function modalLoad() {
  if (document.querySelector(".js-modal-load")) {
    const target = document.querySelector(".js-modal-load");
    const closeElements = document.querySelectorAll(
      ".js-modal-load__close,.js-modal-load__bg"
    );
    //クリックしたら閉じる
    closeElements.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.preventDefault();
        target.classList.add("is-close");
      });
    });
  }
}
