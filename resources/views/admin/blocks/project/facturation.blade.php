@php  
    $banques = \App\Models\CRM\Banque::all(); 
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();
    $amos = \App\Models\CRM\Amo::all(); 
    $agents = \App\Models\CRM\Agent::where('active', 'Oui')->get();
    $entreprise_de_travauxs = \App\Models\CRM\Installer::all();
    $delegates = \App\Models\CRM\Delegate::all();
    $technical_commercials = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get();
    $charge_etudes = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get();
    $installers = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get();
    $team_laeders = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
    $suppliers = \App\Models\CRM\Fournisseur::where('active', 'Oui')->get();
    $products = \App\Models\CRM\Product::latest()->get();
    
@endphp
<div class="accordion" id="leadAccordion91">
    @if ($user_actions->where('module_name', 'collapse_suivi_facturation')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_suivi_facturation')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-91">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                    <span id="subvention_information-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
                    Suivi Facturation
                            <a href="javascript:void(0)" id="createFacturationButton" class="primary-btn primary-btn--primary primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 ml-auto">Nouvelle Encaissement</a>
                        <button data-tab="Facturation" data-block="Suivi Facturation" data-tab-class="suivi_facturation__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-91" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('suivi_facturation__part') }} position-relative ml-1 {{ session('suivi_facturation__part') == 'active' ? 'collapsed':'' }}">
                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                        </button>
                </div>
            </h2>
        </div>
        <div id="leadCardCollapse-91" class="collapse {{ session('suivi_facturation__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-14">
            <div class="card-body px-0 pb-0">
                <div class="accordion">
                    @foreach ($project->getFacturation as $facturation)
                    @php
                        $facturation_type = $facturation->type;
                        $facturation_type_array = explode(' ', $facturation_type);
                        if($facturation_type_array[0] == 'Encaissement'){
                            array_shift($facturation_type_array);
                            $facturation_type = implode(' ', $facturation_type_array);
                        }
                    @endphp
                    <div class="card lead__card border-bottom" style="border-color: black !important;">
                        <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
                            <h2 class="mb-0">
                                @if ($user_actions->where('module_name', 'collapse_suivi_facturation')->where('action_name', 'delete')->first() || $role == 's_admin')
                                    <button type="button" class="btn btn-icon shadow-none top-right facturationDeleteButton" data-id="{{ $facturation->id }}"><i class="bi bi-trash3"></i></button>
                                @endif
                                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                                    <div class="lead__card__toggler__content w-100">
                                        <h3 class="lead__card__toggler__content__heading">Encaissement {{ $project->getFacturation->count() - $loop->index }}</h3>
                                        <div class="lead__card__toggler__content__row">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Type de réglement :</strong>
                                                        <span class="text-dark">{{ $facturation_type }}</span>
                                                    </p>
                                                </div>
                                               <div class="col-xl-6">
                                                   <div class="lead__card__toggler__content__row__text d-flex align-items-center">
                                                       <strong class="lead__card__toggler__content__row__title flex-shrink-0 mr-2">Statut règlement :</strong>
                                                       @if ($facturation->Statut_règlement)
                                                           <div style="border-radius: 5px; padding:10px;
                                                           @if($facturation->Statut_règlement == 'Déposé' || $facturation->Statut_règlement == 'Envoi contrat' || $facturation->Statut_règlement == 'En cours de paiement')
                                                               color:#000000; background-color:#F1C232;
                                                           @elseif($facturation->Statut_règlement == 'Payé')
                                                               color:#000000; background-color:#6AA84F;
                                                           @elseif($facturation->Statut_règlement == 'Non payé')
                                                               color:#000000; background-color:#f55050;
                                                           @else
                                                               color:#000000; background-color:#27C6DA;
                                                           @endif
                                                           ">{{ $facturation->Statut_règlement }} </div>
                                                       @endif
                                                   </div>
                                               </div>
                                               @if ($facturation_type == 'Client' || $facturation_type == 'Action Logement')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Montant :</strong>
                                                           <span class="text-dark">
                                                               {{ EuroFormat($facturation->Montant) }}
                                                           </span>
                                                       </p>
                                                   </div>
                                               @elseif ($facturation_type == 'CEE')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Delegataire :</strong>
                                                           <span class="text-dark">
                                                               {{ $facturation->getDelegataire->company_name ?? ''  }}
                                                           </span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">CUMAC :</strong>
                                                           <span class="text-dark">
                                                               {{ $facturation->CUMAC }}
                                                           </span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Montant prime C.E.E NOVECOLOGY :</strong>
                                                           <span class="text-dark">
                                                               {{ $facturation->Montant_prime_CEE_NOVECOLOGY }}
                                                           </span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Montant apporteu r d’affaires NOVECOLOGY  :</strong>
                                                           <span class="text-dark">
                                                               {{ $facturation->Montant_apporteur_dapostropheaffaires_NOVECOLOGY }}
                                                           </span>
                                                       </p>
                                                   </div>
                                               @elseif($facturation_type == 'MaPrimeRénov’')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Montant :</strong>
                                                           <span class="text-dark">
                                                               {{ EuroFormat($facturation->Montant) }}
                                                           </span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Mandataire :</strong>
                                                           <span class="text-dark">
                                                               {{ $facturation->getAgent->company_name ?? '' }}
                                                           </span>
                                                       </p>
                                                   </div>
                                               @elseif($facturation_type == 'Banque')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Banque :</strong>
                                                           <span class="text-dark">
                                                               {{ $facturation->getBanque->name ?? '' }}
                                                           </span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Montant :</strong>
                                                           <span class="text-dark">
                                                               {{ EuroFormat($facturation->Montant) }}
                                                           </span>
                                                       </p>
                                                   </div>
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button data-tab="Facturation" data-block="Suivi Facturation Encaissement {{ $project->getFacturation->count() - $loop->index }}" data-tab-class="suivi_facturation__part{{ $project->getFacturation->count() - $loop->index }}" type="button" data-toggle="collapse" data-target="#facturationInnerCardCollapse-{{ $facturation->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('suivi_facturation__part'.($project->getFacturation->count() - $loop->index)) }} position-relative ml-1 {{ session('suivi_facturation__part'.($project->getFacturation->count() - $loop->index)) == 'active' ? 'collapsed':'' }}">
                                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                    </button>
                                </div>
                            </h2>
                        </div>
                        <div id="facturationInnerCardCollapse-{{ $facturation->id }}" class="collapse {{ session('suivi_facturation__part'.($project->getFacturation->count() - $loop->index)) == 'active' ? 'show':'' }}">
                            <div class="card-body">
                                <form action="{{ route('project.facturation.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                       <input type="hidden" name="id" value="{{ $facturation->id }}">
                                       <input type="hidden" name="project_id" value="{{ $project->id }}">
                                       @if ($facturation_type == 'Client')
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_règlement{{ $facturation->id }}">Statut règlement <span class="text-danger">*</span></label>
                                                   <select name="Statut_règlement" data-placeholder="{{ __("Select") }}" id="Statut_règlement{{ $facturation->id }}" class="select2_color_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ statut de règlement est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#ffffff" data-background="green" {{ $facturation->Statut_règlement == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#f55050" {{ $facturation->Statut_règlement == 'Non payé' ? 'selected':'' }} value="Non payé">Non payé</option>
                                                       <option data-color="#000000" data-background="#ffd966" {{ $facturation->Statut_règlement == 'En cours de paiement' ? 'selected':'' }} value="En cours de paiement">En cours de paiement</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Facture_number{{ $facturation->id }}">N° facture <span class="text-danger">*</span></label>
                                                   <input type="text" name="Facture_number" id="Facture_number{{ $facturation->id }}" value="{{ $facturation->Facture_number }}" class="form-control suivi_facturation_disabled shadow-none required_field" data-error-message="Le champ N° facture est requis">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant{{ $facturation->id }}">Montant <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $facturation->Montant }}" name="Montant" id="Montant{{ $facturation->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled required_field" data-error-message="Le champ montant est requis" value="{{ EuroFormat($facturation->Montant) }}">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Prestations{{ $facturation->id }}">Prestations</label>
                                                   <input type="text" name="Prestations" id="Prestations{{ $facturation->id }}" value="{{ $facturation->Prestations }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label">Moyens de paiement</label>
                                                   <select name="Moyens_de_paiement[]" class="select2_select_option form-control suivi_facturation_disabled" multiple>
                                                       <option {{ str_contains($facturation->Moyens_de_paiement, 'Chèque') ?  'selected':'' }} value="Chèque">Chèque</option>
                                                       <option {{ str_contains($facturation->Moyens_de_paiement, 'Virement') ?  'selected':'' }} value="Virement">Virement</option>
                                                       <option {{ str_contains($facturation->Moyens_de_paiement, 'Autre') ?  'selected':'' }} value="Autre">Autre</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Mode">Mode <span class="text-danger">*</span></label>
                                                   <select name="Mode" id="Mode" class="select2_select_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ mode est requis">
                                                   <option value="" selected>{{ __("Select") }}</option>
                                                       <option {{ $facturation->Mode == 'Comptant' ? 'selected':'' }} value="Comptant">Comptant</option>
                                                       <option {{ $facturation->Mode == 'Différé' ? 'selected':'' }} value="Différé">Différé</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 invoice_customer_mode_wrap" style="display: {{ $facturation->Mode == 'Différé' ? '':'none' }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="nombre_de_mensualité">Nombre de mensualité</label>
                                                   <select name="nombre_de_mensualité" data-id="{{ $facturation->id }}" id="nombre_de_mensualité" class="select2_select_option form-control suivi_facturation_disabled w-100">
                                                   <option value="" selected>{{ __("Select") }}</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '1' ? 'selected':'' }} value="1">1</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '2' ? 'selected':'' }} value="2">2</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '3' ? 'selected':'' }} value="3">3</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '4' ? 'selected':'' }} value="4">4</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '5' ? 'selected':'' }} value="5">5</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '6' ? 'selected':'' }} value="6">6</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '7' ? 'selected':'' }} value="7">7</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '8' ? 'selected':'' }} value="8">8</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '9' ? 'selected':'' }} value="9">9</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '10' ? 'selected':'' }} value="10">10</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '11' ? 'selected':'' }} value="11">11</option>
                                                       <option {{ $facturation->nombre_de_mensualité == '12' ? 'selected':'' }} value="12">12</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 invoice_customer_nubmer_of_month_wrap" style="display: {{ $facturation->Mode == 'Différé' && $facturation->nombre_de_mensualité > 0 ? '':'none' }}">
                                               @if ($facturation->Mode == 'Différé' && $facturation->nombre_de_mensualité > 0)

                                                   @for ($i = 1; $i <= $facturation->nombre_de_mensualité; $i++)
                                                       @php
                                                           $Règlement_Date = 'Règlement_'.$i.'_Date';
                                                           $Règlement_Montant = 'Règlement_'.$i.'_Montant';
                                                           $Règlement_Statut = 'Règlement_'.$i.'_Statut';
                                                           $Règlement_Mode = 'Règlement_'.$i.'_Mode';
                                                       @endphp
                                                       <div class="card mb-3">
                                                           <div class="card-body" style="background-color: #F2F2F2">
                                                               <div class="row mt-2">
                                                                   <div class="col-12">
                                                                       <h3>
                                                                           Règlement {{ $i }}
                                                                       </h3>
                                                                   </div>

                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label class="form-label" for="Règlement_{{ $i }}_Date{{ $facturation->id }}">Date</label>
                                                                           <input type="date" name="Règlement_{{ $i }}_Date" value="{{ $facturation->$Règlement_Date }}" id="Règlement_{{ $i }}_Date{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none" placeholder="dd/mm/yyyy">
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label class="form-label" for="Règlement_{{ $i }}_Montant{{ $facturation->id }}">Montant</label>
                                                                           <input type="text" name="Règlement_{{ $i }}_Montant{{ $facturation->id }}" value="{{ $facturation->$Règlement_Montant }}" id="Règlement_{{ $i }}_Montant" class="form-control suivi_facturation_disabled shadow-none">
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label class="form-label" for="Règlement_{{ $i }}_Statut{{ $facturation->id }}">Statut</label>
                                                                           <select name="Règlement_{{ $i }}_Statut" id="Règlement_{{ $i }}_Statut{{ $facturation->id }}" class="select2_color_option form-control suivi_facturation_disabled w-100">
                                                                           <option value=" " selected>{{ __("Select") }}</option>
                                                                               <option data-color="#ffffff" data-background="green" {{ $facturation->$Règlement_Statut == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                                               <option data-color="#000000" data-background="#FFD700" {{ $facturation->$Règlement_Statut == 'Encaissement' ? 'selected':'' }} value="Encaissement">Encaissement</option>
                                                                               <option data-color="#000000" data-background="#F7980C" {{ $facturation->$Règlement_Statut == 'Attente' ? 'selected':'' }} value="Attente">Attente</option>
                                                                               <option data-color="#ffffff" data-background="red" {{ $facturation->$Règlement_Statut == 'Non payé' ? 'selected':'' }} value="Non payé">Non payé</option>
                                                                           </select>
                                                                       </div>
                                                                   </div>
                                                                   <div class="col-md-6">
                                                                       <div class="form-group">
                                                                           <label class="form-label" for="Règlement_{{ $i }}_Mode{{ $facturation->id }}">Mode</label>
                                                                           <select name="Règlement_{{ $i }}_Mode" id="Règlement_{{ $i }}_Mode{{ $facturation->id }}" class="select2_select_option form-control suivi_facturation_disabled w-100">
                                                                           <option value="" selected>{{ __("Select") }}</option>
                                                                               <option {{ $facturation->$Règlement_Mode == 'virement' ? 'selected':'' }} value="virement">virement</option>
                                                                               <option {{ $facturation->$Règlement_Mode == 'cheque' ? 'selected':'' }} value="cheque">cheque</option>
                                                                           </select>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   @endfor
                                               @endif
                                           </div>
                                       @elseif($facturation_type == 'CEE')
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_règlement{{ $facturation->id }}">Statut règlement <span class="text-danger">*</span></label>
                                                   <select name="Statut_règlement" data-placeholder="{{ __("Select") }}" id="Statut_règlement{{ $facturation->id }}" class="select2_color_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ statut de règlement est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#000000" data-background="#ffd966" {{ $facturation->Statut_règlement == 'Déposé' ? 'selected':'' }} value="Déposé">Déposé</option>
                                                       <option data-color="#ffffff" data-background="green" {{ $facturation->Statut_règlement == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Délégataire{{ $facturation->id }}">Délégataire <span class="text-danger">*</span></label>
                                                   <select name="Délégataire" id="Délégataire{{ $facturation->id }}" class="select2_select_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ délégataire est requis">
                                                       <option value="" selected>{{ __("Select") }}</option>
                                                       @foreach ($delegates as $delegate)
                                                           <option {{ $facturation->Délégataire == $delegate->id ? 'selected':'' }} value="{{ $delegate->id }}">{{ $delegate->company_name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="CUMAC{{ $facturation->id }}">CUMAC </label>
                                                   <input type="hidden" name="CUMAC" value="{{ $facturation->CUMAC }}" id="CUMAC{{ $facturation->id }}"  class="number__value">
                                                   <input type="text" step="any" value="{{ formatNumberVal($facturation->CUMAC) }}" class="form-control suivi_facturation_disabled shadow-none number__format">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_prime_CEE_Bénéficiaire{{ $facturation->id }}">Montant prime C.E.E Bénéficiaire </label>
                                                   <input type="hidden" value="{{ $facturation->Montant_prime_CEE_Bénéficiaire }}" name="Montant_prime_CEE_Bénéficiaire" id="Montant_prime_CEE_Bénéficiaire{{ $facturation->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled" value="{{ EuroFormat($facturation->Montant_prime_CEE_Bénéficiaire) }}">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_prime_CEE_NOVECOLOGY{{ $facturation->id }}">Montant prime C.E.E NOVECOLOGY  </label>
                                                   <input type="hidden" value="{{ $facturation->Montant_prime_CEE_NOVECOLOGY }}" name="Montant_prime_CEE_NOVECOLOGY" id="Montant_prime_CEE_NOVECOLOGY{{ $facturation->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled" value="{{ EuroFormat($facturation->Montant_prime_CEE_NOVECOLOGY) }}">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_apporteur_dapostropheaffaires_NOVECOLOGY{{ $facturation->id }}">Montant apporteur d’affaires NOVECOLOGY </label>
                                                   <input type="hidden" value="{{ $facturation->Montant_apporteur_dapostropheaffaires_NOVECOLOGY }}" name="Montant_apporteur_dapostropheaffaires_NOVECOLOGY" id="Montant_apporteur_dapostropheaffaires_NOVECOLOGY{{ $facturation->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled" value="{{ EuroFormat($facturation->Montant_apporteur_dapostropheaffaires_NOVECOLOGY) }}">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numero_lot{{ $facturation->id }}">Numero lot <span class="text-danger">*</span></label>
                                                   <input type="text" name="Numero_lot" id="Numero_lot{{ $facturation->id }}" value="{{ $facturation->Numero_lot }}" class="form-control suivi_facturation_disabled shadow-none required_field" data-error-message="Le champ numéro de lot est requis">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_dépôt_pollueur{{ $facturation->id }}">Date dépôt pollueur <span class="text-danger">*</span></label>
                                                   <input type="date" name="Date_dépôt_pollueur" value="{{ $facturation->Date_dépôt_pollueur }}" id="Date_dépôt_pollueur{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent required_field" data-error-message="Le champ date de dépôt pollueur est requis" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_paiement_pollueur{{ $facturation->id }}">Date paiement pollueur</label>
                                                   <input type="date" name="Date_paiement_pollueur" value="{{ $facturation->Date_paiement_pollueur }}" id="Date_paiement_pollueur{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Facture_number_NOVECOLOGY{{ $facturation->id }}">N° facture NOVECOLOGY</label>
                                                   <input type="text" name="Facture_number_NOVECOLOGY" value="{{ $facturation->Facture_number_NOVECOLOGY }}" id="Facture_number_NOVECOLOGY{{ $facturation->id }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                       @elseif ($facturation_type == 'MaPrimeRénov’')
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_règlement{{ $facturation->id }}">Statut règlement <span class="text-danger">*</span></label>
                                                   <select name="Statut_règlement" data-placeholder="{{ __("Select") }}" id="Statut_règlement{{ $facturation->id }}" class="select2_color_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ statut de règlement est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#000000" data-background="#ffd966" {{ $facturation->Statut_règlement == 'Déposé' ? 'selected':'' }} value="Déposé">Déposé</option>
                                                       <option data-color="#ffffff" data-background="green" {{ $facturation->Statut_règlement == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#26c6da" {{ $facturation->Statut_règlement == 'Avance' ? 'selected':'' }} value="Avance">Avance</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant{{ $facturation->id }}">Montant <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $facturation->Montant }}" name="Montant" id="Montant{{ $facturation->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled required_field" data-error-message="Le champ montant est requis" value="{{ EuroFormat($facturation->Montant) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <h4 class="mb-0 mr-2">Paiement inférieur au montant prévu</h4>
                                                       <label class="switch-checkbox">
                                                           <input type="checkbox" value="yes" data-autre-box="Paiement_inférieur_au_montant_prévuWrap{{ $facturation->id }}"  class="switch-checkbox__input suivi_facturation_disabled other_field__system" id="Paiement_inférieur_au_montant_prévu"  name="Paiement_inférieur_au_montant_prévu" {{ ($facturation->Paiement_inférieur_au_montant_prévu == 'yes' || $facturation->Paiement_inférieur_au_montant_prévu == 'Oui')? 'checked':'' }}>
                                                           <span class="switch-checkbox__label"></span>
                                                       </label>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-12 Paiement_inférieur_au_montant_prévuWrap{{ $facturation->id }}" style="display: {{ ($facturation->Paiement_inférieur_au_montant_prévu == 'yes' || $facturation->Paiement_inférieur_au_montant_prévu == 'Oui')? '':'none' }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="Paiement_inférieur_payé{{ $facturation->id }}">Paiement inférieur payé </label>
                                                   <input type="hidden" value="{{ $facturation->Paiement_inférieur_payé }}" name="Paiement_inférieur_payé" class="montant_value">
                                                   <input type="text" value="{{ EuroFormat($facturation->Paiement_inférieur_payé) }}" class="form-control montant_format suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Mandataire{{ $facturation->id }}">Mandataire <span class="text-danger">*</span></label>
                                                   <select name="Mandataire" id="Mandataire{{ $facturation->id }}" class="select2_select_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ mandataire est requis">
                                                       <option value="" selected>{{ __("Select") }}</option>
                                                       @foreach ($agents as $agent)
                                                           <option {{ $facturation->Mandataire == $agent->id ? 'selected':'' }} value="{{ $agent->id }}">{{ $agent->company_name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Entreprise_de_travaux{{ $facturation->id }}">Entreprise de travaux <span class="text-danger">*</span></label>
                                                   <select name="Entreprise_de_travaux[]" id="Entreprise_de_travaux{{ $facturation->id }}" class="select2_select_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ entreprise de travaux est requis" multiple>
                                                       @foreach ($entreprise_de_travauxs as $entreprise_de_travaux)
                                                           <option {{ $facturation->facturationEntreprise()->where('entreprise_id', $entreprise_de_travaux->id)->exists() ? 'selected':'' }} value="{{ $entreprise_de_travaux->id }}">{{ $entreprise_de_travaux->first_name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_facturation_MaPrimeRénov{{ $facturation->id }}">Date facturation MaPrimeRénov’ <span class="text-danger">*</span></label>
                                                   <input type="date" name="Date_facturation_MaPrimeRénov" value="{{ $facturation->Date_facturation_MaPrimeRénov }}" id="Date_facturation_MaPrimeRénov{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent required_field" data-error-message="Le champ date facturation MaPrimeRénov’  est requis" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Facture_number_NOVECOLOGY{{ $facturation->id }}">N° facture NOVECOLOGY <span class="text-danger">*</span></label>
                                                   <input type="text" name="Facture_number_NOVECOLOGY" value="{{ $facturation->Facture_number_NOVECOLOGY }}" id="Facture_number_NOVECOLOGY{{ $facturation->id }}" class="form-control suivi_facturation_disabled shadow-none required_field" data-error-message="Le champ N° facture NOVECOLOGY est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <h4 class="mb-0 mr-2">Avance délégataire MaPrimeRénov'</h4>
                                                       <label class="switch-checkbox">
                                                           <input type="checkbox" value="yes" class="switch-checkbox__input suivi_facturation_disabled other_field__system" id="Avance_délégataire_MaPrimeRénov" data-autre-box="Avance_délégataire_MaPrimeRénovWrap{{ $facturation->id }}"  name="Avance_délégataire_MaPrimeRénov" {{ ($facturation->Avance_délégataire_MaPrimeRénov == 'yes' || $facturation->Avance_délégataire_MaPrimeRénov == 'Oui')? 'checked':'' }}>
                                                           <span class="switch-checkbox__label"></span>
                                                       </label>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-12 Avance_délégataire_MaPrimeRénovWrap{{ $facturation->id }}" style="display: {{ ($facturation->Avance_délégataire_MaPrimeRénov == 'yes' || $facturation->Avance_délégataire_MaPrimeRénov == 'Oui')? '':'none' }}">
                                               <div class="card mb-3">
                                                   <div class="card-body" style="background-color: #F2F2F2">
                                                       <div class="row">
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="form-label" for="Avance_délégataire_MaPrimeRénov_Mandataire{{ $facturation->id }}">Mandataire</label>
                                                                   <select name="Avance_délégataire_MaPrimeRénov_Mandataire" id="Avance_délégataire_MaPrimeRénov_Mandataire{{ $facturation->id }}" class="select2_select_option form-control suivi_facturation_disabled w-100">
                                                                       <option value="" selected>{{ __("Select") }}</option>
                                                                       @foreach ($agents as $agent)
                                                                           <option {{ $facturation->Avance_délégataire_MaPrimeRénov_Mandataire == $agent->id ? 'selected':'' }} value="{{ $agent->id }}">{{ $agent->company_name }}</option>
                                                                       @endforeach
                                                                   </select>
                                                               </div>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="form-label" for="Montant_avance{{ $facturation->id }}">Montant avance</label>
                                                                   <input type="hidden" value="{{ $facturation->Montant_avance }}" name="Montant_avance" id="Montant_avance{{ $facturation->id }}" class="montant_value">
                                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled" value="{{ EuroFormat($facturation->Montant_avance) }}">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="form-label" for="Lot_APF{{ $facturation->id }}">Lot APF</label>
                                                                   <input type="text" name="Lot_APF" id="Lot_APF{{ $facturation->id }}" value="{{ $facturation->Lot_APF }}" class="form-control suivi_facturation_disabled shadow-none">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="form-label" for="Numéro_de_bordereau_APF{{ $facturation->id }}">Numéro de bordereau APF</label>
                                                                   <input type="number" name="Numéro_de_bordereau_APF" step="any" id="Numéro_de_bordereau_APF{{ $facturation->id }}" value="{{ $facturation->Numéro_de_bordereau_APF }}" class="form-control suivi_facturation_disabled shadow-none">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="form-label" for="Date_APF{{ $facturation->id }}">Date APF</label>
                                                                   <input type="date" name="Date_APF" value="{{ $facturation->Date_APF }}" id="Date_APF{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none" placeholder="dd/mm/yyyy">
                                                               </div>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group">
                                                                   <label class="form-label" for="Paye_le{{ $facturation->id }}">Payé le</label>
                                                                   <input type="date" name="Paye_le" value="{{ $facturation->Paye_le }}" id="Paye_le{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none" placeholder="dd/mm/yyyy">
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_paiement_MaPrimeRénov{{ $facturation->id }}">Date paiement MaPrimeRénov’</label>
                                                   <input type="date" name="Date_paiement_MaPrimeRénov" value="{{ $facturation->Date_paiement_MaPrimeRénov }}" id="Date_paiement_MaPrimeRénov{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Référence_bancaire{{ $facturation->id }}">Référence bancaire</label>
                                                   <input type="text" name="Référence_bancaire" id="Référence_bancaire{{ $facturation->id }}" value="{{ $facturation->Référence_bancaire }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <div class="d-flex align-items-center justify-content-between">
                                                       <h4 class="mb-0 mr-2">Lettre de versement</h4>
                                                       <label class="switch-checkbox">
                                                           <input type="checkbox" value="yes" class="switch-checkbox__input suivi_facturation_disabled other_field__system" id="Lettre_de_versement" data-autre-box="Lettre_de_versementWrap{{ $facturation->id }}"  name="Lettre_de_versement" {{ ($facturation->Lettre_de_versement == 'yes' || $facturation->Lettre_de_versement == 'Oui')? 'checked':'' }}>
                                                           <span class="switch-checkbox__label"></span>
                                                       </label>
                                                   </div>   
                                               </div>
                                           </div>
                                           <div class="col-12 my-3 Lettre_de_versementWrap{{ $facturation->id }}" style="display: {{ ($facturation->Lettre_de_versement == 'yes' || $facturation->Lettre_de_versement == 'Oui')? '':'none' }}">
                                               {{-- @push('all_forms')
                                                   <form action="{{ route('project.facturation.file.update') }}" method="post" enctype="multipart/form-data">
                                                       @csrf
                                                       <input type="hidden" name="id" value="{{ $facturation->id }}">
                                                       <input type="file" hidden name="La_lettre_de_versement" id="La_lettre_de_versement{{ $facturation->id }}" onchange="this.closest('form').submit()">
                                                   </form>
                                               @endpush --}}
                                               <input type="file" hidden name="La_lettre_de_versement" id="La_lettre_de_versement{{ $facturation->id }}" class="form-control suivi_facturation_disabled shadow-none">
                                               <div class="d-flex align-items-center border px-2 rounded" style="background-color: #f2f2f2">
                                                   <h3 class="mr-auto mb-0">
                                                       @if ($facturation->La_lettre_de_versement)
                                                           {{ $facturation->La_lettre_de_versement_file_name ?? $facturation->La_lettre_de_versement }}
                                                       @else
                                                       <strong>Merci d’insérer la lettre de versement:</strong>
                                                       @endif
                                                   </h3>
                                                   <label for="La_lettre_de_versement{{ $facturation->id }}" tabindex="0" class="btn p-2 shadow-none suivi_facturation_disabled" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                                   @if ($facturation->La_lettre_de_versement)
                                                       <a href="{{ asset('uploads/facturation') }}/{{ $facturation->La_lettre_de_versement }}" target="_blank" class="btn p-2 shadow-none">
                                                           <i class="bi bi-eye"></i>
                                                       </a>
                                                       <a href="{{ asset('uploads/facturation') }}/{{ $facturation->La_lettre_de_versement }}" download="{{ $facturation->La_lettre_de_versement_file_name ?? $facturation->La_lettre_de_versement }}" class=" btn p-2 shadow-none">
                                                           <i class="bi bi-download"></i>
                                                       </a>
                                                       <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                           <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                               <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                           </button>
                                                           <div class="dropdown-menu dropdown-menu-right dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                               <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#facturationFileEdit{{ $facturation->id }}">
                                                                   Editer
                                                               </button>
                                                               <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#facturationFileDelete{{ $facturation->id }}">
                                                                   Supprimer
                                                               </button>
                                                           </div>
                                                       </div>
                                                   @endif
                                               </div>
                                               {{-- <div class="form-group">
                                                   <div class="d-flex align-items-center mb-1">
                                                       <label class="form-label">Merci d'insérer la lettre de versement</label>
                                                       <div class="d-flex ml-3">
                                                           <label for="La_lettre_de_versement{{ $facturation->id }}" class="btn shadow-none">
                                                               <i class="bi bi-upload"></i>
                                                           </label>
                                                           @if ($facturation->La_lettre_de_versement)
                                                               <a href="{{ asset('uploads/facturation') }}/{{ $facturation->La_lettre_de_versement }}" target="_blank" class=" btn shadow-none">
                                                                   <i class="bi bi-eye"></i>
                                                               </a>
                                                               <a href="{{ asset('uploads/facturation') }}/{{ $facturation->La_lettre_de_versement }}" download="{{ $facturation->La_lettre_de_versement }}" class=" btn shadow-none">
                                                                   <i class="bi bi-download"></i>
                                                               </a>
                                                           @endif
                                                       </div>
                                                   </div>
                                               </div> --}}
                                           </div>
                                           @push('all_modals')
                                               <div class="modal modal--aside fade" id="facturationFileDelete{{ $facturation->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered">
                                                       <div class="modal-content border-0">
                                                           <div class="modal-header border-0 pb-0">
                                                               <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                                                   <span class="novecologie-icon-close"></span>
                                                               </button>
                                                           </div>
                                                           <div class="modal-body text-center pt-0">
                                                               <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                                               <span>{{ __('Are You Sure To Delete this') }} ??</span>
                                                               <form action="{{ route('project.facturation.file.delete') }}" method="POST">
                                                                   @csrf
                                                                   <input type="hidden" name="id" value="{{ $facturation->id }}">
                                                                   <div class="d-flex justify-content-center">
                                                                       <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                                                           Annuler
                                                                       </button>
                                                                       <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                                                           Supprimer
                                                                       </button>
                                                                   </div>
                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                               <div class="modal modal--aside fade" id="facturationFileEdit{{ $facturation->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-centered">
                                                       <div class="modal-content border-0">
                                                           <div class="modal-header border-0 pb-0">
                                                               <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                                                   <span class="novecologie-icon-close"></span>
                                                               </button>
                                                           </div>
                                                           <div class="modal-body text-center pt-0">
                                                               <h1 class="form__title position-relative mb-4">Mettre à jour le nom du fichier </h1>
                                                               <form action="{{ route('project.facturation.file.name.edit') }}" method="POST" enctype="multipart/form-data">
                                                                   @csrf
                                                                   <input type="hidden" name="id" value="{{ $facturation->id }}">
                                                                   <div class="form-group text-left">
                                                                       <label for="#">Nom de fichier</label>
                                                                       <input type="text" name="name" value="{{ $facturation->La_lettre_de_versement_file_name ?? $facturation->La_lettre_de_versement }}" class="form-control shadow-none">
                                                                   </div>
                                                                   <div class="d-flex justify-content-center">
                                                                       <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                                                                           {{ __('Submit') }}
                                                                       </button>
                                                                   </div>
                                                               </form>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                           @endpush
                                       @elseif($facturation_type == 'Banque')
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_règlement{{ $facturation->id }}">Statut réglement banque <span class="text-danger">*</span></label>
                                                   <select name="Statut_règlement" data-placeholder="{{ __("Select") }}" id="Statut_règlement{{ $facturation->id }}" class="select2_color_option form-control suivi_facturation_disabled w-100  required_field" data-error-message="Le champ statut réglement banque est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#000000" data-background="#ffd966" {{ $facturation->Statut_règlement == 'Envoi contrat' ? 'selected':'' }} value="Envoi contrat">Envoi contrat</option>
                                                       <option data-color="#ffffff" data-background="#26c6da" {{ $facturation->Statut_règlement == 'Dépôt demande de financement' ? 'selected':'' }} value="Dépôt demande de financement">Dépôt demande de financement</option>
                                                       <option data-color="#ffffff" data-background="green" {{ $facturation->Statut_règlement == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Banque{{ $facturation->id }}">Banque <span class="text-danger">*</span></label>
                                                   <select name="Banque" id="Banque{{ $facturation->id }}" class="select2_select_option form-control suivi_facturation_disabled w-100  required_field" data-error-message="Le champ banque est requis">
                                                       <option value="" selected>{{ __("Select") }}</option>
                                                       @foreach ($banques as $banque)
                                                           <option {{ ($banque->id == $facturation->Banque)? 'selected':'' }} value="{{ $banque->id }}">{{ $banque->name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant{{ $facturation->id }}">Montant <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $facturation->Montant }}" name="Montant" id="Montant{{ $facturation->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled required_field" data-error-message="Le champ montant est requis" value="{{ EuroFormat($facturation->Montant) }}">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="N_Dossier_organisme{{ $facturation->id }}">N* Dossier organisme </label>
                                                   <input type="text" name="N_Dossier_organisme" id="N_Dossier_organisme{{ $facturation->id }}" value="{{ $facturation->N_Dossier_organisme }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_envoi_contrat{{ $facturation->id }}">Date envoi contrat <span class="text-danger">*</span></label>
                                                   <input type="date" name="Date_envoi_contrat" value="{{ $facturation->Date_envoi_contrat }}" id="Date_envoi_contrat{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent   required_field" data-error-message="Le champ date envoi contrat est requis" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numero_suivi_envoi_contrat{{ $facturation->id }}">Numero suivi envoi contrat</label>
                                                   <input type="text" name="Numero_suivi_envoi_contrat" value="{{ $facturation->Numero_suivi_envoi_contrat }}" id="Numero_suivi_envoi_contrat{{ $facturation->id }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_demande_de_financement{{ $facturation->id }}">Date demande de financement</label>
                                                   <input type="date" name="Date_demande_de_financement" value="{{ $facturation->Date_demande_de_financement }}" id="Date_demande_de_financement{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Paye_le{{ $facturation->id }}">Paye le</label>
                                                   <input type="date" name="Paye_le" value="{{ $facturation->Paye_le }}" id="Paye_le{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Référence_bancaire{{ $facturation->id }}">Référence bancaire</label>
                                                   <input type="text" name="Référence_bancaire" id="Référence_bancaire{{ $facturation->id }}" value="{{ $facturation->Référence_bancaire }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                       @elseif($facturation_type == 'Action Logement')
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_règlement{{ $facturation->id }}">Statut réglement <span class="text-danger">*</span></label>
                                                   <select name="Statut_règlement" data-placeholder="{{ __("Select") }}" id="Statut_règlement{{ $facturation->id }}" class="select2_color_option form-control suivi_facturation_disabled w-100 required_field" data-error-message="Le champ statut de règlement est requis">
                                                       <option value="" selected></option>
                                                       <option  data-color="#000000" data-background="#ffd966" {{ $facturation->Statut_règlement == 'Déposé' ? 'selected':'' }} value="Déposé">Déposé</option>
                                                       <option  data-color="#ffffff" data-background="green" {{ $facturation->Statut_règlement == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant{{ $facturation->id }}">Montant <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $facturation->Montant }}" name="Montant" id="Montant{{ $facturation->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format suivi_facturation_disabled required_field" data-error-message="Le champ montant est requis" value="{{ EuroFormat($facturation->Montant) }}">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="N_Dossier_Action_Logement{{ $facturation->id }}">N° Dossier Action Logement</label>
                                                   <input type="text" name="N_Dossier_Action_Logement" id="N_Dossier_Action_Logement{{ $facturation->id }}" value="{{ $facturation->N_Dossier_Action_Logement }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="amos{{ $facturation->id }}">AMO <span class="text-danger">*</span></label>
                                                   <select name="AMO" id="amos{{ $facturation->id }}" class="select2_select_option shadow-none form-control suivi_facturation_disabled required_field" data-error-message="Le champ AMO est requis">
                                                       <option value="" selected>{{ __('Select') }}</option>
                                                       @foreach ($amos as $amo)
                                                           <option {{ $facturation->AMO == $amo->company_name ? 'selected':'' }} value="{{ $amo->company_name }}">{{ $amo->company_name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_facturation_Action_Logement{{ $facturation->id }}">Date facturation Action Logement <span class="text-danger">*</span></label>
                                                   <input type="date" name="Date_facturation_Action_Logement" value="{{ $facturation->Date_facturation_Action_Logement }}" id="Date_facturation_Action_Logement{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent  required_field" data-error-message="Le champ Date facturation Action Logement est requis" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Facture_number_NOVECOLOGY{{ $facturation->id }}">N° facture NOVECOLOGY <span class="text-danger">*</span></label>
                                                   <input type="text" name="Facture_number_NOVECOLOGY" value="{{ $facturation->Facture_number_NOVECOLOGY }}" id="Facture_number_NOVECOLOGY{{ $facturation->id }}" class="form-control suivi_facturation_disabled shadow-none required_field" data-error-message="Le champ N° facture NOVECOLOGY est requis">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_paiement_Action_Logement{{ $facturation->id }}">Date paiement Action Logement</label>
                                                   <input type="date" name="Date_paiement_Action_Logement" value="{{ $facturation->Date_paiement_Action_Logement }}" id="Date_paiement_Action_Logement{{ $facturation->id }}" class="flatpickr form-control suivi_facturation_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="form-label" for="Référence_bancaire{{ $facturation->id }}">Référence bancaire</label>
                                                   <input type="text" name="Référence_bancaire" id="Référence_bancaire{{ $facturation->id }}" value="{{ $facturation->Référence_bancaire }}" class="form-control suivi_facturation_disabled shadow-none">
                                               </div>
                                           </div>
                                       @endif
                                       <div class="col-12">
                                           <div class="form-group">
                                               <label class="form-label">Observations</label>
                                               <textarea name="Observations" class="form-control suivi_facturation_disabled shadow-none">{{ $facturation->Observations }}</textarea>
                                           </div>
                                       </div>

                                        @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "collapse__suivi_facturation".$facturation_type), 'custom_field_data' => $facturation->custom_field_data, 'disabled_class' => 'suivi_facturation_disabled'])
                                        @if ($user_actions->where('module_name', 'collapse_suivi_facturation')->where('action_name', 'edit')->first() || $role == 's_admin')
                                            <div class="col-12 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 formSubmitButton">Valider</button>
                                                    @if ($role == 's_admin')
                                                        <button type="button" data-collapse="collapse__suivi_facturation{{ $facturation_type }}" data-callapse_active="facturation_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 suivi_facturation_disabled">
                                                            Ajouter un champ
                                                        </button>
                                                    @endif
                                                </div>
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
   @endif
   @if ($user_actions->where('module_name', 'collapse_controle_de_gestion')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_controle_de_gestion')->where('action_name', 'edit')->first() || $role == 's_admin')
       <div class="card lead__card border-0">
           <div class="card-header bg-transparent border-0 p-0" id="leadCard-92">
           <h2 class="mb-0">
               <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                   <span id="management_control_verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
                   Contrôle de gestion
                   <a href="javascript:void(0)" id="createControleDeGestionButton" class="primary-btn primary-btn--primary primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 ml-auto">Nouvelle Paiement</a>
                   <button data-tab="Facturation" data-block="Contrôle de gestion" data-tab-class="controle_de_gestion__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-92" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('controle_de_gestion__part') }} position-relative ml-1 {{ session('controle_de_gestion__part') == 'active' ? 'collapsed':'' }}">
                       <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                       <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                   </button>
               </div>
           </h2>
           </div>
           <div id="leadCardCollapse-92" class="collapse {{ session('controle_de_gestion__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-92">
           <div class="card-body  px-0 pb-0">
               @foreach ($project->getGestion as $gestion)
                    <div class="card lead__card border-bottom" style="border-color: black !important;">
                        <div class="card-header bg-transparent border-0 p-0" id="leadCard-14">
                            <h2 class="mb-0">
                                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                                    <div class="lead__card__toggler__content w-100">
                                        <h3 class="lead__card__toggler__content__heading">Paiement {{ $project->getGestion->count() - $loop->index }}</h3>
                                        <div class="lead__card__toggler__content__row">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Type :</strong>
                                                        <span class="text-dark">{{ $gestion->type }}</span>
                                                    </p>
                                                </div>
                                                <div class="col-xl-6">
                                                    <p class="lead__card__toggler__content__row__text">
                                                        <strong class="lead__card__toggler__content__row__title">Statut facture :</strong>
                                                        <span class="text-dark">{{ $gestion->Statut_facture }}</span>
                                                    </p>
                                                </div>
                                               @if ($gestion->type == 'Facture Matériel')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Produit :</strong>
                                                           <span class="text-dark">@foreach ($gestion->products as $product)
                                                               {{ $product->reference  }} {{ $loop->last ? '':', ' }}
                                                           @endforeach</span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Fournisseur matériel :</strong>
                                                           <span class="text-dark">{{ $gestion->getFournisseur->suplier ?? '' }}</span>
                                                       </p>
                                                   </div>
                                               @elseif ($gestion->type == 'Facture Installateur')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Installateur :</strong>
                                                           <span class="text-dark">{{ $gestion->InstallateurTechnique->name ?? '' }}</span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Numéro de facture :</strong>
                                                           <span class="text-dark">{{ $gestion->Numéro_de_facture }}</span>
                                                       </p>
                                                   </div>
                                               @elseif ($gestion->type == 'Facture Chargé étude')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Chargé d’étude :</strong>
                                                           <span class="text-dark">{{ $gestion->getChargeEtude->name ?? '' }}</span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Numéro de facture :</strong>
                                                           <span class="text-dark">{{ $gestion->Numéro_de_facture }}</span>
                                                       </p>
                                                   </div>
                                               @elseif ($gestion->type == 'Facture Prévisiteur Technico-Commercial')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Prévisiteur Technico-Commercial :</strong>
                                                           <span class="text-dark">{{ $gestion->getTechnicalCommercial->name ?? '' }}</span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Numéro de facture :</strong>
                                                           <span class="text-dark">{{ $gestion->Numéro_de_facture }}</span>
                                                       </p>
                                                   </div>
                                               @elseif ($gestion->type == 'Facture frais de dossiers')
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Prestataire :</strong>
                                                           <span class="text-dark">{{ $gestion->Prestataire }}</span>
                                                       </p>
                                                   </div>
                                                   <div class="col-xl-6">
                                                       <p class="lead__card__toggler__content__row__text">
                                                           <strong class="lead__card__toggler__content__row__title">Numéro de facture :</strong>
                                                           <span class="text-dark">{{ $gestion->Numéro_de_facture }}</span>
                                                       </p>
                                                   </div>
                                               @else
                                               <div class="col-xl-6">
                                                   <p class="lead__card__toggler__content__row__text">
                                                       <strong class="lead__card__toggler__content__row__title">Désignation :</strong>
                                                       <span class="text-dark">{{ $gestion->Désignation }}</span>
                                                   </p>
                                               </div>
                                               @endif
                                            </div>
                                        </div>
                                    </div>
                                    <button data-tab="Facturation" data-block="Contrôle de gestion paiement {{ $project->getGestion->count() - $loop->index }}" data-tab-class="controle_de_gestion__part{{ $project->getGestion->count() - $loop->index }}" type="button" data-toggle="collapse" data-target="#controleDeGestionInnerCardCollapse-{{ $gestion->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('controle_de_gestion__part'.($project->getGestion->count() - $loop->index)) }} position-relative ml-1 {{ session('controle_de_gestion__part'.($project->getGestion->count() - $loop->index)) == 'active' ? 'collapsed':'' }}">
                                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                    </button>
                                </div>
                            </h2>
                        </div>
                        <div id="controleDeGestionInnerCardCollapse-{{ $gestion->id }}" class="collapse {{ session('controle_de_gestion__part'.($project->getGestion->count() - $loop->index)) == 'active' ? 'show':'' }}">
                            <div class="card-body">
                                <form action="{{ route('project.gestion.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                       <input type="hidden" name="id" value="{{ $gestion->id }}">
                                       <input type="hidden" name="project_id" value="{{ $project->id }}">
                                       @if ($gestion->type == 'Facture Matériel')
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_facture{{ $gestion->id }}">Statut facture <span class="text-danger">*</span></label>
                                                   <select name="Statut_facture" data-placeholder="{{ __("Select") }}" id="Statut_facture{{ $gestion->id }}" data-id="{{ $gestion->id }}" class="Statut_facture_input select2_color_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ statut facture est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#ffffff" data-background="green" {{ $gestion->Statut_facture == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#f55050" {{ $gestion->Statut_facture == 'Non Payé' ? 'selected':'' }} value="Non Payé">Non Payé</option>
                                                       <option data-color="#000000" data-background="#28C6DA" {{ $gestion->Statut_facture == 'Paiement partiel' ? 'selected':'' }} value="Paiement partiel">Paiement partiel</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 Statut_facture_wrap{{ $gestion->id }}" style="display: {{ $gestion->Statut_facture == 'Payé' ? '' : 'none'  }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="Payé_le{{ $gestion->id }}">Payé le <span class="text-danger">*</span></label>
                                                   <input type="date" name="Payé_le" value="{{ $gestion->Payé_le }}" id="Payé_le{{ $gestion->id }}" class="flatpickr form-control controle_de_gestion_disabled bg-transparent shadow-none {{ $gestion->Statut_facture == 'Payé' ? 'required_field' : ''  }} required_field__option{{ $gestion->id }}" data-error-message="Le champ payé le est requis" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Fournisseur_matériel{{ $gestion->id }}">Fournisseur matériel</label>
                                                   <select name="Fournisseur_matériel" id="Fournisseur_matériel{{ $gestion->id }}" class="select2_select_option form-control controle_de_gestion_disabled w-100">
                                                   <option value="" selected>{{ __("Select") }}</option>
                                                   @foreach ($suppliers as $supplier)
                                                       <option {{ $gestion->Fournisseur_matériel == $supplier->id ? 'selected':'' }} value="{{ $supplier->id }}">{{ $supplier->suplier }}</option>
                                                   @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label">Produits</label>
                                                   <select name="products[]" class="select2_select_option form-control controle_de_gestion_disabled w-100" multiple>
                                                   @foreach ($products as $product)
                                                       <option {{ $gestion->products()->where('product_id', $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                   @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numéro_de_facture">Numéro de facture <span class="text-danger">*</span></label>
                                                   <input type="text" name="Numéro_de_facture" value="{{ $gestion->Numéro_de_facture }}" id="Numéro_de_facture" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ numéro de facture est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Date_de_facture{{ $gestion->id }}">Date de facture <span class="text-danger">*</span></label>
                                                   <input type="date" name="Date_de_facture" value="{{ $gestion->Date_de_facture }}" id="Date_de_facture{{ $gestion->id }}" class="flatpickr form-control controle_de_gestion_disabled bg-transparent shadow-none required_field" data-error-message="Le champ date de facture est requis" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_HT{{ $gestion->id }}">Montant HT <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_HT }}" name="Montant_HT" id="Montant_HT{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant HT est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_HT) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TTC{{ $gestion->id }}">Montant TTC <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_TTC }}" name="Montant_TTC" id="Montant_TTC{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant TTC est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_TTC) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TVA{{ $gestion->id }}">Montant TVA <span class="text-danger">*</span></label>
                                                   <input type="text" disabled value="{{ EuroFormat($gestion->Montant_TTC - $gestion->Montant_HT) }}" id="Montant_TVA{{ $gestion->id }}" class="form-control controle_de_gestion_disabled shadow-none">
                                               </div>
                                           </div>
                                       @elseif ($gestion->type == 'Facture Installateur')
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_facture{{ $gestion->id }}">Statut facture</label>
                                                   <select name="Statut_facture" id="Statut_facture{{ $gestion->id }}" data-id="{{ $gestion->id }}" class="Statut_facture_input select2_color_option form-control controle_de_gestion_disabled w-100">
                                                       <option value=" " selected>{{ __("Select") }}</option>
                                                       <option data-color="#ffffff" data-background="green" {{ $gestion->Statut_facture == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#f55050" {{ $gestion->Statut_facture == 'Non Payé' ? 'selected':'' }} value="Non Payé">Non Payé</option>
                                                       <option data-color="#000000" data-background="#28C6DA" {{ $gestion->Statut_facture == 'Paiement partiel' ? 'selected':'' }} value="Paiement partiel">Paiement partiel</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 Statut_facture_wrap{{ $gestion->id }}" style="display: {{ $gestion->Statut_facture == 'Payé' ? '' : 'none'  }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="Payé_le{{ $gestion->id }}">Payé le <span class="text-danger">*</span></label>
                                                   <input type="date" name="Payé_le" value="{{ $gestion->Payé_le }}" id="Payé_le{{ $gestion->id }}" class="flatpickr form-control controle_de_gestion_disabled bg-transparent shadow-none {{ $gestion->Statut_facture == 'Payé' ? 'required_field' : ''  }} required_field__option{{ $gestion->id }}" data-error-message="Le champ payé le est requis"  placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label">Installateur technique <span class="text-danger">*</span></label>
                                                   <select name="Installateur_technique" class="select2_select_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ installateur technique est requis">
                                                       <option value="" selected>{{ __("Select") }}</option>
                                                   @foreach ($installers as $installer)
                                                       <option {{ $gestion->Installateur_technique == $installer->id ? 'selected':'' }} value="{{ $installer->id }}">{{ $installer->name }}</option>
                                                   @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Chef_d_équipe{{ $gestion->id }}">Chef d’équipe :</label>
                                                   <select id="Chef_d_équipe{{ $gestion->id }}" disabled class="select2_select_option form-control controle_de_gestion_disabled w-100">
                                                       @foreach ($team_laeders as $team_laeder)
                                                           <option value="disabled" disabled="disabled"  {{ $gestion->InstallateurTechnique ? ($gestion->InstallateurTechnique->team_leader == $team_laeder->id ? 'selected' : '') : ''  }}>{{ $team_laeder->name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Société">Société <span class="text-danger">*</span></label>
                                                   <input type="text" name="Société" value="{{ $gestion->Société }}" id="Société" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ société est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numéro_de_facture">Numéro de facture <span class="text-danger">*</span></label>
                                                   <input type="text" name="Numéro_de_facture" value="{{ $gestion->Numéro_de_facture }}" id="Numéro_de_facture" class="form-control controle_de_gestion_disabled shadow-none  required_field" data-error-message="Le champ numéro de facture est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_HT{{ $gestion->id }}">Montant HT <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_HT }}" name="Montant_HT" id="Montant_HT{{ $gestion->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format controle_de_gestion_disabled required_field" data-error-message="Le champ montant HT est requis" value="{{ EuroFormat($gestion->Montant_HT) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TTC{{ $gestion->id }}">Montant TTC <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_TTC }}" name="Montant_TTC" id="Montant_TTC{{ $gestion->id }}" class="montant_value">
                                                   <input type="text" class="form-control shadow-none montant_format controle_de_gestion_disabled required_field" data-error-message="Le champ montant TTC est requis" value="{{ EuroFormat($gestion->Montant_TTC) }}">
                                               </div>
                                           </div>

                                       @elseif ($gestion->type == 'Facture Chargé étude')
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_facture{{ $gestion->id }}">Statut facture <span class="text-danger">*</span></label>
                                                   <select name="Statut_facture" data-placeholder="{{ __("Select") }}" id="Statut_facture{{ $gestion->id }}" data-id="{{ $gestion->id }}" class="Statut_facture_input select2_color_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ statut facture est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#ffffff" data-background="green" {{ $gestion->Statut_facture == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#f55050" {{ $gestion->Statut_facture == 'Non Payé' ? 'selected':'' }} value="Non Payé">Non Payé</option>
                                                       <option data-color="#000000" data-background="#28C6DA" {{ $gestion->Statut_facture == 'Paiement partiel' ? 'selected':'' }} value="Paiement partiel">Paiement partiel</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 Statut_facture_wrap{{ $gestion->id }}" style="display: {{ $gestion->Statut_facture == 'Payé' ? '' : 'none'  }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="Payé_le{{ $gestion->id }}">Payé le</label>
                                                   <input type="date" name="Payé_le" value="{{ $gestion->Payé_le }}" id="Payé_le{{ $gestion->id }}" class="flatpickr form-control controle_de_gestion_disabled bg-transparent shadow-none" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label">Chargé d’étude <span class="text-danger">*</span></label>
                                                   <select name="Chargé_dapostropheétude" class="select2_select_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ chargé d’étude est requis">
                                                       <option value="" selected>{{ __("Select") }}</option>
                                                       @foreach ($charge_etudes as $charge_etude)
                                                           <option {{ ($gestion->Chargé_dapostropheétude == $charge_etude->id) ? 'selected':'' }} value="{{ $charge_etude->id }}">{{ $charge_etude->name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numéro_de_facture">Numéro de facture <span class="text-danger">*</span></label>
                                                   <input type="text" name="Numéro_de_facture" value="{{ $gestion->Numéro_de_facture }}" id="Numéro_de_facture" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ numéro de facture est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_HT{{ $gestion->id }}">Montant HT <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_HT }}" name="Montant_HT" id="Montant_HT{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant HT est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_HT) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TTC{{ $gestion->id }}">Montant TTC <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_TTC }}" name="Montant_TTC" id="Montant_TTC{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant TTC est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_TTC) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TVA{{ $gestion->id }}">Montant TVA</label>
                                                   <input type="text" disabled value="{{ EuroFormat($gestion->Montant_TTC - $gestion->Montant_HT) }}" id="Montant_TVA{{ $gestion->id }}" class="form-control controle_de_gestion_disabled shadow-none">
                                               </div>
                                           </div>
                                       @elseif ($gestion->type == 'Facture Prévisiteur Technico-Commercial')
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_facture{{ $gestion->id }}">Statut facture <span class="text-danger">*</span></label>
                                                   <select name="Statut_facture" data-placeholder="{{ __("Select") }}" id="Statut_facture{{ $gestion->id }}" data-id="{{ $gestion->id }}" class="Statut_facture_input select2_color_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ statut facture est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#ffffff" data-background="green" {{ $gestion->Statut_facture == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#f55050" {{ $gestion->Statut_facture == 'Non Payé' ? 'selected':'' }} value="Non Payé">Non Payé</option>
                                                       <option data-color="#000000" data-background="#28C6DA" {{ $gestion->Statut_facture == 'Paiement partiel' ? 'selected':'' }} value="Paiement partiel">Paiement partiel</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 Statut_facture_wrap{{ $gestion->id }}" style="display: {{ $gestion->Statut_facture == 'Payé' ? '' : 'none'  }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="Payé_le{{ $gestion->id }}">Payé le</label>
                                                   <input type="date" name="Payé_le" value="{{ $gestion->Payé_le }}" id="Payé_le{{ $gestion->id }}" class="flatpickr form-control controle_de_gestion_disabled bg-transparent shadow-none" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label">Prévisiteur Technico-Commercial <span class="text-danger">*</span></label>
                                                   <select name="Prévisiteur_TechnicohyphenCommercial" class="select2_select_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ prévisiteur Technico-Commercial est requis">
                                                       <option value="" selected>{{ __("Select") }}</option>
                                                       @foreach ($technical_commercials->where('role_id', 4) as $technical_commercial)
                                                           <option {{ ($gestion->Prévisiteur_TechnicohyphenCommercial == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numéro_de_facture">Numéro de facture <span class="text-danger">*</span></label>
                                                   <input type="text" name="Numéro_de_facture" value="{{ $gestion->Numéro_de_facture }}" id="Numéro_de_facture" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ numéro de facture est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_HT{{ $gestion->id }}">Montant HT <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_HT }}" name="Montant_HT" id="Montant_HT{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant HT est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_HT) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TTC{{ $gestion->id }}">Montant TTC <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_TTC }}" name="Montant_TTC" id="Montant_TTC{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant TTC est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_TTC) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TVA{{ $gestion->id }}">Montant TVA</label>
                                                   <input type="text" disabled value="{{ EuroFormat($gestion->Montant_TTC - $gestion->Montant_HT) }}" id="Montant_TVA{{ $gestion->id }}" class="form-control controle_de_gestion_disabled shadow-none">
                                               </div>
                                           </div>
                                       @elseif ($gestion->type == 'Facture frais de dossiers')
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_facture{{ $gestion->id }}">Statut facture <span class="text-danger">*</span></label>
                                                   <select name="Statut_facture" data-placeholder="{{ __("Select") }}" id="Statut_facture{{ $gestion->id }}" data-id="{{ $gestion->id }}" class="Statut_facture_input select2_color_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ statut facture est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#ffffff" data-background="green" {{ $gestion->Statut_facture == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#f55050" {{ $gestion->Statut_facture == 'Non Payé' ? 'selected':'' }} value="Non Payé">Non Payé</option>
                                                       <option data-color="#000000" data-background="#28C6DA" {{ $gestion->Statut_facture == 'Paiement partiel' ? 'selected':'' }} value="Paiement partiel">Paiement partiel</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 Statut_facture_wrap{{ $gestion->id }}" style="display: {{ $gestion->Statut_facture == 'Payé' ? '' : 'none'  }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="Payé_le{{ $gestion->id }}">Payé le</label>
                                                   <input type="date" name="Payé_le" value="{{ $gestion->Payé_le }}" id="Payé_le{{ $gestion->id }}" class="flatpickr form-control controle_de_gestion_disabled bg-transparent shadow-none" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Prestataire{{ $gestion->id }}">Prestataire <span class="text-danger">*</span></label>
                                                   <input type="text" name="Prestataire" value="{{ $gestion->Prestataire }}" id="Prestataire{{ $gestion->id }}" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ prestataire est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numéro_de_facture{{ $gestion->id }}">Numéro de facture <span class="text-danger">*</span></label>
                                                   <input type="text" name="Numéro_de_facture" value="{{ $gestion->Numéro_de_facture }}" id="Numéro_de_facture{{ $gestion->id }}" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ numéro de facture est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_HT{{ $gestion->id }}">Montant HT <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_HT }}" name="Montant_HT" id="Montant_HT{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant HT est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_HT) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TTC{{ $gestion->id }}">Montant TTC <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_TTC }}" name="Montant_TTC" id="Montant_TTC{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant TTC est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_TTC) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TVA{{ $gestion->id }}">Montant TVA</label>
                                                   <input type="text" disabled value="{{ EuroFormat($gestion->Montant_TTC - $gestion->Montant_HT) }}" id="Montant_TVA{{ $gestion->id }}" class="form-control controle_de_gestion_disabled shadow-none">
                                               </div>
                                           </div>
                                       @else
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Désignation">Désignation <span class="text-danger">*</span></label>
                                                   <input type="text" name="Désignation" value="{{ $gestion->Désignation }}" id="Désignation" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ désignation est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Statut_facture{{ $gestion->id }}">Statut facture <span class="text-danger">*</span></label>
                                                   <select name="Statut_facture" data-placeholder="{{ __("Select") }}" id="Statut_facture{{ $gestion->id }}" data-id="{{ $gestion->id }}" class="Statut_facture_input select2_color_option form-control controle_de_gestion_disabled w-100 required_field" data-error-message="Le champ statut facture est requis">
                                                       <option value="" selected></option>
                                                       <option data-color="#ffffff" data-background="green" {{ $gestion->Statut_facture == 'Payé' ? 'selected':'' }} value="Payé">Payé</option>
                                                       <option data-color="#ffffff" data-background="#f55050" {{ $gestion->Statut_facture == 'Non Payé' ? 'selected':'' }} value="Non Payé">Non Payé</option>
                                                       <option data-color="#000000" data-background="#28C6DA" {{ $gestion->Statut_facture == 'Paiement partiel' ? 'selected':'' }} value="Paiement partiel">Paiement partiel</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div class="col-12 Statut_facture_wrap{{ $gestion->id }}" style="display: {{ $gestion->Statut_facture == 'Payé' ? '' : 'none'  }}">
                                               <div class="form-group">
                                                   <label class="form-label" for="Payé_le{{ $gestion->id }}">Payé le</label>
                                                   <input type="date" name="Payé_le" value="{{ $gestion->Payé_le }}" id="Payé_le{{ $gestion->id }}" class="flatpickr form-control controle_de_gestion_disabled bg-transparent shadow-none" placeholder="dd/mm/yyyy">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Numéro_de_facture">Numéro de facture <span class="text-danger">*</span></label>
                                                   <input type="text" name="Numéro_de_facture" value="{{ $gestion->Numéro_de_facture }}" id="Numéro_de_facture" class="form-control controle_de_gestion_disabled shadow-none required_field" data-error-message="Le champ numéro de facture est requis">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_HT{{ $gestion->id }}">Montant HT <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_HT }}" name="Montant_HT" id="Montant_HT{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant HT est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_HT) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TTC{{ $gestion->id }}">Montant TTC <span class="text-danger">*</span></label>
                                                   <input type="hidden" value="{{ $gestion->Montant_TTC }}" name="Montant_TTC" id="Montant_TTC{{ $gestion->id }}" class="montant_value__cal">
                                                   <input type="text" class="form-control shadow-none montant_format__cal controle_de_gestion_disabled required_field" data-error-message="Le champ montant TTC est requis" data-id="{{ $gestion->id }}" value="{{ EuroFormat($gestion->Montant_TTC) }}">
                                               </div>
                                           </div>
                                           <div class="col-12">
                                               <div class="form-group">
                                                   <label class="form-label" for="Montant_TVA{{ $gestion->id }}">Montant TVA</label>
                                                   <input type="text" disabled value="{{ EuroFormat($gestion->Montant_TTC - $gestion->Montant_HT) }}" id="Montant_TVA{{ $gestion->id }}" class="form-control controle_de_gestion_disabled shadow-none">
                                               </div>
                                           </div>
                                       @endif
                                       <div class="col-12">
                                           <div class="form-group">
                                               <label class="form-label">Observations</label>
                                               <textarea name="Observations" class="form-control controle_de_gestion_disabled shadow-none">{{ $gestion->Observations }}</textarea>
                                           </div>
                                       </div>

                                        @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "collapse__controle_de_gestion".$gestion->type), 'custom_field_data' => $gestion->custom_field_data, 'disabled_class' => 'controle_de_gestion_disabled'])
                                        @if ($user_actions->where('module_name', 'collapse_controle_de_gestion')->where('action_name', 'edit')->first() || $role == 's_admin')
                                            <div class="col-12 text-center">
                                                <div class="form-group">
                                                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 formSubmitButton">Enregistrer</button>
                                                    @if ($role == 's_admin')
                                                        <button type="button" data-collapse="collapse__controle_de_gestion{{ $gestion->type }}" data-callapse_active="facturation_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 controle_de_gestion_disabled">
                                                            Ajouter un champ
                                                        </button>
                                                    @endif
                                                </div>
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
                    @endforeach
           </div>
           </div>
       </div>
   @endif
</div>


{{-- Subvention create modal --}}
<div class="modal modal--aside fade" id="facturationCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">Contrôle de gestion </h1>
                <form action="{{ route('project.facturation.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label for="#">Sélectionner un type d’encaissement</label>
                        <select class="form-control" name="type" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            <option value="Client">Client</option>
                            <option value="CEE">CEE</option>
                            <option value="MaPrimeRénov’">MaPrimeRénov’</option>
                            <option value="Action Logement">Action Logement</option>
                            <option value="Banque">Banque</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Subvention create modal --}}
<div class="modal modal--aside fade" id="createControleDeGestionModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">Contrôle de gestion </h1>
                <form action="{{ route('project.gestion.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label for="#">Sélectionner un type de paiement</label>
                        <select class="form-control" name="type" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            <option value="Facture Matériel">Facture Matériel</option>
                            <option value="Facture Installateur">Facture Installateur</option>
                            <option value="Facture Chargé étude">Facture Chargé étude</option>
                            <option value="Facture Prévisiteur Technico-Commercial">Facture Prévisiteur Technico-Commercial</option>
                            <option value="Facture frais de dossiers">Facture frais de dossiers</option>
                            <option value="Facture dépense">Facture dépense {{ $project->getGestion()->where('status', 0)->count() + 1 }}</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--  Delete Modal  --}}
<div class="modal modal--aside fade" id="FacturationDeleteButton" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>{{ __('Are You Sure To Delete this') }}?</span>
                <form action="{{ route('project.facturation.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="facturation_deleted_id">
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