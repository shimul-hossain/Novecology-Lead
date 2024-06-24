@extends('layouts.frontend')

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('frontend_assets/plugins/venobox/css/venobox.min.css') }}">
@endsection


@section('meta_data')
    <!-- Site Meta Data -->
    <meta name="author" content="{{ $detail->meta_author }}">
    <meta name="title" content="{{ $detail->meta_title }}">
    <meta name="description" content="{{ $detail->meta_description }}">
    <meta name="keywords" content="{{ $detail->meta_keyword }}">
    <!-- Primary Meta Tags -->

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $detail->og_type }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $detail->og_title }}">
    <meta property="og:description" content="{{ $detail->og_description }}">
    @if ($detail->og_image != null)
        <meta property="og:image" content="{{ asset('uploads/our_advice')}}/{{ $detail->og_image  }}">
    @else
        <meta property="og:image" content="{{ asset('uploads/our_advice')}}/{{ $detail->thumbnail }}">
    @endif
@endsection



@section('content')

@include('includes.inner_page_menu')
{{-- @include('includes.home_page_menu') --}}
<!-- Banner Section -->

<section class="banner banner--secondary">
    <div class="banner__slide__wrapper text-center position-relative"
        style="background-image: var(--gradient-overlay), url({{ asset('uploads/our_advice')}}/{{ $detail->thumbnail }})">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <a href="{{ route('frontend.adviceGrants') }}"
                        class="gradient-btn--secondary font-weight-bold border-0 position-relative d-inline-block rounded-pill">Conseils
                        & subventions</a>
                    <h1 class="banner__title text-center mt-3">
                        {{$detail->title}}
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <!-- Header Section -->
<header class="header header--sticky w-100">
    <nav class="navbar navbar-expand-xl py-0">
        <div class="container">
            <button class="navbar-toggler text-uppercase" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler__wrapper d-flex align-items-center justify-content-center w-100 h-100">
                    <span
                        class="navbar-toggler__icon d-flex align-items-center justify-content-center position-relative flex-shrink-0"></span>
                    <span class="navbar-toggler__text pl-3">Menu</span>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a href="./index.html" class="d-inline-block d-xl-none navbar-collapse__logo mb-4">
                    <img src="./assets/images/logo/logo.png" alt="logo" class="w-100">
                </a>
                <ul class="navbar-nav ml-xl-auto">
                    <li class="nav-item dropdown position-static">
                        <button class="nav-link border-0 bg-transparent dropdown-toggle" type="button"
                            id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Novecology
                        </button>
                        <div class="dropdown-menu d-block shadow-none border-0 rounded-0 mt-0"
                            aria-labelledby="navbarDropdown">
                            <div class="container">
                                <ul class="nav w-100">
                                    <li class="nav-item">
                                        <a class="dropdown-item bg-transparent" href="./our-society.html">Notre
                                            société</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item bg-transparent" href="./our-service.html">Notre
                                            service</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item bg-transparent" href="./contact.html">Nous contacter</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./solutions.html">Nos solutions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./advice-grants.html">Conseils & subventions</a>
                    </li>
                </ul>
                <ul class="btn-nav nav flex-column flex-xl-row mx-xl-3 my-3 my-xl-0">
                    <li class="nav-item">
                        <button class="gradient-btn--primary border-0 position-relative d-inline-block rounded-pill"
                            data-toggle="modal" data-target="#calledBackModal">Je veux être rappelé</button>
                    </li>
                    <li class="nav-item">
                        <button class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill"
                            data-toggle="modal" data-target="#simulateProjectModal">Je simule mon projet</button>
                    </li>
                </ul>
                <ul class="social-nav nav mt-3 mt-xl-0 mr-xl-auto">
                    <li class="nav-list">
                        <a href="#!" class="social-nav__link d-inline-block">
                            <span class="novecology-icon-facebook"></span>
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="#!" class="social-nav__link d-inline-block">
                            <span class="novecology-icon-youtube"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header> --}}



