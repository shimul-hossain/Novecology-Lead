@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Nos références")

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
@section('dropdownActiveClass','active')
@section('nosReferences','active')


@section('plugin_css')

@endsection

@push('style_css')
<style>

</style>
@endpush


@section('content')
    <!-- References Section -->
    <section class="section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-header text-start">
                        <h1 class="section-header__title">{{ $info->title }}</h1>
                    </div>
                    <p>{{ $info->description }}</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('uploads/new/reference') }}/{{ $info->image }}" alt="references" draggable="false" loading="lazy" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Installations Section -->
    <section class="section-gap">
        <div class="container">
            <div class="section-header">
                <h1 class="section-header__title">{{ $info->gallery_title }}</h1>
            </div>
            <div class="installations-filter__nav nav nav justify-content-center">
                <button type="button" class="installations-filter__btn active" data-filter="*">
                    Tout
                </button>
                @foreach ($categories as $category)
                    <button type="button" class="installations-filter__btn" data-filter=".{{ $category->id }}">
                        {{ $category->name }}
                    </button>
                @endforeach
                {{-- <button type="button" class="installations-filter__btn" data-filter=".chaudiere_a_granules">
                    Chaudière à granulés
                </button>
                <button type="button" class="installations-filter__btn" data-filter=".pompe_a_chaleur_air_eau">
                    Pompe à Chaleur Air/Eau
                </button>
                <button type="button" class="installations-filter__btn" data-filter=".pompe_a_chaleur_air_air">
                    Pompe à Chaleur Air/Air
                </button>
                <button type="button" class="installations-filter__btn" data-filter=".solaire">
                    Solaire
                </button>
                <button type="button" class="installations-filter__btn" data-filter=".isolation">
                    Isolation
                </button> --}}
            </div>
            <div class="row grid">
                @foreach ($categories as $category)
                    @foreach ($category->getImages as $image)
                        <div class="grid-item col-md-6 mt-3 mt-md-4 {{ $image->category_id }}">
                            <div class="ratio ratio-16x9">
                                <img src="{{ asset('uploads/new/reference') }}/{{ $image->image }}" alt="service" loading="lazy" draggable="false">
                            </div>
                        </div>   
                    @endforeach
                @endforeach
                {{-- <div class="grid-item col-md-6 mt-3 mt-md-4 chaudiere_a_granules">
                    <div class="ratio ratio-16x9">
                        <img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-1.jpg') }}" alt="service" loading="lazy" draggable="false">
                    </div>
                </div>
                <div class="grid-item col-md-6 mt-3 mt-md-4 pompe_a_chaleur_air_eau">
                    <div class="ratio ratio-16x9">
                        <img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-2.jpg') }}" alt="service" loading="lazy" draggable="false">
                    </div>
                </div>
                <div class="grid-item col-md-6 mt-3 mt-md-4 pompe_a_chaleur_air_air">
                    <div class="ratio ratio-16x9">
                        <img src="{{ asset('frontend_assets/new/images/services/service-1/service-image-3.jpg') }}" alt="service" loading="lazy" draggable="false">
                    </div>
                </div>
                <div class="grid-item col-md-6 mt-3 mt-md-4 solaire">
                    <div class="ratio ratio-16x9">
                        <img src="{{ asset('frontend_assets/new/images/services/service-3/service-image-1.jpg') }}" alt="service" loading="lazy" draggable="false">
                    </div>
                </div>
                <div class="grid-item col-md-6 mt-3 mt-md-4 isolation">
                    <div class="ratio ratio-16x9">
                        <img src="{{ asset('frontend_assets/new/images/services/service-2/service-image-1.jpg') }}" alt="service" loading="lazy" draggable="false">
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
    <script src="{{ asset('frontend_assets/new/plugins/isotope/js/isotope.min.js') }}"></script>
@endsection

@push('script_js')
    <script>
        /* Isotope Init */
        function isotopeInit() {
            $(".grid").isotope({
                itemSelector: ".grid-item",
                layoutMode: "fitRows",
                masonry: {
                    isFitWidth: true
                }
            });

            // filter items on button click
            $(".installations-filter__btn").on("click", function () {
                var filterValue = $(this).attr("data-filter");
                $(".grid").isotope({ filter: filterValue });

                // Toggle active class on button click
                $(".installations-filter__btn").removeClass("active");
                $(this).addClass("active");
            });
        }

        $(document).ready(function () {
            isotopeInit()
        });
    </script>
@endpush
