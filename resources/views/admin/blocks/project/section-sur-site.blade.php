@php
    $control_sur_sites = \App\Models\CRM\ControleSurSite::where('project_id', $project->id)->orderBy('id', 'desc')->get(); 
    $control_offices = \App\Models\CRM\Control::all(); 
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get(); 
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();
    $deals = \App\Models\CRM\Deal::all();   
    $schedules30 = \Carbon\CarbonInterval::minutes('30')->toPeriod('00:00', '24:00'); 
    $min_30_interval = [];
    foreach($schedules30 as $d){
        $min_30_interval[] = \Carbon\Carbon::parse($d)->format("G").'h'.\Carbon\Carbon::parse($d)->format("i");
    }
@endphp
<div class="accordion" id="leadAccordionControlSurSite">
    @if ($user_actions->where('module_name', 'collapse__section_sur_site')->where('action_name', 'create')->first() || $role == 's_admin')
        <button type="button" class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#controlSurSiteCreateModal">
            <span class="mr-2"></span>
            + Nouveau CSP
        </button>
    @else
        <button type="button" class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">
            <span class="mr-2"></span>
            <span class="novecologie-icon-lock py-1"></span>
        </button>
    @endif
    @if ($user_actions->where('module_name', 'collapse__section_sur_site')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse__section_sur_site')->where('action_name', 'edit')->first() || $role == 's_admin')
        @foreach ($control_sur_sites as $controle_sur_site)
            <div class="card lead__card border-0">
                <div style="border:1px solid black" class="rounded-lg">
                    <div class="card-header bg-transparent border-0 p-0" id="leadCard-ControlSurSite{{ $controle_sur_site->id }}">
                    <h2 class="mb-0">
                        @if ($user_actions->where('module_name', 'collapse__section_sur_site')->where('action_name', 'delete')->first() || $role == 's_admin')
                            <button type="button" class="btn btn-icon shadow-none top-right controle_sur_siteDeleteButton" style="margin: -15px" data-id="{{ $controle_sur_site->id }}"><i class="bi bi-trash3"></i></button>
                        @endif
                        <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                            <div class="lead__card__toggler__content w-100">
                                <h3 class="lead__card__toggler__content__heading">Contrôle sur site {{ $control_sur_sites->count() - $loop->index }}</h3>
                                <div class="lead__card__toggler__content__row">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">TYPE : </strong>
                                                <span class="text-dark">{{ $controle_sur_site->type }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="lead__card__toggler__content__row__text d-flex align-items-center">
                                                <strong class="lead__card__toggler__content__row__title flex-shrink-0 mr-2">Conformité du chantier : </strong>
                                                @if ($controle_sur_site->Conformité_du_chantier)
                                                    <div style="border-radius: 5px; padding:10px; color:{{ $controle_sur_site->Conformité_du_chantier == 'Sans objet' ? '#000000':'#ffffff' }}; background-color:{{ $controle_sur_site->Conformité_du_chantier == 'Conforme'? 'green':  ($controle_sur_site->Conformité_du_chantier == 'Non Conforme orange' ? '#FFAC1C': ($controle_sur_site->Conformité_du_chantier == 'Sans objet' ? '':'#D22B2B')) }}">{{ $controle_sur_site->Conformité_du_chantier }} </div>
                                                @endif
                                            </div>
                                        </div>
                                        @if ($controle_sur_site->type != 'MISE EN SERVICE')
                                            <div class="col-xl-6">
                                                <p class="lead__card__toggler__content__row__text">
                                                    <strong class="lead__card__toggler__content__row__title">Date Contrôle : </strong>
                                                    @if ($controle_sur_site->Date_de_contrôle)
                                                        <span class="text-dark">{{ \Carbon\Carbon::parse($controle_sur_site->Date_de_contrôle)->format('d-m-Y') }}</span>
                                                    @endif
                                                </p>
                                            </div>
                                        @endif
                                        @if ($controle_sur_site->type != 'CSP MPR')
                                            <div class="col-xl-6">
                                                <p class="lead__card__toggler__content__row__text">
                                                    <strong class="lead__card__toggler__content__row__title">Action de mise en conformité : </strong>
                                                    <span class="text-dark">{{ $controle_sur_site->Conformité_du_chantier == 'conforme' ? 'Non requis': (($controle_sur_site->Conformité_du_chantier == 'Non Conforme' || $controle_sur_site->Conformité_du_chantier == 'Non Conforme rouge' ||$controle_sur_site->Conformité_du_chantier == 'Non Conforme orange') ? 'Oui':'') }}</span>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <span class="d-block ml-auto">
                                <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                            </span> --}}
                            <button data-tab="Contrôle Sur Site" data-block="Contrôle sur site {{ $control_sur_sites->count() - $loop->index }}" data-tab-class="controle_sur_site__part{{ $controle_sur_site->id }}" type="button" data-toggle="collapse" data-target="#leadCardCollapse-ControlSurSite{{ $controle_sur_site->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('controle_sur_site__part'.$controle_sur_site->id) }} position-relative ml-auto mr-1 {{ session('controle_sur_site__part'.$controle_sur_site->id) == 'active' ? 'collapsed':'' }}">
                                <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                            </button>
                        </div>
                    </h2>
                    </div>
                    <div id="leadCardCollapse-ControlSurSite{{ $controle_sur_site->id }}" class="collapse {{ session('controle_sur_site__part'.$controle_sur_site->id) == 'active' ? 'show':'' }}" aria-labelledby="leadCard-ControlSurSite{{ $controle_sur_site->id }}">
                        <div class="card-body row">
                            <div class="col custom-space">
                                @if ($controle_sur_site->type != 'CSP MPR')
                                    <div class="text-right">
                                        <a href="{{ route('project.controle.pdf', $controle_sur_site->id) }}" target="_blank" class="btn-pdf shadow-none"><i class="bi bi-file-earmark-pdf"></i></a>
                                    </div>
                                @endif
                                <form action="{{ route('control.sur.site.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $controle_sur_site->id }}">
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <input type="hidden" name="block_name" value="Contrôle sur site {{ $loop->iteration }}">
                                        @if ($controle_sur_site->type == 'COFRAC')
                                            <div class="col-12 my-3">
                                                @push('all_forms')
                                                    <form action="{{ route('control.sur.site.file.update') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id"  value="{{ $controle_sur_site->id }}">
                                                        <input type="file" hidden name="report" id="controle_sur_site{{ $controle_sur_site->id }}" onchange="this.closest('form').submit()">
                                                    </form>
                                                @endpush
                                                <div class="d-flex align-items-center border px-2 rounded" style="background-color: #f2f2f2">
                                                    <h3 class="mr-auto mb-0">
                                                        @if ($controle_sur_site->report)
                                                        {{ $controle_sur_site->report_file_name ?? $controle_sur_site->report }}
                                                        @else
                                                            <strong>Insérer le rapport:</strong>
                                                        @endif
                                                    </h3>
                                                    <label for="controle_sur_site{{ $controle_sur_site->id }}" tabindex="0" class="btn p-2 shadow-none section_sur_site__disabled" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                                    @if ($controle_sur_site->report)
                                                        <a href="{{ asset('uploads/controle_sur_site') }}/{{ $controle_sur_site->report }}" target="_blank" class="btn p-2 shadow-none">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ asset('uploads/controle_sur_site') }}/{{ $controle_sur_site->report }}" download="{{ $controle_sur_site->report_file_name ?? $controle_sur_site->report }}" class=" btn p-2 shadow-none">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                                <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#controleSurSiteFileEdit{{ $controle_sur_site->id }}">
                                                                    Editer
                                                                </button>
                                                                <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#controleSurSiteFileDelete{{ $controle_sur_site->id }}">
                                                                    Supprimer
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Bureau_de_contrôle_id{{ $controle_sur_site->id }}">Bureau de contrôle <span class="text-danger">*</span></label>
                                                    <select name="Bureau_de_contrôle_id" id="Bureau_de_contrôle_id{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champ bureau de contrôle est requis">
                                                    <option value="" selected>{{ __("Select") }}</option>
                                                    @foreach ($control_offices as $control_office)
                                                        <option {{ ($control_office->id == $controle_sur_site->Bureau_de_contrôle_id)? 'selected':'' }} value="{{ $control_office->id }}">{{ $control_office->company_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Date_de_contrôle{{ $controle_sur_site->id }}">Date de contrôle <span class="text-danger">*</span></label>
                                                    <input type="date" name="Date_de_contrôle" id="Date_de_contrôle{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->Date_de_contrôle }}" class="flatpickr form-control section_sur_site__disabled shadow-none bg-transparent required_field" data-error-message="Le champ date de controle est requis" placeholder="dd/mm/yyyy">
                                                </div>
                                            </div>
                                            <div class="col-12">  
                                                <div class="form-group">
                                                    <label class="form-label" for="horaire_intervention{{ $controle_sur_site->id }}">Horaire intervention: </label>
                                                    <select name="horaire_intervention" id="horaire_intervention{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        @foreach ($min_30_interval as $hour)
                                                            <option {{ ($controle_sur_site->horaire_intervention == $hour) ? 'selected':'' }} value="{{ $hour }}">{{ $hour }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Étape_du_contrôle{{ $controle_sur_site->id }}">Étape du contrôle</label>
                                                    <select name="Étape_du_contrôle" id="Étape_du_contrôle{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100" data-error-message="Le champ travaux contrôlés est requis">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        <option value="Avant travaux" {{ $controle_sur_site->Étape_du_contrôle == 'Avant travaux' ? 'selected':'' }}>Avant travaux</option>
                                                        <option value="Après travaux" {{ $controle_sur_site->Étape_du_contrôle == 'Après travaux' ? 'selected':'' }}>Après travaux</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Travaux_contrôlés{{ $controle_sur_site->id }}">Travaux contrôlés <span class="text-danger">*</span></label>
                                                    <select name="Travaux_contrôlés[]" id="Travaux_contrôlés{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champ travaux contrôlés est requis" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        <option  {{ ($controle_sur_site->getSelectedTravaux()->where('travaux_id', $travaux->id)->exists())? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Conformité_du_chantier{{ $controle_sur_site->id }}">Conformité du chantier</label>
                                                    <select name="Conformité_du_chantier" id="Conformité_du_chantier{{ $controle_sur_site->id }}" class="select2_color_option form-control section_sur_site__disabled w-100 Conformité_du_chantier" data-error-message="Le champ conformité du chantier est requis" data-id="{{ $controle_sur_site->id }}">
                                                    <option value=" " selected>{{ __("Select") }}</option>
                                                    <option data-color="#ffffff" data-background="green" {{ ($controle_sur_site->Conformité_du_chantier == 'Conforme')? 'selected':'' }} value="Conforme">Conforme</option>
                                                    <option data-color="#ffffff" data-background="#D22B2B" {{ ($controle_sur_site->Conformité_du_chantier == 'Non Conforme')? 'selected':'' }} value="Non Conforme">Non Conforme</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 Conformité_du_chantier{{ $controle_sur_site->id }}" style="display: {{ $controle_sur_site->Conformité_du_chantier == 'Non Conforme' ? '':'none' }}">
                                                <div class="row NonConfirmReasonWrap{{ $controle_sur_site->id }}">
                                                    <input type="hidden" class="NonConfirmReasonCount{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->getReason->count() == 0 ? 1 : $controle_sur_site->getReason->count() }}">
                                                    @forelse ($controle_sur_site->getReason as $reason)
                                                        <div class="col-12 mb-3 new_reason_block">
                                                            <input type="hidden" name="number[]" value="{{ $loop->iteration }}">
                                                            <div class="form-group d-flex align-items-center">
                                                                <label class="form-label">Raisons de non-conformité {{ $loop->iteration }}</label>
                                                                @if ($loop->first)
                                                                    <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site__add_btn2" data-id="{{ $controle_sur_site->id }}">+</button>
                                                                @else
                                                                    <button type="button" class="remove-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site__remove_btn">&times;</button>
                                                                @endif

                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="Raisons_de_non_conformité[{{ $loop->iteration }}]" class="form-control section_sur_site__disabled  shadow-none">{{ $reason->reason }}</textarea>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="background-color: #F2F2F2">
                                                                    <div class="form-group">
                                                                        <div class="d-flex align-items-center">
                                                                            <h3 class="flex-grow-1">Action corrective {{ $loop->iteration }}</h3> 
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                            <label class="form-label">Description action corrective</label>
                                                                        <textarea name="Description_action_corrective[{{ $loop->iteration }}]" class="form-control section_sur_site__disabled shadow-none" data-error-message="Le champ correctif de la description de l'action est requis">{{ $reason->Description_action_corrective }}</textarea>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="form-label">Date</label>
                                                                        <input type="date" name="Date[{{ $loop->iteration }}]" class="flatpickr form-control section_sur_site__disabled shadow-none" data-error-message="Le champ de date est requis" value="{{ $reason->Date }}" placeholder="dd/mm/yyyy">
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Statut_mise_en_conformité{{ $loop->iteration }}">Statut action corrective </label>
                                                                        <select name="Statut_mise_en_conformité[{{ $loop->iteration }}]" data-placeholder="{{ __("Select") }}" id="Statut_mise_en_conformité{{ $loop->iteration }}" class="select2_color_option form-control section_sur_site__disabled w-100" data-error-message="Le champ correctif d'action de statut est requis">
                                                                            <option value="" selected></option>
                                                                            <option data-color="#ffffff" data-background="green" {{ $reason->Statut_mise_en_conformité == 'Conforme' ? 'selected':''  }} value="Conforme">Conforme</option>
                                                                            <option data-color="#ffffff" data-background="#D22B2B" {{ $reason->Statut_mise_en_conformité == 'Non Conforme' ? 'selected':''  }} value="Non Conforme">Non Conforme</option>
                                                                            <option data-color="#000000" data-background="#cca1c5" {{ $reason->Statut_mise_en_conformité == 'En attente retour tiers' ? 'selected':''  }} value="En attente retour tiers">En attente retour tiers</option>
                                                                        </select>
                                                                    </div> 
                                                                </div> 
                                                            </div> 
                                                        </div>
                                                    @empty
                                                    <input type="hidden" name="number[]" value="1">
                                                    <div class="col-12">
                                                            <div class="form-group d-flex align-items-center">
                                                                <label class="form-label">Raisons de non-conformité 1</label>
                                                                <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site__add_btn2" data-id="{{ $controle_sur_site->id }}">+</button>
                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="Raisons_de_non_conformité[1]" class="form-control section_sur_site__disabled  shadow-none"></textarea>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-body" style="background-color: #F2F2F2">
                                                                    <div class="form-group">
                                                                        <div class="d-flex align-items-center">
                                                                            <h3 class="flex-grow-1">Action corrective 1</h3> 
                                                                        </div>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                            <label class="form-label">Description action corrective</label>
                                                                        <textarea name="Description_action_corrective[1]" class="form-control section_sur_site__disabled shadow-none" data-error-message="Le champ correctif de la description de l'action est requis"></textarea>
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="form-label">Date</label>
                                                                        <input type="date" name="Date[1]" class="flatpickr form-control section_sur_site__disabled shadow-none" data-error-message="Le champ de date est requis" placeholder="dd/mm/yyyy">
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Statut_mise_en_conformité">Statut action corrective </label>
                                                                        <select name="Statut_mise_en_conformité[1]" data-placeholder="{{ __("Select") }}" id="Statut_mise_en_conformité" class="select2_color_option form-control section_sur_site__disabled w-100" data-error-message="Le champ correctif d'action de statut est requis">
                                                                            <option value="" selected></option>
                                                                            <option data-color="#ffffff" data-background="green" value="Conforme">Conforme</option>
                                                                            <option data-color="#ffffff" data-background="#D22B2B" value="Non Conforme">Non Conforme</option>
                                                                            <option data-color="#000000" data-background="#cca1c5" value="En attente retour tiers">En attente retour tiers</option>
                                                                        </select>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Surface_contrôlée{{ $controle_sur_site->id }}">Surface contrôlée</label>
                                                    <input type="hidden" class="m2_type_hidden_value" name="Surface_contrôlée" id="Surface_contrôlée__hidden{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->Surface_contrôlée }}">
                                                    <input type="text" step="any" value="{{ $controle_sur_site->Surface_contrôlée }} m2" id="Surface_contrôlée{{ $controle_sur_site->id }}" class="form-control section_sur_site__disabled shadow-none m2_type_value__cal" data-id="{{ $controle_sur_site->id }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="d-flex align-items-center">
                                                        <label class="form-label mr-3 flex-grow-1">Écart de surface</label>
                                                        <select name="Ecart_surface" data-autre-box="Ecart_surfaceWrap{{ $controle_sur_site->id }}" class="other_field__system2 custom-select shadow-none section_sur_site__disabled w-auto" data-error-message="Le champ Écart de surface est requis">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            <option {{ $controle_sur_site->Ecart_surface == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                            <option {{ $controle_sur_site->Ecart_surface == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 Ecart_surfaceWrap{{ $controle_sur_site->id }}" style="display: {{ ($controle_sur_site->Ecart_surface == 'Oui')? '':'none' }}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Ecart_de_surface{{ $controle_sur_site->id }}">Différence de surface</label>
                                                            <input type="hidden" id="Ecart_de_surface__hidden{{ $controle_sur_site->id }}" class="m2_type_hidden_value" name="Ecart_de_surface" value="{{ $controle_sur_site->Ecart_de_surface }}">
                                                            <input readonly type="text" step="any" value="{{ $controle_sur_site->Ecart_de_surface }}  m2" id="Ecart_de_surface{{ $controle_sur_site->id }}" class="form-control section_sur_site__disabled shadow-none m2_type_value" data-id="{{ $controle_sur_site->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Surface_réalisé_sur_facture{{ $controle_sur_site->id }}">Surface déclaré sur facture</label>
                                                            <input type="hidden" id="Surface_réalisé_sur_facture__hidden{{ $controle_sur_site->id }}" class="m2_type_hidden_value" name="Surface_réalisé_sur_facture" value="{{ $controle_sur_site->Surface_réalisé_sur_facture }}">
                                                            <input type="text"  step="any" value="{{ $controle_sur_site->Surface_réalisé_sur_facture }} m2" id="Surface_réalisé_sur_facture{{ $controle_sur_site->id }}" class="form-control section_sur_site__disabled shadow-none m2_type_value__cal" data-id="{{ $controle_sur_site->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-12 actionWrap{{ $controle_sur_site->id }}">
                                                <div class="form-group d-flex align-items-center">
                                                    <label class="form-label">Créer une action de mise en conformité</label>
                                                        <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site_action__add_btn" data-id="{{ $controle_sur_site->id }}">+</button>
                                                </div>
                                                <input type="hidden" class="adminCount{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->getAction->count() }}">
                                                @foreach ($controle_sur_site->getAction as $action)
                                                <div class="card mb-3 new_reason_block">
                                                        <input type="hidden" name="number[]" value="{{ $loop->iteration }}">
                                                        <div class="card-body" style="background-color: #F2F2F2">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="d-flex align-items-center">
                                                                            <h3 class="flex-grow-1">Action corrective {{ $loop->iteration }}</h3>
                                                                            <button type="button" class="remove-btn mb-1 justify-content-center button section_sur_site__disabled section_sur_site__remove_btn">&times;</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                            <label class="form-label">Description action corrective <span class="text-danger">*</span></label>
                                                                        <textarea name="Description_action_corrective[{{ $loop->iteration }}]" class="form-control section_sur_site__disabled shadow-none required_field" data-error-message="Le champ correctif de la description de l'action est requis">{{ $action->Description_action_corrective }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                                                        <input type="date" name="Date[{{ $loop->iteration }}]" class="flatpickr form-control section_sur_site__disabled shadow-none required_field" data-error-message="Le champ de date est requis" value="{{ $action->Date }}" placeholder="dd/mm/yyyy">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Statut_mise_en_conformité">Statut action corrective <span class="text-danger">*</span></label>
                                                                        <select name="Statut_mise_en_conformité[{{ $loop->iteration }}]" data-placeholder="{{ __("Select") }}" id="Statut_mise_en_conformité" class="select2_color_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champ correctif d'action de statut est requis">
                                                                            <option value="" selected></option>
                                                                            <option data-color="#ffffff" data-background="green" {{ $action->Statut_mise_en_conformité == 'Conforme' ? 'selected':''  }} value="Conforme">Conforme</option>
                                                                            <option data-color="#ffffff" data-background="#D22B2B" {{ $action->Statut_mise_en_conformité == 'Non Conforme' ? 'selected':''  }} value="Non Conforme">Non Conforme</option>
                                                                            <option data-color="#000000" data-background="#cca1c5" {{ $action->Statut_mise_en_conformité == 'En attente retour tiers' ? 'selected':''  }} value="En attente retour tiers">En attente retour tiers</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div> --}}
                                        @elseif ($controle_sur_site->type == 'MISE EN SERVICE')
                                            {{-- <div class="col-12 d-flex  align-items-center">
                                                <input type="file" hidden name="report" id="controle_sur_site{{ $controle_sur_site->id }}">
                                                <h3 class="mr-2"><strong>Rapport:</strong> {{ $controle_sur_site->report_file_name ?? $controle_sur_site->report }}</h3>
                                                <label for="controle_sur_site{{ $controle_sur_site->id }}" tabindex="0" class="btn p-2 shadow-none section_sur_site__disabled" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                                @if ($controle_sur_site->report)
                                                    <a href="{{ asset('uploads/controle_sur_site') }}/{{ $controle_sur_site->report }}" target="_blank" class="btn p-2 shadow-none">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ asset('uploads/controle_sur_site') }}/{{ $controle_sur_site->report }}" download="{{ $controle_sur_site->report_file_name ?? $controle_sur_site->report }}" class=" btn p-2 shadow-none">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                            <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#controleSurSiteFileEdit{{ $controle_sur_site->id }}">
                                                                Editer
                                                            </button>
                                                            <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#controleSurSiteFileDelete{{ $controle_sur_site->id }}">
                                                                Supprimer
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div> --}}
                                            <div class="col-12 my-3">
                                                @push('all_forms')
                                                    <form action="{{ route('control.sur.site.file.update') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id"  value="{{ $controle_sur_site->id }}">
                                                        <input type="file" hidden name="report" id="controle_sur_site{{ $controle_sur_site->id }}" onchange="this.closest('form').submit()">
                                                    </form>
                                                @endpush
                                                <div class="d-flex align-items-center border px-2 rounded" style="background-color: #f2f2f2">
                                                    <h3 class="mr-auto mb-0">
                                                        @if ($controle_sur_site->report)
                                                        {{ $controle_sur_site->report_file_name ?? $controle_sur_site->report }}
                                                        @else
                                                            <strong>Insérer le rapport:</strong>
                                                        @endif
                                                    </h3>
                                                    <label for="controle_sur_site{{ $controle_sur_site->id }}" tabindex="0" class="btn p-2 shadow-none section_sur_site__disabled" role="button"><i class="bi bi-upload px-2 py-1"></i></label>
                                                    @if ($controle_sur_site->report)
                                                        <a href="{{ asset('uploads/controle_sur_site') }}/{{ $controle_sur_site->report }}" target="_blank" class="btn p-2 shadow-none">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ asset('uploads/controle_sur_site') }}/{{ $controle_sur_site->report }}" download="{{ $controle_sur_site->report_file_name ?? $controle_sur_site->report }}" class=" btn p-2 shadow-none">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle p-2" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                                <button  type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#controleSurSiteFileEdit{{ $controle_sur_site->id }}">
                                                                    Editer
                                                                </button>
                                                                <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#controleSurSiteFileDelete{{ $controle_sur_site->id }}">
                                                                    Supprimer
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Société_MES{{ $controle_sur_site->id }}">Société MES <span class="text-danger">*</span></label>
                                                    <select name="Société_MES" id="Société_MES{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champs société MES est requis">
                                                    <option value="" selected>{{ __("Select") }}</option>
                                                    @foreach ($control_offices as $company_commissioned)
                                                        <option {{ ($company_commissioned->id == $controle_sur_site->Société_MES)? 'selected':'' }} value="{{ $company_commissioned->id }}">{{ $company_commissioned->company_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Date_MES{{ $controle_sur_site->id }}">Date MES <span class="text-danger">*</span></label>
                                                    <input type="date" name="Date_MES" id="Date_MES{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->Date_MES }}" class="flatpickr form-control section_sur_site__disabled shadow-none bg-transparent  required_field" data-error-message="Le champ date MES est requis" placeholder="dd/mm/yyyy">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Travaux_contrôlés{{ $controle_sur_site->id }}">Travaux contrôlés <span class="text-danger">*</span></label>
                                                    <select name="Travaux_contrôlés[]" id="Travaux_contrôlés{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champ travaux contrôlés est requis" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        <option  {{ ($controle_sur_site->getSelectedTravaux()->where('travaux_id', $travaux->id)->exists())? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="deal{{ $controle_sur_site->id }}">Deal</label>
                                                    <select name="deal" id="deal{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100">
                                                    <option value="" selected>{{ __("Select") }}</option>
                                                    @foreach ($deals as $deal)
                                                        <option {{ ($deal->id == $controle_sur_site->deal)? 'selected':'' }} value="{{ $deal->id }}">{{ $deal->name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <label class="mb-0 form-label mr-3">Rapport MES dans Dropbox :</label>
                                                        <select name="Rapport_MES_dans_Dropbox" class="other_field__system2 custom-select shadow-none section_sur_site__disabled w-auto" data-error-message="Le champ rapport MES dans Dropbox est requis">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            <option {{ $controle_sur_site->Rapport_MES_dans_Dropbox == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                            <option {{ $controle_sur_site->Rapport_MES_dans_Dropbox == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Conformité_du_chantier{{ $controle_sur_site->id }}">Conformité du chantier</label>
                                                    <select name="Conformité_du_chantier" id="Conformité_du_chantier{{ $controle_sur_site->id }}" class="select2_color_option form-control section_sur_site__disabled w-100 Conformité_du_chantier1" data-error-message="Le champ conformité du chantier est requis" data-id="{{ $controle_sur_site->id }}">
                                                    <option value=" " selected>{{ __("Select") }}</option>
                                                    <option data-color="#ffffff" data-background="green" {{ ($controle_sur_site->Conformité_du_chantier == 'Conforme')? 'selected':'' }} value="Conforme">Conforme</option>
                                                    <option data-color="#000000" data-background="#FFAC1C" {{ ($controle_sur_site->Conformité_du_chantier == 'Non Conforme orange')? 'selected':'' }} value="Non Conforme orange">Non Conforme orange</option>
                                                    <option data-color="#ffffff" data-background="#D22B2B" {{ ($controle_sur_site->Conformité_du_chantier == 'Non Conforme rouge')? 'selected':'' }} value="Non Conforme rouge">Non Conforme rouge</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 Conformité_du_chantier{{ $controle_sur_site->id }}" style="display: {{ ($controle_sur_site->Conformité_du_chantier == 'Non Conforme orange' || $controle_sur_site->Conformité_du_chantier == 'Non Conforme rouge') ? '':'none' }}">
                                                <div class="row NonConfirmReasonWrap{{ $controle_sur_site->id }}">
                                                    <input type="hidden" class="NonConfirmReasonCount{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->getReason->count() == 0 ? 1 : $controle_sur_site->getReason->count() }}">
                                                    @forelse ($controle_sur_site->getReason as $reason)
                                                        <div class="col-12 new_reason_block">
                                                            <div class="form-group d-flex align-items-center">
                                                                <label class="form-label">Raisons de non-conformité {{ $loop->iteration }}</label>
                                                                @if ($loop->first)
                                                                    <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site__add_btn" data-id="{{ $controle_sur_site->id }}">+</button>
                                                                @else
                                                                    <button type="button" class="remove-btn ml-3 justify-content-center button section_sur_site__disabled   section_sur_site__remove_btn">&times;</button>
                                                                @endif

                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="Raisons_de_non_conformité[]" class="form-control section_sur_site__disabled  shadow-none">{{ $reason->reason }}</textarea>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <div class="form-group d-flex align-items-center">
                                                                <label class="form-label">Raisons de non-conformité 1</label>
                                                                <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site__add_btn" data-id="{{ $controle_sur_site->id }}">+</button>
                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="Raisons_de_non_conformité[]" class="form-control section_sur_site__disabled  shadow-none"></textarea>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="col-12 actionWrap{{ $controle_sur_site->id }}">
                                                <div class="form-group d-flex align-items-center">
                                                    <label class="form-label">Créer une action de mise en conformité</label>
                                                        <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site_action__add_btn" data-id="{{ $controle_sur_site->id }}">+</button>
                                                </div>
                                                <input type="hidden" class="adminCount{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->getAction->count() }}">
                                                @foreach ($controle_sur_site->getAction as $action)
                                                <div class="card mb-3 new_reason_block">
                                                        <input type="hidden" name="number[]" value="{{ $loop->iteration }}">
                                                        <div class="card-body" style="background-color: #F2F2F2">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="d-flex align-items-center">
                                                                            <h3 class="flex-grow-1">Action corrective {{ $loop->iteration }}</h3>
                                                                            <button type="button" class="remove-btn mb-1 justify-content-center button section_sur_site__disabled section_sur_site__remove_btn">&times;</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                            <label class="form-label">Description action corrective <span class="text-danger">*</span></label>
                                                                        <textarea name="Description_action_corrective[{{ $loop->iteration }}]" class="form-control section_sur_site__disabled shadow-none required_field" data-error-message="Le champ correctif de la description de l'action est requis">{{ $action->Description_action_corrective }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Date <span class="text-danger">*</span></label>
                                                                        <input type="date" name="Date[{{ $loop->iteration }}]" class="flatpickr form-control section_sur_site__disabled shadow-none required_field" data-error-message="Le champ de date est requis" value="{{ $action->Date }}" placeholder="dd/mm/yyyy">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label class="form-label" for="Statut_mise_en_conformité">Statut action corrective <span class="text-danger">*</span></label>
                                                                        <select name="Statut_mise_en_conformité[{{ $loop->iteration }}]" data-placeholder="{{ __("Select") }}" id="Statut_mise_en_conformité" class="select2_color_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champ correctif d'action de statut est requis">
                                                                            <option value="" selected></option>
                                                                            <option data-color="#ffffff" data-background="green" {{ $action->Statut_mise_en_conformité == 'Conforme' ? 'selected':''  }} value="Conforme">Conforme</option>
                                                                            <option data-color="#ffffff" data-background="#D22B2B" {{ $action->Statut_mise_en_conformité == 'Non Conforme' ? 'selected':''  }} value="Non Conforme">Non Conforme</option>
                                                                            <option data-color="#000000" data-background="#cca1c5" {{ $action->Statut_mise_en_conformité == 'En attente retour tiers' ? 'selected':''  }} value="En attente retour tiers">En attente retour tiers</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @elseif ($controle_sur_site->type == 'CSP MPR')
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Bureau_de_contrôle_id{{ $controle_sur_site->id }}">Bureau de contrôle <span class="text-danger">*</span></label>
                                                    <select name="Bureau_de_contrôle_id" id="Bureau_de_contrôle_id{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champ bureau de contrôle est requis">
                                                    <option value="" selected>{{ __("Select") }}</option>
                                                    @foreach ($control_offices as $control_office)
                                                        <option {{ ($control_office->id == $controle_sur_site->Bureau_de_contrôle_id)? 'selected':'' }} value="{{ $control_office->id }}">{{ $control_office->company_name }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Date_de_contrôle{{ $controle_sur_site->id }}">Date de contrôle <span class="text-danger">*</span></label>
                                                    <input type="date" name="Date_de_contrôle" id="Date_de_contrôle{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->Date_de_contrôle }}" class="flatpickr form-control section_sur_site__disabled shadow-none bg-transparent required_field" data-error-message="Le champ date de controle est requis" placeholder="dd/mm/yyyy">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Travaux_contrôlés{{ $controle_sur_site->id }}">Travaux contrôlés <span class="text-danger">*</span></label>
                                                    <select name="Travaux_contrôlés[]" id="Travaux_contrôlés{{ $controle_sur_site->id }}" class="select2_select_option form-control section_sur_site__disabled w-100 required_field" data-error-message="Le champ travaux contrôlés est requis" multiple>
                                                    @foreach ($bareme_travaux_tags as $travaux)
                                                        <option  {{ ($controle_sur_site->getSelectedTravaux()->where('travaux_id', $travaux->id)->exists())? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h4 class="mb-0 mr-2">Réception du bordereau de passage</h4>
                                                        <select name="Réception_du_bordereau_de_passage" class="other_field__system2 custom-select shadow-none section_sur_site__disabled w-auto" data-error-message="Le champ réception du bordereau de passage est requis">
                                                            <option value="" selected>{{ __('Select') }}</option>
                                                            <option {{ $controle_sur_site->Réception_du_bordereau_de_passage == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                            <option {{ $controle_sur_site->Réception_du_bordereau_de_passage == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Conformité_du_chantier{{ $controle_sur_site->id }}">Conformité du chantier</label>
                                                    <select name="Conformité_du_chantier" id="Conformité_du_chantier{{ $controle_sur_site->id }}" class="select2_color_option form-control section_sur_site__disabled w-100 Conformité_du_chantier" data-id="{{ $controle_sur_site->id }}">
                                                    <option value=" " selected>{{ __("Select") }}</option>
                                                    <option data-color="#ffffff" data-background="green" {{ ($controle_sur_site->Conformité_du_chantier == 'Conforme')? 'selected':'' }} value="Conforme">Conforme</option>
                                                    <option data-color="#ffffff" data-background="#D22B2B" {{ ($controle_sur_site->Conformité_du_chantier == 'Non Conforme')? 'selected':'' }} value="Non Conforme">Non Conforme</option>
                                                    <option {{ ($controle_sur_site->Conformité_du_chantier == 'Sans objet')? 'selected':'' }} value="Sans objet">Sans objet</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 Conformité_du_chantier{{ $controle_sur_site->id }}" style="display: {{ ($controle_sur_site->Conformité_du_chantier == 'Non Conforme') ? '':'none' }}">
                                                <div class="row NonConfirmReasonWrap{{ $controle_sur_site->id }}">
                                                    <input type="hidden" class="NonConfirmReasonCount{{ $controle_sur_site->id }}" value="{{ $controle_sur_site->getReason->count() == 0 ? 1 : $controle_sur_site->getReason->count() }}">
                                                    @forelse ($controle_sur_site->getReason as $reason)
                                                        <div class="col-12 new_reason_block">
                                                            <div class="form-group d-flex align-items-center">
                                                                <label class="form-label">Raisons de non-conformité {{ $loop->iteration }}</label>
                                                                @if ($loop->first)
                                                                    <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site__add_btn" data-id="{{ $controle_sur_site->id }}">+</button>
                                                                @else
                                                                    <button type="button" class="remove-btn ml-3 justify-content-center button section_sur_site__disabled   section_sur_site__remove_btn">&times;</button>
                                                                @endif

                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="Raisons_de_non_conformité[]" class="form-control section_sur_site__disabled  shadow-none">{{ $reason->reason }}</textarea>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <div class="form-group d-flex align-items-center">
                                                                <label class="form-label">Raisons de non-conformité 1</label>
                                                                <button type="button" class="add-btn ml-3 justify-content-center button section_sur_site__disabled section_sur_site__add_btn" data-id="{{ $controle_sur_site->id }}">+</button>
                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea name="Raisons_de_non_conformité[]" class="form-control section_sur_site__disabled  shadow-none"></textarea>
                                                            </div>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Observations</label>
                                                <textarea name="Observations" class="form-control section_sur_site__disabled shadow-none">{{ $controle_sur_site->Observations }}</textarea>
                                            </div>
                                        </div>
                                        @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "controle_sur_site__$controle_sur_site->type"), 'custom_field_data' => $controle_sur_site->custom_field_data, 'disabled_class' => 'section_sur_site__disabled'])
                                        @if ($user_actions->where('module_name', 'collapse__section_sur_site')->where('action_name', 'edit')->first() || $role == 's_admin')
                                            <div class="col-12 text-center ">
                                                <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 formSubmitButton">
                                                    {{ __('Submit') }}
                                                </button>
                                                @if ($role == 's_admin')
                                                    <button type="button" data-collapse="controle_sur_site__{{ $controle_sur_site->type }}" data-callapse_active="css_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 section_sur_site__disabled">
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
            </div>
            @push('all_modals')
                <div class="modal modal--aside fade" id="controleSurSiteFileDelete{{ $controle_sur_site->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                                <form action="{{ route('control.sur.site.file.delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $controle_sur_site->id }}">
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
                <div class="modal modal--aside fade" id="controleSurSiteFileEdit{{ $controle_sur_site->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0">
                            <div class="modal-header border-0 pb-0">
                                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                    <span class="novecologie-icon-close"></span>
                                </button>
                            </div>
                            <div class="modal-body text-center pt-0">
                                <h1 class="form__title position-relative mb-4">Mettre à jour le nom du fichier </h1>
                                <form action="{{ route('control.sur.site.file.name.edit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $controle_sur_site->id }}">
                                    <div class="form-group text-left">
                                        <label for="#">Nom de fichier</label>
                                        <input type="text" name="name" value="{{ $controle_sur_site->report_file_name ?? $controle_sur_site->report }}" class="form-control shadow-none">
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
        @endforeach
    @endif
</div>



{{-- Control sur site create modal --}}
<div class="modal modal--aside fade" id="controlSurSiteCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">Créer une Contrôle Sur Site </h1>
                <form action="{{ route('project.control.sur.site.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label for="#" class="form-label text-left">Contrôle Sur Site</label>
                        <select class="form-control" name="type" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            <option value="COFRAC">COFRAC</option>
                            <option value="MISE EN SERVICE">MISE EN SERVICE</option>
                            <option value="CSP MPR">CSP MPR</option>
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
<div class="modal modal--aside fade" id="ControleSurSiteDeleteButton" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                <form action="{{ route('project.control.sur.site.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="controle_sur_site_deleted_id">
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