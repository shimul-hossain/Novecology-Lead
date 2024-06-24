@php
    $validation_referent_technique_status = true;
    $role_category  = \Auth::user()->getRoleName->category_id;
    if($role_category == 3 || $role_category == 4 || role() == 'Referent_Technique'){
        $validation_referent_technique_status = false;
    }
@endphp
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="Date_interventionPlanningIntervention">Date intervention: <span class="text-danger">*</span></label>
        <input type="date" name="Date_intervention" id="Date_interventionPlanningIntervention" class="flatpickr form-control intervention_disabled shadow-none bg-transparent required_field" data-error-message="Le champ date de l'intervention est requis" placeholder="dd/mm/yyyy">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="form-label" for="">Horaire intervention: <span class="text-danger">*</span></label>
        <select name="Horaire_intervention" id="" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Champ d'intervention horaire est requis">
            <option value="" selected>{{ __('Select') }}</option>
            @foreach ($min_30_interval as $hour)
                <option value="{{ $hour }}">{{ $hour }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-12">
    <div class="form-group">
        <label class="form-label" for="Statut_planningPlanningIntervention">Statut planning :<span class="text-danger">*</span></label>
        <select name="Statut_planning" id="Statut_planningPlanningIntervention" data-id="PlanningIntervention" class="select2_color_option Statut_planning_input form-control intervention_disabled w-100 required_field" data-error-message="Le champ planification des statuts est requis">
            <option value=" " selected>{{ __('Select') }}</option>
            @foreach ($status_planning as $item)
                <option  data-color="{{ $item->color }}" data-background="{{ $item->background_color }}" value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-12 Statut_planning_wrapPlanningIntervention" style="display: none">
    <div class="form-group">
        <label class="form-label" for="Merci_de_préciser_la_raisonPlanningIntervention">Merci de préciser la raison:</label>
        <input type="text" name="Merci_de_préciser_la_raison" id="Merci_de_préciser_la_raisonPlanningIntervention" class="form-control intervention_disabled shadow-none">
    </div>
</div> 
@if ($type == 'Etude')
    <div class="{{ (role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager_externe') ? 'col-12': 'col-md-6'}}">
        <div class="form-group">
            <label class="form-label" for="Chargé_dapostropheétudePlanningIntervention">Chargé d’étude : <span class="text-danger">*</span></label>
            <select name="user_id" id="Chargé_dapostropheétudePlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ Chargé d'études est requis">
                <option value="" selected>{{ __('Select') }}</option>
                @foreach ($charge_etudes as $charge_etude)
                    <option  value="{{ $charge_etude->id }}">{{ $charge_etude->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="Réfèrent_techniquePlanningIntervention">Réfèrent technique : </label>
                <select name="Réfèrent_technique" id="Réfèrent_techniquePlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 " data-error-message="Référez le champ technique est requis">
                    <option value="" selected>{{ __('Select') }}</option> 
                    @foreach ($technical_referees as $technical_referee)
                        <option value="{{ $technical_referee->id }}">{{ $technical_referee->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetPlanningIntervention">Travaux projet : <span class="text-danger">*</span></label>
            <select id="travauxProjetPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($bareme_travaux_tags as $travaux) 
                    @if ($project->ProjectTravaux()->where('travaux_id',  $travaux->id)->exists())
                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                    @endif  
                @endforeach
            </select> 
        </div>
    </div> --}}
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Faisabilité_du_chantierPlanningIntervention">Faisabilité du chantier : </label>
            <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantierPlanningIntervention" data-id="PlanningIntervention" class="select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100" data-error-message="Le champ faisabilité du chantier est requis">
                <option value=" " selected>{{ __('Select') }}</option> 
                    <option data-color="#ffffff" data-background="green" value="Faisable">Faisable</option> 
                    <option data-color="#ffffff" data-background="red"  value="Infaisable">Infaisable</option> 
                    <option data-color="#ffffff" data-background="orange" value="Faisable sous condition">Faisable sous condition</option> 
            </select>
        </div>
    </div> 
    <div class="col-12 Faisabilité_du_chantier_wrapPlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="Liste_des_travaux_à_réaliserPlanningIntervention">Liste des travaux à réaliser : <span class="text-danger">*</span></label>
            <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliserPlanningIntervention" class="form-control intervention_disabled w-100 required_field__optionFaisable_sous_conditionPlanningIntervention" data-error-message="Le champ Liste des travaux à réaliser est requis"></textarea>
        </div>
    </div>
    <div class="col-12 Faisabilité_du_chantier_wrap_InfaisablePlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="infaisable_raisonsPlanningIntervention">Raisons <span class="text-danger">*</span></label>
            <textarea name="infaisable_raisons" id="infaisable_raisonsPlanningIntervention" class="form-control intervention_disabled w-100 required_field__optionInfaisablePlanningIntervention" data-error-message="Le champ raisons est requis"></textarea>
        </div>
    </div> 
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Validation referent technique</label> 
            <select  
            @if ($validation_referent_technique_status)
                disabled
            @else
                name="Validation_referent_technique"
            @endif
          class="select2_select_option custom-select shadow-none intervention_disabled w-auto">
                <option value="" selected>{{ __('Select') }}</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Statut_contratPlanningIntervention">Statut contrat :</label>
            <select name="Statut_contrat" id="Statut_contratPlanningIntervention" data-id="PlanningIntervention" class="select2_color_option Statut_contrat_input form-control intervention_disabled w-100 " data-error-message="Le champ Statut du contrat est requis">
                <option value=" " selected> {{ __('Select') }}</option> 
                    <option data-color="#ffffff" data-background="green" value="Devis Signé">Devis Signé</option> 
                    <option data-color="#ffffff" data-background="orange" value="Réflexion">Réflexion</option> 
                    <option data-color="#ffffff" data-background="red" value="KO">KO</option> 
            </select>
        </div>
    </div> 
    <div class="col-12 Statut_contrat__SignéPlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="Devis_signé_leIntervention">Devis signé le <span class="text-danger">*</span></label>
            <input type="date" name="Devis_signé_le" id="Devis_signé_leIntervention" class="flatpickr form-control intervention_disabled shadow-none bg-transparent required_field__optionPlanningIntervention" data-error-message="Devis signé le champ est requis" placeholder="dd/mm/yyyy">
        </div>
        <input type="hidden" class="interventionTravauxCountPlanningIntervention" value="1"> 
            <div class="row intervention_travaux__wrap">
                <input type="hidden" name="number[]" value="1">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="intervention_travaux0PlanningIntervention">Travaux 1 <span class="text-danger">*</span></label>
                        <select name="travaux_id[1]" id="intervention_travaux0PlanningIntervention" class="select2_select_option form-control intervention_disabled required_field__optionPlanningIntervention  intervention_travaux_change" data-error-message="Le champ travaux est requis">
                            <option value="" selected>{{ __('Select') }}</option> 
                            @foreach ($bareme_travaux_tags as $t_travaux)
                                <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>    
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-group flex-grow-1">
                        <label class="form-label" for="travaux">Produit</label>
                        <select name="product_id[1]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product" data-error-message="Le champ produit est requis">
                            <option value="" selected>{{ __('Select') }}</option>
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group ml-3 pb-1">
                        <button type="button" data-id="PlanningIntervention" class="add-btn add__new_intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button> 
                    </div>
                </div>    
            </div> 
        <div class="form-group" id="Statut_contrat__Signé_endPlanningIntervention">
            <label class="form-label" for="Montant_TTC_Devis0PlanningIntervention">Montant TTC Devis: <span class="text-danger">*</span></label> 
            <input type="hidden" name="Montant_TTC_Devis" id="Montant_TTC_Devis0PlanningIntervention" class="montant_value"> 
			<input type="text" class="form-control shadow-none montant_format intervention_disabled required_field__optionPlanningIntervention" data-error-message="Montant TTC devis champ est requis">
        </div>
    </div>
    <div class="col-12 Statut_contrat__RéflexionPlanningIntervention" style="display: none">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Réflexion_RaisonsPlanningIntervention">Raisons :</label>
                    <select name="Réflexion_Raisons" id="Réflexion_RaisonsPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100">
                        <option value="" selected>{{ __('Select') }}</option> 
                        @foreach ($reflection_reasons as $reflection_reason) 
                            <option  value="{{ $reflection_reason->name }}">{{ $reflection_reason->name }}</option>  
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Réflexion_PrécisionsPlanningIntervention">Précisions :</label>
                    <textarea name="Réflexion_Précisions" id="Réflexion_PrécisionsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 Statut_contrat__KOPlanningIntervention" style="display: none">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="KO_RaisonsPlanningIntervention">Raisons :</label>
                    <select name="KO_Raisons" id="KO_RaisonsPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100">
                        <option value="" selected>{{ __('Select') }}</option> 
                        @foreach ($ko_reasons as $ko_reason)
                            <option value="{{ $ko_reason->name }}">{{ $ko_reason->name }}</option>  
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="KO_PrécisionsPlanningIntervention">Précisions :</label>
                    <textarea name="KO_Précisions" id="KO_PrécisionsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-12">
        <div class="mt-4 d-flex align-items-center">
            <label class="form-label mb-0 mr-2">Dossier administratif complet</label>
            <div class="multi-option-switch">
                <div class="multi-option-switch__body">
                    <input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="PlanningIntervention" id="Dossier_administratif_completPlanningIntervention--off" name="Dossier_administratif_complet">
                    <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="PlanningIntervention" value="n/a" id="Dossier_administratif_completPlanningIntervention--disabled" checked name="Dossier_administratif_complet">
                    <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="PlanningIntervention"  value="yes" id="Dossier_administratif_completPlanningIntervention--on" name="Dossier_administratif_complet">
                    <span class="multi-option-switch__float-indicator"></span>
                    <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Dossier_administratif_completPlanningIntervention--off">
                        <span class="multi-option-switch__label__btn">
                            <i class="bi bi-x-lg"></i>
                        </span>
                    </label>
                    <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Dossier_administratif_completPlanningIntervention--disabled">
                        <span class="multi-option-switch__label__btn">
                            <i class="bi bi-circle"></i>
                        </span>
                    </label>
                    <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Dossier_administratif_completPlanningIntervention--on">
                        <span class="multi-option-switch__label__btn">
                            <i class="bi bi-check-lg"></i>
                        </span>
                    </label>
                </div>
            </div> 
        </div>
    </div>   --}}
    <div class="col-12">
        <div class="form-group">
            <div class="d-flex align-items-center justify-content-between">
                <label class="form-label" for="Dossier_administratif_complet">Dossier administratif complet</label>
            </div>
            <select name="Dossier_administratif_complet" data-placeholder="{{ __('Select') }}" id="Dossier_administratif_complet"  class="select2_color_option custom-select shadow-none form-control intervention_disabled Dossier_administratif_complet__input " data-error-message="Le champ dossier administratif complet est requis" data-id="PlanningIntervention">
                <option value="" selected></option>
                <option  data-color="#000000" data-background="#93C47D" value="yes">Oui</option>
                <option data-color="#000000" data-background="#EA9999" value="no">Non</option> 
            </select> 
        </div>
    </div>
    <div class="col-12 Dossier_administratif_complet__wrapPlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="Merci_de_renseigner_les_pièces_manquantesPlanningIntervention">Merci de renseigner les pièces manquantes :</label>
            <textarea name="Merci_de_renseigner_les_pièces_manquantes" id="Merci_de_renseigner_les_pièces_manquantesPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div>
@elseif($type == 'DPE')
    @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="Prévisiteur_TechnicohyphenCommercialPlanningIntervention">Prévisiteur Technico-Commercial : <span class="text-danger">*</span></label>
                <select name="user_id" id="Prévisiteur_TechnicohyphenCommercialPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ Prévisiteur Technico-Commercial est requis">
                    <option value="" selected>{{ __('Select') }}</option>
                    @foreach ($technical_commercials->where('role_id', 4) as $technical_commercial)
                        <option value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
@elseif($type == 'Pré-Visite Technico-Commercial')
    @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="Prévisiteur_TechnicohyphenCommercialPlanningIntervention">Prévisiteur Technico-Commercial : <span class="text-danger">*</span></label>
                <select name="user_id" id="Prévisiteur_TechnicohyphenCommercialPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ Prévisiteur Technico-Commercial est requis">
                    <option value="" selected>{{ __('Select') }}</option>
                    @foreach ($technical_commercials->where('role_id', 4) as $technical_commercial)
                        <option value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="Réfèrent_techniquePlanningIntervention">Réfèrent technique :</label>
                <select name="Réfèrent_technique" id="Réfèrent_techniquePlanningIntervention" class="select2_select_option form-control intervention_disabled w-100" data-error-message="Référez le champ technique est requis">
                    <option value="" selected>{{ __('Select') }}</option>
                    @foreach ($technical_referees as $technical_referee)
                        <option value="{{ $technical_referee->id }}">{{ $technical_referee->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetPlanningIntervention">Travaux projet :</label>
            <select id="travauxProjetPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($bareme_travaux_tags as $travaux) 
                    @if ($project->ProjectTravaux()->where('travaux_id',  $travaux->id)->exists())
                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                    @endif  
                @endforeach
            </select> 
        </div>
    </div> --}}
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Faisabilité_du_chantierPlanningIntervention">Faisabilité du chantier : </label>
            <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantierPlanningIntervention" data-id="PlanningIntervention" class=" select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100 " data-error-message="Le champ faisabilité du chantier est requis">
                <option value=" " selected>{{ __('Select') }}</option> 
                    <option data-color="#ffffff" data-background="green"  value="Faisable">Faisable</option> 
                    <option data-color="#ffffff" data-background="red"  value="Infaisable">Infaisable</option> 
                    <option data-color="#ffffff" data-background="orange" value="Faisable sous condition">Faisable sous condition</option> 
            </select>
        </div>
    </div> 
    <div class="col-12 Faisabilité_du_chantier_wrapPlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="Liste_des_travaux_à_réaliserPlanningIntervention">Liste des travaux à réaliser :</label>
            <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliserPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div>
    <div class="col-12 Faisabilité_du_chantier_wrap_InfaisablePlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="infaisable_raisonsPlanningIntervention">Raisons</label>
            <textarea name="infaisable_raisons" id="infaisable_raisonsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Validation referent technique</label> 
            <select  
            @if ($validation_referent_technique_status)
                disabled
            @else
                name="Validation_referent_technique"
            @endif
          class="select2_select_option custom-select shadow-none intervention_disabled w-auto">
                <option value="" selected>{{ __('Select') }}</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
            </select>
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Statut_contratPlanningIntervention">Statut contrat : </label>
            <select name="Statut_contrat" id="Statut_contratPlanningIntervention" data-id="PlanningIntervention" class=" select2_color_option Statut_contrat_input form-control intervention_disabled w-100 " data-error-message="Le champ statut du contrat est requis">
                <option value=" " selected>{{ __('Select') }}</option> 
                    <option data-color="#ffffff" data-background="green" value="Devis Signé">Devis Signé</option> 
                    <option data-color="#ffffff" data-background="orange" value="Réflexion">Réflexion</option> 
                    <option data-color="#ffffff" data-background="red" value="KO">KO</option> 
            </select>
        </div>
    </div> 
    <div class="col-12 Statut_contrat__SignéPlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="Devis_signé_leIntervention">Devis signé le</label>
            <input type="date" name="Devis_signé_le" id="Devis_signé_leIntervention" class="flatpickr form-control intervention_disabled shadow-none bg-transparent " data-error-message="Devis signé le champ est requis" placeholder="dd/mm/yyyy">
        </div>
        <input type="hidden" class="interventionTravauxCountPlanningIntervention" value="1"> 
        <div class="row intervention_travaux__wrap">
            <input type="hidden" name="number[]" value="1">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="intervention_travaux0PlanningIntervention">Travaux 1</label>
                    <select name="travaux_id[1]" id="intervention_travaux0PlanningIntervention" class="select2_select_option form-control intervention_disabled  intervention_travaux_change" data-error-message="Le champ travaux est requis">
                        <option value="" selected>{{ __('Select') }}</option> 
                        @foreach ($bareme_travaux_tags as $t_travaux)
                            <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                        @endforeach
                    </select>
                </div>
            </div>     
            <div class="col-md-6 d-flex align-items-end">
                <div class="form-group flex-grow-1">
                    <label class="form-label" for="travaux">Produit</label>
                    <select name="product_id[1]" class="select2_select_option form-control w-100 intervention_disabled  intervention_travaux_product" data-error-message="Le champ produit est requis">
                        <option value="" selected>{{ __('Select') }}</option> 
                    </select>
                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                </div>
                <div class="form-group ml-3 pb-1">
                    <button type="button" data-id="PlanningIntervention" class="add-btn add__new_intervention_travaux__1 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button> 
                </div>
            </div>  
        </div> 
        <div class="row" id="Statut_contrat__Signé_endPlanningIntervention">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Montant_TTC_du_devis0PlanningIntervention">Montant TTC du devis:</label> 
                    <input type="hidden" name="Montant_TTC_du_devis" id="Montant_TTC_du_devis0PlanningIntervention" class="montant_value"> 
					<input type="text" class="form-control shadow-none montant_format intervention_disabled " data-error-message="Le champ montant TTC du devis est requis">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Reste_à_charge_devis0PlanningIntervention">Reste à charge devis:</label> 
                    <input type="hidden" name="Reste_à_charge_devis" id="Montant_TTC_du_devis0PlanningIntervention" class="montant_value"> 
					<input type="text" class="form-control shadow-none montant_format intervention_disabled " data-error-message="Le champ reste à charge devis est requis">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Reste_à_charge_client0PlanningIntervention">Reste à charge client:</label> 
                    <input type="hidden" name="Reste_à_charge_client" id="Reste_à_charge_client0PlanningIntervention" class="montant_value"> 
					<input type="text" class="form-control shadow-none montant_format intervention_disabled " data-error-message="Le champ reste à charge client est requis">
                </div>
            </div> 
            <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                <h4 class="mb-0 mr-2">Survente <span class="text-danger">*</span></h4> 
                <select name="Survente" data-autre-box="Montant_survente__PlanningIntervention" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto">
                    <option value="" selected>{{ __('Select') }}</option>
                    <option value="Oui">Oui</option> 
                    <option value="Non">Non</option> 
                </select>
            </div> 
            <div class="col-12 mt-3 Montant_survente__PlanningIntervention" style="display: none">
                <div class="form-group">
                    <label class="form-label" for="Montant_survente0PlanningIntervention">Montant survente:</label>
                    <input type="hidden" name="Montant_survente" id="Montant_survente0PlanningIntervention" class="montant_value"> 
					<input type="text" class="form-control shadow-none montant_format intervention_disabled">
                </div>
            </div> 
        </div>
    </div>
    <div class="col-12 Statut_contrat__RéflexionPlanningIntervention" style="display: none">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Réflexion_RaisonsPlanningIntervention">Raisons :</label>
                    <select name="Réflexion_Raisons" id="Réflexion_RaisonsPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100">
                        <option value="" selected>{{ __('Select') }}</option> 
                        @foreach ($reflection_reasons as $reflection_reason) 
                            <option value="{{ $reflection_reason->name }}">{{ $reflection_reason->name }}</option>  
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Réflexion_PrécisionsPlanningIntervention">Précisions :</label>
                    <textarea name="Réflexion_Précisions" id="Réflexion_PrécisionsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 Statut_contrat__KOPlanningIntervention" style="display: none">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="KO_RaisonsPlanningIntervention">Raisons :</label>
                    <select name="KO_Raisons" id="KO_RaisonsPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100">
                        <option value="" selected>{{ __('Select') }}</option> 
                        @foreach ($ko_reasons as $ko_reason)
                            <option value="{{ $ko_reason->name }}">{{ $ko_reason->name }}</option>  
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="KO_PrécisionsPlanningIntervention">Précisions :</label>
                    <textarea name="KO_Précisions" id="KO_PrécisionsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-12">
        <div class="mt-4 d-flex align-items-center">
            <label class="form-label mb-0 mr-2">Dossier administratif complet</label>
            <div class="multi-option-switch">
                <div class="multi-option-switch__body">
                    <input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="PlanningIntervention" id="Dossier_administratif_completPlanningIntervention--off" name="Dossier_administratif_complet">
                    <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="PlanningIntervention" value="n/a" id="Dossier_administratif_completPlanningIntervention--disabled" name="Dossier_administratif_complet" checked>
                    <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="PlanningIntervention"  value="yes" id="Dossier_administratif_completPlanningIntervention--on" name="Dossier_administratif_complet">
                    <span class="multi-option-switch__float-indicator"></span>
                    <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Dossier_administratif_completPlanningIntervention--off">
                        <span class="multi-option-switch__label__btn">
                            <i class="bi bi-x-lg"></i>
                        </span>
                    </label>
                    <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Dossier_administratif_completPlanningIntervention--disabled">
                        <span class="multi-option-switch__label__btn">
                            <i class="bi bi-circle"></i>
                        </span>
                    </label>
                    <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Dossier_administratif_completPlanningIntervention--on">
                        <span class="multi-option-switch__label__btn">
                            <i class="bi bi-check-lg"></i>
                        </span>
                    </label>
                </div>
            </div> 
        </div>
    </div>   --}}
    <div class="col-12">
        <div class="form-group">
            <div class="d-flex align-items-center justify-content-between">
                <label class="form-label" for="Dossier_administratif_complet">Dossier administratif complet</label>
            </div>
            <select name="Dossier_administratif_complet" data-placeholder="{{ __('Select') }}" id="Dossier_administratif_complet"  class="select2_color_option custom-select shadow-none form-control intervention_disabled Dossier_administratif_complet__input" data-error-message="Le champ dossier administratif complet est requis" data-id="PlanningIntervention">
                <option value="" selected>{{ __('Select') }}</option>
                <option  data-color="#000000" data-background="#93C47D" value="yes">Oui</option>
                <option data-color="#000000" data-background="#EA9999" value="no">Non</option> 
            </select> 
        </div>
    </div>
    <div class="col-12 Dossier_administratif_complet__wrapPlanningIntervention" style="display:none">
        <div class="form-group">
            <label class="form-label" for="Merci_de_renseigner_les_pièces_manquantesPlanningIntervention">Merci de renseigner les pièces manquantes :</label>
            <textarea name="Merci_de_renseigner_les_pièces_manquantes" id="Merci_de_renseigner_les_pièces_manquantesPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div>
