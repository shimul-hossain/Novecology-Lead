@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Témoignages clients")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', 'Témoignages clients')

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', 'Témoignages clients')

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

{{-- menu active  --}}
@section('temoignagesClients','active')

@section('plugin_css')

@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')

    <!-- Review Section -->
	<section class="review section-gap">
		<div class="container">
			<div class="row flex-lg-row-reverse align-items-center">
				<div class="col-lg-6">
					<img src="{{asset('uploads/new/testimonial')}}/{{ $info->right_side_image }}" alt="bear" height="300" draggable="false" loading="lazy" class="review__image mx-auto">
				</div>
				<div class="col-lg-6 text-center text-lg-start">
					<div class="section-header text-lg-start">
						<h1 class="section-header__title mb-1">{{ $info->title }}</h1>
						<h2 class="text-danger">{{ $info->subtitle }}</h2>
					</div>
					<p>{{ $info->description }}</p>
					<a href="{{ $info->button_link ?? '#!' }}" class="btn-fat btn-fat--primary">{{ $info->button_text }}</a>
				</div>
			</div>
		</div>
	</section>

	<section class="review section-gap">
		<div class="container">
			<div class="row">
				@foreach ($testimonials as $testimonial)
					<div class="col-lg-4 col-md-6 mb-4">
						<div class="review__card rounded">
							<div class="review__card__header">
								<h3 class="review__card__title">{{ $testimonial->title }}</h3>
							</div>
							<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="{{ $testimonial->embed_id }}"></div>
							<div class="review__card__footer">
								<p class="review__card__text mb-0">{{ $testimonial->description }}</p>
							</div>
						</div>
					</div>
				@endforeach
				{{-- <div class="col-lg-4 col-md-6 mb-4">
					<div class="review__card rounded">
						<div class="review__card__header">
							<h3 class="review__card__title">Title</h3>
						</div>
						<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="pNfgyV3jRiY"></div>
						<div class="review__card__footer">
							<p class="review__card__text mb-0">Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="review__card rounded">
						<div class="review__card__header">
							<h3 class="review__card__title">Title</h3>
						</div>
						<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="cm7BjtGDzWg"></div>
						<div class="review__card__footer">
							<p class="review__card__text mb-0">Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="review__card rounded">
						<div class="review__card__header">
							<h3 class="review__card__title">Title</h3>
						</div>
						<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="xRNTW3eem48"></div>
						<div class="review__card__footer">
							<p class="review__card__text mb-0">Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="review__card rounded">
						<div class="review__card__header">
							<h3 class="review__card__title">Title</h3>
						</div>
						<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="SPf5GXIott4"></div>
						<div class="review__card__footer">
							<p class="review__card__text mb-0">Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="review__card rounded">
						<div class="review__card__header">
							<h3 class="review__card__title">Title</h3>
						</div>
						<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="vXOqIVAd7Pw"></div>
						<div class="review__card__footer">
							<p class="review__card__text mb-0">Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="review__card rounded">
						<div class="review__card__header">
							<h3 class="review__card__title">Title</h3>
						</div>
						<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="KRpQ6APj4rU"></div>
						<div class="review__card__footer">
							<p class="review__card__text mb-0">Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4">
					<div class="review__card rounded">
						<div class="review__card__header">
							<h3 class="review__card__title">Title</h3>
						</div>
						<div class="review__card__body ratio ratio-4x3" data-toggle="thumbnail" data-embed-id="mDvskrB-zsU"></div>
						<div class="review__card__footer">
							<p class="review__card__text mb-0">Description Lorem ipsum dolor sit, amet consectetur adipisicing elit. Explicabo, libero.</p>
						</div>
					</div>
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

@endsection

@push('script_js')
    <script>
        $(document).ready(function () {
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
                $(this).closest('[data-toggle="thumbnail"]').html(`<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/${$(this).closest('[data-toggle="thumbnail"]').attr("data-embed-id")}?autoplay=1&enablejsapi=1&controls=1&autopause=0&muted=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen frameborder="0" loading="lazy"></iframe>`)
            });
        });
    </script>
@endpush
