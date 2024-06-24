@php 
    $offices = \App\Models\CRM\Auditor::all();
    $status_audits = \App\Models\CRM\AuditStatus::all();
    $administrarif_role_id  = \App\Models\CRM\Role::where('category_id', 3)->pluck('id');
    $suvbention_gestionnaires = \App\Models\User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $administrarif_role_id)->get();
    $report_results = \App\Models\CRM\ReportResult::all();
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get();
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();  
@endphp
<div class="accordion" id="leadAccordionAudit">
    @if ($user_actions->where('module_name', 'collapse_audit')->where('action_name', 'edit')->first() || $role == 's_admin')
        <button class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#auditCreateModal">
            <span class="mr-2"></span>
            + Nouvel Audit
        </button>
     @else
        <button type="button" class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">
            <span class="novecologie-icon-lock py-1"></span>
        </button>
    @endif
    @if ($user_actions->where('module_name', 'collapse_audit')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_audit')->where('action_name', 'edit')->first() || $role == 's_admin')
    @foreach ($project->getAudit as $audit)
        <div class="card lead__card border-0">
            <div class="card-header bg-transparent border-0 p-0" id="leadCard-Audit{{ $audit->id }}">
            <h2 class="mb-0">
                @if ($user_actions->where('module_name', 'collapse_audit')->where('action_name', 'delete')->first() || $role == 's_admin')
                    <button type="button" class="btn btn-icon shadow-none top-right auditDeleteButton" data-id="{{ $audit->id }}"><i class="bi bi-trash3"></i></button>
                @endif
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                    <div class="lead__card__toggler__content w-100">
                        <h3 class="lead__card__toggler__content__heading">Audit {{ $project->getAudit->count() - $loop->index }}</h3>
                        <div class="lead__card__toggler__content__row">
                            <div class="row">
                                <div class="col-xl-6">
                                    <p class="lead__card__toggler__content__row__text">
                                        <strong class="lead__card__toggler__content__row__title">Audit réalisé :</strong>
                                        <span class="text-dark">{{ $audit->audit_type }}</span>
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p class="lead__card__toggler__content__row__text">
                                        <strong class="lead__card__toggler__content__row__title">Statut audit :</strong>
                                        <span class="text-dark">{{ $audit->getStatus->name ?? '' }}</span>
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p class="lead__card__toggler__content__row__text">
                                        <strong class="lead__card__toggler__content__row__title">Bureau étude :</strong>
                                        <span class="text-dark">{{ $audit->office->company_name ?? '' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <span class="d-block ml-auto">
                        <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                    </span> --}}
                    <button data-tab="Audit Energetique" data-block="Audit {{ $loop->iteration }}" data-tab-class="audit__part{{ $audit->id }}" type="button" data-toggle="collapse" data-target="#leadCardCollapse-audit{{ $audit->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('audit__part'.$audit->id) }} position-relative ml-auto mr-1 {{ session('audit__part'.$audit->id) == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
                </div>
            </h2>
            </div>
            <div id="leadCardCollapse-audit{{ $audit->id }}" class="collapse {{ session('audit__part'.$audit->id) == 'active' ? 'show':'' }}" aria-labelledby="leadCard-Audit{{ $audit->id }}">
                <div class="card-body row">
                    <div class="col custom-space">
                        <form action="{{ route('project.audit.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="audit_type">Audit réalisé: <span class="text-danger">*</span></label>
                                        <input type="hidden" name="id" value="{{ $audit->id }}">
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <select name="audit_type" id="audit_type" class="select2_select_option form-control audit_disabled w-100 required_field" data-error-message="Le champ audit réalisé est requis">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ ($audit->audit_type == 'Avant travaux')? 'selected':'' }} value="Avant travaux">Avant travaux</option>
                                            <option {{ ($audit->audit_type == 'Après travaux')? 'selected':'' }} value="Après travaux">Après travaux</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="study_office">Bureau étude: <span class="text-danger">*</span></label>
                                        <select name="study_office" id="study_office" class="select2_select_option form-control audit_disabled w-100 required_field" data-error-message="Le champ bureau étude est requis">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($offices as $office)
                                                <option {{ ($audit->study_office == $office->id)? 'selected':'' }} value="{{ $office->id }}">{{ $office->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="audit_status{{ $audit->id }}">Statut audit : <span class="text-danger">*</span></label>
                                        <select name="audit_status" data-placeholder="{{ __('Select') }}" id="audit_status{{ $audit->id }}" class="select2_color_option form-control audit_disabled w-100 required_field" data-error-message="Le champ d'audit des statuts est requis">
                                            <option value="" selected></option>
                                            @foreach ($status_audits as $audit_status)
                                                <option data-color="{{ $audit_status->text_color ?? '#000000' }}" data-background="{{ $audit_status->background_color ?? '#ffffff' }}" {{ ($audit->audit_status == $audit_status->id)? 'selected':'' }} value="{{ $audit_status->id }}">{{ $audit_status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="audit_user">Audit réalisé par :</label>
                                        <select name="audit_user" id="audit_user" class="select2_select_option form-control audit_disabled w-100" data-error-message="Le champ  audit réalisé par est requis">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($suvbention_gestionnaires as $user)
                                            <option {{ ($audit->audit_user == $user->id)? 'selected':'' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="release_date">Audit réalisé le :</label>
                                        <input type="date" name="release_date" id="release_date" value="{{ $audit->release_date }}" class="flatpickr form-control audit_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="report_result">Résultat du rapport audit :</label>
                                        <select name="report_result" id="report_result" class="select2_select_option form-control audit_disabled w-100">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($report_results as $report_result)
                                                <option {{ ($audit->report_result == $report_result->id)? 'selected':'' }} value="{{ $report_result->id }}">{{ $report_result->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Audit_envoyé_le{{ $audit->id }}">Audit envoyé le : <span class="text-danger">*</span></label>
                                        <input type="date" name="Audit_envoyé_le" id="Audit_envoyé_le{{ $audit->id }}" value="{{ $audit->Audit_envoyé_le }}" class="flatpickr form-control audit_disabled shadow-none bg-transparent  required_field" data-error-message="Le champ auditer le envoyé est obligatoire" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Audit_reçu_le{{ $audit->id }}">Audit reçu le :</label>
                                        <input type="date" name="Audit_reçu_le" id="Audit_reçu_le{{ $audit->id }}" value="{{ $audit->Audit_reçu_le }}" class="flatpickr form-control audit_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Scénario_choisi{{ $audit->id }}">Scénario choisi :</label>
                                        <select name="Scénario_choisi" id="Scénario_choisi{{ $audit->id }}" class="select2_select_option form-control audit_disabled w-100">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ ($audit->Scénario_choisi == 'Scénario 1')? 'selected':'' }} value="Scénario 1">Scénario 1</option>
                                            <option {{ ($audit->Scénario_choisi == 'Scénario 2')? 'selected':'' }} value="Scénario 2">Scénario 2</option>
                                            <option {{ ($audit->Scénario_choisi == 'Scénario 3')? 'selected':'' }} value="Scénario 3">Scénario 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Travaux_du_scénario_choisi{{ $audit->id }}">Travaux du scénario choisi :</label>
                                        <select  name="Travaux_du_scénario_choisi[]" id="Travaux_du_scénario_choisi{{ $audit->id }}" class="select2_select_option form-control audit_disabled w-100" multiple>
                                            @foreach ($bareme_travaux_tags->where('rank', 1) as $travaux)
                                                <option {{ $audit->getTravaux->where('id', $travaux->id)->first() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Cumac_du_scénario_choisi{{ $audit->id }}">Cumac du scénario choisi</label> 
                                        <input type="number" class="form-control shadow-none audit_disabled" value="{{ $audit->Cumac_du_scénario_choisi }}" name="Cumac_du_scénario_choisi" id="Cumac_du_scénario_choisi{{ $audit->id }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Prime_CEE_du_scénario_choisi{{ $audit->id }}">Prime CEE du scénario choisi </label>
                                        <input type="hidden" value="{{ $audit->Prime_CEE_du_scénario_choisi }}" name="Prime_CEE_du_scénario_choisi" class="montant_value">
                                        <input type="text" id="Prime_CEE_du_scénario_choisi{{ $audit->id }}" class="form-control shadow-none montant_format audit_disabled" value="{{ EuroFormat($audit->Prime_CEE_du_scénario_choisi) }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="report_reference">Référence du rapport :</label>
                                        <textarea name="report_reference" id="report_reference" class="form-control audit_disabled shadow-none">{{ $audit->report_reference }}</textarea>
                                    </div>
                                </div>
                                 <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="Observations">Observations :</label>
                                        <textarea name="Observations" id="Observations" class="form-control audit_disabled shadow-none">{{ $audit->Observations }}</textarea>
                                    </div>
                                </div>
                                @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "audit__collapse"), 'custom_field_data' => $audit->custom_field_data, 'disabled_class' => 'audit_disabled'])
                                @if ($user_actions->where('module_name', 'collapse_audit')->where('action_name', 'edit')->first() || $role == 's_admin')
                                    <div class="col-12 text-center ">
                                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 formSubmitButton">
                                            {{ __('Submit') }}
                                        </button>
                                        @if ($role == 's_admin')
                                            <button type="button" data-collapse="audit__collapse" data-callapse_active="audit_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 audit_disabled">
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



{{-- Subvention create modal --}}
<div class="modal modal--aside fade" id="auditCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>Etes-vous sûr de vouloir créer un audit énergétique ?</span>
                <form action="{{ route('project.audit.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                            {{ ('Non') }}
                        </button>
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                            {{ __('Oui') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--  Audit Delete Modal  --}}
<div class="modal modal--aside fade" id="AuditDeleteButton" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                <form action="{{ route('project.audit.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="audit_deleted_id">
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