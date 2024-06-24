@php 
    if (role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager' || role() == 'sales_manager_externe'){
        $project_interventions = $project->getIntervention()->where('type', '<>', 'Déplacement')->where('type', '<>', 'SAV')->get();
    }else{
        $project_interventions = $project->getIntervention;
    }
    $schedules30 = \Carbon\CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
    $min_30_interval = [];
    foreach($schedules30 as $d){
        $min_30_interval[] = \Carbon\Carbon::parse($d)->format("G").'h'.\Carbon\Carbon::parse($d)->format("i");
    }
    $status_planning = \App\Models\CRM\StatusPlanningIntervention::all();  
    $technical_commercials = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [1,2,4])->get();
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get(); 
    $installers = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 2)->get();
    $installer_techniques = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [2,4])->get();
    $users = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->get();
    $team_laeders = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 1)->get();
    $technical_referees = \App\Models\CRM\TechnicalReferee::all();
    $reflection_reasons = \App\Models\CRM\ProjectReflectionReason::all();
    $ko_reasons = \App\Models\CRM\ProjectDeadReason::all(); 
    $charge_etudes = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->where('role_id', 9)->get();  
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();  
    $project_control_photos = \App\Models\CRM\ProjectControlPhoto::all();

    $validation_referent_technique_status = true;
    $role_category  = \Auth::user()->getRoleName->category_id;
    if($role_category == 3 || $role_category == 4 || $role == 'Referent_Technique'){
        $validation_referent_technique_status = false;
    }

