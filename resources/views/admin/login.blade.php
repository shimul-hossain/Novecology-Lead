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
	<title>@yield('title') | {{ config('app.name') }}</title>
	<!-- Favicon Link -->
	<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('assets/images/favicon/android-chrome-512x512.png') }}">
	<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/favicon/android-chrome-192x192.png') }}">
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
	<link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon/favicon.ico') }}">
	<!-- All CSS -->
	<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
 	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
	<main class="page-wrapper">
		<!-- Header Section -->

        <header class="header position-fixed bg-white w-100">
            <nav class="navbar navbar-expand-xxl">
                <div class="container">
                    <a class="navbar-brand brand-logo custom-focus d-block" href="{{ url('/') }}">
                        <img src="https://novecology.fr/frontend_assets/images/logo/logo.png" alt="logo">
                    </a>
                </div>
            </nav>
        </header>

        <!-- Banner Section -->
		<section class="banner section-gap position-relative">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-5 col-lg-6 col-md-8">
						<div class="banner__card bg-white">
							<form action="./index.html" class="form mx-auto needs-validation" id="login-form" novalidate>
								<h1 class="form__title position-relative text-center">Log in</h1>
								<div class="form-group d-flex flex-column align-items-center position-relative">
									<span class="novecologie-icon-envelope form-group__icon position-absolute"></span>
									<input type="email" name="email" class="form-control shadow-none" placeholder="Your username" required>
									<div class="invalid-feedback">This field is necessary</div>
								</div>
								<div class="form-group d-flex flex-column align-items-center position-relative">
									<span class="novecologie-icon-lock form-group__icon position-absolute"></span>
									<input type="password" name="password" class="form-control form-control--password shadow-none" placeholder="Password" required>
									<button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
										<span class="password-toggler__icon novecologie-icon-eye"></span>
									</button>
									<div class="invalid-feedback">This field is necessary</div>
								</div>
								<div class="form-group d-flex flex-column align-items-center mt-4">
									<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3">Log in</button>
									<a href="#!" class="primary-btn primary-btn--transparent primary-btn--lg rounded-pill">Forgot your password</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Contact Section -->
		<section class="contact section-gap pt-0">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-xl-auto col-lg-7">
						<div class="contact__card d-sm-flex align-items-center">
							<div class="contact__card__icon flex-shrink-0 d-inline-flex align-items-center justify-content-center rounded-circle">
								<span class="novecologie-icon-phone"></span>
							</div>
							<div class="contact__card__details">
								<h2 class="contact__card__title">For any questions, contact the</h2>
								<h1 class="contact__card__number"><a href="tel:+0970830831" class="custom-focus">0970 830 831</a></h1>
								<p class="contact__card__text mb-0">Available from <span class="font-weight-bold">9h00</span> To <span class="font-weight-bold">17h30</span> Monday to Friday (number not surcharged).</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

        	<!-- Footer Section -->
		<footer class="footer">
			<div class="container">
				<div class="row align-items-center justify-content-center position-relative">
					<div class="col-12">
						<ul class="footer__list list-inline text-center text-lg-left mb-lg-0">
							<li class="list-inline-item">
								<a href="#!" class="footer__list__link">Legal Notice</a>
							</li>
							<li class="list-inline-item">-</li>
							<li class="list-inline-item">
								<a href="#!" class="footer__list__link">Cookies policy</a>
							</li>
						</ul>
					</div>
					<ul class="footer__social-list list-inline text-center mb-0">
						<li class="list-inline-item">
							<a href="#!" class="footer__social-list__link d-inline-flex align-items-center justify-content-center rounded-circle">
								<span class="novecologie-icon-facebook"></span>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="#!" class="footer__social-list__link d-inline-flex align-items-center justify-content-center rounded-circle">
								<span class="novecologie-icon-linkedIn"></span>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="#!" class="footer__social-list__link d-inline-flex align-items-center justify-content-center rounded-circle">
								<span class="novecologie-icon-youTube"></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</footer>

		<!-- Scroll To Top Button -->
		<div class="scroll-top position-fixed">
			<button class="scroll-top__btn border-0 d-inline-flex align-items-center justify-content-center">
				<span class="novecologie-icon-chevron-up"></span>
			</button>
		</div>
	</main>
	

	<!-- All Scripts -->
	<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/fontawesome/js/all.min.js') }}"></script>
 	<script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>

@stack('js')