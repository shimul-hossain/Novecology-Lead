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
@endpush

{{-- Main Content Part  --}}
@section('content')

@php
	$days_in_month = 31;
@endphp

<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		<div class="row bg-white py-3 rounded-lg shadow-sm">
			<div class="col-lg-2">
				<div class="text-center text-md-left">
					@if (checkAction(Auth::id(), 'calendar', 'add event') || role() == 's_admin') 
					<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="addEvent-btn primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">{{ __('Add Event') }}</button>
					@endif
					<button data-toggle="modal" data-target="#leftAsideModal" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 mt-3">{{ __('Add Event Category') }}</button>
				</div>
				<h4 class="mt-4 mb-3">{{ __('Filters') }}</h4>
				@foreach ($category as $item)
				<div class="calendar-filter-card d-flex align-items-center" style="background-color: {{ $item->color }}">
					<p class="calendar-filter-card__text mb-0">{{ $item->name }}</p>
					<div class="custom-control custom-checkbox mb-0 ml-auto">
						<input value="{{ $item->id }}" type="checkbox" class="custom-control-input calendar-filter-checkbox" id="eventFilterCheck-{{ $item->id }}" checked>
						<label class="custom-control-label" for="eventFilterCheck-{{ $item->id }}"></label>
					</div>
					{{-- <button type="button" class="calendar-filter-card__action-btn">
						<i class="bi bi-pencil-square"></i>
					</button>
					<button type="button" class="calendar-filter-card__action-btn">
						<i class="bi bi-trash3-fill"></i>
					</button> --}}
				</div>
				@endforeach 
			</div>
			<div class="col-lg-10">
				<div class="calendar" style="--day-length: {{ $days_in_month }};">
					<div class="calendar-header">
						<div class="calendar-header__top">
							<button class="calendar-header__top__btn">
								<i class="bi bi-chevron-left"></i>
							</button>
							<h3 class="calendar-header__top__title">October 2022</h3>
							<button class="calendar-header__top__btn">
								<i class="bi bi-chevron-right"></i>
							</button>
						</div>
						<div class="calendar__row">
							<div class="calendar__row__item">
								<div class="calendar__row__item__filter">
									<input type="search" name="filter" class="calendar__row__item__filter__input" placeholder="Filter">
								</div>
							</div>
							<div class="calendar__row__container">
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-01">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">01</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-02">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">02</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-03">
										<span class="calendar__row__container__col__date__name">M</span>
										<span class="calendar__row__container__col__date__number">03</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-04">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">04</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-05">
										<span class="calendar__row__container__col__date__name">W</span>
										<span class="calendar__row__container__col__date__number">05</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-06">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">06</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-07">
										<span class="calendar__row__container__col__date__name">F</span>
										<span class="calendar__row__container__col__date__number">07</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-08">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">08</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-09">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">09</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-10">
										<span class="calendar__row__container__col__date__name">M</span>
										<span class="calendar__row__container__col__date__number">10</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-11">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">11</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-12">
										<span class="calendar__row__container__col__date__name">W</span>
										<span class="calendar__row__container__col__date__number">12</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-13">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">13</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-14">
										<span class="calendar__row__container__col__date__name">F</span>
										<span class="calendar__row__container__col__date__number">14</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-15">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">15</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-16">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">16</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-17">
										<span class="calendar__row__container__col__date__name">M</span>
										<span class="calendar__row__container__col__date__number">17</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-18">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">18</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-19">
										<span class="calendar__row__container__col__date__name">W</span>
										<span class="calendar__row__container__col__date__number">19</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-20">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">20</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-21">
										<span class="calendar__row__container__col__date__name">F</span>
										<span class="calendar__row__container__col__date__number">21</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-22">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">22</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-23">
										<span class="calendar__row__container__col__date__name">S</span>
										<span class="calendar__row__container__col__date__number">23</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-24">
										<span class="calendar__row__container__col__date__name">M</span>
										<span class="calendar__row__container__col__date__number">24</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-25">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">25</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-26">
										<span class="calendar__row__container__col__date__name">W</span>
										<span class="calendar__row__container__col__date__number">26</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-27">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">27</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-28">
										<span class="calendar__row__container__col__date__name">F</span>
										<span class="calendar__row__container__col__date__number">28</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-29">
										<span class="calendar__row__container__col__date__name">W</span>
										<span class="calendar__row__container__col__date__number">29</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-30">
										<span class="calendar__row__container__col__date__name">T</span>
										<span class="calendar__row__container__col__date__number">30</span>
									</time>
								</div>
								<div class="calendar__row__container__col">
									<time class="calendar__row__container__col__date" datetime="2022-10-31">
										<span class="calendar__row__container__col__date__name">F</span>
										<span class="calendar__row__container__col__date__number">31</span>
									</time>
								</div>
							</div>
						</div>
					</div>
					<div class="calendar-body">
						<div class="calendar__row">
							<div class="calendar__row__item">
								<div class="calendar__row__item__list" style="background-color: #22f7b0">
									<span class="calendar__row__item__list__text">Material Resource 1 frgf fewferewfrwrff</span>
								</div>
							</div>
							<div class="calendar__row__container" style="--total-event-layer: 3;">
								@for ($i = 1; $i <= $days_in_month; $i++)
									<div class="calendar__row__container__col" data-date="2022-10-{{ $i <= 9 ? '0' : '' }}{{ $i }}"></div>
								@endfor
								<div class="calendar__row__container__event" style="--event-color: #f8254e; --event-start: 2; --event-end: 2; --event-layer: 1;">
									<div class="calendar__row__container__event__card">
										<span class="calendar__row__container__event__text">Event Danger</span>
									</div>
									<div class="calendar__row__container__event__details">
										<h3 class="calendar__row__container__event__details__title">Event Danger</h3>
										<p class="calendar__row__container__event__details__text">Nom</p>
										<p class="calendar__row__container__event__details__text">Prenom</p>
										<p class="calendar__row__container__event__details__text">Projet</p>
										<p class="calendar__row__container__event__details__text">Departement</p>
									</div>
								</div>
								<div class="calendar__row__container__event" style="--event-color: #fc9b10; --event-start: 10; --event-end: 17; --event-layer: 2;">
									<div class="calendar__row__container__event__card">
										<span class="calendar__row__container__event__text">Event Warning</span>
									</div>
									<div class="calendar__row__container__event__details">
										<h3 class="calendar__row__container__event__details__title">Event Warning</h3>
										<p class="calendar__row__container__event__details__text">Nom</p>
										<p class="calendar__row__container__event__details__text">Prenom</p>
										<p class="calendar__row__container__event__details__text">Projet</p>
										<p class="calendar__row__container__event__details__text">Departement</p>
									</div>
								</div>
								<div class="calendar__row__container__event" style="--event-color: #0a5eff; --event-start: 6; --event-end: 10; --event-layer: 3;">
									<div class="calendar__row__container__event__card">
										<span class="calendar__row__container__event__text">Event Info</span>
									</div>
									<div class="calendar__row__container__event__details">
										<h3 class="calendar__row__container__event__details__title">Event Info</h3>
										<p class="calendar__row__container__event__details__text">Nom</p>
										<p class="calendar__row__container__event__details__text">Prenom</p>
										<p class="calendar__row__container__event__details__text">Projet</p>
										<p class="calendar__row__container__event__details__text">Departement</p>
									</div>
								</div>
							</div>
						</div>
						<div class="calendar__row">
							<div class="calendar__row__item">
								<div class="calendar__row__item__list" style="background-color: #22f7ed">
									<span class="calendar__row__item__list__text">Material Resource 3</span>
								</div>
							</div>
							<div class="calendar__row__container" style="--total-event-layer: 2;">
								@for ($i = 1; $i <= $days_in_month; $i++)
									<div class="calendar__row__container__col" data-date="2022-10-{{ $i <= 9 ? '0' : '' }}{{ $i }}"></div>
								@endfor
								<div class="calendar__row__container__event" style="--event-color: #f8254e; --event-start: 2; --event-end: 5; --event-layer: 1;">
									<div class="calendar__row__container__event__card">
										<span class="calendar__row__container__event__text">Event Danger</span>
									</div>
									<div class="calendar__row__container__event__details">
										<h3 class="calendar__row__container__event__details__title">Event Danger</h3>
										<p class="calendar__row__container__event__details__text">Nom</p>
										<p class="calendar__row__container__event__details__text">Prenom</p>
										<p class="calendar__row__container__event__details__text">Projet</p>
										<p class="calendar__row__container__event__details__text">Departement</p>
									</div>
								</div>
								<div class="calendar__row__container__event" style="--event-color: #0a5eff; --event-start: 8; --event-end: 13; --event-layer: 2;">
									<div class="calendar__row__container__event__card">
										<span class="calendar__row__container__event__text">Event Info</span>
									</div>
									<div class="calendar__row__container__event__details">
										<h3 class="calendar__row__container__event__details__title">Event Info</h3>
										<p class="calendar__row__container__event__details__text">Nom</p>
										<p class="calendar__row__container__event__details__text">Prenom</p>
										<p class="calendar__row__container__event__details__text">Projet</p>
										<p class="calendar__row__container__event__details__text">Departement</p>
									</div>
								</div>
							</div>
						</div>
						<div class="calendar__row">
							<div class="calendar__row__item">
								<div class="calendar__row__item__list" style="background-color: #22f7b0">
									<span class="calendar__row__item__list__text">Material Resource 5</span>
								</div>
							</div>
							<div class="calendar__row__container" style="--total-event-layer: 1;">
								@for ($i = 1; $i <= $days_in_month; $i++)
									<div class="calendar__row__container__col" data-date="2022-10-{{ $i <= 9 ? '0' : '' }}{{ $i }}"></div>
								@endfor
								<div class="calendar__row__container__event" style="--event-color: #fc9b10; --event-start: 7; --event-end: 17; --event-layer: 1;">
									<div class="calendar__row__container__event__card">
										<span class="calendar__row__container__event__text">Event Warning</span>
									</div>
									<div class="calendar__row__container__event__details">
										<h3 class="calendar__row__container__event__details__title">Event Warning</h3>
										<p class="calendar__row__container__event__details__text">Nom</p>
										<p class="calendar__row__container__event__details__text">Prenom</p>
										<p class="calendar__row__container__event__details__text">Projet</p>
										<p class="calendar__row__container__event__details__text">Departement</p>
									</div>
								</div>
							</div>
						</div>
						<div class="calendar__row">
							<div class="calendar__row__item">
								<div class="calendar__row__item__list" style="background-color: #22f7b0">
									<span class="calendar__row__item__list__text">Material Resource 5</span>
								</div>
							</div>
							<div class="calendar__row__container" style="--total-event-layer: 1;">
								@for ($i = 1; $i <= $days_in_month; $i++)
									<div class="calendar__row__container__col" data-date="2022-10-{{ $i <= 9 ? '0' : '' }}{{ $i }}"></div>
								@endfor
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
			<div class="modal-body">
				<div class="d-flex flex-column align-items-center mb-2">
					<h1 id="addEventheader" class="modal-title text-center">{{ __('Add Event') }}</h1>
					<a id="client_details_id" class="secondary-btn primary-btn--md d-none border-0">{{ __('Client Details') }}</a>
				</div>
				<form action="{{ route('event.store') }}" class="form" id="addEventForm" method="POST">
					@csrf
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
								<input type="text" name="title" id="title" class="form-control shadow-none" placeholder="{{ __('Event Title') }}">
								<input type="hidden" name="event_id" id="event_id" value="">
								@error('title')
								<span class="alert text-danger">{{ $message }} **</span>								
								@enderror
							</div>
						</div>
						<div class="col-12 mb-3">
							<div class="form-group" id="categorySelectWrapper">
								<label class="form-label" for="categorySelect">{{ __('Category') }} <span class="text-danger">*</span></label>  
								<select class="custom-select shadow-none form-control" name="category_id" id="categorySelect">
									<option value="">{{ __('Select') }}</option>
									@foreach ($category as $item)
									<option id="selected{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach 
								</select>
							</div>
							@error('category_id')
							<span class="alert text-danger">{{ $message }} **</span>								
							@enderror
						</div>
						<div class="col-12 mb-3">
							<div class="form-group" id="UserSelectWrapper">
								<label class="form-label" for="UserSelect">{{ __('Assignee') }} <span class="text-danger">*</span></label>  
								<select class="select2_select_option custom-select shadow-none form-control" name="user_id[]" id="UserSelect" multiple required> 
									@foreach ($users as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach 
								</select>
							</div>
							@error('category_id')
							<span class="alert text-danger">{{ $message }} **</span>								
							@enderror
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="startDate">{{ __('Start Date') }} <span class="text-danger">*</span></label>
								<input type="datetime" name="start_date" id="startDate" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select start date') }}">
								@error('start_date')
								<span class="alert text-danger">{{ $message }} **</span>								
								@enderror
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="endDate">{{ __('End Date') }}</label>
								<input type="datetime" id="endDate" name="end_date" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select End date') }}">
								@error('end_date')
								<span class="alert text-danger">{{ $message }} **</span>								
								@enderror
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" name="all_day" value="yes" id="customSwitch1">
									<label class="custom-control-label" for="customSwitch1">{{ __('All Day') }}</label>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="clientSelect">{{ __('Client') }} <span class="text-danger">*</span></label>
								<select class="custom-select shadow-none form-control" id="clientSelect" name="client_id">
									<option value="">{{ __('Select') }}</option>
									@foreach ($clients as $item)
										@if ($client && $client->id == $item->id) 
										<option id="clientSeleted{{ $item->id }}" selected value="{{ $item->id }}">{{ $item->first_name }}</option>
										@else
										<option id="clientSeleted{{ $item->id }}" value="{{ $item->id }}">{{ $item->first_name }}</option>
										@endif
									@endforeach 
								</select>
							</div>
							@error('client')
							<span class="alert text-danger">{{ $message }} **</span>								
							@enderror
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="projectSelect">{{ __('Project') }} <span class="text-danger">*</span></label>
								<select class="custom-select shadow-none form-control" id="projectSelect" name="project_id">
									<option value="">{{ __('Select') }}</option>
									@if($client)
										 @foreach (getProject($client->id) as $item)
										 <option value="{{ $item->id }}">{{ $item->project_name }}</option>
										 @endforeach
									@endif 
								</select>
							</div> 
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="location">{{ __('Location') }} <span class="text-danger">*</span></label>
								<input type="text" id="location" name="location" class="form-control shadow-none" placeholder="{{ __('Enter Location') }}">
								@error('location')
								<span class="alert text-danger">{{ $message }} **</span>								
								@enderror
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="description">{{ __('Description') }}</label>
								<textarea type="text" id="description" name="description" class="form-control shadow-none"></textarea>
								@error('description')
								<span class="alert text-danger">{{ $message }} **</span>								
								@enderror
							</div>
						</div>
						<div class="col-12 text-center">
							<button id="eventAddButton" type="submit" class="secondary-btn primary-btn--md border-0 mb-2">{{ __('Add') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Left Aside Modal -->
<div class="modal modal--aside fade leftAsideModal" id="leftAsideModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
	<div class="modal-dialog m-0 h-100 bg-white">
	<div class="modal-content simple-bar border-0 h-100 rounded-0">
		<div class="modal-header border-0">
			<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
				<span class="novecologie-icon-close"></span>
			</button>
		</div>
		<div class="modal-body">
			<h1 id="updatedCategoryTitle" class="modal-title text-center mb-5">{{ __('Add Category') }}</h1>
			<form action="{{ route('category.store') }}" class="form" method="POST">
				@csrf
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<input type="text" id="categoryId" name="name" class="form-control shadow-none" placeholder="{{ __('Category Name') }}*">
							<input type="hidden" id="existing_category_id" name="existing_category_id" value="">
							@error('name')
								<span class="alert text-danger">{{ $message }} **</span>								
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							{{-- <select class="custom-select shadow-none form-control" id="select" name="color">
								<option data-display="Select Colour" value="">Select Colour *</option>
								<option class="selectColor" value="event--primary">Primary</option>
								<option class="selectColor" value="event--success">Success</option>
								<option class="selectColor" value="event--danger">danger</option>
								<option class="selectColor" value="event--info">info</option>
								<option class="selectColor" value="event--warning">warning</option>
								<option class="selectColor" value="event--purple">purple</option>
								<option class="selectColor" value="event--cyan">cyan</option>
								<option class="selectColor" value="event--pest">Pest</option>
								<option class="selectColor" value="event--pink">pink</option>
								<option class="selectColor" value="event--light-green">light green</option>
								<option class="selectColor" value="event--dark-green">dark green</option>
								<option class="selectColor" value="event--charleston-green">charleston green</option>
								<option class="selectColor" value="event--magenta">magenta</option>
								<option class="selectColor" value="event--darken">darken</option>
								<option class="selectColor" value="event--teal">teal</option>
								<option class="selectColor" value="event--light-blue">light blue</option>
								<option class="selectColor" value="event--blue">blue</option>
								<option class="selectColor" value="event--dark-blue">dark blue</option>
								<option class="selectColor" value="event--dark-orange">dark orange</option>
								<option class="selectColor" value="event--majorelle-blue">majorelle blue</option>
								<option class="selectColor" value="event--dark-slate-blue">dark-slate blue</option>
								<option class="selectColor" value="event--rosy-brown">rosy brown</option>
								<option class="selectColor" value="event--camel">camel</option>
								<option class="selectColor" value="event--black-coral">black coral</option>
								<option class="selectColor" value="event--dark-purple">dark purple</option>
								<option class="selectColor" value="event--dark-goldenrod">dark goldenrod</option>
								<option class="selectColor" value="event--davys-grey">davys grey</option>
								<option class="selectColor" value="event--key-lime">key lime</option>
								<option class="selectColor" value="event--yellow">yellow</option>
								<option class="selectColor" value="event--alabaster">alabaster</option>
								<option class="selectColor" value="event--antique-ruby">antique ruby</option>
								<option class="selectColor" value="event--russian-violet">russian violet</option>
								<option class="selectColor" value="event--charcoal">charcoal</option>
								<option class="selectColor" value="event--cadet">cadet</option>
								<option class="selectColor" value="event--feldgrau">feldgrau</option>
								<option class="selectColor" value="event--russian-green">russian green</option>
								<option class="selectColor" value="event--dark-lava">dark-lava</option>
								<option class="selectColor" value="event--lilac-luster">lilac luster</option>
								<option class="selectColor" value="event--tart-orange">tart orange</option>
								<option class="selectColor" value="event--true-blue">true blue</option>
								<option class="selectColor" value="event--chocolate-traditional">chocolate traditional</option>
								<option class="selectColor" value="event--queen-blue">queen blue</option>
								<option class="selectColor" value="event--yellow-green">yellow green</option>
								<option class="selectColor" value="event--popstar">popstar</option>
								<option class="selectColor" value="event--opal">opal</option>
								<option class="selectColor" value="event--gainsboro">gainsboro</option>
								<option class="selectColor" value="event--sea-green-crayola">sea green crayola</option>
								<option class="selectColor" value="event--orange-yellow-crayola">orange yellow crayola</option>
								<option class="selectColor" value="event--lemon-meringue">lemon meringue</option>
								<option class="selectColor" value="event--tea-green">tea green</option>
							</select> --}}
							<input type="color" name="color" class="form-control shadow-none">
							@error('color')
								<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
					</div> 
					<div class="col-12 text-center">
						<button id="updatedCategoryButton" type="submit" class="primary-btn primary-btn--primary primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0 mt-3">{{ __('Add') }} </button> 
					</div>
				</div> 
			</form>
			<h1 class="modal-title text-center my-5">{{ __('All Event Category') }}</h1>
			<div class="col-12 px-3">
				<div class="database-table-wrapper bg-white border">
					<div class="table-responsive simple-bar">
						<table class="table database-table w-100 mb-0">
							<thead class="database-table__header">
								<tr>
									<th>{{ __('Serial') }}</th> 
									<th>{{ __('Category Name') }}</th>
									<th>{{ __('Color Name') }}</th> 
									<th class="text-center">{{ __('Action') }}</th>
								</tr>
							</thead>
							<tbody class="database-table__body">
								@foreach ($category as $item)
									<tr> 
										<td>{{ $loop->iteration }}</td> 
										<td id="categoryName{{ $item->id }}">{{ $item->name }}</td>
										<td id="categoryColor{{ $item->id }}">{{ $item->color }}</td> 
										<td class="text-center">
											<div class="dropdown dropdown--custom p-0 d-inline-block">
												<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="novecologie-icon-dots-horizontal-triple"></span>
												</button>
												<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
													<button data-id="{{ $item->id }}" type="button" class="dropdown-item border-0 editEventCategory">
														<span class="novecologie-icon-edit mr-1"></span>
														{{ __('Edit') }}
													</button> 
													<form action="{{ route('event.category.delete') }}" method="POST">
														@csrf
														<input type="hidden" name="event_category_id" value="{{ $item->id }}">
														<button type="submit" class="dropdown-item border-0">
															<span class="novecologie-icon-trash mr-1"></span> 
																{{ __('Delete') }} 
														</button>
													</form>
												</div>
											</div>
										</td>
									</tr> 	
								@endforeach
								{{-- <tr>
										
									<td>l:2874793949439305</td>
									
									<td>+33666098000</td>
									<td>redonromuald@hotmail.fr</td>
									
										
									<td>
										<div class="d-flex align-items-center justify-content-around"> 
											<div class="navbar dropdown dropdown--custom p-0 d-inline-block">
												<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="novecologie-icon-dots-horizontal-triple"></span>
												</button>
												<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
													<button type="button" class="dropdown-item border-0">
														<span class="novecologie-icon-edit mr-1"></span>
														Edit
													</button>
													<button type="button" class="dropdown-item border-0">
														<span class="novecologie-icon-trash mr-1"></span>
														Delete
													</button>
												</div>
											</div>
										</div>
									</td>
								</tr>  --}}
							</tbody>
						</table>
					</div>
					{{-- <div class="pagination-wrapper">
						<nav>
							<ul class="pagination">
								<li class="page-item disabled">
									<a class="page-link" href="#!" rel="prev" aria-label="« Previous">‹</a>
								</li>	
								<li class="page-item active" aria-current="page">
									<span class="page-link">1</span>
								<li class="page-item">
									<a class="page-link" href="#!">2</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">3</a>
								</li>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">4</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">...</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">52</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!" rel="next" aria-label="Next »">›</a>
								</li>
							</ul>
						</nav>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
		@if ($errors->has('name')||$errors->has('color'))
			@push('js')
			<script>
			$("#leftAsideModal").modal('show');
			</script>  
			@endpush
		@endif

		@if ($errors->has('title')||$errors->has('category_id')||$errors->has('start_date')||$errors->has('location')||$errors->has('description'))
			@push('js')
			<script>
			$("#rightAsideModal").modal('show');
			</script>
			@endpush
		@endif
@endsection

@push('js')
<script>
	$(document).ready(function () {
		$(".addEvent-btn").click(function(){
			$("#addEventForm")[0].reset();
			$('#eventAddButton').text("{{ __('Add') }}");
			$('#projectSelect').html("<option value='' disabled>{{ __('Select') }}</option>");
			$("#UserSelect").val(null).trigger("change");
			$('#client_details_id').removeClass("d-inline-block");
			$('#client_details_id').addClass("d-none");			
		});

		$(".flatpickr").flatpickr({
			altInput: true,
			enableTime: true,
			// altFormat: "d-m-Y",
			// dateFormat: "Y-m-d",
		});

		$('.editEventCategory').click(function(){
			var id = $(this).attr('data-id');
			var name = $('#categoryName'+id).text();
			var color = $('#categoryColor'+id).text();
			$('#updatedCategoryTitle').text("{{ __('Update Category') }}");
			$('#updatedCategoryButton').text("{{ __('Update') }}");
			$('#existing_category_id').val(id);
			$('#categoryId').val(name); 

			$('.selectColor').each(function(){
				if($(this).attr('value') == color){
					$(this).attr('selected', true);
				};
			}); 

		});

		$('#eventAddButton').click(function(e){
			e.preventDefault();
			var title 			= $('#title').val();
			var categorySelect = $('#categorySelect').val();
			var UserSelect 	= $('#UserSelect').val();
			var startDate 		= $('#startDate').val();
			var clientSelect 	= $('#clientSelect').val(); 
			var projectSelect 	= $('#projectSelect').val(); 
			var location 		= $('#location').val(); 
	
			if( title == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Title') }}");
				$('.toast.toast--error').toast('show');  
				$('#title').focus(); 
			}

			else if(categorySelect == ''){
				$('#errorMessage').text("{{ __('Please Select Category') }}");
				$('.toast.toast--error').toast('show');  
				$('#categorySelect').focus(); 
			}
			else if(UserSelect == null){
				$('#errorMessage').text("{{ __('Please Select Assignee') }}");
				$('.toast.toast--error').toast('show');  
				$('#UserSelect').focus(); 
			}
			else if(startDate == ''){
				$('#errorMessage').text("{{ __('Please Select Start Date') }}");
				$('.toast.toast--error').toast('show');  
				$('#startDate').focus(); 
			}
			else if(clientSelect == ''){
				$('#errorMessage').text("{{ __('Please Select Client') }}");
				$('.toast.toast--error').toast('show');  
				$('#clientSelect').focus(); 
			}
			else if(projectSelect == ''){
				$('#errorMessage').text("{{ __('Please Select Project') }}");
				$('.toast.toast--error').toast('show');  
				$('#projectSelect').focus(); 
			}
			else if(location == ''){
				$('#errorMessage').text("{{ __('Please Enter Location') }}");
				$('.toast.toast--error').toast('show');  
				$('#location').focus(); 
			}
	
			else{
				$('#addEventForm').submit();
			}

		});

		$('#clientSelect').change(function(e){
			var id = $(this).val();
			if(id != ''){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST", 
				url:"{{ route('event.client.project') }}",
				data: {
					client_id	:id, 
				},

				success: function(data){
					$('#projectSelect').html(data);
				}, 
			}); 
			} 
		});

		$(document).on("click", ".calendar-body .calendar__row__container__col", function(){
			$("#startDate").flatpickr({
				altInput: true,
				enableTime: true,
				defaultDate: $(this).data("date"),
			});
			$("#endDate").flatpickr({
				altInput: true,
				enableTime: true,
				minDate: $(this).data("date"),
				defaultDate: "",
			}).clear();
			$('#rightAsideModal').modal('show');
		});
	});
	
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
 