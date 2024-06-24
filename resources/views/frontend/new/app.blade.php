<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Site Meta Data -->
    <meta name="author" content="Novecology">
    <meta name="keywords" content="Novecology, novecology">
	<!-- Site Title -->
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Site Meta Data -->
    <meta name="title" content="{{ config('app.name') }} - @yield('title')">
    <meta name="description" content="@yield('meta_description')">
    <!-- Primary Meta Tags -->

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('fb_url')">
    <meta property="og:title" content="@yield('fb_title')">
    <meta property="og:description" content="@yield('fb_description')">
    <meta property="og:image" content="@yield('fb_image')">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="@yield('twitter_url')">
    <meta property="twitter:title" content="@yield('twitter_title')">
    <meta property="twitter:description" content="@yield('twitter_desciption')">
    <meta property="twitter:image" content="@yield('twitter_image')">


	<!-- Favicon Link -->
	{{-- <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('frontend_assets/new/images/favicon/android-chrome-512x512.png') }}"> --}}
	{{-- <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('frontend_assets/new/images/favicon/android-chrome-192x192.png') }}"> --}}
	{{-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend_assets/new/images/favicon/apple-touch-icon.png') }}"> --}}
	{{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend_assets/new/images/favicon/favicon-32x32.png') }}"> --}}
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/new/setting') }}/{{ generalSetting()->favicon }}">
	{{-- <link rel="icon" type="image/x-icon" href="{{ asset('frontend_assets/new/images/favicon/favicon.ico') }}"> --}}
	<!-- All CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{ asset('frontend_assets/new/plugins/bootstrap/css/bootstrap.min.css') }}">
    @yield('plugin_css')
	<link rel="stylesheet" href="{{ asset('frontend_assets/new/css/style.min.css') }}">
    @stack('style_css')
</head>
<body>
	<!-- Header Section -->
	<header class="header bg-white fixed-top">
		<div class="header__top">
			<div class="container-fluid">
				<div class="header__top__wrapper d-flex">
					<span class="header__top__text align-self-center">
						<i class="fa-solid fa-phone me-2"></i> Contactez-nous au <a href="tel:{{ generalSetting()->phone }}" class="btn btn-sm btn-primary rounded-pill ms-2"><i class="fa-solid fa-phone me-2"></i> {{ generalSetting()->phone }}</a>
					</span>
					<ul class="nav header__top__nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle @yield('dropdownActiveClass')" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								QUI SOMMES-NOUS ?
							</a>
							<ul class="dropdown-menu">
								<li>
									<a class="dropdown-item @yield('notreHistoire')" href="{{ route('notre.histoire') }}">Notre histoire</a>
								</li>
								<li>
									<a class="dropdown-item @yield('nosValeurs')" href="{{ route('nos.valeurs') }}">Nos valeurs</a>
								</li>
								<li>
									<a class="dropdown-item @yield('nosReferences')" href="{{ route('nos.references') }}">Nos références</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link @yield('nousContacter')" href="{{ route('nous.contacter') }}">Nous Contacter</a>
						</li>
						<li class="nav-item">
							<a class="nav-link @yield('prendreRdv')" href="{{ route('prendre.rdv') }}">Prendre RDV</a>
						</li>
					</ul>
					<ul class="nav header__top__social-nav">
						<li class="nav-item">
							  <a class="nav-link" href="https://www.facebook.com/NOVECOLOGY" target="_blank">
								<i class="fa-brands fa-facebook-f"></i>
							</a>
						</li>
						<li class="nav-item">
							  <a class="nav-link" href="https://www.instagram.com/novecology/" target="_blank">
								<i class="fa-brands fa-instagram"></i>
							</a>
						</li>
						<li class="nav-item">
							  <a class="nav-link" href="https://www.youtube.com/@NOVECOLOGY" target="_blank">
								<i class="fa-brands fa-youtube"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<nav class="navbar navbar-expand-xl">
				<a class="navbar-brand" href="{{ route('new.home') }}">
					<img src="{{ asset('uploads/new/setting') }}/{{ generalSetting()->logo }}" alt="logo" class="navbar-brand__image">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas">
					<i class="fa-solid fa-bars"></i>
				</button>
				<div class="offcanvas offcanvas-end align-self-stretch" tabindex="-1" id="navbarOffcanvas">
					<ul class="navbar-nav ms-xl-auto">
						<li class="nav-item">
							  <a class="nav-link @yield('nosOffres')" href="{{ route('nos.offres') }}">Nos offres</a>
						</li>
						<li class="nav-item">
							  <a class="nav-link @yield('temoignagesClients')" href="{{ route('temoignages.clients') }}">Témoignages clients</a>
						</li>
						<li class="nav-item">
							  <a class="nav-link @yield('nosConseils')" href="{{ route('nos.conseils') }}">Nos Conseils</a>
						</li>
						<li class="nav-item">
							  <a class="nav-link @yield('auditEnergetique')" href="{{ route('audit.energetique') }}">Audit énergétique</a>
						</li>
						<li class="nav-item">
							  <a class="nav-link @yield('estimerVosAides')" href="{{ route('estimer.vos.aides') }}"">Estimer vos aides</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>

        @yield('content')

	<!-- Footer Section -->
	<footer class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xxl col-xl-3 col-lg-4 col-md-6">
					<div class="footer__block">
						<a href="{{ route('new.home') }}" class="d-inline-block">
							<img src="{{ asset('uploads/new/setting') }}/{{ generalSetting()->logo }}" alt="logo">
						</a> 
						<div class="footer__text"  style="white-space: pre-line">{{ generalSetting()->footer_description }}</div>
					</div>
				</div>
				<div class="col-xxl col-xl-3 col-lg-4 col-md-6">
					<div class="footer__block">
						<ul class="footer__list">
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">QUI SOMMES NOUS ?</a>
							</li>
							<li class="footer__list__item">
								<a href="{{ route('nous.contacter') }}" class="footer__list__link">NOUS CONTACTER</a>
							</li>
							<li class="footer__list__item">
								<a href="{{ route('nos.offres') }}" class="footer__list__link">NOS OFFRES</a>
							</li>
							<li class="footer__list__item">
								<a href="{{ route('temoignages.clients') }}" class="footer__list__link">TÉMOIGNAGES CLIENTS</a>
							</li>
							<li class="footer__list__item">
								<a href="{{ route('nos.conseils') }}" class="footer__list__link">NOS CONSEILS</a>
							</li>
							<li class="footer__list__item">
								<a href="{{ route('audit.energetique') }}" class="footer__list__link">AUDIT ÉNERGÉTIQUE</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xxl col-xl-3 col-lg-4 col-md-6">
					<div class="footer__block">
						<h3 class="footer__block__title">CHANGER MON CHAUFFAGE</h3>
						<ul class="footer__list">
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Chaudière à granulés</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Pompe à Chaleur Air/Eau</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Pompe à Chaleur Air/Air</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Chauffe Eau Thermodynamique</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Poêle à Granulés</a>
							</li>
						</ul>
						<h3 class="footer__block__title">ISOLER MA MAISON</h3>
						<ul class="footer__list">
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Isolation des murs</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xxl col-xl-3 col-lg-4 col-md-6">
					<div class="footer__block">
						<h3 class="footer__block__title">PASSER AU SOLAIRE</h3>
						<ul class="footer__list">
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Panneaux solaires</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Système Solaire Combiné</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Chauffe Eau Solaire</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Panneau Solaire “NOMADE”</a>
							</li>
						</ul>
						<h3 class="footer__block__title">RÉNOVATION GLOBALE </h3>
						<ul class="footer__list">
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Rénovation d'une maison individuelle</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-xxl col-xl-3 col-lg-4 col-md-6">
					<div class="footer__block">
						<h3 class="footer__block__title">ACTUALITÉS ET CONSEILS</h3>
						<ul class="footer__list">
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Comment réduire l'humidité dans une maison ?</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">8 conseils pour combattre l'éco-anxiété par des actions simples</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Conseils écologiques pour voyager de manière plus durable</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">22 façons de protéger notre planète</a>
							</li>
							<li class="footer__list__item">
								<a href="#!" class="footer__list__link">Le meilleur système de chauffage pour vous en 2022</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5 col-md-6">
					<ul class="footer__list">
						<li class="footer__list__item">
							<a href="{{ route('legal.notice') }}" class="footer__list__link">MENTIONS LÉGALES</a>
						</li>
						<li class="footer__list__item">
							<a href="{{ route('cookie.policy') }}" class="footer__list__link">POLITIQUE DE COOKIES</a>
						</li>
						<li class="footer__list__item">
							<a href="{{ route('bandeau-information') }}" class="footer__list__link">BANDEAU D’INFORMATION</a>
						</li>
						<li class="footer__list__item">
							<a href="{{ route('privacy.policy') }}" class="footer__list__link">POLITIQUE DE CONFIDENTIALITÉ</a>
						</li>
						<li class="footer__list__item">
							<a href="{{ route('droit.opposition') }}" class="footer__list__link">DROIT D'OPPOSITION</a>
						</li>
					</ul>
				</div>
				<div class="col-lg-7 col-md-6">
					<div class="footer__btn-group">
						<a href="{{ route('prendre.rdv') }}" class="btn-fat btn-fat--light btn-bear">
							Prendre <br> rendez-vous
							<img src="{{ asset('frontend_assets/new/images/icon/bear-image.png') }}" alt="bear" height="64" class="btn-bear__image user-select-none">
						</a>
						<a href="{{ route('estimer.vos.aides') }}" class="btn-fat btn-fat--warning">Estimez le montant de <br> vos aides</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Scroll To Top Button -->
	<div class="scroll-top position-fixed">
		<button class="scroll-top__btn border-0 d-inline-flex align-items-center justify-content-center">
			<i class="fa-solid fa-chevron-up"></i>
		</button>
	</div>

	<!-- All Scripts -->
	<script src="{{ asset('frontend_assets/new/plugins/jquery/jquery-3.6.4.min.js') }}"></script>
	<script src="{{ asset('frontend_assets/new/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @yield('plugin_js')
	<script src="{{ asset('frontend_assets/new/js/script.js') }}"></script>
    @stack('script_js')
</body>
</html>
