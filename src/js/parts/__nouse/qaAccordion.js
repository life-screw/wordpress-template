// QAアコーディオン（ウィンドウサイズが768px以上のときにリサイズする）====================
export function qaAccordion() {
  window.addEventListener("load", initializeAccordion);
  window.addEventListener("resize", resizeAccordion);

  function initializeAccordion() {
    setAccordionHeights();
    setupAccordionButtons();
  }

  function setAccordionHeights() {
    //.js-accordionに.is-activeクラスがあるか調べる
    document.querySelectorAll(".js-accordion").forEach(function (accordion) {
      const content = accordion.querySelector(".js-accordion-contents");
      if (accordion.classList.contains("is-active")) {
        // .is-active クラスがある場合、開いた状態にする
        content.style.display = "block"; //必要に応じて"block"に設定
        content.style.height = "auto"; //一旦高さをリセット
        const newHeight = content.scrollHeight + "px";
        requestAnimationFrame(() => {
          content.style.height = newHeight; //再計算した高さを設定
        });
      } else {
        // .is-active クラスがない場合、閉じる
        content.style.height = "0px";
        content.style.display = "none";
      }
    });
  }

  //アコーディオンボタンのクリックイベント
  function setupAccordionButtons() {
    document.querySelectorAll(".js-accordion-btn").forEach(function (btn) {
      btn.addEventListener("click", function () {
        const parentAccordion = this.closest(".js-accordion");
        if (parentAccordion) {
          parentAccordion.classList.toggle("is-active");

          const nextContent = this.nextElementSibling;

          // ボタンに隣接する.js-accordion-contentsの表示切り替え
          if (
            nextContent &&
            nextContent.classList.contains("js-accordion-contents")
          ) {
            toggleSlide(nextContent);
          }
        }
      });
    });
  }

  // js-accordion-contentsの表示切り替えの処理内容
  function toggleSlide(element) {
    //指定された要素のスタイルを取得
    let computedStyle = window.getComputedStyle(element);
    //指定された要素が非表示かどうかを判定
    let isHidden =
      computedStyle.display === "none" || computedStyle.height === "0px";

    //非表示の場合は、表示状態にする
    if (isHidden) {
      element.style.display = "block";
      element.style.height = "0px"; // 明示的に設定

      requestAnimationFrame(() => {
        element.style.height = element.scrollHeight + "px";
      });
    } else {
      element.style.height = "0px";
      element.addEventListener("transitionend", function transitionEnd(event) {
        //CSSのtransitionプロパティの変化が終わり、かつ、高さが0pxになったら発火
        if (event.propertyName === "height" && element.style.height === "0px") {
          //displayプロパティをnoneにすることで、要素が非表示になる
          element.style.display = "none";
          //イベントリスナーを削除
          element.removeEventListener("transitionend", transitionEnd);
        }
      });
    }
  }

  // ウィンドウ幅が768px以上の場合のみ実行
  function resizeAccordion() {
    if (window.innerWidth >= 768) {
      setAccordionHeights();
    }
  }
}

// アコーディオン要素にこのCSSを設定
// .js-accordion-contents { transition: height 300ms; overflow: hidden; }

// アコーディオンのPug
// dl.p-qa.js-accordion.is-active //- .is-activeをつけると開いた状態になる
// 	dt.p-qa__question.js-accordion-btn
// 		span.p-qa__question-main ボタンタイトル
// 		span.p-qa__question-toggle
// 	dd.p-qa__answer.js-accordion-contents
// 		この中に内容を入れる