@elseif($type == 'Contre Visite Technique')
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Contre_prévisiteurPlanningIntervention">Contre prévisiteur : <span class="text-danger">*</span></label>
            <select name="user_id" id="Contre_prévisiteurPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ contre-prévisiteur est requis">
                <option value="" selected>{{ __('Select') }}</option>
                @foreach ($technical_commercials as $technical_commercial)
                    <option value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                @endforeach
            </select>
        </div>
    </div> 
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetPlanningIntervention">Travaux projet :</label>
            <select id="travauxProjetPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($bareme_travaux_tags as $travaux) 
                    @if ($project->ProjectTravaux()->where('travaux_id',  $travaux->id)->exists())
                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                    @endif  
                @endforeach
            </select> 
        </div>
    </div> --}}
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Faisabilité_du_chantierPlanningIntervention">Faisabilité du chantier :</label>
            <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantierPlanningIntervention" data-id="PlanningIntervention" class=" select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100 " data-error-message="Le champ faisabilité du chantier est requis">
                <option value=" " selected>{{ __('Select') }}</option> 
                    <option data-color="#ffffff" data-background="green" value="Faisable">Faisable</option> 
                    <option data-color="#ffffff" data-background="red" value="Infaisable">Infaisable</option> 
                    <option data-color="#ffffff" data-background="orange" value="Faisable sous condition">Faisable sous condition</option> 
            </select>
        </div>
    </div> 
    <div class="col-12 Faisabilité_du_chantier_wrapPlanningIntervention" style="display:none">
        <div class="form-group">
            <label class="form-label" for="Liste_des_travaux_à_réaliserPlanningIntervention">Liste des travaux à réaliser :</label>
            <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliserPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div> 
    <div class="col-12 Faisabilité_du_chantier_wrap_InfaisablePlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="infaisable_raisonsPlanningIntervention">Raisons</label>
            <textarea name="infaisable_raisons" id="infaisable_raisonsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div>
    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
        <h4 class="mb-0 mr-2">Travaux supplémentaires <span class="text-danger">*</span></h4> 
        <select name="Travaux_supplémentaires" data-autre-box="Montant_Travaux_supplémentaires__PlanningIntervention" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto required_field" data-error-message="Le champ travaux supplémentaires est requis">
            <option value="" selected>{{ __('Select') }}</option>
            <option value="Oui">Oui</option> 
            <option value="Non">Non</option> 
        </select> 
    </div> 
    <div class="col-12 mt-3 Montant_Travaux_supplémentaires__PlanningIntervention"  id="Travaux_supplémentaires__startPlanningIntervention" style="display:none">
        <input type="hidden" class="interventionTravauxCountPlanningIntervention" value="1">
            <div class="row intervention_travaux__wrap">
                <input type="hidden" name="number[]" value="1">
                <div class="col-12 d-flex align-items-center"> 
                    <div class="form-group w-100">
                        <label class="form-label" for="intervention_travaux0PlanningIntervention">Travaux 1</label>
                        <select name="travaux_id[1]" id="intervention_travaux0PlanningIntervention" class="select2_select_option form-control intervention_disabled">
                            <option value="" selected>{{ __('Select') }}</option> 
                            @foreach ($bareme_travaux_tags->where('rank', 2) as $t_travaux)
                                <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ml-3 mt-3">
                        <button type="button" data-id="PlanningIntervention" class="add-btn add__new_intervention_travaux__2 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button> 
                    </div> 
                </div>   
            </div>
    </div> 
