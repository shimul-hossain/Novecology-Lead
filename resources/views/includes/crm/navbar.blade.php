<header class="header position-fixed bg-white">
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <a class="navbar-brand brand-logo custom-focus py-0" href="{{ route('dashboard.analytic') }}">
                <img class="brand-logo__image" src="{{ asset('frontend_assets/images/logo/logo.png') }}" alt="logo" height="40" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNavbar" aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="novecologie-icon-menu"></span>
            </button>

            <div class="collapse navbar-collapse" id="mobileNavbar">
                <div class="navbar-collapse__header w-100">
                    <div class="navbar-collapse__header__wrapper d-flex align-items-center justify-content-between">
                        <a class="brand-logo custom-focus" href="{{ route('dashboard.analytic') }}">
                            <img class="brand-logo__image" src="{{ asset('frontend_assets/images/logo/logo.png') }}" alt="logo" height="40" loading="lazy">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNavbar" aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="novecologie-icon-close"></span>
                        </button>
                    </div>
                </div>
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link @yield('homeIndex')" href="{{ route('dashboard.analytic') }}">{{ __('Home') }}</a>
                    </li>
                    @php
                        $nav_access_id = [];
                        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];
                    @endphp
                    @foreach (checkMenuAccess() as $key =>$menu)
                        @if ($menu->route == 'role.index' || $menu->route == 'superadmin.dashboard'|| $menu->route == 'super_admin.landing' || $menu->route == 'chat.index'|| $menu->route == 'map.index')
                            @continue
                        @endif
                        @if(role() == 's_admin')
                            @if ($menu->route == 'ticketing.index')
                                <li class="nav-item dropdown">
                                    <a class="nav-link @yield($menu->yield) dropdown-toggle" href="/More/" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        {{ $menu->name }}
                                    </a>
                                    <div class="dropdown-menu bg-white border-0">
                                        @if (in_array(role(), $administrarif_role))
                                            <a class="dropdown-item" href="{{ route('ticket.dashboard') }}">Tableau de bord</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route($menu->route) }}">{{ $menu->name }}</a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link @yield($menu->yield)" href="{{ route($menu->route) }}">{{ $menu->name }}</a>
                                </li>
                            @endif
                        @else
                            @if ($menu->getNavigation->route == 'role.index' || $menu->getNavigation->route == 'superadmin.dashboard'|| $menu->getNavigation->route == 'super_admin.landing' || $menu->getNavigation->route == 'chat.index'|| $menu->getNavigation->route == 'map.index')
                                @continue
                            @endif

                            @if (in_array($menu->navigation_id, $nav_access_id))
                                @continue
                            @else
                                @php
                                    $nav_access_id[] = $menu->navigation_id;
                                @endphp
                            @endif

                            @if ($menu->getNavigation->route == 'ticketing.index')
                                <li class="nav-item dropdown">
                                    <a class="nav-link @yield($menu->yield) dropdown-toggle" href="/More/" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        {{ $menu->getNavigation->name }}
                                    </a>
                                    <div class="dropdown-menu bg-white border-0">
                                        @if (in_array(role(), $administrarif_role))
                                            <a class="dropdown-item" href="{{ route('ticket.dashboard') }}">Tableau de bord</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route($menu->getNavigation->route) }}">{{ $menu->getNavigation->name }}</a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link @yield($menu->getNavigation->yield)" href="{{ route($menu->getNavigation->route) }}">{{ $menu->getNavigation->name }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    {{-- @include('includes.crm.language-switcher') --}}
                </ul>
            </div>

            <div class="navbar-account ml-auto">
                <ul class="navbar-account__nav nav align-items-center text-center">
                    <li class="nav-item">
                        <button type="button" title="search" class="mobile-searchbar-toggle-btn" data-mobile-searchbar-toggle-btn>
                            <i class="bi bi-search"></i>
                        </button>
                        <div class="navbar__searchbar">
                            <input type="text" placeholder="Recherche" class="navbar__searchbar__input" data-searchbar-input tabindex="1">
                            <div class="navbar__searchbar__append">
                                <button type="button" title="close" class="navbar__searchbar__btn navbar__searchbar__btn--clear" data-searchbar-clear-btn>
                                    <i class="bi bi-x-lg"></i>
                                </button>
                                <button type="button" title="search" class="bg-white navbar__searchbar__btn navbar__searchbar__btn--search" data-searchbar-search-btn>
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="navbar-account__link dropdown-toggle" href="/More/" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <svg width="1em" height="1em" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg" class="navbar-account__link__icon">
                                <path d="M15 30C6.72875 30 0 23.2713 0 15C0 6.72875 6.72875 0 15 0C23.2713 0 30 6.72875 30 15C30 23.2713 23.2713 30 15 30ZM15 1.25C7.41875 1.25 1.25 7.41875 1.25 15C1.25 22.5813 7.41875 28.75 15 28.75C22.5813 28.75 28.75 22.5813 28.75 15C28.75 7.41875 22.5813 1.25 15 1.25Z" fill="currentColor"/>
                                <path d="M20.625 10H9.375C9.03 10 8.75 9.72 8.75 9.375C8.75 9.03 9.03 8.75 9.375 8.75H20.625C20.97 8.75 21.25 9.03 21.25 9.375C21.25 9.72 20.97 10 20.625 10Z" fill="currentColor"/>
                                <path d="M20.625 15.625H9.375C9.03 15.625 8.75 15.345 8.75 15C8.75 14.655 9.03 14.375 9.375 14.375H20.625C20.97 14.375 21.25 14.655 21.25 15C21.25 15.345 20.97 15.625 20.625 15.625Z" fill="currentColor"/>
                                <path d="M20.625 21.25H9.375C9.03 21.25 8.75 20.97 8.75 20.625C8.75 20.28 9.03 20 9.375 20H20.625C20.97 20 21.25 20.28 21.25 20.625C21.25 20.97 20.97 21.25 20.625 21.25Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <div class="dropdown-menu bg-white border-0 dropdown-menu-right navbar-scroll-bar navbar-fixed-width">
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'map.index')->exists() || role() == 's_admin')
                            <a class="dropdown-item" href="{{ route('map.index') }}">Carte</a>
                            @endif
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'chat.index')->exists() || role() == 's_admin')
                            <a class="dropdown-item" href="{{ route('chat.index') }}">Chat</a>
                            @endif
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'notion.index')->exists() || role() == 's_admin')
                                <a class="dropdown-item" href="{{ route('notion.index') }}">Notions</a>
                            @endif
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'automatisation.index')->exists() || role() == 's_admin')
                            <a class="dropdown-item" href="{{ route('automatisation.index') }}">Automatisations</a>
                            @endif
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'pannel.log')->exists() || role() == 's_admin')
                                <a class="dropdown-item" href="{{ route('pannel.log') }}">Pannel Log</a>
                            @endif
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'jarvis.index')->exists() || role() == 's_admin')
                                <a class="dropdown-item" href="#!">Jarvis</a>
                            @endif
                            <div class="main_element">
                                <h3 class="dropdown-item">Exports
                                    <i class="bi bi-chevron-up icon"></i>
                                </h3>
                                <div class="main_item"> 
                                    @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'export.index')->exists() || role() == 's_admin')
                                        <a class="dropdown-item" href="{{ route('export.index') }}">Export</a>
                                    @endif
                                    @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'export.lite')->exists() || role() == 's_admin')
                                        <a class="dropdown-item" href="{{ route('export.lite') }}">Export Lite</a>
                                    @endif
                                </div>
                            </div>  
                            @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'stock.index')->exists() || role() == 's_admin')
                                <a class="dropdown-item" href="{{ route('stock.index') }}">Stock</a>
                            @endif
                            {{-- @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'stock.index')->exists() || role() == 's_admin')
                                <a class="dropdown-item" href="#!">Stock</a>
                            @endif --}}

                            <div class="main_element">
                                <h3 class="dropdown-item">Outils
                                    <i class="bi bi-chevron-up icon"></i>
                                </h3>
                                <div class="main_item"> 
                                    @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'calculatte.barth')->exists() || role() == 's_admin')
                                        <a class="dropdown-item" href="{{ route('calculatte.barth') }}">Calculette BAR TH 164</a>
                                    @endif
                                    
                                    @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'calculatte.reno')->exists() || role() == 's_admin')
                                        <a class="dropdown-item" href="{{ route('calculatte.reno') }}">Calculette Reno Ampleur</a>
                                    @endif
                                    
                                    @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'calculatte.depertidion')->exists() || role() == 's_admin')
                                        <a class="dropdown-item" href="{{ route('calculatte.depertidion') }}">Note de dimensionnement</a>
                                    @endif
                                    @if (\App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'calculatte.cumac')->exists() || role() == 's_admin')
                                        <a class="dropdown-item" href="{{ route('calculatte.cumac') }}">Calculette Cumac</a>
                                    @endif
                                    @if (checkAction(Auth::id(), 'project', 'magic-planning') || role() == 's_admin')
                                        <a class="dropdown-item" href="{{ route('magic.planning') }}">Magic planning</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('mediatheque.index') }}">Mediatheque</a>
                                </div>
                            </div> 
                        </div>
                    </li>
                    {{-- @include('includes.crm.language-switcher') --}}
                    <li class="nav-item">
                        <a class="navbar-account__link @yield('settingsIndex')" href="{{ route('profile.index') }}"> <span class="novecologie-icon-settings"></span></a>
                    </li>
                    @if (Auth::user()->status != 'deactive')
                        <li class="nav-item dropdown">
                            <a class="navbar-account__link notification d-flex position-relative custom-focus dropdown-toggle" href="/notifications/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span id="notifyIconVibrate"  class="novecologie-icon-bell notification--icon @if (countNotifications() >0)
                                    active
                                @endif"></span>
                                <span id="notificationCount" class="notification--counter text-white position-absolute d-inline-flex align-items-center justify-content-center rounded-circle">{{ countNotifications() }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu--notification bg-white border-0 px-0" aria-labelledby="navbarDropdown">
                                <div class="dropdown-menu__header d-flex align-items-center justify-content-between px-3 py-3">
                                    <h3 class="dropdown-menu__title mb-0">{{ __('Notifications') }}</h3>
                                    <span class="badge-btn flex-shrink-0 d-inline-block rounded-pill">{{ countNotifications() }} New</span>
                                </div>
                                @include('includes.crm.view-notification')
                                <div class="dropdown-menu__footer text-center p-2 border-top">
                                    <a href="{{ route('notifications.read.all') }}" class="primary-btn primary-btn--orange d-inline-block border-0 w-100 mb-1 rounded">{{ __('Mark as read') }}</a>
                                    <a href="{{ route('notifications.index') }}" class="secondary-btn secondary-btn--secondary d-inline-block border-0 w-100">{{ __('View all notifications') }}</a>
                                </div>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="navbar-account__link dropdown-toggle d-flex align-items-center custom-focus" href="/me/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::user()->profile_photo)
                            <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ Auth::user()->profile_photo }}" alt="user image" class="navbar-account__user--avator rounded-circle">
                            @else
                            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="user image" class="navbar-account__user--avator rounded-circle">
                            @endif
                            <p class="navbar-account__user--name mb-0"><span class="font-weight-bold">{{ Auth::user()->name }}</span></p>
                            <span class="novecologie-icon-chevron-down dropdown-icon"></span>
                        </a>
                        <div class="dropdown-menu bg-white border-0 dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                <span class="novecologie-icon-user dropdown-menu__icon mr-2"></span>
                                {{ __('Profile') }}
                            </a>

                            @if(getRegisterPage())
                                <a class="dropdown-item" href="{{ route(getRegisterPage()->route) }}">
                                    <span class="novecologie-icon-user-plus dropdown-menu__icon mr-2"></span>
                                    {{ getRegisterPage()->name }}
                                </a>
                            @endif

                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <span class="novecologie-icon-log-out dropdown-menu__icon mr-2"></span>
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mobile__searchbar" data-mobile-searchbar>
            <div class="mobile__searchbar__row h-100 bg-white">
                <div class="mobile__searchbar__prepend">
                    <span title="search" class="mobile__searchbar__btn mobile__searchbar__btn--search">
                        <i class="bi bi-search"></i>
                    </span>
                </div>
                <input type="text" placeholder="Recherche" class="mobile__searchbar__input" data-searchbar-input>
                <div class="mobile__searchbar__append">
                    <button type="button" title="close" class="mobile__searchbar__btn mobile__searchbar__btn--clear" data-searchbar-clear-btn>
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="search-result-card" data-search-card>
    <div class="search-result-card__body bg-white rounded-bottom">
        <div class="container">
            <div class="search-result-list" id="allSearch">
                <h1 class="text-primary text-center mb-0">Recherche...</h1>
            </div>
        </div>
    </div>
