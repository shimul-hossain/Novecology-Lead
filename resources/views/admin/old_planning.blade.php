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

{{-- Main Content Part  --}}
@section('content')
<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		<div class="row bg-white py-3 rounded-lg shadow-sm">
			<div class="col-lg-2 mb-2 mb-lg-0">
				<div class="planing-navigation text-center mb-2 d-lg-none">
					<div class="btn-group">
						<a href="{{ Route('calendar.index') }}" class="btn btn-outline-secondary active">
							<i class="bi bi-calendar2-week"></i>
						</a>
						<a href="{{ Route('calendar.weeks') }}" class="btn btn-outline-secondary">
							<i class="bi bi-card-list"></i>
						</a>
						<a href="{{ Route('planning.map') }}" class="btn btn-outline-secondary">
							<i class="bi bi-geo-alt"></i>
						</a>
					</div>
				</div>
				<div class="text-center text-lg-left">
					@if (checkAction(Auth::id(), 'calendar', 'add event') || role() == 's_admin')
						<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="addEvent-btn primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 w-100">{{ __('Add Event') }}</button>
					@else
						<button type="button" class="addEvent-btn primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 w-100"><span class="novecologie-icon-lock py-1"></span> {{ __('Add Event') }}</button>
					@endif
					@if (checkAction(Auth::id(), 'event_category', 'create') || role() == 's_admin')
						<button data-toggle="modal" data-target="#leftAsideModal" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 mt-3 w-100">{{ __('Add Event Category') }}</button>
					@else
						<button  type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 mt-3 w-100"><span class="novecologie-icon-lock py-1 mr-1"></span>  {{ __('Add Event Category') }}</button>
					@endif
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
				<div class="planing-navigation text-center mb-2 d-none d-lg-block">
					<div class="btn-group">
						<a href="{{ Route('calendar.index') }}" class="btn btn-outline-secondary active">
							<i class="bi bi-calendar2-week"></i>
						</a>
						<a href="{{ Route('calendar.weeks') }}" class="btn btn-outline-secondary">
							<i class="bi bi-card-list"></i>
						</a>
						<a href="{{ Route('planning.map') }}" class="btn btn-outline-secondary">
							<i class="bi bi-geo-alt"></i>
						</a>
					</div>
				</div>
				<div class="calendar-header">
					<div class="calendar-header__top">
						<a href="{{ route('calendar.index',[$client ? $client->id:0, $prev_month]) }}" class="calendar-header__top__btn">
							<i class="bi bi-chevron-left"></i>
						</a>
						<h3 class="calendar-header__top__title">{{ $month }}</h3>
						<a href="{{ route('calendar.index',[$client ? $client->id:0, $next_month]) }}" class="calendar-header__top__btn">
							<i class="bi bi-chevron-right"></i>
						</a>
					</div>
				</div>
				<div class="calendar" style="--day-length: {{ $days_in_month }};">
					<div class="calendar-header">
						<div class="calendar__row">
							<div class="calendar__row__item">
								<div class="calendar__row__item__filter">
									<input type="search" id="calendar__row__item__filter__search" name="filter" class="calendar__row__item__filter__input" placeholder="Filtre">
								</div>
							</div>
							<div class="calendar__row__container">
								@foreach ($full_month as $key => $day)
									<div class="calendar__row__container__col">
										<time class="calendar__row__container__col__date" datetime="{{ $day['date'] }}">
											<span class="calendar__row__container__col__date__name">{{ $day['day'] }}</span>
											<span class="calendar__row__container__col__date__number">{{ $key+1 }}</span>
										</time>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<div class="calendar-body">
						@foreach ($installers as $installer)
						@php
							$i = 1;
						@endphp
							<div class="calendar__row">
								<div class="calendar__row__item">
									<div class="calendar__row__item__list" style="background-color: #22f7b0">
										<span class="calendar__row__item__list__text">{{ $installer->name }}</span>
									</div>
								</div>
								<div class="calendar__row__container" style="--total-event-layer: {{ $installer->getEvent->whereBetween('start_date', [$first_day, $last_day])->count()+ $installer->getEvent->whereBetween('end_date', [$first_day, $last_day])->where('start_date', '<', $first_day)->count() + $installer->getEvent->where('start_date', '<', $first_day)->where('end_date', '>', $last_day)->count()  }};">
									@foreach ($full_month as $date)
										<div class="calendar__row__container__col" data-date="{{ $date['date'] }}"></div>
									@endforeach
									@foreach ($installer->getEvent->whereBetween('end_date', [$first_day, $last_day])->where('start_date', '<', $first_day) as $event)
										<div class="calendar__row__container__event" data-category="{{ $event->category_id }}" tabindex="-1" style="--event-color: {{ $event->getCategory->color }}; --event-start: 1; --event-end: {{ \Carbon\Carbon::parse($event->end_date)->format('d') }}; --event-layer: {{ $i }};">
											<div class="calendar__row__container__event__card">
												<span class="calendar__row__container__event__text">{{ $event->title }}</span>
											</div>
											<div class="calendar__row__container__event__details">
												<h3 class="calendar__row__container__event__details__title">{{ $event->title }}</h3>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->last_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->first_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getProject->project_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->city ?? '' }}</p>
											</div>
										</div>
										@php
											$i++;
										@endphp
									@endforeach
									@foreach ($installer->getEvent->where('start_date', '<', $first_day)->where('end_date', '>', $last_day) as $event)
										<div class="calendar__row__container__event" data-category="{{ $event->category_id }}" tabindex="-1" style="--event-color: {{ $event->getCategory->color }}; --event-start: 1; --event-end: {{ $days_in_month }}; --event-layer: {{ $i }};">
											<div class="calendar__row__container__event__card">
												<span class="calendar__row__container__event__text">{{ $event->title }}</span>
											</div>
											<div class="calendar__row__container__event__details">
												<h3 class="calendar__row__container__event__details__title">{{ $event->title }}</h3>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->last_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->first_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getProject->project_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->city ?? '' }}</p>
											</div>
										</div>
										@php
											$i++;
										@endphp
									@endforeach
									@foreach ($installer->getEvent->whereBetween('start_date', [$first_day, $last_day]) as $event)
										<div class="calendar__row__container__event" data-category="{{ $event->category_id }}" tabindex="-1" style="--event-color: {{ $event->getCategory->color }}; --event-start: {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}; --event-end: {{ $event->end_date ? ((\Carbon\Carbon::parse($event->end_date)->format('m') > \Carbon\Carbon::parse($event->start_date)->format('m') || \Carbon\Carbon::parse($event->end_date)->format('Y') > \Carbon\Carbon::parse($event->start_date)->format('Y'))?  $days_in_month:\Carbon\Carbon::parse($event->end_date)->format('d')):\Carbon\Carbon::parse($event->start_date)->format('d') }}; --event-layer: {{ $i }};">
											<div class="calendar__row__container__event__card" data-toggle="modal" data-target="#eventEditModal{{ $installer->id.$event->id }}">
												<span class="calendar__row__container__event__text">{{ $event->title }}</span>
											</div>
											<div class="calendar__row__container__event__details">
												<h3 class="calendar__row__container__event__details__title">{{ $event->title }}</h3>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->last_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->first_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getProject->project_name ?? '' }}</p>
												<p class="calendar__row__container__event__details__text">{{ $event->getClient->city ?? '' }}</p>
											</div>
										</div>
										@php
											$i++;
										@endphp

										@push('all_modals')
											<div class="modal modal--aside fade rightAsideModal" id="eventEditModal{{ $installer->id.$event->id }}" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
												<div class="modal-dialog m-0 h-100 bg-white">
													<div class="modal-content simple-bar border-0 h-100 rounded-0">
														<div class="modal-header border-0 pb-0">
															<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
																<span class="novecologie-icon-close"></span>
															</button>
														</div>
														<div class="modal-body pt-0">
															<div class="d-flex flex-column align-items-center">
																<h1 class="modal-title text-center">{{ __('Edit Event') }}</h1>
															</div>
															<form action="{{ route('event.store') }}" class="form" id="editEventForm{{ $installer->id.$event->id }}" method="POST">
																@csrf
																<div class="row">
																	<div class="col-12">
																		<div class="form-group">
																			<label class="form-label" for="title{{ $installer->id.$event->id }}">{{ __('Title') }} <span class="text-danger">*</span></label>
																			<input type="text" name="title" id="title{{ $installer->id.$event->id }}"  value="{{ $event->title }}" class="form-control shadow-none" placeholder="{{ __('Event Title') }}">
																			<input type="hidden" name="event_id" value="{{ $event->id }}">
																			@error('title')
																			<span class="alert text-danger">{{ $message }} **</span>
																			@enderror
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<label class="form-label" for="categorySelect{{ $installer->id.$event->id }}">{{ __('Category') }} <span class="text-danger">*</span></label>
																			<select class="custom-select shadow-none form-control" name="category_id" id="categorySelect{{ $installer->id.$event->id }}">
																				<option value="">{{ __('Select') }}</option>
																				@foreach ($category as $item)
																				<option {{ $event->category_id == $item->id ? 'selected':'' }} id="selected{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
																				@endforeach
																			</select>
																		</div>
																		@error('category_id')
																		<span class="alert text-danger">{{ $message }} **</span>
																		@enderror
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<label class="form-label" for="UserSelect{{ $installer->id.$event->id }}">{{ __('Assignee') }} <span class="text-danger">*</span></label>
																			<select class="select2_select_option custom-select shadow-none form-control" name="user_id[]" id="UserSelect{{ $installer->id.$event->id }}" multiple required>
																				@foreach ($installers as $item)
																				@if (\App\Models\CRM\EventAssign::where('event_id', $event->id)->where('user_id', $item->id)->exists())
																					<option selected value="{{ $item->id }}">{{ $item->name }}</option>
																				@else
																					<option value="{{ $item->id }}">{{ $item->name }}</option>
																				@endif
																				@endforeach
																			</select>
																		</div>
																		@error('category_id')
																		<span class="alert text-danger">{{ $message }} **</span>
																		@enderror
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<label class="form-label" for="startDate{{ $installer->id.$event->id }}">{{ __('Start Date') }} <span class="text-danger">*</span></label>
																			<input type="datetime-local" name="start_date" id="startDate{{ $installer->id.$event->id }}" value="{{ $event->start_date }}" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select start date') }}">
																			@error('start_date')
																			<span class="alert text-danger">{{ $message }} **</span>
																			@enderror
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<label class="form-label" for="endDate{{ $installer->id.$event->id }}">{{ __('End Date') }}</label>
																			<input type="datetime-local" id="endDate{{ $installer->id.$event->id }}" name="end_date" value="{{ $event->end_date }}" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select End date') }}">
																			@error('end_date')
																			<span class="alert text-danger">{{ $message }} **</span>
																			@enderror
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<div class="custom-control custom-switch">
																				<input type="checkbox" class="custom-control-input" name="all_day" {{ $event->all_day == 'yes' ? 'checked':'' }} value="yes" id="customSwitch1{{ $installer->id.$event->id }}">
																				<label class="custom-control-label" for="customSwitch1{{ $installer->id.$event->id }}">{{ __('All Day') }}</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<label class="form-label" for="clientSelect{{ $installer->id.$event->id }}">{{ __('Client') }} <span class="text-danger">*</span></label>
																			<select class="custom-select shadow-none form-control clientSelect" data-id="{{ $installer->id.$event->id }}" id="clientSelect{{ $installer->id.$event->id }}" name="client_id">
																				<option value="">{{ __('Select') }}</option>
																				@foreach ($clients as $item)
																					@if ($client && $client->id == $item->id)
																					<option id="clientSeleted{{ $item->id }}" selected value="{{ $item->id }}">{{ $item->first_name }}</option>
																					@else
																					<option {{ $event->client_id == $item->id ? 'selected':'' }} id="clientSeleted{{ $item->id }}" value="{{ $item->id }}">{{ $item->first_name }}</option>
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
																			<label class="form-label" for="projectSelect{{ $installer->id.$event->id }}">{{ __('Project') }} <span class="text-danger">*</span></label>
																			<select class="custom-select shadow-none form-control" id="projectSelect{{ $installer->id.$event->id }}" name="project_id">
																				<option value="">{{ __('Select') }}</option>
																					@foreach (getProject($event->client_id) as $item)
																					<option {{ $event->project_id == $item->id ? "selected":'' }} value="{{ $item->id }}">{{ $item->project_name }}</option>
																					@endforeach
																			</select>
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<label for="company_address" class="form-label">{{ __('Adresse') }} <span class="text-danger">*</span></label>
																			<div class="geocoder{{ $installer->id.$event->id }}"></div>
																			<input type="hidden" name="address_lat" value="{{ $event->address_lat }}" id="setAddressLatValue{{ $installer->id.$event->id }}" placeholder="Address Lat Value">
																			<input type="hidden" name="address_lon" value="{{ $event->address_lon }}" id="setAddressLngValue{{ $installer->id.$event->id }}" placeholder="Address Lng Value">
																			<input type="hidden" name="location" value="{{ $event->location }}" id="location{{ $installer->id.$event->id }}" placeholder="Address Name">
																			@error('location')
																			<span class="alert text-danger">{{ $message }} **</span>
																			@enderror
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<label class="form-label" for="description{{ $installer->id.$event->id }}">{{ __('Description') }}</label>
																			<textarea type="text" id="description{{ $installer->id.$event->id }}" name="description" class="form-control shadow-none">{{ $event->description }}</textarea>
																			@error('description')
																			<span class="alert text-danger">{{ $message }} **</span>
																			@enderror
																		</div>
																	</div>
																	<div class="col-12 text-center">
																		@if (checkAction(Auth::id(), 'calendar', 'edit') || role() == 's_admin')
																			<button type="submit" data-id="{{ $installer->id.$event->id }}" class="secondary-btn primary-btn--md border-0 eventEditButton">{{ __('Submit') }}</button>
																		@else
																			<button type="button" class="secondary-btn primary-btn--md border-0 mb-2"><span class="novecologie-icon-lock py-1"> {{ __('Submit') }}</button>
																		@endif
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										@endpush
										@push('js')
											<script>
												(function(){
													mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2ZWxvcGVyLXphaGlkIiwiYSI6ImNreDY3Ym93aDBuOXEycHF1Mjc2N3cxY2wifQ.9EyRPzKr0dB9bWghzGNK-g';
														const geocoder{{ $installer->id.$event->id }} = new MapboxGeocoder({
														accessToken: mapboxgl.accessToken,
														types: 'country,region,place,postcode,locality,neighborhood'
													});
													geocoder{{ $installer->id.$event->id }}.addTo('.geocoder'+"{{ $installer->id }}{{ $event->id }}");
													geocoder{{ $installer->id.$event->id }}.on('result', function(e) {
														$('#setAddressLatValue'+"{{ $installer->id }}{{ $event->id }}").val(e.result.center[1]);
														$('#setAddressLngValue'+"{{ $installer->id }}{{ $event->id }}").val(e.result.center[0]);
														$('#location'+"{{ $installer->id }}{{ $event->id }}").val(e.result.text);
														$('.geocoder'+"{{ $installer->id }}{{ $event->id }}"+' .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').removeClass('invalid_input');
														$('.location_alert_message').addClass('d-none');
													});
													geocoder{{ $installer->id.$event->id }}.on('clear', function() {
														$('#setAddressLatValue'+"{{ $installer->id }}{{ $event->id }}").val("");
														$('#setAddressLngValue'+"{{ $installer->id }}{{ $event->id }}").val("");
														$('#location'+"{{ $installer->id }}{{ $event->id }}").val("");
													});
													$('.geocoder'+"{{ $installer->id }}{{ $event->id }}"+' .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').val("{{ $event->location }}");
												})();
											</script>
										@endpush
									@endforeach
								</div>
							</div>
						@endforeach
						{{-- <div class="calendar__row">
							<div class="calendar__row__item">
								<div class="calendar__row__item__list" style="background-color: #22f7ed">
									<span class="calendar__row__item__list__text">Material Resource 3</span>
								</div>
							</div>
							<div class="calendar__row__container" style="--total-event-layer: 2;">
								@for ($i = 1; $i <= $days_in_month; $i++)
									<div class="calendar__row__container__col" data-date="2022-10-{{ $i <= 9 ? '0' : '' }}{{ $i }}"></div>
								@endfor
								<div class="calendar__row__container__event" tabindex="-1" style="--event-color: #f8254e; --event-start: 2; --event-end: 5; --event-layer: 1;">
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
								<div class="calendar__row__container__event" tabindex="-1" style="--event-color: #0a5eff; --event-start: 8; --event-end: 13; --event-layer: 2;">
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
								<div class="calendar__row__container__event" tabindex="-1" style="--event-color: #fc9b10; --event-start: 7; --event-end: 17; --event-layer: 1;">
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
						</div> --}}
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
				<div class="d-flex flex-column align-items-center">
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
						<div class="col-12">
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
						<div class="col-12">
							<div class="form-group" id="UserSelectWrapper">
								<label class="form-label" for="UserSelect">{{ __('Assignee') }} <span class="text-danger">*</span></label>
								<select class="select2_select_option custom-select shadow-none form-control" name="user_id[]" id="UserSelect" multiple required>
									@foreach ($installers as $item)
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
								<input type="datetime-local" name="start_date" id="startDate" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select start date') }}">
								@error('start_date')
								<span class="alert text-danger">{{ $message }} **</span>
								@enderror
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="endDate">{{ __('End Date') }}</label>
								<input type="datetime-local" id="endDate" name="end_date" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select End date') }}">
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
								<label for="company_address" class="form-label">{{ __('Adresse') }} <span class="text-danger">*</span></label>
								<div id="geocoder"></div>
								<input type="hidden" name="address_lat" id="setAddressLatValue" placeholder="Address Lat Value">
								<input type="hidden" name="address_lon" id="setAddressLngValue" placeholder="Address Lng Value">
								<input type="hidden" name="location" id="location" placeholder="Address Name">
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
							<button id="eventAddButton" type="submit" class="secondary-btn primary-btn--md border-0">{{ __('Add') }}</button>
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
							<input type="color" id="categoryColor" name="color" class="form-control shadow-none">
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
													@if (checkAction(Auth::id(), 'event_category', 'edit') || role() == 's_admin')
														<button data-id="{{ $item->id }}" type="button" class="dropdown-item border-0 editEventCategory">
															<span class="novecologie-icon-edit mr-1"></span>
															{{ __('Edit') }}
														</button>
													@else
														<button  type="button" class="dropdown-item border-0">
															<span class="novecologie-icon-lock py-1 mr-1">
															{{ __('Edit') }}
														</button>
													@endif
													@if (checkAction(Auth::id(), 'event_category', 'delete') || role() == 's_admin')
														<form action="{{ route('event.category.delete') }}" method="POST">
															@csrf
															<input type="hidden" name="event_category_id" value="{{ $item->id }}">
															<button type="submit" class="dropdown-item border-0">
																<span class="novecologie-icon-trash mr-1"></span>
																	{{ __('Delete') }}
															</button>
														</form>
													@else
														<button type="button" class="dropdown-item border-0">
															<span class="novecologie-icon-lock py-1 mr-1">
																{{ __('Delete') }}
														</button>
													@endif
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

		{{-- @if ($errors->has('title')||$errors->has('category_id')||$errors->has('start_date')||$errors->has('location')||$errors->has('description'))
			@push('js')
			<script>
			$("#rightAsideModal").modal('show');
			</script>
			@endpush
		@endif --}}
