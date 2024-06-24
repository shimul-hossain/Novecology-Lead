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
@section('savIndex')
active
@endsection

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/row-calendar/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/geocoder.css') }}">
@endpush
@push('plugins-script')
	<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl.js') }}"></script>
	<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl-geocoder.min.js') }}"></script>
@endpush

@push('css')
<style>
    #filterAccordion .card-header .btn::after{
        content: '\F64D';
    }
    #filterAccordion .card-header .btn[aria-expanded="true"]::after{
        content: '\F63B';
    }
	h4{
        font-size: 16px;
        font-weight: bold;
    }
    @media (min-width: 768px){
        .position-lg-absolute {
            position: absolute;
            z-index: 1;
        }
    }
</style>
@endpush

{{-- Main Content Part  --}}
@section('content')

@php
	$days_in_week = 7;
	$dateColorArr = ['#81384a', '#7d4cf3', '#5572e1', '#5ac4b5', '#ea3624', '#ef9230', '#5ac4b5'];
	$i = 1;
@endphp

<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		<div class="row bg-white py-3 rounded-lg shadow-sm">
			<div class="col-12 mb-2 mb-lg-0">
                <div class="position-lg-absolute text-center text-md-left mb-2 mb-md-0"> 
					@if (checkAction(Auth::id(), 'collapse_intervention', 'create') || role() == 's_admin')
					    <button data-toggle="modal" data-target="#rightAsideModal" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 w-100"><i class="bi bi-plus-lg mr-1"></i>Ajouter une intervention</button>
                    @endif
				</div>
				<div class="planing-navigation text-center mb-2 d-lg-none">
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
						<a href="{{ route('planning.weeks.view') }}" class="btn btn-outline-secondary active">
							<i class="bi bi-card-list"></i>
						</a>
						@if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager' && role() != 'sales_manager_externe' && role() != 'installer' && role() != 'energy_auditor')
							<a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary">
								<i class="bi bi-geo-alt"></i>
							</a>
                        @endif
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="planing-navigation text-center mb-2 d-none d-lg-block">
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
						<a href="{{ route('planning.weeks.view') }}" class="btn btn-outline-secondary active">
							<i class="bi bi-card-list"></i>
						</a>
						@if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager' && role() != 'sales_manager_externe' && role() != 'installer' && role() != 'energy_auditor')
							<a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary">
								<i class="bi bi-geo-alt"></i>
							</a>
                        @endif
					</div>
				</div>
				<div class="calendar-wrapper">
					<div class="calendar-header">
						<div class="calendar-header__top justify-content-center py-2">
							<a href="{{ route('planning.weeks.view', \Carbon\Carbon::parse($week_start)->subDays(7)->format('Y-m-d')) }}" class="calendar-header__top__btn">
								<i class="bi bi-chevron-left"></i>
							</a>
							<h3 class="calendar-header__top__title mx-3">
								<label class="label-flatpickr">{{ \Carbon\Carbon::parse($week_start)->locale(app()->getLocale())->translatedFormat('d F') }} - {{ \Carbon\Carbon::parse($week_end)->locale(app()->getLocale())->translatedFormat('d F') }}
									<form action="{{ route('planning.week.custom.filter') }}" method="post" class="label-flatpickr__container">
										@csrf
										<div class="form-group">
											<input type="date" name="custom_filter_date" value="{{ $current_date }}" class="flatpickr" onchange="this.closest('form').submit()">
										</div>
									</form>
								</label>
							</h3>
							<a href="{{ route('planning.weeks.view', \Carbon\Carbon::parse($week_end)->addDay()->format('Y-m-d')) }}" class="calendar-header__top__btn">
								<i class="bi bi-chevron-right"></i>
							</a>
						</div>
					</div>
					<div class="calendar-filters">
						<form action="{{ $url_status == 1 ? route('planning.week.menu.filter', $current_date) : route('planning.week.menu.filter')  }}" method="get">
							<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 align-items-end">
								@if ($all_access)
									<div class="col">
										<div class="form-group">
											<label for="intervention_client" class="form-label">Client</label>
											<select id="intervention_client" name="client" class="select2_select_option custom-select shadow-none form-control">
												<option value="" selected>{{ __('Select') }}</option>
												@foreach ($projects as $project)
													<option {{ request()->client == $project['id'] ? 'selected':'' }} value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label for="code_postal" class="form-label">Département</label>
											<select name="code_postal" id="code_postal" class="select2_select_option shadow-none form-control">
												<option value="" selected>{{ __("Select") }}</option>
												@foreach ($departments as $department)
													<option {{ request()->code_postal == $department->postal_code ? 'selected':'' }} value="{{ $department->postal_code < 10 ? '0':'' }}{{ $department->postal_code }}">{{ $department->city }}( {{ $department->postal_code < 10 ? '0':'' }}{{ $department->postal_code }})</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label class="form-label">Type d’intervention</label>
											<select  name="intervention_type" class="select2_select_option custom-select shadow-none form-control">
												<option value="" selected>{{ __('Select') }}</option>
												<option {{ request()->intervention_type == 'Etude' ? 'selected':'' }} value="Etude">Etude</option>
												<option {{ request()->intervention_type == 'Pré-Visite Technico-Commercial' ? 'selected':'' }} value="Pré-Visite Technico-Commercial">Pré-Visite Technico-Commercial</option>
												<option {{ request()->intervention_type == 'Contre Visite Technique' ? 'selected':'' }} value="Contre Visite Technique">Contre Visite Technique</option>
												<option {{ request()->intervention_type == 'Installation' ? 'selected':'' }} value="Installation">Installation</option>
												<option {{ request()->intervention_type == 'SAV' ? 'selected':'' }} value="SAV">SAV</option>
												<option {{ request()->intervention_type == 'Prévisite virtuelle' ? 'selected':'' }} value="Prévisite virtuelle">Prévisite virtuelle</option>
												<option {{ request()->intervention_type == 'Déplacement' ? 'selected':'' }} value="Déplacement">Déplacement</option>
												<option {{ request()->intervention_type == 'DPE' ? 'selected':'' }} value="DPE">DPE</option>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label class="form-label">Travaux</label>
											<select name="travaux" class="select2_select_option custom-select shadow-none form-control">
												<option value="" selected>{{ __('Select') }}</option>
												@foreach ($bareme_travaux_tags->where('rank', 1) as $travaux)
													<option {{ request()->travaux == $travaux->id ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label  class="form-label">Statut planning</label>
											<select name="statut_planning" class="select2_select_option custom-select shadow-none form-control">
												<option value="" selected>{{ __('Select') }}</option>
												@foreach ($status_planning as $item)
													<option {{ request()->statut_planning == $item->name ? 'selected':'' }} value="{{ $item->name }}">{{ $item->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label class="form-label">Profil</label>
											<select name="role" id="roleFilter" class="select2_select_option custom-select shadow-none form-control">
												<option value="" selected>{{ __('Select') }}</option>
												@foreach ($filter_role as $role)
													@if ($all_access)
														<option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
													@else
														@if (role() == $role->value)
															<option {{ request()->role == $role->id ? 'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
														@endif
													@endif 
												@endforeach
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<label class="form-label">Utilisateur</label>
											<select name="user_id" id="filterUserList" class="select2_select_option custom-select shadow-none form-control">
												<option value="" selected>{{ __('Select') }}</option>
												@if (request()->role)
													@foreach ($users->where('role_id', request()->role) as $user)
														<option {{ request()->user_id == $user->id ? 'selected':'' }}  value="{{ $user->id }}">{{ $user->name }}</option>
													@endforeach
												@endif
											</select>
										</div>
									</div>
									<div class="col d-flex"> 
										<div class="form-group">
											<button class="secondary-btn border-0 mr-1" type="submit">{{ __('Submit') }}</button>
										</div>
										@if (\Request::route()->getName() == 'planning.week.menu.filter')
											<div class="form-group">
												@if ($url_status == 1)
													<a href="{{ route('planning.weeks.view', $current_date) }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
												@else
													<a href="{{ route('planning.weeks.view') }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
												@endif
											</div>
										@endif
									</div> 	
								@endif
							</div>
						</form>
					</div>
					<div class="calendar" style="--day-length: {{ $days_in_week }};">
						<div class="calendar-body">
							<div class="calendar__week__row">
								@foreach ($full_week as $week)
									<div class="calendar__week__col">
										<div class="calendar__week__col__header">
											<div class="calendar__week__col__header__top">
												<h4 class="calendar__week__col__header__top__title">{{ $week['day'] }}</h4>
												<div class="calendar__week__col__header__top__number" style="--day-color: {{ $dateColorArr[$loop->index] }}">{{ \Carbon\Carbon::parse($week['date'])->format('d') }}</div>
											</div>
											<div class="calendar__week__col__header__bottom">
												<strong class="calendar__week__col__header__bottom__title">{{ $week['interventions']->count() == 0 ? "": $week['interventions']->count()  }}</strong><span class="calendar__week__col__header__bottom__text">{{ $week['interventions']->count() == 0 ? "Aucune": "" }} intervention{{ $week['interventions']->count() > 1 ? "s": ''  }}</span>
											</div>
										</div>
										@foreach ($week['interventions'] as $intervention)
											<div class="calendar__week__col__body">
												<div class="week-event">
                                                    {{-- <button type="button" class="week-event__arrow week-event__arrow--top" data-toggle="tooltip" data-placement="top"  data-html="true" title='{{ $intervention->getProject->latitude ? ($intervention->getUser ? getPreviousLocation($intervention->getUser->getIntervention, $intervention->Date_intervention, $intervention):'Emplacement introuvable') : 'Emplacement introuvable' }}'> --}}
													<button type="button" class="week-event__arrow week-event__arrow--top getPreviousLocation" data-intervention-id="{{ $intervention->id }}" data-distance="0" data-toggle="tooltip" data-placement="top"  data-html="true" title='Emplacement introuvable'>
                                                        <i class="bi bi-chevron-up"></i>
                                                    </button>
													<div class="week-event__header" style="--event-color: {{ $intervention->getStatusPlanning ? $intervention->getStatusPlanning->background_color : '#ff0000'  }}">{{ $intervention->Statut_planning ?? "No Statut" }}</div>
													<div class="week-event__body interventionEditModal" data-id="{{ $intervention->id }}">
														<ul class="week-event__body__list" style="cursor: pointer;">
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Nom</strong>:
																<span class="week-event__body__list__item__text">{{ $intervention->getProject->Nom.' '.$intervention->getProject->Prenom }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Ville</strong>:
																<span class="week-event__body__list__item__text">{{ $intervention->getProject->Ville }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Code Postal</strong>:
																<span class="week-event__body__list__item__text">{{ $intervention->getProject->Code_Postal }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Téléphone</strong>:
																<span class="week-event__body__list__item__text">{{ $intervention->getProject->phone }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Type d’intervention</strong>:
																<span class="week-event__body__list__item__text">{{ $intervention->type }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Attribué à</strong>:
																<span class="week-event__body__list__item__text">{{ $intervention->getUser->name ?? '' }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Travaux</strong>:
																<span class="week-event__body__list__item__text">
																	@foreach ($intervention->getProject->ProjectTravaux as $travaux)
																		{{ $travaux->tag }} {{ $loop->last ? '':', ' }}
																	@endforeach
																</span>
															</li>
														</ul>
													</div>
                                                    <button type="button" class="week-event__arrow week-event__arrow--bottom getNextLocation" data-toggle="tooltip" data-placement="bottom" data-intervention-id="{{ $intervention->id }}" data-distance="0" data-html="true" title='Emplacement introuvable'>
                                                        <i class="bi bi-chevron-down"></i>
                                                    {{-- <button type="button" class="week-event__arrow week-event__arrow--bottom" data-toggle="tooltip" data-placement="bottom"  data-html="true" title='{{ $intervention->getProject->latitude ? ($intervention->getUser ? getNextLocation($intervention->getUser->getIntervention, $intervention->Date_intervention, $intervention):'Emplacement introuvable'):'Emplacement introuvable' }}'>
                                                        <i class="bi bi-chevron-down"></i> --}}
                                                    </button>
												</div>
											</div> 
										@endforeach
									</div>
									@php
										$i++;
									@endphp
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Right Aside Modal -->
<div class="modal modal--aside fade rightAsideModal" id="rightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
	<div class="modal-dialog m-0 h-100 bg-white">
		<div class="modal-content simple-bar border-0 h-100 rounded-0">
			<div class="modal-header border-0 pb-0">
				<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
					<span class="novecologie-icon-close"></span>
				</button>
			</div>
			<div class="modal-body pt-0">
				<div class="d-flex flex-column align-items-center mb-2">
					<h1 id="addEventheader" class="modal-title text-center">Ajouter une intervention</h1>
				</div>
				<form action="{{ route('planning.intervention.store') }}" class="form" id="addEventForm" method="POST">
					@csrf
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="project_id0">Selection un chantier <span class="text-danger">*</span></label>
								<select class="select2_select_option custom-select shadow-none form-control required_field" data-error-message="Le champ chantier est requis" id="project_id0" name="project_id" required>
									<option value="" selected>{{ __('Select') }}</option>
									@foreach ($projects as $project)
										<option value="{{ $project['id'] }}">{{ $project['Nom'].' '.$project['Prenom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="intervention0">Selection une intervention <span class="text-danger">*</span></label>
								<select class="select2_select_option custom-select shadow-none form-control inteventionChange required_field" data-error-message="Le champ intervention est requis" data-id="0" id="intervention0" name="type" required>
									<option value="" selected>{{ __('Select') }}</option>
									<option value="Etude">Etude</option>
									<option value="Pré-Visite Technico-Commercial">Pré-Visite Technico-Commercial</option>
									<option value="Contre Visite Technique">Contre Visite Technique</option>
									<option value="Installation">Installation</option>
									<option value="SAV">SAV</option>
									<option value="Prévisite virtuelle">Prévisite virtuelle</option>
									<option value="Déplacement">Déplacement</option>
									<option value="DPE">DPE</option>
								</select>
							</div>
						</div>
						<div class="col-12 interventionInfoWrap0" style="display: none">
							<div class="row" id="interventionInfoWrap0">

							</div>
						</div>

						<div class="col-12 text-center">
							<button type="submit" class="secondary-btn primary-btn--md border-0">{{ __('Add') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="renderModal"> 
</div>
@endsection

@push('js')
<script>
	$(document).ready(function () {
		let rendaring = false;
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
                    url  : "{{ route('planning.intervention.modal.render') }}",
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

						const isMobile = () => /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
                        if(isMobile()){
                            $('.waze-mobile-button').removeClass('d-none');
                        }
    
                        @if (role() != 's_admin' && !checkAction(Auth::id(), 'collapse_intervention', 'edit'))
                            $('.intervention_disabled').prop('disabled', true);
                        @endif 
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
                let intervention_id = $(this).data('intervention-id');
                let type = 'previous';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning2.location.distance') }}",
                    data : {intervention_id, type},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $(this).attr('data-original-title', response).tooltip('show');
                        $(this).data('distance', '1');
                        console.log(response);
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
                let intervention_id = $(this).data('intervention-id');
                let type = 'next';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type : "POST",
                    url  : "{{ route('planning2.location.distance') }}",
                    data : {intervention_id, type},
                    success : response => {
                        $(".getPreviousLocation").tooltip('hide');
                        $(".getNextLocation").tooltip('hide');
                        $(this).attr('data-original-title', response).tooltip('show');
                        $(this).data('distance', '1');
                        console.log(response);
                    }
                }); 
            }else{ 
                $(this).tooltip('show');
            }
        }); 

		$('body').on('change', '.intervention_travaux_change', function(){
            let travaux = $(this).val();
            let wrap = $(this).closest('.row').find('.intervention_travaux_product');
            if(travaux){ 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 

                $.ajax({
                    type: "POST",
                    url: "{{ route('intervention.travaux.change2') }}",
                    data: {travaux},
                    success: function (response) { 
                        wrap.html(response);
                    }, 
                    error: function(errors){   
                        wrap.html('<option value="" selected>{{ __("Select") }}</option>');
                    }
                });
            }else{
                wrap.html('<option value="" selected>{{ __("Select") }}</option>');
            }
        });

		$('body').on('click', '.interventionSubmitBtn', function(e){
			e.preventDefault();
            let form = $(this).closest('form');
            let required_input = form.find('.required_field');
            let error_status = false;
            required_input.each(function(){
				if(jQuery.type($(this).val()) == 'array'){ 
                }else{ 
                    if($(this).val() == null || !$(this).val().trim()){
                        $('#errorMessage').html($(this).data('error-message'));
                        $('.toast.toast--error').toast('show');
                        $(this).focus();
                        error_status = true;
                        return false;
                    }
                }
            });
            if(!error_status){
                form.submit();
            }
		});

		$('body').on('change', '#project_id0', function(){
			let type = $('#intervention0').val('').trigger('change');
			$('.interventionInfoWrap0').slideUp();

		});

		$('body').on('change','.other_field__system2', function(){
			let autre_box = $(this).data('autre-box');
            if($(this).val() == 'Oui'){
                $('.'+autre_box).slideDown();
            }else{
                $('.'+autre_box).slideUp();
            }
		});

		$('body').on('change', '.inteventionChange', function(){
			let type = $(this).val();
			if(type){
				let project_id = $('#project_id'+$(this).data('id')).val();
				$('.interventionInfoWrap'+$(this).data('id')).slideUp();
				if(project_id){
					$.ajax({
						type : 'POST',
						url  : '{{ route("planning.intervention.change") }}',
						data : {type, project_id},
						success : response => {
							$('#interventionInfoWrap'+$(this).data('id')).html(response);
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
							$('.interventionInfoWrap'+$(this).data('id')).slideDown();
						}
					})
				}else{
					$('#project_id'+$(this).data('id')).focus();
					$('#errorMessage').text("Veuillez sélectionner un chantier");
					$('.toast.toast--error').toast('show');
				}
			}

		});
		$('body').on('change', '.Statut_planning_input', function(){
            if($(this).val() == 'Annulé' || $(this).val() == 'Reportée'){
                $('.Statut_planning_wrap'+$(this).data('id')).slideDown();
            }else{
                $('.Statut_planning_wrap'+$(this).data('id')).slideUp();
            }
		});
		$('body').on('change', '.Faisabilité_du_chantier_input', function(){
            if($(this).val() == 'Faisable sous condition'){
                $('.Faisabilité_du_chantier_wrap'+$(this).data('id')).slideDown();
                $('.Faisabilité_du_chantier_wrap_Infaisable'+$(this).data('id')).slideUp();
                $('.required_field__optionFaisable_sous_condition'+$(this).data('id')).addClass('required_field');
                $('.required_field__optionInfaisable'+$(this).data('id')).removeClass('required_field');
            }else if($(this).val() == 'Infaisable'){
                $('.Faisabilité_du_chantier_wrap_Infaisable'+$(this).data('id')).slideDown();
                $('.Faisabilité_du_chantier_wrap'+$(this).data('id')).slideUp();
                $('.required_field__optionFaisable_sous_condition'+$(this).data('id')).removeClass('required_field');
                $('.required_field__optionInfaisable'+$(this).data('id')).addClass('required_field');

            }
            else{
                $('.Faisabilité_du_chantier_wrap'+$(this).data('id')).slideUp();
                $('.Faisabilité_du_chantier_wrap_Infaisable'+$(this).data('id')).slideUp();
                $('.required_field__optionFaisable_sous_condition'+$(this).data('id')).removeClass('required_field');
                $('.required_field__optionInfaisable'+$(this).data('id')).removeClass('required_field');

            }
		});

		$('body').on('change', '.Statut_contrat_input', function(){
            if($(this).val() == 'Devis Signé'){
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Signé'+$(this).data('id')).slideDown();
                $('.required_field__option'+$(this).data('id')).addClass('required_field');
            }else if($(this).val() == 'Réflexion'){
                $('.Statut_contrat__Signé'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideDown();
                $('.required_field__option'+$(this).data('id')).removeClass('required_field');
            }else if($(this).val() == 'KO'){
                $('.Statut_contrat__Signé'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideDown();
                $('.required_field__option'+$(this).data('id')).removeClass('required_field');
            }else{
                $('.required_field__option'+$(this).data('id')).removeClass('required_field');
                $('.Statut_contrat__Réflexion'+$(this).data('id')).slideUp();
                $('.Statut_contrat__KO'+$(this).data('id')).slideUp();
                $('.Statut_contrat__Signé'+$(this).data('id')).slideUp();
            }
		});
		$('body').on('click', '.add__new_intervention_travaux__1', function(){
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;

            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="number[]" value="${count}">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count}</label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}" class="select2_select_option form-control intervention_disabled intervention_travaux_change">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-group flex-grow-1">
                                    <label class="form-label" for="travaux">Produit</label>
                                    <select name="product_id[${count}]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product">
                                        <option value="" selected>{{ __('Select') }}</option>
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                                <div class="form-group ml-3 pb-1">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
                        </div>
                        </div>`;
            $('#Statut_contrat__Signé_end'+$(this).data('id')).before(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
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
            $('.intervention_travaux__wrap').slideDown(1000);
		});
		$('body').on('click', '.add__new_intervention_travaux', function(){
            let intervention_id = $(this).data('id');
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;
            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="number[]" value="${count}">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count} <span class="text-danger">*</span></label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}" class="select2_select_option form-control intervention_disabled required_field required_field__option${intervention_id} intervention_travaux_change" data-error-message="Le champ travaux est requis">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6  d-flex align-items-end">
                                <div class="form-group  flex-grow-1">
                                    <label class="form-label" for="travaux">Produit</label>
                                    <select name="product_id[${count}]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product" data-error-message="Le champ produit est requis">
                                        <option value="" selected>{{ __('Select') }}</option> 
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                                <div class="form-group ml-3 pb-1">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
                        </div>
                        </div>`;
            $('#Statut_contrat__Signé_end'+$(this).data('id')).before(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
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
            $('.intervention_travaux__wrap').slideDown(1000);
		});

		$('body').on('click', '.remove__intervention_travaux', function(){
            $(this).closest('.intervention_travaux__wrap').slideUp(function(){
                $(this).remove();
            })
        });

		$('body').on('change','.other_field__system', function(){
			let autre_box = $(this).data('autre-box');
			let input_type = $(this).data('input-type');
			let select_type = $(this).data('select-type');
			if(input_type == 'select'){
				if(select_type == 'single'){
					if($(this).val() == 'Autre'){
						$('.'+autre_box).slideDown();
					}else{
						$('.'+autre_box).slideUp();
					}
				}
			}else if(input_type == 'radio'){
				if($(this).val() == 'Autre'){
					$('.'+autre_box).slideDown();
				}else{
					$('.'+autre_box).slideUp();
				}
			}else if(input_type == 'radio_checkbox'){
				if($(this).is(":checked") && $(this).val() == 'Autre'){
					$('.'+autre_box).slideDown();
				}else{
					$('.'+autre_box).slideUp();
				}
			}
			else{
				if($(this).is(":checked")){
					$('.'+autre_box).slideDown();
				}else{
					$('.'+autre_box).slideUp();
				}
			}

		});

		$('body').on('change', '.Dossier_administratif_complet__input', function(){
            if($(this).val() == 'no'){
                $('.Dossier_administratif_complet__wrap'+$(this).data('id')).slideDown();
            }else{
                $('.Dossier_administratif_complet__wrap'+$(this).data('id')).slideUp();
            }
		});

		$('body').on('click', '.add__new_intervention_travaux__2', function(){
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;

            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <div class="form-group  w-100">
									<input type="hidden" name="number[]" value="${count}">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count}</label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}" class="select2_select_option form-control intervention_disabled">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags->where('rank', 2) as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ml-3 mt-3">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
                        </div>
                        </div>
                        `;
            $('#Travaux_supplémentaires__start'+$(this).data('id')).append(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
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
            $('.intervention_travaux__wrap').slideDown(1000);
		});
		$('body').on('click', '.add__new_intervention_travaux__3', function(){
            let count = +$('.interventionTravauxCount'+$(this).data('id')).val()+1;

            let data = `<div class="intervention_travaux__wrap" style="display:none">
                        <input type="hidden" name="number[]" value="${count}">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="intervention_travaux0${count}">Travaux ${count}</label>
                                    <select name="travaux_id[${count}]" id="intervention_travaux0${count}"  data-travaux-number="${count}" data-travaux-wrap="interventionTravauxControlProjectWrapa${count}" class="select2_select_option interventionTravauxChange form-control intervention_disabled intervention_travaux_change">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($bareme_travaux_tags as $t_travaux)
                                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="form-group flex-grow-1">
                                    <label class="form-label" for="travaux">Produit </label>
                                    <select name="product_id[${count}]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product">
                                        <option value="" selected>{{ __('Select') }}</option> 
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div>
                                <div class="form-group ml-3 pb-1">
                                    <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                </div>
                            </div>
							@if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
								<div class="col-12">
									<div class="card">
										<div class="card-body" style="background-color: #fbfbfb">
											<div class="row">
												<div class="col-12 mt-3 d-flex align-items-center justify-content-between">
													<h4 class="mb-0 mr-2">Réception photos Installation <span class="text-danger">*</span></h4>
													<label class="switch-checkbox switch-checkbox--danger">
														<input type="hidden"  name="Réception_photos_Installation[${count}]" value="no" class="hiddenInput">
														<input type="checkbox" value="yes" data-autre-box="Réception_photos_Installation__${count}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
														<span class="switch-checkbox__label"></span>
													</label>
												</div>
												<div class="col-12 mt-3 Réception_photos_Installation__${count}"  style="display: none">
													<div class="row ">
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="Réception_photos_Installation_Par${count}">Par</label>
																<select name="Réception_photos_Installation_Par[${count}]" id="Réception_photos_Installation_Par${count}" class="select2_select_option form-control intervention_disabled">
																	<option value="" selected>{{ __('Select') }}</option>
																	@foreach ($users as $user)
																		<option value="{{ $user->id }}">{{ $user->name }}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="Réception_photos_Installation_Le${count}">Le </label>
																<input type="date" name="Réception_photos_Installation_Le[${count}]" id="Réception_photos_Installation_Le${count}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
															</div>
														</div>
													</div>
												</div>
												<div class="col-12">
                                                    <div class="form-group">
                                                        <h4 class="mt-2">Contrôle conformité photos</h4>
                                                        <select name="Contrôle_conformité_photos[${count}]" id="Contrôle_conformité_photos${count}" data-error-message="Le champ contrôle conformité photos est requis" data-autre-box="Contrôle_conformité_photos__${count}" class="select2_select_option other_field__system2 form-control intervention_disabled">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
												<div class="col-12 mt-3 Contrôle_conformité_photos__${count}"  style="display: none">
													<div class="row ">
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="Contrôle_conformité_photos_Par${count}">Par</label>
																<select name="Contrôle_conformité_photos_Par[${count}]" id="Contrôle_conformité_photos_Par${count}" class="select2_select_option form-control intervention_disabled">
																	<option value="" selected>{{ __('Select') }}</option>
																	@foreach ($users as $user)
																		<option value="{{ $user->id }}">{{ $user->name }}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="Contrôle_conformité_photos_Le${count}">Le </label>
																<input type="date" name="Contrôle_conformité_photos_Le[${count}]" id="Contrôle_conformité_photos_Le${count}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
															</div>
														</div>
													</div>
													<div class="col-12" id="interventionTravauxControlProjectWrapa${count}">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endif

                        </div>
                        </div>`;
            $('#Statut_Installation__start'+$(this).data('id')).before(data);
            $('.interventionTravauxCount'+$(this).data('id')).val(count)
            $('.select2_select_option').select2();
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
            $('.intervention_travaux__wrap').slideDown(1500);
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
		});


		$('body').on('change', '.Statut_Installation_input', function(){
            if($(this).val() == 'Terminé - Complet'){
                $('.Statut_Installation__incomplete'+$(this).data('id')).slideUp();
                $('.Statut_Installation__complete'+$(this).data('id')).slideDown();
            }else{
                $('.Statut_Installation__complete'+$(this).data('id')).slideUp();
                $('.Statut_Installation__incomplete'+$(this).data('id')).slideDown();
            }
		});

		$('body').on('change', '.interventionTravauxChange', function(){
			let travaux_number = $(this).data('travaux-number');
			let travaux = $(this).val();
			if(travaux){
				$.ajax({
					type: 'POST',
					url : '{{ route("intervention.travaux.change") }}',
					data: {travaux, travaux_number},
					success : response => {
						$('#'+$(this).data('travaux-wrap')).html(response);
					}
				});
			}else{
				$('#'+$(this).data('travaux-wrap')).html('');
			}
		});

		$('body').on('change', '.checkboxChange', function(){
            if($(this).is(':checked')){
                $(this).closest('.switch-checkbox').find('.hiddenInput').val('yes');
            }else{
                $(this).closest('.switch-checkbox').find('.hiddenInput').val('no');
            }
		});

		$('body').on('change', '.Statut_SAV_input', function(){
            if($(this).val() == 'NON RESOLU'){
                $('.Statut_SAV_wrap'+$(this).data('id')).slideDown();
            }else{
                $('.Statut_SAV_wrap'+$(this).data('id')).slideUp();
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

		@if (role() != 's_admin' && !checkAction(Auth::id(), 'collapse_intervention', 'edit'))
            $('.intervention_disabled').prop('disabled', true);
        @endif 
	});

</script>
@endpush


@push('css')
	{{-- <style>
		@for ($i = 1; $i <= $days_in_week; $i++)
		.calendar-body .calendar__row__container__col:nth-of-type({{ $days_in_week }}n + {{ $i }}) {
			grid-column: {{ $i }}/{{ $i }};
		}
		@endfor
	</style> --}}
@endpush
