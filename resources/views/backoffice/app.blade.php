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

    <link rel="apple-touch-icon" href="{{ asset('uploads/new/setting')}}/{{ generalSetting()->favicon }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/new/setting')}}/{{ generalSetting()->favicon }}">
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
        href="{{ asset('dashboard_assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('dashboard_assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
    <!-- END: Vendor CSS-->



    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"  href="{{ asset('dashboard_assets/css/core/menu/menu-types/vertical-menu.css') }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/pages/app-email.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: DataTable CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <!-- END: DataTable CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    @stack('plugin-css')

    @yield('css')
    <style>
        .gap-15{
            gap: 15px;
        }
    </style>

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
                        {{-- <a class="dropdown-item" href="{{ route('profile.show') }}">
                            <i class="mr-50" data-feather="user"></i>{{ __('Profile') }}
                        </a> --}}
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
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('backoffice.dashboard') }}"><span
                            class="brand-logo">
                            <img src="{{ asset('uploads/new/setting') }}/{{ generalSetting()->dashboard_logo }}" alt="" width="40">
                        </span>
                        <h2 class="brand-text">Novecology</h2>
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
                    <a target="_blank" class="d-flex align-items-center" href="{{ route('new.home') }}">
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
                <li class="nav-item @yield('backofficeIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.dashboard') }}">
                        <i data-feather='users'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='briefcase'></i>
                        <span class="menu-title text-truncate" data-i18n="User">{{ __('Banner') }}</span>
                    </a>

                    <ul class="menu-content">

                        <li class="@yield('bannerIndex')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.banner.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('bannerCreate')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.banner.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item @yield('reviewForm')">
                    <a class="d-flex align-items-center" href="{{ route('review.index') }}">
                        <i data-feather='hash'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Review</span>
                    </a>
                </li>
                <li class="nav-item @yield('bannerform')">
                    <a class="d-flex align-items-center" href="{{ route('banner.form.index') }}">
                        <i data-feather='chrome'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">{{ __('Banner Form') }}</span>
                    </a>
                </li>
                <li class="nav-item @yield('ServiceFeature')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.feature.index') }}">
                        <i data-feather='life-buoy'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Fonctionnalité</span>
                    </a>
                </li>

                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='coffee'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Offres</span>
                    </a>

                    <ul class="menu-content">

                        <li class="@yield('offerCategory')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.offer.category')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">Catégorie</span>
                            </a>
                        </li>
                        <li class="@yield('offerIndex')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.offer.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('offerCreate')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.offer.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item @yield('AccompagnementIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.support.index') }}">
                        <i data-feather='rss'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Accompagnement</span>
                    </a>
                </li>
                <li class="nav-item @yield('renovationIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.renovation.index') }}">
                        <i data-feather='sunrise'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Projet de rénovation</span>
                    </a>
                </li>
                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='speaker'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Témoignage</span>
                    </a>

                    <ul class="menu-content">

                        <li class="@yield('testimonialInfo')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.testimonial.info')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">Info</span>
                            </a>
                        </li>
                        <li class="@yield('testimonialIndex')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.testimonial.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('testimonialCreate')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.testimonial.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='share-2'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Conseils</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('newsInfo')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.news.info')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">Info</span>
                            </a>
                        </li>
                        <li class="@yield('newsCategory')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.news.category')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">Catégorie</span>
                            </a>
                        </li>
                        <li class="@yield('newsIndex')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.news.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li>

                        <li class="@yield('newsCreate')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.news.create')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="Create">{{ __('Create') }}</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item @yield('auditEnergetiqueIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.audit-energetique.index') }}">
                        <i data-feather='at-sign'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Audit énergétique</span>
                    </a>
                </li>
                <li class="nav-item @yield('historyIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.history.index') }}">
                        <i data-feather='columns'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Notre histoire</span>
                    </a>
                </li>
                <li class="nav-item @yield('valueIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.value.index') }}">
                        <i data-feather='filter'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Nos valeurs</span>
                    </a>
                </li>
                <li class="nav-item has-sub" style="">
                    <a class="d-flex align-items-center " href="#">
                        <i data-feather='refresh-cw'></i>
                        <span class="menu-title text-truncate" data-i18n="User">Nos références</span>
                    </a>

                    <ul class="menu-content">
                        <li class="@yield('referenceInfo')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.reference.info')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">Info</span>
                            </a>
                        </li>
                        <li class="@yield('referenceCategory')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.reference.category')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">Catégorie</span>
                            </a>
                        </li>
                        <li class="@yield('referenceIndex')">
                            <a class="d-flex align-items-center" href="{{route('backoffice.reference.index')}}">
                                <i data-feather='chevron-right'></i>
                                <span class="menu-item text-truncate" data-i18n="List">{{ __('List') }}</span>
                            </a>
                        </li> 
                    </ul>
                </li>
                <li class="nav-item @yield('contactIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.contact.index') }}">
                        <i data-feather='gitlab'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Nous Contacter</span>
                    </a>
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
                
                <li class="nav-item @yield('DroitOpposition')">
                    <a class="d-flex align-items-center" href="{{ route('droit.opposition.index') }}">
                        <i data-feather='minimize-2'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">Droit d’opposition</span>
                    </a>
                </li>
                <li class="nav-item @yield('legalNotice')">
                    <a class="d-flex align-items-center" href="{{ route('legal.notice.index') }}">
                        <i data-feather='git-branch'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">MENTIONS LÉGALES</span>
                    </a>
                </li>
                <li class="nav-item @yield('cookiePolicy')">
                    <a class="d-flex align-items-center" href="{{ route('cookie.policy.index') }}">
                        <i data-feather='map'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">COOKIES</span>
                    </a>
                </li>
                <li class="nav-item @yield('privacyPolicy')">
                    <a class="d-flex align-items-center" href="{{ route('privacy.policy.index') }}">
                        <i data-feather='layers'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">CONFIDENTIALITÉ</span>
                    </a>
                </li>
                
                <li class="nav-item @yield('bandeauInformation')">
                    <a class="d-flex align-items-center" href="{{ route('bandeau-information.index') }}">
                        <i data-feather='bar-chart-2'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">BANDEAU D’INFORMATION</span>
                    </a>
                </li>
                
                <li class="nav-item @yield('settingIndex')">
                    <a class="d-flex align-items-center" href="{{ route('backoffice.settings.index') }}">
                        <i data-feather='settings'></i>
                        <span class="menu-title text-truncate" data-i18n="Chat">paramètres généraux</span>
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
                Copyright <?= date('Y') ?> , Novecology. All Rights Reserved.
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

    @stack('all_modals')
    <!-- END: Footer-->
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('dashboard_assets/vendors/js/vendors.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script> --}}
    <!-- END: Page JS-->
    <!-- END: Theme JS-->
    @stack('plugin-js')

    @yield('all-scripts')


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
