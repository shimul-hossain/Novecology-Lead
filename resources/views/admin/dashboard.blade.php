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
@section('homeIndex')
active
@endsection

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/apexchart/css/apexcharts.min.css') }}">
    <style>
        .dashboard-card,
        .ticket-analytic-card
        {
            box-shadow: none !important;
        }
        .table {
            font-size: 14px;
        }
        .form-control {
            border-color: #dddddd;
        }
    </style>
@endpush


{{-- Main Content Part --}}
@section('content')
<section class="dashboard py-4">
    <div class="container">
        <div class="row match-height">
            <div class="col-12 d-flex flex-wrap py-3">
                <h1 class="dashboard-title mb-0">{{ __('Dashboard Analytics') }}</h1>
                <div class="dropdown dropdown--custom dropdown--dashboard-filter ml-auto">
                    <button class="primary-btn primary-btn--primary border-0 rounded px-4 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('Company Filter') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach ($company as $item)
                        @php
                            $exists = \App\Models\CRM\CompanyFilter::where('user_id', Auth::id())->where('company_id', $item->id)->exists();
                        @endphp
                        @if ($exists)
                        <a class="dropdown-item" href="javascript:void(0)"><span class="dropdown-item__icon"><i class="bi bi-check2"></i></span> {{ $item->company_name }}</a>
                        @else
                        <a class="dropdown-item" href="{{ route('filter.company', $item->id) }}"> {{ $item->company_name }}</a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="w-100">
                    <div class=" d-lg-flex align-items-center">
                        {{-- <h3 class="dashboard-card__header__title">{{ __('Statistics') }}</h3> --}}
                        <button type="button" class="btn btn-outline-primary shadow-none analytic-toggler" data-module="main_dashboard" data-status="{{ checkAnalyticTogger('main_dashboard')? 'hide':'show' }}">
                            @if(checkAnalyticTogger('main_dashboard'))
                                <i class="bi bi-eye-slash"></i>
                            @else
                                <i class="bi bi-eye"></i>
                            @endif
                        </button>
                        <div class="ml-auto">
                            <div class="row">
                                {{-- <div id="datePickerClear">

                                </div> --}}
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Start Date') }}</label>
                                        <input type="date" id="start_date" class="flatpickr flatpickr-input form-control shadow-none bg-transparent" placeholder="{{ __('dd-mm-yyyy') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('End Date') }}</label>
                                        <input type="date" id="end_date" class="flatpickr flatpickr-input form-control shadow-none bg-transparent" placeholder="{{ __('dd-mm-yyyy') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-auto mt-auto">
                                    <div class="form-group">
                                        <button type="button" id="filterButton" class="primary-btn primary-btn--primary border-0 rounded px-4">{{ __('Filter') }}</button>
                                    </div>
                                </div>
                                <div class="col-lg-auto mt-auto d-none" id="clearFilter">
                                    <div class="form-group">
                                        <button type="button"  id="filterButtonClear" class="secondary-btn border-0"> {{ __('Clear Filter') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="analytic-wrapper w-100" style="display: {{ checkAnalyticTogger('main_dashboard')? '':'none' }}">
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('Users') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="total__User">{{ $totalUsers->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--success">
                                    <i class="bi bi-bar-chart"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('Projects') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="total__Project">{{ $totalProjects->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--info">
                                    <i class="bi bi-people"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('Clients') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="total__Client">{{ $totalClients->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--danger">
                                    <i class="bi bi-bar-chart-steps"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('Leads') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="total__Lead">{{ $totalLeads->count() }}</h3>
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
                            <h3 id="clientCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $clientCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Clients') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Clients') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="client_chart_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
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
                                <i class="bi bi-bar-chart-steps"></i>
                            </div>
                            <h3 id="leadCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $leadCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Leads') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Leads') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button  id="lead_chart_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item lead_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item lead_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item lead_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item lead_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
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
                            <h3 id="projectCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $projectCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Projects') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Projects') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="project_chart_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
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
                            <div class="dashboard-card__header__icon dashboard-card__header__icon--danger">
                                <i class="bi bi-building"></i>
                            </div>
                            <h3 id="leadClientCount" class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $lead_percentage }} %</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Lead-Client') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Lead-Client State') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="lead_client_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 30 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item lead_client_state" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item lead_client_state" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item lead_client_state" data-value="last" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item lead_client_state" data-value="year" href="#">{{ __('Last Year') }}</a>
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
                        <h3 class="dashboard-card__header__title">{{ __('Latest Lead') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            <button id="leadListLabel" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 7 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item lead_list" data-value="7days" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item lead_list" data-value="today" href="#">{{ __('Today') }}</a>
                                <a class="dropdown-item lead_list" data-value="yesterday" href="#">{{ __('Yesterday') }}</a>
                                <a class="dropdown-item lead_list" data-value="week" href="#">{{ __('Last Week') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div class="dashboard-card__body simple-bar h-100">
                            <ul class="dashboard-list" id="leadListRender">
                               @include('admin.lead_list')
                                {{-- <li class="dashboard-list__item">
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
                                </li> --}}
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
                                <i class="bi bi-bar-chart-steps"></i>
                            </div>
                            <h3 class="dashboard-card__header__title dashboard-card__header__title--lg">{{ $lastThreeMonthleadCount }}</h3>
                            {{-- <p class="dashboard-card__header__text">{{ __('Leads') }}</p> --}}
                        </div>
                        <h3 class="dashboard-card__header__title mt-2">{{ __('Leads Overview') }}</h3>
                        {{-- <div class="dropdown dropdown--custom ml-auto">
                            <button class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 7 Days') }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">{{ __('Last 30 Days') }}</a>
                                <a class="dropdown-item" href="#">{{ __('Last Month') }}</a>
                                <a class="dropdown-item" href="#">{{ __('Last Year') }}</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="dashboard-card__body">
                        <div id="overviewChart"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h1 class="dashboard-title">{{ __('Project Details') }}</h1>
            </div>
            <div class="col-12">
                <div class="dashboard-card dashboard-card--min">
                    <div class="overflow-hidden h-100">
                        <div class="dashboard-card__body p-0 simple-bar h-100">
                            <table class="table table--dashboard no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Sl') }}</th>
                                        <th>{{ __('Project Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        <th>{{ __('Postal Code') }}</th>
                                        <th>{{ __('Status') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projectList as $project)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $project->project_name }}</td>
                                            <td>{{ $project->email??__('Not Provided') }}</td>
                                            <td>{{ $project->phone??__('Not Provided') }}</td>
                                            <td>{{ $project->postal_code??__('Not Provided') }}</td>
                                            <td>{{ $project->status ?? 'status unknown' }}</td>
                                            {{-- <td>{{ $project->getStatus->status ?? __('No Status') }}</td>  --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h1 class="dashboard-title">{{ __('Notion List') }}</h1>
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="dashboard-card">
                    <div class="dashboard-card__header d-flex">
                        <h3 class="dashboard-card__header__title">{{ __('Notion List') }}</h3>
                        <div class="dropdown dropdown--custom ml-auto">
                            {{-- <button id="leadListLabel" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Last 7 Days') }}
                            </button> --}}
                            {{-- <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item lead_list" data-value="7days" href="#">{{ __('Last 7 Days') }}</a>
                                <a class="dropdown-item lead_list" data-value="today" href="#">{{ __('Today') }}</a>
                                <a class="dropdown-item lead_list" data-value="yesterday" href="#">{{ __('Yesterday') }}</a>
                                <a class="dropdown-item lead_list" data-value="week" href="#">{{ __('Last Week') }}</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div class="dashboard-card__body simple-bar h-100">
                            <ul class="dashboard-list">
                                @foreach ($notions as $notion)
                                    <li class="dashboard-list__item">
                                        <div class="media media--warning">
                                            <div class="media-header rounded">
                                                <svg fill="#000000" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="35px" height="35px"><path d="M 31.494141 5.1503906 L 5.9277344 7.0019531 A 1.0001 1.0001 0 0 0 5.9042969 7.0039062 A 1.0001 1.0001 0 0 0 5.8652344 7.0097656 A 1.0001 1.0001 0 0 0 5.7929688 7.0214844 A 1.0001 1.0001 0 0 0 5.7636719 7.0292969 A 1.0001 1.0001 0 0 0 5.7304688 7.0371094 A 1.0001 1.0001 0 0 0 5.6582031 7.0605469 A 1.0001 1.0001 0 0 0 5.6113281 7.0800781 A 1.0001 1.0001 0 0 0 5.5839844 7.0917969 A 1.0001 1.0001 0 0 0 5.4335938 7.1777344 A 1.0001 1.0001 0 0 0 5.4082031 7.1933594 A 1.0001 1.0001 0 0 0 5.3476562 7.2421875 A 1.0001 1.0001 0 0 0 5.3359375 7.2539062 A 1.0001 1.0001 0 0 0 5.2871094 7.2988281 A 1.0001 1.0001 0 0 0 5.2578125 7.3320312 A 1.0001 1.0001 0 0 0 5.2148438 7.3828125 A 1.0001 1.0001 0 0 0 5.1992188 7.4023438 A 1.0001 1.0001 0 0 0 5.15625 7.4648438 A 1.0001 1.0001 0 0 0 5.1445312 7.484375 A 1.0001 1.0001 0 0 0 5.1074219 7.5488281 A 1.0001 1.0001 0 0 0 5.09375 7.5761719 A 1.0001 1.0001 0 0 0 5.0644531 7.6484375 A 1.0001 1.0001 0 0 0 5.0605469 7.65625 A 1.0001 1.0001 0 0 0 5.015625 7.8300781 A 1.0001 1.0001 0 0 0 5.0097656 7.8613281 A 1.0001 1.0001 0 0 0 5.0019531 7.9414062 A 1.0001 1.0001 0 0 0 5.0019531 7.9453125 A 1.0001 1.0001 0 0 0 5 8 L 5 33.738281 C 5 34.76391 5.3151542 35.766862 5.9042969 36.607422 A 1.0001 1.0001 0 0 0 5.953125 36.671875 L 12.126953 44.101562 A 1.0001 1.0001 0 0 0 12.359375 44.382812 L 12.75 44.851562 A 1.0006635 1.0006635 0 0 0 12.917969 45.011719 C 13.50508 45.581386 14.317167 45.917563 15.193359 45.861328 L 42.193359 44.119141 C 43.762433 44.017718 45 42.697027 45 41.125 L 45 15.132812 C 45 14.209354 44.565523 13.390672 43.904297 12.839844 A 1.0008168 1.0008168 0 0 0 43.748047 12.695312 L 43.263672 12.337891 A 1.0001 1.0001 0 0 0 43.0625 12.189453 L 34.824219 6.1132812 C 33.865071 5.4054876 32.682705 5.0641541 31.494141 5.1503906 z M 31.638672 7.1445312 C 32.352108 7.0927682 33.061867 7.29845 33.636719 7.7226562 L 39.767578 12.246094 L 14.742188 13.884766 C 13.880567 13.941006 13.037689 13.622196 12.425781 13.011719 L 12.423828 13.011719 L 8.2539062 8.8398438 L 31.638672 7.1445312 z M 7 10.414062 L 11.011719 14.425781 L 12 15.414062 L 12 40.818359 L 7.5390625 35.449219 C 7.1899317 34.947488 7 34.351269 7 33.738281 L 7 10.414062 z M 41.935547 14.134766 C 42.526748 14.096822 43 14.54116 43 15.132812 L 43 41.125 C 43 41.660973 42.59938 42.08847 42.064453 42.123047 L 15.064453 43.865234 C 14.770856 43.884078 14.506356 43.783483 14.314453 43.605469 A 1.0006635 1.0006635 0 0 0 14.3125 43.603516 C 14.3125 43.603516 14.310547 43.601562 14.310547 43.601562 C 14.306465 43.597733 14.304796 43.59179 14.300781 43.587891 A 1.0006635 1.0006635 0 0 0 14.289062 43.572266 C 14.112238 43.393435 14 43.149431 14 42.867188 L 14 16.875 C 14 16.337536 14.39999 15.911571 14.935547 15.876953 L 41.935547 14.134766 z M 38.496094 19 L 33.421875 19.28125 C 32.647875 19.36125 31.746094 19.938 31.746094 20.875 L 33.996094 21.0625 L 33.996094 31.753906 L 26.214844 19.751953 L 20.382812 20.080078 C 19.291812 20.160078 18.994141 20.970953 18.994141 22.001953 L 21.244141 22.001953 L 21.244141 37.566406 C 21.244141 37.566406 20.191844 37.850406 19.839844 37.941406 C 19.091844 38.134406 18.994141 38.784906 18.994141 39.253906 C 18.994141 39.253906 22.746656 39.065547 24.472656 38.935547 C 26.431656 38.785547 26.496094 37.472656 26.496094 37.472656 L 24.246094 37.003906 L 24.246094 25.470703 C 24.246094 25.470703 29.965844 34.660328 31.714844 37.361328 C 32.537844 38.630328 33.152375 38.878906 34.234375 38.878906 C 35.122375 38.878906 35.962141 38.616594 36.994141 38.058594 L 36.994141 20.697266 C 36.994141 20.697266 37.184203 20.687141 37.783203 20.494141 C 38.466203 20.273141 38.496094 19.656 38.496094 19 z"/></svg>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-body__title font-weight-normal"><a href="{{ route('notion.details', $notion->id) }}">{{ $notion->title }}</a></h4>
                                                <p class="media-body__sub-title d-flex">
                                                    {{ $notion->createdBy->name }}
                                                    <span class="text-secondary font-weight-bold ml-auto">{{ \Carbon\Carbon::parse($notion->created_at)->diffForHumans() }}</span>
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
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
                name: 'Clients',
                data: @json($clients),
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
                name: 'Leads',
                data: @json($leads)
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

    let leadClientChartOptions = {
        series: [
            {
                name: 'Leads',
                data: @json($leadsWithConvert)
            },
            {
                name: ' Clients',
                data: @json($clients)
            }
        ],
        chart: {
            id: 'leadClientChart',
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
            categories: @json($days),
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
            // categories: [
            //     '5000', '4000', '6000', '3000', '7000', '2000', '8000', '1000', '9000', '1500', '1200', '1900'
            // ],
            labels: {
                formatter: (value)=> value + ""
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
                data: @json($projects),
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
        labels: @json($lastThreeMonth),
        series: @json($lastThreeMonthlead),
        plotOptions: {
            radialBar: {
                dataLabels: {
                    value: {
                        formatter: function (val) {
                            return val + ''
                        }
                    },
                    total: {
                        show: true,
                        label: 'Overview',
                        formatter: function (w) {
                            return `{{ $lastThreeMonthleadCount }}`;
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
        // eachApexChartsCallFunction("#productsChart", productsChartOptions);
        // eachApexChartsCallFunction("#revenueChart", revenueChartOptions);
        eachApexChartsCallFunction("#overviewChart", overviewChartOptions);

        var clientChart = new ApexCharts(document.querySelector("#clientsChart"), clientsChartOptions);
        clientChart.render();
        var projectsChart = new ApexCharts(document.querySelector("#projectsChart"), projectsChartOptions);
        projectsChart.render();
        var leadChart = new ApexCharts(document.querySelector("#productsChart"), productsChartOptions);
        leadChart.render();
        var leadClientChart = new ApexCharts(document.querySelector("#revenueChart"), leadClientChartOptions);
        leadClientChart.render();

        $(".flatpickr").flatpickr({
			altInput: true,
			altFormat: "d-m-Y",
			dateFormat: "Y-m-d",
		});

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.project_chart').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('chart.project.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    console.log(label);
                    $("#project_chart_label").text(label);
                    $("#projectCount").text(response.count);
                    projectsChart.updateSeries([{
                        data: response.data,
                    }]);
                },
            });
        });
        $('.client_chart').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('chart.client.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#client_chart_label").text(label);
                    $("#clientCount").text(response.count);
                    clientChart.updateSeries([{
                        data: response.data,
                    }]);
                },
            });
        });
        $('.lead_chart').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('chart.lead.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    console.log(label);
                    $("#lead_chart_label").text(label);
                    $("#leadCount").text(response.count);

                    leadChart.updateSeries([{
                        data: response.data,
                    }]);
                },
            });
        });
        $('.lead_list').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('lead.filter.list') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#leadListLabel").text(label);
                    $("#leadListRender").html(response);
                },
            });
        });
        $('.lead_client_state').click(function(e){
            e.preventDefault();
            var label = $(this).text();
            $.ajax({
                url : "{{ route('lead.client.filter') }}",
                method : 'post',
                data : {
                    value : $(this).attr('data-value'),
                },
                success: function (response) {
                    $("#lead_client_label").text(label);
                    $("#leadClientCount").text(response.percentage + ' %');
                    ApexCharts.exec("leadClientChart", "updateOptions", {
                        series: [
                            {
                                data: response.lead,
                            },
                            {
                                data: response.client,
                            }
                        ],
                        xaxis: {
                            categories: response.label,
                        }
                    });
                },
            });
        });

        $('#filterButton').click(function(e){
            e.preventDefault();
            var from = $('#start_date').val();
            var to = $('#end_date').val();
            if(from){
                $.ajax({
                    url : "{{ route('dashboard.filter') }}",
                    method : 'post',
                    data : {
                        from : from,
                        to : to,
                    },
                    success: function (response) {
                       $('#total__User').text(response.users);
                       $('#total__Project').text(response.projects);
                       $('#total__Client').text(response.clients);
                       $('#total__Lead').text(response.leads);
                       $('#clearFilter').removeClass('d-none');
                    },
                });
            }else{
                $('#errorMessage').text("{{ __('please select start date first') }}");
				$('.toast.toast--error').toast('show');
            }
        });

        $('#filterButtonClear').click(function(e){
            e.preventDefault();
            $('#start_date').val('');
            $('#end_date').val('');
            $.ajax({
                url : "{{ route('dashboard.filter.clear') }}",
                method : 'post',
                success: function (response) {
                    $('#total__User').text(response.users);
                    $('#total__Project').text(response.projects);
                    $('#total__Client').text(response.clients);
                    $('#total__Lead').text(response.leads);
                    $('#clearFilter').addClass('d-none');
                    $(".flatpickr").flatpickr({
                        altInput: true,
                        altFormat: "d-m-Y",
                        dateFormat: "Y-m-d",
                    });
                },
            });
        });

        /* Analytic Cards Toggler Function */
        $(".analytic-toggler").on("click", function(){
            let status = $(this).data('status');
            let module = $(this).data('module');
            $(".analytic-wrapper").slideToggle();
            if(status == 'hide'){
                $(this).data('status', 'show');
                $(this).html('<i class="bi bi-eye"></i>')
            }else{
                $(this).data('status', 'hide');
                $(this).html('<i class="bi bi-eye-slash"></i>')
            }
            $.ajax({
                type : "POST",
                url  : "{{ route('analytic.toggler.update') }}",
                data : {status, module},
                success: (response)=>{
                    console.log(response);
                },
                error : (error)=> {
                    console.log(error);
                }

            });
        });

    });
</script>
@endpush
