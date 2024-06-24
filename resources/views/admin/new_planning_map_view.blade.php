{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Calendar') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection

{{-- active menu  --}}
@section('planningIndex')
active
@endsection

@push('css')
<style>
    #filterAccordion .card-header .btn::after{
        content: '\F64D';
    }
    #filterAccordion .card-header .btn[aria-expanded="true"]::after{
        content: '\F63B';
    }

    #filterAccordion .card-header .btn::after{
        background-color: #f7f7f7;
        padding: 5px;
    }    
    h4{
        font-size: 16px;
        font-weight: bold;
    }
    .gm-ui-hover-effect > span {
        background-color: #FF0708;
    }

    /* Hide google map brand content */
    .gm-style-cc,
    .gm-style-mtc,
    .gm-svpc,
    a[title="Open this area in Google Maps (opens a new window)"][aria-label="Open this area in Google Maps (opens a new window)"],
    [aria-label] > div > [alt="Google"]
    {
        display: none !important;
    }

    .custom-map-wrapper #custom-map{
        height: 100%;
        min-height: 400px !important;
    }
</style>
@endpush

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/row-calendar/css/style.css') }}">
@endpush
@push('plugins-script')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E&callback=initMap" defer></script>
@endpush


{{-- Main Content Part  --}}
@section('content')

<div class="full-preloader position-fixed w-100 h-100" style="display: none">
    <div class="full-preloader__wrapper d-flex align-items-center justify-content-center w-100 h-100">
        <svg class="preloader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
            <path class="preloader__icon__path" fill="currentColor" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
            </path>
        </svg>
    </div>
</div>

