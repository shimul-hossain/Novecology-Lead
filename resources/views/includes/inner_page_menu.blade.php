<!-- Header Section -->
<header class="header header--fixed w-100">
    <nav class="navbar navbar-expand-xl py-0">
        <div class="container justify-content-center justify-content-xl-between">
            <a class="navbar-brand d-inline-block" href="{{ url('/') }}">
                {{-- <img src="{{ asset('uploads/logo') }}/{{ logo()->image2 }}" alt="logo" class="navbar-brand__logo w-100" loading="lazy"> --}}
                <img src="{{ asset('frontend_assets/images/logo/logo.png') }}" alt="logo" class="navbar-brand__logo w-100" loading="lazy">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a href="{{ url('/') }}" class="d-inline-block d-xl-none navbar-collapse__logo mb-4">
                    <img src="{{ asset('frontend_assets/images/logo/logo.png') }}" alt="logo" class="w-100" loading="lazy">
                </a>
                <ul class="navbar-nav mx-xl-auto">
                    <li class="nav-item">
                        <a class="nav-link @yield('homePage')" href="{{ url('/') }}">Accueil</a>
                    </li>
                    {{-- <li class="nav-item dropdown position-static">
                        <button class="nav-link border-0 bg-transparent dropdown-toggle position-relative" type="button"
                            id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Novecology
                        </button>
                        <div class="dropdown-menu d-block shadow-none border-0 rounded-0 mt-0"
                            aria-labelledby="navbarDropdown">
                            <div class="container">
                                <ul class="nav w-100">
                                    <li class="nav-item">
                                        <a class="dropdown-item bg-transparent @yield('service')" href="{{ route('frontend.ourService') }}">Notre service</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link @yield('ourSolutions')" href="{{ route('frontend.ourSolutions') }}">Nos services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('adviceGrants')" href="{{ route('frontend.adviceGrants') }}">Conseils & subventions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('testimonial')" href="{{ route('frontend.testimonial') }}">Témoignages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('society')" href="{{ route('frontend.society')}}">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('contact')" href="{{ route('frontend.ourContact') }}">Contact</a>
                    </li>
                </ul>
                <ul class="btn-nav nav flex-column flex-xl-row mx-xl-2 my-3 my-xl-0">
                    <li class="nav-item">
                        <a href="tel:{{ getFooter()->phone }}" class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill">
                            <i class="fas fa-phone-alt"></i> {{ getFooter()->phone }}
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('frontend.chatbot') }}" class="gradient-btn--secondary border-0 position-relative d-inline-block rounded-pill">
                            <i class="fa fa-comments"></i> ChatBot
                        </a>
                    </li> --}}
                </ul>
                {{-- <ul class="social-nav nav mt-3 mt-xl-0 mr-xl-auto">
                    <li class="nav-list">
                        <a href="tel:{{ getFooter()->phone }}" class="social-nav__link d-inline-block">
                            <i class="fas fa-phone-alt"></i>
                        </a>
                    </li>
                    @foreach (social() as $item)
						<li class="nav-list">
							<a href="{{ $item->link }}" class="social-nav__link d-inline-block">
								{!! $item->icon !!}
							</a>
						</li>
					@endforeach
                </ul> --}}
            </div>
        </div>
    </nav>
</header>
<button class="navbar-toggler text-uppercase d-xl-none" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
    aria-label="Toggle navigation">
    <span class="navbar-toggler__wrapper d-flex align-items-center justify-content-center w-100 h-100">
        <span
            class="navbar-toggler__icon d-flex align-items-center justify-content-center position-relative flex-shrink-0"></span>
        <span class="navbar-toggler__text pl-3">Menu</span>
    </span>
</button>
