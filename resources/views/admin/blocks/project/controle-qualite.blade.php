@php 
    $quality_controls = \App\Models\CRM\ControleQuality::where('project_id', $project->id)->orderBy('id', 'desc')->get();
    $qc_type = \App\Models\CRM\QualityControlType::all();
@endphp
<div class="accordion" id="leadAccordionqualityControl">
    @if ($user_actions->where('module_name', 'collapse__qc')->where('action_name', 'create')->first() || $role == 's_admin')
        <button class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#qualityControlCreateModal">
            <span class="mr-2"></span>
            + Nouveau CQ
        </button>
    @else
        <button class="mb-2 primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">
            <span class="mr-2"></span>
            <span class="novecologie-icon-lock py-1"></span>
        </button>
    @endif
    @if ($user_actions->where('module_name', 'collapse__qc')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse__qc')->where('action_name', 'edit')->first() || $role == 's_admin')
        @foreach ($quality_controls as $qc)
            @if ($qc->getType)
                <div class="card lead__card border-0">
                    <div class="card-header bg-transparent border-0 p-0" id="leadCard-qualityControl{{ $qc->id }}">
                    <h2 class="mb-0">
                        @if ($user_actions->where('module_name', 'collapse__qc')->where('action_name', 'delete')->first() || $role == 's_admin')
                            <button type="button" class="btn btn-icon shadow-none top-right qcDeleteButton" data-id="{{ $qc->id }}"><i class="bi bi-trash3"></i></button>
                        @endif
                        <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-xl-center w-100 collapseBtn">
                            <div class="lead__card__toggler__content w-100">
                                <h3 class="lead__card__toggler__content__heading">CQ {{ $quality_controls->count() - $loop->index }}</h3>
                                <div class="lead__card__toggler__content__row">
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">TYPE : </strong>
                                                <span class="text-dark">{{ $qc->getType->name ?? '' }}</span>
                                            </p>
                                        </div>
                                        <div class="col-xl-6">
                                            <p class="lead__card__toggler__content__row__text">
                                                <strong class="lead__card__toggler__content__row__title">Date : </strong>
                                                <span class="text-dark">{{ \Carbon\Carbon::parse($qc->created_at)->format('d-m-Y') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <span class="d-block ml-auto">
                                <span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
                            </span> --}}
                            <button data-tab="Contrôle Qualité" data-block="CQ {{ $loop->iteration }}" data-tab-class="controle_quaility__part{{ $qc->id }}" type="button" data-toggle="collapse" data-target="#leadCardCollapse-qualityControl{{ $qc->id }}" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('controle_quaility__part'.$qc->id) }} position-relative ml-auto mr-1 {{ session('controle_quaility__part'.$qc->id) == 'active' ? 'collapsed':'' }}">
                                <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                            </button>
                        </div>
                    </h2>
                    </div>
                    <div id="leadCardCollapse-qualityControl{{ $qc->id }}" class="collapse {{ session('controle_quaility__part'.$qc->id) == 'active' ? 'show':'' }}" aria-labelledby="leadCard-qualityControl{{ $qc->id }}">
                        <div class="card-body">
                            <div class="pdf-container">

                                    {{-- @if ($qc->quality_control_type == 'CQ Post-Etude') --}}
                                        <form action="{{ route('project.quality.control.post.etude.update') }}" method="POST" class="pdf-form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $qc->id }}">
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                            <input type="hidden" name="block_name" value="CQ {{ $loop->iteration }}">

                                            <div class="pdf-page pdf-page--1">
                                                <div class="pdf-card">
                                                    <div class="pdf-card__body">
                                                        @foreach ($qc->getType->getQuestions as $qc_question)
                                                            @if ($qc_question->type == 'question')
                                                                @if ($qc_question->question_type == 'checkbox')
                                                                    <input type="hidden" name="field_name[]" value="checkboxinput_{{ $qc_question->question_name }}">
                                                                @else
                                                                    <input type="hidden" name="field_name[]" value="{{ $qc_question->question_name }}">
                                                                @endif
                                                                @if ($qc_question->question_type == 'textarea')
                                                                    <div class="form-group">
                                                                        <label for="qc_question_label{{ $qc_question->id }}" class="form-label"> {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }} </label>
                                                                        <textarea {{ $qc->status == 1 ? (($role == 's_admin' || $role == 'manager_direction')? '':'disabled' ):'' }} name="{{ $qc_question->question_name }}" id="qc_question_label{{ $qc_question->id }}" class="form-control shadow-none cq__disabled" {{ $qc_question->question_required == 'yes' ? 'required':'' }}>{{ qualityControlInputValue($qc->id, $qc_question->question_name) }}</textarea>
                                                                    </div>
                                                                @elseif ($qc_question->question_type == 'select')
                                                                <div class="form-group">
                                                                    <label for="qc_question_label{{ $qc_question->id }}" class="form-label">
                                                                        {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }}
                                                                    </label>
                                                                    <select class="select2_select_option form-control w-100 cq__disabled" id="qc_question_label{{ $qc_question->id }}" {{ $qc->status == 1 ? (($role == 's_admin' || $role == 'manager_direction')? '':'disabled' ):'' }} name="{{ $qc_question->question_name }}" {{ $qc_question->question_required == 'yes' ? 'required':'' }}>
                                                                            <option value="" selected>{{ __('Select') }}</option>
                                                                            @foreach (explode(',', $qc_question->question_options) as $item)
                                                                                <option @if ( trim(qualityControlInputValue($qc->id, $qc_question->question_name)) == trim($item))
                                                                                    selected
                                                                                @endif value="{{ $item }}">{{ $item }}</option>
                                                                            @endforeach
                                                                    </select>
                                                                </div>
                                                                @elseif ($qc_question->question_type == 'radio')
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h4>  {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }} </h4>
                                                                        </div>
                                                                        @foreach (explode(',', $qc_question->question_options) as $item)
                                                                        <div class="col-4">
                                                                            <div class="form-group">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input type="radio" {{ $qc->status == 1 ? (($role == 's_admin' || $role == 'manager_direction')? '':'disabled' ):'' }} name="{{ $qc_question->question_name }}" value="{{ $item }}" class="custom-control-input cq__disabled" id="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}" {{ $qc_question->question_required == 'yes' ? 'required':'' }} @if (trim(qualityControlInputValue($qc->id, $qc_question->question_name)) == trim($item))
                                                                                    checked
                                                                                @endif>
                                                                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                                                                    <label class="custom-control-label" for="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}"> {{ $item }} </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                @elseif ($qc_question->question_type == 'checkbox')
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <h4> {{ $qc_question->question_title }} </h4>
                                                                        </div>
                                                                        @foreach (explode(',', $qc_question->question_options) as $item)
                                                                        <div class="col-4">
                                                                            <div class="form-group required-checkbox">
                                                                                <div class="custom-control custom-checkbox">
                                                                                    <input @if (getFeature(qualityControlInputValue($qc->id, $qc_question->question_name), $item))
                                                                                    checked
                                                                                @endif type="checkbox" {{ $qc->status == 1 ? (($role == 's_admin' || $role == 'manager_direction')? '':'disabled' ):'' }} name="checkboxinput_{{ $qc_question->question_name }}[]" value="{{ $item }}" class="custom-control-input cq__disabled" id="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}">
                                                                                    <label class="custom-control-label" for="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}"> {{ $item }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                @else
                                                                    <div class="form-group">
                                                                        <label for="qc_question_label{{ $qc_question->id }}" class="form-label">
                                                                            {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }}
                                                                        </label>
                                                                        <input type="{{ $qc_question->question_type }}" {{ $qc->status == 1 ? (($role == 's_admin' || $role == 'manager_direction')? '':'disabled' ):'' }}  value="{{ qualityControlInputValue($qc->id, $qc_question->question_name) }}" name="{{ $qc_question->question_name }}" id="qc_question_label{{ $qc_question->id }}" class="form-control shadow-none cq__disabled">
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="pdf-card__head" style="background-color: {{ $qc_question->header_color }}">
                                                                    <h3 class="pdf-card__head__title text-center mb-4">{{ $qc_question->header_title }}</h3>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($user_actions->where('module_name', 'collapse__qc')->where('action_name', 'edit')->first() || $role == 's_admin')
                                                <div class="text-center">
                                                    @if ($qc->status == 1)
                                                        @if ($role == 's_admin' || $role == 'manager_direction')
                                                            <button type="button" data-toggle="modal" data-target="#qcSubmitModal{{ $qc->id }}" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                                                {{ __('Submit') }}
                                                            </button>
                                                        @else
                                                            <button type="button" disabled data-toggle="false"  class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                                                Fermée
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button" data-toggle="modal" data-target="#qcSubmitModal{{ $qc->id }}" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                                            {{ __('Submit') }}
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="modal modal--aside fade" id="qcSubmitModal{{ $qc->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content border-0">
                                                            <div class="modal-header border-0 pb-0">
                                                                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                                                    <span class="novecologie-icon-close"></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center pt-0">
                                                                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                                                                <span> Etes vous sûr de vouloir valider votre CQ</span>
                                                                <div class="d-flex justify-content-center">
                                                                    <button type="submit" name="qc_status" value="yes" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1">
                                                                        Oui
                                                                    </button>
                                                                    <button type="submit" name="qc_status" value="no" class="primary-btn btn-primary primary-btn--md rounded border-0 my-3 mx-1">
                                                                        Non
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                    </button>
                                                </div>
                                            @endif
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>


{{-- Quality Control create modal --}}
<div class="modal modal--aside fade" id="qualityControlCreateModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">Créer une Contrôle Qualité </h1>
                <form action="{{ route('project.quality.control.create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                        <label for="#" class="form-label text-left">Contrôle Qualité</label>
                        <select class="form-control shadow-none" name="qc_type_id" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            @foreach ($qc_type as $q_type)
                                <option value="{{ $q_type->id }}">{{ $q_type->name }}</option>
                            @endforeach
                            {{-- <option value="CQ Post-Etude">CQ Post-Etude</option>
                            <option value="CQ Post-Installation">CQ Post-Installation</option>
                            <option value="CQ Post-Previsite technico-commercial">CQ Post-Previsite technico-commercial</option>  --}}
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

{{--  CQ Delete Modal  --}}
<div class="modal modal--aside fade" id="CQDeleteButton" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                <form action="{{ route('project.quality.control.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="qc_deleted_id">
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