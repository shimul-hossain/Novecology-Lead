{{-- <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
    @foreach($available_locales as $locale_name => $available_locale)
        @if($available_locale === $current_locale)
                @if($current_locale === 'en')
                <img  loading="lazy"  src="{{ asset('english.png') }}" alt="">
                @elseif($current_locale === 'fr')
                <img  loading="lazy"  src="{{ asset('french.png') }}" alt="">
                @endif
        @else
            <a class="ml-1 underline ml-2 mr-2" href="{{ url('/locale') }}/{{ $available_locale }}">
                @if($current_locale === 'en')
                <img  loading="lazy"  src="{{ asset('french.png') }}" alt="">
                @elseif($current_locale === 'fr')
                <img  loading="lazy"  src="{{ asset('english.png') }}" alt="">
                @endif
            </a>
        @endif
    @endforeach
</div> --}}
<li class="nav-item position-relative dropdown">
    <button class="navbar-account__link language-toggle dropdown-toggle d-flex align-items-center bg-transparent border-0 custom-focus" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @if($current_locale === 'en')
        <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/flags/flag-en.jpg') }}" alt="En flag" class="current-language-flag img-fluid">
        @elseif($current_locale === 'fr')
        <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/flags/flag-fr.jpg') }}" alt="Fr flag" class="current-language-flag img-fluid">
        @endif
        {{-- <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/flags/flag-en.jpg') }}" alt="En flag" class="current-language-flag img-fluid"> --}}
    </button>
    <div class="dropdown-menu dropdown-menu--language bg-white border-0" aria-labelledby="navbarDropdown">
        <a class="dropdown-item language__item text-center p-1" href="{{ route('localization', 'fr') }}">
            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/flags/flag-fr.jpg') }}" alt="Fr flag" class="language__item__flag img-fluid">
        </a>
        <a class="dropdown-item language__item text-center p-1" href="{{ route('localization', 'en') }}">
            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/flags/flag-en.jpg') }}" alt="En flag" class="language__item__flag img-fluid">
        </a>
    </div>
</li>