@extends('layouts.master')


{{-- Title part  --}}
@section('title')
    Tickets 
@endsection

@section('bodyBg')
secondary-bg
@endsection

@section('ticketing')
active
@endsection

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/apexchart/css/apexcharts.min.css') }}">
    <style>
        .form-control {
            border-color: #dddddd;
        }
    </style>
@endpush


{{-- Main content part  --}}
@section('content')
    <!-- Ticketing Section -->
    <section class="ticket-section">
        <div class="container-fluid">
            <div class="ticket-section-container">
                <div class="row">
                    {{-- <div class="col-12 d-flex flex-row-reverse align-item-center flex-wrap py-3">
                        <div class="ml-auto mb-1">
                            @if (checkAction(Auth::id(), 'ticketing', 'create') || role() == 's_admin')
                                <button type="button" class="ticket-main__chat-card__send-btn" data-toggle="modal" data-target="#createTicketModal">
                                    <i class="bi bi-plus-square-dotted"></i>
                                    <span class="pl-1">{{ __('Create New Ticket') }}</span>
                                </button>
                            @else
                                <button type="button" class="ticket-main__chat-card__send-btn">
                                    <span class="novecologie-icon-lock py-1"></span>
                                    <span class="pl-1">{{ __('Create New Ticket') }}</span>
                                </button>
                            @endif
                        </div>
                        <h1 class="dashboard-title mr-auto mb-1">{{ __('Ticket Analytics') }}</h1>
                    </div> --}}
                    <div class="col-12">
                        <div class="w-100">
                            <div class="d-lg-flex flex-wrap align-items-center">
                                {{-- <button type="button" class="btn btn-outline-primary shadow-none analytic-toggler" data-module="ticketing" data-status="{{ checkAnalyticTogger('ticketing')? 'hide':'show' }}">
                                    @if(checkAnalyticTogger('ticketing'))
                                        <i class="bi bi-eye-slash"></i>
                                    @else
                                        <i class="bi bi-eye"></i>
                                    @endif
                                </button> --}}
                                <h1 class="dashboard-title mr-auto">{{ __('Ticket Analytics') }}</h1>
                                <div>
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('Start Date') }}</label>
                                                <input type="date" id="start_date" class="flatpickr flatpickr-input form-control shadow-none" placeholder="{{ __('dd-mm-yyyy') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-group">
                                                <label class="form-label">{{ __('End Date') }}</label>
                                                <input type="date" id="end_date" class="flatpickr flatpickr-input form-control shadow-none" placeholder="{{ __('dd-mm-yyyy') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto mt-auto">
                                            <div class="form-group">
                                                <button type="button" id="filterButton" class="secondary-btn border-0">{{ __('Filter') }}</button>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto mt-auto d-none" id="clearFilter">
                                            <div class="form-group">
                                                <button type="button" id="filterButtonClear" class="secondary-btn border-0"> {{ __('Clear Filter') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- style="display: {{ checkAnalyticTogger('ticketing')? '':'none' }}" --}}
                <div class="analytic-wrapper">
                    <div class="row row-cols-xl-4 row-cols-lg-3 row-cols-sm-2 row-cols-1">
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon">
                                    <i class="bi bi-ticket-perforated-fill"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('Total Ticket') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="totalTicketCount">{{ $tickets->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--info">
                                    <i class="bi bi-ticket-detailed-fill"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('viewed Ticket') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="viewedTicketCount">{{ $view_count }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--success">
                                    <i class="bi bi-ticket-fill"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('Open Ticket') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="openTicketCount">{{ $tickets->whereNull('close_at')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="ticket-analytic-card">
                                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--danger">
                                    <i class="bi bi-ticket"></i>
                                </div>
                                <div class="ticket-analytic-card__content">
                                    <h4 class="ticket-analytic-card__content__sub-title">{{ __('Closed Ticket') }}</h4>
                                    <h3 class="ticket-analytic-card__content__title" id="closedTicketCount">{{ $tickets->whereNotNull('close_at')->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row match-height">
                    <div class="col-xl-4 col-lg-6">
                        <div class="dashboard-card">
                            <div class="dashboard-card__header d-flex">
                                <h3 class="dashboard-card__header__title">{{ __('Ticket Type') }}</h3>
                                <div class="dropdown dropdown--custom ml-auto">
                                    <button id="ticket_type_chart_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Last 30 Days') }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item ticket_type_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                        <a class="dropdown-item ticket_type_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                        <a class="dropdown-item ticket_type_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                        <a class="dropdown-item ticket_type_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-card__body p-0  mt-auto">
                                <div id="ticketTypeChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="dashboard-card">
                            <div class="dashboard-card__header d-flex">
                                <h3 class="dashboard-card__header__title">{{ __('Ticket Status') }}</h3>
                                <div class="dropdown dropdown--custom ml-auto">
                                    <button id="ticket_status_chart_label" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Last 30 Days') }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item ticket_status_chart" data-value="7" href="#">{{ __('Last 7 Days') }}</a>
                                        <a class="dropdown-item ticket_status_chart" data-value="this" href="#">{{ __('Last 30 Days') }}</a>
                                        <a class="dropdown-item ticket_status_chart" data-value="last" href="#">{{ __('Last Month') }}</a>
                                        <a class="dropdown-item ticket_status_chart" data-value="year" href="#">{{ __('Last Year') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard-card__body p-0 mt-auto">
                                <div id="ticketStatusChart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="dashboard-card">
                            <div class="dashboard-card__header d-flex">
                                <h3 class="dashboard-card__header__title">{{ __('Best Assignee') }}</h3>
                                <div class="dropdown dropdown--custom ml-auto">
                                    <button id="AssigneListLabel" class="btn btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Tout
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item best_assigne_ticket" data-value="all" href="#">Tout</a>
                                        <a class="dropdown-item best_assigne_ticket" data-value="Administratif" href="#">Administratif</a>
                                        <a class="dropdown-item best_assigne_ticket" data-value="Technique" href="#">Technique</a>
                                        <a class="dropdown-item best_assigne_ticket" data-value="Financier" href="#">Financier</a>
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-hidden">
                                <div class="dashboard-card__body simple-bar h-100">
                                    <ul class="dashboard-list" id="assignListWrap">
                                        @include('admin.ticket_assigne_list')
                                    </ul>
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



        $(document).ready(function () {

            $("#filterButton").click(function(){
                var from = $('#start_date').val();
                var to = $('#end_date').val();

                if(from){
                    $.ajax({
                        url : "{{ route('ticket.date.filter') }}",
                        method : 'post',
                        data : {
                            from : from,
                            to : to,
                        },
                        success: function (response) {
                        $('#totalTicketCount').text(response.total);
                        $('#openTicketCount').text(response.open);
                        $('#closedTicketCount').text(response.close);
                        $('#viewedTicketCount').text(response.viewed);
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
                    url : "{{ route('ticket.date.filter.clear') }}",
                    method : 'post',
                    success: function (response) {
                        $('#totalTicketCount').text(response.total);
                        $('#openTicketCount').text(response.open);
                        $('#closedTicketCount').text(response.close);
                        $('#viewedTicketCount').text(response.viewed);
                        $('#clearFilter').addClass('d-none');
                        $(".flatpickr").flatpickr({
                            altInput: true,
                            altFormat: "d-m-Y",
                            dateFormat: "Y-m-d",
                        });
                    },
                });
            });

            $(document).on("click", ".best_assigne_ticket", function(e){

                e.preventDefault();
                var label = $(this).text();

                $.ajax({
                    url : "{{ route('ticket.assign.list.filter') }}",
                    method : 'post',
                    data : {
                        value : $(this).attr('data-value'),
                    },
                    success: function (response) {
                        $("#AssigneListLabel").text(label);
                        $("#assignListWrap").html(response);
                    },
                });
            });
            $(document).on("click", ".ticket_type_chart", function(e){

                e.preventDefault();
                var label = $(this).text();

                $.ajax({
                    url : "{{ route('ticket.type.chart.filter') }}",
                    method : 'post',
                    data : {
                        value : $(this).attr('data-value'),
                    },
                    success: function (response) {
                        $("#ticket_type_chart_label").text(label);
                        ApexCharts.exec("ticketTypeChart", "updateOptions", {
                            series: [
                                {
                                    data: response.admnistrative,
                                },
                                {
                                    data: response.technique,
                                },
                                {
                                    data: response.financier,
                                }

                            ],
                            xaxis: {
                                categories: response.label,
                            }
                        });
                    },
                });
            });
            $(document).on("click", ".ticket_status_chart", function(e){

                e.preventDefault();
                var label = $(this).text();

                $.ajax({
                    url : "{{ route('ticket.status.chart.filter') }}",
                    method : 'post',
                    data : {
                        value : $(this).attr('data-value'),
                    },
                    success: function (response) {
                        $("#ticket_status_chart_label").text(label); 
                        ApexCharts.exec("ticketStatusChart", "updateOptions", {
                            series: [
                                {
                                    data: response.total_ticket,
                                },
                                {
                                    data: response.open_ticket,
                                },
                                {
                                    data: response.closed_ticket,
                                }
                            ]
                        });
                    },
                });
            });

            $('#ticketStatus').change(function(){
                $('#ticketDeadline').val($(this).find(':selected').data('deadline'));
            });
        });

        /* Apex Charts Short Call Function */
        function eachApexChartsCallFunction(selector, option){
            return new ApexCharts(document.querySelector(selector), option);
        };

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

        let ticketTypeChartOptions = {
            series: [
                {
                    name: 'Administratif',
                    data: @json($admnistrative)
                },
                {
                    name: ' Technique',
                    data: @json($technique)
                },
                {
                    name: ' Financier',
                    data: @json($financier)
                }
            ],
            chart: {
                id: 'ticketTypeChart',
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
            colors: ["#7367F0", "#ff9f43", "#28C76F"],
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

        let ticketStatusChartOptions = {
            series: [
                {
                    name: 'Total',
                    data: @json($total_ticket)
                },
                {
                    name: 'Ouvert',
                    data: @json($open_ticket)
                },
                {
                    name: 'Clôturé',
                    data: @json($close_ticket)
                }
            ],
            chart: {
                id : 'ticketStatusChart',
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
            colors: ["#735bf3", "#28c76f", "#ea5455"],
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

        $(document).ready(function(){
            let ticketTypeChart = eachApexChartsCallFunction("#ticketTypeChart", ticketTypeChartOptions);
            ticketTypeChart.render();

            let ticketStatusChart = eachApexChartsCallFunction("#ticketStatusChart", ticketStatusChartOptions);
            ticketStatusChart.render();


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
