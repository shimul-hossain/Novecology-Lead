
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
					<button class="primary-btn primary-btn--purple primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('Current lead') }}</button>
					<button id="preValidateBtn" class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('Pre-validated lead') }}</button>
					<button id="leadVerifyBtn" class="primary-btn primary-btn--sky primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('verified lead') }} </button>
				</div>
			</div>
			</div>
		</div>

		<!-- Right Aside Modal -->

		<form action="{{ route('client.to.project') }}" method="POST" class="status_change__modal" id="clientToProjectModalForm">
			@csrf
			<div class="modal modal--aside fade" id="clientToProject" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body text-center pt-0">
							<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
							<span>Pouvez-vous confirmer la création d’un nouveau projet pour le client ?</span>
							<input type="hidden" name="client_id" value="{{ $client->id }}">
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
								<div>
									<button type="button" id="clientToProjectBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
										{{ __('Submit') }}
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal modal--aside fade" id="clientToProjectModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
					<div class="modal-content border-0">
						<div class="modal-header border-0 pb-0">
							<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
								<span class="novecologie-icon-close"></span>
							</button>
						</div>
						<div class="modal-body pt-0">
							<h1 class="form__title position-relative text-center mb-4">Projet</h1>
							<div class="row collapseRow">
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="Adresse_des_travaux"> Adresse des travaux</label>
										<input type="text" id="Adresse_des_travaux" class="form-control shadow-none travaux_disabled" readonly
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
										<label class="form-label" for="complement_Adresse_des_travaux">Complément adresse Travaux</label>
										<input type="text" id="complement_Adresse_des_travaux" class="form-control shadow-none travaux_disabled" readonly
										@if ($primary_tax)
											@if ($primary_tax->same_as_work_address == 'no')
												value="{{ $primary_tax->Complément_adresse_Travaux }}"
											@else
												value="{{ $primary_tax->address }}"
											@endif
										@endif
										>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="Code_postale_des_travaux">Code postale des travaux</label>
										<input type="text" id="Code_postale_des_travaux" class="form-control shadow-none travaux_disabled" readonly
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
										<input type="text" id="Ville_des_travaux" class="form-control shadow-none travaux_disabled" readonly
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
										<input type="text" id="Département_des_travaux" class="form-control shadow-none travaux_disabled" readonly
										@if ($primary_tax)
											@if ($primary_tax->same_as_work_address == 'no')
												value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
											@else
												value="{{ getDepartment2($primary_tax->postal_code) }}"
											@endif
										@endif
										>
									</div>
								</div>
								<div class="col-12">
									<label class="form-label">Google Adresse</label>
									<div class="form-group d-flex flex-column align-items-center position-relative">
										<input type="text" id="google_address2" class="form-control shadow-none" disabled value="{{ $primary_tax->google_address ?? '' }}">
									</div>
								</div>
								<div class="col-12 my-4">
									<a target="_blank" id="googleMapImage2" href="https://www.google.com/maps?q={{ $primary_tax && $primary_tax->google_address ? urlencode($primary_tax->google_address) : '' }}">
										<img  loading="lazy"  height="80" src="{{ asset('crm_assets/assets/images/Google-Maps-Logo-Transparent 1.png') }}" alt="">
									</a>
									<a target="_blank" href="https://www.geoportail.gouv.fr/" class="mx-5">
										<img  loading="lazy"  width="150" src="{{ asset('crm_assets/assets/images/geo-logo.png') }}" alt="">
									</a>
									<a target="_blank" href="https://cadastre.gouv.fr/scpc/accueil.do">
										<img  loading="lazy"  height="80" src="{{ asset('crm_assets/assets/images/cadastre-gouv-logo.png') }}" alt="">
									</a>
								</div>
								<div class="col-12 p-3" style="border: 1px solid black">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="d-flex align-items-center justify-content-between">
													<label class="form-label" for="bareme"> Barème</label>
												</div>
												<select name="bareme[]" id="bareme"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
													@foreach ($bareme_travaux_tags->where('rank', 1) as $baremes)
													@if ($client->clientBareme->whereIn('id',  [7,29])->first())
														@if ($client->clientBareme->where('id',  $baremes->id)->first())
															<option selected value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
														@endif
													@else
														<option {{ $client->clientBareme->where('id',  $baremes->id)->first()? 'selected':'' }} value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
													@endif
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
														@if ($client->clientBareme->whereIn('id',  [7,29])->first())
															@if ($client->clientBareme->where('id', $travaux->id)->first())
																<option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>
															@else
																<option {{ \App\Models\CRM\ClientTravaux::where('client_id', $client->id)->where('travaux_id',  $travaux->id)->exists() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
															@endif
														@else
															@if ($travaux->rank == '1')
																@if (\App\Models\CRM\ClientTravaux::where('client_id', $client->id)->where('travaux_id',  $travaux->id)->exists())
																	<option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>
																@endif
															@else
																<option {{ \App\Models\CRM\ClientTravaux::where('client_id', $client->id)->where('travaux_id',  $travaux->id)->exists() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
															@endif
														@endif
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<div class="d-flex align-items-center justify-content-between">
													<label class="form-label" for="tag">TAG</label>
												</div>
												<select name="tag[]" id="tag"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
													@foreach ($bareme_travaux_tags as $tag)
														@if ($client->clientTravauxTags->where('id',  $tag->id)->first())
															<option  value="disabled" disabled="disabled" selected>{{ $tag->tag }}</option>
														@endif
													@endforeach
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12" id="productListBlock">
									@foreach ($bareme_travaux_tags as $product_tag)
										@php
											$client_travaux_tags = \App\Models\CRM\ClientTravauxTag::where('client_id', $client->id)->where('tag_id', $product_tag->id)->first();
										@endphp
										@if ($client->clientTravauxTags->where('id', $product_tag->id)->first() && $product_tag->id != 7 && $product_tag->id != 29)
											<div class="my-2 text-center"> 
												<button type="button" class="btn w-100" style="background-color: #9fbfe6; max-width: 540px;">{{ $product_tag->travaux }}</button>
											</div> 
											<input type="hidden" data-tag-id="{{ $product_tag->id }}" class="tag__product">
											@if ($product_tag->tag == 'CAG' || $product_tag->tag == 'POELE' || $product_tag->tag == 'PAC R/R' || $product_tag->tag == 'PAC R/O' || $product_tag->tag == 'CESI' || $product_tag->tag == 'BTD' || $product_tag->tag == 'SSC')
												<div class="form-group">
													<div class="d-flex align-items-center">
														<label class="form-label" for="status">Marque</label>
													</div>
													<select name="marque[{{ $product_tag->id }}]" id="marque{{ $product_tag->id }}" class="select2_select_option shadow-none form-control travaux_disabled prjectMarquelist" data-tag-id="{{ $product_tag->id }}">
														<option value="">{{ __("Select") }}</option>
														@foreach ($marques as $marque)
														@if(in_array($marque->id, $product_tag->getProducts->pluck('marque_id')->toArray()))
															<option {{ $client_travaux_tags->marque == $marque->id ? 'selected':'' }} value="{{ $marque->id }}">{{ $marque->description }}</option>
                                                		@endif
														@endforeach
													</select>
												</div>
											@endif
											@if ($product_tag->tag == 'PAC R/R')
												<div class="form-group">
													<label class="form-label">Nombre de split</label>
													<input type="number" name="Nombre_de_split[{{ $product_tag->id }}]" id="Nombre_de_split{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->Nombre_de_split ?? ''  }}">
												</div>
											@endif
											@if ($product_tag->rank == '1')
												<div class="form-group">
													<div class="d-flex align-items-center">
														<label class="form-label" for="status">Produit {{ $product_tag->tag }}</label>
													</div>
													<select name="tag_product[{{ $product_tag->id }}][]" id="product{{ $product_tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled project-tag-product--change" data-tag-id="{{ $product_tag->id }}" multiple>
														@foreach ($product_tag->getProducts as $product)
														@if ($product_tag->tag == 'CAG' || $product_tag->tag == 'POELE' || $product_tag->tag == 'PAC R/R' || $product_tag->tag == 'PAC R/O' || $product_tag->tag == 'CESI' || $product_tag->tag == 'BTD' || $product_tag->tag == 'SSC')
															@if ($client_travaux_tags->marque == $product->marque_id)
																<option {{ \App\Models\CRM\ClientTagProduct::where('client_id', $client->id)->where('tag_id',  $product_tag->id)->where('product_id',  $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
															@endif
														@else
															<option {{ \App\Models\CRM\ClientTagProduct::where('client_id', $client->id)->where('tag_id',  $product_tag->id)->where('product_id',  $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
														@endif
														@endforeach
													</select>
												</div>
											@endif
											@if ($product_tag->tag == 'ITI_101' || $product_tag->tag == 'ITI_102' || $product_tag->tag == 'ITE_102' || $product_tag->tag == 'ITI_103'|| $product_tag->tag == 'Crépis' || $product_tag->tag == 'ITE hors zone')
												@if ($product_tag->tag == 'ITI_101')
													<div class="form-group">
														<label class="form-label" for="Type_de_comble{{ $product_tag->id }}">Type de comble</label>
														<select name="Type_de_comble[{{ $product_tag->id }}]" id="Type_de_comble{{ $product_tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
															<option value="" selected>{{ __('Select') }}</option>
															<option {{ $client_travaux_tags->Type_de_comble && $client_travaux_tags->Type_de_comble == 'Comble perdu' ? 'selected':'' }} value="Comble perdu">Comble perdu</option>
															<option {{ $client_travaux_tags->Type_de_comble && $client_travaux_tags->Type_de_comble == 'Comble aménagés/aménagéable' ? 'selected':'' }} value="Comble aménagés/aménagéable">Comble aménagés/aménagéable</option>
														</select>
													</div>
												@endif
												<div class="form-group">
													<label class="form-label" for="surface{{ $product_tag->id }}">Surface {{ $product_tag->tag  }}</label>
													<input type="hidden" name="surface[{{ $product_tag->id }}]" value="{{ $client_travaux_tags->surface ?? ''  }}" id="surface{{ $product_tag->id }}" class="hidden_surface_m2_value">
													<input type="text" class="surface_m2_value form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->surface ?? '' }} m2">
												</div>
											@endif
											@if ($product_tag->tag == 'StoreBanne')
												<div class="form-group">
													<label class="form-label">Nombre de store banne</label>
													<input type="number" name="Nombre_de_split[{{ $product_tag->id }}]" id="Nombre_de_split{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->Nombre_de_split ?? ''  }}">
												</div>
											@endif
											@if ($product_tag->tag == 'GD ITE')
												<div class="form-group">
													<label class="form-label">Nombre</label>
													<input type="number" name="Nombre_de_split[{{ $product_tag->id }}]" id="Nombre_de_split{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->Nombre_de_split ?? ''  }}">
												</div>
											@endif
											<div id="projectTagProductWrap{{ $product_tag->id }}">
												@if ($product_tag->id == 2 || $product_tag->id == 6)
													@foreach (\App\Models\CRM\ClientTagProduct::where('client_id', $client->id)->where('tag_id',  $product_tag->id)->get()  as $selected_product)
														<div class="form-group">
															<label class="form-label">{{ \App\Models\CRM\Product::find($selected_product->product_id)->reference ?? '' }} : <button style="background-color: #B4C7E6" type="button" class="primary-btn primary-btn--sm rounded">Nombre</button></label>
															<input type="number" name="tag_product_nombre[{{ $product_tag->id }}__{{ $selected_product->product_id }}]" class="form-control shadow-none travaux_disabled tag_product_nombre" value="{{ \App\Models\CRM\ClientProductNombre::where('client_id', $client->id)->where('tag_id', $product_tag->id)->where('product_id', $selected_product->product_id)->first()->number ?? '' }}" data-product-id="{{ $selected_product->product_id }}" data-tag-id="{{ $product_tag->id }}">
														</div>
													@endforeach
												@endif
											</div>
											@if ($product_tag->tag == 'THERMO')
												<div class="form-group">
													<label class="form-label">SHAB:</label>
													<input type="number" step="any" name="shab[{{ $product_tag->id }}]" id="shab{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->shab }}">
												</div>
												<div class="form-group">
													<label class="form-label">Nombre de pièces dans le logement:</label>
													<input type="number" step="any" name="Nombre_de_pièces_dans_le_logement[{{ $product_tag->id }}]" id="Nombre_de_pièces_dans_le_logement{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->Nombre_de_pièces_dans_le_logement }}">
												</div>
												<div class="form-group">
													<label class="form-label">Nombre de radiateurs total dans le logement <span class="only--positive--value--alert"></span></label>
													<input type="number" step="any" min="0" name="Nombre_de_radiateur_total_dans_le_logement[{{ $product_tag->id }}]" id="Nombre_de_radiateur_total_dans_le_logement{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled only--positive--value" value="{{ $client_travaux_tags->Nombre_de_radiateur_total_dans_le_logement }}">
												</div>
												<div class="form-group">
													<label class="form-label" for="Type_de_radiateur{{ $product_tag->id }}">Type de radiateurs à équiper</label>
													<select name="Type_de_radiateur[{{ $product_tag->id }}]" id="Type_de_radiateur{{ $product_tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled Type_de_radiateur_select_input">
														<option value="" selected>{{ __('Select') }}</option>
														<option {{ $client_travaux_tags->Type_de_radiateur && $client_travaux_tags->Type_de_radiateur == 'combustible' ? 'selected':'' }} value="combustible">combustible</option>
														<option {{ $client_travaux_tags->Type_de_radiateur && $client_travaux_tags->Type_de_radiateur == 'électrique' ? 'selected':'' }} value="électrique">électrique</option>
														<option {{ $client_travaux_tags->Type_de_radiateur && $client_travaux_tags->Type_de_radiateur == 'mixte' ? 'selected':'' }} value="mixte">mixte</option>
													</select>
												</div>
												<div class="form-group" id="Nombre_de_radiateurs_électrique_input" style="display: {{ ($client_travaux_tags->Type_de_radiateur == 'mixte' || $client_travaux_tags->Type_de_radiateur == 'électrique') ? '':'none'  }}">
													<label class="form-label">Nombre de radiateurs électrique à équiper:</label>
													<input type="number" step="any" name="Nombre_de_radiateurs_électrique[{{ $product_tag->id }}]" id="Nombre_de_radiateurs_électrique{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->Nombre_de_radiateurs_électrique }}">
												</div>
												<div class="form-group" id="Nombre_de_radiateurs_combustible_input" style="display: {{ ($client_travaux_tags->Type_de_radiateur == 'mixte' || $client_travaux_tags->Type_de_radiateur == 'combustible') ? '':'none'  }}">
													<label class="form-label">Nombre de radiateurs combustible à équiper:</label>
													<input type="number" step="any" name="Nombre_de_radiateurs_combustible[{{ $product_tag->id }}]" id="Nombre_de_radiateurs_combustible{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $client_travaux_tags->Nombre_de_radiateurs_combustible }}">
												</div>
												<div class="form-group">
													<label class="form-label" for="Thermostat_supplémentaire{{ $product_tag->id }}">Thermostat supplémentaire:</label>
													<select name="Thermostat_supplémentaire[{{ $product_tag->id }}]" id="Thermostat_supplémentaire{{ $product_tag->id }}" data-autre-box="Thermostat_supplémentaire_wrap" class="select2_select_option custom-select shadow-none form-control travaux_disabled other_field__system2">
														<option value="" selected>{{ __('Select') }}</option>
														<option {{ $client_travaux_tags->Thermostat_supplémentaire && $client_travaux_tags->Thermostat_supplémentaire == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
														<option {{ $client_travaux_tags->Thermostat_supplémentaire && $client_travaux_tags->Thermostat_supplémentaire == 'Non' ? 'selected':'' }} value="Non">Non</option>
													</select>
												</div>
												<div class="Thermostat_supplémentaire_wrap"  style="display: {{ ($client_travaux_tags->Thermostat_supplémentaire == 'Oui')? '':'none' }}">
													<div class="form-group">
														<label class="form-label">Nombre thermostat supplémentaire:</label>
														<input type="number" step="any" name="Nombre_thermostat_supplémentaire[{{ $product_tag->id }}]" id="Nombre_thermostat_supplémentaire{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled Nombre_thermostat_supplémentaire_input" data-price="{{ $product_tag->price }}" value="{{ $client_travaux_tags->Nombre_thermostat_supplémentaire }}">
													</div>
													<div class="form-group">
														<label class="form-label">Montant:</label>
														<input type="text" disabled class="form-control shadow-none" id="Nombre_thermostat_supplémentaire_montant" value="{{ EuroFormat($client_travaux_tags->Nombre_thermostat_supplémentaire*$product_tag->price) }}">
													</div>
												</div> 
											@endif
										@endif
									@endforeach
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<div class="d-flex align-items-center justify-content-between">
											<label class="form-label" for="Type_de_contrat">Type de contrat:</label>
										</div>
										<select name="Type_de_contrat" id="Type_de_contrat"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
											{{-- <option value="" selected>{{ __('Select') }}</option>
											<option {{ $client->Type_de_contrat == 'Credit' ? 'selected':'' }} value="Credit">Credit</option>
											<option {{ $client->Type_de_contrat == 'MaPrimeRenov' ? 'selected':'' }} value="MaPrimeRenov">MaPrimeRenov</option>
											<option {{ $client->Type_de_contrat == 'Bar TH 164' ? 'selected':'' }} value="Bar TH 164">Bar TH 164</option> --}}

                                             <option value=" " selected>{{ __('Select') }}</option>
                                            <option data-color="#ffffff" data-background="#00818E" {{ $client->Type_de_contrat == 'Credit' ? 'selected':'' }} value="Credit">Credit</option>
                                            <option data-color="#000000" data-background="#B2E6D9" {{ $client->Type_de_contrat == 'MaPrimeRenov' ? 'selected':'' }} value="MaPrimeRenov">MaPrimeRenov</option>
                                            <option data-color="#000000" data-background="#ff0000" {{ $client->Type_de_contrat == 'BAR TH 164 – 2022' ? 'selected':'' }} value="BAR TH 164 – 2022">BAR TH 164 – 2022</option>
                                            <option data-color="#000000" data-background="#F8A0EE" {{ $client->Type_de_contrat == 'BAR TH 164 – 2023' ? 'selected':'' }} value="BAR TH 164 – 2023">BAR TH 164 – 2023</option>
                                            <option data-color="#000000" data-background="#9BB8CD" {{ $client->Type_de_contrat == 'BAR TH 164 – 2023 (après 01/07/2023)' ? 'selected':'' }} value="BAR TH 164 – 2023 (après 01/07/2023)">BAR TH 164 – 2023 (après 01/07/2023)</option>
											<option data-color="#000000" data-background="#EADFB4" {{ $client->Type_de_contrat == 'BAR TH 145' ? 'selected':'' }} value="BAR TH 145">BAR TH 145</option>
											<option data-color="#000000" data-background="#FFB996" {{ $client->Type_de_contrat == 'BAR TH 173' ? 'selected':'' }} value="BAR TH 173">BAR TH 173</option>
										</select>
									</div>
								</div>
								<div class="col-12 text-center">
									<button id="MaPrimeRenovUpdateBtn" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
										Calcul des aides
									</button>
								</div>
								<div class="col-12 mt-4">
									<div class="row">
										<div class="col-md-2">
											<h4 class="mb-0 text-right">MaPrimeRenov</h4>
										</div>
										<div class="col-md-10">
											<label class="switch-checkbox">
												<input type="checkbox" data-autre-box="work__MaPrimeRenov" class="switch-checkbox__input other_field__system travaux_disabled" id="MaPrimeRenov"  name="MaPrimeRenov" {{ ($client->MaPrimeRenov == 'yes')? 'checked':'' }}>
												<span class="switch-checkbox__label"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 work__MaPrimeRenov" style="display: {{ ($client->MaPrimeRenov == 'yes')? '':'none' }}">
									<div class="card">
										<div class="card-body" style="background-color: #F2F2F2">
											@if ($primary_tax)
												<h4 class="mb-0">Montant estimée de l’aide: <span id="MaPrimeRenovEstimatedAmount">{{ MaPrimeRenovEstimatedAmount($client->Mode_de_chauffage, $client->precariousness,  $client->clientBareme->pluck('id')) }}</span></h4>
												<h4 class="mb-0 mt-4">Précarité du client: <span class="precarious p-2 d-inline-block" style="border-radius: 5px; background-color:
												@if ($client->precariousness == 'Classique')
													 #FF00FF;
													 color:black;
												@elseif($client->precariousness == 'Intermediaire')
													 #9900FF;
													 color:white;
												@elseif($client->precariousness == 'Precaire')
													 #FFD966;
													 color:black;
												@elseif($client->precariousness == 'Grand Precaire')
													 #3C78D8;
													 color:white;
												@endif
												">{{ $client->precariousness }}</span></h4>
												<div class="form-group mt-4">
													<div class="d-flex align-items-center justify-content-between">
														<label class="form-label" for="Subvention_MaPrimeRénov_déduit_du_devis">Subvention MaPrimeRénov déduit du devis ?</label>
													</div>
													<select name="Subvention_MaPrimeRénov_déduit_du_devis" id="Subvention_MaPrimeRénov_déduit_du_devis"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
														<option value=" " selected>{{ __('Select') }}</option>
														<option  data-color="#000000" data-background="#93C47D" {{ $client->Subvention_MaPrimeRénov_déduit_du_devis == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
														<option data-color="#000000" data-background="#EA9999" {{ $client->Subvention_MaPrimeRénov_déduit_du_devis == 'Non' ? 'selected':'' }} value="Non">Non</option>
													</select>
												</div>
												<div class="form-group mt-4">
													<div class="d-flex align-items-center justify-content-between">
														<label class="form-label" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov">Le demandeur a déjà fait une demande à MaPrimeRenov ?</label>
													</div>
													<select name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
														<option value=" " selected>{{ __('Select') }}</option>
														<option  data-color="#000000" data-background="#EA9999" {{ $client->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
														<option data-color="#000000" data-background="#93C47D" {{ $client->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'Non' ? 'selected':'' }} value="Non">Non</option>
													</select>
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
												<input type="checkbox" data-autre-box="work__Action_Logement"  class="switch-checkbox__input other_field__system travaux_disabled"  id="Action_Logement"  name="Action_Logement" {{ ($client->Action_Logement == 'yes')? 'checked':'' }}>
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
												<input type="checkbox" data-autre-box="work__CEE"  class="switch-checkbox__input travaux_disabled other_field__system"  id="CEE"  name="CEE" {{ ($client->CEE == 'yes')? 'checked':'' }}>
												<span class="switch-checkbox__label"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 work__CEE" style="display: {{ ($client->CEE == 'yes')? '':'none' }}">
									<div class="card">
										<div class="card-body" style="background-color: #F2F2F2">
											@if ($primary_tax)
												<h4 id="CEEEstimatedCalculate" class="mb-0 {{ ($client->clientBareme->count() == 1 && $client->clientBareme->first()->id == 7) ? 'd-none':'' }}">Montant estimée de l’aide : <span id="CEEEstimatedAmount">{{ CEEEstimatedAmount($client->Mode_de_chauffage, $client->precariousness,  $client->clientBareme->pluck('id')) }}</span></h4>
												<div id="CEEEstimatedWrap" class="{{ ($client->clientBareme->count() == 1 && $client->clientBareme->first()->id == 7) ? '':'d-none' }}">
													<div class="form-group d-flex align-items-center">
														<h4 class="mr-2">Montant estimée de l’aide :</h4>
														<div class="d-flex align-item-center justify-content-end">
															<input type="text" readonly name="Montant_estimée_de_lapostropheaide" id="Montant_estimée_de_lapostropheaide" class="form-control shadow-none travaux_disabled" value="{{ $client->Montant_estimée_de_lapostropheaide }}">
															<button type="button" data-input-id="Montant_estimée_de_lapostropheaide" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
															@if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
																informations_personal
															@endif
															">
																<span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
																<span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
															</button>
														</div>
													</div>
												</div>
												<h4 class="mb-0 mt-2">Précarité du client: <span class="precarious p-2 d-inline-block"  style="border-radius: 5px; background-color:
													@if ($client->precariousness == 'Classique')
														 #FF00FF;
														 color:black;
													@elseif($client->precariousness == 'Intermediaire')
														 #9900FF;
														 color:white;
													@elseif($client->precariousness == 'Precaire')
														 #FFD966;
														 color:black;
													@elseif($client->precariousness == 'Grand Precaire')
														 #3C78D8;
														 color:white;
													@endif
													">{{ $client->precariousness }}</span></h4>
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
												<input type="checkbox" data-autre-box="work__credit"  class="switch-checkbox__input travaux_disabled other_field__system"  id="Credit"  name="Credit" {{ ($client->Credit == 'yes')? 'checked':'' }}>
												<span class="switch-checkbox__label"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 work__credit" style="display: {{ ($client->Credit == 'yes')? '':'none' }}">
									<div class="card">
										<div class="card-body" style="background-color: #F2F2F2">
											<div class="form-group">
												<label class="form-label" for="Montant_Crédit">Montant Crédit</label>
												<input type="hidden" value="{{ $client->Montant_Crédit  }}" name="Montant_Crédit" id="Montant_Crédit" class="montant_value">
												<input type="text" class="form-control shadow-none travaux_disabled montant_format" value="{{ EuroFormat($client->Montant_Crédit) }}">
											</div>
											<div class="mt-4 d-flex align-items-center">
												<span class="mb-0 mr-2">Report du crédit</span>
												<label class="switch-checkbox">
													<input type="checkbox" data-autre-box="work__Report_du_crédit" class="switch-checkbox__input travaux_disabled other_field__system" {{ $client->Report_du_crédit == 'yes'? 'checked':'' }} name="Report_du_crédit" id="Report_du_crédit">
													<span class="switch-checkbox__label"></span>
												</label>
											</div>
											<div class="mt-2 work__Report_du_crédit" style="display: {{ ($client->Report_du_crédit == 'yes') ? "": 'none' }}">
												<div class="form-group">
													<div class="d-flex align-items-center justify-content-between">
														<label class="form-label" for="Nombre_de_jours_report">Nombre de jours report:</label>
													</div>
													<select name="Nombre_de_jours_report" id="Nombre_de_jours_report"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
														<option value="" selected>{{ __('Select') }}</option>
														<option {{ $client->Nombre_de_jours_report == '0 jours' ? 'selected':'' }} value="0 jours">0 jours</option>
														<option {{ $client->Nombre_de_jours_report == '90 jours' ? 'selected':'' }} value="90 jours">90 jours</option>
														<option {{ $client->Nombre_de_jours_report == '140 jours' ? 'selected':'' }} value="140 jours">140 jours</option>
														<option {{ $client->Nombre_de_jours_report == '180 jours' ? 'selected':'' }} value="180 jours">180 jours</option>
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
												<input type="checkbox" data-autre-box="work__Reste_à_charge"  class="switch-checkbox__input travaux_disabled other_field__system"  id="Reste_à_charge"  name="Reste_à_charge" {{ ($client->Reste_à_charge == 'yes')? 'checked':'' }}>
												<span class="switch-checkbox__label"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="col-12 work__Reste_à_charge" style="display: {{ ($client->Reste_à_charge == 'yes')? '':'none' }}">
									<div class="card">
										<div class="card-body" style="background-color: #F2F2F2">
											<div class="form-group">
												<label class="form-label" for="Reste_à_charge_Montant">Montant</label>
												<input type="hidden" value="{{ $client->Reste_à_charge_Montant  }}" name="Reste_à_charge_Montant" id="Reste_à_charge_Montant" class="montant_value">
												<input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($client->Reste_à_charge_Montant) }}">
											</div>
											<div class="form-group">
												<div class="d-flex align-items-center justify-content-between">
													<label class="form-label" for="Mode_de_paiement">Mode de paiement:</label>
												</div>
												<select name="Mode_de_paiement" id="Mode_de_paiement" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
													<option value="" selected>{{ __('Select') }}</option>
													<option {{ $client->Mode_de_paiement == 'Comptant' ? 'selected':'' }} value="Comptant">Comptant</option>
													<option {{ $client->Mode_de_paiement == 'Différé' ? 'selected':'' }} value="Différé">Différé</option>
												</select>
											</div>
											<div class="form-group work__Mode_de_paiement"  style="display: {{ $client->Mode_de_paiement == 'Différé' ? '':'none' }}">
												<div class="d-flex align-items-center justify-content-between">
													<label class="form-label" for="Nombre_de_mensualités">Nombre de mensualités:</label>
												</div>
												<select name="Nombre_de_mensualités" id="Nombre_de_mensualités"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
													<option value="" selected>{{ __('Select') }}</option>
													<option {{ $client->Nombre_de_mensualités == '1' ? 'selected':'' }} value="1">1</option>
													<option {{ $client->Nombre_de_mensualités == '2' ? 'selected':'' }} value="2">2</option>
													<option {{ $client->Nombre_de_mensualités == '3' ? 'selected':'' }} value="3">3</option>
													<option {{ $client->Nombre_de_mensualités == '4' ? 'selected':'' }} value="4">4</option>
													<option {{ $client->Nombre_de_mensualités == '5' ? 'selected':'' }} value="5">5</option>
												</select>
											</div>
											@if (\Auth::user()->getRoleName->category_id != 1)
												<div class="p-3" style="background-color: #ffffff"> 
													<div class="form-group d-flex align-items-center justify-content-between">
														<label class="form-label">Survente</label>
														<select name="Survente" data-autre-box="work__Survente" class="other_field__system2 custom-select shadow-none w-auto travaux_disabled">
															<option value="" selected>{{ __('Select') }}</option>
															<option {{ $client->Survente == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
															<option {{ $client->Survente == 'Non' ? 'selected':'' }} value="Non">Non</option>
														</select>
													</div>  
													<div class="form-group work__Survente" style="display: {{ ($client->Survente == 'Oui')? '':'none' }}">
														<label class="form-label">Montant survente :</label>
														<input type="hidden" value="{{ $client->Montant_survente  }}" name="Montant_survente" class="montant_value">
														<input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($client->Montant_survente) }}">
													</div> 
													<div class="form-group">
														<label class="form-label">Observations reste à charge</label>
														<textarea name="Observations_reste_à_charge" class="form-control shadow-none travaux_disabled">{{ $client->Observations_reste_à_charge }}</textarea>
													</div>
												</div>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-12 mt-3">
									<div class="form-group">
										<label class="form-label" for="advance_visit">Disponibilité pour prévisite (jour /horaire)</label>
										<textarea name="advance_visit" id="advance_visit" class="form-control shadow-none travaux_disabled">{{ $client->advance_visit ?? '' }}</textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label class="form-label" for="Projet_observations">Observations</label>
										<textarea name="Projet_observations" id="Projet_observations" class="form-control shadow-none travaux_disabled">{{ $client->Projet_observations ?? '' }}</textarea>
									</div>
								</div>
								<div class="col-12 text-center">
									<div class="lead__card__loader-wrapper d-none" id="clientToProjectLoader">
									<div class="lead__card__loader">
										<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
											<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
											<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
											</path>
										</svg>
									</div>
								</div>
								<div  id="clientToProjectButton">
									<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
										{{ __('Submit') }}
									</button>
								</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</form>


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
						<span>Problème de récupération des avis fiscaux : Voulez-vous quand même passer à l'étape suivante?</span>
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

		<div class="modal modal--aside fade" id="taxErrorAlert2" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<input type="hidden" id="tax_update_id" value="0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						{{-- <span>Problème de recupération des avis fiscaux : <span class="notice__number_text"></span>, Voulez-vous quand même passer à l'étape suivante?</span> --}}
						<span>Problème de récupération des avis fiscaux : Voulez-vous quand même passer à l'étape suivante?</span>
						<div class="d-flex justify-content-center">
							<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
								Non
							</button>
							<button type="button" id="customTaxValidate2" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
								Oui
							</button>
						</div>
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
								<h1 class="modal-title">@if ($client->callback_time && \Carbon\Carbon::parse($client->callback_time) > \Carbon\Carbon::now()->addHour())
									Detail rappel
									@if (checkAction(Auth::id(), 'client', 'rappel_edit') || role() == 's_admin')
										<button type="button" id="callbackUpdateBtn" class="btn shadow-none p-0"><i class="bi bi-pencil"></i></button>
									@endif
								@endif</h1>
								<form action="{{ route('client.callback.setting') }}" method="POST">
									@csrf
									@if ($client)
										<input type="hidden" name="id" value="{{ $client->id }}">
									@endif
									@if($client->callback_time && \Carbon\Carbon::parse($client->callback_time)> \Carbon\Carbon::now()->addHour())
										<table class="common-table" id="callbackInfoTable" style="display: block">
											<tbody>
												<tr>
													<td class="common-table__heade">
														<i class="bi bi-calendar2-week mr-2"></i>
														Date
													</td>
													<td>: {{ \Carbon\Carbon::parse($client->callback_time)->format('d-m-Y') }}</td>
												</tr>
												<tr>
													<td class="common-table__heade">
														<i class="bi bi-alarm mr-2"></i>
														Horaire
													</td>
													<td>: {{ \Carbon\Carbon::parse($client->callback_time)->format('H:i') }}</td>
												</tr>
												<tr>
													<td class="common-table__heade">
														<i class="bi bi-person mr-2"></i>
														Utilisateur
													</td>
													<td>: {{ $client->callbackUser->name ?? ''  }}</td>
												</tr>
												<tr>
													<td class="common-table__heade">
														Observations
													</td>
													<td>: {{ $client->callback_observations  }}</td>
												</tr>
											</tbody>
										</table>
										<div class="row text-center" id="callbackInfoUpdateBlock" style="display: none">
											<div class="col-12 mb-3">
												<input type="datetime-local" min="{{ \Carbon\Carbon::now() }}" name="callback_time" class="flatpickr flatpickr-input form-control shadow-none" value="{{ \Carbon\Carbon::parse($client->callback_time)->format('Y-m-d H:i') }}" placeholder="JJ-MM-AAAA Heure:Minute" required>
											</div>
											<div class="col-12 mb-3 text-left">
												<div class="form-group">
													<label class="form-label">Observations</label>
													<textarea name="callback_observations" class="form-control shadow-none">{{ $client->callback_observations }}</textarea>
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
												<input type="datetime-local" min="{{ \Carbon\Carbon::now() }}" name="callback_time" class="flatpickr flatpickr-input form-control shadow-none" placeholder="JJ-MM-AAAA Heure:Minute" required {{ (!checkAction(Auth::id(), 'client', 'rappel_create') && role() != 's_admin')? 'disabled':'' }}>
											</div>
											<div class="col-12 mb-3 text-left">
												<div class="form-group">
													<label class="form-label">Observations</label>
													<textarea name="callback_observations" class="form-control shadow-none" {{ (!checkAction(Auth::id(), 'client', 'rappel_create') && role() != 's_admin')? 'disabled':'' }}></textarea>
												</div>
											</div>
											<div class="col-12">
												@if (checkAction(Auth::id(), 'client', 'rappel_create') || role() == 's_admin')
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
								@forelse ($client->callbackHistory as $history)
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
