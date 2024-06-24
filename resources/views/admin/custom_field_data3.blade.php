@foreach ($inputs as $input)
    @if ($input->input_type == 'checkbox')
        <input type="hidden" name="custom_field_name[]" value="checkboxinput_{{ $input->name }}">    
    @else
        <input type="hidden" name="custom_field_name[]" value="{{ $input->name }}">    
    @endif
    @if ($input->input_type == 'textarea')
        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="lead_tracking{{ $input->id }}">{{ $input->title }}</label>
                <textarea name="{{ $input->name }}" id="lead_tracking{{ $input->id }}" class="form-control shadow-none tracking_disabled"></textarea>
                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
            </div>
        </div>
    @elseif ($input->input_type == 'select')
        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="lead_tracking{{ $input->id }}">{{ $input->title }}</label>
                <select name="{{ $input->name }}" id="lead_tracking{{ $input->id }}" class="custom-select shadow-none form-control tracking_disabled">
                    <option value="" selected>{{ __('Select') }}</option>
                    @foreach (explode(',', $input->options) as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
            </div>
        </div>
    @elseif ($input->input_type == 'radio')
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <label class="form-label"> {{ $input->title }}</label>
                </div>
                @foreach (explode(',', $input->options) as $item)
                <div class="col-12">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="radio" name="{{ $input->name }}" value="{{ trim($item) }}" class="custom-control-input tracking_disabled" id="{{ $loop->iteration }}lead_tracking{{ $input->id }}">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            <label class="custom-control-label" for="{{ $loop->iteration }}lead_tracking{{ $input->id }}"> {{ $item }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @elseif ($input->input_type == 'checkbox')
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <label class="form-label"> {{ $input->title }}</label>
                </div>
                @foreach (explode(',', $input->options) as $item)
                <div class="col-12">
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="checkboxinput_{{ $input->name }}[]"  value="{{ trim($item) }}" class="custom-control-input tracking_disabled" id="{{ $loop->iteration }}lead_tracking{{ $input->id }}">
                            <label class="custom-control-label" for="{{ $loop->iteration }}lead_tracking{{ $input->id }}"> {{ $item }}</label>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="col-12">
            <div class="form-group">
                <label class="form-label" for="lead_tracking{{ $input->id }}">{{ $input->title }}</label>
                <input type="{{ $input->input_type }}" name="{{ $input->name }}" id="lead_tracking{{ $input->id }}" 
                @if ($input->input_type == 'date')
                    class="flatpickr flatpickr-input form-control shadow-none tracking_disabled" placeholder="{{ __('dd-mm-yyyy') }}"
                @else
                    class="form-control shadow-none tracking_disabled"
                @endif
                >
                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
            </div>
        </div>
    @endif

    <div class="modal modal--aside fade" id="customInputFieldDelete{{ $input->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                    <form action="{{ route('project.custom.field.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="input_id" value="{{ $input->id }}">
                        <input type="hidden" name="callapse_active" class="callapse_active" value="">
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