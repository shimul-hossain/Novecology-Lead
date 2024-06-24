<!DOCTYPE html>
<html class="loaded {{ themesettings(Auth::id())->theme }}" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin @yield('title')</title>

    <link rel="apple-touch-icon" href="{{ asset('uploads/favicon')}}/{{favicon()->image}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/themes/semi-dark-layout.css') }}">




    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/vendors/css/editors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
    <!-- END: Vendor CSS-->



    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/css/plugins/forms/form-quill-editor.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/pages/app-email.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: DataTable CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <!-- END: DataTable CSS-->

    @yield('css')

<style>
    .gap-15{
        gap: 15px;
    }
</style>
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->


    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/style.css') }}"> --}}

    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static menu-{{ themesettings(Auth::id())->nav }}" data-open="click"
    data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"></li>
                    <a class="nav-link menu-toggle" href="javascript:void(0);">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">

                <li class="nav-item d-none d-lg-block">
                    <a id="dark" class="nav-link nav-link-style">
                        <i class="ficon" data-feather="moon"></i>
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{ Auth::user()->name }}</span>

                            <span
                                class="user-status">{{ (Auth::user()->role == 's_admin') ? 'Super Admin' : 'Admin' }}</span>
                        </div>
                        {{-- <span class="avatar">
                            <img class="round" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg"
                                alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"> </span>
                        </span> --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="mr-50" data-feather="user"></i>{{ __('Profile') }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a onclick="event.preventDefault();this.closest('form').submit();" class="dropdown-item"
                                href="{{ route('logout') }}">
                                <i class="mr-50" data-feather="power"></i> {{ __('Logout') }}
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <ul class="main-search-list-defaultlist d-none">
        <li class="d-flex align-items-center">
            <a href="javascript:void(0);">
                <h6 class="section-label mt-75 mb-0">{{ __('Files') }}</h6>
            </a>
        </li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75">
                        <img src="../../../images/icons/xls.png" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">{{ __('Two new item submitted') }}</p>
                        <small class="text-muted">{{ __('Marketing Manager') }}</small>
                    </div>
                </div>
                <small class="search-data-size mr-50 text-muted">&apos;17kb</small>
            </a></li>
        <li class="auto-suggestion">
            <a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
                <div class="d-flex">
                    <div class="mr-75">
                        <img src="../../../images/icons/jpg.png" alt="png" height="32">
                    </div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">{{ __('52 JPG file Generated') }}</p>
                        <small class="text-muted">{{ __('FontEnd Developer') }}</small>
                    </div>
                </div>
                <small class="search-data-size mr-50 text-muted">&apos;11kb</small>
            </a>
        </li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion justify-content-between">
            <a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start">
                    <span class="mr-75" data-feather="alert-circle"></span>
                    <span>{{ __('No results found.') }}</span>
                </div>
            </a>
        </li>
    </ul>
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('superadmin.dashboard') }}"><span
                            class="brand-logo">
                            <img src="{{ asset('logo.png') }}" alt="" width="40">
                        </span>
                        <h2 class="brand-text">{{ __('Soclose') }}</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a id="toggle" class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="shadow-bottom "></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item @yield('view-website')">
                    <a target="_blank" class="d-flex align-items-center" href="{{ url('/') }}">
                        <i data-feather='eye'></i>
                        <span class="menu-title text-truncate" data-i18n="Email">{{ __('View Website') }}</span>
                    </a>
                </li>
                <li class="nav-item @yield('view-website')">
                    <a target="_blank" class="d-flex align-items-center" href="{{ route('dashboard.analytic') }}">
                        <i data-feather='eye'></i>
                        <span class="menu-title text-truncate" data-i18n="Email">{{ __('View CRM') }}</span>
                    </a>
                </li>
                <li class="navigation-header">
                    <span data-i18n="Apps &amp; Pages">{{ __('Analytics') }}</span>
                    <i data-feather="more-horizontal"></i>
                </li>
                <li class="nav-item @yield('index')">
                    <a class="d-flex align-items-center" href="{{ route('superadmin.dashboard') }}">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Dashboard') }}</span>
                    </a>
                </li>



                {{-- Logos & Favicon --}}

                <li class=" navigation-header">
                    <span data-i18n="User Interface">{{ __('Home') }}</span>
                </li>

                <li class="nav-item @yield('subscribeIndex')">
                    <a class="d-flex align-items-center" href="{{ route('subscribe.index') }}">
                        <i data-feather='maximize'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Subscribers') }}</span>
                    </a>
                </li>


                {{-- Banner --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Banner</span>
                </li> --}}

                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='monitor'></i>
                        <span class="menu-title text-truncate" data-i18n="User">{{ __('Banner') }}</span>
                    </a>

                    <ul class="menu-content">

                        <li class="@yield('bannerIndex')">
                            <a class="d-flex align-items-center" href="{{route('banner.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('bannerCreate')">
                            <a class="d-flex align-items-center" href="{{route('banner.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>


                {{-- Bienvenue --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Bienvenuer</span>
                </li> --}}

                <li class="nav-item @yield('bienvenueIndex')">
                    <a class="d-flex align-items-center" href="{{ route('bienvenue.index') }}">
                        <i data-feather='align-center'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Bienvenue') }}</span>
                    </a>
                </li>


                {{-- Expertises --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Expertises</span>
                </li> --}}

                <li class="nav-item @yield('expertisesIndex')">
                    <a class="d-flex align-items-center" href="{{ route('expertises.index') }}">
                        <i data-feather='smile'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Expertises') }}</span>
                    </a>
                </li>


                {{-- Contacts --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Customer Contact</span>
                </li> --}}

                <li class="nav-item @yield('contactIndex')">
                    <a class="d-flex align-items-center" href="{{ route('contacts.index') }}">
                        <i data-feather='message-circle'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Call Back Request') }}</span>
                    </a>
                </li>

                <li class="nav-item @yield('userMessageIndex')">
                    <a class="d-flex align-items-center" href="{{ route('user.massage') }}">
                        <i data-feather='message-square'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Message') }}</span>
                    </a>
                </li>

                {{-- Customer Project Simulations requests --}}
                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Project Simulation Requests</span>
                </li> --}}

                <li class="nav-item @yield('simulationIndex')">
                    <a class="d-flex align-items-center" href="{{ route('simulateProjects.index') }}">
                        <i data-feather='briefcase'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Simulation Requests') }}</span>
                    </a>
                </li>

                <li class="nav-item @yield('bannerform')">
                    <a class="d-flex align-items-center" href="{{ route('banner.form.index') }}">
                        <i data-feather='box'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Banner Form') }}</span>
                    </a>
                </li>
                <li class="nav-item @yield('chatBot')">
                    <a class="d-flex align-items-center" href="{{ route('admin.chatbot') }}">
                        <i data-feather='codepen'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Chatbot</span>
                    </a>
                </li>


                {{-- WorkingWith --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Working With Section</span>
                </li> --}}

                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='hard-drive'></i>
                        <span class="menu-title text-truncate" data-i18n="User">{{ __('Work With') }}</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('workingwithIndex')">
                            <a class="d-flex align-items-center" href="{{route('workingwith.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('workingwithCreate')">
                            <a class="d-flex align-items-center" href="{{route('workingwith.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='crosshair'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Mediatheque Category</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('mediathequeCategoryIndex')">
                            <a class="d-flex align-items-center" href="{{route('admin.mediatheque.category.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('mediathequeCategoryCreate')">
                            <a class="d-flex align-items-center" href="{{route('admin.mediatheque.category.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='cast'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Mediatheque</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('mediathequeIndex')">
                            <a class="d-flex align-items-center" href="{{route('admin.mediatheque.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('mediathequeCreate')">
                            <a class="d-flex align-items-center" href="{{route('admin.mediatheque.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- about us --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">About us</span>
                </li> --}}

                {{-- <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='twitch'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Our Services</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('aboutIndex')">
                            <a class="d-flex align-items-center" href="{{route('abouts.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">List</span>
                            </a>
                        </li>

                        <li class="@yield('aboutCreate')">
                            <a class="d-flex align-items-center" href="{{route('abouts.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">Create</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}



                {{-- Menu Section --}}

                <li class=" navigation-header">
                    <span data-i18n="User Interface">{{ __('Website') }}</span>
                </li>

                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='cloud-rain'></i>
                        <span class="menu-title text-truncate" data-i18n="User">{{ __('Our Society') }}</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('societyIndex')">
                            <a class="d-flex align-items-center" href="{{route('ourSocieties.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('societyCreate')">
                            <a class="d-flex align-items-center" href="{{route('ourSocieties.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>
                        <li class="@yield('ourSocieteLogo')">
                            <a class="d-flex align-items-center" href="{{ route('ourSocieteLogo.index') }}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Our Solution Logo') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='codepen'></i>
                        <span class="menu-title text-truncate" data-i18n="User">{{ __('Our Service') }}</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('serviceIndex')">
                            <a class="d-flex align-items-center" href="{{route('ourService.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('serviceCreate')">
                            <a class="d-flex align-items-center" href="{{route('ourService.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @yield('contactUsIndex')">
                    <a class="d-flex align-items-center" href="{{ route('menueContactus.index') }}">
                        <i data-feather='hexagon'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Menu Contact us') }}</span>
                    </a>
                </li>

                {{-- Logos & Favicon --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Logo & Favicon</span>
                </li> --}}




                {{-- Advice And Grant Section --}}

                {{-- <li class=" navigation-header">
                    <span data-i18n="User Interface">Advice And Grant Section</span>
                </li> --}}

                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='anchor'></i>
                        <span class="menu-title text-truncate" data-i18n="User">{{ __('Advice and Grants') }}</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('adviceIndex')">
                            <a class="d-flex align-items-center" href="{{route('adviceGrants.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('adviceCreate')">
                            <a class="d-flex align-items-center" href="{{route('adviceGrants.create')}}">
                          <i data-feather='chevron-right'></i>
                           <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>


                {{-- <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='folder-minus'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Our Solution details</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('oursolutionDetailsIndex')">
                            <a class="d-flex align-items-center" href="{{route('solutionDetails.index')}}">
                <i data-feather='chevron-right'></i>
                <span class="menu-item text-truncate" data-i18n="List">List</span>
                </a>
                </li>

                <li class="@yield('oursolutionDtailsCreate')">
                    <a class="d-flex align-items-center" href="{{route('solutionDetails.create')}}">
                        <i data-feather='chevron-right'></i>
                        <span class="menu-item text-truncate" data-i18n="Create">Create</span>
                    </a>
                </li>
            </ul>
            </li>
            <li class="nav-item has-sub" style="">
                <a class="d-flex align-items-center " href="#">
                    <i data-feather='battery-charging'></i>
                    <span class="menu-title text-truncate" data-i18n="User">Solutions Reasons</span>
                </a>

                <ul class="menu-content">
                    <li class="@yield('solutionsReasonsIndex')">
                        <a class="d-flex align-items-center" href="{{route('solutionResons.index')}}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="List">List</span>
                        </a>
                    </li>

                    <li class="@yield('solutionsReasonsCreate')">
                        <a class="d-flex align-items-center" href="{{route('solutionResons.create')}}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="Create">Create</span>
                        </a>
                    </li>
                </ul>
            </li> --}}



            {{-- Our Solution section --}}

            {{-- <li class=" navigation-header">
                <span data-i18n="User Interface">Our Solution section</span>
            </li> --}}

            <li class="nav-item has-sub" style="">
                <a class="d-flex align-items-center " href="#">
                    <i data-feather='cloud-snow'></i>
                    <span class="menu-title text-truncate" data-i18n="User">{{ __('Our Solution') }}</span>
                </a>

                <ul class="menu-content">
                    <li class="@yield('ourSolutionIndex')">
                        <a class="d-flex align-items-center" href="{{ route('ourSolutions.index') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                        </a>
                    </li>

                    <li class="@yield('ourSolutionCreate')">
                        <a class="d-flex align-items-center" href="{{ route('ourSolutions.create') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                        </a>
                    </li>
                </ul>
            </li>


            {{-- <li class="nav-item has-sub" style="">
                <a class="d-flex align-items-center " href="#">
                    <i data-feather='book-open'></i>
                    <span class="menu-title text-truncate" data-i18n="User">Solution Details</span>
                </a>
                <ul class="menu-content">
                    <li class="@yield('solutionDetailsIndex')">
                        <a class="d-flex align-items-center" href="{{ route('solutionDetails.index') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="List">List</span>
                        </a>
                    </li>
                    <li class="@yield('solutionDetailsCreate')">
                        <a class="d-flex align-items-center " href="{{ route('solutionDetails.create') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="Create">Create</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
            {{-- <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='coffee'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Advice Reasons</span>
                    </a>
                    <ul class="menu-content">
                        <li class="@yield('adviceReasonsIndex')">
                            <a class="d-flex align-items-center " href="{{ route('reasonsAdvice.index') }}">
            <i data-feather='chevron-right'></i>
            <span class="menu-item text-truncate" data-i18n="List">List</span>
            </a>
            </li>
            <li class="@yield('adviceReasonsCreate')">
                <a class="d-flex align-items-center " href="{{ route('reasonsAdvice.create') }}">
                    <i data-feather='chevron-right'></i>
                    <span class="menu-item text-truncate" data-i18n="Create">Create</span>
                </a>
            </li>
            </ul>
            </li> --}}

            {{-- Our Suppliers --}}
            {{-- <li class=" navigation-header">
                <span data-i18n="User Interface">Our Suppliers</span>
            </li> --}}
            <li class="nav-item has-sub" style="">
                <a class="d-flex align-items-center " href="#">
                    <i data-feather='globe'></i>
                    <span class="menu-title text-truncate" data-i18n="User">{{ __('Our Suppliers') }}</span>
                </a>
                <ul class="menu-content">
                    <li class="@yield('suppliersIndex')">
                        <a class="d-flex align-items-center " href="{{route('suppliers.index')}}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                        </a>
                    </li>
                    <li class="@yield('suppliersCreate')">
                        <a class="d-flex align-items-center " href="{{route('suppliers.create')}}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- Clint Opinions --}}
            {{-- <li class=" navigation-header">
                <span data-i18n="User Interface">Clint Opinions</span>
            </li> --}}

            <li class="nav-item has-sub" style="">
                <a class="d-flex align-items-center " href="#">
                    <i data-feather='slack'></i>
                    <span class="menu-title text-truncate" data-i18n="User">{{ __('Client Opinions') }}</span>
                </a>

                <ul class="menu-content">
                    <li class="@yield('clintOpinionsIndex')">
                        <a class="d-flex align-items-center " href="{{route('clintOpinions.index')}}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                        </a>
                    </li>

                    <li class="@yield('clintOpinionsCreate')">
                        <a class="d-flex align-items-center " href="{{route('clintOpinions.create')}}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                        </a>
                    </li>
                </ul>
            </li>



            {{-- Genarel Setting --}}
            <li class=" navigation-header">
                <span data-i18n="User Interface">{{ __('All Setting') }}</span>
            </li>

            {{-- translation menu  --}}
            {{-- <li class="nav-item @yield('translation')">
                <a class="d-flex align-items-center" href="{{ route('translation') }}">
                    <i data-feather='triangle'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">Translation</span>
                </a>
            </li> --}}
            <li class="nav-item @yield('token')">
                <a class="d-flex align-items-center" href="{{ route('token') }}">
                    <i data-feather='framer'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">{{ __('API Token') }}</span>
                </a>
            </li>
            <li class="nav-item has-sub" style="">
                <a class="d-flex align-items-center " href="#">
                    <i data-feather='slack'></i>
                    <span class="menu-title text-truncate" data-i18n="User">{{ __('Translation') }}</span>
                </a>

                <ul class="menu-content">
                    <li class="@yield('translation')">
                        <a class="d-flex align-items-center " href="{{ route('translation') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="List">{{ __('Translation') }}</span>
                        </a>
                    </li>

                    <li class="@yield('dbTranslation')">
                        <a class="d-flex align-items-center " href="{{ route('translation.database') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="Create">{{ __('Database Translation') }}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item @yield('logoIndex')">
                <a class="d-flex align-items-center" href="{{ route('logos.index') }}">
                    <i data-feather='zap'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Logo') }}</span>
                </a>
            </li>


            <li class="nav-item @yield('faviconIndex')">
                <a class="d-flex align-items-center" href="{{ route('favicons.index') }}">
                    <i data-feather='feather'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Favicon') }}</span>
                </a>
            </li>

            <li class="nav-item has-sub" style="">
                <a class="d-flex align-items-center " href="#">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="User">{{ __('Page Setting') }}</span>
                </a>

                <ul class="menu-content">
                    <li class="@yield('pageIndex')">
                        <a class="d-flex align-items-center " href="{{ route('pages.index') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="List">{{ __('Page List') }}</span>
                        </a>
                    </li>

                    <li class="@yield('pageCreate')">
                        <a class="d-flex align-items-center" href="{{ route('pages.create') }}">
                            <i data-feather='chevron-right'></i>
                            <span class="menu-item text-truncate" data-i18n="Create">{{ __('Page Create') }}</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item @yield('colorIndex')">
                <a class="d-flex align-items-center" href="{{ route('colorSetting.index') }}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Color Setting') }}</span>
                </a>
            </li>


            <li class="nav-item @yield('footerIndex')">
                <a class="d-flex align-items-center" href="{{ route('footerSettings.index') }}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Footer Setting') }}</span>
                </a>
            </li>

            <li class="nav-item @yield('footerColumnIndex')">
                <a class="d-flex align-items-center" href="{{ route('columnSettings.index') }}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Footer Column Setting') }}</span>
                </a>
            </li>

            <li class="nav-item @yield('socialIndex')">
                <a class="d-flex align-items-center" href="{{ route('socialLinks.index') }}">
                    <i data-feather='settings'></i>
                    <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Social Media Setting') }}</span>
                </a>
            </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay">
        </div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            @yield('breadcrumb')

                            <!-- <div class="content-header-left col-md-12 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
                                    <div class="breadcrumb-wrapper">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">Banners</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        {{-- content start from here --}}
                        @yield('content') {{-- content end her
                    e --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">
                {{ getFooter()->copyright }}
            </span>
        </p>
    </footer>
     <!-- Toast Alert -->
     <div aria-live="polite" aria-atomic="true" class="toast-wrapper d-flex flex-column align-items-end justify-content-center position-fixed">
        <div class="toast toast--success border-0 w-100" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i data-feather='check-square' class="toast-icon"></i>
                    <span class="toast-text ml-2" id="successMessage">
                    </span>
                </div>
                <button type="button" class="close" data-dismiss="toast" aria-label="close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
        </div>
        <div class="toast toast--error border-0 w-100" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-body d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <span class="novecologie-icon-close toast-icon"></span>
                    <span class="toast-text ml-2" id="errorMessage">

                    </span>
                </div>
                <button type="button" class="close" data-dismiss="toast" aria-label="close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('dashboard_assets/vendors/js/vendors.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    <script src="{{ asset('dashboard_assets/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: DataTable  JS-->
    <script src="{{ asset('dashboard_assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard_assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <!-- END:  DataTable JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('dashboard_assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('dashboard_assets/js/core/app.js') }}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('dashboard_assets/js/scripts/pages/app-email.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <!-- END: Page JS-->
    <!-- END: Theme JS-->


        {{-- Dark mode/Night mode --}}
        <script>
            $(document).ready(function(){
                $('#dark').click(function(){
                     $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{ route('theme.color') }}",
                            type: "GET",
                            success: function(data)
                            {
                            }
                        })


                });
            })

        </script>

        {{-- Toogle --}}
        <script>
            $(document).ready(function(){
                $('#toggle').click(function(){

                    // Ajax Setup
                     $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: "{{ route('theme.toggle') }}",
                            type: "GET",
                            success: function(data)
                            {
                            }
                        })


                });
            })

        </script>


    {{-- Data Table --}}
    <script>
        $(document).ready(function () {
            $('#data_table').DataTable();
        })
    </script>
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script>
        $(window).on('load',
            function () {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14
                    });
                }
            }
        )
    </script>

    @yield('js')

</body>

<!-- END: Body-->

</html>