@elseif($type == 'Installation')
    @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="Installateur_techniquePlanningIntervention">Installateur technique : <span class="text-danger">*</span></label>
                <select name="user_id" id="Installateur_techniquePlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ technique d'installation est requis">
                    <option value="" selected>{{ __('Select') }}</option>
                    @foreach ($installer_techniques as $installer)
                        <option value="{{ $installer->id }}">{{ $installer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div> 
        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="Chef_d_équipePlanningIntervention">Chef d'équipe : <span class="text-danger">*</span></label>
                <select name="Chef_d_équipe" id="Chef_d_équipePlanningIntervention" disabled class="select2_select_option form-control intervention_disabled w-100">
                    <option value="" selected>{{ __('Select') }}</option>
                    @foreach ($team_laeders as $team_laeder)
                        <option value="disabled" disabled="disabled"  value="{{ $team_laeder->id }}">{{ $team_laeder->name }}</option>
                    @endforeach
                </select>
            </div>
        </div> 
    @endif
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetPlanningIntervention">Travaux projet :</label>
            <select id="travauxProjetPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($bareme_travaux_tags as $travaux) 
                    @if ($project->ProjectTravaux()->where('travaux_id',  $travaux->id)->exists())
                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                    @endif  
                @endforeach
            </select> 
        </div>
    </div> --}}
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetpPlanningIntervention">Produits projet :</label>
            <select id="travauxProjetpPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($products as $product)
                    @if ($project->getTagProduct()->where('product_id', $product->id)->exists())
                        <option selected value="disabled" disabled="disabled" value="{{ $product->id }}">{{ $product->reference }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div> --}}
    @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
        <div class="col-12">
            <div class="form-group d-flex align-items-center justify-content-between">
                <h4 class="mb-0 mr-2">Dossier Installation </h4>
                {{-- <label class="switch-checkbox">
                    <input type="checkbox" name="Dossier_Installation" value="yes" data-autre-box="Montant_Dossier_Installation__PlanningIntervention" class="switch-checkbox__input other_field__system intervention_disabled">
                    <span class="switch-checkbox__label"></span>
                </label> --}}
                <select name="Dossier_Installation" data-autre-box="Montant_Dossier_Installation__PlanningIntervention" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto  " data-error-message="Le champ installation du dossier est requis">
                    <option value="" selected>{{ __('Select') }}</option>
                    <option value="Oui">Oui</option> 
                    <option value="Non">Non</option> 
                </select> 
            </div>
        </div> 
    @endif
    <div class="col-12 Montant_Dossier_Installation__PlanningIntervention"  style="display: none">  
        <div class="row ">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="Préparé_parPlanningIntervention">Préparé par</label>
                    <select name="Préparé_par" id="Préparé_parPlanningIntervention" class="select2_select_option form-control intervention_disabled">
                        <option value="" selected>{{ __('Select') }}</option> 
                        @foreach ($users->where('role_id', 11) as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div> 
            </div>  
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="DatePlanningIntervention">Date </label>
                    <input type="date" name="Date" id="DatePlanningIntervention" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none bg-transparent data-date-readonly" placeholder="dd/mm/yyyy"> 
                </div> 
            </div>  
        </div> 
    </div> 
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Statut_InstallationPlanningIntervention">Statut Installation :</label>
            <select name="Statut_Installation" id="Statut_InstallationPlanningIntervention" data-id="PlanningIntervention" class="select2_color_option Statut_Installation_input form-control intervention_disabled w-100" data-error-message="Le champ statut de l'installation est requiss">
                <option value=" " selected >{{ __('Select') }}</option> 
                <option data-color="#ffffff" data-background="green" value="Terminé - Complet">Terminé - Complet</option> 
                <option data-color="#ffffff" data-background="red" value="Non terminé - Incomplet">Non terminé - Incomplet</option>  
            </select>
        </div>
    </div> 
    <div class="col-12 Statut_Installation__completePlanningIntervention" style="display:none">
        <input type="hidden" class="interventionTravauxCountPlanningIntervention" value="1">
            <div class="row intervention_travaux__wrap">
                <input type="hidden" name="number[]" value="1">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="intervention_travaux0PlanningIntervention">Travaux 1</label>
                        <select name="travaux_id[1]"  data-travaux-number="1" data-travaux-wrap="interventionTravauxControlProjectWrapsPlanningIntervention"   id="intervention_travaux0PlanningIntervention" class="select2_select_option interventionTravauxChange form-control intervention_disabled intervention_travaux_change">
                            <option value="" selected>{{ __('Select') }}</option> 
                            @foreach ($bareme_travaux_tags as $t_travaux)
                                <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>     
                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-group flex-grow-1">
                        <label class="form-label" for="travaux">Produit</label>
                        <select name="product_id[1]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product">
                            <option value="" selected>{{ __('Select') }}</option>
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group ml-3 pb-1">
                        <button type="button" data-id="PlanningIntervention" class="add-btn add__new_intervention_travaux__3 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button> 
                    </div>
                </div>  
                @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" style="background-color: #fbfbfb">
                                <div class="row"> 
                                    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 mr-2">Réception photos Installation <span class="text-danger">*</span></h4>
                                        <label class="switch-checkbox switch-checkbox--danger">
                                            <input type="hidden"  name="Réception_photos_Installation[1]" value="no" class="hiddenInput">
                                            <input type="checkbox" value="yes" data-autre-box="Réception_photos_Installation__PlanningIntervention" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                            <span class="switch-checkbox__label"></span>
                                        </label>
                                    </div> 
                                    <div class="col-12 mt-3 Réception_photos_Installation__PlanningIntervention"  style="display: none">  
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Réception_photos_Installation_ParPlanningIntervention">Par</label>
                                                    <select name="Réception_photos_Installation_Par[1]" id="Réception_photos_Installation_ParPlanningIntervention" class="select2_select_option form-control intervention_disabled">
                                                        <option value="" selected>{{ __('Select') }}</option> 
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div>  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Réception_photos_Installation_LePlanningIntervention">Le </label>
                                                    <input type="date" name="Réception_photos_Installation_Le[1]" id="Réception_photos_Installation_LePlanningIntervention" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy"> 
                                                </div> 
                                            </div>  
                                        </div> 
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h4 class="mt-2">Contrôle conformité photos</h4>
                                            <select name="Contrôle_conformité_photos[1]" id="Contrôle_conformité_photosPlanningIntervention" data-autre-box="Contrôle_conformité_photos__PlanningIntervention" data-error-message="Le champ contrôle conformité photos est requis" class="select2_select_option other_field__system2 form-control intervention_disabled">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option value="Oui">Oui</option>
                                                <option value="Non">Non</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 Contrôle_conformité_photos__PlanningIntervention"  style="display: none">  
                                        <div class="row ">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Contrôle_conformité_photos_ParPlanningIntervention">Par</label>
                                                    <select name="Contrôle_conformité_photos_Par[1]" id="Contrôle_conformité_photos_ParPlanningIntervention" class="select2_select_option form-control intervention_disabled">
                                                        <option value="" selected>{{ __('Select') }}</option> 
                                                        @foreach ($users as $user)
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> 
                                            </div>  
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Contrôle_conformité_photos_LePlanningIntervention">Le </label>
                                                    <input type="date" name="Contrôle_conformité_photos_Le[1]" id="Contrôle_conformité_photos_LePlanningIntervention" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy"> 
                                                </div> 
                                            </div>  
                                        </div> 
                                        <div class="col-12" id="interventionTravauxControlProjectWrapsPlanningIntervention">
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        <div class="card my-3" id="Statut_Installation__startPlanningIntervention">
            @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                <div class="card-body" style="background-color: #f2f2f2">
                    <div class="row">
                        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 mr-2">Photos sauvegardés Dropbox<span class="text-danger">*</span></h4>
                            <label class="switch-checkbox switch-checkbox--danger">
                                <input type="hidden"  name="Photo_sauvegardé_Dropbox" class="hiddenInput">
                                <input type="checkbox" value="yes" data-autre-box="Photo_sauvegardé_Dropbox__PlanningIntervention" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                <span class="switch-checkbox__label"></span>
                            </label>
                        </div> 
                        <div class="col-12 mt-3 Photo_sauvegardé_Dropbox__PlanningIntervention"  style="display:none">  
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Photo_sauvegardé_Dropbox_ParPlanningIntervention">Par</label>
                                        <select name="Photo_sauvegardé_Dropbox_Par" id="Photo_sauvegardé_Dropbox_ParPlanningIntervention" class="select2_select_option form-control intervention_disabled">
                                            <option value="" selected>{{ __('Select') }}</option> 
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Photo_sauvegardé_Dropbox_LePlanningIntervention">Le </label>
                                        <input type="date" name="Photo_sauvegardé_Dropbox_Le" id="Photo_sauvegardé_Dropbox_LePlanningIntervention" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy"> 
                                    </div> 
                                </div>  
                            </div> 
                        </div>  
                        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 mr-2">Réception dossier installation</h4>
                            <label class="switch-checkbox switch-checkbox--danger">
                                <input type="hidden"  name="Reception_dossier_installation" class="hiddenInput">
                                <input type="checkbox" value="yes" data-autre-box="Reception_dossier_installation__PlanningIntervention" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                <span class="switch-checkbox__label"></span>
                            </label>
                        </div> 
                        <div class="col-12 mt-3 Reception_dossier_installation__PlanningIntervention"  style="display:none">  
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Reception_dossier_installation_ParPlanningIntervention">Par</label>
                                        <select name="Reception_dossier_installation_Par" id="Reception_dossier_installation_ParPlanningIntervention" class="select2_select_option form-control intervention_disabled">
                                            <option value="" selected>{{ __('Select') }}</option> 
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Reception_dossier_installation_LePlanningIntervention">Le </label>
                                        <input type="date" name="Reception_dossier_installation_Le" id="Reception_dossier_installation_LePlanningIntervention" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy"> 
                                    </div> 
                                </div>  
                            </div> 
                        </div>  
                        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 mr-2">Paiement d’un reste à charge ?<span class="text-danger">*</span></h4>
                            <label class="switch-checkbox">
                                <input type="hidden"  name="Paiement_d_un_reste_à_charge" class="hiddenInput">
                                <input type="checkbox" value="yes" data-autre-box="Paiement_d_un_reste_à_charge__PlanningIntervention" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                <span class="switch-checkbox__label"></span>
                            </label>
                        </div> 
                        <div class="col-12 mt-3 Paiement_d_un_reste_à_charge__PlanningIntervention"  style="display:none">  
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Montant0PlanningIntervention">Montant :</label> 
                                        <input type="hidden" name="Montant" id="Montant0PlanningIntervention" class="montant_value"> 
                                        <input type="text" class="form-control shadow-none montant_format intervention_disabled">
                                    </div>
                                </div>  
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Moyens_de_paiementPlanningIntervention">Moyens de paiement</label>
                                        <select name="Moyens_de_paiement[]" id="Moyens_de_paiementPlanningIntervention" class="select2_select_option form-control intervention_disabled" multiple> 
                                            <option value="Chèque">Chèque</option>
                                            <option value="Virement">Virement</option>
                                            <option value="Autre">Autre</option>
                                        </select>
                                    </div>  
                                </div>  
                            </div> 
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-12 Statut_Installation__incompletePlanningIntervention" style="display:none">
        <div class="form-group">
            <label class="form-label" for="RaisonsPlanningIntervention">Raisons :</label>
            <textarea name="Raisons" id="RaisonsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div> 
@elseif($type == 'SAV')
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Technicien_SAVPlanningIntervention">Technicien SAV : <span class="text-danger">*</span></label>
            <select name="user_id" id="Technicien_SAVPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champs technicien SAV est requis">
                <option value="" selected>{{ __('Select') }}</option>
                @foreach ($installers as $installer)
                    <option value="{{ $installer->id }}">{{ $installer->name }}</option>
                @endforeach
            </select>
        </div>
    </div> 
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetPlanningIntervention">Travaux projet :</label>
            <select id="travauxProjetPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($bareme_travaux_tags as $travaux) 
                    @if ($project->ProjectTravaux()->where('travaux_id',  $travaux->id)->exists())
                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                    @endif  
                @endforeach
            </select> 
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetpPlanningIntervention">Produits projet :</label>
            <select id="travauxProjetpPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($products as $product)
                    @if ($project->getTagProduct()->where('product_id', $product->id)->exists())
                        <option selected value="disabled" disabled="disabled" value="{{ $product->id }}">{{ $product->reference }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div> --}}
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Statut_SAVPlanningIntervention">Statut SAV :</label>
            <select name="Statut_SAV" id="Statut_SAVPlanningIntervention" data-id="PlanningIntervention" class="select2_color_option Statut_SAV_input form-control intervention_disabled w-100 required_field" data-error-message="Le champs statut SAV est requis">
                <option value=" " selected>{{ __('Select') }}</option> 
                    <option data-color="#ffffff" data-background="green" value="RESOLU">RESOLU</option> 
                    <option data-color="#ffffff" data-background="red" value="NON RESOLU">NON RESOLU</option>  
            </select>
        </div>
    </div> 
    <div class="col-12 Statut_SAV_wrapPlanningIntervention" style="display:none">
        <div class="form-group">
            <label class="form-label" for="RaisonsPlanningIntervention">Raisons :</label>
            <textarea name="Raisons" id="RaisonsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div> 
    <div class="col-md-6 mt-3 d-flex align-items-center">
        <h4 class="mb-0 mr-2">Réception photos SAV </h4>
        {{-- <label class="switch-checkbox">
            <input type="checkbox" name="Reception_photo_SAV" value="yes" class="switch-checkbox__input other_field__system intervention_disabled">
            <span class="switch-checkbox__label"></span>
        </label> --}}
        <select name="Reception_photo_SAV" data-autre-box="Montant_Reception_photo_SAV__PlanningIntervention" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto required_field" data-error-message="Le champ SAV des photos de réception est requis">
            <option value="" selected>{{ __('Select') }}</option>
            <option value="Oui">Oui</option> 
            <option value="Non">Non</option> 
        </select>
    </div> 
    <div class="col-md-6 mt-3 d-flex align-items-center">
        <h4 class="mb-0 mr-2">Réception attestation SAV </h4>
        {{-- <label class="switch-checkbox">
            <input type="checkbox" name="Réception_attestation_SAV" value="yes" class="switch-checkbox__input intervention_disabled">
            <span class="switch-checkbox__label"></span>
        </label> --}}
        <select name="Réception_attestation_SAV" class="custom-select shadow-none intervention_disabled w-auto required_field" data-error-message="Le champ SAV de l'attestation de réception est requis">
            <option value="" selected>{{ __('Select') }}</option>
            <option value="Oui">Oui</option> 
            <option value="Non">Non</option> 
        </select>
    </div> 
    <div class="col-12 mt-3 Montant_Reception_photo_SAV__PlanningIntervention"  style="display:none">  
        <div class="row ">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="ParPlanningIntervention">Par</label>
                    <select name="Par" id="ParPlanningIntervention" class="select2_select_option form-control intervention_disabled">
                        <option value="" selected>{{ __('Select') }}</option> 
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div> 
            </div>  
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="LePlanningIntervention">Le </label>
                    <input type="date" name="Le" id="LePlanningIntervention" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none bg-transparent data-date-readonly" placeholder="dd/mm/yyyy"> 
                </div> 
            </div>  
        </div> 
    </div>  
