import "../styles/index.scss";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(ScrollToPlugin);
import marquee from "vanilla-marquee";
import customSelect from "custom-select";

const isTouchScreen =
  navigator.userAgent.match(/Android/i) ||
  navigator.userAgent.match(/webOS/i) ||
  navigator.userAgent.match(/iPhone/i) ||
  navigator.userAgent.match(/iPad/i) ||
  navigator.userAgent.match(/iPod/i);
const gsapMatchMedia = gsap.matchMedia();

document.addEventListener("DOMContentLoaded", () => {
  fullScreenMenu();
  initMarquee();
  initAccordion();
  videoPlayer();
  initSwiperMobileGallery();
  initSelect();
  initModals();
  gsapAnimations();
  dropdown();
  fixHeaderOnScroll();
  animTitleRedLine();
  fade();

  document.body.style.visibility = "visible";
  document.body.style.opacity = "1";

  console.log("content loaded");
});

const fade = () => {
  const SELECTORS = {
    el: ".js-fade-el",
  };

  const $fadeEl = document.querySelectorAll(SELECTORS.el);
  if ($fadeEl.length) {
    gsap.set($fadeEl, {
      y: 40,
      opacity: 0,
    });

    ScrollTrigger.batch($fadeEl, {
      start: "top 85%",
      once: true,
      onEnter: (batch) =>
        gsap.to(batch, {
          duration: 0.4,
          opacity: 1,
          y: 0,
          stagger: 0.1,
          ease: "none",
        }),
    });
  }
};

const exist = (elementOrArray) => {
  if (!elementOrArray && elementOrArray !== 0) return false;
  if (elementOrArray.length === 0) {
    return false;
  }
  return true;
};

window.addEventListener("resize", () => {});

function animTitleRedLine() {
  // const items = document.querySelectorAll(".decor_line_wrapper");
  const items = document.querySelectorAll(".js-anim-line");

  if (!items.length) return;

  items.forEach((item, index) => {
    gsap.set(item, {
      rotation: 135,
      background: "#882929",
      scaleX: 0,
      transformOrigin: "0% 0%",
    });

    const anim = gsap.to(item, {
      scaleX: 1,
      ease: "none",
      paused: true,
    });

    ScrollTrigger.create({
      trigger: item,
      animation: anim,

      start: "center center",
      end: `center+=${item.dataset.srollerEnd || 0} top`,
      once: true,
      // markers: true,
      scrub: 1,
    });
  });
}

function fixHeaderOnScroll() {
  let previousScrollPosition = 0;
  const header = document.querySelector(".header");

  if (!header) return;

  window.addEventListener("scroll", () => {
    if (isScrollingDown() === false) {
      header.classList.add("fixed");
    } else {
      header.classList.remove("fixed");
    }

    if (window.scrollY > 0) {
      header.classList.remove("header--start-pos");
    } else {
      header.classList.add("header--start-pos");
    }

    // console.log(window.scrollY);
  });
  // console.log(previousScrollPosition);

  function isScrollingDown() {
    let goingDown = false;

    let scrollPosition = window.scrollY;

    // if (scrollPosition > 30) {
    //   header.style.paddingTop = "1rem";
    // } else {
    //   header.style.paddingTop = "3.3rem";
    // }

    if (scrollPosition > previousScrollPosition) {
      goingDown = true;
      header.classList.add("header-scrolling");
    } else {
      header.classList.remove("header-scrolling");
    }

    previousScrollPosition = scrollPosition;

    return goingDown;
  }
}

function dropdown() {
  const activeClass = "show";
  const select = "lang-select";

  document.addEventListener("click", function (e) {
    let shareEl = e.target.closest("." + select);
    if (!shareEl && e.target.classList.contains(select)) {
      shareEl = e.target;
    } else if (shareEl) {
      shareEl.classList.toggle(activeClass);
    }

    document
      .querySelectorAll("." + select + "." + activeClass)
      .forEach((el) => {
        if (!shareEl || el !== shareEl) {
          el.classList.remove(activeClass);
        }
      });
  });
}

