@php
    $bareme_status = false;
    if($project->ProjectBareme->whereIn('id',  [28,29])->first()){
        $bareme_status = true;
    }
    $not_convertable = false;
    $not_convertable2 = false;
    if(!$bareme_status && (!$project->primaryTax || $project->primaryTax->tax_number == '0000000000')){
        $not_convertable = true;
    }
    if($project->getSubventions->first() && (!$project->getSubventions->first()->subvention_status || $project->getSubventions->first()->subvention_status == 'Demande de subvention déposé' || $project->getSubventions->first()->subvention_status == 'En cours d’instruction' || $project->getSubventions->first()->subvention_status == 'Dépôt de subvention en attente de complément')){
        $not_convertable2 = true;
    }
@endphp
<div class="modal modal--aside fade" id="project_status__change" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>Confirmer la nouvelle etiquette de votre chantier</span>
                <form action="{{ route('project.status.change') }}" method="POST" class="status_change__modal">
                    @csrf
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <div class="status_change__btn_block">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                Non
                            </button>
                            <button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
                                Oui
                            </button>
                        </div>
                    </div>
                    <div class="status_change__input text-left" style="display: none">
                        <div class="form-group mt-3">
                            <label class="form-label" for="project_staus_new{{ $project->id }}">Confirmer le nouvelle etiquette de votre chantier</label>
                            <select name="status" id="project_staus_new{{ $project->id }}" data-id="{{ $project->id }}" class="select2_select_option custom-select shadow-none form-control project_staus__change" required>
                                <option value="" selected disabled>{{ __('Select') }}</option>
                                <option {{ $project->project_label == 1 ? 'selected':'' }} value="1">En Cours</option>
                                @if ($project->Type_de_contrat && $project->Faisabilité_du_projet && $project->Statut_Projet || ($project->Type_de_contrat == 'BAR TH 173' && $project->project_label != 5 && $project->project_label != 6))
                                    <option {{ $project->project_label == 2 ? 'selected':'' }} value="2">Prévisite Réalisé</option>
                                    <option {{ $project->project_label == 3 ? 'selected':'' }} {{ $not_convertable ? 'disabled':'' }} value="3">Déposé {{ $not_convertable ? '(Avis d’Impot pas réel)':'' }}</option>
                                    <option {{ $project->project_label == 4 ? 'selected':'' }} {{ ($not_convertable || $not_convertable2) ? 'disabled':'' }} value="4">Accepté {{ $not_convertable ? '(Avis d’Impot pas réel)':($not_convertable2 ? '(Statut MPR - La subvention est invalide)':'') }}</option>
                                    <option {{ $project->project_label == 8 ? 'selected':'' }} {{ ($not_convertable || $not_convertable2) ? 'disabled':'' }} value="8">Installation en cours {{ $not_convertable ? '(Avis d’Impot pas réel)':($not_convertable2 ? '(Statut MPR - La subvention est invalide)':'') }}</option>
                                    <option {{ $project->project_label == 5 ? 'selected':'' }} {{ ($not_convertable || $not_convertable2) ? 'disabled':'' }} value="5">Installé {{ $not_convertable ? '(Avis d’Impot pas réel)':($not_convertable2 ? '(Statut MPR - La subvention est invalide)':'') }}</option>
                                    <option {{ $project->project_label == 6 ? 'selected':'' }} {{ ($not_convertable || $not_convertable2) ? 'disabled':'' }} value="6">Terminé {{ $not_convertable ? '(Avis d’Impot pas réel)':($not_convertable2 ? '(Statut MPR - La subvention est invalide)':'') }}</option>
                                    <option {{ $project->project_label == 7 ? 'selected':'' }} value="7">KO</option>
                                @else
                                    <option {{ $project->project_label == 2 ? 'selected':'' }} disabled>Prévisite Réalisé (Informations sur le projet manquantes)</option>
                                    <option {{ $project->project_label == 3 ? 'selected':'' }} disabled>Déposé (Informations sur le projet manquantes)</option>
                                    <option {{ $project->project_label == 4 ? 'selected':'' }} disabled>Accepté (Informations sur le projet manquantes)</option>
                                    <option {{ $project->project_label == 8 ? 'selected':'' }} disabled>Installation en cours (Informations sur le projet manquantes)</option>
                                    <option {{ $project->project_label == 5 ? 'selected':'' }} disabled>Installé (Informations sur le projet manquantes)</option>
                                    <option {{ $project->project_label == 6 ? 'selected':'' }} disabled>Terminé (Informations sur le projet manquantes)</option>
                                    <option {{ $project->project_label == 7 ? 'selected':'' }} disabled>KO (Informations sur le projet manquantes)</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="project_sub_staus_new{{ $project->id }}">Merci de renseigner le nouveau statut de votre chantier</label>
                            <select name="sub_status" id="project_sub_staus_new{{ $project->id }}" class="select2_select_option custom-select shadow-none form-control" required>
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($project_sub_status as $sub_status)
                                    <option {{ $project->project_sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group dead_reason__wrap" style="display: {{ $project->project_label == 7 ? '':'none' }}">
                            <label class="form-label" for="dead-reason{{ $project->id }}">Raisons <span class="text-danger">*</span></label>
                            <textarea rows="3" name="dead_reason" id="dead-reason{{ $project->id }}" class="form-control shadow-none"></textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>