
@include('includes.crm.header')

@section('title')
    {{ __('Reset Password') }}
@endsection
   
    
<header class="header position-fixed bg-white w-100">
    <nav class="navbar navbar-expand-xxl">
        <div class="container">
            <a class="navbar-brand brand-logo custom-focus d-block" href="{{ url('/') }}">
                <img  loading="lazy"  src="https://novecology.fr/frontend_assets/images/logo/logo.png" alt="logo">
            </a>
        </div>
    </nav>
</header>

<!-- Banner Section -->
<section class="banner section-gap position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="banner__card bg-white">
                    <form method="POST" action="{{ route('password.update') }}" class="form mx-auto needs-validation" id="login-form" novalidate>
                        @csrf
                        <h1 class="form__title position-relative text-center">{{ __('Password Reset') }}</h1>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="email" name="email" class="form-control shadow-none" readonly  value="{{ $request->email }}" placeholder="{{ __('Your Email') }}" required>                            
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="password" name="password" class="form-control shadow-none "placeholder="{{ __('Password') }}" required>                            
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="password" name="password_confirmation" class="form-control shadow-none "  placeholder="{{ __('Confirm Password') }}" required>                            
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3">{{ __('Email Password Reset Link') }}</button>
                        </div>
                    </form>
                    {{-- <form method="POST" action="{{ route('password.update') }}">
                        @csrf
            
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
            
                        <div class="block">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                        </div>
            
                        <div class="mt-4">
                            <x-jet-label for="password" value="{{ __('Password') }}" />
                            <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        </div>
            
                        <div class="mt-4">
                            <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                            <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        </div>
            
                        <div class="flex items-center justify-end mt-4">
                            <x-jet-button>
                                {{ __('Reset Password') }}
                            </x-jet-button>
                        </div>
                    </form> --}}
                </div>
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
