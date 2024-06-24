@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Nos offres")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', 'Nos offres')

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', 'Nos offres')

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

{{-- menu active  --}}
@section('nosOffres','active')

@section('plugin_css')

@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')

	<!-- Service Section -->
	<section class="service section-gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 section-header">
					<h1 class="section-header__title">Vous voulez faire des économies d'énergie ?</h1>
					<p class="section-header__text">Nos offres pour PARTICULIER pour répondre à votre besoins</p>
				</div>
				<div class="col-12 d-flex justify-content-center">
					<div class="tablist--service nav nav-pills" role="tablist">
						@foreach ($categories as $category)
							<button type="button" class="nav-link {{ $loop->first ? 'active':'' }}" data-bs-toggle="pill" data-bs-target="#service-category-{{ $category->id }}"  role="tab" aria-selected="{{ $loop->first ? 'true':'false' }}">
								<span class="nav-link__icon">
									<img src="{{ asset('frontend_assets/new/images/services/service-icon-1.svg') }}" alt="service-icon" width="36" height="36" draggable="false" loading="lazy" class="nav-link__icon__image">
								</span>
								<span class="nav-link__text">{{ $category->title }}</span>
							</button>
						@endforeach
						{{-- <button type="button" class="nav-link active" data-bs-toggle="pill" data-bs-target="#service-category-1"  role="tab" aria-selected="true">
							<span class="nav-link__icon">
								<img src="{{ asset('frontend_assets/new/images/services/service-icon-1.svg') }}" alt="service-icon" width="36" height="36" draggable="false" loading="lazy" class="nav-link__icon__image">
							</span>
							<span class="nav-link__text">Changer mon chauffage</span>
						</button>
						<button type="button" class="nav-link" data-bs-toggle="pill" data-bs-target="#service-category-2" role="tab" aria-selected="false">
							<span class="nav-link__icon">
								<img src="{{ asset('frontend_assets/new/images/services/service-icon-2.svg') }}" alt="service-icon" width="36" height="36" draggable="false" loading="lazy" class="nav-link__icon__image">
							</span>
							<span class="nav-link__text">Isoler ma maison</span>
						</button>
						<button type="button" class="nav-link" data-bs-toggle="pill" data-bs-target="#service-category-3" role="tab" aria-selected="false">
							<span class="nav-link__icon">
								<img src="{{ asset('frontend_assets/new/images/services/service-icon-3.svg') }}" alt="service-icon" width="36" height="36" draggable="false" loading="lazy" class="nav-link__icon__image">
							</span>
							<span class="nav-link__text">Passer au solaire</span>
						</button>
						<button type="button" class="nav-link" data-bs-toggle="pill" data-bs-target="#service-category-4" role="tab" aria-selected="false">
							<span class="nav-link__icon">
								<img src="{{ asset('frontend_assets/new/images/services/service-icon-4.svg') }}" alt="service-icon" width="36" height="36" draggable="false" loading="lazy" class="nav-link__icon__image">
							</span>
							<span class="nav-link__text">Rénovation Globale</span>
						</button> --}}
					</div>
				</div>
				<div class="col-xxl-10">
					<div class="tab-content pt-3">
						@foreach ($categories as $category)
							{{-- <button type="button" class="nav-link {{ $loop->first ? 'active':'' }}" data-bs-toggle="pill" data-bs-target="#service-category-{{ $category->id }}"  role="tab" aria-selected="{{ $loop->first ? 'true':'false' }}">
								<span class="nav-link__icon">
									<img src="{{ asset('frontend_assets/new/images/services/service-icon-1.svg') }}" alt="service-icon" width="36" height="36" draggable="false" loading="lazy" class="nav-link__icon__image">
								</span>
								<span class="nav-link__text">{{ $category->title }}</span>
							</button> --}}
							<div class="tab-pane fade {{ $loop->first ? 'show active':'' }}" id="service-category-{{ $category->id }}" role="tabpanel">
								<div class="row justify-content-center justify-content-lg-start match-height">
									@foreach ($category->getOffers as $offer)
										<div class="col-lg-6 col-sm-9">
											<div class="service-card">
												<div class="service-card__header">
													<img src="{{asset('uploads/new/offer')}}/{{ $offer->feature_image }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
													<span class="service-card__header__icon">
														<img src="{{asset('uploads/new/offer')}}/{{ $offer->icon }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
													</span>
												</div>
												<div class="service-card__body text-center text-lg-start">
													<div class="service-card__body__top">
														<h4 class="service-card__body__top__title mb-0">{{ $offer->subtitle }}</h4>
													</div>
													<div class="service-card__body__bottom">
														<h3 class="service-card__body__bottom__title">{{ $offer->title }}</h3> 
														<p class="service-card__body__list__item">{{ $offer->short_description }}</p>
														<a href="{{ route('nos.offres.details', $offer->id) }}" class="btn-gradient text-uppercase rounded-pill">{{ $offer->home_page_button_text }}</a>
													</div>
												</div>
											</div>
										</div> 
									@endforeach
								</div>
							</div>
						@endforeach
						{{-- <div class="tab-pane fade show active" id="service-category-1" role="tabpanel">
							<div class="row justify-content-center justify-content-lg-start match-height">
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-1.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-1.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 1 000€ d'économies par an</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Chaudière à granulés</h3>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Chaleur douce et homogène</li>
													<li class="service-card__body__list__item">Energie renouvelable</li>
												</ul>
												<a href="{{ route('nos.offres.details', 1) }}" class="btn-gradient text-uppercase rounded-pill">J’installe une PAC</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-2.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-2.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 1 000€ d'économies par an</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Pompe à chaleur Air/Eau</h3>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Chaleur douce et homogène</li>
													<li class="service-card__body__list__item">Energie renouvelable</li>
												</ul>
												<a href="{{ route('nos.offres.details', 2) }}" class="btn-gradient text-uppercase rounded-pill">J’installe une PAC</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-3.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-2.svg') }}"  alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 1 000€ d'économies par an</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Pompe à chaleur Air/Air</h3>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Chaleur douce et homogène</li>
													<li class="service-card__body__list__item">Energie renouvelable</li>
												</ul>
												<a href="{{ route('nos.offres.details', 3) }}" class="btn-gradient text-uppercase rounded-pill">J’installe une PAC</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-4.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-3.svg') }}"  alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Des factures divisées par trois</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Chauffe-eau thermodynamique</h3>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Réactivité sur l’eau chaude</li>
													<li class="service-card__body__list__item">Energie renouvelable</li>
												</ul>
												<a href="{{ route('nos.offres.details', 4) }}" class="btn-gradient text-uppercase rounded-pill">J’installe un chauffe-eau</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-5.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-1.svg') }}"  alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu’à 3 800€ d’aides</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Chauffage d’appoint</h3>
												<p class="service-card__body__list__item">Gagnez en confort en installant un poêle à bûches, à granulés ou un insert cheminée.</p>
												<a href="{{ route('nos.offres.details', 5) }}" class="btn-gradient text-uppercase rounded-pill">Je choisis mon chauffage</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="service-category-2" role="tabpanel">
							<div class="row justify-content-center justify-content-lg-start match-height">
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-2/service-image-1.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-4.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 25% d'économies d'énergie</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Isolation des murs</h3>
												<p class="service-card__body__list__item">Votre maison est plus belle et gagne en valeur.</p>
												<a href="{{ route('nos.offres.details', 6) }}" class="btn-gradient text-uppercase rounded-pill">J’isole mes murs</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="service-category-3" role="tabpanel">
							<div class="row justify-content-center justify-content-lg-start match-height">
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-3/service-image-1.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-5.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 1 400€ d'économies par an</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Panneaux solaires</h3>
												<p class="service-card__body__list__item">En installant des panneaux photovoltaïques sur votre toiture, vous :</p>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Economisez 40% sur votre facture et valorisez votre maison</li>
													<li class="service-card__body__list__item">Produisez votre propre énergie avec une ressource durable</li>
												</ul>
												<p class="service-card__body__list__item mb-0">Pensez au solaire hybride !</p>
												<p class="service-card__body__list__item">Une offre 2 en 1 pour produire votre électricité et votre eau chaude et économiser jusqu'à 80% sur votre facture.</p>
												<a href="{{ route('nos.offres.details', 7) }}" class="btn-gradient text-uppercase rounded-pill">Je passe au solaire</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-3/service-image-2.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-2.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 1 400€ d'économies par an</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Système Solaire Combiné</h3>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Chaleur douce et homogène</li>
													<li class="service-card__body__list__item">Energie renouvelable</li>
												</ul>
												<a href="{{ route('nos.offres.details', 8) }}" class="btn-gradient text-uppercase rounded-pill">J’installe une PAC</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-3/service-image-3.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-2.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 1 400€ d'économies par an</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Chauffe Eau Solaire</h3>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Chaleur douce et homogène</li>
													<li class="service-card__body__list__item">Energie renouvelable</li>
												</ul>
												<a href="{{ route('nos.offres.details', 9) }}" class="btn-gradient text-uppercase rounded-pill">J’installe une PAC</a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-3/service-image-4.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-2.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 1 400€ d'économies par an</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Panneaux solaires « NOMADE »</h3>
												<ul class="service-card__body__list">
													<li class="service-card__body__list__item">Chaleur douce et homogène</li>
													<li class="service-card__body__list__item">Energie renouvelable</li>
												</ul>
												<a href="{{ route('nos.offres.details', 10) }}" class="btn-gradient text-uppercase rounded-pill">J’installe une PAC</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="service-category-4" role="tabpanel">
							<div class="row justify-content-center justify-content-lg-start match-height">
								<div class="col-lg-6 col-sm-9">
									<div class="service-card">
										<div class="service-card__header">
											<img src="{{ asset('frontend_assets/new/images/services/service-4/service-image-1.jpg') }}" alt="service" draggable="false" loading="lazy" class="service-card__header__image">
											<span class="service-card__header__icon">
												<img src="{{ asset('frontend_assets/new/images/services/service-image-icon-4.svg') }}" alt="service icon" height="28" draggable="false" loading="lazy" class="service-card__header__icon__image">
											</span>
										</div>
										<div class="service-card__body text-center text-lg-start">
											<div class="service-card__body__top">
												<h4 class="service-card__body__top__title mb-0">Jusqu'à 25% d'économies d'énergie</h4>
											</div>
											<div class="service-card__body__bottom">
												<h3 class="service-card__body__bottom__title">Rénovation Globale</h3>
												<p class="service-card__body__list__item">Votre maison est plus belle et gagne en valeur.</p>
												<a href="{{ route('nos.offres.details', 11) }}" class="btn-gradient text-uppercase rounded-pill">J’isole mes murs</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> --}}
					</div>
				</div>
			</div>
		</div>
	</section>

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

@endsection

@push('script_js')

@endpush
