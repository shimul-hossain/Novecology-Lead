@extends('layouts.frontend')
@section('content')

@include('includes.inner_page_menu')

<!-- Banner Section -->
<section class="banner banner--secondary">
    <div class="banner__slide__wrapper position-relative"
        style="background-image: var(--gradient-overlay), url({{ asset('uploads/our_solution') }}/{{ $solutions->image }})">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('frontend.ourSolutions') }}" class="gradient-btn--secondary font-weight-bold border-0 position-relative d-inline-block rounded-pill">Nos solutions</a>
                    <h1 class="banner__title mt-3">{{ $solutions->title }}</h1>
                    <p>{{ $solutions->subtitle }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Details Section -->
<section class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 text-center text-lg-left mb-5 mb-lg-0">
                @foreach ($details as $item)
                <div class="section-header">
                    <h1 class="section-header__title section-header__title--lg">
                        <strong>{{ $item->question }}</strong>
                    </h1>
                </div>
                <p>{!! $item->answer !!}</p>
                @endforeach
            </div>

            <div class="col-lg-4">
                <div class="sticky-card bg-white text-center mx-auto">
                    <a href="{{ url('/') }}" class="d-inline-block">
                        <img src="{{ asset('uploads/logo') }}/{{ logo()->image2}}" alt="logo"
                            class="sticky-card__logo w-100">
                    </a>
                    <p class="sticky-card__text primary-color my-4">
                        Bénéficiez <br>
                        d’une <u>étude gratuite</u> <br> pour réaliser <br> des <strong>économies sur votre facture
                            énergétique</strong>
                    </p>
                    <button class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill mb-3"
                        data-toggle="modal" data-target="#simulateProjectModal">Je simule mon projet</button>
                    <button class="gradient-btn--primary border-0 position-relative d-inline-block rounded-pill"
                        data-toggle="modal" data-target="#calledBackModal">Je veux être rappelé</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Good Reasons Section -->
<section class="section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center text-lg-left mb-3">
                <div class="section-header">
                    <h1 class="section-header__title section-header__title--lg">
                        <strong class="font-weight-bold d-block">{{ $solutions->get_reasons->count() }} bonnes raisons</strong>
                        d'éco-rénover votre logement maintenant !
                    </h1>
                </div>
            </div>
            <div class="col-lg-11">
                <div class="row justify-content-between">

                    @foreach ($oursolutionReason as $item)
                     <div class="col-md-6 mt-4">
                        <div class="process__block text-center px-0">
                            <div
                                class="process__block__circle process__block__circle--shadow rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                <img src="{{ asset('uploads/our_solutionReasons')}}/{{ $item->image }}" alt="icon image" class="w-100 h-100">
                            </div>
                            <h2 class="process__block__title mb-4">
                                <strong class="font-weight-light">{{ $item->title }}</strong>
                            </h2>
                            <p class="process__block__text">{!! $item->details !!}</p>
                        </div>
                     </div>
                    @endforeach
                    {{-- <div class="col-md-6 mt-4">
                        <div class="process__block text-center px-0">
                            <div
                                class="process__block__circle process__block__circle--shadow rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                <img src="{{ asset('frontend_assets/images/icons/icons-2.png') }}" alt="icon image" class="w-100 h-100">
                            </div>
                            <h2 class="process__block__title mb-4">
                                <strong class="font-weight-light">Améliorez le</strong><br>confort de votre
                                habitation
                            </h2>
                            <p class="process__block__text">Été comme en hiver, cela permet d’améliorer grandement
                                votre confort</p>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="process__block text-center px-0">
                            <div
                                class="process__block__circle process__block__circle--shadow rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                <img src="{{ asset('frontend_assets/images/icons/icons-3.png') }}" alt="icon image" class="w-100 h-100">
                            </div>
                            <h2 class="process__block__title mb-4">
                                <strong class="font-weight-light">Assurez la réalisation de votre chantier <br>par
                                    un</strong>artisan « reconnu garant de l’environnement »
                            </h2>
                            <p class="process__block__text">Gage de confiance, notre entreprise est « reconnu garant
                                de l’environnement » (qualibat – RGE) et exerce dans le respect des normes et de
                                l’excellence technique.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <div class="process__block text-center px-0">
                            <div
                                class="process__block__circle process__block__circle--shadow rounded-circle d-inline-flex align-items-center justify-content-center mb-4">
                                <img src="{{ asset('frontend_assets/images/icons/icons-4.png') }}" alt="icon image" class="w-100 h-100">
                            </div>
                            <h2 class="process__block__title mb-4">
                                Réduisez <strong class="font-weight-light">considérablement</strong><br>vos factures
                                en chauffage
                            </h2>
                            <p class="process__block__text">Gage de confiance, notre entreprise est « reconnu garant
                                de l’environnement » (qualibat – rge) et exerce dans le respect des normes et de
                                l’excellence technique.</p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <!-- Clients Details Section -->
	<section class="section-gap">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center text-lg-left mb-3">
					<div class="section-header">
						<h1 class="section-header__title section-header__title--lg">
							Nos fournisseurs pour
							<strong class="font-weight-bold d-block">éco-rénover votre logement</strong>
						</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="clients__card col-md-3 col-sm-4 col-6">
					<div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
						<img src="./assets/images/clients/clients-4.jpg" alt="clients logo" class="clients__card__image w-100">
					</div>
				</div>
				<div class="clients__card col-md-3 col-sm-4 col-6">
					<div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
						<img src="./assets/images/clients/clients-5.jpg" alt="clients logo" class="clients__card__image w-100">
					</div>
				</div>
				<div class="clients__card col-md-3 col-sm-4 col-6">
					<div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
						<img src="./assets/images/clients/clients-6.jpg" alt="clients logo" class="clients__card__image w-100">
					</div>
				</div>
				<div class="clients__card col-md-3 col-sm-4 col-6">
					<div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
						<img src="./assets/images/clients/clients-7.jpg" alt="clients logo" class="clients__card__image w-100">
					</div>
				</div>
				<div class="clients__card col-md-3 col-sm-4 col-6">
					<div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
						<img src="./assets/images/clients/clients-8.jpg" alt="clients logo" class="clients__card__image w-100">
					</div>
				</div>
				<div class="clients__card col-md-3 col-sm-4 col-6">
					<div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
						<img src="./assets/images/clients/clients-9.jpg" alt="clients logo" class="clients__card__image w-100">
					</div>
				</div>
				<div class="clients__card col-md-3 col-sm-4 col-6">
					<div class="clients__card__wrapper d-flex align-items-center justify-content-center bg-white h-100">
						<img src="./assets/images/clients/clients-10.jpg" alt="clients logo" class="clients__card__image w-100">
					</div>
				</div>
			</div>
		</div>
	</section> --}}

{{-- <!-- Customers Opinion Section -->
	<section class="testimonial section-gap">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-header mb-0">
						<h1 class="section-header__title section-header__title--lg mb-0"><strong>l'avis de nos clients</strong></h1>
					</div>
				</div>
			</div>
			<div class="testimonial__slider row py-5">
				<div class="testimonial__slide col-lg-4 col-md-6">
					<div class="testimonial__card text-center h-100">
						<div class="testimonial__card__head">
							<svg class="testimonial__card__quote-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><path d="M50.6,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1c-0.8-0.9-1.2-1.3-1.8-1.8 c-0.4-0.3-0.9-0.3-1.3,0c-6.3,5.5-13.4,16.9-12.3,30.8c0.6,8.2,6.6,14.1,14.2,14.1c7.8,0,14.2-6.4,14.2-14.2 C64,32.8,58.1,26.7,50.6,26.2z M49.8,52.6c-6.5,0-11.7-5.2-12.2-12.3c0,0,0,0,0,0c-1.1-15.7,8.2-25.8,11-28.5c0.3,0.3,0.6,0.6,1,1.1 c0.6,0.6,1.3,1.3,2.5,2.5c-4.4,6.8-3.6,11.6-3.2,12.3c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C62,47.1,56.5,52.6,49.8,52.6z M15.1,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1 c-0.8-0.9-1.2-1.3-1.8-1.8c-0.4-0.3-0.9-0.3-1.3,0C6.1,15.2-0.9,26.5,0.1,40.5v0c0.6,8.2,6.6,14.1,14.2,14.1 c7.8,0,14.2-6.4,14.2-14.2C28.5,32.8,22.6,26.7,15.1,26.2z M14.3,52.6c-6.5,0-11.7-5.2-12.2-12.3v0c-1.1-15.7,8.2-25.9,11-28.5 c0.3,0.3,0.6,0.6,1.1,1.1c0.6,0.6,1.3,1.3,2.5,2.5C12.2,22.1,13,27,13.4,27.7c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C26.5,47.1,21,52.6,14.3,52.6z"></path></svg>
						</div>
						<p class="testimonial__card__text my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
						<div class="testimonial__card__author d-flex align-items-center justify-content-center">
							<img src="./assets/images/user/user.svg" alt="" class="testimonial__card__author__avatar rounded-circle flex-shrink-0">
							<p class="testimonial__card__author__name mb-0 ml-2">Nom du client</p>
						</div>
					</div>
				</div>
				<div class="testimonial__slide col-lg-4 col-md-6">
					<div class="testimonial__card text-center h-100">
						<div class="testimonial__card__head">
							<svg class="testimonial__card__quote-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><path d="M50.6,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1c-0.8-0.9-1.2-1.3-1.8-1.8 c-0.4-0.3-0.9-0.3-1.3,0c-6.3,5.5-13.4,16.9-12.3,30.8c0.6,8.2,6.6,14.1,14.2,14.1c7.8,0,14.2-6.4,14.2-14.2 C64,32.8,58.1,26.7,50.6,26.2z M49.8,52.6c-6.5,0-11.7-5.2-12.2-12.3c0,0,0,0,0,0c-1.1-15.7,8.2-25.8,11-28.5c0.3,0.3,0.6,0.6,1,1.1 c0.6,0.6,1.3,1.3,2.5,2.5c-4.4,6.8-3.6,11.6-3.2,12.3c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C62,47.1,56.5,52.6,49.8,52.6z M15.1,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1 c-0.8-0.9-1.2-1.3-1.8-1.8c-0.4-0.3-0.9-0.3-1.3,0C6.1,15.2-0.9,26.5,0.1,40.5v0c0.6,8.2,6.6,14.1,14.2,14.1 c7.8,0,14.2-6.4,14.2-14.2C28.5,32.8,22.6,26.7,15.1,26.2z M14.3,52.6c-6.5,0-11.7-5.2-12.2-12.3v0c-1.1-15.7,8.2-25.9,11-28.5 c0.3,0.3,0.6,0.6,1.1,1.1c0.6,0.6,1.3,1.3,2.5,2.5C12.2,22.1,13,27,13.4,27.7c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C26.5,47.1,21,52.6,14.3,52.6z"></path></svg>
						</div>
						<p class="testimonial__card__text my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
						<div class="testimonial__card__author d-flex align-items-center justify-content-center">
							<img src="./assets/images/user/user.svg" alt="" class="testimonial__card__author__avatar rounded-circle flex-shrink-0">
							<p class="testimonial__card__author__name mb-0 ml-2">Nom du client</p>
						</div>
					</div>
				</div>
				<div class="testimonial__slide col-lg-4 col-md-6">
					<div class="testimonial__card text-center h-100">
						<div class="testimonial__card__head">
							<svg class="testimonial__card__quote-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><path d="M50.6,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1c-0.8-0.9-1.2-1.3-1.8-1.8 c-0.4-0.3-0.9-0.3-1.3,0c-6.3,5.5-13.4,16.9-12.3,30.8c0.6,8.2,6.6,14.1,14.2,14.1c7.8,0,14.2-6.4,14.2-14.2 C64,32.8,58.1,26.7,50.6,26.2z M49.8,52.6c-6.5,0-11.7-5.2-12.2-12.3c0,0,0,0,0,0c-1.1-15.7,8.2-25.8,11-28.5c0.3,0.3,0.6,0.6,1,1.1 c0.6,0.6,1.3,1.3,2.5,2.5c-4.4,6.8-3.6,11.6-3.2,12.3c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C62,47.1,56.5,52.6,49.8,52.6z M15.1,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1 c-0.8-0.9-1.2-1.3-1.8-1.8c-0.4-0.3-0.9-0.3-1.3,0C6.1,15.2-0.9,26.5,0.1,40.5v0c0.6,8.2,6.6,14.1,14.2,14.1 c7.8,0,14.2-6.4,14.2-14.2C28.5,32.8,22.6,26.7,15.1,26.2z M14.3,52.6c-6.5,0-11.7-5.2-12.2-12.3v0c-1.1-15.7,8.2-25.9,11-28.5 c0.3,0.3,0.6,0.6,1.1,1.1c0.6,0.6,1.3,1.3,2.5,2.5C12.2,22.1,13,27,13.4,27.7c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C26.5,47.1,21,52.6,14.3,52.6z"></path></svg>
						</div>
						<p class="testimonial__card__text my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
						<div class="testimonial__card__author d-flex align-items-center justify-content-center">
							<img src="./assets/images/user/user.svg" alt="" class="testimonial__card__author__avatar rounded-circle flex-shrink-0">
							<p class="testimonial__card__author__name mb-0 ml-2">Nom du client</p>
						</div>
					</div>
				</div>
				<div class="testimonial__slide col-lg-4 col-md-6">
					<div class="testimonial__card text-center h-100">
						<div class="testimonial__card__head">
							<svg class="testimonial__card__quote-icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><path d="M50.6,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1c-0.8-0.9-1.2-1.3-1.8-1.8 c-0.4-0.3-0.9-0.3-1.3,0c-6.3,5.5-13.4,16.9-12.3,30.8c0.6,8.2,6.6,14.1,14.2,14.1c7.8,0,14.2-6.4,14.2-14.2 C64,32.8,58.1,26.7,50.6,26.2z M49.8,52.6c-6.5,0-11.7-5.2-12.2-12.3c0,0,0,0,0,0c-1.1-15.7,8.2-25.8,11-28.5c0.3,0.3,0.6,0.6,1,1.1 c0.6,0.6,1.3,1.3,2.5,2.5c-4.4,6.8-3.6,11.6-3.2,12.3c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C62,47.1,56.5,52.6,49.8,52.6z M15.1,26.2c-0.1-1.4,0-5.2,3.6-10.4c0.3-0.4,0.2-0.9-0.1-1.3c-1.5-1.5-2.4-2.4-3-3.1 c-0.8-0.9-1.2-1.3-1.8-1.8c-0.4-0.3-0.9-0.3-1.3,0C6.1,15.2-0.9,26.5,0.1,40.5v0c0.6,8.2,6.6,14.1,14.2,14.1 c7.8,0,14.2-6.4,14.2-14.2C28.5,32.8,22.6,26.7,15.1,26.2z M14.3,52.6c-6.5,0-11.7-5.2-12.2-12.3v0c-1.1-15.7,8.2-25.9,11-28.5 c0.3,0.3,0.6,0.6,1.1,1.1c0.6,0.6,1.3,1.3,2.5,2.5C12.2,22.1,13,27,13.4,27.7c0.2,0.3,0.5,0.6,0.9,0.6c6.7,0,12.2,5.5,12.2,12.2 C26.5,47.1,21,52.6,14.3,52.6z"></path></svg>
						</div>
						<p class="testimonial__card__text my-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
						<div class="testimonial__card__author d-flex align-items-center justify-content-center">
							<img src="./assets/images/user/user.svg" alt="" class="testimonial__card__author__avatar rounded-circle flex-shrink-0">
							<p class="testimonial__card__author__name mb-0 ml-2">Nom du client</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> --}}

<!-- Our Solutions Section -->


@include('includes.suppliers')

@include('includes.client_oppinion');

<section class="solutions section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header">
                    <h1 class="section-header__title section-header__title--lg"><strong>Nos autres solutions</strong>
                    </h1>
                </div>
            </div>
        </div>
        <div class="blogs__slider row">
            @foreach ($ourSolution as $item)
            <div class="blogs__slide col-lg-4 col-md-6">
                <div class="blogs__card blogs__card--highlight d-flex flex-column h-100">
                    <div class="blogs__card__head d-flex position-relative">
                        <a href="{{route('ourSolution.details',$item->id)}}" class="blogs__card__link d-inline-block">
                            <img src="{{ asset('uploads/our_solution')}}/{{$item->image}}" alt="blogs image"
                                class="blogs__card__image w-100">
                        </a>
                        {{-- <a href="{{route('ourSolution.details',$item->id)}}" class="tag-btn d-inline-block
                        text-white position-absolute rounded-pill">Solutions pour particuliers</a> --}}
                    </div>
                    <div class="blogs__card__body h-100">
                        <h3 class="blogs__card__title mb-0">
                            <a href="{{route('ourSolution.details',$item->id)}}"
                                class="d-inline-block">{{$item->title}}</a>
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@include('includes.footer_contact')
@include('includes.simulate_project_modal')


@include('includes.contact_modal')

@endsection

@section('js')
@endsection
