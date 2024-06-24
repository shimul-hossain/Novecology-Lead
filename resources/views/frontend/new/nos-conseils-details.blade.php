@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Nos Conseils Details")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', 'Nos Conseils Details')

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', 'Nos Conseils Details')

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

{{-- menu active  --}}
@section('nosConseils','active')

@section('plugin_css')
    <link rel="stylesheet" href="{{ asset('frontend_assets/new/plugins/slick-slider/css/slick.min.css') }}">
@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')

	<!-- Banner Section -->
	<section class="sub-banner sub-banner--empty">
		<div class="sub-banner__overlay">
			<img src="{{asset('uploads/new/news')}}/{{ $news->banner_image }}" alt="audit-energetique" loading="lazy" class="sub-banner__image">
		</div>
	</section>

	<!-- Blog Details Section -->
	<section class="section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-3 mb-lg-0">
					<main class="blog-details rounded">
						<div class="d-flex align-items-center justify-content-between">
							<a href="#!" class="text-primary text-uppercase fw-bold">{{ $news->getCategory->name ?? '' }}</a>
							<span>{{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</span>
						</div>
						<h1 class="blog-details__title">{{ $news->title }}</h1>
						<div class="py-4">
							<p class="mb-1">{{ $news->createdBy->name ?? '' }}</p>
							{{-- <p class="mb-1">{{ $news->created_by }}</p> --}}
							<p class="text-muted mb-0">Publié le {{ \Carbon\Carbon::parse($news->created_at)->format('d/m/Y') }}</p>
						</div>
						<div class="editor-content">
							{!! $news->description !!}
							{{-- <p><em>Une hausse du montant de la prime à l'autoconsommation solaire a été actée le 28 février 2023 par la Commission de Régulation de l'Energie (CRE). Cette augmentation est assortie d'une modification du versement de la prime. Autrefois versée sur 5 ans, elle fait désormais l'objet d'un paiement en une seule fois. Un moyen d'inciter les particuliers à s'équiper de panneaux solaires. TUCOENERGIE vous explique tout ça en détail.</em></p>
							<h3>Hausse du montant de la prime à l'autoconsommation : quel est le nouveau barème ?</h3>
							<br>
							<p>La <a href="#!">prime à l'autoconsommation</a> est une aide destinée aux consommateurs particuliers et professionnels qui décident d'installer des panneaux solaires photovoltaïques en toiture. Mise en place par l'Etat, cette prime permet de minimiser les frais de l'acquisition et de la pose des modules solaires. Son montant est établi selon un barème dégressif qui dépend de la puissance de l'installation en kilowatt-crête (kWc). Révisés par les pouvoirs publics, les nouveaux montants ont été publiés par la CRE à la fin du mois de février, avec <a href="#!">l'arrêté du 8 février 2023</a> Le gendarme de l'énergie précise le montant de la prime:</p>
							<ul>
								<li>du 1er février 2023 au 30 avril 2023 (1er trimestre 2023);</li>
								<li>du 1er novembre 2022 au 31 janvier 2023 (4 trimestre 2022).</li>
							</ul>
							<h4 class="mb-0">Prime à l'investissement : le barème pour le T1 2023</h4> --}}
						</div>
					</main>
				</div>
				<aside class="col-lg-4">
					<div class="follow-card mb-5">
						<p class="mb-0 fw-bold">Suivez-nous</p>
						<p class="mb-0">sur nos réseaux sociaux</p>
						<div class="nav follow-card__social-nav">
							<a class="nav-link" href="https://www.facebook.com/NOVECOLOGY" target="_blank">
								<i class="fa-brands fa-facebook-f"></i>
							</a>
							<a class="nav-link" href="https://www.instagram.com/novecology/" target="_blank">
								<i class="fa-brands fa-instagram"></i>
							</a>
							<a class="nav-link" href="https://www.youtube.com/@novecology1609" target="_blank">
								<i class="fa-brands fa-youtube"></i>
							</a>
						</div>
					</div>
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
	</section>

	<!-- News Section -->
	<section class="news section-gap">
		<div class="container">
			<div class="section-header text-start">
				<h1 class="section-header__title">Articles similaires</h1>
			</div>
			<div class="blog__slider row">
				@if ($news->getCategory)
					@forelse ($news->getCategory->news as $news_item)
						<div class="blog__slide col-lg-4">
							<a href="{{ route('nos.conseils.details', $news_item->id) }}" class="news-card d-block mx-2">
								<div class="d-flex align-items-center justify-content-between">
									<span class="fw-bold text-primary">{{ $news_item->getCategory->name }}</span>
									<small class="text-muted">{{ \Carbon\Carbon::parse($news->created_at)->diffForHumans() }}</small>
								</div>
								<figure class="news-card__figure position-relative">
									<img class="news-card__figure__image" src="{{ asset('uploads/new/news') }}/{{ $news_item->thumbnail_image }}" alt="news">
								</figure>
								<h4 class="news-card__title">{{ $news_item->title }}</h4>
								<small class="text-muted mb-0">{{ \Carbon\Carbon::parse($news->created_at)->format('d/m/Y') }}</small>
							</a>
						</div>	
					@empty
					<div class="blog__slide col-lg-4">
						<h2>Aucun article trouvé</h2>
					</div>	
					@endforelse
				@else
					<div class="blog__slide col-lg-4">
						<h2>Aucun article trouvé</h2>
					</div>	
				@endif
				{{-- <div class="blog__slide col-lg-4">
					<a href="#!" class="news-card d-block mx-2">
						<div class="d-flex align-items-center justify-content-between">
							<span class="fw-bold text-primary">ACTUALITÉS</span>
							<small class="text-muted">.3min</small>
						</div>
						<figure class="news-card__figure position-relative">
							<img class="news-card__figure__image" src="{{ asset('frontend_assets/new/images/valeurs/valeurs-image-1.jpg') }}" alt="news">
						</figure>
						<h4 class="news-card__title">Calculer la consommation d'une pompe à chaleur Air/Eau de 11 kW</h4>
						<small class="text-muted mb-0">24/07/2023</small>
					</a>
				</div>
				<div class="blog__slide col-lg-4">
					<a href="#!" class="news-card d-block mx-2">
						<div class="d-flex align-items-center justify-content-between">
							<span class="fw-bold text-primary">ACTUALITÉS</span>
							<small class="text-muted">.3min</small>
						</div>
						<figure class="news-card__figure position-relative">
							<img class="news-card__figure__image" src="{{ asset('frontend_assets/new/images/valeurs/valeurs-image-2.jpg') }}" alt="news">
						</figure>
						<h4 class="news-card__title">Calculer la consommation d'une pompe à chaleur Air/Eau de 11 kW</h4>
						<small class="text-muted mb-0">24/07/2023</small>
					</a>
				</div>
				<div class="blog__slide col-lg-4">
					<a href="#!" class="news-card d-block mx-2">
						<div class="d-flex align-items-center justify-content-between">
							<span class="fw-bold text-primary">ACTUALITÉS</span>
							<small class="text-muted">.3min</small>
						</div>
						<figure class="news-card__figure position-relative">
							<img class="news-card__figure__image" src="{{ asset('frontend_assets/new/images/valeurs/valeurs-image-3.jpg') }}" alt="news">
						</figure>
						<h4 class="news-card__title">Calculer la consommation d'une pompe à chaleur Air/Eau de 11 kW</h4>
						<small class="text-muted mb-0">24/07/2023</small>
					</a>
				</div>
				<div class="blog__slide col-lg-4">
					<a href="#!" class="news-card d-block mx-2">
						<div class="d-flex align-items-center justify-content-between">
							<span class="fw-bold text-primary">ACTUALITÉS</span>
							<small class="text-muted">.3min</small>
						</div>
						<figure class="news-card__figure position-relative">
							<img class="news-card__figure__image" src="{{ asset('frontend_assets/new/images/valeurs/valeurs-image-4.jpg') }}" alt="news">
						</figure>
						<h4 class="news-card__title">Calculer la consommation d'une pompe à chaleur Air/Eau de 11 kW</h4>
						<small class="text-muted mb-0">24/07/2023</small>
					</a>
				</div> --}}
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
	<script src="{{ asset('frontend_assets/new/plugins/slick-slider/js/slick.min.js') }}"></script>
@endsection

@push('script_js')
<script>
    $(document).ready(function (){
        /*  Blog slider */
        if($(".blog__slider").length){
            $(".blog__slider").slick({
                slidesToShow: 3,
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
    })
</script>
@endpush
