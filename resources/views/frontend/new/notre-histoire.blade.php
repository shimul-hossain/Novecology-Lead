@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Notre Histoire")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', 'Notre Histoire')

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', 'Notre Histoire')

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

{{-- menu active  --}}
@section('dropdownActiveClass','active')
@section('notreHistoire','active')

@section('plugin_css')

@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')
    <!-- History Section -->
	<section class="section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="section-header text-start">
						<h1 class="section-header__title">{{ $history->first_block_title }}</h1>
					</div>
					<p>{{ $history->first_block_description }}</p>
				</div>
				<div class="col-lg-6">
					<img src="{{ asset('uploads/new/history') }}/{{ $history->first_block_image }}" alt="history" draggable="false" loading="lazy" class="img-fluid">
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

	<!-- History Section -->
	<section class="section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<img src="{{ asset('uploads/new/history') }}/{{ $history->second_block_image }}" alt="history" draggable="false" loading="lazy" class="img-fluid">
				</div>
				<div class="col-lg-6 mt-3 mt-lg-0">
					<div class="section-header text-start">
						<h1 class="section-header__title">{{ $history->second_block_title }}</h1>
					</div>
					<p>{{ $history->second_block_description }}</p>
				</div>
			</div>
		</div>
	</section>

	<!-- History Section -->
	<section class="section-gap section-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 mx-auto pb-3">
					<div class="section-header">
						<h1 class="section-header__title">{{ $history->third_block_title }}</h1>
						<p class="section-header__text">{{ $history->third_block_description }}</p>
					</div>
				</div>
				<div class="col-lg-4">
					<img src="{{ asset('uploads/new/history') }}/{{ $history->third_block_image }}" alt="bear & map" draggable="false" loading="lazy" class="img-fluid mx-auto">
				</div>
				<div class="col-lg-8 text-center mt-4 mt-lg-0">
					<ul class="icon-list list-unstyled">
						@foreach ($history_infos as $history_info)
							<li class="icon-list__item">
								<span class="icon-list__item__icon">
									{!! $history_info->icon !!}
								</span>
								<span class="icon-list__item__text">{{ $history_info->description }}</span>
							</li>
						@endforeach
						{{-- <li class="icon-list__item">
							<span class="icon-list__item__icon">
								<i class="fa-solid fa-user-group"></i>
							</span>
							<span class="icon-list__item__text">Un accompagnement client à toutes les étapes de votre projet</span>
						</li>
						<li class="icon-list__item">
							<span class="icon-list__item__icon">
								<i class="fa-solid fa-shapes"></i>
							</span>
							<span class="icon-list__item__text">Des équipements répondant aux standards CEE</span>
						</li>
						<li class="icon-list__item">
							<span class="icon-list__item__icon">
								<i class="fa-solid fa-user-tie"></i>
							</span>
							<span class="icon-list__item__text">Des experts disponibles pour répondre à toutes vos questions</span>
						</li>
						<li class="icon-list__item">
							<span class="icon-list__item__icon">
								<i class="fa-solid fa-warehouse"></i>
							</span>
							<span class="icon-list__item__text">10 entrepôts dans toute la France</span>
						</li>
						<li class="icon-list__item">
							<span class="icon-list__item__icon">
								<i class="fa-solid fa-award"></i>
							</span>
							<span class="icon-list__item__text">Des installateurs agréés RGE prêt de chez vous</span>
						</li>
						<li class="icon-list__item">
							<span class="icon-list__item__icon">
								<i class="fa-solid fa-screwdriver-wrench"></i>
							</span>
							<span class="icon-list__item__text">Des installations conformes aux exigences de qualité du label RGE</span>
						</li> --}}
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Footer Contact Section -->
	{{-- <section class="footer-contact section-gap section-bg">
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
