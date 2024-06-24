@extends('includes.crm.login-header')

@section('title')
    {{ __('Forgot Password') }}
@endsection

{{-- <header class="header position-fixed bg-white w-100">
    <nav class="navbar navbar-expand-xxl">
        <div class="container">
            <a class="navbar-brand brand-logo custom-focus d-block" href="{{ url('/') }}">
                <span class="brand-logo__color">Nov</span>ecology
            </a>
        </div>
    </nav>
</header> --}}

<!-- Banner Section -->
{{-- <section class="banner section-gap position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="banner__card bg-white">
                    <form method="POST" action="{{ route('password.email') }}" class="form mx-auto needs-validation" id="login-form" novalidate>
                        @csrf
                        <h1 class="form__title position-relative text-center">{{ __('Password Reset') }}</h1>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="email" name="email" class="form-control shadow-none " value="{{ old('email') }}" placeholder="{{ __('Your Email') }}" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3">{{ __('Email Password Reset Link') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}

@section('login')
<section class="layout--row secondary-bg">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-8 col-md-6 d-none d-md-block">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <img src="https://i.ibb.co/1sXMdc0/noveco-login.png" alt="login image" draggable="false" loading="lazy" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-center justify-content-center bg-white">
                <form method="POST" action="{{ route('password.email') }}" class="form mx-auto needs-validation w-100 py-5" id="login-form" novalidate>
                    @csrf
                    <h1 class="form__title position-relative text-center">{{ __('Password Reset') }}</h1>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="email" name="email" class="form-control shadow-none " value="{{ old('email') }}" placeholder="{{ __('Your Email') }}" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center mt-4">
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3">{{ __('Email Password Reset Link') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Middle Modal -->
<div class="modal modal--aside fade" id="middleModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0 pb-5">
                @if (session('status'))
                <h4 class="verified">{{ session('status') }}</h4>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    @if (session('status'))
        <script>
            $(window).load(function(){
                $('#middleModal').modal('show')
            })
        </script>
    @endif
@endpush

@include('includes.crm.footer-contact')


@include('includes.crm.footer')
