@extends('layouts.frontend')

@section('contact')
active
@endsection


@section('content')

@include('includes.inner_page_menu')

<!-- Sub Banner Section -->
<section class="sub-banner py-2">
    <article class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header text-center text-lg-left mb-0">
                    <h1 class="section-header__title">
                        <strong class="font-weight-bold d-block">{{ $contactUs->title }}</strong>
                    </h1>
                </div>
            </div>
        </div>
        </div>
</section>

<!-- Contact Details Section -->
<section class="section-gap pt-1">
    <div class="container">
        <b><span class="text-success" id="succ"></span></b>
        <div class="row justify-content-center">
            <div class="col-12 text-center text-lg-left mb-5 mb-lg-0">
                <div class="card border-0 card-shadow mb-5">
                    <div class="card-body">
                        <form id="reset_form" method="POST" action="#!" class="contact-form needs-validation" id="contactForm" novalidate>
                            <div class="row">
                                @csrf
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control shadow-none" placeholder="Nom">
                                        <span class="text-danger contactFormError" id="nameError"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group position-relative">
                                        <input id="contactEmail" name="email" type="email" class="form-control shadow-none" placeholder="Adresse email" required>
                                        <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        <span class="text-danger contactFormError" id="emailError"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group position-relative">
                                        <input id="phone" name="phone" type="tel" class="form-control shadow-none" placeholder="Votre téléphone" required>
                                        <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        <span class="text-danger contactFormError" id="phoneError"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group position-relative">
                                        <input id="address" name="address" type="text" class="form-control shadow-none" placeholder="Ville" required>
                                        <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        <span class="text-danger contactFormError" id="addressError"></span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group position-relative">
                                        <textarea id="contactMassage" name="message" rows="5" class="form-control shadow-none" placeholder="Messege"></textarea>
                                        <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                        <span class="text-danger contactFormError" id="messageError"></span>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <div class="form-group position-relative">
                                        <input type="text"
                                            class="form-control shadow-none rounded-0 border-top-0 border-right-0 border-left-0"
                                            placeholder="Votre code postal" required>
                                        <div class="invalid-tooltip">Ce champ est nécessaire</div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group position-relative">
                                        <div class="input-group">
                                            <select
                                                class="form-control custom-select shadow-none rounded-0 border-top-0 border-right-0 border-left-0"
                                                id="contactFormSelect" required>
                                                <option>Choose...</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group position-relative">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="contactFormFile"
                                                    aria-describedby="Contact Form File">
                                                <label
                                                    class="custom-file-label form-control text-left shadow-none rounded-0 border-top-0 border-right-0 border-left-0"
                                                    for="contactFormFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12 text-center text-lg-left">
                                    <button type="submit" id="contactFormSubmit" class="gradient-btn--secondary position-relative border-0 rounded-pill">Envoyer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card border-0 card-shadow">
                    <div class="card-body">
                        <h4 class="secondary-color">
                            {{ $contactUs->subtitle }}
                        </h4>
                        <div class="font-weight-light">
                            {!! $contactUs->details !!}
                        </div>
                        <ul class="social-list list-inline mb-0">
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
            {{-- <div class="col-lg-4">
                <div class="sticky-card bg-white text-center mx-auto">
                    <a href="{{ url('/') }}" class="d-inline-block">
                        <img src="{{ asset('uploads/logo') }}/{{ logo()->image2 }}" alt="logo" class="sticky-card__logo w-100" loading="lazy">
                    </a>
                    <p class="sticky-card__text primary-color my-4">
                        Bénéficiez <br>
                        d’une <u>étude gratuite</u> <br> pour réaliser <br> des <strong>économies sur votre facture
                            énergétique</strong>
                    </p>
                    <button class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill mb-3" data-toggle="modal" data-target="#simulateProjectModal">Je simule mon projet</button>
                    <!--
                        <button class="gradient-btn--primary border-0 position-relative d-inline-block rounded-pill" data-toggle="modal" data-target="#calledBackModal">Je veux être rappelé</button>
                    -->
                </div>
            </div> --}}
        </div>
    </div>
{{--
    <style>
        .short_list_img
        {
            display: inline-block;
            width: 300px;
            height: 60px;
            object-fit: cover;
            margin-top: 20px;
        }

    </style>
     <div class="text-center">
        <a class="short_list_img" href="undefined" >
            <img class="img-fluid" src="https://core.sortlist.com//_/apps/core/images/badges-en/badge-flag-blue-light-xl.svg" alt="flag" />
        </a>
     </div> --}}
</section>


@include('includes.simulate_project_modal')


@include('includes.contact_modal')
@endsection


@section('js')
<script>
    $(document).ready(function () {
        $('#contactFormSubmit').click(function (e) {
            e.preventDefault();
            let name = $('#name').val();
            let email = $('#contactEmail').val();
            let phone = $('#phone').val();
            let address = $('#address').val();
            let message = $('#contactMassage').val();
            // $('#reset_form')[0].reset();



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{route('frontend.useMassage')}}",
                data: {
                    name    : name,
                    email   : email,
                    phone   : phone,
                    address : address,
                    message : message,
                },

                success: function (data) {
                    $('#reset_form')[0].reset();
                    $(".contactFormError").text('');
                    $("#succ").html('Votre message a été envoyé avec succès !! Merci');
                },
                error: function(errors) {
                    if(errors.responseJSON.errors.name){
                        $('#nameError').text(errors.responseJSON.errors.name);
                    }else{
                        $('#nameError').text('');
                    }
                    if(errors.responseJSON.errors.email){
                        $('#emailError').text(errors.responseJSON.errors.email);
                    }else{
                        $('#emailError').text('');
                    }
                    if(errors.responseJSON.errors.phone){
                        $('#phoneError').text(errors.responseJSON.errors.phone);
                    }else{
                        $('#phoneError').text('');
                    }
                    if(errors.responseJSON.errors.address){
                        $('#addressError').text(errors.responseJSON.errors.address);
                    }else{
                        $('#addressError').text('');
                    }
                    if(errors.responseJSON.errors.message){
                        $('#messageError').text(errors.responseJSON.errors.message);
                    }else{
                        $('#messageError').text('');
                    }
                }
            });

        });
    })
</script>
@endsection