<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		<div class="row bg-white py-3 rounded-lg shadow-sm">
			<div class="col-12">
				<div class="planing-navigation text-center mb-2">
					<div class="btn-group">
                        <a href="{{ route('calendar.index') }}" class="btn btn-outline-secondary">
							<svg width="1.3em" height="1.3em" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.3848 8.90625C13.7655 8.92224 13.177 9.17948 12.7446 9.62314C12.3123 10.0668 12.0703 10.6618 12.0703 11.2813C12.0703 11.9007 12.3123 12.4957 12.7446 12.9394C13.177 13.383 13.7655 13.6403 14.3848 13.6563C15.0041 13.6403 15.5926 13.383 16.0249 12.9394C16.4573 12.4957 16.6992 11.9007 16.6992 11.2813C16.6992 10.6618 16.4573 10.0668 16.0249 9.62314C15.5926 9.17948 15.0041 8.92224 14.3848 8.90625ZM14.3848 10.0938C14.5408 10.0938 14.6952 10.1246 14.8393 10.1843C14.9834 10.2441 15.1144 10.3316 15.2246 10.442C15.3349 10.5523 15.4224 10.6833 15.482 10.8274C15.5417 10.9716 15.5723 11.126 15.5723 11.282C15.5722 11.438 15.5414 11.5925 15.4817 11.7366C15.422 11.8807 15.3344 12.0116 15.2241 12.1219C15.1137 12.2322 14.9827 12.3196 14.8386 12.3793C14.6945 12.4389 14.54 12.4696 14.384 12.4695C14.0689 12.4694 13.7668 12.3442 13.5441 12.1213C13.3214 11.8985 13.1964 11.5963 13.1965 11.2813C13.1966 10.9662 13.3218 10.6641 13.5447 10.4414C13.7675 10.2187 14.0697 10.0936 14.3848 10.0938Z" fill="currentColor"/>
                                <path d="M12.1326 18.0111C13.3359 18.0111 15.4362 18.0111 16.6395 18.0008C16.8606 17.9999 17.0783 17.9458 17.274 17.8429C17.4697 17.74 17.6378 17.5915 17.7638 17.4098C17.8899 17.2282 17.9704 17.0188 17.9983 16.7995C18.0263 16.5802 18.0009 16.3573 17.9244 16.1499C17.6629 15.4201 17.1824 14.789 16.5485 14.3427C15.9147 13.8965 15.1585 13.657 14.3833 13.6569C13.6076 13.6585 12.8512 13.8981 12.2161 14.3434C11.581 14.7886 11.0978 15.4181 10.8319 16.1467C10.7547 16.3562 10.7293 16.5812 10.7578 16.8026C10.7863 17.024 10.8679 17.2353 10.9956 17.4184C11.1234 17.6014 11.2935 17.751 11.4914 17.8542C11.6894 17.9574 11.9093 18.0112 12.1326 18.0111ZM12.1326 16.8236C12.1006 16.8236 12.0683 16.816 12.0399 16.8012C12.0116 16.7865 11.9872 16.7651 11.9689 16.7389C11.9507 16.7126 11.939 16.6824 11.935 16.6507C11.9309 16.619 11.9346 16.5867 11.9457 16.5568L11.9465 16.556C12.1287 16.0556 12.46 15.6231 12.8958 15.3171C13.3316 15.011 13.8508 14.846 14.3833 14.8444C15.5011 14.8444 16.4527 15.5585 16.8082 16.5544L16.8097 16.5607C16.8204 16.589 16.8239 16.6194 16.8201 16.6494C16.8162 16.6793 16.8051 16.7079 16.7876 16.7325C16.7705 16.7575 16.7475 16.7778 16.7208 16.7919C16.694 16.806 16.6642 16.8133 16.634 16.8133H16.6292C15.4283 16.8236 13.3327 16.8236 12.1326 16.8236ZM16.4258 7.12565V5.14648C16.4258 4.35912 16.113 3.60401 15.5563 3.04726C14.9995 2.49051 14.2444 2.17773 13.457 2.17773H3.95703C3.16967 2.17773 2.41456 2.49051 1.85781 3.04726C1.30106 3.60401 0.988281 4.35912 0.988281 5.14648V14.6465C0.988281 15.4338 1.30106 16.189 1.85781 16.7457C2.41456 17.3025 3.16967 17.6152 3.95703 17.6152H8.70703C8.8645 17.6152 9.01553 17.5527 9.12688 17.4413C9.23823 17.33 9.30078 17.179 9.30078 17.0215C9.30078 16.864 9.23823 16.713 9.12688 16.6016C9.01553 16.4903 8.8645 16.4277 8.70703 16.4277H3.95703C3.48461 16.4277 3.03155 16.2401 2.6975 15.906C2.36345 15.572 2.17578 15.1189 2.17578 14.6465V5.14648C2.17578 4.67407 2.36345 4.221 2.6975 3.88695C3.03155 3.5529 3.48461 3.36523 3.95703 3.36523H13.457C13.9294 3.36523 14.3825 3.5529 14.7166 3.88695C15.0506 4.221 15.2383 4.67407 15.2383 5.14648V7.12565C15.2383 7.28312 15.3008 7.43415 15.4122 7.5455C15.5235 7.65685 15.6746 7.7194 15.832 7.7194C15.9895 7.7194 16.1405 7.65685 16.2519 7.5455C16.3632 7.43415 16.4258 7.28312 16.4258 7.12565Z" fill="currentColor"/>
                                <path d="M4.75 1.58398V3.95898C4.75 4.11646 4.81256 4.26748 4.92391 4.37883C5.03526 4.49018 5.18628 4.55273 5.34375 4.55273C5.50122 4.55273 5.65225 4.49018 5.7636 4.37883C5.87494 4.26748 5.9375 4.11646 5.9375 3.95898V1.58398C5.9375 1.42651 5.87494 1.27549 5.7636 1.16414C5.65225 1.05279 5.50122 0.990234 5.34375 0.990234C5.18628 0.990234 5.03526 1.05279 4.92391 1.16414C4.81256 1.27549 4.75 1.42651 4.75 1.58398ZM11.4792 1.58398V3.95898C11.4792 4.11646 11.5417 4.26748 11.6531 4.37883C11.7644 4.49018 11.9154 4.55273 12.0729 4.55273C12.2304 4.55273 12.3814 4.49018 12.4928 4.37883C12.6041 4.26748 12.6667 4.11646 12.6667 3.95898V1.58398C12.6667 1.42651 12.6041 1.27549 12.4928 1.16414C12.3814 1.05279 12.2304 0.990234 12.0729 0.990234C11.9154 0.990234 11.7644 1.05279 11.6531 1.16414C11.5417 1.27549 11.4792 1.42651 11.4792 1.58398ZM4.75 8.51107H7.20417C7.36164 8.51107 7.51266 8.44851 7.62401 8.33716C7.73536 8.22581 7.79792 8.07479 7.79792 7.91732C7.79792 7.75985 7.73536 7.60882 7.62401 7.49747C7.51266 7.38612 7.36164 7.32357 7.20417 7.32357H4.75C4.59253 7.32357 4.44151 7.38612 4.33016 7.49747C4.21881 7.60882 4.15625 7.75985 4.15625 7.91732C4.15625 8.07479 4.21881 8.22581 4.33016 8.33716C4.44151 8.44851 4.59253 8.51107 4.75 8.51107ZM4.75 11.6777H8.70833C8.86581 11.6777 9.01683 11.6152 9.12818 11.5038C9.23953 11.3925 9.30208 11.2415 9.30208 11.084C9.30208 10.9265 9.23953 10.7755 9.12818 10.6641C9.01683 10.5528 8.86581 10.4902 8.70833 10.4902H4.75C4.59253 10.4902 4.44151 10.5528 4.33016 10.6641C4.21881 10.7755 4.15625 10.9265 4.15625 11.084C4.15625 11.2415 4.21881 11.3925 4.33016 11.5038C4.44151 11.6152 4.59253 11.6777 4.75 11.6777Z" fill="currentColor"/>
                            </svg>
						</a>
						<a href="{{ route('planning.index') }}" class="btn btn-outline-secondary">
							<i class="bi bi-calendar2-week"></i>
						</a>
						<a href="{{ route('planning.weeks.view') }}" class="btn btn-outline-secondary">
							<i class="bi bi-card-list"></i>
						</a>
                        @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager' && role() != 'sales_manager_externe' && role() != 'installer' && role() != 'energy_auditor')
                            <a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary active">
                                <i class="bi bi-geo-alt"></i>
                            </a>
                        @endif
					</div>
				</div>
				<div class="calendar-filters">
					<form action="{{ route('planning.map.menu.filter') }}" method="get">
						<div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1 align-items-end">  
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Profil</label>
                                    <select name="role" id="roleFilter" class="select2_select_option custom-select shadow-none form-control">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($roles as $role) 
                                            <option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="form-label">Utilisateur</label>
                                    <select name="user_id" id="filterUserList" class="select2_select_option custom-select shadow-none form-control" required>
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @if (request()->role)
                                            @foreach ($users->where('role_id', request()->role) as $user)
                                                <option {{ request()->user_id == $user->id ? 'selected':'' }}  value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label class="form-label">Date</label>
                                    <div class="calendar-wrapper">
                                        <div class="calendar-header">
                                            <div class="calendar-header__top justify-content-center border" style="padding: 2px;">
                                                <button type="button" class="calendar-header__top__btn filterDateChangeArray" data-type="left" data-start-date="{{ $week_start }}">
                                                    <i class="bi bi-chevron-left"></i>
                                                </button>
                                                <h3 class="calendar-header__top__title mx-3" id="mapDateFilterWrap">
                                                    <label class="label-flatpickr"> <span id="filterDateRangeLabel">{{ \Carbon\Carbon::parse($week_start)->locale(app()->getLocale())->translatedFormat('d F') }} - {{ \Carbon\Carbon::parse($week_end)->locale(app()->getLocale())->translatedFormat('d F') }}</span>
                                                        <div class="label-flatpickr__container">
                                                            <div class="form-group">
                                                                <input type="date" name="custom_filter_date" id="filterDate" value="{{ \Carbon\Carbon::parse($week_start)->format('Y-m-d') }}" class="flatpickr">
                                                            </div>
                                                        </div>
                                                    </label>
                                                </h3>
                                                <button type="button" class="calendar-header__top__btn filterDateChangeArray" data-type="right" data-start-date="{{ $week_start }}">
                                                    <i class="bi bi-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col d-flex">
                                <div class="form-group ml-auto">
                                    <button class="secondary-btn border-0 mr-1" type="submit">{{ __('Submit') }}</button>
                                </div>
                                @if (\Request::route()->getName() == 'planning.map.menu.filter')
                                    <div class="form-group"> 
                                        <a href="{{ route('planning.map.view') }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a> 
                                    </div>
                                @endif
                            </div> 
						</div>
					</form>
				</div>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center calendar-header__top__title py-2">  
                            <span class="">{{ ucFirst($month) }}</span> 
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="calendar" style="--day-length: {{ $days_in_month }};">
                            <div class="calendar-header">
                                <div class="calendar__row"> 
                                    <div class="calendar__row__item">
                                        <div class="calendar__row__item__filter">
                                            <input type="search" disabled name="filter" class="calendar__row__item__filter__input" placeholder="Utilisateur">
                                            {{-- <input type="search" id="calendar__row__item__filter__search" name="filter" class="calendar__row__item__filter__input" placeholder="Filtre"> --}}
                                        </div>
                                    </div> 
                                    <div class="calendar__row__container">
                                        @foreach ($full_month as $key => $day)
                                            <div class="calendar__row__container__col">
                                                <time class="calendar__row__container__col__date" datetime="{{ $day['date'] }}">
                                                    <span class="calendar__row__container__col__date__name">{{ $day['day'] }}</span>
                                                    <span class="calendar__row__container__col__date__number">{{ \Carbon\Carbon::parse($day['date'])->format('d') }}</span>
                                                </time>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> 
                            <div class="calendar-body">
                                @foreach ($filteredUser as $fUser)
                                @php 
                                    $i = 1;
                                    $position = [];
                                    $same_date = 'empty';
                                    $event_layer = 1;
                                    $result = \App\Models\CRM\ProjectIntervention::whereIn('id', $interventions->pluck('id'))->select('Date_intervention')
                                    ->selectRaw('count(Date_intervention) as qty')
                                    ->groupBy('Date_intervention')
                                    ->orderBy('qty', 'DESC')
                                    ->first();
                                @endphp
                                    <div class="calendar__row"> 
                                        <div class="calendar__row__item">
                                            <div class="calendar__row__item__list" style="color: {{ $fUser->color }};background-color: {{ $fUser->background_color }}">
                                                <span class="calendar__row__item__list__text">{{ $fUser->name }}</span>
                                            </div>
                                        </div> 
                                        <div class="calendar__row__container" style="--total-event-layer: {{ $result->qty ?? 1 }};">
                                            @foreach ($full_month as $date)
                                                <div class="calendar__row__container__col" data-date="{{ $date['date'] }}"></div>
                                                @php
                                                    $position[$date['date']] = $loop->iteration;
                                                @endphp
                                            @endforeach
                                            @foreach ($interventions as $intervention)
                                                @php
                                                    if($intervention->Date_intervention == $same_date){
                                                        ++$event_layer;
                                                    }else{
                                                        $event_layer = 1;
                                                        $same_date = $intervention->Date_intervention;
                                                    }
                                                @endphp
        
                                                <div class="calendar__row__container__event" style="--event-color: {{ $fUser->background_color }}; --event-start: {{ $position[\Carbon\Carbon::parse($intervention->Date_intervention)->format('Y-m-d')] ?? '' }}; --event-end: {{ $position[\Carbon\Carbon::parse($intervention->Date_intervention)->format('Y-m-d')] ?? '' }}; --event-layer: {{ $event_layer }};">
                                                    <button type="button" class="calendar__row__container__event__arrow getPreviousLocation" data-distance="0" data-user-id="{{ $fUser->id }}" data-intervention-id="{{ $intervention->id }}" data-toggle="tooltip" data-placement="top" data-html="true" title='Emplacement introuvable'> 
                                                        <i class="bi bi-chevron-up"></i> 
                                                        {{-- @if (checkAction(Auth::id(), 'project', 'magic-planning') || role() == 's_admin')
                                                            <a href="{{ route('magic.planning', $intervention->project_id) }}" target="_blank" class="calendar__row__container__event__arrow__inner-btn" data-project-id="{{ $intervention->project_id }}">
                                                                <img  loading="lazy"  src="{{ asset('dashboard_assets/images/magic-planing.png') }}" alt="magic" width="9" />
                                                            </a>
                                                        @endif --}}
                                                    </button>
                                                    <div role="button" tabindex="0" class="calendar__row__container__event__card interventionEditModal" data-id="{{ $intervention->id }}">
                                                        <span class="calendar__row__container__event__text">{{ $intervention->getProject->Nom }}</span>
                                                        <span class="calendar__row__container__event__indicator" style="background-color: {{ $intervention->getStatusPlanning ? $intervention->getStatusPlanning->background_color : '#ff0000'  }};"></span>
                                                    </div>
                                                    <button type="button" class="calendar__row__container__event__arrow getNextLocation" data-distance="0" data-user-id="{{ $fUser->id }}" data-intervention-id="{{ $intervention->id }}" data-toggle="tooltip" data-html="true" data-placement="bottom" title='Emplacement introuvable'> 
                                                        <i class="bi bi-chevron-down"></i>
                                                    </button>
                                                    <div class="calendar__row__container__event__details">
                                                        <h3 class="calendar__row__container__event__details__title"><strong>Nom: </strong>{{ $intervention->getProject->Nom.' '.$intervention->getProject->Prenom }}</h3>
                                                        <p class="calendar__row__container__event__details__text"><strong>Ville: </strong>{{ $intervention->getProject->Ville }}</p>
                                                        <p class="calendar__row__container__event__details__text"><strong>Code Postal: </strong>{{ $intervention->getProject->Code_Postal }}</p>
                                                        <p class="calendar__row__container__event__details__text"><strong>Téléphone: </strong>{{ $intervention->getProject->phone }}</p>
                                                        <p class="calendar__row__container__event__details__text"><strong>Type d’intervention: </strong>{{ $intervention->type }}</p>
                                                        <p class="calendar__row__container__event__details__text"><strong>Attribué à: </strong>{{ $intervention->getUser->name ?? '' }}</p>
                                                        <p class="calendar__row__container__event__details__text"><strong>Travaux: </strong>
                                                            @foreach ($intervention->getProject->ProjectTravaux as $travaux)
                                                            {{ $travaux->tag }} {{ $loop->last ? '':', ' }}
                                                        @endforeach</p>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp 
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach 
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-6 custom-map-wrapper"> 
                        <div id="custom-map"></div> 
                    </div>
                </div> 
			</div>
		</div>
	</div>