@elseif($type == 'Déplacement')
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="TechnicienPlanningIntervention">Technicien : <span class="text-danger">*</span></label>
            <select name="user_id" id="TechnicienPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ technicien est requis">
                <option value="" selected>{{ __('Select') }}</option>
                @foreach ($technical_commercials as $technical_commercial)
                    @if ($technical_commercial->role_id == 1)
                        @continue
                    @endif
                    <option value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                @endforeach
            </select>
        </div>
    </div> 
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif 
            @endif
             class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif 
            @endif
             class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
             class="form-control shadow-none">
        </div>
    </div> --}}
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Précisions_déplacementPlanningIntervention">Précisions déplacement : <span class="text-danger">*</span></label>
            <textarea name="Précisions_déplacement" id="Précisions_déplacementPlanningIntervention" class="form-control intervention_disabled w-100 required_field" data-error-message="Le champ précisions déplacement est requis"></textarea>
        </div>
    </div> 
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetPlanningIntervention">Travaux projet :</label>
            <select id="travauxProjetPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($bareme_travaux_tags as $travaux) 
                    @if ($project->ProjectTravaux()->where('travaux_id',  $travaux->id)->exists())
                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                    @endif  
                @endforeach
            </select> 
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetpPlanningIntervention">Produits projet :</label>
            <select id="travauxProjetpPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($products as $product)
                    @if ($project->getTagProduct()->where('product_id', $product->id)->exists())
                        <option selected value="disabled" disabled="disabled" value="{{ $product->id }}">{{ $product->reference }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>   --}}
    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
        <h4 class="mb-0 mr-2">Mission accomplie <span class="text-danger">*</span></h4>
        {{-- <label class="switch-checkbox">
            <input type="checkbox" name="Mission_accomplie" value="yes" class="switch-checkbox__input intervention_disabled">
            <span class="switch-checkbox__label"></span>
        </label> --}}
        <select name="Mission_accomplie" class="custom-select shadow-none intervention_disabled w-auto required_field" data-error-message="Le champ mission accomplie est requis">
            <option value="" selected>{{ __('Select') }}</option>
            <option value="Oui">Oui</option> 
            <option value="Non">Non</option> 
        </select> 
    </div> 