function initModals() {
  const open_btns = document.querySelectorAll("[toggle-modal]");
  const close_btns = document.querySelectorAll(".modal .btn-close");
  const overlay = document.querySelector(".modal-overlay");

  if (open_btns) {
    open_btns.forEach((el) => {
      el.addEventListener("click", function (event) {
        event.preventDefault();
        const id = this.getAttribute("toggle-modal");
        document.querySelector(`#${id}`).classList.add("show");
        document.body.classList.add("modal-open");
      });
    });
  }

  if (close_btns) {
    close_btns.forEach((el) => {
      el.addEventListener("click", function (event) {
        event.preventDefault();
        el.parentNode.parentNode.classList.remove("show");
        document.body.classList.remove("modal-open");
      });
    });
  }

  if (overlay) {
    overlay.addEventListener("click", function (e) {
      if (e.target == overlay) {
        document.querySelector(".modal.show").classList.remove("show");
        document.body.classList.remove("modal-open");
      }
    });
  }
}

function initSelect() {
  const selectEl = require("custom-select").default;
  customSelect("select");
}

function initSwiperMobileGallery() {
  const slider = document.querySelector(".swiper-mobile-gallery");

  if (slider && window.innerWidth < 992) {
    console.log(Swiper);
    console.log(slider);

    const swiper = new Swiper(slider, {
      spaceBetween: 8,
      slidesPerView: "auto",
      loop: true,
      centeredSlides: true,
    });

    const container = document.querySelector(
      ".swiper-mobile-gallery .swiper-wrapper"
    );
    const blocks = document.querySelectorAll(
      ".swiper-mobile-gallery .swiper-slide"
    );

    if (blocks.length > 0) {
      for (var i = 0; i < 3; i++) {
        const newBlock = blocks[i].cloneNode(true);
        container.appendChild(newBlock);
      }
    }
  }
}

function videoPlayer() {
  const videoBlock = document.querySelectorAll(".video-holder");

  if (videoBlock && videoBlock.length > 0) {
    videoBlock.forEach((block) => {
      block.addEventListener("click", () => {
        if (block.classList.contains("playing")) {
          block.classList.remove("playing");
          block.querySelector("video").pause();
        } else {
          block.classList.add("playing");
          block.querySelector("video").play();
        }
      });
    });
  }
}

function fullScreenMenu() {
  const btn = document.querySelector(".header .btn-toggle-menu");
  const menu = document.querySelector(".header .main-navigation");
  const links = menu.querySelectorAll(".header .main-navigation li");
  const lang_list = menu.querySelectorAll(".langs-list");

  function onStart() {
    document.body.classList.add("menu-opened");
    btn.classList.add("open");
  }

  function onComplete() {
    document.body.classList.remove("menu-opened");
    btn.classList.remove("open");
  }

  gsapMatchMedia.add("(max-width: 1200px)", () => {
    console.log("max-1200");

    const tl = gsap.timeline({
      paused: true,
    });

    gsap.set(links, { y: 30, opacity: 0 });
    gsap.set(lang_list, { y: 30, opacity: 0 });

    tl.to(menu, {
      duration: 0.8,
      opacity: 1,
      height: "100%",
      ease: "expo.inOut",
    });
    tl.to(links, {
      y: 0,
      opacity: 1,
      stagger: 0.15,
      ease: "power4.out",
    });
    tl.to(
      lang_list,
      { duration: 0.4, y: 0, opacity: 1, ease: "expo.inOut" },
      "-=.3"
    );
    tl.reverse();

    btn.addEventListener("click", (e) => {
      e.preventDefault();
      if (document.body.classList.contains("menu-opened")) {
        onComplete();
        tl.reversed(!tl.reversed());
        document.body.classList.remove("menu-opened");
      } else {
        onStart();
        tl.play();
        document.body.classList.add("menu-opened");
      }
    });
  });
}

function initMarquee() {
  const marqueeBlocks = document.querySelectorAll("[marquee]");

  if (marqueeBlocks && marqueeBlocks.length > 0) {
    marqueeBlocks.forEach((element) => {
      new marquee(element, {
        duplicated: true,
        direction: "left",
        speed: 20,
        startVisible: true,
        gap: 0,
        delayBeforeStart: 0,
      });
    });
  }
}

