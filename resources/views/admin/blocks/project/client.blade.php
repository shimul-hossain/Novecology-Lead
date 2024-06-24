@php 

    $heatings = \App\Models\CRM\HeatingMode::orderBy('order', 'asc')->get();
    $childrens = \App\Models\CRM\Children::where('project_id', $project->id)->get(); 
    
    $tax = \App\Models\CRM\ProjectTax::where('project_id', $project->id)->orderBy('primary', 'asc')->get();
    $primary_tax = \App\Models\CRM\ProjectTax::where('project_id', $project->id)->where('primary', 'yes')->first(); 
 
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();   

    
    $code_postal_type = 'Hors IDF';

    if($project->Code_Postal){
        if(\App\Models\CRM\CheckZone::where('postal_code', substr($project->Code_Postal, 0,2))->exists()){
            $code_postal_type = 'IDF';
        }
    }
@endphp
<div class="accordion" id="leadAccordion">

    @if ($user_actions->where('module_name', 'collapse_tax_notice')->where('action_name', 'view')->first() || $user_actions->where('module_name', 'collapse_tax_notice')->where('action_name', 'edit')->first() || $role == 's_admin')
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
                    <button data-tab="Client" data-block="Avis d'impôt" data-tab-class="tax__notice" type="button" data-toggle="collapse" data-target="#leadCardCollapse-3" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('tax__notice') }} position-relative ml-auto mr-1 {{ session('tax__notice') == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
            </div>
            </h2>
        </div>
        <div id="leadCardCollapse-3" class="collapse {{ session('tax__notice') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-3">
            <div class="card-body row">
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col-12 p-0" id="taxWrapperId">
                        @include('includes.crm.project-tax')
                        </div>
                        <div class="col-12 text-center" id="textItem">
                            <div class="lead__card__loader-wrapper d-none">
                                <div class="lead__card__loader">
                                    <svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                        <path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center lead__card__btn-wrapper">

                                {{-- <button type="button" id="taxValidateOption3" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                    {{ __('Validate') }}
                                </button>
                                <button type="button" id="taxValidate" class="primary-btn btn-success primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                    {{ __('Verify') }}
                                </button> --}}
                                <button type="button" id="taxValiderBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                    Passer
                                </button>
                                <button type="button" id="taxVerifyBtn" class="primary-btn btn-success primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 tax_input_disabled">
                                    Vérifier
                                </button>
                                {{-- <button type="button" id="taxTelechargerBtn" class="primary-btn btn-secondary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 tax_input_disabled shadow-none">
                                    Télécharger
                                </button> --}}
                            </div>
                        </div>
                        <div class="col-12 p-0" id="taxWrapperId2">
                            @include('includes.crm.project-tax-info')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($user_actions->where('module_name', 'collapse_personal_information')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_personal_information')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-4">
            <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button">
                <span id="info-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
                    @isset($project->zone)
                    verified
                    @endisset"></span>
                    Informations personnelles
                    <button data-tab="Client" data-block="Informations personnelles" data-tab-class="personal__info" type="button" data-toggle="collapse" data-target="#leadCardCollapse-4" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('personal__info') }} position-relative ml-auto mr-1 {{ session('personal__info') == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
            </div>
            </h2>
        </div>
        <div id="leadCardCollapse-4" class="collapse {{ session('personal__info') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-4">
            @include('includes.crm.personal_info', ['type' => 'collapse_personal_information', 'data' => $project])
        </div>
    </div>
    @endif
    @if ($user_actions->where('module_name', 'collapse_eligibility')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_eligibility')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-5">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="work-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
            @isset($project->nature_occupation)
            verified
            @endisset"></span>
            Éligibilité
                <button data-tab="Client" data-block="Eligibility" data-tab-class="eligibility__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-5" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('eligibility__part') }} position-relative ml-auto mr-1 {{ session('eligibility__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>

            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-5" class="collapse {{ session('eligibility__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-5">
        <div class="card-body row">
            <div class="col custom-space">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Type_occupation">Type occupation <span class="text-danger">*</span></label>
                            <select name="Type_occupation" id="Type_occupation" class="custom-select shadow-none form-control eligibility_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option @if ($project->Type_occupation =='Indivision') selected @endif value="Indivision">{{ __('Indivision') }}</option>
                                <option @if ($project->Type_occupation =='SCI') selected @endif value="SCI">{{ __('SCI') }}</option>
                                <option @if ($project->Type_occupation =='Pleine propriété') selected @endif value="Pleine propriété">{{ __('Pleine propriété') }}</option>
                                <option @if ($project->Type_occupation =='Locataire') selected @endif value="Locataire">Locataire</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-group w-100">
                            <label class="form-label" for="Parcelle_cadastrale">Parcelle cadastrale </label>
                            <input type="text" name="Parcelle_cadastrale" id="Parcelle_cadastrale" class="form-control shadow-none eligibility_disabled"
                            value="{{ $project->Parcelle_cadastrale }}">
                        </div>
                        <a href="#!" data-toggle="modal" data-target="#locationParcelModal" class="ml-2"><img  loading="lazy"  src="{{ asset('crm_assets/assets/images/parcelle.png') }}" alt="parcelle" height="30" width="30"></a>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Type_habitation">Type habitation <span class="text-danger">*</span></label>
                            <select name="Type_habitation" id="Type_habitation"  class="custom-select shadow-none form-control eligibility_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option @if ($project->Type_habitation =='Propriétaire occupant') selected @endif value="Propriétaire occupant">Propriétaire occupant</option> 
                                <option @if ($project->Type_habitation =='Locataire') selected @endif value="Locataire"> Locataire</option> 
                                <option @if ($project->Type_habitation =='Propriétaire bailleur') selected @endif value="Propriétaire bailleur"> Propriétaire bailleur</option> 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Age_du_bâtiment">Age du bâtiment <span class="text-danger">*</span></label>
                            <select name="Age_du_bâtiment" id="Age_du_bâtiment"  class="custom-select shadow-none form-control eligibility_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option @if ($project->Age_du_bâtiment =='Moins de 2 ans') selected @endif value="Moins de 2 ans">Moins de 2 ans</option>
                                <option @if ($project->Age_du_bâtiment =='Non' || $project->Age_du_bâtiment =='plus de 2 ans et moins de 15 ans') selected @endif value="plus de 2 ans et moins de 15 ans">plus de 2 ans et moins de 15 ans</option>
                                <option @if ($project->Age_du_bâtiment =='Oui' || $project->Age_du_bâtiment =='Plus de 15 ans') selected @endif value="Plus de 15 ans">Plus de 15 ans</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Nombre_de_foyer">Nombre de foyer <span class="text-danger">*</span></label>
                            <input type="number" name="Nombre_de_foyer" id="Nombre_de_foyer" class="form-control shadow-none eligibility_disabled"
                            value="{{ $project->Nombre_de_foyer ?? $tax->count() }}"> 
                        </div>
                    </div>
                    <form action="{{ route('eligibility.input.change') }}" method="POST" class="col-12">
                        <div class="row">
                            @csrf
                            <input type="hidden" value="project" name="type">
                            <input type="hidden" value="{{ $project->id }}" name="id">
                            @forelse ($tax as $tax__item)
                                <div class="col-12">
                                    <h1 class=""><u> <strong>Avis {{ $loop->iteration }}</strong></u></h1>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Revenue_Fiscale_de_Référence">Revenue Fiscale de Référence <span class="text-danger">*</span></label>
                                        <input type="hidden" id="Revenue_Fiscale_de_Référence__hidden{{ $tax__item->id }}" value="{{ $tax__item->pays }}">
                                        <input type="number" name="Revenue_Fiscale_de_Référence[{{ $tax__item->id }}]" id="Revenue_Fiscale_de_Référence" data-hidden-id="Revenue_Fiscale_de_Référence__hidden{{ $tax__item->id }}" class="form-control shadow-none eligibility_disabled project_eligibility_input_change"
                                        value="{{ $tax__item->pays }}"> 
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Nombre_de_personnes">Nombre de personnes <span class="text-danger">*</span></label>
                                        <input type="hidden" id="Nombre_de_personnes__hidden{{ $tax__item->id }}" value="{{ $tax__item->family_person }}">
                                        <input type="number" name="Nombre_de_personnes[{{ $tax__item->id }}]"  id="Nombre_de_personnes" data-hidden-id="Nombre_de_personnes__hidden{{ $tax__item->id }}" class="form-control shadow-none eligibility_disabled project_eligibility_input_change"
                                    value="{{ $tax__item->family_person }}"> 
                                    </div>
                                </div>
                            @empty
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Revenue_Fiscale_de_Référence">Revenue Fiscale de Référence <span class="text-danger">*</span></label>
                                        <input type="hidden" id="Revenue_Fiscale_de_Référence__hidden" value="{{ $project->Revenue_Fiscale_de_Référence }}">
                                        <input type="number" name="Revenue_Fiscale_de_Référence[0]" id="Revenue_Fiscale_de_Référence" data-hidden-id="Revenue_Fiscale_de_Référence__hidden" class="form-control shadow-none eligibility_disabled project_eligibility_input_change"
                                        value="{{ $project->Revenue_Fiscale_de_Référence }}"> 
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Nombre_de_personnes">Nombre de personnes <span class="text-danger">*</span></label>
                                        <input type="hidden" id="Nombre_de_personnes__hidden" value="{{ $project->Nombre_de_personnes }}">
                                        <input type="number" name="Nombre_de_personnes[0]"  id="Nombre_de_personnes" data-hidden-id="Nombre_de_personnes__hidden" class="form-control shadow-none eligibility_disabled project_eligibility_input_change"
                                    value="{{ $project->Nombre_de_personnes }}"> 
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Revenue_Fiscale_de_Référence">Revenue Fiscale de Référence <span class="text-danger">*</span></label>
                                        <input type="hidden" id="Revenue_Fiscale_de_Référence__hidden" value="{{ $project->Revenue_Fiscale_de_Référence }}">
                                        <input type="number" name="Revenue_Fiscale_de_Référence" id="Revenue_Fiscale_de_Référence" class="form-control shadow-none eligibility_disabled project_eligibility_input_change"
                                        value="{{ $project->Revenue_Fiscale_de_Référence }}" data-hidden-id="Revenue_Fiscale_de_Référence__hidden"> 
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Nombre_de_personnes">Nombre de personnes <span class="text-danger">*</span></label>
                                        <input type="hidden" id="Nombre_de_personnes__hidden" value="{{ $project->Nombre_de_personnes }}">
                                        <input type="number" name="Nombre_de_personnes"  id="Nombre_de_personnes" class="form-control shadow-none eligibility_disabled project_eligibility_input_change"
                                    value="{{ $project->Nombre_de_personnes }}" data-hidden-id="Nombre_de_personnes__hidden"> 
                                    </div>
                                </div>  --}}
                            @endforelse 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Zone">{{ __('Zone') }}</label>
                                    <input type="text" name="Zone" readonly id="Zone"  class="form-control shadow-none eligibility_disabled"
                                value="{{ $project->Zone }}"> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="precariousness">Éligibilité MaPrimeRenov</label>

                                    <div class="dropdown">
                                        <input class="dropdown_custom-select" type="hidden" name="precariousness" id="precariousness"
                                        value="@if ($project->precariousness == 'Classique')
                                                Classique
                                            @elseif($project->precariousness == 'Intermediaire')
                                                Intermediaire
                                            @elseif($project->precariousness == 'Precaire')
                                                Precaire
                                            @elseif($project->precariousness == 'Grand Precaire')
                                                Grand Precaire
                                            @endif">
                                            
                                        @if ($project->projectSecondTable && ($project->projectSecondTable->manual_import == 1 || $project->projectSecondTable->manual_import == 2))
                                            <button class="custom-select shadow-none form-control text-left dropdown-toggle
                                                @if ($project->projectSecondTable->precariousness == 'Classique')
                                                    Classique-option
                                                @elseif($project->projectSecondTable->precariousness == 'Intermediaire')
                                                    Intermediaire-option
                                                @elseif($project->projectSecondTable->precariousness == 'Precaire')
                                                    Precaire-option
                                                @elseif($project->projectSecondTable->precariousness == 'Grand Precaire')
                                                    Grand_Precaire-option
                                                @endif" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                @if ($project->projectSecondTable->precariousness == 'Classique')
                                                    Classique
                                                @elseif($project->projectSecondTable->precariousness == 'Intermediaire')
                                                    Intermediaire
                                                @elseif($project->projectSecondTable->precariousness == 'Precaire')
                                                    Precaire
                                                @elseif($project->projectSecondTable->precariousness == 'Grand Precaire')
                                                    Grand Precaire
                                                @endif
                                            </button>
                                        @else  
                                            <button id="precariousnessDropdownToggle" class="custom-select shadow-none form-control text-left dropdown-toggle
                                                @if ($project->precariousness == 'Classique')
                                                    Classique-option
                                                @elseif($project->precariousness == 'Intermediaire')
                                                    Intermediaire-option
                                                @elseif($project->precariousness == 'Precaire')
                                                    Precaire-option
                                                @elseif($project->precariousness == 'Grand Precaire')
                                                    Grand_Precaire-option
                                                @endif" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                @if ($project->precariousness == 'Classique')
                                                    Classique
                                                @elseif($project->precariousness == 'Intermediaire')
                                                    Intermediaire
                                                @elseif($project->precariousness == 'Precaire')
                                                    Precaire
                                                @elseif($project->precariousness == 'Grand Precaire')
                                                    Grand Precaire
                                                @endif

                                            </button>
                                        @endif 
                                        {{-- <div class="dropdown-menu py-0 w-100">
                                        <button type="button" class="dropdown-item Classique-option" data-class="Classique-option" data-value="Classique">Classique</button>
                                        <button type="button" class="dropdown-item Intermediaire-option" data-class="Intermediaire-option" data-value="Intermediaire">Intermediaire</button>
                                        <button type="button" class="dropdown-item Precaire-option" data-class="Precaire-option" data-value="Precaire">Precaire</button>
                                        <button type="button" class="dropdown-item Grand_Precaire-option" data-class="Grand_Precaire-option" data-value="Grand Precaire">Grand Precaire</button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Zone Précarité</h4>
                                <div class="tab-checkbox">
                                    <label class="tab-checkbox__btn">
                                        <input type="radio" name="zone_type" class="tab-checkbox__input" id="Zone_IDF" disabled {{ $code_postal_type == 'IDF' ? 'checked':'' }}>
                                        <span class="tab-checkbox__btn__label">IDF</span>
                                    </label>
                                    <label class="tab-checkbox__btn">
                                        <input type="radio" name="zone_type" class="tab-checkbox__input" id="Zone_Hors_IDF" disabled {{ $code_postal_type == 'Hors IDF' ? 'checked':'' }}>
                                        <span class="tab-checkbox__btn__label">Hors IDF</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Bareme</h4> 
                                {{-- <label class="switch-checkbox">
                                    <input type="checkbox" id="precariousness_year" {{ $project->precariousness_year == '2023' ? 'checked':'' }} class="switch-checkbox__input eligibility_disabled">
                                    <span class="switch-checkbox__label switch-checkbox__label--dynamic" data-on="2023" data-off="2024"></span>
                                </label> --}}
                                <div class="tab-checkbox">
                                    <label class="tab-checkbox__btn">
                                        <input type="radio" name="precariousness_year" onchange="this.closest('form').submit()" value="2023" class="tab-checkbox__input eligibility_disabled" {{ $project->precariousness_year == '2023' ? 'checked':'' }}>
                                        <span class="tab-checkbox__btn__label">2023</span>
                                    </label>
                                    <label class="tab-checkbox__btn">
                                        <input type="radio" name="precariousness_year" onchange="this.closest('form').submit()" value="2024" class="tab-checkbox__input eligibility_disabled" {{ $project->precariousness_year == '2024' ? 'checked':'' }}>
                                        <span class="tab-checkbox__btn__label">2024</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'lead_collapse_eligibility'), 'custom_field_data' => $project->eligibility_custom_field_data, 'class' => 'eligibility__custom_field', 'disabled_class' => 'eligibility_disabled'])
                    @if ($user_actions->where('module_name', 'collapse_eligibility')->where('action_name', 'edit')->first() || $role == 's_admin')
                        <div class="col-12 text-center ">
                            <button id="workValidate"
                            type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 eligibility_disabled">
                                {{ __('Submit') }}
                            </button>
                            @if ($role == 's_admin')
                                <button type="button" data-collapse="lead_collapse_eligibility" data-callapse_active="client_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 eligibility_disabled">
                                    Ajouter un champ
                                </button>
                            @endif
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
    @if ($user_actions->where('module_name', 'collapse_work_site')->where('action_name', 'view')->first() || $user_actions->where('module_name', 'collapse_work_site')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-6">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="present-work-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
            @isset($project->project_name)
            verified
            @endisset"></span>
            Information logement
                <button data-tab="Client" data-block="Chantier de travail" data-tab-class="work_type__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-6" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('work_type__part') }} position-relative ml-auto mr-1 {{ session('work_type__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-6" class="collapse {{ session('work_type__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-6">
        <div class="card-body row">
            <div class="col custom-space">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Type_de_logement"> Type de logement<span class="text-danger">*</span></label> 
                            <select id="Type_de_logement" class="select2_select_option form-control w-100 work_site_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option {{ $project->Type_de_logement == 'Maison individuelle' ? 'selected':'' }} value="Maison individuelle" >Maison individuelle</option>
                                <option {{ $project->Type_de_logement == 'Appartement' ? 'selected':'' }} value="Appartement" >Appartement</option> 
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Type_de_chauffage"> Type de chauffage<span class="text-danger">*</span></label> 
                            <select id="Type_de_chauffage" class="select2_select_option form-control w-100 work_site_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                @if ($project->Type_de_logement)
                                    <option {{ $project->Type_de_chauffage == 'Combustible' ? 'selected':'' }} value="Combustible" >Combustible</option>
                                    <option {{ $project->Type_de_chauffage == 'Electrique' ? 'selected':'' }} value="Electrique" >Electrique</option> 
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Mode_de_chauffage"> Mode de chauffage <span class="text-danger">*</span></label>
                            <input type="hidden" id="Mode_de_chauffage__old" value="{{ $project->Mode_de_chauffage }}">
                            <select id="Mode_de_chauffage" data-autre-box="heating__type" data-input-type="select" data-select-type="single" class="select2_select_option form-control w-100 other_field__system work_site_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                @if ($project->Type_de_logement && $project->Type_de_chauffage)
                                    @if ($project->Type_de_chauffage == 'Combustible')
                                        <option {{ $project->Mode_de_chauffage == 'Fioul' ? 'selected':'' }} value="Fioul" >Fioul</option> 
                                        <option {{ $project->Mode_de_chauffage == 'Gaz' ? 'selected':'' }} value="Gaz" >Gaz</option> 
                                        <option {{ $project->Mode_de_chauffage == 'Charbon' ? 'selected':'' }} value="Charbon" >Charbon</option> 
                                        <option {{ $project->Mode_de_chauffage == 'Bois' ? 'selected':'' }} value="Bois" >Bois</option> 
                                        <option {{ $project->Mode_de_chauffage == 'GPL' ? 'selected':'' }} value="GPL" >GPL</option> 
                                        <option {{ $project->Mode_de_chauffage == 'Gaz condensation' ? 'selected':'' }} value="Gaz condensation" >Gaz condensation</option> 
                                        <option {{ $project->Mode_de_chauffage == 'Autre' ? 'selected':'' }} value="Autre" >Autre</option> 
                                    @endif
                                    @if ($project->Type_de_chauffage == 'Electrique')
                                        <option {{ $project->Mode_de_chauffage == 'Electrique' ? 'selected':'' }} value="Electrique" >Electrique</option>
                                        <option {{ $project->Mode_de_chauffage == 'Autre' ? 'selected':'' }} value="Autre" >Autre</option> 
                                    @endif
                                    {{-- @foreach ($heatings as $heating)
                                        <option {{ $project->Mode_de_chauffage == $heating->name ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
                                    @endforeach --}}
                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Mode_de_chauffage"> Mode de chauffage <span class="text-danger">*</span></label>

                            <select id="Mode_de_chauffage" data-autre-box="heating__type" data-input-type="select" data-select-type="single" class="select2_select_option form-control w-100 other_field__system work_site_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($heatings as $heating)
                                    <option {{ $project->Mode_de_chauffage == $heating->name ? 'selected':'' }} value="{{ $heating->name }}">{{ $heating->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-12 heating__type" style="display: {{ $project->Mode_de_chauffage == 'Autre' ? '':'none' }}">
                        <div class="form-group">
                            <label class="form-label" for="Mode_de_chauffage__a__">Merci de précisez</label>
                            <input type="text" name="Mode_de_chauffage__a__" id="Mode_de_chauffage__a__" class="form-control shadow-none work_site_disabled"
                            value="{{ $project->Mode_de_chauffage__a__ }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Date_construction_maison">Date construction maison </label>
                            <select name="Date_construction_maison" class="select2_select_option form-control w-100 work_site_disabled"  id="Date_construction_maison">
                                <option value="" selected>{{ __('Select') }}</option>
                                @for ($i = \Carbon\Carbon::now()->subYear()->format('Y'); $i >= 1000; $i--)
                                @if ($project->Date_construction_maison)
                                    @if ($i == $project->Date_construction_maison)
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
                            <label class="form-label" for="Surface_habitable"> Surface habitable <span class="text-danger">*</span></label>
                            <input type="hidden" id="hidden_Surface_habitable" value="{{ $project->Surface_habitable }}">
                            <input type="text" step="any" name="Surface_habitable" id="Surface_habitable" class="form-control shadow-none work_site_disabled"
                            value="{{ $project->Surface_habitable }} m2">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Surface_à_chauffer">Surface à chauffer <span class="text-danger">*</span></label>
                            <input type="hidden" id="hidden_Surface_à_chauffer" value="{{ $project->Surface_à_chauffer ?? '' }}">
                            <input type="text" step="any" name="Surface_à_chauffer" id="Surface_à_chauffer" class="form-control shadow-none work_site_disabled"
                            value="{{ $project->Surface_à_chauffer }} m2">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Consommation_chauffage_annuel"> Consommation chauffage annuel (€)</label>
                            <input type="hidden" id="hidden_Consommation_chauffage_annuel" value="{{ $project->Consommation_chauffage_annuel ?? '' }}">
                            <input type="text" name="Consommation_chauffage_annuel" id="Consommation_chauffage_annuel" class="form-control shadow-none work_site_disabled"
                            value="{{ $project->Consommation_chauffage_annuel }} €/an">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Consommation_Chauffage_Annuel_2">Consommation Chauffage Annuel (litres,kWh,m3)</label>
                            <input type="text" name="Consommation_Chauffage_Annuel_2" id="Consommation_Chauffage_Annuel_2" class="form-control shadow-none work_site_disabled"
                            value="{{ $project->Consommation_Chauffage_Annuel_2 }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Depuis_quand_occupez_vous_le_logement">Depuis quand occupez vous le logement </label>
                            <select  name="Depuis_quand_occupez_vous_le_logement" id="Depuis_quand_occupez_vous_le_logement" class="select2_select_option form-control w-100 work_site_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option {{ $project->Depuis_quand_occupez_vous_le_logement == '0-5 ans' ? 'selected':'' }} value="0-5 ans">0-5 ans</option>
                                <option {{ $project->Depuis_quand_occupez_vous_le_logement == '5-10 ans' ? 'selected':'' }} value="5-10 ans">5-10 ans</option>
                                <option {{ $project->Depuis_quand_occupez_vous_le_logement == '10-20 ans' ? 'selected':'' }} value="10-20 ans">10-20 ans</option>
                                <option {{ $project->Depuis_quand_occupez_vous_le_logement == '+ 20 ans' ? 'selected':'' }} value="+ 20 ans">+ 20 ans</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Type_du_courant_du_logement">Type de compteur du logement <span class="text-danger">*</span></label>
                            <select  name="Type_du_courant_du_logement" id="Type_du_courant_du_logement" class="select2_select_option form-control w-100 work_site_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option {{ $project->Type_du_courant_du_logement == 'Monophasé' ? 'selected':'' }} value="Monophasé">Monophasé</option>
                                <option {{ $project->Type_du_courant_du_logement == 'Triphasé' ? 'selected':'' }} value="Triphasé">Triphasé</option>
                                <option {{ $project->Type_du_courant_du_logement == 'A definir' ? 'selected':'' }} value="A definir">A definir</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 mr-2">Le logement possède t - il un chauffage d’appoint ?  <span class="text-danger">*</span></h4>
                        <select id="auxiliary_heating_statusInput" data-autre-box="auxiliary_heating_status_wrap" class="other_field__system2 custom-select shadow-none work_site_disabled w-auto">
                            <option value="" selected>{{ __('Select') }}</option>
                            <option {{ $project->auxiliary_heating_status == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                            <option {{ $project->auxiliary_heating_status == 'Non' ? 'selected':'' }} value="Non">Non</option>
                        </select>
                    </div>

                    <div class="col-12 mt-3 auxiliary_heating_status_wrap" style="display:{{ ($project->auxiliary_heating_status == 'Oui') ? '':'none' }}" id="auxiliary_heating_status">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Insert à bois" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating1"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Insert à bois'))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Insert_à_bois" >
                                                <label class="custom-control-label" for="auxiliary_heating1">Insert à bois</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Insert_à_bois" style="display: {{ $project && getFeature($project->auxiliary_heating, 'Insert à bois') ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Insert_à_bois_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Insert_à_bois_Nombre" id="auxiliary_heating__Insert_à_bois_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Insert_à_bois_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Poêle à bois" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating2"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Poêle à bois'))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Poêle_à_bois" >
                                                <label class="custom-control-label" for="auxiliary_heating2">Poêle à bois</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Poêle_à_bois" style="display: {{ $project && getFeature($project->auxiliary_heating, 'Poêle à bois') ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Poêle_à_bois_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Poêle_à_bois_Nombre" id="auxiliary_heating__Poêle_à_bois_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Poêle_à_bois_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Poêle à gaz" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating3"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Poêle à gaz'))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Poêle_à_gaz" >
                                                <label class="custom-control-label" for="auxiliary_heating3">Poêle à gaz</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Poêle_à_gaz" style="display: {{ $project && getFeature($project->auxiliary_heating, 'Poêle à gaz') ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Poêle_à_gaz_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Poêle_à_gaz_Nombre" id="auxiliary_heating__Poêle_à_gaz_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Poêle_à_gaz_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Convecteur électrique" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating4"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Convecteur électrique'))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Convecteur_électrique" >
                                                <label class="custom-control-label" for="auxiliary_heating4">Convecteur électrique</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Convecteur_électrique" style="display: {{ $project && getFeature($project->auxiliary_heating, 'Convecteur électrique') ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Convecteur_électrique_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Convecteur_électrique_Nombre" id="auxiliary_heating__Convecteur_électrique_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Convecteur_électrique_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Sèche-serviette" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating5"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Sèche-serviette'))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Sèche_serviette" >
                                                <label class="custom-control-label" for="auxiliary_heating5">Sèche-serviette</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Sèche_serviette" style="display: {{ $project && getFeature($project->auxiliary_heating, 'Sèche-serviette') ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Sèche_serviette_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Sèche_serviette_Nombre" id="auxiliary_heating__Sèche_serviette_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Sèche_serviette_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Panneau rayonnant" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating6"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Panneau rayonnant'))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Panneau_rayonnant" >
                                                <label class="custom-control-label" for="auxiliary_heating6">Panneau rayonnant</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Panneau_rayonnant" style="display: {{ $project && getFeature($project->auxiliary_heating, 'Panneau rayonnant') ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Panneau_rayonnant_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Panneau_rayonnant_Nombre" id="auxiliary_heating__Panneau_rayonnant_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Panneau_rayonnant_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Radiateur bain d'huile" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating7"
                                                @if ($project && getFeature($project->auxiliary_heating, "Radiateur bain d'huile"))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Radiateur_bain_dhuile" >
                                                <label class="custom-control-label" for="auxiliary_heating7">Radiateur bain d'huile</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Radiateur_bain_dhuile" style="display: {{ $project && getFeature($project->auxiliary_heating, "Radiateur bain d'huile") ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Radiateur_bain_dhuile_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Radiateur_bain_dhuile_Nombre" id="auxiliary_heating__Radiateur_bain_dhuile_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Radiateur_bain_dhuile_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Radiateur soufflant électrique" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating8"
                                                @if ($project && getFeature($project->auxiliary_heating, "Radiateur soufflant électrique"))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Radiateur_soufflan_électrique" >
                                                <label class="custom-control-label" for="auxiliary_heating8">Radiateur soufflant électrique</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Radiateur_soufflan_électrique" style="display: {{ $project && getFeature($project->auxiliary_heating, "Radiateur soufflant électrique") ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Radiateur_soufflan_électrique_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Radiateur_soufflan_électrique_Nombre" id="auxiliary_heating__Radiateur_soufflan_électrique_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Radiateur_soufflan_électrique_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-checkbox ml-1">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Autre" class="custom-control-input work_site_disabled other_field__system" id="auxiliary_heating9"
                                                @if ($project && getFeature($project->auxiliary_heating, "Autre"))
                                                checked
                                                @endif data-autre-box="auxiliary_heating__Autre" >
                                                <label class="custom-control-label" for="auxiliary_heating9">Autre</label>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8 auxiliary_heating__Autre" style="display: {{ $project && getFeature($project->auxiliary_heating, "Autre") ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="auxiliary_heating__Autre_Nombre">Nombre:</label>
                                            <input type="text" name="auxiliary_heating__Autre_Nombre" id="auxiliary_heating__Autre_Nombre" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->auxiliary_heating__Autre_Nombre }}">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Insert à bois" class="custom-control-input work_site_disabled" id="auxiliary_heating1"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Insert à bois'))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating1">Insert à bois</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Poêle à bois" class="custom-control-input work_site_disabled" id="auxiliary_heating2"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Poêle à bois'))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating2">Poêle à bois</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Poêle à gaz" class="custom-control-input work_site_disabled" id="auxiliary_heating3"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Poêle à gaz'))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating3">Poêle à gaz</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Convecteur électrique" class="custom-control-input work_site_disabled" id="auxiliary_heating4"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Convecteur électrique'))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating4">Convecteur électrique</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Sèche-serviette" class="custom-control-input work_site_disabled" id="auxiliary_heating5"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Sèche-serviette'))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating5">Sèche-serviette</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Panneau rayonnant" class="custom-control-input work_site_disabled" id="auxiliary_heating6"
                                                @if ($project && getFeature($project->auxiliary_heating, 'Panneau rayonnant'))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating6">Panneau rayonnant</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Radiateur bain d'huile" class="custom-control-input work_site_disabled" id="auxiliary_heating7"
                                                @if ($project && getFeature($project->auxiliary_heating, "Radiateur bain d'huile"))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating7">Radiateur bain d'huile</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="auxiliary_heating[]" value="Radiateur soufflant électrique" class="custom-control-input work_site_disabled" id="auxiliary_heating8"
                                                @if ($project && getFeature($project->auxiliary_heating, "Radiateur soufflant électrique"))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating8">Radiateur soufflant électrique</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" data-autre-box="specify__heating" name="auxiliary_heating[]" value="Autre" class="custom-control-input other_field__system work_site_disabled" id="auxiliary_heating9"
                                                @if ($project && getFeature($project->auxiliary_heating, "Autre"))
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="auxiliary_heating9">Autre</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-12 auxiliary_heating__Autre" style="display: {{ ($project && getFeature($project->auxiliary_heating, "Autre")) ? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label" for="auxiliary_heating__a__"> Merci de préciser </label>
                                    <input type="text" name="auxiliary_heating__a__" id="auxiliary_heating__a__" class="form-control shadow-none work_site_disabled"
                                    value="{{ $project->auxiliary_heating__a__ }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 mr-2"> La maison possède-t-elle un second générateur de chauffage : <span class="text-danger">*</span></h4>
                        {{-- <label class="switch-checkbox">
                            <input type="checkbox" class="switch-checkbox__input work_site_disabled" id="second_heating_generator_statusInput"
                            {{ $project->second_heating_generator_status == 'yes' ? 'checked':'' }}>
                            <span class="switch-checkbox__label"></span>
                        </label> --}}
                        <select id="second_heating_generator_statusInput" data-autre-box="second_heating_generator_status_wrap" class="other_field__system2 custom-select shadow-none work_site_disabled w-auto">
                            <option value="" selected>{{ __('Select') }}</option>
                            <option {{ $project->second_heating_generator_status == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                            <option {{ $project->second_heating_generator_status == 'Non' ? 'selected':'' }} value="Non">Non</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3 second_heating_generator_status_wrap" style="display:{{ ($project->second_heating_generator_status == 'Oui') ? '':'none' }}" id="heatingGenerator">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="second_heating_generator[]" value="Chaudière fioul" class="custom-control-input work_site_disabled" id="second_heating_generator"

                                        @if (getFeature($project->second_heating_generator, 'Chaudière fioul'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="second_heating_generator">Chaudière fioul</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="second_heating_generator[]" value="Chaudière bois" class="custom-control-input work_site_disabled" id="second_heating_generator2"

                                        @if (getFeature($project->second_heating_generator, 'Chaudière bois'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="second_heating_generator2"> Chaudière bois</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="second_heating_generator[]" value="Chaudière gaz" class="custom-control-input work_site_disabled" id="second_heating_generator3"

                                        @if (getFeature($project->second_heating_generator, 'Chaudière gaz'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="second_heating_generator3">Chaudière gaz</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="second_heating_generator[]" value="Chaudière mazoute" class="custom-control-input work_site_disabled" id="second_heating_generator4"

                                        @if (getFeature($project->second_heating_generator, 'Chaudière mazoute'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="second_heating_generator4">Chaudière mazoute</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="second_heating_generator[]" value="Pompe à chaleur" class="custom-control-input work_site_disabled" id="second_heating_generatord4"

                                        @if (getFeature($project->second_heating_generator, 'Pompe à chaleur'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="second_heating_generatord4">Pompe à chaleur</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="second_heating_generator[]" data-autre-box="second_heating__type" value="Autre" class="custom-control-input other_field__system work_site_disabled" id="second_heating_generator5"

                                        @if (getFeature($project->second_heating_generator, 'Autre'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="second_heating_generator5"> {{ __('Autre') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 second_heating__type" style="display: {{ (getFeature($project->second_heating_generator, 'Autre')) ? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label" for="second_heating_generator__a__">Merci de préciser</label>
                                    <input type="text" name="second_heating_generator__a__" id="second_heating_generator__a__" class="form-control shadow-none work_site_disabled"
                                    value="{{ $project->second_heating_generator__a__ }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 mr-2"> Le logement possède un réseau hydraulique ? <span class="text-danger">*</span></h4>
                        <select data-autre-box="Le_logement_possède_un_réseau_hydraulique_wrap" id="Le_logement_possède_un_réseau_hydraulique" class="other_field__system2 custom-select shadow-none work_site_disabled w-auto">
                            <option value="" selected>{{ __('Select') }}</option>
                            <option {{ $project->Le_logement_possède_un_réseau_hydraulique == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                            <option {{ $project->Le_logement_possède_un_réseau_hydraulique == 'Non' ? 'selected':'' }} value="Non">Non</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3 Le_logement_possède_un_réseau_hydraulique_wrap" style="display:{{ ($project->Le_logement_possède_un_réseau_hydraulique == 'Oui') ? '':'none' }}">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    Quels sont les différents émetteurs hydraulique de chaleur du logement  <span class="text-danger">*</span>
                                </h4>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement[]" value="Radiateurs" data-autre-box="transmitter__type__Radiateurs"  class="custom-control-input other_field__system work_site_disabled" id="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement2"

                                        @if (getFeature($project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement, 'Radiateurs'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement2">Radiateurs</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement[]" value="Plancher Chauffant" class="custom-control-input work_site_disabled" id="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement"

                                        @if (getFeature($project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement,'Plancher Chauffant'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement">Plancher Chauffant</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement[]" value="Ventilo-Convecteur" class="custom-control-input work_site_disabled" id="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement3"

                                        @if (getFeature($project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement, 'Ventilo-Convecteur'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement3">Ventilo-Convecteur</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" data-autre-box="transmitter__type" name="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement[]" value="Autre" class="custom-control-input other_field__system work_site_disabled" id="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement4"
                                        @if (getFeature($project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement, 'Autre'))
                                        checked
                                        @endif >
                                        <label class="custom-control-label" for="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement4">Autre</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 transmitter__type" style="display: {{ (getFeature($project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement, 'Autre')) ? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label" for="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__">Merci de préciser</label>
                                    <input type="text" name="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__" id="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__" class="form-control shadow-none work_site_disabled"
                                    value="{{ $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__ }}">
                                </div>
                            </div>
                        </div>
                        <div class="row transmitter__type__Radiateurs" style="display: {{ getFeature($project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement, 'Radiateurs') ? '':'none' }}">
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
                                                <input type="checkbox" {{ $project->Préciser_le_type_de_radiateurs_Aluminium == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Aluminium" value="yes" class="custom-control-input other_field__system" id="Préciser_le_type_de_radiateurs_Aluminium">
                                                <label class="custom-control-label" for="Préciser_le_type_de_radiateurs_Aluminium">Aluminium</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 radiatuers__Aluminium" style="display: {{ $project->Préciser_le_type_de_radiateurs_Aluminium == 'yes' ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs">Nombre de radiateurs:</label>
                                            <input type="text" name="Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs" id="Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-switch ml-1">
                                                <input type="checkbox" {{ $project->Préciser_le_type_de_radiateurs_Fonte == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Fonte" value="yes" class="custom-control-input other_field__system" id="Préciser_le_type_de_radiateurs_Fonte">
                                                <label class="custom-control-label" for="Préciser_le_type_de_radiateurs_Fonte">Fonte</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 radiatuers__Fonte" style="display: {{ $project->Préciser_le_type_de_radiateurs_Fonte == 'yes' ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label  mb-0 no-wrap mr-2" for="Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs">Nombre de radiateurs:</label>
                                            <input type="text" name="Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs" id="Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-switch ml-1">
                                                <input type="checkbox" {{ $project->Préciser_le_type_de_radiateurs_Acier == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Acier" value="yes" class="custom-control-input other_field__system" id="Préciser_le_type_de_radiateurs_Acier">
                                                <label class="custom-control-label" for="Préciser_le_type_de_radiateurs_Acier">Acier</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 radiatuers__Acier" style="display: {{ $project->Préciser_le_type_de_radiateurs_Acier == 'yes' ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs">Nombre de radiateurs:</label>
                                            <input type="text" name="Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs" id="Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group d-flex">
                                            <div class="custom-control custom-switch ml-1">
                                                <input type="checkbox" {{ $project->Préciser_le_type_de_radiateurs_Autre == 'yes' ? 'checked':'' }} name="active" data-autre-box="radiatuers__Autre" value="yes" class="custom-control-input other_field__system" id="Préciser_le_type_de_radiateurs_Autre">
                                                <label class="custom-control-label" for="Préciser_le_type_de_radiateurs_Autre">Autre</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 radiatuers__Autre" style="display: {{ $project->Préciser_le_type_de_radiateurs_Autre == 'yes' ? '':'none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <label class="form-label mb-0 no-wrap mr-2" for="Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs">Nombre de radiateurs:</label>
                                            <input type="text" name="Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs" id="Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs" class="form-control shadow-none work_site_disabled"
                                            value="{{ $project->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 radiatuers__Autre" style="display: {{ $project->Préciser_le_type_de_radiateurs_Autre == 'yes' ? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label" for="Préciser_le_type_de_radiateurs_Autre___a__">Merci de préciser</label>
                                    <input type="text" name="Préciser_le_type_de_radiateurs_Autre___a__" id="Préciser_le_type_de_radiateurs_Autre___a__" class="form-control shadow-none work_site_disabled"
                                    value="{{ $project->Préciser_le_type_de_radiateurs_Autre___a__ }}">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for=""> Production d’eau chaude sanitaire <span class="text-danger">*</span></label>
                            <select name="" id="Production_dapostropheeau_chaude_sanitaire" class="custom-select shadow-none form-control work_site_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option @if($project->Production_dapostropheeau_chaude_sanitaire== 'Instantanné' ) selected @endif value="Instantanné">{{ __('Instantanné') }}</option>
                                <option @if($project->Production_dapostropheeau_chaude_sanitaire== 'Accumulation' ) selected @endif value="Accumulation">{{ __('Accumulation') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12" id="instant" style="display: {{ $project->Production_dapostropheeau_chaude_sanitaire== 'Instantanné' ? '':'none'}}">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    {{ __('Instantanné') }}
                                </h4>
                            </div>
                            <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Instantanné[]" value="Générateur de chauffage" class="custom-control-input work_site_disabled" id="Instantanné"

                                    @if (getFeature($project->Instantanné, 'Générateur de chauffage'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Instantanné">Générateur de chauffage</label>
                                </div>
                            </div>
                            </div>

                            <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Instantanné[]" value="Autre" data-autre-box="Instantanné_Merci_de_préciser__autre" class="custom-control-input work_site_disabled other_field__system" id="Instantanné3"

                                    @if (getFeature($project->Instantanné, 'Autre'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Instantanné3">Autre</label>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 Instantanné_Merci_de_préciser__autre" style="display: {{ getFeature($project->Instantanné, 'Autre') ? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label" for="Instantanné_Merci_de_préciser"> Merci de préciser </label>
                                    <input type="text" name="Instantanné_Merci_de_préciser" id="Instantanné_Merci_de_préciser" class="form-control shadow-none work_site_disabled"
                                    value="{{ $project->Instantanné_Merci_de_préciser }}">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Instantanné[]" value="Chauffe-eau gaz" class="custom-control-input work_site_disabled" id="Instantanné2"

                                    @if (getFeature($project->Instantanné, 'Chauffe-eau gaz'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Instantanné2">Chauffe-eau gaz</label>
                                </div>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Instantanné[]" value="Chauffe-eau électrique" class="custom-control-input work_site_disabled" id="Instantanné3"

                                    @if (getFeature($project->Instantanné, 'Chauffe-eau électrique'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Instantanné3">Chauffe-eau électrique</label>
                                </div>
                            </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-12" id="accumulation" style="display: {{ $project->Production_dapostropheeau_chaude_sanitaire== 'Accumulation' ? '':'none'}}">
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    {{ __('Accumulation') }}
                                </h4>
                            </div>
                            {{-- <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Accumulation[]" value="Générateur de chauffage" class="custom-control-input work_site_disabled" id="Accumulation4"

                                    @if (getFeature($project->Accumulation, 'Générateur de chauffage'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Accumulation4">Générateur de chauffage</label>
                                </div>
                            </div>
                            </div> --}}
                            <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Accumulation[]" value="Chauffe-eau gaz" class="custom-control-input work_site_disabled" id="Accumulation5"

                                    @if (getFeature($project->Accumulation, 'Chauffe-eau gaz'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Accumulation5">Chauffe-eau gaz</label>
                                </div>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Accumulation[]" value="Chauffe-eau électrique" class="custom-control-input work_site_disabled" id="Accumulation6"

                                    @if (getFeature($project->Accumulation, 'Chauffe-eau électrique'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Accumulation6">Chauffe-eau électrique</label>
                                </div>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Accumulation[]" value="Chauffe-eau thermodynamique" class="custom-control-input work_site_disabled" id="Accumulation7"

                                    @if (getFeature($project->Accumulation, 'Chauffe-eau thermodynamique'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Accumulation7">Chauffe-eau thermodynamique</label>
                                </div>
                            </div>
                            </div>
                            <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Accumulation[]" value="Autre" data-autre-box="Accumulation_Merci_de_préciser__autre" class="custom-control-input work_site_disabled other_field__system" id="Accumulation9"

                                    @if (getFeature($project->Accumulation, 'Autre'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Accumulation9">Autre</label>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12 Accumulation_Merci_de_préciser__autre" style="display: {{ getFeature($project->Accumulation, 'Autre') ? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label" for="Accumulation_Merci_de_préciser"> Merci de préciser </label>
                                    <input type="text" name="Accumulation_Merci_de_préciser" id="Accumulation_Merci_de_préciser" class="form-control shadow-none work_site_disabled"
                                    value="{{ $project->Accumulation_Merci_de_préciser }}">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="Accumulation[]" value="Chauffe-eau electrosolaire" class="custom-control-input work_site_disabled" id="Accumulation8"

                                    @if (getFeature($project->Accumulation, 'Chauffe-eau electrosolaire'))
                                    checked
                                    @endif >
                                    <label class="custom-control-label" for="Accumulation8">Chauffe-eau electrosolaire</label>
                                </div>
                            </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 mr-2">Le logement possède t- il un ballon d’eau chaude ?</h4>
                        <select id="Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude" data-autre-box="Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude_wrap" class="other_field__system2 custom-select shadow-none work_site_disabled w-auto">
                            <option value="" selected>{{ __('Select') }}</option>
                            <option {{ $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                            <option {{ $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude == 'Non' ? 'selected':'' }} value="Non">Non</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3 Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude_wrap" style="display: {{ ($project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude == 'Oui') ? '':'none' }}">
                        <div class="form-group">
                            <label class="form-label" for="Précisez_le_volume_du_ballon_dapostropheeau_chaude"> Précisez le volume du ballon d’eau chaude :</label>
                            <input type="number" step="any" name="Précisez_le_volume_du_ballon_dapostropheeau_chaude" id="Précisez_le_volume_du_ballon_dapostropheeau_chaude" class="form-control shadow-none work_site_disabled" placeholder="Merci de préciser le litrage du ballon"
                            value="{{ $project->Précisez_le_volume_du_ballon_dapostropheeau_chaude }}">
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label class="form-label" for="Information_logement_observations"> Observations </label>
                            <textarea name="Information_logement_observations" id="Information_logement_observations" class="form-control shadow-none work_site_disabled">{{ $project->Information_logement_observations }}</textarea>
                        </div>
                    </div>
                    @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'lead_collapse_information_logement'), 'custom_field_data' => $project->information_logement_custom_field_data, 'class' => 'information_logement__custom_field', 'disabled_class' => 'work_site_disabled'])
                    @if ($user_actions->where('module_name', 'collapse_work_site')->where('action_name', 'edit')->first() || $role == 's_admin')
                        <div class="col-12 text-center ">
                            <button id="presentWorkValidate"
                            type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 work_site_disabled">
                                {{ __('Submit') }}
                            </button>
                            @if ($role == 's_admin')
                                <button type="button" data-collapse="lead_collapse_information_logement" data-callapse_active="client_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 work_site_disabled">
                                    Ajouter un champ
                                </button>
                            @endif
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
    @if ($user_actions->where('module_name', 'collapse_situation_foyer')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_situation_foyer')->where('action_name', 'edit')->first() || $role == 's_admin')
        <div class="card lead__card border-0">
            <div class="card-header bg-transparent border-0 p-0" id="leadCard-7">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                <span id="situation_foyer" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
                @isset($project->annual_heating)
                verified
                @endisset"></span>
                {{ __('Situation foyer') }}
                {{-- <div role="button" class="edit-toggler foyer_edit_toggler active position-relative ml-auto mr-1">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </div> --}}
                {{-- <span class="d-block  ml-auto">
                    <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                </span> --}}
                    <button data-tab="Client" data-block="Situation foyer" data-tab-class="situation_foyer__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-7" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('situation_foyer__part') }} position-relative ml-auto mr-1 {{ session('situation_foyer__part') == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
                </div>
            </h2>
            </div>
            <div id="leadCardCollapse-7" class="collapse {{ session('situation_foyer__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-7">
            <div class="card-body row">
                <div class="col custom-space">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="Situation_familiale"> Situation familiale </label>
                                <select name="Situation_familiale"  id="Situation_familiale" data-input-type="select" data-autre-box="family__situation" data-select-type="single" class="form-control other_field__system shadow-none foyer_disabled">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option @if ($project->Situation_familiale == 'Marié')
                                        selected
                                    @endif value="Marié">Marié</option>
                                    <option @if ($project->Situation_familiale == 'Pacsé')
                                        selected
                                    @endif value="Pacsé">Pacsé</option>
                                    <option @if ($project->Situation_familiale == 'Concubinage')
                                        selected
                                    @endif value="Concubinage">Concubinage</option>
                                    <option @if ($project->Situation_familiale == 'Divorcé')
                                        selected
                                    @endif value="Divorcé">Divorcé</option>
                                    <option @if ($project->Situation_familiale == 'Séparé')
                                        selected
                                    @endif value="Séparé">Séparé</option>
                                    <option @if ($project->Situation_familiale == 'Célibataire')
                                        selected
                                    @endif value="Célibataire">Célibataire</option>
                                    <option @if ($project->Situation_familiale == 'Veuf')
                                        selected
                                    @endif value="Veuf">Veuf</option>
                                    <option @if ($project->Situation_familiale == 'Autre')
                                        selected
                                    @endif value="Autre">Autre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 family__situation" style="display: {{ $project->Situation_familiale == 'Autre' ? '':'none' }}">
                            <div class="form-group">
                                <label class="form-label" for="Situation_familiale___a__"> Merci de préciser </label>
                                <input type="text" name="Situation_familiale___a__" id="Situation_familiale___a__" class="form-control shadow-none work_site_disabled"
                                value="{{ $project->Situation_familiale___a__ }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 mr-2">Y a t il des enfants dans le foyer fiscale ? <span class="text-danger">*</span></h4>
                                <select id="Y_a_t_il_des_enfants_dans_le_foyer_fiscale" data-autre-box="Y_a_t_il_des_enfants_dans_le_foyer_fiscale_wrap" class="other_field__system2 custom-select shadow-none work_site_disabled w-auto">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                    <option {{ $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 Y_a_t_il_des_enfants_dans_le_foyer_fiscale_wrap" style="display: {{ $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale == 'Oui' ? '':'none' }}">
                            <div class="row">
                                <div class="col-12">
                                    <h4><b>{{ __('Enfants à charge') }}</b></h4>
                                </div>
                                <div class="col-12" id="dependent_children">
                                    @include('includes.crm.children')
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <div class="form-group">
                                <label class="form-label" for="Personne_1">Personne 1:</label>
                                {{-- <span>{{ $primary_tax && $primary_tax->first_name?? '' }} {{ $primary_tax && $primary_tax->last_name ?? '' }}</span> --}}
                                <select name="Personne_1" id="Personne_1"  class="select2_select_option custom-select shadow-none form-control foyer_disabled">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->Personne_1 == 'Monsieur'? 'selected':'' }} value="Monsieur">Monsieur</option>
                                    <option {{ $project->Personne_1 == 'Madame'? 'selected':'' }} value="Madame">Madame</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12" id="Personne_1_wrap" style="display:{{ $project->Personne_1? '':'none' }}">
                            <div class="row">
                                <div id="mr_status" class="col-12 mb-4">
                                    <div class="row ">
                                        <div class="col-12">
                                        <h4><b>Quel est le contrat de travail de <span class="personne_1_title">{{ $project->Personne_1 }}</span></b></h4>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat à durée déterminée (CDD)" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_1"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Contrat à durée déterminée (CDD)')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_1">Contrat à durée déterminée (CDD)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat à durée indéterminée (CDI)" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_12"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Contrat à durée indéterminée (CDI)')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_12">Contrat à durée indéterminée (CDI)</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de travail temporaire" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_13"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Contrat de travail temporaire')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_13">Contrat de travail temporaire</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de travail intermittent" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_14"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Contrat de travail intermittent')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_14">Contrat de travail intermittent</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat d'apprentissage" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_15"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == "Contrat d'apprentissage")
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_15">Contrat d'apprentissage</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de professionnalisation" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_16"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Contrat de professionnalisation')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_16">Contrat de professionnalisation</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat unique d'insertion" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_17"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == "Contrat unique d'insertion")
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_17">Contrat unique d'insertion</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrats conclus avec un groupement d'employeurs" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_18"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == "Contrats conclus avec un groupement d'employeurs")
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_18">Contrats conclus avec un groupement d'employeurs</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Contrat de travail en portage salarial à durée déterminée ou indéterminée" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_19"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Contrat de travail en portage salarial à durée déterminée ou indéterminée')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_19">Contrat de travail en portage salarial à durée déterminée ou indéterminée</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Retraite" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_110"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Retraite')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_110">Retraite</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_1" data-autre-box="mr__activity" data-input-type="radio_checkbox" value="Autre" class="custom-control-input other_field__system radio_checkbox__mr_activity  foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_111"

                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Autre')
                                                checked
                                                @endif >
                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_111">Autre</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mr__activity" style="display: {{ $project->Quel_est_le_contrat_de_travail_de_Personne_1 == 'Autre' ? '':'none' }}">
                                    <div class="form-group">
                                        <label class="form-label" for="Quel_est_le_contrat_de_travail_de_Personne_1__a__">Merci de précisez</label>
                                        <input type="text" name="Quel_est_le_contrat_de_travail_de_Personne_1__a__" id="Quel_est_le_contrat_de_travail_de_Personne_1__a__" class="form-control shadow-none foyer_disabled" value="{{ $project->Quel_est_le_contrat_de_travail_de_Personne_1__a__ }}" >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="Revenue_Personne_1"> Revenue <span class="personne_1_title">{{ $project->Personne_1 }}</span></label>
                                        <input type="number" step="any" name="Revenue_Personne_1" id="Revenue_Personne_1" class="form-control shadow-none foyer_disabled"
                                        value="{{ $project->Revenue_Personne_1 }}"
                                        >
                                    </div>
                                </div>
                                <div class="col-12 d-flex align-items-center">
                                    <h4 class="mb-0 mr-2">Existe-t-il un conjoint ? :</h4>
                                    <label class="switch-checkbox">
                                        <input type="checkbox" id="Existehyphenthyphenil_un_conjoint" data-autre-box="personne__1_partner" class="switch-checkbox__input other_field__system work_site_disabled"
                                        {{ ($project->Existehyphenthyphenil_un_conjoint == 'yes') ? 'checked':'' }} >
                                        <span class="switch-checkbox__label"></span>
                                    </label>
                                </div>
                                <div class="col-12 personne__1_partner" style="display: {{ ($project->Existehyphenthyphenil_un_conjoint == 'yes') ? '':'none' }}">
                                    <div class="row">
                                        <div class="col-12 mt-4">
                                            <div class="form-group">
                                                <label class="form-label" for="Personne_2">Personne 2:</label>
                                                <select name="Personne_2" id="Personne_2"  class="select2_select_option custom-select shadow-none form-control foyer_disabled">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option {{ $project->Personne_2 == 'Monsieur'? 'selected':'' }} value="Monsieur">Monsieur</option>
                                                    <option {{ $project->Personne_2 == 'Madame'? 'selected':'' }} value="Madame">Madame</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12" id="Personne_2_wrap" style="display: {{ $project->Personne_2 ? '':'none' }}">
                                            <div class="row">
                                                <div id="mrs_status" class="col-12  mb-4">
                                                    <div class="row ">
                                                        <div class="col-12">
                                                        <h4><b>Quel est le contrat de travail de <span class="personne_2_title">{{ $project->Personne_2 }}</span></b> </h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat à durée déterminée (CDD)" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_2"

                                                                @if ($project->Quel_est_le_contrat_de_travail_de_Personne_2 == 'Contrat à durée déterminée (CDD)')
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_2">Contrat à durée déterminée (CDD) </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat à durée indéterminée (CDI)" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_22"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == 'Contrat à durée indéterminée (CDI)')
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_22">Contrat à durée indéterminée (CDI)</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat de travail temporaire" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_23"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Contrat de travail temporaire")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_23">Contrat de travail temporaire</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrat de travail intermittent" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_24"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Contrat de travail intermittent")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_24">Contrat de travail intermittent</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat d'apprentissage" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_25"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Contrat d'apprentissage")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_25">Contrat d'apprentissage</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrat de professionnalisation" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_26"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Contrat de professionnalisation")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_26">Contrat de professionnalisation</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity"  value="Contrat unique d'insertion" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_27"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Contrat unique d'insertion")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_27">Contrat unique d'insertion</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrats conclus avec un groupement d'employeurs" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_28"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Contrats conclus avec un groupement d'employeurs")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_28">Contrats conclus avec un groupement d'employeurs</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Contrat de travail en portage salarial à durée déterminée ou indéterminée" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_29"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Contrat de travail en portage salarial à durée déterminée ou indéterminée")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_29">Contrat de travail en portage salarial à durée déterminée ou indéterminée</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-input-type="radio_checkbox" data-autre-box="mrs__activity" value="Retraite" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_210"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Retraite")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_210">Retraite</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="Quel_est_le_contrat_de_travail_de_Personne_2" data-autre-box="mrs__activity" data-input-type="radio_checkbox" value="Autre" class="custom-control-input other_field__system radio_checkbox__mrs_activity foyer_disabled" id="Quel_est_le_contrat_de_travail_de_Personne_211"

                                                                @if ( $project->Quel_est_le_contrat_de_travail_de_Personne_2 == "Autre")
                                                                checked
                                                                @endif >
                                                                <label class="custom-control-label" for="Quel_est_le_contrat_de_travail_de_Personne_211">Autre</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mrs__activity" style="display: {{ $project->mrs_activity == 'Autre' ? '':'none' }}">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Quel_est_le_contrat_de_travail_de_Personne_2__a__">Merci de précisez</label>
                                                        <input type="text" name="Quel_est_le_contrat_de_travail_de_Personne_2__a__" id="Quel_est_le_contrat_de_travail_de_Personne_2__a__" class="form-control shadow-none foyer_disabled" value="{{ $project->Quel_est_le_contrat_de_travail_de_Personne_2__a__ }}" >
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Revenue_Personne_2">Revenue <span class="personne_2_title">{{ $project->Personne_2 }}</span></label>
                                                        <input type="number" name="Revenue_Personne_2" id="Revenue_Personne_2" class="form-control shadow-none foyer_disabled"
                                                        value="{{ $project->Revenue_Personne_2 }}"
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="Crédit_du_foyer_mensuel"> Crédit du foyer mensuel</label>
                                        <input type="number" name="Crédit_du_foyer_mensuel" id="Crédit_du_foyer_mensuel" class="form-control shadow-none foyer_disabled"
                                        value="{{ $project->Crédit_du_foyer_mensuel }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="Commentaires_revenue_et_crédit_du_foyer">Commentaires revenue et crédit du foyer</label>
                                        <textarea rows="8" name="Commentaires_revenue_et_crédit_du_foyer" id="Commentaires_revenue_et_crédit_du_foyer" class="form-control shadow-none foyer_disabled"> {{ $project->Commentaires_revenue_et_crédit_du_foyer }} </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'lead_collapse_situation_foyer'), 'custom_field_data' => $project->situation_foyer_custom_field_data, 'class' => 'situation_foyer__custom_field', 'disabled_class' => 'foyer_disabled'])
                        @if ($user_actions->where('module_name', 'collapse_situation_foyer')->where('action_name', 'edit')->first() || $role == 's_admin')
                            <div class="col-12 text-center">
                                <button id="situation_foyer_btn"
                                type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 foyer_disabled">
                                    {{ __('Submit') }}
                                </button>
                                @if ($role == 's_admin')
                                    <button type="button" data-collapse="lead_collapse_situation_foyer" data-callapse_active="client_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 foyer_disabled">
                                        Ajouter un champ
                                    </button>
                                @endif
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