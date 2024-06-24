@php 
    $banques = \App\Models\CRM\Banque::all();  
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();
@endphp
<div class="accordion" id="leadAccordionBanque">
    @if ($user_actions->where('module_name', 'collapse_depot')->where('action_name', 'create')->first() || $role == 's_admin')
        <button class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#depotCreateModal">
            <span class="mr-2"></span>
            + Ajouter nouvelle demande
        </button>
    @else
        <button type="button" class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">
            <span class="novecologie-icon-lock py-1"></span>
        </button>
    @endif
    @if ($user_actions->where('module_name', 'collapse_depot')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_depot')->where('action_name', 'edit')->first() || $role == 's_admin')
    @foreach ($project->getDepot as $depot)
        <div class="card lead__card border-0">
            @if ($user_actions->where('module_name', 'collapse_depot')->where('action_name', 'delete')->first() || $role == 's_admin')
                <button type="button" class="btn btn-icon shadow-none top-right banqueDeleteButton" data-id="{{ $depot->id }}"><i class="bi bi-trash3"></i></button>
            @endif
            <div class="card-header bg-transparent border-0 p-0" id="leadCard-Banque{{ $depot->id }}">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                    <div class="lead__card__toggler__content w-100">
                        <h3 class="lead__card__toggler__content__heading">Depot en banque  {{ $project->getDepot->count() - $loop->index }}</h3>
                        <div class="lead__card__toggler__content__row">
                            <div class="row">
                                <div class="col-xl-6">
                                    <p class="lead__card__toggler__content__row__text">
                                        <strong class="lead__card__toggler__content__row__title">Banque :</strong>
                                        <span class="text-dark">{{ $depot->banque->name ?? '' }}</span>
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p class="lead__card__toggler__content__row__text">
                                        <strong class="lead__card__toggler__content__row__title">Statut Banque :</strong>
                                        <span class="text-dark">{{ $depot->banque_status }}</span>
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p class="lead__card__toggler__content__row__text">
                                        <strong class="lead__card__toggler__content__row__title">Date de dépôt :</strong>
                                        @if ($depot->date_depot && strtotime($depot->date_depot))
                                            <span class="text-dark">{{ \Carbon\Carbon::parse($depot->date_depot)->format('d-m-Y') }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-xl-6">
                                    <p class="lead__card__toggler__content__row__text">
                                        <strong class="lead__card__toggler__content__row__title">montant :</strong>
                                        <span class="text-dark">{{ EuroFormat($depot->banque_montant) }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <span class="d-block ml-auto">
                        <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                    </span> --}}
                    <button data-tab="Banque" data-block="Depot en banque {{ $loop->iteration }}" data-tab-class="banque__part{{ $depot->id }}" type="button" data-toggle="collapse" data-target="#leadCardCollapse-banque{{ $depot->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('banque__part'.$depot->id) }} position-relative ml-auto mr-1 {{ session('banque__part'.$depot->id) == 'active' ? 'collapsed':'' }}">
                        <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                        <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                    </button>
                </div>
            </h2>
            </div>
            <div id="leadCardCollapse-banque{{ $depot->id }}" class="collapse {{ session('banque__part'.$depot->id) == 'active' ? 'show':'' }}" aria-labelledby="leadCard-Banque{{ $depot->id }}">
                <div class="card-body row">
                    <div class="col custom-space">
                        <form action="{{ route('banque.depot.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="banque_id">Banque <span class="text-danger">*</span></label>
                                        <input type="hidden" name="id" value="{{ $depot->id }}">
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <select name="banque_id" id="banque_id" class="select2_select_option form-control depot_disabled w-100 required_field" data-error-message="Le champ banque est requis">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        @foreach ($banques as $banque)
                                            <option {{ ($banque->id == $depot->banque_id)? 'selected':'' }} value="{{ $banque->id }}">{{ $banque->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="banque_montant{{ $depot->id }}">Montant <span class="text-danger">*</span></label>
                                        <input type="hidden" value="{{ $depot->banque_montant }}" name="banque_montant" id="banque_montant{{ $depot->id }}" class="montant_value">
                                        <input type="text" class="form-control shadow-none montant_format depot_disabled required_field" data-error-message="Le champ montant est requis" value="{{ EuroFormat($depot->banque_montant) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="date_depot{{ $depot->id }}">Date de dépôt <span class="text-danger">*</span></label>
                                        <input type="date" name="date_depot" id="date_depot{{ $depot->id }}" value="{{ $depot->date_depot }}" class="flatpickr form-control depot_disabled shadow-none bg-transparent required_field" data-error-message="Le champ date de dépôt est requis" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="banque_numero_de_dossier{{ $depot->id }}">Numéro de dossier <span class="text-danger">*</span></label>
                                        <input type="text" name="banque_numero_de_dossier" value="{{ $depot->banque_numero_de_dossier }}" id="banque_numero_de_dossier{{ $depot->id }}" class="form-control depot_disabled shadow-none required_field" data-error-message="Le champ numéro de dossier est requis">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="banque_status{{ $depot->id }}">Statut dépôt banque <span class="text-danger">*</span></label>
                                        <select name="banque_status" id="banque_status{{ $depot->id }}" data-id="{{ $depot->id }}" class="select2_select_option banqueStatusChange custom-select shadow-none form-control depot_disabled required_field" data-error-message="Le champ statut dépôt banque est requis">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $depot->banque_status == "Déposé" ? 'selected':'' }} value="Déposé">Déposé</option>
                                            <option {{ $depot->banque_status == "En attente de pièces complémentaires" ? 'selected':'' }} value="En attente de pièces complémentaires">En attente de pièces complémentaires</option>
                                            <option {{ $depot->banque_status == "Accord sous réserve retour contrat client" ? 'selected':'' }} value="Accord sous réserve retour contrat client">Accord sous réserve retour contrat client</option>
                                            <option {{ $depot->banque_status == "Accord définitif" ? 'selected':'' }} value="Accord définitif">Accord définitif</option>
                                            <option {{ $depot->banque_status == "Avis défavorable" ? 'selected':'' }} value="Avis défavorable">Avis défavorable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 banqueStatusWrap{{ $depot->id }}" style="display: {{ $depot->banque_status == "En attente de pièces complémentaires" ? '':'none' }}">
                                    <div class="form-group">
                                        <label class="form-label" for="Préciser_pièces_manquantes">Préciser pièces manquantes</label>
                                        <textarea name="Préciser_pièces_manquantes" id="Préciser_pièces_manquantes" class="form-control shadow-none depot_disabled">{{ $depot->Préciser_pièces_manquantes }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <div class="my-3 d-flex align-items-center">
                                        <label class="form-label mb-0 mr-2">Statut accord banque</label>
                                        <div class="multi-option-switch">
                                            <div class="multi-option-switch__body">
                                                <input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input depot_disabled StatutAccordBanqueChange" data-id="{{ $depot->id }}" id="Statut_accord_banque{{ $depot->id }}--off" name="Statut_accord_banque" {{ ($depot->Statut_accord_banque == 'no')? 'checked':'' }}>
                                                <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input depot_disabled StatutAccordBanqueChange" data-id="{{ $depot->id }}" value="n/a" id="Statut_accord_banque{{ $depot->id }}--disabled" name="Statut_accord_banque" {{ ($depot->Statut_accord_banque != 'yes' && $depot->Statut_accord_banque != 'no')? 'checked':'' }}>
                                                <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input depot_disabled StatutAccordBanqueChange" data-id="{{ $depot->id }}"  value="yes" id="Statut_accord_banque{{ $depot->id }}--on" name="Statut_accord_banque" {{ ($depot->Statut_accord_banque == 'yes')? 'checked':'' }}>
                                                <span class="multi-option-switch__float-indicator"></span>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Statut_accord_banque{{ $depot->id }}--off">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-x-lg"></i>
                                                    </span>
                                                </label>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Statut_accord_banque{{ $depot->id }}--disabled">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-circle"></i>
                                                    </span>
                                                </label>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Statut_accord_banque{{ $depot->id }}--on">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-check-lg"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Statut_accord_banque{{ $depot->id }}">Statut accord banque</label>
                                        </div>
                                        <select name="Statut_accord_banque" id="Statut_accord_banque{{ $depot->id }}"  class="select2_color_option custom-select shadow-none form-control depot_disabled Statut_accord_banque__input" data-id="{{ $depot->id }}">
                                            <option value=" " selected>{{ __('Select') }}</option>
                                            <option data-color="#000000" data-background="#93C47D" {{ $depot->Statut_accord_banque == 'Accordé' ? 'selected':'' }} value="Accordé">Accordé</option>
                                            <option data-color="#000000" data-background="#EA9999" {{ $depot->Statut_accord_banque == 'Refusé' ? 'selected':'' }} value="Refusé">Refusé</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mt-3 StatutAccordBanqueYesWrap{{ $depot->id }}" style="display: {{ ($depot->Statut_accord_banque == 'Accordé')? '':'none' }}">
                                    <div class="form-group">
                                        <label for="Montant_crédit_accepté{{ $depot->id }}" class="form-label">Montant crédit accepté</label>
                                        <input type="hidden" value="{{ $depot->Montant_crédit_accepté }}" name="Montant_crédit_accepté" id="Montant_crédit_accepté{{ $depot->id }}" class="montant_value">
                                        <input type="text" class="form-control shadow-none montant_format depot_disabled" value="{{ EuroFormat($depot->Montant_crédit_accepté) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="Date_de_notification_accord" class="form-label">Date de notification accord</label>
                                        <input type="date" name="Date_de_notification_accord" value="{{ $depot->Date_de_notification_accord }}" class="flatpickr form-control shadow-none depot_disabled">
                                    </div>
                                </div>
                                <div class="col-12 mt-3 StatutAccordBanqueNoWrap{{ $depot->id }}" style="display: {{ ($depot->Statut_accord_banque == 'Refusé')? '':'none' }}">
                                    <div class="form-group">
                                        <label for="Raison_refus_du_crédit" class="form-label">Raison refus du crédit</label>
                                        <textarea  name="Raison_refus_du_crédit" id="Raison_refus_du_crédit" class="form-control shadow-none depot_disabled">{{ $depot->Raison_refus_du_crédit }}</textarea>
                                    </div>
                                </div>
                                @include('admin.custom_field_data2', ['inputs' => $all_inputs->where('collapse_name', "banque__collapse"), 'custom_field_data' => $depot->custom_field_data, 'disabled_class' => 'depot_disabled'])
                                @if ($user_actions->where('module_name', 'collapse_depot')->where('action_name', 'edit')->first() || $role == 's_admin')
                                    <div class="col-12 text-center ">
                                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 formSubmitButton">
                                            {{ __('Submit') }}
                                        </button>
                                        @if ($role == 's_admin')
                                            <button type="button" data-collapse="banque__collapse" data-callapse_active="banque_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 depot_disabled">
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


{{-- Banque create modal --}}
<div class="modal modal--aside fade" id="depotCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>Êtes-vous sûr de vouloir créer un nouveau dépot?</span>
                <form action="{{ route('project.banque.depot.create') }}" method="POST">
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

{{-- Banque Delete Modal  --}}
<div class="modal modal--aside fade" id="BanqueDeleteButton" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                <form action="{{ route('project.banque.depot.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="banque_deleted_id">
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