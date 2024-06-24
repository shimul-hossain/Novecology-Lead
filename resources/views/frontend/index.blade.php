@extends('layouts.frontend')

@section('homePage', 'active')

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('frontend_assets/plugins/intl-tel-input/css/intlTelInput.min.css') }}">
@endsection

@section('plugin-js')
<script src="{{ asset('frontend_assets/plugins/intl-tel-input/js/intlTelInput-jquery.min.js') }}" defer></script>
@endsection

@section('content')

@include('includes.inner_page_menu')

@include('includes.banner')

{{-- @include('includes.footer_contact') --}}

{{-- @include('includes.bienvenue') --}}

{{-- @include('includes.expertise') --}}

@include('includes.workWith')

@include('includes.nos_solution')

@include('includes.about_us')

@include('includes.conseils_&_subventions')

@include('includes.client_oppinion')

@include('includes.video_testimonial')

{{-- @include('includes.project-realize') --}}


@include('includes.simulate_project_modal')


@include('includes.contact_modal')


@endsection

@section('js')
<script>
    $(document).ready(function(){
        /* Load iframe after click function start */
        $('[data-toggle="thumbnail"]').each(function(){
            $(this).append(`
            <button type="button" class="video-testimonial__slide__card__thumbnail-wrapper" data-toggle="iframe">
                <img src="https://i.ytimg.com/vi/${$(this).attr("data-embed-id")}/hqdefault.jpg" alt="youtube thumbnail" loading="lazy" class="video-testimonial__slide__card__thumbnail-image" />
                <svg class="video-testimonial__slide__card__thumbnail-icon" width="1em" height="1em" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.5212 2.58C21.2688 1.60333 20.7156 0.776667 19.7676 0.516667C18.0497 0.0433333 11 0 11 0C11 0 3.95029 0.0433333 2.23235 0.516667C1.28441 0.776667 0.734412 1.60333 0.478824 2.58C0.0194118 4.35 0 8 0 8C0 8 0.0194118 11.65 0.478824 13.42C0.731176 14.3967 1.28441 15.2233 2.23235 15.4833C3.95029 15.9567 11 16 11 16C11 16 18.0497 15.9567 19.7676 15.4833C20.7156 15.2233 21.2688 14.3967 21.5212 13.42C21.9806 11.65 22 8 22 8C22 8 21.9806 4.35 21.5212 2.58Z" fill="#FF0000"/>
                    <path d="M14.5579 8.00033L8.73438 4.66699V11.3337" fill="white"/>
                </svg>
            </button>
            `);
        });

        $(document).on("click", '[data-toggle="iframe"]', function(){
            $(this).closest('[data-toggle="thumbnail"]').html(`<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/${$(this).closest('[data-toggle="thumbnail"]').attr("data-embed-id")}?autoplay=1&enablejsapi=1&controls=1&autopause=0&muted=1" allow="autoplay" frameborder="0" loading="lazy"></iframe>`)
        });
        /* Load iframe after click function end */


    });

    $(document).ready( function() {
        $("#telephone").intlTelInput({
            initialCountry:"fr",
            separateDialCode: true,
        });

        $("#telephone").on("input", function(){
            let countryTelephoneCode = $(".iti__selected-dial-code").text();
            let countryTelephoneNumber = $(this).val();
            $("#selectedTelephoneNumber").val(countryTelephoneCode + countryTelephoneNumber);
        });

        $(document).on("click", "li.iti__country", function(){
            let countryTelephoneCode = $(".iti__selected-dial-code").text();
            let countryTelephoneNumber = $("#telephone").val();
            $("#selectedTelephoneNumber").val(countryTelephoneCode + countryTelephoneNumber);
        });
    });


</script>
@endsection