@endsection

@push('js')
<script>
		(function(){
			mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2ZWxvcGVyLXphaGlkIiwiYSI6ImNreDY3Ym93aDBuOXEycHF1Mjc2N3cxY2wifQ.9EyRPzKr0dB9bWghzGNK-g';
			const geocoder = new MapboxGeocoder({
				accessToken: mapboxgl.accessToken,
				types: 'country,region,place,postcode,locality,neighborhood'
			});
			geocoder.addTo('#geocoder');
			geocoder.on('result', function(e) {
				$('#setAddressLatValue').val(e.result.center[1]);
				$('#setAddressLngValue').val(e.result.center[0]);
				$('#location').val(e.result.text);
				$('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').removeClass('invalid_input');
				$('.location_alert_message').addClass('d-none');
			});
			geocoder.on('clear', function() {
				$('#setAddressLatValue').val("");
				$('#setAddressLngValue').val("");
				$('#location').val("");
			});
		})();

	$(document).ready(function () {
		$(".addEvent-btn").click(function(){
			$("#addEventForm")[0].reset();
			$('#eventAddButton').text("{{ __('Add') }}");
			$('#projectSelect').html("<option value='' disabled>{{ __('Select') }}</option>");
			$("#UserSelect").val(null).trigger("change");
			$('#client_details_id').removeClass("d-inline-block");
			$('#client_details_id').addClass("d-none");
		});


		$("#calendar__row__item__filter__search").on("input", function() {
			var value = $(this).val().toLowerCase();
			$(".calendar__row .calendar__row__item .calendar__row__item__list__text").filter(function() {
			$(this).closest('.calendar__row').toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
		$(".calendar-filter-checkbox").on("click", function() {
			let self = $(this);
			let category_id = self.val();
			$(".calendar-body .calendar__row .calendar__row__container .calendar__row__container__event[data-category='"+category_id+"']").filter(function() {
			$(this).toggle(self.is(':checked'))
			});
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
			$('#categoryColor').val(color);

			// $('.selectColor').each(function(){
			// 	if($(this).attr('value') == color){
			// 		$(this).attr('selected', true);
			// 	};
			// });

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
				$('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').focus();
			}

			else{
				$('#addEventForm').submit();
			}

		});
		$('.eventEditButton').click(function(e){
			e.preventDefault();
			var id 				= $(this).attr('data-id');
			var title 			= $('#title'+id).val();
			var categorySelect 	= $('#categorySelect'+id).val();
			var UserSelect 		= $('#UserSelect'+id).val();
			var startDate 		= $('#startDate'+id).val();
			var clientSelect 	= $('#clientSelect'+id).val();
			var projectSelect 	= $('#projectSelect'+id).val();
			var location 		= $('#location'+id).val();

			if( title == ''){
				$('#errorMessage').text("{{ __('Please Enter Title') }}");
				$('.toast.toast--error').toast('show');
				$('#title'+id).focus();
			}

			else if(categorySelect == ''){
				$('#errorMessage').text("{{ __('Please Select Category') }}");
				$('.toast.toast--error').toast('show');
				$('#categorySelect'+id).focus();
			}
			else if(UserSelect == null){
				$('#errorMessage').text("{{ __('Please Select Assignee') }}");
				$('.toast.toast--error').toast('show');
				$('#UserSelect'+id).focus();
			}
			else if(startDate == ''){
				$('#errorMessage').text("{{ __('Please Select Start Date') }}");
				$('.toast.toast--error').toast('show');
				$('#startDate'+id).focus();
			}
			else if(clientSelect == ''){
				$('#errorMessage').text("{{ __('Please Select Client') }}");
				$('.toast.toast--error').toast('show');
				$('#clientSelect'+id).focus();
			}
			else if(projectSelect == ''){
				$('#errorMessage').text("{{ __('Please Select Project') }}");
				$('.toast.toast--error').toast('show');
				$('#projectSelect'+id).focus();
			}
			else if(location == ''){
				$('#errorMessage').text("{{ __('Please Enter Location') }}");
				$('.toast.toast--error').toast('show');
				$('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').focus();
			}

			else{
				$('#editEventForm'+id).submit();
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
		$('.clientSelect').change(function(e){
			var data_id = $(this).attr('data-id');
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
					$('#projectSelect'+data_id).html(data);
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
