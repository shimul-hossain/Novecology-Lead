@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Audit énergétique")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', "Audit énergétique")

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', "Audit énergétique")

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

{{-- menu active  --}}
@section('auditEnergetique','active')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('frontend_assets/new/plugins/slick-slider/css/slick.min.css') }}">
@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')
	<!-- Banner Section -->
	<section class="sub-banner sub-banner--reversed">
		<div class="sub-banner__overlay">
			<img src="{{ asset('frontend_assets/new/images/audit/audit-energetique.webp') }}" alt="audit-energetique" class="sub-banner__image">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="sub-banner__wrapper">
						<h3 class="text-primary">{{ $item->banner_title }}</h3>
						<h1 class="sub-banner__title text-danger">{{ $item->banner_subtitle }}</h1>
						<p>{{ $item->banner_description }}</p>
						<a href="{{ $item->banner_button_link ?? '#!' }}" class="btn btn-primary text-uppercase rounded-pill">{{ $item->banner_button_text }}</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div class="main">
		<div class="container-fluid px-0">
			<div class="row g-0">
				<main class="col-lg">
					<section class="section-gap">
						<div class="container">
							<div class="section-header">
								<h1 class="section-header__title text-start">{{ $item->title }}</h1>
							</div>
							<p>{{ $item->description }}</p>
						</div>
					</section>
					<section class="section-gap bg-light-blue">
						<div class="container">
							<div class="row">
								<div class="col-lg-4 text-center">
									<img class="mx-auto" src="{{asset('uploads/new/audit-energetique')}}/{{ $item->first_block_image }}" alt="services details" loading="lazy" draggable="false">
									<a href="{{ $item->first_block_button_link ?? '#!' }}" class="btn-fat btn-fat--warning mt-3">{{ $item->first_block_button_text }}</a>
								</div>
								<div class="col-lg-8 mt-4 mt-lg-0">
									<h2 class="fs-4 mb-4">{{ $item->first_block_title }}</h2>
									<p>{{ $item->first_block_desciption }}</p>
								</div>
							</div>
						</div>
					</section>
					<section class="section-gap">
						<div class="container">
							<div class="row flex-xl-row-reverse">
								<div class="col-lg-4 text-center">
									<img class="mx-auto" src="{{asset('uploads/new/audit-energetique')}}/{{ $item->second_block_image }}" alt="services details" loading="lazy" draggable="false">
									<a href="{{ $item->second_block_button_link ?? '#!' }}" class="btn-fat btn-fat--warning mt-3">{{ $item->second_block_button_text }}</a>
								</div>
								<div class="col-lg-8 mt-4 mt-lg-0">
									<h2 class="fs-4 mb-4">{{ $item->second_block_title }}</h2>
									<p>{{ $item->second_block_desciption }}</p>
								</div>
							</div>
						</div>
					</section>
					<section class="section-gap bg-light-blue">
						<div class="container">
							<h2 class="fs-4 mb-4">{{ $item->third_block_title }}</h2>
							<div class="row">
								@foreach ($infos as $info)
									<div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-end">
										<div class="icon-card">
											<img class="icon-card__image" src="{{asset('uploads/new/audit-energetique')}}/{{ $info->image }}" alt="service icon" width="120" height="120" loading="lazy" draggable="false">
											<h3 class="icon-card__title fs-5">{{ $info->title }}</h3>
											<p class="icon-card__text fs-sm">{{ $info->description }}</p>
										</div>
									</div>
								@endforeach
								{{-- <div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-end">
									<div class="icon-card">
										<img class="icon-card__image" src="{{ asset('frontend_assets/new/images/services/services-details/icon/icon-1.svg') }}" alt="service icon" width="120" height="120" loading="lazy" draggable="false">
										<h3 class="icon-card__title fs-5">Un confort thermique</h3>
										<p class="icon-card__text fs-sm">La PAC Air/Eau maintient et garantit une température constante pendant toute la saison hivernale. Vous profitez ainsi d’une chaleur douce dans toutes les pièces de votre logement.</p>
									</div>
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-end">
									<div class="icon-card">
										<img class="icon-card__image" src="{{ asset('frontend_assets/new/images/services/services-details/icon/icon-2.svg') }}" alt="service icon" width="120" height="120" loading="lazy" draggable="false">
										<h3 class="icon-card__title fs-5">Un système écologique</h3>
										<p class="icon-card__text fs-sm">La pompe à chaleur Air/Eau se distingue des autres types de chauffage exploitant les énergies fossiles. Puisant son énergie dans l’air, elle est donc inodore lors de son fonctionnement contrairement aux chaudières au fioul ou au gaz.</p>
									</div>
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-end">
									<div class="icon-card">
										<img class="icon-card__image" src="{{ asset('frontend_assets/new/images/services/services-details/icon/icon-3.svg') }}" alt="service icon" width="120" height="120" loading="lazy" draggable="false">
										<h3 class="icon-card__title fs-5">Une plus value immobilière</h3>
										<p class="icon-card__text fs-sm">Le chauffage étant le plus gros poste de dépense énergétique dans un logement, la pompe à chaleur Air/Eau vous fait gagner en étiquette énergétique. S’équiper d’une PAC Air/Eau permet ainsi d’améliorer sa performance énergétique et de valoriser son habitat. Une habitation chauffée au fioul sera classée E, F ou G sur le DPE (Diagnostic de Performance Energétique). Équipée d’une PAC Air/Eau, celle-ci valorisera son DPE en moyenne d’une étiquette.</p>
									</div>
								</div>
								<div class="col-xl-3 col-lg-4 col-md-6 d-flex align-items-end">
									<div class="icon-card">
										<img class="icon-card__image" src="{{ asset('frontend_assets/new/images/services/services-details/icon/icon-4.svg') }}" alt="service icon" width="120" height="120" loading="lazy" draggable="false">
										<h3 class="icon-card__title fs-5">Une installation simple et efficace</h3>
										<p class="icon-card__text fs-sm">La PAC Air/Eau se compose d’une unité extérieure et d’une unité intérieure, positionnée dans une des pièces de la maison. Peu volumineuse, elle ne requiert que peu d’espace et vous permet ainsi de garder l’esthétisme de votre logement. En plus de présenter une performance de chauffe, la pompe à chaleur Air/Eau ne nécessite, à l’inverse du bois ou du fioul, pas d’espace de stockage pour le combustible. Facile d’installation et d’entretien, la PAC Air/Eau est la solution de chauffage idéale dans le cadre de travaux de rénovation énergétique.</p>
									</div>
								</div> --}}
							</div>
						</div>
					</section>
					<!-- Testimonial Section -->
					{{-- <section class="testimonial section-gap">
						<div class="container">
							<div class="section-header">
								<h1 class="section-header__title">Vous en parlez mieux que nous !</h1>
							</div>
							<div class="testimonial__wrapper bg-white">
								<div class="testimonial__slider row justify-content-center match-height">
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Installation d'une pompe à chaleur au top ! Merci à toute l'équipe qui a été très professionnelle. J...</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M., suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Le travail a bien été effectué très rapide et dans les délais.A recommandé.Merci</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M.  , suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Je recommande pour un travail de qualité, j'en suis très satisfait une équipe agréable et conscienci...</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M. ,suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Très bonne équipe et du très bon travail, des professionnels.....</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M. , suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Installation d'une pompe à chaleur au top ! Merci à toute l'équipe qui a été très professionnelle. J...</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M., suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Le travail a bien été effectué très rapide et dans les délais.A recommandé.Merci</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M.  , suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Je recommande pour un travail de qualité, j'en suis très satisfait une équipe agréable et conscienci...</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M. ,suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
									<div class="testimonial__slide col-xl-3 col-lg-4 col-md-6 px-1">
										<div class="testimonial__card">
											<div class="testimonial__card__head">
												<ul class="nav testimonial__card__list list-unstyled mb-0">
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
													<li class="testimonial__card__list__item">
														<i class="fa-solid fa-star"></i>
													</li>
												</ul>
												<span class="testimonial__card__head__text">
													<small>publié le 05/08/2023</small>
												</span>
											</div>
											<div class="testimonial__card__body">
												<blockquote class="testimonial__card__blockquote">
													<span class="testimonial__card__text">Très bonne équipe et du très bon travail, des professionnels.....</span>
												</blockquote>
												<cite class="testimonial__card__text mt-auto">
													<small>Sylvie M. , suite à une expérience du 04/08/2022</small>
												</cite>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section> --}}

					@include('frontend.new.review')

					<!-- Review Section -->
					<section class="review section-gap">
						<div class="container">
							<div class="row justify-content-center align-items-center flex-lg-row-reverse">
								<div class="col-lg-5">
									<div class="review__slider">
										@foreach ($testimonials as $testimonial)
											<div class="review__slide">
												<div class="review__card ratio ratio-4x3 rounded" data-toggle="thumbnail" data-embed-id="{{ $testimonial->embed_id }}"></div>
											</div>
										@endforeach 
									</div>
								</div>
								<div class="col-xl-5 text-center">
									<div class="section-header">
										<h1 class="section-header__title">{{ $testimonial_info->home_page_title }}</h1>
									</div>
									<a href="{{ route('temoignages.clients') }}" class="btn-fat btn-fat--primary">{{ $testimonial_info->home_page_button_text }}</a>
								</div>
							</div>
						</div>
					</section>
					{{-- <section class="review section-gap">
						<div class="container">
							<div class="row justify-content-center align-items-center flex-lg-row-reverse">
								<div class="col-lg-5">
									<div class="review__slider">
										<div class="review__slide">
											<div class="review__card ratio ratio-4x3 rounded" data-toggle="thumbnail" data-embed-id="pNfgyV3jRiY"></div>
										</div>
										<div class="review__slide">
											<div class="review__card ratio ratio-4x3 rounded" data-toggle="thumbnail" data-embed-id="cm7BjtGDzWg"></div>
										</div>
										<div class="review__slide">
											<div class="review__card ratio ratio-4x3 rounded" data-toggle="thumbnail" data-embed-id="xRNTW3eem48"></div>
										</div>
									</div>
								</div>
								<div class="col-xl-5 text-center">
									<div class="section-header">
										<h1 class="section-header__title">NOS CLIENTS PARTAGENT LEURS EXPÉRIENCES</h1>
									</div>
									<a href="{{ route('temoignages.clients') }}" class="btn-fat btn-fat--primary">Les <br> Témoignages</a>
								</div>
							</div>
						</div>
					</section> --}}
				</main>
				<aside class="col-lg-auto px-3">
					<div class="sticky-card text-center">
						<a href="{{ route('new.home') }}" class="d-inline-block">
							<img src="{{ asset('frontend_assets/new/images/logo/logo.png') }}" alt="logo"  loading="lazy" draggable="false">
						</a>
						<p class="sticky-card__text">Bénéficiez d’une <span class="text-underline">étude gratuite</span> pour réaliser des <strong>économies sur votre facture énergétique</strong></p>
						<a href="#!" class="btn-fat btn-fat--gray btn-bear">
							Prendre <br> rendez-vous
							<img src="{{ asset('frontend_assets/new/images/icon/bear-image.png') }}" alt="bear" class="btn-bear__image user-select-none" height="64" loading="lazy" draggable="false">
						</a>
					</div>
				</aside>
			</div>
		</div>
	</div>

	<!-- Wavy Shape -->
	<figure class="wavy__figure user-select-none">
		<svg class="wavy__figure__shape" fill="currentColor" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 54 1024 162" preserveAspectRatio="none">
			<path d="M0 216.312h1024v-3.044c-50.8-17.1-108.7-30.7-172.7-37.9-178.6-19.8-220 36.8-404.9 21.3-206.6-17.2-228-126.5-434.5-141.6-3.9-.3-7.9-.5-11.9-.7v161.944z"></path>
		</svg>
	</figure>

	<!-- Footer Contact Section -->
	{{-- <section class="footer-contact section-gap">
		<div class="container">
			<div class="row flex-lg-row-reverse align-items-end">
				<div class="col-lg-4 footer-contact__shape text-center position-relative mb-5 mb-lg-0">
					<img src="{{ asset('frontend_assets/new/images/icon/bear-image.png') }}" alt="bear" height="300" draggable="false" loading="lazy" class="footer-contact__shape__image user-select-none">
					<a href="{{ route('new.home') }}" class="d-inline-block">
						<img src="{{ asset('frontend_assets/new/images/logo/logo-main.png') }}" alt="logo" draggable="false" loading="lazy" class="img-fluid">
					</a>
					<strong class="strong text-primary">La rénovation énergétique pour tous</strong>
				</div>
				<div class="col-lg-8">
					<div class="schedule-form">
						<div class="container-fluid">
							<h1 class="schedule-form__title schedule-form__title--lg">Service de rappel gratuit</h1>
							<h2 class="schedule-form__title mb-3">Appelez-nous au <a href="tel:+0972102972" class="link-highlight">09 72 10 29 72</a> ou remplissez le formulaire de contact.</h2>
							<form action="javascript:void(0)">
								<div class="row">
									<div class="col-lg-4 col-md-6">
										<div class="mb-3">
											<input type="text" class="form-control" placeholder="Nom et prénom *" required>
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="mb-3">
											<input type="number" class="form-control" placeholder="Téléphone *" required>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<input type="email" class="form-control" placeholder="Email *" required>
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="mb-3">
											<select class="form-control" name="travaux">
												<option value="" disabled selected>Type de travaux *</option>
												<option value="1">Chaudières à granulés</option>
												<option value="2">Pompes à chaleur air/eau</option>
												<option value="3">Système Solaire Combiné</option>
												<option value="4">Ballon Thermodynamique</option>
												<option value="5">Chauffe-eau solaire</option>
												<option value="6">Pompes à chaleur air/air</option>
												<option value="7">Rénovation globale d'une maison individuelle</option>
												<option value="8">VMC Double Flux</option>
												<option value="9">VMC SIMPLE Flux</option>
												<option value="10">Poêles à granulés</option>
											</select>
										</div>
									</div>
									<div class="col-lg-4 col-md-6">
										<div class="mb-3">
											<select class="form-control" name="department">
												<option value="" disabled selected>Département *</option>
												<option value="01 - Ain - Bourg-en-Bresse">01 - Ain - Bourg-en-Bresse</option>
												<option value="02 - Aisne - Laon">02 - Aisne - Laon</option>
												<option value="03 - Allier - Moulins">03 - Allier - Moulins</option>
												<option value="04 - Alpes-de-Haute-Provence - Digne-les-bains">04 - Alpes-de-Haute-Provence - Digne-les-bains</option>
												<option value="05 - Hautes-alpes - Gap">05 - Hautes-alpes - Gap</option>
												<option value="06 - Alpes-maritimes - Nice">06 - Alpes-maritimes - Nice</option>
												<option value="07 - Ardèche - Privas">07 - Ardèche - Privas</option>
												<option value="08 - Ardennes - Charleville-Mézières">08 - Ardennes - Charleville-Mézières</option>
												<option value="09 - Ariège - Foix">09 - Ariège - Foix</option>
												<option value="10 - Aube - Troyes">10 - Aube - Troyes</option>
											</select>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="mb-3">
											<button type="submit" class="btn w-100 btn-primary text-uppercase">
												<small>Valider</small>
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	@include('frontend.new.footer-form')
@endsection

@section('plugin_js')
    <script src="{{ asset('frontend_assets/new/plugins/slick-slider/js/slick.min.js') }}"></script>
@endsection

@push('script_js')
<script>
    $(document).ready(function () {
        /*  Testimonial slider */
        if($(".testimonial__slider").length){
            $(".testimonial__slider").slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                speed: 600,
                arrows: true,
                prevArrow: '<button class="slick__arrows slick__arrows--left border-0 d-inline-flex align-items-center justify-content-center position-absolute"><i class="fa-solid fa-chevron-left"></i></button>',
                nextArrow: '<button class="slick__arrows slick__arrows--right border-0 d-inline-flex align-items-center justify-content-center position-absolute"><i class="fa-solid fa-chevron-right"></i></button>',
                dots: false,
                pauseOnHover: false,
                pauseOnFocus: false,
                infinite: false,
                responsive: [
                    {
                        breakpoint: 1401,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                        }
                    },
                    {
                        breakpoint: 999,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    },
                ],
            });
        };

        /*  Blog slider */
        if($(".review__slider").length){
            $(".review__slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 400,
                fade: true,
                cssEase: 'linear',
                arrows: false,
                dots: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                infinite: false,
            });
        };

        /* Load iframe after click function start */
        $('[data-toggle="thumbnail"]').each(function(){
            $(this).append(`
            <button type="button" class="d-block bg-transparent border-0 rounded p-0" data-toggle="iframe">
                <img src="https://i.ytimg.com/vi/${$(this).attr("data-embed-id")}/hqdefault.jpg" alt="youtube thumbnail" loading="lazy" class="d-block w-100 h-100 rounded" />
                <svg class="play-icon position-absolute top-50 start-50 translate-middle d-block" width="1em" height="1em" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.5212 2.58C21.2688 1.60333 20.7156 0.776667 19.7676 0.516667C18.0497 0.0433333 11 0 11 0C11 0 3.95029 0.0433333 2.23235 0.516667C1.28441 0.776667 0.734412 1.60333 0.478824 2.58C0.0194118 4.35 0 8 0 8C0 8 0.0194118 11.65 0.478824 13.42C0.731176 14.3967 1.28441 15.2233 2.23235 15.4833C3.95029 15.9567 11 16 11 16C11 16 18.0497 15.9567 19.7676 15.4833C20.7156 15.2233 21.2688 14.3967 21.5212 13.42C21.9806 11.65 22 8 22 8C22 8 21.9806 4.35 21.5212 2.58Z" fill="#FF0000"/>
                    <path d="M14.5579 8.00033L8.73438 4.66699V11.3337" fill="white"/>
                </svg>
            </button>
            `);
        });

        /* Load iframe after click function end */
        $(document).on("click", '[data-toggle="iframe"]', function(){
            $(this).closest('[data-toggle="thumbnail"]').html(`<iframe class="embed-responsive-item rounded" src="https://www.youtube.com/embed/${$(this).closest('[data-toggle="thumbnail"]').attr("data-embed-id")}?autoplay=1&enablejsapi=1&controls=1&autopause=0&muted=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen frameborder="0" loading="lazy"></iframe>`)
        });
    });
</script>
@endpush
