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
                <form action="{{ route('lead.all.filter', $status) }}" method="get">
                    <h2 class="modal-sub-title position-relative">{{ __('Lead Tracking (Form and response)') }}</h2>
                    <div class="row">
                        {{-- @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager' && role() != 'sales_manager_externe') --}}
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label class="form-label" for="__tracking__Fournisseur_de_lead">Fournisseur de lead</label>
                                    <select name="__tracking__Fournisseur_de_lead" id="__tracking__Fournisseur_de_lead" class="form-control shadow-none {{ isset($all_request['__tracking__Fournisseur_de_lead']) ? 'filter-field--active':'' }} filterInputChage">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ (isset($all_request['__tracking__Fournisseur_de_lead']) && $all_request['__tracking__Fournisseur_de_lead'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                        @foreach ($suppliers as $supplier)
                                        <option  {{ (isset($all_request['__tracking__Fournisseur_de_lead']) && $supplier->id == $all_request['__tracking__Fournisseur_de_lead']) ? 'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->suplier }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        {{-- @endif --}}
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Type_de_campagne">Type de campagne</label>
                                <select name="__tracking__Type_de_campagne" id="__tracking__Type_de_campagne" class="form-control shadow-none {{ isset($all_request['__tracking__Type_de_campagne']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['__tracking__Type_de_campagne']) && $all_request['__tracking__Type_de_campagne'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($campagne_types as $campagne_type)
                                        <option  {{ (isset($all_request['__tracking__Type_de_campagne']) && $all_request['__tracking__Type_de_campagne'] == $campagne_type->name) ? 'selected':'' }} value="{{ $campagne_type->name }}">{{ $campagne_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Nom_campagne">Nom campagne</label>
                                <input type="text" name="__tracking__Nom_campagne" id="__tracking__Nom_campagne" class="form-control shadow-none {{ isset($all_request['__tracking__Nom_campagne']) ? 'filter-field--active':'' }} filterInputChage" placeholder="Nom campagne"
                                value ="{{ $all_request['__tracking__Nom_campagne'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Date_demande_lead_from">Date demande lead from</label>
                                <input type="date" name="__tracking__Date_demande_lead_from" id="__tracking__Date_demande_lead_from"
                                    value ="{{ $all_request['__tracking__Date_demande_lead_from'] ?? '' }}"
                                 class="flatpickr flatpickr-input form-control shadow-none {{ isset($all_request['__tracking__Date_demande_lead_from']) ? 'filter-field--active':'' }} filterDateChage" placeholder="{{ __('dd-mm-yyyy') }}" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Date_demande_lead_to">Date demande lead to</label>
                                <input type="date" name="__tracking__Date_demande_lead_to" id="__tracking__Date_demande_lead_to"
                                    value ="{{ $all_request['__tracking__Date_demande_lead_to'] ?? '' }}"
                                 class="flatpickr flatpickr-input form-control shadow-none {{ isset($all_request['__tracking__Date_demande_lead_to']) ? 'filter-field--active':'' }} filterDateChage" placeholder="{{ __('dd-mm-yyyy') }}" >
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Date_attribution_télécommercial">Date attribution télécommercial</label>
                                <input type="date" name="__tracking__Date_attribution_télécommercial" id="__tracking__Date_attribution_télécommercial" class="flatpickr flatpickr-input form-control shadow-none {{ isset($all_request['__tracking__Date_attribution_télécommercial']) ? 'filter-field--active':'' }} filterDateChage" value="{{ $all_request['__tracking__Date_attribution_télécommercial'] ?? '' }}" placeholder="{{ __('dd-mm-yyyy') }}">
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Mode_de_chauffage">Mode de chauffage</label>
                                <select name="__tracking__Mode_de_chauffage" id="__tracking__Mode_de_chauffage" class="form-control shadow-none {{ isset($all_request['__tracking__Mode_de_chauffage']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($heatings as $heating)
                                        <option {{ (isset($all_request['__tracking__Mode_de_chauffage']) && $all_request['__tracking__Mode_de_chauffage'] == $heating->name) ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Informations personnelles</h2>
                    <div class="row"> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="f__first_name">{{ __('Prenom') }} </label>
                                <input type="text" name="Prenom" id="f__first_name" class="form-control shadow-none {{ isset($all_request['Prenom']) ? 'filter-field--active':'' }} filterInputChage" value="{{ $all_request['Prenom'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="f__last_name">{{ __('Nom') }} </label>
                                <input type="text" name="Nom" id="f__last_name" class="form-control shadow-none {{ isset($all_request['Nom']) ? 'filter-field--active':'' }} filterInputChage" value="{{ $all_request['Nom'] ?? '' }}">
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="f__email">{{ __('Email') }} </label>
                                <input type="email" name="Email" id="f__email" class="form-control shadow-none {{ isset($all_request['Email']) ? 'filter-field--active':'' }} filterInputChage" value="{{ $all_request['Email'] ?? '' }}">
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Éligibilité</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Type_occupation">Type occupation </label>
                                <select name="Type_occupation" id="Type_occupation" class="custom-select shadow-none form-control {{ isset($all_request['Type_occupation']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Type_occupation']) && $all_request['Type_occupation'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ (isset($all_request['Type_occupation']) && $all_request['Type_occupation'] =='Indivision') ? 'selected':'' }} value="Indivision">{{ __('Indivision') }}</option>
                                    <option {{ (isset($all_request['Type_occupation']) && $all_request['Type_occupation'] =='SCI') ? 'selected':'' }} value="SCI">{{ __('SCI') }}</option>
                                    <option {{ (isset($all_request['Type_occupation']) && $all_request['Type_occupation'] =='Pleine propriété') ? 'selected':'' }} value="Pleine propriété">{{ __('Pleine propriété') }}</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Zone">{{ __('Zone') }}</label>
                                <select name="Zone" id="Zone"  class="custom-select shadow-none form-control {{ isset($all_request['Zone']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Zone']) && $all_request['Zone'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ (isset($all_request['Zone']) && $all_request['Zone'] == 'H1') ? 'selected':'' }} value="H1">H1</option>
                                    <option {{ (isset($all_request['Zone']) && $all_request['Zone'] == 'H2') ? 'selected':'' }} value="H2">H2</option>
                                    <option {{ (isset($all_request['Zone']) && $all_request['Zone'] == 'H3') ? 'selected':'' }} value="H3">H3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="precariousness">Éligibilité MaPrimeRenov </label>
                                <select name="precariousness" id="precariousness"  class="custom-select shadow-none form-control {{ isset($all_request['precariousness']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['precariousness']) && $all_request['precariousness'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ (isset($all_request['precariousness']) && $all_request['precariousness'] == 'Classique') ? 'selected':'' }} value="Classique">Classique</option>
                                    <option {{ (isset($all_request['precariousness']) && $all_request['precariousness'] == 'Intermediaire') ? 'selected':'' }} value="Intermediaire">Intermediaire</option>
                                    <option {{ (isset($all_request['precariousness']) && $all_request['precariousness'] == 'Precaire') ? 'selected':'' }} value="Precaire">Precaire</option>
                                    <option {{ (isset($all_request['precariousness']) && $all_request['precariousness'] == 'Grand Precaire') ? 'selected':'' }} value="Grand Precaire">Grand Precaire</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Information logement</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Mode_de_chauffage"> Mode de chauffage </label>
                                <select id="Mode_de_chauffage" name="Mode_de_chauffage" class="form-control w-100 {{ isset($all_request['Mode_de_chauffage']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Mode_de_chauffage']) && $all_request['Mode_de_chauffage'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($heatings as $heating)
                                        <option {{ (isset($all_request['Mode_de_chauffage']) && $all_request['Mode_de_chauffage'] == $heating->name) ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Surface_habitable"> Surface habitable </label>
                                <input type="number" step="any" name="Surface_habitable" id="Surface_habitable" class="form-control shadow-none {{ isset($all_request['Surface_habitable']) ? 'filter-field--active':'' }} filterInputChage"
                                value="{{ $all_request['Surface_habitable'] ?? '' }}">
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Situation foyer</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Situation_familiale"> Situation familiale</label>
                                <select name="Situation_familiale"  id="Situation_familiale" class="form-control shadow-none {{ isset($all_request['Situation_familiale']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Marié') ? 'selected':'' }} value="Marié">Marié</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Pacsé') ? 'selected':'' }} value="Pacsé">Pacsé</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Concubinage') ? 'selected':'' }} value="Concubinage">Concubinage</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Divorcé') ? 'selected':'' }} value="Divorcé">Divorcé</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Séparé') ? 'selected':'' }} value="Séparé">Séparé</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Célibataire') ? 'selected':'' }} value="Célibataire">Célibataire</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Veuf') ? 'selected':'' }} value="Veuf">Veuf</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale']  == 'Autre') ? 'selected':'' }} value="Autre">Autre</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Projet</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Ville">Ville des travaux</label>
                                <input type="text" name="Ville" id="Ville" class="form-control shadow-none {{ isset($all_request['Ville']) ? 'filter-field--active':'' }} filterInputChage"
                                value="{{ $all_request['Ville'] ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Consommation_Chauffage_Annuel_2">Département des travaux</label>
                                <select  name="department[]" id="department" class="select2_select_option form-control w-100 {{ count($department_request) > 0 ? 'filter-field--active':'' }} filterInputChage" multiple>
                                    {{-- <option value="" selected>{{ __('Select') }}</option> --}}
                                    <option {{ in_array('no-data', $department_request) ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($departments as $department)
                                        <option {{ in_array($department->postal_code, $department_request) ? 'selected':'' }} value="{{ $department->postal_code }}">{{ strlen($department->postal_code) == 1 ? '0':'' }}{{ $department->postal_code }} - {{ $department->city }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="bareme">Barème</label>
                                <select  name="bareme[]" id="bareme" class="select2_select_option form-control w-100 {{ count($bareme_request) ? 'filter-field--active':'' }} filterInputChage" multiple>
                                    {{-- <option value="" selected>{{ __('Select') }}</option> --}}
                                    <option {{ in_array('no-data', $bareme_request) ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($bareme_travaux_tags->where('rank', 1) as $t_travaux)
                                        <option {{ in_array($t_travaux->id, $bareme_request) ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->bareme }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="travaux">Travaux</label>
                                <select  name="travaux[]" id="travaux" class="select2_select_option form-control w-100 {{ count($travaux_request) ? 'filter-field--active':'' }} filterInputChage" multiple>
                                    {{-- <option value="" selected>{{ __('Select') }}</option> --}}
                                    <option {{ in_array('no-data', $travaux_request) ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($bareme_travaux_tags as $t_travaux)
                                        <option {{ in_array($t_travaux->id, $travaux_request) ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="tag">TAG</label>
                                <select  name="tag" id="tag" class=" form-control w-100 {{ isset($all_request['tag']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['tag']) && $all_request['tag'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($bareme_travaux_tags->where('rank', 1) as $t_travaux)
                                        <option {{ (isset($all_request['tag']) && $all_request['tag'] == $t_travaux->id) ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Type_de_contrat">Type de contrat</label>
                                <select  name="Type_de_contrat" id="Type_de_contrat" class=" form-control w-100 {{ isset($all_request['Type_de_contrat']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>											
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'Credit') ? 'selected':'' }} value="Credit">Credit</option>
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'MaPrimeRenov') ? 'selected':'' }} value="MaPrimeRenov">MaPrimeRenov</option>
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'BAR TH 164 – 2022') ? 'selected':'' }} value="BAR TH 164 – 2022">BAR TH 164 – 2022</option>
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'BAR TH 164 – 2023') ? 'selected':'' }} value="BAR TH 164 – 2023">BAR TH 164 – 2023</option>
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'BAR TH 164 – 2023 (après 01/07/2023)') ? 'selected':'' }} value="BAR TH 164 – 2023 (après 01/07/2023)">BAR TH 164 – 2023 (après 01/07/2023)</option>
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'BAR TH 145') ? 'selected':'' }} value="BAR TH 145">BAR TH 145</option>
                                    <option {{ (isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'BAR TH 173') ? 'selected':'' }} value="BAR TH 173">BAR TH 173</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Autre</h2>
                    <div class="row"> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Statut</label>
                                <select  name="sub_status[]" class="select2_select_option form-control w-100 {{ count($sub_status_request) > 0 ? 'filter-field--active':'' }} filterInputChage" multiple>
                                    {{-- <option value="" selected>{{ __('Select') }}</option> --}}
                                    <option {{ in_array('no-data', $sub_status_request) ? 'selected':'' }} value="no-data">Pas de sous statut</option>
                                    @foreach ($lead_sub_status as $sub_status)
                                        <option {{ in_array($sub_status->id, $sub_status_request) ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        @if ($filter_telecommercial_status || role() == 'sales_manager' || role() == 'sales_manager_externe')
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">Télécommercial</label>
                                    <select  name="telecommercial_id" class=" form-control w-100 {{ isset($all_request['telecommercial_id']) ? 'filter-field--active':'' }} filterInputChage">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ (isset($all_request['telecommercial_id']) && $all_request['telecommercial_id'] == 'no-data') ? 'selected':'' }} value="no-data">Pas d'assignation</option>
                                        @foreach ($telecommercials as $telecommercial)
                                            <option {{ (isset($all_request['telecommercial_id']) && $all_request['telecommercial_id'] == $telecommercial->id) ? 'selected':'' }} value="{{ $telecommercial->id }}">{{ $telecommercial->name }}</option>	
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        @endif
                        @if ($permission_regies)
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">Régie</label>
                                    <select  name="regie" class=" form-control w-100 {{ isset($all_request['regie']) ? 'filter-field--active':'' }} filterInputChage">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ (isset($all_request['regie']) && $all_request['regie'] == 'no-regie') ? 'selected':'' }} value="no-regie">{{ __('No Regie') }}</option>
                                        @foreach ($regies as $regie)
                                            <option {{ (isset($all_request['regie']) && $all_request['regie'] == $regie->id) ? 'selected':'' }} value="{{ $regie->id }}">{{ $regie->name }}</option>	
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        @endif
                    </div>
                    <div class="form-group d-flex justify-content-center align-items-center mt-4">
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">Filtre</button>
                        @if (\Request::route()->getName() == 'lead.all.filter')
                            <a href="{{ route('leads.all', $status) }}" class="primary-btn btn-danger primary-btn--lg rounded border-0 mb-3 ml-2">Reset</a>
                        @endif 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>