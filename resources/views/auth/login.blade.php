@extends('includes.crm.login-header')

@section('internal-css')
    <style>
        .btn--match-width{
            width: 100%;
            max-width: 185px;
        }
    </style>
@endsection

@section('login')
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
                    <form action="{{ route('login') }}" class="form mx-auto needs-validation" id="login-form" method="POST" novalidate>
                        @csrf
                        <h1 class="form__title position-relative text-center">{{ __('Log in') }}</h1>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="email" name="email" class="form-control shadow-none" placeholder="{{ __('Your username') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="password" name="password" class="form-control form-control--password shadow-none" placeholder="{{ __('Password') }}" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
                                <span class="password-toggler__icon novecologie-icon-eye"></span>
                            </button>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3 primary-btn--match-width">{{ __('Log in') }}</button>
                            <a href="{{ url('forgot-password') }}" class="primary-btn primary-btn--transparent primary-btn--lg rounded-pill primary-btn--match-width">{{ __('Forgot your password') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<section class="layout--row secondary-bg">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-8 col-md-6 d-none d-md-block">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <img src="{{ asset('crm_assets/assets/images/noveco-login.png') }}" alt="login image" draggable="false" loading="lazy" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 d-flex align-items-center justify-content-center bg-white">
                <form action="{{ route('login') }}" class="form mx-auto needs-validation w-100 py-5" id="login-form" method="POST" novalidate>
                    @csrf
                    <h1 class="form__title position-relative text-center">{{ __('Log in') }}</h1>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="email" name="email" class="form-control shadow-none" placeholder="{{ __('Your username') }}" required>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        <input type="password" name="password" class="form-control form-control--password shadow-none" placeholder="{{ __('Password') }}" required>
                        {{-- @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror --}}
                        <button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
                            <span class="password-toggler__icon novecologie-icon-eye"></span>
                        </button>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center mt-4">
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3 btn--match-width">{{ __('Log in') }}</button>
                        <a href="{{ url('forgot-password') }}" class="primary-btn primary-btn--transparent primary-btn--lg rounded-pill btn--match-width">{{ __('Forgot your password') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
