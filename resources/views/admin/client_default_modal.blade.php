		<!-- Middle Modal -->
		<div class="modal modal--aside fade" id="newAssigneModal" tabindex="-1" aria-labelledby="newAssigneModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('client.bulk.assign') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">{{__('Assign Leads')}}</h1>
							<div class="form-group d-flex flex-column align-items-center position-relative">
								<input type="hidden" name="client_id" class="bulk_selected_client" value="">
								<select class="select2_select_option form-control w-100" name="user_id" required>
									<option value="" selected>{{ __('Select') }}</option>
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
		<div class="modal modal--aside fade" id="clientBulkDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
						<form  action="{{ route('client.bulk.delete') }}" method="post">
							@csrf
							<input type="hidden" name="client_id" class="bulk_selected_client" value="">
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
						<p class="modal-text text-center mb-5">{{ __('Filter your tables with your custom columns') }}</p>
						<form action="{{ route('client.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
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
															@if ( $header->id == $item->client_header_id)
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
										|| $header->header == 'Autre_intervenant'
										|| $header->header == 'Prospect_telecommercial'
										// || $header->header == 'Observations'
										)
										<div class="col-md-4">
											<div class="custom-control custom-checkbox">
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="informations_personnelles-{{ $key }}" name="header_id[]"
													@if ($filter_status->count() > 0)
														@foreach ($filter_status as $item)
															@if ( $header->id == $item->client_header_id)
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
