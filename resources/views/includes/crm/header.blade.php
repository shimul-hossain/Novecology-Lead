<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Site Meta Data -->
    <meta name="description" content="Novecology is a dashboard website">
    <meta name="keywords" content="dashboard, Novecology">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Site Title -->
	<title> @yield('title') | {{ config('app.name') }}</title>
	<!-- Favicon Link -->
	<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
	<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
	<link rel="icon" type="image/x-icon" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
	<!-- All CSS -->
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/fontawesome/css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/nice-select/css/nice-select.min.css') }}">
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/select2/css/select2.min.css') }}">
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/flatpickr/css/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/simplebar/css/simplebar.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	@stack('plugins-link')
	{{-- Style css  --}}
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/css/style.css') }}">

	<style>
		.page-item.disabled .page-link{
			background-color: #f2f2f2 !important;
		}
		.submit-btn-trans{
			background: #ececec;
		}
		.submit_btn_color{
			background: #36146b;
			color: #ffffff;
		}
		.cursor-pointer{
			cursor: pointer !important;
		}
		.select2-selection--multiple .select2-selection__choice.removed-remove-btn .select2-selection__choice__remove,
		.select2-selection--single .select2-selection__choice.removed-remove-btn .select2-selection__choice__remove
		{
			display: none!important;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__choice.removed-remove-btn{
			padding-left: 0 !important;
		}
		.distance-icon,
		.clock-icon
		{
			display: inline-block;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.distance-icon{
			width: 20px;
			height: 20px;
			background-image: url({{ asset('crm_assets/assets/images/distance-icon.png') }});
		}
		.clock-icon{
			width: 15px;
			height: 15px;
			background-image: url({{ asset('crm_assets/assets/images/clock-icon.png') }});
		}

		.tooltip-inner{
			padding: 5px;
			white-space: nowrap;
		}
		.taged_user{
			text-decoration: underline;
			color: #4D056E;
			font-weight: 700;
		}

        .select2_color_option-parent .select2-container--default .select2-selection--single .select2-selection__rendered{
            line-height: 36px;
            padding-left: 0;
            padding-right: 0;
        }
        .select2_color_option-parent .select2-results__option{
            padding: 0;
        }
        .select2_color_option-parent .select2-results__option.select2-results__option--disabled{
            padding: 6px;
        }
		.bg--gray{
			background-color: #f2f2f2 !important;
		}
		.btn-not-allow{
			cursor: not-allowed !important;
		}
		.table-row--active{
			background-color: #DCE7FB !important;
		}
		.filter-field--active{
			background-color: #A8D18D !important;
			color: #000000 !important;
		}

		.tbody-group tr:first-of-type td{
			border-top: 2px solid #000000;
		}
		.tbody-group tr td:first-of-type{
			border-left: 2px solid #000000;
		}
		.tbody-group tr td:last-of-type{
			border-right: 2px solid #000000;
		}
		.tbody-group tr:last-of-type td{
			border-bottom: 2px solid #000000;
		}

		.dynamic-table thead tr th{
			border-bottom: 2px solid #000000 !important;
		}
		.tbody-empty td{
			padding-top: 30px !important;
		}

		.filter-field--active + .select2-container--default .select2-selection--multiple {
			background-color: #a8d18d;
		}

		.only--positive--value--alert{
			color: red;
		}

        .navbar-fixed-width{
            width: 235px;
        }

        .navbar-scroll-bar{
            max-height: 90vh;
            overflow-y: scroll;
            overscroll-behavior: contain;
        }

        /* @media (max-height: 768px) {
                .navbar-scroll-bar{
                    height: 500px;
                    overflow-y: scroll;
                }
            } */

        .main_item {
            display: none;
          }

          .main_element h3{
            border-radius: .25rem;
            padding-top: 0.625rem;
            padding-bottom: 0.625rem;
            display: inline-block;
            color: #13438c;
            cursor: pointer !important;
            padding-left: 24px;

          }


          .main_element a{
              padding-left: 40px;
              color: #13438c;
              font-size: 14px;
              font-family: "SF Pro Display Regular", sans-serif;
              display: inline-block;
          }

          .main_element h3{
              position: relative;
          }

          .main_element i{
            font-size: 16px;
            font: bolder;
            font-weight: 900;

          }

          .main_element .icon{
              position: absolute;
              left: 88%;
              top: 14px;

          }
          .dropdown-item-active{
            color: white !important;
            background-color: #13438c;
          }


	</style>
 	@stack('css')

    <script defer>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '410422680847226');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"src="https://www.facebook.com/tr?id=410422680847226&ev=PageView&noscript=1"/></noscript>


</head>
<body class="@yield('bodyBg')">
	<!-- Preloader Section -->
	<div class="preloader position-fixed w-100 h-100">
		<div class="preloader__wrapper d-flex align-items-center justify-content-center w-100 h-100">
            <svg class="preloader__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="shape-rendering: auto;" width="4em" height="4em" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="50" cy="50" fill="none" stroke="#13438c" stroke-width="6" r="38" stroke-dasharray="179.0707812546182 61.690260418206066">
                  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"/>
                </circle>
            </svg>
		</div>
	</div>

	<main class="page-wrapper">
		<!-- Header Section -->
