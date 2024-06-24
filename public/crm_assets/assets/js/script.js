(function ($) {
    "use strict"

	/* Document on load functions */
	$(window).on('load', function () {
		preLoader();
		headerHeightFixer();
		fixCollapseWidth();
		fixCustomMapHeight();
		getScrollbarWidth();
		elementsHeightMeasure();
    });

	$(window).on('resize', function(){
		headerHeightFixer();
		fixCollapseWidth();
		fixCustomMapHeight();
		getScrollbarWidth();
		elementsHeightMeasure();
	});

	/* Preloader init */
	function preLoader(){
		$(".preloader").fadeOut("slow");
	}

	/* Bootstrap Form Validation function */
	window.addEventListener('load', function() {
		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		var forms = document.getElementsByClassName('needs-validation');
		// Loop over them and prevent submission
		var validation = Array.prototype.filter.call(forms, function(form) {
		  form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
			  event.preventDefault();
			  event.stopPropagation();
			}
			form.classList.add('was-validated');
		  }, false);
		});
	}, false);

	/* Fixed Header function */
	$(window).on("scroll", function () {
		var scrolling = $(this).scrollTop();

		if (scrolling > $('.header').innerHeight()) {
			$(".header").addClass("header--fixed");
		} else {
			$(".header").removeClass("header--fixed");
		}
	});

	/* scroll top function */
	$(".scroll-top").on("click", function () {
		$("html,body").animate({scrollTop: 0},50);
	});
	$(window).on("scroll", function () {
		var scrolling = $(this).scrollTop();

		if (scrolling > 200) {
			$(".scroll-top").fadeIn();
		} else {
			$(".scroll-top").fadeOut();
		}
	});

	/* Fix Header Height function */
	$(document).ready(function () {
		$('.header').before('<div class="header-height-fix"></div>');
	});
    function headerHeightFixer(){
    	$('.header-height-fix').css('height', $('.header').innerHeight() + 10 - 2 +'px');
	};

	/* Closes responsive menu when a navbar link is clicked */
	$(".nav-link, .dropdown-item").on("click", function (e) {
		if( $(this).hasClass("dropdown-toggle") ){
			e.preventDefault();
		}else{
			$(".navbar-collapse").collapse("hide");
			$("html").removeClass("overflow-hidden");
			$('.offCanvasMenuCloser').removeClass('show');
		}
	});
	$('.navbar-toggler').on('click', function () {
        $("html").toggleClass('overflow-hidden');
        $('.offCanvasMenuCloser').toggleClass('show');
    });
    $('.offCanvasMenuCloser').on('click', function () {
        $(this).removeClass('show');
        $("html").removeClass("overflow-hidden");
    });

	/* Change language image function */
	$(".language__item").on("click", function(){
		const languageImgSrc = $(this).find(".language__item__flag").attr("src");
		$(".language-toggle .current-language-flag").attr("src", languageImgSrc);
	});

	/* Fix collapse width function */
	function fixCollapseWidth(){
		$('.page-wrapper').attr("style",`--navbar-collapse-width: ${$(".navbar-collapse").outerWidth()}px`);
	};
	fixCollapseWidth();

	/* Fix collapse width function */
	function getScrollbarWidth(){
		const bodyScrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
		$('body').attr("style",`--scrollbar-width: ${bodyScrollbarWidth}px`);
	};
	getScrollbarWidth();

	/* Fix Map Height function */
	function fixCustomMapHeight(){
		// $('#custom-map').css('min-height', ((window.innerHeight * 0.01 * 100) - ($('header').outerHeight() + ($('footer').outerHeight()))) + 2 +'px');
		$('#custom-map').css('min-height', ((window.innerHeight * 0.01 * 100) - $('header').outerHeight()) + 2 +'px');
	};
	fixCustomMapHeight();

	function elementsHeightMeasure(){
		$("html").attr({
			style: `
				--vh:${window.innerHeight * 0.01}px;
				--header-height:${$('header').outerHeight()}px;
				`
				// --footer-height:${$('footer').outerHeight()}px;
		});
	};
	elementsHeightMeasure();

	/* Show And Hide Password function */
	$('.form-group__password-toggler').on('click', function (e) {
		e.preventDefault();
		var $this = $(this),
		  inputGroupText = $this.closest('.form-group'),
		  formPasswordToggleIcon = $this.children(".password-toggler__icon"),
		  formPasswordToggleInput = inputGroupText.find('input');

		if (formPasswordToggleInput.attr('type') === 'text') {
		  formPasswordToggleInput.attr('type', 'password');
		  if (formPasswordToggleIcon.attr('class') === 'password-toggler__icon novecologie-icon-eye-close') {
			formPasswordToggleIcon.attr('class', 'password-toggler__icon novecologie-icon-eye');
		  }
		} else if (formPasswordToggleInput.attr('type') === 'password') {
		  formPasswordToggleInput.attr('type', 'text');
		  if (formPasswordToggleIcon.attr('class') === 'password-toggler__icon novecologie-icon-eye') {
			formPasswordToggleIcon.attr('class', 'password-toggler__icon novecologie-icon-eye-close');
		  }
		}
	});

	/* Custom Scrollbar function */
    $('.simple-bar').each((index, element) => new SimpleBar(element, { autoHide: true }));

	$(document).ready(function () {
		$('[type="date"], [type="datetime-local"], [type="datetime"]').wrap('<div class="datepicker-input"></div>');
	});

})(jQuery);
