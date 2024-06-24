
@if ($lead) 
<form  action="{{ route('lead.travaux.question.save') }}" method="post" class="needs-validation"  novalidate>
<div class="row mb-3">
@csrf
<input type="hidden" name="data_lead_id" value="{{ $lead->id }}">
{{-- <input type="hidden" name="data_travaux" value="{{ $input->travaux }}">  --}}
@php
    if($lead->LeadBareme->whereIn('id',  [7,29])->first()){
        $travauxs = $lead->LeadTravax;
    }else{
        $travauxs = $lead->LeadBareme;
    } 
@endphp
@foreach ($travauxs as $travaux)
    {{-- @php
        $inputs =\App\Models\CRM\TravauxQuestion::where('travaux', $travaux->id)->orderBy('order')->get();
    @endphp  --}}
    <div class="col-12 my-4 text-center">
        {{-- <h3 class="my-4" style="text-decoration: underline; font-weight: bolder">{{ $travaux->bareme .' '. $travaux->bareme_description }}</h3> --}}
        <button class="btn w-100" type="button" style="background-color: #9fbfe6; max-width: 540px;">{{ $travaux->bareme .' '. $travaux->bareme_description }}</button>
    </div>
    @if ($travaux->getPrescriptionChantierNote)
        <div class="col-12">
            <div class="note-box mb-3">
                <h3 class="note-box__title">Note</h3>
                <p >{!! $travaux->getPrescriptionChantierNote->note !!}</p>
            </div>
        </div>
    @endif
    @forelse ($travaux->travauxQuestion as $input) 
            @if ($input->type == 'textarea')
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="example_project{{ $input->id }}">{{ $input->title }} @if ($input->required == 'yes') <span class="text-danger">*</span> @endif </label>
                        <textarea name="{{ $input->name }}" id="example_project{{ $input->id }}" class="form-control shadow-none question_disabled" @if ($input->required == 'yes') required @endif>{{ getCustomFieldData($input->name, $lead->question_data) }}</textarea> 
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>    
            @elseif ($input->type == 'select')
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="example_project{{ $input->id }}">{{ $input->title }} @if ($input->required == 'yes') <span class="text-danger">*</span> @endif </label>
                        <select name="{{ $input->name }}" id="example_project{{ $input->id }}" class="custom-select shadow-none form-control question_disabled" @if ($input->required == 'yes') required @endif>
                            <option value="">{{ __('Select') }}</option>
                            @foreach (explode(',', $input->options) as $item)
                                <option @if ( trim(getCustomFieldData($input->name, $lead->question_data)) == trim($item))
                                    selected
                                @endif value="{{ $item }}">{{ $item }}</option> 
                            @endforeach 
                        </select> 
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>
            @elseif ($input->type == 'radio')
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h4> {{ $input->title }} @if ($input->required == 'yes') <span class="text-danger">*</span> @endif </h4> 
                        </div>
                        @foreach (explode(',', $input->options) as $item)
                        <div class="col-4">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="radio" name="{{ $input->name }}" value="{{ $item }}" class="custom-control-input question_disabled" id="{{ $loop->iteration }}specify_heating{{ $input->id }}" @if ($input->required == 'yes') required @endif  @if (trim(getCustomFieldData($input->name, $lead->question_data)) == trim($item))
                                    checked
                                @endif>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                    <label class="custom-control-label" for="{{ $loop->iteration }}specify_heating{{ $input->id }}"> {{ $item }} </label>
                                </div>
                            </div> 
                        </div>  
                        @endforeach  
                    </div>
                </div>
            @elseif ($input->type == 'checkbox')
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h4> {{ $input->title }}</h4> 
                        </div>
                        @foreach (explode(',', $input->options) as $item)
                        <div class="col-4">
                            <div class="form-group required-checkbox">
                                <div class="custom-control custom-checkbox">
                                    <input @if (getFeature(getCustomFieldData($input->name, $lead->question_data), $item))
                                    checked
                                @endif type="checkbox" name="checkboxinput_{{ $input->name }}[]" value="{{ $item }}" class="custom-control-input question_disabled" id="{{ $loop->iteration }}specify_heating{{ $input->id }}">
                                    <label class="custom-control-label" for="{{ $loop->iteration }}specify_heating{{ $input->id }}"> {{ $item }}</label>
                                </div>
                            </div> 
                        </div>  
                        @endforeach  
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="example_project{{ $input->id }}">{{ $input->title }} @if ($input->required == 'yes') <span class="text-danger">*</span> @endif </label>
                        <input type="{{ $input->type }}" name="{{ $input->name }}" id="example_project{{ $input->id }}" value="{{ getCustomFieldData($input->name, $lead->question_data) }}" class="form-control shadow-none question_disabled" @if ($input->required == 'yes') required @endif>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>    
            @endif 
        @empty 
    {{-- <div class="row"> 
        <div class="col-12">
            <h3 class="text-center">
                {{ __('No Question For This Bareme') }} 
            </h3>
        </div>
    </div> --}}
    @endforelse  
@endforeach 
    @if (checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'edit') || role() == 's_admin')
        <div class="col-12 text-center">
            <button type="submit" data-toggle="false" data-target="#leadCardCollapse-5" aria-expanded="false" aria-controls="leadCardCollapse-5" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 question_save_validation question_disabled">
                {{ __('Submit') }}
            </button>
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
@else
{{-- <div class="row"> 
    <div class="col-12">
        <h3 class="text-center">
            {{ __('No Question For This Bareme') }} 
        </h3>
    </div>
</div> --}}
@endif