@php 
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get();
    $amos = \App\Models\CRM\Amo::all();
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();   
@endphp
<div class="accordion" id="leadAccordion6">
    @if ($user_actions->where('module_name', 'collapse_informaton_2')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_informaton_2')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-15">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                Subvention
                {{-- <span class="d-block ml-auto">
                    <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                </span> --}}
                <button data-tab="Action Logement" data-block="Subvention" data-tab-class="information_2_part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-15" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('information_2_part') }} position-relative ml-auto mr-1 {{ session('information_2_part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-15" class="collapse {{ session('information_2_part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-15">
        <div class="card-body row">
            <div class="col custom-space">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Date_de_dépôt">Date de dépôt</label>
                            <input type="date" name="Date_de_dépôt" id="Date_de_dépôt" value="{{ $project->Date_de_dépôt }}" class="flatpickr flatpickr-input form-control shadow-none information2_disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Number_Dossier_Action_Logement"> N° Dossier Action Logement <span class="text-danger">*</span></label>
                            <input type="text" name="Number_Dossier_Action_Logement" id="Number_Dossier_Action_Logement" value="{{ $project->Number_Dossier_Action_Logement }}"  class="form-control shadow-none information2_disabled">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Montant_subvention_prévisionnelle">Montant subvention prévisionnelle <span class="text-danger">*</span></label>
                            <input type="hidden" value="{{ $project->Montant_subvention_prévisionnelle }}" name="Montant_subvention_prévisionnelle" id="Montant_subvention_prévisionnelle" class="montant_value">
                            <input type="text" class="form-control shadow-none montant_format information2_disabled" id="Montant_subvention_prévisionnelleInput" value="{{ EuroFormat($project->Montant_subvention_prévisionnelle) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Travaux_déposés">Travaux déposés <span class="text-danger">*</span></label>
                            <select name="Travaux_déposés" id="Travaux_déposés"  class="select2_select_option custom-select shadow-none form-control information2_disabled" multiple>
                                @foreach ($bareme_travaux_tags as $travaux)
                                        <option @if (getFeature($project->Travaux_déposés, $travaux->travaux))
                                            selected
                                        @endif value="{{ $travaux->travaux }}">{{ $travaux->travaux }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Statut_Action_logement"> Statut Action logement <span class="text-danger">*</span></label>
                            <select name="Statut_Action_logement" id="Statut_Action_logement" value="{{ $project->Statut_Action_logement }}" class="select2_select_option custom-select shadow-none form-control information2_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                <option {{ $project->Statut_Action_logement == 'Dossier en cours de saisie' ? 'selected':'' }} value="Dossier en cours de saisie">Dossier en cours de saisie</option>
                                <option {{ $project->Statut_Action_logement == 'Dossier en attente de pièces' ? 'selected':'' }} value="Dossier en attente de pièces">Dossier en attente de pièces</option>
                                <option {{ $project->Statut_Action_logement == 'En cours de saisie du plan de financement' ? 'selected':'' }} value="En cours de saisie du plan de financement">En cours de saisie du plan de financement</option>
                                <option {{ $project->Statut_Action_logement == 'En cours de traitement par Action Logement' ? 'selected':'' }} value="En cours de traitement par Action Logement">En cours de traitement par Action Logement</option>
                                <option {{ $project->Statut_Action_logement == 'En attente de signature de la convention' ? 'selected':'' }} value="En attente de signature de la convention">En attente de signature de la convention</option>
                                <option {{ $project->Statut_Action_logement == "En attente d'acomptes et factures" ? 'selected':'' }} value="En attente d'acomptes et factures">En attente d'acomptes et factures</option>
                                <option {{ $project->Statut_Action_logement == "En attente factures autre frais" ? 'selected':'' }} value="En attente factures autre frais">En attente factures autre frais</option>
                                <option {{ $project->Statut_Action_logement == "En cours de versement" ? 'selected':'' }} value="En cours de versement">En cours de versement</option>
                                <option {{ $project->Statut_Action_logement == "Versement effectué - Dossier terminé" ? 'selected':'' }} value="Versement effectué - Dossier terminé">Versement effectué - Dossier terminé</option>
                                <option {{ $project->Statut_Action_logement == "Dossier refusé par Action Logement" ? 'selected':'' }} value="Dossier refusé par Action Logement">Dossier refusé par Action Logement</option>
                                <option {{ $project->Statut_Action_logement == "Dossier annulé sur demande client" ? 'selected':'' }} value="Dossier annulé sur demande client">Dossier annulé sur demande client</option>
                                <option {{ $project->Statut_Action_logement == "Dossier annulé pour dépassement du délai" ? 'selected':'' }} value="Dossier annulé pour dépassement du délai">Dossier annulé pour dépassement du délai</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="Date_mise_à_jour">Date mise à jour</label>
                            <input type="date" name="Date_mise_à_jour" id="Date_mise_à_jour" value="{{ $project->Date_mise_à_jour }}" class="flatpickr flatpickr-input form-control shadow-none information2_disabled">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="amo">AMO <span class="text-danger">*</span></label>
                            <select name="amo" id="amo"  class="select2_select_option custom-select shadow-none form-control information2_disabled">
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($amos as $amo)
                                    <option {{ $project->amo == $amo->company_name ? 'selected':'' }} value="{{ $amo->company_name }}">{{ $amo->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Subvention_Observations">Observations</label>
                            <textarea  name="Subvention_Observations" id="Subvention_Observations" class="form-control shadow-none information2_disabled">{{ $project->Subvention_Observations }}</textarea>
                        </div>
                    </div>
                    @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'subvention__collapse'), 'custom_field_data' => $project->subvention_custom_field_data, 'class' => 'subvention__custom_field', 'disabled_class' => 'information2_disabled'])
                    @if ($user_actions->where('module_name', 'collapse_informaton_2')->where('action_name', 'edit')->first() || $role == 's_admin')
                        <div class="col-12 text-center ">
                            <button id="information2Validate" type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 information2_disabled">
                                {{ __('Submit') }}
                            </button>
                            @if ($role == 's_admin')
                                <button type="button" data-collapse="subvention__collapse" data-callapse_active="action_logement_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 information2_disabled">
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