@elseif($type == 'Prévisite virtuelle')
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="TechnicienPlanningIntervention">Technicien : <span class="text-danger">*</span></label>
            <select name="user_id" id="TechnicienPlanningIntervention" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ technicien est requis">
                <option value="" selected>{{ __('Select') }}</option>
                @foreach ($technical_commercials as $technical_commercial) 
                    <option value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                @endforeach
            </select>
        </div>
    </div> 
    {{-- <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div> 
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif 
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
             class="form-control intervention_disabled shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="travauxProjetPlanningIntervention">Travaux projet :</label>
            <select id="travauxProjetPlanningIntervention" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                @foreach ($bareme_travaux_tags as $travaux) 
                    @if ($project->ProjectTravaux()->where('travaux_id',  $travaux->id)->exists())
                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                    @endif  
                @endforeach
            </select> 
        </div>
    </div>   --}}
    <div class="col-12 mb-3">
        <div class="row">
            @include('admin.intervention_project_info')
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label" for="Faisabilité_du_chantierPlanningIntervention">Faisabilité du chantier : </label>
            <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantierPlanningIntervention" data-id="PlanningIntervention" class=" select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100 " data-error-message="Le champ faisabilité du chantier est requis">
                <option value=" " selected>{{ __('Select') }}</option> 
                    <option data-color="#ffffff" data-background="green" value="Faisable">Faisable</option> 
                    <option data-color="#ffffff" data-background="red" value="Infaisable">Infaisable</option> 
                    <option data-color="#ffffff" data-background="orange" value="Faisable sous condition">Faisable sous condition</option> 
            </select>
        </div>
    </div> 
    <div class="col-12 Faisabilité_du_chantier_wrapPlanningIntervention" style="display:none">
        <div class="form-group">
            <label class="form-label" for="Liste_des_travaux_à_réaliserPlanningIntervention">Liste des travaux à réaliser :</label>
            <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliserPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div>
    <div class="col-12 Faisabilité_du_chantier_wrap_InfaisablePlanningIntervention" style="display: none">
        <div class="form-group">
            <label class="form-label" for="infaisable_raisonsPlanningIntervention">Raisons</label>
            <textarea name="infaisable_raisons" id="infaisable_raisonsPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
        </div>
    </div>
@endif 
<div class="col-12">
    <div class="form-group">
        <label class="form-label" for="ObservationsssPlanningIntervention">Observations :</label>
        <textarea name="Observations" id="ObservationsssPlanningIntervention" class="form-control intervention_disabled w-100"></textarea>
    </div>
</div>
@include('admin.custom_field_data3', ['inputs' => $all_inputs->where('collapse_name', "intervention__$type")])