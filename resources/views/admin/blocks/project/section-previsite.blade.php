@php 
    $document_controls = \App\Models\CRM\DocumentControl::orderBy('order', 'asc')->get();
    $role_ids = \App\Models\CRM\Role::whereIn('category_id', [3,4])->pluck('id')->toArray();
    $users = \App\Models\User::whereIn('role_id', $role_ids)->where('deleted_status', 'no')->where('status', 'active')->get();
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();   
    $projectDocumentControl = $project->projectDocumentControl;
@endphp

<div class="accordion" id="leadAccordion4">
    @if ($user_actions->where('module_name', 'collapse_intervention_prev')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_intervention_prev')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-11">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="intervention-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
            Contrôles des pièces
                <button data-tab="Pièces Administratives" data-block="Contrôles des pièces" data-tab-class="intervention_prev__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-11" aria-expanded="false" class="d-flex border-0 edit-toggler {{ session('intervention_prev__part') }} edit-toggler--lock__access position-relative ml-auto mr-1 {{ session('intervention_prev__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-11" class="collapse  {{ session('intervention_prev__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-11">
        <div class="card-body row">
            <div class="col custom-space">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-body d-flex align-items-center pl-0">
                                <select name="Pièces_manquante" id="Pièces_manquante" data-autre-box="CompteEmailWrap" class="other_field__system2 custom-select shadow-none intervention_prev_disabled w-auto">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $project->Pièces_manquante == 'OUI' ? 'selected':'' }} value="OUI">OUI</option>
                                    <option {{ $project->Pièces_manquante == 'NON' ? 'selected':'' }} value="NON">NON</option>
                                </select>
                                <span class="mb-0 ml-2">Pièces manquante</span>
                            </div>
                        </div>
                    </div>
                    @foreach ($document_controls as $document)
                        <div class="col-12 {{ $loop->first ? 'mt-2':'mt-4' }}">
                            <div class="card" style="background-color: #f2f2f2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 d-flex align-items-center">
                                            <label class="switch-checkbox">
                                                <input type="checkbox" data-autre-box="documentControle{{ $document->id }}" data-id="{{ $document->id }}" class="switch-checkbox__input controleDocumentChecbox intervention_prev_disabled other_field__system" {{ $projectDocumentControl->where('document_id', $document->id)->first() ? 'checked':'' }} name="Report_du_crédit" id="Report_du_crédit">
                                                <span class="switch-checkbox__label"></span>
                                            </label>
                                            <span class="mb-0 ml-2">{{ $document->name }}</span>
                                        </div>
                                        <div class="col-12 mt-3 documentControle{{ $document->id }}" style="display: {{ $projectDocumentControl->where('document_id', $document->id)->first() ? '':'none' }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Réceptionné_le{{ $document->id }}">Réceptionné le</label>
                                                        <input type="date" id="Réceptionné_le{{ $document->id }}" disabled value="{{ $projectDocumentControl->where('document_id', $document->id)->first() ? $projectDocumentControl->where('document_id', $document->id)->first()->Réceptionné_le : \Carbon\Carbon::now()->format('Y-m-d') }}" class="flatpickr form-control shadow-none intervention_prev_disabled">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="Réceptionné_par{{ $document->id }}">Réceptionné par</label>
                                                        <select id="Réceptionné_par{{ $document->id }}" class="select2_select_option form-control intervention_prev_disabled w-100">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                        @foreach ($users as $user)
                                                            <option {{ $projectDocumentControl->where('document_id', $document->id)->first() ? ($projectDocumentControl->where('document_id', $document->id)->first()->Réceptionné_par == $user->id ? 'selected':'') : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label class="form-label" for="Contrôles_des_pièces_observation">Observation</label>
                            <textarea name="Contrôles_des_pièces_observation" id="Contrôles_des_pièces_observation" class="form-control shadow-none intervention_prev_disabled">{{ $project->Contrôles_des_pièces_observation }}</textarea>
                        </div>
                    </div>
                    @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'collapse__controle_de'), 'custom_field_data' => $project->controle_des_custom_field_data, 'class' => 'controle_de__custom_field', 'disabled_class' => 'intervention_prev_disabled'])
                    @if ($user_actions->where('module_name', 'collapse_intervention_prev')->where('action_name', 'edit')->first() || $role == 's_admin')
                        <div class="col-12 text-center ">
                            <button type="button" id="controleDocumentSubmitButton" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 intervention_prev_disabled">
                                {{ __('Submit') }}
                            </button>
                            @if ($role == 's_admin')
                                <button type="button" data-collapse="collapse__controle_de" data-callapse_active="pieces_administratives_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 intervention_prev_disabled">
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