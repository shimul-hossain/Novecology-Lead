<div class="modal modal--aside fade" id="hugeFilterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body pt-0 px-lg-4">
                <h1 class="form__title position-relative text-center mb-4">Filtres</h1>
                <form action="{{ route('project.filter', $status) }}" method="get">

                    <h2 class="modal-sub-title position-relative">Autre</h2>
                    <div class="row"> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label">Statut</label>
                                <select  name="sub_status[]" class="select2_select_option form-control w-100 {{ count($sub_status_request) > 0 ? 'filter-field--active':'' }} filterInputChage" multiple>
                                    <option {{ in_array('no-data', $sub_status_request) ? 'selected':'' }} value="no-data">Pas de sous statut</option>
                                    @foreach ($project_sub_status as $sub_status)
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
                                        <option {{ ( isset($all_request['telecommercial_id']) && $all_request['telecommercial_id'] == 'no-data') ? 'selected':'' }} value="no-data">Pas d'assignation</option>
                                        @foreach ($telecommercials as $telecommercial)
                                            <option {{ (isset($all_request['telecommercial_id']) && $all_request['telecommercial_id'] == $telecommercial->id) ? 'selected':'' }} value="{{ $telecommercial->id }}">{{ $telecommercial->name }}</option>	
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        @endif
                        @if ($filter_telecommercial_status)
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">Gestionnaire</label>
                                    <select  name="gestionnaire_id" class=" form-control w-100 {{ isset($all_request['gestionnaire_id']) ? 'filter-field--active':'' }} filterInputChage">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ ( isset($all_request['gestionnaire_id']) && $all_request['gestionnaire_id'] == 'no-data') ? 'selected':'' }} value="no-data">Pas d'assignation</option>
                                        @foreach ($suvbention_gestionnaires as $gestionnaire)
                                            <option {{ (isset($all_request['gestionnaire_id']) && $all_request['gestionnaire_id'] == $gestionnaire->id) ? 'selected':'' }} value="{{ $gestionnaire->id }}">{{ $gestionnaire->name }}</option>	
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        @endif
                        @if ($permission_regies)
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label class="form-label">Regie</label>
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

                    <h2 class="modal-sub-title position-relative  mt-3">{{ __('Lead Tracking (Form and response)') }}</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Fournisseur_de_lead">Fournisseur de lead</label>
                                <select name="__tracking__Fournisseur_de_lead" id="__tracking__Fournisseur_de_lead" class="form-control shadow-none {{ isset($all_request['__tracking__Fournisseur_de_lead']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ ( isset($all_request['__tracking__Fournisseur_de_lead']) && $all_request['__tracking__Fournisseur_de_lead'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($suppliers as $supplier)
                                    <option  {{ (isset($all_request['__tracking__Fournisseur_de_lead']) &&  $supplier->id == $all_request['__tracking__Fournisseur_de_lead']) ? 'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->suplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="__tracking__Type_de_campagne">Type de campagne</label>
                                <select name="__tracking__Type_de_campagne" id="__tracking__Type_de_campagne" class="form-control shadow-none {{ isset($all_request['__tracking__Type_de_campagne']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ ( isset($all_request['__tracking__Type_de_campagne']) && $all_request['__tracking__Type_de_campagne'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
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
                                    <option {{ ( isset($all_request['Type_occupation']) && $all_request['Type_occupation'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
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
                                    <option {{ ( isset($all_request['Zone']) && $all_request['Zone'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ isset($all_request['Zone']) && $all_request['Zone'] == 'H1' ? 'selected':'' }} value="H1">H1</option>
                                    <option {{ isset($all_request['Zone']) && $all_request['Zone'] == 'H2' ? 'selected':'' }} value="H2">H2</option>
                                    <option {{ isset($all_request['Zone']) && $all_request['Zone'] == 'H3' ? 'selected':'' }} value="H3">H3</option>
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
                                <select id="Mode_de_chauffage" name="Mode_de_chauffage" class=" form-control w-100 {{ isset($all_request['Mode_de_chauffage']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ ( isset($all_request['Mode_de_chauffage']) && $all_request['Mode_de_chauffage'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
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
                                    <option {{ ( isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Marié') ? 'selected':'' }} value="Marié">Marié</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Pacsé') ? 'selected':'' }} value="Pacsé">Pacsé</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Concubinage') ? 'selected':'' }} value="Concubinage">Concubinage</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Divorcé') ? 'selected':'' }} value="Divorcé">Divorcé</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Séparé') ? 'selected':'' }} value="Séparé">Séparé</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Célibataire') ? 'selected':'' }} value="Célibataire">Célibataire</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Veuf') ? 'selected':'' }} value="Veuf">Veuf</option>
                                    <option {{ (isset($all_request['Situation_familiale']) && $all_request['Situation_familiale'] == 'Autre') ? 'selected':'' }} value="Autre">Autre</option>
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
                                <select  name="department[]" id="department" class="select2_select_option form-control w-100 {{ count($department_request) ? 'filter-field--active':'' }} filterInputChage" multiple>
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
                                    <option {{ ( isset($all_request['tag']) && $all_request['tag'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    @foreach ($bareme_travaux_tags->where('rank', 1) as $t_travaux)
                                        <option {{ (isset($all_request['tag']) && $all_request['tag'] == $t_travaux->id) ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->tag }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="product">Produit installé</label>
                                <select  name="product" id="product" class=" form-control w-100 {{ isset($all_request['product']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($products as $product)
                                        <option {{ (isset($all_request['product']) && $all_request['product'] == $product->id) ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Type_de_contrat">Type de contrat</label>
                                <select  name="Type_de_contrat" id="Type_de_contrat" class=" form-control w-100 {{ isset($all_request['Type_de_contrat']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>  
                                    <option {{ ( isset($all_request['Type_de_contrat']) && $all_request['Type_de_contrat'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
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
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_Projet">Statut Projet</label>
                                <select  name="Statut_Projet" id="Statut_Projet" class=" form-control w-100 {{ isset($all_request['Statut_Projet']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option> 
                                    <option {{ ( isset($all_request['Statut_Projet']) && $all_request['Statut_Projet'] == 'no-data') ? 'selected':'' }} value="no-data">{{ __('Not Provided') }}</option>
                                    <option {{ (isset($all_request['Statut_Projet']) && $all_request['Statut_Projet'] == 'Devis signé') ? 'selected':'' }} value="Devis signé">Devis signé</option>
                                    <option {{ (isset($all_request['Statut_Projet']) && $all_request['Statut_Projet'] == 'Réflexion') ? 'selected':'' }} value="Réflexion">Réflexion</option>
                                    <option {{ (isset($all_request['Statut_Projet']) && $all_request['Statut_Projet'] == 'KO') ? 'selected':'' }} value="KO">KO</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Contrôles des pièces</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Pièces_manquante">Pièces manquante</label>
                                <select name="Pièces_manquante"  id="Pièces_manquante" class="form-control shadow-none {{ isset($all_request['Pièces_manquante']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Pièces_manquante']) && $all_request['Pièces_manquante'] == 'OUI') ? 'selected':'' }} value="OUI">OUI</option>
                                    <option {{ (isset($all_request['Pièces_manquante']) && $all_request['Pièces_manquante'] == 'NON') ? 'selected':'' }} value="NON">NON</option> 
                                </select>
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Interventions</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="intervention_type">Sélectionner une intervention</label>
                                <select name="intervention_type" id="intervention_type" class="form-control shadow-none {{ isset($all_request['intervention_type']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['intervention_type']) && $all_request['intervention_type'] == 'Etude') ? 'selected':'' }} value="Etude">Etude</option>
                                    <option {{ (isset($all_request['intervention_type']) && $all_request['intervention_type'] == 'Pré-Visite Technico-Commercial') ? 'selected':'' }} value="Pré-Visite Technico-Commercial">Pré-Visite Technico-Commercial</option>
                                    <option {{ (isset($all_request['intervention_type']) && $all_request['intervention_type'] == 'Contre Visite Technique') ? 'selected':'' }} value="Contre Visite Technique">Contre Visite Technique</option>
                                    <option {{ (isset($all_request['intervention_type']) && $all_request['intervention_type'] == 'Installation') ? 'selected':'' }} value="Installation">Installation</option>
                                    <option {{ (isset($all_request['intervention_type']) && $all_request['intervention_type'] == 'SAV') ? 'selected':'' }} value="SAV">SAV</option>
                                    <option {{ (isset($all_request['intervention_type']) && $all_request['intervention_type'] == 'Prévisite virtuelle') ? 'selected':'' }} value="Prévisite virtuelle">Prévisite virtuelle</option>
                                    <option {{ (isset($all_request['intervention_type']) && $all_request['intervention_type'] == 'Déplacement') ? 'selected':'' }} value="Déplacement">Déplacement</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_planning">Statut planning</label>
                                <select name="Statut_planning" id="Statut_planning" class="form-control shadow-none {{ isset($all_request['Statut_planning']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($status_planning as $item)
                                        <option {{ (isset($all_request['Statut_planning']) && $all_request['Statut_planning'] == $item->name) ? 'selected':'' }} value="{{ $item->name }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Faisabilité_du_chantier">Faisabilité du chantier</label>
                                <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantier" class="form-control shadow-none {{ isset($all_request['Faisabilité_du_chantier']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Faisabilité_du_chantier']) && $all_request['Faisabilité_du_chantier'] == 'Faisable') ? 'selected':'' }} value="Faisable">Faisable</option>
                                    <option {{ (isset($all_request['Faisabilité_du_chantier']) && $all_request['Faisabilité_du_chantier'] == 'Infaisable') ? 'selected':'' }} value="Infaisable">Infaisable</option>
                                    <option {{ (isset($all_request['Faisabilité_du_chantier']) && $all_request['Faisabilité_du_chantier'] == 'Faisable sous condition') ? 'selected':'' }} value="Faisable sous condition">Faisable sous condition</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Dossier_administratif_complet">Dossier administratif complet</label>
                                <select name="Dossier_administratif_complet" id="Dossier_administratif_complet" class="form-control shadow-none {{ isset($all_request['Dossier_administratif_complet']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Dossier_administratif_complet']) && $all_request['Dossier_administratif_complet'] == 'yes') ? 'selected':'' }} value="yes">Oui</option>
                                    <option {{ (isset($all_request['Dossier_administratif_complet']) && $all_request['Dossier_administratif_complet'] == 'no') ? 'selected':'' }} value="no">Non</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Installateur_technique">Installateur technique</label>
                                <select name="Installateur_technique" id="Installateur_technique" class="form-control shadow-none {{ isset($all_request['Installateur_technique']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($installers as $installer)
                                        <option {{ (isset($all_request['Installateur_technique']) && $all_request['Installateur_technique'] == $installer->id) ? 'selected':'' }} value="{{ $installer->id }}">{{ $installer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_Installation">Statut Installation</label>
                                <select name="Statut_Installation" id="Statut_Installation" class="form-control shadow-none {{ isset($all_request['Statut_Installation']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Statut_Installation']) && $all_request['Statut_Installation'] == 'Terminé - Complet') ? 'selected':'' }} value="Terminé - Complet">Terminé - Complet</option>
                                    <option {{ (isset($all_request['Statut_Installation']) && $all_request['Statut_Installation'] == 'Non terminé - Incomplet') ? 'selected':'' }} value="Non terminé - Incomplet">Non terminé - Incomplet</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Chargé_étude">Chargé d’étude</label>
                                <select name="Chargé_étude" id="Chargé_étude" class="form-control shadow-none {{ isset($all_request['Chargé_étude']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($charge_etudes as $etude)
                                        <option {{ (isset($all_request['Chargé_étude']) && $all_request['Chargé_étude'] == $etude->id) ? 'selected':'' }} value="{{ $etude->id }}">{{ $etude->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Réfèrent_technique">Réfèrent technique</label>
                                <select name="Réfèrent_technique" id="Réfèrent_technique" class="form-control shadow-none {{ isset($all_request['Réfèrent_technique']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($technical_referees as $technical_referee)
                                        <option {{ (isset($all_request['Réfèrent_technique']) && $all_request['Réfèrent_technique'] == $technical_referee->id) ? 'selected':'' }} value="{{ $technical_referee->id }}">{{ $technical_referee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Prévisiteur_Technico_Commercial">Prévisiteur Technico-Commercial</label>
                                <select name="Prévisiteur_Technico_Commercial" id="Prévisiteur_Technico_Commercial" class="form-control shadow-none {{ isset($all_request['Prévisiteur_Technico_Commercial']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($technical_commercials->where('role_id', 4) as $technical_commercial)
                                        <option {{ (isset($all_request['Prévisiteur_Technico_Commercial']) && $all_request['Prévisiteur_Technico_Commercial'] == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Contre_prévisiteur">Contre prévisiteur</label>
                                <select name="Contre_prévisiteur" id="Contre_prévisiteur" class="form-control shadow-none {{ isset($all_request['Contre_prévisiteur']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($technical_commercials as $technical_commercial)
                                        <option {{ (isset($all_request['Contre_prévisiteur']) && $all_request['Contre_prévisiteur'] == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Technicien_SAV">Technicien SAV</label>
                                <select name="Technicien_SAV" id="Technicien_SAV" class="form-control shadow-none {{ isset($all_request['Technicien_SAV']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($technical_commercials as $technical_commercial)
                                        <option {{ (isset($all_request['Technicien_SAV']) && $all_request['Technicien_SAV'] == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_SAV">Statut SAV</label>
                                <select name="Statut_SAV" id="Statut_SAV" class="form-control shadow-none {{ isset($all_request['Statut_SAV']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Statut_SAV']) && $all_request['Statut_SAV'] == 'RESOLU') ? 'selected':'' }} value="RESOLU">RESOLU</option>
                                    <option {{ (isset($all_request['Statut_SAV']) && $all_request['Statut_SAV'] == 'NON RESOLU') ? 'selected':'' }} value="NON RESOLU">NON RESOLU</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">MaPrimeRenov'</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="subvention_status">Statut MPR - Subvention</label>
                                <select name="subvention_status" id="subvention_status" class="form-control shadow-none {{ isset($all_request['subvention_status']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($statut_maprimerenovs as $statut_maprimerenov)
                                        <option {{ (isset($all_request['subvention_status']) && $all_request['subvention_status'] == $statut_maprimerenov->name)? 'selected':'' }} value="{{ $statut_maprimerenov->name }}">{{ $statut_maprimerenov->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="mandataire">Mandataire MaPrimeRénov</label>
                                <select name="mandataire" id="mandataire" class="form-control shadow-none {{ isset($all_request['mandataire']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($mandataire_maprimerenovs as $mandataire_maprimerenov)
                                        <option {{ (isset($all_request['mandataire']) && $all_request['mandataire'] == $mandataire_maprimerenov->company_name) ? 'selected':'' }} value="{{ $mandataire_maprimerenov->company_name }}">{{ $mandataire_maprimerenov->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="gestionnaire_depot">Gestionnaire</label>
                                <select name="gestionnaire_depot" id="gestionnaire_depot" class="form-control shadow-none {{ isset($all_request['gestionnaire_depot']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($suvbention_gestionnaires as $suvbention_gestionnaire)
                                        <option {{ (isset($all_request['gestionnaire_depot']) && $all_request['gestionnaire_depot'] == $suvbention_gestionnaire->id)? 'selected':'' }} value="{{ $suvbention_gestionnaire->id }}">{{ $suvbention_gestionnaire->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_subvention">Statut subvention</label>
                                <select name="Statut_subvention" id="Statut_subvention" class="form-control shadow-none {{ isset($all_request['Statut_subvention']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Statut_subvention']) && $all_request['Statut_subvention'] == 'Accordé') ? 'selected':'' }} value="Accordé">Accordé</option>
                                    <option {{ (isset($all_request['Statut_subvention']) && $all_request['Statut_subvention'] == 'Refusé') ? 'selected':'' }} value="Refusé">Refusé</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="status_1">Statut 1 - MyMPR</label>
                                <input type="text" name="status_1" id="status_1" class="form-control shadow-none {{ isset($all_request['status_1']) ? 'filter-field--active':'' }} filterInputChage" value="{{ $all_request['status_1'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Banque</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="banque">Banque</label>
                                <select name="banque" id="banque" class="form-control shadow-none {{ isset($all_request['banque']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($banques as $banque)
                                        <option {{ (isset($all_request['banque']) && $all_request['banque'] == $banque->id)? 'selected':'' }} value="{{ $banque->id }}">{{ $banque->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="banque_status">Statut dépôt banque</label>
                                <select name="banque_status" id="banque_status" class="form-control shadow-none {{ isset($all_request['banque_status']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['banque_status']) && $all_request['banque_status'] == "Déposé") ? 'selected':'' }} value="Déposé">Déposé</option>
                                    <option {{ (isset($all_request['banque_status']) && $all_request['banque_status'] == "En attente de pièces complémentaires") ? 'selected':'' }} value="En attente de pièces complémentaires">En attente de pièces complémentaires</option>
                                    <option {{ (isset($all_request['banque_status']) && $all_request['banque_status'] == "Accord sous réserve retour contrat client") ? 'selected':'' }} value="Accord sous réserve retour contrat client">Accord sous réserve retour contrat client</option>
                                    <option {{ (isset($all_request['banque_status']) && $all_request['banque_status'] == "Accord définitif") ? 'selected':'' }} value="Accord définitif">Accord définitif</option>
                                    <option {{ (isset($all_request['banque_status']) && $all_request['banque_status'] == "Avis défavorable") ? 'selected':'' }} value="Avis défavorable">Avis défavorable</option>
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_accord_banque">Statut accord banque</label>
                                <select name="Statut_accord_banque" id="Statut_accord_banque" class="form-control shadow-none {{ isset($all_request['Statut_accord_banque']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option> 
                                    <option {{ (isset($all_request['Statut_accord_banque']) && $all_request['Statut_accord_banque'] == 'Accordé') ? 'selected':'' }} value="Accordé">Accordé</option>
                                    <option {{ (isset($all_request['Statut_accord_banque']) && $all_request['Statut_accord_banque'] == 'Refusé') ? 'selected':'' }} value="Refusé">Refusé</option>
                                </select>
                            </div>
                        </div>  
                    </div> 
                    <h2 class="modal-sub-title position-relative mt-3">Audit Energetique</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="audit_status">Statut audit</label>
                                <select name="audit_status" id="audit_status" class="form-control shadow-none {{ isset($all_request['audit_status']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($status_audits as $audit_status)
                                        <option {{ (isset($all_request['audit_status']) && $all_request['audit_status'] == $audit_status->id)? 'selected':'' }} value="{{ $audit_status->id }}">{{ $audit_status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="report_result">Résultat du rapport audit</label>
                                <select name="report_result" id="report_result" class="form-control shadow-none {{ isset($all_request['report_result']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($report_results as $report_result)
                                        <option {{ (isset($all_request['report_result']) && $all_request['report_result'] == $report_result->id)? 'selected':'' }} value="{{ $report_result->id }}">{{ $report_result->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Contrôle Sur Site</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="csp_type">Contrôle Sur Site</label>
                                <select name="csp_type" id="csp_type" class="form-control shadow-none {{ isset($all_request['csp_type']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['csp_type']) && $all_request['csp_type'] == 'COFRAC')? 'selected':'' }} value="COFRAC">COFRAC</option>
                                    <option {{ (isset($all_request['csp_type']) && $all_request['csp_type'] == 'MISE EN SERVICE')? 'selected':'' }} value="MISE EN SERVICE">MISE EN SERVICE</option>
                                    <option {{ (isset($all_request['csp_type']) && $all_request['csp_type'] == 'CSP MPR')? 'selected':'' }} value="CSP MPR">CSP MPR</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Conformité_du_chantier">Conformité du chantier</label>
                                <select name="Conformité_du_chantier" id="Conformité_du_chantier" class="form-control shadow-none {{ isset($all_request['Conformité_du_chantier']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Conformité_du_chantier']) && $all_request['Conformité_du_chantier'] == 'Conforme')? 'selected':'' }} value="Conforme">Conforme</option>
                                    <option {{ (isset($all_request['Conformité_du_chantier']) && $all_request['Conformité_du_chantier'] == 'Non Conforme')? 'selected':'' }} value="Non Conforme">Non Conforme</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <h2 class="modal-sub-title position-relative mt-3">Facturation</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="facturation_type">Sélectionner une facturation type</label>
                                <select name="facturation_type" id="facturation_type" class="form-control shadow-none {{ isset($all_request['facturation_type']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['facturation_type']) && $all_request['facturation_type'] == 'Encaissement Client')? 'selected':'' }} value="Encaissement Client">Encaissement Client</option>
                                    <option {{ (isset($all_request['facturation_type']) && $all_request['facturation_type'] == 'Encaissement CEE')? 'selected':'' }} value="Encaissement CEE">Encaissement CEE</option>
                                    <option {{ (isset($all_request['facturation_type']) && $all_request['facturation_type'] == 'Encaissement MaPrimeRénov’')? 'selected':'' }} value="Encaissement MaPrimeRénov’">Encaissement MaPrimeRénov’</option>
                                    <option {{ (isset($all_request['facturation_type']) && $all_request['facturation_type'] == 'Encaissement Action Logement')? 'selected':'' }} value="Encaissement Action Logement">Encaissement Action Logement</option>
                                    <option {{ (isset($all_request['facturation_type']) && $all_request['facturation_type'] == 'Encaissement Banque')? 'selected':'' }} value="Encaissement Banque">Encaissement Banque</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_règlement">Statut règlement</label>
                                <select name="Statut_règlement" id="Statut_règlement" class="form-control shadow-none {{ isset($all_request['Statut_règlement']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Statut_règlement']) && $all_request['Statut_règlement'] == 'Payé') ? 'selected':'' }} value="Payé">Payé</option>
                                    <option {{ (isset($all_request['Statut_règlement']) && $all_request['Statut_règlement'] == 'Non payé') ? 'selected':'' }} value="Non payé">Non payé</option>
                                    <option {{ (isset($all_request['Statut_règlement']) && $all_request['Statut_règlement'] == 'En cours de paiement') ? 'selected':'' }} value="En cours de paiement">En cours de paiement</option>
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Paiement_inférieur_au_montant_prévu">Paiement inférieur au montant prévu</label>
                                <select name="Paiement_inférieur_au_montant_prévu" id="Paiement_inférieur_au_montant_prévu" class="form-control shadow-none {{ isset($all_request['Paiement_inférieur_au_montant_prévu']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Paiement_inférieur_au_montant_prévu']) && $all_request['Paiement_inférieur_au_montant_prévu'] == 'yes') ? 'selected':'' }} value="yes">Oui</option>
                                    <option {{ (isset($all_request['Paiement_inférieur_au_montant_prévu']) && $all_request['Paiement_inférieur_au_montant_prévu'] == 'no') ? 'selected':'' }} value="no">Non</option> 
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="facturationMandataire">Mandataire</label>
                                <select name="facturationMandataire" id="facturationMandataire" class="form-control shadow-none {{ isset($all_request['facturationMandataire']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($agents as $agent)
                                        <option {{ (isset($all_request['facturationMandataire']) && $all_request['facturationMandataire'] == $agent->id) ? 'selected':'' }} value="{{ $agent->id }}">{{ $agent->company_name }}</option>
                                    @endforeach 
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Avance_délégataire_MaPrimeRénov">Avance délégataire MaPrimeRénov'</label>
                                <select name="Avance_délégataire_MaPrimeRénov" id="Avance_délégataire_MaPrimeRénov" class="form-control shadow-none {{ isset($all_request['Avance_délégataire_MaPrimeRénov']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Avance_délégataire_MaPrimeRénov']) && $all_request['Avance_délégataire_MaPrimeRénov'] == 'yes') ? 'selected':'' }} value="yes">Oui</option>
                                    <option {{ (isset($all_request['Avance_délégataire_MaPrimeRénov']) && $all_request['Avance_délégataire_MaPrimeRénov'] == 'no') ? 'selected':'' }} value="no">Non</option> 
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Statut_règlement_banque">Statut réglement banque</label>
                                <select name="Statut_règlement_banque" id="Statut_règlement_banque" class="form-control shadow-none {{ isset($all_request['Statut_règlement_banque']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ (isset($all_request['Statut_règlement_banque']) && $all_request['Statut_règlement_banque'] == 'Envoi contrat') ? 'selected':'' }} value="Envoi contrat">Envoi contrat</option>
                                    <option {{ (isset($all_request['Statut_règlement_banque']) && $all_request['Statut_règlement_banque'] == 'Dépôt demande de financement') ? 'selected':'' }} value="Dépôt demande de financement">Dépôt demande de financement</option>
                                    <option {{ (isset($all_request['Statut_règlement_banque']) && $all_request['Statut_règlement_banque'] == 'Payé') ? 'selected':'' }} value="Payé">Payé</option>
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Banque_facturation">Banque</label>
                                <select name="Banque_facturation" id="Banque_facturation" class="form-control shadow-none {{ isset($all_request['Banque_facturation']) ? 'filter-field--active':'' }} filterInputChage">
                                    <option value="" selected>{{ __('Select') }}</option> 
                                    @foreach ($banques as $banque)
                                        <option {{ (isset($all_request['Banque_facturation']) && $banque->id == $all_request['Banque_facturation'])? 'selected':'' }} value="{{ $banque->id }}">{{ $banque->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>  
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="Numero_lot">Numero lot</label>
                                <input type="text" name="Numero_lot" id="Numero_lot" class="form-control shadow-none {{ isset($all_request['Numero_lot']) ? 'filter-field--active':'' }} filterInputChage" value="{{ $all_request['Numero_lot'] ?? '' }}">
                            </div>
                        </div>
                    </div> 
                    <div class="form-group d-flex justify-content-center align-items-center mt-4">
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">Filtre</button> 
                        @if (\Request::route()->getName() == 'project.filter')
                            <a href="{{ route('project.index', $status) }}" class="primary-btn btn-danger primary-btn--lg rounded border-0 mb-3 ml-2">Reset</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>