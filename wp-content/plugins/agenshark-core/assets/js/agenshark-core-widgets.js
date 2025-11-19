(function ($) {
	"use strict";
	/**
	   * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */


	function mybe_note_undefined($selector, $data_atts) {
		return ($selector.data($data_atts) !== undefined) ? $selector.data($data_atts) : '';
	}


	/**
	 * Swiper activation
	 * @param $scope
	 * @param $
	*/
	var WidgetSliderHandler = function ($scope, $) {
		var slider_el = $scope.find(".tp-demo-active").eq(0);
		if (slider_el.length === 0)
			return;
		var settings = slider_el.data('settings');
		var arrows = settings['arrows'];
		var dots = settings['dots'];
		var autoplay = settings['autoplay'];
		var autoplay_speed = parseInt(settings['autoplay_speed']) || 2500;
		var infinite = settings['infinite'];
		var for_xl_desktop = settings['for_xl_desktop'];
		var slidesToShow = settings['slidesToShow'];
		var for_laptop = settings['for_laptop'];
		var for_tablet = settings['for_tablet'];
		var for_mobile = settings['for_mobile'];
		var for_xs_mobile = settings['for_xs_mobile'];

		var tpslider = new Swiper('.tp-demo-active', {
			slidesPerView: for_xl_desktop,
			spaceBetween: 30,
			// direction: 'vertical',
			loop: infinite,
			autoplay: {
				delay: autoplay_speed,
			},
			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},

			// And if we need scrollbar
			// scrollbar: {
			//   el: '.swiper-scrollbar',
			// },
			breakpoints: {
				0: {
					slidesPerView: for_xs_mobile,
				},
				550: {
					slidesPerView: for_mobile,
				},
				768: {
					slidesPerView: for_tablet,
				},
				992: {
					slidesPerView: for_laptop,
				},
				1200: {
					slidesPerView: slidesToShow,
				},
				1599: {
					slidesPerView: for_xl_desktop,
				},
			}
		});

		if (true !== autoplay) {
			tpslider.autoplay.stop();
		}

	};

	// // Make sure you run this code under Elementor.
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/portfolio.default', WidgetSliderHandler);
	});

	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/wpr-testimonial.default', function ($scope) {

			// Testimonial slider area start here ***
			var swiper = new Swiper(".testimonial__slider", {
				loop: "true",
				spaceBetween: 30,
				speed: 400,
				pagination: {
					el: ".testimonial__dot",
					type: "fraction",
				},
				navigation: {
					nextEl: ".testimonial__arry-next",
					prevEl: ".testimonial__arry-prev",
				},
			});

			var swiper = new Swiper(".testimonial-two__slider", {
				loop: "true",
				spaceBetween: 30,
				speed: 500,
				centeredSlides: true,
				pagination: {
					el: ".testimonial-two__dot",
					clickable: true,
				},
				navigation: {
					nextEl: ".testimonial-two__arry-next",
					prevEl: ".testimonial-two__arry-prev",
				},
				breakpoints: {
					1500: {
						slidesPerView: 4,
					},
					1200: {
						slidesPerView: 3,
					},
					767: {
						slidesPerView: 2,
					},
				},
			});

			var swiper = new Swiper(".testimonial-three__slider", {
				loop: "true",
				spaceBetween: 60,
				speed: 500,
				pagination: {
					el: ".testimonial-three__dot",
					clickable: true,
				},
				navigation: {
					nextEl: ".testimonial-three__arry-next",
					prevEl: ".testimonial-three__arry-prev",
				},
				breakpoints: {
					991: {
						slidesPerView: 2,
					},
				},
			});

			var swiper = new Swiper(".testimonial-four__slider", {
				loop: "true",
				spaceBetween: 24,
				speed: 500,
				pagination: {
					el: ".team-four__dot",
					clickable: true,
				},
				navigation: {
					nextEl: ".testimonial-four__arry-next",
					prevEl: ".testimonial-four__arry-prev",
				},
				scrollbar: {
					el: ".testimonial-four__scrollbar",
				},
				breakpoints: {
					991: {
						slidesPerView: 2,
					},
					768: {
						slidesPerView: 2,
					},
				},
			});
			// Testimonial slider area end here ***
		});
	});


	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/wpr-team.default', function ($scope) {

			// Team slider area start here ***
			var swiper = new Swiper(".team__slider", {
				loop: "true",
				spaceBetween: 24,
				speed: 500,
				pagination: {
					el: ".team__dot",
					clickable: true,
				},
				navigation: {
					nextEl: ".team__arry-next",
					prevEl: ".team__arry-prev",
				},
				breakpoints: {
					1200: {
						slidesPerView: 4,
					},
					992: {
						slidesPerView: 3,
					},
					767: {
						slidesPerView: 2,
					},
				},
			});

			var swiper = new Swiper(".team-four__slider", {
				loop: "true",
				spaceBetween: 24,
				speed: 500,
				pagination: {
					el: ".team-four__dot",
					clickable: true,
				},
				navigation: {
					nextEl: ".team-four__arry-next",
					prevEl: ".team-four__arry-prev",
				},
				scrollbar: {
					el: ".swiper-scrollbar",
				},
				breakpoints: {
					1200: {
						slidesPerView: 4,
					},
					991: {
						slidesPerView: 3,
					},
					575: {
						slidesPerView: 2,
					},
				},
			});
			// Team slider area end here ***
		});
	});

	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/wpr-case-study.default', function ($scope) {

			// Story slider area start here ***
			var swiper = new Swiper(".story__slider", {
				loop: "true",
				centeredSlides: false,
				spaceBetween: 45,
				slidesPerView: 1,
				speed: 500,
				scrollbar: {
					el: ".swiper-scrollbar",
				},
				breakpoints: {
					992: {
						slidesPerView: 2,
					},
				},
			});
			// Story slider area start here ***
		});
	});


	$(window).on("elementor/frontend/init", function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/wpr_branding.default', function ($scope) {

			// Brand slider area start here ***
			var swiper = new Swiper($scope.find(".brand__slider")[0], {
				loop: true,
				spaceBetween: 24,
				allowTouchMove: false,
				disableOnInteraction: true,
				speed: 3000,
				autoplay: {
					delay: 1
				},
				breakpoints: {
					1200: {
						slidesPerView: 5,
					},
					992: {
						slidesPerView: 4,
					},
					575: {
						slidesPerView: 2,
					},
					320: {
						slidesPerView: 2,
					},
				},
			});
			// Brand slider area end here ***
		});
	});






}(jQuery));
