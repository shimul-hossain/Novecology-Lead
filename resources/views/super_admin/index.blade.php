@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Our Solution') }}
@endsection

{{-- Menu Active --}}
@section('index')
active
@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/app-assets/css/plugins/charts/chart-apex.css') }}">

    <style>
        /* Hide scrollbar for Chrome, Safari and Opera */
    .example::-webkit-scrollbar {
    display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .example {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    }
    </style>
    
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('superadmin.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<section id="dashboard-analytics" class="app-user-view">

    <div class="row match-height">
        <!-- Greetings Card starts -->
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-congratulations">
                <div class="card-body text-center">
                    {{-- {{ asset('dashboard_assets') }} --}}
                    <img src="{{ asset('dashboard_assets/images/elements/decore-left.png') }}" class="congratulations-img-left" alt="card-img-left" />
                    <img src="{{ asset('dashboard_assets/images/elements/decore-right.png') }}" class="congratulations-img-right" alt="card-img-right" />
                    <div class="avatar avatar-xl bg-primary shadow">
                        <div class="avatar-content">
                            <i data-feather="award" class="font-large-1"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <h1 class="mb-1 text-white">{{ __('Congratulations') }} {{ Auth::user()->name }}</h1>
                        {{-- <p class="card-text m-auto w-75">
                            You have done <strong>57.6%</strong> more sales today. Check your new badge in your profile.
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Greetings Card ends -->
    </div>

    <div class="row match-height">
        <!-- Subscribers Chart Card starts -->
        <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="users" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder mt-1">{{ $subs->count() }}</h2>
                    <p class="card-text">{{ __('Subscribers Gained') }}</p>
                </div>
                <div id="gained-chart"></div>
            </div>
        </div>
        <!-- Subscribers Chart Card ends -->

        <!-- Orders Chart Card starts -->
        <div class="col-xl-3 col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0">
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="package" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder mt-1">{{ array_sum($simulation) }}</h2>
                    <p class="card-text">{{ __('Simulation Request') }}</p>
                </div>
                <div id="order-chart"></div>
            </div>
        </div>
        <!-- Orders Chart Card ends -->

        <div class="col-xl-6 col-lg-6 col-md-12">
            <div class="card user-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-sm-6 d-flex flex-column justify-content-between border-container-lg">
                            <div class="user-avatar-section">
                                <div class="d-flex justify-content-start">
                                    {{-- <img class="img-fluid rounded" src="{{ asset('dashboard_assets/images/avatars/7.png') }}" height="104" width="104" alt="User avatar"> --}}
                                    <div class="d-flex flex-column ml-1">
                                        <div class="user-info mb-1">
                                            <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                                            <span class="card-text">{{ Auth::user()->email }}</span>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <a href="{{ url('user/profile') }}" class="btn btn-primary waves-effect waves-float waves-light">{{ __('Edit') }}</a>
                                            {{-- <button class="btn btn-outline-danger ml-1 waves-effect">Delete</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-right user-total-numbers mt-3">
                                <div class="d-flex align-items-center mr-2">
                                    <div class="color-box bg-light-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign text-primary"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">23.3k</h5>
                                        <small>{{ __('Monthly Sales') }}</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="color-box bg-light-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up text-success"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                                    </div>
                                    <div class="ml-1">
                                        <h5 class="mb-0">$99.87K</h5>
                                        <small>{{ __('Annual Profit') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-6 mt-2 mt-xl-0">
                            <div class="user-info-wrapper">
                                <div class="d-flex flex-wrap">
                                    <div class="user-info-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="card-text user-info-title font-weight-bold mb-0">{{ __('Name') }}:</span>
                                    </div>
                                    <p class="card-text mb-0">{{ Auth::user()->name }}</p>
                                </div>
                                {{-- <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check mr-1"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        <span class="card-text user-info-title font-weight-bold mb-0">Status:</span>
                                    </div>
                                    @if (Auth::user()->email_verified_at)
                                    <p class="card-text mb-0 text-success">Verified</p>
                                    @else
                                    <p class="card-text mb-0 text-warning">Not verfied</p>
                                    @endif
                                    
                                </div> --}}
                                <div class="d-flex flex-wrap my-50">
                                    <div class="user-info-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star mr-1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                        <span class="card-text user-info-title font-weight-bold mb-0">{{ __('Role') }}:</span>
                                    </div>
                                    <p class="card-text mb-0">{{ __('Super Admin') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row match-height">
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-browser-states">
                <div class="card-header">
                    <div>
                        <h4 class="card-title">Browser States</h4>
                        <p class="card-text font-small-2">Al Time</p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="browser-states">
                        <div class="media">
                            <img src="{{ asset('dashboard_assets/app-assets/images/icons/google-chrome.png') }}" class="rounded mr-1" height="30" alt="Google Chrome" />
                            <h6 class="align-self-center mb-0">Google Chrome</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">{{$browser['chrome']}}%</div>
                            <div id="browser-state-chart-primary"></div>
                        </div>
                    </div>
                    <div class="browser-states">
                        <div class="media">
                            <img src="{{ asset('dashboard_assets/app-assets/images/icons/mozila-firefox.png') }}" class="rounded mr-1" height="30" alt="Mozila Firefox" />
                            <h6 class="align-self-center mb-0">Mozila Firefox</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">{{$browser['firefox']}}%</div>
                            <div id="browser-state-chart-warning"></div>
                        </div>
                    </div>
                   <div class="browser-states">
                        <div class="media">
                            <img src="{{ asset('dashboard_assets/app-assets/images/icons/apple-safari.png') }}" class="rounded mr-1" height="30" alt="Apple Safari"/>

                            <h6 class="align-self-center mb-0">Apple Safari</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">{{$browser['safari']}}%</div>
                            <div id="browser-state-chart-secondary"></div>
                        </div>
                    </div>
                    <div class="browser-states">
                        <div class="media">
                            <img src="{{ asset('dashboard_assets/app-assets/images/icons/internet-explorer.png') }}" class="rounded mr-1" height="30" alt="Internet Explorer" />
                            <h6 class="align-self-center mb-0">Internet Explorer</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">{{$browser['internet']}}%</div>
                            <div id="browser-state-chart-info"></div>
                        </div>
                    </div>

                    <div class="browser-states">
                        <div class="media">
                            <img src="{{ asset('dashboard_assets/app-assets/images/icons/opera.png') }}" class="rounded mr-1" height="30" alt="Internet Explorer" />
                            <h6 class="align-self-center mb-0">Opera</h6>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-body-heading mr-1">{{$browser['opera']}}%</div>
                            <div id="browser-state-chart-danger"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-6 col-12 example" style="overflow-y:scroll; max-height: 432px !important">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h4 class="card-title">Most Visited Pages</h4>
                        <p class="card-text font-small-2">Al Time</p>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>URL</th>
                            <th>Visit Count</th>
                        </thead>
                        <tbody>

                            @foreach($top_pages as $item)
                            <tr>
                                <td>
                                    <a href="{{$item->url}}" target="_blank">
                                        {{$item->url}}
                                    </a>
                                </td>
                                <td>{{$item->count}}</td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</section>
@endsection

@section('js')

<script>
  var $avgSessionStrokeColor2 = '#ebf0f7';
  var $textHeadingColor = '#5e5873';
  var $white = '#fff';
  var $strokeColor = '#ebe9f1';

  var $gainedChart = document.querySelector('#gained-chart');
  var $orderChart = document.querySelector('#order-chart');
  var $avgSessionsChart = document.querySelector('#avg-sessions-chart');
  var $supportTrackerChart = document.querySelector('#support-trackers-chart');
  var $salesVisitChart = document.querySelector('#sales-visit-chart');

  var gainedChartOptions;
  var orderChartOptions;
  var avgSessionsChartOptions;
  var supportTrackerChartOptions;
  var salesVisitChartOptions;

  var gainedChart;
  var orderChart;
  var avgSessionsChart;
  var supportTrackerChart;
  var salesVisitChart;



    // Subscribed Gained Chart
  // ----------------------------------

  gainedChartOptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      }
    },
    colors: [window.colors.solid.primary],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [
      {
        name: 'Subscribers',
        data: @json($subscribe)
      }
    ],
    xaxis: {
      labels: {
        show: false
      },
      axisBorder: {
        show: false
      }
    },
    yaxis: [
      {
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: { left: 0, right: 0 }
      }
    ],
    tooltip: {
      x: { show: false }
    }
  };
  gainedChart = new ApexCharts($gainedChart, gainedChartOptions);
  gainedChart.render();


   // Order Received Chart
  // ----------------------------------

  orderChartOptions = {
    chart: {
      height: 100,
      type: 'area',
      toolbar: {
        show: false
      },
      sparkline: {
        enabled: true
      },
      grid: {
        show: false,
        padding: {
          left: 0,
          right: 0
        }
      }
    },
    colors: [window.colors.solid.warning],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 2.5
    },
    fill: {
      type: 'gradient',
      gradient: {
        shadeIntensity: 0.9,
        opacityFrom: 0.7,
        opacityTo: 0.5,
        stops: [0, 80, 100]
      }
    },
    series: [
      {
        name: 'Orders',
        data: @json($simulation)
      }
    ],
    xaxis: {
      labels: {
        show: false
      },
      axisBorder: {
        show: false
      }
    },
    yaxis: [
      {
        y: 0,
        offsetX: 0,
        offsetY: 0,
        padding: { left: 0, right: 0 }
      }
    ],
    tooltip: {
      x: { show: false }
    }
  };
  orderChart = new ApexCharts($orderChart, orderChartOptions);
  orderChart.render();

</script>
@endsection