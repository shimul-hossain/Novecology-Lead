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

@php
	$days_in_week = 7;
	$dateColorArr = ['#81384a', '#7d4cf3', '#5572e1', '#5ac4b5', '#ea3624', '#ef9230', '#5ac4b5'];
	$i = 1;
@endphp

<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		<div class="row bg-white py-3 rounded-lg shadow-sm">
			<div class="col-lg-2 mb-2 mb-lg-0">
				<div class="planing-navigation text-center mb-2 d-lg-none">
					<div class="btn-group">
						<a href="{{ Route('calendar.index') }}" class="btn btn-outline-secondary">
							<i class="bi bi-calendar2-week"></i>
						</a>
						<a href="{{ Route('calendar.weeks') }}" class="btn btn-outline-secondary active">
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
			</div>
			<div class="col-lg-10">
				<div class="planing-navigation text-center mb-2 d-none d-lg-block">
					<div class="btn-group">
						<a href="{{ Route('calendar.index') }}" class="btn btn-outline-secondary">
							<i class="bi bi-calendar2-week"></i>
						</a>
						<a href="{{ Route('calendar.weeks') }}" class="btn btn-outline-secondary active">
							<i class="bi bi-card-list"></i>
						</a>
						<a href="{{ Route('planning.map') }}" class="btn btn-outline-secondary">
							<i class="bi bi-geo-alt"></i>
						</a>
					</div>
				</div>
				<div class="calendar-wrapper">
					<div class="calendar-header">
						<div class="calendar-header__top justify-content-center py-2">
							<a href="{{ route('calendar.weeks',[$client ? $client->id:0, \Carbon\Carbon::parse($week_start)->subDays(7)->format('Y-m-d')]) }}" class="calendar-header__top__btn">
								<i class="bi bi-chevron-left"></i>
							</a>
							<h3 class="calendar-header__top__title mx-3">{{ \Carbon\Carbon::parse($week_start)->locale(app()->getLocale())->translatedFormat('d F') }} - {{ \Carbon\Carbon::parse($week_end)->locale(app()->getLocale())->translatedFormat('d F') }}</h3>
							<a href="{{ route('calendar.weeks',[$client ? $client->id:0, \Carbon\Carbon::parse($week_end)->addDay()->format('Y-m-d')]) }}" class="calendar-header__top__btn">
								<i class="bi bi-chevron-right"></i>
							</a>
						</div>
					</div>
					<div class="calendar-filters">
						<form action="{{ route('calendar.week.filter') }}" method="get">
							<div class="row row-cols-xl-5 row-cols-lg-4 row-cols-sm-2 row-cols-1 align-items-end">
								<div class="col">
									<div class="form-group">
										<label for="event_id_filter" class="form-label">{{ __('Event') }}</label>
										<input type="hidden" name="week" value="{{ $week_start }}">
										<input type="hidden" name="client_id" value="{{ $client ? $client->id:0 }}">
										<select id="event_id_filter" name="event_id" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($all_event as $a_event)
												<option {{ request()->event_id ? (request()->event_id == $a_event->id ? 'selected':''):''  }} value="{{ $a_event->id }}">{{ $a_event->title }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="event_category_filter" class="form-label">Catégorie d'événement</label>
										<select id="event_category_filter" name="event_category" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($category as $cat)
												<option {{ request()->event_category ? (request()->event_category == $cat->id ? 'selected':''):''  }} value="{{ $cat->id }}">{{ $cat->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="event_client_filter" class="form-label">{{ __('Client') }}</label>
										<select id="event_client_filter" name="event_client" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($clients as $c_item)
												<option {{ request()->event_client ? (request()->event_client == $c_item->id ? 'selected':''):''  }} value="{{ $c_item->id }}">{{ $c_item->first_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="event_project_filter" class="form-label">{{ __('Project') }}</label>
										<select id="event_project_filter" name="event_project" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>{{ __('Select') }}</option>
											@foreach ($projects as $p_item)
												<option {{ request()->event_project ? (request()->event_project == $p_item->id ? 'selected':''):''  }} value="{{ $p_item->id }}">{{ $p_item->project_name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col d-flex">
									<div class="form-group">
										<button class="secondary-btn border-0 mr-1" name="submit" type="submit">{{ __('Submit') }}</button>
									</div>
									@if (request()->event_category || request()->event_client || request()->event_project)
										<div class="form-group">
											<a href="{{ route('calendar.weeks',[$client ? $client->id:0, \Carbon\Carbon::parse($week_start)->format('Y-m-d')]) }}" class="btn btn-outline-danger" name="clear" type="submit"><i class="bi bi-x-lg"></i></a>
										</div>
									@endif
								</div>
								{{-- <div class="col">
									<div class="form-group">
										<label for="calendar_status" class="form-label">STATUT</label>
										<select id="calendar_status" name="calendar_status" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">STATUT 1</option>
											<option value="2">STATUT 2</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_postal_code" class="form-label">Code postal</label>
										<input id="calendar_postal_code" name="calendar_postal_code" type="text" class="form-control bg-white shadow-none" placeholder="Ex: 75 77 79">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_telecommercial" class="form-label">TELECOMMERCIAL</label>
										<select id="calendar_telecommercial" name="calendar_telecommercial" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">TELECOMMERCIAL 1</option>
											<option value="2">TELECOMMERCIAL 2</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_regia" class="form-label">REGIE</label>
										<select id="calendar_regia" name="calendar_regia" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">REGIE 1</option>
											<option value="2">REGIE 2</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_study_advisor" class="form-label">Conseiller étude</label>
										<select id="calendar_study_advisor" name="calendar_study_advisor" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">Conseiller étude 1</option>
											<option value="2">Conseiller étude 2</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_technical_sales_representative" class="form-label">Prévisiteur Technico-Commercial</label>
										<select id="calendar_technical_sales_representative" name="calendar_technical_sales_representative" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">Technico-Commercial 1</option>
											<option value="2">Technico-Commercial 2</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_team_leader" class="form-label">Chef d’équipe</label>
										<select id="calendar_team_leader" name="calendar_team_leader" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">Chef d’équipe 1</option>
											<option value="2">Chef d’équipe 2</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_technical_installer" class="form-label">Installateur Technique</label>
										<select id="calendar_technical_installer" name="calendar_technical_installer" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">Installateur Technique 1</option>
											<option value="2">Installateur Technique 2</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="calendar_intervention_type" class="form-label">TYPE d’INTERVENTION</label>
										<select id="calendar_intervention_type" name="calendar_intervention_type" class="select2_select_option custom-select shadow-none form-control">
											<option value="" selected>Select</option>
											<option value="1">TYPE d’INTERVENTION 1</option>
											<option value="2">TYPE d’INTERVENTION 2</option>
										</select>
									</div>
								</div> --}}
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
												<strong class="calendar__week__col__header__bottom__title">{{ $week['events']->count() }}</strong><span class="calendar__week__col__header__bottom__text">Installation</span>
											</div>
										</div>
										@foreach ($week['events'] as $event)
											<div class="calendar__week__col__body">
												<div class="week-event">
													<div class="week-event__header" style="--event-color: {{ $event->getCategory->color }}">{{ $event->getProject->statusPlanningInstallation->status ?? '' }}</div>
													<div class="week-event__body">
														<ul class="week-event__body__list">
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Nom</strong>:
																<span class="week-event__body__list__item__text">{{ $event->getClient->first_name ?? '' }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">ADRESSE</strong>:
																<span class="week-event__body__list__item__text">{{ $event->location }}</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
																<span class="week-event__body__list__item__text">
																	@foreach ($event->getAssignee as $user)
																		{{ $user->name }}{{ $loop->last ? '':', '  }}
																	@endforeach
																</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">Installateur Technique</strong>:
																<span class="week-event__body__list__item__text">
																	@if ($event->getProject)
																		@foreach ($event->getProject->projectInstaller as $installer)
																			{{ $installer->name }}{{ $loop->last ? '':', '  }}
																		@endforeach
																	@endif
																</span>
															</li>
															<li class="week-event__body__list__item">
																<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
																<span class="week-event__body__list__item__text">{{ $event->getClient->phone ?? '' }}</span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										@endforeach
										{{-- @if ($i == 2)
										<div class="calendar__week__col__body">
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #70ebe9">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #eb7070">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
										@elseif($i == 6)
										<div class="calendar__week__col__body">
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #70ebe9">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #eb7070">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #70ebe9">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #70ebe9">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #eb7070">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
											<div class="week-event">
												<div class="week-event__header" style="--event-color: #70ebe9">planning installation</div>
												<div class="week-event__body">
													<ul class="week-event__body__list">
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Nom</strong>:
															<span class="week-event__body__list__item__text">Amar nam</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">ADRESSE</strong>:
															<span class="week-event__body__list__item__text">Amar ADRESSE</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Chef d’équipe</strong>:
															<span class="week-event__body__list__item__text">Amar Chef</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Installateur</strong>:
															<span class="week-event__body__list__item__text">Amar Installateur</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">Technique</strong>:
															<span class="week-event__body__list__item__text">Amar Technique</span>
														</li>
														<li class="week-event__body__list__item">
															<strong class="week-event__body__list__item__title">TELEPHONE</strong>:
															<span class="week-event__body__list__item__text">01234567890</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
										@endif --}}
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
								<label for="company_address" class="form-label">{{ __('Location') }} <span class="text-danger">*</span></label>
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
				$('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').focus();
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
	{{-- <style>
		@for ($i = 1; $i <= $days_in_week; $i++)
		.calendar-body .calendar__row__container__col:nth-of-type({{ $days_in_week }}n + {{ $i }}) {
			grid-column: {{ $i }}/{{ $i }};
		}
		@endfor
	</style> --}}
@endpush
