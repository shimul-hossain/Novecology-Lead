@extends('frontend.new.app')

{{-- Site title  --}}
@section('title', "Médiathèque")

{{-- Meta Description --}}
@section('meta_description', 'Novecology website')

{{-- Meta facebook url  --}}
@section('fb_url', '')

{{-- Meta facebook title --}}
@section('fb_title', "Médiathèque")

{{-- Meta facebook Description --}}
@section('fb_description', 'Novecology website')

{{-- Meta facebook image --}}
@section('fb_image', '')

{{-- Meta Twitter url  --}}
@section('twitter_url', '')

{{-- Meta Twitter title  --}}
@section('twitter_title', "Médiathèque")

{{-- Meta Twitter description  --}}
@section('twitter_desciption', 'Novecology website')

{{-- Meta Twitter image  --}}
@section('twitter_image','')

{{-- menu active  --}}
{{-- @section('Médiathèque','') --}}

@section('plugin_css')

@endsection

@push('style_css')
<style>   
    h1,h3,h4
    {
        font-family: "Quicksand", sans-serif
    }

    .hr,
    .hr__text {
        position: relative
    }

    .hr {
        display: flex;
        align-items: center;
        justify-content: center
    }

    .hr::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 1px;
        background-color: #170863
    }

    .hr__text {
        background-color: #ffffff;
        padding: 1px 15px
    }

    .text-primary {
        color: #59c0b6 !important
    }


    .gradient-btn--secondary,
    .gradient-btn--secondary::before,
    .gradient-btn--secondary::after {
        -webkit-transition: all linear .3s;
        -o-transition: all linear .3s;
        -moz-transition: all linear .3s;
        transition: all linear .3s
    }

    .gradient-btn--secondary::before{
        background-image: -webkit-gradient(linear, right top, left top, from(#0d279c), to(#52a4f3));
        background-image: -webkit-linear-gradient(right, #0d279c, #52a4f3);
        background-image: -moz-linear-gradient(right, #0d279c, #52a4f3);
        background-image: -o-linear-gradient(right, #0d279c, #52a4f3);
        background-image: linear-gradient(-90deg, #0d279c, #52a4f3)
    }

    .gradient-btn--secondary,
    .gradient-btn--secondary::after{
        background-image: -webkit-gradient(linear, left top, right top, from(#5bc4b4), to(#4a9fc6));
        background-image: -webkit-linear-gradient(left, #5bc4b4, #4a9fc6);
        background-image: -moz-linear-gradient(left, #5bc4b4, #4a9fc6);
        background-image: -o-linear-gradient(left, #5bc4b4, #4a9fc6);
        background-image: linear-gradient(90deg, #5bc4b4, #4a9fc6)
    }



    .gradient-btn--secondary {
        font-size: .9375rem;
        font-weight: 300;
        padding: .625rem 1.875rem;
        z-index: 1
    }

    .gradient-btn--secondary::before,
    .gradient-btn--secondary::after {
        content: "";
        position: absolute;
        top: -1px;
        right: -1px;
        bottom: -1px;
        left: -1px;
        border-radius: inherit;
        z-index: -1
    }

    .gradient-btn--secondary::before {
        opacity: 0
    }

    .gradient-btn--secondary:hover,
    .gradient-btn--secondary:focus-visible {
        color: #fff
    }

    .gradient-btn--secondary:hover::before,
    .gradient-btn--secondary:focus-visible::before {
        opacity: 1
    }

    .gradient-btn--secondary:hover::after,
    .gradient-btn--secondary:focus-visible::after {
        opacity: 0
    }


    .gradient-btn--secondary {
        color: #ffffff !important
    }




    @media(max-width: 667.98px) {
        .hr__text * {
            font-size: 18px
        }
    }
</style>
@endpush


@section('content')
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
                                            <img src="{{asset('uploads/mediatheques')}}/{{ $mediatheque->logo}}" alt="logo" draggable="false" loading="lazy" width="250" class="img-fluid mx-auto">
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

@section('plugin_js') 
@endsection

@push('script_js')
<script>
    $(document).ready(function () {
 
    });
</script>
@endpush
