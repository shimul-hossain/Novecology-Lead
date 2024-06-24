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
	.user-card__table tr th.user-card__table__heade{
		width: 20%;
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
</style>

@endpush

@push('plugins-link')
<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/leaflet-map/css/geocoder.css') }}">
@endpush
@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/leaflet-map/js/mapbox-gl-geocoder.min.js') }}"></script>
@endpush
{{-- Main Content Part  --}}
@section('content')
{{-- {{ Auth::user()->name }} --}}
		<!-- Banner Section -->
		<section class="banner section-gap position-relative pb-xl-0">
			<div class="container">
				<a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a>
				<div class="row justify-content-center">
					<div class="col-xl-auto">
						<div class="user-card">
							<div class="user-card__head position-relative">
								<div class="user-card__head__wrapper position-relative">
									@if ( $lead->count()>0)
											<input type="hidden" id="lead_id" name="lead_id" value="{{ $lead->id }}">
											@else
											<input type="hidden" id="lead_id" name="lead_id">
											@endif
											<input type="hidden" id="company_id" name="company_id" value="{{ $company->id }}">
											<input type="file" id="edit-image" name="image" class="d-none">
									@if($primary_tax)
										@if (checkDuplicateEntry($primary_tax))
											<div class="alert bg-danger text-white">
												<div class="alert-body"><a target="_blank" href="{{ route('lead.similar.file', $primary_tax->id) }}"><small>Attention, dossier(s) similaire(s) déja saisi(s).</small></a></div>
											</div>
										@endif
									@endif
									<h3 id="userStatus" class="user-card__title text-center text-capitalize my-4
									@if ($lead && $lead->status == 'verified')
										verified
									@endif
									">
									@if ($lead)
										{{ ucwords($lead->first_name) ." ". ucwords($lead->last_name) }}
									@endif </h3>
									<div class="table-responsive simple-bar mb-4">
										<table class="user-card__table text-white w-100">
											<tbody>
												<tr>
													<th class="user-card__table__heade position-relative">Téléphone</th>
													<td class="position-relative">
														<span id="telephone">{{ $lead->phone }} </span>
														{{-- <span id="edit-telephone-btn" class="">
															<i class="fas fa-pencil-alt" style="position: absolute; top:10px; right: 0;cursor: pointer;"></i>
														</span> --}}
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
														{{-- <span id="edit-department-btn">
															<i class="fas fa-pencil-alt" style=" cursor: pointer; position: absolute; top:10px; right: 0"></i>
														</span> --}}
														<input type="text" name="department" id="edit-department" value="{{ $lead->city }}" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none">
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Precariousness') }}</th>
													<td class="position-relative">
														<span class="precarious" style="
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
															@forelse (getLeadAssignee($lead->id) as $assigne)
																{{ $assigne->getUserName->name }}{{ $loop->last? '':', ' }}
															@empty
																{{ __('No assignee') }}
															@endforelse
														</td>
													@else
														<td id="Telecommercial">
															@forelse (getLeadAssignee($lead->id) as $assigne)
																{{ $assigne->getUserName->name }}{{ $loop->last? '':', ' }}
															@empty
																{{ __('No assignee') }}
															@endforelse
														</td>
													@endif
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">Régie</th>
													<td id="regie">
														@foreach (getLeadAssignee($lead->id) as $assigne)
															{{ $assigne->getUserName->getRegie->name?? __('No Regie') }}{{ $loop->last? '':', ' }}
														@endforeach
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Projects') }}</th>
													<td id="projectName">
														@foreach ($work->LeadBareme as $tag)
														<span class="btn btn-sm rounded" style="border:1px solid #5a616a; background-color: #ffd966">{{ $tag->tag ?? '' }}</span>
														@endforeach
														{{-- @if($work->getTag)
															{{ $work->getTag->name }}
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
										<div class="text-center lead__card__btn-wrapper" id="lead_status_change_btn">
										{{-- <button data-toggle="modal" data-target="#leftAsideModal" type="button" class="primary-btn primary-btn--pink primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
											@if ($lead && $lead->status == 'pre-validated')
											<span id="lead_status">{{ __('Pre-Validated') }}</span>

											@elseif ($lead && $lead->status == 'verified')
											<span id="lead_status">{{ __('Verified') }}</span>
											@else
											<span id="lead_status">{{ __('Current lead') }}</span>

											@endif
											<span class="novecologie-icon-chevron-right primary-btn__icon ml-2"></span>
										</button>  --}}
										</div>
										@if ($lead->user_status == 6)
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
											<button type="button" data-toggle="modal" data-target="#subStatusChangeModal" style="background-color:{{ $lead->getSubStatus ? $lead->getSubStatus->background_color : '#8e27b3' }} ; color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#fff' }}"  class="primary-btn primary-btn--lg rounded-pill align-items-center justify-content-center border-0 mt-3 
											d-inline-flex
											">
											{{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->user_status == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
											</button>
										</div>

									</div>
								</div>
							</div>
							<div class="user-card__footer bg-white pb-5">
								<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
									@if (checkAction(Auth::id(), 'lead_tab_access', 'lead-tracking') || role() == 's_admin')
									<a class="nav-link rounded-pill d-flex align-items-center justify-content-center access_permitted" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">
										<span id="lead_tracking_tab" class="mr-2"></span>
										{{ getProjectStaticTab('lead-tracking')->name }}
									</a>
									@endif
                                	@if (checkAction(Auth::id(), 'lead_tab_access', 'information-personnel') || role() == 's_admin')
									<a class="nav-link rounded-pill d-flex align-items-center justify-content-center access_permitted" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">
										<span id="personal_information_tab" class="mr-2"></span>
										{{ getProjectStaticTab('information-personnel')->name }}
									</a>
									@endif
                                	@if (checkAction(Auth::id(), 'lead_tab_access', 'information-logement') || role() == 's_admin')
									<a class="nav-link rounded-pill d-flex align-items-center justify-content-center access_permitted" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">
										<span id="logement_info_tab" class="mr-2"></span>
										Projet
									</a>
									@endif
									{{-- @if (checkAction(Auth::id(), 'lead_tab_access', 'custom_field') || role() == 's_admin')
									<a class="nav-link rounded-pill d-flex align-items-center justify-content-center access_permitted" id="v-pills-custom-field-tab" data-toggle="pill" href="#v-pills-custom-field" role="tab" aria-controls="v-pills-custom-field" aria-selected="false">
										<span class="mr-2"></span>
										{{ __('Custom Field') }}
									</a>
									@endif --}}
									{{-- <a class="nav-link rounded-pill d-flex align-items-center justify-content-center" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false">
										<span id="section_project_tab" class="mr-2 @if ($work->travaux)
											verified
										@endif"></span>
										{{ __('Section Projet') }}
									</a>  --}}
								  </div>
							</div>
						</div>
					</div>
					<div class="lead__column position-relative col-xl mt-xl-0">
						<div class="arrow-btn-group">
							<button type="button" class="arrow-btn {{ $lead->user_status == 1 ? 'active':'' }}" style="color: #5c6bc0; cursor: not-allowed;">
							  	<span class="arrow-btn__text">Non attribué</span>
							</button>
							<button type="button" @if ($lead->user_status == 6)
								@if (role() == 'manager' || role() == 's_admin')
									data-toggle="modal" data-target="#newLeadModal"
								@else
									data-toggle="tooltip" data-placement="top" title="Ce prospect est validé" 
								@endif
							@else
							data-toggle="modal" data-target="#newLeadModal"
							@endif class="arrow-btn {{ $lead->user_status == 2 ? 'active':'' }}" style="color: #42a5f5">
							  	<span class="arrow-btn__text">Nouveau</span>
							</button>
							<button type="button" @if ($lead->user_status == 6)
								@if (role() == 'manager' || role() == 's_admin')
									data-toggle="modal"  data-target="#EncLeadModal"
								@else
									data-toggle="tooltip" data-placement="top" title="Ce prospect est validé" 
								@endif
							@else
							data-toggle="modal"  data-target="#EncLeadModal"
							@endif class="arrow-btn {{ $lead->user_status == 3 ? 'active':'' }}" style="color: #26c6da">
							  	<span class="arrow-btn__text">En cours</span>
							</button>
							<button type="button" @if ($lead->user_status == 6)
								@if (role() == 'manager' || role() == 's_admin')
									data-toggle="modal" data-target="#NRPLeadModal"
								@else
									data-toggle="tooltip" data-placement="top" title="Ce prospect est validé" 
								@endif
							@else
							data-toggle="modal" data-target="#NRPLeadModal"
							@endif class="arrow-btn {{ $lead->user_status == 4 ? 'active':'' }}" style="color: #237a86">
							  	<span class="arrow-btn__text">NRP</span>
							</button>
							<button type="button"  @if ($lead->user_status == 6)
								@if (role() == 'manager' || role() == 's_admin')
									data-toggle="modal" data-target="#KOLeadModal"
								@else
									data-toggle="tooltip" data-placement="top" title="Ce prospect est validé" 
								@endif
							@else
							data-toggle="modal" data-target="#KOLeadModal"
							@endif class="arrow-btn {{ $lead->user_status == 5 ? 'active':'' }}" style="color: #5aa626">
							  	<span class="arrow-btn__text">KO</span>
							</button>
							<button type="button"  @if ($lead->user_status == 6)
								@if (role() == 'manager' || role() == 's_admin')
									data-toggle="modal" data-target="#ValidationLeadModal"
								@else
									data-toggle="tooltip" data-placement="top" title="Ce prospect est validé" 
								@endif
							@else
							data-toggle="modal" data-target="#ValidationLeadModal"
							@endif class="arrow-btn {{ $lead->user_status == 6 ? 'active':'' }}" style="color: #26a69a">
							  	<span class="arrow-btn__text">Validation</span>
							</button>
							<button type="button" class="arrow-btn {{ $lead->user_status == 7 ? 'active':'' }}" style="color: #0ecc3e; cursor: not-allowed;">
							  	<span class="arrow-btn__text"> Converti</span>
							</button>
							@if ($lead->user_status == 5)
								<div class="bg-white px-3 py-2 ml-2">
									Raisons: <button data-toggle="modal" data-target="#koTextEditModal" type="button" class="btn shadow-none p-0"><i class="bi bi-pencil"></i></button><br>
									<span class="ko_raisons">{{ $lead->comment }}</span>
								</div>
							@endif
						</div>
						<div class="d-flex flex-wrap justify-content-between align-items-center">
							<h1 class="text-white text-shadow mb-0">{{ __('New lead') }}</h1>
							<div>
								<button data-toggle="{{ $primary_tax ? 'modal':'' }}" data-target="#callBackModal" class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0" type="button">
									@if ($primary_tax && $primary_tax->callback_time && \Carbon\Carbon::parse($primary_tax->callback_time) > \Carbon\Carbon::now()->addHour())
									Rappel en cours
									@else
									Rappeler
									@endif</button>
							</div>
						</div>
						<div class="lead__wrapper py-3">
							<div  class="tab-content  shadow-none" id="v-pills-tabContent">
								@if (checkAction(Auth::id(), 'lead_tab_access', 'information-personnel') || role() == 's_admin')
								<div class="tab-pane fade" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
									<div class="accordion" id="leadAccordion">
										@if (checkAction(Auth::id(), 'lead_collapse_tax_notice', 'view') ||checkAction(Auth::id(), 'lead_collapse_tax_notice', 'edit') || role() == 's_admin')
											<div class="card lead__card border-0">
												<div class="card-header bg-transparent border-0 p-0" id="leadCard-3">
													<h2 class="mb-0">
														<div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
														<span id="tax-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
															@if($tax->count()>0)
																verified
															@endif
														"></span>
															{{ __('Tax Notice') }}
															{{-- <span class="d-block ml-auto">
																<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
															</span> --}}
															<button data-tab="Client" data-block="Avis d'impôt" data-tab-class="lead__tax__notice" type="button" data-toggle="collapse" data-target="#leadCardCollapse-3" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__tax__notice') }} position-relative ml-auto mr-1 {{ session('lead__tax__notice') == 'active' ? 'collapsed':'' }}">
																<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
																<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
															</button>
														</div>
													</h2>
												</div>
												<div id="leadCardCollapse-3" class="collapse {{ session('lead__tax__notice') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-3">
													<div class="card-body row">
														<div class="col">
															<div class="row align-items-center">
																	<div class="col-12 p-0" id="taxWrapperId">
																	@include('includes.crm.lead-tax')
																	</div>
																<div class="col-12 text-center" id="textItem">
																	<div class="lead__card__loader-wrapper d-none" id="tax__card__loader">
																		<div class="lead__card__loader">
																			<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
																				<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
																				<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
																				</path>
																			</svg>
																		</div>
																	</div>
																	@if (checkAction(Auth::id(), 'lead_collapse_tax_notice', 'edit') || role() == 's_admin')
																		<div class="text-center lead__card__btn-wrapper" id="tax__card__btn">
																			<button type="button" id="taxValidate" data-toggle="false" aria-expanded="false" aria-controls="leadCardCollapse-4" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 tax_input_disabled">
																				{{ __('Verify') }}
																			</button>
																			{{-- <button type="button" id="customTaxValidate" data-toggle="false" aria-expanded="false" aria-controls="leadCardCollapse-4" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																				{{ __('Validate') }}
																			</button> --}}
																		</div>
																	@else
																	<div class="text-center">
																		<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																			<span class="novecologie-icon-lock py-1"></span>
																		</button>
																	</div>
																	@endif
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										@endif
										@if (checkAction(Auth::id(), 'lead_collapse_personal_information', 'view') ||checkAction(Auth::id(), 'lead_collapse_personal_information', 'edit') || role() == 's_admin')
											<div class="card lead__card border-0">
												<div class="card-header bg-transparent border-0 p-0" id="leadCard-4">
													<h2 class="mb-0">
													<div id="personal_info_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
														<span id="info-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
														verified "></span>
														{{ __('Personal informations') }}
														{{-- <div role="button" class="edit-toggler info_edit_toggler position-relative ml-auto mr-1">
															<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
															<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
														</div> --}}
														{{-- <span class="d-block ml-auto">
															<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>


														</span> --}}
														<button data-tab="Client" data-block="Informations personnelles" data-tab-class="lead__personal__info" type="button" data-toggle="collapse" data-target="#leadCardCollapse-4" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__personal__info') }} position-relative ml-auto mr-1 {{ session('lead__personal__info') == 'active' ? 'collapsed':'' }}">
															<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
															<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
														</button>
													</div>
													</h2>
												</div>
												<div id="leadCardCollapse-4" class="collapse {{ session('lead__personal__info') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-4">
													@include('includes.crm.personal_info', ['type' => 'lead_collapse_personal_information'])
												</div>
											</div>
										@endif
										@if (checkAction(Auth::id(), 'lead_collapse_eligibility', 'view') ||checkAction(Auth::id(), 'lead_collapse_eligibility', 'edit') || role() == 's_admin')
											<div class="card lead__card border-0">
												<div class="card-header bg-transparent border-0 p-0" id="leadCard-5">
												<h2 class="mb-0">
													<div id="eligibility_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
													<span id="work-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4

													verified "></span>
													Éligibilité
													{{-- <div role="button" class="edit-toggler eligibility_edit_toggler position-relative ml-auto mr-1">
														<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
														<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
													</div> --}}
													{{-- <span class="d-block ml-auto">
														<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
													</span> --}}
													<button data-tab="Client" data-block="Eligibility" data-tab-class="lead__eligibility__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-5" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__eligibility__part') }} position-relative ml-auto mr-1 {{ session('lead__eligibility__part') == 'active' ? 'collapsed':'' }}">
														<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
														<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
													</button>
													</div>
												</h2>
												</div>
												<div id="leadCardCollapse-5" class="collapse {{ session('lead__eligibility__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-5">
													<div class="card-body row">
														<div class="col custom-space">
															<div class="row collapseRow"  style="display: {{ $collapse_status ? '':'none' }}">
																{{-- <div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="heatingType">{{ __('Type of heating') }} <span class="text-danger">*</span></label>
																		<select name="heatingType" id="heatingType" class="custom-select shadow-none form-control eligibility_disabled" >
																			<option value="">{{ __('Select') }}</option>
																			<option @if ($lead->heating_type =='Fioul') selected @endif value="Fioul">{{ __('Fioul') }}</option>
																			<option @if ($lead->heating_type =='Gaz') selected @endif value="Gaz">{{ __('Gaz') }}</option>
																			<option @if ($lead->heating_type =='Mazout') selected @endif value="Mazout">{{ __('Mazout') }}</option>
																			<option @if ($lead->heating_type =='Electricité') selected @endif value="Electricité">{{ __('Electricité') }}</option>
																			<option @if ($lead->heating_type =='Bois') selected @endif value="Bois">{{ __('Bois') }}</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="natureOccupation">{{ __('Occupation') }} <span class="text-danger">*</span></label>
																			<select  name="natureOccupation" id="natureOccupation" class="custom-select shadow-none form-control eligibility_disabled" required>
																			<option value="">{{ __('Select') }}</option>
																			<option @if ($lead->nature_occupation =='Proprietaire occupant') selected @endif value="Proprietaire occupant">{{ __('Proprietaire occupant') }}</option>
																			<option @if ($lead->nature_occupation =='Proprietaire Bailleur') selected @endif value="Proprietaire Bailleur">{{ __('Proprietaire Bailleur') }}</option>
																			<option @if ($lead->nature_occupation =='Locataire') selected @endif value="Locataire">{{ __('Locataire') }}</option>
																			</select>
																	</div>
																</div> --}}
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="occupation_type">Type occupation <span class="text-danger">*</span></label>
																		<select name="" id="occupation_type" class="custom-select shadow-none form-control eligibility_disabled">
																			<option value="">{{ __('Select') }}</option>
																			<option @if ($lead->occupation_type =='Indivision') selected @endif value="Indivision">{{ __('Indivision') }}</option>
																			<option @if ($lead->occupation_type =='SCI') selected @endif value="SCI">{{ __('SCI') }}</option>
																			<option @if ($lead->occupation_type =='Pleine propriété') selected @endif value="Pleine propriété">{{ __('Pleine propriété') }}</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="cadstrablePlot">Parcelle cadastrale </label>
																		<input type="text" name="cadstrablePlot" id="cadstrablePlot" class="form-control shadow-none eligibility_disabled"
																		value="{{ $lead->cadstrable_plot }}">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="fiscal_amount">Revenue Fiscale de Référence</label>
																		<div class="d-flex align-item-center justify-content-end">
																		<input type="number" readonly name="fiscal_amount" id="fiscal_amount" class="form-control shadow-none eligibility_disabled"
																		value="{{ $lead->fiscal_amount }}">
																			<button type="button" data-input-id="fiscal_amount" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
																			@if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
																				eligibility_lock_button
																			@endif
																			 ">
																				<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
																				<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
																			</button>
																		</div>
																	</div>
																</div>
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="form-label" for="foyer">Nombre de foyer</label>
																			<div class="d-flex align-item-center justify-content-end">
																				<input type="number" readonly name="foyer" id="foyer" class="form-control shadow-none eligibility_disabled"
																				value="{{ $lead->foyer ?? $tax->count() }}">
																				<button type="button" data-input-id="foyer" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
																				@if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
																					eligibility_lock_button
																				@endif
																				">
																					<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
																					<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
																				</button>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-6">
																		<div class="form-group">
																			<label class="form-label" for="family_person">Nombre de personnes</label>
																			<div class="d-flex align-item-center justify-content-end">
																				<input type="number" readonly name="family_person"  id="family_person" class="form-control shadow-none eligibility_disabled"
																			value="{{ $lead->family_person }}">
																				<button type="button" data-input-id="family_person" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
																				@if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
																					eligibility_lock_button
																				@endif
																				 ">
																					<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
																					<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
																				</button>
																			</div>
																		</div>
																	</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="house_over_15_years">Age du bâtiment <span class="text-danger">*</span></label>
																		<select name="house_over_15_years" id="house_over_15_years"  class="custom-select shadow-none form-control eligibility_disabled">
																			<option value="">{{ __('Select') }}</option>
																			<option @if ($lead->house_over_15_years =='Oui') selected @endif value="Oui">{{ __('Plus de 15 ans') }}</option>
																			<option @if ($lead->house_over_15_years =='Non') selected @endif value="Non">{{ __('Moins de 15 ans') }}</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="zone">{{ __('Zone') }}</label>
																		<div class="d-flex align-item-center justify-content-end">
																			<input type="text" name="zone" readonly id="zone_data"  class="form-control shadow-none eligibility_disabled"
																		value="{{ $lead->zone }}">
																			<button type="button" data-input-id="zone_data" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
																			@if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
																				eligibility_lock_button
																			@endif
																			 ">
																				<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
																				<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
																			</button>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="form-label" for="precariousness">Éligibilité MaPrimeRenov</label>

																		<div class="dropdown">
																			<input class="dropdown_custom-select" type="hidden" name="precariousness" id="precariousness"
																			value="@if ($lead->precariousness == 'Classique')
																					Classique
																				@elseif($lead->precariousness == 'Intermediaire')
																					Intermediaire
																				@elseif($lead->precariousness == 'Precaire')
																					Precaire
																				@elseif($lead->precariousness == 'Grand Precaire')
																					Grand Precaire
																				@endif">
																			<button id="precariousnessDropdownToggle" class="custom-select shadow-none form-control text-left dropdown-toggle
																				@if ($lead->precariousness == 'Classique')
																					Classique-option
																				@elseif($lead->precariousness == 'Intermediaire')
																					Intermediaire-option
																				@elseif($lead->precariousness == 'Precaire')
																					Precaire-option
																				@elseif($lead->precariousness == 'Grand Precaire')
																					Grand_Precaire-option
																				@endif" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

																				@if ($lead->precariousness == 'Classique')
																					Classique
																				@elseif($lead->precariousness == 'Intermediaire')
																					Intermediaire
																				@elseif($lead->precariousness == 'Precaire')
																					Precaire
																				@elseif($lead->precariousness == 'Grand Precaire')
																					Grand Precaire
																				@endif

																			</button>
																			{{-- <div class="dropdown-menu py-0 w-100">
																			<button type="button" class="dropdown-item Classique-option" data-class="Classique-option" data-value="Classique">Classique</button>
																			<button type="button" class="dropdown-item Intermediaire-option" data-class="Intermediaire-option" data-value="Intermediaire">Intermediaire</button>
																			<button type="button" class="dropdown-item Precaire-option" data-class="Precaire-option" data-value="Precaire">Precaire</button>
																			<button type="button" class="dropdown-item Grand_Precaire-option" data-class="Grand_Precaire-option" data-value="Grand Precaire">Grand Precaire</button>
																			</div> --}}
																		</div>
																	</div>
																</div>
																@if (checkAction(Auth::id(), 'lead_collapse_eligibility', 'edit') || role() == 's_admin')
																	<div class="col-12 text-center ">
																		<button id="workValidate"
																		type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 eligibility_disabled">
																			{{ __('Submit') }}
																		</button>
																	</div>
																@else
																	<div class="col-12 text-center mb-3">
																		<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																			<span class="novecologie-icon-lock py-1"></span>
																		</button>
																	</div>
																@endif
															</div>
														</div>
													</div>
												</div>
											</div>
										@endif
										@if (checkAction(Auth::id(), 'lead_collapse_work_site', 'view') ||checkAction(Auth::id(), 'lead_collapse_work_site', 'edit') || role() == 's_admin')
											<div class="card lead__card border-0">
												<div class="card-header bg-transparent border-0 p-0" id="leadCard-6">
												<h2 class="mb-0">
													<div id="work_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
													<span id="present-work-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
													verified"></span>
													Information logement
														{{-- <div role="button" class="edit-toggler work_edit_toggler position-relative ml-auto mr-1">
															<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
															<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
														</div> --}}
														{{-- <span class="d-block ml-auto">
															<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
														</span> --}}
														<button data-tab="Client" data-block="Chantier de travail" data-tab-class="lead__work_type__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-6" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__work_type__part') }} position-relative ml-auto mr-1 {{ session('lead__work_type__part') == 'active' ? 'collapsed':'' }}">
															<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
															<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
														</button>
													</div>
												</h2>
												</div>
												<div id="leadCardCollapse-6" class="collapse {{ session('lead__work_type__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-6">
												<div class="card-body row">
													<div class="col custom-space">
														<div class="row collapseRow" style="display: {{ $collapse_status ? '':'none' }}">

															<div class="col-md-12">
																<div class="form-group">
																	<label class="form-label" for="heating_type"> Mode de chauffage </label>

																	<select id="heating_type" data-autre-box="heating__type" data-input-type="select" data-select-type="single" class="select2_select_option form-control w-100 other_field__system work_site_disabled">
																		<option value="" selected disabled>{{ __('Select') }}</option>
																		@foreach ($heatings as $heating)
																			<option {{ $lead->heating_type == $heating->name ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
																		@endforeach
																	</select>
																</div>
															</div>
															<div class="col-12 heating__type" style="display: {{ $lead->heating_type == 'Autre' ? '':'none' }}">
																<div class="form-group">
																	<label class="form-label" for="Merci_de_précisez">Merci de précisez</label>
																	<input type="text" name="Merci_de_précisez" id="Merci_de_précisez" class="form-control shadow-none work_site_disabled"
																	value="{{ $second_leads->Merci_de_précisez }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="date_fo_construction">Date construction maison <span class="text-danger">*</span></label>
																	<select name="date_fo_construction" class="select2_select_option form-control w-100 work_site_disabled"  id="date_fo_construction">
																		<option value="" selected disabled>{{ __('Select') }}</option>
																		@for ($i = \Carbon\Carbon::now()->subYear()->format('Y'); $i >= 1000; $i--)
																		@if ($lead->date_fo_construction)
																			@if ($i == $lead->date_fo_construction)
																			<option selected value="{{ $i }}">{{ $i }}</option>
																			@else
																			<option value="{{ $i }}">{{ $i }}</option>
																			@endif
																		@else
																			<option value="{{ $i }}">{{ $i }}</option>
																		@endif
																		@endfor
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="living_area"> Surface habitable <span class="text-danger">*</span></label>
																	<input type="hidden" id="hidden_living_area" value="{{ $lead->living_space }}">
																	<input type="text" step="any" name="living_area" id="living_area" class="form-control shadow-none work_site_disabled"
																	value="{{ $lead->living_space }} m2">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="Surface_à_chauffer">Surface à chauffer </label>
																	<input type="hidden" id="hidden_Surface_à_chauffer" value="{{ $second_leads->Surface_à_chauffer ?? '' }}">
																	<input type="text" step="any" name="Surface_à_chauffer" id="Surface_à_chauffer" class="form-control shadow-none work_site_disabled"
																	value="{{ $second_leads->Surface_à_chauffer }} m2">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="annual_heating"> Consommation chauffage annuel (€)<span class="text-danger">*</span></label>
																	<input type="hidden" id="hidden_annual_heating" value="{{ $second_leads->annual_heating ?? '' }}">
																	<input type="text" name="annual_heating" id="annual_heating" class="form-control shadow-none work_site_disabled"
																	value="{{ $second_leads->annual_heating }} €/an">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="annual_heating2">Consommation Chauffage Annuel (litres,kWh,m3)</label>
																	<input type="text" name="annual_heating2" id="annual_heating2" class="form-control shadow-none work_site_disabled"
																	value="{{ $second_leads->annual_heating2 }}">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="with_basement">Depuis quand occupez vous le logement </label>
																	<select  name="with_basement" id="with_basement" class="select2_select_option form-control w-100 work_site_disabled">
																		<option value="" selected disabled>{{ __('Select') }}</option>
																		<option {{ $second_leads->with_basement == '0-5 ans' ? 'selected':'' }} value="0-5 ans">0-5 ans</option>
																		<option {{ $second_leads->with_basement == '5-10 ans' ? 'selected':'' }} value="5-10 ans">5-10 ans</option>
																		<option {{ $second_leads->with_basement == '10-20 ans' ? 'selected':'' }} value="10-20 ans">10-20 ans</option>
																		<option {{ $second_leads->with_basement == '+ 20 ans' ? 'selected':'' }} value="+ 20 ans">+ 20 ans</option>
																	</select>
																</div>
															</div>

															<div class="col-12">
																<div class="form-group">
																	<label class="form-label" for="Type_du_courant_du_logement">Type du courant du logement</label>
																	<select  name="Type_du_courant_du_logement" id="Type_du_courant_du_logement" class="select2_select_option form-control w-100 work_site_disabled">
																		<option value="" selected disabled>{{ __('Select') }}</option>
																		<option {{ $second_leads->Type_du_courant_du_logement == 'Monophasé' ? 'selected':'' }} value="Monophasé">Monophasé</option>
																		<option {{ $second_leads->Type_du_courant_du_logement == 'Triphasé' ? 'selected':'' }} value="Triphasé">Triphasé</option> 
																	</select>
																</div>
															</div>
															
															<div class="col-12 mt-3 d-flex align-items-center">
																<h4 class="mb-0 mr-2">Le logement possède t - il un chauffage d’appoint ?  <span class="text-danger">*</span></h4>
																<label class="switch-checkbox">
																	<input type="checkbox" class="switch-checkbox__input work_site_disabled"
																	{{ ($second_leads->supplementary == 'yes') ? 'checked':'' }}
																	id="supplementaryInput">
																	<span class="switch-checkbox__label"></span>
																</label>
															</div>

															<div class="col-12 mt-3" style="display:{{ ($second_leads->supplementary == 'yes') ? '':'none' }}" id="supplementary">
																<div class="row">
																	<div class="col-md-12">
																		<div class="row">
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Insert à bois" class="custom-control-input work_site_disabled" id="specify_heating1"
																						@if ($second_leads && getFeature($second_leads->specify_heating, 'Insert à bois'))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating1">Insert à bois</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Poêle à bois" class="custom-control-input work_site_disabled" id="specify_heating2"
																						@if ($second_leads && getFeature($second_leads->specify_heating, 'Poêle à bois'))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating2">Poêle à bois</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Poêle à gaz" class="custom-control-input work_site_disabled" id="specify_heating3"
																						@if ($second_leads && getFeature($second_leads->specify_heating, 'Poêle à gaz'))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating3">Poêle à gaz</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Convecteur électrique" class="custom-control-input work_site_disabled" id="specify_heating4"
																						@if ($second_leads && getFeature($second_leads->specify_heating, 'Convecteur électrique'))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating4">Convecteur électrique</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Sèche-serviette" class="custom-control-input work_site_disabled" id="specify_heating5"
																						@if ($second_leads && getFeature($second_leads->specify_heating, 'Sèche-serviette'))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating5">Sèche-serviette</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Panneau rayonnant" class="custom-control-input work_site_disabled" id="specify_heating6"
																						@if ($second_leads && getFeature($second_leads->specify_heating, 'Panneau rayonnant'))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating6">Panneau rayonnant</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Radiateur bain d'huile" class="custom-control-input work_site_disabled" id="specify_heating7"
																						@if ($second_leads && getFeature($second_leads->specify_heating, "Radiateur bain d'huile"))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating7">Radiateur bain d'huile</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" name="specify_heating[]" value="Radiateur soufflant électrique" class="custom-control-input work_site_disabled" id="specify_heating8"
																						@if ($second_leads && getFeature($second_leads->specify_heating, "Radiateur soufflant électrique"))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating8">Radiateur soufflant électrique</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-12">
																				<div class="form-group">
																					<div class="custom-control custom-checkbox">
																						<input type="checkbox" data-autre-box="specify__heating" name="specify_heating[]" value="Autre" class="custom-control-input other_field__system work_site_disabled" id="specify_heating9"
																						@if ($second_leads && getFeature($second_leads->specify_heating, "Autre"))
																						checked
																						@endif >
																						<label class="custom-control-label" for="specify_heating9">Autre</label>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12 specify__heating" style="display: {{ ($second_leads && getFeature($second_leads->specify_heating, "Autre")) ? '':'none' }}">
																		<div class="form-group">
																			<label class="form-label" for="other_heating"> Merci de préciser </label>
																			<input type="text" name="other_heating" id="other_heating" class="form-control shadow-none work_site_disabled"
																			value="{{ $second_leads->other_heating }}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-12 mt-3 d-flex align-items-center">
																<h4 class="mb-0 mr-2"> La maison possède-t-elle un second générateur de chauffage : <span class="text-danger">*</span></h4>
																<label class="switch-checkbox">
																	<input type="checkbox" class="switch-checkbox__input work_site_disabled" id="heatingGeneratorInput"
																	{{ $second_leads->heating_generator == 'yes' ? 'checked':'' }}>
																	<span class="switch-checkbox__label"></span>
																</label>
															</div>
															<div class="col-12 mt-3" style="display:{{ ($second_leads->heating_generator == 'yes') ? '':'none' }}" id="heatingGenerator">
																<div class="row">
																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="second_heating_type[]" value="Chaudière fioul" class="custom-control-input work_site_disabled" id="second_heating_type"

																				@if (getFeature($lead->second_heating_type, 'Chaudière fioul'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="second_heating_type">Chaudière fioul</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="second_heating_type[]" value="Chaudière bois" class="custom-control-input work_site_disabled" id="second_heating_type2"

																				@if (getFeature($lead->second_heating_type, 'Chaudière bois'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="second_heating_type2"> Chaudière bois</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="second_heating_type[]" value="Chaudière gaz" class="custom-control-input work_site_disabled" id="second_heating_type3"

																				@if (getFeature($lead->second_heating_type, 'Chaudière gaz'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="second_heating_type3">Chaudière gaz</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="second_heating_type[]" value="Chaudière mazoute" class="custom-control-input work_site_disabled" id="second_heating_type4"

																				@if (getFeature($lead->second_heating_type, 'Chaudière mazoute'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="second_heating_type4">Chaudière mazoute</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="second_heating_type[]" value="Pompe à chaleur" class="custom-control-input work_site_disabled" id="second_heating_typed4"

																				@if (getFeature($lead->second_heating_type, 'Pompe à chaleur'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="second_heating_typed4">Pompe à chaleur</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="second_heating_type[]" data-autre-box="second_heating__type" value="Autre" class="custom-control-input other_field__system work_site_disabled" id="second_heating_type5"

																				@if (getFeature($lead->second_heating_type, 'Autre'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="second_heating_type5"> {{ __('Autre') }}</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12 second_heating__type" style="display: {{ (getFeature($lead->second_heating_type, 'Autre')) ? '':'none' }}">
																		<div class="form-group">
																			<label class="form-label" for="other_second_heating_type">Merci de préciser</label>
																			<input type="text" name="other_second_heating_type" id="other_second_heating_type" class="form-control shadow-none work_site_disabled"
																			value="{{ $lead->other_second_heating_type }}">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-12 mt-3">
																<div class="row">
																	<div class="col-12">
																		<h4>
																			Quels sont les différents émetteurs de chaleur du logement  <span class="text-danger">*</span>
																		</h4>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="transmitter_type[]" value="Radiateurs" data-autre-box="transmitter__type__Radiateurs"  class="custom-control-input other_field__system work_site_disabled" id="transmitter_type2"

																				@if (getFeature($lead->transmitter_type, 'Radiateurs'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="transmitter_type2">Radiateurs</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="transmitter_type[]" value="Plancher Chauffant" class="custom-control-input work_site_disabled" id="transmitter_type"

																				@if (getFeature($lead->transmitter_type,'Plancher Chauffant'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="transmitter_type">Plancher Chauffant</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" name="transmitter_type[]" value="Ventilo-Convecteur" class="custom-control-input work_site_disabled" id="transmitter_type3"

																				@if (getFeature($lead->transmitter_type, 'Ventilo-Convecteur'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="transmitter_type3">Ventilo-Convecteur</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-12">
																		<div class="form-group">
																			<div class="custom-control custom-checkbox">
																				<input type="checkbox" data-autre-box="transmitter__type" name="transmitter_type[]" value="Autre" class="custom-control-input other_field__system work_site_disabled" id="transmitter_type4"
																				@if (getFeature($lead->transmitter_type, 'Autre'))
																				checked
																				@endif >
																				<label class="custom-control-label" for="transmitter_type4">Autre</label>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12 transmitter__type" style="display: {{ (getFeature($lead->transmitter_type, 'Autre')) ? '':'none' }}">
																		<div class="form-group">
																			<label class="form-label" for="autre_field__transmitter_type">Merci de préciser</label>
																			<input type="text" name="autre_field__transmitter_type" id="autre_field__transmitter_type" class="form-control shadow-none work_site_disabled"
																			value="{{ $second_leads->autre_field__transmitter_type }}">
																		</div>
																	</div>
																</div>
																<div class="row transmitter__type__Radiateurs" style="display: {{ getFeature($lead->transmitter_type, 'Radiateurs') ? '':'none' }}">
																	<div class="col-12">
																		<h4>
																			Préciser le type de radiateurs
																		</h4>
																	</div>
																	<div class="col-12">
																		<div class="row">
																			<div class="col-md-4">
																				<div class="form-group d-flex">
																					<div class="custom-control custom-switch ml-1">
																						<input type="checkbox" {{ $second_leads->radiatuers_Aluminium == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Aluminium" value="yes" class="custom-control-input other_field__system" id="radiatuers_Aluminium">
																						<label class="custom-control-label" for="radiatuers_Aluminium">Aluminium</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-8 radiatuers__Aluminium" style="display: {{ $second_leads->radiatuers_Aluminium == 'yes' ? '':'none' }}">
																				<div class="form-group d-flex align-items-center">
																					<label class="form-label mb-0 no-wrap mr-2" for="radiatuers_Aluminium_Nombre">Nombre de radiateurs:</label>
																					<input type="text" name="radiatuers_Aluminium_Nombre" id="radiatuers_Aluminium_Nombre" class="form-control shadow-none work_site_disabled"
																					value="{{ $second_leads->radiatuers_Aluminium_Nombre }}">
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-4">
																				<div class="form-group d-flex">
																					<div class="custom-control custom-switch ml-1">
																						<input type="checkbox" {{ $second_leads->radiatuers_Fonte == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Fonte" value="yes" class="custom-control-input other_field__system" id="radiatuers_Fonte">
																						<label class="custom-control-label" for="radiatuers_Fonte">Fonte</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-8 radiatuers__Fonte" style="display: {{ $second_leads->radiatuers_Fonte == 'yes' ? '':'none' }}">
																				<div class="form-group d-flex align-items-center">
																					<label class="form-label  mb-0 no-wrap mr-2" for="radiatuers_Fonte_Nombre">Nombre de radiateurs:</label>
																					<input type="text" name="radiatuers_Fonte_Nombre" id="radiatuers_Fonte_Nombre" class="form-control shadow-none work_site_disabled"
																					value="{{ $second_leads->radiatuers_Fonte_Nombre }}">
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-4">
																				<div class="form-group d-flex">
																					<div class="custom-control custom-switch ml-1">
																						<input type="checkbox" {{ $second_leads->radiatuers_Acier == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Acier" value="yes" class="custom-control-input other_field__system" id="radiatuers_Acier">
																						<label class="custom-control-label" for="radiatuers_Acier">Acier</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-8 radiatuers__Acier" style="display: {{ $second_leads->radiatuers_Acier == 'yes' ? '':'none' }}">
																				<div class="form-group d-flex align-items-center">
																					<label class="form-label mb-0 no-wrap mr-2" for="radiatuers_Acier_Nombre">Nombre de radiateurs:</label>
																					<input type="text" name="radiatuers_Acier_Nombre" id="radiatuers_Acier_Nombre" class="form-control shadow-none work_site_disabled"
																					value="{{ $second_leads->radiatuers_Acier_Nombre }}">
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-md-4">
																				<div class="form-group d-flex">
																					<div class="custom-control custom-switch ml-1">
																						<input type="checkbox" {{ $second_leads->radiatuers_Autre == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Autre" value="yes" class="custom-control-input other_field__system" id="radiatuers_Autre">
																						<label class="custom-control-label" for="radiatuers_Autre">Autre</label>
																					</div>
																				</div>
																			</div>
																			<div class="col-md-8 radiatuers__Autre" style="display: {{ $second_leads->radiatuers_Autre == 'yes' ? '':'none' }}">
																				<div class="form-group d-flex align-items-center">
																					<label class="form-label mb-0 no-wrap mr-2" for="radiatuers_Autre_Nombre">Nombre de radiateurs:</label>
																					<input type="text" name="radiatuers_Autre_Nombre" id="radiatuers_Autre_Nombre" class="form-control shadow-none work_site_disabled"
																					value="{{ $second_leads->radiatuers_Autre_Nombre }}">
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12 radiatuers__Autre" style="display: {{ $second_leads->radiatuers_Autre == 'yes' ? '':'none' }}">
																		<div class="form-group">
																			<label class="form-label" for="autre_field__radiatuers">Merci de préciser</label>
																			<input type="text" name="autre_field__radiatuers" id="autre_field__radiatuers" class="form-control shadow-none work_site_disabled"
																			value="{{ $second_leads->autre_field__radiatuers }}">
																		</div>
																	</div>
																</div>

															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label class="form-label" for=""> Production d’eau chaude sanitaire <span class="text-danger">*</span></label>
																	<select name="" id="hot_water_production" class="custom-select shadow-none form-control work_site_disabled">
																		<option value="">{{ __('Select') }}</option>
																		<option @if($lead->hot_water_production== 'Instantanné') selected @endif value="Instantanné">{{ __('Instantanné') }}</option>
																		<option @if($lead->hot_water_production== 'Accumulation') selected @endif value="Accumulation">{{ __('Accumulation') }}</option>
																	</select>
																</div>
															</div>
															<div class="col-md-12" id="instant" style="display: {{ $lead->hot_water_production == 'Instantanné' ? '':'none' }}">
																<div class="row">
																	<div class="col-12">
																		<h4>
																			{{ __('Instantanné') }} <span class="text-danger">*</span>
																		</h4>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Générateur de chauffage" class="custom-control-input work_site_disabled" id="hot_water_feature"

																			@if (getFeature($lead->hot_water_feature, 'Générateur de chauffage'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature">Générateur de chauffage</label>
																		</div>
																	</div>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Chauffe-eau gaz" class="custom-control-input work_site_disabled" id="hot_water_feature2"

																			@if (getFeature($lead->hot_water_feature, 'Chauffe-eau gaz'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature2">Chauffe-eau gaz</label>
																		</div>
																	</div>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Chauffe-eau électrique" class="custom-control-input work_site_disabled" id="hot_water_feature3"

																			@if (getFeature($lead->hot_water_feature, 'Chauffe-eau électrique'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature3">Chauffe-eau électrique</label>
																		</div>
																	</div>
																	</div>
																</div>
															</div>
															<div class="col-md-12" id="accumulation" style="display: {{ $lead->hot_water_production == 'Accumulation' ? '':'none' }}">
																<div class="row">
																	<div class="col-12">
																		<h4>
																			{{ __('Accumulation') }} <span class="text-danger">*</span>
																		</h4>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Générateur de chauffage" class="custom-control-input work_site_disabled" id="hot_water_feature4"

																			@if (getFeature($lead->hot_water_feature, 'Générateur de chauffage'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature4">Générateur de chauffage</label>
																		</div>
																	</div>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Chauffe-eau gaz" class="custom-control-input work_site_disabled" id="hot_water_feature5"

																			@if (getFeature($lead->hot_water_feature, 'Chauffe-eau gaz'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature5">Chauffe-eau gaz</label>
																		</div>
																	</div>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Chauffe-eau électrique" class="custom-control-input work_site_disabled" id="hot_water_feature6"

																			@if (getFeature($lead->hot_water_feature, 'Chauffe-eau électrique'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature6">Chauffe-eau électrique</label>
																		</div>
																	</div>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Chauffe-eau thermodynamique" class="custom-control-input work_site_disabled" id="hot_water_feature7"

																			@if (getFeature($lead->hot_water_feature, 'Chauffe-eau thermodynamique'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature7">Chauffe-eau thermodynamique</label>
																		</div>
																	</div>
																	</div>
																	<div class="col-12">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="hot_water_feature[]" value="Chauffe-eau electrosolaire" class="custom-control-input work_site_disabled" id="hot_water_feature8"

																			@if (getFeature($lead->hot_water_feature, 'Chauffe-eau electrosolaire'))
																			checked
																			@endif >
																			<label class="custom-control-label" for="hot_water_feature8">Chauffe-eau electrosolaire</label>
																		</div>
																	</div>
																	</div>
																</div>
															</div>
															<div class="col-12 d-flex align-items-center">
																<h4 class="mb-0 mr-2">Le logement possède t- il un ballon d’eau chaude ?</h4>
																<label class="switch-checkbox">
																	<input type="checkbox" id="le_logement" data-autre-box="le__logement" class="switch-checkbox__input other_field__system work_site_disabled"
																	{{ ($second_leads->le_logement == 'yes') ? 'checked':'' }} >
																	<span class="switch-checkbox__label"></span>
																</label>
															</div>
															<div class="col-md-12 mt-3 le__logement" style="display: {{ ($second_leads->le_logement == 'yes') ? '':'none' }}">
																<div class="form-group">
																	<label class="form-label" for="volume"> Précisez le volume du ballon d’eau chaude :</label>
																	<input type="number" step="any" name="volume" id="volume" class="form-control shadow-none work_site_disabled" placeholder="Merci de préciser le litrage du ballon"
																	value="{{ $lead->volume }}">
																</div>
															</div>

															<div class="col-md-12 mt-3">
																<div class="form-group">
																	<label class="form-label" for="volume"> Observations </label>
																	<textarea name="ovservations" id="ovservations" class="form-control shadow-none work_site_disabled">{{ $second_leads->ovservations }}</textarea>
																</div>
															</div>
															@if (checkAction(Auth::id(), 'lead_collapse_work_site', 'edit') || role() == 's_admin')
																<div class="col-12 text-center ">
																	<button id="presentWorkValidate"
																	type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 work_site_disabled">
																		{{ __('Submit') }}
																	</button>
																</div>
															@else
																<div class="col-12 text-center">
																	<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																		<span class="novecologie-icon-lock py-1"></span>
																	</button>
																</div>
															@endif
														</div>
													</div>
												</div>
												</div>
											</div>
										@endif
										@if (checkAction(Auth::id(), 'lead_collapse_situation_foyer', 'view') ||checkAction(Auth::id(), 'lead_collapse_situation_foyer', 'edit') || role() == 's_admin')
											<div class="card lead__card border-0">
												<div class="card-header bg-transparent border-0 p-0" id="leadCard-7">
												<h2 class="mb-0">
													<div id="foyer_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
													<span id="situation_foyer" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
													"></span>
													{{ __('Situation foyer') }}
														{{-- <span class="d-block ml-auto">
															<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
														</span> --}}
														<button data-tab="Client" data-block="Situation foyer" data-tab-class="lead__situation_foyer__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-7" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__situation_foyer__part') }} position-relative ml-auto mr-1 {{ session('lead__situation_foyer__part') == 'active' ? 'collapsed':'' }}">
															<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
															<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
														</button>
													</div>
												</h2>
												</div>
												<div id="leadCardCollapse-7" class="collapse {{ session('lead__situation_foyer__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-7">
												<div class="card-body row">
													<div class="col custom-space">
														<div class="row collapseRow"  style="display: {{ $collapse_status ? '':'none' }}">

															<div class="col-12">
																<div class="form-group">
																	<label class="form-label" for="family_situation"> Situation familiale <span class="text-danger">*</span></label>
																	<select name="family_situation"  id="family_situation" data-input-type="select" data-autre-box="family__situation" data-select-type="single" class="form-control other_field__system shadow-none foyer_disabled">
																		<option value="">{{ __('Select') }}</option>
																		<option @if ($lead->family_situation == 'Marié')
																			selected
																		@endif value="Marié">Marié</option>
																		<option @if ($lead->family_situation == 'Pacsé')
																			selected
																		@endif value="Pacsé">Pacsé</option>
																		<option @if ($lead->family_situation == 'Concubinage')
																			selected
																		@endif value="Concubinage">Concubinage</option>
																		<option @if ($lead->family_situation == 'Divorcé')
																			selected
																		@endif value="Divorcé">Divorcé</option>
																		<option @if ($lead->family_situation == 'Séparé')
																			selected
																		@endif value="Séparé">Séparé</option>
																		<option @if ($lead->family_situation == 'Célibataire')
																			selected
																		@endif value="Célibataire">Célibataire</option>
																		<option @if ($lead->family_situation == 'Veuf')
																			selected
																		@endif value="Veuf">Veuf</option>
																		<option @if ($lead->family_situation == 'Autre')
																			selected
																		@endif value="Autre">Autre</option>
																	</select>
																</div>
															</div>
															<div class="col-md-12 family__situation" style="display: {{ $lead->family_situation == 'Autre' ? '':'none' }}">
																<div class="form-group">
																	<label class="form-label" for="autre_field__family_situation"> Merci de préciser </label>
																	<input type="text" name="autre_field__family_situation" id="autre_field__family_situation" class="form-control shadow-none work_site_disabled"
																	value="{{ $second_leads->autre_field__family_situation }}">
																</div>
															</div>
															<div class="col-12">
																<div class="d-flex align-items-center">
																	<h4 class="mb-0 mr-2">Y a t il des enfants dans le foyer fiscale ? </h4> 
																	<label class="switch-checkbox">
																		<input id="children__status" type="checkbox" {{ $second_leads->children__status == 'yes' ? 'checked':'' }} class="switch-checkbox__input tax_input_disabled">
																		<span class="switch-checkbox__label"></span>
																	</label>
																</div>
															</div>
															<div class="col-12" id="children__status_wrap" style="display: {{ $second_leads->children__status == 'yes' ? '':'none' }}">
																<div class="row">
																	<div class="col-12">
																		<h4><b>{{ __('Enfants à charge') }}</b></h4>
																	</div>
																	<div class="col-12" id="dependent_children">
																		@include('includes.crm.children')
																	</div>
																</div>
															</div>
															<div class="col-md-12 mt-4">
																<div class="form-group">
																	<label class="form-label" for="personne_1">Personne 1:</label>
																	{{-- <span>{{ $primary_tax && $primary_tax->first_name?? '' }} {{ $primary_tax && $primary_tax->last_name ?? '' }}</span> --}}
																	<select name="personne_1" id="personne_1"  class="select2_select_option custom-select shadow-none form-control foyer_disabled">
																		<option value="" selected disabled>{{ __('Select') }}</option>
																		<option {{ $second_leads->personne_1 == 'Monsieur'? 'selected':'' }} value="Monsieur">Monsieur</option>
																		<option {{ $second_leads->personne_1 == 'Madame'? 'selected':'' }} value="Madame">Madame</option>
																	</select>
																</div>
															</div>
															<div class="col-12" id="personne_1_wrap" style="display:{{ $second_leads->personne_1? '':'none' }}">
																<div class="row">
																	<div id="mr_status" class="col-md-12 mb-4">
																		<div class="row ">
																			<div class="col-12">
																			<h4><b>Quel est le contrat de travail de <span class="personne_1_title">{{ $second_leads->personne_1 }}</span></b></h4>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat à durée déterminée (CDD)" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity"

																					@if ($lead->mr_activity == 'Contrat à durée déterminée (CDD)')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity">Contrat à durée déterminée (CDD)</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat à durée indéterminée (CDI)" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity2"

																					@if ($lead->mr_activity == 'Contrat à durée indéterminée (CDI)')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity2">Contrat à durée indéterminée (CDI)</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de travail temporaire" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity3"

																					@if ($lead->mr_activity == 'Contrat de travail temporaire')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity3">Contrat de travail temporaire</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de travail intermittent" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity4"

																					@if ($lead->mr_activity == 'Contrat de travail intermittent')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity4">Contrat de travail intermittent</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat d'apprentissage" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity5"

																					@if ($lead->mr_activity == "Contrat d'apprentissage")
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity5">Contrat d'apprentissage</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de professionnalisation" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity6"

																					@if ($lead->mr_activity == 'Contrat de professionnalisation')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity6">Contrat de professionnalisation</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat unique d'insertion" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity7"

																					@if ($lead->mr_activity == "Contrat unique d'insertion")
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity7">Contrat unique d'insertion</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrats conclus avec un groupement d'employeurs" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity8"

																					@if ($lead->mr_activity == "Contrats conclus avec un groupement d'employeurs")
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity8">Contrats conclus avec un groupement d'employeurs</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de travail en portage salarial à durée déterminée ou indéterminée" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity9"

																					@if ($lead->mr_activity == 'Contrat de travail en portage salarial à durée déterminée ou indéterminée')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity9">Contrat de travail en portage salarial à durée déterminée ou indéterminée</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Retraite" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity10"

																					@if ($lead->mr_activity == 'Retraite')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity10">Retraite</label>
																				</div>
																			</div>
																			<div class="col-md-6">
																				<div class="custom-control custom-checkbox">
																					<input type="checkbox" name="mr_activity" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Autre" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="mr_activity11"

																					@if ($lead->mr_activity == 'Autre')
																					checked
																					@endif >
																					<label class="custom-control-label" for="mr_activity11">Autre</label>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-12 mr__activity" style="display: {{ $lead->mr_activity == 'Autre' ? '':'none' }}">
																		<div class="form-group">
																			<label class="form-label" for="autre_field__personne_1">Merci de précisez</label>
																			<input type="text" name="autre_field__personne_1" id="autre_field__personne_1" class="form-control shadow-none foyer_disabled" value="{{ $second_leads->autre_field__personne_1 }}" >
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="form-label" for="mr_revenue"> Revenue <span class="personne_1_title">{{ $second_leads->personne_1 }}</span></label>
																			<input type="number" step="any" name="mr_revenue" id="mr_revenue" class="form-control shadow-none foyer_disabled"
																			value="{{ $lead->mr_revenue }}"
																			>
																		</div>
																	</div>
																	<div class="col-12 d-flex align-items-center">
																		<h4 class="mb-0 mr-2">Existe-t-il un conjoint ? :</h4>
																		<label class="switch-checkbox">
																			<input type="checkbox" id="personne_1_partner" data-autre-box="personne__1_partner" class="switch-checkbox__input other_field__system work_site_disabled"
																			{{ ($second_leads->personne_1_partner == 'yes') ? 'checked':'' }} >
																			<span class="switch-checkbox__label"></span>
																		</label>
																	</div>
																	<div class="col-12 personne__1_partner" style="display: {{ ($second_leads->personne_1_partner == 'yes') ? '':'none' }}">
																		<div class="row">
																			<div class="col-md-12 mt-4">
																				<div class="form-group">
																					<label class="form-label" for="personne_2">Personne 2:</label>
																					<select name="personne_2" id="personne_2"  class="select2_select_option custom-select shadow-none form-control foyer_disabled">
																						<option value="" selected disabled>{{ __('Select') }}</option>
																						<option {{ $second_leads->personne_2 == 'Monsieur'? 'selected':'' }} value="Monsieur">Monsieur</option>
																						<option {{ $second_leads->personne_2 == 'Madame'? 'selected':'' }} value="Madame">Madame</option>
																					</select>
																				</div>
																			</div>
																			<div class="col-12" id="personne_2_wrap" style="display: {{ $second_leads->personne_2 ? '':'none' }}">
																				<div class="row">
																					<div id="mrs_status" class="col-md-12  mb-4">
																						<div class="row ">
																							<div class="col-12">
																							<h4><b>Quel est le contrat de travail de <span class="personne_2_title">{{ $second_leads->personne_2 }}</span></b> </h4>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat à durée déterminée (CDD)" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity"

																									@if ($lead->mrs_activity == 'Contrat à durée déterminée (CDD)')
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity">Contrat à durée déterminée (CDD) </label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat à durée indéterminée (CDI)" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity2"

																									@if ( $lead->mrs_activity == 'Contrat à durée indéterminée (CDI)')
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity2">Contrat à durée indéterminée (CDI)</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat de travail temporaire" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity3"

																									@if ( $lead->mrs_activity == "Contrat de travail temporaire")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity3">Contrat de travail temporaire</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrat de travail intermittent" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity4"

																									@if ( $lead->mrs_activity == "Contrat de travail intermittent")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity4">Contrat de travail intermittent</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat d'apprentissage" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity5"

																									@if ( $lead->mrs_activity == "Contrat d'apprentissage")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity5">Contrat d'apprentissage</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrat de professionnalisation" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity6"

																									@if ( $lead->mrs_activity == "Contrat de professionnalisation")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity6">Contrat de professionnalisation</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat unique d'insertion" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity7"

																									@if ( $lead->mrs_activity == "Contrat unique d'insertion")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity7">Contrat unique d'insertion</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrats conclus avec un groupement d'employeurs" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity8"

																									@if ( $lead->mrs_activity == "Contrats conclus avec un groupement d'employeurs")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity8">Contrats conclus avec un groupement d'employeurs</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrat de travail en portage salarial à durée déterminée ou indéterminée" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity9"

																									@if ( $lead->mrs_activity == "Contrat de travail en portage salarial à durée déterminée ou indéterminée")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity9">Contrat de travail en portage salarial à durée déterminée ou indéterminée</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Retraite" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity10"

																									@if ( $lead->mrs_activity == "Retraite")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity10">Retraite</label>
																								</div>
																							</div>
																							<div class="col-md-6">
																								<div class="custom-control custom-checkbox">
																									<input type="checkbox" name="mrs_activity" data-autre-box="mrs__activity" data-input-type="radio_checkbox" value="Autre" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="mrs_activity11"

																									@if ( $lead->mrs_activity == "Autre")
																									checked
																									@endif >
																									<label class="custom-control-label" for="mrs_activity11">Autre</label>
																								</div>
																							</div>
																						</div>
																					</div>
																					<div class="col-12 mrs__activity" style="display: {{ $lead->mrs_activity == 'Autre' ? '':'none' }}">
																						<div class="form-group">
																							<label class="form-label" for="autre_field__personne_2">Merci de précisez</label>
																							<input type="text" name="autre_field__personne_2" id="autre_field__personne_2" class="form-control shadow-none foyer_disabled" value="{{ $second_leads->autre_field__personne_2 }}" >
																						</div>
																					</div>
																					<div class="col-md-12">
																						<div class="form-group">
																							<label class="form-label" for="mrs_revenue">Revenue <span class="personne_2_title">{{ $second_leads->personne_2 }}</span></label>
																							<input type="number" name="mrs_revenue" id="mrs_revenue" class="form-control shadow-none foyer_disabled"
																							value="{{ $lead->mrs_revenue }}"
																							>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="form-label" for="monthly_credit"> Crédit du foyer mensuel</label>
																			<input type="number" name="monthly_credit" id="monthly_credit" class="form-control shadow-none foyer_disabled"
																			value="{{ $lead->monthly_credit }}">
																		</div>
																	</div>
																	<div class="col-md-12">
																		<div class="form-group">
																			<label class="form-label" for="revenue_credit">Commentaires revenue et crédit du foyer</label>
																			<textarea rows="8" name="revenue_credit" id="revenue_credit" class="form-control shadow-none foyer_disabled"> {{ $lead->revenue_credit }} </textarea>
																		</div>
																	</div>
																</div>
															</div>
															@if (checkAction(Auth::id(), 'lead_collapse_situation_foyer', 'edit') || role() == 's_admin')
																<div class="col-12 text-center">
																	<button id="situation_foyer_btn"
																	type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 foyer_disabled">
																		{{ __('Submit') }}
																	</button>
																</div>
															@else
																<div class="col-12 text-center mb-3">
																	<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																		<span class="novecologie-icon-lock py-1"></span>
																	</button>
																</div>
															@endif
														</div>
													</div>
												</div>
												</div>
											</div>
										@endif
									</div>
									{{-- <div class="text-center">
										<button id="v-pills-1__next_btn" type="button" class="secondary-btn primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 my-3 ml-4">
											{{ __('Next') }}
										</button>
									</div> --}}
								</div>
								@endif
								@if (checkAction(Auth::id(), 'lead_tab_access', 'lead-tracking') || role() == 's_admin')
								<div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
									<div class="accordion" id="leadAccordion23">
										@if (checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'view') ||checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'edit') || role() == 's_admin')
											<div class="card lead__card border-0">
												<div class="card-header bg-transparent border-0 p-0" id="leadCard-1">
												<h2 class="mb-0">
													<div id="tracker_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100">
														<span id="lead-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
														{{-- @if($tracker && $tracker->tracker_platform)
														verified
														@endif --}}
														"></span>
														{{ __('Lead Tracking (Form and response)') }}
														{{-- <span class="d-block ml-auto">
															<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
														</span> --}}
														<button data-tab="Lead Tracking" data-block="Lead Tracking (Form and response)" data-tab-class="lead__lead_tracking" type="button" data-toggle="collapse" data-target="#leadCardCollapse-1" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__lead_tracking') }} position-relative ml-auto mr-1 {{ session('lead__lead_tracking') == 'active' ? 'collapsed':'' }}">
															<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
															<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
														</button>
													</div>
												</h2>
												</div>

												<div id="leadCardCollapse-1" class="collapse {{ session('lead__lead_tracking') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-1">
												<div class="card-body row">
													<div class="col custom-space">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="supplier">Fournisseur de lead <span class="text-danger">*</span></label>
																	<select name="supplier" id="supplier" class="form-control tracking_disabled">
																		@foreach ($suppliers as $supplier)
																		<option  {{ ($supplier->id == $tracker->supplier) ? 'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->suplier }}</option>
																		@endforeach
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="campaign_type">Type de campagne<span class="text-danger">*</span></label>
																	<select name="campaign_type" data-autre-box="compaigne__type" data-input-type="select" data-select-type="single" id="campaign_type" class="form-control tracking_disabled other_field__system">
																		@foreach ($campagne_types as $campagne_type)
																			<option  {{ ($tracker->campaign_type == $campagne_type->name) ? 'selected':'' }} value="{{ $campagne_type->name }}">{{ $campagne_type->name }}</option>
																		@endforeach
																	</select>
																</div>
															</div>
															<div class="col-12 compaigne__type" style="display: {{ $tracker->campaign_type == 'Autre' ? '':'none' }}">
																<div class="form-group">
																	<label class="form-label" for="autre_field__campaign_type">Merci de précisez</label>
																	<input type="text" name="autre_field__campaign_type" id="autre_field__campaign_type" class="form-control shadow-none tracking_disabled"
																	value="{{ $tracker->autre_field__campaign_type }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="campaign">Nom campagne<span class="text-danger">*</span></label>
																	<input type="text" name="campaign" id="campaign" class="form-control shadow-none tracking_disabled" placeholder="Nom campagne"
																	value ="{{ $tracker->campaign }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="request_date">Date demande lead<span class="text-danger">*</span></label>
																	<input type="date" name="request_date" id="request_date"
																	value ="{{ \Carbon\Carbon::parse($tracker->request_date)->format('Y-m-d') }}" class="flatpickr flatpickr-input form-control shadow-none tracking_disabled" placeholder="{{ __('dd-mm-yyyy') }}" >
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="award_date">Date attribution télécommercial<span class="text-danger">*</span></label>
																	<input type="date" name="award_date" id="award_date" class="flatpickr flatpickr-input form-control shadow-none tracking_disabled"
																	value ="{{ \Carbon\Carbon::parse($tracker->award_date)->format('Y-m-d') }}"
															 placeholder="{{ __('dd-mm-yyyy') }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="tracker_travaux">Type de travaux souhaité</label>
																	<select name="tracker_travaux[]" id="tracker_travaux" class="select2_select_option form-control tracking_disabled" multiple>
																		@foreach ($bareme_travaux_tags as $t_travaux)
																			<option {{ getFeature($tracker->tracker_travaux, $t_travaux->travaux) ? 'selected':'' }} value="{{ $t_travaux->travaux }}">{{ $t_travaux->travaux }}</option>
																		@endforeach
																	</select>
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="first_last_name">Nom Prénom<span class="text-danger">*</span></label>
																	<input type="text" name="first_last_name" id="first_last_name" class="form-control shadow-none tracking_disabled"
																	value ="{{ $tracker->first_last_name }}">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="p_code">Code postal<span class="text-danger">*</span></label>
																	<input type="text" name="p_code" id="p_code" class="form-control shadow-none tracking_disabled"
																	value ="{{ $tracker->p_code }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="email_address">Email<span class="text-danger">*</span></label>
																	<input type="email" name="email_address" id="email_address" class="form-control shadow-none tracking_disabled"
																	value="{{ $tracker->email_address }}">
																</div>
															</div>

															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="telephone_number">téléphone<span class="text-danger">*</span></label>
																	<input type="text" name="telephone_number" id="telephone_number" class="form-control shadow-none tracking_disabled"
																	value ="{{ $tracker->telephone }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="p_code_department">Département<span class="text-danger">*</span></label>
																	<input type="text" readonly name="p_code_department" id="p_code_department" class="form-control shadow-none tracking_disabled"
																	value ="{{ getDepartment2($tracker->p_code) }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="h_mode">Mode de chauffage<span class="text-danger">*</span></label>
																	<select name="h_mode" data-autre-box="heating__type_tracker" data-input-type="select" data-select-type="single" id="h_mode" class="form-control other_field__system tracking_disabled">
																		@foreach ($heatings as $heating)
																			<option {{ $tracker->h_mode == $heating->name ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
																		@endforeach
																	</select>
																</div>
															</div>
															<div class="col-12 heating__type_tracker" style="display: {{ $tracker->h_mode == 'Autre' ? '':'none' }}">
																<div class="form-group">
																	<label class="form-label" for="autre_field__h_mode">Merci de précisez</label>
																	<input type="text" name="autre_field__h_mode" id="autre_field__h_mode" class="form-control shadow-none tracking_disabled"
																	value="{{ $tracker->autre_field__h_mode }}">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="owner">Propriétaire<span class="text-danger">*</span></label>
																	<select name="owner" id="owner" class="form-control tracking_disabled">
																		<option
																			{{ ($tracker->owner == 'Oui') ? 'selected':'' }}value="Oui">Oui</option>
																		<option
																			{{ ($tracker->owner == 'Non') ? 'selected':'' }} value="Non">Non</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label class="form-label" for="over_then_15">Votre maison a-t-elle plus de 15 ans ?<span class="text-danger">*</span></label>
																	<select name="over_then_15" id="over_then_15" class="form-control tracking_disabled">
																		<option {{ ($tracker->over_then_15 == 'Oui') ? 'selected':'' }} value="Oui">Oui</option>
																		<option {{ ($tracker->over_then_15 == 'Non') ? 'selected':'' }} value="Non">Non</option>
																	</select>
																</div>
															</div>
															@if (checkAction(Auth::id(), 'collapse_lead_tracing_lead', 'edit') || role() == 's_admin')
																<div class="col-12 text-center">
																	<button type="button" id="leadTrackValidate" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 tracking_disabled">
																		{{ __('Submit') }}
																	</button>
																</div>
															@else
																<div class="col-12 text-center">
																	<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																		<span class="novecologie-icon-lock py-1"></span>
																	</button>
																</div>
															@endif
														</div>
														</form>
													</div>
												</div>
												</div>
											</div>
										@endif
									</div>
									{{-- <div class="text-center">
										<button id="v-pills-3__next_btn" type="button" class="secondary-btn primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 my-3 ml-4">
											{{ __('Next') }}
										</button>
									</div> --}}
								</div>
								@endif
								@if (checkAction(Auth::id(), 'lead_tab_access', 'information-logement') || role() == 's_admin')
								<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
									<div class="accordion" id="leadAccordion22">
										@if (checkAction(Auth::id(), 'lead_collapse__project', 'view') ||checkAction(Auth::id(), 'lead_collapse__project', 'edit') || role() == 's_admin')
										<div class="card lead__card border-0">
											<div class="card-header bg-transparent border-0 p-0" id="leadCard-8">
											<h2 class="mb-0">
												<div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
												<span id="travaux-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4

												"></span>
												Projet
												{{-- <div role="button" class="edit-toggler travaux_edit_toggler active position-relative ml-auto mr-1">
													<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
													<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
												</div> --}}
												{{-- <span class="d-block  ml-auto">
													<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
												</span> --}}
												<button data-tab="Projet" data-block="Projet" data-tab-class="lead__project" type="button" data-toggle="collapse" data-target="#leadCardCollapse-8" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__project') }} position-relative ml-auto mr-1 {{ session('lead__project') == 'active' ? 'collapsed':'' }}">
													<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
													<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
												</button>
												</div>
											</h2>
											</div>
											<div id="leadCardCollapse-8" class="collapse {{ session('lead__project') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-8">
											<div class="card-body row">
												<div class="col custom-space">
													<div class="row collapseRow"  style="display: {{ $collapse_status ? '':'none' }}">
														<div class="col-12">
															<div class="form-group">
																<label class="form-label" for="Adresse_des_travaux"> Adresse des travaux</label>
																<input type="text" name="Adresse_des_travaux" id="Adresse_des_travaux" class="form-control shadow-none travaux_disabled" readonly
																@if ($primary_tax)
																	@if ($primary_tax->same_as_work_address == 'no')
																		value="{{ $primary_tax->Adresse_Travaux }}"
																	@else
																		value="{{ $primary_tax->address2 }}"
																	@endif
																@endif
																>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<label class="form-label" for="Code_postale_des_travaux">Code postale des travaux</label>
																<input type="text" name="Code_postale_des_travaux" id="Code_postale_des_travaux" class="form-control shadow-none travaux_disabled" readonly
																@if ($primary_tax)
																	@if ($primary_tax->same_as_work_address == 'no')
																		value="{{ $primary_tax->Code_postal_Travaux }}"
																	@else
																		value="{{ $primary_tax->postal_code }}"
																	@endif
																@endif
																>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<label class="form-label" for="Ville_des_travaux">Ville des travaux</label>
																<input type="text" name="Ville_des_travaux" id="Ville_des_travaux" class="form-control shadow-none travaux_disabled" readonly
																@if ($primary_tax)
																	@if ($primary_tax->same_as_work_address == 'no')
																		value="{{ $primary_tax->Ville_Travaux }}"
																	@else
																		value="{{ $primary_tax->city }}"
																	@endif
																@endif
																>
															</div>
														</div>
														<div class="col-12">
															<div class="form-group">
																<label class="form-label" for="Département_des_travaux">Département des travaux</label>
																<input type="text" name="Département_des_travaux" id="Département_des_travaux" class="form-control shadow-none travaux_disabled" readonly
																@if ($primary_tax)
																	@if ($primary_tax->same_as_work_address == 'no')
																		value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
																	@else
																		value="{{ getDepartment2($primary_tax->postal_code) }}"
																	@endif
																@endif
																>
															</div>

															 {{-- @php
																 dd(App\Models\CRM\LeadWorkBareme::where('work_id', $work->id)->get());
															 @endphp --}}
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<div class="d-flex align-items-center justify-content-between">
																	<label class="form-label" for="bareme"> Barème</label>
																	{{-- @if (checkAction(Auth::id(), 'general__setting', 'travaux') || role() == 's_admin')
																	<button type="button" class="secondary-btn border-0 mb-1" data-toggle="modal" data-target="#BarèmesModal">+ {{ __('Add new') }}</button>
																	@endif --}}
																</div>
																<select name="bareme[]" id="bareme"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
																	@foreach ($bareme_travaux_tags->where('rank', 1) as $baremes)
																	<option {{ \App\Models\CRM\LeadWorkBareme::where('work_id', $work->id)->where('barame_id',  $baremes->id)->exists()? 'selected':'' }} value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<div class="d-flex align-items-center justify-content-between">
																	<label class="form-label" for="travaux"> Travaux</label>
																</div>
																<select name="travaux[]" id="travaux"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
																	@foreach ($bareme_travaux_tags as $travaux)
																		@if ($travaux->rank == '1')
																			@if (\App\Models\CRM\LeadWorkTravaux::where('work_id', $work->id)->where('travaux_id',  $travaux->id)->exists())
																				<option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>
																			@endif
																		@else
																			<option {{ \App\Models\CRM\LeadWorkTravaux::where('work_id', $work->id)->where('travaux_id',  $travaux->id)->exists() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
																		@endif
																	@endforeach
																</select>
															</div>
														</div>
														<div class="col-md-12">
															<div class="form-group">
																<div class="d-flex align-items-center justify-content-between">
																	<label class="form-label" for="tag">Tag</label>
																</div>
																<select name="tag[]" id="tag"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
																	@foreach ($bareme_travaux_tags->where('rank', 1) as $tag)
																		@if (\App\Models\CRM\LeadWorkBareme::where('work_id', $work->id)->where('barame_id',  $tag->id)->exists())
																			<option  value="disabled" disabled="disabled" selected>{{ $tag->tag }}</option>
																		@endif
																	@endforeach
																</select>
															</div>
														</div>

														<div class="col-md-12" id="productListBlock">
															@foreach ($bareme_travaux_tags as $product_tag)
																@if ($product_tag->rank == '1')
																	@if (\App\Models\CRM\LeadWorkBareme::where('work_id', $work->id)->where('barame_id',  $product_tag->id)->exists())
																		<div class="form-group">
																			<div class="d-flex align-items-center">
																				<label class="form-label" for="status">Produit {{ $product_tag->tag }}</label>
																			</div>
																			<select id="product{{ $product_tag->id }}" data-tag-id="{{ $product_tag->id }}" class="select2_select_option custom-select shadow-none tag__product form-control travaux_disabled" multiple>
																				@foreach (\App\Models\CRM\Product::latest()->get() as $product)
																					<option {{ \App\Models\CRM\LeadWorkTagProduct::where('work_id', $work->id)->where('tag_id',  $product_tag->id)->where('product_id',  $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
																				@endforeach
																			</select>
																		</div>
																	@endif
																@endif
															@endforeach
															{{-- <div class="form-group">
																<div class="d-flex align-items-center">
																	<label class="form-label" for="status">{{ __('Produits') }}</label>
																</div>
																<select name="product" id="product" class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
																	@foreach (\App\Models\CRM\Product::latest()->get() as $product)
																		@if (getFeature($work->product, $product->id))
																			<option selected value="{{ $product->id }}">{{ $product->reference }}</option>
																		@endif
																	@endforeach
																</select>
															</div> --}}
														</div>
														{{-- <div class="col-md-12">
															<div class="form-group">
																<div class="d-flex align-items-center justify-content-between">
																	<label class="form-label" for="status">{{ __('Produits') }}</label>
																	@if (checkAction(Auth::id(), 'others', 'product') || role() == 's_admin')
																	<button type="button" class="secondary-btn border-0 mb-1" data-toggle="modal" data-target="#produitsCreateModal">+ {{ __('Add new') }}</button>
																	@endif
																</div>
																<select name="product" id="product"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
																	@foreach (\App\Models\CRM\Product::latest()->get() as $product)
																		@if (getFeature($work->product, $product->id))
																			<option selected value="{{ $product->id }}">{{ $product->reference }}</option>
																		@endif
																	@endforeach
																</select>
															</div>
														</div> --}}


														{{-- <div class="col-md-12" id="accumulation">
															<div class="row">
																<div class="col-12 d-flex align-items-center justify-content-between">
																	<h4 class="font-weight-bold">
																		{{ __('Financement ') }} <span class="text-danger">*</span>
																	</h4>
																	@if (checkAction(Auth::id(), 'others', 'financement') || role() == 's_admin')
																	<button type="button" class="secondary-btn border-0" id="add_financement" data-toggle="modal" data-target="#addFinancement">+ {{ __('Add new') }}</button>
																	@endif
																</div>
																@foreach (getProjectStatus('Financement') as $item)
																<div class="col-md-3">
																	<div class="form-group">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" name="financement[]" value="{{ $item->status }}" class="custom-control-input travaux_disabled" id="financement{{ $item->id }}"  @if (getFeature($work->financement, $item->status))
																				checked
																				@endif>
																			<label class="custom-control-label" for="financement{{ $item->id }}">{{ $item->status }}</label>
																		</div>
																	</div>
																</div>
																@endforeach
															</div>
														</div> --}}
														<div class="col-md-12">
															<div class="form-group">
																<div class="d-flex align-items-center justify-content-between">
																	<label class="form-label" for="Type_de_contrat">Type de contrat:</label>
																</div>
																<select name="Type_de_contrat" id="Type_de_contrat"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
																	<option value="" selected disabled>{{ __('Select') }}</option>
																	<option {{ $work->Type_de_contrat == 'Financement IM' ? 'selected':'' }} value="Financement IM">Financement IM</option>
																	<option {{ $work->Type_de_contrat == 'Subvention Interne' ? 'selected':'' }} value="Subvention Interne">Subvention Interne</option>
																	<option {{ $work->Type_de_contrat == 'Financement Interne' ? 'selected':'' }} value="Financement Interne">Financement Interne</option>
																</select>
															</div>
														</div>
														<div class="col-12 text-center">
															<button id="MaPrimeRenovUpdateBtn" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
																Calcul des aides
																{{-- CALCUL DES AIDES --}}
																{{-- {{ __('Submit') }} --}}
															</button>
														</div>
														<div class="col-12 mt-4">
															<div class="row">
																<div class="col-md-2">
																	<h4 class="mb-0 text-right">MaPrimeRenov</h4>
																</div>
																<div class="col-md-10">
																	<label class="switch-checkbox">
																		<input type="checkbox" data-autre-box="work__MaPrimeRenov" class="switch-checkbox__input other_field__system travaux_disabled" id="MaPrimeRenov"  name="MaPrimeRenov" {{ ($work->MaPrimeRenov == 'yes')? 'checked':'' }}>
																		<span class="switch-checkbox__label"></span>
																	</label>
																</div>
															</div>
														</div>
														<div class="col-12 work__MaPrimeRenov" style="display: {{ ($work->MaPrimeRenov == 'yes')? '':'none' }}">
															<div class="card">
																<div class="card-body" style="background-color: #F2F2F2">
																	@if ($primary_tax)
																		<h4 class="mb-0">Montant estimée de l’aide: <span id="MaPrimeRenovEstimatedAmount">{{ MaPrimeRenovEstimatedAmount($lead->heating_type, $lead->precariousness,  \App\Models\CRM\LeadWorkBareme::where('work_id', $work->id)->pluck('barame_id')) }}</span></h4>
																		<h4 class="mb-0">Précarité du client: <span class="precarious p-2 d-inline-block" style="border-radius: 5px; background-color:
																		@if ($lead->precariousness == 'Classique')
																			 #FF00FF;
																			 color:black;
																		@elseif($lead->precariousness == 'Intermediaire')
																			 #800080;
																			 color:white;
																		@elseif($lead->precariousness == 'Precaire')
																			 #FFFF00;
																			 color:black;
																		@elseif($lead->precariousness == 'Grand Precaire')
																			 #0000FF;
																			 color:white;
																		@endif
																		">{{ $lead->precariousness }}</span></h4>
																		<div class="mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2">Subvention MaPrimeRénov déduit du devis ?</span>
																			<div class="multi-option-switch">
																				<div class="multi-option-switch__body">
																					<input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input" id="Subvention_MaPrimeRénov_déduit_du_devis--off" name="Subvention_MaPrimeRénov_déduit_du_devis" {{ ($work->Subvention_MaPrimeRénov_déduit_du_devis == 'no')? 'checked':'' }}>
																					<input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input" value="n/a" id="Subvention_MaPrimeRénov_déduit_du_devis--disabled" name="Subvention_MaPrimeRénov_déduit_du_devis" {{ ($work->Subvention_MaPrimeRénov_déduit_du_devis != 'yes' && $work->Subvention_MaPrimeRénov_déduit_du_devis != 'no')? 'checked':'' }}>
																					<input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input"  value="yes" id="Subvention_MaPrimeRénov_déduit_du_devis--on" name="Subvention_MaPrimeRénov_déduit_du_devis" {{ ($work->Subvention_MaPrimeRénov_déduit_du_devis == 'yes')? 'checked':'' }}>
																					<span class="multi-option-switch__float-indicator"></span>
																					<label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Subvention_MaPrimeRénov_déduit_du_devis--off">
																						<span class="multi-option-switch__label__btn">
																							<i class="bi bi-x-lg"></i>
																						</span>
																					</label>
																					<label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Subvention_MaPrimeRénov_déduit_du_devis--disabled">
																						<span class="multi-option-switch__label__btn">
																							<i class="bi bi-circle"></i>
																						</span>
																					</label>
																					<label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Subvention_MaPrimeRénov_déduit_du_devis--on">
																						<span class="multi-option-switch__label__btn">
																							<i class="bi bi-check-lg"></i>
																						</span>
																					</label>
																				</div>
																			</div>
																			{{-- <label class="switch-checkbox">
																				<input type="checkbox" {{ ($work->Subvention_MaPrimeRénov_déduit_du_devis == 'yes')? 'checked':'' }} class="switch-checkbox__input travaux_disabled" id="Subvention_MaPrimeRénov_déduit_du_devis">
																				<span class="switch-checkbox__label"></span>
																			</label>  --}}
																		</div>
																		<div class="mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2">Le demandeur a déjà fait une demande à MaPrimeRenov ?</span>
																			<div class="multi-option-switch">
																				<div class="multi-option-switch__body">
																					<input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--off" name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" {{ ($work->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'no')? 'checked':'' }}>
																					<input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input" value="n/a" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--disabled" name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" {{ ($work->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov != 'yes' && $work->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov != 'no')? 'checked':'' }}>
																					<input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input"  value="yes" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--on" name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" {{ ($work->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'yes')? 'checked':'' }}>
																					<span class="multi-option-switch__float-indicator"></span>
																					<label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--off">
																						<span class="multi-option-switch__label__btn">
																							<i class="bi bi-x-lg"></i>
																						</span>
																					</label>
																					<label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--disabled">
																						<span class="multi-option-switch__label__btn">
																							<i class="bi bi-circle"></i>
																						</span>
																					</label>
																					<label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--on">
																						<span class="multi-option-switch__label__btn">
																							<i class="bi bi-check-lg"></i>
																						</span>
																					</label>
																				</div>
																			</div>
																			{{-- <label class="switch-checkbox">
																				<input type="checkbox" {{ ($work->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'yes')? 'checked':'' }} class="switch-checkbox__input travaux_disabled" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov">
																				<span class="switch-checkbox__label"></span>
																			</label>  --}}
																		</div>
																	@else
																		<h4 class="mb-0">Avis impôt non renseigné </h4>
																	@endif
																</div>
															</div>
														</div>
														<div class="col-12 mt-4">
															<div class="row">
																<div class="col-md-2">
																	<h4 class="mb-0 text-right">Action Logement</h4>
																</div>
																<div class="col-md-10">
																	<label class="switch-checkbox">
																		<input type="checkbox" data-autre-box="work__Action_Logement"  class="switch-checkbox__input other_field__system travaux_disabled"  id="Action_Logement"  name="Action_Logement" {{ ($work->Action_Logement == 'yes')? 'checked':'' }}>
																		<span class="switch-checkbox__label"></span>
																	</label>
																</div>
															</div>
														</div>
														<div class="col-12 mt-4">
															<div class="row">
																<div class="col-md-2">
																	<h4 class="mb-0 text-right">CEE</h4>
																</div>
																<div class="col-md-10">
																	<label class="switch-checkbox">
																		<input type="checkbox" data-autre-box="work__CEE"  class="switch-checkbox__input travaux_disabled other_field__system"  id="CEE"  name="CEE" {{ ($work->CEE == 'yes')? 'checked':'' }}>
																		<span class="switch-checkbox__label"></span>
																	</label>
																</div>
															</div>
														</div>
														<div class="col-12 work__CEE" style="display: {{ ($work->CEE == 'yes')? '':'none' }}">
															<div class="card">
																<div class="card-body" style="background-color: #F2F2F2">
																	@if ($primary_tax)
																		<h4 class="mb-0">Montant estimée de l’aide: <span id="CEEEstimatedAmount">{{ CEEEstimatedAmount($lead->heating_type, $lead->precariousness,  \App\Models\CRM\LeadWorkBareme::where('work_id', $work->id)->pluck('barame_id')) }}</span></h4>
																		<h4 class="mb-0">Précarité du client: <span class="precarious p-2 d-inline-block"  style="border-radius: 5px; background-color:
																			@if ($lead->precariousness == 'Classique')
																				 #FF00FF;
																				 color:black;
																			@elseif($lead->precariousness == 'Intermediaire')
																				 #800080;
																				 color:white;
																			@elseif($lead->precariousness == 'Precaire')
																				 #FFFF00;
																				 color:black;
																			@elseif($lead->precariousness == 'Grand Precaire')
																				 #0000FF;
																				 color:white;
																			@endif
																			">{{ $lead->precariousness }}</span></h4>
																	@else
																		<h4 class="mb-0">Avis impôt non renseigné </h4>
																	@endif
																</div>
															</div>
														</div>
														<div class="col-12 mt-4">
															<div class="row">
																<div class="col-md-2">
																	<h4 class="mb-0 text-right">Credit</h4>
																</div>
																<div class="col-md-10">
																	<label class="switch-checkbox">
																		<input type="checkbox" data-autre-box="work__credit"  class="switch-checkbox__input travaux_disabled other_field__system"  id="credit"  name="credit" {{ ($work->credit == 'yes')? 'checked':'' }}>
																		<span class="switch-checkbox__label"></span>
																	</label>
																</div>
															</div>
														</div>
														<div class="col-12 work__credit" style="display: {{ ($work->credit == 'yes')? '':'none' }}">
															<div class="card">
																<div class="card-body" style="background-color: #F2F2F2">
																	<div class="form-group">
																		<label class="form-label" for="Montant_Crédit">Montant Crédit</label>
																		<input type="number" step="any" name="Montant_Crédit" id="Montant_Crédit" class="form-control shadow-none travaux_disabled" value="{{ $work->Montant_Crédit  }}">
																	</div>
																	<div class="mt-4 d-flex align-items-center">
																		<span class="mb-0 mr-2">Report du crédit</span>
																		<label class="switch-checkbox">
																			<input type="checkbox" data-autre-box="work__Report_du_crédit" class="switch-checkbox__input travaux_disabled other_field__system" {{ $work->Report_du_crédit == 'yes'? 'checked':'' }} name="Report_du_crédit" id="Report_du_crédit">
																			<span class="switch-checkbox__label"></span>
																		</label>
																	</div>
																	<div class="mt-2 work__Report_du_crédit" style="display: {{ ($work->Report_du_crédit == 'yes') ? "": 'none' }}">
																		<div class="form-group">
																			<div class="d-flex align-items-center justify-content-between">
																				<label class="form-label" for="Nombre_de_jours_report">Nombre de jours report:</label>
																			</div>
																			<select name="Nombre_de_jours_report" id="Nombre_de_jours_report"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
																				<option value="" selected disabled>{{ __('Select') }}</option>
																				<option {{ $work->Nombre_de_jours_report == '0 jours' ? 'selected':'' }} value="0 jours">0 jours</option>
																				<option {{ $work->Nombre_de_jours_report == '90 jours' ? 'selected':'' }} value="90 jours">90 jours</option>
																				<option {{ $work->Nombre_de_jours_report == '140 jours' ? 'selected':'' }} value="140 jours">140 jours</option>
																				<option {{ $work->Nombre_de_jours_report == '180 jours' ? 'selected':'' }} value="180 jours">180 jours</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-12 mt-4">
															<div class="row">
																<div class="col-md-2">
																	<h4 class="mb-0 text-right">Reste à  charge</h4>
																</div>
																<div class="col-md-10">
																	<label class="switch-checkbox">
																		<input type="checkbox" data-autre-box="work__Reste_à_charge"  class="switch-checkbox__input travaux_disabled other_field__system"  id="Reste_à_charge"  name="Reste_à_charge" {{ ($work->Reste_à_charge == 'yes')? 'checked':'' }}>
																		<span class="switch-checkbox__label"></span>
																	</label>
																</div>
															</div>
														</div>
														<div class="col-12 work__Reste_à_charge" style="display: {{ ($work->Reste_à_charge == 'yes')? '':'none' }}">
															<div class="card">
																<div class="card-body" style="background-color: #F2F2F2">
																	<div class="form-group">
																		<label class="form-label" for="montant">Montant</label>
																		<input type="number" step="any" name="montant" id="montant" class="form-control shadow-none travaux_disabled" value="{{ $work->montant  }}">
																	</div>
																	<div class="form-group">
																		<div class="d-flex align-items-center justify-content-between">
																			<label class="form-label" for="Mode_de_paiement">Mode de paiement:</label>
																		</div>
																		<select name="Mode_de_paiement" id="Mode_de_paiement" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
																			<option value="" selected disabled>{{ __('Select') }}</option>
																			<option {{ $work->Mode_de_paiement == 'Comptant' ? 'selected':'' }} value="Comptant">Comptant</option>
																			<option {{ $work->Mode_de_paiement == 'Différé' ? 'selected':'' }} value="Différé">Différé</option>
																		</select>
																	</div>
																	<div class="form-group work__Mode_de_paiement"  style="display: {{ $work->Mode_de_paiement == 'Différé' ? '':'none' }}">
																		<div class="d-flex align-items-center justify-content-between">
																			<label class="form-label" for="Nombre_de_mensualités">Nombre de mensualités:</label>
																		</div>
																		<select name="Nombre_de_mensualités" id="Nombre_de_mensualités"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
																			<option value="" selected disabled>{{ __('Select') }}</option>
																			<option {{ $work->Nombre_de_mensualités == '1' ? 'selected':'' }} value="1">1</option>
																			<option {{ $work->Nombre_de_mensualités == '2' ? 'selected':'' }} value="2">2</option>
																			<option {{ $work->Nombre_de_mensualités == '3' ? 'selected':'' }} value="3">3</option>
																			<option {{ $work->Nombre_de_mensualités == '4' ? 'selected':'' }} value="4">4</option>
																			<option {{ $work->Nombre_de_mensualités == '5' ? 'selected':'' }} value="5">5</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
														{{-- <div class="col-12 my-4 d-flex align-items-center">
															<h4 class="mb-0 mr-2">CREDIT<span class="text-danger">*</span></h4>
															<label class="switch-checkbox">
																<input type="checkbox" class="switch-checkbox__input travaux_disabled" id="credit" name="credit"
																@isset($work)
																{{ ($work->credit == 'yes')? 'checked':'' }}
																@endisset
																>
																<span class="switch-checkbox__label"></span>
															</label>
														</div>
														<div class="col-12 mb-4" @isset ($work) style="display: {{ ($work->credit == 'yes')? '':'none' }}" @else style="display: none" @endisset id="creditBlock">
															<div class="row">
																<div class="col-12">
																	<div class="row">
																		<div class="col-md-3 mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2"> MaPrimeRenov</span>
																			<label class="switch-checkbox">
																				<input type="checkbox" class="switch-checkbox__input travaux_disabled" name="credit_item[]" value="MaPrimeRenov" @if (getFeature($work->credit_item, 'MaPrimeRenov'))
																				checked
																				@endif>
																				<span class="switch-checkbox__label"></span>
																			</label>
																		</div>
																		<div class="col-md-3 mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2"> Action Logement</span>
																			<label class="switch-checkbox">
																				<input type="checkbox" class="switch-checkbox__input travaux_disabled" name="credit_item[]" value="Action Logement" @if (getFeature($work->credit_item, 'Action Logement'))
																				checked
																				@endif>
																				<span class="switch-checkbox__label"></span>
																			</label>
																		</div>
																		<div class="col-md-3 mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2"> CEE</span>
																			<label class="switch-checkbox">
																				<input type="checkbox" class="switch-checkbox__input travaux_disabled" name="credit_item[]" value="CEE" @if (getFeature($work->credit_item, 'CEE'))
																				checked
																				@endif>
																				<span class="switch-checkbox__label"></span>
																			</label>
																		</div>
																		<div class="col-md-3 mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2"> Credit</span>
																			<label class="switch-checkbox">
																				<input type="checkbox" class="switch-checkbox__input travaux_disabled" name="credit_item[]" value="Credit" @if (getFeature($work->credit_item, 'Credit'))
																				checked
																				@endif>
																				<span class="switch-checkbox__label"></span>
																			</label>
																		</div>
																		<div class="col-md-3 mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2"> Paiement en plusieurs fois</span>
																			<label class="switch-checkbox">
																				<input type="checkbox" class="switch-checkbox__input travaux_disabled" name="credit_item[]" value="Paiement en plusieurs fois" @if (getFeature($work->credit_item, 'Paiement en plusieurs fois'))
																				checked
																				@endif>
																				<span class="switch-checkbox__label"></span>
																			</label>
																		</div>
																		<div class="col-md-3 mt-4 d-flex align-items-center">
																			<span class="mb-0 mr-2">Paiement Comptant</span>
																			<label class="switch-checkbox">
																				<input type="checkbox" class="switch-checkbox__input travaux_disabled" name="credit_item[]" value="Paiement Comptant" @if (getFeature($work->credit_item, 'Paiement Comptant'))
																				checked
																				@endif>
																				<span class="switch-checkbox__label"></span>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-md-12 mt-3">
																	<div class="form-group">
																		<label class="form-label" for="credit_amount">Bon de commande €</label>
																		<input type="text" name="credit_amount" id="credit_amount" value="{{ $work->credit_amount ?? '' }}" class="form-control shadow-none travaux_disabled">
																	</div>
																</div>
															</div>
														</div> --}}
														{{-- <div class="col-md-12">
															<div class="form-group">
																<label class="form-label" for="montant">{{ __('Montant') }} <span class="text-danger">*</span></label>
																<input type="number" name="montant" id="montant" value="{{ $work->montant }}" class="form-control shadow-none travaux_disabled">
															</div>
														</div> --}}
														{{-- <div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="previsite">{{ __('Previsite realisé') }} <span class="text-danger">*</span></label>
																<input type="text" name="previsite" id="previsite" value="@if ($work){{ $work->previsite }}@endif" class="form-control highlight shadow-none travaux_disabled">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="projet_valide">{{ __('Projet valide') }} <span class="text-danger">*</span></label>
																<input type="text" name="projet_valide" id="projet_valide" value="@if ($work){{ $work->projet_valide }}@endif" class="form-control highlight shadow-none travaux_disabled">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="devis_signe">{{ __('Devis signe') }} <span class="text-danger">*</span></label>
																<input type="text" name="devis_signe" id="devis_signe" value="@if ($work){{ $work->devis_signe }}@endif" class="form-control highlight shadow-none travaux_disabled">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="project_charge">{{ __('Reste a charge Projet') }} <span class="text-danger">*</span> </label>
																<input type="text" name="project_charge" id="project_charge" value="@if ($work){{ $work->project_charge }}@endif" class="form-control highlight shadow-none travaux_disabled">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="additional_work">{{ __('Travaux supplementaire') }} <span class="text-danger">*</span></label>
																<input type="text" name="additional_work" id="additional_work" value="@if ($work){{ $work->additional_work }}@endif" class="form-control shadow-none travaux_disabled">
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="additional_work_payable">{{ __('Reste a charge travaux supplementaire') }} <span class="text-danger">*</span></label>
																<input type="text" name="additional_work_payable" id="additional_work_payable"  value="@if ($work){{ $work->additional_work_payable }}@endif" class="form-control shadow-none travaux_disabled">
															</div>
														</div>  --}}
														<div class="col-md-12 mt-3">
															<div class="form-group">
																<label class="form-label" for="comments">Observations</label>
																<textarea name="comments" id="comments" class="form-control shadow-none travaux_disabled">{{ $work->comments ?? '' }}</textarea>
															</div>
														</div>
														@if (checkAction(Auth::id(), 'lead_collapse__project', 'edit') || role() == 's_admin')
															<div class="col-12 text-center ">
																<button id="travauxValidate"
																type="button"  class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 travaux_disabled">
																	{{ __('Submit') }}
																</button>
															</div>
														@else
															<div class="col-12 text-center">
																<button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																	<span class="novecologie-icon-lock py-1"></span>
																</button>
															</div>
														@endif
													</div>
												</div>
											</div>
											</div>
										</div>
										@endif
										@if (checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'view') ||checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'edit') || role() == 's_admin')
											<div class="card lead__card border-0">
												<div class="card-header bg-transparent border-0 p-0" id="leadCard-9">
												<h2 class="mb-0">
													<div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
													<span id="travaux-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
													Prescriptions chantier
													{{-- <div role="button" class="edit-toggler travaux_edit_toggler active position-relative ml-auto mr-1">
														<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
														<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
													</div> --}}
													{{-- <span class="d-block  ml-auto">
														<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
													</span> --}}
													<button data-tab="Projet" data-block="Prescriptions chantier" data-tab-class="lead__prescription_chantier" type="button" data-toggle="collapse" data-target="#leadCardCollapse-9" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__prescription_chantier') }} position-relative ml-auto mr-1 {{ session('lead__prescription_chantier') == 'active' ? 'collapsed':'' }}">
														<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
														<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
													</button>
													</div>
												</h2>
												</div>
												<div id="leadCardCollapse-9" class="collapse {{ session('lead__prescription_chantier') == 'active' ? 'show':'' }} aria-labelledby="leadCard-9">
												<div class="card-body row">
													<div class="col custom-space">
														<div class="col custom-space collapseRow" style="display: {{ $collapse_status ? '':'none' }}" id="questionBlock">
															@include('includes.crm.lead_question')
														</div>
													</div>
												</div>
												</div>
											</div>
										@endif
										{{-- @endif  --}}
									</div>
									{{-- <div class="text-center">
										<button id="v-pills-2__next_btn" type="button" class="secondary-btn primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 my-3 ml-4">
											{{ __('Next') }}
										</button>
									</div> --}}
								</div>
								@endif
								@if (checkAction(Auth::id(), 'lead_tab_access', 'custom_field') || role() == 's_admin')
									<div class="tab-pane fade" id="v-pills-custom-field" role="tabpanel" aria-labelledby="v-pills-custom-field-tab">
										<div class="accordion" id="leadAccordion2custom">
											@if (checkAction(Auth::id(), 'custom_field', 'view') ||checkAction(Auth::id(), 'custom_field', 'edit') || role() == 's_admin')
												<div class="card lead__card border-0">
													<div class="card-header bg-transparent border-0 p-0" id="leadCard-custom_field">
													<h2 class="mb-0">
														<button id="work_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-custom_field"   aria-expanded="false" aria-controls="leadCardCollapse-custom_field">
														<span id="present-work-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
														{{ __('Custom Field') }}
															<span class="d-block ml-auto">
																<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
															</span>
														</button>
													</h2>
													</div>
													<div id="leadCardCollapse-custom_field" class="collapse" aria-labelledby="leadCard-custom_field">
													<div class="card-body row">
														<div class="col custom-space">
															<div class="row">
																<div class="col-md-12">
																	<div class="text-right">
																	@if (checkAction(Auth::id(), 'custom_field', 'add_field') || role() == 's_admin')
																		<button data-toggle="modal" data-target="#customTabDataField" class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">
																			<span class="mr-2"></span>
																			+ {{ __('Add Field') }}
																		</button>
																	@endif
																	</div>
																	@forelse ($inputs as $input)
                                                                    @if ($loop->first)
                                                                    <form  action="{{ route('lead.custom.field.data.store') }}" method="post" class="needs-validation"  novalidate>
                                                                    <div class="row mb-3">
                                                                    @csrf
                                                                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                                                                    @endif
                                                                    @if ($input->input_type == 'textarea')
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="example_project_tab{{ $input->id }}">{{ $input->title }} </label>
                                                                                <textarea @if (getCustomFieldPermission()) disabled @endif name="{{ $input->name }}" id="example_project_tab{{ $input->id }}" class="form-control shadow-none">{{ getLeadCustomInputValue($lead->id, $input->name) }}</textarea>
                                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($input->input_type == 'select')
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="example_project_tab{{ $input->id }}">{{ $input->title }} </label>
                                                                                <select @if (getCustomFieldPermission()) disabled @endif name="{{ $input->name }}" id="example_project_tab{{ $input->id }}" class="custom-select shadow-none form-control">
                                                                                    <option value="">{{ __('Select') }}</option>
                                                                                    @foreach (explode(',', $input->options) as $option)
                                                                                        <option
																						@if ( trim(getLeadCustomInputValue($lead->id, $input->name)) == trim($option))
                                                                                                selected
																						@endif
																						 value="{{ $option }}">{{ $option }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($input->input_type == 'radio')
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <h4 class="font-weight-bold"> {{ $input->title }} </h4>
                                                                                </div>
                                                                                @foreach (explode(',', $input->options) as $option)
                                                                                <div class="col-4">
                                                                                    <div class="form-group">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input @if (getCustomFieldPermission()) disabled @endif type="radio" name="{{ $input->name }}" value="{{ $option }}" class="custom-control-input" id="{{ $loop->iteration }}tab_radio_type{{ $input->id }}" @if (trim(getLeadCustomInputValue($lead->id, $input->name)) == trim($option))
																							checked
																						@endif>
                                                                                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                                                            <label class="custom-control-label" for="{{ $loop->iteration }}tab_radio_type{{ $input->id }}"> {{ $option }} </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @elseif ($input->input_type == 'checkbox')
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <h4 class="font-weight-bold"> {{ $input->title }}</h4>
                                                                                </div>
                                                                                @foreach (explode(',', $input->options) as $option)
                                                                                <div class="col-4">
                                                                                    <div class="form-group required-checkbox">
                                                                                        <div class="custom-control custom-checkbox">
                                                                                            <input @if (getCustomFieldPermission()) disabled @endif type="checkbox" name="checkboxinput_{{ $input->name }}[]" value="{{ $option }}" class="custom-control-input " id="{{ $loop->iteration }}tab_checkbox{{ $input->id }}" @if (getFeature(trim(getLeadCustomInputValue($lead->id, $input->name)), trim($option)))
																							checked
																						@endif>
                                                                                            <label class="custom-control-label" for="{{ $loop->iteration }}tab_checkbox{{ $input->id }}"> {{ $option }}</label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label class="form-label" for="tab_input_field{{ $input->id }}">{{ $input->title }} </label>
                                                                                <input  @if (getCustomFieldPermission()) disabled @endif type="{{ $input->input_type }}" name="{{ $input->name }}" id="tab_input_field{{ $input->id }}"  class="form-control shadow-none " value="{{ getLeadCustomInputValue($lead->id, $input->name)}}">
																				@if ($input->input_type == 'email')
                                                                                <div class="invalid-feedback">{{ __('Please enter a valid email address') }}</div>
																				@else
                                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
																				@endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if ($loop->last)
                                                                            <div class="col-12 text-center">
                                                                                <button type="submit" data-toggle="false"  aria-expanded="false" aria-controls="leadCardCollapse-5" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                                                                    {{ __('Submit') }}
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    @endif
                                                                @empty
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <h3 class="text-center">
                                                                            {{ __('No Item Found') }}
                                                                        </h3>
                                                                    </div>
                                                                </div>
                                                                @endforelse
																</div>
															</div>
														</div>
													</div>
													</div>
												</div>
											@endif
										</div>
									</div>
								@endif
							</div>

							{{-- </form> --}}
						</div>
						<div class="database-table-wrapper bg-white">
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
							<div class="tab-content" id="pills-tabContent">
								@if (checkAction(Auth::id(), 'lead', 'activity') || role() == 's_admin')
								<div class="tab-pane fade" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab">
									<div class="table-responsive database-table-wrapper--custom simple-bar">
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
											<tbody class="database-table__body" id="activity_log_wrap">
												@include('includes.crm.lead-activity-log')
											</tbody>
										</table>
									</div>
								</div>
								@endif
								@if (checkAction(Auth::id(), 'lead', 'create_comment') || role() == 's_admin')
								<div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
									<div class="ticket-main__chat-card">
										<div class="ticket-main__chat-card__body">
											<div class="ticket-main__chat-card__body__scroller">
												<div class="ticket-main__chat-card__body__list" id="lead_comments">
													@foreach ($comments as $comment)
														<div class="ticket-main__chat-card__body__list__item {{ \Auth::id() == $comment->user_id ? '':'' }}">
															<div class="ticket-main__chat-card__body__list__item__header">
																<a href="#!" class="ticket-main__chat-card__body__list__item__header__user-meta">
																	@if ($comment->getUser)
																		@if($comment->getUser->profile_photo)
																			<img src="{{ asset('uploads/crm/profiles') }}/{{ $comment->getUser->profile_photo }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image">
																		@else
																			<img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image">
																		@endif
																	@else
																		<img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="image" class="ticket-main__chat-card__body__list__item__header__user__image">
																	@endif

																	<span class="ticket-main__chat-card__body__list__item__header__user__name">{{ $comment->getUser->name ?? '' }}</span>
																</a>
																<div class="d-md-inline">
																	<span class="ticket-main__chat-card__body__list__item__header__text ticket-main__chat-card__body__list__item__header__text--muted">{{ __('replied on') }}</span>
																	<span class="ticket-main__chat-card__body__list__item__header__text">{{ \Carbon\Carbon::parse($comment->created_at)->format('F d, Y') .' at '. \Carbon\Carbon::parse($comment->created_at)->format('h:i a') }}</span> @if ($comment->getCategory)
																	<span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: {{ $comment->getCategory->background_color ?? '#fff' }}">{{ $comment->getCategory->name ?? '' }}</span>
																	@endif
																</div>
															</div>
															<div class="ticket-main__chat-card__body__list__item__body">
																<p class="ticket-main__chat-card__body__list__item__body__text">{{ $comment->comment }}</p>
															</div>
															<div class="ticket-main__chat-card__body__list__item__footer">
																@foreach ($comment->file as $file)
																	<a href="{{ asset('uploads/crm/comment_file') }}/{{ $file->name }}" download="{{ $file->name }}" target="_blank" class="ticket-main__chat-card__body__list__item__footer__btn">
																		@if ($file->type == 'png' || $file->type == 'jpg' || $file->type == 'jpeg' || $file->type == 'gif')
																			<i class="bi bi-image-fill"></i>
																		@else
																			<i class="bi bi-file-earmark-text-fill"></i>
																		@endif
																		<span class="ticket-main__chat-card__body__list__item__footer__btn__text">{{ $file->name }}</span>
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
												<textarea rows="5" name="comment" id="lead_comment" class="ticket-main__chat-card__form__textarea" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="{{ __('Write your response') }}"></textarea>
												<div class="ticket-main__chat-card__form__footer">
													<div class="form-group">
														<select id="comment_category" name="category_id" class="form-control w-100" required>
															<option value="" selected>{{ __('Select') }}</option>
															@foreach ($categories as $cat)
																<option value="{{ $cat->id }}">{{ $cat->name }}</option>
															@endforeach
														</select>
													</div>
													<label class="ticket-main__chat-card__custom-file" role="button">
														<input type="file" name="attach_files[]" multiple class="ticket-main__chat-card__custom-file__input">
														<span class="ticket-main__chat-card__custom-file__btn">
															<span class="ticket-main__chat-card__custom-file__btn__text">{{ __('Attach') }}</span>
															<i class="bi bi-paperclip"></i>
														</span>
													</label>
													@if (checkAction(Auth::id(), 'project', 'create_comment') || role() == 's_admin')
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
												@foreach(getCalls() as $calls)
												@if ($calls['from_number'] == $lead->phone)
													<tr>
														<td class="align-middle">
															<p class="ringover-call-last_state">{{ $calls['last_state'] }}</p>
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
												@endforeach
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

		{{-- Baremes Modal  --}}
		<div class="modal modal--aside fade leftAsideModal" id="BarèmesModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Nouvelle sous-opération') }}</h1>
					<form action="{{ route('scale.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="wording">{{ __('Libellé') }} :</label>
							<input type="text" id="wording" name="wording" class="form-control shadow-none rounded">
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>

						<div class="form-group">
							<label class="form-label" for="description">{{ __('Description') }} :</label>
							<textarea  id="description" name="description" class="form-control shadow-none rounded"></textarea>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="kwh_cumac">Kwh Cumac :</label>
							<input type="text" id="kwh_cumac" name="kwh_cumac" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="prime_coup">Prime Coup de pouce CEE :</label>
							<input type="text" id="prime_coup" name="prime_coup" class="form-control shadow-none rounded" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="bareme_travaux"> Travaux :</label>
							<select name="travaux" id="bareme_travaux"  class="custom-select shadow-none form-control">
								<option value="" selected disabled>{{ __('Select') }}</option>
								 @foreach (\App\Models\CRM\TravauxList::all() as $travaux)
									 <option value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
								 @endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="barame_tag"> TAG :</label>
							<select name="tag" id="barame_tag"  class="custom-select shadow-none form-control">
								<option value="" selected disabled>{{ __('Select') }}</option>
								@foreach (\App\Models\CRM\TravauxTag::all() as $tag)
								<option value="{{ $tag->id }}">{{ $tag->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="barame_product"> Produits :</label>
							<select name="product[]" id="barame_product"  class="select2_select_option custom-select shadow-none form-control" multiple>
								  @foreach (\App\Models\CRM\Product::latest()->get() as $product)
									  <option value="{{ $product->id }}">{{ $product->reference }}</option>
								  @endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="form-label" for="include_price">{{ __('Inclure le prix dans les prestations') }} :</label>
							<select name="include_price" id="include_price"  class="custom-select shadow-none form-control">
								<option value="OUI">{{ __('OUI') }}</option>
								<option selected value="NON">{{ __('NON') }}</option>
							</select>
						</div>
						<div class="form-group d-flex">
							<label class="form-label" for="activeSwitch">{{ __('Activer') }} :</label>
							<div class="custom-control custom-switch ml-1">
								<input type="checkbox" name="active" value="yes" class="custom-control-input" id="activeSwitch">
								<label class="custom-control-label" for="activeSwitch"></label>
							</div>
						</div>

						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
					<h1 class="modal-title text-center my-5">{{ __('All Barèmes') }}</h1>
						<div class="col-12 px-3">
							<div class="database-table-wrapper bg-white border">
								<div class="table-responsive simple-bar">
									<table class="table database-table w-100 mb-0">
										<thead class="database-table__header">
											<tr>
												<th>{{ __('Serial') }}</th>
												<th>{{ __('Libellé') }}</th>
												<th>{{ __('Activer') }}</th>
												<th class="text-center">{{ __('Action') }}</th>
											</tr>
										</thead>
										<tbody class="database-table__body">
											@foreach (\App\Models\CRM\Scale::all() as $scale)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td>
													{{ $scale->wording }}
												</td>
												<td>
													@if ($scale->active == 'yes')
														<span class="text-success">&check;</span>
														@else
														<span class="text-danger">&times;</span>
													@endif

												</td>
												<td class="text-center">
													<div class="dropdown dropdown--custom p-0 d-inline-block">
														<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span class="novecologie-icon-dots-horizontal-triple"></span>
														</button>
														<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
															<button data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#BarèmesEditModal{{ $scale->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
																<span class="novecologie-icon-edit mr-1"></span>
																{{ __('Edit') }}
															</button>
															<form action="{{ route('scale.delete') }}" method="post">
																@csrf
																<input type="hidden" name="id" value="{{ $scale->id }}">
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
										</tbody>
									</table>
								</div>
							</div>
						</div>
				</div>
			</div>
			</div>
		</div>

		@foreach (\App\Models\CRM\Scale::all() as $scale)
			<div class="modal modal--aside fade leftAsideModal" id="BarèmesEditModal{{ $scale->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
				<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Nouvelle sous-opération') }}</h1>
						<form action="{{ route('scale.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<input type="hidden" name="id" value="{{ $scale->id }}">
							<div class="form-group">
								<label class="form-label" for="wording{{ $scale->id }}">{{ __('Libellé') }} :</label>
								<input type="text" id="wording{{ $scale->id }}" name="wording" class="form-control shadow-none rounded" value="{{ $scale->wording }}">
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>

							<div class="form-group">
								<label class="form-label" for="description{{ $scale->id }}">{{ __('Description') }} :</label>
								<textarea  id="description{{ $scale->id }}" name="description" class="form-control shadow-none rounded">{{ $scale->description }}</textarea>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="kwh_cumac{{ $scale->id }}">Kwh Cumac :</label>
								<input type="text" id="kwh_cumac{{ $scale->id }}" value="{{ $scale->kwh_cumac }}" name="kwh_cumac" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="prime_coup{{ $scale->id }}">Prime Coup de pouce CEE :</label>
								<input type="text" id="prime_coup{{ $scale->id }}" value="{{ $scale->prime_coup }}" name="prime_coup" class="form-control shadow-none rounded" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="bareme_travaux{{ $scale->id }}"> Travaux :</label>
								<select name="travaux" id="bareme_travaux{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option value="" selected disabled>{{ __('Select') }}</option>
									 @foreach (\App\Models\CRM\TravauxList::all() as $travaux)
										 <option {{ $scale->travaux == $travaux->id ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
									 @endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="barame_tag{{ $scale->id }}"> TAG :</label>
								<select name="tag" id="barame_tag{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option value="" selected disabled>{{ __('Select') }}</option>
									@foreach (\App\Models\CRM\TravauxTag::all() as $tag)
									<option {{ $scale->tag == $tag->id ? 'selected':'' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="barame_product{{ $scale->id }}"> Produits :</label>
								<select name="product[]" id="barame_product{{ $scale->id }}"  class="select2_select_option custom-select shadow-none form-control" multiple>
									  @foreach (\App\Models\CRM\Product::latest()->get() as $product)
										  <option {{ \App\Models\CRM\ScaleProduct::where('scale_id', $scale->id)->where('product_id', $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
									  @endforeach
								</select>
							</div>
							<div class="form-group">
								<label class="form-label" for="include_price{{ $scale->id }}">{{ __('Inclure le prix dans les prestations') }} :</label>
								<select name="include_price" id="include_price{{ $scale->id }}"  class="custom-select shadow-none form-control">
									<option @if ($scale->include_price == 'OUI')
										selected
									@endif value="OUI">{{ __('OUI') }}</option>
									<option @if ($scale->include_price == 'NON')
										selected
									@endif value="NON">{{ __('NON') }}</option>
								</select>
							</div>
							{{-- <div class="form-group">
								<label class="form-label" for="services">{{ __('Prestations concernées') }} :</label>
								<select name="services" id="services"  class="select2_select_option custom-select shadow-none form-control">
									<option value="item1">item1</option>
									<option value="item2">item2</option>
									<option value="item3">item3</option>
									<option value="item4">item4</option>
									<option value="item5">item5</option>
								</select>
							</div>  --}}
							<div class="form-group d-flex">
								<label class="form-label" for="activeSwitch{{ $scale->id }}">{{ __('Activer') }} :</label>
								<div class="custom-control custom-switch ml-1">
									<input type="checkbox" name="active" value="yes" class="custom-control-input" id="activeSwitch{{ $scale->id }}" @if ($scale->active == 'yes')
									checked
								@endif>
									<label class="custom-control-label" for="activeSwitch{{ $scale->id }}"></label>
								</div>
							</div>

							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
							</div>
						</form>
					</div>
				</div>
				</div>
			</div>
		@endforeach
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
					<textarea  class="form-control my-3" id="ko_raisons__input">{{ $lead->comment }}</textarea>
					<button id="ko_raisons__update" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2" type="button"> {{ __('Submit') }} </button>
				</div>
			</div>
			</div>
		</div>

		<!-- Left Aside Modal -->
		<div class="modal modal--aside fade" id="callBackModal" tabindex="-1" aria-labelledby="callBackModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
                    <h1 class="modal-title">Detail rappel @if ($primary_tax && $primary_tax->callback_time && \Carbon\Carbon::parse($primary_tax->callback_time) > \Carbon\Carbon::now()->addHour())
						<button type="button" id="callbackUpdateBtn" class="btn shadow-none p-0"><i class="bi bi-pencil"></i></button>
					@endif</h1>
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<form action="{{ route('lead.callback.setting') }}" method="POST">
					@csrf
					<div class="modal-body">
						@if ($primary_tax)
							<input type="hidden" name="tax_id" value="{{ $primary_tax->id }}">
						@endif
                        @if($primary_tax && $primary_tax->callback_time && \Carbon\Carbon::parse($primary_tax->callback_time) > \Carbon\Carbon::now()->addHour())
                            <table class="user-card__table" id="callbackInfoTable" style="display: block">
                                <tbody>
                                    <tr>
                                        <td class="user-card__table__heade position-relative">
                                            <i class="bi bi-calendar2-week mr-2"></i>
                                            Date
                                        </td>
                                        <td class="position-relative">{{ \Carbon\Carbon::parse($primary_tax->callback_time)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="user-card__table__heade position-relative">
                                            <i class="bi bi-alarm mr-2"></i>
                                            Horaire
                                        </td>
                                        <td class="position-relative">{{ \Carbon\Carbon::parse($primary_tax->callback_time)->format('h:i a') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="user-card__table__heade position-relative">
                                            <i class="bi bi-person mr-2"></i>
                                            Utilisateur
                                        </td>
                                        <td class="position-relative">{{ $primary_tax->callbackUser->name ?? ''  }}</td>
                                    </tr>
                                </tbody>
                            </table>
							<div class="row text-center" id="callbackInfoUpdateBlock" style="display: none">
								<div class="col-12 mb-3">
									<input type="datetime-local" min="{{ \Carbon\Carbon::now() }}" name="callback_time" class="flatpickr flatpickr-input form-control shadow-none" value="{{ \Carbon\Carbon::parse($primary_tax->callback_time)->format('Y-m-d h:i') }}" placeholder="JJ-MM-AAAA Heure:Minute" required>
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
									<input type="datetime-local" min="{{ \Carbon\Carbon::now() }}" name="callback_time" class="flatpickr flatpickr-input form-control shadow-none" placeholder="JJ-MM-AAAA Heure:Minute" required>
								</div>
								<div class="col-12">
									<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2" type="button"> {{ __('Submit') }} </button>
								</div>
							</div>
						@endif
					</div>
				</form>
			</div>
			</div>
		</div>

		{{-- product modal  --}}
		<div class="modal modal--aside fade leftAsideModal" id="produitsCreateModal" tabindex="-1" aria-labelledby="produitsCreateModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body mr-2">
					<h1 class="modal-title text-center mb-5">{{ __('Nouveau Produit') }}</h1>
					<form action="{{ route('product.store') }}" class="form" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Type isolant/ Produit :</label>
									<input type="text" name="product_type" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Catégorie : <span class="text-danger">*</span></label>
									<select class="select2_select_option form-control" name="category_id" required>
										@foreach (\App\Models\CRM\Category::all() as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Marque : <span class="text-danger">*</span></label>
									<select class="select2_select_option form-control" name="marque_id" required>
										@foreach (\App\Models\Brand::all() as $marque)
											<option value="{{ $marque->id }}"> {{ $marque->description }} </option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Sous-Catégorie : <span class="text-danger">*</span></label>
									<select class="select2_select_option form-control" name="subcategory_id" required>
										@foreach (\App\Models\CRM\Subcategory::all() as $sub_cat)
											<option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Référence : <span class="text-danger">*</span></label>
									<input type="text" name="reference" class="form-control shadow-none rounded" required>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="form-group">
									<label for="#">Norme  :</label>
									<input type="text" name="standard" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group">
									<label for="#">Designation :<span class="text-danger">*</span></label>
									<textarea class="form-control shadow-none rounded" name="designation" rows="3" required></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<div class="form-group">
									<label for="#">Note de dimensionnement :</label>
									<textarea class="form-control shadow-none rounded"  name="sizing_note" rows="3"></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Acermi :</label>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="text" placeholder="Référence" name="acermi_reference" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="date" name="acermi_date" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="input-group mb-3">
									<div class="custom-file">
										<input type="file" name="acermi_file" class="custom-file-input form-control" id="inputGroupFile02">
										<label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Certita :</label>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="text" placeholder="Référence" name="certita_reference" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="form-group">
									<input type="date" name="certita_date" class="form-control shadow-none rounded">
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="input-group mb-3">
									<div class="custom-file">
										<input type="file" name="certita_file" class="custom-file-input form-control" id="inputGroupFile03">
										<label class="custom-file-label" for="inputGroupFile03" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Avis technique :</label>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<input type="text" name="notice_reference" class="form-control shadow-none rounded" placeholder="Référence">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<input type="date" name="notice_date" class="form-control shadow-none rounded" placeholder="Date de Validité">
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="input-group mb-3">
									<div class="custom-file">
										<input type="file" name="notice_file" class="custom-file-input form-control" id="inputGroupFile04">
										<label class="custom-file-label" for="inputGroupFile04" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Fiche Technique :</label>
							</div>
							<div class="col-lg-8 col-md-9 col-sm-8">
								<div class="input-group mb-3">
									<div class="custom-file">
										<input type="file" name="data_file" class="custom-file-input form-control" id="inputGroupFile05">
										<label class="custom-file-label" for="inputGroupFile05" aria-describedby="inputGroupFileAddon02">Choose file</label>
									</div>
									</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="switches d-flex">
									<label for="customSwitch43">Marquage CE :</label>
									<div class="custom-control custom-switch ml-4">
										<input type="checkbox" name="ce_marking" class="custom-control-input" id="customSwitch43">
										<label class="custom-control-label" for="customSwitch43"></label>
										</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 .col-sm-6">
								<div class="switches d-flex">
									<label for="customSwitch44">Activer :</label>
									<div class="custom-contro2 custom-switch ml-4">
										<input type="checkbox" name="activate" class="custom-control-input" id="customSwitch44" checked>
										<label class="custom-control-label" for="customSwitch44"></label>
										</div>
								</div>
							</div>
						</div>
						<div class="row">
							{{-- <div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Barèmes concernés en B2C :</label>
								<select name="baremes[]" class="select2_select_option custom-select shadow-none form-control" multiple>
									@foreach (\App\Models\CRM\Scale::where('active', 'yes')->get() as $scale)
									<option value="{{ $scale->id }}">{{ $scale->wording }}</option>
									@endforeach
								</select>
							</div> --}}
							<div class="col-12">
								<label for="#">tags : <span class="text-danger">*</span></label>
								<select name="tags[]" class="select2_select_option custom-select shadow-none form-control" multiple required>
									@foreach (\App\Models\CRM\TravauxTag::all() as $tag)
									<option value="{{ $tag->id }}">{{ $tag->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Mode de Pose :</label>
								<select class="select2_select_option form-control" name="installation_mode" required>
									<option value="Soufflé">Soufflé</option>
									<option value="Deroulé">Deroulé</option>
								</select>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Cap. de couverture :</label>
								<div class="input-group">
									<input type="number" class="form-control" name="covering_capacity" aria-label="Dollar amount (with dot and two decimal places)">
									<div class="input-group-append">
										<span class="input-group-text">m2</span>
									</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Epaisseur :</label>
								<div class="input-group">
									<input type="text" class="form-control" name="thikness" aria-label="Dollar amount (with dot and two decimal places)">
									<div class="input-group-append">
										<span class="input-group-text">mm</span>
									</div>
									</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label for="#">Rés. thermique 1 :</label>
								<div class="input-group">
									<input type="text" class="form-control" name="thermal_res" aria-label="Dollar amount (with dot and two decimal places)">
									<div class="input-group-append">
										<span class="input-group-text">m².K/W</span>
									</div>
									</div>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 mt-4">
								<div class="form_submit_btn text-right">
									<button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
									<button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
								</div>
						</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>

		<div class="modal modal--aside fade leftAsideModal" id="addFinancement" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Financement') }}</h1>
                    <form action="{{ route('project.status.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="hidden" name="name" value="Financement">
                            <input type="hidden" name="x_id" id="xProjectId">
                            <input type="text" id="xProjectStatus" name="status" class="form-control shadow-none rounded" placeholder="{{ __('Enter Financement') }}" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" id="xProjectUpdateBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
                        </div>
                    </form>
                    <h1 class="modal-title text-center my-5">{{ __('All Financement') }}</h1>
                    <div class="col-12 px-3">
                        <div class="database-table-wrapper bg-white border">
                            <div class="table-responsive simple-bar">
                                <table class="table database-table w-100 mb-0">
                                    <thead class="database-table__header">
                                        <tr>
                                            <th>{{ __('Serial') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th class="text-center">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="database-table__body">
                                        @foreach (getProjectStatus('Financement') as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td id="projectStatus{{ $item->id }}">{{ $item->status }}</td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                            <button data-id="{{ $item->id }}" data-status="{{ $item->status }}" type="button" class="dropdown-item border-0 editProjectStatus">
                                                                <span class="novecologie-icon-edit mr-1"></span>
                                                                {{ __('Edit') }}
                                                            </button>
                                                            <form action="{{ route('project.status.delete') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
				<div class="modal-body text-center">
					<h1 class="modal-title mb-5">{{ __('Choose a status') }}</h1>
					{{-- <button class="primary-btn primary-btn--purple primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('Current lead') }}</button> --}}
					<button id="preValidateBtn" class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('Pre-validated lead') }}</button>
					<button id="leadVerifyBtn" class="primary-btn primary-btn--sky primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('Verified lead') }} </button>
				</div>
			</div>
			</div>
		</div>

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
						<h1 class="modal-title text-center">{{ __('Mandatory Step') }}</h1>
						<p class="modal-text text-center mb-5">{{ __('Please validate the client\'s project') }}</p>
						<form action="#!" class="form" id="clientsValidateForm">
							<h2 class="modal-sub-title position-relative mb-5">{{ __('Type of Project') }}</h2>
							<div class="row mb-5">
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" class="custom-control-input" name="project_name_m" value="Pellet boiler" id="projectTypeFormCheck-1"
										@if ( $lead->project_name == 'Pellet boiler')
										checked
										@endif>
										<label class="custom-control-label" for="projectTypeFormCheck-1"> {{ __('Pellet boiler') }}</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" class="custom-control-input" name="project_name_m" value="Heat pump" id="projectTypeFormCheck-2"
										@if ( $lead->project_name == 'Heat pump')
										checked
										@endif>
										<label class="custom-control-label" for="projectTypeFormCheck-2"> {{ __('Heat pump') }}</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" class="custom-control-input" name="project_name_m" value="Isolation" id="projectTypeFormCheck-3"
										@if ( $lead->project_name == 'Isolation')
										checked
										@endif>
										<label class="custom-control-label" for="projectTypeFormCheck-3"> {{ __('Isolation') }}</label>
									</div>
								</div>
							</div>
							<h2 class="modal-sub-title position-relative mb-5">{{ __('Funding') }}</h2>
							<div class="row">
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" name="funding" value="Housing action" class="custom-control-input" id="fundingFormCheck-1">
										<label class="custom-control-label" for="fundingFormCheck-1"> {{ __('Housing action') }}</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" name="funding" value="MPR" class="custom-control-input" id="fundingFormCheck-2">
										<label class="custom-control-label" for="fundingFormCheck-2"> {{ __('MPR') }}</label>
									</div>
								</div>
								<div class="col-12 text-center">
									<button id="leadToCustomer" type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
										{{ __('Verify') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal modal--aside fade leftAsideModal" id="travauxProductModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Produits') }}</h1>
					<form action="{{ route('travaux.product.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label" for="travaux">{{ __('Travaux') }} <span class="text-danger">*</span></label>
							<select name="travaux" id="travaux2"  class="select2_select_option custom-select shadow-none form-control" required>
								<option value="">{{ __('Select Travaux') }}</option>
								<option value="Chaudière à Granules">{{ __('Chaudière à Granules') }}</option>
								<option value="Ballon thermodynamique">{{ __('Ballon thermodynamique') }}</option>
								<option value="Ballon solaire">{{ __('Ballon solaire') }}</option>
								<option value="Pompe à chaleur Air/Eau">{{ __('Pompe à chaleur Air/Eau') }}</option>
								<option value="Pompe à chaleur Air/Air">{{ __('Pompe à chaleur Air/Air') }}</option>
								<option value="Isolation Interieur - 101">{{ __('Isolation Interieur - 101') }}</option>
								<option value="Isolation Interieur - 102">{{ __('Isolation Interieur - 102') }}</option>
								<option value="Isolation Interieur - 103">{{ __('Isolation Interieur - 103') }}</option>
								<option value="Isolation Thermique par l'exterieur">{{ __('Isolation Thermique par l exterieur') }}</option>
								<option value="Poèle à Granulés">{{ __('Poèle à Granulés') }}</option>
								<option value="VMC Double Flux">{{ __('VMC Double Flux') }}</option>
								<option value="Panneaux solaire">{{ __('Panneaux solaire') }}</option>
							</select>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group">
							<label class="form-label" for="travaux">{{ __('Produits') }} <span class="text-danger">*</span></label>
							<input type="text" id="xtravaux_product_Status" name="product" class="form-control shadow-none rounded" placeholder="{{ __('Enter Produit') }}" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div>
						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" id="xtravaux_product_UpdateBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
						</div>
					</form>
					<h1 class="modal-title text-center my-5">{{ __('All Produits') }}</h1>
					<div class="col-12 px-3">
						<div class="database-table-wrapper bg-white border">
							<div class="table-responsive simple-bar">
								<table class="table database-table w-100 mb-0">
									<thead class="database-table__header">
										<tr>
											<th>{{ __('Serial') }}</th>
											<th>{{ __('Travaux') }}</th>
											<th>{{ __('Produits') }}</th>
											<th class="text-center">{{ __('Action') }}</th>
										</tr>
									</thead>
									<tbody class="database-table__body">
										@foreach (getTravauxProduct() as $item)
											<tr>
												<td>{{ $loop->iteration }}</td>
												<td id="project_travaux{{ $item->id }}">{{ $item->travaux }}</td>
												<td id="travaux_product{{ $item->id }}">{{ $item->product }}</td>
												<td class="text-center">
													<div class="dropdown dropdown--custom p-0 d-inline-block">
														<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<span class="novecologie-icon-dots-horizontal-triple"></span>
														</button>
														<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
															{{-- <button data-id="{{ $item->id }}" data-status="{{ $item->status }}" type="button" class="dropdown-item border-0 editProjectStatus">
																<span class="novecologie-icon-edit mr-1"></span>
																{{ __('Edit') }}
															</button>  --}}
															<form action="{{ route('travaux.product.delete') }}" method="POST">
																@csrf
																<input type="hidden" name="id" value="{{ $item->id }}">
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
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>

		{{-- Custom field  --}}
		<div class="modal modal--aside fade leftAsideModal" id="customTabDataField" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Custom Tab Field') }}</h1>
					<form action="{{ route('lead.custom.field.store') }}" class="form mx-auto needs-validation"  novalidate method="POST">
						@csrf
						<div class="form-group d-flex flex-column align-items-center position-relative">
						</div>
						<div id="CustomTabInput">
							<div class="form-group">
								<label class="form-label" for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
								<input type="text" name="title[]" id="title" class="form-control shadow-none" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label class="form-label" for="input_type">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
								<select name="input_type[]" id="input_type2"  class="select2_select_option custom-select shadow-none form-control">
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
								<label class="form-label" for="options">{{ __('Options') }} <span class="text-danger">*</span></label>
								<textarea name="options[]" id="options" class="form-control shadow-none" placeholder="Enter Options. Each option seperate with comma ','"></textarea>
							</div>
						</div>
						<div class="form-group d-flex flex-column align-items-center mt-4">
							<button type="submit" id="xProjectUpdateBtn4" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
							<button type="button" class="secondary-btn secondary-btn--cuccess primary-btn--lg rounded border-0 mb-3" id="add_more_custom_field_input_btn">{{ __('Add More') }}</button>
						</div>
					</form>
					<h1 class="modal-title text-center my-5">{{ __('Custom Tab Field') }}</h1>
					<div class="col-12 px-3">
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
									<tbody class="database-table__body">
										@forelse ($inputs as $input)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $input->title }}</td>
											<td>
												@if ($input->input_type == 'text')
												{{ __('Text') }}
												@elseif ($input->input_type == 'date')
												{{ __('Date') }}
												@elseif ($input->input_type == 'number')
												{{ __('Number') }}
												@elseif ($input->input_type == 'email')
												{{ __('Email') }}
												@elseif ($input->input_type == 'radio')
												{{ __('Radio') }}
												@elseif ($input->input_type == 'checkbox')
												{{ __('Checkbox') }}
												@elseif ($input->input_type == 'select')
												{{ __('Dropdown') }}
												@else
												{{ __('Textarea') }}
												@endif
											</td>
											{{-- <td>{{ $input->options }}</td> --}}
											<td class="text-center">
												<div class="dropdown dropdown--custom p-0 d-inline-block">
													<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span class="novecologie-icon-dots-horizontal-triple"></span>
													</button>
													<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
														<form action="{{ route('lead.custom.field.delete') }}" method="post">
															@csrf
															<input type="hidden" name="input_id" value="{{ $input->id }}">
															<button type="submit" class="dropdown-item border-0">
																<span class="novecologie-icon-trash mr-1"></span>
																{{ __('Delete') }}
															</button>
														</form>
													</div>
												</div>
											</td>
										</tr>
										@empty
										<tr>
											<td  class="text-center" colspan="5">{{ __('No Field Found') }}</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<div class="modal modal--aside fade" id="taxErrorAlert" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Problème de recupération des avis fiscaux : <span class="notice__number_text"></span>, Voulez-vous quand même passer à l'étape suivante?</span>
						<div class="d-flex justify-content-center">
							<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
								Non
							</button>
							<button type="button" id="customTaxValidate" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
								Oui
							</button>
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
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($telecommercials as $user)
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
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($lead_sub_status as $sub_status)
											<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
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
						<form action="{{ route('lead.to.client') }}" method="POST" class="status_change__modal">
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
									<label class="form-label" for="user_assigne_id">Pouvez vous nommer un télécommercial pour ce nouveau projet ? </label>
									<select name="user_id" id="user_assigne_id"  class="custom-select shadow-none form-control">
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($telecommercials as $telecommercial)
											<option value="{{ $telecommercial->id }}">{{ $telecommercial->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group text-left mt-3">
									<label class="form-label" for="gestionnaire_id">Pouvez vous nommer un gestionnaire pour ce nouveau projet ?</label>
									<select name="gestionnaire_id" id="gestionnaire_id"  class="custom-select shadow-none form-control">
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($gestionnaires as $gestionnaire)
											<option value="{{ $gestionnaire->id }}">{{ $gestionnaire->name }}</option>
										@endforeach
									</select>
								</div>
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
									{{ __('Submit') }}
								</button>
							</div>
						</form>
					</div>
					{{-- <div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Souhaitez vous valider la transformation du prospect en client</span>
						<form action="{{ route('lead.to.client') }}" method="POST" class="status_change__modal">
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
									<label class="form-label" for="gestionnaire_id">Merci de nommer un gestionnaire pour ce projet</label>
									<select name="user_id" id="gestionnaire_id"  class="custom-select shadow-none form-control" required>
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($gestionnaires as $gestionnaire)
											<option value="{{ $gestionnaire->id }}">{{ $gestionnaire->name }}</option>
										@endforeach
									</select>
								</div>
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
									{{ __('Submit') }}
								</button>
							</div>
						</form>
					</div> --}}
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
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($lead_sub_status as $sub_status)
											<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
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
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($lead_sub_status as $sub_status)
											<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
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
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($lead_sub_status as $sub_status)
											<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label class="form-label" for="dead-reason">Raisons <span class="text-danger">*</span></label>
									<textarea rows="3" name="dead_reason" id="dead-reason" class="form-control shadow-none" required></textarea>
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
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($lead_sub_status as $sub_status)
											<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
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
							<input type="hidden" name="status" value="{{ $lead->user_status }}">
							<div class="status_change__input text-left">
								<div class="form-group text-left mt-3">
									<label class="form-label" for="lead_sub__staus">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_sub__staus" class="select2_select_option custom-select shadow-none form-control">
										<option value="" selected disabled>{{ __('Select') }}</option>
										@foreach ($lead_sub_status as $sub_status)
											<option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
										@endforeach
									</select>
								</div>
								@if ($lead->user_status == 5)
									<div class="form-group">
										<label class="form-label" for="dead-reason">Raisons <span class="text-danger">*</span></label>
										<textarea rows="3" name="dead_reason"  id="dead-reason" class="form-control shadow-none" required>{{ $lead->comment }}</textarea>
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
@endsection
@isset($leads)
		<script> var lead_id = "{{ $leads->id }}"; </script>
@endisset

@push('js')

<script>
	$(document).ready(function () {

		$('body').on('change', '#children__status', function(){ 
			 $('#children__status_wrap').slideToggle();
		});
		$('body').on('click', '#callbackUpdateBtn', function(){ 
			 $('#callbackInfoTable').slideUp();
			$('#callbackInfoUpdateBlock').slideDown();
		});
		$('body').on('click', '#callbackBlockCloseBtn', function(){ 
			$('#callbackInfoUpdateBlock').slideUp();
			$('#callbackInfoTable').slideDown();
		});

		$('body').on('click', '.house_owner_property_tax_status', function(){ 
			$.ajax({
				type : "POST",
				url  : "{{ route('lead.fiscal.status.change') }}",
				data : {
					tax_id	: $(this).data('id'),
					field 	: $(this).data('field'), 
					status  : $(this).is(':checked') ? 'yes':'no'
				}, 
				success : response  => {
					$('#successMessage').text(response);
					$('.toast.toast--success').toast('show');
				}
			});
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
		$('body').on('change','#personne_1', function(){
			 $('.personne_1_title').text($(this).val());
			 $('#personne_1_wrap').slideDown();
		});

		$('body').on('change','#personne_2', function(){
			 $('.personne_2_title').text($(this).val());
			 $('#personne_2_wrap').slideDown();
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
		$('#commentStore').click(function(e){
            e.preventDefault();
            var data = $('#lead_comment').val();
            var category = $('#comment_category').val();
            if(data.trim()== ''){
                $('#errorMessage').html("{{ __('Write your response') }}");
                $('.toast.toast--error').toast('show');
                $('#lead_comment').focus();
			}else if(!category){
                $('#errorMessage').html("{{ __('Please Select Category') }}");
                $('.toast.toast--error').toast('show');
                $('#comment_category').focus();
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
					success: function(data){
						$('#commentStoreForm').trigger('reset');
                        $('#lead_comments').html(data.comment);
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');
					},
				});
            }
        });

		$('.edit-toggler--lock__access').click(function(){
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
                    $('#activity_log_wrap').html(response)
                }

            })
        });

		$('#supplementaryInput').click(function(){
			if(this.checked){
				$("#supplementary").slideDown();
			}else{
				$("#supplementary").slideUp();
			}
		});
		$('#heatingGeneratorInput').click(function(){
			if(this.checked){
				$("#heatingGenerator").slideDown();
			}else{
				$("#heatingGenerator").slideUp();
			}
		});
	});
</script>

<script>


	// (function(){
	// 	mapboxgl.accessToken = 'pk.eyJ1IjoiZGV2ZWxvcGVyLXphaGlkIiwiYSI6ImNreDY3Ym93aDBuOXEycHF1Mjc2N3cxY2wifQ.9EyRPzKr0dB9bWghzGNK-g';
	// 		const geocoder = new MapboxGeocoder({
	// 		accessToken: mapboxgl.accessToken,
	// 		types: 'country,region,place,postcode,locality,neighborhood'
	// 	});
	// 	geocoder.addTo('#geocoder');
	// 	geocoder.on('result', function(e) {
	// 		$('#setAddressLatValue').val(e.result.center[1]);
	// 		$('#setAddressLngValue').val(e.result.center[0]);
	// 		$('#setAddressName').val(e.result.html);
	// 		$('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').removeClass('invalid_input');
    //         $('.location_alert_message').addClass('d-none');
	// 	});
	// 	geocoder.on('clear', function() {
	// 		$('#setAddressLatValue').val("");
	// 		$('#setAddressLngValue').val("");
	// 		$('#setAddressName').val("");
	// 	});
	// })();


	$(document).ready(function(){

		// Family Situation
		@if (session('custom_field_tab_active'))
            $('#v-pills-custom-field-tab').addClass('active');
            $('#v-pills-custom-field').addClass('show active');
			// $('#leadCardCollapse-custom_field').addClass('show');
		@elseif(session('scale_active') || session('produits_tab_active'))
            $('#v-pills-2-tab').addClass('active');
            $('#v-pills-2').addClass('show active');
			// $('#leadCardCollapse-8').collapse('show');
		@elseif(session('question_save'))
            $('#v-pills-2-tab').addClass('active');
            $('#v-pills-2').addClass('show active');
			// $('#leadCardCollapse-9').collapse('show');
			// $('#BarèmesModal').modal('show');
		@else
			$('#v-pills-3-tab').addClass('active');
            $('#v-pills-3').addClass('show active');
			// $('#leadCardCollapse-1').addClass('show');
		@endif

		// Map Code
		// $(".mapboxgl-ctrl-geocoder").addClass("dropdown");
		// $(".mapboxgl-ctrl-geocoder--input").addClass("dropdown-toggle");
		// $(".mapboxgl-ctrl-geocoder--input").val("{{ $lead->present_address }}");
		// $(".mapboxgl-ctrl-geocoder--input").attr({
		// 	id: "company_address",
		// 	name: "company_address",
		// 	autocomplete: "off",
		// 	"data-toggle":"dropdown",
		// 	"aria-haspopup":"true",
		// 	"aria-expanded":"false",
		// 	"data-offset":"0, 10"
		// });
		// $(".mapboxgl-ctrl-geocoder--input").keydown(function(){
		// 	$(this).dropdown('show');
		// });
		// $(".mapboxgl-ctrl-geocoder--input").blur(function(){
		// 	$(this).dropdown('hide');
		// });
		// $(".mapboxgl-ctrl-geocoder .suggestions-wrapper .suggestions").addClass("dropdown-menu");
		// $(".mapboxgl-ctrl-geocoder .suggestions-wrapper .suggestions").attr("aria-labelledby","company_address");

		// Map Code End

		@if($lead->hot_water_production == 'Instantanné')
		$('#accumulation').hide();

		@elseif($lead->hot_water_production == 'Accumulation')
		$('#instant').hide();
		@else
		$('#instant').hide();
		$('#accumulation').hide();
		@endif


		var number = $('#notice_number').val();
		var company_id = "{{ $company->id }}";

		// Profile image update
		$('#edit-image').change(function(e){

			 $('#profile-form').submit();

		});

		// Add New Text Item
		$('body').on('click', '#addTextItem',function(){
			if($('#existingAddMore').val() == 'exist'){
				$('#errorMessage').html("{{ __('please complete open fiscal information first') }}");
				$('.toast.toast--error').toast('show');
				exit();
			}
			var item = '<div class="col-12 mb-4 tax__row" style="display:none;"> <div class="row align-items-center"> <div class="col-lg-auto"> <h4 class="mb-lg-0 font-weight-bold notice__number">{{ __("Notice") }} '+ number+'</h4> </div> <div class="col-lg-4 col-md-6"> <div class="form-group mb-lg-0"> <input type="hidden" id="existingAddMore" value="exist"> <input type="text" name="tax_number" class="form-control shadow-none" placeholder="{{ __("Fiscal number") }} *"  id="tax_number"> </div> </div> <div class="col-lg-4 col-md-6"> <div class="form-group mb-lg-0"> <input type="hidden" name="tax_id" id="tax_id", value="0"> <input type="text" name="tax_reference" id="tax_reference" class="form-control shadow-none" placeholder="{{ __("Reference notice") }} *"> </div> </div> <div class="col-lg-auto"> <button type="button" class="remove-btn btn__tax_item d-inline-flex align-items-center justify-content-center button">&times;</button> </div>  </div> </div>';

			$('#taxWrapperId').append(item);
			$('.tax__row').slideDown();
			number ++;
		});

		$('body').on('click', '.btn__tax_item', function(){
			number --;
			$(this).closest('.tax__row').slideUp("normal", function() { $(this).remove(); } );
		});

		$('#taxValidate').click(function(){

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
			else{

				if(tax_number == '0000000000' && tax_reference == '0000000000'){
					$('.notice__number_text').text($('.notice__number').text());
					$('#taxErrorAlert').modal('show');
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
							$('#taxWrapperId').html(data.all_tax);
							$('.collapseRow').show();
							$('#notificationCount').text(data.count);
							$('#notificationList').html(data.response);
							$('#activity_log_wrap').html(data.log);

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
							// location.reload();
							}
						},
						error : errors => {
							$("#tax__card__btn").removeClass("d-none");
							$("#tax__card__loader").addClass("d-none");
						}

					});
				}
			}
		});
		$('#customTaxValidate').click(function(){
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
							$('#taxWrapperId').html(data.all_tax);
							$('.collapseRow').show();
							$('#notificationCount').text(data.count);
							$('#notificationList').html(data.response);

							$('#successMessage').html(data.alert);
							$('.toast.toast--success').toast('show');
							$('#activity_log_wrap').html(data.log);
							// $('#leadCardCollapse-4').collapse('show');
							// $('#info-verify').addClass('verified');
							$('#tax-verify').addClass('verified');
							$("#tax__card__btn").removeClass("d-none");
							$("#tax__card__loader").addClass("d-none");
							if($('#tax-verify').hasClass('verified') && $('#info-verify').hasClass('verified') && $('#work-verify').hasClass('verified')){
								$('#personal_information_tab').addClass('verified');
							}
						}
					},

				});
			// }
		});

		$('#presentWorkValidate').click(function(e){
			// if(!$('#project-verify').hasClass('verified'))
			// 	{
			// 		$('#leadCardCollapse-2').addClass('show');
			// 		$('#errorMessage').html('Select a project to proceed');
			// 		$('.toast.toast--error').toast('show');
			// 		exit();
			// 	}


			e.preventDefault();
			 var lead_id 					= $('#lead_id');
			//  var project_name	 			= $('#project_name');
			//  var address 					= $('#address');
			//  var present_address 			= $('#setAddressName');
			//  var address_lat 				= $('#setAddressLatValue');
			//  var address_lng 				= $('#setAddressLngValue');
			var heating_type 				= $('#heating_type');
			 var date_fo_construction 		= $('#date_fo_construction');
			 var living_area 				= $('#hidden_living_area');
			 var annual_heating 			= $('#hidden_annual_heating');
			 var Surface_à_chauffer 		= $('#hidden_Surface_à_chauffer');
			 var Merci_de_précisez 		    = $('#Merci_de_précisez');
			 var autre_field__transmitter_type 		    = $('#autre_field__transmitter_type');
			 var annual_heating2 			= $('#annual_heating2');
			 var with_basement 			    = $('#with_basement');
			 if($('#supplementaryInput').is(':checked')){
				 var supplementary = 'yes';
			}else{
				 var supplementary = 'no';
			 }
			 //  var auxiliary_heating 			= $('input[name="auxiliary_heating"]:checked');
			 var specify_heating 			= $('input[name="specify_heating[]"]:checked');

			 if($('#heatingGeneratorInput').is(':checked')){
			 	var heating_generator = 'yes';
			}else{
				 var heating_generator = 'no';
			 }
			 var second_heating_type 		= $('input[name="second_heating_type[]"]:checked');
			 var other_second_heating_type  = $('#other_second_heating_type');
			 var transmitter_type 			= $('input[name="transmitter_type[]"]:checked');
			 var number_of_radiator 		= $('#number_of_radiator');
			 var radiator_type 				= $('input[name="radiator_type[]"]:checked');
			 var other_radiator_type 		= $('#other_radiator_type');
			 var hot_water_production 		= $('#hot_water_production');
			 var hot_water_feature 			= $('input[name="hot_water_feature[]"]:checked');
			 var volume 					= $('#volume');
			 var ovservations 			    = $('#ovservations');

			//  if(project_name.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Nom du projet') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	project_name.focus();
			// }
			//  else if(address.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Même adresse') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	address.focus();
			// }
			//  else if(present_address.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Nouvelle adresse') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	present_address.focus();
			// }
			if(date_fo_construction.val() == ''){
				$('#errorMessage').html("{{ __('Please Select Date construction maison') }}");
				$('.toast.toast--error').toast('show');
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified');
				date_fo_construction.focus();
			}

			else if(living_area.val() == ''){
				$('#errorMessage').html("{{ __('Please Enter Surface habitable') }}");
				$('.toast.toast--error').toast('show');
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified');
				$('#living_area').focus();
			}
			else if(annual_heating.val() == ''){
				$('#errorMessage').html("{{ __('Please Enter Consommation chauffage Annuel') }}");
				$('.toast.toast--error').toast('show');
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified');
				$('#annual_heating').focus();
			}

			// else if(annual_heating2.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Consommation chauffage Annuel') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	$('#annual_heating2').focus();
			// }

			// else if(auxiliary_heating.length == 0){

			// 	$('#errorMessage').html("{{ __('Please Select Chauffage dappoint') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	auxiliary_heating.focus();
			// }

			// else if(specify_heating.length == 0){
			// 	$('#errorMessage').html("{{ __('Please Select Precisez le chauffage d appoint') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	specify_heating.focus();
			// }

			// else if(second_heating_type.length == 0 && other_second_heating_type.val() == ''){

			// 		$('#errorMessage').html("{{ __('Please Select Second mode de chauffage') }}");
			// 		$('.toast.toast--error').toast('show');
			// 		$('#presentWorkValidate').attr('data-toggle', false);
			// 		$('#present-work-verify').removeClass('verified');
			// 		second_heating_type.focus();

			// }
			// else if(transmitter_type.length == 0){
			// 	$('#errorMessage').html("{{ __('Please Select Type démetteur') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	transmitter_type.focus();
			// }
			// else if(number_of_radiator.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Nombre de radiateur') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	number_of_radiator.focus();
			// }

			// else if(radiator_type.length == 0 && other_radiator_type.val() == ''){

			// 	$('#errorMessage').html("{{ __('Please Select Type de radiateur') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	radiator_type.focus();

			// }
			else if(hot_water_production.val() == ''){
				$('#errorMessage').html("{{ __('Please Select Production deau chaude sanitaire') }}");
				$('.toast.toast--error').toast('show');
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified');
				hot_water_production.focus();
			}
			else if(hot_water_feature.length == 0){
				$('#errorMessage').html("{{ __('Please Select Any Production deau chaude sanitaire') }}");
				$('.toast.toast--error').toast('show');
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified');
				hot_water_feature.focus();
			}
			// else if(volume.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Volume Ballon Eau chaude') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#presentWorkValidate').attr('data-toggle', false);
			// 	$('#present-work-verify').removeClass('verified');
			// 	volume.focus();
			// }
			else{
				var specify_heating_data = '';
				var second_heating_type_data = '';
				var transmitter_type_data = '';
				var radiator_type_data = '';
				var hot_water_feature_data = '';

			 	$.each(specify_heating, function (indexInArray, valueOfElement) {
					specify_heating_data += $(this).val() + ',';
				});
			 	$.each(second_heating_type, function (indexInArray, valueOfElement) {
					second_heating_type_data += $(this).val() + ',';
				});
			 	$.each(transmitter_type, function (indexInArray, valueOfElement) {
					transmitter_type_data += $(this).val() + ',';
				});
			 	$.each(radiator_type, function (indexInArray, valueOfElement) {
					radiator_type_data += $(this).val() + ',';
				});
			 	$.each(hot_water_feature, function (indexInArray, valueOfElement) {
					hot_water_feature_data += $(this).val() + ',';
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
						lead_id 					: lead_id.val(),
						// project_name				: project_name.val(),
						// address						: address.val(),
						// present_address				: present_address.val(),
						// address_lat					: address_lat.val(),
						// address_lng					: address_lng.val(),
						heating_type				: heating_type.val(),
						date_fo_construction		: date_fo_construction.val(),
						living_area					: living_area.val(),
						annual_heating				: annual_heating.val(),
						Surface_à_chauffer			: Surface_à_chauffer.val(),
						Merci_de_précisez			: Merci_de_précisez.val(),
						autre_field__transmitter_type: autre_field__transmitter_type.val(),
						annual_heating2				: annual_heating2.val(),
						with_basement				: with_basement.val(),
						supplementary				: supplementary,
						heating_generator			: heating_generator,
						// auxiliary_heating			: auxiliary_heating.val(),
						specify_heating				: specify_heating_data,
						other_heating				: $('#other_heating').val(),
						second_heating_type			: second_heating_type_data,
						other_second_heating_type	: other_second_heating_type.val(),
						transmitter_type			: transmitter_type_data,
						number_of_radiator			: number_of_radiator.val(),
						radiator_type				: radiator_type_data,
						other_radiator_type			: other_radiator_type.val(),
						hot_water_production		: hot_water_production.val(),
						hot_water_feature			: hot_water_feature_data,
						volume						: volume.val(),
						ovservations				: ovservations.val(),
						radiatuers_Aluminium		: $("#radiatuers_Aluminium").is(":checked")?'yes':'no',
						radiatuers_Aluminium_Nombre	: $("#radiatuers_Aluminium_Nombre").val(),
						radiatuers_Fonte			: $("#radiatuers_Fonte").is(":checked")?'yes':'no',
						radiatuers_Fonte_Nombre		: $("#radiatuers_Fonte_Nombre").val(),
						radiatuers_Acier			: $("#radiatuers_Acier").is(":checked")?'yes':'no',
						radiatuers_Acier_Nombre		: $("#radiatuers_Acier_Nombre").val(),
						radiatuers_Autre			: $("#radiatuers_Autre").is(":checked")?'yes':'no',
						radiatuers_Autre_Nombre		: $("#radiatuers_Autre_Nombre").val(),
						autre_field__radiatuers		: $("#autre_field__radiatuers").val(),
						Type_du_courant_du_logement	: $("#Type_du_courant_du_logement").val(),
						le_logement					: $("#le_logement").is(":checked")?'yes':'no',

					},

					success: function(data){
						// $('#leadCardCollapse-6').collapse('hide');
						// $('#leadCardCollapse-7').collapse('show');
						$('#activity_log_wrap').html(data.log);
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');
						// console.log(data);
					},

				});
			}
		});
		$('#workValidate').click(function(e){
			// if(!$('#tax-verify').hasClass('verified'))
			// 	{
			// 		$('#leadCardCollapse-2').addClass('show');
			// 		$('#errorMessage').html('Please Enter ');
			// 		$('.toast.toast--error').toast('show');
			// 		exit();
			// 	}

			e.preventDefault();
			 var lead_id 				= $('#lead_id');
			//  var heatingType 			= $('#heatingType');
			//  var natureOccupation 		= $('#natureOccupation');
			 var occupation_type 		= $('#occupation_type');
			 var cadstrablePlot  		= $('#cadstrablePlot');
			 var foyer 					= $('#foyer');
			 var house_over_15_years 	= $('#house_over_15_years');
			 var fiscal_amount 			= $('#fiscal_amount').val();
			 var family_person 			= $('#family_person').val();
			 var zone 					= $('#zone_data').val();
			 var precariousness 		= $('#precariousness').val();

			//  if(heatingType.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Select Heating Type') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#workValidate').attr('data-toggle', false);
			// 	$('#work-verify').removeClass('verified');
			// 	 heatingType.focus();
			// 	 console.log('ekhane');
			// }

			// else if(natureOccupation.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Selectg Occupation') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#workValidate').attr('data-toggle', false);
			// 	$('#work-verify').removeClass('verified');
			// 	 natureOccupation.focus();
			// }
			 if(occupation_type.val() == ''){
				$('#errorMessage').html("{{ __('Please Select Occupation Type') }}");
				$('.toast.toast--error').toast('show');
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified');
				 occupation_type.focus();
			}

			//  else if(cadstrablePlot.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Parcelle cadastrale') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#workValidate').attr('data-toggle', false);
			// 	$('#work-verify').removeClass('verified');
			// 	 cadstrablePlot.focus();
			// }

			//  else if(foyer.val() == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Foyer') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#workValidate').attr('data-toggle', false);
			// 	$('#work-verify').removeClass('verified');
			// 	 foyer.focus();
			// }

			 else if(house_over_15_years.val() == ''){
				$('#errorMessage').html("{{ __('Please Select Age du batiment') }}");
				$('.toast.toast--error').toast('show');
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified');
				 house_over_15_years.focus();
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
						lead_id 					: lead_id.val(),
						// heating_type				: heatingType.val(),
						// nature_occupation			: natureOccupation.val(),
						occupation_type				: occupation_type.val(),
						cadstrable_plot				: cadstrablePlot.val(),
						foyer				   		: foyer.val(),
						house_over_15_years	     	: house_over_15_years.val(),
						fiscal_amount               : fiscal_amount,
                        family_person               : family_person,
                        zone                        : zone,
                        precariousness              : precariousness,
					},
					success: function(data){
						// $('#successMessage').html(data);
						// $('#heating_type').val(heatingType.val());
						$('#activity_log_wrap').html(data.log);
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');

					},

				});
			}
		});

		$('#preValidateBtn').click(function(){


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

		$('#leadVerifyBtn').click(function(){


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

		// $('#TurnToCustomer').click(function(e){

		// 	e.preventDefault();
		// 	// var project = $('input[name="project_name_m"]:checked').val();
		// 	// var funding = $('input[name="funding"]:checked');
		// 	var company_id = $('#company_id').val();
		// 	var lead_id = $('#lead_id').val();

		// 	$("#lead_to_client_convert").removeClass("d-none");
		// 	$("#lead_to_client_convert_btn").addClass("d-none");

		// 	// if(project.length == 0){
		// 	// 	$('#errorMessage').html("{{ __('Please Select Project') }}");
		// 	// 	$('.toast.toast--error').toast('show');
		// 	// }
		// 	// else if(funding.length == 0){
		// 	// 	$('#errorMessage').html("{{ __('Please Select Funding') }}");
		// 	// 	$('.toast.toast--error').toast('show');
		// 	// }

		// 	// else{
		// 		$.ajaxSetup({
		// 			headers: {
		// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 			}
		// 		});
		// 		$.ajax({
		// 			type: "POST",
		// 			url: "{{ route('lead.to.client') }}",
		// 			data: {
		// 				lead_id 	: lead_id,
		// 				company_id 	: company_id ,
		// 			},
		// 			success: function(data){

		// 				if(data.error){
		// 					$('#errorMessage').html(data.error);
		// 					$('.toast.toast--error').toast('show');
		// 					$("#lead_to_client_convert").addClass("d-none");
		// 					$("#lead_to_client_convert_btn").removeClass("d-none");
		// 				}
		// 				else{
		// 					// $('#rightAsideModal').modal('hide');
		// 					$("#lead_to_client_convert").addClass("d-none");
		// 					$("#lead_to_client_convert_btn").removeClass("d-none");
		// 					$('#successMessage').html("{{ __('Lead to Customer Converted') }}");
		// 					$('.toast.toast--success').toast('show');
		// 					window.location.href = '/admin/client-update/'+data;
		// 				}
		// 				// }


		// 			},
		// 		});
		// 	// }
		// });

		$('.collapseBtn').click(function(){
			// if(!$('#lead-verify').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	$('#leadCardCollapse-1').addClass('show');
			// 	$('#errorMessage').html("{{ __('First Fill Lead Tracking Form') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
		})
		$('#personal_info_collapse_btn').click(function(){
			// if(!$('#lead-verify').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	$('#leadCardCollapse-1').addClass('show');
			// 	$('#errorMessage').html("{{ __('First Fill Lead Tracking Form') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
			// if(!$('#tax-verify').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	$('#leadCardCollapse-3').addClass('show');
			// 	$('#errorMessage').html("{{ __('Verify Tax to proceed') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
		})
		// $('#tracker_collapse_btn').click(function(){
		// 	if(!$('#work-verify').hasClass('verified')){
		// 		$(this).removeClass('collapsed');
		// 		$(this).attr('data-toggle', false);
		// 		// $('#leadCardCollapse-3').addClass('show');
		// 		$('#errorMessage').html("{{ __('Verify Eligibility to proceed') }}");
		// 		$('.toast.toast--error').toast('show');
		// 	}
		// })
		$('#eligibility_collapse_btn').click(function(){
			// if(!$('#tax-verify').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	$('#leadCardCollapse-3').addClass('show');
			// 	$('#errorMessage').html("{{ __('Verify Tax to proceed') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
		})
		$('#work_collapse_btn').click(function(){
			// if(!$('#lead-verify').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	// $('#leadCardCollapse-5').addClass('show');
			// 	$('#errorMessage').html("{{ __('Verify lead tracker to proceed') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
		})
		$('#foyer_collapse_btn').click(function(){
			// if(!$('#present-work-verify').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	// $('#leadCardCollapse-6').addClass('show');
			// 	$('#errorMessage').html("{{ __('Verify Chantier to proceed') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
		})
		$('#travaux_btn').click(function(){
			// if(!$('#situation_foyer').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	// $('#leadCardCollapse-6').addClass('show');
			// 	$('#errorMessage').html("{{ __('Verify situation foyer to proceed') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
		})
		$('#question_btn').click(function(){
			// if(!$('#travaux-verify').hasClass('verified')){
			// 	$(this).removeClass('collapsed');
			// 	$(this).attr('data-toggle', false);
			// 	// $('#leadCardCollapse-6').addClass('show');
			// 	$('#errorMessage').html("{{ __('Verify travaux to proceed') }}");
			// 	$('.toast.toast--error').toast('show');
			// }
		})
		// $('#trait_btn').click(function(){
		// 	if(!$('#question-verify').hasClass('verified')){
		// 		$(this).removeClass('collapsed');
		// 		$(this).attr('data-toggle', false);
		// 		// $('#leadCardCollapse-6').addClass('show');
		// 		$('#errorMessage').html("{{ __('Verify question to proceed') }}");
		// 		$('.toast.toast--error').toast('show');
		// 	}
		// })

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
				else if(phone.val() == ''){
					$('#errorMessage').html("{{ __('Please Enter First Name') }}");
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
						},

						success: function(data){

							if(data.email){
								$("#email-address").text(data.email);
								$("#telephone").text(data.phone);
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
							$('#activity_log_wrap').html(data.log);
							$('.toast.toast--success').toast('show');
							if($('#tax-verify').hasClass('verified') && $('#info-verify').hasClass('verified') && $('#work-verify').hasClass('verified')){
							$('#personal_information_tab').addClass('verified');
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
					$('#infoValidate').attr('data-toggle', 'collapse');
					$('#info-verify').addClass('verified');
					$("#zone").text(data.zone);
					$(".precarious").text(data.precariousness);
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
					$('#successMessage').html(data.alert);
					$('#fiscal_amount').val(data.fiscal_amount);
					$('#family_person').val(data.family_person);
					$('.toast.toast--success').toast('show');

					$(".precarious").text(data.precariousness);
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

		$('#hot_water_production').change(function(){
			var data = $(this).val();
			if(data == 'Instantanné'){
				$.each($('input[name="hot_water_feature[]"]:checked'), function (indexInArray, valueOfElement) {
					$(this).prop( "checked", false );
				});
				$('#accumulation').hide('fadeOut');
				$('#instant').show('fadeIn');
			}
			else if(data == 'Accumulation'){
				$.each($('input[name="hot_water_feature[]"]:checked'), function (indexInArray, valueOfElement) {
					$(this).prop( "checked", false );
				});
				$('#instant').hide('fadeOut');
				$('#accumulation').show('fadeIn');
			}
			else{
				$.each($('input[name="hot_water_feature[]"]:checked'), function (indexInArray, valueOfElement) {
					$(this).prop( "checked", false );
				});
				$('#accumulation').hide('fadeOut');
				$('#instant').hide('fadeOut');
			}
		});

		$('body').on('click', '#add_dependent_children', function(){
			if($('#existingChildren').val() == 'empty'){
				$('#errorMessage').html("{{ __('please complete open fields first') }}");
				$('.toast.toast--error').toast('show');
				exit();
			}

			var item = '<div class="row"> <div class="col-md-5"> <div class="form-group"> <label class="form-label" for="revenue_mister">{{ __("Nom") }} <span class="text-danger">*</span></label> <input type="text" name="name" id="birth_name" class="form-control shadow-none"> </div> </div> <div class="col-md-5"> <div class="form-group"> <label class="form-label" for="revenue_mister">{{ __("Date de naissance") }} <span class="text-danger">*</span></label> <input type="date" name="birth_date" id="birth_date" class="flatpickr flatpickr-input form-control shadow-none">  <input type="hidden" id="existingChildren" value="empty"> </div> </div> </div>';

			$('#dependent_children').append(item);
		});

		$('#situation_foyer_btn').click(function(){

			var lead_id 			= $('#lead_id').val();
			// var annual_heating 		= $('#hidden_annual_heating').val();
			// var adult_occupants 	= $('#adult_occupants').val();
			// var child_occupants 	= $('#child_occupants').val();
			var family_situation 	= $('#family_situation').val();
			// var with_basement 	    = $('#with_basement').val();
			var birth_name 			= $('#birth_name').val();
			var birth_date 			= $('#birth_date').val();
			var mr_activity 		= $('input[name="mr_activity"]:checked').val();
			var mr_revenue 			= $('#mr_revenue').val();
			var mrs_activity 		= $('input[name="mrs_activity"]:checked').val();
			var mrs_revenue 		= $('#mrs_revenue').val();
			var monthly_credit 		= $('#monthly_credit').val();
			var revenue_credit 		= $('#revenue_credit').val();

			// if(annual_heating == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Consommation chauffage Annuel') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#annual_heating').focus();
			// }
			// else if(adult_occupants == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Nombre doccupants adultes') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#adult_occupants').focus();
			// }
			// else if(child_occupants == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Nombre doccupants enfants') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#child_occupants').focus();
			// }
			if(family_situation == ''){
				$('#errorMessage').html("{{ __('Please Select Situation familiale') }}");
				$('.toast.toast--error').toast('show');
				$('#family_situation').focus();
			}
			// else if(with_basement == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Situation familiale') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#with_basement').focus();
			// }
			// else if(birth_name == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Nom') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#birth_name').focus();
			// }
			// else if(birth_date == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Date de naissance') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#birth_date').focus();
			// }
			// else if(!$('#mr_status').hasClass('d-none') && $('input[name="mr_activity"]:checked').length == 0){
			// 	$('#errorMessage').html("{{ __('Please Select Quel est le contrat de travail du conjoint') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('input[name="mr_activity"]:checked').focus();
			// }
			// else if(!$('#mr_status').hasClass('d-none') && mr_revenue == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Revenue Conjoint') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#mr_revenue').focus();
			// }
			// else if($('#mrs_status').length && $('input[name="mrs_activity"]:checked').length == 0){
			// 	$('#errorMessage').html("{{ __('Please Select Quel est le contrat de travail du conjoint') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('input[name="mrs_activity"]:checked').focus();
			// }
			// else if($('#mrs_status').length && mrs_revenue == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Revenue Conjoint') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#mrs_revenue').focus();
			// }
			// else if(monthly_credit == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Credit du foyer mensuel') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#monthly_credit').focus();
			// }
			// else if(revenue_credit == ''){
			// 	$('#errorMessage').html("{{ __('Please Enter Commentaires revenue et credit') }}");
			// 	$('.toast.toast--error').toast('show');
			// 	$('#revenue_credit').focus();
			// }
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
						lead_id 						: lead_id,
						// annual_heating				: annual_heating,
						// adult_occupants				: adult_occupants,
						// child_occupants				: child_occupants,
						family_situation				: family_situation,
						// with_basement				: with_basement,
						birth_name						: birth_name,
						birth_date						: birth_date,
						mr_activity						: mr_activity,
						mr_revenue						: mr_revenue,
						mrs_activity					: mrs_activity,
						mrs_revenue						: mrs_revenue,
						monthly_credit					: monthly_credit,
						revenue_credit					: revenue_credit,
						autre_field__family_situation	: $('#autre_field__family_situation').val(),
						personne_1						: $('#personne_1').val(),
						autre_field__personne_1			: $('#autre_field__personne_1').val(),
						personne_1_partner				: $('#personne_1_partner').is(":checked")?'yes':'no',
						children__status				: $('#children__status').is(":checked")?'yes':'no',
						personne_2						: $('#personne_2').val(),
						autre_field__personne_2			: $('#autre_field__personne_2').val(),

					},

					success: function(data){
						$('#situation_foyer').addClass('verified');
						// $('#leadCardCollapse-7').collapse('hide');
						$('#dependent_children').html(data.children);
						// console.log(data)
						$('#successMessage').html(data.alert);
						$('#activity_log_wrap').html(data.log);
						$('.toast.toast--success').toast('show');
						if($('#present-work-verify').hasClass('verified') && $('#situation_foyer').hasClass('verified')){
							$('#logement_info_tab').addClass('verified');
						}
						// console.log(data);
					},

				});

			};



		});

		$('#leadTrackValidate').click(function(e){
			e.preventDefault();
			var lead_id 		= $('#lead_id').val();
			var supplier 		= $('#supplier');
			var campaign_type 	= $('#campaign_type');
			var campaign 		= $('#campaign');
			var request_date 	= $('#request_date');
			var award_date 		= $('#award_date');
			var first_last_name = $('#first_last_name');
			var p_code 			= $('#p_code');
			var telephone_number = $('#telephone_number');
			var h_mode 			= $('#h_mode');
			var owner 			= $('#owner');
			var over_then_15 	= $('over_then_15');
			var email_address 	= $('#email_address');

			var regex 	= /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(supplier.val() == null){
				$('#errorMessage').html("{{ __('Please Select Fournisseur') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				supplier.focus();
			}
			else if(campaign_type.val() == null){
				$('#errorMessage').html("{{ __('Please Select Type de Campagne') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				campaign_type.focus();
			}
			else if(campaign.val() == ''){
				$('#errorMessage').html("{{ __('Please Enter Nom Campagne') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				campaign.focus();
			}
			else if(request_date.val() == ''){
				$('#errorMessage').html("{{ __('Please Select Date demande') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				request_date.focus();
			}

			else if(award_date.val() == ''){
				$('#errorMessage').html("{{ __('Please Select Date d’attribution Commercial') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				award_date.focus();
			}
			else if(first_last_name.val() == ''){
				$('#errorMessage').html("{{ __('Please Enter Nom et prénom') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				first_last_name.focus();
			}
			else if(p_code.val() == ''){
				$('#errorMessage').html("{{ __('Please Enter Code Postal') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				p_code.focus();
			}
			else if(telephone_number.val() == ''){
				$('#errorMessage').html("{{ __('Please Enter téléphone') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				telephone_number.focus();
			}
			else if(h_mode.val() == null){
				$('#errorMessage').html("{{ __('Please Enter Mode de chauffage') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				h_mode.focus();
			}
			else if(email_address.val() == ''){
				$('#errorMessage').html("{{ __('Please Enter Email') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				email_address.focus();
			}
			else if(!regex.test(email_address.val())){
				$('#errorMessage').html("{{ __('Please Enter Valid Email') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				email_address.focus();
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
						lead_id 					: lead_id,
						supplier 					: supplier.val(),
						campaign_type 				: campaign_type.val(),
						campaign 					: campaign.val(),
						request_date 				: request_date.val(),
						award_date 					: award_date.val(),
						first_last_name  			: first_last_name.val(),
						p_code 						: p_code.val(),
						telephone 					: telephone_number.val(),
						h_mode 						: h_mode.val(),
						owner 						: owner.val(),
						over_then_15 				: over_then_15.val(),
						email_address 				: email_address.val(),
						autre_field__campaign_type 	: $("#autre_field__campaign_type").val(),
						autre_field__h_mode 		: $("#autre_field__h_mode").val(),
						tracker_travaux 			: $("#tracker_travaux").val() ? $("#tracker_travaux").val().toString() : $("#tracker_travaux").val(),
				},
				success: function(data){

					// $('#leadCardCollapse-1').collapse('hide');
					$('#p_code_department').val(data.department);
					$('#lead-verify').addClass('verified');
					$('#lead_tracking_tab').addClass('verified');

					// $("#userStatus").html(data.first_name+" "+data.last_name);

					$('#successMessage').html(data.alert);
					$('#activity_log_wrap').html(data.log);
					$('.toast.toast--success').toast('show');


				},


			});
			}
		});


        $('body').on('click', '.editProjectStatus', function(){
            var id      = $(this).attr('data-id');
            var status  = $(this).attr('data-status');
            $('#xProjectStatus').val(status);
            $('#xProjectId').val(id);
            $('#xProjectUpdateBtn').html("{{ __('Update') }}");

        });
		$('#subvention').click(function(){
			if($(this).is(':checked')){
				$('#subventionBlock').slideDown();
			}else{
				$('#subventionBlock').slideUp();
			}
		});
		$('#credit').click(function(){
			if($(this).is(':checked')){
				$('#creditBlock').slideDown();
			}else{
				$('#creditBlock').slideUp();
			}
		});

		$('#travauxValidate').click(function(){
			var tag_product			={};
			 var product        	= $('.tag__product');

			product.each(function(){
				tag_product[$(this).data('tag-id')]=$(this).val();
			})

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
					comments 											: $('#comments').val(),
					tag_product 										: tag_product,
					Adresse_des_travaux 								: $('#Adresse_des_travaux').val(),
					Code_postale_des_travaux 							: $('#Code_postale_des_travaux').val(),
					Ville_des_travaux 									: $('#Ville_des_travaux').val(),
					Département_des_travaux 							: $('#Département_des_travaux').val(),
					Type_de_contrat 									: $('#Type_de_contrat').val(),
					MaPrimeRenov 										: $('#MaPrimeRenov').is(':checked') ? 'yes':'no',
					Action_Logement 									: $('#Action_Logement').is(':checked') ? 'yes':'no',
					CEE 												: $('#CEE').is(':checked') ? 'yes':'no',
					credit 												: $('#credit').is(':checked') ? 'yes':'no',
					Reste_à_charge 										: $('#Reste_à_charge').is(':checked') ? 'yes':'no',
					Subvention_MaPrimeRénov_déduit_du_devis 			: $('input[name="Subvention_MaPrimeRénov_déduit_du_devis"]:checked').val(),
					// Subvention_MaPrimeRénov_déduit_du_devis 			: $('#Subvention_MaPrimeRénov_déduit_du_devis').is(':checked') ? 'yes':'no',
					Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov : $('input[name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov"]:checked').val(),
					Montant_Crédit 										: $('#Montant_Crédit').val(),
					Report_du_crédit 									: $('#Report_du_crédit').is(':checked') ? 'yes':'no',
					Nombre_de_jours_report 								: $('#Nombre_de_jours_report').val(),
					montant 											: $('#montant').val(),
					Mode_de_paiement 									: $('#Mode_de_paiement').val(),
					Nombre_de_mensualités 								: $('#Nombre_de_mensualités').val(),
				},

				success: function(data){
					// console.log(data);
					$('#travaux-verify').addClass('verified');
					// $('#leadCardCollapse-8').collapse('hide');
					// $('#leadCardCollapse-8').collapse('hide');
					$('#questionBlock').html(data.questions);
					$('#successMessage').html(data.alert);
					$('#activity_log_wrap').html(data.log);
					$('#projectName').html(data.tag);
					$('#MaPrimeRenovEstimatedAmount').text(data.maprime);
					$('#CEEEstimatedAmount').text(data.cee);
					$('.toast.toast--success').toast('show');
					if($('#travaux-verify').hasClass('verified') && $('#question-verify').hasClass('verified')){
						$('#section_project_tab').addClass('verified');
					}
				},

			});


        });

		$('#bareme').change(function(){
			var id = $(this).val();
			var travaux = $('#travaux').val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				url :"{{ route('lead.barame.change') }}",
				data: {id,travaux},

				success: function(data){
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

        $('body').on('click', '#questionValidate', function(){
			 var lead_id 				= $('#lead_id').val();
             var example_project        = $('#example_project').val();
             var question_cag           = $('#question_cag').val();
             var access_door            = $('#access_door').val();
             var boiler_room_size       = $('#boiler_room_size').val();
             var height                 = $('#height').val();
             var boiler_location        = $('#boiler_location').val();
             var other                  = $('#other').val();
             var accessibility          = $('#accessibility').val();
             var other_question         = $('#other_question').val();

             if(example_project == ''){
                $('#errorMessage').html("{{ __('Please Enter Exemple Projet Chaudiere a Granules') }}");
				$('.toast.toast--error').toast('show');
                $('#example_project').focus();
             }
             else if(question_cag  == ''){
                $('#errorMessage').html("{{ __('Please Enter Questionnaire technique CAG') }}");
				$('.toast.toast--error').toast('show');
                $('#question_cag').focus();
             }
             else if(access_door  == ''){
                $('#errorMessage').html("{{ __('Please Select Porte d acces') }}");
				$('.toast.toast--error').toast('show');
                $('#access_door').focus();
             }

             else if(boiler_room_size  == ''){
                $('#errorMessage').html("{{ __('Please Select Dimension Chaufferie') }}");
				$('.toast.toast--error').toast('show');
                $('#boiler_room_size').focus();
             }

             else if(height  == ''){
                $('#errorMessage').html("{{ __('Please Select Hauteur') }}");
				$('.toast.toast--error').toast('show');
                $('#height').focus();
             }

             else if(boiler_location  == ''){
                $('#errorMessage').html("{{ __('Please Select Emplacement chaudière') }}");
				$('.toast.toast--error').toast('show');
                $('#boiler_location').focus();
             }

             else if(accessibility  == ''){
                $('#errorMessage').html("{{ __('Please Select Accessibilité chaufferie') }}");
				$('.toast.toast--error').toast('show');
                $('#accessibility').focus();
             }

             else if(other_question  == ''){
                $('#errorMessage').html("{{ __('Please Enter Autres questionnaires à construire ; ITE / PAC / POELE') }}");
				$('.toast.toast--error').toast('show');
                $('#other_question').focus();
             }
             else{

                $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('lead.question.update') }}",
					data: {
						lead_id 		        : lead_id,
						example_project 		: example_project,
						question_cag 		    : question_cag,
						access_door 		    : access_door,
						boiler_room_size 		: boiler_room_size,
						height 		            : height,
						boiler_location 		: boiler_location,
						other 		            : other,
						accessibility 		    : accessibility,
						other_question 		    : other_question,

					},

					success: function(data){
						$('#question-verify').addClass('verified');
						// $('#leadCardCollapse-9').collapse('hide');
						// $('#leadCardCollapse-10').collapse('show');
                        // $('#questionBlock').html(data.questions);
						$('#successMessage').html(__('Updated Successfully'));
						$('.toast.toast--success').toast('show');
						if($('#travaux-verify').hasClass('verified') && $('#question-verify').hasClass('verified')){
							$('#section_project_tab').addClass('verified');
						}
						// console.log(data);
					},

				});
             }
        });


        $('#traitValidate').click(function(){
			var lead_id 				= $('#lead_id').val();
            var previsite               = $('#previsite').val();
            var projet_valide           = $('#projet_valide').val();
            var devis_signe             = $('#devis_signe').val();
            var project_charge          = $('#project_charge').val();
            var additional_work         = $('#additional_work').val();
            var additional_work_payable = $('#additional_work_payable').val();

            if(previsite == ''){
                $('#errorMessage').html("{{ __('Please Enter Previsite realisé') }}");
				$('.toast.toast--error').toast('show');
                $('#previsite').focus();
            }
            else if(projet_valide == ''){
                $('#errorMessage').html("{{ __('Please Enter Projet valide') }}");
				$('.toast.toast--error').toast('show');
                $('#projet_valide').focus();
            }
            else if(devis_signe == ''){
                $('#errorMessage').html("{{ __('Please Enter Devis signe') }}");
				$('.toast.toast--error').toast('show');
                $('#devis_signe').focus();
            }
            else if(project_charge == ''){
                $('#errorMessage').html("{{ __('Please Enter Reste a charge Projet') }}");
				$('.toast.toast--error').toast('show');
                $('#project_charge').focus();
            }
            else if(additional_work == ''){
                $('#errorMessage').html("{{ __('Please Enter Travaux supplementaire') }}");
				$('.toast.toast--error').toast('show');
                $('#additional_work').focus();
            }
            else if(additional_work_payable == ''){
                $('#errorMessage').html("{{ __('Please Enter Reste a charge travaux supplementaire') }}");
				$('.toast.toast--error').toast('show');
                $('#additional_work_payable').focus();
            }
            else{
                $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('lead.trait.update') }}",
					data: {
						lead_id 					: lead_id,
						previsite 					: previsite,
						projet_valide 				: projet_valide,
						devis_signe 				: devis_signe,
						project_charge 				: project_charge,
						additional_work 			: additional_work,
						additional_work_payable 	: additional_work_payable,


					},

					success: function(data){
						$('#trait-verify').addClass('verified');
						// $('#leadCardCollapse-10').collapse('hide');
						$('#successMessage').html(data.alert);
						$('.toast.toast--success').toast('show');
						if($('#travaux-verify').hasClass('verified') && $('#question-verify').hasClass('verified') && $('#trait-verify').hasClass('verified')){
							$('#section_project_tab').addClass('verified');
						}
						// console.log(data);
					},

				});
            }
        });

		$(".info_edit_toggler").on("click", function(e){
			e.stopPropagation();
            $(this).toggleClass("active");
            if($(this).hasClass('active')){
                $('.personal_info_disabled').prop('disabled', false);
            }else{
                $('.personal_info_disabled').prop('disabled', true);
            }
		});
        $(".work_edit_toggler").on("click", function(e){
			e.stopPropagation();
            $(this).toggleClass("active");
            if($(this).hasClass('active')){
                $('.work_disabled').prop('disabled', false);
            }else{
                $('.work_disabled').prop('disabled', true);
            }
		});

		$('#v-pills-1__next_btn').click(function(){
			if($('#v-pills-2-tab').hasClass('access_permitted')){
                $('#v-pills-2-tab').click();
            }else{
                return false;
            }
		});
		$('#v-pills-3__next_btn').click(function(){
            if($('#v-pills-1-tab').hasClass('access_permitted')){
                $('#v-pills-1-tab').click();
            }else if($('#v-pills-2-tab').hasClass('access_permitted')){
                $('#v-pills-2-tab').click();
            }else{
                return false;
            }
		});

		$('#living_area').keyup(function(){
            $('#hidden_living_area').val($(this).val());
        });
        $('#living_area').focus(function(){
            $(this).attr('type', 'number');
            $(this).val($('#hidden_living_area').val());
        });
        $('#living_area').blur(function(){
            $(this).attr('type', 'text');
            $(this).val($('#hidden_living_area').val()+' m2');
        });

		$('#Surface_à_chauffer').keyup(function(){
            $('#hidden_Surface_à_chauffer').val($(this).val());
        });
        $('#Surface_à_chauffer').focus(function(){
            $(this).attr('type', 'number');
            $(this).val($('#hidden_Surface_à_chauffer').val());
        });
        $('#Surface_à_chauffer').blur(function(){
            $(this).attr('type', 'text');
            $(this).val($('#hidden_Surface_à_chauffer').val()+' m2');
        });

		$('#annual_heating').keyup(function(){
            $('#hidden_annual_heating').val($(this).val());
        });
        $('#annual_heating').focus(function(){
            $(this).attr('type', 'number');
            $(this).val($('#hidden_annual_heating').val());
        });
        $('#annual_heating').blur(function(){
            $(this).attr('type', 'text');
            $(this).val($('#hidden_annual_heating').val()+' €/an');
        });

		$('#select_address').change(function(){
            var data = $(this).val();
            if(data == 'yes'){
                $('#setAddressLatValue').val('');
                $('.mapboxgl-ctrl-geocoder--input').val($('#address').val());
                $('.location_alert_message').removeClass('d-none');
                $('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').addClass('invalid_input');
                $('.mapboxgl-ctrl-geocoder--input').focus();
            }else{
                $('#geocoder .mapboxgl-ctrl-geocoder .mapboxgl-ctrl-geocoder--input').removeClass('invalid_input');
                $('.location_alert_message').addClass('d-none');
                $('.mapboxgl-ctrl-geocoder--input').val("{{ $lead->present_address }}");
            }
        });

        $('#travaux').change(function(){
			// var data = $(this).val();
			// var options = '';
			// if(data == null){
			// 	$('#product').html('');
			// }
			// if(data.indexOf('Chaudière à Granules')  != -1){
			// 	options += ` @foreach (getProductByTravaux('Chaudière à Granules') as $product)
            //                     <option @if (getFeature($work->product, $product->product))
            //                         selected
            //                     @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach `;
			// }
			// if(data.indexOf('Ballon thermodynamique')  != -1){
			// 	options += `  @foreach (getProductByTravaux('Ballon thermodynamique') as $product)
            //                     <option @if (getFeature($work->product, $product->product))
            //                         selected
            //                     @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                     @endforeach `;
			// }
			// if(data.indexOf('Ballon solaire')  != -1){
			// 	options += `  @foreach (getProductByTravaux('Ballon solaire') as $product)
            //                     <option @if (getFeature($work->product, $product->product))
            //                         selected
            //                     @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                     @endforeach `;
			// }
			// if(data.indexOf('Pompe à chaleur Air/Eau')  != -1){
			// 	options += `@foreach (getProductByTravaux('Pompe à chaleur Air/Eau') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
			// if(data.indexOf('Pompe à chaleur Air/Air')  != -1){
			// 	options += `@foreach (getProductByTravaux('Pompe à chaleur Air/Air') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
			// if(data.indexOf('Isolation Interieur - 101')  != -1){
			// 	options += `@foreach (getProductByTravaux('Isolation Interieur - 101') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
			// if(data.indexOf('Isolation Interieur - 102')  != -1){
			// 	options += `@foreach (getProductByTravaux('Isolation Interieur - 102') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
			// if(data.indexOf('Isolation Interieur - 103')  != -1){
			// 	options += `@foreach (getProductByTravaux('Isolation Interieur - 103') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
			// if(data.indexOf("Isolation Thermique par l'exterieur")  != -1){
			// 	options += `@foreach (getProductByTravaux("Isolation Thermique par l'exterieur") as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
            // if(data.indexOf('Poèle à Granulés')  != -1){
			// 	options += `@foreach (getProductByTravaux('Poèle à Granulés') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
            // if(data.indexOf('VMC Double Flux')  != -1){
			// 	options += `@foreach (getProductByTravaux('VMC Double Flux') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }
            // if(data.indexOf('Panneaux solaire')  != -1){
			// 	options += `@foreach (getProductByTravaux('Panneaux solaire') as $product)
            //                 <option @if (getFeature($work->product, $product->product))
            //                     selected
            //                 @endif value="{{ $product->product }}">{{ $product->product }}</option>
            //                 @endforeach`;
			// }

			// $('#product').html(options);
		});

		// $('#family_situation').change(function(){
		// 	if($(this).val() == 'Marié' ||$(this).val() == 'Pacsé' ||$(this).val() == 'Concubinage'){
		// 		$('.husband_status').removeClass('d-none');
		// 		$('.wife_status').removeClass('d-none');
		// 	}
		// 	else {
		// 		if($('.primary_tax_title').val() == 'mr'){
		// 			$('.husband_status').removeClass('d-none');
		// 			$('.wife_status').addClass('d-none');
		// 		}else{
		// 			$('.husband_status').addClass('d-none');
		// 			$('.wife_status').removeClass('d-none');
		// 		}
		// 	}
		// });
		$('#add_more_custom_field_input_btn').click(function(){
			var string = Math.random().toString(10).substring(2,12);
            var data = `<div id="remove`+string+`">
                            <div class="form-group">
                                <div class="d-flex align-items-center justify-content-between">
                                    <label class="form-label" for="label_title`+string+`">{{ __('Title') }} <span class="text-danger">*</span></label>
                                    <button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_tab_input_block" data-id="`+string+`">×</button>
                                </div>
                                <input type="text" name="title[]" id="label_title`+string+`" class="form-control shadow-none" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="input_type`+string+`">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
                                <select name="input_type[]" id="input_type`+string+`"  class="select2_select_option custom-select shadow-none form-control">
                                    <option value="text">{{ __('Text') }}</option>
                                    <option value="number">{{ __('Number') }}</option>
                                    <option value="email">{{ __('Email') }}</option>
                                    <option value="radio">{{ __('Radio') }}</option>
                                    <option value="checkbox">{{ __('Checkbox') }}</option>
                                    <option value="select">{{ __('Dropdown') }}</option>
                                    <option value="textarea">{{ __('Textarea') }}</option>
                                </select>
                            </div>
                            <div class="form-group" id="optional_options">
                                <label class="form-label" for="options">{{ __('Options') }} <span class="text-danger">*</span></label>
                                <textarea name="options[]" id="options" class="form-control shadow-none" placeholder="Enter Options. Each option seperate with comma ','"></textarea>
                            </div>
                        </div>`;

            $('#CustomTabInput').append(data);
        });
		$('body').on('click', '.remove_tab_input_block', function(){
			var id = $(this).attr('data-id');
			$('#remove'+id).remove();
		});

	});
</script>




<script>
	$(document).ready(function(){
		@if ($lead->user_status == 6)
			$('.tracking_disabled').prop('disabled', true);
			$('.tax_input_disabled').prop('disabled', true);
			$('.personal_info_disabled').prop('disabled', true);
			$('.eligibility_disabled').prop('disabled', true);
			$('.work_site_disabled').prop('disabled', true);
			$('.foyer_disabled').prop('disabled', true);
			$('.travaux_disabled').prop('disabled', true);
			$('.question_disabled').prop('disabled', true);
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
	});
</script>

@endpush
