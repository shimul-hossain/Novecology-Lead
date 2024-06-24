{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
	Mes Chantiers
@endsection

{{-- active menu  --}}
@section('projectIndex')
active
@endsection



 
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
		<section class="banner section-gap position-relative">
			<div class="container">
				{{-- <a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a> --}}
				<div class="row justify-content-center">
					<div class="col-12">
						<h1 class="banner__title text-center text-white">Entreprise de chantiers</h1>
						<p class="text-center text-white mb-2 mb-md-0">Suivez l’évolution des chantiers en temps réel</p>
					</div>
					<div class="col-lg mb-2 text-center text-lg-left">
						<input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input" id="project_search_bar">
					</div>
					<div class="col-lg-auto d-flex flex-wrap align-items-center justify-content-center justify-content-lg-right">
						@if ($user_action_assign || $role == 's_admin')
							<div class="dropdown d-none" id="allActionButton">
								<button type="button" class="primary-btn primary-btn--white primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Actions sur vos chantiers
								</button>
								<div class="dropdown-menu"> 
									<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#moveToMainChantier">
										Passer au chantier principal
									</button> 
								</div>
							</div>
						@endif
						@if ($user_action_create || $role == 's_admin') 
							<button class="primary-btn primary-btn--white primary-btn--md rounded d-inline-flex align-items-center justify-content-center border-0 mx-2" data-toggle="modal" data-target="#createNewChantier">
								<i class="bi bi-plus-lg mr-1"></i>creér un nouveau chantier
							</button>
						@endif
						@if (\Auth::id() == 1)
							<button class="primary-btn primary-btn--white primary-btn--md rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#projectImportModal">
								Importer un chantier
							</button>
						@endif
						@if ($user_action_add_filter || $role == 's_admin')
							<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 rounded shadow-none ml-2">+ {{ __('Add filter') }}</button>
						@endif 
					</div>
					<div class="col-12">
						<ul class="nav nav-pills" id="tables-pills-tab" role="tablist">
							@foreach ($project_status as $key => $item_data)
								<li class="nav-item" role="presentation" data-tab-id="{{ $key }}">
									<a
									@if ($status)
										@if ($item_data->id == $status)
											style="color: {{ $item_data->status_color }}; background-color:{{ $item_data->background_color }}"
										@endif
									@else
										@if ($status != 0 && $item_data->id == '1')
										style="color: {{ $item_data->status_color }}; background-color:{{ $item_data->background_color }}"
										@endif
									@endif
									  class="nav-link border-0 {{ $status ? ($item_data->id == $status ? 'active':''): ($item_data->id == '1' && $status != 0 ? 'active':'') }}"  href="{{ route('project-import.index', $item_data->id) }}"> {{ $item_data->status }} @if ($item_data->id == $status)<span class="border ml-2 p-1 rounded-pill">{{ $projects->total() }}</span>@endif</a>
								</li>
							@endforeach
							@if (\Auth::id() == 1)
								<li class="nav-item" role="presentation" data-tab-id="{{ $key }}">
									<a @if ($status == 0)
									style="color: black; background-color:yellow"
									@endif class="nav-link border-0 {{ $status == 0 ? 'active':'' }}"  href="{{ route('project-import.index', 0) }}"> Ongoing Chantier @if (0 == $status)<span class="border ml-2 p-1 rounded-pill">{{ $projects->count() }}</span>@endif</a>
								</li>
							@endif
							<li class="ml-auto"> 
								<select id="paginationCount" class="custom-select">
									<option {{ $pagination_number == '25' ? 'selected':'' }} value="25">25</option>
									<option {{ $pagination_number == '50' ? 'selected':'' }} value="50">50</option>
									<option {{ $pagination_number == '100' ? 'selected':'' }} value="100">100</option>
								</select>
							</li>
						</ul>
						<div class="tab-content bg-white" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-" role="tabpanel" aria-labelledby="pills-tab-">
								<div class="database-table-wrapper bg-white">
									<div class="table-responsive simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
											<thead class="database-table__header">
												<tr>
													<th class="text-left">
														<div class="custom-control custom-checkbox">
															<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox tableAllSelectCheck" id="tableAllSelectCheck-">
															<label class="custom-control-label" for="tableAllSelectCheck-"></label>
														</div>
													</th>
														@if ($filter_status->count() == 0) 
															@foreach ($default_filters as $item) 
																	<th>
																		@if ($item->getProjectHeader->header == 'fixed_number')
																			N° Fixe
																		@elseif ($item->getProjectHeader->header == 'phone')
																			N° Mobile
																		@elseif ($item->getProjectHeader->header == 'Consommation_Chauffage_Annuel_2')
																			Consommation Chauffage Annuel (litres,kWh,m3)
																		@elseif ($item->getProjectHeader->header == 'auxiliary_heating_status')
																			Le logement possède t - il un chauffage d’appoint ?
																		@elseif ($item->getProjectHeader->header == 'auxiliary_heating')
																			Le logement possède t - il un chauffage d’appoint
																		@elseif ($item->getProjectHeader->header == 'second_heating_generator_status')
																			La maison possède-t-elle un second générateur de chauffage
																		@elseif ($item->getProjectHeader->header == 'second_heating_generator')
																			La maison possède-t-elle un second générateur de chauffage
																		@elseif ($item->getProjectHeader->header == '__tracking__Nom_Prénom')
																			Nom Prénom Lead
																		@elseif ($item->getProjectHeader->header == '__tracking__téléphone')
																			Téléphone
																		@elseif ($item->getProjectHeader->header == 'precariousness')
																			Précarité
																		@elseif ($item->getProjectHeader->header == 'advance_visit') 
																			Disponibilité pour prévisite (jour /horaire)
																		@else
																			{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $item->getProjectHeader->header))))) }}
																		@endif
																	</th> 
															@endforeach 
														@else 
															@foreach ($filter_status as $item) 
																<th>
																	@if ($item->getHeader->header == 'fixed_number')
																		N° Fixe
																	@elseif ($item->getHeader->header == 'phone')
																		N° Mobile
																	@elseif ($item->getHeader->header == 'Consommation_Chauffage_Annuel_2')
																		Consommation Chauffage Annuel (litres,kWh,m3)
																	@elseif ($item->getHeader->header == 'auxiliary_heating_status')
																		Le logement possède t - il un chauffage d’appoint ?
																	@elseif ($item->getHeader->header == 'auxiliary_heating')
																		Le logement possède t - il un chauffage d’appoint
																	@elseif ($item->getHeader->header == 'second_heating_generator_status')
																		La maison possède-t-elle un second générateur de chauffage
																	@elseif ($item->getHeader->header == 'second_heating_generator')
																		La maison possède-t-elle un second générateur de chauffage
																	@elseif ($item->getHeader->header == '__tracking__Nom_Prénom')
																		Nom Prénom Lead
																	@elseif ($item->getHeader->header == '__tracking__téléphone')
																		Téléphone
																	@elseif ($item->getHeader->header == 'precariousness')
																		Précarité
																	@elseif ($item->getHeader->header == 'advance_visit') 
																		Disponibilité pour prévisite (jour /horaire)
																	@else
																		{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $item->getHeader->header))))) }}
																	@endif
																</th> 
															@endforeach 
														@endif
													{{-- <th class="text-left">
														{{ __('Comment') }}
													</th>  --}}
													@if ($user_action_statut_visible || $role == 's_admin')
														<th>
															{{ __('Status') }}
														</th>
													@endif
													<th class="text-left">
														Gestionnaire
													</th>
													<th class="text-left">
														Telecommercial
													</th>
													<th class="text-center">
														{{ __('Actions') }}
													</th>
													<th class="text-center">
														Dossier
													</th>
												</tr>
											</thead>
											<tbody class="database-table__body">

												@php
													$x_code= 'empty';
													$header_code = 00000;
												@endphp
												@if ($filter_status->count() == 0)
													@forelse ($projects as $project)
														@if ($status != 2 && $status != 3)
															@if ($x_code != substr($project->Code_Postal, 0,2))
																@php 
																	$header_code = $project->id.rand(0000,9999);
																@endphp
																<tr>
																	<td style="background-color: #13438c">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" value="{{ $project->id }}" class="custom-control-input table-select-checkbox project_checkbox_header" data-header-code="{{ $header_code }}" id="tableThreeRowSelectCheckHeader-{{ $project->id }}">
																			<label class="custom-control-label" for="tableThreeRowSelectCheckHeader-{{ $project->id }}"></label>
																		</div>
																	</td>
																	<td colspan="500" class="text-white" style="background-color: #13438c">{{ $project->Code_Postal ? getDepartment3($project->Code_Postal). ' ('.substr($project->Code_Postal, 0,2).') - '.getPrimaryZone($project->Code_Postal) : __('No Department') }}</td>
																</tr>
															@endif
														@endif
														<tr>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox"name="checkedLead[]" value="{{ $project->id }}" class="custom-control-input table-select-checkbox project_checkbox_item project_checkbox_header_code{{ $header_code }}" data-id="{{ $project->id }}"  id="tableThreeRowSelectCheck-{{ $project->id }}">
																	<label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $project->id }}"></label>
																</div>
															</td>
															@foreach ($default_filters as $item)
																@php
																	$header = $item->getProjectHeader->header;
																@endphp
																<td  id="{{ $header }}{{ $project->id }}">{{ $project->$header ??__('Not Provided') }}</td>
															@endforeach
															@if ($user_action_statut_visible || $role == 's_admin')
																<td class="text-left">
																	<button 
																	 style="background-color:{{ $project->getSubStatus ? $project->getSubStatus->background_color : '#13438c' }} ; color: {{ $project->getSubStatus ? $project->getSubStatus->text_color : '#fff' }}" data-status-type="sub_status" data-id="{{ $project->id }}" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0
																	 @if ($user_action_statut_edit || $role == 's_admin')
																		projectStatusChangeModal
																	@endif
																	 ">
																		{{ $project->getSubStatus ? $project->getSubStatus->name : (($project->project_label == 1) ? 'Nouvelle demande': 'Pas de sous statut') }}
																	</button>
																</td>
															@endif
															<td>
																<div class="avatar-group d-flex">
																	@if ($project->projectGestionnaire)
																		<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $project->projectGestionnaire->name }}">
																			@if ($project->projectGestionnaire->profile_photo)
																			<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $project->projectGestionnaire->profile_photo }}" alt="{{ $project->projectGestionnaire->name }}" class="avatar-group__image w-100 h-100">
																			@else
																			<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																			@endif
																		</a>
																	@else
																		{{ __('No assignee') }}
																	@endif
																</div>
															</td>
															<td>
																<div class="avatar-group d-flex">
																	@if ($project->getProjectTelecommercial)
																		<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $project->getProjectTelecommercial->name }}">
																			@if ($project->getProjectTelecommercial->profile_photo)
																			<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $project->getProjectTelecommercial->profile_photo }}" alt="{{ $project->getProjectTelecommercial->name }}" class="avatar-group__image w-100 h-100">
																			@else
																			<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																			@endif
																		</a>
																	@else
																		{{ __('No assignee') }}
																	@endif
																</div>
															</td>
															<td class="text-center">
																@if ($user_action_blue_button || $role == 's_admin')
																	<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle projectStatusChangeModal" data-status-type="status" data-id="{{ $project->id }}"><span class="novecologie-icon-chevron-right"></span></button>
																@endif

																{{-- <button type="button" class="btn p-1 shadow-none" data-target="#project_status__change{{ $project->id }}" data-toggle="modal"><img style="max-height: 25px" src="{{ asset('crm_assets/assets/images/icons/right-arrow.png') }}" alt="icon"></button> --}}
																@if ($user_action_mpr_button || $role == 's_admin')
																	<span class="informationUpdateLoader d-none">
																		<svg class="lead_cardloader_icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
																			<path class="lead_cardloadericon_path" fill="#42a5f6" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
																			<animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"></animateTransform>
																			</path>
																		</svg>
																	</span>
																	{{-- <button type="button" class="btn p-1 shadow-none informationUpdateButton" data-id="{{ $project->id }}"><img  loading="lazy"  style="max-height: 30px" src="{{ asset('crm_assets/assets/images/icons/maprimerenov-logo.png') }}" alt="icon"></button> --}}
																@endif
															</td>
															<td>
																<div class="d-flex align-items-center justify-content-end action-btns-wrapper">
																	@if ($user_action_edit || $role == 's_admin')
																		<a href="{{ route('files-import.index',$project->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
																			{{ __('Update') }}
																		</a>
																	@endif
																</div>
															</td>
														</tr>
														@php
															$x_code = substr($project->Code_Postal, 0,2);
														@endphp 
													@empty
													<tr>
														<td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
													</tr>
													@endforelse
												@else
													@forelse ($projects as $project)
														@if ($status != 2 && $status != 3)
															@if ($x_code != substr($project->Code_Postal, 0,2))
																@php 
																	$header_code = $project->id.rand(0000,9999);
																@endphp
																<tr>
																	<td style="background-color: #13438c">
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" value="{{ $project->id }}" class="custom-control-input table-select-checkbox project_checkbox_header" data-header-code="{{ $header_code }}" id="tableThreeRowSelectCheckHeader-{{ $project->id }}">
																			<label class="custom-control-label" for="tableThreeRowSelectCheckHeader-{{ $project->id }}"></label>
																		</div>
																	</td>
																	<td colspan="500" class="text-white" style="background-color: #13438c">{{ $project->Code_Postal ? getDepartment3($project->Code_Postal). ' ('.substr($project->Code_Postal, 0,2).') - '.getPrimaryZone($project->Code_Postal) : __('No Department') }}</td>
																</tr>
															@endif
														@endif
														<tr>
															<td>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" name="checkedLead[]"  value="{{ $project->id }}" class="custom-control-input table-select-checkbox project_checkbox_item project_checkbox_header_code{{ $header_code }}"  data-id="{{ $project->id }}" id="tableThreeRowSelectCheck-{{ $project->id }}">
																	<label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $project->id }}"></label>
																</div>
															</td>
															@foreach ($filter_status as $item)
																@php
																	$header = $item->getHeader->header;
																	// dd($project->ProjectTravauxTags->where('rank', 1));
																@endphp
																@if ($header == '__projet__Ville_des_travaux')
																	<td>{{ $project->Ville ??__('Not Provided') }}</td>
																@elseif ($header == '__projet__Département_des_travaux')
																	<td>{{ $project->Département ??__('Not Provided') }}</td>
																@elseif ($header == 'TAG') 
																	<td>
																		@foreach ($project->ProjectTravauxTags as $tag)
																			{{ $tag->tag }} {{ $loop->last ? '':', ' }}
																		@endforeach 
																	</td>
																@elseif ($header == 'Montant_Disponible')
																	<td>
																		@if ($project->Statut_1_hyphen_MyMPR == 'Demande de solde' && $project->Statut_2_hyphen_MyMPR == 'Acceptée pour paiement')
																		{{ $project->Montant_subvention_prévisionnel_hyphen_MyMPR ? EuroFormat(20000 - $project->Montant_subvention_prévisionnel_hyphen_MyMPR) : '' }}
																		@endif
																	</td>
																@elseif ($header == 'Statut_accord_banque')
																	<td>
																		@foreach ($project->getDepot as $depot)
																			{{ $depot->Statut_accord_banque }} {{ $loop->last ? '':', ' }}
																		@endforeach
																	</td>
																@elseif ($header == 'Statut_audit')
																	<td>
																		@foreach ($project->getAudit as $audit)
																			{{ $audit->getStatus->name ?? '' }} {{ $loop->last ? '':', ' }}
																		@endforeach
																	</td>
																@elseif ($header == 'Résultat_du_rapport_audit')
																	<td>
																		@foreach ($project->getAudit as $audit)
																			{{ $audit->getResult->name ?? '' }} {{ $loop->last ? '':', ' }}
																		@endforeach
																	</td>
																@elseif ($header == '__tracking__Fournisseur_de_lead')
																	<td>{{ $project->getSupplier->suplier ??__('Not Provided') }}</td>
																@elseif ($header == 'Régie')
																	<td>
																		@if ($project->getProjectTelecommercial)
																			{{ $project->getProjectTelecommercial->getRegie->name ?? __('No Regie') }}
																		@else
																			{{ __('No Regie') }}
																		@endif
																	</td>
																@elseif ($header == 'Statut_Projet')
																	@if ($project->$header)
																		<td class="text-left">
																			<button style="background-color: {{ $project->$header == 'Devis signé' ? 'green' : ($project->$header == 'Réflexion' ? '#00E3EB':'red') }}" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>
																		</td>
																	@else
																		<td>
																			{{ __('Not Provided') }}
																		</td>
																	@endif
																@elseif ($header == 'Type_de_contrat')
																	<td>
																		@if ($project->$header == 'Credit')
																			<button style="background-color: #00818E; color:ffffff" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>
																		@elseif ($project->$header == 'MaPrimeRenov')
																			<button style="background-color: #B2E6D9; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>	
																		@elseif ($project->$header == 'BAR TH 164 – 2022')
																			<button style="background-color: #ff0000; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>	
																		@elseif ($project->$header == 'BAR TH 164 – 2023')
																			<button style="background-color: #F8A0EE; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>	
																		@elseif ($project->$header == 'BAR TH 164 – 2023 (après 01/07/2023)')
																			<button style="background-color: #9BB8CD; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>	
																		@elseif ($project->$header == 'BAR TH 145')
																			<button style="background-color: #EADFB4; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>	
																		@elseif ($project->$header == 'BAR TH 173')
																			<button style="background-color: #FFB996; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																				{{ $project->$header }}
																			</button>	
																		@else
																			 {{ __('Not Provided') }}
																		@endif
																	</td> 
																@elseif ($header == 'Travaux_formulaire')
																	<td>
																		{{ getCustomFieldData('travaux_formulaire', $project->lead_tracking_custom_field_data) ??__('Not Provided') }}
																	</td>
																@elseif ($header == 'precariousness')
																	@if ($project->projectSecondTable && ($project->projectSecondTable->manual_import == 1 || $project->projectSecondTable->manual_import == 2))
																		<td  id="{{ $header }}{{ $project->id }}">{{ $project->projectSecondTable->precariousness }}</td>
																	@else  
																		<td  id="{{ $header }}{{ $project->id }}">{{ $project->$header ??__('Not Provided') }}</td>
																	@endif 
																@else
																	<td  id="{{ $header }}{{ $project->id }}">{{ $project->$header ??__('Not Provided') }}</td>
																@endif
															@endforeach
															@if ($user_action_statut_visible || $role == 's_admin')
																<td class="text-left">
																	<button style="background-color:{{ $project->getSubStatus ? $project->getSubStatus->background_color : '#13438c' }} ; color: {{ $project->getSubStatus ? $project->getSubStatus->text_color : '#fff' }}" data-status-type="sub_status" data-id="{{ $project->id }}" type="button" class=" primary-btn primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 @if ($user_action_statut_edit || $role == 's_admin')
																		projectStatusChangeModal
																	@endif">
																		{{ $project->getSubStatus ? $project->getSubStatus->name : (($project->project_label == 1) ? 'Nouvelle demande': 'Pas de sous statut') }}
																	</button>
																</td>
															@endif

															<td>
																<div class="avatar-group d-flex">
																	@if ($project->projectGestionnaire)
																		<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $project->projectGestionnaire->name }}">
																			@if ($project->projectGestionnaire->profile_photo)
																			<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $project->projectGestionnaire->profile_photo }}" alt="{{ $project->projectGestionnaire->name }}" class="avatar-group__image w-100 h-100">
																			@else
																			<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																			@endif
																		</a>
																	@else
																		{{ __('No assignee') }}
																	@endif
																</div>
															</td>
															<td>
																<div class="avatar-group d-flex">
																	@if ($project->getProjectTelecommercial)
																		<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $project->getProjectTelecommercial->name }}">
																			@if ($project->getProjectTelecommercial->profile_photo)
																			<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $project->getProjectTelecommercial->profile_photo }}" alt="{{ $project->getProjectTelecommercial->name }}" class="avatar-group__image w-100 h-100">
																			@else
																			<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																			@endif
																		</a>
																	@else
																		{{ __('No assignee') }}
																	@endif
																</div>
															</td>
															<td class="text-center">
																@if ($user_action_blue_button || $role == 's_admin')
																	<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle projectStatusChangeModal" data-status-type="status" data-id="{{ $project->id }}"><span class="novecologie-icon-chevron-right"></span></button>
																@endif
																@if ($user_action_mpr_button || $role == 's_admin')
																	<span class="informationUpdateLoader d-none">
																		<svg class="lead_cardloader_icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
																			<path class="lead_cardloadericon_path" fill="#42a5f6" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
																			<animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"></animateTransform>
																			</path>
																		</svg>
																	</span>
																	{{-- <button type="button" class="btn p-1 shadow-none informationUpdateButton" data-id="{{ $project->id }}"><img  loading="lazy"  style="max-height: 30px" src="{{ asset('crm_assets/assets/images/icons/maprimerenov-logo.png') }}" alt="icon"></button> --}}
																@endif  
															</td>
															<td>
																<div class="d-flex align-items-center justify-content-center action-btns-wrapper">
																	@if ($user_action_edit || $role == 's_admin')
																		<a href="{{ route('files-import.index', $project->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
																			{{ __('Update') }}
																		</a>
																	@endif
																</div>
															</td>
														</tr>
														@php
															$x_code = substr($project->Code_Postal, 0,2);
														@endphp 
													@empty
													<tr>
														<td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
													</tr>
													@endforelse
												@endif
											</tbody>
										</table>
									</div>
										{{-- <div class="pagination-wrapper">
											{{ $projects->onEachSide(1)->links() }}
										</div> --}}
										@if ($projects instanceof \Illuminate\Pagination\AbstractPaginator)
										<div class="pagination-wrapper"> 
											{{ $projects->appends(
												['__tracking__Fournisseur_de_lead' => request()->__tracking__Fournisseur_de_lead,
												'__tracking__Type_de_campagne' => request()->__tracking__Type_de_campagne,
												'__tracking__Nom_campagne' => request()->__tracking__Nom_campagne,
												'__tracking__Date_demande_lead' => request()->__tracking__Date_demande_lead,
												'__tracking__Date_attribution_télécommercial' => request()->__tracking__Date_attribution_télécommercial, 
												'Prenom' => request()->Prenom,
												'Nom' => request()->Nom, 
												'Email' => request()->Email, 
												'Type_occupation' => request()->Type_occupation, 
												'Zone' => request()->Zone,
												'precariousness' => request()->precariousness,
												'Mode_de_chauffage' => request()->Mode_de_chauffage, 
												'Surface_habitable' => request()->Surface_habitable, 
												'Situation_familiale' => request()->Situation_familiale, 
												'Ville' => request()->Ville,
												'department' => request()->department,
												'bareme' => request()->bareme,
												'travaux' => request()->travaux,
												'tag' => request()->tag,
												'product' => request()->product,
												'Type_de_contrat' => request()->Type_de_contrat,
												'Pièces_manquante' => request()->Pièces_manquante,
												'intervention_type' => request()->intervention_type,
												'Statut_planning' => request()->Statut_planning,
												'Faisabilité_du_chantier' => request()->Faisabilité_du_chantier,
												'Dossier_administratif_complet' => request()->Dossier_administratif_complet,
												'Installateur_technique' => request()->Installateur_technique,
												'Statut_Installation' => request()->Statut_Installation,
												'Chargé_étude' => request()->Chargé_étude,
												'Réfèrent_technique' => request()->Réfèrent_technique,
												'Prévisiteur_Technico_Commercial' => request()->Prévisiteur_Technico_Commercial,
												'Contre_prévisiteur' => request()->Contre_prévisiteur,
												'Technicien_SAV' => request()->Technicien_SAV,
												'Statut_SAV' => request()->Statut_SAV,
												'subvention_status' => request()->subvention_status,
												'mandataire' => request()->mandataire,
												'gestionnaire_depot' => request()->gestionnaire_depot,
												'Statut_subvention' => request()->Statut_subvention,
												'status_1' => request()->status_1,
												'banque' => request()->banque,
												'banque_status' => request()->banque_status,
												'Statut_accord_banque' => request()->Statut_accord_banque,
												'audit_status' => request()->audit_status,
												'report_result' => request()->report_result,
												'csp_type' => request()->csp_type,
												'Conformité_du_chantier' => request()->Conformité_du_chantier,
												'facturation_type' => request()->facturation_type,
												'Statut_règlement' => request()->Statut_règlement,
												'Paiement_inférieur_au_montant_prévu' => request()->Paiement_inférieur_au_montant_prévu,
												'facturationMandataire' => request()->facturationMandataire,
												'Avance_délégataire_MaPrimeRénov' => request()->Avance_délégataire_MaPrimeRénov,
												'Statut_règlement_banque' => request()->Statut_règlement_banque,
												'Banque_facturation' => request()->Banque_facturation,
												'telecommercial_id' => request()->telecommercial_id,
												'gestionnaire_id' => request()->gestionnaire_id,
												'regie' => request()->regie,
												'sub_status' => request()->sub_status,
												])->render() }}
										</div>
									@endif
								</div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</section>

		 <!-- Project Import Modal -->
		<div class="modal modal--aside fade" id="projectImportModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content border-0">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body pt-0">
					<form action="{{ route('projects.import-manual') }}" class="form" id="projectFileImportForm" method="POST" enctype="multipart/form-data">
						@csrf
						<h1 class="form__title position-relative text-center mb-4">Importer un chantier</h1>
						<span id="importError" class="text-danger"></span>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input type="file" name="file" class="custom-file-input" id="projectFileImportField" aria-describedby="inputGroupFileAddon01" required>
								<label class="custom-file-label" for="projectFileImportField">Choisir le fichier</label>
							</div>
						</div>
						<div id="projectCsvHeader">

						</div>
						<div class="text-center mt-3">
							<div class="lead__card__loader-wrapper d-none" id="projectImportLoader">
								<div class="lead__card__loader">
									<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
										<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
										<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
										</path>
									</svg>
								</div>
							</div>
							<button type="submit" id="projectImportSubmitButton" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0">
								{{ __('Import') }} <span class="novecologie-icon-arrow-right ml-3"></span>
							</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>

		<div class="modal modal--aside fade" id="createNewChantier" tabindex="-1" aria-labelledby="createNewChantierModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Êtes-vous sûr de créer un nouveau chantier') }}</h1> 
						<form action="{{ route('project-import.create') }}" method="POST">
							@csrf 
							<input type="hidden" name="status" value="{{ $status }}">
							<div class="form-group">
								<label class="form-label">Montant CEE :</label>
								<input type="text" name="montant_cee" class="form-control shadow-none">
							</div> 
							<div class="form-group">
								<label class="form-label">Situation :</label>
								<input type="text" name="situation" class="form-control shadow-none">
							</div> 
							<div class="form-group text-center">
								<button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0">{{ __('Submit') }}</button>
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div> 
		<div class="modal modal--aside fade" id="moveToMainChantier" tabindex="-1" aria-labelledby="createNewChantierModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>Êtes-vous sûr de déplacer ce chantier vers le chantier principal ?</span>
						<form action="{{ route('project-import.moveto') }}" method="POST">
							@csrf 
							<input type="hidden" name="bulk_selected_project" class="bulk_selected_project">
							<div class="d-flex justify-content-center">
								<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
									Annuler
								</button>
								<button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
									Confirmer
								</button>
							</div>     
						</form>
					</div>
				</div>
			</div>
		</div> 

		<!-- Right Aside Modal -->
		<div class="modal modal--aside fade rightAsideModal" id="rightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content border-0 h-100 rounded-0 simple-bar">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center">{{ __('Additional filters') }}</h1> 
						<form action="{{ route('project.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
							@csrf 
							<h2 class="modal-sub-title position-relative">Autres</h2>
							<div class="row">
								@foreach ($headers as $key => $header)
									@if ($header->header == '__projet__Ville_des_travaux'
										|| $header->header == '__projet__Département_des_travaux'
										|| $header->header == 'TAG'
										|| $header->header == 'Statut_Projet'
										|| $header->header == 'Statut_1_hyphen_MyMPR'
										|| $header->header == 'Statut_2_hyphen_MyMPR'
										|| $header->header == 'Montant_Disponible'
										|| $header->header == 'Statut_accord_banque'
										|| $header->header == 'Statut_audit' 
										|| $header->header == 'Résultat_du_rapport_audit' 
										|| $header->header == 'Type_de_contrat'
										||($permission_regies && $header->header == 'Régie')
										)
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="situation-foyer-{{ $key }}" name="header_id[]"
													@foreach ($filter_status as $item)
														@if ( $header->id == $item->project_header_id)
															checked
														@endif
													@endforeach>
												<label class="custom-control-label" for="situation-foyer-{{ $key }}">
													{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
												</label>
											</div>
										</div>
									@endif
								@endforeach
							</div>

							<h2 class="modal-sub-title position-relative mt-3">{{ __('Lead Tracking (Form and response)') }}</h2>
							<div class="row">
								@foreach ($headers as $key => $header)
									@if ($header->header == 'id' 
										|| $header->header == '__tracking__Fournisseur_de_lead' 
										|| $header->header == '__tracking__Type_de_campagne' 
										|| $header->header == '__tracking__Nom_campagne'
										|| $header->header == '__tracking__Nom_Prénom'
										|| $header->header == '__tracking__Code_postal'
										|| $header->header == '__tracking__Email'
										|| $header->header == '__tracking__téléphone'
										|| $header->header == '__tracking__Département'
										|| $header->header == '__tracking__Mode_de_chauffage'
										|| $header->header == '__tracking__Propriétaire' 
										|| $header->header == 'Travaux_formulaire'
										)
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="lead_tracking-{{ $key }}" name="header_id[]"
												@if ($filter_status->count() > 0)
													@foreach ($filter_status as $item)
														@if ( $header->id == $item->project_header_id)
															checked
														@endif
													@endforeach
												@else
													@foreach ($default_filters as $item)
														@if ( $header->id == $item->header_id)
															checked
														@endif
													@endforeach
												@endif
												>
												<label class="custom-control-label" for="lead_tracking-{{ $key }}">
													@if ($header->header == '__tracking__Nom_Prénom')
														Nom Prénom Lead
													@elseif ($header->header == '__tracking__téléphone')
														Téléphone
													@else
														{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
													@endif
												</label>
											</div>
										</div>
									@endif
								@endforeach
							</div>
							<h2 class="modal-sub-title position-relative mt-3">Informations personnelles</h2>
							<div class="row">
								@foreach ($headers as $key => $header)
									@if ($header->header == 'Titre'
										|| $header->header == 'Prenom'
										|| $header->header == 'Nom'
										|| $header->header == 'Code_Postal'
										|| $header->header == 'Email'
										|| $header->header == 'phone'
										|| $header->header == 'fixed_number'
										)
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="informations_personnelles-{{ $key }}" name="header_id[]"
													@if ($filter_status->count() > 0)
														@foreach ($filter_status as $item)
															@if ( $header->id == $item->project_header_id)
																checked
															@endif
														@endforeach
													@else
														@foreach ($default_filters as $item)
															@if ( $header->id == $item->header_id)
																checked
															@endif
														@endforeach

													@endif
												>
												<label class="custom-control-label" for="informations_personnelles-{{ $key }}">
													@if ($header->header == 'fixed_number')
														N° Fixe
													@elseif ($header->header == 'phone')
														N° Mobile
													@else
														{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
													@endif
												</label>
											</div>
										</div>
									@endif
								@endforeach
							</div>
							<h2 class="modal-sub-title position-relative mt-3">Éligibilité</h2>
							<div class="row">
								@foreach ($headers as $key => $header)
									@if ($header->header == 'Type_occupation'
										|| $header->header == 'Zone'
										|| $header->header == 'precariousness')
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="eligibility-{{ $key }}" name="header_id[]"
													@foreach ($filter_status as $item)
														@if ( $header->id == $item->project_header_id)
															checked
														@endif
													@endforeach
												>
												<label class="custom-control-label" for="eligibility-{{ $key }}">
													@if ($header->header == 'precariousness')
														Éligibilité MaPrimeRenov
													@else
														{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
													@endif
												</label>
											</div>
										</div>
									@endif
								@endforeach
							</div>
							<h2 class="modal-sub-title position-relative mt-3">Information logement</h2>
							<div class="row">
								@foreach ($headers as $key => $header)
									@if ($header->header == 'Mode_de_chauffage'
										|| $header->header == 'Surface_habitable'
										)
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="information-logement-{{ $key }}" name="header_id[]"
													@foreach ($filter_status as $item)
														@if ( $header->id == $item->project_header_id)
															checked
														@endif
													@endforeach
												>
												<label class="custom-control-label" for="information-logement-{{ $key }}">
													{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
												</label>
											</div>
										</div>
									@endif
								@endforeach
							</div> 
							<div class="row">
								<div class="col text-center">
									<button type="submit" class="secondary-btn primary-btn--md border-0 mt-4">{{ __('Filter') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
				
		


		<form action="{{ route('pagination.number.change') }}" id="paginationCountForm" method="POST">
			@csrf
			<input type="hidden" name="module" value="project-import">
			<input type="hidden" name="number" id="paginationCountInput">
		</form>
		<input type="hidden" id="ProjectLabel" value="{{ $status }}">

		<div id="RenderModal"></div>
		<div id="hugetModal"></div>
		<div id="projectLocationMapModal"></div>
		<div id="similarProjectDeleteModal"></div>
		@foreach (request()->all() as $key => $item)
			@if ($key == 'sub_status') 
				@if ($item && count($item) > 0)
				@foreach ($item as $request_statut)
					<input type="hidden" class="sub_status_request" value="{{ $request_statut }}">
				@endforeach
				@endif
			@elseif ($key == 'department')
				@if ($item && count($item) > 0)
				@foreach ($item as $request_statut)
					<input type="hidden" class="department_request" value="{{ $request_statut }}">
				@endforeach
				@endif
			@elseif ($key == 'bareme')
				@if ($item && count($item) > 0)
				@foreach ($item as $request_statut)
					<input type="hidden" class="bareme_request" value="{{ $request_statut }}">
				@endforeach
				@endif
			@elseif ($key == 'travaux')
				@if ($item && count($item) > 0)
				@foreach ($item as $request_statut)
					<input type="hidden" class="travaux_request" value="{{ $request_statut }}">
				@endforeach
				@endif
			@else
				<input type="hidden" class="all_request" data-key="{{ $key }}" value="{{ $item }}"> 
			@endif
		@endforeach

@include('includes.crm.footer-contact')

@endsection

@push('js')
<script>
	
	$(document).ready(function(){

		var project_id_array = [];
		let huge_filter_modal_status = false;
		$(document).on('change', '#paginationCount', function(){
			$('#paginationCountInput').val($(this).val());
			$('#paginationCountForm').submit();
		});
		var similar_project_id_array = [];
		$('body').on('click', '.similarProjectCheckboxBtn', function(){
			var id = $(this).data('project-id');
			if(similar_project_id_array.indexOf(id)  != -1){
				similar_project_id_array = similar_project_id_array.filter(item => item !== id)
				$('#similar_project_bulk_id').val(similar_project_id_array); 
			}
			else{
				similar_project_id_array.push(id)
				$('#similar_project_bulk_id').val(similar_project_id_array); 
			}
	
			if(similar_project_id_array.length == 0)
			{ 
				$("#similarProjectBulkDeleteBtn").addClass('d-none');
			}else{
				$("#similarProjectBulkDeleteBtn").removeClass('d-none'); 
			}
		});

		$("body").on('click', '#hugeFilterModalBtn', function(){

			if(huge_filter_modal_status){
				$("#hugeFilterModal").modal('show');
			}else{
				let all_request = {};
				$('.all_request').each(function(){ 
                    all_request[$(this).data('key')] = $(this).val();
				});

				let sub_status_request = [];
				$('.sub_status_request').each(function(){ 
                    sub_status_request.push($(this).val());
				}); 

				let department_request = [];
				$('.department_request').each(function(){ 
                    department_request.push($(this).val());
				}); 
				let bareme_request = [];
				$('.bareme_request').each(function(){ 
                    bareme_request.push($(this).val());
				}); 
				let travaux_request = [];
				$('.travaux_request').each(function(){ 
                    travaux_request.push($(this).val());
				}); 

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type : "POST",
					url  : "{{ route('project.huge.filter') }}",
					data : {status:$("#ProjectLabel").val(), 
							all_request:all_request, 
							sub_status_request:sub_status_request, 
							department_request:department_request,
							bareme_request:bareme_request,
							travaux_request:travaux_request,
						},	
					success : response => {
						$('#hugetModal').html(response)
						$("#hugeFilterModal").modal('show')
						huge_filter_modal_status = true;

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
						
					},error : errors => {
					}
				}); 
			}
		});
		
		$('body').on('click', '#projectSimilarCheck', function(){
				let type = $('#projectSimilarType').val();
				if(type){
					$(".full-preloader").fadeIn("slow");
					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type : "POST",
						url  : "{{ route('project.similar.check') }}",
						data : {type},	
						success : response => {
							similar_project_id_array = [];
							$('#similar_project_bulk_id').val(''); 
							$("#similarProjectBulkDeleteBtn").addClass('d-none');						
							$(".full-preloader").fadeOut("slow");
							$("#projectSimilarTableBody").html(response.view); 
							$("#similarProjectDeleteModal").html(response.delete_modal); 
						},error : errors => {
							$(".full-preloader").fadeOut("fast");
							$('#errorMessage').html("Quelque chose a mal tourné");
							$('.toast.toast--error').toast('show');
						}
					}); 
				}else{
					$('#errorMessage').html("Sélectionnez en premier");
					$('.toast.toast--error').toast('show');
					$('#projectSimilarType').focus();
				}
			})
	
		$('body').on('change', '.filterInputChage', function(){ 
			if($(this).val()){
				$(this).addClass('filter-field--active')
			}else{
				$(this).removeClass('filter-field--active')
			} 
		});
		$('body').on('blur', '.filterDateChage', function(){ 
			if($(this).val()){
				$(this).addClass('filter-field--active')
			}else{
				$(this).removeClass('filter-field--active')
			} 
		});
		$("body").on('click','#singleProjectLocation', function(){
			let project_id = project_id_array[0];
			window.open("{{ url('admin/magic/planning/') }}"+'/'+project_id);
		});
	
		$('body').on('change','.project_staus__change', function(){
			$.ajax({
				type : "POST",
				url  : "{{ route('project.status.change.list') }}",
				data : {
					status : $(this).val(),
				},
				success : response => {
					$('#project_sub_staus_new'+$(this).data('id')).html(response);
					if($(this).val() == 7){
						$(this).closest('.status_change__modal').find('.dead_reason__wrap').slideDown();
						$(this).closest('.status_change__modal').find('.dead_reason__wrap').find('.form-control').attr('required', true);
					}else{
						$(this).closest('.status_change__modal').find('.dead_reason__wrap').slideUp();
						$(this).closest('.status_change__modal').find('.dead_reason__wrap').find('.form-control').attr('required', false);
					}
				}
			}) 
		});
	
		$('body').on('click','.status_change__btn', function(){
			$(this).closest('.status_change__modal').find('.status_change__btn_block').slideUp();
			$(this).closest('.status_change__modal').find('.status_change__input').slideDown();
		});
	
	
		$('#projectStatusEditForm').hide();
	
		$('body').on('blur', '.commentTextareaField', function(){
			var currentField = $(this);
			var comment = $(this).val();
			var project_id = $(this).attr('data-id');
			if(currentField.val() != ''){
	
				$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
	
				$.ajax({
					type: "POST",
					url: "{{ route('update.project.comment') }}",
					data: {
						project_id 	: project_id,
						comment   	: comment,
					},
					success: function (response) {
						currentField.val(response.comment);
						$('#successMessage').text(response.alert);
						$('.toast.toast--success').toast('show');
	
	
					},
					error: function(response){
						console.log(response);
					}
				});
			}
		});
		$('body').on('click', '.nav-item__active', function(){
			var tab_id = $(this).attr('data-tab-id');
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
	
				$.ajax({
					type: "POST",
					url: "{{ route('update.active.tab') }}",
					data: {
						id 	: tab_id,
						module : 'project',
					},
					success: function (response) {
	
					},
					error: function(response){
					}
				});
		});
	
	
		$('.tableAllSelectCheck').click(function(){
			project_id_array = [];
			if(this.checked)
			{
			$('.project_checkbox_item').closest('tr').addClass('table-row--active');
			$('.project_checkbox_item').each(function(){
				project_id_array.push($(this).attr('data-id'))
				$('.bulk_selected_project').val(project_id_array);
			});
			} 
			else{
				$('.project_checkbox_item').closest('tr').removeClass('table-row--active');
			}
	 
			if(project_id_array.length == 0)
			{
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				if(project_id_array.length == 1){
					$("#singleProjectLocation").removeClass('d-none');
				}else{
					$("#singleProjectLocation").addClass('d-none');
				}
			} 
		});
	
		$('body').on('click', '.project_checkbox_item', function(){
			var id = $(this).attr('data-id');
			if(project_id_array.indexOf(id)  != -1){
				project_id_array = project_id_array.filter(item => item !== id)
				$('.bulk_selected_project').val(project_id_array);
				$(this).closest('tr').removeClass('table-row--active');
			}
			else{
				project_id_array.push(id)
				$('.bulk_selected_project').val(project_id_array);
				$(this).closest('tr').addClass('table-row--active');
			}
	
			if(project_id_array.length == 0)
			{
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				if(project_id_array.length == 1){
					$("#singleProjectLocation").removeClass('d-none');
				}else{
					$("#singleProjectLocation").addClass('d-none');
				}
			} 
		});
		$('body').on('click', '.project_checkbox_header', function(){ 
			var header = $(this).attr('data-header-code');
			if($(this).is(':checked')){
				$('.project_checkbox_header_code'+header).each(function(){ 
					$(this).prop('checked', true);
					$(this).closest('tr').addClass('table-row--active');
					if(project_id_array.indexOf($(this).attr('data-id'))  == -1){
						project_id_array.push($(this).attr('data-id'))
					}
				});
				$('.bulk_selected_project').val(project_id_array);
			}else{
				$('.project_checkbox_header_code'+header).each(function(){ 
					$(this).prop('checked', false);
					$(this).closest('tr').removeClass('table-row--active');
					if(project_id_array.indexOf($(this).attr('data-id'))  != -1){
						project_id_array = project_id_array.filter(item => item !== $(this).attr('data-id'))
					}
				});
				$('.bulk_selected_project').val(project_id_array); 
			}  
	
			if(project_id_array.length == 0)
			{
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				if(project_id_array.length == 1){
					$("#singleProjectLocation").removeClass('d-none');
				}else{
					$("#singleProjectLocation").addClass('d-none');
				}
			}
		});

		$('body').on('click', '.projectStatusChangeModal', function(){ 
			let id = $(this).data('id');
			let type  = $(this).data('status-type');
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type : "POST",
				url  : "{{ route('project.modal.render') }}",
				data : {id:id, type:type, status:$("#ProjectLabel").val()},
				success : response => {
					$("#RenderModal").html(response);
					if(type == 'sub_status'){
						$("#projectSubStatusChangeModal").modal('show');
					}else{
						$("#project_status__change").modal('show');
					}
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
				}
			}); 
		});
		$('body').on('change', '#importRegieSelector', function(){
			if(!$(this).val()){
				$("#importRegieSelectorWrap").slideUp();
				$("#importRegieTelecommercial").slideUp(function(){
					$(this).remove();
				});
			}else{
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type : "POST",
					url  : "{{ route('project.import.regie.change') }}",
					data : {regie_id : $(this).val()},
					success : response => {
						$(".importRegieSelectorWrap").html(response);
						$(".importRegieSelectorWrap").slideDown();
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
					}
				});
			}
		});

		$('body').on('change', '.leadImportSelectChange', function(){ 
			if($(this).val() != ''){
				$(this).css('background-color', '#64DB31')
				$(this).closest('tr').find('.leadImportSelectExample').val($(this).find(':selected').attr('data-key-value'));
			}else {
				$(this).css('background-color', 'white') 
				$(this).closest('tr').find('.leadImportSelectExample').val('');
			}
		})

		$('body').on('change','#projectFileImportField', function(){
			var form_data = new FormData($('#projectFileImportForm')[0]);
			$.ajax({
				url: "{{ route('project.pre.import-manual') }}",
				type: "post",
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					if(response.data){
						$('#projectImportSubmitButton').removeClass('d-none');
						$('#importError').addClass('d-none');
						$('#projectCsvHeader').html(response.data);
					}
					if(response.error){
						$('#projectCsvHeader').html('');
						$('#projectImportSubmitButton').addClass('d-none');
						$('#importError').removeClass('d-none');
						$('#importError').text(response.error);
					}
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
		$("#project_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTables tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});

		$('body').on('click','.informationUpdateButton', function(){ 
			$(this).closest('td').find(".informationUpdateLoader").removeClass("d-none");
				$(this).addClass("d-none");
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('mpr.info.update') }}",
					data: {
						project_id 			: $(this).data('id'),
					},

					success: (response) => {
						if(response.error){
							$('#errorMessage').html(response.error);
							$('.toast.toast--error').toast('show');
						}else{
							$('#successMessage').html("{{ __('Updated Successfully') }}");
							$('.toast.toast--success').toast('show'); 
						}

						$(this).closest('td').find(".informationUpdateLoader").addClass("d-none");
						$(this).removeClass("d-none");
					},
					error: error => {
						$('#errorMessage').html('{{ __("Something went wrong") }}');
						$('.toast.toast--error').toast('show');

						$(this).closest('td').find(".informationUpdateLoader").addClass("d-none");
						$(this).removeClass("d-none");
					}

				}); 
		});
	});


</script>
@endpush
