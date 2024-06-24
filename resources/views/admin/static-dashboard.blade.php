{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Dashboard Analytic') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection

{{-- active menu --}}
@section('dashboardAnalytic')
active
@endsection

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/apexchart/css/apexcharts.min.css') }}">
@endpush
 

{{-- Main Content Part  --}}
@section('content')
<section class="dashboard position-relative py-4">
    <div class="dashboard__overlay position-absolute d-flex align-items-start justify-content-center w-100 h-100">
        <div class="dashboard__overlay__form-wrapper d-flex">
            <form action="{{ route('compnay.filter') }}" method="post" class="form dashboard__overlay__form w-100">
                @csrf
                <div class="form-group">
                    <label class="form-label">{{ __('Select Company') }}</label>
                    <select class="form-control custom-select shadow-none" name="company_id">
                        @foreach ($company as $item)
                        <option value="{{ $item->id }}">{{ $item->company_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="dashboard__content">
        <div class="container">
            <div class="row match-height">
                <div class="col-12 d-flex flex-wrap py-3">
                    <h1 class="dashboard-title mb-0">{{ __('Dashboard Analytics') }}</h1>
                    <div class="dropdown dropdown--custom ml-auto">
                        <button class="secondary-btn border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Company Filter') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                             
                            <a class="dropdown-item" href="#!">company 1</a>
                            <a class="dropdown-item" href="#!">company 2
    
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="dashboard-card dashboard-card--auto">
                        <div class="dashboard-card__header d-lg-flex">
                            <h3 class="dashboard-card__header__title">{{ __('Statistics') }}</h3>
                            <div class="ml-auto">
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Start Date') }}</label>
                                            <input type="date" id="start_date" class="flatpickr flatpickr-input form-control shadow-none bg-transparent" placeholder="{{ __('dd-mm-yyyy') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('End Date') }}</label>
                                            <input type="date" class="flatpickr flatpickr-input form-control shadow-none bg-transparent" placeholder="{{ __('dd-mm-yyyy') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-auto mt-auto">
                                        <div class="form-group">
                                            <button type="button" class="secondary-btn border-0">{{ __('Filter') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-card__body">
                            <div class="row">
                                <div class="col-lg col-md-3 col-sm-6">
                                    <div class="media">
                                        <div class="media-header rounded-circle">
                                            <i class="bi bi-graph-up-arrow"></i>
                                        </div>
                                        <div class="media-body">
                                          <h4 class="media-body__title">230k</h4>
                                          <p class="media-body__sub-title">{{ __('Sales') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg col-md-3 col-sm-6">
                                    <div class="media media--warning">
                                        <div class="media-header rounded-circle">
                                            <i class="bi bi-bar-chart"></i>
                                        </div>
                                        <div class="media-body">
                                          <h4 class="media-body__title">230k</h4>
                                          <p class="media-body__sub-title">{{ __('Projects') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg col-md-3 col-sm-6">
                                    <div class="media media--info">
                                        <div class="media-header rounded-circle">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="media-body">
                                          <h4 class="media-body__title">230k</h4>
                                          <p class="media-body__sub-title">{{ __('Clients') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg col-md-3 col-sm-6">
                                    <div class="media media--danger">
                                        <div class="media-header rounded-circle">
                                            <i class="bi bi-cart3"></i>
                                        </div>
                                        <div class="media-body">
                                          <h4 class="media-body__title">1.423k</h4>
                                          <p class="media-body__sub-title">{{ __('Products') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg col-md-3 col-sm-6">
                                    <div class="media media--success">
                                        <div class="media-header rounded-circle">
                                            <i class="bi bi-currency-dollar"></i>
                                        </div>
                                        <div class="media-body">
                                          <h4 class="media-body__title">$9745</h4>
                                          <p class="media-body__sub-title">{{ __('Revenue') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header d-flex">
                            <div>
                                <div class="dashboard-card__header__icon dashboard-card__header__icon--info">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg">230k</h3>
                                <p class="dashboard-card__header__text">{{ __('Clients') }}</p>
                            </div>
                            <div class="dropdown dropdown--custom ml-auto">
                                <button id="client_chart_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Last 7 Days') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item client_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                    <a class="dropdown-item client_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                    <a class="dropdown-item client_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                    <a class="dropdown-item client_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-card__body p-0">
                            <div id="clientsChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header d-flex">
                            <div>
                                <div class="dashboard-card__header__icon dashboard-card__header__icon--danger">
                                    <i class="bi bi-cart3"></i>
                                </div>
                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg">1.423k</h3>
                                <p class="dashboard-card__header__text">{{ __('Products') }}</p>
                            </div>
                            <div class="dropdown dropdown--custom ml-auto">
                                <button class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Last 7 Days') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">{{ __('Last 30 Days') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Month') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Year') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-card__body p-0">
                            <div id="productsChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header d-flex">
                            <div>
                                <div class="dashboard-card__header__icon dashboard-card__header__icon--warning">
                                    <i class="bi bi-bar-chart"></i>
                                </div>
                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg">230k</h3>
                                <p class="dashboard-card__header__text">{{ __('Projects') }}</p>
                            </div>
                            <div class="dropdown dropdown--custom ml-auto">
                                <button id="project_chart_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Last 7 Days') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item project_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                    <a class="dropdown-item project_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                    <a class="dropdown-item project_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                    <a class="dropdown-item project_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-card__body p-0">
                            <div id="projectsChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header d-flex">
                            <div>
                                <div class="dashboard-card__header__icon dashboard-card__header__icon--success">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg">$9745</h3>
                                <p class="dashboard-card__header__text">{{ __('Revenue') }}</p>
                            </div>
                            <div class="dropdown dropdown--custom ml-auto">
                                <button class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Last 7 Days') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">{{ __('Last 30 Days') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Month') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Year') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-card__body px-2">
                            <div id="revenueChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header d-flex">
                            <h3 class="dashboard-card__header__title">{{ __('Project Type') }}</h3>
                            <div class="dropdown dropdown--custom ml-auto">
                                <button class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Last 7 Days') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">{{ __('Last 30 Days') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Month') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Year') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-hidden">
                            <div class="dashboard-card__body simple-bar h-100">
                                <ul class="dashboard-list">
                                    <li class="dashboard-list__item">
                                        <div class="media media--danger">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H2
                                                    <span class="text-danger font-weight-bold ml-auto">- $1000</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dashboard-list__item">
                                        <div class="media media--info">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H1
                                                    <span class="text-success font-weight-bold ml-auto">+ $1500</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dashboard-list__item">
                                        <div class="media media--success">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H3
                                                    <span class="text-success font-weight-bold ml-auto">- $1500</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dashboard-list__item">
                                        <div class="media media--warning">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H4
                                                    <span class="text-success font-weight-bold ml-auto">+ $1500</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dashboard-list__item">
                                        <div class="media media--danger">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H2
                                                    <span class="text-danger font-weight-bold ml-auto">- $1000</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dashboard-list__item">
                                        <div class="media media--info">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H1
                                                    <span class="text-success font-weight-bold ml-auto">+ $1500</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dashboard-list__item">
                                        <div class="media media--success">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H3
                                                    <span class="text-success font-weight-bold ml-auto">- $1500</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dashboard-list__item">
                                        <div class="media media--warning">
                                            <div class="media-header rounded">
                                                <i class="bi bi-bar-chart"></i>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal">Lozère</h4>
                                                <p class="media-body__sub-title d-flex">
                                                    H4
                                                    <span class="text-success font-weight-bold ml-auto">+ $1500</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="dashboard-card">
                        <div class="dashboard-card__header d-flex">
                            <div>
                                <div class="dashboard-card__header__icon dashboard-card__header__icon--success">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <h3 class="dashboard-card__header__title dashboard-card__header__title--lg">786,617</h3>
                                <p class="dashboard-card__header__text">{{ __('Overview') }}</p>
                            </div>
                            <div class="dropdown dropdown--custom ml-auto">
                                <button class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Last 7 Days') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">{{ __('Last 30 Days') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Month') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Last Year') }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-card__body">
                            <div id="overviewChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="dashboard-card dashboard-card--min">
                        <div class="overflow-hidden h-100">
                            <div class="dashboard-card__body p-0 simple-bar h-100">
                                <table class="table table--dashboard no-wrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Project Name</th>
                                            <th>Price HT</th>
                                            <th>Price TTC</th>
                                            <th>TAX</th>
                                            <th>Tags</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Noveco</td>
                                            <td>€1200</td>
                                            <td>€1210</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€10</span>
                                            </td>
                                            <td>Pas de statut</td>
                                            <td class="text-success">
                                                <i class="bi bi-graph-up-arrow"></i>
                                                60%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>SoClose</td>
                                            <td>€1300</td>
                                            <td>€1320</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€20</span>
                                            </td>
                                            <td>Test</td>
                                            <td class="text-danger">
                                                <i class="bi bi-graph-down-arrow"></i>
                                                10%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Noveco</td>
                                            <td>€1200</td>
                                            <td>€1210</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€10</span>
                                            </td>
                                            <td>Pas de statut</td>
                                            <td class="text-success">
                                                <i class="bi bi-graph-up-arrow"></i>
                                                60%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>SoClose</td>
                                            <td>€1300</td>
                                            <td>€1320</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€20</span>
                                            </td>
                                            <td>Test</td>
                                            <td class="text-danger">
                                                <i class="bi bi-graph-down-arrow"></i>
                                                10%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Noveco</td>
                                            <td>€1200</td>
                                            <td>€1210</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€10</span>
                                            </td>
                                            <td>Pas de statut</td>
                                            <td class="text-success">
                                                <i class="bi bi-graph-up-arrow"></i>
                                                60%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>SoClose</td>
                                            <td>€1300</td>
                                            <td>€1320</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€20</span>
                                            </td>
                                            <td>Test</td>
                                            <td class="text-danger">
                                                <i class="bi bi-graph-down-arrow"></i>
                                                10%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>Noveco</td>
                                            <td>€1200</td>
                                            <td>€1210</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€10</span>
                                            </td>
                                            <td>Pas de statut</td>
                                            <td class="text-success">
                                                <i class="bi bi-graph-up-arrow"></i>
                                                60%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>SoClose</td>
                                            <td>€1300</td>
                                            <td>€1320</td>
                                            <td>
                                                <span class="badge-btn badge-btn--danger rounded-pill">€20</span>
                                            </td>
                                            <td>Test</td>
                                            <td class="text-danger">
                                                <i class="bi bi-graph-down-arrow"></i>
                                                10%
                                            </td>
                                            <td>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn btn-sm shadow-none dropdown-toggle text-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-eye"></i>
                                                            <span class="dropdown-item__text pl-1">Details</span>
                                                        </a>
                                                        <a href="#!" class="dropdown-item">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span class="dropdown-item__text pl-1">Edit</span>
                                                        </a>
                                                        <button type="button" class="dropdown-item">
                                                            <i class="bi bi-trash"></i>
                                                            <span class="dropdown-item__text pl-1">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/apexchart/js/apexcharts.min.js') }}"></script>
@endpush

@push('js')
<script>
    function eachApexChartsCallFunction(selector, option){
        return new ApexCharts(document.querySelector(selector), option).render();
    };

    let colorWarning = "#FF9F43";
    let colorDanger = "#EA5455";
    let colorSuccess = "#28C76F";
    let colorInfo = "#00CFE8";
    let colorPurple = "#7367F0";

    let commonChartOptions = {
        legend: {
            position: 'top',
            showForSingleSeries: true,
            horizontalAlign: 'left',
            floating: true,
        },
        grid: {
            show: false,
            padding: {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0
            },
            // xaxis: {
            //     lines: {
            //         show: false
            //     },
            //     tick: {
            //         show: false
            //     },
            // },
            // yaxis: {
            //     lines: {
            //         show: false
            //     },
            //     tick: {
            //         show: false
            //     },
            // },
        },
        tooltip: {
            // enabled: false,
            x: {
                show: false,
            },
        },
        dataLabels: {
            enabled: false,
        },
    };

    let clientsChartOptions = {
        series: [
            {
                name: 'Custom Name 1',
                data: [31, 40, 28, 51, 42, 109, 100,11, 32, 45, 32, 34, 52, 41],
            },
            {
                name: 'Custom Name 2',
                data: [11, 32, 45, 32, 34, 52, 41,11, 32, 45, 32, 34, 52, 41],
            }
        ],
        chart: {
            type: 'area',
            height: 250,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        colors: [colorInfo, colorPurple],
        fill: {
            gradient: {
                enabled: true,
                opacityFrom: 0.55,
                opacityTo: 0.25,
            },
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            floating: true,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            // crosshairs: {
            //     show: false,
            // },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            show: false,
        },
        ...commonChartOptions,       
    };

    let productsChartOptions = {
        series: [
            {
                name: 'Products',
                data: [31, 40, 28, 51, 42, 109, 100]
            }
        ],
        chart: {
            type: 'area',
            height: 250,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        colors: [colorDanger],
        fill: {
            gradient: {
                enabled: true,
                opacityFrom: 0.55,
                opacityTo: 0.25,
            },
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            floating: true,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: (value)=> value + " Unit"
            },
        },
        ...commonChartOptions,
    }; 

    let revenueChartOptions = {
        series: [
            {
                name: 'Earning',
                data: [5000, 4000, 6000, 3000, 7000, 2000, 8000, 1000, 9000, 1500, 1200, 1900]
            },
            {
                name: 'Expense',
                data: [-4000, -6000, -3000, -1000, -4000, -5000, -3300, -500, -2500, -300, -9000, -5000]
            }
        ],
        chart: {
            type: 'bar',
            height: 250,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        plotOptions: {
          bar: {
            borderRadius: 5,
            columnWidth: '50%',
          }
        },
        colors: ["#7367F0", colorWarning],
        stroke: {
            curve: 'smooth'
        },
        legend: {
            position: 'top',
            showForSingleSeries: true,
            horizontalAlign: 'left',
        },
        dataLabels: {
            enabled: false,
        },
        xaxis: {
            categories: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            categories: [
                '5000', '4000', '6000', '3000', '7000', '2000', '8000', '1000', '9000', '1500', '1200', '1900'
            ],
            labels: {
                formatter: (value)=> value + " $"
            },
        },
        grid: {
            show: false,
            padding: {
                top: 0,
                bottom: 0,
                left: 0,
                right: 0
            },
        },
        tooltip: {
            x: {
                show: false,
            },
        },
    };

    let projectsChartOptions = {
        series: [
            {
                name: 'Projects',
                data: [11,22,33,44,555],
            }
        ],
        chart: {
            type: 'bar',
            height: 250,
            parentHeightOffset: 0,
            offsetY: 5,
            toolbar: {
                show: false,
            },
            sparkline: {
                enabled: false,
            },
        },
        plotOptions: {
        bar: {
            borderRadius: 3,
        }
        },
        colors: [colorWarning],
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            floating: true,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false,
            },
            tooltip: {
                enabled: false,
            },
        },
        yaxis: {
            show: false,
            labels: {
                formatter: (value)=> value + ""
            },
        },
       ...commonChartOptions, 
    };

    let overviewChartOptions = {
        labels: ['Jan', 'Jun', 'Dec'],
        series: [15, 30, 100],
        plotOptions: {
            radialBar: {
                dataLabels: {
                    total: {
                        show: true,
                        label: 'Overview',
                        formatter: function (w) {
                            return Math.round(w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0) / w.globals.series.length) + '%'
                        },
                    }
                },
            },
        },
        chart: {
            height: 300,
            type: 'radialBar',
        },
        legend: {
            show: true,
            position: 'bottom',
            showForSingleSeries: true,
            horizontalAlign: 'center',
        },
        stroke: {
            lineCap: "round",
        },
        colors: [colorWarning, colorPurple, colorSuccess],
    };

    $(document).ready(function () {
        // eachApexChartsCallFunction("#clientsChart", clientsChartOptions);
        eachApexChartsCallFunction("#productsChart", productsChartOptions);
        eachApexChartsCallFunction("#revenueChart", revenueChartOptions);
        eachApexChartsCallFunction("#overviewChart", overviewChartOptions);

        var clientChart = new ApexCharts(document.querySelector("#clientsChart"), clientsChartOptions);
        clientChart.render();
        var projectsChart = new ApexCharts(document.querySelector("#projectsChart"), projectsChartOptions);
        projectsChart.render();

        $(".flatpickr").flatpickr({
			altInput: true,
			altFormat: "d-m-Y",
			dateFormat: "Y-m-d",
		});
 
    });
</script> 
@endpush
 