<!-- Projects Details Section -->
<section class="project-details section-gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1 class="section-header__title section-header__title--lg mb-4">
                    <strong class="font-weight-bold">{{ $detail->title }}</strong>
                </h1>
                <p>{!! $detail->details !!}</p>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4">
                        <a href="{{ asset('uploads/our_advice')}}/{{ $detail->image1 }}" data-gall="projectDetailsGallery"
                            class="venobox light-box-card d-inline-block h-100">
                            <img src="{{ asset('uploads/our_advice')}}/{{ $detail->image1 }}" alt="works image" class="w-100 h-100">
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{ asset('uploads/our_advice')}}/{{ $detail->image2 }}" data-gall="projectDetailsGallery"
                            class="venobox light-box-card d-inline-block h-100">
                            <img src="{{ asset('uploads/our_advice')}}/{{ $detail->image2 }}" alt="works image" class="w-100 h-100">
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{ asset('uploads/our_advice')}}/{{ $detail->image3 }}" data-gall="projectDetailsGallery"
                            class="venobox light-box-card d-inline-block h-100">
                            <img src="{{ asset('uploads/our_advice')}}/{{ $detail->image3 }}" alt="blogs image" class="w-100 h-100">
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{ asset('uploads/our_advice')}}/{{ $detail->image4 }}" data-gall="projectDetailsGallery"
                            class="venobox light-box-card d-inline-block h-100">
                            <img src="{{ asset('uploads/our_advice')}}/{{ $detail->image4 }}" alt="works image" class="w-100 h-100">
                        </a>
                    </div>
                </div>
                <div class="section-header mt-5">
                    <h2 class="section-header__title section-header__title--lg">
                        <strong class="font-weight-bold">Questions</strong> fréquentes
                    </h2>
                </div>
                <div class="accordion" id="projectDetailsAccordion">

                    @foreach ($adviceFaq as $item)
                    <div class="card border-0 mb-4">
                        <div class="card-header bg-transparent border-0 p-0" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn text-left w-100 d-flex align-items-center shadow-none collapsed"
                                    type="button" data-toggle="collapse" data-target="#faq{{ $item->id }}"
                                    aria-expanded="false" aria-controls="collapseOne">
                                    {{ $item->question }}
                                    <span class="card-header__closer ml-auto flex-shrink-0 ml-2">
                                        <span class="card-header__closer__icon d-inline-block position-relative"><i
                                                class="far fa-times-circle"></i></span>
                                    </span>
                                </button>
                            </h2>
                        </div>

                        <div id="faq{{ $item->id }}" class="collapse" aria-labelledby="headingOne"
                            data-parent="#projectDetailsAccordion">
                            <div class="card-body text-white">
                              {{ $item->answer }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    {{-- <div class="card border-0 mb-4">
                        <div class="card-header bg-transparent border-0 p-0" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn text-left w-100 d-flex align-items-center shadow-none collapsed"
                                    type="button" data-toggle="collapse" data-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br>
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    <span class="card-header__closer ml-auto flex-shrink-0 ml-2">
                                        <span class="card-header__closer__icon d-inline-block position-relative"><i
                                                class="far fa-times-circle"></i></span>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#projectDetailsAccordion">
                            <div class="card-body text-white">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>
                    <div class="card border-0">
                        <div class="card-header bg-transparent border-0 p-0" id="headingThree">
                            <h2 class="mb-0">
                                <button class="btn text-left w-100 d-flex align-items-center shadow-none collapsed"
                                    type="button" data-toggle="collapse" data-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit,<br>
                                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                    <span class="card-header__closer ml-auto flex-shrink-0 ml-2">
                                        <span class="card-header__closer__icon d-inline-block position-relative"><i
                                                class="far fa-times-circle"></i></span>
                                    </span>
                                </button>
                            </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#projectDetailsAccordion">
                            <div class="card-body text-white">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it
                                squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur
                                butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div> --}}
                </div>


                <div class="row align-items-center my-5 border border-left-0 border-right-0 py-3">
                    <div class="col-md-6">
                        <h3 class="primary-color">
                            Vous aimez nos conseils ?
                            <strong class="font-weight-bolde d-block">Partagez-les avec vos proches</strong>
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <ul class="social-list list-inline text-md-right mb-0">
                            @foreach (social() as $item)

                            <li class="list-inline-item">
                                <a href="{{ $item->link }}" class="social-list__link d-inline-block">
                                    {!! $item->icon !!}
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- More Projects Show Section -->
<section class="more-projects section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header">
                    <h1 class="section-header__title section-header__title--md mb-5">
                        <strong class="d-block">D'autres conseils</strong>
                        de nos équipes
                    </h1>
                </div>
            </div>
        </div>
        <div class="blogs__slider row">

            @foreach ($advices  as $item)

            <div class="blogs__slide col-lg-4 col-md-6">
                <div class="blogs__card d-flex flex-column h-100">
                    <div class="blogs__card__head d-flex position-relative">
                        <a href="{{route('advice.details',$item->id)}}" class="blogs__card__link d-inline-block">
                            <img src="{{ asset('uploads/our_advice')}}/{{$item->thumbnail}}" alt="blogs image"
                                class="blogs__card__image w-100">
                        </a>
                        <span class="blogs__card__date position-absolute text-white font-weight-bold">{{$item->created_at->format('d/m/y')}}</span>
                    </div>
                    <div class="blogs__card__body h-100">
                        <h3 class="blogs__card__title mb-0">
                            <a href="{{route('advice.details',$item->id)}}" class="d-inline-block">{{$item->title}}</a>
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

@section('plugin-js')
    <script src="{{ asset('frontend_assets/plugins/venobox/js/venobox.min.js') }}"></script>
@endsection


@section('js')

<script>
    window.onscroll = function () {
        headerStickyfunction()
    };

    let stickyHeader = document.querySelector(".header--sticky");
    let headerElementOffsetTop = stickyHeader.offsetTop;

    function headerStickyfunction() {
        if (window.pageYOffset > headerElementOffsetTop) {
            stickyHeader.classList.add("sticky");
        } else {
            stickyHeader.classList.remove("sticky");
        }
    }

    /* Veno box popup init */
	$('.venobox').venobox({
        bgcolor: '#ffffff',
        spinner: 'cube-grid',
	});
</script>

@endsection