@endphp
<div class="accordion" id="leadAccordionintervention">
    @if ($user_actions->where('module_name', 'collapse_intervention')->where('action_name', 'create')->first() || $role == 's_admin')
        <button class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#interventionCreateModal">
            <span class="mr-2"></span>
            + Nouvelle Intervention
        </button>
    @else
        <button type="button" class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">
            <span class="novecologie-icon-lock py-1"></span>
        </button>
    @endif
    @if ($user_actions->where('module_name', 'collapse_intervention')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_intervention')->where('action_name', 'edit')->first() || $role == 's_admin')
        @foreach ($project_interventions as $intervention)
        <div class="card lead__card border-0">
                <button type="button" class="btn btn-icon shadow-none top-right interventionDeleteButton" data-id="{{ $intervention->id }}"><i class="bi bi-trash3"></i></button>
                <div class="card-header bg-transparent border-0 p-0" id="leadCard-intervention{{ $intervention->id }}">
                <h2 class="mb-0">
                    <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                        <div class="lead__card__toggler__content w-100">
                            <h3 class="lead__card__toggler__content__heading text-right pr-3">
                                <small class="btn btn-sm ml-auto" style="background-color:
                                    @if ($intervention->type == 'Etude' || $intervention->type == 'Pré-Visite Technico-Commercial')
                                        {{ $intervention->Statut_planning && $intervention->Faisabilité_du_chantier && $intervention->Statut_contrat ? '#B6D7A8':'#F4CCCC' }}
                                    @elseif($intervention->type == 'Contre Visite Technique')
                                        {{ $intervention->Statut_planning && $intervention->Faisabilité_du_chantier ? '#B6D7A8':'#F4CCCC' }}
                                    @elseif($intervention->type == 'Installation')
                                        {{ $intervention->Statut_Installation == 'Terminé' ? '#B6D7A8':'#F4CCCC' }}
                                    @elseif($intervention->type == 'SAV')
                                        {{ $intervention->Statut_SAV == 'RESOLU' && $intervention->Reception_photo_SAV == 'Oui' && $intervention->Réception_attestation_SAV == 'Oui' ? '#B6D7A8':'#F4CCCC' }}
                                    @elseif($intervention->type == 'Déplacement')
                                        {{ $intervention->Mission_accomplie == 'Oui' ? '#B6D7A8':'#F4CCCC' }}
                                    @elseif($intervention->type == 'Prévisite virtuelle')
                                        {{ $intervention->Statut_planning && $intervention->Faisabilité_du_chantier ? '#B6D7A8':'#F4CCCC' }}
                                    @endif
                                ;">
                                    @if ($intervention->type == 'Etude' || $intervention->type == 'Pré-Visite Technico-Commercial')
                                        {{ $intervention->Statut_planning && $intervention->Faisabilité_du_chantier && $intervention->Statut_contrat ? 'Terminé':'Non Terminé' }}
                                    @elseif($intervention->type == 'Contre Visite Technique')
                                        {{ $intervention->Statut_planning && $intervention->Faisabilité_du_chantier ? 'Terminé':'Non Terminé' }}
                                    @elseif($intervention->type == 'Installation')
                                        {{ $intervention->Statut_Installation == 'Terminé' ? 'Terminé':'Non Terminé' }}
                                    @elseif($intervention->type == 'SAV')
                                        {{ $intervention->Statut_SAV == 'RESOLU' && $intervention->Reception_photo_SAV == 'Oui' && $intervention->Réception_attestation_SAV == 'Oui' ? 'Terminé':'Non Terminé' }}
                                    @elseif($intervention->type == 'Déplacement')
                                        {{ $intervention->Mission_accomplie == 'Oui' ? 'Terminé':'Non Terminé' }}
                                    @elseif($intervention->type == 'Prévisite virtuelle')
                                        {{ $intervention->Statut_planning && $intervention->Faisabilité_du_chantier ? 'Terminé':'Non Terminé' }}
                                   @endif
                                </small>
                            </h3>
                            <div class="lead__card__toggler__content__row">
                                <div class="row align-items-center">
                                    <div class="col-xl-4">
                                        <p class="lead__card__toggler__content__row__text">
                                            <strong class="lead__card__toggler__content__row__title">Intervention {{ $project_interventions->count() - $loop->index }}:</strong>
                                            <span class="text-dark">{{ $intervention->type }}</span>
                                        </p>
                                    </div>
                                    <div class="col-xl-4">
                                        <p class="lead__card__toggler__content__row__text">
                                            <strong class="lead__card__toggler__content__row__title">Date intervention :</strong>
                                            @if ($intervention->Date_intervention && strtotime($intervention->Date_intervention))
                                                <span class="text-dark">{{ \Carbon\Carbon::parse($intervention->Date_intervention)->format('d-m-Y') }}</span>
                                            @endif
                                        </p>
                                    </div>
                                    @if ($intervention->type == 'Etude')
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Chargé d’étude:</strong>
                                                <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : ''  }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="display: inline-block; border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut faisabilité:</strong>
                                                @if ($intervention->Faisabilité_du_chantier)
                                                    <span style="display: inline-block; border-radius: 5px; padding:10px; color:#ffffff; background-color:{{ $intervention->Faisabilité_du_chantier == 'Faisable'? 'green':  ($intervention->Faisabilité_du_chantier == 'Infaisable' ? 'red':'orange') }}">{{ $intervention->Faisabilité_du_chantier }} </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__cpard__toggler__content__row__title mr-2">Statut contrat:</strong>
                                                @if ($intervention->Statut_contrat)
                                                    <span style="display: inline-block; border-radius: 5px; padding:10px; color:#ffffff; background-color:{{ $intervention->Statut_contrat == 'Devis Signé'? 'green':  ($intervention->Statut_contrat == 'KO' ? 'red':'orange') }}">{{ $intervention->Statut_contrat }} </span>
                                                @endif
                                            </p>
                                        </div>
                                    @elseif ($intervention->type == 'Pré-Visite Technico-Commercial')
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Prévisiteur Technico-Commercial:</strong>
                                                <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="display: inline-block; border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text d-flex align-items-center">
                                                <strong class="lead__card__toggler__content__row__title flex-shrink-0 mr-2">Statut faisabilité:</strong>
                                                @if ($intervention->Faisabilité_du_chantier)
                                                    <span style="display: inline-block; border-radius: 5px; padding:10px; color:#ffffff; background-color:{{ $intervention->Faisabilité_du_chantier == 'Faisable'? 'green':  ($intervention->Faisabilité_du_chantier == 'Infaisable' ? 'red':'orange') }}">{{ $intervention->Faisabilité_du_chantier }} </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut contrat:</strong>
                                                @if ($intervention->Statut_contrat)
                                                    <span style="display: inline-block; border-radius: 5px; padding:10px; color:#ffffff; background-color:{{ $intervention->Statut_contrat == 'Devis Signé'? 'green':  ($intervention->Statut_contrat == 'KO' ? 'red':'orange') }}">{{ $intervention->Statut_contrat }} </span>
                                                @endif
                                            </p>
                                        </div>
                                    @elseif ($intervention->type == 'DPE')
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Prévisiteur Technico-Commercial:</strong>
                                                <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="display: inline-block; border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div> 
                                    @elseif ($intervention->type == 'Contre Visite Technique')
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Contre Prévisiteur:</strong>
                                                <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="display: inline-block; border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-8">
                                            <p class="lead__card__toggler__content__row__text d-flex align-items-center">
                                                <strong class="lead__card__toggler__content__row__title flex-shrink-0 mr-2">Statut faisabilité:</strong>
                                                @if ($intervention->Faisabilité_du_chantier)
                                                    <span style="display: inline-block; border-radius: 5px; padding:10px; color:#ffffff; background-color:{{ $intervention->Faisabilité_du_chantier == 'Faisable'? 'green':  ($intervention->Faisabilité_du_chantier == 'Infaisable' ? 'red':'orange') }}">{{ $intervention->Faisabilité_du_chantier }} </span>
                                                @endif
                                            </p>
                                        </div>
                                    @elseif ($intervention->type == 'Installation')
                                        @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                            <div class="col-xl-4">
                                                <p class="lead__card__toggler__content__row__text">
                                                    <strong class="lead__card__toggler__content__row__title">Installateur Technique:</strong>
                                                    <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : '' }}</span>
                                                </p>
                                            </div>
                                            <div class="col-xl-4">
                                                <p class="lead__card__toggler__content__row__text">
                                                    <strong class="lead__card__toggler__content__row__title">Chef D’Équipe:</strong>
                                                    <span class="text-dark">{{ $intervention->getUser ? ($intervention->getUser->getTeamLeader ?  $intervention->getUser->getTeamLeader->name : '') : '' }}</span>
                                                </p>
                                            </div>
                                        @endif
                                        <div class="col-xl-8">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div>
                                    @elseif ($intervention->type == 'SAV')
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Technicien SAV:</strong>
                                                <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-8">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Statut SAV:</strong>
                                                <span class="text-dark">{{ $intervention->Statut_SAV }}</span>
                                            </p>
                                        </div>
                                    @elseif ($intervention->type == 'Déplacement')
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Technicien:</strong>
                                                <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div>
                                    @elseif ($intervention->type == 'Prévisite virtuelle')
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Technicien:</strong>
                                                <span class="text-dark">{{ $intervention->getUser ? $intervention->getUser->name : '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-4">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut Planning :</strong>
                                                <span style="border-radius: 5px; padding:10px; @if($intervention->getStatusPlanning) color: {{ $intervention->getStatusPlanning->color }}; background-color: {{ $intervention->getStatusPlanning->background_color }}; @endif">{{ $intervention->Statut_planning }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-8">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title mr-2">Statut faisabilité:</strong>
                                                @if ($intervention->Faisabilité_du_chantier)
                                                    <span style="border-radius: 5px; padding:10px; color:#ffffff; background-color:{{ $intervention->Faisabilité_du_chantier == 'Faisable'? 'green':  ($intervention->Faisabilité_du_chantier == 'Infaisable' ? 'red':'orange') }}">{{ $intervention->Faisabilité_du_chantier }} </span>
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button data-tab="Intervention" data-block="Intervention {{ $project_interventions->count() - $loop->index }}" data-tab-class="intervention__part{{ $intervention->id }}" type="button" data-toggle="collapse" data-target="#leadCardCollapse-intervention{{ $intervention->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('intervention__part'.$intervention->id) }} position-relative ml-auto mr-1 {{ session('intervention__part'.$intervention->id) == 'active' ? 'collapsed':'' }}">
                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                        </button>
                    </div>
                </h2>
                </div>
                <div id="leadCardCollapse-intervention{{ $intervention->id }}" class="collapse {{ session('intervention__part'.$intervention->id) == 'active' ? 'show':'' }}" aria-labelledby="leadCard-intervention{{ $intervention->id }}">
                    <div class="card-body row">
                        <div class="col custom-space">
                            <div class="text-right">
                                <a href="{{ route('project.intervention.pdf', $intervention->id) }}" target="_blank" class="btn-pdf shadow-none"><i class="bi bi-file-earmark-pdf"></i></a>
                            </div>
                            <form action="{{ route('new.project.intervention.update') }}" method="POST">
                                @csrf

                                <input type="hidden" name="id" value="{{ $intervention->id }}">
                                <input type="hidden" name="block_name" value="Intervention {{ $project_interventions->count() - $loop->index }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="Date_intervention{{ $intervention->id }}">Date intervention: <span class="text-danger">*</span></label>
                                            <input type="date" name="Date_intervention" data-error-message="Le champ date de l'intervention est requis" id="Date_intervention{{ $intervention->id }}" value="{{ $intervention->Date_intervention }}" class="flatpickr form-control intervention_disabled shadow-none bg-transparent required_field" placeholder="dd/mm/yyyy">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="">Horaire intervention: <span class="text-danger">*</span></label>
                                            <select name="Horaire_intervention" id="" data-error-message="Champ d'intervention horaire est requis" class="select2_select_option required_field form-control intervention_disabled w-100">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                @foreach ($min_30_interval as $hour)
                                                    <option {{ ($intervention->Horaire_intervention == $hour) ? 'selected':'' }} value="{{ $hour }}">{{ $hour }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Statut_planning{{ $intervention->id }}">Statut planning : <span class="text-danger">*</span></label>
                                            <select name="Statut_planning" data-error-message="Le champ planification des statuts est requis" id="Statut_planning{{ $intervention->id }}" data-id="{{ $intervention->id }}" class="select2_color_option required_field Statut_planning_input form-control intervention_disabled w-100">
                                                <option value=" " selected> {{ __('Select') }}</option>
                                                @foreach ($status_planning as $item)
                                                    <option  data-color="{{ $item->color }}" data-background="{{ $item->background_color }}" {{ ($intervention->Statut_planning == $item->name) ? 'selected':'' }} value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 Statut_planning_wrap{{ $intervention->id }}" style="display: {{ $intervention->Statut_planning == 'Reportée' || $intervention->Statut_planning == 'Annulé' ? '':'none' }}">
                                        <div class="form-group">
                                            <label class="form-label" for="Merci_de_préciser_la_raison{{ $intervention->id }}">Merci de préciser la raison:</label>
                                            <input type="text" name="Merci_de_préciser_la_raison" id="Merci_de_préciser_la_raison{{ $intervention->id }}" value="{{ $intervention->Merci_de_préciser_la_raison }}" class="form-control intervention_disabled shadow-none">
                                        </div>
                                    </div>
                                    @if ($intervention->type == 'Etude')
                                        <div class="{{ (role() == 'telecommercial' || role() == 'telecommercial_externe' || role() == 'sales_manager_externe') ? 'col-12': 'col-md-6'}}">
                                            <div class="form-group">
                                                <label class="form-label" for="Chargé_dapostropheétude{{ $intervention->id }}">Chargé d’étude :<span class="text-danger">*</span></label>
                                                <select name="user_id" id="Chargé_dapostropheétude{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ Chargé d'études est requis">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($charge_etudes as $charge_etude)
                                                        <option {{ ($intervention->user_id == $charge_etude->id) ? 'selected':'' }} value="{{ $charge_etude->id }}">{{ $charge_etude->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Réfèrent_technique{{ $intervention->id }}">Réfèrent technique :</label>
                                                    <select name="Réfèrent_technique" id="Réfèrent_technique{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100" data-error-message="Référez le champ technique est requis">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        @foreach ($technical_referees as $technical_referee)
                                                            <option {{ ($intervention->Réfèrent_technique == $technical_referee->id) ? 'selected':'' }} value="{{ $technical_referee->id }}">{{ $technical_referee->name }}</option>
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
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Adresse travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address2 }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Complément adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Ville des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Ville_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->city }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Département des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                                    @else
                                                        value="{{ getDepartment2($primary_tax->postal_code) }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Google Adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    value="{{ $primary_tax->google_address }}"
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjet{{ $intervention->id }}">Travaux projet : <span class="text-danger">*</span></label>
                                                <select id="travauxProjet{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" data-error-message="Le champ Projet de travaux est requis" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Faisabilité_du_chantier{{ $intervention->id }}">Faisabilité du chantier :</label>
                                                <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantier{{ $intervention->id }}" data-id="{{ $intervention->id }}" class="select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100" data-error-message="Le champ faisabilité du chantier est requis">
                                                    <option value=" " selected>{{ __('Select') }}</option>
                                                        <option data-color="#ffffff" data-background="green" {{ ($intervention->Faisabilité_du_chantier == 'Faisable') ? 'selected':'' }} value="Faisable">Faisable</option>
                                                        <option data-color="#ffffff" data-background="red" {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? 'selected':'' }} value="Infaisable">Infaisable</option>
                                                        <option data-color="#ffffff" data-background="orange" {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? 'selected':'' }} value="Faisable sous condition">Faisable sous condition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Liste_des_travaux_à_réaliser{{ $intervention->id }}">Liste des travaux à réaliser :<span class="text-danger">*</span></label>
                                                <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliser{{ $intervention->id }}" class="form-control intervention_disabled w-100 {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? 'required_field':'' }} required_field__optionFaisable_sous_condition{{ $intervention->id }}" data-error-message="Le champ Liste des travaux à réaliser est requis">{{ $intervention->Liste_des_travaux_à_réaliser }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap_Infaisable{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="infaisable_raisons{{ $intervention->id }}">Raisons <span class="text-danger">*</span></label>
                                                <textarea name="infaisable_raisons" id="infaisable_raisons{{ $intervention->id }}" class="form-control intervention_disabled w-100 {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? 'required_field':'' }} required_field__optionInfaisable{{ $intervention->id }}" data-error-message="Le champ raisons est requis">{{ $intervention->infaisable_raisons }}</textarea>
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
                                                    <option {{ $intervention->Validation_referent_technique == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                    <option {{ $intervention->Validation_referent_technique == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Statut_contrat{{ $intervention->id }}">Statut contrat :</label>
                                                <select name="Statut_contrat" id="Statut_contrat{{ $intervention->id }}" data-id="{{ $intervention->id }}" class="select2_color_option Statut_contrat_input form-control intervention_disabled w-100" data-error-message="Le champ Statut du contrat est requis">
                                                    <option value=" " selected>{{ __('Select') }}</option>
                                                        <option data-color="#ffffff" data-background="green" {{ ($intervention->Statut_contrat == 'Devis Signé') ? 'selected':'' }} value="Devis Signé">Devis Signé</option>
                                                        <option data-color="#ffffff" data-background="orange" {{ ($intervention->Statut_contrat == 'Réflexion') ? 'selected':'' }} value="Réflexion">Réflexion</option>
                                                        <option data-color="#ffffff" data-background="red" {{ ($intervention->Statut_contrat == 'KO') ? 'selected':'' }} value="KO">KO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_contrat__Signé{{ $intervention->id }}" style="display: {{ ($intervention->Statut_contrat == 'Devis Signé') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Devis_signé_le{{ $intervention->id }}">Devis signé le <span class="text-danger">*</span></label>
                                                <input type="date" name="Devis_signé_le" id="Devis_signé_le{{ $intervention->id }}" value="{{ $intervention->Devis_signé_le }}" class="flatpickr form-control intervention_disabled shadow-none bg-transparent  {{ ($intervention->Statut_contrat == 'Devis Signé') ? 'required_field':'' }} required_field__option{{ $intervention->id }}"  data-error-message="Devis signé le champ est requis" placeholder="dd/mm/yyyy">
                                            </div>
                                            <input type="hidden" class="interventionTravauxCount{{ $intervention->id }}" value="{{ $intervention->getTravaux->count() == 0 ? 1 : $intervention->getTravaux->count() }}">
                                            @forelse ($intervention->getTravaux as $i_travaux)
                                            <div class="row intervention_travaux__wrap">
                                                    <input type="hidden" name="number[]" value="{{ $loop->iteration }}">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="intervention_travaux{{ $i_travaux->id.$intervention->id }}">Travaux {{ $loop->iteration }} <span class="text-danger">*</span></label>
                                                            <select name="travaux_id[{{ $loop->iteration }}]" id="intervention_travaux{{ $i_travaux->id.$intervention->id }}" class="select2_select_option form-control intervention_disabled  {{ ($intervention->Statut_contrat == 'Devis Signé') ? 'required_field':'' }} required_field__option{{ $intervention->id }} intervention_travaux_change" data-error-message="Le champ travaux est requis">
                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                @foreach ($bareme_travaux_tags as $t_travaux)
                                                                    <option {{ $i_travaux->travaux_id == $t_travaux->id ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-flex align-items-end">
                                                        <div class="form-group flex-grow-1">
                                                            <label class="form-label" for="travaux">Produit</label>
                                                            <select name="product_id[{{ $loop->iteration }}]" class="select2_select_option form-control w-100 intervention_disabled intervention_travaux_product" data-error-message="Le champ produit est requis">
                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                @if ($i_travaux->getTravaux)
                                                                    @foreach ($i_travaux->getTravaux->getProducts as $product)
                                                                        <option {{ $i_travaux->product_id == $product->id?'selected':'' }} value="{{ $product->id }}">{{ $product->reference }} </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                        </div>
                                                        <div class="form-group ml-3 pb-1">
                                                            @if ($loop->index == 0)
                                                                <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                            @else
                                                                <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-4 d-flex align-items-end">
                                                        <div class="form-group flex-grow-1">
                                                            <label class="form-label" for="Montant_TTC1{{ $i_travaux->id.$intervention->id }}">Montant TTC:</label>
                                                            <input type="hidden" value="{{ $i_travaux->Montant_TTC }}" name="Montant_TTC[{{ $loop->iteration }}]" id="Montant_TTC1{{ $i_travaux->id.$intervention->id }}" class="montant_value">
                                                            <input type="text" class="form-control shadow-none montant_format intervention_disabled" value="{{ EuroFormat($i_travaux->Montant_TTC) }}">
                                                        </div>

                                                    </div> --}}
                                                </div>
                                            @empty
                                            <div class="row intervention_travaux__wrap">
                                                    <input type="hidden" name="number[]" value="1">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="intervention_travaux0{{ $intervention->id }}">Travaux 1 <span class="text-danger">*</span></label>
                                                            <select name="travaux_id[1]" id="intervention_travaux0{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled  {{ ($intervention->Statut_contrat == 'Devis Signé') ? 'required_field':'' }} required_field__option{{ $intervention->id }} intervention_travaux_change" data-error-message="Le champ travaux est requis">
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
                                                            <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-4 d-flex align-items-end">
                                                        <div class="form-group flex-grow-1">
                                                            <label class="form-label" for="adresse_travaux_intervention0{{ $intervention->id }}">Montant TTC:</label>
                                                            <input type="hidden" name="Montant_TTC[1]" id="adresse_travaux_intervention0{{ $intervention->id }}" class="montant_value">
                                                            <input type="text" class="form-control shadow-none montant_format intervention_disabled">
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            @endforelse
                                            <div class="form-group" id="Statut_contrat__Signé_end{{ $intervention->id }}">
                                                <label class="form-label" for="Montant_TTC_Devis0{{ $intervention->id }}">Montant TTC Devis: <span class="text-danger">*</span></label>
                                                <input type="hidden" value="{{ $intervention->Montant_TTC_Devis  }}" name="Montant_TTC_Devis" id="Montant_TTC_Devis0{{ $intervention->id }}" class="montant_value">
                                                <input type="text" class="form-control shadow-none montant_format intervention_disabled  {{ ($intervention->Statut_contrat == 'Devis Signé') ? 'required_field':'' }} required_field__option{{ $intervention->id }}" data-error-message="Montant TTC devis champ est requis" value="{{ EuroFormat($intervention->Montant_TTC_Devis) }}">
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_contrat__Réflexion{{ $intervention->id }}" style="display: {{ ($intervention->Statut_contrat == 'Réflexion') ? '':'none' }}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Réflexion_Raisons{{ $intervention->id }}">Raisons :</label>
                                                        <select name="Réflexion_Raisons" id="Réflexion_Raisons{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($reflection_reasons as $reflection_reason)
                                                                <option {{ ($intervention->Réflexion_Raisons == $reflection_reason->name) ? 'selected':'' }} value="{{ $reflection_reason->name }}">{{ $reflection_reason->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Réflexion_Précisions{{ $intervention->id }}">Précisions :</label>
                                                        <textarea name="Réflexion_Précisions" id="Réflexion_Précisions{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Réflexion_Précisions }} </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_contrat__KO{{ $intervention->id }}" style="display: {{ ($intervention->Statut_contrat == 'KO') ? '':'none' }}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="KO_Raisons{{ $intervention->id }}">Raisons :</label>
                                                        <select name="KO_Raisons" id="KO_Raisons{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($ko_reasons as $ko_reason)
                                                                <option {{ ($intervention->KO_Raisons == $ko_reason->name) ? 'selected':'' }} value="{{ $ko_reason->name }}">{{ $ko_reason->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="KO_Précisions{{ $intervention->id }}">Précisions :</label>
                                                        <textarea name="KO_Précisions" id="KO_Précisions{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->KO_Précisions }} </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="mt-4 d-flex align-items-center">
                                                <label class="form-label mb-0 mr-2">Dossier administratif complet</label>
                                                <div class="multi-option-switch">
                                                    <div class="multi-option-switch__body">
                                                        <input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="{{ $intervention->id }}" id="Dossier_administratif_complet{{ $intervention->id }}--off" name="Dossier_administratif_complet" {{ ($intervention->Dossier_administratif_complet == 'no')? 'checked':'' }}>
                                                        <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="{{ $intervention->id }}" value="n/a" id="Dossier_administratif_complet{{ $intervention->id }}--disabled" name="Dossier_administratif_complet" {{ ($intervention->Dossier_administratif_complet != 'yes' && $intervention->Dossier_administratif_complet != 'no')? 'checked':'' }}>
                                                        <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="{{ $intervention->id }}"  value="yes" id="Dossier_administratif_complet{{ $intervention->id }}--on" name="Dossier_administratif_complet" {{ ($intervention->Dossier_administratif_complet == 'yes')? 'checked':'' }}>
                                                        <span class="multi-option-switch__float-indicator"></span>
                                                        <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Dossier_administratif_complet{{ $intervention->id }}--off">
                                                            <span class="multi-option-switch__label__btn">
                                                                <i class="bi bi-x-lg"></i>
                                                            </span>
                                                        </label>
                                                        <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Dossier_administratif_complet{{ $intervention->id }}--disabled">
                                                            <span class="multi-option-switch__label__btn">
                                                                <i class="bi bi-circle"></i>
                                                            </span>
                                                        </label>
                                                        <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Dossier_administratif_complet{{ $intervention->id }}--on">
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
                                                    <label class="form-label" for="Dossier_administratif_complet{{ $intervention->id }}">Dossier administratif complet</label>
                                                </div>
                                                <select name="Dossier_administratif_complet" data-placeholder="{{ __('Select') }}"  id="Dossier_administratif_complet{{ $intervention->id }}"  class="select2_color_option custom-select shadow-none form-control intervention_disabled Dossier_administratif_complet__input" data-error-message="Le champ dossier administratif complet est requis" data-id="{{ $intervention->id }}">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option  data-color="#000000" data-background="#93C47D" {{ $intervention->Dossier_administratif_complet == 'yes' ? 'selected':'' }} value="yes">Oui</option>
                                                    <option data-color="#000000" data-background="#EA9999" {{ $intervention->Dossier_administratif_complet == 'no' ? 'selected':'' }} value="no">Non</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Dossier_administratif_complet__wrap{{ $intervention->id }}" style="display: {{ $intervention->Dossier_administratif_complet == 'no' ? '':'none'  }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Merci_de_renseigner_les_pièces_manquantes{{ $intervention->id }}">Merci de renseigner les pièces manquantes :</label>
                                                <textarea name="Merci_de_renseigner_les_pièces_manquantes" id="Merci_de_renseigner_les_pièces_manquantes{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Merci_de_renseigner_les_pièces_manquantes }} </textarea>
                                            </div>
                                        </div>
                                    @elseif($intervention->type == 'Pré-Visite Technico-Commercial')
                                        @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Prévisiteur_TechnicohyphenCommercial{{ $intervention->id }}">Prévisiteur Technico-Commercial : <span class="text-danger">*</span></label>
                                                    <select name="user_id" id="Prévisiteur_TechnicohyphenCommercial{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ Prévisiteur Technico-Commercial est requis">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        @foreach ($technical_commercials->where('role_id', 4) as $technical_commercial)
                                                            <option {{ ($intervention->user_id == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Réfèrent_technique{{ $intervention->id }}">Réfèrent technique :</label>
                                                    <select name="Réfèrent_technique" id="Réfèrent_technique{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100" data-error-message="Référez le champ technique est requis">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        @foreach ($technical_referees as $technical_referee)
                                                            <option {{ ($intervention->Réfèrent_technique == $technical_referee->id) ? 'selected':'' }} value="{{ $technical_referee->id }}">{{ $technical_referee->name }}</option>
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
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Adresse travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address2 }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Complément adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Ville des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Ville_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->city }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Département des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                                    @else
                                                        value="{{ getDepartment2($primary_tax->postal_code) }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Google Adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    value="{{ $primary_tax->google_address }}"
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjet{{ $intervention->id }}">Travaux projet :</label>
                                                <select id="travauxProjet{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Faisabilité_du_chantier{{ $intervention->id }}">Faisabilité du chantier :</label>
                                                <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantier{{ $intervention->id }}" data-id="{{ $intervention->id }}" class=" select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100" data-error-message="Le champ faisabilité du chantier est requis">
                                                    <option value=" " selected>{{ __('Select') }}</option>
                                                        <option data-color="#ffffff" data-background="green" {{ ($intervention->Faisabilité_du_chantier == 'Faisable') ? 'selected':'' }} value="Faisable">Faisable</option>
                                                        <option data-color="#ffffff" data-background="red" {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? 'selected':'' }} value="Infaisable">Infaisable</option>
                                                        <option data-color="#ffffff" data-background="orange" {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? 'selected':'' }} value="Faisable sous condition">Faisable sous condition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Liste_des_travaux_à_réaliser{{ $intervention->id }}">Liste des travaux à réaliser :</label>
                                                <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliser{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Liste_des_travaux_à_réaliser }} </textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap_Infaisable{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="infaisable_raisons{{ $intervention->id }}">Raisons</label>
                                                <textarea name="infaisable_raisons" id="infaisable_raisons{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->infaisable_raisons }} </textarea>
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
                                                    <option {{ $intervention->Validation_referent_technique == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                    <option {{ $intervention->Validation_referent_technique == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Statut_contrat{{ $intervention->id }}">Statut contrat :</label>
                                                <select name="Statut_contrat" id="Statut_contrat{{ $intervention->id }}" data-id="{{ $intervention->id }}" class=" select2_color_option Statut_contrat_input form-control intervention_disabled w-100" data-error-message="Le champ statut du contrat est requis">
                                                    <option value=" " selected>{{ __('Select') }}</option>
                                                        <option data-color="#ffffff" data-background="green" {{ ($intervention->Statut_contrat == 'Devis Signé') ? 'selected':'' }} value="Devis Signé">Devis Signé</option>
                                                        <option data-color="#ffffff" data-background="orange" {{ ($intervention->Statut_contrat == 'Réflexion') ? 'selected':'' }} value="Réflexion">Réflexion</option>
                                                        <option data-color="#ffffff" data-background="red" {{ ($intervention->Statut_contrat == 'KO') ? 'selected':'' }} value="KO">KO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_contrat__Signé{{ $intervention->id }}" style="display: {{ ($intervention->Statut_contrat == 'Devis Signé') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Devis_signé_le{{ $intervention->id }}">Devis signé le</label>
                                                <input type="date" name="Devis_signé_le" id="Devis_signé_le{{ $intervention->id }}" value="{{ $intervention->Devis_signé_le }}" class="flatpickr form-control intervention_disabled shadow-none bg-transparent" data-error-message="Devis signé le champ est requis" placeholder="dd/mm/yyyy">
                                            </div>
                                            <input type="hidden" class="interventionTravauxCount{{ $intervention->id }}" value="{{ $intervention->getTravaux->count() == 0 ? 1 : $intervention->getTravaux->count() }}">
                                            @forelse ($intervention->getTravaux as $i_travaux)
                                            <div class="row intervention_travaux__wrap">
                                                    <input type="hidden" name="number[]" value="{{ $loop->iteration }}">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="intervention_travaux{{ $i_travaux->id.$intervention->id }}">Travaux {{ $loop->iteration }}</label>
                                                            <select name="travaux_id[{{ $loop->iteration }}]" id="intervention_travaux{{ $i_travaux->id.$intervention->id }}" class="select2_select_option form-control intervention_disabled   intervention_travaux_change" data-error-message="Le champ travaux est requis">
                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                @foreach ($bareme_travaux_tags as $t_travaux)
                                                                    <option {{ $i_travaux->travaux_id == $t_travaux->id ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 d-flex align-items-end">
                                                        <div class="form-group flex-grow-1">
                                                            <label class="form-label" for="travaux">Produit</label>
                                                            <select name="product_id[{{ $loop->iteration }}]" class="select2_select_option form-control w-100 intervention_disabled   intervention_travaux_product" data-error-message="Le champ produit est requis">
                                                                <option value="" selected>{{ __('Select') }}</option> 
                                                                @if ($i_travaux->getTravaux)
                                                                    @foreach ($i_travaux->getTravaux->getProducts as $product)
                                                                        <option {{ $i_travaux->product_id == $product->id?'selected':'' }} value="{{ $product->id }}">{{ $product->reference }} </option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                        </div>
                                                        <div class="form-group ml-3 pb-1">
                                                            @if ($loop->index == 0)
                                                                <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux__1 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                            @else
                                                                <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                            <div class="row intervention_travaux__wrap">
                                                    <input type="hidden" name="number[]" value="1">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="intervention_travaux0{{ $intervention->id }}">Travaux 1</label>
                                                            <select name="travaux_id[1]" id="intervention_travaux0{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled   intervention_travaux_change" data-error-message="Le champ travaux est requis">
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
                                                            <select name="product_id[1]" class="select2_select_option form-control w-100 intervention_disabled   intervention_travaux_product" data-error-message="Le champ produit est requis">
                                                                <option value="" selected>{{ __('Select') }}</option> 
                                                            </select>
                                                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                        </div>
                                                        <div class="form-group ml-3 pb-1">
                                                            <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux__1 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                            <div class="row" id="Statut_contrat__Signé_end{{ $intervention->id }}">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Montant_TTC_du_devis0{{ $intervention->id }}">Montant TTC du devis:</label>
                                                        <input type="hidden" value="{{ $intervention->Montant_TTC_du_devis  }}" name="Montant_TTC_du_devis" id="Montant_TTC_du_devis0{{ $intervention->id }}" class="montant_value">
                                                        <input type="text" class="form-control shadow-none montant_format intervention_disabled " data-error-message="Le champ montant TTC du devis est requis" value="{{ EuroFormat($intervention->Montant_TTC_du_devis) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Reste_à_charge_devis0{{ $intervention->id }}">Reste à charge devis:</label>
                                                        <input type="hidden" value="{{ $intervention->Reste_à_charge_devis  }}" name="Reste_à_charge_devis" id="Reste_à_charge_devis0{{ $intervention->id }}" class="montant_value">
                                                        <input type="text" class="form-control shadow-none montant_format intervention_disabled " data-error-message="Le champ reste à charge devis est requis" value="{{ EuroFormat($intervention->Reste_à_charge_devis) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Reste_à_charge_client0{{ $intervention->id }}">Reste à charge client:</label>
                                                        <input type="hidden" value="{{ $intervention->Reste_à_charge_client  }}" name="Reste_à_charge_client" id="Reste_à_charge_client0{{ $intervention->id }}" class="montant_value">
                                                        <input type="text" class="form-control shadow-none montant_format intervention_disabled " data-error-message="Le champ reste à charge client est requis" value="{{ EuroFormat($intervention->Reste_à_charge_client) }}">
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                    <h4 class="mb-0 mr-2">Survente</h4>
                                                    <select name="Survente" data-autre-box="Montant_Survente__{{ $intervention->id }}" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        <option {{ $intervention->Survente == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                        <option {{ $intervention->Survente == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 mt-3 Montant_Survente__{{ $intervention->id }}" style="display: {{ $intervention->Survente == 'Oui' ? '':'none' }}">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Montant_survente0{{ $intervention->id }}">Montant survente:</label>
                                                        <input type="hidden" value="{{ $intervention->Montant_survente  }}" name="Montant_survente" id="Montant_survente0{{ $intervention->id }}" class="montant_value">
                                                        <input type="text" class="form-control shadow-none montant_format intervention_disabled" value="{{ EuroFormat($intervention->Montant_survente) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_contrat__Réflexion{{ $intervention->id }}" style="display: {{ ($intervention->Statut_contrat == 'Réflexion') ? '':'none' }}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Réflexion_Raisons{{ $intervention->id }}">Raisons :</label>
                                                        <select name="Réflexion_Raisons" id="Réflexion_Raisons{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($reflection_reasons as $reflection_reason)
                                                                <option {{ ($intervention->Réflexion_Raisons == $reflection_reason->name) ? 'selected':'' }} value="{{ $reflection_reason->name }}">{{ $reflection_reason->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Réflexion_Précisions{{ $intervention->id }}">Précisions :</label>
                                                        <textarea name="Réflexion_Précisions" id="Réflexion_Précisions{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Réflexion_Précisions }} </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_contrat__KO{{ $intervention->id }}" style="display: {{ ($intervention->Statut_contrat == 'KO') ? '':'none' }}">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="KO_Raisons{{ $intervention->id }}">Raisons :</label>
                                                        <select name="KO_Raisons" id="KO_Raisons{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($ko_reasons as $ko_reason)
                                                                <option {{ ($intervention->KO_Raisons == $ko_reason->name) ? 'selected':'' }} value="{{ $ko_reason->name }}">{{ $ko_reason->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="KO_Précisions{{ $intervention->id }}">Précisions :</label>
                                                        <textarea name="KO_Précisions" id="KO_Précisions{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->KO_Précisions }} </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="mt-4 d-flex align-items-center">
                                                <label class="form-label mb-0 mr-2">Dossier administratif complet</label>
                                                <div class="multi-option-switch">
                                                    <div class="multi-option-switch__body">
                                                        <input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="{{ $intervention->id }}" id="Dossier_administratif_complet{{ $intervention->id }}--off" name="Dossier_administratif_complet" {{ ($intervention->Dossier_administratif_complet == 'no')? 'checked':'' }}>
                                                        <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="{{ $intervention->id }}" value="n/a" id="Dossier_administratif_complet{{ $intervention->id }}--disabled" name="Dossier_administratif_complet" {{ ($intervention->Dossier_administratif_complet != 'yes' && $intervention->Dossier_administratif_complet != 'no')? 'checked':'' }}>
                                                        <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input intervention_disabled Dossier_administratif_complet__input" data-id="{{ $intervention->id }}"  value="yes" id="Dossier_administratif_complet{{ $intervention->id }}--on" name="Dossier_administratif_complet" {{ ($intervention->Dossier_administratif_complet == 'yes')? 'checked':'' }}>
                                                        <span class="multi-option-switch__float-indicator"></span>
                                                        <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Dossier_administratif_complet{{ $intervention->id }}--off">
                                                            <span class="multi-option-switch__label__btn">
                                                                <i class="bi bi-x-lg"></i>
                                                            </span>
                                                        </label>
                                                        <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Dossier_administratif_complet{{ $intervention->id }}--disabled">
                                                            <span class="multi-option-switch__label__btn">
                                                                <i class="bi bi-circle"></i>
                                                            </span>
                                                        </label>
                                                        <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Dossier_administratif_complet{{ $intervention->id }}--on">
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
                                                    <label class="form-label" for="Dossier_administratif_complet{{ $intervention->id }}">Dossier administratif complet</label>
                                                </div>
                                                <select name="Dossier_administratif_complet" data-placeholder="{{ __('Select') }}" id="Dossier_administratif_complet{{ $intervention->id }}"  class="select2_color_option custom-select shadow-none form-control intervention_disabled Dossier_administratif_complet__input" data-error-message="Le champ dossier administratif complet est requis" data-id="{{ $intervention->id }}">
                                                    <option value="" selected></option>
                                                    <option  data-color="#000000" data-background="#93C47D" {{ $intervention->Dossier_administratif_complet == 'yes' ? 'selected':'' }} value="yes">Oui</option>
                                                    <option data-color="#000000" data-background="#EA9999" {{ $intervention->Dossier_administratif_complet == 'no' ? 'selected':'' }} value="no">Non</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Dossier_administratif_complet__wrap{{ $intervention->id }}" style="display: {{ $intervention->Dossier_administratif_complet == 'no' ? '':'none'  }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Merci_de_renseigner_les_pièces_manquantes{{ $intervention->id }}">Merci de renseigner les pièces manquantes :</label>
                                                <textarea name="Merci_de_renseigner_les_pièces_manquantes" id="Merci_de_renseigner_les_pièces_manquantes{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Merci_de_renseigner_les_pièces_manquantes }} </textarea>
                                            </div>
                                        </div>
                                    @elseif($intervention->type == 'DPE')
                                        @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Prévisiteur_TechnicohyphenCommercial{{ $intervention->id }}">Prévisiteur Technico-Commercial : <span class="text-danger">*</span></label>
                                                    <select name="user_id" id="Prévisiteur_TechnicohyphenCommercial{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ Prévisiteur Technico-Commercial est requis">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        @foreach ($technical_commercials->where('role_id', 4) as $technical_commercial)
                                                            <option {{ ($intervention->user_id == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
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
                                    @elseif($intervention->type == 'Contre Visite Technique')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Contre_prévisiteur{{ $intervention->id }}">Contre prévisiteur : <span class="text-danger">*</span></label>
                                                <select name="user_id" id="Contre_prévisiteur{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ contre-prévisiteur est requis">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($technical_commercials as $technical_commercial)
                                                        <option {{ ($intervention->user_id == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                @include('admin.intervention_project_info')
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Adresse travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address2 }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Complément adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Ville des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Ville_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->city }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Département des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                                    @else
                                                        value="{{ getDepartment2($primary_tax->postal_code) }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Google Adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    value="{{ $primary_tax->google_address }}"
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjet{{ $intervention->id }}">Travaux projet :</label>
                                                <select id="travauxProjet{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Faisabilité_du_chantier{{ $intervention->id }}">Faisabilité du chantier :</label>
                                                <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantier{{ $intervention->id }}" data-id="{{ $intervention->id }}" class=" select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100" data-error-message="Le champ faisabilité du chantier est requis">
                                                    <option value=" " selected>{{ __('Select') }}</option>
                                                        <option data-color="#ffffff" data-background="green" {{ ($intervention->Faisabilité_du_chantier == 'Faisable') ? 'selected':'' }} value="Faisable">Faisable</option>
                                                        <option data-color="#ffffff" data-background="red" {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? 'selected':'' }} value="Infaisable">Infaisable</option>
                                                        <option data-color="#ffffff" data-background="orange" {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? 'selected':'' }} value="Faisable sous condition">Faisable sous condition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Liste_des_travaux_à_réaliser{{ $intervention->id }}">Liste des travaux à réaliser :</label>
                                                <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliser{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Liste_des_travaux_à_réaliser }} </textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap_Infaisable{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="infaisable_raisons{{ $intervention->id }}">Raisons</label>
                                                <textarea name="infaisable_raisons" id="infaisable_raisons{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->infaisable_raisons }} </textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0 mr-2">Travaux supplémentaires</h4>
                                            <select name="Travaux_supplémentaires" data-autre-box="Montant_Travaux_supplémentaires__{{ $intervention->id }}" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto" data-error-message="Le champ travaux supplémentaires est requis">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option {{ $intervention->Travaux_supplémentaires == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                <option {{ $intervention->Travaux_supplémentaires == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3 Montant_Travaux_supplémentaires__{{ $intervention->id }}"  id="Travaux_supplémentaires__start{{ $intervention->id }}" style="display: {{ $intervention->Travaux_supplémentaires == 'Oui' ? '':'none' }}">
                                            <input type="hidden" class="interventionTravauxCount{{ $intervention->id }}" value="{{ $intervention->getTravaux->count() == 0 ? 1 : $intervention->getTravaux->count() }}">
                                            @forelse ($intervention->getTravaux as $i_travaux)
                                            <div class="row intervention_travaux__wrap">
                                                    <input type="hidden" name="number[]" value="{{ $loop->iteration }}">
                                                    <div class="col-12 d-flex align-items-center">
                                                        <div class="form-group w-100">
                                                            <label class="form-label" for="intervention_travaux{{ $i_travaux->id.$intervention->id }}">Travaux {{ $loop->iteration }}</label>
                                                            <select name="travaux_id[{{ $loop->iteration }}]" id="intervention_travaux{{ $i_travaux->id.$intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                @foreach ($bareme_travaux_tags->where('rank', 2) as $t_travaux)
                                                                    <option {{ $i_travaux->travaux_id == $t_travaux->id ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="ml-3 mt-3">
                                                            @if ($loop->index == 0)
                                                                <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux__2 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                            @else
                                                                <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <input type="hidden" name="number[]" value="1">
                                                <div class="row intervention_travaux__wrap">
                                                    <div class="col-12 d-flex align-items-center">
                                                        <div class="form-group w-100">
                                                            <label class="form-label" for="intervention_travaux0{{ $intervention->id }}">Travaux 1</label>
                                                            <select name="travaux_id[1]" id="intervention_travaux0{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                @foreach ($bareme_travaux_tags->where('rank', 2) as $t_travaux)
                                                                    <option value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="ml-3 mt-3">
                                                            <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux__2 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    @elseif($intervention->type == 'Installation')
                                    @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Installateur_technique{{ $intervention->id }}">Installateur technique : <span class="text-danger">*</span></label>
                                                <select name="user_id" id="Installateur_technique{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ technique d'installation est requis">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($installer_techniques as $installer)
                                                        <option {{ ($intervention->user_id == $installer->id) ? 'selected':'' }} value="{{ $installer->id }}">{{ $installer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Chef_d_équipe{{ $intervention->id }}">Chef d'équipe : <span class="text-danger">*</span></label>
                                                <select name="Chef_d_équipe" id="Chef_d_équipe{{ $intervention->id }}" disabled class="select2_select_option form-control intervention_disabled w-100">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($team_laeders as $team_laeder)
                                                        <option value="disabled" disabled="disabled"  {{ $intervention->getUser ? ($intervention->getUser->team_leader == $team_laeder->id ? 'selected' : '') : ''  }} value="{{ $team_laeder->id }}">{{ $team_laeder->name }}</option>
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
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Adresse travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address2 }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Complément adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Ville des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Ville_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->city }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Département des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                                    @else
                                                        value="{{ getDepartment2($primary_tax->postal_code) }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Google Adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    value="{{ $primary_tax->google_address }}"
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjet{{ $intervention->id }}">Travaux projet :</label>
                                                <select id="travauxProjet{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjetp{{ $intervention->id }}">Produits projet :</label>
                                                <select id="travauxProjetp{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
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
                                                    <h4 class="mb-0 mr-2">Dossier Installation</h4>
                                                    <select name="Dossier_Installation" data-autre-box="Montant_Dossier_Installation__{{ $intervention->id }}" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto" data-error-message="Le champ installation du dossier est requis">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        <option {{ $intervention->Dossier_Installation == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                        <option {{ $intervention->Dossier_Installation == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12 Montant_Dossier_Installation__{{ $intervention->id }}"  style="display: {{ $intervention->Dossier_Installation == 'Oui' ? '':'none' }}">
                                            <div class="row ">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Préparé_par{{ $intervention->id }}">Préparé par</label>
                                                        <select name="Préparé_par" id="Préparé_par{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($users->where('role_id', 11) as $user)
                                                                <option {{ $intervention->Préparé_par == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Date{{ $intervention->id }}">Date </label>
                                                        <input type="date" name="Date" id="Date{{ $intervention->id }}" value="{{ ($intervention->Dossier_Installation == 'Oui') ? \Carbon\Carbon::parse($intervention->Date)->format('Y-m-d'):\Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none bg-transparent 
                                                        @if (!$project->projectSecondTable || ($project->projectSecondTable && $project->projectSecondTable->manual_import == 0))
                                                            data-date-readonly
                                                        @endif
                                                        " placeholder="dd/mm/yyyy">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Statut_Installation{{ $intervention->id }}">Statut Installation :</label>
                                                <select name="Statut_Installation" id="Statut_Installation{{ $intervention->id }}" data-id="{{ $intervention->id }}" class="select2_color_option Statut_Installation_input form-control intervention_disabled w-100" data-error-message="Le champ statut de l'installation est requiss">
                                                    <option value=" " selected >{{ __('Select') }}</option>
                                                    <option data-color="#ffffff" data-background="green" {{ ($intervention->Statut_Installation == 'Terminé - Complet') ? 'selected':'' }} value="Terminé - Complet">Terminé - Complet</option>
                                                    <option data-color="#ffffff" data-background="red" {{ ($intervention->Statut_Installation == 'Non terminé - Incomplet') ? 'selected':'' }} value="Non terminé - Incomplet">Non terminé - Incomplet</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_Installation__complete{{ $intervention->id }}" style="display: {{ ($intervention->Statut_Installation == 'Terminé - Complet') ? '':'none' }}">
                                            <input type="hidden" class="interventionTravauxCount{{ $intervention->id }}" value="{{ $intervention->getTravaux->count() == 0 ? 1 : $intervention->getTravaux->count() }}">
                                            @forelse ($intervention->getTravaux as $i_travaux)
                                            @php
                                                $root_loop = $loop->iteration;
                                            @endphp
                                            <div class="row intervention_travaux__wrap">
                                                <input type="hidden" name="number[]" value="{{ $loop->iteration }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="intervention_travaux0{{ $i_travaux->id.$intervention->id }}">Travaux {{ $loop->iteration }}</label>
                                                        <select name="travaux_id[{{ $loop->iteration }}]"  data-travaux-wrap="interventionTravauxControlProjectWrapd{{ $loop->iteration }}" data-travaux-number="{{ $loop->iteration }}" id="intervention_travaux0{{ $i_travaux->id.$intervention->id }}" class="select2_select_option interventionTravauxChange form-control intervention_disabled  intervention_travaux_change">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($bareme_travaux_tags as $t_travaux)
                                                                <option {{ $i_travaux->travaux_id == $t_travaux->id ? 'selected':'' }} value="{{ $t_travaux->id }}">{{ $t_travaux->travaux }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 d-flex align-items-end">
                                                    <div class="form-group flex-grow-1">
                                                        <label class="form-label" for="travaux">Produit</label>
                                                        <select name="product_id[{{ $loop->iteration }}]" class="select2_select_option form-control w-100 intervention_disabled  intervention_travaux_product">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @if ($i_travaux->getTravaux)
                                                                @foreach ($i_travaux->getTravaux->getProducts as $product)
                                                                    <option {{ $i_travaux->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }} </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                    </div>
                                                    <div class="form-group ml-3 pb-1">
                                                        @if ($loop->index == 0)
                                                            <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux__3 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                        @else
                                                            <button type="button" class="remove-btn remove__intervention_travaux d-inline-flex align-items-center justify-content-center button intervention_disabled">&times;</button>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body" style="background-color: #f2f2f2">
                                                                <div class="row">
                                                                    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                                        <h4 class="mb-0 mr-2">Réception photos Installation <span class="text-danger">*</span></h4>
                                                                        <label class="switch-checkbox switch-checkbox--danger">
                                                                            <input type="hidden"  name="Réception_photos_Installation[{{ $loop->iteration }}]" value="{{ $i_travaux->Réception_photos_Installation }}" class="hiddenInput">
                                                                            <input type="checkbox" {{ ($i_travaux->Réception_photos_Installation == 'yes') ? 'checked':'' }} value="yes" data-autre-box="Réception_photos_Installation__{{ $i_travaux->id.$intervention->id }}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                                            <span class="switch-checkbox__label"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-12 mt-3 Réception_photos_Installation__{{ $i_travaux->id.$intervention->id }}"  style="display: {{ $i_travaux->Réception_photos_Installation == 'yes' ? '':'none' }}">
                                                                        <div class="row ">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="form-label" for="Réception_photos_Installation_Par{{ $i_travaux->id.$intervention->id }}">Par</label>
                                                                                    <select name="Réception_photos_Installation_Par[{{ $loop->iteration }}]" id="Réception_photos_Installation_Par{{ $i_travaux->id.$intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                                        <option value="" selected>{{ __('Select') }}</option>
                                                                                        @foreach ($users as $user)
                                                                                            <option {{ $i_travaux->Réception_photos_Installation_Par == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="form-label" for="Réception_photos_Installation_Le{{ $i_travaux->id.$intervention->id }}">Le </label>
                                                                                    <input type="date" name="Réception_photos_Installation_Le[{{ $loop->iteration }}]" id="Réception_photos_Installation_Le{{ $i_travaux->id.$intervention->id }}" value="{{ ($i_travaux->Réception_photos_Installation == 'yes') ? \Carbon\Carbon::parse($i_travaux->Réception_photos_Installation_Le)->format('Y-m-d'):\Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{-- <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                                        <h4 class="mb-0 mr-2">Contrôle conformité photos <span class="text-danger">*</span></h4>
                                                                        <label class="switch-checkbox switch-checkbox--danger">
                                                                            <input type="hidden"  name="Contrôle_conformité_photos[{{ $loop->iteration }}]" value="{{ $i_travaux->Contrôle_conformité_photos }}" class="hiddenInput">
                                                                            <input type="checkbox" {{ ($i_travaux->Contrôle_conformité_photos == 'Oui') ? 'checked':'' }} value="yes" data-autre-box="Contrôle_conformité_photos__{{ $i_travaux->id.$intervention->id }}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                                            <span class="switch-checkbox__label"></span>
                                                                        </label>
                                                                    </div> --}}
                                                                    <div class="col-12">
                                                                        <div class="form-group"> 
                                                                            <h4 class="mt-2">Contrôle conformité photos</h4>
                                                                            <select name="Contrôle_conformité_photos[{{ $loop->iteration }}]" id="Contrôle_conformité_photos{{ $i_travaux->id.$intervention->id }}" data-autre-box="Contrôle_conformité_photos__{{ $i_travaux->id.$intervention->id }}" data-error-message="Le champ contrôle conformité photos est requis" class="select2_select_option other_field__system2 form-control intervention_disabled">
                                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                                <option {{ $i_travaux->Contrôle_conformité_photos == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                                                <option {{ $i_travaux->Contrôle_conformité_photos == 'Non' ? 'selected':'' }} value="Non">Non</option> 
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 mt-3 Contrôle_conformité_photos__{{ $i_travaux->id.$intervention->id }}"  style="display: {{ $i_travaux->Contrôle_conformité_photos == 'Oui' ? '':'none' }}">
                                                                        <div class="row ">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="form-label" for="Contrôle_conformité_photos_Par{{ $i_travaux->id.$intervention->id }}">Par</label>
                                                                                    <select name="Contrôle_conformité_photos_Par[{{ $loop->iteration }}]" id="Contrôle_conformité_photos_Par{{ $i_travaux->id.$intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                                        <option value="" selected>{{ __('Select') }}</option>
                                                                                        @foreach ($users as $user)
                                                                                            <option {{ $i_travaux->Contrôle_conformité_photos_Par == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label class="form-label" for="Contrôle_conformité_photos_Le{{ $i_travaux->id.$intervention->id }}">Le </label>
                                                                                    <input type="date" name="Contrôle_conformité_photos_Le[{{ $loop->iteration }}]" id="Contrôle_conformité_photos_Le{{ $i_travaux->id.$intervention->id }}" value="{{ ($i_travaux->Contrôle_conformité_photos == 'Oui') ? \Carbon\Carbon::parse($i_travaux->Contrôle_conformité_photos_Le)->format('Y-m-d'):\Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12" id="interventionTravauxControlProjectWrapd{{ $loop->iteration }}">
                                                                            @if ($project_control_photos->where('tag_id', $i_travaux->travaux_id)->count() > 0)
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            @foreach ($project_control_photos->where('tag_id', $i_travaux->travaux_id) as $project_control_photo)
                                                                                                <div class="col-12 mt-3"> 
                                                                                                    <h4 class="mb-0 mr-2">{{ $project_control_photo->name }}</h4>
                                                                                                    {{-- <label class="switch-checkbox">
                                                                                                        <input type="checkbox" {{ \App\Models\CRM\InterventionTravauxProjectControl::where('travaux_id', $i_travaux->id)->where('project_control_id', $project_control_photo->id)->exists() ? 'checked':'' }} name="project_control_photo[{{ $root_loop }}][]" value="{{ $project_control_photo->id }}" class="switch-checkbox__input intervention_disabled">
                                                                                                        <span class="switch-checkbox__label"></span>
                                                                                                    </label> --}}

                                                                                                    <select name="project_control_photo[{{ $root_loop }}][{{ $project_control_photo->id }}]" class="select2_select_option form-control intervention_disabled">
                                                                                                        <option value="" selected>{{ __('Select') }}</option>
                                                                                                        <option {{ \App\Models\CRM\InterventionTravauxProjectControl::where('travaux_id', $i_travaux->id)->where('project_control_id', $project_control_photo->id)->where('value', 'Oui')->exists() ? 'selected':'' }} value="Oui">Oui</option>
                                                                                                        <option {{ \App\Models\CRM\InterventionTravauxProjectControl::where('travaux_id', $i_travaux->id)->where('project_control_id', $project_control_photo->id)->where('value', 'Non')->exists() ? 'selected':'' }} value="Non">Non</option> 
                                                                                                        <option {{ \App\Models\CRM\InterventionTravauxProjectControl::where('travaux_id', $i_travaux->id)->where('project_control_id', $project_control_photo->id)->where('value', 'Non verifiable')->exists() ? 'selected':'' }} value="Non verifiable">Non verifiable</option> 
                                                                                                    </select> 
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @empty
                                                <div class="row intervention_travaux__wrap">
                                                    <input type="hidden" name="number[]" value="1">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="intervention_travaux0{{ $intervention->id }}">Travaux 1</label>
                                                            <select name="travaux_id[1]"  data-travaux-number="1" data-travaux-wrap="interventionTravauxControlProjectWraps{{ $intervention->id }}"   id="intervention_travaux0{{ $intervention->id }}" class="select2_select_option interventionTravauxChange form-control intervention_disabled  intervention_travaux_change">
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
                                                            <select name="product_id[1]" class="select2_select_option form-control w-100 intervention_disabled  intervention_travaux_product">
                                                                <option value="" selected>{{ __('Select') }}</option> 
                                                            </select>
                                                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                        </div>
                                                        <div class="form-group ml-3 pb-1">
                                                            <button type="button" data-id="{{ $intervention->id }}" class="add-btn add__new_intervention_travaux__3 d-inline-flex align-items-center justify-content-center button intervention_disabled">+</button>
                                                        </div>
                                                    </div>
                                                    @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-body" style="background-color: #f2f2f2">
                                                                    <div class="row">
                                                                        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                                            <h4 class="mb-0 mr-2">Réception photos Installation <span class="text-danger">*</span></h4>
                                                                            <label class="switch-checkbox switch-checkbox--danger">
                                                                                <input type="hidden"  name="Réception_photos_Installation[1]" value="no" class="hiddenInput">
                                                                                <input type="checkbox" value="yes" data-autre-box="Réception_photos_Installation__{{ $intervention->id }}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                                                <span class="switch-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-12 mt-3 Réception_photos_Installation__{{ $intervention->id }}"  style="display: none">
                                                                            <div class="row ">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="Réception_photos_Installation_Par{{ $intervention->id }}">Par</label>
                                                                                        <select name="Réception_photos_Installation_Par[1]" id="Réception_photos_Installation_Par{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                                            <option value="" selected>{{ __('Select') }}</option>
                                                                                            @foreach ($users as $user)
                                                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="Réception_photos_Installation_Le{{ $intervention->id }}">Le </label>
                                                                                        <input type="date" name="Réception_photos_Installation_Le[1]" id="Réception_photos_Installation_Le{{ $intervention->id }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        {{-- <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                                            <h4 class="mb-0 mr-2">Contrôle conformité photos <span class="text-danger">*</span></h4>
                                                                            <label class="switch-checkbox switch-checkbox--danger">
                                                                                <input type="hidden"  name="Contrôle_conformité_photos[1]" value="no" class="hiddenInput">
                                                                                <input type="checkbox" value="yes" data-autre-box="Contrôle_conformité_photos__{{ $intervention->id }}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                                                <span class="switch-checkbox__label"></span>
                                                                            </label>
                                                                        </div> --}}
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <h4 class="mt-2">Contrôle conformité photos</h4>
                                                                                <select name="Contrôle_conformité_photos[1]" id="Contrôle_conformité_photos{{ $intervention->id }}" data-autre-box="Contrôle_conformité_photos__{{ $intervention->id }}" data-error-message="Le champ contrôle conformité photos est requis" class="select2_select_option other_field__system2 form-control intervention_disabled">
                                                                                    <option value="" selected>{{ __('Select') }}</option>
                                                                                    <option value="Oui">Oui</option>
                                                                                    <option value="Non">Non</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 mt-3 Contrôle_conformité_photos__{{ $intervention->id }}"  style="display: none">
                                                                            <div class="row ">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="Contrôle_conformité_photos_Par{{ $intervention->id }}">Par</label>
                                                                                        <select name="Contrôle_conformité_photos_Par[1]" id="Contrôle_conformité_photos_Par{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                                            <option value="" selected>{{ __('Select') }}</option>
                                                                                            @foreach ($users as $user)
                                                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label class="form-label" for="Contrôle_conformité_photos_Le{{ $intervention->id }}">Le </label>
                                                                                        <input type="date" name="Contrôle_conformité_photos_Le[1]" id="Contrôle_conformité_photos_Le{{ $intervention->id }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12" id="interventionTravauxControlProjectWraps{{ $intervention->id }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforelse
                                            <div class="card my-3" id="Statut_Installation__start{{ $intervention->id }}">
                                                @if (role() != 'telecommercial' && role() != 'telecommercial_externe' && role() != 'sales_manager_externe')
                                                    <div class="card-body" style="background-color: #f2f2f2">
                                                        <div class="row">
                                                            <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                                <h4 class="mb-0 mr-2">Photos sauvegardés Dropbox<span class="text-danger">*</span></h4>
                                                                <label class="switch-checkbox switch-checkbox--danger">
                                                                    <input type="hidden"  name="Photo_sauvegardé_Dropbox" value="{{ $intervention->Photo_sauvegardé_Dropbox }}" class="hiddenInput">
                                                                    <input type="checkbox" {{ ($intervention->Photo_sauvegardé_Dropbox == 'yes') ? 'checked':'' }} value="yes" data-autre-box="Photo_sauvegardé_Dropbox__{{ $intervention->id }}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                                    <span class="switch-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12 mt-3 Photo_sauvegardé_Dropbox__{{ $intervention->id }}"  style="display: {{ $intervention->Photo_sauvegardé_Dropbox == 'yes' ? '':'none' }}">
                                                                <div class="row ">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Photo_sauvegardé_Dropbox_Par{{ $intervention->id }}">Par</label>
                                                                            <select name="Photo_sauvegardé_Dropbox_Par" id="Photo_sauvegardé_Dropbox_Par{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                                @foreach ($users as $user)
                                                                                    <option {{ $intervention->Photo_sauvegardé_Dropbox_Par == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Photo_sauvegardé_Dropbox_Le{{ $intervention->id }}">Le </label>
                                                                            <input type="date" name="Photo_sauvegardé_Dropbox_Le" id="Photo_sauvegardé_Dropbox_Le{{ $intervention->id }}" value="{{ ($intervention->Photo_sauvegardé_Dropbox == 'yes') ? \Carbon\Carbon::parse($intervention->Photo_sauvegardé_Dropbox_Le)->format('Y-m-d'):\Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                                <h4 class="mb-0 mr-2">Réception dossier installation</h4>
                                                                <label class="switch-checkbox switch-checkbox--danger">
                                                                    <input type="hidden"  name="Reception_dossier_installation" value="{{ $intervention->Reception_dossier_installation }}" class="hiddenInput">
                                                                    <input type="checkbox" value="yes" {{ ($intervention->Reception_dossier_installation == 'yes') ? 'checked':'' }} data-autre-box="Reception_dossier_installation__{{ $intervention->id }}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                                    <span class="switch-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12 mt-3 Reception_dossier_installation__{{ $intervention->id }}"  style="display: {{ $intervention->Reception_dossier_installation == 'yes' ? '':'none' }}">
                                                                <div class="row ">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Reception_dossier_installation_Par{{ $intervention->id }}">Par</label>
                                                                            <select name="Reception_dossier_installation_Par" id="Reception_dossier_installation_Par{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                                                <option value="" selected>{{ __('Select') }}</option>
                                                                                @foreach ($users as $user)
                                                                                    <option {{ $intervention->Reception_dossier_installation_Par == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Reception_dossier_installation_Le{{ $intervention->id }}">Le </label>
                                                                            <input type="date" name="Reception_dossier_installation_Le" id="Reception_dossier_installation_Le{{ $intervention->id }}" value="{{ ($intervention->Reception_dossier_installation == 'yes') ? \Carbon\Carbon::parse($intervention->Reception_dossier_installation_Le)->format('Y-m-d'):\Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none data-date-readonly" placeholder="dd/mm/yyyy">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                                                <h4 class="mb-0 mr-2">Paiement d’un reste à charge ?<span class="text-danger">*</span></h4>
                                                                <label class="switch-checkbox">
                                                                    <input type="hidden"  name="Paiement_d_un_reste_à_charge" value="{{ $intervention->Paiement_d_un_reste_à_charge }}" class="hiddenInput">
                                                                    <input type="checkbox" value="yes" {{ ($intervention->Paiement_d_un_reste_à_charge == 'yes') ? 'checked':'' }} data-autre-box="Paiement_d_un_reste_à_charge__{{ $intervention->id }}" class="checkboxChange switch-checkbox__input other_field__system intervention_disabled">
                                                                    <span class="switch-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="col-12 mt-3 Paiement_d_un_reste_à_charge__{{ $intervention->id }}"  style="display: {{ $intervention->Paiement_d_un_reste_à_charge == 'yes' ? '':'none' }}">
                                                                <div class="row ">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Montant0{{ $intervention->id }}">Montant :</label>
                                                                            <input type="hidden" value="{{ $intervention->Montant  }}" name="Montant" id="Montant0{{ $intervention->id }}" class="montant_value">
                                                                            <input type="text" class="form-control shadow-none montant_format intervention_disabled" value="{{ EuroFormat($intervention->Montant) }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="form-label" for="Moyens_de_paiement{{ $intervention->id }}">Moyens de paiement</label>
                                                                            <select name="Moyens_de_paiement[]" id="Moyens_de_paiement{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled" multiple>
                                                                                <option {{ str_contains($intervention->Moyens_de_paiement, 'Chèque') ?  'selected':'' }} value="Chèque">Chèque</option>
                                                                                <option {{ str_contains($intervention->Moyens_de_paiement, 'Virement') ?  'selected':'' }} value="Virement">Virement</option>
                                                                                <option {{ str_contains($intervention->Moyens_de_paiement, 'Autre') ?  'selected':'' }} value="Autre">Autre</option>
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
                                        <div class="col-12 Statut_Installation__incomplete{{ $intervention->id }}" style="display: {{ ($intervention->Statut_Installation == 'Non terminé - Incomplet') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Raisons{{ $intervention->id }}">Raisons :</label>
                                                <textarea name="Raisons" id="Raisons{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Raisons }} </textarea>
                                            </div>
                                        </div>
                                    @elseif($intervention->type == 'SAV')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Technicien_SAV{{ $intervention->id }}">Technicien SAV : <span class="text-danger">*</span></label>
                                                <select name="user_id" id="Technicien_SAV{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champs technicien SAV est requis">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($installers as $installer)
                                                        <option {{ ($intervention->user_id == $installer->id) ? 'selected':'' }} value="{{ $installer->id }}">{{ $installer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                @include('admin.intervention_project_info')
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Adresse travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address2 }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Complément adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Ville des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Ville_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->city }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Département des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                                    @else
                                                        value="{{ getDepartment2($primary_tax->postal_code) }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Google Adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    value="{{ $primary_tax->google_address }}"
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjet{{ $intervention->id }}">Travaux projet :</label>
                                                <select id="travauxProjet{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjetp{{ $intervention->id }}">Produits projet :</label>
                                                <select id="travauxProjetp{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($products as $product)
                                                        @if ($project->getTagProduct()->where('product_id', $product->id)->exists())
                                                            <option selected value="disabled" disabled="disabled" value="{{ $product->id }}">{{ $product->reference }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Statut_SAV{{ $intervention->id }}">Statut SAV :</label>
                                                <select name="Statut_SAV" id="Statut_SAV{{ $intervention->id }}" data-id="{{ $intervention->id }}" class="select2_color_option Statut_SAV_input form-control intervention_disabled w-100" data-error-message="Le champs statut SAV est requis">
                                                    <option value=" " selected></option>
                                                    <option data-color="#ffffff" data-background="green" {{ ($intervention->Statut_SAV == 'RESOLU') ? 'selected':'' }} value="RESOLU">RESOLU</option>
                                                    <option data-color="#ffffff" data-background="red" {{ ($intervention->Statut_SAV == 'NON RESOLU') ? 'selected':'' }} value="NON RESOLU">NON RESOLU</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Statut_SAV_wrap{{ $intervention->id }}" style="display: {{ ($intervention->Statut_SAV == 'NON RESOLU') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Raisons{{ $intervention->id }}">Raisons :</label>
                                                <textarea name="Raisons" id="Raisons{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Raisons }} </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3 d-flex align-items-center">
                                            <h4 class="mb-0 mr-2">Réception photos SAV</h4>
                                            {{-- <label class="switch-checkbox">
                                                <input type="checkbox" name="Reception_photo_SAV" value="yes" data-autre-box="Montant_Reception_photo_SAV__{{ $intervention->id }}" class="switch-checkbox__input other_field__system intervention_disabled"
                                                {{ ($intervention->Reception_photo_SAV == 'yes') ? 'checked':'' }}>
                                                <span class="switch-checkbox__label"></span>
                                            </label> --}}
                                            <select name="Reception_photo_SAV" data-autre-box="Montant_Reception_photo_SAV__{{ $intervention->id }}" class="other_field__system2 custom-select shadow-none intervention_disabled w-auto" data-error-message="Le champ SAV des photos de réception est requis">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option {{ $intervention->Reception_photo_SAV == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                <option {{ $intervention->Reception_photo_SAV == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-3 d-flex align-items-center">
                                            <h4 class="mb-0 mr-2">Réception attestation SAV</h4>
                                            {{-- <label class="switch-checkbox">
                                                <input type="checkbox" name="Réception_attestation_SAV" value="yes" class="switch-checkbox__input intervention_disabled"
                                                {{ ($intervention->Réception_attestation_SAV == 'yes') ? 'checked':'' }}>
                                                <span class="switch-checkbox__label"></span>
                                            </label> --}}
                                            <select name="Réception_attestation_SAV" class="custom-select shadow-none intervention_disabled w-auto" data-error-message="Le champ SAV de l'attestation de réception est requis">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option {{ $intervention->Réception_attestation_SAV == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                <option {{ $intervention->Réception_attestation_SAV == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3 Montant_Reception_photo_SAV__{{ $intervention->id }}"  style="display: {{ $intervention->Reception_photo_SAV == 'Oui' ? '':'none' }}">
                                            <div class="row ">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Par{{ $intervention->id }}">Par</label>
                                                        <select name="Par" id="Par{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            @foreach ($users as $user)
                                                                <option {{ $intervention->Par == $user->id ? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Le{{ $intervention->id }}">Le </label>
                                                        <input type="date" name="Le" id="Le{{ $intervention->id }}" value="{{ ($intervention->Reception_photo_SAV == 'Oui') ? \Carbon\Carbon::parse($intervention->Le)->format('Y-m-d'):\Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control intervention_disabled shadow-none bg-transparent data-date-readonly" placeholder="dd/mm/yyyy">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($intervention->type == 'Déplacement')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Technicien{{ $intervention->id }}">Technicien : <span class="text-danger">*</span></label>
                                                <select name="user_id" id="Technicien{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ technicien est requis">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($technical_commercials as $technical_commercial)
                                                        @if ($technical_commercial->role_id == 1)
                                                            @continue
                                                        @endif
                                                        <option {{ ($intervention->user_id == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                @include('admin.intervention_project_info')
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Adresse travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address2 }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Complément adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Ville des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Ville_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->city }}"
                                                    @endif
                                                @endif
                                                 class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Département des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                                    @else
                                                        value="{{ getDepartment2($primary_tax->postal_code) }}"
                                                    @endif
                                                @endif
                                                 class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Google Adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    value="{{ $primary_tax->google_address }}"
                                                @endif
                                                 class="form-control shadow-none">
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Précisions_déplacement{{ $intervention->id }}">Précisions déplacement : <span class="text-danger">*</span></label>
                                                <textarea name="Précisions_déplacement" id="Précisions_déplacement{{ $intervention->id }}" class="form-control intervention_disabled w-100 required_field" data-error-message="Le champ précisions déplacement est requis">{{ $intervention->Précisions_déplacement }} </textarea>
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjet{{ $intervention->id }}">Travaux projet :</label>
                                                <select id="travauxProjet{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjetp{{ $intervention->id }}">Produits projet :</label>
                                                <select id="travauxProjetp{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($products as $product)
                                                        @if ($project->getTagProduct()->where('product_id', $product->id)->exists())
                                                            <option selected value="disabled" disabled="disabled" value="{{ $product->id }}">{{ $product->reference }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                            <h4 class="mb-0 mr-2">Mission accomplie</h4>
                                            {{-- <label class="switch-checkbox">
                                                <input type="checkbox" name="Mission_accomplie" value="yes" class="switch-checkbox__input intervention_disabled"
                                                {{ ($intervention->Mission_accomplie == 'yes') ? 'checked':'' }}>
                                                <span class="switch-checkbox__label"></span>
                                            </label> --}}
                                            <select name="Mission_accomplie" class="custom-select shadow-none intervention_disabled w-auto" data-error-message="Le champ mission accomplie est requis">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option {{ $intervention->Mission_accomplie == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                <option {{ $intervention->Mission_accomplie == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                            </select>
                                        </div>
                                    @elseif($intervention->type == 'Prévisite virtuelle')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Technicien{{ $intervention->id }}">Technicien : <span class="text-danger">*</span></label>
                                                <select name="user_id" id="Technicien{{ $intervention->id }}" class="select2_select_option form-control intervention_disabled w-100 required_field" data-error-message="Le champ technicien est requis">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach ($technical_commercials as $technical_commercial)
                                                        <option {{ ($intervention->user_id == $technical_commercial->id) ? 'selected':'' }} value="{{ $technical_commercial->id }}">{{ $technical_commercial->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                @include('admin.intervention_project_info')
                                            </div>
                                        </div>
                                        {{-- <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Adresse travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address2 }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Complément adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->address }}"
                                                    @endif
                                                @endif
                                                class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Ville des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ $primary_tax->Ville_Travaux }}"
                                                    @else
                                                        value="{{ $primary_tax->city }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Département des travaux:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    @if ($primary_tax->same_as_work_address == 'no')
                                                        value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                                    @else
                                                        value="{{ getDepartment2($primary_tax->postal_code) }}"
                                                    @endif
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Google Adresse:</label>
                                                <input type="text" disabled
                                                @if ($primary_tax)
                                                    value="{{ $primary_tax->google_address }}"
                                                @endif
                                                 class="form-control intervention_disabled shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="travauxProjet{{ $intervention->id }}">Travaux projet :</label>
                                                <select id="travauxProjet{{ $intervention->id }}" disabled class="select2_select_option custom-select shadow-none form-control intervention_disabled" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="Faisabilité_du_chantier{{ $intervention->id }}">Faisabilité du chantier :</label>
                                                <select name="Faisabilité_du_chantier" id="Faisabilité_du_chantier{{ $intervention->id }}" data-id="{{ $intervention->id }}" class=" select2_color_option Faisabilité_du_chantier_input form-control intervention_disabled w-100" data-error-message="Le champ faisabilité du chantier est requis">
                                                    <option value=" " selected>{{ __('Select') }}</option>
                                                        <option data-color="#ffffff" data-background="green" {{ ($intervention->Faisabilité_du_chantier == 'Faisable') ? 'selected':'' }} value="Faisable">Faisable</option>
                                                        <option data-color="#ffffff" data-background="red" {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? 'selected':'' }} value="Infaisable">Infaisable</option>
                                                        <option data-color="#ffffff" data-background="orange" {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? 'selected':'' }} value="Faisable sous condition">Faisable sous condition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Faisable sous condition') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="Liste_des_travaux_à_réaliser{{ $intervention->id }}">Liste des travaux à réaliser :</label>
                                                <textarea name="Liste_des_travaux_à_réaliser" id="Liste_des_travaux_à_réaliser{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Liste_des_travaux_à_réaliser }} </textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 Faisabilité_du_chantier_wrap_Infaisable{{ $intervention->id }}" style="display: {{ ($intervention->Faisabilité_du_chantier == 'Infaisable') ? '':'none' }}">
                                            <div class="form-group">
                                                <label class="form-label" for="infaisable_raisons{{ $intervention->id }}">Raisons</label>
                                                <textarea name="infaisable_raisons" id="infaisable_raisons{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->infaisable_raisons }} </textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="Observationsss{{ $intervention->id }}">Observations :</label>
                                            <textarea name="Observations" id="Observationsss{{ $intervention->id }}" class="form-control intervention_disabled w-100">{{ $intervention->Observations }} </textarea>
                                        </div>
                                    </div>
                                    @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "intervention__$intervention->type"), 'custom_field_data' => $intervention->custom_field_data, 'disabled_class' => 'intervention_disabled'])
                                    @if ($user_actions->where('module_name', 'collapse_intervention')->where('action_name', 'edit')->first() || $role == 's_admin')
                                        <div class="col-12 text-center ">
                                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 formSubmitButton">
                                                {{ __('Submit') }}
                                            </button>
                                            @if ($role == 's_admin')
                                                <button type="button" data-collapse="intervention__{{ $intervention->type }}" data-callapse_active="intervention_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 intervention_disabled">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
     @endif
</div>

{{-- Intervention create modal --}}
<div class="modal modal--aside fade" id="interventionCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">Créer une intervention </h1>
                <form action="{{ route('project.intervention.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label for="#">Sélectionner une intervention</label>
                        <select class="shadow-none form-control" name="type" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            <option value="Etude">Etude</option>
                            <option value="Pré-Visite Technico-Commercial">Pré-Visite Technico-Commercial</option>
                            <option value="Contre Visite Technique">Contre Visite Technique</option>
                            <option value="Installation">Installation</option>
                            <option value="SAV">SAV</option>
                            <option value="Prévisite virtuelle">Prévisite virtuelle</option>
                            <option value="Déplacement">Déplacement</option>
                            <option value="DPE">DPE</option>
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


{{-- Prestation Bulk Delete Modal  --}}
<div class="modal modal--aside fade" id="InterventionDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                <form action="{{ route('project.intervention.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="intervention_id">
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