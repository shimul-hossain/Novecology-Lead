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

{{-- menu active  --}}
@section('nosConseils','active')

@section('plugin_css')

@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')

	<!-- Blog Section -->
	<section class="blog section-gap">
		<div class="container">
			<div class="section-header">
				<h1 class="section-header__title">{{ $news_info->main_page_title }}</h1>
				<p class="section-header__text">{{ $news_info->main_page_subtitle }}</p>
			</div>
			<div class="row justify-content-center">
				<div class="col-xxl-10">
					<div class="row">
						@php
							$colors = ['1' => '#e5f5ff', '2' => '#feecec', '3'=> '#fceedb', '0'=> '#f3faec'];
						@endphp
						@foreach ($news as $news_item)
							@php
								$index = $loop->iteration % 4;
							@endphp
							<div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						{{-- <div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						<div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						<div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						<div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						<div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						<div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						<div class="col-xl-3 col-lg-4 col-md-6 px-2">
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
						<div class="col-xl-3 col-lg-4 col-md-6 px-2">
							<article class="blog__card" style="background-color: #f3faec;">
								<div class="blog__card__body text-center">
									<p class="blog__card__text">Comment réduire l'humidité dans une maison ?</p>
									<a href="{{ route('nos.conseils.details') }}" class="btn-text stretched-link">En savoir plus</a>
								</div>
								<figure class="blog__card__figure mb-0">
									<img src="{{ asset('frontend_assets/new/images/blogs/blog-image-4.svg') }}" alt="blog" draggable="false" loading="lazy" class="blog__card__figure__image">
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
