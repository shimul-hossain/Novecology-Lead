@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('PrescriptionTabActive', 'active')

@push('plugins-link')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/plugins/forms/form-quill-editor.css') }}">
@endpush

@push('plugins-script')
<script src="{{ asset('dashboard_assets/vendors/js/editors/quill/quill.min.js') }}"></script> 
@endpush 

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
       
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('travaux.question.add') }}" class="setting-form" id="generalInfoForm3" method="POST">
                        @csrf
                        <h3 class="mb-4">Prescription chantier</h3>
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label" for="travaux">{{ __('Select Barèmes') }} <span class="text-danger">*</span></label>
                                @if (checkAction(Auth::id(), 'general__setting-baremes', 'create') || role() == 's_admin')
                                    <button type="button" class="secondary-btn border-0 mb-1" data-toggle="modal" data-target="#travauxModal">+ {{ __('Add new') }}</button>
                                @else
                                    <button type="button" class="secondary-btn border-0 mb-1"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
                                @endif
                            </div>
                            <select name="travaux" id="travaux"  class="select2_select_option custom-select shadow-none form-control">
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($bareme_travaux_tags->where('rank', 1) as $baremes)
                                    <option value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="addMoreQuestion">
                            <div class="form-group">
                                <label class="form-label" for="label_title">{{ __('Question') }} <span class="text-danger">*</span></label>
                                <input type="text" name="label_title[]" id="label_title" class="form-control shadow-none question_title">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="input_type">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
                                <select name="input_type[]" id="input_type"  class="select2_select_option custom-select shadow-none form-control">
                                    <option value="text">{{ __('Text') }}</option>
                                    <option value="number">{{ __('Number') }}</option>
                                    <option value="email">{{ __('Email') }}</option>
                                    <option value="radio">{{ __('Radio') }}</option>
                                    <option value="checkbox">{{ __('Checkbox') }}</option>
                                    <option value="select">{{ __('Dropdown') }}</option>
                                    <option value="textarea">{{ __('Textarea') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="required_optional">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
                                <select name="required_optional[]" id="required_optional"  class="select2_select_option custom-select shadow-none form-control">
                                    <option value="no">{{ __('Optional') }}</option>
                                    <option value="yes">{{ __('Required') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="options">{{ __('Options') }}</label>
                                <textarea name="options[]" id="options" class="form-control shadow-none" placeholder="{{ __('Enter Options. Each option seperate with comma ,') }}"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="order">{{ __('Order') }}</label>
                                <input type="number" name="order[]" id="order" class="form-control shadow-none">
                            </div>
                        </div>
                        @if (checkAction(Auth::id(), 'general__setting-question', 'create') || role() == 's_admin')
                            <button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" id="question_submit_btn">{{ __('Save changes') }}</button>
                            <button type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2" id="add_more_question_btn">{{ __('Add More') }}</button>
                        @else
                        <button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Save changes') }}</button>
                        @endif
                    </form>
                </div> 
                <div class="col-12">
                    <div class="table-responsive simple-bar" id="question_inputs">

                    </div>
                </div>
            </div> 
    </div>
@endsection

@section('modal-content')
<div id="questions_input_modal">

</div>
@endsection