</section>
<div id="renderModal"> 
</div>
@endsection

@push('js')


<script>

	$(document).ready(function () { 
        let rendaring = false; 

        $('body').on('click', '.filterDateChangeArray', function(){ 
            let type = $(this).data('type');
            let start_date = $(this).attr('data-start-date'); 
            $.ajax({
				type : "POST",
				url  : "{{ route('map.date.change') }}",
				data : {type, start_date},
				success : response => {
                    $("#mapDateFilterWrap").html(response.view);
                    $('.filterDateChangeArray').attr('data-start-date', response.date); 
                    $('input[type=date]').wrap('<div class="datepicker-input"></div>');
                    document.querySelectorAll('input[type=date]').forEach(e => {
                        flatpickr(e, {
                            minDate: e.getAttribute('min'),
                            maxDate: e.getAttribute('max'),
                            defaultDate: e.getAttribute('value'),
                            altFormat: 'j F Y',
                            dateFormat: 'Y-m-d',
                            allowInput: true,
                            altInput: true,
                            locale: "fr",
                            onReady: (selectedDates, dateStr, instance) => {
                                const mainInputDataId = instance.input.dataset.id;
                                const altInput = instance.input.parentElement?.querySelector(".input");
                                altInput.setAttribute("onkeypress", "return false");
                                altInput.setAttribute("onpaste", "return false");
                                altInput.setAttribute("autocomplete", "off");
                                altInput.setAttribute("id", mainInputDataId);
                            },
                        });
                    });
				}
			})

		});
        $('body').on('change', '#filterDate', function(){ 
            $.ajax({
				type : "POST",
				url  : "{{ route('map.date.change2') }}",
				data : {date:$(this).val()},
				success : response => {
                    $("#filterDateRangeLabel").text(response.label);
                    $('.filterDateChangeArray').attr('data-start-date', response.date); 
				}
			})
		});

        $('body').on('click', '.interventionEditModal', function(){  
            if(!rendaring){
                rendaring = true;
                let id = $(this).data('id'); 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning.intervention.modal.render2') }}",
                    data : {id},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $("#renderModal").html(response);   
                        $("#planningInterventionEdit").modal('show');
                        rendaring = false;
                        $('.select2_select_option').each(function(){
                            $(this).select2({
                                dropdownParent: $(this).parent(),
                                templateSelection : function (tag, container){
                                    var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                                    if ($option.attr('disabled')){
                                    $(container).addClass('removed-remove-btn');
                                    }
                                    return tag.text;
                                },
                            })
                        })
                        $('input[type=date]').wrap('<div class="datepicker-input"></div>');
                        document.querySelectorAll('input[type=date]').forEach(e => {
                            flatpickr(e, {
                                minDate: e.getAttribute('min'),
                                maxDate: e.getAttribute('max'),
                                defaultDate: e.getAttribute('value'),
                                altFormat: 'j F Y',
                                dateFormat: 'Y-m-d',
                                allowInput: true,
                                altInput: true,
                                locale: "fr",
                                onReady: (selectedDates, dateStr, instance) => {
                                    const mainInputDataId = instance.input.dataset.id;
                                    const altInput = instance.input.parentElement?.querySelector(".input");
                                    altInput.setAttribute("onkeypress", "return false");
                                    altInput.setAttribute("onpaste", "return false");
                                    altInput.setAttribute("autocomplete", "off");
                                    altInput.setAttribute("id", mainInputDataId);
                                },
                            });
                        });
                        var select2_with_color = $(".select2_color_option");
                        if(select2_with_color.length){
                            function renderCustomResultTemplat(option) {
                                if (!option.id) {
                                    return option.text;
                                }
    
                                let $returnTemplate = `
                                <div class="px-3 py-2" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                    ${option.text}
                                </div>
                                `
    
                                return $returnTemplate;
                            }
    
                            function renderCustomSelectionTemplat(option) {
                                if (option.id === '') {
                                    let $returnTemplate = `<div class="px-3 h-100">${option.text}</div>`
                                    return $returnTemplate;
                                }
    
                                if (!option.id) {
                                    return option.text;
                                }
    
                                let $returnTemplate = `
                                <div class="px-3 h-100" style="color: ${$(option.element).data('color')}; background-color: ${$(option.element).data('background')}">
                                    ${option.text}
                                </div>
                                `
    
                                return $returnTemplate;
                            }
    
                            select2_with_color.each(function(){
                                $(this).wrap('<div class="position-relative select2_color_option-parent"></div>').select2({
                                    width: '100%',
                                    dropdownParent: $(this).parent(),
                                    templateResult: renderCustomResultTemplat,
                                    templateSelection: renderCustomSelectionTemplat,
                                    escapeMarkup: function (es) {
                                        return es;
                                    }
                                });
    
                            });
                        }
                        $('.intervention_disabled').prop('disabled', true);
                        const isMobile = () => /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                        if(isMobile()){
                            $('.waze-mobile-button').removeClass('d-none');
                        } 
                    },error : errors => {
                        rendaring = false;
                    }
                });  
            }
		});

        $("body").on('mouseenter','.getPreviousLocation', function(){
            $(".getPreviousLocation").tooltip('hide');
            $(".getNextLocation").tooltip('hide');
            if($(this).data('distance') == '0'){
                let user_id = $(this).data('user-id');
                let intervention_id = $(this).data('intervention-id');
                let type = 'previous';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning.location.distance') }}",
                    data : {user_id, intervention_id, type},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $(this).attr('data-original-title', response).tooltip('show');
                        $(this).data('distance', '1');
                    }
                }); 
            }else{ 
                $(this).tooltip('show');
            }
        });
        $("body").on('mouseenter','.getNextLocation', function(){
            $(".getPreviousLocation").tooltip('hide');
            $(".getNextLocation").tooltip('hide');
            if($(this).data('distance') == '0'){
                let user_id = $(this).data('user-id');
                let intervention_id = $(this).data('intervention-id');
                let type = 'next';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning.location.distance') }}",
                    data : {user_id, intervention_id, type},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $(this).attr('data-original-title', response).tooltip('show');
                        $(this).data('distance', '1');
                    }
                }); 
            }else{ 
                $(this).tooltip('show');
            }
        }); 
 
  

		$('body').on('change', '#roleFilter', function(){
			let role_id = $(this).val();
			$.ajax({
				type : "POST",
				url  : "{{ route('planning.filter.role.change') }}",
				data : {role_id},
				success : response => {
					$('#filterUserList').html(response)
				}
			})
		});
		 
 

		$("#calendar__row__item__filter__search").on("input", function() {
			var value = $(this).val().toLowerCase();
			$(".calendar__row .calendar__row__item .calendar__row__item__list__text").filter(function() {
			$(this).closest('.calendar__row').toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
  
        @if (role() != 's_admin' && !checkAction(Auth::id(), 'collapse_intervention', 'edit'))
            $('.intervention_disabled').prop('disabled', true);
        @endif 
	});

</script>


<script defer>
    let currentInfoWindow;
    let map;
    let defaultLat = 46.2276;
    let defaultLng = 2.2137;

    // Function to create a custom icon with a specified color
    function createCustomIcon(colorCode) {
        return {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent('<svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" viewBox="0 0 45.716 60.955"><path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="' + colorCode + '"/></svg>'),
            scaledSize: new google.maps.Size(26, 35),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(22.858, 60.955)
        }
    };

    const svgIconsCount = [
        '<path fill="#000000" d="M521.76,313.5l-44.85,10.64l-14.06-57.01l77.92-22.04h53.59v267.97h-72.6V313.5z"/>',
        '<path fill="#000000" d="M433.95,457.56l99.59-76.02c24.71-19.38,34.59-31.55,34.59-47.89c0-17.1-11.78-27.37-30.03-27.37   c-17.86,0-31.93,10.64-52.83,34.59l-49.79-41.43c28.51-36.49,57.01-57.01,108.33-57.01c57.77,0,98.06,34.59,98.06,84.76v0.76   c0,42.57-22.05,64.62-61.58,93.12L534.68,453h109.85v60.06H433.95V457.56z"/>',
        '<path fill="#000000" d="M428.82,471.24l46.75-46.37c19.38,19.38,38.77,30.41,63.48,30.41c21.29,0,33.83-10.64,33.83-26.99v-0.76   c0-17.1-14.82-27.37-43.33-27.37h-31.17l-10.26-38.39l60.82-55.11H447.45v-59.67H639.4v52.45l-63.48,54.73   c38.01,8.36,68.8,29.27,68.8,74.88v0.76c0,53.59-43.71,88.56-102.63,88.56C490.4,518.37,455.05,500.13,428.82,471.24z"/>',
        '<path fill="#000000" d="M555.39,461.36H426.16l-11.78-52.07l137.98-164.2h74.12v161.16h33.83v55.11h-33.83v51.69h-71.08V461.36z    M555.39,406.63v-76.78l-63.86,76.78H555.39z"/>',
        '<path fill="#000000" d="M427.87,476.18l42.19-49.41c21.29,18.25,41.81,28.89,64.62,28.89c24.33,0,38.77-11.78,38.77-31.17v-0.76   c0-19.39-15.96-30.79-39.15-30.79c-16.34,0-30.03,5.7-42.57,13.3l-43.71-24.71l7.6-134.55h177.89v60.82H513.78l-2.28,40.29   c12.16-5.7,24.71-9.5,42.57-9.5c47.51,0,91.22,26.61,91.22,84.38v0.76c0,58.91-45.23,94.64-109.85,94.64   C488.31,518.37,455.62,502.03,427.87,476.18z"/>',
        '<path fill="#000000" d="M462.46,487.97c-19.77-19.77-32.69-49.79-32.69-99.59v-0.76c0-82.86,40.29-145.96,123.53-145.96   c37.63,0,62.72,9.88,88.56,29.27l-34.59,51.69c-16.34-12.16-31.55-20.14-52.83-20.14c-38.39,0-48.27,35.73-50.17,57.01   c17.1-13.3,34.59-20.53,57.39-20.53c46.75,0,87.8,29.65,87.8,82.86v0.76c0,59.29-47.51,95.78-105.67,95.78   C505.79,518.37,481.85,507.35,462.46,487.97z M578.01,426.77v-0.76c0-19.38-14.82-34.21-38.01-34.21   c-23.19,0-36.87,14.44-36.87,33.83v0.76c0,19.38,14.44,34.59,37.63,34.59C563.95,460.98,578.01,446.16,578.01,426.77z"/>',
        '<path fill="#000000" d="M563.95,308.94H440.79v-61.96h204.87v55.49L528.22,513.05h-81.34L563.95,308.94z"/>',
        '<path fill="#000000" d="M430.91,439.69v-0.76c0-32.31,16.34-51.69,45.23-63.86c-20.15-11.78-36.11-29.27-36.11-58.16v-0.76   c0-42.57,40.29-73.74,99.97-73.74c59.67,0,100.35,31.17,100.35,73.74v0.76c0,28.89-15.58,46.37-36.49,58.16   c26.99,12.16,45.61,30.79,45.61,63.1v0.76c0,47.89-45.61,78.68-109.47,78.68S430.91,486.07,430.91,439.69z M578.39,432.47v-0.76   c0-17.86-15.58-29.27-38.39-29.27s-38.39,11.4-38.39,29.27v0.76c0,16.34,13.68,30.03,38.39,30.03   C564.71,462.5,578.39,448.82,578.39,432.47z M573.07,325.67v-0.76c0-14.82-12.16-28.13-33.07-28.13   c-20.15,0-32.69,13.3-32.69,28.13v0.76c0,16.72,12.92,29.27,32.69,29.27C559.77,354.93,573.07,342.39,573.07,325.67z"/>',
        '<path fill="#000000" d="M576.49,401.68c-16.34,15.2-35.35,21.67-56.63,21.67c-51.69,0-89.32-32.31-89.32-84.38v-0.76   c0-58.92,45.23-96.54,106.05-96.54c38.39,0,61.58,10.64,81.72,30.79c19.38,19.38,31.93,49.79,31.93,98.82v0.76   c0,86.66-43.33,146.34-122.77,146.34c-39.91,0-68.42-12.16-93.12-31.55l34.59-50.93c18.62,14.82,35.73,21.29,57.01,21.29   C564.71,457.18,574.59,422.97,576.49,401.68z M577.25,335.93v-0.76c0-20.91-14.82-36.49-38.01-36.49   c-23.19,0-37.25,15.2-37.25,36.11v0.76c0,20.14,14.82,34.97,38.01,34.97C563.19,370.52,577.25,355.31,577.25,335.93z"/>',
        '<path fill="#000000" d="M383.02,313.5l-44.85,10.64l-14.06-57.01l77.92-22.04h53.59v267.97h-72.6V313.5z"/><path fill="#000000" d="M497.05,380.78v-0.76c0-75.26,47.89-138.35,123.53-138.35c75.64,0,122.77,62.34,122.77,137.59v0.76   c0,75.26-47.51,138.36-123.53,138.36C544.18,518.37,497.05,456.04,497.05,380.78z M669.23,380.78v-0.76   c0-42.57-20.15-73.36-49.41-73.36c-29.27,0-48.65,30.03-48.65,72.6v0.76c0,42.95,20.15,72.98,49.41,72.98   C650.23,453,669.23,422.97,669.23,380.78z"/>',
        '<path fill="#000000" d="M441.3,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M602.1,314l-45,10.7L543,267.6l78.1-22.1h53.7v268.6h-72.8V314z"/>',
        '<path fill="#000000" d="M402.8,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M514.1,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H514.1   V458.4z"/>',
        '<path fill="#000000" d="M403.4,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M509,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H527.6v-59.8H720v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C570.7,519.4,535.2,501.1,509,472.2z"/>',
        '<path fill="#000000" d="M390.5,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M635.8,462.2H506.3L494.5,410l138.3-164.6h74.3V407H741v55.2h-33.9v51.8h-71.2V462.2z M635.8,407.4v-77l-64,77   H635.8z"/>',
        '<path fill="#000000" d="M401.7,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M508,477.1l42.3-49.5c21.3,18.3,41.9,29,64.8,29c24.4,0,38.9-11.8,38.9-31.2v-0.8c0-19.4-16-30.9-39.2-30.9   c-16.4,0-30.1,5.7-42.7,13.3l-43.8-24.8l7.6-134.9h178.3v61h-120l-2.3,40.4c12.2-5.7,24.8-9.5,42.7-9.5c47.6,0,91.4,26.7,91.4,84.6   v0.8c0,59.1-45.3,94.9-110.1,94.9C568.6,519.4,535.8,503,508,477.1z"/>',
        '<path fill="#000000" d="M395.6,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M542.7,488.9c-19.8-19.8-32.8-49.9-32.8-99.8v-0.8c0-83.1,40.4-146.3,123.8-146.3c37.7,0,62.9,9.9,88.8,29.3   l-34.7,51.8c-16.4-12.2-31.6-20.2-53-20.2c-38.5,0-48.4,35.8-50.3,57.1c17.1-13.3,34.7-20.6,57.5-20.6c46.9,0,88,29.7,88,83.1v0.8   c0,59.4-47.6,96-105.9,96C586.1,519.4,562.1,508.3,542.7,488.9z M658.5,427.6v-0.8c0-19.4-14.9-34.3-38.1-34.3   c-23.2,0-37,14.5-37,33.9v0.8c0,19.4,14.5,34.7,37.7,34.7C644.4,461.9,658.5,447,658.5,427.6z"/>',
        '<path fill="#000000" d="M404.7,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M644.4,309.5H521v-62.1h205.4V303L608.6,514.1H527L644.4,309.5z"/>',
        '<path fill="#000000" d="M401.7,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M511,440.5v-0.8c0-32.4,16.4-51.8,45.3-64c-20.2-11.8-36.2-29.3-36.2-58.3v-0.8c0-42.7,40.4-73.9,100.2-73.9   S721,274,721,316.7v0.8c0,29-15.6,46.5-36.6,58.3c27.1,12.2,45.7,30.9,45.7,63.2v0.8c0,48-45.7,78.9-109.7,78.9   C556.4,518.6,511,487,511,440.5z M658.9,433.3v-0.8c0-17.9-15.6-29.3-38.5-29.3s-38.5,11.4-38.5,29.3v0.8   c0,16.4,13.7,30.1,38.5,30.1S658.9,449.7,658.9,433.3z M653.5,326.2v-0.8c0-14.9-12.2-28.2-33.1-28.2c-20.2,0-32.8,13.3-32.8,28.2   v0.8c0,16.8,13,29.3,32.8,29.3S653.5,343,653.5,326.2z"/>',
        '<path fill="#000000" d="M395.6,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/><path fill="#000000" d="M657,402.4c-16.4,15.2-35.4,21.7-56.8,21.7c-51.8,0-89.5-32.4-89.5-84.6v-0.8c0-59.1,45.3-96.8,106.3-96.8   c38.5,0,61.7,10.7,81.9,30.9c19.4,19.4,32,49.9,32,99.1v0.8c0,86.9-43.4,146.7-123.1,146.7c-40,0-68.6-12.2-93.3-31.6l34.7-51.1   c18.7,14.9,35.8,21.3,57.1,21.3C645.2,458.1,655.1,423.8,657,402.4z M657.7,336.5v-0.8c0-21-14.9-36.6-38.1-36.6   c-23.2,0-37.3,15.2-37.3,36.2v0.8c0,20.2,14.9,35.1,38.1,35.1C643.6,371.2,657.7,355.9,657.7,336.5z"/>',
        '<path fill="#000000" d="M303.6,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H303.6   V458.4z"/><path fill="#000000" d="M544.4,381.5v-0.8c0-75.4,48-138.7,123.8-138.7c75.8,0,123.1,62.5,123.1,137.9v0.8   c0,75.4-47.6,138.7-123.8,138.7C591.7,519.4,544.4,456.9,544.4,381.5z M717,381.5v-0.8c0-42.7-20.2-73.5-49.5-73.5   c-29.3,0-48.8,30.1-48.8,72.8v0.8c0,43.1,20.2,73.2,49.5,73.2C698,453.9,717,423.8,717,381.5z"/>',
        '<path fill="#000000" d="M353.3,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H353.3   V458.4z"/><path fill="#000000" d="M640.6,314l-45,10.7l-14.1-57.1l78.1-22.1h53.7v268.6h-72.8V314z"/>',
        '<path fill="#000000" d="M314.8,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H314.8   V458.4z"/><path fill="#000000" d="M552.6,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H552.6   V458.4z"/>',
        '<path fill="#000000" d="M315.4,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H315.4   V458.4z"/><path fill="#000000" d="M547.4,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H566.1v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C609.2,519.4,573.7,501.1,547.4,472.2z"/>',
        '<path fill="#000000" d="M302.5,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   L304,299.9c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H302.5   V458.4z"/><path fill="#000000" d="M668.6,462.2H539L527.2,410l138.3-164.6h74.3V407h33.9v55.2h-33.9v51.8h-71.2V462.2z M668.6,407.4v-77l-64,77   H668.6z"/>',
        '<path fill="#000000" d="M313.7,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H313.7   V458.4z"/><path fill="#000000" d="M546.5,477.1l42.3-49.5c21.3,18.3,41.9,29,64.8,29c24.4,0,38.9-11.8,38.9-31.2v-0.8c0-19.4-16-30.9-39.2-30.9   c-16.4,0-30.1,5.7-42.7,13.3l-43.8-24.8l7.6-134.9h178.3v61h-120l-2.3,40.4c12.2-5.7,24.8-9.5,42.7-9.5c47.6,0,91.4,26.7,91.4,84.6   v0.8c0,59.1-45.3,94.9-110.1,94.9C607.1,519.4,574.3,503,546.5,477.1z"/>',
        '<path fill="#000000" d="M307.6,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H307.6   V458.4z"/><path fill="#000000" d="M581.2,488.9c-19.8-19.8-32.8-49.9-32.8-99.8v-0.8c0-83.1,40.4-146.3,123.8-146.3c37.7,0,62.9,9.9,88.8,29.3   l-34.7,51.8c-16.4-12.2-31.6-20.2-53-20.2c-38.5,0-48.4,35.8-50.3,57.1c17.1-13.3,34.7-20.6,57.5-20.6c46.9,0,88,29.7,88,83.1v0.8   c0,59.4-47.6,96-105.9,96C624.6,519.4,600.6,508.3,581.2,488.9z M697,427.6v-0.8c0-19.4-14.9-34.3-38.1-34.3   c-23.2,0-37,14.5-37,33.9v0.8c0,19.4,14.5,34.7,37.7,34.7C682.9,461.9,697,447,697,427.6z"/>',
        '<path fill="#000000" d="M316.7,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H316.7   V458.4z"/><path fill="#000000" d="M681,309.5H557.5v-62.1h205.4V303L645.2,514.1h-81.5L681,309.5z"/>',
        '<path fill="#000000" d="M313.7,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H313.7   V458.4z"/><path fill="#000000" d="M549.5,440.5v-0.8c0-32.4,16.4-51.8,45.3-64c-20.2-11.8-36.2-29.3-36.2-58.3v-0.8c0-42.7,40.4-73.9,100.2-73.9   s100.6,31.2,100.6,73.9v0.8c0,29-15.6,46.5-36.6,58.3c27.1,12.2,45.7,30.9,45.7,63.2v0.8c0,48-45.7,78.9-109.7,78.9   S549.5,487,549.5,440.5z M697.4,433.3v-0.8c0-17.9-15.6-29.3-38.5-29.3c-22.9,0-38.5,11.4-38.5,29.3v0.8   c0,16.4,13.7,30.1,38.5,30.1S697.4,449.7,697.4,433.3z M692,326.2v-0.8c0-14.9-12.2-28.2-33.1-28.2c-20.2,0-32.8,13.3-32.8,28.2   v0.8c0,16.8,13,29.3,32.8,29.3C678.7,355.6,692,343,692,326.2z"/>',
        '<path fill="#000000" d="M307.6,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.1-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H307.6   V458.4z"/><path fill="#000000" d="M695.4,402.4c-16.4,15.2-35.4,21.7-56.8,21.7c-51.8,0-89.5-32.4-89.5-84.6v-0.8c0-59.1,45.3-96.8,106.3-96.8   c38.5,0,61.7,10.7,81.9,30.9c19.4,19.4,32,49.9,32,99.1v0.8c0,86.9-43.4,146.7-123.1,146.7c-40,0-68.6-12.2-93.3-31.6l34.7-51.1   c18.7,14.9,35.8,21.3,57.1,21.3C683.6,458.1,693.5,423.8,695.4,402.4z M696.2,336.5v-0.8c0-21-14.9-36.6-38.1-36.6   c-23.2,0-37.3,15.2-37.3,36.2v0.8c0,20.2,14.9,35.1,38.1,35.1C682.1,371.2,696.2,355.9,696.2,336.5z"/>',
        '<path fill="#000000" d="M298.5,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H317.2v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C360.2,519.4,324.8,501.1,298.5,472.2z"/><path fill="#000000" d="M543.9,381.5v-0.8c0-75.4,48-138.7,123.8-138.7s123.1,62.5,123.1,137.9v0.8c0,75.4-47.6,138.7-123.8,138.7   C591.1,519.4,543.9,456.9,543.9,381.5z M716.4,381.5v-0.8c0-42.7-20.2-73.5-49.5-73.5s-48.8,30.1-48.8,72.8v0.8   c0,43.1,20.2,73.2,49.5,73.2C697.4,453.9,716.4,423.8,716.4,381.5z"/>',
        '<path fill="#000000" d="M348.2,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H366.8v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C409.9,519.4,374.5,501.1,348.2,472.2z"/><path fill="#000000" d="M640,314l-45,10.7L581,267.6l78.1-22.1h53.7v268.6H640V314z"/>',
        '<path fill="#000000" d="M309.7,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H328.4v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C371.4,519.4,336,501.1,309.7,472.2z"/><path fill="#000000" d="M552,458.4l99.8-76.2c24.8-19.4,34.7-31.6,34.7-48c0-17.1-11.8-27.4-30.1-27.4c-17.9,0-32,10.7-53,34.7   l-49.9-41.5c28.6-36.6,57.2-57.1,108.6-57.1c57.9,0,98.3,34.7,98.3,85v0.8c0,42.7-22.1,64.8-61.7,93.3l-45.7,32h110.1v60.2H552   V458.4z"/>',
        '<path fill="#000000" d="M310.3,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4H380l-10.3-38.5l61-55.2H328.9v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C372,519.4,336.6,501.1,310.3,472.2z"/><path fill="#000000" d="M546.9,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H565.5v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C608.6,519.4,573.1,501.1,546.9,472.2z"/>',
        '<path fill="#000000" d="M297.3,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4H367l-10.3-38.5l61-55.2H316v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C359,519.4,323.6,501.1,297.3,472.2z"/><path fill="#000000" d="M675.6,462.2H546.1L534.3,410l138.3-164.6h74.3V407h33.9v55.2h-33.9v51.8h-71.2V462.2z M675.6,407.4v-77   l-64,77H675.6z"/>',
        '<path fill="#000000" d="M308.5,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2L368,362.4l61-55.2H327.2v-59.8h192.4v52.6L456,354.8c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C370.3,519.4,334.8,501.1,308.5,472.2z"/><path fill="#000000" d="M544,477.1l42.3-49.5c21.3,18.3,41.9,29,64.8,29c24.4,0,38.9-11.8,38.9-31.2v-0.8c0-19.4-16-30.9-39.2-30.9   c-16.4,0-30.1,5.7-42.7,13.3l-43.8-24.8l7.6-134.9h178.3v61h-120l-2.3,40.4c12.2-5.7,24.8-9.5,42.7-9.5c47.6,0,91.4,26.7,91.4,84.6   v0.8c0,59.1-45.3,94.9-110.1,94.9C604.6,519.4,571.8,503,544,477.1z"/>',
        '<path fill="#000000" d="M302.5,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H321.1v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C364.2,519.4,328.7,501.1,302.5,472.2z"/><path fill="#000000" d="M580.6,488.9c-19.8-19.8-32.8-49.9-32.8-99.8v-0.8c0-83.1,40.4-146.3,123.8-146.3c37.7,0,62.9,9.9,88.8,29.3   l-34.7,51.8c-16.4-12.2-31.6-20.2-53-20.2c-38.5,0-48.4,35.8-50.3,57.1c17.1-13.3,34.7-20.6,57.5-20.6c46.9,0,88,29.7,88,83.1v0.8   c0,59.4-47.6,96-105.9,96C624,519.4,600,508.3,580.6,488.9z M696.4,427.6v-0.8c0-19.4-14.9-34.3-38.1-34.3s-37,14.5-37,33.9v0.8   c0,19.4,14.5,34.7,37.7,34.7C682.3,461.9,696.4,447,696.4,427.6z"/>',
        '<path fill="#000000" d="M311.6,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2L371,362.4l61-55.2H330.3v-59.8h192.4v52.6L459,354.8c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C373.3,519.4,337.9,501.1,311.6,472.2z"/><path fill="#000000" d="M674.7,309.5H551.2v-62.1h205.4V303L638.9,514.1h-81.5L674.7,309.5z"/>',
        '<path fill="#000000" d="M308.5,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2L368,362.4l61-55.2H327.2v-59.8h192.4v52.6L456,354.8c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C370.3,519.4,334.8,501.1,308.5,472.2z"/><path fill="#000000" d="M549,440.5v-0.8c0-32.4,16.4-51.8,45.3-64c-20.2-11.8-36.2-29.3-36.2-58.3v-0.8c0-42.7,40.4-73.9,100.2-73.9   c59.8,0,100.6,31.2,100.6,73.9v0.8c0,29-15.6,46.5-36.6,58.3c27.1,12.2,45.7,30.9,45.7,63.2v0.8c0,48-45.7,78.9-109.7,78.9   C594.3,518.6,549,487,549,440.5z M696.8,433.3v-0.8c0-17.9-15.6-29.3-38.5-29.3c-22.9,0-38.5,11.4-38.5,29.3v0.8   c0,16.4,13.7,30.1,38.5,30.1S696.8,449.7,696.8,433.3z M691.4,326.2v-0.8c0-14.9-12.2-28.2-33.1-28.2c-20.2,0-32.8,13.3-32.8,28.2   v0.8c0,16.8,13,29.3,32.8,29.3C678.1,355.6,691.4,343,691.4,326.2z"/>',
        '<path fill="#000000" d="M302.5,472.2l46.9-46.5c19.4,19.4,38.9,30.5,63.6,30.5c21.3,0,33.9-10.7,33.9-27.1v-0.8   c0-17.1-14.9-27.4-43.4-27.4h-31.2l-10.3-38.5l61-55.2H321.1v-59.8h192.4v52.6l-63.6,54.9c38.1,8.4,69,29.3,69,75.1v0.8   c0,53.7-43.8,88.8-102.9,88.8C364.2,519.4,328.7,501.1,302.5,472.2z"/><path fill="#000000" d="M693,402.4c-16.4,15.2-35.4,21.7-56.8,21.7c-51.8,0-89.5-32.4-89.5-84.6v-0.8c0-59.1,45.3-96.8,106.3-96.8   c38.5,0,61.7,10.7,81.9,30.9c19.4,19.4,32,49.9,32,99.1v0.8c0,86.9-43.4,146.7-123.1,146.7c-40,0-68.6-12.2-93.3-31.6l34.7-51.1   c18.7,14.9,35.8,21.3,57.1,21.3C681.2,458.1,691.1,423.8,693,402.4z M693.7,336.5v-0.8c0-21-14.9-36.6-38.1-36.6   c-23.2,0-37.3,15.2-37.3,36.2v0.8c0,20.2,14.9,35.1,38.1,35.1S693.7,355.9,693.7,336.5z"/>',
        '<path fill="#000000" d="M416.4,462.2H286.8L275,410l138.3-164.6h74.3V407h33.9v55.2h-33.9v51.8h-71.2V462.2z M416.4,407.4v-77l-64,77   H416.4z"/><path fill="#000000" d="M547.8,381.5v-0.8c0-75.4,48-138.7,123.8-138.7s123.1,62.5,123.1,137.9v0.8c0,75.4-47.6,138.7-123.8,138.7   C595.1,519.4,547.8,456.9,547.8,381.5z M720.4,381.5v-0.8c0-42.7-20.2-73.5-49.5-73.5s-48.8,30.1-48.8,72.8v0.8   c0,43.1,20.2,73.2,49.5,73.2C701.4,453.9,720.4,423.8,720.4,381.5z"/>'
    ];

    let customSvgMarkerIcon = function(colorCode, index){
        return {
            url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 1080 1080" xml:space="preserve">
                ${svgIconsCount[index]}
                <path fill="${colorCode}" d="M922.06,379.62C915.75,174.04,747.2,9.3,540.14,9.12h-0.28C488.1,9.16,438.74,19.49,393.72,38.18  C258.66,94.22,162.67,225.43,157.94,379.62c-0.23,7.6-7.9,143.89,107.89,307.21l235.12,360.43c7.59,14.49,22.57,23.59,38.92,23.63  h0.28c16.35-0.04,31.34-9.14,38.92-23.63l235.12-360.43C929.97,523.51,922.3,387.21,922.06,379.62z M540,661.88  c-151.18,0-273.74-122.56-273.74-273.74S388.82,114.4,540,114.4s273.74,122.56,273.74,273.74S691.18,661.88,540,661.88z"/>
            </svg>`),
            scaledSize: new google.maps.Size(39, 52),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(22.858, 60.955)
        }
    }


    // Initialize the map
    function initMap() {
        // Specify the coordinates for the map center
        let mapCenter = { lat: defaultLat, lng: defaultLng };

        // Create a new map instance
        map = new google.maps.Map(document.getElementById('custom-map'), {
            zoom: 5,
            center: mapCenter
        });

        let allLocations = [
            @forelse ($interventions as $intervention)
                @if ($intervention->getProject->latitude)
                    {
                        position: { lat: {{ $intervention->getProject->latitude }}, lng: {{ $intervention->getProject->longitude }} },
                        icon: customSvgMarkerIcon("{{ $intervention->getProject->getSubStatus->background_color ?? '#8e27b3' }}", "{{ $loop->index }}"), 
                        content:
                        `
                        <table style="text-align:left">
                            <tr>
                                <th>
                                    Nom
                                </th>
                                <td>
                                    : {{ $intervention->getProject->Nom }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Prenom
                                </th>
                                <td>
                                    : {{ $intervention->getProject->Prenom }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Département
                                </th>
                                <td>
                                    : {{ $intervention->getProject->Département }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Téléphone
                                </th>
                                <td>
                                    : {{ $intervention->getProject->phone }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    Projet
                                </th>
                                <td>
                                    : {{ implode(',', $intervention->getProject->ProjectTravauxTags->pluck('tag')->toArray()) }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Etiquette
                                </th>
                                <td>
                                    : {{ $intervention->getProject->projectStatus->status ?? '' }} 
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Statut
                                </th>
                                <td>
                                    : {{ $intervention->getProject->getSubStatus->name ?? '' }} 
                                </td>
                            </tr> 
                        </table>
                        `
                    },
                @endif
            @empty
                {
                    position: { lat: defaultLat, lng: defaultLng },
                    icon: createCustomIcon('rgba(255,0,0,0.92)'),
                    content: 'No Item Found'
                }
            @endforelse
        ];

        allLocations.forEach(function(markerData) {
            let marker = new google.maps.Marker({
                position: markerData.position,
                map: map,
                title: 'Custom Marker',
                icon: markerData.icon
            });

            let infowindow = new google.maps.InfoWindow({
                content: markerData.content
            });

            marker.addListener('click', function() {
                // Close the currently open info window
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }

                // Open the clicked marker's info window
                infowindow.open(map, marker);

                // Set the currently open info window
                currentInfoWindow = infowindow;
            });
        });

        map.addListener('click', function() {
            if (currentInfoWindow) {
                currentInfoWindow.close();
            }
        });

        // setTimeout(function () {
        //     window.dispatchEvent(new Event("resize"));
        //     $('#custom-map').css('min-height', '550px'); 
        // }, 500);
    };
</script>

@endpush


@push('css')
	<style>
		@for ($i = 1; $i <= $days_in_month; $i++)
		.calendar-body .calendar__row__container__col:nth-of-type({{ $days_in_month }}n + {{ $i }}) {
			grid-column: {{ $i }}/{{ $i }};
		}
		@endfor
	</style>
@endpush
