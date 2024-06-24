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

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/fullcalendar/css/main.min.css') }}">
@endpush

@push('css')
	<style>
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


<section class="py-4 position-relative">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="bg-white p-3 rounded-lg shadow-sm ">
					<div class="mb-2 mb-lg-0">
						<div class="position-lg-absolute text-center text-md-left mb-2 mb-md-0">
							<button data-toggle="modal" id="addNewBtn" data-target="#rightAsideModal" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">Ajouter un Évenement</button>
						</div>
						<div class="planing-navigation text-center mb-2 d-lg-none">
							<div class="btn-group">
								<a href="{{ route('calendar.index') }}" class="btn btn-outline-secondary active">
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
									<a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary">
										<i class="bi bi-geo-alt"></i>
									</a>
                        		@endif		
							</div>
						</div>
					</div>
					<div>
						<div class="planing-navigation text-center mb-2 d-none d-lg-block">
							<div class="btn-group">
								<a href="{{ route('calendar.index') }}" class="btn btn-outline-secondary active">
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
									<a href="{{ route('planning.map.view') }}" class="btn btn-outline-secondary">
										<i class="bi bi-geo-alt"></i>
									</a>
                        		@endif
							</div>
						</div>
						<div class="calendar-wrapper">
							<div id='calendar'></div>
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
			<div class="modal-body">
				<div class="d-flex flex-column align-items-center mb-2">
					<h1 id="addEventheader" class="modal-title text-center">{{ __('Add Event') }}</h1>
					{{-- <a id="client_details_id" class="secondary-btn primary-btn--md d-none border-0">{{ __('Client Details') }}</a> --}}
				</div>
				<form action="{{ route('new.event.store') }}" class="form" id="addEventForm" method="POST">
					@csrf
					<div class="row">
						<div class="col-12">
                            <div class="form-group">
                                <label class="form-label">Type</label>
                                <select name="event_type" class="select2_select_option form-control w-100 eventTypeChange" id="eventTypeChange" required>
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option value="Prospect">Prospect</option>
                                    <option value="Chantier">Chantier</option>
                                </select>
                            </div>
                        </div>
						<div class="col-12">
							<div class="form-group" id="eventTypeChangeWrap">
								{{-- <label class="form-label" for="clientSelect">Client</label>
								<select class="select2_select_option shadow-none form-control" id="clientSelect" name="project_id">
									<option value="" selected>Sélectionnez</option>
									@foreach ($totalProjects as $project)
										<option {{ old('project_id') == $project->id ? 'selected':'' }} value="{{ $project->id }}">{{ $project->Prenom.' '.$project->Nom }} - {{ $project->ProjectTravauxTags()->count() > 0 ? implode(', ', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '' }} - {{ $project->Code_Postal }}</option>
									@endforeach
								</select> --}}
							</div>
							@error('project_id')
							<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
						{{-- <div class="col-12">
							<div class="form-group">
								<label class="form-label" for="clientSelect">Client</label>
								<input type="hidden" name="event_id" id="event_id">
								<select class="select2_select_option shadow-none form-control" id="clientSelect" name="project_id">
									<option value="" selected>Sélectionnez</option>
									@foreach ($projects as $project)
										<option {{ old('project_id') == $project['id'] ? 'selected':'' }} value="{{ $project['id'] }}">{{ $project['Prenom'].' '.$project['Nom'].'-'.$project['tag'].'-'.$project['Code_Postal'] }}</option>
									@endforeach
								</select>
							</div>
							@error('project_id')
							<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div> --}}
						<div class="col-12" id="evnetClientWrap">
                            <div class="form-group">
                                <label class="form-label">Département</label>
                                <input type="text" disabled class="form-control shadow-none px-3">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Travaux</label>
                                <select disabled class="select2_select_option shadow-none form-control">

                                </select>
                            </div>
                        </div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="startDate">Date <span class="text-danger">*</span></label>
								<input type="date" name="date" value="{{ old('date') }}" id="startDate" class="flatpickr form-control shadow-none bg-transparent" required>
							</div>
							<span class="alert text-danger d-none" id="dateError"><span>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="time">Horaire</label>
								<select name="time" id="time" class="select2_select_option form-control w-100">
									@foreach ($min_30_interval as $key => $hour)
										<option {{ old('time') == $key ? 'selected': ''}} value="{{ $key }}">{{ $hour }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="title">Titre</label>
								<input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control shadow-none">
							</div>
							<span class="alert text-danger d-none" id="titleError"></span>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="description">{{ __('Description') }}</label>
								<textarea type="text" id="description" name="description" class="form-control shadow-none">{{ old('description') }}</textarea>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="guest">Invités</label>
								<input type="text" id="guest" name="guest" value="{{ old('guest') }}" class="form-control shadow-none">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="location">Lieu</label>
								<textarea type="text" id="location" name="location" class="form-control shadow-none">{{ old('location') }}</textarea>
							</div>
						</div>
						<div class="col-12 text-center">
							<button type="submit" id="eventAddBtn" class="secondary-btn primary-btn--md border-0 mb-2">{{ __('Submit') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Left Aside Modal -->
<div class="modal modal--aside fade" id="callBackModal" tabindex="-1" aria-labelledby="callBackModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content simple-bar border-0 h-100 rounded-0">
			<div class="modal-header border-0 pb-0">
				<div class="text-center">
					<button type="button" class="btn btn-secondary" id="rapplerTitle">Rappel en cours</button>
					<a target="_blank" href="#!" class="btn btn-primary" id="rapplerViewBtn">Voir chantier</a>
				</div>
				<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
					<span class="novecologie-icon-close"></span>
				</button>
			</div>
			<div class="modal-body">
				<h1 class="modal-title">Detail rappel </h1>
				<table class="user-card__table" id="callbackInfoTable" style="display: block">
					<tbody>
						<tr>
							<td class="user-card__table__heade position-relative">
								<i class="bi bi-file-earmark mr-2"></i>
								<span id="rapplerType"></span>
							</td>
							<td class="position-relative" id="rapplerName"></td>
						</tr>
						<tr>
							<td class="user-card__table__heade position-relative">
								<i class="bi bi-calendar2-week mr-2"></i>
								Date
							</td>
							<td class="position-relative" id="rapplerDate"></td>
						</tr>
						<tr>
							<td class="user-card__table__heade position-relative">
								<i class="bi bi-alarm mr-2"></i>
								Horaire
							</td>
							<td class="position-relative" id="rapplerTime"></td>
						</tr>
						<tr>
							<td class="user-card__table__heade position-relative">
								<i class="bi bi-person mr-2"></i>
								Utilisateur
							</td>
							<td class="position-relative" id="rapplerUser"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
	@if ($errors->has('project_id')||$errors->has('date'))
		@push('js')
			<script>
				$("#rightAsideModal").modal('show');
			</script>
		@endpush
	@endif
@endsection

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/fullcalendar/js/main.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/fullcalendar/js/locales-all.min.js') }}"></script>
@endpush

@push('js')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		var initialLocaleCode = "{{ app()->getLocale() }}";
		let filterCheckbox = document.querySelectorAll(".calendar-filter-checkbox");
		var calendar = new FullCalendar.Calendar(calendarEl, {
			dayMaxEvents: 2,
			initialView: 'dayGridMonth',
			locale: initialLocaleCode,
			headerToolbar: {
				left: 'prev,next',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			timeZone: 'local',
			navLinks: false,
			editable: true,
			selectable: true,
			selectMirror: true,
			eventTimeFormat: {
				hour: 'numeric',
				minute: '2-digit',
				meridiem: 'short',
			},
			eventDrop : function(e) {
				// $('#successMessage').text("Event Updated");
				// $('.toast.toast--success').toast('show');
				// let movement = e.delta.days;
				// let event_id = e.event._def.extendedProps.eventid;
				// $.ajaxSetup({
				// 	headers: {
				// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				// 	}
				// });
				// $.ajax({
				// 	type: "POST",
				// 	url:"{{ route('event.drag') }}",
				// 	data: {
				// 		event_id	:event_id,
				// 		movement	:movement,
				// 	},
				// 	success: function(data){
				// 		console.log(data);
				// 	},
				// });
			},
			dateClick: function(currentDate) {
				$("#addEventForm")[0].reset();
				$('#rightAsideModal').modal('show');
				$('#eventTypeChangeWrap').html(''); 
				$('#eventTypeChange').val("").trigger('change');
				$('#event_id').val('');
				$('#clientSelect').val("").trigger('change');
				$('#time').val("0:00").trigger('change');
				$('#eventAddBtn').html("{{ __('Submit') }}");
				$('#addEventheader').html("{{ __('Add Event') }}");
				 $('#evnetClientWrap').html(`<div class="form-group">
                                <label class="form-label">Département</label>
                                <input type="text" disabled class="form-control shadow-none px-3">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Travaux</label>
                                <select disabled class="select2_select_option shadow-none form-control">

                                </select>
                            </div>`);
				$("#startDate").flatpickr({
					altInput: true,
                    altFormat: 'j F Y',
			        dateFormat: 'Y-m-d',
					locale: "fr",
					defaultDate: currentDate.date,
				});
			},
			eventClick: function(currentEvent) {
				if(currentEvent.event.extendedProps.status == 'event'){
					$('#rightAsideModal').modal('show');
					$("#startDate").flatpickr({
						altInput: true,
                        altFormat: 'j F Y',
                        dateFormat: 'Y-m-d',
                        locale: "fr",
						defaultDate: currentEvent.event.start,
					});

					let id	= currentEvent.event.extendedProps.project_id;
					let event_id = currentEvent.event.extendedProps.eventid;
					let type = currentEvent.event.extendedProps.type;
					$("#title").val(currentEvent.event.extendedProps.event_title);
					$("#location").val(currentEvent.event.extendedProps.location);
					$('#clientSelect').val(id).trigger('change');
					$('#eventTypeChange').val(type).trigger('change');
					$('#time').val(currentEvent.event.extendedProps.time).trigger('change');
					$('#eventAddBtn').html("{{ __('Update') }}");
					$('#addEventheader').html("{{ __('Edit Event') }}");
					$('#event_id').val(event_id);
					$('#description').val(currentEvent.event.extendedProps.description);
					$('#location').val(currentEvent.event.extendedProps.location);
					$('#guest').val(currentEvent.event.extendedProps.guest);

					

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url:"{{ route('event.project.change') }}",
						data: {id, type},
						success: function(data){
							$('#evnetClientWrap').html(data);
							$('.select2_select_option').select2();
							$.ajax({
								url : "{{ route('new.event.type.change2') }}",
								method : 'post',
								data : {id,type},
								success: function (response) {
									console.log(response);
									$('#eventTypeChangeWrap').html(response);
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
								},
							});
						},
					});
				}else{
					$('#rapplerTitle').text(currentEvent.event.extendedProps.rappler_title);
					$('#rapplerType').text(currentEvent.event.extendedProps.rappler_type);
					$('#rapplerName').text(currentEvent.event.extendedProps.rappler_name);
					$('#rapplerDate').text(currentEvent.event.extendedProps.rappler_date);
					$('#rapplerTime').text(currentEvent.event.extendedProps.rappler_time);
					$('#rapplerUser').text(currentEvent.event.extendedProps.rappler_user);
					$('#rapplerViewBtn').text(currentEvent.event.extendedProps.view_btn_text);
					$('#rapplerViewBtn').attr('href',currentEvent.event.extendedProps.view_btn_link);
					$('#callBackModal').modal('show');
				}

			},
			events: function (fetchInfo, successCallback, failureCallback) {
				successCallback([
					@foreach ($events as $item)
						@if ($item->type == 'Prospect')
							{
								eventid		: "{{ $item->id }}",
								title		: '{{ $item->getLead->Nom ?? $item->title }}',
								cid			: "{{ $item->category_id }}",
								date		: '{{ $item->date }}',
								time		: '{{ $item->time }}',
								event_title : '{{ $item->title }}',
								description	: '{{ $item->description }}',
								location	: '{{ $item->location }}',
								guest		: '{{ $item->guest }}',
								project_id	: '{{ $item->project_id }}',
								type	    : '{{ $item->type }}',
								status 		: 'event',
							},
						@endif
						@if ($item->type == 'Chantier')
							{
								eventid		: "{{ $item->id }}",
								title		: '{{ $item->getProject->Nom ?? $item->title }}',
								cid			: "{{ $item->category_id }}",
								date		: '{{ $item->date }}',
								time		: '{{ $item->time }}',
								event_title : '{{ $item->title }}',
								description	: '{{ $item->description }}',
								location	: '{{ $item->location }}',
								guest		: '{{ $item->guest }}',
								project_id	: '{{ $item->project_id }}',
								type	    : '{{ $item->type }}',
								status 		: 'event',
							},
						@endif
					@endforeach
					@foreach ($lead_rapplers as $rappler)
						{
							eventid			: "{{ $rappler->id }}",
							title	 		: "{{ ucwords($rappler->Prenom) .' '. ucwords($rappler->Nom) }}",
							date	   		: '{{ $rappler->callback_time }}',
							status	 		: 'rappler',
							rappler_type	: 'Prospect',
							view_btn_text	: 'Voir prospect',
							view_btn_link	: "{{ route('leads.index',[$rappler->company_id ,$rappler->id]) }}",
							rappler_title	: 'Prospect rappel en cours',
							rappler_name	: "{{ ucwords($rappler->Prenom) .' '. ucwords($rappler->Nom) }}",
							rappler_date	: "{{ \Carbon\Carbon::parse($rappler->callback_time)->format('d-m-Y') }}",
							rappler_time	: "{{ \Carbon\Carbon::parse($rappler->callback_time)->format('H:i') }}",
							rappler_user	: "{{ $rappler->callbackUser->name ?? ''  }}",
						},
					@endforeach
					@foreach ($client_rapplers as $rappler)
						{
							eventid			: "{{ $rappler->id }}",
							title	 		: "{{ ucwords($rappler->Prenom) .' '. ucwords($rappler->Nom) }}",
							date	   		: '{{ $rappler->callback_time }}',
							status	 		: 'rappler',
							rappler_type	: 'Client',
							view_btn_text	: 'Voir client',
							view_btn_link	: "{{ route('client.lead.update', $rappler->id) }}",
							rappler_title	: 'Client rappel en cours',
							rappler_name	: "{{ ucwords($rappler->Prenom) .' '. ucwords($rappler->Nom) }}",
							rappler_date	: "{{ \Carbon\Carbon::parse($rappler->callback_time)->format('d-m-Y') }}",
							rappler_time	: "{{ \Carbon\Carbon::parse($rappler->callback_time)->format('H:i') }}",
							rappler_user	: "{{ $rappler->callbackUser->name ?? ''  }}",
						},
					@endforeach
					@foreach ($project_rapplers as $rappler)
						{
							eventid			: "{{ $rappler->id }}",
							title	 		: "{{ ucwords($rappler->Prenom) .' '. ucwords($rappler->Nom) }}",
							date	   		: '{{ $rappler->callback_time }}',
							status	 		: 'rappler',
							rappler_type	: 'Chantier',
							view_btn_text	: 'Voir chantier',
							view_btn_link	: "{{ route('files.index', $rappler->id) }}",
							rappler_title	: 'Chantier rappel en cours',
							rappler_name	: "{{ ucwords($rappler->Prenom) .' '. ucwords($rappler->Nom) }}",
							rappler_date	: "{{ \Carbon\Carbon::parse($rappler->callback_time)->format('d-m-Y') }}",
							rappler_time	: "{{ \Carbon\Carbon::parse($rappler->callback_time)->format('H:i') }}",
							rappler_user	: "{{ $rappler->callbackUser->name ?? ''  }}",
						},
					@endforeach
				]);
			},
			eventDidMount: function (arg) {
				filterCheckbox.forEach(function (v) {
					if (v.checked) {
						if (arg.event.extendedProps.cid === v.value) {
							arg.el.style.display = "flex";
						}
					} else {
						if (arg.event.extendedProps.cid === v.value) {
							arg.el.style.display = "none";
						}
					}
				});
			},
		});
		calendar.getOption('locale', 'fr');
		calendar.render();

		filterCheckbox.forEach(function (el) {
			el.addEventListener("change", function () {
				calendar.refetchEvents();
			});
		});
	});

	$("#addNewBtn").click(function(){
		$("#addEventForm")[0].reset();
		$('#event_id').val('');
		$('#rightAsideModal').modal('show');
		$('#eventTypeChangeWrap').html('');
		$('#eventTypeChange').val("").trigger('change');
		$('#clientSelect').val("").trigger('change');
		$('#time').val("0:00").trigger('change');
		$('#eventAddBtn').html("{{ __('Submit') }}");
		$('#addEventheader').html("{{ __('Add Event') }}");
		$('#evnetClientWrap').html(`<div class="form-group">
			<label class="form-label">Département</label>
			<input type="text" disabled class="form-control shadow-none px-3">
		</div>
		<div class="form-group">
			<label class="form-label">Travaux</label>
			<select disabled class="select2_select_option shadow-none form-control">

			</select>
		</div>`);

		$('#startDate').val('');
	});


	$('body').on('change','#clientSelect',function(e){
		var id = $(this).val();
		var type = $("#eventTypeChange").val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url:"{{ route('event.project.change') }}",
			data: {id, type},

			success: function(data){
				$('#evnetClientWrap').html(data);
				$('.select2_select_option').select2();
			},
		});
	});

	$('body').on('change', '.eventTypeChange',function(){
		let type = $(this).val(); 
		$.ajax({
			url : "{{ route('new.event.type.change') }}",
			method : 'post',
			data : {type},
			success: function (response) {
				console.log(response);
				$('#eventTypeChangeWrap').html(response);
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
			},
		});
	});
	$('#addEventForm').on('submit', function(e){
		e.preventDefault();
		if(!$('#startDate').val()){
			$('#dateError').removeClass('d-none');
			$('#dateError').text('La date est requise');
			$('#startDate').focus();
		}else if(!$('#clientSelect').val() && !$('#title').val()){
			$('#titleError').removeClass('d-none');
			$('#titleError').text('Le titre est requis');
			$('#title').focus();
		}else{
			$('#addEventForm')[0].submit();
		}
	});
</script>
@endpush
