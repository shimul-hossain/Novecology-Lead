<style>
    @import  url(https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap);
    @import  url("<?php echo e(asset('frontend_assets/fonts/novecology-icons/style.css')); ?>");

    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3,
    h4,
    .h4,
    h5,
    .h5,
    h6,
    .h6 {
        font-family: "Quicksand", sans-serif
    }

    h1,
    .h1 {
        font-size: 2.25rem
    }

    h2,
    .h2 {
        font-size: 1.875rem
    }

    h3,
    .h3 {
        font-size: 1.5rem
    }

    h4,
    .h4 {
        font-size: 1.125rem
    }

    h5,
    .h5 {
        font-size: .75rem
    }

    p {
        font-size: 1rem
    }

    @media (max-width:575.98px) {
        p {
            font-size: .9375rem
        }
    }

    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        outline: none;
        -webkit-tap-highlight-color: transparent
    }

    ::-moz-selection {
        color: #fff;
        background: <?php echo e(colorSetting()->theme_color); ?>

    }

    ::selection {
        color: #fff;
        background: <?php echo e(colorSetting()->theme_color); ?>

    }

    html,
    body {
        scroll-behavior: smooth
    }

    html {
        font-size: 16px;
        -webkit-text-size-adjust: none;
        -moz-text-size-adjust: none;
        -ms-text-size-adjust: none;
        text-size-adjust: none
    }

    body {
        color: #262626;
        font-weight: 400;
        font-family: "Quicksand", sans-serif;
        line-height: 1.6
    }

    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: unset
    }

    button,
    button:hover,
    button:focus,
    button:active {
        outline: none
    }

    input:-webkit-autofill {
        -webkit-text-fill-color: unset;
        -webkit-transition: background-color 5000s;
        -o-transition: background-color 5000s;
        -moz-transition: background-color 5000s;
        transition: background-color 5000s
    }

    ul,
    ol {
        list-style: none
    }

    img {
        -o-object-fit: cover;
        object-fit: cover
    }

    .user-select-none {
        pointer-events: none
    }

    .list-inline {
        font-size: 0
    }

    .list-inline-item {
        font-size: 1rem
    }

    @media (min-width:1200px) {
        .container {
            max-width: 1180px
        }
    }

    @media (min-width:1400px) {
        .container {
            max-width: 1340px
        }
    }

    @media (min-width:1600px) {
        .container {
            max-width: 1520px
        }
    }

    .slick__arrows {
        top: 0;
        position: absolute;
        z-index: 2
    }

    .slick-dots {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -moz-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        margin-bottom: 0;
        line-height: 0
    }

    .slick-dots li:not(:last-child) {
        margin-right: 1rem
    }

    .slick-dots li button {
        position: relative;
        font-size: 0;
        border: 0
    }

    .slick-dots li.slick-active button {
        background-color: inherit
    }

    .vbox-close {
        top: 2%;
        right: 2%;
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        padding: 0;
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -moz-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        font-size: 3rem;
        background: #5bc4b4 !important;
        color: #ffffff !important
    }

    .vbox-preloader .sk-cube {
        background: #5bc4b4 !important
    }

    .vbox-next,
    .vbox-prev {
        width: 3rem;
        height: 3rem
    }

    .vbox-next span,
    .vbox-prev span {
        width: 2rem;
        height: 2rem;
        border-width: 4px;
        border-top-color: #5bc4b4 !important;
        border-right-color: #5bc4b4 !important
    }

    .section-gap {
        padding: 4.0625rem 0
    }

    .section-gap--fix {
        padding-bottom: -moz-calc(6rem - 30px);
        padding-bottom: calc(6rem - 30px)
    }

    @media (max-width:991.98px) {
        .section-gap--fix {
            padding-bottom: -moz-calc(3rem - 30px);
            padding-bottom: calc(3rem - 30px)
        }
    }

    .section-header {
        margin-bottom: 1.25rem
    }

    .section-header__title {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        font-size: 1.875rem;
        font-weight: 300;
        line-height: 1
    }

    @media (min-width:768px) {
        .section-header__title {
            line-height: 1.1
        }

        .section-header__title--sm {
            font-size: 1.75rem
        }

        .section-header__title--md {
            font-size: 2.5rem
        }

        .section-header__title--lg {
            font-size: 3.125rem
        }
    }

    .section-header__title__small {
        font-size: 1rem;
        letter-spacing: 3px;
        font-weight: inherit
    }

    .highlight-text {
        color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .primary-color {
        color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .primary-bg {
        background-color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .secondary-color {
        color: #5bc4b4
    }

    .secondary-bg {
        background-color: #5bc4b4
    }

    .tertiary-color {
        color: #4a9fc6
    }

    .bullet-point-list li {
        background-image: url(../images/icons/right-arrow.svg);
        background-repeat: no-repeat;
        background-position: left 8px;
        background-size: 15px;
        padding-left: 1.5625rem;
        margin-bottom: .625rem
    }

    .social-list .list-inline-item:not(:last-child) {
        margin-left: .625rem
    }

    .social-list__link {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        font-size: 1.25rem;
        padding: .3125rem
    }

    .social-list__link:hover,
    .social-list__link:focus {
        color: #5bc4b4
    }

    .wavy-bg {
        background-color: rgba(74, 159, 198, .05)
    }

    .wavy-bg__top__shape,
    .wavy-bg__bottom__shape {
        height: 1.875rem
    }

    .wavy-bg__top {
        top: 0;
        -webkit-transform: scaleY(-1) scaleX(-1);
        -moz-transform: scaleY(-1) scaleX(-1);
        -ms-transform: scaleY(-1) scaleX(-1);
        -o-transform: scaleY(-1) scaleX(-1);
        transform: scaleY(-1) scaleX(-1)
    }

    @media (min-width:768px) {
        .wavy-bg__top__shape {
            height: 3.75rem
        }
    }

    .wavy-bg .container {
        position: relative;
        z-index: 1
    }

    .wavy-bg__bottom {
        bottom: 0
    }

    @media (min-width:768px) {
        .wavy-bg__bottom__shape {
            height: 10rem
        }
    }

    .blogs__slider:not(.slick-slider) .blogs__slide,
    .testimonial__slider:not(.slick-slider) .testimonial__slide {
        margin-bottom: 1.875rem
    }

    .slick__arrows,
    .slick-dots li button,
    .social-list__link,
    .primary-btn,
    .gradient-btn--primary,
    .gradient-btn--secondary,
    .gradient-btn--primary::before,
    .gradient-btn--primary::after,
    .gradient-btn--secondary::before,
    .gradient-btn--secondary::after,
    .blogs__card__body,
    .blogs__card__title,
    .filter__nav__btn,
    .accordion .card-header__closer__icon,
    .header,
    .header .navbar .nav-item .dropdown-menu,
    .header .navbar .nav-item .dropdown-item,
    .header .navbar .nav-link,
    .header .navbar .social-nav__link,
    .navbar-toggler__text,
    .navbar-toggler__icon,
    .footer__copyright__link,
    .footer-contact__link {
        -webkit-transition: all linear .3s;
        -o-transition: all linear .3s;
        -moz-transition: all linear .3s;
        transition: all linear .3s
    }

    .sticky-card .gradient-btn--primary,
    .header .navbar .btn-nav .nav-item .gradient-btn--primary {
        -webkit-box-shadow: .4375rem .3125rem 1.375rem rgba(67, 65, 78, .2);
        box-shadow: .4375rem .3125rem 1.375rem rgba(67, 65, 78, .2)
    }

    .gradient-btn--primary::before,
    .gradient-btn--secondary::before,
    .tag-btn {
        background-image: -webkit-gradient(linear, right top, left top, from(#0d279c), to(#52a4f3));
        background-image: -webkit-linear-gradient(right, #0d279c, #52a4f3);
        background-image: -moz-linear-gradient(right, #0d279c, #52a4f3);
        background-image: -o-linear-gradient(right, #0d279c, #52a4f3);
        background-image: linear-gradient(-90deg, #0d279c, #52a4f3)
    }

    .gradient-btn--secondary,
    .gradient-btn--secondary::after,
    .accordion .card-body,
    .header .navbar-collapse::after,.navbar-toggler[aria-expanded="true"] {
        background-image: -webkit-gradient(linear, left top, right top, from(#5bc4b4), to(#4a9fc6));
        background-image: -webkit-linear-gradient(left, #5bc4b4, #4a9fc6);
        background-image: -moz-linear-gradient(left, #5bc4b4, #4a9fc6);
        background-image: -o-linear-gradient(left, #5bc4b4, #4a9fc6);
        background-image: linear-gradient(90deg, #5bc4b4, #4a9fc6)
    }

    .primary-btn {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        font-size: .9375rem;
        font-family: "Quicksand", sans-serif;
        font-weight: 600;
        padding: 1rem 1.875rem;
        background-color: #fff;
        -webkit-box-shadow: .4375rem .3125rem 1.375rem rgba(67, 65, 78, .2);
        box-shadow: .4375rem .3125rem 1.375rem rgba(67, 65, 78, .2)
    }

    .primary-btn:hover,
    .primary-btn:focus {
        color: #fff;
        background-color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .gradient-btn--primary,
    .gradient-btn--secondary {
        font-size: .9375rem;
        font-weight: 300;
        padding: .625rem 1.875rem;
        z-index: 1
    }

    .gradient-btn--primary::before,
    .gradient-btn--primary::after,
    .gradient-btn--secondary::before,
    .gradient-btn--secondary::after {
        content: "";
        position: absolute;
        top: -1px;
        right: -1px;
        bottom: -1px;
        left: -1px;
        border-radius: inherit;
        z-index: -1
    }

    .gradient-btn--primary::before,
    .gradient-btn--secondary::before {
        opacity: 0
    }

    .gradient-btn--primary:hover,
    .gradient-btn--primary:focus-visible,
    .gradient-btn--secondary:hover,
    .gradient-btn--secondary:focus-visible {
        color: #fff
    }

    .gradient-btn--primary:hover::before,
    .gradient-btn--primary:focus-visible::before,
    .gradient-btn--secondary:hover::before,
    .gradient-btn--secondary:focus-visible::before {
        opacity: 1
    }

    .gradient-btn--primary:hover::after,
    .gradient-btn--primary:focus-visible::after,
    .gradient-btn--secondary:hover::after,
    .gradient-btn--secondary:focus-visible::after {
        opacity: 0
    }

    .gradient-btn--primary {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        background-color: #fff
    }

    .gradient-btn--primary::after {
        background-color: #fff
    }

    .gradient-btn--secondary {
        color: #ffffff !important
    }

    .tag-btn {
        font-size: .6875rem;
        padding: .375rem 1.25rem;
        background: #0d279c !important;
        background-image: -webkit-gradient(linear, right top, left top, from(#0d279c), to(#0d279c)) !important;
        background-image: -webkit-linear-gradient(right, #0d279c, #0d279c) !important;
        background-image: -moz-linear-gradient(right, #0d279c, #0d279c) !important;
        background-image: -o-linear-gradient(right, #0d279c, #0d279c) !important;
        background-image: linear-gradient(-90deg, #0d279c, #0d279c) !important
    }

    #calledBackModal::before {
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255, 255, 255, .09)), to(rgba(25, 51, 109, .37))), url(../images/shapes/shape-1.png);
        background-image: -webkit-linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-1.png);
        background-image: -moz-linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-1.png);
        background-image: -o-linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-1.png);
        background-image: linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-1.png)
    }

    #simulateProjectModal::before {
        background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255, 255, 255, .09)), to(rgba(25, 51, 109, .37))), url(../images/shapes/shape-2.png);
        background-image: -webkit-linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-2.png);
        background-image: -moz-linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-2.png);
        background-image: -o-linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-2.png);
        background-image: linear-gradient(rgba(255, 255, 255, .09), rgba(25, 51, 109, .37)), url(../images/shapes/shape-2.png)
    }

    .modal::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-blend-mode: multiply;
        -webkit-backdrop-filter: blur(4px);
        backdrop-filter: blur(4px)
    }

    .modal .close span {
        font-size: 2.5rem;
        line-height: 0
    }

    @media (max-width:991.98px) {
        .modal .section-header__title {
            font-size: 1.875rem
        }
    }

    @media (min-width:992px) {
        .modal-content {
            padding: 1.875rem .625rem
        }
    }

    .modal__image {
        right: 0;
        bottom: 0;
        -webkit-transform: translateX(15%);
        -moz-transform: translateX(15%);
        -ms-transform: translateX(15%);
        -o-transform: translateX(15%);
        transform: translateX(15%);
        max-width: 13.75rem
    }

    .blogs__slider .slick__arrows {
        --size: 42px;
        -webkit-transform: translateY(-200%);
        -moz-transform: translateY(-200%);
        -ms-transform: translateY(-200%);
        -o-transform: translateY(-200%);
        transform: translateY(-200%);
        width: var(--size);
        height: var(--size);
        border-radius: 50%;
        color: <?php echo e(colorSetting()->theme_color); ?>;
        background-color: #fff;
        -webkit-box-shadow: .3125rem .3125rem 1.25rem rgba(0, 0, 0, .12);
        box-shadow: .3125rem .3125rem 1.25rem rgba(0, 0, 0, .12);
        font-size: 1.25rem
    }

    .blogs__slider .slick__arrows--left {
        right: -moz-calc((var(--size) + 14px) * 1.2);
        right: calc((var(--size) + 14px) * 1.2)
    }

    .blogs__slider .slick__arrows--right {
        right: 14px
    }

    .blogs__slider .slick__arrows:hover,
    .blogs__slider .slick__arrows:focus-visible {
        color: #fff;
        background-color: #5bc4b4
    }

    .blogs__slider .slick-dots {
        margin-top: -1.25rem
    }

    .blogs__slider .slick-dots li:first-child button,
    .blogs__slider .slick-dots li:last-child button {
        -webkit-transform: scale(.6);
        -moz-transform: scale(.6);
        -ms-transform: scale(.6);
        -o-transform: scale(.6);
        transform: scale(.6)
    }

    .blogs__slider .slick-dots li button {
        width: .5rem;
        height: .5rem;
        background: rgba(255, 255, 255, .7);
        border-radius: .5rem
    }

    .blogs__slider .slick-dots li.slick-active button {
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -ms-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
        background: #fff
    }

    .blogs__slider--hidden-arrows .slick__arrows {
        display: none !important
    }

    .blogs__card--highlight {
        -webkit-box-shadow: .625rem .625rem 1.25rem rgba(0, 0, 0, .09);
        box-shadow: .625rem .625rem 1.25rem rgba(0, 0, 0, .09)
    }

    .blogs__card__image {
        height: 18.75rem
    }

    .blogs__card__date {
        top: .625rem;
        right: .625rem;
        font-size: .75rem;
        padding: .71875rem 1rem;
        background-color: rgba(0, 0, 0, .5)
    }

    .blogs__card .tag-btn {
        bottom: 1.25rem;
        left: 1.25rem
    }

    .blogs__card__body {
        padding: 1.875rem;
        min-height: 6.5625rem;
        background-color: #fff
    }

    .blogs__card__title {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        font-size: 1.0625rem;
        font-weight: 600
    }

    .blogs__card:hover .blogs__card__body {
        background-color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .blogs__card:hover .blogs__card__title {
        color: #fff
    }

    .blogs__container .blogs__slide {
        margin-bottom: 1.875rem
    }

    .testimonial {
        content-visibility: auto;
        contain-intrinsic-size: 735px
    }

    .testimonial__slider .slick__arrows {
        --size: 42px;
        width: var(--size);
        height: var(--size);
        -webkit-transform: translateY(20%);
        -moz-transform: translateY(20%);
        -ms-transform: translateY(20%);
        -o-transform: translateY(20%);
        transform: translateY(20%);
        border-radius: 50%;
        color: <?php echo e(colorSetting()->theme_color); ?>;
        background-color: #fff;
        -webkit-box-shadow: .3125rem .3125rem 1.25rem rgba(0, 0, 0, .12);
        box-shadow: .3125rem .3125rem 1.25rem rgba(0, 0, 0, .12);
        font-size: 1.25rem
    }

    @media (min-width:481px) {
        .testimonial__slider .slick__arrows {
            -webkit-transform: translateY(-100%);
            -moz-transform: translateY(-100%);
            -ms-transform: translateY(-100%);
            -o-transform: translateY(-100%);
            transform: translateY(-100%)
        }
    }

    .testimonial__slider .slick__arrows--left {
        right: -moz-calc((var(--size) + 14px) * 1.2);
        right: calc((var(--size) + 14px) * 1.2)
    }

    .testimonial__slider .slick__arrows--right {
        right: 14px
    }

    .testimonial__slider .slick__arrows:hover,
    .testimonial__slider .slick__arrows:focus-visible {
        color: #fff;
        background-color: #5bc4b4
    }

    .testimonial__slider .slick-list {
        padding-top: 1.875rem;
        padding-bottom: 1.875rem
    }

    .testimonial__slider .slick-dots {
        margin-top: -.625rem
    }

    .testimonial__slider .slick-dots li:first-child button,
    .testimonial__slider .slick-dots li:last-child button {
        -webkit-transform: scale(.6);
        -moz-transform: scale(.6);
        -ms-transform: scale(.6);
        -o-transform: scale(.6);
        transform: scale(.6)
    }

    .testimonial__slider .slick-dots li button {
        width: .5rem;
        height: .5rem;
        background: whitesmoke;
        border-radius: .5rem
    }

    .testimonial__slider .slick-dots li.slick-active button {
        -webkit-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -ms-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
        background: #dee1e3
    }

    .testimonial__card {
        padding: 1.875rem;
        -webkit-box-shadow: .125rem .1875rem 1.125rem rgba(0, 0, 0, .07);
        box-shadow: .125rem .1875rem 1.125rem rgba(0, 0, 0, .07)
    }

    .testimonial__card__quote-icon {
        width: 3.75rem;
        fill: #b3c1ce
    }

    .testimonial__card__text {
        font-size: 14px;
        line-height: 1.6
    }

    .testimonial__card__author__avatar {
        width: 1.875rem;
        height: 1.875rem;
        background-color: #eaeaea
    }

    .testimonial__card__author__name {
        font-size: 14px;
        font-weight: 500;
        color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .testimonial__card__author__avatar {
        width: 60px;
        height: 60px
    }

    .testimonial__card__author__list {
        display: flex;
        justify-content: center;
        color: #ffce01
    }

    .testimonial__card__image {
        max-height: 45px
    }

    .clients__card {
        margin-bottom: 1.875rem
    }

    .clients__card__wrapper {
        border-radius: .625rem;
        padding: 1.25rem;
        -webkit-box-shadow: .3125rem .3125rem 1.25rem rgba(25, 51, 109, .09);
        box-shadow: .3125rem .3125rem 1.25rem rgba(25, 51, 109, .09)
    }

    .clients__card__image {
        height: 100%;
        max-width: 9.375rem;
        max-height: 3.75rem;
        -o-object-fit: contain;
        object-fit: contain
    }

    .blockquote {
        background-color: <?php echo e(colorSetting()->theme_color); ?>;
        padding-left: 1.25rem;
        padding-right: 1.25rem
    }

    .blockquote__title {
        font-size: 1.0625rem
    }

    @media (min-width:768px) {
        .blockquote__title {
            font-size: 1.5625rem
        }
    }

    .blockquote__icon {
        font-size: 1.25rem;
        color: #5bc4b4
    }

    .blockquote__icon--left {
        top: 5px;
        left: 8px
    }

    .blockquote__icon--right {
        bottom: 5px;
        right: 8px
    }

    .filter__nav .nav-item {
        margin: 0 .5rem
    }

    .filter__nav__btn {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        font-size: .875rem;
        font-weight: 600;
        padding: .5rem 1.5rem;
        background-color: transparent
    }

    .filter__nav__btn.active {
        color: #fff;
        background: -webkit-linear-gradient(230deg, #5bc4b4, #4a9fc6);
        background: -moz-linear-gradient(230deg, #5bc4b4, #4a9fc6);
        background: -o-linear-gradient(230deg, #5bc4b4, #4a9fc6);
        background: linear-gradient(-140deg, #5bc4b4, #4a9fc6)
    }

    .filter__nav__btn:hover,
    .filter__nav__btn:focus {
        background-color: #f9f9fa
    }

    .form-group {
        margin-bottom: 1.5625rem
    }

    .form-control {
        font-size: .875rem;
        font-weight: 600;
        color: #262626;
        border-color: #e3e3e3;
        text-shadow: none;
        min-height: 50px;
        height: auto
    }

    .form-control::-webkit-input-placeholder {
        color: #999;
        opacity: 1
    }

    .form-control:-moz-placeholder {
        color: #999;
        opacity: 1
    }

    .form-control::-moz-placeholder {
        color: #999;
        opacity: 1
    }

    .form-control:-ms-input-placeholder {
        color: #999;
        opacity: 1
    }

    .form-control::-ms-input-placeholder {
        color: #999;
        opacity: 1
    }

    .form-control::placeholder {
        color: #999;
        opacity: 1
    }

    .form-control:focus {
        border-color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .custom-file-input:focus~.custom-file-label {
        border-color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .custom-file-label,
    .custom-select {
        color: #999
    }

    .custom-file-label::after {
        background-color: #f2f2f2;
        border-radius: 0
    }

    .invalid-tooltip {
        font-size: .625rem;
        background-color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .custom-control {
        margin-bottom: .3125rem
    }

    .custom-control-label {
        font-size: .875rem;
        font-weight: 600;
        color: rgba(25, 51, 109, .9);
        cursor: pointer
    }

    .custom-control-label::before {
        border-radius: 50% !important;
        border-width: 2px;
        border-color: #d9d9d9
    }

    .custom-control-input:focus:not(:checked)~.custom-control-label::before {
        border-color: #5bc4b4
    }

    .custom-control-input:focus~.custom-control-label::before {
        -webkit-box-shadow: 0 0 0 .2rem rgba(91, 196, 180, .3);
        box-shadow: 0 0 0 .2rem rgba(91, 196, 180, .3)
    }

    .custom-control-input:checked~.custom-control-label::before {
        border-color: #5bc4b4;
        background-color: #5bc4b4
    }

    .custom-control-input:not(:disabled):active~.custom-control-label::before {
        border-color: rgba(91, 196, 180, .3);
        background-color: rgba(91, 196, 180, .3)
    }

    .form-control.is-valid,
    .was-validated .form-control:valid {
        border-color: rgba(0, 0, 0, .08)
    }

    .form-control.is-valid:focus,
    .was-validated .form-control:valid:focus {
        border-color: rgba(0, 0, 0, .08)
    }

    .custom-control-input.is-valid~.custom-control-label,
    .was-validated .custom-control-input:valid~.custom-control-label {
        color: rgba(25, 51, 109, .9)
    }

    .custom-control-input.is-valid~.custom-control-label::before,
    .was-validated .custom-control-input:valid~.custom-control-label::before {
        border-color: #d9d9d9
    }

    .custom-control-input.is-valid:checked~.custom-control-label::before,
    .was-validated .custom-control-input:valid:checked~.custom-control-label::before {
        background-color: #5bc4b4
    }

    .custom-control-input.is-valid:focus:not(:checked)~.custom-control-label::before,
    .was-validated .custom-control-input:valid:focus:not(:checked)~.custom-control-label::before {
        background-color: rgba(91, 196, 180, .3)
    }

    .custom-control-input.is-valid:checked~.custom-control-label::before,
    .was-validated .custom-control-input:valid:checked~.custom-control-label::before,
    .custom-control-input.is-valid:focus:not(:checked)~.custom-control-label::before,
    .was-validated .custom-control-input:valid:focus:not(:checked)~.custom-control-label::before {
        border-color: #5bc4b4
    }

    .accordion .card-header .btn {
        color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .accordion .card-header .btn[aria-expanded="false"] .card-header__closer__icon {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg)
    }

    .accordion .card-header__closer__icon {
        color: #a6a6a6
    }

    .accordion .card-body {
        border-radius: 7px
    }

    .sticky-card {
        position: -webkit-sticky;
        position: sticky;
        top: 15vh;
        padding: 3.125rem 1.25rem;
        border-radius: 8px;
        -webkit-box-shadow: 5px 5px 20px rgba(25, 51, 109, .09);
        box-shadow: 5px 5px 20px rgba(25, 51, 109, .09);
        max-width: 18.75rem
    }

    @media (min-width:1200px) {
        .sticky-card {
            margin-top: -9.375rem
        }
    }

    .sticky-card__logo {
        max-width: 13.75rem
    }

    .sticky-card__text {
        line-height: 1.2
    }

    .header {
        z-index: 9
    }

    @media (min-width:1200px) {
        .header .navbar {
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -moz-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        .header .navbar>.container {
            padding: 0;
            margin-left: 0;
            margin-right: 0
        }
    }

    .header .navbar-brand {
        max-width: 12.5rem
    }

    .header .navbar-collapse__logo {
        -webkit-box-ordinal-group: 2;
        -webkit-order: 1;
        -moz-box-ordinal-group: 2;
        -ms-flex-order: 1;
        order: 1;
    }

    @media (max-width:1199.98px) {
        .header .navbar-collapse {
            position: fixed;
            top: 0;
            left: 0;
            -webkit-transform: translateX(-100%);
            -moz-transform: translateX(-100%);
            -ms-transform: translateX(-100%);
            -o-transform: translateX(-100%);
            transform: translateX(-100%);
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: reverse;
            -webkit-flex-direction: column-reverse;
            -moz-box-orient: vertical;
            -moz-box-direction: reverse;
            -ms-flex-direction: column-reverse;
            flex-direction: column-reverse;
            -webkit-box-align: start;
            -webkit-align-items: flex-start;
            -moz-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -moz-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            width: 50%;
            height: 100vh;
            padding: 0 1.875rem 9.375rem;
            overflow-y: auto;
            background-color: #fff;
            -webkit-transition: -webkit-transform 0.3s cubic-bezier(.075, .82, .165, 1);
            transition: -webkit-transform 0.3s cubic-bezier(.075, .82, .165, 1);
            -o-transition: -o-transform 0.3s cubic-bezier(.075, .82, .165, 1);
            -moz-transition: transform 0.3s cubic-bezier(.075, .82, .165, 1), -moz-transform 0.3s cubic-bezier(.075, .82, .165, 1);
            transition: transform 0.3s cubic-bezier(.075, .82, .165, 1);
            transition: transform 0.3s cubic-bezier(.075, .82, .165, 1), -webkit-transform 0.3s cubic-bezier(.075, .82, .165, 1), -moz-transform 0.3s cubic-bezier(.075, .82, .165, 1), -o-transform 0.3s cubic-bezier(.075, .82, .165, 1);
            z-index: 5
        }

        .header .navbar-collapse::before,
        .header .navbar-collapse::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 120%;
            z-index: 2;
            pointer-events: none
        }

        .header .navbar-collapse::after {
            -webkit-clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%);
            clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%)
        }

        .header .navbar-collapse.show {
            -webkit-transform: translateX(0);
            -moz-transform: translateX(0);
            -ms-transform: translateX(0);
            -o-transform: translateX(0);
            transform: translateX(0);
            -webkit-box-shadow: 2px 0 15px rgba(0, 0, 0, .1);
            box-shadow: 2px 0 15px rgba(0, 0, 0, .1)
        }

        .header .navbar-collapse.show::before {
            background-color: #fff;
            opacity: 1;
            -webkit-animation: slideFade 4s forwards;
            -moz-animation: slideFade 4s forwards;
            -o-animation: slideFade 4s forwards;
            animation: slideFade 4s forwards
        }

        .header .navbar-collapse.show::after {
            -webkit-animation: slideReveal 1s forwards;
            -moz-animation: slideReveal 1s forwards;
            -o-animation: slideReveal 1s forwards;
            animation: slideReveal 1s forwards
        }
    }

    @media (max-width:767.98px) {
        .header .navbar-collapse {
            width: 100%
        }
    }

    @-webkit-keyframes slideFade {
        0% {
            background-color: #fff;
            opacity: 1
        }

        100% {
            background-color: transparent;
            opacity: 0
        }
    }

    @-moz-keyframes slideFade {
        0% {
            background-color: #fff;
            opacity: 1
        }

        100% {
            background-color: transparent;
            opacity: 0
        }
    }

    @-o-keyframes slideFade {
        0% {
            background-color: #fff;
            opacity: 1
        }

        100% {
            background-color: transparent;
            opacity: 0
        }
    }

    @keyframes  slideFade {
        0% {
            background-color: #fff;
            opacity: 1
        }

        100% {
            background-color: transparent;
            opacity: 0
        }
    }

    @-webkit-keyframes slideReveal {
        0% {
            -webkit-clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%);
            clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%)
        }

        70% {
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%)
        }

        100% {
            -webkit-clip-path: polygon(100% 0, 100% 0, 100% 100%, 100% 100%);
            clip-path: polygon(100% 0, 100% 0, 100% 100%, 100% 100%)
        }
    }

    @-moz-keyframes slideReveal {
        0% {
            clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%)
        }

        70% {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%)
        }

        100% {
            clip-path: polygon(100% 0, 100% 0, 100% 100%, 100% 100%)
        }
    }

    @-o-keyframes slideReveal {
        0% {
            clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%)
        }

        70% {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%)
        }

        100% {
            clip-path: polygon(100% 0, 100% 0, 100% 100%, 100% 100%)
        }
    }

    @keyframes  slideReveal {
        0% {
            -webkit-clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%);
            clip-path: polygon(0 0, 0% 0, 0% 100%, 0% 100%)
        }

        70% {
            -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%)
        }

        100% {
            -webkit-clip-path: polygon(100% 0, 100% 0, 100% 100%, 100% 100%);
            clip-path: polygon(100% 0, 100% 0, 100% 100%, 100% 100%)
        }
    }

    @media (max-width:1199.98px) {
        .header .navbar-nav {
            width: 100%
        }
    }

    @media (max-width:1199.98px) {
        .header .navbar .nav-item .dropdown-toggle {
            width: 100%;
            text-align: left
        }
    }

    .header .navbar .nav-item .dropdown-toggle::after {
        display: none
    }

    .header .navbar .nav-item .dropdown-toggle::before {
        position: absolute;
        bottom: 0;
        left: 50%;
        -webkit-transform: translate(-50%, 50%) rotate(45deg);
        -moz-transform: translate(-50%, 50%) rotate(45deg);
        -ms-transform: translate(-50%, 50%) rotate(45deg);
        -o-transform: translate(-50%, 50%) rotate(45deg);
        transform: translate(-50%, 50%) rotate(45deg);
        width: .625rem;
        height: .625rem;
        background-color: <?php echo e(colorSetting()->theme_color); ?>;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        -webkit-transition: all linear .2s;
        -o-transition: all linear .2s;
        -moz-transition: all linear .2s;
        transition: all linear .2s
    }

    @media (min-width:1200px) {
        .header .navbar .nav-item .dropdown-toggle::before {
            content: ""
        }
    }

    .header .navbar .nav-item .dropdown-menu {
        padding: 0;
        background-color: #f9f9f9
    }

    @media (min-width:1200px) {
        .header .navbar .nav-item .dropdown-menu {
            width: 100%;
            padding: 1.25rem 0;
            opacity: 0;
            visibility: hidden;
            background-color: <?php echo e(colorSetting()->theme_color); ?>

        }
    }

    @media (max-width:1199.98px) {
        .header .navbar .nav-item .dropdown-menu .container {
            max-width: 100%
        }
    }

    @media (max-width:1199.98px) {
        .header .navbar .nav-item .dropdown-menu .nav-item {
            width: 100%
        }
    }

    .header .navbar .nav-item .dropdown-item {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        padding-top: .9375rem;
        padding-bottom: .9375rem;
        font-weight: 600
    }

    @media (min-width:1200px) {
        .header .navbar .nav-item .dropdown-item {
            color: #fff;
            padding-top: .5rem;
            padding-bottom: .5rem
        }
    }

    @media (max-width:1199.98px) {
        .header .navbar .nav-item .dropdown-item {
            padding-left: 0;
            padding-right: 0
        }
    }

    .header .navbar .nav-item .dropdown-item:active,
    .header .navbar .nav-item .dropdown-item:hover,
    .header .navbar .nav-item .dropdown-item:focus {
        color: #5bc4b4
    }

    .header .navbar .nav-item .dropdown-item.active {
        color: #5bc4b4
    }

    @media (min-width:1200px) {
        .header .navbar .nav-item .dropdown-item.active {
            color: #fff;
            border: 2px solid currentColor;
            border-radius: 2rem
        }

        .header .navbar .nav-item .dropdown-item.active:hover,
        .header .navbar .nav-item .dropdown-item.active:focus {
            border-color: #5bc4b4
        }
    }

    @media (min-width:1200px) {

        .header .navbar .nav-item.dropdown:hover .dropdown-toggle::before,
        .header .navbar .nav-item.dropdown:hover .dropdown-menu,
        .header .navbar .nav-item.dropdown:focus .dropdown-toggle::before,
        .header .navbar .nav-item.dropdown:focus .dropdown-menu {
            opacity: 1;
            visibility: visible
        }

        .header .navbar .nav-item.dropdown:hover .dropdown-toggle::before,
        .header .navbar .nav-item.dropdown:focus .dropdown-toggle::before {
            -webkit-transition-duration: .3s;
            -moz-transition-duration: .3s;
            -o-transition-duration: .3s;
            transition-duration: .3s
        }

        .header .navbar .nav-item.dropdown:hover .nav-link,
        .header .navbar .nav-item.dropdown:focus .nav-link {
            color: #5bc4b4
        }
    }

    .header .navbar .nav-link {
        color: <?php echo e(colorSetting()->theme_color); ?>;
        font-size: 1rem;
        font-weight: 600;
        padding: .9375rem
    }

    @media (min-width:1200px) and (max-width:1399.98px) {
        .header .navbar .nav-link {
            font-size: 14px;
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important
        }

        .header .navbar .btn-nav .nav-item .gradient-btn--primary,
        .header .navbar .btn-nav .nav-item .gradient-btn--secondary {
            font-size: 12px;
            padding-left: .9rem;
            padding-right: .9rem
        }

        .header .navbar .social-nav__link {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important
        }
    }

    @media (min-width:1200px) {
        .header .navbar .nav-link {
            padding: 1.25rem .9375rem
        }
    }

    .header .navbar .nav-link:hover,
    .header .navbar .nav-link:focus-visible {
        color: #5bc4b4
    }

    .header .navbar .nav-link.active {
        color: #4a9fc6 !important
    }

    @media (min-width:1200px) {
        .header .navbar .nav-link:focus~.dropdown-menu {
            opacity: 1;
            visibility: visible
        }
    }

    @media (min-width:1200px) {
        .header .navbar .btn-nav .nav-item:not(:last-child) {
            margin-right: .9375rem
        }
    }

    @media (max-width:1199.98px) {
        .header .navbar .btn-nav .nav-item:not(:last-child) {
            margin-bottom: .9375rem
        }
    }

    @media (max-width:1199.98px) {
        .header .navbar .btn-nav {
            -webkit-box-ordinal-group: 1;
            -webkit-order: 0;
            -moz-box-ordinal-group: 1;
            -ms-flex-order: 0;
            order: 0
        }
    }

    .header .navbar .social-nav__link {
        color: #fff;
        padding: .3125rem .9375rem
    }

    .header .navbar .social-nav__link:hover,
    .header .navbar .social-nav__link:focus {
        color: #5bc4b4
    }

    @media (max-width:1199.98px) {
        .header .navbar .social-nav {
            -webkit-box-ordinal-group: 0;
            -webkit-order: -1;
            -moz-box-ordinal-group: 0;
            -ms-flex-order: -1;
            order: -1
        }

        .header .navbar .social-nav__link {
            color: <?php echo e(colorSetting()->theme_color); ?>

        }
    }

    .header--fixed {
        position: absolute;
        top: 0
    }

    @media (min-width:1200px) {
        .header--fixed {
            padding-top: .9375rem;
            padding-bottom: .9375rem
        }
    }

    .header--fixed:not(.fixed) .navbar .nav-link {
        color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .header--fixed:not(.fixed) .navbar .nav-link:hover,
    .header--fixed:not(.fixed) .navbar .nav-link:focus {
        color: #5bc4b4
    }

    @media (min-width:1200px) {
        .header--fixed:not(.fixed) .navbar .social-nav__link {
            color: <?php echo e(colorSetting()->theme_color); ?>

        }

        .header--fixed:not(.fixed) .navbar .social-nav__link:hover,
        .header--fixed:not(.fixed) .navbar .social-nav__link:focus {
            color: #5bc4b4
        }
    }

    @media (max-width:1199.98px) {
        .header--fixed .navbar-brand {
            display: none !important
        }
    }

    .header--fixed .navbar-brand__logo {
        display: block
    }

    .header--fixed .navbar-brand__active-logo {
        display: none
    }

    .header--fixed.fixed {
        position: fixed;
        -webkit-transform: translateY(-100%);
        -moz-transform: translateY(-100%);
        -ms-transform: translateY(-100%);
        -o-transform: translateY(-100%);
        transform: translateY(-100%);
        background-color: #fff;
        -webkit-box-shadow: 0 3px 18px rgba(0, 0, 0, .12);
        box-shadow: 0 3px 18px rgba(0, 0, 0, .12);
        -webkit-animation: header_in .4s linear forwards;
        -moz-animation: header_in .4s linear forwards;
        -o-animation: header_in .4s linear forwards;
        animation: header_in .4s linear forwards
    }

    .header--sticky {
        background-color: <?php echo e(colorSetting()->theme_color); ?>

    }

    @media (min-width:1200px) {
        .header--sticky .navbar .btn-nav .nav-item .gradient-btn--primary {
            -webkit-box-shadow: none;
            box-shadow: none
        }
    }

    @media (min-width:1200px) {
        .header.sticky {
            position: fixed;
            top: 0
        }
    }

    @media (min-width:1200px) {
        .header--active:not(.fixed) .navbar .nav-link {
            color: #fff
        }
    }

    @media (min-width:1200px) {
        .header--active:not(.fixed) .navbar .social-nav__link {
            color: #fff
        }
    }

    .navbar-toggler {
        position: fixed;
        bottom: 0;
        left: 0;
        font-size: .75rem;
        letter-spacing: 4px;
        color: <?php echo e(colorSetting()->theme_color); ?>;
        background-color: #fff;
        font-weight: 600;
        width: 8.125rem;
        height: 3.75rem;
        border-radius: 0;
        -webkit-box-shadow: 4px 9px 20px rgba(80, 136, 163, .15);
        box-shadow: 4px 9px 20px rgba(80, 136, 163, .15);
        z-index: 10;
        -webkit-transition: all 0.25s ease;
        -o-transition: all 0.25s ease;
        -moz-transition: all 0.25s ease;
        transition: all 0.25s ease
    }

    .navbar-toggler__wrapper {
        -webkit-transition: all 0.25s ease;
        -o-transition: all 0.25s ease;
        -moz-transition: all 0.25s ease;
        transition: all 0.25s ease
    }

    .navbar-toggler__icon {
        width: 1.25rem;
        height: 1.25rem;
        color: <?php echo e(colorSetting()->theme_color); ?>

    }

    .navbar-toggler__icon::before,
    .navbar-toggler__icon::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 1px;
        background-color: currentColor;
        -webkit-transition: -webkit-transform 0.5s cubic-bezier(0, .785, 0, 1);
        transition: -webkit-transform 0.5s cubic-bezier(0, .785, 0, 1);
        -o-transition: -o-transform 0.5s cubic-bezier(0, .785, 0, 1);
        -moz-transition: transform 0.5s cubic-bezier(0, .785, 0, 1), -moz-transform 0.5s cubic-bezier(0, .785, 0, 1);
        transition: transform 0.5s cubic-bezier(0, .785, 0, 1);

        transition:transform 0.5s cubic-bezier(0, .785, 0, 1),
        -webkit-transform 0.5s cubic-bezier(0, .785, 0, 1),
        -moz-transform 0.5s cubic-bezier(0, .785, 0, 1),
        -o-transform 0.5s cubic-bezier(0,.785,0,1)}.navbar-toggler[aria-expanded="true"] {
            width: 3.75rem;

            border-radius:0 30px 0 0}.navbar-toggler[aria-expanded="true"] .navbar-toggler__wrapper{padding-right:6px}.navbar-toggler[aria-expanded="true"] .navbar-toggler__text{opacity:0;font-size:0;position:absolute}.navbar-toggler[aria-expanded="true"] .navbar-toggler__icon{color:#fff;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg)}.navbar-toggler[aria-expanded="true"] .navbar-toggler__icon::after {
                -webkit-transform: rotate(90deg);
                -moz-transform: rotate(90deg);
                -ms-transform: rotate(90deg);
                -o-transform: rotate(90deg);
                transform: rotate(90deg)
            }

            @media (min-width:768px) {
                .navbar-toggler:hover .navbar-toggler__text {
                    color: #5bc4b4
                }
            }

            @-webkit-keyframes header_in {
                0% {
                    -webkit-transform: translateY(-100%);
                    transform: translateY(-100%)
                }

                100% {
                    -webkit-transform: translateY(0);
                    transform: translateY(0)
                }
            }

            @-moz-keyframes header_in {
                0% {
                    -moz-transform: translateY(-100%);
                    transform: translateY(-100%)
                }

                100% {
                    -moz-transform: translateY(0);
                    transform: translateY(0)
                }
            }

            @-o-keyframes header_in {
                0% {
                    -o-transform: translateY(-100%);
                    transform: translateY(-100%)
                }

                100% {
                    -o-transform: translateY(0);
                    transform: translateY(0)
                }
            }

            @keyframes  header_in {
                0% {
                    -webkit-transform: translateY(-100%);
                    -moz-transform: translateY(-100%);
                    -o-transform: translateY(-100%);
                    transform: translateY(-100%)
                }

                100% {
                    -webkit-transform: translateY(0);
                    -moz-transform: translateY(0);
                    -o-transform: translateY(0);
                    transform: translateY(0)
                }
            }

            .footer {
                background-color: #09122a
            }

            .footer__logo {
                margin-bottom: .9375rem
            }

            .footer__block__title {
                color: #ffffff;
                font-size: 0.9rem;
                font-weight: 700;
                letter-spacing: 1px;
                line-height: 1.6;
                margin-bottom: .9375rem
            }

            .footer__block__list__item {
                color: #dedede
            }

            .footer__block__list--darken .footer__block__list__item {
                color: #dedede
            }

            .footer__block__list__link {
                font-size: .75rem;
                padding: 2px
            }

            .footer__block__list__link:hover,
            .footer__block__list__link:focus-visible {
                color: #ffffff;
                text-decoration: underline
            }

            .footer__copyright {
                color: #dedede;
                font-size: .75rem
            }

            .footer__copyright__link:hover,
            .footer__copyright__link:focus {
                color: #5bc4b4;
                text-decoration: underline
            }

            @media (min-width:1200px) {
                .footer__form {
                    -webkit-flex-wrap: nowrap;
                    -ms-flex-wrap: nowrap;
                    flex-wrap: nowrap
                }
            }

            .footer__form .form-control {
                background-color: #e6e6e6;
                width: 100%;
                min-height: 3.125rem;
                padding-left: 1.25rem;
                padding-right: 7.1875rem
            }

            .footer__form .gradient-btn--secondary {
                right: 0;
                border-radius: 0 .25rem .25rem 0;
                padding: 0 .9375rem;
                height: -moz-calc(100% - 4px);
                height: calc(100% - 4px)
            }

            .banner {
                position: relative;
                color: #fff
            }

            .banner__slider .slick__arrows {
                top: 0;
                width: 10%;
                height: 100%;
                color: #fff;
                background-color: transparent;
                font-size: 2.8125rem;
                opacity: .6
            }

            .banner__slider .slick__arrows--left {
                left: 0
            }

            .banner__slider .slick__arrows--right {
                right: 0
            }

            .banner__slider .slick__arrows:hover,
            .banner__slider .slick__arrows:focus-visible {
                color: #fff;
                opacity: 1
            }

            .banner__slider .slick-dots {
                position: absolute;
                width: 100%;
                -webkit-transform: translateY(-500%);
                -moz-transform: translateY(-500%);
                -ms-transform: translateY(-500%);
                -o-transform: translateY(-500%);
                transform: translateY(-500%)
            }

            .banner__slider .slick-dots li:not(:last-child) {
                margin-right: 8px
            }

            .banner__slider .slick-dots li button {
                width: 10px;
                height: 3px;
                background: #b3b3b3
            }

            .banner__slider .slick-dots li.slick-active button {
                background-color: #fff
            }

            .banner__slide__wrapper {
                --gradient-overlay: linear-gradient(180deg, rgba(67, 65, 78, .34) 49%, rgba(25, 51, 109, .49) 100%);
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                padding: 25vh 15px 45vh
            }

            @media (max-width:991.98px) {
                .banner__slide__wrapper {
                    padding: 25vh 15px
                }
            }

            .banner__logo {
                margin-bottom: 3.125rem
            }

            .banner__logo__icon {
                width: 18rem
            }

            .banner__title {
                font-weight: 300;
                line-height: 1.1
            }

            @media (min-width:768px) {
                .banner__title {
                    font-size: 2.5rem
                }
            }

            @media (min-width:992px) {
                .banner__title {
                    font-size: 4.375rem
                }
            }

            .banner__form {
                position: relative;
                padding: 30px 30px 20px
            }

            .banner__form::before {
                content: "";
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                background-color: <?php echo e(colorSetting()->footer_color); ?>

            }

            .banner__form .form-control,
            .banner__form .form-control::placeholder {
                color: <?php echo e(colorSetting()->footer_color); ?>

            }

            .banner__form .form-control {
                min-height: 42px
            }

            @media (min-width:992px) {
                .banner__form {
                    position: absolute;
                    right: 0;
                    bottom: 0;
                    left: 0;
                    z-index: 2
                }

                .banner__form::before {
                    opacity: .7
                }
            }

            .sub-banner {
                padding: 6.25rem 0
            }

            .sub-banner__title {
                color: <?php echo e(colorSetting()->theme_color); ?>;
                font-weight: 600;
                line-height: 1;
                margin-bottom: 1.25rem
            }

            @media (min-width:768px) {
                .sub-banner__title {
                    font-size: 4.0625rem
                }
            }

            .sub-banner__sub-title {
                color: <?php echo e(colorSetting()->theme_color); ?>;
                font-weight: 400;
                line-height: 1;
                margin-bottom: 1.25rem;
                font-size: 1.25rem
            }

            @media (min-width:768px) {
                .sub-banner__sub-title {
                    font-size: 2.1875rem
                }
            }

            @media (min-width:1200px) {
                .process__block {
                    padding: 0 1.25rem
                }
            }

            .process__block__circle {
                width: 4.375rem;
                height: 4.375rem;
                background-image: -webkit-linear-gradient(340deg, #5bc4b4, #4a9fc6 100%);
                background-image: -moz-linear-gradient(340deg, #5bc4b4, #4a9fc6 100%);
                background-image: -o-linear-gradient(340deg, #5bc4b4, #4a9fc6 100%);
                background-image: linear-gradient(110deg, #5bc4b4, #4a9fc6 100%)
            }

            .process__block__circle--shadow {
                background-image: none;
                -webkit-box-shadow: 5px 5px 20px rgba(74, 159, 198, .14);
                box-shadow: 5px 5px 20px rgba(74, 159, 198, .14)
            }

            .process__block__icon {
                width: 1.875rem;
                height: 1.875rem;
                fill: #fff
            }

            .process__block__title {
                color: <?php echo e(colorSetting()->theme_color); ?>;
                font-size: 1.25rem;
                font-weight: 500;
                line-height: 1.3
            }

            .process__block__text {
                line-height: 1.6
            }

            .footer-contact {
                background-image: -webkit-linear-gradient(320deg, #4493c4, #00f2ff 89%);
                background-image: -moz-linear-gradient(320deg, #4493c4, #00f2ff 89%);
                background-image: -o-linear-gradient(320deg, #4493c4, #00f2ff 89%);
                background-image: linear-gradient(130deg, #4493c4, #00f2ff 89%)
            }

            .footer-contact__title,
            .footer-contact__link {
                font-weight: 600
            }

            .footer-contact__title {
                font-size: 1.5rem;
                line-height: 1.3
            }

            .footer-contact__link {
                font-size: 1.375rem
            }

            .footer-contact__link:hover,
            .footer-contact__link:focus {
                color: <?php echo e(colorSetting()->theme_color); ?>

            }

            .footer-contact .gradient-btn--primary {
                font-weight: 600;
                padding-top: 1rem;
                padding-bottom: 1rem
            }

            .about .section-header__title {
                font-weight: 600
            }

            .about .section-header__title::after {
                content: "";
                position: absolute;
                right: 0;
                bottom: -20%;
                width: 12%;
                height: 3px;
                background-color: <?php echo e(colorSetting()->theme_color); ?>

            }

            @media (min-width:992px) {
                .about__text {
                    font-size: 1.625rem
                }
            }

            .about__video {
                cursor: pointer
            }

            .expertise {
                background-image: -webkit-linear-gradient(10deg, #5bc4b4, #4493c4 100%);
                background-image: -moz-linear-gradient(10deg, #5bc4b4, #4493c4 100%);
                background-image: -o-linear-gradient(10deg, #5bc4b4, #4493c4 100%);
                background-image: linear-gradient(80deg, #5bc4b4, #4493c4 100%)
            }

            @media (min-width:992px) {
                .expertise__text {
                    font-size: 1.125rem
                }
            }

            .expertise__shape {
                height: 3.6875rem;
                margin-bottom: -2px
            }

            @media (max-width:991.98px) {
                .expertise__shape {
                    -webkit-transform: scaleX(3);
                    -moz-transform: scaleX(3);
                    -ms-transform: scaleX(3);
                    -o-transform: scaleX(3);
                    transform: scaleX(3)
                }
            }

            @media (max-width:575.98px) {
                .expertise__shape {
                    -webkit-transform: scaleX(6);
                    -moz-transform: scaleX(6);
                    -ms-transform: scaleX(6);
                    -o-transform: scaleX(6);
                    transform: scaleX(6)
                }
            }

            .services__block__circle {
                width: 6.25rem;
                height: 6.25rem
            }

            .services__block__circle__icon {
                width: 3.125rem;
                height: 3.125rem
            }

            .services__block__circle--shadow {
                -webkit-box-shadow: 0 0 0 3px rgba(0, 0, 0, .07);
                box-shadow: 0 0 0 3px rgba(0, 0, 0, .07)
            }

            .cookies {
                left: 0;
                bottom: 0;
                padding: 20px 15px;
                z-index: 999;
                transform: translateY(100%);
                opacity: 0;
                transition: all .6s cubic-bezier(.68, -.6, .32, 1.6);
                visibility: hidden;
                pointer-events: none;
                user-select: none
            }

            .cookies.show {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
                pointer-events: all;
                user-select: initial
            }

            .cookies .cookies-content {
                border-radius: 10px;
                padding: 20px;
                box-shadow: 0 0 0 3px #59bfb6;
                background-color: #211773
            }

            .cookies .cookies__icon {
                width: 35px;
                height: 35px;
                background-color: rgba(69, 149, 195, .37)
            }

            .cookies .cookies__icon__image {
                max-width: 25px;
                filter: invert(1);
                animation: shake .9s cubic-bezier(.68, -.6, .32, 1.6) infinite
            }

            @keyframes  shake {

                0%,
                100% {
                    transform: rotate(0) scale(1)
                }

                50% {
                    transform: rotate(10deg) scale(1.05)
                }
            }

            .cookies .cookies__main {
                margin: 0 15px;
                max-width: 500px
            }

            .cookies .cookies__text {
                color: #fff;
                font-size: 14px;
                font-weight: 500
            }

            .cookies .cookies__button {
                font-size: 12px;
                width: 85px;
                padding: 8px 5px;
                color: #fff;
                border: 1px solid #59bfb6;
                background-color: transparent;
                cursor: pointer;
                outline: 0;
                transition: all .3s linear
            }

            .cookies .cookies__button--allow {
                border-radius: 100px 50px 50px 100px !important;
                background-color: #59bfb6;
                border-color: #59bfb6
            }

            .cookies .cookies__button--decline {
                border-radius: 50px 100px 100px 50px !important;
                color: #211773;
                background-color: #fff;
                border-color: #fff
            }

            .cookies .cookies__button--allow:active {
                color: #211773;
                background-color: #fff
            }

            .cookies .cookies__button--decline:active {
                color: #fff;
                background-color: #59bfb6
            }

            @media  only screen and (min-width:768px) {

                .cookies .cookies__button--allow:hover,
                .cookies .cookies__button--allow:focus {
                    color: #211773;
                    background-color: #fff
                }

                .cookies .cookies__button--decline:hover,
                .cookies .cookies__button--decline:focus {
                    color: #fff;
                    background-color: #59bfb6
                }
            }

            @media  only screen and (max-width:767.98px) {
                .cookies {
                    left: 0
                }

                .cookies .cookies-content {
                    flex-direction: column
                }

                .cookies .cookies-content .cookies__main {
                    text-align: center;
                    margin: 15px 0
                }
            }

            .whatsapp-btn {
                position: fixed;
                z-index: 2;
                right: 15px;
                bottom: 15px
            }

            .video-testimonial__slide {
                padding: 30px
            }

            .video-testimonial__slide__card {
                position: relative;
                border-radius: 4px
            }

            .video-testimonial__slide__card::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: #57bcb4;
                background-image: -webkit-linear-gradient(118deg, #57bcb4, #4796b5);
                background-image: linear-gradient(118deg, #57bcb4, #4796b5);
                box-shadow: 0 0 10px 1px rgba(87, 188, 180, .7);
                border-radius: inherit;
                transform: rotate(5deg);
                z-index: -1
            }

            .video-testimonial__slide__card .embed-responsive {
                border-radius: inherit
            }

            .video-testimonial__slider .slick__arrows {
                --size: 42px;
                -webkit-transform: translateY(-200%);
                -moz-transform: translateY(-200%);
                -ms-transform: translateY(-200%);
                -o-transform: translateY(-200%);
                transform: translateY(-200%);
                width: var(--size);
                height: var(--size);
                border-radius: 50%;
                color: <?php echo e(colorSetting()->theme_color); ?>;
                background-color: #fff;
                -webkit-box-shadow: .3125rem .3125rem 1.25rem rgba(0, 0, 0, .12);
                box-shadow: .3125rem .3125rem 1.25rem rgba(0, 0, 0, .12);
                font-size: 1.25rem
            }

            .video-testimonial__slider .slick__arrows--left {
                right: -moz-calc((var(--size) + 14px) * 1.2);
                right: calc((var(--size) + 14px) * 1.2)
            }

            .video-testimonial__slider .slick__arrows--right {
                right: 14px
            }

            .video-testimonial__slider .slick__arrows:hover,
            .video-testimonial__slider .slick__arrows:focus-visible {
                color: #fff;
                background-color: #5bc4b4
            }

            .text-collapse__btn {
                background-color: transparent;
                border: 0;
                font-weight: 400;
                color: #000;
                opacity: .5
            }

            .text-collapse__btn:hover {
                opacity: 1;
                text-decoration: underline
            }

            .project-card {
                display: flex;
                flex-direction: column;
                border-radius: 8px;
                overflow: hidden;
                background-color: <?php echo e(colorSetting()->footer_color); ?>

            }

            .project-card__header,
            .project-card__header::before,
            .project-card__footer__btn {
                display: block
            }

            .project-card__header {
                position: relative
            }

            .project-card__header::before {
                content: "";
                padding-top: 64.23%
            }

            .project-card__header__image {
                top: 0
            }

            .project-card__body {
                color: #fff;
                padding: 20px 15px
            }

            .project-card__body__title {
                font-size: 22px;
                font-weight: 600;
                margin-bottom: 15px
            }

            .project-card__body__sub-title {
                font-size: 18px;
                font-weight: 500
            }

            .project-card__footer {
                margin-top: auto;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px
            }

            .project-card__footer__btn {
                display: block;
                text-align: center;
                color: #fff;
                background-color: #5bc4b4;
                padding: 10px;
                text-transform: uppercase;
                font-size: 14px;
                font-weight: 600;

                transition:color .25s ease-in-out,
                background-color .25s ease-in-out}.project-card__footer__btn:hover,.project-card__footer__btn:active,.project-card__footer__btn:focus-visible{color:#5bc4b4;background-color:<?php echo e(colorSetting()->footer_color); ?>}.match-height>[class*="col"] {
                    display: flex;
                    flex-flow: column
                }

                .match-height>[class*="col"]>* {
                    flex: 1 1 auto
                }

                select.form-control {
                    cursor: pointer
                }

                .video-testimonial__slide__card__thumbnail-wrapper {
                    position: absolute;
                    top: 0;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    border: 0
                }

                .video-testimonial__slide__card__thumbnail-wrapper {
                    background: transparent;
                    border-radius: inherit;
                    cursor: pointer;
                    padding: 0
                }

                .video-testimonial__slide__card__thumbnail-image {
                    width: 100% !important;
                    height: 100% !important;
                    object-fit: cover;
                    font-size: 0
                }

                .video-testimonial__slide__card__thumbnail-icon {
                    position: absolute;
                    inset: 0;
                    margin: auto;
                    font-size: 68px
                }

                .iti__flag-container {
                    color: #211773
                }

                .iti__dial-code {
                    color: #000
                }

                .iti {
                    display: block
                }

                .hr,
                .hr__text {
                    position: relative
                }

                .hr {
                    display: flex;
                    align-items: center;
                    justify-content: center
                }

                .hr::before {
                    content: "";
                    position: absolute;
                    width: 100%;
                    height: 1px;
                    background-color: #170863
                }

                .hr__text {
                    background-color: #ffffff;
                    padding: 1px 15px
                }

                .text-primary {
                    color: #59c0b6 !important
                }

                @media(max-width: 667.98px) {
                    .hr__text * {
                        font-size: 18px
                    }
                }

                .chat-btn {
                    position: fixed;
                    bottom: 15px;
                    right: 15px;
                    z-index: 2;
                    display: inline-flex;
                    align-items: center;
                    justify-content: center;
                    width: 60px;
                    height: 60px;
                    border-radius: 50%;
                    background-color: #ffffff;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.15)
                }

                .chat-btn__image {
                    transform: translateY(5%)
                }

                .footer .social-nav__link {
                    color: #ffffff;
                    padding: 0.3125rem 0.9375rem;
                }

                .footer .social-nav__link:hover,
                .footer .social-nav__link:focus {
                    color: #5bc4b4;
                }

                .footer__bottom {
                    border-top: 1px solid #393939;
                }

                .card-shadow {
                    box-shadow: 5px 5px 20px rgba(25, 51, 109, .09);
                }

                .chat-btn__card {
                    position: absolute;
                    top: 0;
                    right: 0;
                    display: inline-block;
                    padding: 10px 20px;
                    width: max-content;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
                    border-radius: 6px;
                    background-image: linear-gradient(90deg, #5bc4b4, #4a9fc6);
                    color: #fff;
                    transform-origin: right center;
                    transform: translateY(0) scaleX(0);
                    opacity: 0;
                    transition: all 1s cubic-bezier(0.34, 1.56, 0.64, 1);
                }

                .chat-btn.active .chat-btn__card {
                    animation: chat_show 6s cubic-bezier(0.34, 1.56, 0.64, 1) infinite;
                }

                @keyframes  chat_show {

                    0%,
                    100% {
                        transform: translateY(0) scaleX(0);
                        opacity: 0;
                    }

                    10%,
                    90% {
                        transform: translateY(-115%) scaleX(1);
                        opacity: 1;
                    }
                }

                @media (max-width: 575.98px) {
                    .chat-btn__image {
                        width: 30px;
                    }
                }

                @media (min-width: 576px) {
                    .chat-btn {
                        bottom: 60px;
                        right: 40px;
                        width: 80px;
                        height: 80px;
                    }
                }
</style>
<?php /**PATH C:\Users\user\Desktop\SoClose\V2-Novecology-Lead\resources\views/includes/style_css.blade.php ENDPATH**/ ?>