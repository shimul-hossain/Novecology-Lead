@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Home")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', 'Novecology')

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', 'Novecology')

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('frontend_assets/new/plugins/slick-slider/css/slick.min.css') }}">
@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')

	<!-- Banner Section -->
	<section class="banner">
		<div class="banner__top">
			<div class="banner__slider">
				@foreach ($banners as $banner)
					<div class="banner__slide">
						<div class="banner__slide__card">
							<img src="{{asset('uploads/new/banner')}}/{{ $banner->image }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image">
							<div class="banner__slide__card__content">
								<h1 class="banner__slide__card__content__title text-white">{{ $banner->title }}</h1>
								<a href="{{ $banner->button_link ?? '#!' }}" class="btn btn-primary text-uppercase rounded-pill">
									<small>{{ $banner->button_text }}</small>
								</a>
							</div>
						</div>
					</div>
				@endforeach
				{{-- <div class="banner__slide">
					<div class="banner__slide__card">
						<img src="{{ asset('frontend_assets/new/images/banners/banner-1.jpg') }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image">
						<div class="banner__slide__card__content">
							<h1 class="banner__slide__card__content__title text-white">Chaudière à granulés</h1>
							<a href="#!" class="btn btn-primary text-uppercase rounded-pill">
								<small>En savoir plus</small>
							</a>
						</div>
					</div>
				</div>
				<div class="banner__slide">
					<div class="banner__slide__card">
						<img src="{{ asset('frontend_assets/new/images/banners/banner-2.jpg') }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image">
						<div class="banner__slide__card__content">
							<h1 class="banner__slide__card__content__title text-white">Pompes à chaleur Air/Eau</h1>
							<a href="#!" class="btn btn-primary text-uppercase rounded-pill">
								<small>En savoir plus</small>
							</a>
						</div>
					</div>
				</div>
				<div class="banner__slide">
					<div class="banner__slide__card">
						<img src="{{ asset('frontend_assets/new/images/banners/banner-3.jpg') }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image">
						<div class="banner__slide__card__content">
							<h1 class="banner__slide__card__content__title text-white">Système Solaire Combiné</h1>
							<a href="#!" class="btn btn-primary text-uppercase rounded-pill">
								<small>En savoir plus</small>
							</a>
						</div>
					</div>
				</div>
				<div class="banner__slide">
					<div class="banner__slide__card">
						<img src="{{ asset('frontend_assets/new/images/banners/banner-4.jpg') }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image">
						<div class="banner__slide__card__content">
							<h1 class="banner__slide__card__content__title text-white">Pompes à chaleur Air/Air</h1>
							<a href="#!" class="btn btn-primary text-uppercase rounded-pill">
								<small>En savoir plus</small>
							</a>
						</div>
					</div>
				</div>
				<div class="banner__slide">
					<div class="banner__slide__card">
						<img src="{{ asset('frontend_assets/new/images/banners/banner-5.jpg') }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image">
						<div class="banner__slide__card__content">
							<h1 class="banner__slide__card__content__title text-white">Panneau Photovoltaïque</h1>
							<a href="#!" class="btn btn-primary text-uppercase rounded-pill">
								<small>En savoir plus</small>
							</a>
						</div>
					</div>
				</div>
				<div class="banner__slide">
					<div class="banner__slide__card">
						<img src="{{ asset('frontend_assets/new/images/banners/banner-6.jpg') }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image w-100">
						<div class="banner__slide__card__content">
							<h1 class="banner__slide__card__content__title text-white">Isolation thermique par l'extérieur</h1>
							<a href="#!" class="btn btn-primary text-uppercase rounded-pill">
								<small>En savoir plus</small>
							</a>
						</div>
					</div>
				</div>
				<div class="banner__slide">
					<div class="banner__slide__card">
						<img src="{{ asset('frontend_assets/new/images/banners/banner-7.jpg') }}" alt="banner" loading="lazy" draggable="false" class="banner__slide__card__image">
						<div class="banner__slide__card__content">
							<h1 class="banner__slide__card__content__title text-white">Rénovation globale</h1>
							<a href="#!" class="btn btn-primary text-uppercase rounded-pill">
								<small>En savoir plus</small>
							</a>
						</div>
					</div>
				</div> --}}
			</div>
		</div>
		<div class="banner__bottom w-100">
			<img src="{{ asset('frontend_assets/new/images/icon/bear-image.png') }}" alt="bear" class="banner__bottom__image" loading="lazy">
			<div class="schedule-form">
				<div class="container-fluid">
					<h2 class="schedule-form__title mb-3 d-flex justify-content-between"><span>Parlez de votre projet de rénovation énergétique avec un de nos experts</span></h2>
					<form action="#!" class="bannerForm">
						<div class="row">
							<div class="col-xl col-lg-4 col-md-6">
								<div class="mb-3">
									<input type="text" class="form-control" name="name" placeholder="Nom et prénom *" required>
								</div>
							</div>
							<div class="col-xl col-lg-4 col-md-6">
								<div class="mb-3">
									<input type="email" class="form-control" name="email" placeholder="Email *" required>
								</div>
							</div>
							<div class="col-xl col-lg-4">
								<div class="mb-3">
									<input type="number" class="form-control" name="phone" placeholder="Phone *" required>
								</div>
							</div>
							{{-- <div class="col-xl col-lg-4">
								<div class="mb-3">
									<input type="date" class="form-control" name="date" placeholder="Date *" required>
								</div>
							</div> --}}
							<div class="col-xl col-lg-4 col-md-6">
								<div class="mb-3">
									<select class="form-control" name="department" required>
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
							<div class="col-xl col-lg-4 col-md-6">
								<div class="mb-3">
									<select class="form-control" name="travaux" required>
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
							<div class="col-xl-auto col-lg-4">
								<div class="mb-3">
									<button type="submit" class="btn w-100 btn-primary text-uppercase bannerFormSubmitBtn">
										<small>Valider</small>
									</button>
								</div>
							</div>
							<div class="col-12 d-none bannerFormSuccess">

							</div>
						</div>
					</form>
					<a href="{{ route('droit.opposition') }}" class="text-white"><small class="fst-italic">Droit d’opposition</small></a>
				</div>
			</div>
		</div>
	</section>

	<!-- Feature Section -->
	<section class="feature">
		<div class="container container-lg-fluid">
			<div class="row">
				@foreach ($features as $feature)
					<div class="col-lg-3 col-md-6">
						<div class="feature__card">
							<div class="feature__card__icon rounded-circle">
								{!! $feature->icon_link !!}
							</div>
							<p class="feature__card__text mb-0">{{ $feature->description }}</p>
						</div>
					</div>
				@endforeach
				{{-- <div class="col-lg-3 col-md-6">
					<div class="feature__card">
						<div class="feature__card__icon rounded-circle">
							<i class="fa-solid fa-angle-up"></i>
						</div>
						<p class="feature__card__text mb-0">8 ans d'expertise et d'expérience au service des particuliers</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="feature__card">
						<div class="feature__card__icon rounded-circle">
							<i class="fa-solid fa-map-location-dot"></i>
						</div>
						<p class="feature__card__text mb-0">Notre entreprise RGE intervient dans toute la France</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="feature__card">
						<div class="feature__card__icon rounded-circle">
							<i class="fa-solid fa-clock-rotate-left"></i>
						</div>
						<p class="feature__card__text mb-0">Une présence sur toute la France au travers de nos sites logistiques pour assurer une relation de proximité</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="feature__card">
						<div class="feature__card__icon rounded-circle">
							<i class="fa-solid fa-thumbs-up"></i>
						</div>
						<p class="feature__card__text mb-0">91% de nos clients nous parviennent sur recommandation</p>
					</div>
				</div> --}}
			</div>
		</div>
	</section>

    <!-- Intro Video Section -->
    <section class="intro-video section-gap">
        <div class="container">
            <div class="intro-video__container position-relative">
                <div class="row">
                    <div class="col-xl-9 mx-auto">
                        <div class="intro-video__main position-relative">
                            <div class="review__card ratio ratio-16x9 rounded" data-toggle="thumbnail" data-embed-id="5UaxuQpd0lY"></div>
                            <a href="#!" class="intro-video__main__image" data-text="Vu Sur">
                                <img src="{{ asset('frontend_assets/new/images/logo/tv-name.png') }}" alt="logo"  loading="lazy">
                            </a>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('frontend_assets/new/images/icon/bear-image.png') }}" alt="bear" class="intro-video__container__image" loading="lazy">
            </div>
        </div>
    </section>

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
						@foreach ($offer_categories as $offer_category)
							<button type="button" class="nav-link {{ $loop->first? 'active':'' }}" data-bs-toggle="pill" data-bs-target="#service-category-{{ $offer_category->id }}"  role="tab" aria-selected="{{ $loop->first? 'true':'false' }}">
								<span class="nav-link__icon">
									<img src="{{asset('uploads/new/offer')}}/{{ $offer_category->logo }}" alt="service-icon" width="36" height="36" draggable="false" loading="lazy" class="nav-link__icon__image">
								</span>
								<span class="nav-link__text">{{ $offer_category->title }}</span>
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
						@foreach ($offer_categories as $offer_category)
							<div class="tab-pane fade {{ $loop->first? 'show active':'' }}" id="service-category-{{ $offer_category->id }}" role="tabpanel">
								<div class="row justify-content-center justify-content-lg-start match-height">
									@foreach ($offer_category->getOffers as $offer)
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

	<!-- Support Section -->
	<section class="support section-gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-6 section-header">
					<h1 class="section-header__title">{{ $support_info->title }}</h1>
					<p class="section-header__text">{{ $support_info->subtitle }}</p>
				</div>
			</div>
			<div class="row align-items-center justify-content-center">
				<div class="col-xxl-5 col-lg-6">
					<figure class="support__figure position-relative">
						<img src="{{asset('uploads/new/support')}}/{{ $support_info->image }}" alt="support" draggable="false" loading="lazy" class="support__figure__image" >
					</figure>
				</div>
				<div class="col-xxl-5 col-lg-6">
					<div class="ps-xl-5">
						<div class="row">
							@foreach ($supports as $support)
								<div class="col-md-6 mb-3">
									<div class="support__card">
										<img src="{{asset('uploads/new/support')}}/{{ $support->icon }}" alt="support icon" height="52" draggable="false" loading="lazy" class="support__card__icon">
										<h3 class="support__card__title">{{ $support->title }}</h3>
										<p class="support__card__text">{{ $support->description }}</p>
									</div>
								</div>
							@endforeach
							{{-- <div class="col-md-6 mb-3">
								<div class="support__card">
									<img src="{{ asset('frontend_assets/new/images/supports/support-icon-1.png') }}" alt="support icon" height="52" draggable="false" loading="lazy" class="support__card__icon">
									<h3 class="support__card__title">Des conseillers à votre écoute</h3>
									<p class="support__card__text">Disponibles du lundi au vendredi de 8h à 19h.</p>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="support__card">
									<img src="{{ asset('frontend_assets/new/images/supports/support-icon-2.png') }}" alt="support icon" height="52" draggable="false" loading="lazy" class="support__card__icon">
									<h3 class="support__card__title">Experts en rénovation</h3>
									<p class="support__card__text">Formés en continu aux nouveautés du secteur.</p>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="support__card">
									<img src="{{ asset('frontend_assets/new/images/supports/support-icon-3.png') }}" alt="support icon" height="52" draggable="false" loading="lazy" class="support__card__icon">
									<h3 class="support__card__title">Un suivi personnalisé</h3>
									<p class="support__card__text">Nos recommandations sont adaptées à votre logement.</p>
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<div class="support__card">
									<img src="{{ asset('frontend_assets/new/images/supports/support-icon-4.png') }}" alt="support icon" height="52" draggable="false" loading="lazy" class="support__card__icon">
									<h3 class="support__card__title">Une assistance pour obtenir vos aides</h3>
									<p class="support__card__text">Vous êtes guidé pour obtenir la Prime Effy et MaPrimeRenov'.</p>
								</div>
							</div> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Step Section -->
	<section class="step section-gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-6 section-header">
					<h1 class="section-header__title">{{ $renovation_info->title }}</h1>
					<p class="section-header__text">{{ $renovation_info->subtitle }}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xxl-8 col-xl-6 col-lg-10 mx-auto">
					<div class="step__video-slider">
						@foreach ($renovations as $renovation)
							<div class="step__video-slide">
								<div class="step__video__card">
									<div class="step__video__card__header">
										<img src="{{asset('uploads/new/renovation')}}/{{ $renovation->image }}" alt="step preview" draggable="false" loading="lazy" class="step__video__card__image">
									</div>
									<div class="step__video__card__body">
										<div class="step__video__card__count">{{ $loop->iteration }}</div>
										<h3 class="step__video__card__title">{{ $renovation->title }}</h3>
										<p class="step__video__card__text">{{ $renovation->description }}</p>
									</div>
								</div>
							</div>
						@endforeach
						{{-- <div class="step__video-slide">
							<div class="step__video__card">
								<div class="step__video__card__header">
									<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-1.jpg') }}" alt="step preview" draggable="false" loading="lazy" class="step__video__card__image">
								</div>
								<div class="step__video__card__body">
									<div class="step__video__card__count">1</div>
									<h3 class="step__video__card__title">Étude énergétique</h3>
									<p class="step__video__card__text">Réalisez une étude complète de votre habitat avec un de nos experts énergétiques puis recevez instantanément votre étude et le devis détaillé de votre projet aides déduites.</p>
								</div>
							</div>
						</div>
						<div class="step__video-slide">
							<div class="step__video__card">
								<div class="step__video__card__header">
									<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-2.jpg') }}" alt="step preview" draggable="false" loading="lazy" class="step__video__card__image">
								</div>
								<div class="step__video__card__body">
									<div class="step__video__card__count">2</div>
									<h3 class="step__video__card__title">Visite technique</h3>
									<p class="step__video__card__text">Un de nos auditeurs énergétiques se déplace à votre domicile afin de confirmer la faisabilité technique de votre projet de rénovation énergétique.</p>
								</div>
							</div>
						</div>
						<div class="step__video-slide">
							<div class="step__video__card">
								<div class="step__video__card__header">
									<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-3.jpg') }}" alt="step preview" draggable="false" loading="lazy" class="step__video__card__image">
								</div>
								<div class="step__video__card__body">
									<div class="step__video__card__count">3</div>
									<h3 class="step__video__card__title">Démarches administratives</h3>
									<p class="step__video__card__text">Un chargé de projet dédié réalise pour vous toutes les démarches nécessaires à l’obtention de vos aides ainsi que les formalités administratives pour vos travaux.</p>
								</div>
							</div>
						</div>
						<div class="step__video-slide">
							<div class="step__video__card">
								<div class="step__video__card__header">
									<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-4.jpg') }}" alt="step preview" draggable="false" loading="lazy" class="step__video__card__image">
								</div>
								<div class="step__video__card__body">
									<div class="step__video__card__count">4</div>
									<h3 class="step__video__card__title">Installation</h3>
									<p class="step__video__card__text">Un de nos professionnels certifiés RGE se déplace chez vous pour réaliser vos travaux de rénovation énergétique. Vos travaux sont couverts par notre garantie décennale.</p>
								</div>
							</div>
						</div>
						<div class="step__video-slide">
							<div class="step__video__card">
								<div class="step__video__card__header">
									<img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-5.jpg') }}" alt="step preview" draggable="false" loading="lazy" class="step__video__card__image">
								</div>
								<div class="step__video__card__body">
									<div class="step__video__card__count">5</div>
									<h3 class="step__video__card__title">Suivi client</h3>
									<p class="step__video__card__text">Bénéficiez d’un service client à votre écoute pour toutes vos questions durant toute la durée de vie de votre installation.</p>
								</div>
							</div>
						</div> --}}
					</div>
				</div>
				<div class="col-xxl-4 col-xl-6">
					<div class="step__content-slider">
						@foreach ($renovations as $renovation)
							<div class="step__content-slide" data-slide-index="{{ $loop->index }}">
								<div class="step__content__card">
									<div class="step__content__card__count">{{ $loop->iteration }}</div>
									<div class="step__content__card__content">
										<h3 class="step__content__card__content__title">{{ $renovation->title }}</h3>
										<div class="step__content__card__content__body">
											<div class="step__content__card__content__body__collapse">
												<p class="step__content__card__content__body__text">{{ $renovation->description }}</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endforeach
						{{-- <div class="step__content-slide" data-slide-index="0">
							<div class="step__content__card">
								<div class="step__content__card__count">1</div>
								<div class="step__content__card__content">
									<h3 class="step__content__card__content__title">Étude énergétique</h3>
									<div class="step__content__card__content__body">
										<div class="step__content__card__content__body__collapse">
											<p class="step__content__card__content__body__text">Réalisez une étude complète de votre habitat avec un de nos experts énergétiques puis recevez instantanément votre étude et le devis détaillé de votre projet aides déduites.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="step__content-slide" data-slide-index="1">
							<div class="step__content__card">
								<div class="step__content__card__count">2</div>
								<div class="step__content__card__content">
									<h3 class="step__content__card__content__title">Visite technique</h3>
									<div class="step__content__card__content__body">
										<div class="step__content__card__content__body__collapse">
											<p class="step__content__card__content__body__text">Un de nos auditeurs énergétiques se déplace à votre domicile afin de confirmer la faisabilité technique de votre projet de rénovation énergétique.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="step__content-slide" data-slide-index="2">
							<div class="step__content__card">
								<div class="step__content__card__count">3</div>
								<div class="step__content__card__content">
									<h3 class="step__content__card__content__title">Démarches administratives</h3>
									<div class="step__content__card__content__body">
										<div class="step__content__card__content__body__collapse">
											<p class="step__content__card__content__body__text">Un chargé de projet dédié réalise pour vous toutes les démarches nécessaires à l’obtention de vos aides ainsi que les formalités administratives pour vos travaux.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="step__content-slide" data-slide-index="3">
							<div class="step__content__card">
								<div class="step__content__card__count">4</div>
								<div class="step__content__card__content">
									<h3 class="step__content__card__content__title">Installation</h3>
									<div class="step__content__card__content__body">
										<div class="step__content__card__content__body__collapse">
											<p class="step__content__card__content__body__text">Un de nos professionnels certifiés RGE se déplace chez vous pour réaliser vos travaux de rénovation énergétique. Vos travaux sont couverts par notre garantie décennale.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="step__content-slide" data-slide-index="4">
							<div class="step__content__card">
								<div class="step__content__card__count">5</div>
								<div class="step__content__card__content">
									<h3 class="step__content__card__content__title">Suivi client</h3>
									<div class="step__content__card__content__body">
										<div class="step__content__card__content__body__collapse">
											<p class="step__content__card__content__body__text">Bénéficiez d’un service client à votre écoute pour toutes vos questions durant toute la durée de vie de votre installation.</p>
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
						{{-- <div class="review__slide">
							<div class="review__card ratio ratio-4x3 rounded" data-toggle="thumbnail" data-embed-id="pNfgyV3jRiY"></div>
						</div>
						<div class="review__slide">
							<div class="review__card ratio ratio-4x3 rounded" data-toggle="thumbnail" data-embed-id="cm7BjtGDzWg"></div>
						</div>
						<div class="review__slide">
							<div class="review__card ratio ratio-4x3 rounded" data-toggle="thumbnail" data-embed-id="xRNTW3eem48"></div>
						</div> --}}
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

	<!-- Blog Section -->
	<section class="blog section-gap">
		<div class="container">
			<div class="section-header">
				<h1 class="section-header__title">{{ $news_info->home_page_title }}</h1>
				<p class="section-header__text">{{ $news_info->home_page_subtitle }}</p>
			</div>
			<div class="row justify-content-center">
				<div class="col-xxl-10">
					<div class="blog__slider row px-2">
						@php
							$colors = ['1' => '#e5f5ff', '2' => '#feecec', '3'=> '#fceedb', '0'=> '#f3faec'];
						@endphp
						@foreach ($news as $news_item)
							@php
								$index = $loop->iteration % 4;
							@endphp
							<div class="blog__slide col-xl-3 col-lg-4 col-md-6 px-2">
								<article class="blog__card" style="background-color: {{ $colors[$index] }};">
									<div class="blog__card__body text-center">
										<p class="blog__card__text">{{ $news_item->title }}</p>
										<a href="{{ route('nos.conseils.details', $news_item->id) }}" class="btn-text stretched-link">En savoir plus</a>
									</div>
									<figure class="blog__card__figure mb-0">
										<img src="{{ asset('uploads/new/news') }}/{{ $news_item->feature_image }}" alt="blog" draggable="false" loading="lazy" class="blog__card__figure__image">
									</figure>
								</article>
							</div>
						@endforeach
						{{-- <div class="blog__slide col-xl-3 col-lg-4 col-md-6 px-2">
							<article class="blog__card" style="background-color: #e5f5ff;">
								<div class="blog__card__body text-center">
									<p class="blog__card__text">Comment réduire l'humidité dans une maison ?</p>
									<a href="{{ route('nos.conseils.details') }}" class="btn-text stretched-link">En savoir plus</a>
								</div>
								<figure class="blog__card__figure mb-0">
									<img src="{{ asset('frontend_assets/new/images/blogs/blog-image-1.svg') }}" alt="blog" draggable="false" loading="lazy" class="blog__card__figure__image">
								</figure>
							</article>
						</div>
						<div class="blog__slide col-xl-3 col-lg-4 col-md-6 px-2">
							<article class="blog__card" style="background-color: #feecec;">
								<div class="blog__card__body text-center">
									<p class="blog__card__text">Comment réduire l'humidité dans une maison ?</p>
									<a href="{{ route('nos.conseils.details') }}" class="btn-text stretched-link">En savoir plus</a>
								</div>
								<figure class="blog__card__figure mb-0">
									<img src="{{ asset('frontend_assets/new/images/blogs/blog-image-2.svg') }}" alt="blog" draggable="false" loading="lazy" class="blog__card__figure__image">
								</figure>
							</article>
						</div>
						<div class="blog__slide col-xl-3 col-lg-4 col-md-6 px-2">
							<article class="blog__card" style="background-color: #fceedb;">
								<div class="blog__card__body text-center">
									<p class="blog__card__text">Comment réduire l'humidité dans une maison ?</p>
									<a href="{{ route('nos.conseils.details') }}" class="btn-text stretched-link">En savoir plus</a>
								</div>
								<figure class="blog__card__figure mb-0">
									<img src="{{ asset('frontend_assets/new/images/blogs/blog-image-3.svg') }}" alt="blog" draggable="false" loading="lazy" class="blog__card__figure__image">
								</figure>
							</article>
						</div>
						<div class="blog__slide col-xl-3 col-lg-4 col-md-6 px-2">
							<article class="blog__card" style="background-color: #f3faec;">
								<div class="blog__card__body text-center">
									<p class="blog__card__text">Comment réduire l'humidité dans une maison ?</p>
									<a href="{{ route('nos.conseils.details') }}" class="btn-text stretched-link">En savoir plus</a>
								</div>
								<figure class="blog__card__figure mb-0">
									<img src="{{ asset('frontend_assets/new/images/blogs/blog-image-4.svg') }}" alt="blog" draggable="false" loading="lazy" class="blog__card__figure__image">
								</figure>
							</article>
						</div>
						<div class="blog__slide col-xl-3 col-lg-4 col-md-6 px-2">
							<article class="blog__card" style="background-color: #e5f5ff;">
								<div class="blog__card__body text-center">
									<p class="blog__card__text">Comment réduire l'humidité dans une maison ?</p>
									<a href="{{ route('nos.conseils.details') }}" class="btn-text stretched-link">En savoir plus</a>
								</div>
								<figure class="blog__card__figure mb-0">
									<img src="{{ asset('frontend_assets/new/images/blogs/blog-image-1.svg') }}" alt="blog" draggable="false" loading="lazy" class="blog__card__figure__image">
								</figure>
							</article>
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
	@include('frontend.new.footer-form')
@endsection

@section('plugin_js')
	<script src="{{ asset('frontend_assets/new/plugins/slick-slider/js/slick.min.js') }}"></script>
@endsection

@push('script_js')
<script>
    $(document).ready(function () {
		// $('.bannerFormSubmitBtn').removeAttr('disabled');
        // $('.bannerForm').removeClass('d-none');
		// $('.bannerForm').on('submit', function(e){
        //     e.preventDefault();
        //     $(this).find('.bannerFormSuccess').addClass('d-none');
        //     let form_data = new FormData($(this)[0]);
        //     $.ajaxSetup({
        //         headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type : "POST",
        //         url  : "{{route('banner.form.store')}}",
        //         data : form_data,
        //         contentType: false,
		// 		processData: false,
        //         success:  response => {
        //             $('.bannerForm').trigger('reset');
        //             if(response.success){
        //                 $(this).find('.bannerFormSuccess').removeClass('d-none');
        //                 $(this).find('.bannerFormSuccess').html(
		// 					`<div class="alert alert-success alert-dismissible fade show" role="alert">
		// 							Merci de vos informations, un expert vous recontactera rapidement
		// 							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		// 						</div>`);
        //             }
        //         }
        //     });
        // });



        /*  Banner slider */
        if($(".banner__slider").length){
            $(".banner__slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                cssEase: 'linear',
                autoplay: true,
                autoplaySpeed: 8000,
                speed: 600,
                arrows: true,
                prevArrow: '<button class="slick__arrows slick__arrows--left border-0 d-inline-flex align-items-center justify-content-center position-absolute"><i class="fa-solid fa-chevron-left"></i></button>',
                nextArrow: '<button class="slick__arrows slick__arrows--right border-0 d-inline-flex align-items-center justify-content-center position-absolute"><i class="fa-solid fa-chevron-right"></i></button>',
                dots: false,
                pauseOnHover: false,
                pauseOnFocus: false,
                infinite: true,
            });
        };

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
        if($(".blog__slider").length){
            $(".blog__slider").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
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
                        }
                    },
                    {
                        breakpoint: 999,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                        }
                    },
                ],
            });
        };

        /*  Review slider */
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

        /*  Step Section sliders */
        if($('.step__video-slider').length && $('.step__content-slide').length){
            const $stepContentSlide = $('.step__content-slide');
            const $stepContentSlideArray = Array.from($stepContentSlide);
            $($stepContentSlideArray[0]).addClass('active');
            const $stepVideoSlide = $('.step__video-slider');

            $stepVideoSlide.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 300,
                autoplay: true,
                autoplaySpeed: 8000,
                arrows: false,
                dots: true,
                pauseOnHover: false,
                pauseOnFocus: false,
                infinite: false,
            });

            $stepVideoSlide.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {
                $stepContentSlide.removeClass('active');
                $($stepContentSlideArray[slick.currentSlide]).addClass('active');
            });

            $stepContentSlide.each(function(){
                var slideTimer;
                $(this).on("mouseenter click", ()=> {
                    slideTimer = setTimeout(()=> {
                        $stepVideoSlide.slick('slickGoTo', $(this).data('slide-index'));
                        $stepVideoSlide.slick('pause');
                    }, 100);

                }).on("mouseleave", function(e){
                    clearTimeout(slideTimer);
                    $stepVideoSlide.slick('play');
                })
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