</div>

<button type="button" class="search-result-close" data-search-result-close></button>


<!-- Off Canvas Menu Toggler -->
<button class="offCanvasMenuCloser position-fixed borde-0" type="button" data-toggle="collapse" data-target="#mobileNavbar" aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation"></button>

@push('js')
<script>
    $(document).ready(function () {


        $('.main_element h3').click(function(e) {
            e.stopPropagation();
            $(this).toggleClass('dropdown-item-active');
            $(this).find('i').toggleClass('bi-chevron-down bi-chevron-up');
            $(this).next('.main_item').slideToggle();
        }); 

        function debounceFunction(callback, delay = 400){
            let timeOut
            return (...args)=> {
                clearTimeout(timeOut)
                timeOut = setTimeout(() => {
                    callback(...args)
                }, delay);
            }
        }

        const allSearchActions = debounceFunction((searchedValue)=>{
            const typedSearchValue = searchedValue.toLowerCase().trim()
            if(typedSearchValue == ''){
                $('[data-search-result-close]').hide()
                $('[data-search-card]').hide()
                $('[data-searchbar-search-btn]').show()
                $("#allSearch").html(`<h1 class="text-primary text-center mb-0">Recherche...</h1>`);
                return
            }else{
                $('[data-search-result-close]').fadeIn()
                $('[data-search-card]').fadeIn()
                $('[data-searchbar-search-btn]').hide()
                $("#allSearch").html(`<h1 class="text-primary text-center mb-0">Recherche...</h1>`);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : "POST",
                    url  : "{{ route('admin.all.search') }}",
                    data : {
                        search : typedSearchValue,
                    },
                    success : response => {
                        $("#allSearch").html(response);
                    },
                    error : errors => {
                        console.log(errors);
                    }
                });
            }

        })

        $('[data-searchbar-input]').val('')

        $('[data-searchbar-input]').on('input', function(){
            allSearchActions($(this).val())
        })

        $('[data-searchbar-clear-btn], [data-search-result-close]').on('click', function(){
            $('[data-searchbar-input]').val('')
            allSearchActions($('[data-searchbar-input]').val())
            $('[data-mobile-searchbar]').fadeOut()
        })

        $('[data-mobile-searchbar-toggle-btn]').on('click', function(){
            $('[data-mobile-searchbar]').fadeIn()
            $('[data-searchbar-input]').focus()
        })
    });
</script>
@endpush