function initAccordion() {
  var accordions = document.querySelectorAll("[accordion-item]");
  var accordionsBody = document.querySelectorAll(".accordion-collapse");

  if (accordions.length > 0) {
    function heightDelete(arrayOfItems) {
      for (const item of arrayOfItems) {
        item.style.maxHeight = null;
      }
    }

    function deleteClass(arrayOfItems, className) {
      for (const item of arrayOfItems) {
        item.classList.remove(className);
      }
    }

    accordions.forEach((item) => {
      item
        .querySelector(".accordion-header")
        .addEventListener("click", function (e) {
          e.preventDefault();

          if (item.classList.contains("open")) {
            item.classList.remove("open");
            item.querySelector(".accordion-collapse").style.maxHeight = null;
          } else {
            deleteClass(accordions, "open");
            item.classList.add("open");
            heightDelete(accordionsBody);
            item.querySelector(".accordion-collapse").style.maxHeight =
              item.querySelector(".accordion-collapse").scrollHeight + "px";
          }
        });

      if (item.classList.contains("open")) {
        item.querySelector(".accordion-collapse").style.maxHeight =
          item.querySelector(".accordion-collapse").scrollHeight + "px";
      }
    });
  }
}

function gsapAnimations() {
  homePageAnimtaions();
  footerAnimation();
  introAnimation();

  function footerAnimation() {
    const footer = gsap.timeline({
      scrollTrigger: {
        trigger: ".footer",
        start: "top bottom-=200",
        end: "bottom center",
        // markers: true,
        onEnter: () => footer.play(),
      },
    });

    footer
      .from(
        ".footer-block",
        {
          ease: "line",
          delay: 0.5,
          opacity: 0,
          scale: 0.97,
          duration: 0.6,
          stagger: 0.2,
        },
        "-=.2"
      )
      .from(
        ".footer_decor_circle",
        {
          ease: "line",
          opacity: 0,
          scale: 0,
          duration: 0.4,
        },
        "-=.4"
      );
  }

  function introAnimation() {
    const page = document.querySelectorAll(".js-intro-w");

    if (!exist(page)) return;

    const introFade = () => {
      const SELECTORS = {
        el: ".js-anim-intro-el",
      };

      const $fadeEl = document.querySelectorAll(SELECTORS.el);
      if ($fadeEl.length) {
        gsap.set($fadeEl, {
          y: 40,
          opacity: 0,
        });

        gsap.to($fadeEl, {
          duration: 0.6,
          opacity: 1,
          y: 0,
          stagger: 0.1,
          ease: "none",
        });
      }
    };

    introFade();

    const introAnimationLine = () => {
      const items = document.querySelectorAll(".js-anim-intro-line");

      if (!items.length) return;

      items.forEach((item) => {
        gsap.set(item, {
          opacity: 1,
          rotation: 135,
          background: "#882929",
          scaleX: 0,
          transformOrigin: "0% 0%",
        });

        gsap.to(item, {
          scaleX: 1,
          ease: "power1.out",
          duration: 1,
        });
      });
    };

    const lineItems = document.querySelectorAll(".js-anim-intro-line");
    if (lineItems.length) {
      gsap.delayedCall(0, introAnimationLine);
    }
  }

  function homePageAnimtaions() {
    const page = document.querySelector(".home-page");

    if (page) {
      const tlSectionIntro = gsap.timeline({});

      tlSectionIntro.from(".section_intro .h1", {
        // y: 40,
        ease: "power1.out",
        opacity: 0,
        scale: 0.9,
        duration: 2,
        stagger: 0.1,
      });

      tlSectionIntro.from(
        ".section_intro .chip",
        {
          duration: 0.8,
          y: 20,
          opacity: 0,
          autoAlpha: 0,
          scale: 0,
          stagger: 0.15,
        },
        "-=1.2"
      );

      tlSectionIntro.from(
        ".section_intro .text-holder p",
        {
          duration: 0.5,
          y: 30,
          opacity: 0,
          autoAlpha: 0,
          stagger: 0.15,
        },
        "-=1.4"
      );
      tlSectionIntro.from(
        ".section_intro .title_img",
        {
          opacity: 0,
          autoAlpha: 0,
          duration: 2,
        },
        "-=1.5"
      );

      tlSectionIntro.from(
        "#svg",
        {
          opacity: 0,
          autoAlpha: 0,
          duration: 2,
        },
        "-=1.5"
      );

      const tlSectionCooperate = gsap.timeline({
        ease: "power.in",
        scrollTrigger: {
          trigger: document.querySelector(".section_cooperate"),
          start: "top-=200 60%",
          end: "+=500",
          // markers: true,
        },
      });

      tlSectionCooperate.from(".section_cooperate .title-custom", {
        autoAlpha: 0,
        y: 50,
        opacity: 0,
        duration: 0.55,
      });

      tlSectionCooperate.from(
        ".section_cooperate .header-img",
        {
          autoAlpha: 0,
          y: 150,
          opacity: 0,
          scale: 0.5,
          duration: 0.5,
        },
        "-=.4"
      );

      tlSectionCooperate.from(
        ".section_cooperate .header-text",
        {
          autoAlpha: 0,
          y: 50,
          opacity: 0,
          duration: 0.55,
        },
        "-=.9"
      );

      gsap.set(".section_cooperate .cooperate-card", { y: 100, opacity: 0 });

      ScrollTrigger.batch(".section_cooperate .cooperate-card", {
        start: "top 85%",
        once: true,
        onEnter: (batch) =>
          gsap.to(batch, {
            duration: 0.4,
            opacity: 1,
            y: 0,
            stagger: 0.1,
            ease: "none",
          }),
      });

      let cards = gsap.utils.toArray(".works-card");
      let stickDistance = 0;
      let firstCardST = ScrollTrigger.create({
        trigger: cards[0],
        start: "center center",
      });
      let lastCardST = ScrollTrigger.create({
        trigger: cards[cards.length - 1],
        start: "top top",
      });

      gsapMatchMedia.add("(min-width: 992px)", () => {
        cards.forEach((card, index) => {
          var scale = 1 - (cards.length - index) * 0.025;
          let scaleDown = gsap.to(card, {
            scale: scale,
            "transform-origin":
              '"50% ' + (lastCardST.start + stickDistance) + '"',
          });

          ScrollTrigger.create({
            trigger: card,
            start: "top top+=160px",
            end: () => lastCardST.start + stickDistance,
            pin: true,
            // markers: false,
            pinSpacing: false,
            ease: "none",
            animation: scaleDown,
            toggleActions: "restart none none reverse",
          });
        });
      });

      const tlSectionLatestWorks = gsap.timeline({
        scrollTrigger: {
          trigger: document.querySelector(
            ".section_latest-works .title-custom"
          ),
          start: "top-=150 60%",
          end: "+=500",
          // markers: true,
        },
      });

      tlSectionLatestWorks.from(".section_latest-works .title-custom", {
        duration: 0.5,
        y: 50,
        opacity: 0,
        autoAlpha: 0,
      });

      tlSectionLatestWorks.from(".section_latest-works .cards-holder", {
        duration: 0.5,
        opacity: 0,
        autoAlpha: 0,
      });

      // Pride ---------------------------

      const tlSectionPride = gsap.timeline({
        scrollTrigger: {
          trigger: document.querySelector(".section_pride"),
          start: "top bottom-=50%",
          end: "bottom 150%",
          scrub: 4,
          // markers: true,
          // once: true,
        },
      });

      tlSectionPride.from(".section_pride .section-illustration", {
        ease: "power1.out",
        scale: 0,
        duration: 1.1,
      });

      const circle = document.querySelector("circle");
      const radius = circle.r.baseVal.value;
      const circumference = 2 * Math.PI * radius;

      gsap.set(circle, {
        strokeDasharray: circumference,
        strokeDashoffset: circumference,
      });

      tlSectionPride.to(
        circle,
        {
          strokeDashoffset: 0,
          ease: "none",
          duration: 1.1,
        },
        "-=1"
      );

      // const tlSectionPride = gsap.timeline({
      //   scrollTrigger: {
      //     trigger: document.querySelector(".section_pride"),
      //     start: "top 60%",
      //     end: "+=500",
      //   },
      // });

      // gsap.from(".section_pride .section-illustration", {
      //   ease: "power1.out",
      //   scale: 0,
      //   // duration: 1.1,
      //   scrollTrigger: {
      //     // once: true,
      //     trigger: ".section_pride",
      //     start: "top bottom-=50%",
      //     end: "bottom 150%",
      //     // markers: true,
      //     scrub: 3,
      //   },
      // });

      // const circle = document.querySelector("circle");
      // const radius = circle.r.baseVal.value;
      // const circumference = 2 * Math.PI * radius;

      // gsap.set(circle, {
      //   strokeDasharray: circumference,
      //   strokeDashoffset: circumference,
      // });

      // ScrollTrigger.create({
      //   trigger: ".container",
      //   start: "top center",
      //   end: "bottom center",
      //   scrub: true,
      //   markers: true,
      //   onUpdate: (self) => {
      //     const progress = self.progress; // Получаем прогресс прокрутки
      //     gsap.to(circle, {
      //       strokeDashoffset: circumference * (1 - progress), // Изменяем stroke-dashoffset на основе прогресса
      //       ease: "none",
      //     });
      //   },
      // });

      gsap.utils.toArray(".section_pride .text-holder p").forEach((p) => {
        gsap.fromTo(
          p,
          { backgroundSize: "0% 100%" },
          {
            backgroundSize: "100% 100%",
            scrollTrigger: {
              trigger: ".section_pride",
              start: "top-=30% top",
              end: "40% center",
              scrub: 3,
              // markers: true,
            },
            duration: 1,
            ease: "none",
          }
        );
      });

      gsap.from(".section_pride .video-holder", {
        opacity: 0,
        scale: 0,
        duration: 0.5,
        autoAlpha: 0,
        scrollTrigger: {
          // markers: true,
          start: "center+=100 bottom",
          trigger: document.querySelector(".section_pride .video-holder"),
        },
      });

      gsap.set(".section_pride .img-holder", { y: 100, opacity: 0 });
      ScrollTrigger.batch(".section_pride .img-holder", {
        onEnter: (batch) =>
          gsap.to(batch, {
            delay: 0.1,
            autoAlpha: 1,
            y: 0,
            opacity: 1,
            stagger: 0.3,
            duration: 0.6,
          }),
        scrollTrigger: {
          start: "top 20%",
          trigger: document.querySelector(".section_pride"),
        },
      });

      const tlSectionResults = gsap.timeline({
        scrollTrigger: {
          trigger: document.querySelector(".section_result"),
          start: "top 60%",
          end: "+=500",
        },
      });

      tlSectionResults.from(".section_result .title-custom", {
        autoAlpha: 0,
        y: 50,
        opacity: 0,
        duration: 0.55,
      });

      gsap.from(".section_result .list-title", {
        autoAlpha: 0,
        y: 50,
        opacity: 0,
        duration: 0.55,
        stagger: 0.5,

        scrollTrigger: {
          start: "top 60%",
          trigger: document.querySelector(".section_result"),
        },
      });

      gsap.set(".section_result .list-result li", { y: 100, opacity: 0 });

      ScrollTrigger.batch(".section_result .list-result li", {
        onEnter: (batch) =>
          gsap.to(batch, {
            ease: "power1.in",
            duration: 0.4,
            opacity: 1,
            autoAlpha: 1,
            y: 0,
            stagger: 0.1,
            ease: "none",
          }),
        scrollTrigger: {
          start: "top 75%",
          once: true,
        },
      });

      const tlSectionAnswer = gsap.timeline({
        scrollTrigger: {
          trigger: document.querySelector(".section_result"),
          start: "top 10%",
        },
      });

      tlSectionAnswer
        .from(".section_answer .title-custom", {
          autoAlpha: 0,
          y: 50,
          opacity: 0,
          duration: 0.55,
        })
        .from(".section_answer .accordion", {
          autoAlpha: 0,
          y: 50,
          opacity: 0,
          duration: 0.3,
          stagger: 0.05,
        });

      if (!isTouchScreen && document.querySelector(".title-wrapper")) {
        document.body.addEventListener("mousemove", (event) => {
          gsap.to(
            document.querySelector(".home-page .section_intro .decor-title"),
            {
              x: (event.clientX * 1) / window.innerWidth + "%",
              y: (event.clientY * 1.5) / window.innerHeight + "%",
              duration: 0.25,
            }
          );

          gsap.to(
            document.querySelector(".section_intro .decor-title .chip-1"),
            {
              x: (event.clientX * 5) / window.innerWidth + "%",
              y: (event.clientY * 8) / window.innerHeight + "%",
              duration: 0.25,
            }
          );

          gsap.to(
            document.querySelector(".section_intro .decor-title .chip-2"),
            {
              x: (event.clientX * 5) / window.innerWidth + "%",
              y: (event.clientY * 8) / window.innerHeight + "%",
              duration: 0.25,
            }
          );
        });
      }
    }
  }
}
