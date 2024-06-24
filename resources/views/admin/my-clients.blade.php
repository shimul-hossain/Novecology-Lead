{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
{{ __('My clients') }}
@endsection

{{-- active menu  --}}
@section('clientIndex')
active
@endsection

{{-- php code  --}}





{{-- Main Content Part  --}}
@section('content')
		<!-- Banner Section -->
		<section class="banner section-gap position-relative">
			<div class="container">
				{{-- <a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a> --}}
				<div class="row justify-content-center">
					<div class="col-12">
						<h1 class="banner__title text-center text-white">Clients</h1>
						<p class="text-center text-white mb-2 mb-md-0">Suivez l’évolution des clients en temps réel</p>
					</div>
					<div class="col-lg mb-2 text-center text-lg-left">
						<input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input" id="client_search_bar">
					</div>
					<div class="col-lg-auto d-flex flex-wrap align-items-center justify-content-center justify-content-lg-right mb-2 mb-lg-0">
						@if (checkAction(Auth::id(), 'client', 'assign') || role() == 's_admin')
							<div class="dropdown p-0 d-none" id="allActionButton">
								<button type="button" class="primary-btn primary-btn--white primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											Actions sur vos clients
								</button>
								<div class="dropdown-menu">
									@if (checkAction(Auth::id(), 'client', 'assign') || role() == 's_admin')
										<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#newAssigneModal">
											Attribuer un télécommercial
										</button>
									@endif
									@if (role() == 's_admin')
										<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#clientBulkDeleteModal">
											Supprimer client
										</button>
									@endif
								</div>
							</div>
						@endif
						@if (checkAction(Auth::id(), 'client', 'add_filter') || role() == 's_admin')
							<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 rounded mx-2">+ {{ __('Add filter') }}</button>
						@endif
						@if (checkAction(Auth::id(), 'client', 'filter_blue_button') || role() == 's_admin')
							<button data-toggle="modal" data-target="#filterModal" type="button" class="btn border-0 rounded mr-2" style="background-color:#42a5f6">
								<svg width="2em" height="1.5em" viewBox="0 0 44 21" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M43.7307 9.3913C43.7116 9.34324 43.6796 9.30222 43.6387 9.27336C43.5978 9.24449 43.5498 9.22907 43.5007 9.229H32.5005C32.4513 9.2289 32.4031 9.24424 32.3621 9.27309C32.321 9.30194 32.2889 9.34302 32.2697 9.39118C32.2506 9.43934 32.2452 9.49244 32.2543 9.54382C32.2634 9.59521 32.2866 9.64259 32.321 9.68004L37.821 15.6903C37.8443 15.7158 37.8721 15.736 37.9029 15.7499C37.9337 15.7637 37.9668 15.7708 38.0002 15.7708C38.0336 15.7708 38.0667 15.7637 38.0975 15.7499C38.1283 15.736 38.1562 15.7158 38.1795 15.6903L43.6795 9.67977C43.7137 9.64233 43.7368 9.595 43.7459 9.5437C43.755 9.4924 43.7496 9.43939 43.7305 9.3913H43.7307Z" fill="white"/>
									<path fill-rule="evenodd" clip-rule="evenodd" d="M0.75 9.125H28.25V11.875H0.75V9.125ZM0.75 0.875H28.25V3.625H0.75V0.875ZM0.75 17.375H28.25V20.125H0.75V17.375Z" fill="white"/>
								</svg>
							</button>
						@endif
                        <select id="paginationCount" class="custom-select w-auto">
                            <option {{ paginationNumber('client') == '25' ? 'selected':'' }} value="25">25</option>
                            <option {{ paginationNumber('client') == '50' ? 'selected':'' }} value="50">50</option>
                            <option {{ paginationNumber('client') == '100' ? 'selected':'' }} value="100">100</option>
                        </select>
					</div>
					<div class="col-12">
						<div class="database-table-wrapper bg-white">
							<div class="table-responsive simple-bar">
								<table class="table database-table w-100 mb-0" id="dataTabless">
									<thead class="database-table__header">
										<tr>
											<th class="text-left">
												<div class="custom-control custom-checkbox">
													<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheck">
													<label class="custom-control-label" for="tableAllSelectCheck"></label>
												</div>
											</th>
											@if ($filter_status->count() == 0) 
											@foreach ($default_filters as $item) 
												<th>
													@if ($item->getClientHeader->header == 'fixed_number')
														N° Fixe
													@elseif ($item->getClientHeader->header == 'phone')
														N° Mobile
													@elseif ($item->getClientHeader->header == 'Consommation_Chauffage_Annuel_2')
														Consommation Chauffage Annuel (litres,kWh,m3)
													@elseif ($item->getClientHeader->header == 'auxiliary_heating_status')
														Le logement possède t - il un chauffage d’appoint ?
													@elseif ($item->getClientHeader->header == 'auxiliary_heating')
														Le logement possède t - il un chauffage d’appoint
													@elseif ($item->getClientHeader->header == 'second_heating_generator_status')
														La maison possède-t-elle un second générateur de chauffage
													@elseif ($item->getClientHeader->header == 'second_heating_generator')
														La maison possède-t-elle un second générateur de chauffage
													@elseif ($item->getClientHeader->header == '__tracking__Nom_Prénom')
														Nom Prénom Lead
													@elseif ($item->getClientHeader->header == '__tracking__téléphone')
														Téléphone
													@elseif ($item->getClientHeader->header == 'precariousness')
														Précarité
													@elseif ($item->getClientHeader->header == 'advance_visit') 
														Disponibilité pour prévisite (jour /horaire)
													@else
														{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $item->getClientHeader->header))))) }}
													@endif
												</th> 
											@endforeach 
											@else 
												@foreach ($filter_status as $item)
													@if ($item->client_header_id == 74 || $item->client_header_id == 75)
														@continue
													@endif 
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
												Statut client
											</th>
											@if ($filter_status->count() > 0)
												@foreach ($filter_status as $item)
													@if ($item->client_header_id == 74)
														<th>
															Autre intervenant
														</th>
													@endif
												@endforeach
											@endif
											@if ($filter_status->count() > 0)
												@foreach ($filter_status as $item)
													@if ($item->client_header_id == 75)
														<th>
															Prospect Telecommercial
														</th> 
													@endif
												@endforeach
											@endif 
											<th class="text-center">
												Dossier
											</th>
										</tr>
									</thead>
									<tbody class="database-table__body">
										@php
										$x_code= 'empty';
										@endphp
										@if ($filter_status->count()== 0)
											@forelse ($clients as $client)
												@if ($x_code != substr($client->Code_Postal, 0,2))
													<tr>
														<td colspan="500" class="text-white" style="background-color: #13438c">{{ $client->Code_Postal ? getDepartment3($client->Code_Postal). ' ('.substr($client->Code_Postal, 0,2).') - '.getPrimaryZone($client->Code_Postal) : __('No Department') }}</td>
													</tr>
												@endif
												<tr>
													<td>
														<div class="custom-control custom-checkbox">
															<input value="1" type="checkbox" data-client-id="{{ $client->id }}" class="custom-control-input table-select-checkbox clientCheckboxBtn" id="tableRowSelectCheck-{{ $client->id }}">
															<label class="custom-control-label" for="tableRowSelectCheck-{{ $client->id }}"></label>
														</div>
													</td>
													@foreach ($default_filters as $item)
														@php
															$header = $item->getClientHeader->header;
														@endphp
														@if ($header == 'Nom' && $client->pinComment)
															<td>
																<span data-toggle="tooltip" data-placement="top" title="{{ $client->pinComment->comment }}" style="cursor: pointer">
																	{{ $client->$header ??__('Not Provided') }}
																</span>
															</td>
														@else
															<td>{{ $client->$header ??__('Not Provided') }}</td>
														@endif
													@endforeach
													<td class="text-left">
														@if ($client->getProject->count() > 0)
															@if ($client->getProject()->orderBy('id', 'desc')->first()->project_label == 7) 
																<button style="background: #F4CCCC" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
																	Annulé
																</button> 
															@elseif ($client->getProject()->orderBy('id', 'desc')->first()->project_label == 6) 
																<button style="background: #90EE90" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
																	Cloture
																</button> 
															@else 
																<button style="background: #FFD580"  type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
																	Ouvert
																</button> 
															@endif
														@endif
													</td>
													<td>
														@if (checkAction(Auth::id(), 'client', 'edit') || role() == 's_admin')
															<div class="d-flex align-items-center justify-content-center">
																<a href="{{ route('client.lead.update', $client->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
																	{{ __('Update') }}
																</a>
															</div>
														@endif
													</td>
												</tr> 
												@php
													$x_code = substr($client->Code_Postal, 0,2);
												@endphp
											@empty
												<tr>
													<td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
												</tr>
											@endforelse
										@else
											@forelse ($clients as $client)
												@if ($x_code != substr($client->Code_Postal, 0,2))
													<tr>
														<td colspan="500" class="text-white" style="background-color: #13438c">{{ $client->Code_Postal ? getDepartment3($client->Code_Postal). ' ('.substr($client->Code_Postal, 0,2).') - '.getPrimaryZone($client->Code_Postal) : __('No Department') }}</td>
													</tr>
												@endif
												<tr>
													<td>
														<div class="custom-control custom-checkbox">
															<input value="1" type="checkbox" data-client-id="{{ $client->id }}" class="custom-control-input table-select-checkbox clientCheckboxBtn" id="tableRowSelectCheck-{{ $client->id }}">
															<label class="custom-control-label" for="tableRowSelectCheck-{{ $client->id }}"></label>
														</div>
													</td>
													@foreach ($filter_status as $item)
														@if ($item->getHeader->header == 'Autre_intervenant' || $item->getHeader->header == 'Prospect_telecommercial')
															@continue
														@endif
														@php
															$header = $item->getHeader->header;
														@endphp
														@if ($header == '__tracking__Fournisseur_de_lead')
															<td>{{ $client->getSupplier->suplier ??__('Not Provided') }}</td>
														@elseif ($header == 'Travaux_formulaire')
															<td>
																{{ getCustomFieldData('travaux_formulaire', $client->lead_tracking_custom_field_data) ?? __('Not Provided') }}
															</td>
														@elseif ($header == 'Nom' && $client->pinComment)
															<td>
																<span data-toggle="tooltip" data-placement="top" title="{{ $client->pinComment->comment }}" style="cursor: pointer">
																	{{ $client->$header ??__('Not Provided') }}
																</span>
															</td>
														@else
															<td>{{ $client->$header ??__('Not Provided') }}</td>
														@endif 
													@endforeach
													<td class="text-left">
														@if ($client->getProject->count() > 0)
															@if ($client->getProject()->orderBy('id', 'desc')->first()->project_label == 7) 
																<button style="background: #F4CCCC" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
																	Annulé
																</button>
															@elseif ($client->getProject()->orderBy('id', 'desc')->first()->project_label == 6) 
																<button style="background: #90EE90" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
																	Cloture
																</button> 
															@else 
																<button style="background: #FFD580"  type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
																	Ouvert
																</button> 
															@endif
														@endif 
													</td>
													@foreach ($filter_status as $item)
														@if ($item->client_header_id == 74)
															<td>
																<div class="avatar-group d-flex">
																	@if ($client->clientTelecommercial)
																		<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $client->clientTelecommercial->name }}">
																			@if ($client->clientTelecommercial->profile_photo)
																			<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $client->clientTelecommercial->profile_photo }}" alt="{{ $client->clientTelecommercial->name }}" class="avatar-group__image w-100 h-100">
																			@else
																			<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																			@endif
																		</a>
																	@else
																		Aucun autre intervenant
																	@endif
																</div>
															</td>
														@endif
														@if ($item->client_header_id == 75)
															<td>
																<div class="avatar-group d-flex">
																	@if ($client->prospectTelecommercial)
																		<a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $client->prospectTelecommercial->name }}">
																			@if ($client->prospectTelecommercial->profile_photo)
																			<img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $client->prospectTelecommercial->profile_photo }}" alt="{{ $client->prospectTelecommercial->name }}" class="avatar-group__image w-100 h-100">
																			@else
																			<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
																			@endif
																		</a>
																	@else
																		Aucun prospect telecommerical
																	@endif
																</div>
															</td>
														@endif
													@endforeach
													<td> 
														@if (checkAction(Auth::id(), 'client', 'edit') || role() == 's_admin')
															<div class="d-flex align-items-center justify-content-center">
																<a href="{{ route('client.lead.update', $client->id) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
																	{{ __('Update') }}
																</a>
															</div>
														@endif
													</td>
												</tr> 
												@php
													$x_code = substr($client->Code_Postal, 0,2);
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
							@if ($clients instanceof \Illuminate\Pagination\AbstractPaginator)
								<div class="pagination-wrapper"> 
									{{ $clients->appends(
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
										'telecommercial_id' => request()->telecommercial_id, 
										])->render() }}
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Middle Modal -->
		<div class="modal modal--aside fade" id="filterModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-full">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0 px-lg-4">
						<h1 class="form__title position-relative text-center mb-4">Filtres</h1>
						<form action="{{ route('client.filter') }}" method="get">
							<h2 class="modal-sub-title position-relative">{{ __('Lead Tracking (Form and response)') }}</h2>
							<div class="row">
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="__tracking__Fournisseur_de_lead">Fournisseur de lead</label>
										<select name="__tracking__Fournisseur_de_lead" id="__tracking__Fournisseur_de_lead" class="form-control shadow-none {{ request()->__tracking__Fournisseur_de_lead ? 'filter-field--active':'' }} filterInputChage">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->__tracking__Fournisseur_de_lead == 'no-data' ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
											@foreach ($suppliers as $supplier)
											<option  {{ ($supplier->id == request()->__tracking__Fournisseur_de_lead) ? 'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->suplier }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="__tracking__Type_de_campagne">Type de campagne</label>
										<select name="__tracking__Type_de_campagne" id="__tracking__Type_de_campagne" class="form-control shadow-none {{ request()->__tracking__Type_de_campagne ? 'filter-field--active':'' }} filterInputChage">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->__tracking__Type_de_campagne == 'no-data' ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
											@foreach ($campagne_types as $campagne_type)
												<option  {{ (request()->__tracking__Type_de_campagne == $campagne_type->name) ? 'selected':'' }} value="{{ $campagne_type->name }}">{{ $campagne_type->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="__tracking__Nom_campagne">Nom campagne</label>
										<input type="text" name="__tracking__Nom_campagne" id="__tracking__Nom_campagne" class="form-control shadow-none {{ request()->__tracking__Nom_campagne ? 'filter-field--active':'' }} filterInputChage" placeholder="Nom campagne"
										value ="{{ request()->__tracking__Nom_campagne }}">
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="__tracking__Date_demande_lead_from">Date demande lead from</label>
										<input type="date" name="__tracking__Date_demande_lead_from" id="__tracking__Date_demande_lead_from"
											value ="{{ request()->__tracking__Date_demande_lead_from }}"
											class="flatpickr flatpickr-input form-control shadow-none filterDateChage {{ request()->__tracking__Date_demande_lead_from ? 'filter-field--active':'' }}" placeholder="{{ __('dd-mm-yyyy') }}" >
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="__tracking__Date_demande_lead_to">Date demande lead to</label>
										<input type="date" name="__tracking__Date_demande_lead_to" id="__tracking__Date_demande_lead_to"
											value ="{{ request()->__tracking__Date_demande_lead_to }}"
											class="flatpickr flatpickr-input form-control shadow-none filterDateChage {{ request()->__tracking__Date_demande_lead_to ? 'filter-field--active':'' }}" placeholder="{{ __('dd-mm-yyyy') }}" >
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="__tracking__Date_attribution_télécommercial">Date attribution télécommercial</label>
										<input type="date" name="__tracking__Date_attribution_télécommercial" id="__tracking__Date_attribution_télécommercial" class="flatpickr flatpickr-input form-control shadow-none filterDateChage {{ request()->__tracking__Date_attribution_télécommercial ? 'filter-field--active':'' }}" value="{{ request()->__tracking__Date_attribution_télécommercial }}" placeholder="{{ __('dd-mm-yyyy') }}">
									</div>
								</div> 
							</div>
							<h2 class="modal-sub-title position-relative mt-3">Informations personnelles</h2>
							<div class="row"> 
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="f__first_name">{{ __('Prenom') }} </label>
										<input type="text" name="Prenom" id="f__first_name" class="form-control shadow-none {{ request()->Prenom ? 'filter-field--active':'' }} filterInputChage" value="{{ request()->Prenom }}">
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="f__last_name">{{ __('Nom') }} </label>
										<input type="text" name="Nom" id="f__last_name" class="form-control shadow-none {{ request()->Nom ? 'filter-field--active':'' }} filterInputChage" value="{{ request()->Nom }}">
									</div>
								</div> 
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="f__email">{{ __('Email') }} </label>
										<input type="email" name="Email" id="f__email" class="form-control shadow-none {{ request()->Email ? 'filter-field--active':'' }} filterInputChage" value="{{ request()->Email }}">
									</div>
								</div> 
							</div>
							<h2 class="modal-sub-title position-relative mt-3">Éligibilité</h2>
							<div class="row">
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="Type_occupation">Type occupation </label>
										<select name="Type_occupation" id="Type_occupation" class="custom-select shadow-none form-control {{ request()->Type_occupation ? 'filter-field--active':'' }} filterInputChage">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->Type_occupation == 'no-data' ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
											<option {{ request()->Type_occupation =='Indivision' ? 'selected':'' }} value="Indivision">{{ __('Indivision') }}</option>
											<option {{ request()->Type_occupation =='SCI' ? 'selected':'' }} value="SCI">{{ __('SCI') }}</option>
											<option {{ request()->Type_occupation =='Pleine propriété' ? 'selected':'' }} value="Pleine propriété">{{ __('Pleine propriété') }}</option>
										</select>
									</div>
								</div> 
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="Zone">{{ __('Zone') }}</label>
										<select name="Zone" id="Zone"  class="custom-select shadow-none form-control {{ request()->Zone ? 'filter-field--active':'' }} filterInputChage">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->Zone == 'no-data' ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
											<option {{ request()->Zone == 'H1' ? 'selected':'' }} value="H1">H1</option>
											<option {{ request()->Zone == 'H2' ? 'selected':'' }} value="H2">H2</option>
											<option {{ request()->Zone == 'H3' ? 'selected':'' }} value="H3">H3</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="precariousness">Éligibilité MaPrimeRenov </label>
										<select name="precariousness" id="precariousness"  class="custom-select shadow-none form-control {{ request()->precariousness ? 'filter-field--active':'' }} filterInputChage">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->precariousness == 'no-data' ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
											<option {{ request()->precariousness == 'Classique' ? 'selected':'' }} value="Classique">Classique</option>
											<option {{ request()->precariousness == 'Intermediaire' ? 'selected':'' }} value="Intermediaire">Intermediaire</option>
											<option {{ request()->precariousness == 'Precaire' ? 'selected':'' }} value="Precaire">Precaire</option>
											<option {{ request()->precariousness == 'Grand Precaire' ? 'selected':'' }} value="Grand Precaire">Grand Precaire</option>
										</select>
									</div>
								</div>
							</div>
							<h2 class="modal-sub-title position-relative mt-3">Information logement</h2>
							<div class="row">
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="Mode_de_chauffage"> Mode de chauffage </label>
										<select id="Mode_de_chauffage" name="Mode_de_chauffage" class="form-control w-100 {{ request()->Mode_de_chauffage ? 'filter-field--active':'' }} filterInputChage">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->Mode_de_chauffage == 'no-data' ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
											@foreach ($heatings as $heating)
												<option {{ request()->Mode_de_chauffage == $heating->name ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
											@endforeach
										</select>
									</div>
								</div> 
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="Surface_habitable"> Surface habitable </label>
										<input type="number" step="any" name="Surface_habitable" id="Surface_habitable" class="form-control shadow-none {{ request()->Surface_habitable ? 'filter-field--active':'' }} filterInputChage"
										value="{{ request()->Surface_habitable }}">
									</div>
								</div> 
							</div>
							<h2 class="modal-sub-title position-relative mt-3">Situation foyer</h2>
							<div class="row">
								<div class="col-md-6 col-lg-3">
									<div class="form-group">
										<label class="form-label" for="Situation_familiale"> Situation familiale</label>
										<select name="Situation_familiale"  id="Situation_familiale" class="form-control shadow-none {{ request()->Situation_familiale ? 'filter-field--active':'' }} filterInputChage">
											<option value="" selected>{{ __('Select') }}</option>
											<option {{ request()->Situation_familiale == 'no-data' ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
											<option {{ request()->Situation_familiale == 'Marié' ? 'selected':'' }} value="Marié">Marié</option>
											<option {{ request()->Situation_familiale == 'Pacsé' ? 'selected':'' }} value="Pacsé">Pacsé</option>
											<option {{ request()->Situation_familiale == 'Concubinage' ? 'selected':'' }} value="Concubinage">Concubinage</option>
											<option {{ request()->Situation_familiale == 'Divorcé' ? 'selected':'' }} value="Divorcé">Divorcé</option>
											<option {{ request()->Situation_familiale == 'Séparé' ? 'selected':'' }} value="Séparé">Séparé</option>
											<option {{ request()->Situation_familiale == 'Célibataire' ? 'selected':'' }} value="Célibataire">Célibataire</option>
											<option {{ request()->Situation_familiale == 'Veuf' ? 'selected':'' }} value="Veuf">Veuf</option>
											<option {{ request()->Situation_familiale == 'Autre' ? 'selected':'' }} value="Autre">Autre</option>
										</select>
									</div>
								</div> 
							</div>
							@if ($filter_telecommercial_status || role() == 'sales_manager' || role() == 'sales_manager_externe')
								<h2 class="modal-sub-title position-relative mt-3">Autre</h2>
								<div class="row">  
									<div class="col-md-6 col-lg-3">
										<div class="form-group">
											<label class="form-label">Télécommercial</label>
											<select  name="telecommercial_id" class="form-control w-100 {{ request()->telecommercial_id ? 'filter-field--active':'' }} filterInputChage">
												<option value="" selected>{{ __('Select') }}</option>
												<option {{ request()->Mode_de_chauffage == 'no-data' ? 'selected':'' }} value="no-data">Aucun prospect telecommerical</option>
												@foreach ($telecommercials as $telecommercial)
													<option {{ request()->telecommercial_id == $telecommercial->id ? 'selected':'' }} value="{{ $telecommercial->id }}">{{ $telecommercial->name }}</option>	
												@endforeach
											</select>
										</div>
									</div> 
								</div>
							@endif
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">Filtre</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
 

		<form action="{{ route('pagination.number.change') }}" id="paginationCountForm" method="POST">
			@csrf
			<input type="hidden" name="module" value="client">
			<input type="hidden" name="number" id="paginationCountInput">
		</form>
		
		<div id="DefaultModal"></div>
@include('includes.crm.footer-contact')

@endsection

@push('js')
<script>
	$(document).ready(function(){
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type : "POST",
			url  : "{{ route('client.default.modal.render') }}",

			success : response => {
				$("#DefaultModal").html(response); 

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
			}
		}); 

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

		$(document).on('change', '#paginationCount', function(){
			$('#paginationCountInput').val($(this).val());
			$('#paginationCountForm').submit();
		});

		var client_id_array = [];

		$('body').on('click', '.clientCheckboxBtn', function(){

			var id = $(this).attr('data-client-id');
			if(client_id_array.indexOf(id)  != -1){

				client_id_array = client_id_array.filter(item => item !== id)
			}
			else{
				client_id_array.push(id)
			}
			if(client_id_array.length == 0)
			{
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
			}
			$('.bulk_selected_client').val(client_id_array);
		});

		$('#tableAllSelectCheck').click(function(){
			client_id_array = [];

			if(this.checked)
			{
				$('.clientCheckboxBtn').each(function(){
					client_id_array.push($(this).attr('data-client-id'))
				});
			}
			if(client_id_array.length == 0)
			{
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
			}
			$('.bulk_selected_client').val(client_id_array);
		});


		$("#client_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTabless tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});

</script>
@endpush
