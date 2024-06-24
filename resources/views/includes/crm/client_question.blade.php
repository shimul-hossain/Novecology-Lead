@if ($work)
    @foreach (explode(',', $work->travaux) as $travaux)
    @php
        $inputs =\App\Models\CRM\TravauxQuestion::where('travaux', $travaux)->orderBy('order')->get();
    @endphp 
        @forelse ($inputs as $input)
            @if ($loop->first)
            <form  action="{{ route('client.travaux.question.save') }}" method="post" class="needs-validation"  novalidate>
            <div class="row mb-3">
            @csrf
            <input type="hidden" name="data_client_id" value="{{ $work->client_id }}">
            <input type="hidden" name="data_travaux" value="{{ $input->travaux }}">
            @endif
            @if ($input->type == 'textarea')
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="example_project{{ $input->id }}">{{ $input->title }} @if ($input->required == 'yes') <span class="text-danger">*</span> @endif </label>
                        <textarea name="{{ $input->name }}" id="example_project{{ $input->id }}" class="form-control shadow-none question_disabled" @if ($input->required == 'yes') required @endif>{{ getClientInputValue($work->client_id, $travaux, $input->name) }}</textarea> 
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>    
            @elseif ($input->type == 'select')
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label" for="example_project{{ $input->id }}">{{ $input->title }} @if ($input->required == 'yes') <span class="text-danger">*</span> @endif </label>
                        <select name="{{ $input->name }}" id="example_project{{ $input->id }}" class="custom-select shadow-none form-control question_disabled" @if ($input->required == 'yes') required @endif>
                            <option value="">Select</option>
                            @foreach (explode(',', $input->options) as $item)
                                <option @if ( trim(getClientInputValue($work->client_id, $travaux, $input->name)) == trim($item))
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
                                    <input type="radio" name="{{ $input->name }}" value="{{ $item }}" class="custom-control-input" id="{{ $loop->iteration }}specify_heating{{ $input->id }}" @if ($input->required == 'yes') required @endif  @if (trim(getClientInputValue($work->client_id, $travaux, $input->name)) == trim($item))
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
                                    <input @if (getFeature(getClientInputValue($work->client_id, $travaux, $input->name), $item))
                                    checked
                                @endif type="checkbox" name="checkboxinput_{{ $input->name }}[]" value="{{ $item }}" class="custom-control-input " id="{{ $loop->iteration }}specify_heating{{ $input->id }}">
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
                        <input type="{{ $input->type }}" name="{{ $input->name }}" id="example_project{{ $input->id }}" value="{{ getClientInputValue($work->client_id, $travaux, $input->name) }}" class="form-control shadow-none question_disabled" @if ($input->required == 'yes') required @endif>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>    
            @endif
            @if ($loop->last) 
                    <div class="col-12 text-center">
                        <button type="submit" data-toggle="false" data-target="#leadCardCollapse-5" aria-expanded="false" aria-controls="leadCardCollapse-5" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 question_save_validation">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </div>
            </form>
            @endif 
        @empty 
        <div class="row"> 
            <div class="col-12">
                <h3 class="text-center">
                    {{ __('No Question For This Travaux') }} 
                </h3>
            </div>
        </div>
        @endforelse 
    @endforeach
@else
    <div class="row"> 
        <div class="col-12">
            <h3 class="text-center">
                {{ __('No Question For This Travaux') }} 
            </h3>
        </div>
    </div>
@endif