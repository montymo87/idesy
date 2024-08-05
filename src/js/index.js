
import '../styles/index.scss';
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(ScrollToPlugin);
import marquee from 'vanilla-marquee';
import customSelect from 'custom-select';

const isTouchScreen = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);
const gsapMatchMedia = gsap.matchMedia();

document.addEventListener('DOMContentLoaded', () => {
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
});

window.addEventListener('resize', () => {

});


function fixHeaderOnScroll() {
	let previousScrollPosition = 0;

	window.addEventListener('scroll', () => {
		if (isScrollingDown() === false) {
			document.querySelector('.header').classList.add('fixed');
		} else {
			document.querySelector('.header').classList.remove('fixed');
		}
	});

	function isScrollingDown() {


		let goingDown = false;

		let scrollPosition = window.pageYOffset;

		if (scrollPosition > previousScrollPosition) {
			goingDown = true;
		}

		previousScrollPosition = scrollPosition;

		return goingDown;
	}
}

function dropdown() {
	const activeClass = 'show';
	const select = 'lang-select';

	document.addEventListener('click', function (e) {
		let shareEl = e.target.closest('.' + select);
		if (!shareEl && e.target.classList.contains(select)) {
			shareEl = e.target;
		} else if (shareEl) {
			shareEl.classList.toggle(activeClass);
		}

		document.querySelectorAll('.' + select + '.' + activeClass).forEach(el => {
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
		open_btns.forEach(el => {
			el.addEventListener('click', function (event) {
				event.preventDefault();
				const id = this.getAttribute("toggle-modal");
				document.querySelector(`#${id}`).classList.add('show');
				document.body.classList.add('modal-open')
			})
		});
	}

	if (close_btns) {
		close_btns.forEach(el => {
			el.addEventListener('click', function (event) {
				event.preventDefault();
				el.parentNode.parentNode.classList.remove('show');
				document.body.classList.remove('modal-open')
			})
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
	customSelect('select');
}

function initSwiperMobileGallery() {
	const slider = document.querySelector('.swiper-mobile-gallery');

	if (slider && window.innerWidth < 992) {
		console.log(Swiper);
		console.log(slider)

		const swiper = new Swiper(slider, {
			spaceBetween: 8,
			slidesPerView: 'auto',
			loop: true,
			centeredSlides: true,
		});


		const container = document.querySelector('.swiper-mobile-gallery .swiper-wrapper');
		const blocks = document.querySelectorAll('.swiper-mobile-gallery .swiper-slide');

		if (blocks.length > 0) {
			for (var i = 0; i < 3; i++) {
				const newBlock = blocks[i].cloneNode(true);
				container.appendChild(newBlock);
			}
		}
	}
}

function videoPlayer() {
	const videoBlock = document.querySelectorAll('.video-holder');

	if (videoBlock && videoBlock.length > 0) {
		videoBlock.forEach(block => {
			block.addEventListener('click', () => {
				if (block.classList.contains('playing')) {
					block.classList.remove('playing');
					block.querySelector('video').pause();
				} else {
					block.classList.add('playing');
					block.querySelector('video').play()
				}
			})
		})
	}
}

function fullScreenMenu() {
	const btn = document.querySelector(".header .btn-toggle-menu");
	const menu = document.querySelector('.header .main-navigation');
	const links = menu.querySelectorAll('.header .main-navigation li');
	const lang_list = menu.querySelectorAll('.langs-list');

	function onStart() {
		document.body.classList.add('menu-opened');
		btn.classList.add('open');
	}

	function onComplete() {
		document.body.classList.remove('menu-opened');
		btn.classList.remove('open');
	}

	gsapMatchMedia.add("(max-width: 1200px)", () => {
		console.log('max-1200')

		const tl = gsap.timeline({
			paused: true,
		});

		gsap.set(links, { y: 30, opacity: 0, });
		gsap.set(lang_list, { y: 30, opacity: 0, });

		tl.to(menu, {
			duration: 1,
			opacity: 1,
			height: '100%',
			ease: 'expo.inOut',
		});
		tl.to(links, { duration: 0.65, y: 0, opacity: 1, stagger: 0.15, ease: "power4.out" });
		tl.to(lang_list, { duration: 0.65, y: 0, opacity: 1, ease: "expo.inOut" });
		tl.reverse();

		btn.addEventListener('click', () => {
			if (document.body.classList.contains('menu-opened')) {
				onComplete();
				tl.reversed(!tl.reversed());
				document.body.classList.remove('menu-opened');
			} else {
				onStart();
				tl.play();
				document.body.classList.add('menu-opened');
			}
		});
	})
}

function initMarquee() {
	const marqueeBlocks = document.querySelectorAll('[marquee]');

	if (marqueeBlocks && marqueeBlocks.length > 0) {
		marqueeBlocks.forEach(element => {
			new marquee(element, { duplicated: true, direction: 'left', speed: 20, startVisible: true, gap: 0, delayBeforeStart: 0 });
		})
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

		accordions.forEach(item => {
			item.querySelector('.accordion-header').addEventListener("click", function (e) {
				e.preventDefault();

				if (item.classList.contains('open')) {
					item.classList.remove("open");
					item.querySelector('.accordion-collapse').style.maxHeight = null;
				} else {
					deleteClass(accordions, "open");
					item.classList.add("open");
					heightDelete(accordionsBody);
					item.querySelector('.accordion-collapse').style.maxHeight = item.querySelector('.accordion-collapse').scrollHeight + "px";
				}
			});

			if (item.classList.contains("open")) {
				item.querySelector('.accordion-collapse').style.maxHeight = item.querySelector('.accordion-collapse').scrollHeight + "px";
			}
		});
	}
}

function gsapAnimations() {
	homePageAnimtaions();

	function homePageAnimtaions() {
		const page = document.querySelector('.home-page');

		if (page) {
			const tlSectionIntro = gsap.timeline({});

			tlSectionIntro.from(".section_intro .h1", {
				y: 50,
				delay: 0.3,
				// skewY: 7,
				opacity: 0,
				duration: 0.5,
				// ease: 'back',
			});

			tlSectionIntro.from(".section_intro .decor-title", {
				opacity: 0,
				autoAlpha: 0,
				duration: 0.65
			});

			tlSectionIntro.from(".section_intro .chip", {
				duration: 0.5,
				y: 20,
				opacity: 0,
				autoAlpha: 0,
				scale: 0,
				stagger: 0.25,
			});

			tlSectionIntro.from(".section_intro .text-holder p", {
				duration: 0.5,
				y: 20,
				opacity: 0,
				autoAlpha: 0,
				stagger: 0.35,
			});

			tlSectionIntro.from(".section_intro .marquee-group", {
				delay: 0.1,
				opacity: 0,
				duration: 0.55,
				ease: 'none',
			});


			const tlSectionCooperate = gsap.timeline({
				scrollTrigger: {
					trigger: document.querySelector(".section_cooperate"),
					start: "top 60%",
					end: "+=500",
				},
			});

			tlSectionCooperate.from(".section_cooperate .title-custom", {
				autoAlpha: 0,
				y: 50,
				opacity: 0,
				duration: 0.55,
			});

			tlSectionCooperate.from(".section_cooperate .header-img", {
				autoAlpha: 0,
				y: 50,
				opacity: 0,
				scale: 0.5,
				duration: 0.55,
			});

			tlSectionCooperate.from(".section_cooperate .header-text", {
				autoAlpha: 0,
				y: 50,
				opacity: 0,
				duration: 0.55,
			});

			gsap.set(".section_cooperate .cooperate-card", { y: 100, opacity: 0 });
			ScrollTrigger.batch(".section_cooperate .cooperate-card", {
				onEnter: batch => gsap.to(batch, { delay: 0.1, autoAlpha: 1, y: 0, opacity: 1, stagger: 0.3, duration: 0.6, }),
				scrollTrigger: {
					start: "top 60%",
					trigger: document.querySelector(".section_cooperate")
				}
			});

			let cards = gsap.utils.toArray(".works-card");
			let stickDistance = 0;
			let firstCardST = ScrollTrigger.create({
				trigger: cards[0],
				start: "center center"
			});
			let lastCardST = ScrollTrigger.create({
				trigger: cards[cards.length - 1],
				start: "top top"
			});

			gsapMatchMedia.add("(min-width: 992px)", () => {
				cards.forEach((card, index) => {
					var scale = 1 - (cards.length - index) * 0.025;
					let scaleDown = gsap.to(card, { scale: scale, 'transform-origin': '"50% ' + (lastCardST.start + stickDistance) + '"' });

					ScrollTrigger.create({
						trigger: card,
						start: "top top+=160px",
						end: () => lastCardST.start + stickDistance,
						pin: true,
						markers: false,
						pinSpacing: false,
						ease: "none",
						animation: scaleDown,
						toggleActions: "restart none none reverse"
					});
				});
			})


			const tlSectionLatestWorks = gsap.timeline({
				scrollTrigger: {
					trigger: document.querySelector(".section_latest-works .title-custom"),
					start: "top 60%",
					end: "+=500",
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


			const tlSectionPride = gsap.timeline({
				scrollTrigger: {
					trigger: document.querySelector(".section_pride"),
					start: "top 60%",
					end: "+=500",
				},
			});


			gsap.from(".section_pride .section-illustration", {
				scrollTrigger: {
					trigger: ".section_pride",
					start: "top bottom",
					end: "bottom 150%",
					scrub: true
				},
				duration: 0.5,
				scale: 0,
			});



			gsap.from(".section_pride .text-holder", {
				scrollTrigger: {
					trigger: ".section_pride",
					start: "top 15%",
					end: "bottom 20%",
				},
				scale: 0,
				opacity: 0,
				duration: 0.5
			});



			gsap.from(".section_pride .video-holder", {
				opacity: 0,
				scale: 0,
				duration: 0.5,
				autoAlpha: 0,
				scrollTrigger: {
					start: "top 60%",
					trigger: document.querySelector(".section_pride .video-holder"),
				}
			})


			gsap.set(".section_pride .img-holder", { y: 100, opacity: 0 });
			ScrollTrigger.batch(".section_pride .img-holder", {
				onEnter: batch => gsap.to(batch, { delay: 0.1, autoAlpha: 1, y: 0, opacity: 1, stagger: 0.3, duration: 0.6, }),
				scrollTrigger: {
					start: "top 20%",
					trigger: document.querySelector(".section_pride")
				}
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
					trigger: document.querySelector(".section_result")
				}
			});

			gsap.set(".section_result .list-result li", { y: 100, opacity: 0 });
			ScrollTrigger.batch(".section_result .list-result li", {
				onEnter: batch => gsap.to(batch, { delay: 0.1, autoAlpha: 1, y: 0, opacity: 1, stagger: 0.15, duration: 0.6, }),
				scrollTrigger: {
					start: "top 60%",
					trigger: document.querySelector(".section_result")
				}
			});



			const tlSectionAnswer = gsap.timeline({
				scrollTrigger: {
					trigger: document.querySelector(".section_result"),
					start: "top 10%",
				},
			});


			tlSectionAnswer.from(".section_answer .title-custom", {
				autoAlpha: 0,
				y: 50,
				opacity: 0,
				duration: 0.55,
			}).from(".section_answer .accordion", {
				autoAlpha: 0,
				y: 50,
				opacity: 0,
				duration: 0.55,
				stagger: 0.13
			});






			if (!isTouchScreen && document.querySelector('.title-wrapper')) {
				document.body.addEventListener("mousemove", (event) => {

					gsap.to(document.querySelector('.home-page .section_intro .decor-title'), {
						x: (event.clientX * 1) / window.innerWidth + "%",
						y: (event.clientY * 1.5) / window.innerHeight + "%",
						duration: 0.25,
					})

					gsap.to(document.querySelector('.section_intro .decor-title .chip-1'), {
						x: (event.clientX * 5) / window.innerWidth + "%",
						y: (event.clientY * 8) / window.innerHeight + "%",
						duration: 0.25,
					})


					gsap.to(document.querySelector('.section_intro .decor-title .chip-2'), {
						x: (event.clientX * 5) / window.innerWidth + "%",
						y: (event.clientY * 8) / window.innerHeight + "%",
						duration: 0.25,
					})

				});
			}

		}



	}
}