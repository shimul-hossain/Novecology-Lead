{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
	Mes Prospects
@endsection

{{-- active menu  --}}
@section('leadIndex')
active
@endsection

{{-- php code  --}}

{{-- main content  --}}
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
				<a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a>
				<div class="row justify-content-center">
					<div class="col-12">
						<h1 class="ml-lg-5 text-white">{{  __('All Leads') }}</h1>
					</div>
					<div class="col-12 pb-3">
                        <div class="row">
                            <div class="col-lg">
                                <input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input rounded" id="all_lead_search_bar">
                            </div>
                            <div class="col-md-auto">
                                <div class="button-group-spacing">
                                    <div class="dropdown p-0 d-none" id="allActionButton">
                                        <button type="button" class="primary-btn primary-btn--white primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 Actions sur vos prospects
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($user_actions->where('module_name', 'lead')->where('action_name', 'assign')->first() || $role == 's_admin')
                                                <button type="button" class="dropdown-item border-0" id="leadBulkAssignFormButton" form="leadBulkAssignForm" data-toggle="modal" data-target="#middleModal3">
                                                    Attribuer un télécommercial
                                                </button> 
                                            @endif
                                            @if ($user_actions->where('module_name', 'lead')->where('action_name', 'assign_supplier')->first() || $role == 's_admin') 
                                                <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#middleModal4">
                                                    Attribuer un fournisseur de lead
                                                </button>
                                            @endif
											@if ($status == 1)
												@if ($role == 's_admin')
													<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#regieAssignModal">
														Attribuer un regie
													</button>
												@endif
                                            @endif
											@if ($user_actions->where('module_name', 'lead')->where('action_name', 'reset')->first() || $role == 's_admin')
												<form action="{{ route('lead.tracking.date.update') }}" method="POST">
													@csrf
													<input type="hidden" name="ids" class="bulk_selected_lead">
													<button type="submit" class="dropdown-item border-0">
														Remise à zéro des prospects
													</button>
												</form>
											@endif
                                            {{-- @if (checkAction(Auth::id(), 'lead', 'assign') || $role == 's_admin')
                                                <form action="{{ route('lead.bulk.unassign') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="ids" class="bulk_selected_lead">
                                                    <button type="submit" class="dropdown-item border-0">
                                                        Désattribuer télécommercial
                                                    </button>
                                                </form>
                                            @endif --}}
                                           @if ($user_actions->where('module_name', 'lead')->where('action_name', 'delete')->first() || $role == 's_admin')
                                                <button type="button" class="dropdown-item border-0" id="leadDeleteFormButton">
                                                    Supprimer lead
                                                </button>
                                            @endif
                                            @if ($status == 1)
                                                @if ($user_actions->where('module_name', 'lead')->where('action_name', 'dispatch')->first() || $role == 's_admin')
                                                <button type="button" class="dropdown-item border-0" id="distribute-modalbtn">
                                                    Dispatcher
                                                </button>
                                                @endif
                                            @endif
											@if ($user_actions->where('module_name', 'lead')->where('action_name', 'bulk_status')->first() || $role == 's_admin')
												<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#bulkStatutChangeModal">
													Changer statut 
												</button>
                                            @endif
											@if ($role == 's_admin')
												<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#remizeZeroNewAssign">
													Remise a zero des prospect + nouvelle assignation 
												</button>
                                            @endif
												<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
												{{-- <button type="button" class="dropdown-item border-0" id="Click2CopyNumber"> 
													Copier numéro de téléphone
												</button>  --}}
                                        </div>
                                    </div>

                                    @if ($user_actions->where('module_name', 'lead')->where('action_name', 'create')->first() || $role == 's_admin')
                                    <form action="{{ route('create-leads.index') }}" method="POST" class="d-inline-block">
                                        @csrf
                                        <button type="submit" class="primary-btn primary-btn--white primary-btn--md rounded d-inline-flex align-items-center justify-content-center border-0">
                                            <i class="bi bi-plus-lg mr-1"></i>{{ __('Create New Lead') }}
                                        </button>
                                    </form>
                                    @endif
                                    @if ($user_actions->where('module_name', 'lead')->where('action_name', 'import')->first() || $role == 's_admin')
                                        <button class="primary-btn primary-btn--white primary-btn--md rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#leadImportModal">
                                            {{ __('Import a lead') }}
                                        </button>
                                   @endif
								   @if ($user_actions->where('module_name', 'lead')->where('action_name', 'add_filter')->first() || $role == 's_admin')
								   		<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 rounded shadow-none">+ {{ __('Add filter') }}</button>
								   @endif
									@if ($statut_blue_button_access || $role == 's_admin')
										<button id="hugeFilter" type="button" class="btn border-0 rounded" style="background-color:#42a5f6">
											<svg width="2em" height="1em" viewBox="0 0 44 21" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M43.7307 9.3913C43.7116 9.34324 43.6796 9.30222 43.6387 9.27336C43.5978 9.24449 43.5498 9.22907 43.5007 9.229H32.5005C32.4513 9.2289 32.4031 9.24424 32.3621 9.27309C32.321 9.30194 32.2889 9.34302 32.2697 9.39118C32.2506 9.43934 32.2452 9.49244 32.2543 9.54382C32.2634 9.59521 32.2866 9.64259 32.321 9.68004L37.821 15.6903C37.8443 15.7158 37.8721 15.736 37.9029 15.7499C37.9337 15.7637 37.9668 15.7708 38.0002 15.7708C38.0336 15.7708 38.0667 15.7637 38.0975 15.7499C38.1283 15.736 38.1562 15.7158 38.1795 15.6903L43.6795 9.67977C43.7137 9.64233 43.7368 9.595 43.7459 9.5437C43.755 9.4924 43.7496 9.43939 43.7305 9.3913H43.7307Z" fill="white"/>
												<path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 9.125H28.25V11.875H0.75V9.125ZM0.75 0.875H28.25V3.625H0.75V0.875ZM0.75 17.375H28.25V20.125H0.75V17.375Z" fill="white"/>
											</svg>
										</button>
									@endif
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-12">
						<ul class="nav nav-pills" id="tables-pills-tab" role="tablist">
							@foreach ($lead_status as $key => $item_data)
								@if (\Auth::id() == '102' && $item_data->id == 7)
									@continue
								@endif
								<li class="nav-item" role="presentation" data-tab-id="{{ $key }}">
									<a
									@if ($status)
										@if ($item_data->id == $status)
											style="color: {{ $item_data->status_color }}; background-color:{{ $item_data->background_color }}"
										@endif
									@else
										@if ($item_data->id == '2')
										style="color: {{ $item_data->status_color }}; background-color:{{ $item_data->background_color }}"
										@endif
									@endif
									class="nav-link border-0 {{ $status ? ($item_data->id == $status ? 'active':''): ($item_data->id == '2'? 'active':'') }}"  href="{{ route('leads.all', $item_data->id) }}"> {{ $item_data->status }} @if ($item_data->id == $status)<span class="border ml-2 p-1 rounded-pill">{{ $leads->total() }}</span>@endif</a>
								</li>
							@endforeach
							<li class="ml-auto">
								@if ($user_actions->where('module_name', 'lead')->where('action_name', 'similar-prospect')->first() || $role == 's_admin')
									<button type="button" class="primary-btn primary-btn--white primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#similarLeadModal">
										Analyse doublons
									</button>
								@endif
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
													<th>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" name="checkAll" data-id="" value="1" class="custom-control-input table-all-select-checkbox lead_checkbox_all" id="progress_lead_custom_check-">
															<label class="custom-control-label" for="progress_lead_custom_check-"></label>
														</div>
													</th>
													@if ($filter_status->count() == 0) 
														@foreach ($default_filters as $item) 
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

													<th>
														{{ __('Status') }}
													</th>

													<th>
														Télécommerciale
													</th>
													{{-- @if ($status == 1)
														<th>
															Importer régie
														</th>
                                            		@endif	 --}}
													@if ($statut_blue_button_access || $role == 's_admin')
														<th class="text-center">
															{{ __('Actions') }}
														</th>
													@endif
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
											   @forelse ($leads as $lead)
													@if ($x_code != substr($lead->Code_Postal, 0,2))
														@php 
															$header_code = $lead->id.rand(0000,9999);
														@endphp
														<tr>
															<td style="background-color: #13438c">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" value="{{ $lead->id }}" class="custom-control-input table-select-checkbox lead_checkbox_header" data-header-code="{{ $header_code }}" id="tableThreeRowSelectCheckHeader-{{ $lead->id }}">
																	<label class="custom-control-label" for="tableThreeRowSelectCheckHeader-{{ $lead->id }}"></label>
																</div>
															</td>
															<td colspan="500" class="text-white" style="background-color: #13438c">{{ $lead->Code_Postal ? getDepartment3($lead->Code_Postal).' ('.substr($lead->Code_Postal, 0,2).') - '.getPrimaryZone($lead->Code_Postal) : __('No Department') }}</td>
														</tr>
													@endif
													<tr>
														<td>
															<div class="custom-control custom-checkbox">
																<input type="checkbox"name="checkedLead[]" value="{{ $lead->id }}" class="custom-control-input table-select-checkbox lead_checkbox_item lead_checkbox_header_code{{ $header_code }}" data-id="{{ $lead->id }}"  id="tableThreeRowSelectCheck-{{ $lead->id }}">
																<label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $lead->id }}"></label>
															</div>
														</td>
														@foreach ($default_filters as $item)
															@php
																$header = $item->getHeader->header;
															@endphp
															<td>{{ $lead->$header ??__('Not Provided') }}</td>
														@endforeach
														<td class="text-left">
															<button style="background-color:{{ $lead->getSubStatus ? $lead->getSubStatus->background_color : '#13438c' }} ; color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#fff' }}" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 leadStatusChangeModal" data-status-type="sub_status" data-id="{{ $lead->id }}">
																{{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->lead_label == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
															</button>
														</td>
														<td>
															<div class="avatar-group d-flex">
																@if ($lead->leadTelecommercial)
																	<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $lead->leadTelecommercial->name }}">
																		@if ($lead->leadTelecommercial->profile_photo)
																		<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $lead->leadTelecommercial->profile_photo }}" alt="{{ $lead->leadTelecommercial->name }}" class="avatar-group__image w-100 h-100" >
																		@else
																		<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																		@endif
																	</a>
																@else
																	{{ __('No assignee') }}
																@endif
															</div>
														</td>
														{{-- @if ($status == 1)
															<td>
																{{ $lead->getRegie->name ?? '' }}
															</td>
                                            			@endif --}}
														@if ($statut_blue_button_access || $role == 's_admin')
															<td class="text-center">
																@if ($lead->lead_label == 7)
																	<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle" data-toggle="tooltip" data-placement="top" title="Le prospect est converti"><span class="novecologie-icon-chevron-right"></span></button>
																@else
																	@if ($lead->lead_label == 6)
																		@if (Auth::user()->getRoleName->category_id != 1)
																			<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle leadStatusChangeModal" data-status-type="status" data-id="{{ $lead->id }}"><span class="novecologie-icon-chevron-right"></span></button>
																		@else
																			<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle" data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"><span class="novecologie-icon-chevron-right"></span></button>
																		@endif
																	@else
																		<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle leadStatusChangeModal" data-status-type="status" data-id="{{ $lead->id }}"><span class="novecologie-icon-chevron-right"></span></button>
																	@endif
																@endif 
															</td>
														@endif
														<td>
															<div class="d-flex align-items-center justify-content-end action-btns-wrapper">
																<a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
																	{{ __('Update') }}
																</a>
															</div>
														</td>
													</tr>
													@php
														$x_code = substr($lead->Code_Postal, 0,2);
													@endphp 
											   @empty
											   <tr>
												   <td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
											   </tr>
											   @endforelse
										   @else
											   @forelse ($leads as $lead)
													@if ($x_code != substr($lead->Code_Postal, 0,2))
														@php 
															$header_code = $lead->id.rand(0000,9999);
														@endphp
														<tr>
															<td style="background-color: #13438c">
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" value="{{ $lead->id }}" class="custom-control-input table-select-checkbox lead_checkbox_header" data-header-code="{{ $header_code }}" id="tableThreeRowSelectCheckHeader-{{ $lead->id }}">
																	<label class="custom-control-label" for="tableThreeRowSelectCheckHeader-{{ $lead->id }}"></label>
																</div>
															</td>
															<td colspan="500" class="text-white" style="background-color: #13438c">{{ $lead->Code_Postal ? getDepartment3($lead->Code_Postal). ' ('.substr($lead->Code_Postal, 0,2).') - '.getPrimaryZone($lead->Code_Postal) : __('No Department') }}</td>
														</tr>
													@endif
													<tr>
														<td>
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="checkedLead[]"  value="{{ $lead->id }}" class="custom-control-input table-select-checkbox lead_checkbox_item lead_checkbox_header_code{{ $header_code }}"  data-id="{{ $lead->id }}" id="tableThreeRowSelectCheck-{{ $lead->id }}">
																<label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $lead->id }}"></label>
															</div>
														</td>
														@foreach ($filter_status as $item)
															@php
																$header = $item->getHeader->header;
															@endphp
															@if ($header == '__tracking__Fournisseur_de_lead')
																<td>{{ $lead->getSupplier->suplier ??__('Not Provided') }}</td>
															@elseif($header == 'Régie')
																@if ($status == 1)
																	<td>
																		{{ $lead->getRegie->name ?? __('No Regie') }}
																	</td>
																@else
																	<td>
																		@if ($lead->leadTelecommercial)
																			{{ $lead->leadTelecommercial->getRegie->name ?? __('No Regie') }}
																		@else
																			{{ __('No Regie') }}
																		@endif
																	</td>
																@endif
															@elseif($header == 'Ville_des_travaux')
																<td>{{ $lead->Ville ??__('Not Provided') }}</td>
															@elseif ($header == 'Département_des_travaux')
																<td>{{ $lead->Département ??__('Not Provided') }}</td>
															@elseif ($header == 'TAG') 
																<td>
																	@foreach ($lead->LeadTravaxTags as $tag)
																		{{ $tag->tag }} {{ $loop->last ? '':', ' }}
																	@endforeach 
																</td>
															{{-- @elseif ($header == 'Statut_Projet')
																@if ($lead->$header)
																	<td class="text-left">
																		<button style="background-color: {{ $lead->$header == 'Devis signé' ? 'green' : ($lead->$header == 'Réflexion' ? '#00E3EB':'red') }}" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>
																	</td>
																@else
																	<td>
																		{{ __('Not Provided') }}
																	</td>
																@endif --}}
															@elseif ($header == 'Type_de_contrat')
																<td>
																	@if ($lead->$header == 'Credit')
																		<button style="background-color: #00818E; color:ffffff" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>
																	@elseif ($lead->$header == 'MaPrimeRenov')
																		<button style="background-color: #B2E6D9; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>	
																	@elseif ($lead->$header == 'BAR TH 164 – 2022')
																		<button style="background-color: #ff0000; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>	
																	@elseif ($lead->$header == 'BAR TH 164 – 2023')
																		<button style="background-color: #F8A0EE; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>	
																	@elseif ($lead->$header == 'BAR TH 164 – 2023 (après 01/07/2023)')
																		<button style="background-color: #9BB8CD; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>	
																	@elseif ($lead->$header == 'BAR TH 145')
																		<button style="background-color: #EADFB4; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>	
																	@elseif ($lead->$header == 'BAR TH 173')
																		<button style="background-color: #FFB996; color:000000" type="button" class="primary-btn primary-btn--sm rounded border-0">
																			{{ $lead->$header }}
																		</button>	
																	@else
																			{{ __('Not Provided') }}
																	@endif
																</td>
															@elseif ($header == 'Travaux_formulaire')
																<td>
																	{{ getCustomFieldData('travaux_formulaire', $lead->lead_tracking_custom_field_data) ??__('Not Provided') }}
																</td>
															@else
																<td>{{ $lead->$header ??__('Not Provided') }}</td>
															@endif 
														@endforeach
														<td class="text-left">
															<button style="background-color:{{ $lead->getSubStatus ? $lead->getSubStatus->background_color : '#13438c' }} ; color: {{ $lead->getSubStatus ? $lead->getSubStatus->text_color : '#fff' }}" type="button" class=" primary-btn primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 leadStatusChangeModal" data-status-type="sub_status" data-id="{{ $lead->id }}">
																{{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->lead_label == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}
															</button>
														</td>

														<td>
															<div class="avatar-group d-flex">
																@if ($lead->leadTelecommercial)
																	<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $lead->leadTelecommercial->name }}">
																		@if ($lead->leadTelecommercial->profile_photo)
																		<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $lead->leadTelecommercial->profile_photo }}" alt="{{ $lead->leadTelecommercial->name }}" class="avatar-group__image w-100 h-100">
																		@else
																		<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																		@endif
																	</a>
																@else
																	{{ __('No assignee') }}
																@endif
															</div>
														</td>
														{{-- @if ($status == 1)
															<td>
																{{ $lead->getRegie->name ?? '' }}
															</td>
                                            			@endif --}}

														@if ($statut_blue_button_access || $role == 's_admin')
															<td class="text-center">
																@if ($lead->lead_label == 7)
																	<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle" data-toggle="tooltip" data-placement="top" title="Le prospect est converti"><span class="novecologie-icon-chevron-right"></span></button>
																@else
																	@if ($lead->lead_label == 6)
																		@if (Auth::user()->getRoleName->category_id != 1)
																			<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle leadStatusChangeModal" data-status-type="status" data-id="{{ $lead->id }}"><span class="novecologie-icon-chevron-right"></span></button>
																		@else
																			<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle" data-toggle="tooltip" data-placement="top" title="Ce prospect est validé"><span class="novecologie-icon-chevron-right"></span></button>
																		@endif
																	@else
																		<button type="button" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle leadStatusChangeModal" data-status-type="status" data-id="{{ $lead->id }}"><span class="novecologie-icon-chevron-right"></span></button>
																	@endif
																@endif 
															</td>
														@endif
														<td>
															<div class="d-flex align-items-center justify-content-center action-btns-wrapper">
																<a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
																	{{ __('Update') }}
																</a>
															</div>
														</td>
													</tr>
												   @php
													   $x_code = substr($lead->Code_Postal, 0,2);
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
									@if ($leads instanceof \Illuminate\Pagination\AbstractPaginator)
										<div class="pagination-wrapper">
											{{-- {{ $leads->onEachSide(1)->links() }} --}}
											{{-- {{ $leads->appends(['__tracking__Fournisseur_de_lead' => request()->__tracking__Fournisseur_de_lead])->render() }} --}}
											{{ $leads->appends(
												['__tracking__Fournisseur_de_lead' => request()->__tracking__Fournisseur_de_lead,
												'__tracking__Type_de_campagne' => request()->__tracking__Type_de_campagne,
												'__tracking__Nom_campagne' => request()->__tracking__Nom_campagne,
												'__tracking__Date_demande_lead_from' => request()->__tracking__Date_demande_lead_from,
												'__tracking__Date_demande_lead_to' => request()->__tracking__Date_demande_lead_to,
												'__tracking__Date_attribution_télécommercial' => request()->__tracking__Date_attribution_télécommercial, 
												'__tracking__Mode_de_chauffage' => request()->__tracking__Mode_de_chauffage, 
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
												'Type_de_contrat' => request()->Type_de_contrat,
												'sub_status' => request()->sub_status,
												'telecommercial_id' => request()->telecommercial_id,
												'regie' => request()->regie,
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
		<!-- Middle Modal -->

		<!-- Right Aside Modal -->
		<div class="modal modal--aside fade rightAsideModal" id="rightAsideModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content simple-bar border-0 h-100 rounded-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<h1 class="modal-title text-center">{{ __('Additional filters') }}</h1>
						<p class="modal-text text-center mb-5">{{ __('Filter your tables with your custom columns') }}</p>
						<form action="{{ route('lead.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
							@csrf
							<h2 class="modal-sub-title position-relative">{{ __('Lead Tracking (Form and response)') }}</h2>
							<div class="row">
								@foreach ($headers as $key => $header)
									@if ($header->header == 'id'
										|| $header->header == '__tracking__Fournisseur_de_lead'
										|| $header->header == '__tracking__Type_de_campagne'
										|| $header->header == '__tracking__Nom_campagne'
										// || $header->header == '__tracking__Date_demande_lead'
										// || $header->header == '__tracking__Date_attribution_télécommercial'
										// || $header->header == '__tracking__Type_de_travaux_souhaité'
										|| $header->header == '__tracking__Nom_Prénom'
										|| $header->header == '__tracking__Code_postal'
										|| $header->header == '__tracking__Email'
										|| $header->header == '__tracking__téléphone'
										|| $header->header == '__tracking__Département'
										|| $header->header == '__tracking__Mode_de_chauffage'
										|| $header->header == '__tracking__Propriétaire'
										|| $header->header == 'Travaux_formulaire'
										// || $header->header == '__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans'
										)
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="lead_tracking-{{ $key }}" name="header_id[]"
												@if ($filter_status->count() > 0)
													@foreach ($filter_status as $item)
														@if ( $header->id == $item->lead_header_id)
															checked
														@endif
													@endforeach
												@else
													{{-- @foreach ($default_filters as $item) --}}
														@if (in_array($header->id, $default_filter_header_id))
															checked
														@endif
													{{-- @endforeach --}}
												@endif
												>
												<label class="custom-control-label" for="lead_tracking-{{ $key }}">
													@if ($header->header == 'fixed_number')
														N° Fixe
													@elseif ($header->header == 'phone')
														N° Mobile
													@elseif ($header->header == 'Consommation_Chauffage_Annuel_2')
														Consommation Chauffage Annuel (litres,kWh,m3)
													@elseif ($header->header == 'auxiliary_heating_status')
														Le logement possède t - il un chauffage d’appoint ?
													@elseif ($header->header == 'auxiliary_heating')
														Le logement possède t - il un chauffage d’appoint
													@elseif ($header->header == 'second_heating_generator_status')
														La maison possède-t-elle un second générateur de chauffage
													@elseif ($header->header == 'second_heating_generator')
														La maison possède-t-elle un second générateur de chauffage
													@elseif ($header->header == '__tracking__Nom_Prénom')
														Nom Prénom Lead
													@elseif ($header->header == '__tracking__téléphone')
														Téléphone
													@elseif ($header->header == 'advance_visit')
														Disponibilité pour prévisite (jour /horaire)
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
										|| $header->header == 'Adresse'
										|| $header->header == 'Complément_adresse'
										|| $header->header == 'Code_Postal'
										|| $header->header == 'Ville'
										|| $header->header == 'Département'
										|| $header->header == 'Email'
										|| $header->header == 'phone'
										|| $header->header == 'fixed_number'
										// || $header->header == 'Observations'
										)
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="informations_personnelles-{{ $key }}" name="header_id[]"
													@if ($filter_status->count() > 0)
														@foreach ($filter_status as $item)
															@if ( $header->id == $item->lead_header_id)
																checked
															@endif
														@endforeach
													@else
														{{-- @foreach ($default_filters as $item)
															@if ( $header->id == $item->header_id)
																checked
															@endif
														@endforeach --}}
														@if (in_array($header->id, $default_filter_header_id))
															checked
														@endif
	
													@endif
												>
												<label class="custom-control-label" for="informations_personnelles-{{ $key }}">
													@if ($header->header == 'fixed_number')
														N° Fixe
													@elseif ($header->header == 'phone')
														N° Mobile
													@elseif ($header->header == 'Consommation_Chauffage_Annuel_2')
														Consommation Chauffage Annuel (litres,kWh,m3)
													@elseif ($header->header == 'auxiliary_heating_status')
														Le logement possède t - il un chauffage d’appoint ?
													@elseif ($header->header == 'auxiliary_heating')
														Le logement possède t - il un chauffage d’appoint
													@elseif ($header->header == 'second_heating_generator_status')
														La maison possède-t-elle un second générateur de chauffage
													@elseif ($header->header == 'second_heating_generator')
														La maison possède-t-elle un second générateur de chauffage
													@elseif ($header->header == 'advance_visit')
														Disponibilité pour prévisite (jour /horaire)
													@else
														{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
													@endif
												</label>
											</div>
										</div>
									@endif
								@endforeach
							</div>     
							@if ($permission_regies)
								<h2 class="modal-sub-title position-relative mt-3">Autres</h2>
								<div class="row">
									@foreach ($headers as $key => $header)
										@if ($header->header == 'Régie'
											|| $header->header == 'Ville_des_travaux'
											|| $header->header == 'Département_des_travaux'
											|| $header->header == 'TAG'
											// || $header->header == 'Statut_Projet'
											|| $header->header == 'Type_de_contrat'
										)
											<div class="col-md-4">
												<div class="custom-control custom-checkbox">
													<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="collpase-autres-{{ $key }}" name="header_id[]"
														@if ($filter_status->count() > 0)
															@foreach ($filter_status as $item)
																@if ( $header->id == $item->lead_header_id)
																	checked
																@endif
															@endforeach  
														@endif
													>
													<label class="custom-control-label" for="collpase-autres-{{ $key }}">
														{{ str_replace('_',' ',$header->header) }}
													</label>
												</div>
											</div>
										@endif
									@endforeach
								</div> 
							@endif
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
	
	
		<!-- Middle Modal -->
		<div class="modal modal--aside fade" id="regieAssignModal" tabindex="-1" aria-labelledby="regieAssignModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.bulk.regie.assign') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">Attribuer un regie</h1>
							<div class="form-group d-flex flex-column align-items-center position-relative" id="bu" >
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
								<select class="select2_select_option form-control w-100" name="regie_id" required>
									@foreach ($regies as $regie)
										<option value="{{ $regie->id }}">{{ $regie->name }}</option>
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
		<div class="modal modal--aside fade" id="remizeZeroNewAssign" tabindex="-1" aria-labelledby="remizeZeroNewAssignLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.bulk.remise.zero.regie.assign') }}" method="POST" class="form mx-auto needs-validation" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4"> REMISE A ZERO DES PROSPECT <br> Attribuer un regie</h1>
							<div class="form-group d-flex flex-column align-items-center position-relative" id="bu" >
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
								<select class="select2_select_option form-control w-100" name="regie_id" required>
									@foreach ($regies as $regie)
										<option value="{{ $regie->id }}">{{ $regie->name }}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{__('Submit')}}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Middle Modal -->
		<div class="modal modal--aside fade" id="middleModal3" tabindex="-1" aria-labelledby="middleModal3Label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.bulk.assign') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">{{__('Assign Leads')}}</h1>
							<div class="form-group d-flex flex-column align-items-center position-relative" id="bu" >
								<input type="hidden" name="lead_id" id="lead_id_assignee">
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
								<select class="select2_select_option form-control w-100" name="user_id" required>
									@foreach ($telecommercials as $user)
										<option value="{{ $user->id }}">{{ $user->name }}</option>
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
		<div class="modal modal--aside fade" id="middleModal4" tabindex="-1" aria-labelledby="middleModal4Label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.bulk.assign.supplier') }}" method="POST" class="form mx-auto needs-validation" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">Attribuer un fournisseur de lead</h1>
							<div class="form-group d-flex flex-column align-items-center position-relative"> 
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
								<select class="select2_select_option form-control w-100" name="supplier_id" required> 
									@foreach ($suppliers as $supplier)
										<option value="{{ $supplier->id }}">{{ $supplier->suplier }}</option>
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
	
		<div class="modal modal--aside fade" id="leadBulkDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
						<form  action="{{ route('lead.bulk.delete') }}" method="post">
							@csrf
							<div id="du">
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
							</div>
	
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
	
		<!-- Lead Import Modal -->
		<div class="modal modal--aside fade" id="leadImportModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-dialog-centered">
			<div class="modal-content border-0">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body pt-0">
					<form action="{{ route('leads.import') }}" class="form" id="leadFileImportForm" method="POST" enctype="multipart/form-data">
						@csrf
						<h1 class="form__title position-relative text-center mb-4">Importer un prospect</h1>
						<span id="importError" class="text-danger"></span>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input type="file" name="file" class="custom-file-input" id="leadFileImportField" aria-describedby="inputGroupFileAddon01" required>
								<label class="custom-file-label" for="leadFileImportField">Choisir le fichier</label>
							</div>
						</div>
						<div id="leadCsvHeader">
	
						</div>
						<div class="text-center mt-3">
							<div class="lead__card__loader-wrapper d-none" id="leadImportLoader">
								<div class="lead__card__loader">
									<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
										<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
										<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
										</path>
									</svg>
								</div>
							</div>
							<button type="submit" id="leadImportSubmitButton" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0">
								{{ __('Import') }} <span class="novecologie-icon-arrow-right ml-3"></span>
							</button>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
	
	
		<div class="modal modal--aside fade" id="bulkStatutChangeModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
						<form action="{{ route('lead.status.change.bulk') }}" method="POST" class="status_change__modal">
							@csrf
							<input type="hidden" name="selected_id" class="bulk_selected_lead">
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
									<label class="form-label" for="lead_staus_newbulk">Merci de renseigner le nouveau etiquette de votre prospect</label>
									<select name="status" id="lead_staus_newbulk" data-id="bulk" class="select2_select_option custom-select shadow-none form-control lead_staus__change" required>
										<option value="" selected disabled>{{ __('Select') }}</option>
										<option {{ $status == 2 ? 'selected':'' }} value="2">Nouveau</option>
										<option {{ $status == 3 ? 'selected':'' }} value="3">En cours</option>
										<option {{ $status == 4 ? 'selected':'' }} value="4">NRP</option>
										<option {{ $status == 5 ? 'selected':'' }} value="5">KO</option>
										<option {{ $status == 6 ? 'selected':'' }} value="6">Validation</option>
									</select>
								</div>
								<div class="form-group mt-3">
									<label class="form-label" for="lead_sub_staus_newbulk">Merci de renseigner le nouveau statut de votre prospect</label>
									<select name="sub_status" id="lead_sub_staus_newbulk" class="select2_select_option custom-select shadow-none form-control" required>
										<option value="" selected disabled>{{ __('Select') }}</option>
										@if ($status == 2)
											<option selected value="0">Nouvelle demande</option>	
										@endif
										@foreach ($lead_sub_status as $sub_status)
											@if ($status == 6)
												@if ($sub_status->id == 25)
												<option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
												@endif 
												@if (\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4)
													@if ($sub_status->id == 52 || $sub_status->id == 53 || $sub_status->id == 54 || $sub_status->id == 50 || $sub_status->id == 56)
														<option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
													@endif
												@endif
											@else
												@if ($sub_status->id != 5)
													<option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
												@endif
											@endif
										@endforeach
									</select>
								</div>
								<div class="form-group dead_reason__wrap" style="display: {{ $status == '5' ? '':'none' }}">
									<label class="form-label" for="dead-reasonbulk">Raisons</label>
									<textarea rows="3" name="dead_reason" id="dead-reasonbulk" class="form-control shadow-none"></textarea>
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
		

		<div class="modal modal--aside fade" id="similarLeadModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-extra-large modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">  
						<div class="form-group">
							<label class="form-label" for="Mode_de_chauffage">Sélectionnez le type</label>
							<select class="select2_select_option form-control w-100" id="leadSimilarType" required>
								<option value="" selected>{{ __('Select') }}</option>
								<option value="Nom">Nom</option>
								<option value="Prenom">Prenom</option>
								<option value="Adresse">Adresse</option>
								<option value="phone">Téléphone</option>
							</select>
						</div>
						<div class="text-center">
							<button type="button" id="leadSimilarCheck" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
								{{ __('Submit') }}
							</button>
						</div>
						<hr>
						<div class="alert bg-danger mb-0 text-white text-center">
                            <div class="alert-body">Attention, dossier(s) similaire(s) déja saisi(s).</div>
                        </div>
						@if ($role == 's_admin')
							<div class="text-right">
								<button type="button" data-toggle="modal" data-target="#similarLeadBulkDelete" id="similarLeadBulkDeleteBtn" class="primary-btn btn-danger primary-btn--md rounded border-0 m-2 shadow-none d-none">Supprimer</button>
							</div>
						@endif
						<div class="database-table-wrapper bg-white">
							<div class="table-responsive  simple-bar">
								<table class="table dynamic-table" id="leadSimilarTableBody">
									<thead>
										<tr> 
                                            <th></th>
                                            <th>ID</th>
                                            <th>Client</th>  
                                            <th>Adresse</th>  
                                            <th>Code postal</th>  
                                            <th>TAG</th>
                                            <th>Téléphone</th>  
                                            <th>Etiquette</th>  
                                            <th>Statut</th>  
                                            <th>Telecommercial</th>  
											@if ($user_actions->where('module_name', 'lead')->where('action_name', 'similar-prospect-link')->first() || $role == 's_admin')
												<th>LIEN</th>  
											@endif
										</tr>
									</thead>
									<tbody> 
										<tr>
											<td colspan="2000"><h3 class="text-center">Aucun résultat trouvé.</h3></td>
										</tr> 
									</tbody>
								</table>
							</div> 
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="modal modal--aside fade" id="similarLeadBulkDelete" tabindex="-1" aria-labelledby="similarLeadBulkDeleteModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>{{ __('Are You Sure To Delete this') }} ?</span>
						<form action="{{ route('similar.lead.bulk.delete') }}" method="POST">
							@csrf
							<input type="hidden" name="similar_lead_bulk_id" id="similar_lead_bulk_id" value="">
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

		<form action="{{ route('pagination.number.change') }}" id="paginationCountForm" method="POST">
			@csrf
			<input type="hidden" name="module" value="lead">
			<input type="hidden" name="number" id="paginationCountInput">
		</form>
		<input type="hidden" id="leadLabel" value="{{ $status }}">
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
		<div id="RenderModal"></div>
		<div id="dispatchModal"></div>
		<div id="DefaultModal"></div>
		<div id="similarLeadDeleteModal"></div>
		<div id="hugeFilterRenderModal"></div>
		@include('includes.crm.footer-contact')
@endsection

@push('js')
<script>
	function countTotalInput(){
		var inputValue = 0;
		$('.number-spinner__input').each(function(){
			inputValue += +$(this).val();
		});
		return inputValue;
	}
	$(document).ready(function(){
		var similar_lead_id_array = [];
		let huge_filter_status = false;
		$('body').on('click', '.similarLeadCheckboxBtn', function(){
			var id = $(this).data('lead-id');
			if(similar_lead_id_array.indexOf(id)  != -1){
				similar_lead_id_array = similar_lead_id_array.filter(item => item !== id)
				$('#similar_lead_bulk_id').val(similar_lead_id_array); 
			}
			else{
				similar_lead_id_array.push(id)
				$('#similar_lead_bulk_id').val(similar_lead_id_array); 
			}

			if(similar_lead_id_array.length == 0)
			{ 
				$("#similarLeadBulkDeleteBtn").addClass('d-none');
			}else{
				$("#similarLeadBulkDeleteBtn").removeClass('d-none'); 
			}
		});
		
		$('body').on('change', '.filterInputChage', function(){ 
			 if($(this).val()){
				$(this).addClass('filter-field--active')
			}else{
				 $(this).removeClass('filter-field--active')
			 } 
		});

		$('body').on('click', '#leadSimilarCheck', function(){
			let type = $('#leadSimilarType').val();
			if(type){
				$(".full-preloader").fadeIn("slow");
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type : "POST",
					url  : "{{ route('lead.similar.check') }}",
					data : {type},	
					success : response => {
						$('#similar_lead_bulk_id').val(''); 
						$("#similarLeadBulkDeleteBtn").addClass('d-none');
						similar_lead_id_array = [];
						$(".full-preloader").fadeOut();
						$("#leadSimilarTableBody").html(response.view); 
						$("#similarLeadDeleteModal").html(response.delete_modal); 
					},error : errors => {
						$(".full-preloader").fadeOut("fast");
						$('#errorMessage').html("Quelque chose a mal tourné");
						$('.toast.toast--error').toast('show');
					}
				}); 
			}else{
				$('#errorMessage').html("Sélectionnez en premier");
				$('.toast.toast--error').toast('show');
				$('#leadSimilarType').focus();
			}
		})


		$('body').on('blur', '.filterDateChage', function(){ 
			 if($(this).val()){
				$(this).addClass('filter-field--active')
			}else{
				 $(this).removeClass('filter-field--active')
			 } 
		});
		let dispatch_modal_status = false;
		$('body').on('click', '#distribute-modalbtn', function(){ 
			if(dispatch_modal_status){
				$("#distribute-modal").modal('show');
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
			}else{
				let status = $("#leadLabel").val();
			   $.ajaxSetup({
				   headers: {
					   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				   }
			   });
			   $.ajax({
				   type : "POST",
				   url  : "{{ route('lead.dispatch.render') }}",
				   data : {status},
				   success : response => {
					   $("#dispatchModal").html(response);
					   $("#distribute-modal").modal('show');
					   $('.bulk_selected_lead').val(lead_id_array);
				   	   $('#selectedLeadCount').text(lead_id_array.length);
					   dispatch_modal_status = true;

				   }
			   }); 
			}
		});
		$('body').on('click', '.leadStatusChangeModal', function(){ 
			let id = $(this).data('id');
			let type  = $(this).data('status-type');
			let status = $("#leadLabel").val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type : "POST",
				url  : "{{ route('lead.modal.render') }}",
				data : {id, type, status},
				success : response => {
					$("#RenderModal").html(response);
					if(type == 'sub_status'){
						$("#leadSubStatusChangeModal").modal('show');
					}else{
						$("#lead_status__change").modal('show');
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
		$('body').on('click', '#hugeFilter', function(){ 
			if(huge_filter_status){
				$("#filterModal").modal('show');
			}else{
				let status = $("#leadLabel").val();
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
					url  : "{{ route('lead.huge.filter') }}",
					data : {status:status, 
							all_request:all_request, 
							sub_status_request:sub_status_request, 
							department_request:department_request, 
							bareme_request:bareme_request,
							travaux_request:travaux_request,
						},
					success : response => {
						$("#hugeFilterRenderModal").html(response);
						$("#filterModal").modal('show');
						huge_filter_status = true;

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
					}
				}); 
			}
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
					url  : "{{ route('lead.import.regie.change') }}",
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

		$('body').on('submit', '#leadFileImportForm', function(){
			$('#leadImportSubmitButton').addClass('d-none');
			$('#leadImportLoader').removeClass('d-none');
		})

		$('body').on('change', '.leadImportSelectChange', function(){ 
			if($(this).val() != ''){
				$(this).css('background-color', '#64DB31')
				$(this).closest('tr').find('.leadImportSelectExample').val($(this).find(':selected').attr('data-key-value'));
			}else {
				$(this).css('background-color', 'white') 
				$(this).closest('tr').find('.leadImportSelectExample').val('');
			}
		})

		$('body').on('change','#leadFileImportField', function(){
			var form_data = new FormData($('#leadFileImportForm')[0]);
			$.ajax({
				url: "{{ route('lead.pre.import') }}",
				type: "post",
				data: form_data,
				contentType: false,
				processData: false,
				success: function (response) {
					if(response.data){
						$('#leadImportSubmitButton').removeClass('d-none');
						$('#importError').addClass('d-none');
						$('#leadCsvHeader').html(response.data);
					}
					if(response.error){
						$('#leadCsvHeader').html('');
						$('#leadImportSubmitButton').addClass('d-none');
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
		$('body').on('click','.status_change__btn', function(){
			$(this).closest('.status_change__modal').find('.status_change__btn_block').slideUp();
			$(this).closest('.status_change__modal').find('.status_change__input').slideDown();
		});
		$(document).on('click', '#Click2CopyNumber', function(){
			$.ajax({
				type : "POST",
				url  : "{{ route('lead.number.copy') }}",
				data : {
					lead_id : lead_id_array,
				},
				success : response => {
					numbers = response.numbers.replace(/<\/?br>/g, '\r');
					var $temp = $("<textarea>");
					$("body").append($temp);
					$temp.val(numbers).select();
					document.execCommand("copy");
					$temp.remove();
					if(response.status){
						$('#successMessage').html('Numéros copiés dans le presse-papiers');
						$('.toast.toast--success').toast('show');
					}else{
						$('#errorMessage').html("Aucun numéro trouvé");
                		$('.toast.toast--error').toast('show');
					}
				}
			})
		});
		$(document).on('change', '#paginationCount', function(){
			$('#paginationCountInput').val($(this).val());
			$('#paginationCountForm').submit();
		});

		$(document).on("input", ".distribute-search__input", function() {
			let searchValue = $(this).val().toLowerCase();
			$(this).closest(".distribute-wrapper").find(".distribute-list__item").filter(function() {
				$(this).toggle($(this).find(".distribute-list__item__info__title").text().toLowerCase().indexOf(searchValue) > -1)
			});
		});

		var lead_id_array = [];
		$('body').on('click', '.lead_checkbox_item', function(){
			var id = $(this).attr('data-id');
			if(lead_id_array.indexOf(id)  != -1){
				lead_id_array = lead_id_array.filter(item => item !== id)
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
				$(this).closest('tr').removeClass('table-row--active');
			}
			else{
				$(this).closest('tr').addClass('table-row--active');
				lead_id_array.push(id)
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
			}

			if(lead_id_array.length == 0)
			{
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
			}
		});

		$('.lead_checkbox_all').click(function(){
			lead_id_array = [];
			if(this.checked)
			{
			$('.lead_checkbox_item').closest('tr').addClass('table-row--active');
			$('.lead_checkbox_item').each(function(){
				lead_id_array.push($(this).attr('data-id'))
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
			});
			}
			else{
				$('.lead_checkbox_item').closest('tr').removeClass('table-row--active');
			}
			if(lead_id_array.length == 0)
			{
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
			}
		});

		$('body').on('click', '.lead_checkbox_header', function(){ 
			var header = $(this).attr('data-header-code');
			if($(this).is(':checked')){
				$('.lead_checkbox_header_code'+header).each(function(){ 
					$(this).prop('checked', true);
					$(this).closest('tr').addClass('table-row--active');
					if(lead_id_array.indexOf($(this).attr('data-id'))  == -1){
						lead_id_array.push($(this).attr('data-id'))
					}
				});
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
			}else{
				$('.lead_checkbox_header_code'+header).each(function(){ 
					$(this).prop('checked', false);
					$(this).closest('tr').removeClass('table-row--active');
					if(lead_id_array.indexOf($(this).attr('data-id'))  != -1){
						lead_id_array = lead_id_array.filter(item => item !== $(this).attr('data-id'))
					}
				});
				$('.bulk_selected_lead').val(lead_id_array); 
				$('#selectedLeadCount').text(lead_id_array.length);
			}  

			if(lead_id_array.length == 0)
			{
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
			}
		});


		$(document).on("click", ".number-spinner__btn--increase", function(e){
			let user = $(this).attr('data-id');

			if(countTotalInput() == lead_id_array.length){
				$('#errorMessage').text("{{ __('Maximum limit reached') }}");
				$('.toast.toast--error').toast('show');
			}else{
				$(".number-spinner__input__value"+user).val(+$(".number-spinner__input__value"+user).val()+1);
			}
			$('#selectedLeadDispatchCount').text(countTotalInput());
		});

		$(document).on("click", ".number-spinner__btn--decrease", function(e){
			let user = $(this).attr('data-id');
			let assigned = $('.assignedLead'+user).val();
			let value = $(".number-spinner__input__value"+user);

			if(value.val() < 1){
				$('#errorMessage').text("{{ __('Minimum limit reached') }}");
				$('.toast.toast--error').toast('show');
				value.val(0);
			}else{
				value.val(+value.val()-1);
			}
			$('#selectedLeadDispatchCount').text(countTotalInput());

		});

		$('body').on('click', '#leadDeleteFormButton', function(){
			// var text = "{{ __('Are You Sure To Delete this') }}";
			// if(confirm(text) == true){
				$('#leadBulkDeleteModal').modal('show');
			// }
			// else{
			// 	return false
			// }
		});

		$("#all_lead_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTables tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
</script>

@endpush
