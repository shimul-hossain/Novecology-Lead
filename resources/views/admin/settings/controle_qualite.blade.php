@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('ContrôleQualitéTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-quality_control" role="tabpanel" aria-labelledby="v-pills-quality_control-tab">
        <form action="{{ route('quality.control.create') }}" class="setting-form" id="qualityControlTypeForm" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">Contrôle Qualité</h3>
                    <div class="form-group">
                        <label class="form-label" for="quality_controle_name">Contrôle Qualité <span class="text-danger">*</span></label>
                        <input type="text" id="quality_controle_name" name="name" class="form-control shadow-none rounded" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div id="addMoreQuestion__qc"> 
                    </div>
                </div>
                <div class="col-12 mt-3">
                    @if (checkAction(Auth::id(), 'general__setting-quality_control', 'create') || role() == 's_admin')
                        <button type="button" id="qualityControlBtn" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
                        <button type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2" id="add_more_question_btn__qc">nouvelle question</button>
                        <button id="add_more_header" type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2">
                            <span class="mr-2"></span>
                            + {{ __('Add Headers') }}
                        </button>
                    @else
                        <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
                    @endif
                </div>
                <div class="col-12" >
                    <div class="table-responsive">
                        <table class="table database-table w-100 mb-0">
                            <thead class="database-table__header">
                                <tr>
                                    <th>{{ __('Serial') }}</th>
                                    <th>Contrôle Qualité</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="database-table__body">
                                @foreach ($quality_controls as $quality_control)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $quality_control->name }}</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    @if (checkAction(Auth::id(), 'general__setting-quality_control', 'edit') || role() == 's_admin')
                                                        <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#quality_control_edit{{ $quality_control->id }}">
                                                            <span class="novecologie-icon-edit mr-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @else
                                                        <button  type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @endif
                                                    @if (checkAction(Auth::id(), 'general__setting-quality_control', 'view') || role() == 's_admin')
                                                        <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#quality_control_view{{ $quality_control->id }}">
                                                            <span class="novecologie-icon-eye mr-1"></span>
                                                            {{ __('View') }}
                                                        </button>
                                                    @else
                                                        <button  type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            {{ __('View') }}
                                                        </button>
                                                    @endif
                                                    @if (checkAction(Auth::id(), 'general__setting-quality_control', 'delete') || role() == 's_admin')
                                                        <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#quality_control_delete{{ $quality_control->id }}">
                                                            <span class="novecologie-icon-trash mr-1"></span>
                                                                Supprimer
                                                        </button>
                                                    @else
                                                        <button type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                                Supprimer
                                                        </button>
                                                    @endif

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal-content')
    @foreach ($quality_controls as $quality_control)
        <div class="modal modal--aside fade leftAsideModal" id="quality_control_edit{{ $quality_control->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">Contrôle Qualité</h1>
                    <form action="{{ route('quality.control.update') }}" class="form mx-auto needs-validation"  novalidate method="POST" id="qualityControleUpdateForm{{ $quality_control->id }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="quality_controls__edit{{ $quality_control->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
                            <input type="text" id="quality_controls__edit{{ $quality_control->id }}" name="name" value="{{ $quality_control->name }}" class="form-control shadow-none rounded" required>
                            <input type="hidden" name="id" value="{{ $quality_control->id }}">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div id="addMoreQuestion__qc__edit{{ $quality_control->id }}">
                            @foreach ($quality_control->getQuestions as $qc__question)
                                @if ($qc__question->type == 'question')
                                    <div class='new_qc__block'>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label class="form-label" for="label_title__qc0{{ $qc__question->id }}">{{ __('Question') }} <span class="text-danger">*</span></label>
                                                <button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
                                            </div>
                                            <input type="text" value="{{ $qc__question->question_title }}" name="label_title[]" id="label_title__qc0{{ $qc__question->id }}" class="form-control shadow-none qc_question_title__edit{{ $quality_control->id }}">
                                            <input type="hidden" name="type[]" value="question">
                                            <input type="hidden" name="qc_header_color[]">
                                            <input type="hidden" name="question_id[]" value="{{ $qc__question->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="input_type__qc0{{ $qc__question->id }}">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
                                            <select name="input_type[]" id="input_type__qc0{{ $qc__question->id }}"  class="select2_select_option custom-select shadow-none form-control">
                                                <option {{ $qc__question->question_type == 'text' ? 'selected':'' }} value="text">{{ __('Text') }}</option>
                                                <option {{ $qc__question->question_type == 'number' ? 'selected':'' }} value="number">{{ __('Number') }}</option>
                                                <option {{ $qc__question->question_type == 'email' ? 'selected':'' }} value="email">{{ __('Email') }}</option>
                                                <option {{ $qc__question->question_type == 'radio' ? 'selected':'' }} value="radio">{{ __('Radio') }}</option>
                                                <option {{ $qc__question->question_type == 'checkbox' ? 'selected':'' }} value="checkbox">{{ __('Checkbox') }}</option>
                                                <option {{ $qc__question->question_type == 'select' ? 'selected':'' }} value="select">{{ __('Dropdown') }}</option>
                                                <option {{ $qc__question->question_type == 'textarea' ? 'selected':'' }} value="textarea">{{ __('Textarea') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="required_optional__qc0{{ $qc__question->id }}">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
                                            <select name="required_optional[]" id="required_optional__qc0{{ $qc__question->id }}"  class="select2_select_option custom-select shadow-none form-control">
                                                <option {{ $qc__question->question_required == 'no' ? 'selected':'' }} value="no">{{ __('Optional') }}</option>
                                                <option {{ $qc__question->question_required == 'yes' ? 'selected':'' }} value="yes">{{ __('Required') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="options__qc0{{ $qc__question->id }}">{{ __('Options') }}</label>
                                            <textarea name="options[]" id="options__qc0{{ $qc__question->id }}" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}">{{ $qc__question->question_options }}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="new_qc__block">
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label class="form-label" for="qc_header0{{ $qc__question->id }}">{{ __('Header Title') }} <span class="text-danger">*</span></label>
                                                <button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_question_block__qc">×</button>
                                            </div>
                                            <input type="text" value="{{ $qc__question->header_title }}" name="label_title[]" id="qc_header0{{ $qc__question->id }}" class="form-control shadow-none qc_question_title" required>
                                            <input type="hidden" name="type[]" value="header">
                                            <input type="hidden" name="options[]">
                                            <input type="hidden" name="input_type[]">
                                            <input type="hidden" name="required_optional[]">
                                            <input type="hidden" name="question_id[]" value="{{ $qc__question->id }}">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="qc_header_color0{{ $qc__question->id }}">{{ __('Header Background Color') }} <span class="text-danger">*</span></label>
                                            <input type="color" name="qc_header_color[]" id="qc_header_color0{{ $qc__question->id }}" class="form-control shadow-none" value="{{ $qc__question->header_color }}" required>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="form-group mt-4">
                            <button type="button"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2 qualityControlBtn__edit" data-id="{{ $quality_control->id }}" >{{ __('Update') }}</button>
                            <button type="button" data-id="{{ $quality_control->id }}" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2 add_more_question_btn__qc__edit">nouvelle question</button>
                            <button type="button" data-id="{{ $quality_control->id }}" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2 add_more_header__edit">
                                <span class="mr-2"></span>
                                + {{ __('Add Headers') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal modal--aside fade leftAsideModal" id="quality_control_view{{ $quality_control->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">Contrôle Qualité</h1>
                    <div class="pdf-page pdf-page--1">
                        <div class="pdf-card">
                            <div class="pdf-card__body">
                                @foreach ($quality_control->getQuestions as $qc_question)
                                    @if ($qc_question->type == 'question')
                                        @if ($qc_question->question_type == 'textarea')
                                            <div class="form-group">
                                                <label for="qc_question_label{{ $qc_question->id }}" class="form-label"> {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }} </label>
                                                <textarea name="{{ $qc_question->question_name }}" id="qc_question_label{{ $qc_question->id }}" class="form-control shadow-none cq__disabled" {{ $qc_question->question_required == 'yes' ? 'required':'' }}></textarea>
                                            </div>
                                        @elseif ($qc_question->question_type == 'select')
                                        <div class="form-group">
                                            <label for="qc_question_label{{ $qc_question->id }}" class="form-label">
                                                {{ $qc_question->question_title }} {{ $qc_question->question_required == 'yes' ? '*':'' }}
                                            </label>
                                            <select class="select2_select_option form-control w-100 cq__disabled" id="qc_question_label{{ $qc_question->id }}" name="{{ $qc_question->question_name }}" {{ $qc_question->question_required == 'yes' ? 'required':'' }}>
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    @foreach (explode(',', $qc_question->question_options) as $item)
                                                        <option value="{{ $item }}">{{ $item }}</option>
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
                                                            <input type="radio" name="{{ $qc_question->question_name }}" value="{{ $item }}" class="custom-control-input cq__disabled" id="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}" {{ $qc_question->question_required == 'yes' ? 'required':'' }}>
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
                                                            <input type="checkbox" name="checkboxinput_{{ $qc_question->question_name }}[]" value="{{ $item }}" class="custom-control-input cq__disabled" id="{{ $loop->iteration }}qc_question_label{{ $qc_question->id }}">
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
                                                <input type="{{ $qc_question->question_type }}" name="{{ $qc_question->question_name }}" id="qc_question_label{{ $qc_question->id }}" class="form-control shadow-none cq__disabled">
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
                </div>
            </div>
            </div>
        </div>
        <div class="modal modal--aside fade" id="quality_control_delete{{ $quality_control->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                            <span class="novecologie-icon-close"></span>
                        </button>
                    </div>
                    <div class="modal-body text-center pt-0">
                        <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                        <span>{{ __('Are You Sure To Delete this') }} ?</span>
                        <form action="{{ route('quality.control.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $quality_control->id }}">
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
    @endforeach
@endsection