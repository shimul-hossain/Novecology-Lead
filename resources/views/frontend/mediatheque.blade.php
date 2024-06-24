@extends('layouts.frontend')
@section('content')

@include('includes.inner_page_menu')

<!-- Contact Details Section -->
<section class="section-gap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center">
                    <h1 class="section-header__title section-header__title--md font-weight-bold">Médiathèque</h1>
                </div>
            </div>
            <div class="col-lg-7 mx-auto text-center">
                <h4 class="mb-5">Vous trouverez ci-dessous toutes les fiches techniques concernant nos pompes à chaleur, ballons d'eau chaude et types d'isolants utilisés</h4>
            </div>
            @foreach ($categories as $category)
                <div class="col-12 mb-4">
                    <div class="hr mb-5">
                        <div class="hr__text">
                            <h3 class="text-primary font-weight-bold mb-0">{{ $category->name }}</h3>
                        </div>
                    </div>
                    <div class="row justify-content-center match-height">
                        @foreach ($category->getMediatheque as $mediatheque)
                            <div class="col-lg-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <img src="{{asset('uploads/mediatheques')}}/{{ $mediatheque->logo}}" alt="logo" draggable="false" loading="lazy" width="250" class="img-fluid">
                                        <h3 class="my-3">{{ $mediatheque->title }}</h3>
                                        <a href="{{asset('uploads/mediatheques')}}/{{ $mediatheque->file_name}}" target="_blank" class="d-inline-block gradient-btn--secondary position-relative border-0 rounded-pill">Télécharger</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach 
        </div>
    </div>
</section>

@endsection

@section('js')
@endsection
