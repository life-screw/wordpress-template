export function gsapHamburgerAnimation() {
  //ハンバーガーメニューのSVGパスのアニメーション===============
  document.addEventListener("DOMContentLoaded", function () {
    const path01 = document.getElementById("hum-path01");
    const path02 = document.getElementById("hum-path02");
    const hamburger = document.getElementById("hum-path");

    //中継のパス
    const midPath01a = "m1 9.9s4.9-4.3 16.2-7.3c8.9-2.3 16.2-1.5 16.2-1.5"; //1本目の線の中継パス
    const midPath02a = "m1 18.8s4.9-4.3 16.2-7.3c8.9-2.3 16.3-1.5 16.3-1.5"; //2本目の線の中継パス

    // それぞれのパスのバツ印への最終形
    const endPath01 = "m1 9.8 32.5-8.8"; // 1本目の線
    const endPath02 = "m1 1 32.5 8.8"; // 2本目の線

    let animation = gsap
      .timeline({ paused: true, reversed: true })
      .to(path01, {
        attr: { d: midPath01a },
        duration: 0.25,
        ease: "power3.in", //イージングの参考 https://ics-creative.github.io/220822_gsap_examples/to_ease.html
      })
      .to(
        path02,
        { attr: { d: midPath02a }, duration: 0.25, ease: "power3.in" },
        "<" //"<"はマーカーで、path01とpath02が同時に動くようにしている
      )
      .to(path01, {
        attr: { d: endPath01 },
        duration: 0.25,
        ease: "power3.out",
      })
      .to(
        path02,
        { attr: { d: endPath02 }, duration: 0.25, ease: "power3.out" },
        "<" //"<"はマーカーで、path01とpath02が同時に動くようにしている
      );

    hamburger.addEventListener("click", function () {
      if (animation.reversed()) {
        animation.play();
      } else {
        animation.reverse();
      }
    });
  });
}
