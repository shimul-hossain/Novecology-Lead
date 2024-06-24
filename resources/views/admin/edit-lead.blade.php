{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Leads') }}
@endsection

{{-- active menu  --}}
@section('leadIndex')
active
@endsection

@push("css")

<style>
	.common-table{
        width: 100%;
        font-family: "SF Pro Display Semibold", sans-serif;
    }
    .common-table th,
    .common-table td
    {
       padding: 5px;
    }
	.user-card__table tr th.user-card__table__heade{
		width: 40%;
	}
	h4{
        font-size: 16px;
		font-weight: bold;
    }
	.custom-control-input.is-valid~.custom-control-label, .was-validated .custom-control-input:valid~.custom-control-label {
        color: initial;
    }
    .custom-control-input.is-valid~.custom-control-label::before, .was-validated .custom-control-input:valid~.custom-control-label::before {
        border-color: #c7c6c6;
    }
	.database-table-wrapper--custom{
        max-height: 614px;
    }
	.lead__column{
         max-width: 100% !important;
     }

	.pac-container{
		border-radius: 0.357rem;
		font-family: "Roboto", sans-serif;
		box-shadow: 0 5px 25px rgba(34, 41, 47, 0.1);
		z-index: 99999;
		box-shadow: 0 4px 24px 0 rgba(0, 0, 0, 0.24);
		background-color: #fff;
		border: 1px solid rgba(34, 41, 47, 0.05);
	}

	.pac-logo::after{
		display: none;
	}

	.pac-item {
		font-size: 14px;
		font-weight: 400;
		padding: 0.65rem 1.28rem;
		border-top: 0;
		background-color: transparent;
		cursor: pointer;
		color: #000000;
	}
	.pac-item:is(:hover, :focus, .pac-item-selected){
		color: #4D056E;
		background-color: rgba(77, 5, 110, 0.07);
	}

	.pac-icon {
		background-size: 20px;
	}
	.hdpi .pac-icon{
		background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 0C5.865 0 2.5 3.38833 2.5 7.55417C2.5 13.4733 9.295 19.585 9.58417 19.8417C9.70333 19.9475 9.85167 20 10 20C10.1483 20 10.2967 19.9475 10.4158 19.8425C10.705 19.585 17.5 13.4733 17.5 7.55417C17.5 3.38833 14.135 0 10 0ZM10 11.6667C7.7025 11.6667 5.83333 9.7975 5.83333 7.5C5.83333 5.2025 7.7025 3.33333 10 3.33333C12.2975 3.33333 14.1667 5.2025 14.1667 7.5C14.1667 9.7975 12.2975 11.6667 10 11.6667Z' fill='%236E6B7B'/%3E%3C/svg%3E");
	}
	.pac-icon{
		background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M10 0C5.865 0 2.5 3.38833 2.5 7.55417C2.5 13.4733 9.295 19.585 9.58417 19.8417C9.70333 19.9475 9.85167 20 10 20C10.1483 20 10.2967 19.9475 10.4158 19.8425C10.705 19.585 17.5 13.4733 17.5 7.55417C17.5 3.38833 14.135 0 10 0ZM10 11.6667C7.7025 11.6667 5.83333 9.7975 5.83333 7.5C5.83333 5.2025 7.7025 3.33333 10 3.33333C12.2975 3.33333 14.1667 5.2025 14.1667 7.5C14.1667 9.7975 12.2975 11.6667 10 11.6667Z' fill='%236E6B7B'/%3E%3C/svg%3E");
	}

	.pac-icon-marker,
	.pac-item-selected .pac-icon-marker
	{
		background-position: center;
	}

	.pac-item-query,
	.pac-matched
	{
		color: #292d34;
		background-color: #ffff80;
	}

	.pac-item-query{
		font-size: 1.01em;
	}

	@media (min-width: 768px){
		.modal-header__searchbar{
			position: absolute;
			top: 50%;
			left: 0;
			right: 0;
			transform: translateY(-50%);
			pointer-events: none;
		}
		.modal-header__searchbar .form-control{
			pointer-events: all;
		}
	}
	.modal-header__searchbar .form-control{
		max-width: 400px;
	}
	@media (min-width: 992px){
		.modal-header__searchbar .form-control{
			max-width: 500px;
		}
	}

	#parcel-map.leaflet-grab{
        cursor: pointer;
    }
    .map-parcel-card{
        z-index: 2;
        top: 10px;
        left: 55px;
        padding: 10px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }
    .map-parcel-card:not(.show){
        display: none;
    }
    .map-parcel-card__text{
        color: #212529;
        font-size: 13px;
        margin-bottom: 5px;
    }
    .map-parcel-card__text:nth-of-type(1){
        padding-right: 25px;
    }
    .map-parcel-card__text--muted{
        color: #919191;
    }
    .map-parcel-card__close-btn{
        top: 5px;
        right: 5px;
        color: red;
        display: inline-block;
        line-height: 1;
        background-color: transparent;
        border: 0;
        padding: 2px;
    }

</style>

@endpush

@push('plugins-link')
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/geocoder.css') }}">
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/tagify/css/tagify.css') }}">

<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet.css') }}">
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/leaflet-gesture-handling.min.css') }}">
@endpush
@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl-geocoder.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/tagify/js/tagify.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E"></script>
<script src="{{ asset('crm_assets/assets/plugins/cleave/cleave.min.js') }}"></script>

<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/leaflet.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/leaflet-gesture-handling.min.js') }}"></script>
@endpush
@php
	$edit_access = false;
    if($lead->lead_label == 6){
        if ($lead->sub_status  == 50 && \Auth::user()->getRoleName->category_id == 2) {
            $edit_status = true;
        }
        if(\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4){
            $edit_status = true;
        } 
    }

