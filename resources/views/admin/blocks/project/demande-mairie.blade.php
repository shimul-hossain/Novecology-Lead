@php    
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get(); 
    $all_inputs = \App\Models\CRM\ProjectCustomField::all(); 
@endphp
<div class="accordion" id="leadAccordionDemandeMairie">
    @if ($user_actions->where('module_name', 'collapse_demande_mairie')->where('action_name', 'create')->first() || $role == 's_admin')
        <button class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#demandemairieCreateModal">
            <span class="mr-2"></span>
            + Ajouter nouvelle demande
        </button>
    @else
        <button type="button" class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">
            <span class="novecologie-icon-lock py-1"></span>
        </button>
    @endif
    @if ($user_actions->where('module_name', 'collapse_demande_mairie')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_demande_mairie')->where('action_name', 'edit')->first() || $role == 's_admin')
    @foreach ($project->getDemandes as $demande)
        <div class="card lead__card border-0">
            <div class="card-header bg-transparent border-0 p-0" id="leadCard-Banque{{ $demande->id }}">
                <h2 class="mb-0">
                    @if ($user_actions->where('module_name', 'collapse_demande_mairie')->where('action_name', 'delete')->first() || $role == 's_admin')
                        <button type="button" class="btn btn-icon shadow-none top-right demandeDeleteButton" data-id="{{ $demande->id }}"><i class="bi bi-trash3"></i></button>
                    @endif
                    <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                        <div class="lead__card__toggler__content w-100">
                            <h3 class="lead__card__toggler__content__heading">Dépôt en Mairie {{ $project->getDemandes->count() - $loop->index }}</h3>
                            <div class="lead__card__toggler__content__row">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <p class="lead__card__toggler__content__row__text">
                                            <strong class="lead__card__toggler__content__row__title">Statut demande :</strong>
                                            <span class="text-dark">{{ $demande->Statut_demande }}</span>
                                        </p>
                                    </div>
                                    <div class="col-xl-6">
                                        <p class="lead__card__toggler__content__row__text">
                                            <strong class="lead__card__toggler__content__row__title">Date de dépôt :</strong>
                                            <span class="text-dark">@if($demande->Date_de_dépôt && strtotime($demande->Date_de_dépôt)) {{ \Carbon\Carbon::parse($demande->Date_de_dépôt)->format('d-m-Y') }} @endif
                                        </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button data-tab="Demande Mairie" data-block="Dépôt en Mairie {{ $project->getDemandes->count() - $loop->index }}" data-tab-class="demande_mairie__part{{ $demande->id }}" type="button" data-toggle="collapse" data-target="#leadCardCollapse-demande_mairie{{ $demande->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('demande_mairie__part'.$demande->id) }} position-relative ml-auto mr-1 {{ session('demande_mairie__part'.$demande->id) == 'active' ? 'collapsed':'' }}">
                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                        </button>
                    </div>
                </h2>
            </div>
            <div id="leadCardCollapse-demande_mairie{{ $demande->id }}" class="collapse {{ session('demande_mairie__part'.$demande->id) == 'active' ? 'show':'' }}" aria-labelledby="leadCard-Banque{{ $demande->id }}">
                <div class="card-body row">
                    <div class="col custom-space">
                        <form action="{{ route('project.demande.mairie.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ $demande->id }}">
                                        <label class="form-label" for="Mairie{{ $demande->id }}">Mairie </label>
                                        <input type="text" name="Mairie" value="{{ $demande->Mairie }}" id="Mairie{{ $demande->id }}" class="form-control demande_mairie_disabled shadow-none">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="Statut_demande{{ $demande->id }}">Statut demande </label>
                                        <select name="Statut_demande" id="Statut_demande{{ $demande->id }}" data-id="{{ $demande->id }}" class="select2_select_option StatutDemandeChange shadow-none form-control demande_mairie_disabled" required>
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $demande->Statut_demande == "Déposée" ? 'selected':'' }} value="Déposée">Déposée</option>
                                            <option {{ $demande->Statut_demande == "Acceptée" ? 'selected':'' }} value="Acceptée">Acceptée</option>
                                            <option {{ $demande->Statut_demande == "Demande de compléments" ? 'selected':'' }} value="Demande de compléments">Demande de compléments</option>
                                            <option {{ $demande->Statut_demande == "Refusée" ? 'selected':'' }} value="Refusée">Refusée</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 StatutDemandeChangeWrap{{ $demande->id }}" style="display: {{ ($demande->Statut_demande == 'Acceptée')? '':'none' }}">
                                    <div class="form-group">
                                        <label for="Date_de_réception_de_l_accord_de_mairie" class="form-label">Date de réception de l'accord de mairie</label>
                                        <input type="date" name="Date_de_réception_de_l_accord_de_mairie" value="{{ $demande->Date_de_réception_de_l_accord_de_mairie }}" class="flatpickr form-control shadow-none demande_mairie_disabled">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Date_de_dépôt{{ $demande->id }}">Date de dépôt</label>
                                        <input type="date" name="Date_de_dépôt" id="Date_de_dépôt{{ $demande->id }}" value="{{ $demande->Date_de_dépôt }}" class="flatpickr form-control demande_mairie_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Demande_de_travaux{{ $demande->id }}">Demande de travaux :</label>
                                        <select  name="Demande_de_travaux" id="Demande_de_travaux{{ $demande->id }}" class="select2_select_option form-control demande_mairie_disabled w-100" required>
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($bareme_travaux_tags->where('rank', 1) as $travaux)
                                                <option {{ $demande->Demande_de_travaux == $travaux->id ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Réception_du_récépissé_de_dépôt{{ $demande->id }}">Réception du récépissé de dépôt</label>
                                        <select name="Réception_du_récépissé_de_dépôt" id="Réception_du_récépissé_de_dépôt{{ $demande->id }}"  class="select2_color_option custom-select shadow-none form-control demande_mairie_disabled">
                                            <option value=" " selected>{{ __('Select') }}</option>
                                            <option data-color="#ffffff" data-background="green" {{ $demande->Réception_du_récépissé_de_dépôt == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                            <option data-color="#ffffff" data-background="red" {{ $demande->Réception_du_récépissé_de_dépôt == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="Date_de_réception_de_récépissé_de_mairie{{ $demande->id }}">Date de réception de récépissé de mairie</label>
                                        <input type="date" name="Date_de_réception_de_récépissé_de_mairie" id="Date_de_réception_de_récépissé_de_mairie{{ $demande->id }}" value="{{ $demande->Date_de_réception_de_récépissé_de_mairie }}" class="flatpickr form-control demande_mairie_disabled shadow-none bg-transparent " placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="Observations" class="form-label">Observations </label>
                                        <textarea  name="Observations" id="Observations" class="form-control shadow-none demande_mairie_disabled">{{ $demande->Observations }}</textarea>
                                    </div>
                                </div>
                                @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "demande__collapse"), 'custom_field_data' => $demande->custom_field_data, 'disabled_class' => 'demande_mairie_disabled'])
                                @if ($user_actions->where('module_name', 'collapse_demande_mairie')->where('action_name', 'edit')->first() || $role == 's_admin')
                                    <div class="col-12 text-center">
                                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                            {{ __('Submit') }}
                                        </button>
                                        @if ($role == 's_admin')
                                            <button type="button" data-collapse="demande__collapse" data-callapse_active="demande_mairie" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 demande_mairie_disabled">
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

{{-- Demande create modal --}}
<div class="modal modal--aside fade" id="demandemairieCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>Êtes-vous sûr de vouloir créer un nouveau Demande Mairie?</span>
                <form action="{{ route('project.demande.mairie.create') }}" method="POST">
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

{{--  Demande Delete Modal  --}}
<div class="modal modal--aside fade" id="DemandeDeleteButton" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                <form action="{{ route('project.demande.mairie.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="demande_deleted_id">
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