@endphp
{{-- Main Content Part  --}}
@section('content')
{{-- {{ Auth::user()->name }} --}}
		<!-- Banner Section -->
		<section class="banner section-gap position-relative pb-xl-0">
			<div class="container">
				<a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a>
				<div class="row justify-content-center">
					<div class="col-xl-auto">
						<div class="user-card mb-5">
							<div class="user-card__head position-relative">
								<div class="user-card__head__wrapper position-relative">
									<input type="hidden" id="lead_id" name="lead_id" value="{{ $lead->id }}">
									<input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
 
										@if (checkDuplicateEntry($lead))
											<div class="alert bg-danger text-white">
												<div class="alert-body"><a target="_blank" href="{{ route('lead.similar.file', $lead->id) }}"><small>Attention, dossier(s) similaire(s) déja saisi(s).</small></a></div>
											</div>
										@endif 
									<h3 id="userStatus" class="user-card__title text-center text-capitalize my-4">
									@if ($lead)
										{{ ucwords($lead->Prenom) .' '. ucwords($lead->Nom) }}
									@endif </h3>
									<div class="table-responsive simple-bar mb-4">
										<table class="user-card__table text-white w-100">
											<tbody>
												<tr>
													<th class="user-card__table__heade position-relative">ID</th>
													<td class="position-relative" id="fakeId"><span>BH{{ sprintf('%08d', $lead->id) }}</span></td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">Téléphone</th>
													<td class="position-relative">
														<span id="telephone">{{ $lead->phone }} </span>
														<input type="text" name="telephone" id="edit-telephone" value="{{ $lead->phone }}" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none">
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Department') }}</th>
													<td class="position-relative">
														<span id="department">
															@if ($primary_tax)
																@if ($primary_tax->same_as_work_address == 'no')
																	{{ getDepartment($primary_tax->Code_postal_Travaux) }}
																@else
																	{{ getDepartment($primary_tax->postal_code) }}
																@endif
															@endif
														</span>
														<input type="text" name="department" id="edit-department" value="{{ $lead->city }}" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none">
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Precariousness') }}</th>
													<td class="position-relative">
														<span id="precarious" style="
														@if ($lead->precariousness == 'Classique')
															color: #FF00FF;
														@elseif($lead->precariousness == 'Intermediaire')
															color: #800080;
														@elseif($lead->precariousness == 'Precaire')
															color: #FFFF00;
														@elseif($lead->precariousness == 'Grand Precaire')
															color: #0000FF;
														@endif
															">
															{{ $lead->precariousness }}
														</span>
													</td>
												</tr>

												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Telecommercial') }}</th>
													@if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
														<td id="Telecommercial" style="cursor:pointer" data-toggle="modal" data-target="#assignModal">
															@if ($lead->leadTelecommercial)
																{{ $lead->leadTelecommercial->name ?? '' }}
															@else
																{{ __('No assignee') }}
															@endif
														</td>
													@else
														<td id="Telecommercial">
															@if ($lead->leadTelecommercial)
																{{ $lead->leadTelecommercial->name ?? '' }}
															@else
																{{ __('No assignee') }}
															@endif
														</td>
													@endif
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">Régie</th>
													<td id="regie">
														@if ($lead->lead_label == 1)
															@if ($lead->getRegie)
																{{ $lead->getRegie->name ?? '' }}
															@else
																{{ __('No Regie') }}
															@endif
														@else
															@if ($lead->leadTelecommercial)
																{{ $lead->leadTelecommercial->getRegie->name ?? __('No Regie') }}
															@else
																{{ __('No Regie') }}
															@endif
														@endif
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Projects') }}</th>
													<td id="projectName">
														@foreach ($lead->LeadTravaxTags as $tag)
														<span class="btn btn-sm rounded" style="border:1px solid #5a616a; background-color: #ffd966">{{ $tag->tag ?? '' }}</span>
														@endforeach
														{{-- @if($lead->getTag)
															{{ $lead->getTag->name }}
														@endif --}}
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="text-center">
										<div class="lead__card__loader-wrapper d-none" id="lead_status_change">
											<div class="lead__card__loader">
												<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
													<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
													<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
													</path>
												</svg>
											</div>
										</div>
										@if ($lead->lead_label == 6 && $lead->Type_de_contrat)
											@if (role() == 'manager' || role() == 'Gestionnaire' || role() == 'adv' || role() == 'assistant_adv' || role() == 's_admin' || role() == 'manager_direction')
												<div class="lead__card__loader-wrapper d-none" id="lead_to_client_convert">
													<div class="lead__card__loader">
														<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
															<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
															<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
															</path>
														</svg>
													</div>
												</div>
												<div class="text-center lead__card__btn-wrapper" id="lead_to_client_convert_btn">
													<button data-toggle="modal" data-target="#leadToClient"  type="button" class=" primary-btn primary-btn--white primary-btn--lg rounded-pill align-items-center justify-content-center border-0 mt-3 verified

													d-inline-flex
													">
													{{ __('Turn the lead into a customer') }}
													</button>
												</div>
											@endif
										@endif

										<div class="text-center lead__card__btn-wrapper">
											<button type="button" data-toggle="modal" data-target="#subStatusChangeModal" style="background-color:{{ $lead->getSubStatus ? $lead->getSubStatus->background_color : '#42a5f6' }} ; color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#fff' }}"  class="primary-btn primary-btn--lg rounded-pill align-items-center justify-content-center border-0 mt-3
											d-inline-flex
											">
											{{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->lead_label == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
											</button>
										</div>
										<div class="arrow-btn-group d-none" id="left_side_button">
											<button type="button"
											@if ($lead->lead_label == 7)
												data-toggle="tooltip" data-placement="top" title="Le prospect est converti"
											@else
												@if ($lead->lead_label == 6)
													@if (role() == 'manager' || role() == 's_admin')
														data-toggle="modal" data-target="#lead_status__change" 
													@else
														data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"
													@endif
												@else
													data-toggle="modal" 
													@if ($lead->lead_label == 2 || $lead->lead_label == 3 ||$lead->lead_label == 4 ||$lead->lead_label == 5)
														data-target="#lead_status__change"
													@endif
												@endif
											@endif
											 class="arrow-btn m-auto" style="color: {{ $lead->getStatus->background_color }}; {{ ($lead->lead_label == 1 || $lead->lead_label == 7)? 'cursor: not-allowed;':'' }}">
												  <span class="arrow-btn__text">{{ $lead->getStatus->status }}</span>
											</button> 
										</div>
									</div>
								</div>
							</div>
							<div class="user-card__footer bg-white pb-5">
								<div class="nav flex-column nav-pills" id="v-pills-tab">
									@if (checkAction(Auth::id(), 'lead_tab_access', 'lead-tracking') || role() == 's_admin' || $edit_access)
									<a href="#!" class="nav-link rounded-pill d-flex align-items-center justify-content-center collapseBlockTab {{ session('active_lead_tab_collapse') ? (session('active_lead_tab_collapse') == 'lead-tracking' ? 'active': '') : 'active'  }}" data-tab-value="lead-tracking">
										<span id="lead_tracking_tab" class="mr-2"></span>
										Lead Tracking
									</a>
									@endif
                                	@if (checkAction(Auth::id(), 'lead_tab_access', 'information-personnel') || role() == 's_admin' || $edit_access)
									<a href="#!" class="nav-link rounded-pill d-flex align-items-center justify-content-center collapseBlockTab {{ session('active_lead_tab_collapse') == 'client' ? 'active' : ''  }}" data-tab-value="client">
										<span id="personal_information_tab" class="mr-2"></span>
										Client
									</a>
									@endif
                                	@if (checkAction(Auth::id(), 'lead_tab_access', 'information-logement') || role() == 's_admin' || $edit_access)
									<a href="#!" class="nav-link rounded-pill d-flex align-items-center justify-content-center collapseBlockTab {{ session('active_lead_tab_collapse') == 'projet' ? 'active' : ''  }}" data-tab-value="projet">
										<span id="logement_info_tab" class="mr-2"></span>
										Projet
									</a>
									@endif
								  </div>
							</div>
						</div>
					</div>
					<div class="lead__column position-relative col-xl mt-xl-0 mb-5">
						<div class="arrow-btn-group"> 
								<button type="button" class="arrow-btn top_section_button" style="color: {{ $lead->lead_label == 1 ? $lead_statuses->where('id', 1)->first()->background_color :'#ffffff' }}; cursor: not-allowed;">
									<span class="arrow-btn__text" style="color: {{ $lead->lead_label == 1 ? '':'#1a1a1a' }}">Non attribué</span>
								</button>
								<button type="button"
								@if ($lead->lead_label == 7)
									data-toggle="tooltip" data-placement="top" title="Le prospect est converti"
								@else
									@if ($lead->lead_label == 6)
										@if (role() == 'manager' || role() == 's_admin')
											data-toggle="modal" data-target="#newLeadModal"
										@else
											data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"
										@endif
									@else
										data-toggle="modal" data-target="#newLeadModal"
									@endif
								@endif
								class="arrow-btn top_section_button" style="color: {{ $lead->lead_label == 2 ? $lead_statuses->where('id', 2)->first()->background_color :'#ffffff' }}">
										<span class="arrow-btn__text" style="color: {{ $lead->lead_label == 2 ? '':'#1a1a1a' }}">Nouveau</span>
								</button>
								<button type="button"
								@if ($lead->lead_label == 7)
									data-toggle="tooltip" data-placement="top" title="Le prospect est converti"
								@else
									@if ($lead->lead_label == 6)
										@if (role() == 'manager' || role() == 's_admin')
											data-toggle="modal"  data-target="#EncLeadModal"
										@else
											data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"
										@endif
									@else
										data-toggle="modal"  data-target="#EncLeadModal"
									@endif
								@endif
								class="arrow-btn top_section_button" style="color: {{ $lead->lead_label == 3 ? $lead_statuses->where('id', 3)->first()->background_color :'#ffffff' }}">
										<span class="arrow-btn__text" style="color: {{ $lead->lead_label == 3 ? '':'#1a1a1a' }}">En cours</span>
								</button>
								<button type="button"
								@if ($lead->lead_label == 7)
									data-toggle="tooltip" data-placement="top" title="Le prospect est converti"
								@else
									@if ($lead->lead_label == 6)
										@if (role() == 'manager' || role() == 's_admin')
											data-toggle="modal" data-target="#NRPLeadModal"
										@else
											data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"
										@endif
									@else
										data-toggle="modal" data-target="#NRPLeadModal"
									@endif
								@endif
								class="arrow-btn top_section_button" style="color: {{ $lead->lead_label == 4 ? $lead_statuses->where('id', 4)->first()->background_color :'#ffffff' }}">
										<span class="arrow-btn__text" style="color: {{ $lead->lead_label == 4 ? '':'#1a1a1a' }}">NRP</span>
								</button>
								<button type="button"
								@if ($lead->lead_label == 7)
									data-toggle="tooltip" data-placement="top" title="Le prospect est converti"
								@elseif (!$lead->leadTelecommercial)
									data-toggle="tooltip" data-placement="top" title="Pas de télécommercial"
								@elseif (!$lead->Type_de_contrat)
									data-toggle="tooltip" data-placement="top" title="Le type de contrat est vide"
								@else
									@if ($lead->lead_label == 6)
										@if (role() == 'manager' || role() == 's_admin')
											data-toggle="modal" data-target="#ValidationLeadModal"
										@else
											data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"
										@endif
									@else
										data-toggle="modal" data-target="#ValidationLeadModal"
									@endif
								@endif
								class="arrow-btn top_section_button" style="color: {{ $lead->lead_label == 6 ? $lead_statuses->where('id', 6)->first()->background_color :'#ffffff' }}">
										<span class="arrow-btn__text" style="color: {{ $lead->lead_label == 6 ? '':'#1a1a1a' }}">Validation</span>
								</button>
								<button type="button" class="arrow-btn top_section_button" style="color: {{ $lead->lead_label == 7 ? $lead_statuses->where('id', 7)->first()->background_color :'#ffffff' }}; cursor: not-allowed;">
										<span class="arrow-btn__text" style="color: {{ $lead->lead_label == 7 ? '':'#1a1a1a' }}"> Converti</span>
								</button>
								<button type="button"
								@if ($lead->lead_label == 7)
									data-toggle="tooltip" data-placement="top" title="Le prospect est converti"
								@else
									@if ($lead->lead_label == 6)
										@if (role() == 'manager' || role() == 's_admin')
											data-toggle="modal" data-target="#KOLeadModal"
										@else
											data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"
										@endif
									@else
										data-toggle="modal" data-target="#KOLeadModal"
									@endif
								@endif
								class="arrow-btn top_section_button" style="color: {{ $lead->lead_label == 5 ? $lead_statuses->where('id', 5)->first()->background_color :'#ffffff' }}">
										<span class="arrow-btn__text" style="color: {{ $lead->lead_label == 5 ? '':'#1a1a1a' }}">KO</span>
								</button>
								@if ($lead->lead_label == 5)
									<div class="bg-white px-3 py-2 ml-2">
										Raisons: <button data-toggle="modal" data-target="#koTextEditModal" type="button" class="btn shadow-none p-0"><i class="bi bi-pencil"></i></button><br>
										<span class="ko_raisons">{{ $lead->lead_ko_reason }}</span>
									</div>
								@endif 
							@if (role() == 's_admin')
								<button type="button" data-toggle="modal" data-target="#leadSingleDeleteModal"  class="btn btn-icon shadow-none ml-auto mt-auto text-white">
									<i class="bi bi-trash3"></i>
								</button>  
								<div class="modal modal--aside fade" id="leadSingleDeleteModal" tabindex="-1" aria-labelledby="TicketMessageStoreModal" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content border-0">
											<div class="modal-header border-0 pb-0">
												<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
													<span class="novecologie-icon-close"></span>
												</button>
											</div>
											<div class="modal-body text-center pt-0">
												<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
												<span>{{ __('Are You Sure To Delete this') }} ?</span>
												<form action="{{ route('lead.single.delete') }}" method="POST">
													@csrf
													<input type="hidden" name="id" value="{{ $lead->id }}">
													<div class="d-flex justify-content-center">
														<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
															Annuler
														</button>
														<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
															Confirmer
														</button>
													</div>     
												</form>
											</div>
										</div>
									</div>
								</div>
							@endif
						</div>
						<div class="d-flex flex-wrap justify-content-between align-items-center">
							<h1 class="text-white text-shadow mb-0">{{ __('New lead') }}</h1>
							<div>
								<button data-toggle="{{ $lead->phone ? 'modal':'' }}" data-target="#callBackModal" class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0" type="button">
                                    <i class="bi bi-telephone-fill mr-2"></i>
									@if ($lead->callback_time && \Carbon\Carbon::parse($lead->callback_time) > \Carbon\Carbon::now()->addHour())
									Rappel en cours
									@else
									Rappeler
									@endif</button>
							</div>
						</div>
						<div class="lead__wrapper py-3" id="collapseBlockWrap">
							@if (session('active_lead_tab_collapse'))
								@include("admin.blocks.lead.".session('active_lead_tab_collapse'))
							@endif
							{{-- </form> --}}
						</div>
						<div class="database-table-wrapper shadow bg-white pb-1">
							@if (checkAction(Auth::id(), 'lead', 'create_comment') || checkAction(Auth::id(), 'lead', 'activity') || checkAction(Auth::id(), 'lead', 'ringover') || role() == 's_admin')
								<ul class="nav nav-pills nav-pills--horizontal p-3" id="pills-tab" role="tablist">
									@if (checkAction(Auth::id(), 'lead', 'create_comment') || role() == 's_admin')
									<li class="nav-item" role="presentation">
										<a class="nav-link active" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">Commentaires</a>
									</li>
									@endif
									@if (checkAction(Auth::id(), 'lead', 'activity') || role() == 's_admin')
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="false">{{ __('Activities') }}</a>
									</li>
									@endif
									@if (checkAction(Auth::id(), 'lead', 'ringover') || role() == 's_admin')
									<li class="nav-item" role="presentation">
										<a class="nav-link" id="pills-ringover-tab" data-toggle="pill" href="#pills-ringover" role="tab" aria-controls="pills-ringover" aria-selected="false">{{ __('Ringover Logs') }}</a>
									</li>
									@endif
								</ul>
							@endif
							<div class="tab-content" id="pills-tabContent">
								@if (checkAction(Auth::id(), 'lead', 'activity') || role() == 's_admin')
								<div class="tab-pane fade" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
									@include('includes.crm.lead-activity-log')
									{{-- <div class="table-responsive database-table-wrapper--custom simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
											<thead class="database-table__header">
												<tr>
													<th class="text-left">
														{{ __('Détails') }}
													</th>
													<th>
													{{ __('Action') }}
													</th>
												</tr>
											</thead>
											<tbody class="database-table__body" id="pills-one">

											</tbody>
										</table>
									</div> --}}
								</div>
								@endif
								@if (checkAction(Auth::id(), 'lead', 'create_comment') || role() == 's_admin')
								<div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
									<div class="ticket-main__chat-card">
										<div class="ticket-main__chat-card__body">
											<div class="ticket-main__chat-card__body__scroller">
												<div class="ticket-main__chat-card__body__list" id="lead_comments">
													@foreach ($comments as $comment)
														@if($comment->lead_reset_status == 1  && role() != 's_admin' && role() != 'manager_direction' && role() != 'manager' && role() != 's_admin' && role() != 'adv' && role() != 'adv_copy_1693686130')
															@continue
														@endif
														<div class="ticket-main__chat-card__body__list__item {{ \Auth::id() == $comment->user_id ? '':'' }}">
															<div class="ticket-main__chat-card__body__list__item__header">
																<a href="#!" class="ticket-main__chat-card__body__list__item__header__user-meta">
																	@if ($comment->getUser)
																		@if($comment->getUser->profile_photo)
																			<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $comment->getUser->profile_photo }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image">
																		@else
																			<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image">
																		@endif
																	@else
																		<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image">
																	@endif

																	<span class="ticket-main__chat-card__body__list__item__header__user__name">@if ($comment->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif {{ $comment->getUser->name ?? '' }}</span>
																</a>
																<div class="d-md-inline">
																	<span class="ticket-main__chat-card__body__list__item__header__text ticket-main__chat-card__body__list__item__header__text--muted">{{ __('replied on') }}</span>
																	<span class="ticket-main__chat-card__body__list__item__header__text">{{ \Carbon\Carbon::parse($comment->created_at)->locale('fr')->translatedFormat('d F Y') .' a '. \Carbon\Carbon::parse($comment->created_at)->format('H:i') }}</span> @if ($comment->getCategory)
																	<span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: {{ $comment->getCategory->background_color ?? '#fff' }}">{{ $comment->getCategory->name ?? '' }}</span>
																	@endif
																</div>
																@if (role() == 's_admin')
																	<form action="{{ route('lead.comment.delete') }}" method="POST" class="d-inline" style="float: right">
																		@csrf
																		<input type="hidden" name="id" value="{{ $comment->id }}">
																		<button type="submit" class="btn btn-icon shadow-none">
																			<i class="bi bi-trash3"></i>
																		</button> 
																	</form> 
																@endif
															</div>
															<div class="ticket-main__chat-card__body__list__item__body">
																<p class="ticket-main__chat-card__body__list__item__body__text">{!! $comment->comment !!}</p>
															</div>
															<div class="ticket-main__chat-card__body__list__item__footer">
																@foreach ($comment->file as $file)
																	<a href="{{ asset('uploads/crm/comment_file') }}/{{ $file->name }}" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
																		@if ($file->type == 'png' || $file->type == 'jpg' || $file->type == 'jpeg' || $file->type == 'gif')
																			<i class="bi bi-image-fill"></i>
																		@else
																			<i class="bi bi-file-earmark-text-fill"></i>
																		@endif
																		<span class="ticket-main__chat-card__body__list__item__footer__btn__text">{{ $file->name }}</span>
																	</a>
																	<a href="{{ asset('uploads/crm/comment_file') }}/{{ $file->name }}" download="{{ $file->name }}" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
                                                                        <span class="ticket-main__chat-card__body__list__item__footer__btn__text"><i class="bi bi-download"></i></span>
                                                                    </a>
																@endforeach
															</div>
														</div>
													@endforeach
												</div>
											</div>
										</div>
										<div class="ticket-main__chat-card__footer">
											<form action="#!" id="commentStoreForm" enctype="multipart/form-data" class="ticket-main__chat-card__form">
												<input type="hidden" name="lead_id" value="{{ $lead->id }}">
												<textarea rows="5" name="comment" id="lead_comment" class="ticket-main__chat-card__form__textarea tagifyInput" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Rédigez votre commentaire"></textarea>
												<div class="ticket-main__chat-card__form__footer">
													<div class="form-group col-lg-3 col-md-4">
														<select id="comment_category" name="category_id" class="select2_select_option custom-select shadow-none form-control w-100" required>
															<option value="" selected>{{ __('Select') }}</option>
															@foreach ($categories as $cat)
																<option value="{{ $cat->id }}">{{ $cat->name }}</option>
															@endforeach
														</select>
													</div>
													<label class="ticket-main__chat-card__custom-file" role="button">
														<input type="file" name="attach_files[]" multiple class="ticket-main__chat-card__custom-file__input">
														<span class="ticket-main__chat-card__custom-file__btn">
															<span class="ticket-main__chat-card__custom-file__btn__text">Piece jointe</span>
															<i class="bi bi-paperclip"></i>
														</span>
													</label>
													@if (checkAction(Auth::id(), 'lead', 'create_comment') || role() == 's_admin')
														<button type="button" class="ticket-main__chat-card__send-btn" id="commentStore">
															<span class="ticket-main__chat-card__send-btn__text">{{ __('Send') }}</span>
															<i class="bi bi-send-fill"></i>
														</button>
													@else
														<button type="button" class="ticket-main__chat-card__send-btn">
															<span class="ticket-main__chat-card__send-btn__text">{{ __('Send') }}</span>
															<span class="novecologie-icon-lock py-1"></span>
														</button>
													@endif
												</div>
											</form>
										</div>
									</div>
								</div>
								@endif
								@if (checkAction(Auth::id(), 'lead', 'ringover') || role() == 's_admin')
								<div class="tab-pane fade" id="pills-ringover" role="tabpanel" aria-labelledby="pills-ringover-tab">
									<div class="table-responsive database-table-wrapper--custom simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
											<thead  class="database-table__header">
												<tr>
													<th>{{ __('Last State') }}</th>
													<th>{{ __('From') }}</th>
													<th>{{ __('IVR') }}</th>
													<th>{{ __('To') }}</th>
													<th>{{ __('Details') }}</th>
													<th>{{ __('Record') }}</th>
													<th>{{ __('Voicemail') }}</th>
												</tr>
											</thead>
											<tbody class="database-table__body">
												{{-- @forelse(getCalls() as $calls)
												@if ($calls['from_number'] == $lead->phone)
													<tr>
														<td class="align-middle">
															<p class="ringover-call-last_state">
																@if ($calls['last_state'] == 'ANSWERED')
																	A RÉPONDU
																@elseif ($calls['last_state'] == 'MISSED')
																	MANQUÉE
																@elseif ($calls['last_state'] == 'FAILED')
																	ÉCHOUÉ
																@elseif ($calls['last_state'] == 'VOICEMAIL')
																	MESSAGERIE VOCALE
																@else
																	{{ $calls['last_state'] }}
																@endif
															</p>
														</td>
														<td>
															@if ($calls['user'] && $calls['user']['picture'])
																<div class="ringover-call-user">
																	<div class="ringover-call-user__avatar">
																		<img src="{{ $calls['user']['picture'] }}" alt="user" width="50" height="50" class="ringover-call-user__avatar__image" loading="lazy">
																	</div>
																	<div class="ringover-call-user__details">
																		<p class="ringover-call-user__details__name">{{ $calls['user']['firstname'] }} {{ $calls['user']['lastname'] }}</p>
																		<span class="ringover-call-user__details__number">{{ $calls['to_number'] }}</span>
																	</div>
																</div>
															@else
																<div class="ringover-call-user">
																	<div class="ringover-call-user__avatar">
																		<img src="https://ui-avatars.com/api/?name=U&background=DDDDDD&size=60" alt="user" width="50" height="50" class="ringover-call-user__avatar__image" loading="lazy">
																	</div>
																	<div class="ringover-call-user__details">
																		<p class="ringover-call-user__details__name">{{ __('Unknown') }}</p>
																		<span class="ringover-call-user__details__number">{{ $calls['to_number'] }}</span>
																	</div>
																</div>
															@endif
														</td>
														<td class="align-middle">
															@if ($calls['ivr'] && $calls['ivr']['name'])
																<span class="badge--custom" style="color: #{{ $calls['ivr']['color'] }}">{{ $calls['ivr']['name'] }}</span>
															@endif
														</td>
														<td class="align-middle">
															@if ($calls['last_state'] == 'ANSWERED')
															<p class="ringover-call-status ringover-call-status--answered">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.3482C-0.830904 13.8656 -1.22534 7.30982 2.68297 2.31959L2.94097 2L7.12531 6.18434L6.98999 6.37619C5.08459 9.16843 5.76866 12.2233 7.77267 14.2273C9.75377 16.2084 12.7618 16.8996 15.5279 15.0744L15.8157 14.8747L20 19.059L19.616 19.3669L19.5495 19.4183C14.576 23.2182 8.09533 22.7918 3.65176 18.3482V18.3482Z" fill="url(#call_in_gradient)"/>
																	<path d="M12.2539 9.78301L20.7303 1.30664" stroke="#5CD4D5" stroke-width="2"/>
																	<path d="M19.323 9.78201H12.2578V2.7168" stroke="#5CD4D5" stroke-width="2"/>
																	<defs>
																		<linearGradient id="call_in_gradient" x1="1.5308" y1="4.15647" x2="20" y2="22" gradientUnits="userSpaceOnUse">
																			<stop stop-color="#40E0CF"/>
																			<stop offset="1" stop-color="#36CDCF"/>
																		</linearGradient>
																	</defs>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@elseif ($calls['last_state'] == 'VOICEMAIL')
															<p class="ringover-call-status ringover-call-status--voicemail">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 29 14" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M26.9278 6.94286C26.9302 6.29302 26.8037 5.64915 26.5558 5.04848C26.3078 4.44781 25.9432 3.90225 25.4831 3.44335C25.023 2.98445 24.4765 2.6213 23.8751 2.37491C23.2738 2.12851 22.6296 2.00376 21.9798 2.00786C21.3299 2.00468 20.6858 2.13038 20.0847 2.37769C19.4837 2.62499 18.9377 2.989 18.4782 3.44866C18.0187 3.90832 17.6549 4.45452 17.4079 5.05565C17.1608 5.65679 17.0354 6.30094 17.0388 6.95086C17.0332 7.60488 17.1581 8.25346 17.4061 8.85862C17.6542 9.46379 18.0205 10.0134 18.4836 10.4753C18.9467 10.9371 19.4973 11.302 20.1031 11.5485C20.7089 11.795 21.3578 11.9182 22.0118 11.9109C22.6617 11.9108 23.3052 11.7818 23.905 11.5315C24.5048 11.2811 25.049 10.9144 25.5061 10.4524C25.9633 9.99038 26.3243 9.44234 26.5683 8.83995C26.8124 8.23756 26.9345 7.59277 26.9278 6.94286M6.92379 11.9129C8.23653 11.9169 9.49735 11.4005 10.4302 10.4769C11.363 9.55322 11.8918 8.29757 11.9008 6.98486C11.9168 4.26086 9.70979 2.02986 6.97479 2.00786C6.32491 2.0002 5.67993 2.12115 5.07697 2.36374C4.47401 2.60632 3.92498 2.96576 3.46148 3.42136C2.99798 3.87696 2.62915 4.41974 2.37624 5.01844C2.12332 5.61713 1.99131 6.25994 1.9878 6.90986C1.9698 9.68886 4.15379 11.9009 6.92379 11.9109M11.8688 11.8859H17.0348C16.7988 11.5879 16.6038 11.3539 16.4218 11.1089C14.6758 8.76586 14.5798 5.61986 16.1758 3.15186C17.7348 0.742862 20.7098 -0.465138 23.5138 0.173862C26.3278 0.816862 28.4788 3.16586 28.8638 6.01886C29.1039 7.77472 28.663 9.55591 27.6316 10.997C26.6001 12.4381 25.0563 13.4299 23.3168 13.7689C22.8183 13.8664 22.3117 13.9166 21.8038 13.9189C16.8448 13.9289 11.8858 13.9359 6.9268 13.9199C3.50979 13.9099 1.0038 11.5079 0.264795 8.87986C-0.815205 5.03386 1.50979 1.07086 5.39479 0.175862C9.22079 -0.705138 13.0628 1.81486 13.7638 5.70086C14.1538 7.86286 13.5988 9.79686 12.2038 11.4899L11.8688 11.8859" fill="url(#call_voivemail_gradient)"/>
																	<defs>
																		<linearGradient id="call_voivemail_gradient" x1="-2.73322e-08" y1="5.35012" x2="24.7467" y2="17.264" gradientUnits="userSpaceOnUse">
																			<stop stop-color="#FFC54F"/>
																			<stop offset="1" stop-color="#FF9B4A"/>
																		</linearGradient>
																	</defs>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@elseif ($calls['last_state'] == 'CANCELLED')
															<p class="ringover-call-status ringover-call-status--cancelled">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.0416C-0.830904 13.5589 -1.22534 7.00318 2.68297 2.01295L2.94097 1.69336L7.12531 5.8777L6.98999 6.06955C5.08459 8.86179 5.76866 11.9167 7.77267 13.9207C9.75377 15.9018 12.7618 16.593 15.5279 14.7677L15.8157 14.5681L20 18.7524L19.616 19.0602L19.5495 19.1117C14.576 22.9115 8.09533 22.4852 3.65176 18.0416V18.0416Z" fill="currentColor"/>
																	<path d="M12.2539 9.47637L20.7303 1" stroke="currentColor" stroke-width="2"/>
																	<path d="M20.7305 9.47637L12.2541 1" stroke="currentColor" stroke-width="2"/>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@elseif ($calls['last_state'] == 'FAILED')
															<p class="ringover-call-status ringover-call-status--failed">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.0416C-0.830904 13.5589 -1.22534 7.00318 2.68297 2.01295L2.94097 1.69336L7.12531 5.8777L6.98999 6.06955C5.08459 8.86179 5.76866 11.9167 7.77267 13.9207C9.75377 15.9018 12.7618 16.593 15.5279 14.7677L15.8157 14.5681L20 18.7524L19.616 19.0602L19.5495 19.1117C14.576 22.9115 8.09533 22.4852 3.65176 18.0416V18.0416Z" fill="currentColor"/>
																	<path d="M12.2539 9.47637L20.7303 1" stroke="currentColor" stroke-width="2"/>
																	<path d="M20.7305 9.47637L12.2541 1" stroke="currentColor" stroke-width="2"/>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@elseif ($calls['last_state'] == 'MISSED')
															<p class="ringover-call-status ringover-call-status--missed">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M10.6992 6.85648V1H16.4284" stroke="#F04E4F" stroke-width="2"/>
																	<path d="M10.6992 1L16.9201 7.38889L23.1701 1" stroke="#F04E4F" stroke-width="2"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 17.3482C-0.830904 12.8656 -1.22534 6.30982 2.68297 1.31959L2.94097 1L7.12531 5.18434L6.98999 5.37619C5.08459 8.16843 5.76866 11.2233 7.77267 13.2273C9.69874 15.1534 12.5955 15.8602 15.2969 14.2207L15.582 14.0381L15.8157 13.8747L20 18.059L19.5495 18.4183C14.576 22.2182 8.09533 21.7918 3.65176 17.3482Z" fill="url(#call_missed_gradient)"/>
																	<defs>
																		<linearGradient id="call_missed_gradient" x1="20" y1="21" x2="0" y2="1" gradientUnits="userSpaceOnUse">
																			<stop stop-color="#FF8888"/>
																			<stop offset="1" stop-color="#F05F5F"/>
																		</linearGradient>
																	</defs>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@elseif ($calls['last_state'] == 'QUEUE_TIMEOUT')
															<p class="ringover-call-status ringover-call-status--timeout">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 21 23" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 19.3482C-0.830904 14.8656 -1.22534 8.30982 2.68297 3.31959L2.94097 3L7.12531 7.18434L6.98999 7.37619C5.08459 10.1684 5.76866 13.2233 7.77267 15.2273C9.69874 17.1534 12.5955 17.8602 15.2969 16.2207L15.582 16.0381L15.8157 15.8747L20 20.059L19.5495 20.4183C14.576 24.2182 8.09533 23.7918 3.65176 19.3482Z" fill="url(#call_timeout_gradient)"/>
																	<path d="M15.7788 3.65456V2.77522C15.7788 2.63584 15.6648 2.5218 15.5254 2.5218H14.641V1.93135C14.641 1.46507 15.0186 1.08495 15.4848 1.08495H15.6622C16.1285 1.08495 16.5061 1.46507 16.5061 1.93135C16.5061 2.2912 16.648 2.63077 16.9014 2.88672C17.1574 3.14266 17.4969 3.28204 17.8593 3.28204H17.9683C18.7133 3.28204 19.3215 2.67638 19.3215 1.93135C19.3215 1.79197 19.2075 1.67794 19.0681 1.67794C18.9287 1.67794 18.8147 1.79197 18.8147 1.93135C18.8147 2.39763 18.4346 2.77522 17.9683 2.77522H17.8593C17.6338 2.77522 17.4209 2.68652 17.2613 2.52687C17.1016 2.36722 17.0129 2.15689 17.0129 1.93135C17.0129 1.18632 16.4073 0.578125 15.6622 0.578125H15.4848C14.7398 0.578125 14.1341 1.18632 14.1341 1.93135V2.5218H13.2548C13.1154 2.5218 13.0014 2.63584 13.0014 2.77522V3.65456C10.67 4.27289 9 6.42943 9 8.85966C9 11.8322 11.4176 14.2498 14.3901 14.2498C17.3626 14.2498 19.7802 11.8322 19.7802 8.85966C19.7802 6.42943 18.1102 4.27289 15.7788 3.65456ZM14.3901 13.7429C11.6988 13.7429 9.50683 11.5534 9.50683 8.85966C9.50683 6.59668 11.1059 4.59472 13.3106 4.10057C13.4271 4.07269 13.5082 3.97133 13.5082 3.85222V3.02863H15.272V3.85222C15.272 3.97133 15.3531 4.07269 15.4696 4.10057C17.6743 4.59472 19.2734 6.59668 19.2734 8.85966C19.2734 11.5534 17.0813 13.7429 14.3901 13.7429V13.7429Z" fill="#F04E4F"/>
																	<path d="M14.3904 4.61133C12.0463 4.61133 10.1406 6.51953 10.1406 8.86106C10.1406 11.2051 12.0463 13.1108 14.3904 13.1108C16.7344 13.1108 18.6401 11.2051 18.6401 8.86106C18.6401 6.51953 16.7344 4.61133 14.3904 4.61133V4.61133ZM11.1061 9.05366H10.6779C10.574 9.05366 10.4878 8.9675 10.4878 8.8636C10.4878 8.7597 10.574 8.67354 10.6779 8.67354H11.1061C11.21 8.67354 11.2962 8.7597 11.2962 8.8636C11.2962 8.9675 11.21 9.05366 11.1061 9.05366ZM14.1978 5.14856C14.1978 5.04466 14.2839 4.9585 14.3878 4.9585C14.4943 4.9585 14.5779 5.04466 14.5779 5.14856V5.57683C14.5779 5.68073 14.4943 5.76689 14.3878 5.76689C14.2839 5.76689 14.1978 5.68073 14.1978 5.57683V5.14856ZM11.6282 6.10393C11.7042 6.02791 11.8233 6.02791 11.8968 6.10393L12.2009 6.40549C12.2744 6.47898 12.2744 6.60062 12.2009 6.67411C12.1629 6.71212 12.1147 6.72986 12.0666 6.72986C12.0159 6.72986 11.9677 6.71212 11.9323 6.67411L11.6282 6.37255C11.5547 6.29906 11.5547 6.17742 11.6282 6.10393V6.10393ZM12.2034 11.3192L11.9018 11.6233C11.8638 11.6587 11.8157 11.679 11.7675 11.679C11.7169 11.679 11.6687 11.6587 11.6332 11.6233C11.5572 11.5472 11.5572 11.4281 11.6332 11.3546L11.9348 11.0506C12.0083 10.9771 12.1299 10.9771 12.2034 11.0506C12.2769 11.1266 12.2769 11.2457 12.2034 11.3192V11.3192ZM14.583 12.5736C14.583 12.68 14.4968 12.7636 14.3929 12.7636C14.2865 12.7636 14.2028 12.68 14.2028 12.5736V12.1453C14.2028 12.0414 14.2865 11.9552 14.3929 11.9552C14.4968 11.9552 14.583 12.0414 14.583 12.1453V12.5736ZM14.3904 9.75815C14.2358 9.75815 14.0913 9.71507 13.9646 9.64664L13.0599 10.5488C13.0118 10.5995 12.9459 10.6223 12.8826 10.6223C12.8167 10.6223 12.7533 10.5995 12.7026 10.5488C12.6038 10.45 12.6038 10.2903 12.7026 10.1915L13.6048 9.2868C13.5364 9.16009 13.4933 9.01565 13.4933 8.86106C13.4933 8.4556 13.767 8.11603 14.1369 8.00453V6.50179C14.1369 6.36241 14.251 6.24838 14.3904 6.24838C14.5297 6.24838 14.6438 6.36241 14.6438 6.50179V8.00453C15.0138 8.11603 15.2874 8.4556 15.2874 8.86106C15.2874 9.35522 14.8845 9.75815 14.3904 9.75815V9.75815ZM16.5773 6.40296L16.8789 6.1014C16.9549 6.02537 17.074 6.02537 17.1475 6.1014C17.2235 6.17489 17.2235 6.29399 17.1475 6.37001L16.8459 6.67158C16.8079 6.70959 16.7598 6.72733 16.7116 6.72733C16.6635 6.72733 16.6153 6.70959 16.5773 6.67158C16.5038 6.59809 16.5038 6.47645 16.5773 6.40296ZM17.1526 11.6182C17.1146 11.6562 17.0664 11.6739 17.0183 11.6739C16.9676 11.6739 16.9194 11.6562 16.8839 11.6182L16.5798 11.3166C16.5064 11.2431 16.5064 11.1215 16.5798 11.048C16.6559 10.9745 16.775 10.9745 16.8485 11.048L17.1526 11.3496C17.2261 11.4256 17.2261 11.5447 17.1526 11.6182ZM18.1029 9.04859H17.6746C17.5707 9.04859 17.4845 8.96496 17.4845 8.85853C17.4845 8.75463 17.5707 8.66847 17.6746 8.66847H18.1029C18.2068 8.66847 18.2929 8.75463 18.2929 8.85853C18.2929 8.96496 18.2068 9.04859 18.1029 9.04859Z" fill="#F04E4F"/>
																	<path d="M14.7805 8.85901C14.7805 9.07441 14.6057 9.24926 14.3903 9.24926C14.1749 9.24926 14 9.07441 14 8.85901C14 8.64361 14.1749 8.46875 14.3903 8.46875C14.6057 8.46875 14.7805 8.64361 14.7805 8.85901Z" fill="#F04E4F"/>
																	<path d="M19.0659 1.2397C19.2061 1.2397 19.3193 1.12642 19.3193 0.986283V0.253413C19.3193 0.113276 19.2061 0 19.0659 0C18.9258 0 18.8125 0.113276 18.8125 0.253413V0.986537C18.8125 1.12642 18.9258 1.2397 19.0659 1.2397Z" fill="#F04E4F"/>
																	<path d="M18.2217 1.44136C18.2711 1.49077 18.336 1.51561 18.4009 1.51561C18.4657 1.51561 18.5306 1.49077 18.58 1.44136C18.6791 1.34227 18.6791 1.18212 18.58 1.08303L18.0615 0.564548C17.9625 0.465463 17.8023 0.465463 17.7032 0.564548C17.6041 0.663632 17.6041 0.823789 17.7032 0.922874L18.2217 1.44136Z" fill="#F04E4F"/>
																	<path d="M19.917 2.42002C19.8179 2.32093 19.6578 2.32093 19.5587 2.42002C19.4596 2.5191 19.4596 2.67926 19.5587 2.77834L20.0769 3.29657C20.1263 3.34599 20.1912 3.37082 20.2561 3.37082C20.321 3.37082 20.3858 3.34599 20.4352 3.29657C20.5343 3.19749 20.5343 3.03733 20.4352 2.93825L19.917 2.42002Z" fill="#F04E4F"/>
																	<path d="M20.7443 1.67773H20.0112C19.8711 1.67773 19.7578 1.79101 19.7578 1.93115C19.7578 2.07128 19.8711 2.18456 20.0112 2.18456H20.7443C20.8845 2.18456 20.9978 2.07128 20.9978 1.93115C20.9978 1.79101 20.8845 1.67773 20.7443 1.67773Z" fill="#F04E4F"/>
																	<path d="M19.7379 1.51561C19.8027 1.51561 19.8676 1.49077 19.917 1.44136L20.4352 0.922874C20.5343 0.823789 20.5343 0.663632 20.4352 0.564548C20.3362 0.465463 20.176 0.465463 20.0769 0.564548L19.5587 1.08303C19.4596 1.18212 19.4596 1.34227 19.5587 1.44136C19.6081 1.49077 19.673 1.51561 19.7379 1.51561Z" fill="#F04E4F"/>
																	<defs>
																		<linearGradient id="call_timeout_gradient" x1="20" y1="23" x2="0" y2="3" gradientUnits="userSpaceOnUse">
																			<stop stop-color="#FF8888"/>
																			<stop offset="1" stop-color="#F05F5F"/>
																		</linearGradient>
																	</defs>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@elseif ($calls['last_state'] == 'OUTGOING')
															<p class="ringover-call-status ringover-call-status--outgoing">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M20.7029 1.00195L12.5977 9.10616" stroke="#4990E2" stroke-width="2"/>
																	<path d="M13.8633 1H20.7054V7.84211" stroke="#4990E2" stroke-width="2"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.3482C-0.830904 13.8656 -1.22534 7.30982 2.68297 2.31959L2.94097 2L7.12531 6.18434L6.98999 6.37619C5.08459 9.16843 5.76866 12.2233 7.77267 14.2273C9.75377 16.2084 12.7618 16.8996 15.5279 15.0744L15.8157 14.8747L20 19.059L19.616 19.3669L19.5495 19.4183C14.576 23.2182 8.09533 22.7918 3.65176 18.3482V18.3482Z" fill="url(#call_outgoing_gradient)"/>
																	<defs>
																		<linearGradient id="call_outgoing_gradient" x1="20" y1="22" x2="0" y2="2" gradientUnits="userSpaceOnUse">
																			<stop stop-color="#72BBF1"/>
																			<stop offset="1" stop-color="#4B90E2"/>
																		</linearGradient>
																	</defs>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@else
															<p class="ringover-call-status ringover-call-status--outgoing">
																<svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M20.7029 1.00195L12.5977 9.10616" stroke="#4990E2" stroke-width="2"/>
																	<path d="M13.8633 1H20.7054V7.84211" stroke="#4990E2" stroke-width="2"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.3482C-0.830904 13.8656 -1.22534 7.30982 2.68297 2.31959L2.94097 2L7.12531 6.18434L6.98999 6.37619C5.08459 9.16843 5.76866 12.2233 7.77267 14.2273C9.75377 16.2084 12.7618 16.8996 15.5279 15.0744L15.8157 14.8747L20 19.059L19.616 19.3669L19.5495 19.4183C14.576 23.2182 8.09533 22.7918 3.65176 18.3482V18.3482Z" fill="url(#call_outgoing_gradient)"/>
																	<defs>
																		<linearGradient id="call_outgoing_gradient" x1="20" y1="22" x2="0" y2="2" gradientUnits="userSpaceOnUse">
																			<stop stop-color="#72BBF1"/>
																			<stop offset="1" stop-color="#4B90E2"/>
																		</linearGradient>
																	</defs>
																</svg>
																<span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
															</p>
															@endif
														</td>
														<td>
															<div class="ringover-call-details">
																<p class="ringover-call-details__time">{{ \Carbon\Carbon::parse($calls['end_time'])->format('d M Y - h:i A') ?? 'Not answered' }}</p>
																<span class="ringover-call-details__duration ringover-call-details__duration--muted">
																	<i class="bi bi-hourglass-split"></i>
																	<span class="ringover-call-details__duration__text">{{ seconds2human($calls['incall_duration']) }}</span>
																</span>
																<span class="ringover-call-details__duration ringover-call-details__duration--highlight">
																	<svg width="1em" height="1em" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
																		<path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 17.0416C-0.830904 12.5589 -1.22534 6.00318 2.68297 1.01295L2.94097 0.693359L7.12531 4.8777L6.98999 5.06955C5.08459 7.86179 5.76866 10.9167 7.77267 12.9207C9.75377 14.9018 12.7618 15.593 15.5279 13.7677L15.8157 13.5681L20 17.7524L19.616 18.0602L19.5495 18.1117C14.576 21.9115 8.09533 21.4852 3.65176 17.0416V17.0416Z" fill="url(#call_single_gradient)"/>
																		<defs>
																			<linearGradient id="call_single_gradient" x1="1.5308" y1="2.84983" x2="20" y2="20.6934" gradientUnits="userSpaceOnUse">
																				<stop stop-color="#40E0CF"/>
																				<stop offset="1" stop-color="#36CDCF"/>
																			</linearGradient>
																		</defs>
																	</svg>
																	<span class="ringover-call-details__duration__text">{{ seconds2human($calls['total_duration']) }}</span>
																</span>
															</div>
														</td>
														<td class="align-middle">
															@if ($calls['record'])
																<div class="ringover-call-audio-wrapper">
																	<div class="ringover-call-btn-wrapper">
																		<button type="button" class="ringover-call-btn ringover-call-btn--record" data-audio-play>
																			<svg class="ringover-call-btn__icon" width="1em" height="1em" viewBox="0 0 20 32" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M20 16.1401C20 15.5151 19.5221 15.0371 18.8971 15.0371C18.2721 15.0371 17.7941 15.5151 17.7941 16.1401C17.7941 20.4415 14.3015 23.9342 10 23.9342C5.69853 23.9342 2.20588 20.4415 2.20588 16.1401C2.20588 15.5151 1.72794 15.0371 1.10294 15.0371C0.477941 15.0371 0 15.5151 0 16.1401C0 21.2503 3.82353 25.5518 8.89706 26.1033V29.0445H4.88971C4.26471 29.0445 3.78677 29.5224 3.78677 30.1474C3.78677 30.7724 4.26471 31.2503 4.88971 31.2503H15.1103C15.7353 31.2503 16.2132 30.7724 16.2132 30.1474C16.2132 29.5224 15.7353 29.0445 15.1103 29.0445H11.1029V26.1033C16.1765 25.5518 20 21.2503 20 16.1401Z" fill="currentColor"/>
																				<path d="M9.99908 0C6.61673 0 3.85938 2.75735 3.85938 6.13971V16.1029C3.85938 19.5221 6.61673 22.2426 9.99908 22.2794C13.3814 22.2794 16.1388 19.5221 16.1388 16.1397V6.13971C16.1388 2.75735 13.3814 0 9.99908 0Z" fill="currentColor"/>
																			</svg>
																		</button>
																		<button type="button" class="ringover-call-btn ringover-call-btn--stop" data-audio-stop>
																			<svg class="ringover-call-btn__icon" width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
																				<path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5z"/>
																			</svg>
																		</button>
																	</div>
																	<audio class="ringover-call-audio" controls preload="none">
																		<source src="{{ $calls['record'] }}" type="audio/mpeg">
																	</audio>
																	<span class="ringover-call-duration"></span>
																</div>
															@endif
														</td>
														<td class="align-middle">
															@if ($calls['voicemail'])
																<div class="ringover-call-audio-wrapper">
																	<div class="ringover-call-btn-wrapper">
																		<button type="button" class="ringover-call-btn ringover-call-btn--voicemail" data-audio-play>
																			<svg class="ringover-call-btn__icon" width="1em" height="1em" viewBox="0 0 29 26" fill="none" xmlns="http://www.w3.org/2000/svg">
																				<path d="M12.0102 15.2345C9.2422 12.7528 8.6172 10.2712 8.4762 9.27689C8.4368 9.00197 8.54232 8.72626 8.7617 8.53096L11.0017 6.52358C11.3312 6.22834 11.3897 5.76822 11.1427 5.41409L7.5762 0.448991C7.30296 0.0568611 6.74192 -0.0846625 6.2807 0.122198L0.555198 2.53975C0.182227 2.7044 -0.0371492 3.05968 0.0051975 3.43047C0.305197 5.98565 1.5477 12.2669 8.4327 18.4401C15.3177 24.6133 22.3227 25.7268 25.1742 25.9958C25.5878 26.0337 25.984 25.8371 26.1677 25.5027L28.8642 20.3695C29.0941 19.9569 28.9373 19.4552 28.5017 19.2098L22.9637 16.0131C22.5689 15.7915 22.0557 15.8435 21.7262 16.1386L19.4872 18.1469C19.2694 18.3436 18.9618 18.4382 18.6552 18.4029C17.5462 18.2765 14.7782 17.7161 12.0102 15.2345V15.2345Z" fill="currentColor"/>
																				<path d="M21.5 0C17.358 0 14 2.60897 14 5.82759C14.0068 7.00854 14.4558 8.15324 15.275 9.07803L14.5 12.5517L18.432 11.1414C19.4102 11.482 20.4506 11.6562 21.5 11.6552C25.642 11.6552 29 9.04621 29 5.82759C29 2.60897 25.642 0 21.5 0ZM17.5 6.72414C16.9477 6.72414 16.5 6.32274 16.5 5.82759C16.5 5.33243 16.9477 4.93103 17.5 4.93103C18.0523 4.93103 18.5 5.33243 18.5 5.82759C18.5 6.32274 18.0523 6.72414 17.5 6.72414ZM21.5 6.72414C20.9477 6.72414 20.5 6.32274 20.5 5.82759C20.5 5.33243 20.9477 4.93103 21.5 4.93103C22.0523 4.93103 22.5 5.33243 22.5 5.82759C22.5 6.32274 22.0523 6.72414 21.5 6.72414ZM25.5 6.72414C24.9477 6.72414 24.5 6.32274 24.5 5.82759C24.5 5.33243 24.9477 4.93103 25.5 4.93103C26.0523 4.93103 26.5 5.33243 26.5 5.82759C26.5 6.32274 26.0523 6.72414 25.5 6.72414Z" fill="currentColor"/>
																			</svg>
																		</button>
																		<button type="button" class="ringover-call-btn ringover-call-btn--stop" data-audio-stop>
																			<svg class="ringover-call-btn__icon" width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
																				<path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5z"/>
																			</svg>
																		</button>
																	</div>
																	<audio class="ringover-call-audio" controls preload="none">
																		<source src="{{ $calls['voicemail'] }}" type="audio/mpeg">
																	</audio>
																</div>
															@endif
														</td>
													</tr>
												@endif

												@empty --}}
												<tr>
													<td colspan="9000">
														<h2 class="text-center py-3">{{ __('No results found.') }}</h2>
													</td>
												</tr>
												{{-- @endforelse --}}
											</tbody>
										</table>
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Left Aside Modal -->
		<div class="modal modal--aside fade" id="koTextEditModal" tabindex="-1" aria-labelledby="koTextEditModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body text-center">
					<h1 class="modal-title">KO Raisons Modifier</h1>
					<textarea  class="form-control my-3" id="ko_raisons__input">{{ $lead->lead_ko_reason }}</textarea>
					<button id="ko_raisons__update" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2" type="button"> {{ __('Submit') }} </button>
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
							<ul class="nav nav-pills nav-pills--horizontal p-1 bg-white justify-content-center rounded mb-2 d-inline-flex" id="pills-tab-rappler" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="pills-activities-information-tab" data-toggle="pill" href="#pills-rappler-tab" role="tab" aria-controls="pills-two" aria-selected="true">Rappel en cours</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" id="pills-intervention-Statuts-tab" data-toggle="pill" href="#pills-callback-history-tab" role="tab" aria-controls="pills-one" aria-selected="false">Historique</a>
								</li>
							</ul>
						</div>
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<div class="tab-content" id="pills-tabContent-rappler">
							<div class="tab-pane fade show active" id="pills-rappler-tab" role="tabpanel" aria-labelledby="pills-tab-pills-tab-rappler">
								<h1 class="modal-title">@if ($lead->callback_time && \Carbon\Carbon::parse($lead->callback_time) > \Carbon\Carbon::now()->addHour())
									Detail rappel
									@if (checkAction(Auth::id(), 'lead', 'rappel_edit') || role() == 's_admin')
										<button type="button" id="callbackUpdateBtn" class="btn shadow-none p-0"><i class="bi bi-pencil"></i></button>
									@endif
								@endif</h1>
								<form action="{{ route('lead.callback.setting') }}" method="POST">
									@csrf
									@if ($lead)
										<input type="hidden" name="id" value="{{ $lead->id }}">
									@endif
									@if($lead->callback_time && \Carbon\Carbon::parse($lead->callback_time) > \Carbon\Carbon::now()->addHour())
										<table class="common-table" id="callbackInfoTable" style="display: block">
											<tbody>
												<tr>
													<td class="common-table__heade">
														<i class="bi bi-calendar2-week mr-2"></i>
														Date
													</td>
													<td>:  {{ \Carbon\Carbon::parse($lead->callback_time)->format('d-m-Y') }}</td>
												</tr>
												<tr>
													<td class="common-table__heade">
														<i class="bi bi-alarm mr-2"></i>
														Horaire
													</td>
													<td>:  {{ \Carbon\Carbon::parse($lead->callback_time)->format('H:i') }}</td>
												</tr>
												<tr>
													<td class="common-table__heade">
														<i class="bi bi-person mr-2"></i>
														Utilisateur
													</td>
													<td>:  {{ $lead->callbackUser->name ?? ''  }}</td>
												</tr>
												<tr>
													<td class="common-table__heade">
														Observations
													</td>
													<td>:  {{ $lead->callback_observations  }}</td>
												</tr>
											</tbody>
										</table>
										<div class="row text-center" id="callbackInfoUpdateBlock" style="display: none">
											<div class="col-12 mb-3">
												<input type="datetime-local" min="{{ \Carbon\Carbon::now() }}" name="callback_time" class="flatpickr flatpickr-input form-control shadow-none" value="{{ \Carbon\Carbon::parse($lead->callback_time)->format('Y-m-d H:i') }}" placeholder="JJ-MM-AAAA Heure:Minute" required>
											</div>
											<div class="col-12 mb-3 text-left">
												<div class="form-group">
													<label class="form-label">Observations</label>
													<textarea name="callback_observations" class="form-control shadow-none">{{ $lead->callback_observations }}</textarea>
												</div>
											</div>
											<div class="col-12">
												<button type="button" id="callbackBlockCloseBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
													Fermer
												</button>
												<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2" type="button"> {{ __('Submit') }} </button>
											</div>
										</div>
									@else
										<div class="row text-center">
											<div class="col-12 mb-3">
												<input type="datetime-local" min="{{ \Carbon\Carbon::now() }}" name="callback_time" class="flatpickr flatpickr-input form-control shadow-none" placeholder="JJ-MM-AAAA Heure:Minute" required  {{ (!checkAction(Auth::id(), 'lead', 'rappel_create') && role() != 's_admin')? 'disabled':'' }}>
											</div>
											 <div class="col-12 mb-3 text-left">
												<div class="form-group">
													<label class="form-label">Observations</label>
													<textarea name="callback_observations" class="form-control shadow-none"  {{ (!checkAction(Auth::id(), 'lead', 'rappel_create') && role() != 's_admin')? 'disabled':'' }}>{{ $lead->callback_observations }}</textarea>
												</div>
											</div>
											<div class="col-12">
												@if (checkAction(Auth::id(), 'lead', 'rappel_create') || role() == 's_admin')
													<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2"> {{ __('Submit') }} </button>
												@else
													<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }} </button>
												@endif
											</div>
										</div>
									@endif
								</form>
							</div>
							<div class="tab-pane fade ml-3" id="pills-callback-history-tab" role="tabpanel" aria-labelledby="pills-tab-pills-tab-rappler">
								@forelse ($lead->callbackHistory as $history)
									<p>{{ $history->callbackUser->name ?? '' }} <span class="mx-2">{{ \Carbon\Carbon::parse($history->expired_date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($history->expired_date)->format('H:i') }}
										{{-- <span class="border px-4 py-2 rounded" style="background-color: {{ $history->status == 'Réalisé' ? '#00B050' : ($history->status == 'Reporté' ? '#FF9900' : '#E06666')  }}">{{ $history->status }}</span> --}}
									</p>
								@empty
                                	<p class="text-center">Aucun historique trouvé</p>
								@endforelse
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal modal--aside fade" id="assignModal" tabindex="-1" aria-labelledby="middleModal2Label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.assign') }}" method="POST" class="form mx-auto needs-validation">
							@csrf
							<h1 class="form__title position-relative text-center mb-4">{{__('Assign Leads')}}</h1>
							<div class="form-group d-flex flex-column align-items-center position-relative" id="leadAssignModal">
								<input type="hidden" name="lead_id" value="{{ $lead->id }}">
								<select class="select2_select_option form-control w-100" name="user_id" required>
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($telecommercials->where('status', 'active') as $user)
										@if (getLeadAssign($lead->id, $user->id))
												<option selected value="{{ $user->id }}">{{ $user->name }}</option>
										@else
												<option value="{{ $user->id }}">{{ $user->name }}</option>
										@endif
										@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{__('Assign')}}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="newLeadModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Confirmer le nouvelle etiquette de votre prospect :  Nouveau</span>
						<form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="id" value="{{ $lead->id }}">
							<input type="hidden" name="status" value="2">
							<div class="status_change__btn_block">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Non
									</button>
									<button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
										Oui
									</button>
								</div>
							</div>
							<div class="status_change__input" style="display: none">
								<div class="form-group text-left mt-3">
									<label class="form-label" for="lead_staus_new">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_staus_new"  class="custom-select shadow-none form-control">
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($lead_nouveau->getSubStatus as $sub_status)
											@if ($sub_status->id != 5)
												<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
									{{ __('Submit') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="leadToClient" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Pouvez-vous confirmer la transformation du client en projet ?</span>
						<form action="{{ route('lead.to.client') }}" method="POST" class="status_change__modal" id="LeadToClientModalForm">
							@csrf
							<input type="hidden" name="lead_id" value="{{ $lead->id }}">
							<input type="hidden" name="company_id" value="{{ $company->id }}">
							<div class="status_change__btn_block">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Non
									</button>
									<button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
										Oui
									</button>
								</div>
							</div>
							<div class="status_change__input" style="display: none">
								<div class="form-group text-left mt-3">
									<label class="form-label" for="user_assigne_id">Pouvez vous nommer un télécommercial pour ce nouveau projet ? *</label>
									<select name="user_id" id="user_assigne_id"  class="custom-select shadow-none form-control" required>
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($telecommercials as $telecommercial)
											<option value="{{ $telecommercial->id }}">{{ $telecommercial->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group text-left mt-3">
									<label class="form-label" for="gestionnaire_id">Pouvez vous nommer un gestionnaire pour ce nouveau projet ?</label>
									<select name="gestionnaire_id" id="gestionnaire_id"  class="custom-select shadow-none form-control">
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($gestionnaires as $gestionnaire)
											<option value="{{ $gestionnaire->id }}">{{ $gestionnaire->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="lead__card__loader-wrapper d-none" id="LeadToClientLoader">
									<div class="lead__card__loader">
										<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
											<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
											<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
											</path>
										</svg>
									</div>
								</div>
								<div  id="LeadToClientButton">
									<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
										{{ __('Submit') }}
									</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="EncLeadModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Confirmer le nouvelle etiquette de votre prospect :  En cours</span>
						<form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="id" value="{{ $lead->id }}">
							<input type="hidden" name="status" value="3">
							<div class="status_change__btn_block">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Non
									</button>
									<button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
										Oui
									</button>
								</div>
							</div>
							<div class="status_change__input" style="display: none">
								<div class="form-group text-left mt-3">
									<label class="form-label" for="lead_staus_new">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_staus_new"  class="custom-select shadow-none form-control">
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($lead_en_cours->getSubStatus as $sub_status)
											@if ($sub_status->id != 5)
												<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
									{{ __('Submit') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="NRPLeadModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Confirmer le nouvelle etiquette de votre prospect :  NRP</span>
						<form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="id" value="{{ $lead->id }}">
							<input type="hidden" name="status" value="4">
							<div class="status_change__btn_block">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Non
									</button>
									<button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
										Oui
									</button>
								</div>
							</div>
							<div class="status_change__input" style="display: none">
								<div class="form-group text-left mt-3">
									<label class="form-label" for="lead_staus_new">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_staus_new"  class="custom-select shadow-none form-control">
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($lead_nrp->getSubStatus as $sub_status)
											@if ($sub_status->id != 5)
												<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
									{{ __('Submit') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="KOLeadModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Confirmer le nouvelle etiquette de votre prospect : KO</span>
						<form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="id" value="{{ $lead->id }}">
							<input type="hidden" name="status" value="5">
							<div class="status_change__btn_block">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Non
									</button>
									<button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
										Oui
									</button>
								</div>
							</div>
							<div class="status_change__input text-left" style="display: none">
								<div class="form-group mt-3">
									<label class="form-label" for="lead_staus_new">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_staus_new"  class="custom-select shadow-none form-control">
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($lead_ko->getSubStatus as $sub_status)
											@if ($sub_status->id != 5)
												<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-label" for="dead-reason">Raisons</label>
									<textarea rows="3" name="dead_reason" id="dead-reason" class="form-control shadow-none"></textarea>
								</div>
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
									{{ __('Submit') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="ValidationLeadModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Confirmer le nouvelle etiquette de votre prospect :  Validation</span>
						<form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="id" value="{{ $lead->id }}">
							<input type="hidden" name="status" value="6">
							<div class="status_change__btn_block">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Non
									</button>
									<button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
										Oui
									</button>
								</div>
							</div>
							<div class="status_change__input" style="display: none">
								<div class="form-group text-left mt-3">
									<label class="form-label" for="lead_staus_new">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_staus_new"  class="custom-select shadow-none form-control">
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($lead_validation->getSubStatus as $sub_status)
											@if ($sub_status->id == 25)
												<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
											@endif
											@if (\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4)
												@if ($sub_status->id == 52 || $sub_status->id == 53 || $sub_status->id == 54 || $sub_status->id == 50 || $sub_status->id == 56)
													<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
												@endif
											@endif
										@endforeach
									</select>
								</div>
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
									{{ __('Submit') }}
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="subStatusChangeModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="id" value="{{ $lead->id }}">
							<input type="hidden" name="status" value="{{ $lead->lead_label }}">
							<div class="status_change__input text-left">
								<div class="form-group text-left mt-3">
									<label class="form-label" for="lead_sub__staus">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_sub__staus" class="select2_select_option custom-select shadow-none form-control">
										<option value="" selected>{{ __('Select') }}</option>
										@foreach ($lead_current_label->getSubStatus as $sub_status)
											@if ($lead->lead_label == 6)
												@if ($sub_status->id == 25)
													<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
												@endif
												@if (\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4)
													@if ($sub_status->id == 52 || $sub_status->id == 53 || $sub_status->id == 54 || $sub_status->id == 50 || $sub_status->id == 56)
														<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
													@endif
												@endif
											@else
												@if ($sub_status->id != 5)
													<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
												@endif
											@endif
										@endforeach
									</select>
								</div>
								@if ($lead->lead_label == 5)
									<div class="form-group">
										<label class="form-label" for="dead-reason2">Raisons</label>
										<textarea rows="3" name="dead_reason"  id="dead-reason2" class="form-control shadow-none">{{ $lead->lead_ko_reason }}</textarea>
									</div>
								@endif
							</div>
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
								{{ __('Submit') }}
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="addCustomFieldModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">Ajouter un nouveau</h1>
						<form action="{{ route('project.custom.field.store') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div>
								<div class="form-group">
									<label class="form-label" for="title">Ajouter un champ <span class="text-danger">*</span></label>
									<input type="text" name="title" id="title" class="form-control shadow-none" required>
									<input type="hidden" name="collapse_name" id="collapse_name" value="">
									<input type="hidden" name="callapse_active" class="callapse_active" value="">
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
								<div class="form-group">
									<label class="form-label" for="input_type">Type de champ <span class="text-danger">*</span></label>
									<select name="input_type" id="input_type"  class="select2_select_option custom-select shadow-none form-control">
										<option value="text">{{ __('Text') }}</option>
										<option value="date">{{ __('Date') }}</option>
										<option value="number">{{ __('Number') }}</option>
										<option value="email">{{ __('Email') }}</option>
										<option value="radio">{{ __('Radio') }}</option>
										<option value="checkbox">{{ __('Checkbox') }}</option>
										<option value="select">{{ __('Dropdown') }}</option>
										<option value="textarea">{{ __('Textarea') }}</option>
									</select>
								</div>
								<div class="form-group">
									<label class="form-label" for="options">Réponse <span class="text-danger">*</span></label>
									<textarea name="options" id="options" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}"></textarea>
								</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
							</div>
						</form>
						<div class="col-12 px-3">
							<h1 class="modal-title my-3">Champ personnalisé</h1>
							<div class="database-table-wrapper bg-white border">
								<div class="table-responsive simple-bar">
									<table class="table database-table w-100 mb-0">
										<thead class="database-table__header">
											<tr>
												<th>{{ __('Serial') }}</th>
												<th>{{ __('Title') }}</th>
												<th>{{ 'Input Type' }}</th>
												<th class="text-center">{{ __('Action') }}</th>
											</tr>
										</thead>
										<tbody class="database-table__body" id="customFieldInputList">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal modal--aside fade" id="lead_status__change" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Confirmer le nouvelle etiquette de votre prospect</span>
						<form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="id" value="{{ $lead->id }}">
							{{-- <div class="status_change__btn_block">
								<div class="d-flex justify-content-center">
									<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
										Non
									</button>
									<button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
										Oui
									</button>
								</div>
							</div> --}}
							<div class="status_change__input text-left">
								<div class="form-group mt-3">
									<label class="form-label" for="lead_staus_new{{ $lead->id }}">Merci de renseigner le nouveau etiquette de votre prospect</label>
									<select name="status" id="lead_staus_new{{ $lead->id }}" data-id="{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control lead_staus__change" required>
										<option value="" selected disabled>{{ __('Select') }}</option>
										<option {{ $lead->lead_label == 2 ? 'selected':'' }} value="2">Nouveau</option>
										<option {{ $lead->lead_label == 3 ? 'selected':'' }} value="3">En cours</option>
										<option {{ $lead->lead_label == 4 ? 'selected':'' }} value="4">NRP</option>
										<option {{ $lead->lead_label == 5 ? 'selected':'' }} value="5">KO</option>
										@if (role() == 'manager' || role() == 's_admin')
											<option {{ $lead->lead_label == 6 ? 'selected':'' }} 
												@if (!$lead->leadTelecommercial || !$lead->Type_de_contrat)
													disabled
												@endif 
												value="6">Validation 
												@if (!$lead->leadTelecommercial)
													Pas de télécommercial
												@elseif (!$lead->Type_de_contrat)
													Le type de contrat est vide
												@endif 
											</option>
										@else
											<option disabled value="6">Validation (Ce prospect est validé)</option>
										@endif
									</select>
								</div>
								<div class="form-group mt-3">
									<label class="form-label" for="lead_sub_staus_new{{ $lead->id }}">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_sub_staus_new{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control" required>
										<option value="" selected disabled>{{ __('Select') }}</option>
										@if ($lead->lead_label == 2)
											<option selected value="0">Nouvelle demande</option>	
										@endif
										@foreach ($lead_sub_status as $sub_status)
											@if ($lead->lead_label == 6)
												@if ($sub_status->id == 25)
												<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
												@endif 
												@if (\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4)
													@if ($sub_status->id == 52 || $sub_status->id == 53 || $sub_status->id == 54 || $sub_status->id == 50 || $sub_status->id == 56)
														<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
													@endif
												@endif
											@else
												@if ($sub_status->id != 5)
													<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
												@endif
											@endif
										@endforeach
									</select>
								</div>
								<div class="form-group dead_reason__wrap" style="display: {{ $lead->lead_label == '5' ? '':'none' }}">
									<label class="form-label" for="dead-reason{{ $lead->id }}">Raisons</label>
									<textarea rows="3" name="dead_reason" id="dead-reason{{ $lead->id }}" class="form-control shadow-none">{{ $lead->lead_ko_reason }}</textarea>
								</div>
								<div class="form-group text-center">
									<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
										{{ __('Submit') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		
		@include('admin.blocks.parcel-modal')
@endsection

@push('js')


{{-- Collapse Block Render  --}}
<script>
    window.addEventListener("load", function(){
        parcelleGoogleSearchInitialize()
    })

	function formatCurrency(number) {
		if(number){
			// Format the number with two decimal places, a comma as the decimal point, and a space as the thousand separator
			const formattedNumber = parseFloat(number).toLocaleString('en-GB', {
				minimumFractionDigits: 2,
				maximumFractionDigits: 2,
			}).replace(/,/g, ' ').replace(/\./, ',');

			// Replace the last space character with a non-breaking space
			const lastSpacePosition = formattedNumber.lastIndexOf(' ');
			const formattedNumberWithNbsp = lastSpacePosition !== -1
				? formattedNumber.substring(0, lastSpacePosition) + '\u00A0' + formattedNumber.substring(lastSpacePosition + 1)
				: formattedNumber;

			// Add the Euro symbol to the formatted number
			return  formattedNumberWithNbsp;
		}else{
			return 0;
		}
	} 

	function dateMask(){
		var dateMask = $('.date-mask');

		// Date
		if (dateMask.length) {
			dateMask.each(function(){
				new Cleave($(this), {
				date: true,
				delimiter: '/',
				datePattern: ['d','m','Y']
				});
			})
		}
	}

	dateMask();

	var tag_user_list = [
		@foreach ($tag_users as $user)
			{ id:"{{ $user->id }}", value:'{{ $user->name }}', title:'{{ $user->name }}'},
		@endforeach
	]

	function tagifyInput(){
		// initialize Tagify
		var input = document.querySelector('.tagifyInput'),

			// init Tagify script on the above inputs
			tagify = new Tagify(input, {
			//  mixTagsInterpolator: ["{{", "}}"],
				mode: 'mix',  // <--  Enable mixed-content
				pattern: /@/,  // <--  Text starting with @ or # (if single, String can be used here)

				whitelist: tag_user_list.map(function(item){ return typeof item == 'string' ? {value:item} : item}),
				enforceWhitelist: true,

				dropdown : {
					enabled: 1,
					position: "text",
					highlightFirst: true  // automatically highlights first sugegstion item in the dropdown
				}
			})


		tagify.on('input', function(e){
			var prefix = e.detail.prefix;

			if( prefix ){
				if( prefix == '@' )
					tagify.whitelist = tag_user_list;

				if( e.detail.value.length > 1 )
					tagify.dropdown.show.call(tagify, e.detail.value);
			}
		})
	}

	tagifyInput();

	    // Geoportal Map 
	$mapParcelCard = $('.map-parcel-card');
    const mapId = 'parcel-map';
    let defaultMarkerColor = "#13438c";
    let lat = "{{ $lat }}";
    let lng = "{{ $lng }}";
    let mapOptions = {
        center: [lat, lng],
        zoom: 19,
        minZoom: 5,
        attributionControl: false,
        gestureHandling: true
    };
    let mapImageUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    let ParcellLayer = L.tileLayer('https://wxs.ign.fr/{ignApiKey}/geoportail/wmts?&REQUEST=GetTile&SERVICE=WMTS&VERSION=1.0.0&TILEMATRIXSET=PM&LAYER={ignLayer}&STYLE={style}&FORMAT={format}&TILECOL={x}&TILEROW={y}&TILEMATRIX={z}',
    {
        ignApiKey: 'choisirgeoportail',
        ignLayer: 'CADASTRALPARCELS.PARCELLAIRE_EXPRESS',
        style: 'PCI vecteur',
        format: 'image/png',
        service: 'WMTS',
        maxZoom: 20
    });
    let defaultSvgMarkerIcon = (colorCode)=>{
        return L.divIcon({
            html: `
                <svg xmlns="http://www.w3.org/2000/svg" width="45.716" height="60.955" class="w-100 h-100" viewBox="0 0 45.716 60.955">
                    <path id="geo-alt-fill" d="M24.858,60.955s22.858-21.662,22.858-38.1A22.858,22.858,0,1,0,2,22.858C2,39.293,24.858,60.955,24.858,60.955Zm0-26.668A11.429,11.429,0,1,1,36.287,22.858,11.429,11.429,0,0,1,24.858,34.287Z" transform="translate(-2)" fill="${colorCode}"/>
                </svg>
            `,
            iconSize: [26, 35],
            iconAnchor: [13, 35],
            // popupAnchor: [-13, -35],
        });
    };

    let map = L.map(mapId, mapOptions);
    L.tileLayer(mapImageUrl).addTo(map);
    L.layerGroup().addLayer(ParcellLayer).addTo(map);

    let marker = null;

    marker = L.marker([lat, lng], {icon: defaultSvgMarkerIcon(defaultMarkerColor)}).addTo(map);
    map.panTo(L.latLng(lat, lng));

    const addNewMarker = async (currentLat, currentLng)=>{ 
        $('#parcelleLat').html(currentLat);
        $('#parcelleLng').html(currentLng);
        $('#parcelleDepArrNomCom').html("");
        $('#parcelleCode').html("");
        $('#parcelleLocationName').html("");
        $('#parcelNumberCopyButton').addClass('d-none');
        if(marker !== null){
            map.removeLayer(marker);
            $mapParcelCard.removeClass('show');
        }
        marker = L.marker([currentLat, currentLng], {icon: defaultSvgMarkerIcon(defaultMarkerColor)}).addTo(map);
        map.panTo(L.latLng(currentLat, currentLng));
        $mapParcelCard.addClass('show');
    
        // const parcelleDataURL = `https://apicarto.ign.fr/api/cadastre/parcelle?geom={"type":"Point","coordinates":[${currentLng},${currentLat}]}`;
        // const addressDataURL = `https://wxs.ign.fr/calcul/geoportail/geocodage/rest/0.1/reverse?index=address&searchgeom={"type":"Circle","coordinates":[${currentLng},${currentLat}],"radius":100}&lon=${currentLng}&lat=${currentLat}&limit=1`;
        const parcelleDataURL = `https://data.geopf.fr/geocodage/reverse?index=parcel&searchgeom={"type":"Circle","coordinates":[${currentLng},${currentLat}],"radius":100}&lon=${currentLng}&lat=${currentLat}&limit=1`;
        const addressDataURL = `https://data.geopf.fr/geocodage/reverse?index=address&searchgeom={"type":"Circle","coordinates":[${currentLng},${currentLat}],"radius":100}&lon=${currentLng}&lat=${currentLat}&limit=1`;
        try {
            const response = await fetch(parcelleDataURL);
            const responseAddress = await fetch(addressDataURL);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            if (!responseAddress.ok) {
                throw new Error(`HTTP error! Status: ${responseAddress.status}`);
            }
            const parcelleData = await response.json();
            const parcelleDataFeaturesProperties = parcelleData.features[0].properties;

            const addressData = await responseAddress.json();
            const addressDataFeaturesProperties = addressData.features[0].properties;


            $('#parcelleLat').html(currentLat);
            $('#parcelleLng').html(currentLng);
            $('#parcelleDepArrNomCom').html(addressDataFeaturesProperties.postcode+' ' +addressDataFeaturesProperties.city);
            $('#parcelleCode').html(parcelleDataFeaturesProperties.oldmunicipalitycode+" / "+parcelleDataFeaturesProperties.section+" / "+parcelleDataFeaturesProperties.number);
            $('#parcelleLocationName').html(addressDataFeaturesProperties.name);
            $('#parcelNumberCopyButton').removeClass('d-none');
        }catch (error){
            $('#parcelleLat').html(currentLat);
            $('#parcelleLng').html(currentLng);
            $('#parcelleDepArrNomCom').html("");
            $('#parcelleCode').html("");
            $('#parcelleLocationName').html("");
            $('#errorMessage').html("Quelque chose a mal tourné");
            $('.toast.toast--error').toast('show');
            console.error('Error fetching parcel data:', error.message);
        }
    };

    map.on('click', (event)=> {
        let currentLat = event.latlng.lat;
        let currentLng = event.latlng.lng;

        addNewMarker(currentLat, currentLng)
    });

    $('#locationParcelModal').on('shown.bs.modal', function(){
        map.invalidateSize();
    });

    $('.map-parcel-card__close-btn').on('click', function(){
        $mapParcelCard.removeClass('show');
    });

    function parcelleGoogleSearchInitialize() {
        let addressInputElement = document.getElementById('parcelle_google_address');
        let autocomplete = new google.maps.places.Autocomplete(addressInputElement);
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            let place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            let currentFormattedAddress = '';
            let currentLat = place.geometry.location.lat();
            let currentLng = place.geometry.location.lng();
            if (place.formatted_address) {
                currentFormattedAddress = place.formatted_address;
            }
            addNewMarker(currentLat, currentLng)
        });
    }

	function googleSearchInitialize() {
		var address = document.getElementById('google_address');
		if(address){
			var autocomplete = new google.maps.places.Autocomplete(address);
			autocomplete.setTypes(['geocode']);
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
				if (!place.geometry) {
					return;
				}
				var address = '';
				if (place.formatted_address) {
					address = place.formatted_address;
				}
			});
		}
	}
	$(document).ready(function(){

		const isMobile = () => /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		if(isMobile()){
			$('.top_section_button').addClass('d-none');
			$('#left_side_button').removeClass('d-none');
		}

		$('body').on('change','.lead_staus__change', function(){ 
			$.ajax({
				type : "POST",
				url  : "{{ route('lead.status.change.list') }}",
				data : {
					status : $(this).val(),
				},
				success : response => {
					$('#lead_sub_staus_new'+$(this).data('id')).html(response);
					if($(this).val() == 5){
						$(this).closest('.status_change__modal').find('.dead_reason__wrap').slideDown();
					}else{
						$(this).closest('.status_change__modal').find('.dead_reason__wrap').slideUp();
					}
				}
			})
			
		});

		$('body').on('change','#Type_de_logement', function(){ 
			let Type_de_logement = $(this).val();
			let Type_de_chauffage = $('#Type_de_chauffage').val(); 
			if(Type_de_logement){
				$('#Type_de_chauffage').html(`<option value="" selected>{{ __('Select') }}</option> 
					<option ${Type_de_chauffage == 'Combustible' ? 'selected':''} value="Combustible" >Combustible</option>
					<option ${Type_de_chauffage == 'Electrique' ? 'selected':''} value="Electrique" >Electrique</option>`);
			}
		});
		$('body').on('change','#Type_de_chauffage', function(){ 
			let Type_de_chauffage = $(this).val(); 
			let Mode_de_chauffage = $('#Mode_de_chauffage').val();
			if(!Mode_de_chauffage){
				Mode_de_chauffage = $('#Mode_de_chauffage__old').val();
			}
			if(Type_de_logement){
				if(Type_de_chauffage == 'Combustible'){
					$('#Mode_de_chauffage').html(`<option value="" selected>{{ __('Select') }}</option> 
					<option ${Mode_de_chauffage == 'Fioul' ? 'selected':''} value="Fioul" >Fioul</option> 
					<option ${Mode_de_chauffage == 'Gaz' ? 'selected':''} value="Gaz" >Gaz</option> 
					<option ${Mode_de_chauffage == 'Charbon' ? 'selected':''} value="Charbon" >Charbon</option> 
					<option ${Mode_de_chauffage == 'Bois' ? 'selected':''} value="Bois" >Bois</option> 
					<option ${Mode_de_chauffage == 'GPL' ? 'selected':''} value="GPL" >GPL</option> 
					<option ${Mode_de_chauffage == 'Gaz condensation' ? 'selected':''} value="Gaz condensation" >Gaz condensation</option> 
					<option ${Mode_de_chauffage == 'Autre' ? 'selected':''} value="Autre" >Autre</option>`);
				}else{
					$('#Mode_de_chauffage').html(`<option value="" selected>{{ __('Select') }}</option> 
					<option ${Mode_de_chauffage == 'Electrique' ? 'selected':''} value="Electrique" >Electrique</option> 
					<option ${Mode_de_chauffage == 'Autre' ? 'selected':''} value="Autre" >Autre</option>`);
				}
			}
		});

		$('body').on('input','.Nombre_thermostat_supplémentaire_input', function(){ 
			let value = $(this).val();
			let price = $(this).data('price');
			$('#Nombre_thermostat_supplémentaire_montant').val(formatCurrency(+value*+price)+' €');
		});
		$('body').on('change','.Type_de_radiateur_select_input', function(){ 
			if($(this).val() == 'mixte'){
				$('#Nombre_de_radiateurs_électrique_input').slideDown();
				$('#Nombre_de_radiateurs_combustible_input').slideDown();
			}else if($(this).val() == 'combustible'){
				$('#Nombre_de_radiateurs_électrique_input').slideUp();
				$('#Nombre_de_radiateurs_combustible_input').slideDown();
			}else if($(this).val() == 'électrique'){
				$('#Nombre_de_radiateurs_combustible_input').slideUp();
				$('#Nombre_de_radiateurs_électrique_input').slideDown();
			}else{
				$('#Nombre_de_radiateurs_combustible_input').slideUp();
				$('#Nombre_de_radiateurs_électrique_input').slideUp();
			}
		});


		$('body').on('click', '#parcelNumberCopyButton', function(){
			$("#Parcelle_cadastrale").val($('#parcelleCode').text());
            $('#locationParcelModal').modal('hide');
		});

		$('body').on('blur', '.lead_eligibility_input_change', function(){
			let value = $(this).val();
			let hidden_value = $(this).data('hidden-id');

			if(value !== $("#"+hidden_value).val()){
				$(this).closest('form').submit();
			}
			 
		});

		$('body').on('change', '.prjectMarquelist', function(){
			let value = $(this).val();
			let tag_id = $(this).data('tag-id');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type : 'POST',
				url  : "{{ route('project.marque.change') }}",
				data : {value, tag_id},
				success : response => {
					$('#product'+tag_id).html(response);
					console.log('response', response);
				},
			});
		});

		$('body').on('change', '.project-tag-product--change', function(){
			let value = $(this).val();
			let tag_id = $(this).data('tag-id');
			var tag_product_nombre  ={};
			$('.tag_product_nombre').each(function(){
				tag_product_nombre[$(this).data('product-id')] = $(this).val();
			});
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type : 'POST',
				url  : "{{ route('project.tag.product.change') }}",
				data : {value, tag_id, tag_product_nombre},
				success : response => {
					$('#projectTagProductWrap'+tag_id).html(response);
				},
			});
		});

		$('body').on('blur','#f__postal_code',function(){
			let code = $(this).val();
			$.ajax({
				type : 'POST',
				url  : '{{ route("postal.code.change") }}',
				data : {code},
				success : response => {
					$("#f__department").val(response.department);
					if($('#same_as_work_address').is(':checked')){
						$("#Zone").val(response.zone);
					}
				}
			});
		});
		$('body').on('blur','#f__Code_postal_Travaux',function(){
			let code = $(this).val();
			$.ajax({
				type : 'POST',
				url  : '{{ route("postal.code.change") }}',
				data : {code},
				success : response => {
					$("#f__Departement_Travaux").val(response.department);
					if(!$('#same_as_work_address').is(':checked')){
						$("#Zone").val(response.zone);
					}
				}
			})
		});


		var company_id = "{{ $company->id }}";
		@if (!session('active_lead_tab_collapse'))
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type : "POST",
				url  : "{{ route('lead.collapse.block') }}",
				data : {
						lead_id : $('#lead_id').val(),
						tab_value : 'lead-tracking'
						},
				success : response => {
					$('#collapseBlockWrap').html(response);
					googleSearchInitialize();

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

					$('.select2_select_option').select2();
					$('.select2_select_option').select2({
						templateSelection : function (tag, container){
							var $option = $('.select2_select_option option[value="'+tag.id+'"]');
							if ($option.attr('disabled')){
							$(container).addClass('removed-remove-btn');
							}
							return tag.text;
						},
					})

					@if ($lead->lead_label == 7)
						$('.tracking_disabled').prop('disabled', true);
						$('.tax_input_disabled').prop('disabled', true);
						$('.personal_info_disabled').prop('disabled', true);
						$('.eligibility_disabled').prop('disabled', true);
						$('.work_site_disabled').prop('disabled', true);
						$('.foyer_disabled').prop('disabled', true);
						$('.travaux_disabled').prop('disabled', true);
						$('.question_disabled').prop('disabled', true);
					@elseif ($lead->lead_label == 6)
						@if ($lead->sub_status == 50 && Auth::user()->getRoleName->category_id == 2)
						@else
							@if(!$admin__status)
								$('.tracking_disabled').prop('disabled', true);
								$('.tax_input_disabled').prop('disabled', true);
								$('.personal_info_disabled').prop('disabled', true);
								$('.eligibility_disabled').prop('disabled', true);
								$('.work_site_disabled').prop('disabled', true);
								$('.foyer_disabled').prop('disabled', true);
								$('.travaux_disabled').prop('disabled', true);
								$('.question_disabled').prop('disabled', true);
							@endif
						@endif
					@elseif (role() != 's_admin')
						@if (!checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'edit'))
							$('.tracking_disabled').prop('disabled', true);
						@endif
						@if (!checkAction(Auth::id(), 'lead_collapse_tax_notice', 'edit'))
							$('.tax_input_disabled').prop('disabled', true);
						@endif
						@if (!checkAction(Auth::id(), 'lead_collapse_personal_information', 'edit'))
							$('.personal_info_disabled').prop('disabled', true);
						@endif
						@if (!checkAction(Auth::id(), 'lead_collapse_eligibility', 'edit'))
							$('.eligibility_disabled').prop('disabled', true);
						@endif
						@if (!checkAction(Auth::id(), 'lead_collapse_work_site', 'edit'))
							$('.work_site_disabled').prop('disabled', true);
						@endif
						@if (!checkAction(Auth::id(), 'lead_collapse_situation_foyer', 'edit'))
							$('.foyer_disabled').prop('disabled', true);
						@endif
						@if (!checkAction(Auth::id(), 'lead_collapse__project', 'edit'))
							$('.travaux_disabled').prop('disabled', true);
						@endif
						@if (!checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'edit'))
							$('.question_disabled').prop('disabled', true);
						@endif
					@endif
				}
			});
		@endif

		$('body').on('click', '.collapseBlockTab', function(e){
			e.stopPropagation();
			if(!$(this).hasClass('active')){
				$('.collapseBlockTab').removeClass('active');
				$(this).addClass('active');
				let tab_value = $(this).data('tab-value');
				let lead_id = $('#lead_id').val();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type : "POST",
					url  : "{{ route('lead.collapse.block') }}",
					data : {lead_id, tab_value},
					success : response => {
						$('#collapseBlockWrap').html(response);
						googleSearchInitialize();
						dateMask();

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

						$('.select2_select_option').select2();
						$('.select2_select_option').select2({
							templateSelection : function (tag, container){
								var $option = $('.select2_select_option option[value="'+tag.id+'"]');
								if ($option.attr('disabled')){
								$(container).addClass('removed-remove-btn');
								}
								return tag.text;
							},
						})

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
                        
						@if ($lead->lead_label == 7)
							$('.tracking_disabled').prop('disabled', true);
							$('.tax_input_disabled').prop('disabled', true);
							$('.personal_info_disabled').prop('disabled', true);
							$('.eligibility_disabled').prop('disabled', true);
							$('.work_site_disabled').prop('disabled', true);
							$('.foyer_disabled').prop('disabled', true);
							$('.travaux_disabled').prop('disabled', true);
							$('.question_disabled').prop('disabled', true);
						@elseif ($lead->lead_label == 6)
							@if ($lead->sub_status == 50 && Auth::user()->getRoleName->category_id == 2)
							@else
								@if(!$admin__status)
									$('.tracking_disabled').prop('disabled', true);
									$('.tax_input_disabled').prop('disabled', true);
									$('.personal_info_disabled').prop('disabled', true);
									$('.eligibility_disabled').prop('disabled', true);
									$('.work_site_disabled').prop('disabled', true);
									$('.foyer_disabled').prop('disabled', true);
									$('.travaux_disabled').prop('disabled', true);
									$('.question_disabled').prop('disabled', true);
								@endif
							@endif 
						@elseif (role() != 's_admin')
							@if (!checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'edit'))
								$('.tracking_disabled').prop('disabled', true);
							@endif
							@if (!checkAction(Auth::id(), 'lead_collapse_tax_notice', 'edit'))
								$('.tax_input_disabled').prop('disabled', true);
							@endif
							@if (!checkAction(Auth::id(), 'lead_collapse_personal_information', 'edit'))
								$('.personal_info_disabled').prop('disabled', true);
							@endif
							@if (!checkAction(Auth::id(), 'lead_collapse_eligibility', 'edit'))
								$('.eligibility_disabled').prop('disabled', true);
							@endif
							@if (!checkAction(Auth::id(), 'lead_collapse_work_site', 'edit'))
								$('.work_site_disabled').prop('disabled', true);
							@endif
							@if (!checkAction(Auth::id(), 'lead_collapse_situation_foyer', 'edit'))
								$('.foyer_disabled').prop('disabled', true);
							@endif
							@if (!checkAction(Auth::id(), 'lead_collapse__project', 'edit'))
								$('.travaux_disabled').prop('disabled', true);
							@endif
							@if (!checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'edit'))
								$('.question_disabled').prop('disabled', true);
							@endif
						@endif
					}
				});
			}
		});


		$('body').on('click', '.update_children_info', function(){
			let id = $(this).data('id');
			let name = $(this).closest('.modal-body').find('.edit_birth_name');
			let date = $(this).closest('.modal-body').find('.edit_birth_date');
			if(!name.val()){
				$('#errorMessage').html("Le nom est requis");
				$('.toast.toast--error').toast('show');
				name.focus();
				return false;
			}
			if(!date.val()){
				$('#errorMessage').html("La date de naissance est requis");
				$('.toast.toast--error').toast('show');
				date.focus();
				return false;
			}

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type 	: "POST",
				url  	: "{{ route('children.update') }}",
				data 	: {id : id, name: name.val(), date: date.val()},
				success : response => {
					console.log(response);
					$('#successMessage').html('Mis à jour avec succés');
					$('.toast.toast--success').toast('show');
					$("#birth_name"+id).val(name.val());
					$("#birth_date_wrap"+id).html(response);
					$("#childrenInfoEditModal"+id).modal('hide');
				}
			})

        });
		$('body').on('click', '.remove_dependent_children', function(){
			let id = $(this).data('id');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				type 	: "POST",
				url  	: "{{ route('children.removed') }}",
				data 	: {id},
				success : response => {
					$(this).closest('.row').slideUp(function(){
						$(this).remove();
						$('#successMessage').html('Supprimé avec succès');
						$('.toast.toast--success').toast('show');
					})
				}
			})

        });
		$('body').on('keyup', '.surface_m2_value', function(){
            $(this).closest('.form-group').find('.hidden_surface_m2_value').val($(this).val());
        });
         $('body').on('focus', '.surface_m2_value', function(){
            $(this).attr('type', 'number');
            $(this).val($(this).closest('.form-group').find('.hidden_surface_m2_value').val());
        });
         $('body').on('blur', '.surface_m2_value', function(){
            $(this).attr('type', 'text');
            $(this).val($(this).closest('.form-group').find('.hidden_surface_m2_value').val()+' m2');
        });

		$('body').on('change','.other_field__system2', function(){
			let autre_box = $(this).data('autre-box');
            if($(this).val() == 'Oui'){
                $('.'+autre_box).slideDown();
            }else{
                $('.'+autre_box).slideUp();
            }
		});

		$('body').on('click', '.addCustomFieldBtn', function(){
			let collapse = $(this).data('collapse');
			$('#collapse_name').val(collapse);
			$('.callapse_active').val($(this).data('callapse_active'));
			$.ajax({
				type 	: "POST",
				url  	: "{{ route('project.custom.field') }}",
				data 	: {collapse},
				success : response => {
					$('#customFieldInputList').html(response);
					$('#addCustomFieldModal').modal('show');
				}
			})
		});

		$('body').on('submit', '#LeadToClientModalForm', function(){
			$('#LeadToClientButton').addClass('d-none');
			$('#LeadToClientLoader').removeClass('d-none');
		});
		$('body').on('change', '#Type_de_contrat', function(){
			let value = $(this).val();
			if($(this).val() == 'Credit'){
				$('#Subvention_MaPrimeRénov_déduit_du_devis').val("Non").trigger('change');
			}else{
				$('#Subvention_MaPrimeRénov_déduit_du_devis').val(" ").trigger('change');
			}
		});
		$('body').on('click', '#callbackUpdateBtn', function(){
			 $('#callbackInfoTable').slideUp();
			$('#callbackInfoUpdateBlock').slideDown();
		});
		$('body').on('click', '#callbackBlockCloseBtn', function(){
			$('#callbackInfoUpdateBlock').slideUp();
			$('#callbackInfoTable').slideDown();
		});


		$('body').on('click', '#same_as_work_address', function(){
			if($(this).is(':checked')){
				$('#same_as_work_address_wrap').slideUp();
			}else{
				$('#same_as_work_address_wrap').slideDown();
			}
		});

		$('body').on('click', '#MaPrimeRenovUpdateBtn', function(){
			$.ajax({
				type : 'POST',
				url  : '{{ route("lead.bareme.validate") }}',
				data : {
					lead_id : $("#lead_id").val(),
					value 	: $('#bareme').val(),
				},
				success: response => {
					$('#MaPrimeRenovEstimatedAmount').text(response.maprime);
					$('#CEEEstimatedAmount').text(response.cee);
					$('#successMessage').html('Le calcul des aides a été mise a jour');
					$('.toast.toast--success').toast('show');
				}
			});
		});
		$('body').on('click', '#ko_raisons__update', function(){
			let value = $('#ko_raisons__input').val();
			$.ajax({
				type : 'POST',
				url  : '{{ route("lead.ko.raison.update") }}',
				data : {
					lead_id : $("#lead_id").val(),
					value 	: value,
				},
				success: response => {
					$("#koTextEditModal").modal('hide');
					$(".ko_raisons").text(value);
				}
			});
		});
		$('body').on('change', '.radio_checkbox__mr_activity', function(){
			if($(this).is(':checked')){
				$('.radio_checkbox__mr_activity').prop('checked', false);
				$(this).prop('checked', true);
			}
		});

		$('body').on('change', '.radio_checkbox__mrs_activity', function(){
			if($(this).is(':checked')){
				$('.radio_checkbox__mrs_activity').prop('checked', false);
				$(this).prop('checked', true);
			}
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

		$('body').on('change','#Mode_de_paiement', function(){
				if($(this).val() == 'Différé'){
					$('.work__Mode_de_paiement').slideDown();
				}else{
					$('.work__Mode_de_paiement').slideUp();
				}


		});
		$('body').on('change','#Personne_1', function(){
			if($(this).val()){
				$('.personne_1_title').text($(this).val());
				$('#Personne_1_wrap').slideDown();
			}else{
				$('#Personne_1_wrap').slideUp();
			}
		});

		$('body').on('change','#Personne_2', function(){
			if($(this).val()){
				$('.personne_2_title').text($(this).val());
				$('#Personne_2_wrap').slideDown();
			}else{
				$('#Personne_2_wrap').slideUp();
			}
		});

		$('body').on('click','.eligibility_lock_button', function(){
			let id = $(this).data('input-id');
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('#'+id).attr('readonly', true);
			}else{
				$(this).addClass('active');
				$('#'+id).attr('readonly', false);
			}
		});
		$('body').on('click','.informations_personal', function(){
			let id = $(this).data('input-id');
			if($(this).hasClass('active')){
				$(this).removeClass('active');
				$('#'+id).attr('readonly', true);
			}else{
				$(this).addClass('active');
				$('#'+id).attr('readonly', false);
			}
		});

		$('body').on('click','.status_change__btn', function(){
			$(this).closest('.status_change__modal').find('.status_change__btn_block').slideUp();
			$(this).closest('.status_change__modal').find('.status_change__input').slideDown();
		});
		$('body').on('focus','#f__phone', function(){
			let phone = $(this).val();
			if(phone){
				if(phone.slice(0,2) == '33'){
					$('#f__phone').val(phone.slice(2,phone.length));
				}
			}
		});
		$('body').on('blur','#f__phone',function(){
			if($(this).val()){
				$(this).val('33'+$(this).val());
			}
		});
		$('body').on('click', '#commentStore',function(e){
			$(this).attr('disabled', true);
            $(this).addClass('btn-not-allow');
            e.preventDefault();
            var data = $('#lead_comment').val();
            var category = $('#comment_category').val();
            if(data.trim()== ''){
                $('#errorMessage').html("Rédigez votre commentaire");
                $('.toast.toast--error').toast('show');
                $('#lead_comment').focus();
				$(this).removeClass('btn-not-allow');
                $(this).attr('disabled', false);
			}else if(!category){
                $('#errorMessage').html("{{ __('Please Select Category') }}");
                $('.toast.toast--error').toast('show');
                $('#comment_category').focus();
				$(this).removeClass('btn-not-allow');
                $(this).attr('disabled', false);
            }else{
                $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url: "{{ route('lead.comment.store') }}",
					processData: false,
                    contentType: false,
                    data : new FormData($('#commentStoreForm')[0]),
					success: data => {
						$('#commentStoreForm').trigger('reset');
                        $('#lead_comments').html(data.comment);
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');
						$(this).removeClass('btn-not-allow');
                		$(this).attr('disabled', false);
					},
					error : errors => {
						$(this).removeClass('btn-not-allow');
						$(this).attr('disabled', false);
					}
				});
            }
        });

		$('body').on('click', '.edit-toggler--lock__access',function(){
            let value,
                tab_name = $(this).attr('data-tab'),
                block_name = $(this).attr('data-block'),
                key = 'lock_access__activity',
                feature_id = $('#lead_id').val(),
                feature_type = 'lead',
                tab= $(this).attr('data-tab-class');
            if($(this).hasClass('active')){
                $(this).removeClass('active')
                $(this).collapse('hide');
                value = 'close';
            }else{
                $(this).addClass('active')
                $(this).collapse('show');
                value = 'open';
            }

            $.ajax({
                type : "POST",
                url  : "{{ route('lead.lock.access') }}",
                data : {value, tab_name, block_name, key, feature_id, feature_type, tab},
                success: response =>{
                    $('#pills-one').html(response)
                }

            })
        });


		// Add New Text Item
		$('body').on('click', '#addTextItem',function(){
			var number = $('#notice_number').val();
			if($('#existingAddMore').val() == 'exist'){
				$('#errorMessage').html("{{ __('please complete open fiscal information first') }}");
				$('.toast.toast--error').toast('show');
				exit();
			}
			var item = '<div class="col-12 mb-4 tax__row" style="display:none;"> <div class="row align-items-center"><div class="col-lg-auto"> <h4 class="mb-lg-0 font-weight-bold notice__number">{{ __("Notice") }} '+ number+'</h4> </div> <div class="col-lg-4 col-md-6"> <div class="form-group mb-lg-0"> <input type="hidden" id="existingAddMore" value="exist"> <input type="text" name="tax_number" class="form-control shadow-none" placeholder="{{ __("Fiscal number") }} *"  id="tax_number"> </div> </div> <div class="col-lg-4 col-md-6"> <div class="form-group mb-lg-0"> <input type="hidden" name="tax_id" id="tax_id", value="0"> <input type="text" name="tax_reference" id="tax_reference" class="form-control shadow-none" placeholder="{{ __("Reference notice") }} *"> </div> </div> <div class="col-lg-auto"> <button type="button" class="remove-btn btn__tax_item d-inline-flex align-items-center justify-content-center button">&times;</button> </div>  </div> </div>';

			$('#taxWrapperId').append(item);
			$('.tax__row').slideDown();
			$('#notice_number').val(+number + 1);
		});

		$('body').on('click', '.btn__tax_item', function(){
			$('#notice_number').val(+$('#notice_number').val() - 1);
			$(this).closest('.tax__row').slideUp("normal", function() { $(this).remove(); } );
		});

		$('body').on('click', '#taxValiderBtn',function(){
			if($('#tax_number').length == 0)
			{
					return false;
			}

			var lead_id 				= $('#lead_id').val();
			var company_id 				= $('#company_id').val();
			 var tax_number				= $('#tax_number').val();
			 var tax_reference 			= $('#tax_reference').val();
			if(tax_number == ''){
				$('#errorMessage').html("{{ __('Please Enter Fiscal Number') }}");
				$('.toast.toast--error').toast('show');
				$('#tax_number').focus();
			}
			else if(tax_reference == ''){
				$('#errorMessage').html("{{ __('Please Enter Reference Notice') }}");
				$('.toast.toast--error').toast('show');
				$('#tax_reference').focus();
			}
			else if(tax_number == '0000000000' && tax_reference == '0000000000'){
				$('#taxErrorAlert').modal('show');
			}else{
				if(tax_number.length !=13){
					$('#errorMessage').html("Entrée invalide");
					$('.toast.toast--error').toast('show');
					$('#tax_number').focus();
				}else if(tax_reference.length !=13){
					$('#errorMessage').html("Entrée invalide");
					$('.toast.toast--error').toast('show');
					$('#tax_reference').focus();
				}else{
					$("#tax__card__loader").removeClass("d-none");
					$("#tax__card__btn").addClass("d-none");
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url:"{{ route('lead.tax.custom.update') }}",
						data: {

							lead_id 		: lead_id,
							tax_number 		: tax_number,
							tax_reference 	: tax_reference,
							company_id 		: company_id,

						},
						success: function(data){
							if(data.error){
							$('#errorMessage').html(data.error);
							$('.toast.toast--error').toast('show');
							$("#tax__card__btn").removeClass("d-none");
							$("#tax__card__loader").addClass("d-none");
							}
							else{
								$('#leadCardCollapse-4').html(data.taxes);
								googleSearchInitialize();
								$('#taxWrapperId').html(data.all_tax);
								$('#taxWrapperId2').html(data.all_tax2);
								$('.collapseRow').show();
								$('#notificationCount').text(data.count);
								$('#notificationList').html(data.response);
								dateMask();

								$('#successMessage').html(data.alert);
								$('.toast.toast--success').toast('show');
								$('#pills-one').html(data.log);
								$("#tax__card__btn").removeClass("d-none");
								$("#tax__card__loader").addClass("d-none");
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
						},

					});
				}
			}
		});
		$('body').on('click','.taxValiderBtn2',function(){
			let tax_id = $(this).data('id');
			let tax_number = $(this).closest('.modal-body').find('.edit_tax_number').val();
			let tax_reference = $(this).closest('.modal-body').find('.edit_tax_reference').val();
			if(tax_number == ''){
				$('#errorMessage').html("{{ __('Please Enter Fiscal Number') }}");
				$('.toast.toast--error').toast('show');
				$(this).closest('.modal-body').find('.edit_tax_number').focus();
			}
			else if(tax_reference == ''){
				$('#errorMessage').html("{{ __('Please Enter Reference Notice') }}");
				$('.toast.toast--error').toast('show');
				$(this).closest('.modal-body').find('.edit_tax_reference').focus();
			}
			else if(tax_number == '0000000000' && tax_reference == '0000000000'){
				$('#tax_update_id').val(tax_id)
				$("#taxEditModal"+tax_id).modal('hide');
				$('#taxErrorAlert2').modal('show');
			}else{
				if(tax_number.length !=13){
					$('#errorMessage').html("Entrée invalide");
					$('.toast.toast--error').toast('show');
					$(this).closest('.modal-body').find('.edit_tax_number').focus();
				}else if(tax_reference.length !=13){
					$('#errorMessage').html("Entrée invalide");
					$('.toast.toast--error').toast('show');
					$(this).closest('.modal-body').find('.edit_tax_reference').focus();
				}else{
					$("#tax__card__loader2"+tax_id).removeClass("d-none");
					$("#tax__card__btn2"+tax_id).addClass("d-none");
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url:"{{ route('lead.tax.custom.update2') }}",
						data: {

							tax_id 			: tax_id,
							tax_number 		: tax_number,
							tax_reference 	: tax_reference,

						},
						success: function(data){
							if(data.error){
								$('#errorMessage').html(data.error);
								$('.toast.toast--error').toast('show');
								$("#tax__card__btn2"+tax_id).removeClass("d-none");
								$("#tax__card__loader2"+tax_id).addClass("d-none");
							}
							else{
								$('#pills-one').html(data.log);
								$('#successMessage').html(data.alert);
								$('.toast.toast--success').toast('show');

								$("#tax__card__btn2"+tax_id).removeClass("d-none");
								$("#tax__card__loader2"+tax_id).addClass("d-none");
								$("#tax_number__edit"+tax_id).val(tax_number);
								$("#tax_reference__edit"+tax_id).val(tax_reference);
								$("#taxEditModal"+tax_id).modal('hide');
							}

						},
						error: function (error){
							$("#tax__card__btn2"+tax_id).removeClass("d-none");
							$("#tax__card__loader2"+tax_id).addClass("d-none");
							$('#errorMessage').html('{{ __("Something went wrong") }}');
				        	$('.toast.toast--error').toast('show');
						}

					});
				}
			}
		});
		$('body').on('click','.taxVerifyBtn2',function(){
			let tax_id = $(this).data('id');
			let tax_number = $(this).closest('.modal-body').find('.edit_tax_number').val();
			let tax_reference = $(this).closest('.modal-body').find('.edit_tax_reference').val();
			if(tax_number == ''){
				$('#errorMessage').html("{{ __('Please Enter Fiscal Number') }}");
				$('.toast.toast--error').toast('show');
				$(this).closest('.modal-body').find('.edit_tax_number').focus();
			}
			else if(tax_reference == ''){
				$('#errorMessage').html("{{ __('Please Enter Reference Notice') }}");
				$('.toast.toast--error').toast('show');
				$(this).closest('.modal-body').find('.edit_tax_reference').focus();
			}
			 else{
				$("#tax__card__loader2"+tax_id).removeClass("d-none");
				$("#tax__card__btn2"+tax_id).addClass("d-none");
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url:"{{ route('lead.tax.custom.verify2') }}",
					data: {

						tax_id 			: tax_id,
						tax_number 		: tax_number,
						tax_reference 	: tax_reference,

					},
					success: function(data){
						if(data.error){
							$('#errorMessage').html(data.error);
							$('.toast.toast--error').toast('show');
							$("#tax__card__btn2"+tax_id).removeClass("d-none");
							$("#tax__card__loader2"+tax_id).addClass("d-none");
						}
						else{
							$('#pills-one').html(data.log);
							$('#successMessage').html(data.alert);
							$('.toast.toast--success').toast('show');

							$("#tax__card__btn2"+tax_id).removeClass("d-none");
							$("#tax__card__loader2"+tax_id).addClass("d-none");
							$("#tax_number__edit"+tax_id).val(tax_number);
							$("#tax_reference__edit"+tax_id).val(tax_reference);
							$("#taxEditModal"+tax_id).modal('hide');
						}

					},
					error: function (error){
                        $("#tax__card__btn2"+tax_id).removeClass("d-none");
						$("#tax__card__loader2"+tax_id).addClass("d-none");
						$('#errorMessage').html('{{ __("Something went wrong") }}');
						$('.toast.toast--error').toast('show');
                    }
				});
			}
		});
		$('body').on('click', '#customTaxValidate2',function(){
			let tax_id = $('#tax_update_id').val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				url:"{{ route('lead.tax.custom.update2') }}",
				data: {

					tax_id 			: tax_id,
					tax_number 		: '0000000000',
					tax_reference 	: '0000000000',
				},
				success: function(data){
					if(data.error){
						$('#errorMessage').html(data.error);
						$('.toast.toast--error').toast('show');
					}
					else{
						$('#pills-one').html(data.log);
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');

						$("#tax_number__edit"+tax_id).val('0000000000');
						$("#tax_reference__edit"+tax_id).val('0000000000');
						$("#taxErrorAlert2").modal('hide');
					}

				},

			});
		});
		$('body').on('click', '#taxTelechargerBtn',function(){

			if($('#tax_number').length == 0)
			{
				exit();
			}

			var lead_id 				= $('#lead_id').val();
			var company_id 				= $('#company_id').val();
			 var tax_number				= $('#tax_number').val();
			 var tax_reference 			= $('#tax_reference').val();
			if(tax_number == ''){
				$('#errorMessage').html("{{ __('Please Enter Fiscal Number') }}");
				$('.toast.toast--error').toast('show');
				$('#taxValidate').attr('data-toggle', false);
				$('#tax-verify').removeClass('verified');
				$('#tax_number').focus();
			}
			else if(tax_reference == ''){
				$('#errorMessage').html("{{ __('Please Enter Reference Notice') }}");
				$('.toast.toast--error').toast('show');
				$('#taxValidate').attr('data-toggle', false);
				$('#tax-verify').removeClass('verified');
				$('#tax_reference').focus();
			}
			else if(tax_number == '0000000000' && tax_reference == '0000000000'){
				return false;
			}
			else{
				$("#tax__card__loader").removeClass("d-none");
				$("#tax__card__btn").addClass("d-none");
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url:"{{ route('lead.tax.update') }}",
					data: {

						lead_id 		: lead_id,
						tax_number 		: tax_number,
						tax_reference 	: tax_reference,
						company_id 		: company_id,

					},
					success: function(data){
						if(data.error){
						$('#errorMessage').html(data.error);
						$('.toast.toast--error').toast('show');
						$("#tax__card__btn").removeClass("d-none");
						$("#tax__card__loader").addClass("d-none");
						}
						else{
							if(data.primary == 'yes'){
								$("#zone").text(data.zone);
								$("#department").text(data.city);
								$("#userStatus").text(data.name);
								$("#email-address").text(data.email);
								$("#telephone").text(data.phone);
								$("#zone_data").val(data.zone);
								$(".precarious").text(data.precariousness);
								$("#precarious").text(data.precariousness);
								$("#precariousness").val(data.precariousness);
								$('#precariousnessDropdownToggle').text(data.precariousness);
								$('#precariousnessDropdownToggle').removeClass("Classique-option Intermediaire-option Precaire-option Grand_Precaire-option");
								if(data.precariousness == 'Classique'){
									$("#precarious").css('color', '#FF00FF');
									$('#precariousnessDropdownToggle').addClass('Classique-option');
								}else if(data.precariousness == 'Intermediaire'){
									$('#precariousnessDropdownToggle').addClass('Intermediaire-option');
									$("#precarious").css('color', '#800080');
								}else if(data.precariousness == 'Precaire'){
									$('#precariousnessDropdownToggle').addClass('Precaire-option');
									$("#precarious").css('color', '#FFFF00');
								}else{
									$('#precariousnessDropdownToggle').addClass('Grand_Precaire-option');
									$("#precarious").css('color', '#0000FF');
								}
								$("#fiscal_amount").val(data.fiscal_amount);
								$("#family_person").val(data.family_person);
								// $("#address").val(data.address);
								// $("#address2").val(data.address2);
							}
						$('#leadCardCollapse-4').html(data.taxes);
						googleSearchInitialize();
						$('#taxWrapperId').html(data.all_tax);
						$('#taxWrapperId2').html(data.all_tax2);
						$('.collapseRow').show();
						$('#notificationCount').text(data.count);
						$('#notificationList').html(data.response);
						$('#pills-one').html(data.log);
						dateMask();

						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');
						// $('#leadCardCollapse-4').collapse('show');
						$('#info-verify').addClass('verified');
						$('#tax-verify').addClass('verified');
						$("#tax__card__btn").removeClass("d-none");
						$("#tax__card__loader").addClass("d-none");
						if($('#tax-verify').hasClass('verified') && $('#info-verify').hasClass('verified') && $('#work-verify').hasClass('verified')){
							$('#personal_information_tab').addClass('verified');
						}

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
						// location.reload();
						}
					},
					error : errors => {
						$("#tax__card__btn").removeClass("d-none");
						$("#tax__card__loader").addClass("d-none");
					}

				});
			}
		});
		$('body').on('click', '#customTaxValidate',function(){
			$('#taxErrorAlert').modal('hide');
				// if($('#tax_number').length == 0)
				// {
				// 	 exit();
				// }

			var lead_id 				= $('#lead_id').val();
			var company_id 				= $('#company_id').val();
			 var tax_number				= $('#tax_number').val();
			 var tax_reference 			= $('#tax_reference').val();
			// if(tax_number == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Fiscal Number') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#taxValidate').attr('data-toggle', false);
			// 	$('#tax-verify').removeClass('verified');
			// 	$('#tax_number').focus();
			// }
			// else if(tax_reference == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Reference Notice') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#taxValidate').attr('data-toggle', false);
			// 	$('#tax-verify').removeClass('verified');
			// 	$('#tax_reference').focus();
			// }
			// else{
				$("#tax__card__loader").removeClass("d-none");
				$("#tax__card__btn").addClass("d-none");

				$('#taxValidate').attr('data-toggle', 'collapse');
				$('#tax-verify').addClass('verified');
				$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('lead.tax.custom.update') }}",
					data: {

						lead_id 		: lead_id,
						tax_number 		: tax_number,
						tax_reference 	: tax_reference,
						company_id 		: company_id,

					},
					success: function(data){
						if(data.error){
						$('#errorMessage').html(data.error);
						$('.toast.toast--error').toast('show');
						$("#tax__card__btn").removeClass("d-none");
						$("#tax__card__loader").addClass("d-none");
						}
						else{
							$('#leadCardCollapse-4').html(data.taxes);
							googleSearchInitialize();
							$('#taxWrapperId').html(data.all_tax);
							$('#taxWrapperId2').html(data.all_tax2);
							$('.collapseRow').show();
							$('#notificationCount').text(data.count);
							$('#notificationList').html(data.response);
							dateMask();

							$('#successMessage').html(data.alert);
							$('.toast.toast--success').toast('show');
							$('#pills-one').html(data.log);
							// $('#leadCardCollapse-4').collapse('show');
							// $('#info-verify').addClass('verified');
							$('#tax-verify').addClass('verified');
							$("#tax__card__btn").removeClass("d-none");
							$("#tax__card__loader").addClass("d-none");
							if($('#tax-verify').hasClass('verified') && $('#info-verify').hasClass('verified') && $('#work-verify').hasClass('verified')){
								$('#personal_information_tab').addClass('verified');
							}

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
					},

				});
			// }
		});
		$('body').on('click', '#taxVerifyBtn',function(){
			var lead_id 				= $('#lead_id').val();
			var company_id 				= $('#company_id').val();
			var tax_number				= $('#tax_number').val();
			var tax_reference 			= $('#tax_reference').val();

			if($('#tax_number').length == 0){
				exit();
			}

			if(tax_number == ''){
				$('#errorMessage').html("{{ __('Please Enter Fiscal Number') }}");
				$('.toast.toast--error').toast('show');
				$('#taxValidate').attr('data-toggle', false);
				$('#tax-verify').removeClass('verified');
				$('#tax_number').focus();
			}
			else if(tax_reference == ''){
				$('#errorMessage').html("{{ __('Please Enter Reference Notice') }}");
				$('.toast.toast--error').toast('show');
				$('#taxValidate').attr('data-toggle', false);
				$('#tax-verify').removeClass('verified');
				$('#tax_reference').focus();
			}
			else if(tax_number == '0000000000' && tax_reference == '0000000000'){
				return false;
			}
			else{
				$("#tax__card__loader").removeClass("d-none");
				$("#tax__card__btn").addClass("d-none");
				$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('lead.tax.custom.verify') }}",
					data: {

						lead_id 		: lead_id,
						tax_number 		: tax_number,
						tax_reference 	: tax_reference,
						company_id 		: company_id,

					},
					success: function(data){
						if(data.error){
							$('#errorMessage').html(data.error);
							$('.toast.toast--error').toast('show');
							$("#tax__card__btn").removeClass("d-none");
							$("#tax__card__loader").addClass("d-none");
						}
						else{
							$('#leadCardCollapse-4').html(data.taxes);
							googleSearchInitialize();
							$('#taxWrapperId').html(data.all_tax);
							$('#taxWrapperId2').html(data.all_tax2);
							$('.collapseRow').show();
							$('#notificationCount').text(data.count);
							$('#notificationList').html(data.response);
							dateMask();

							$('#successMessage').html(data.alert);
							$('.toast.toast--success').toast('show');
							$('#pills-one').html(data.log);
							// $('#leadCardCollapse-4').collapse('show');
							// $('#info-verify').addClass('verified');
							$('#tax-verify').addClass('verified');
							$("#tax__card__btn").removeClass("d-none");
							$("#tax__card__loader").addClass("d-none");
							if($('#tax-verify').hasClass('verified') && $('#info-verify').hasClass('verified') && $('#work-verify').hasClass('verified')){
								$('#personal_information_tab').addClass('verified');
							}
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
					},
					error: errors => {
						$("#tax__card__btn").removeClass("d-none");
						$("#tax__card__loader").addClass("d-none");
					}

				});
			}
		});

		$('body').on('click', '#presentWorkValidate',function(e){

			e.preventDefault();
			 var lead_id 															= $('#lead_id');
			 var Type_de_logement 													= $('#Type_de_logement');
			 var Type_de_chauffage 													= $('#Type_de_chauffage');
			 var Mode_de_chauffage 													= $('#Mode_de_chauffage');
			 var Date_construction_maison 											= $('#Date_construction_maison');
			 var Surface_habitable 													= $('#hidden_Surface_habitable');
			 var Consommation_chauffage_annuel 										= $('#hidden_Consommation_chauffage_annuel');
			 var Surface_à_chauffer 												= $('#hidden_Surface_à_chauffer');
			 var Mode_de_chauffage__a__ 		    								= $('#Mode_de_chauffage__a__');
			 var Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__ 	= $('#Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__');
			 var Consommation_Chauffage_Annuel_2 									= $('#Consommation_Chauffage_Annuel_2');
			 var Depuis_quand_occupez_vous_le_logement 			    				= $('#Depuis_quand_occupez_vous_le_logement');
			 var auxiliary_heating 													= $('input[name="auxiliary_heating[]"]:checked');
			 var second_heating_generator 											= $('input[name="second_heating_generator[]"]:checked');
			 var second_heating_generator__a__  									= $('#second_heating_generator__a__');
			 var Quels_sont_les_différents_émetteurs_de_chaleur_du_logement 		= $('input[name="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement[]"]:checked');
			 var Production_dapostropheeau_chaude_sanitaire 						= $('#Production_dapostropheeau_chaude_sanitaire');
			 var Instantanné 														= $('input[name="Instantanné[]"]:checked');
			 var Accumulation 														= $('input[name="Accumulation[]"]:checked');
			 var Précisez_le_volume_du_ballon_dapostropheeau_chaude 				= $('#Précisez_le_volume_du_ballon_dapostropheeau_chaude');
			 var Information_logement_observations 			    					= $('#Information_logement_observations');


			//  if($('#auxiliary_heating_statusInput').is(':checked')){
			// 	 var auxiliary_heating_status = 'yes';
			// }else{
			// 	 var auxiliary_heating_status = 'no';
			//  }

			//  if($('#second_heating_generator_statusInput').is(':checked')){
			//  	var second_heating_generator_status = 'yes';
			// }else{
			// 	 var second_heating_generator_status = 'no';
			//  }

			 let custom_field_data = {};

			$('.information_logement__custom_field').each(function(){
				if($(this).data('input') == 'radio'){
					custom_field_data[$(this).attr('name')] = $(`input[name="${$(this).attr('name')}"]:checked`).val();
				}else if($(this).data('input') == 'checkbox'){
					let selected = '';
					$(`input[name="${$(this).attr('name')}"]:checked`).each(function () {
						if($(this).is(':checked')){
							selected += $(this).val() + ',';
						}
					});
					custom_field_data[$(this).attr('name')] = selected ? selected.slice(0, -1) : '';

				}else{
					custom_field_data[$(this).attr('name')] = $(this).val();
				}
			});

			if(Type_de_logement.val() == ''){
				$('#errorMessage').html("Surface Type de logement est requis");
				$('.toast.toast--error').toast('show');
				$('#Type_de_logement').focus();
			}
			else if(Type_de_chauffage.val() == ''){
				$('#errorMessage').html("Surface Type de chauffage est requis");
				$('.toast.toast--error').toast('show');
				$('#Type_de_chauffage').focus();
			}
			else if(Mode_de_chauffage.val() == ''){
				$('#errorMessage').html("Le champ Mode de chauffage est requis");
				$('.toast.toast--error').toast('show');
				Mode_de_chauffage.focus();
			}
			else if(Surface_habitable.val() == ''){
				$('#errorMessage').html("Surface habitable terrain est requis");
				$('.toast.toast--error').toast('show');
				$('#Surface_habitable').focus();
			}
			else if(Surface_à_chauffer.val() == ''){
				$('#errorMessage').html("Le champ Surface à chauffer est requis");
				$('.toast.toast--error').toast('show');
				$('#Surface_à_chauffer').focus();
			}
			else if($("#Type_du_courant_du_logement").val() == ''){
				$('#errorMessage').html("le champ type de compteur du logement est obligatoire");
				$('.toast.toast--error').toast('show');
				$("#Type_du_courant_du_logement").focus();
			}
			else if($('#auxiliary_heating_statusInput').val() == ''){
				$('#errorMessage').html("Le logement possède t-il un chauffage d'appoint ? Champ requis");
				$('.toast.toast--error').toast('show');
				$('#auxiliary_heating_statusInput').focus();
			}
			else if($('#second_heating_generator_statusInput').val() == ''){
				$('#errorMessage').html("La maison possède-t-elle un second générateur de chauffage : Champ requis");
				$('.toast.toast--error').toast('show');
				$('#second_heating_generator_statusInput').focus();
			}
			else if($('#Le_logement_possède_un_réseau_hydraulique').val() == ''){
				$('#errorMessage').html("Le logement possède un réseau hydraulique ? Champ requis");
				$('.toast.toast--error').toast('show');
				$('#Le_logement_possède_un_réseau_hydraulique').focus();
			}

			else if($("#Le_logement_possède_un_réseau_hydraulique").val() == 'Oui' && Quels_sont_les_différents_émetteurs_de_chaleur_du_logement.length == 0){
				$('#errorMessage').html("Quels sont les différents émetteurs hydraulique de chaleur du logement est requis");
				$('.toast.toast--error').toast('show');
				Quels_sont_les_différents_émetteurs_de_chaleur_du_logement.focus();
			}

			else if(Production_dapostropheeau_chaude_sanitaire.val() == ''){
				$('#errorMessage').html("{{ __('Please Select Production deau chaude sanitaire') }}");
				$('.toast.toast--error').toast('show');
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified');
				Production_dapostropheeau_chaude_sanitaire.focus();
			}
			// else if(Instantanné.length == 0){
			// 	$('#errorMessage').html("{{ __('Please Select Any Production deau chaude sanitaire') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	Instantanné.focus();
			// }

			else{
				var auxiliary_heating_data = '';
				var second_heating_generator_data = '';
				var Quels_sont_les_différents_émetteurs_de_chaleur_du_logement_data = '';
				var Instantanné_data = '';
				var Accumulation_data = '';

			 	$.each(auxiliary_heating, function (indexInArray, valueOfElement) {
					auxiliary_heating_data += $(this).val() + ',';
				});
			 	$.each(second_heating_generator, function (indexInArray, valueOfElement) {
					second_heating_generator_data += $(this).val() + ',';
				});
			 	$.each(Quels_sont_les_différents_émetteurs_de_chaleur_du_logement, function (indexInArray, valueOfElement) {
					Quels_sont_les_différents_émetteurs_de_chaleur_du_logement_data += $(this).val() + ',';
				});
			 	$.each(Instantanné, function (indexInArray, valueOfElement) {
					Instantanné_data += $(this).val() + ',';
				});
			 	$.each(Accumulation, function (indexInArray, valueOfElement) {
					Accumulation_data += $(this).val() + ',';
				});


				$('#present-work-verify').addClass('verified');
				$('#presentWorkValidate').attr('data-toggle', 'collapse');
				if($('#present-work-verify').hasClass('verified') && $('#situation_foyer').hasClass('verified')){
					$('#logement_info_tab').addClass('verified');
				}
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('lead.present.work.update') }}",
					data: {
						lead_id 														: lead_id.val(),
						Type_de_logement												: Type_de_logement.val(),
						Type_de_chauffage												: Type_de_chauffage.val(),
						Mode_de_chauffage												: Mode_de_chauffage.val(),
						Date_construction_maison										: Date_construction_maison.val(),
						Surface_habitable												: Surface_habitable.val(),
						Consommation_chauffage_annuel									: Consommation_chauffage_annuel.val(),
						Surface_à_chauffer												: Surface_à_chauffer.val(),
						Mode_de_chauffage__a__											: Mode_de_chauffage__a__.val(),
						Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__	: Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__.val(),
						Consommation_Chauffage_Annuel_2									: Consommation_Chauffage_Annuel_2.val(),
						Depuis_quand_occupez_vous_le_logement							: Depuis_quand_occupez_vous_le_logement.val(),
						auxiliary_heating_status										: $('#auxiliary_heating_statusInput').val(),
						second_heating_generator_status									: $('#second_heating_generator_statusInput').val(),
						Le_logement_possède_un_réseau_hydraulique						: $('#Le_logement_possède_un_réseau_hydraulique').val(),
						auxiliary_heating												: auxiliary_heating_data,
						custom_field_data												: custom_field_data,
						auxiliary_heating__a__											: $('#auxiliary_heating__a__').val(),
						second_heating_generator										: second_heating_generator_data,
						second_heating_generator__a__									: second_heating_generator__a__.val(),
						Quels_sont_les_différents_émetteurs_de_chaleur_du_logement		: Quels_sont_les_différents_émetteurs_de_chaleur_du_logement_data,
						Production_dapostropheeau_chaude_sanitaire						: Production_dapostropheeau_chaude_sanitaire.val(),
						Instantanné														: Instantanné_data,
						Accumulation													: Accumulation_data,
						Précisez_le_volume_du_ballon_dapostropheeau_chaude				: Précisez_le_volume_du_ballon_dapostropheeau_chaude.val(),
						Information_logement_observations								: Information_logement_observations.val(),
						Préciser_le_type_de_radiateurs_Aluminium						: $("#Préciser_le_type_de_radiateurs_Aluminium").is(":checked")?'yes':'no',
						Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs	: $("#Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs").val(),
						Préciser_le_type_de_radiateurs_Fonte							: $("#Préciser_le_type_de_radiateurs_Fonte").is(":checked")?'yes':'no',
						Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs		: $("#Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs").val(),
						Préciser_le_type_de_radiateurs_Acier							: $("#Préciser_le_type_de_radiateurs_Acier").is(":checked")?'yes':'no',
						Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs		: $("#Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs").val(),
						Préciser_le_type_de_radiateurs_Autre							: $("#Préciser_le_type_de_radiateurs_Autre").is(":checked")?'yes':'no',
						Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs		: $("#Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs").val(),
						Préciser_le_type_de_radiateurs_Autre___a__						: $("#Préciser_le_type_de_radiateurs_Autre___a__").val(),
						Type_du_courant_du_logement										: $("#Type_du_courant_du_logement").val(),
						Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude	: $("#Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude").val(),
						Instantanné_Merci_de_préciser									: $("#Instantanné_Merci_de_préciser").val(),
						Accumulation_Merci_de_préciser									: $("#Accumulation_Merci_de_préciser").val(),
						auxiliary_heating__Insert_à_bois_Nombre							: $("#auxiliary_heating__Insert_à_bois_Nombre").val(),
						auxiliary_heating__Poêle_à_bois_Nombre							: $("#auxiliary_heating__Poêle_à_bois_Nombre").val(),
						auxiliary_heating__Poêle_à_gaz_Nombre							: $("#auxiliary_heating__Poêle_à_gaz_Nombre").val(),
						auxiliary_heating__Convecteur_électrique_Nombre					: $("#auxiliary_heating__Convecteur_électrique_Nombre").val(),
						auxiliary_heating__Sèche_serviette_Nombre						: $("#auxiliary_heating__Sèche_serviette_Nombre").val(),
						auxiliary_heating__Panneau_rayonnant_Nombre						: $("#auxiliary_heating__Panneau_rayonnant_Nombre").val(),
						auxiliary_heating__Radiateur_bain_dhuile_Nombre					: $("#auxiliary_heating__Radiateur_bain_dhuile_Nombre").val(),
						auxiliary_heating__Radiateur_soufflan_électrique_Nombre			: $("#auxiliary_heating__Radiateur_soufflan_électrique_Nombre").val(),
						auxiliary_heating__Autre_Nombre									: $("#auxiliary_heating__Autre_Nombre").val(),

					},

					success: function(data){
						// $('#leadCardCollapse-6').collapse('hide');
						// $('#leadCardCollapse-7').collapse('show');
						$('#pills-one').html(data.log);
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');
						// console.log(data);
					},

				});
			}
		});
		$('body').on('click', '#workValidate',function(e){
			// if(!$('#tax-verify').hasClass('verified'))
			// 	{
			// 		$('#leadCardCollapse-2').addClass('show');
			// 		$('#errorMessage').html('Please Enter ');
			// 		$('.toast.toast--error').toast('show');
			// 		exit();
			// 	}

			e.preventDefault();
			 var lead_id 						= $('#lead_id');
			 var Type_occupation 				= $('#Type_occupation');
			 var Parcelle_cadastrale  			= $('#Parcelle_cadastrale');
			 var Nombre_de_foyer 				= $('#Nombre_de_foyer');
			 var Age_du_bâtiment 				= $('#Age_du_bâtiment');
			 var Type_habitation 				= $('#Type_habitation');
			 var Revenue_Fiscale_de_Référence 	= $('#Revenue_Fiscale_de_Référence');
			 var Nombre_de_personnes 			= $('#Nombre_de_personnes');
			 var Zone 							= $('#Zone').val();
			 var precariousness 				= $('#precariousness').val();
			 var precariousness_year 			= $('#precariousness_year').is(':checked') ? '2023' : '2024';

			 let custom_field_data = {};

			$('.eligibility__custom_field').each(function(){
				if($(this).data('input') == 'radio'){
					custom_field_data[$(this).attr('name')] = $(`input[name="${$(this).attr('name')}"]:checked`).val();
				}else if($(this).data('input') == 'checkbox'){
					let selected = '';
					$(`input[name="${$(this).attr('name')}"]:checked`).each(function () {
						if($(this).is(':checked')){
							selected += $(this).val() + ',';
						}
					});
					custom_field_data[$(this).attr('name')] = selected ? selected.slice(0, -1) : '';

				}else{
					custom_field_data[$(this).attr('name')] = $(this).val();
				}
			});


			if(Type_occupation.val() == ''){
				$('#errorMessage').html("Le champ Type de profession est requis");
				$('.toast.toast--error').toast('show');
				 Type_occupation.focus();
			}
			//  else if(Revenue_Fiscale_de_Référence.val() == ''){
			// 	$('#errorMessage').text("Le champ Revenu Fiscale de Référence est requis");
			// 	$('.toast.toast--error').toast('show');
			// 	 Revenue_Fiscale_de_Référence.focus();
			// }			
			//  else if(Nombre_de_personnes.val() == ''){
			// 	$('#errorMessage').text("Le champ Nombre de personnes est requis");
			// 	$('.toast.toast--error').toast('show');
			// 	 Nombre_de_personnes.focus();
			// }
			 else if(Type_habitation.val() == ''){
				$('#errorMessage').html("Le champ Type habitation est requis");
				$('.toast.toast--error').toast('show');
				 Type_habitation.focus();
			}
			 else if(Age_du_bâtiment.val() == ''){
				$('#errorMessage').html("Le champ Age du bâtiment est requis");
				$('.toast.toast--error').toast('show');
				 Age_du_bâtiment.focus();
			}

			else if(Nombre_de_foyer.val() == ''){
				$('#errorMessage').text("Le champ Nombre de foyer est requis");
				$('.toast.toast--error').toast('show');
				 Nombre_de_foyer.focus();
			}

			else{

				$('#work-verify').addClass('verified');
				$('#workValidate').attr('data-toggle', 'collapse');
				if($('#tax-verify').hasClass('verified') && $('#info-verify').hasClass('verified') && $('#work-verify').hasClass('verified')){
					$('#personal_information_tab').addClass('verified');
				}
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('lead.work.update') }}",
					data: {
						lead_id 						: lead_id.val(),
						Type_occupation					: Type_occupation.val(),
						Parcelle_cadastrale				: Parcelle_cadastrale.val(),
						Nombre_de_foyer				   	: Nombre_de_foyer.val(),
						Age_du_bâtiment	     			: Age_du_bâtiment.val(),
						Type_habitation	     			: Type_habitation.val(),
						// Revenue_Fiscale_de_Référence    : Revenue_Fiscale_de_Référence.val(),
                        // Nombre_de_personnes             : Nombre_de_personnes.val(),
                        Zone                        	: Zone,
                        precariousness              	: precariousness,
                        precariousness_year             : precariousness_year,
                        custom_field_data              	: custom_field_data,
					},
					success: function(data){
						// $('#successMessage').html(data);
						// $('#heating_type').val(heatingType.val());
						$(".precarious").text(data.precariousness);
						$("#precarious").text(data.precariousness);
						$("#precariousness").val(data.precariousness);
						$('#precariousnessDropdownToggle').text(data.precariousness);
						$('#precariousnessDropdownToggle').removeClass("Classique-option Intermediaire-option Precaire-option Grand_Precaire-option");
						if(data.precariousness == 'Classique'){
							$("#precarious").css('color', '#FF00FF');
							$('#precariousnessDropdownToggle').addClass('Classique-option');
						}else if(data.precariousness == 'Intermediaire'){
							$('#precariousnessDropdownToggle').addClass('Intermediaire-option');
							$("#precarious").css('color', '#800080');
						}else if(data.precariousness == 'Precaire'){
							$('#precariousnessDropdownToggle').addClass('Precaire-option');
							$("#precarious").css('color', '#FFFF00');
						}else{
							$('#precariousnessDropdownToggle').addClass('Grand_Precaire-option');
							$("#precarious").css('color', '#0000FF');
						}
						$('#pills-one').html(data.log);
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');

					},

				});
			}
		});

		$('body').on('click', '#preValidateBtn',function(){


				if(!$('#tax-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-3').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Tax Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#info-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-4').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Info Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#work-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Eligibility Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}
				else if(!$('#lead-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Lead Tracking Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}
				else if(!$('#present-work-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Chantier Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}
				else if(!$('#situation_foyer').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Situation Foyer Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}
				// else if(!$('#travaux-verify').hasClass('verified'))
				// {
				// 	$('#leftAsideModal').modal('hide');
				// 	$('#errorMessage').html("{{ __('Please Complete Travaux Task') }}");
				// 	$('.toast.toast--error').toast('show');
				// 	exit();
				// }

				// else if(!$('#question-verify').hasClass('verified'))
				// {
				// 	$('#leftAsideModal').modal('hide');
				// 	$('#errorMessage').html("{{ __('Please Complete Question Task') }}");
				// 	$('.toast.toast--error').toast('show');
				// 	exit();
				// }

				// else if(!$('#trait-verify').hasClass('verified'))
				// {
				// 	$('#leftAsideModal').modal('hide');
				// 	$('#errorMessage').html("{{ __('Please Complete Trait Task') }}");
				// 	$('.toast.toast--error').toast('show');
				// 	exit();
				// }

				else{
					$("#lead_status_change").removeClass("d-none");
					$("#lead_status_change_btn").addClass("d-none");
					$('#leftAsideModal').modal('hide');
					var lead_id 		= $('#lead_id').val();
					var status 			= 'pre-validated';

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url: "{{ route('lead.status.update') }}",
						data: {
							lead_id : lead_id,
							status  : status,
						},
						success: function(data){
							$("#lead_status_change").addClass("d-none");
							$("#lead_status_change_btn").removeClass("d-none");
							if(data.error){
								// $('#leftAsideModal').modal('hide');
								$('#errorMessage').html(data.error);
								$('.toast.toast--error').toast('show');
							}
							else{
								$('#lead_status').html("{{ __('Pre-Validated') }}");
								// $('#leftAsideModal').modal('hide');
								$('#userStatus').removeClass('verified');
								$('#TurnToCustomer').removeClass('d-inline-flex');
								// $('#appoinmentBtn').removeClass('d-block');
								// $('#appoinmentBtn').addClass('d-none');
								$('#TurnToCustomer').addClass('d-none');
								$('#successMessage').html(data.success);
								$('.toast.toast--success').toast('show');
								$('#notificationCount').text(data.count);
								$('#notificationList').html(data.response);
								$('#notifyIconVibrate').addClass('active');

							}

						},

					});
				}
		});

		$('body').on('click', '#leadVerifyBtn',function(){


				if(!$('#tax-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-3').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Tax Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#info-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-4').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Info Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#work-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Eligibility Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#lead-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Lead Tracking Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#present-work-verify').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Chantier Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}
				else if(!$('#situation_foyer').hasClass('verified'))
				{
					// $('#leadCardCollapse-5').addClass('show');
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').html("{{ __('Please Complete Situation Foyer Task') }}");
					$('.toast.toast--error').toast('show');
					exit();
				}

				// else if(!$('#travaux-verify').hasClass('verified'))
				// {
				// 	// $('#leadCardCollapse-5').addClass('show');
				// 	$('#leftAsideModal').modal('hide');
				// 	$('#errorMessage').html("{{ __('Please Complete Travaux Task') }}");
				// 	$('.toast.toast--error').toast('show');
				// 	exit();
				// }

				// else if(!$('#question-verify').hasClass('verified'))
				// {
				// 	// $('#leadCardCollapse-5').addClass('show');
				// 	$('#leftAsideModal').modal('hide');
				// 	$('#errorMessage').html("{{ __('Please Complete Question Task') }}");
				// 	$('.toast.toast--error').toast('show');
				// 	exit();
				// }

				// else if(!$('#trait-verify').hasClass('verified'))
				// {
				// 	// $('#leadCardCollapse-5').addClass('show');
				// 	$('#leftAsideModal').modal('hide');
				// 	$('#errorMessage').html("{{ __('Please Complete Trait Task') }}");
				// 	$('.toast.toast--error').toast('show');
				// 	exit();
				// }


				else{
					$("#lead_status_change").removeClass("d-none");
					$("#lead_status_change_btn").addClass("d-none");
					$('#leftAsideModal').modal('hide');
					var lead_id 		= $('#lead_id').val();
					var status 			= 'verified';

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST",
						url: "{{ route('lead.status.update') }}",
						data: {
							lead_id : lead_id,
							status  : status,
						},
						success: function(data){
							$("#lead_status_change").addClass("d-none");
							$("#lead_status_change_btn").removeClass("d-none");
							if(data.error){
								$('#leftAsideModal').modal('hide');
								$('#errorMessage').html(data.error);
								$('.toast.toast--error').toast('show');
							}
							else{
								$('#lead_status').html("{{ __('Verified') }}");
								$('#leftAsideModal').modal('hide');
								$('#userStatus').addClass('verified');
								$('#TurnToCustomer').removeClass('d-none');
								$('#TurnToCustomer').addClass('d-inline-flex');
								// $('#appoinmentBtn').addClass('d-block');
								$('#successMessage').html(data.success);
								$('.toast.toast--success').toast('show');
								$('#notificationCount').text(data.count);
								$('#notificationList').html(data.response);
								$('#notifyIconVibrate').addClass('active');
							}


						},

					});
				}
		});

		$('body').on('click', '.infoValidateBtn', function(){
			var id = $(this).attr('data-tax-id');
			var lead_id 			= $('#lead_id').val();
			var company_id 			= $('#company_id').val();
			var  title 				= $('#f__title');
			var  second_title 		= $('#f__second_title');
			var  first_name         = $('#f__first_name');
			var  last_name          = $('#f__last_name');
			var  second_first_name  = $('#f__second_first_name');
			var  second_last_name   = $('#f__second_last_name');
			var  postal_code        = $('#f__postal_code');
			var  city               = $('#f__city');
			var  address2           = $('#f__address2');
			var  address            = $('#f__address1');
			var  telephone 			= $('#f__home_telephone').val();
			var  phone 				= $('#f__phone');
			var  email 				= $('#f__email');


			let custom_field_data = {};

			$('.personal_info_custom_field').each(function(){
				if($(this).data('input') == 'radio'){
					custom_field_data[$(this).attr('name')] = $(`input[name="${$(this).attr('name')}"]:checked`).val();
				}else if($(this).data('input') == 'checkbox'){
					let selected = '';
					$(`input[name="${$(this).attr('name')}"]:checked`).each(function () {
						if($(this).is(':checked')){
							selected += $(this).val() + ',';
						}
					});
					custom_field_data[$(this).attr('name')] = selected ? selected.slice(0, -1) : '';

				}else{
					custom_field_data[$(this).attr('name')] = $(this).val();
				}
			});
			// var title = [];
			// $("select.notun-system").each(function(i, sel){
			// 	var selectedVal = $(sel).val();
			// 	title.push(selectedVal);
			// });
			// var title = [];
			// $("select.info_title").each(function(i, sel){
			// 	var selectedVal = $(sel).val();
			// 	title.push(selectedVal);
			// });

			// var first_name = [];
			// $("input.info_first_name").each(function(i, sel){
			// 	var selectedVal = $(sel).val();
			// 	first_name.push(selectedVal);
			// });

			// var last_name = [];
			// $("input.info_last_name").each(function(i, sel){
			// 	var selectedVal = $(sel).val();
			// 	last_name.push(selectedVal);
			// });

			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;


				// if(values == ''){
				// 	$('#errorMessage').html("{{ __('Please Select Title') }}");
				// 	$('.toast.toast--error').toast('show');
				// 	$('#infoValidate').attr('data-toggle', false);
				// 	title.focus();
				// }
				// $('.info_title').each(function(){
				// 	if($(this).val() == ''){
				// 		$('#errorMessage').html("{{ __('Please Select Title') }}");
				// 		$('.toast.toast--error').toast('show');
				// 		$(this).focus();
				// 		exit();
				// 	}
				// });

				// $('.info_first_name').each(function(){
				// 	if($(this).val() == ''){
				// 		$('#errorMessage').html("{{ __('Please Enter First Name') }}");
				// 		$('.toast.toast--error').toast('show');
				// 		$(this).focus();
				// 		exit();
				// 	}
				// });

				// $('.info_last_name').each(function(){
				// 	if($(this).val() == ''){
				// 		$('#errorMessage').html("{{ __('Please Enter Last Name') }}");
				// 		$('.toast.toast--error').toast('show');
				// 		$(this).focus();
				// 		exit();
				// 	}
				// });

				if(title.val() == ''){
					$('#errorMessage').html("{{ __('Please Select Title') }}");
					$('.toast.toast--error').toast('show');
					title.focus();
				}
				else if(first_name.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter First Name') }}");
					$('.toast.toast--error').toast('show');
					first_name.focus();
				}
				else if(last_name.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter Last Name') }}");
					$('.toast.toast--error').toast('show');
					last_name.focus();
				}
				else if(second_title.val() == ''){
					$('#errorMessage').html("{{ __('Please Select Title') }}");
					$('.toast.toast--error').toast('show');
					second_title.focus();
				}
				else if(second_first_name.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter First Name') }}");
					$('.toast.toast--error').toast('show');
					second_first_name.focus();
				}
				else if(second_last_name.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter Last Name') }}");
					$('.toast.toast--error').toast('show');
					second_last_name.focus();
				}
				else if(address2.val() == ''){
					$('#errorMessage').html("Le champ Adresse est requis");
					$('.toast.toast--error').toast('show');
					address2.focus();
				}
				else if(postal_code.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter Code Postal') }}");
					$('.toast.toast--error').toast('show');
					postal_code.focus();
				}
				else if(city.val() == ''){
					$('#errorMessage').html("Le champ ville est requis");
					$('.toast.toast--error').toast('show');
					city.focus();
				}
				else if(!$('#same_as_work_address').is(':checked') && $('#f__Adresse_Travaux').val() == ''){
					$('#errorMessage').html("Le champ Adresse Travaux est requis");
					$('.toast.toast--error').toast('show');
					$('#f__Adresse_Travaux').focus();
				}
				else if(!$('#same_as_work_address').is(':checked') && $('#f__Code_postal_Travaux').val() == ''){
					$('#errorMessage').html("Code postal Le champ Travaux est requis");
					$('.toast.toast--error').toast('show');
					$('#f__Code_postal_Travaux').focus();
				}
				else if(!$('#same_as_work_address').is(':checked') && $('#f__Code_postal_Travaux').val().length != 5){
					$('#errorMessage').html("Le code postal doit être composé de 5 chiffres");
					$('.toast.toast--error').toast('show');
					$('#f__Code_postal_Travaux').focus();
				}
				else if(postal_code.val().length != 5){
					$('#errorMessage').html("Le code postal doit être composé de 5 chiffres");
					$('.toast.toast--error').toast('show');
					postal_code.focus();
				}
				else if(email.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter Email') }}");
					$('.toast.toast--error').toast('show');
					email.focus();
				}
				else if(!regex.test(email.val())){
					$('#errorMessage').html("{{ __('Please Enter Valid Email') }}");
					$('.toast.toast--error').toast('show');
					email.focus();
				}
				else if(phone.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter Phone Number') }}");
					$('.toast.toast--error').toast('show');
					phone.focus();
				}
				else if(phone.val().length > 11){
					$('#errorMessage').html("{{ __('Please Enter Valid Phone Number') }}");
					$('.toast.toast--error').toast('show');
					phone.focus();
				}
				else{
					// alert('success');
					// $('#infoValidate').attr('data-toggle', 'collapse');
					// $('#info-verify').addClass('verified');

					$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
					$.ajax({
						type: "POST",
						url:"{{ route('tax.info.update') }}",
						data: {
							tax_id							:id,
							lead_id							:lead_id,
							company_id						:company_id,
							phone							:phone.val(),
							email							:email.val(),
							telephone						:telephone,
                            postal_code         			:postal_code.val(),
                            city                			:city.val(),
                            address             			:address.val(),
                            address2            			:address2.val(),
							title							:title.val(),
							first_name          			:first_name.val(),
                            last_name           			:last_name.val(),
							second_title					:second_title.val(),
							second_first_name   			:second_first_name.val(),
                            second_last_name    			:second_last_name.val(),
                            observations    				:$('#f__observation').val(),
                            same_as_work_address    		:$('#same_as_work_address').is(':checked') ? 'yes':'no',
                            Adresse_Travaux    				:$('#f__Adresse_Travaux').val(),
                            Complément_adresse_Travaux   	:$('#f__Complément_adresse_Travaux').val(),
                            Code_postal_Travaux    			:$('#f__Code_postal_Travaux').val(),
                            Ville_Travaux    				:$('#f__Ville_Travaux').val(),
							google_address    				:$('#google_address').val(),
                            custom_field_data    			:custom_field_data,
						},

						success: function(data){

							if(data.email){
								$("#email-address").text(data.email);
								$("#telephone").text(data.phone);
								$("#AvisFiscaleName"+id).text(data.name);
								$("#userStatus").text(data.name);
								$("#department").text(data.city);
								$("#zone").text(data.zone);
								$("#f__Departement_Travaux").val(data.department);
								$("#Adresse_des_travaux").val(data.address);
								$("#Code_postale_des_travaux").val(data.postal_code);
								$("#Ville_des_travaux").val(data.ville);
								$("#Département_des_travaux").val(data.department);
							}

							if(data.precariousness){
								$(".precarious").text(data.precariousness);
								$("#precarious").text(data.precariousness);
								$('#precariousnessDropdownToggle').text(data.precariousness);
								$('#precariousnessDropdownToggle').removeClass("Classique-option Intermediaire-option Precaire-option Grand_Precaire-option");
								if(data.precariousness == 'Classique'){
									$("#precarious").css('color', '#FF00FF');
									$('#precariousnessDropdownToggle').addClass('Classique-option');
								}else if(data.precariousness == 'Intermediaire'){
									$("#precarious").css('color', '#800080');
									$('#precariousnessDropdownToggle').addClass('Intermediaire-option');
								}else if(data.precariousness == 'Precaire'){
									$("#precarious").css('color', '#FFFF00');
									$('#precariousnessDropdownToggle').addClass('Precaire-option');
								}else{
									$("#precarious").css('color', '#0000FF');
									$('#precariousnessDropdownToggle').addClass('Grand_Precaire-option');
								}
							}

							// $('#leadCardCollapse-4').collapse('hide');
							$('#info-verify').addClass('verified');
							// $("#userStatus").text(data.first_name+" "+data.last_name);

							$('#successMessage').html(data.alert);
                            $('#google_address2').val($('#google_address').val());
                            $('#googleMapImage2').attr('href', 'https://www.google.com/maps?q='+data.loggleAddress);
							$('#googleMapImage').attr('href', 'https://www.google.com/maps?q='+data.loggleAddress);
							$('#pills-one').html(data.log);
							$('.toast.toast--success').toast('show');
							if($('#tax-verify').hasClass('verified') && $('#info-verify').hasClass('verified') && $('#work-verify').hasClass('verified')){
							$('#personal_information_tab').addClass('verified');
							}
							
							if(data.zone_type == 'Zone_Hors_IDF'){
                                $('#Zone_IDF').prop('checked', false);
                                $('#Zone_Hors_IDF').prop('checked', true);
                            }else{
                                $('#Zone_Hors_IDF').prop('checked', false);
                                $('#Zone_IDF').prop('checked', true);
                            }
						},

					});
				}

		});

		$('body').on('click', '.taxCheckedBtn', function(){
			var tax_id 		= $(this).attr('data-tax-id');
			var lead_id 	= $('#lead_id').val();
			var company_id 	= $('#company_id').val();

			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			$.ajax({
				type: "POST",
				url: "{{ route('tax.primary.change') }}",
				data: {
						lead_id 	: lead_id,
						company_id 	: company_id ,
						tax_id		:tax_id,
				},
				success: function(data){

					$('#leadCardCollapse-4').html(data.taxes);
					googleSearchInitialize();
					$('#infoValidate').attr('data-toggle', 'collapse');
					$('#info-verify').addClass('verified');
					$("#zone").text(data.zone);
					$(".precarious").text(data.precariousness);
					$("#precarious").text(data.precariousness);
					$("#department").text(data.city);
					$("#userStatus").text(data.name);
					$("#email-address").text(data.email);
					$("#telephone").text(data.phone);
					$("#zone_data").val(data.zone);
					$("#precariousness").val(data.precariousness);
					$('#precariousnessDropdownToggle').text(data.precariousness);
					$('#precariousnessDropdownToggle').removeClass("Classique-option Intermediaire-option Precaire-option Grand_Precaire-option");
					if(data.precariousness == 'Classique'){
						$("#precarious").css('color', '#FF00FF');
						$('#precariousnessDropdownToggle').addClass('Classique-option');
					}else if(data.precariousness == 'Intermediaire'){
						$("#precarious").css('color', '#800080');
						$('#precariousnessDropdownToggle').addClass('Intermediaire-option');
					}else if(data.precariousness == 'Precaire'){
						$("#precarious").css('color', '#FFFF00');
						$('#precariousnessDropdownToggle').addClass('Precaire-option');
					}else{
						$("#precarious").css('color', '#0000FF');
						$('#precariousnessDropdownToggle').addClass('Grand_Precaire-option');
					}
					// $("#fiscal_amount").val(data.fiscal_amount);
					// $("#family_person").val(data.family_person);
					// $("#address").val(data.address);
					// $("#address2").val(data.address2);
					// $("#userStatus").text(data.first_name+" "+data.last_name);

					$('#successMessage').html(data.alert);
					$('.toast.toast--success').toast('show');


				},


			});
		});
		$('body').on('click', '.taxMarkChecked', function(){
			var tax_id 		= $(this).attr('data-tax-id');
			var lead_id 	= $('#lead_id').val();
			var company_id 	= $('#company_id').val();
			if(this.checked){
				let = data = 'yes';
			}else{
				let = data = 'no';
			}
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			$.ajax({
				type: "POST",
				url: "{{ route('tax.mark.check') }}",
				data: {
						lead_id 	: lead_id,
						company_id 	: company_id ,
						tax_id 		: tax_id,
						data 		: data,

				},
				success: function(data){
					$('#leadCardCollapse-4').html(data.taxes);
					googleSearchInitialize();
					$('#successMessage').html(data.alert);
					$('#fiscal_amount').val(data.fiscal_amount);
					$('#family_person').val(data.family_person);
					$('.toast.toast--success').toast('show');

					$(".precarious").text(data.precariousness);
					$("#precarious").text(data.precariousness);
					$("#precariousness").val(data.precariousness);
					$('#precariousnessDropdownToggle').text(data.precariousness);
					$('#precariousnessDropdownToggle').removeClass("Classique-option Intermediaire-option Precaire-option Grand_Precaire-option");
					if(data.precariousness == 'Classique'){
						$("#precarious").css('color', '#FF00FF');
						$('#precariousnessDropdownToggle').addClass('Classique-option');
					}else if(data.precariousness == 'Intermediaire'){
						$("#precarious").css('color', '#800080');
						$('#precariousnessDropdownToggle').addClass('Intermediaire-option');
					}else if(data.precariousness == 'Precaire'){
						$("#precarious").css('color', '#FFFF00');
						$('#precariousnessDropdownToggle').addClass('Precaire-option');
					}else{
						$("#precarious").css('color', '#0000FF');
						$('#precariousnessDropdownToggle').addClass('Grand_Precaire-option');
					}
				},


			});
		});

		$('body').on('change', '#Production_dapostropheeau_chaude_sanitaire',function(){
			var data = $(this).val();
			if(data == 'Instantanné'){
				$.each($('input[name="Accumulation[]"]:checked'), function (indexInArray, valueOfElement) {
					$(this).prop( "checked", false );
				});
				$('#accumulation').hide('fadeOut');
				$('#instant').show('fadeIn');
			}
			else if(data == 'Accumulation'){
				$.each($('input[name="Instantanné[]"]:checked'), function (indexInArray, valueOfElement) {
					$(this).prop( "checked", false );
				});
				$('#instant').hide('fadeOut');
				$('#accumulation').show('fadeIn');
			}
			else{
				$.each($('input[name="Accumulation[]"]:checked'), function (indexInArray, valueOfElement) {
					$(this).prop( "checked", false );
				});
				$.each($('input[name="Instantanné[]"]:checked'), function (indexInArray, valueOfElement) {
					$(this).prop( "checked", false );
				});
				$('#accumulation').hide('fadeOut');
				$('#instant').hide('fadeOut');
			}
		});

		$('body').on('click', '#add_dependent_children', function(){
			// if($('#existingChildren').val() == 'empty'){
			// 	$('#errorMessage').html("{{ __('please complete open fields first') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	exit();
			// }

			var item = '<div class="row birth_info"> <div class="col-md-5"> <div class="form-group"> <label class="form-label">Nom </label> <input type="text" class="form-control shadow-none birth_name"> </div> </div> <div class="col-md-5"> <div class="form-group"> <label class="form-label">{{ __("Date de naissance") }} </label> <input type="text" class="date-mask form-control shadow-none birth_date" placeholder="__/__/____"></div> </div> </div>';

			$('#dependent_children').append(item);
			dateMask();
		});

		$('body').on('click', '#situation_foyer_btn',function(){

			var lead_id 										= $('#lead_id').val();
			var Situation_familiale 							= $('#Situation_familiale').val();
			var birth_name 										= {};
			var birth_date 										= {};
			var Quel_est_le_contrat_de_travail_de_Personne_1  	= $('input[name="Quel_est_le_contrat_de_travail_de_Personne_1"]:checked').val();
			var Revenue_Personne_1 								= $('#Revenue_Personne_1').val();
			var Quel_est_le_contrat_de_travail_de_Personne_2  	= $('input[name="Quel_est_le_contrat_de_travail_de_Personne_2"]:checked').val();
			var Revenue_Personne_2 								= $('#Revenue_Personne_2').val();
			var Crédit_du_foyer_mensuel 						= $('#Crédit_du_foyer_mensuel').val();
			var Commentaires_revenue_et_crédit_du_foyer 		= $('#Commentaires_revenue_et_crédit_du_foyer').val();

			if($('#Y_a_t_il_des_enfants_dans_le_foyer_fiscale').val() == 'Oui'){
				$('body .birth_info').each(function (index, element) {
					if(!$(element).find('.birth_name').val()){
						$('#errorMessage').html("Le nom est requis");
						$('.toast.toast--error').toast('show');
						$(element).find('.birth_name').focus();
						exit();
					}else{
						birth_name[index] = $(element).find('.birth_name').val();
					}
					if(!$(element).find('.birth_date').val()){
						$('#errorMessage').html("La date de naissance est requis");
						$('.toast.toast--error').toast('show');
						$(element).find('.birth_date').focus();
						exit();
					}else{
						birth_date[index] = $(element).find('.birth_date').val();
					}
				})
			}
			let custom_field_data = {};

			$('.situation_foyer__custom_field').each(function(){
				if($(this).data('input') == 'radio'){
					custom_field_data[$(this).attr('name')] = $(`input[name="${$(this).attr('name')}"]:checked`).val();
				}else if($(this).data('input') == 'checkbox'){
					let selected = '';
					$(`input[name="${$(this).attr('name')}"]:checked`).each(function () {
						if($(this).is(':checked')){
							selected += $(this).val() + ',';
						}
					});
					custom_field_data[$(this).attr('name')] = selected ? selected.slice(0, -1) : '';

				}else{
					custom_field_data[$(this).attr('name')] = $(this).val();
				}
			});

			if($('#Y_a_t_il_des_enfants_dans_le_foyer_fiscale').val() == ''){
				$('#errorMessage').html("Y at-il des enfants dans le foyer fiscal ? Champ requis");
				$('.toast.toast--error').toast('show');
				$('#Y_a_t_il_des_enfants_dans_le_foyer_fiscale').focus();
			}
			else{
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('lead.foyer.update') }}",
					data: {
						lead_id 											: lead_id,
						custom_field_data									: custom_field_data,
						Situation_familiale									: Situation_familiale,
						birth_name											: birth_name,
						birth_date											: birth_date,
						Quel_est_le_contrat_de_travail_de_Personne_1		: Quel_est_le_contrat_de_travail_de_Personne_1,
						Revenue_Personne_1									: Revenue_Personne_1,
						Quel_est_le_contrat_de_travail_de_Personne_2		: Quel_est_le_contrat_de_travail_de_Personne_2,
						Revenue_Personne_2									: Revenue_Personne_2,
						Crédit_du_foyer_mensuel								: Crédit_du_foyer_mensuel,
						Commentaires_revenue_et_crédit_du_foyer				: Commentaires_revenue_et_crédit_du_foyer,
						Situation_familiale___a__							: $('#Situation_familiale___a__').val(),
						Personne_1											: $('#Personne_1').val(),
						Quel_est_le_contrat_de_travail_de_Personne_1__a__	: $('#Quel_est_le_contrat_de_travail_de_Personne_1__a__').val(),
						Existehyphenthyphenil_un_conjoint					: $('#Existehyphenthyphenil_un_conjoint').is(":checked")?'yes':'no',
						Y_a_t_il_des_enfants_dans_le_foyer_fiscale			: $('#Y_a_t_il_des_enfants_dans_le_foyer_fiscale').val(),
						Personne_2											: $('#Personne_2').val(),
						Quel_est_le_contrat_de_travail_de_Personne_2__a__	: $('#Quel_est_le_contrat_de_travail_de_Personne_2__a__').val(),

					},

					success: function(data){
						$('#situation_foyer').addClass('verified');
						// $('#leadCardCollapse-7').collapse('hide');
						$('#dependent_children').html(data.children);
						dateMask();
						// console.log(data)
						$('#successMessage').html(data.alert);
						$('#pills-one').html(data.log);
						$('.toast.toast--success').toast('show');
					},

				});

			};



		});

		$('body').on('click', '#leadTrackValidate',function(e){
			e.preventDefault();
			var lead_id 													= $('#lead_id').val();
			var __tracking__Fournisseur_de_lead 							= $('#__tracking__Fournisseur_de_lead');
			var __tracking__Type_de_campagne 								= $('#__tracking__Type_de_campagne');
			var __tracking__Nom_campagne 									= $('#__tracking__Nom_campagne');
			var __tracking__Date_demande_lead 								= $('#__tracking__Date_demande_lead');
			var __tracking__Date_attribution_télécommercial 				= $('#__tracking__Date_attribution_télécommercial');
			var __tracking__Nom_Prénom 										= $('#__tracking__Nom_Prénom');
			var __tracking__Code_postal 									= $('#__tracking__Code_postal');
			var __tracking__téléphone 										= $('#__tracking__téléphone');
			var __tracking__Mode_de_chauffage 								= $('#__tracking__Mode_de_chauffage');
			var __tracking__Propriétaire 									= $('#__tracking__Propriétaire');
			var __tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans 	= $('#__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans');
			var __tracking__Email 											= $('#__tracking__Email');

			let custom_field_data = {};

			$('.lead_tracking_custom_field').each(function(){
				if($(this).data('input') == 'radio'){
					custom_field_data[$(this).attr('name')] = $(`input[name="${$(this).attr('name')}"]:checked`).val();
				}else if($(this).data('input') == 'checkbox'){
					let selected = '';
					$(`input[name="${$(this).attr('name')}"]:checked`).each(function () {
						if($(this).is(':checked')){
							selected += $(this).val() + ',';
						}
					});
					custom_field_data[$(this).attr('name')] = selected ? selected.slice(0, -1) : '';

				}else{
					custom_field_data[$(this).attr('name')] = $(this).val();
				}
			});

			if(!__tracking__Type_de_campagne.val()){
				$('#errorMessage').html("Veuillez sélectionner le type de campagne");
				$('.toast.toast--error').toast('show');
				__tracking__Type_de_campagne.focus();
			}
			else if(!__tracking__Date_demande_lead.val()){
				$('#errorMessage').html("Veuillez sélectionner la date de la demande de prospect");
				$('.toast.toast--error').toast('show');
				__tracking__Date_demande_lead.focus();
			}
			else if(!__tracking__Nom_Prénom.val()){
				$('#errorMessage').html("Veuillez entrer Nom et prénom");
				$('.toast.toast--error').toast('show');
				__tracking__Nom_Prénom.focus();
			}
			else if(!__tracking__Code_postal.val()){
				$('#errorMessage').html("Veuillez entrer le code postal");
				$('.toast.toast--error').toast('show');
				__tracking__Code_postal.focus();
			}
			else if(__tracking__Code_postal.val().length != 5){
				$('#errorMessage').html("Le code postal doit être composé de 5 chiffres");
				$('.toast.toast--error').toast('show');
				__tracking__Code_postal.focus();
			}

			else if(!__tracking__téléphone.val()){
				$('#errorMessage').html("Veuillez entrer téléphone");
				$('.toast.toast--error').toast('show');
				__tracking__téléphone.focus();
			}
			else if(!__tracking__Mode_de_chauffage.val()){
				$('#errorMessage').html("Veuillez saisir Mode de chauffage");
				$('.toast.toast--error').toast('show');
				__tracking__Mode_de_chauffage.focus();
			}
			else{
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			$.ajax({
				type: "POST",
				url: "{{ route('lead.tracker.update') }}",
				data: {
						lead_id 													: lead_id,
						custom_field_data											:  custom_field_data,
						__tracking__Fournisseur_de_lead 							: __tracking__Fournisseur_de_lead.val(),
						__tracking__Type_de_campagne 								: __tracking__Type_de_campagne.val(),
						__tracking__Nom_campagne 									: __tracking__Nom_campagne.val(),
						__tracking__Date_demande_lead 								: __tracking__Date_demande_lead.val(),
						__tracking__Date_attribution_télécommercial 				: __tracking__Date_attribution_télécommercial.val(),
						__tracking__Nom_Prénom  									: __tracking__Nom_Prénom.val(),
						__tracking__Code_postal 									: __tracking__Code_postal.val(),
						__tracking__téléphone 										: __tracking__téléphone.val(),
						__tracking__Mode_de_chauffage 								: __tracking__Mode_de_chauffage.val(),
						__tracking__Propriétaire 									: __tracking__Propriétaire.val(),
						__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans 	: __tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans.val(),
						__tracking__Email 											: __tracking__Email.val(),
						__tracking__Type_de_campagne__a__ 							: $("#__tracking__Type_de_campagne__a__").val(),
						__tracking__Mode_de_chauffage__a__ 							: $("#__tracking__Mode_de_chauffage__a__").val(),
						__tracking__Type_de_travaux_souhaité 						: $("#__tracking__Type_de_travaux_souhaité").val() ? $("#__tracking__Type_de_travaux_souhaité").val().toString() : $("#__tracking__Type_de_travaux_souhaité").val(),
				},
				success: function(data){

					// $('#leadCardCollapse-1').collapse('hide');
					$('#__tracking__Département').val(data.department);
					$('#lead-verify').addClass('verified');
					$('#lead_tracking_tab').addClass('verified');

					// $("#userStatus").html(data.first_name+" "+data.last_name);

					$('#successMessage').html(data.alert);
					$('#pills-one').html(data.log);
					$('.toast.toast--success').toast('show');


				},


			});
			}
		});



		$('body').on('click', '#travauxValidate',function(){
			var tag_product			={};
			var surface				={};
			var Nombre_de_split		={};
			var Type_de_comble		={};
			var marque				={};
			var tag_product_nombre  ={};
			var product        	= $('.tag__product');
			let custom_field_data  = {};
			var shab  ={};
			var Nombre_de_pièces_dans_le_logement  ={};
			var Type_de_radiateur  ={};
			var Nombre_de_radiateurs_électrique  ={};
			var Nombre_de_radiateurs_combustible  ={};
			var Nombre_de_radiateur_total_dans_le_logement  ={};
			var Thermostat_supplémentaire  ={};
			var Nombre_thermostat_supplémentaire  ={};

			$('.project__custom_field').each(function(){
				if($(this).data('input') == 'radio'){
					custom_field_data[$(this).attr('name')] = $(`input[name="${$(this).attr('name')}"]:checked`).val();
				}else if($(this).data('input') == 'checkbox'){
					let selected = '';
					$(`input[name="${$(this).attr('name')}"]:checked`).each(function () {
						if($(this).is(':checked')){
							selected += $(this).val() + ',';
						}
					});
					custom_field_data[$(this).attr('name')] = selected ? selected.slice(0, -1) : '';

				}else{
					custom_field_data[$(this).attr('name')] = $(this).val();
				}
			});

			$('.tag_product_nombre').each(function(){
				tag_product_nombre[$(this).data('product-id')] = $(this).data('tag-id')+'__'+$(this).val();
			});
			product.each(function(){
				tag_product[$(this).data('tag-id')]=$("#product"+$(this).data('tag-id')).val();
				surface[$(this).data('tag-id')]=$("#surface"+$(this).data('tag-id')).val();
				Nombre_de_split[$(this).data('tag-id')]=$("#Nombre_de_split"+$(this).data('tag-id')).val();
				Type_de_comble[$(this).data('tag-id')]=$("#Type_de_comble"+$(this).data('tag-id')).val();
				marque[$(this).data('tag-id')]=$("#marque"+$(this).data('tag-id')).val();
				shab[$(this).data('tag-id')]=$("#shab"+$(this).data('tag-id')).val();
				Nombre_de_pièces_dans_le_logement[$(this).data('tag-id')]=$("#Nombre_de_pièces_dans_le_logement"+$(this).data('tag-id')).val();
				Type_de_radiateur[$(this).data('tag-id')]=$("#Type_de_radiateur"+$(this).data('tag-id')).val();
				Nombre_de_radiateurs_électrique[$(this).data('tag-id')]=$("#Nombre_de_radiateurs_électrique"+$(this).data('tag-id')).val();
				Nombre_de_radiateurs_combustible[$(this).data('tag-id')]=$("#Nombre_de_radiateurs_combustible"+$(this).data('tag-id')).val();
				Nombre_de_radiateur_total_dans_le_logement[$(this).data('tag-id')]=$("#Nombre_de_radiateur_total_dans_le_logement"+$(this).data('tag-id')).val();
				Thermostat_supplémentaire[$(this).data('tag-id')]=$("#Thermostat_supplémentaire"+$(this).data('tag-id')).val();
				Nombre_thermostat_supplémentaire[$(this).data('tag-id')]=$("#Nombre_thermostat_supplémentaire"+$(this).data('tag-id')).val();
			})

			if(!$('#bareme').val()){
				$('#errorMessage').html("le champ barèmes est requis");
				$('.toast.toast--error').toast('show');
				$('#bareme').focus();
			// }else if(!$('#Type_de_contrat').val()){
            //     $('#errorMessage').html("Le champ type de contrat est requis");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#Type_de_contrat').focus();
            }else{
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('lead.travaux.update') }}",
					data: {
						lead_id 											: $('#lead_id').val(),
						bareme 												: $('#bareme').val(),
						travaux 											: $('#travaux').val(),
						Projet_observations 								: $('#Projet_observations').val(),
						advance_visit 										: $('#advance_visit').val(),
						custom_field_data 									: custom_field_data,
						tag_product 										: tag_product,
						surface 											: surface,
						Nombre_de_split 									: Nombre_de_split,
						Type_de_comble 									    : Type_de_comble,
						tag_product_nombre 									: tag_product_nombre,
						marque 												: marque,
						shab 												: shab,
						Nombre_de_pièces_dans_le_logement 					: Nombre_de_pièces_dans_le_logement,
						Type_de_radiateur 									: Type_de_radiateur,
						Nombre_de_radiateurs_électrique 					: Nombre_de_radiateurs_électrique,
						Nombre_de_radiateurs_combustible 					: Nombre_de_radiateurs_combustible,
						Nombre_de_radiateur_total_dans_le_logement 			: Nombre_de_radiateur_total_dans_le_logement,
						Thermostat_supplémentaire 							: Thermostat_supplémentaire,
						Nombre_thermostat_supplémentaire 					: Nombre_thermostat_supplémentaire,
						// Adresse_des_travaux 								: $('#Adresse_des_travaux').val(),
						// Code_postale_des_travaux 							: $('#Code_postale_des_travaux').val(),
						// Ville_des_travaux 									: $('#Ville_des_travaux').val(),
						// Département_des_travaux 							: $('#Département_des_travaux').val(),
						Type_de_contrat 									: $('#Type_de_contrat').val(),
						MaPrimeRenov 										: $('#MaPrimeRenov').is(':checked') ? 'yes':'no',
						Action_Logement 									: $('#Action_Logement').is(':checked') ? 'yes':'no',
						CEE 												: $('#CEE').is(':checked') ? 'yes':'no',
						Credit 												: $('#Credit').is(':checked') ? 'yes':'no',
						Reste_à_charge 										: $('#Reste_à_charge').is(':checked') ? 'yes':'no',
						Subvention_MaPrimeRénov_déduit_du_devis 			: $('#Subvention_MaPrimeRénov_déduit_du_devis').val(),
						// Subvention_MaPrimeRénov_déduit_du_devis 			: $('#Subvention_MaPrimeRénov_déduit_du_devis').is(':checked') ? 'yes':'no',
						Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov : $('#Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov').val(),
						Montant_Crédit 										: $('#Montant_Crédit').val(),
						Report_du_crédit 									: $('#Report_du_crédit').is(':checked') ? 'yes':'no',
						Nombre_de_jours_report 								: $('#Nombre_de_jours_report').val(),
						Reste_à_charge_Montant 								: $('#Reste_à_charge_Montant').val(),
						Mode_de_paiement 									: $('#Mode_de_paiement').val(),
						Nombre_de_mensualités 								: $('#Nombre_de_mensualités').val(),
						Montant_estimée_de_lapostropheaide 					: $('#Montant_estimée_de_lapostropheaide').val(),
						Survente 											: $('#Survente').val(),
						Montant_survente 									: $('#Montant_survente').val(),
						Observations_reste_à_charge 						: $('#Observations_reste_à_charge').val(),
					},

					success: function(data){
						// console.log(data);
						$('#travaux-verify').addClass('verified');
						// $('#leadCardCollapse-8').collapse('hide');
						// $('#leadCardCollapse-8').collapse('hide');
						$('#questionBlock').html(data.questions);
						$('#successMessage').html(data.alert);
						$('#pills-one').html(data.log);
						$('#projectName').html(data.tag);
						$('#MaPrimeRenovEstimatedAmount').text(data.maprime);
						$('#CEEEstimatedAmount').text(data.cee);
						$('.toast.toast--success').toast('show');
						if($('#travaux-verify').hasClass('verified') && $('#question-verify').hasClass('verified')){
							$('#section_project_tab').addClass('verified');
						}
					},

				});
			}


        });

		$('body').on('change', '#bareme',function(){
			var id = $(this).val();
			var tag_product			={};
			var surface				={};
			var Nombre_de_split		={};
			var Type_de_comble		={};
			var tag_product_nombre  ={};
			var marque  			={};
			var product        		= $('.tag__product');
			var shab  ={};
			var Nombre_de_pièces_dans_le_logement  ={};
			var Type_de_radiateur  ={};
			var Nombre_de_radiateurs_électrique  ={};
			var Nombre_de_radiateurs_combustible  ={};
			var Nombre_de_radiateur_total_dans_le_logement  ={};
			var Thermostat_supplémentaire  ={};
			var Nombre_thermostat_supplémentaire  ={};

			$('.tag_product_nombre').each(function(){
				tag_product_nombre[$(this).data('product-id')] = $(this).data('tag-id')+'__'+$(this).val();
			});
			product.each(function(){
				tag_product[$(this).data('tag-id')]=$("#product"+$(this).data('tag-id')).val();
				surface[$(this).data('tag-id')]=$("#surface"+$(this).data('tag-id')).val();
				Nombre_de_split[$(this).data('tag-id')]=$("#Nombre_de_split"+$(this).data('tag-id')).val();
				Type_de_comble[$(this).data('tag-id')]=$("#Type_de_comble"+$(this).data('tag-id')).val();
				marque[$(this).data('tag-id')]=$("#marque"+$(this).data('tag-id')).val();
				shab[$(this).data('tag-id')]=$("#shab"+$(this).data('tag-id')).val();
				Nombre_de_pièces_dans_le_logement[$(this).data('tag-id')]=$("#Nombre_de_pièces_dans_le_logement"+$(this).data('tag-id')).val();
				Type_de_radiateur[$(this).data('tag-id')]=$("#Type_de_radiateur"+$(this).data('tag-id')).val();
				Nombre_de_radiateurs_électrique[$(this).data('tag-id')]=$("#Nombre_de_radiateurs_électrique"+$(this).data('tag-id')).val();
				Nombre_de_radiateurs_combustible[$(this).data('tag-id')]=$("#Nombre_de_radiateurs_combustible"+$(this).data('tag-id')).val();
				Nombre_de_radiateur_total_dans_le_logement[$(this).data('tag-id')]=$("#Nombre_de_radiateur_total_dans_le_logement"+$(this).data('tag-id')).val();
				Thermostat_supplémentaire[$(this).data('tag-id')]=$("#Thermostat_supplémentaire"+$(this).data('tag-id')).val();
				Nombre_thermostat_supplémentaire[$(this).data('tag-id')]=$("#Nombre_thermostat_supplémentaire"+$(this).data('tag-id')).val();
			})

			if(id && (id.includes('7') || id.includes('29'))){
               $(this).attr('disabled', true);
            }
			var travaux = $('#travaux').val();
			if(id && id.length == 1 && (id[0] == 7 || id[0] == 29)){
				$("#CEEEstimatedCalculate").addClass('d-none');
				$("#CEEEstimatedWrap").removeClass('d-none');
			}else{
				$("#CEEEstimatedCalculate").removeClass('d-none');
				$("#CEEEstimatedWrap").addClass('d-none');
			}
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				url :"{{ route('lead.barame.change') }}",
				data: {id,travaux,tag_product,surface,Nombre_de_split,Type_de_comble,tag_product_nombre,marque,shab,Type_de_radiateur,Nombre_de_radiateurs_électrique,Nombre_de_radiateurs_combustible,Thermostat_supplémentaire,Nombre_thermostat_supplémentaire,Nombre_de_radiateur_total_dans_le_logement,Nombre_de_pièces_dans_le_logement},

				success: (data) => {
                    if(!id || id.includes('7') || id.includes('29')){
                        $(this).attr('disabled', false);
                        $("#bareme").html(data.bareme);
                    }
					$("#bareme").html(data.bareme);
					$("#travaux").html(data.travaux);
					$("#tag").html(data.tag);
					$("#productListBlock").html(data.product);
					$('.select2_select_option').select2();
					$('.select2_select_option').select2({
						templateSelection : function (tag, container){
							var $option = $('.select2_select_option option[value="'+tag.id+'"]');
							if ($option.attr('disabled')){
							$(container).addClass('removed-remove-btn');
							}
							return tag.text;
						},
					})
				},

			});
		});
		$('body').on('change', '#travaux',function(){
            var id = $('#bareme').val();
            var travaux = $('#travaux').val();

			var tag_product			={};
			var surface				={};
			var Nombre_de_split		={};
			var Type_de_comble		={};
			var tag_product_nombre  ={};
			var marque  			={};
			var shab  			={};
			var Nombre_de_pièces_dans_le_logement  			={};
			var Type_de_radiateur  			={};
			var Nombre_de_radiateurs_électrique  			={};
			var Nombre_de_radiateurs_combustible  			={};
			var Nombre_de_radiateur_total_dans_le_logement  			={};
			var Thermostat_supplémentaire  			={};
			var Nombre_thermostat_supplémentaire  			={};
			 var product        	= $('.tag__product');

			$('.tag_product_nombre').each(function(){
				tag_product_nombre[$(this).data('product-id')] = $(this).data('tag-id')+'__'+$(this).val();
			});
			product.each(function(){
				tag_product[$(this).data('tag-id')]=$("#product"+$(this).data('tag-id')).val();
				surface[$(this).data('tag-id')]=$("#surface"+$(this).data('tag-id')).val();
				Nombre_de_split[$(this).data('tag-id')]=$("#Nombre_de_split"+$(this).data('tag-id')).val();
				Type_de_comble[$(this).data('tag-id')]=$("#Type_de_comble"+$(this).data('tag-id')).val();
				marque[$(this).data('tag-id')]=$("#marque"+$(this).data('tag-id')).val();
				shab[$(this).data('tag-id')]=$("#shab"+$(this).data('tag-id')).val();
				Nombre_de_pièces_dans_le_logement[$(this).data('tag-id')]=$("#Nombre_de_pièces_dans_le_logement"+$(this).data('tag-id')).val();
				Type_de_radiateur[$(this).data('tag-id')]=$("#Type_de_radiateur"+$(this).data('tag-id')).val();
				Nombre_de_radiateurs_électrique[$(this).data('tag-id')]=$("#Nombre_de_radiateurs_électrique"+$(this).data('tag-id')).val();
				Nombre_de_radiateurs_combustible[$(this).data('tag-id')]=$("#Nombre_de_radiateurs_combustible"+$(this).data('tag-id')).val();
				Nombre_de_radiateur_total_dans_le_logement[$(this).data('tag-id')]=$("#Nombre_de_radiateur_total_dans_le_logement"+$(this).data('tag-id')).val();
				Thermostat_supplémentaire[$(this).data('tag-id')]=$("#Thermostat_supplémentaire"+$(this).data('tag-id')).val();
				Nombre_thermostat_supplémentaire[$(this).data('tag-id')]=$("#Nombre_thermostat_supplémentaire"+$(this).data('tag-id')).val();
			})

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				url :"{{ route('lead.travaux.change') }}",
				data: {id, travaux,tag_product,surface,Nombre_de_split,Type_de_comble,tag_product_nombre,marque,shab,Type_de_radiateur,Nombre_de_radiateurs_électrique,Nombre_de_radiateurs_combustible,Thermostat_supplémentaire,Nombre_thermostat_supplémentaire,Nombre_de_radiateur_total_dans_le_logement,Nombre_de_pièces_dans_le_logement},

				success: (data) => {

					$("#tag").html(data.tag);
					$("#productListBlock").html(data.product);
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



		$('body').on('keyup', '#Surface_habitable',function(){
            $('#hidden_Surface_habitable').val($(this).val());
        });
        $('body').on('focus', '#Surface_habitable',function(){
            $(this).attr('type', 'number');
            $(this).val($('#hidden_Surface_habitable').val());
        });
        $('body').on('blur', '#Surface_habitable',function(){
            $(this).attr('type', 'text');
            $(this).val($('#hidden_Surface_habitable').val()+' m2');
        });

		$('body').on('keyup', '#Surface_à_chauffer',function(){
            $('#hidden_Surface_à_chauffer').val($(this).val());
        });
        $('body').on('focus', '#Surface_à_chauffer',function(){
            $(this).attr('type', 'number');
            $(this).val($('#hidden_Surface_à_chauffer').val());
        });
        $('body').on('blur', '#Surface_à_chauffer',function(){
            $(this).attr('type', 'text');
            $(this).val($('#hidden_Surface_à_chauffer').val()+' m2');
        });

		$('body').on('keyup', '#Consommation_chauffage_annuel',function(){
            $('#hidden_Consommation_chauffage_annuel').val($(this).val());
        });
        $('body').on('focus', '#Consommation_chauffage_annuel',function(){
            $(this).attr('type', 'number');
            $(this).val($('#hidden_Consommation_chauffage_annuel').val());
        });
        $('body').on('blur', '#Consommation_chauffage_annuel',function(){
            $(this).attr('type', 'text');
            $(this).val($('#hidden_Consommation_chauffage_annuel').val()+' €/an');
        });

		@if ($lead->lead_label == 7)
			$('.tracking_disabled').prop('disabled', true);
			$('.tax_input_disabled').prop('disabled', true);
			$('.personal_info_disabled').prop('disabled', true);
			$('.eligibility_disabled').prop('disabled', true);
			$('.work_site_disabled').prop('disabled', true);
			$('.foyer_disabled').prop('disabled', true);
			$('.travaux_disabled').prop('disabled', true);
			$('.question_disabled').prop('disabled', true);
		@elseif ($lead->lead_label == 6)
			@if ($lead->sub_status == 50 && Auth::user()->getRoleName->category_id == 2)
			@else
				@if(!$admin__status)
					$('.tracking_disabled').prop('disabled', true);
					$('.tax_input_disabled').prop('disabled', true);
					$('.personal_info_disabled').prop('disabled', true);
					$('.eligibility_disabled').prop('disabled', true);
					$('.work_site_disabled').prop('disabled', true);
					$('.foyer_disabled').prop('disabled', true);
					$('.travaux_disabled').prop('disabled', true);
					$('.question_disabled').prop('disabled', true);
				@endif
			@endif 
		@elseif (role() != 's_admin')
            @if (!checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'edit'))
                $('.tracking_disabled').prop('disabled', true);
            @endif
            @if (!checkAction(Auth::id(), 'lead_collapse_tax_notice', 'edit'))
                $('.tax_input_disabled').prop('disabled', true);
            @endif
            @if (!checkAction(Auth::id(), 'lead_collapse_personal_information', 'edit'))
                $('.personal_info_disabled').prop('disabled', true);
            @endif
            @if (!checkAction(Auth::id(), 'lead_collapse_eligibility', 'edit'))
                $('.eligibility_disabled').prop('disabled', true);
            @endif
            @if (!checkAction(Auth::id(), 'lead_collapse_work_site', 'edit'))
                $('.work_site_disabled').prop('disabled', true);
            @endif
            @if (!checkAction(Auth::id(), 'lead_collapse_situation_foyer', 'edit'))
                $('.foyer_disabled').prop('disabled', true);
            @endif
            @if (!checkAction(Auth::id(), 'lead_collapse__project', 'edit'))
                $('.travaux_disabled').prop('disabled', true);
            @endif
            @if (!checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'edit'))
                $('.question_disabled').prop('disabled', true);
            @endif
        @endif


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
	});
</script>

@endpush
