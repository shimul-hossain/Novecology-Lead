<option value="" selected>{{ __('Select') }}</option>
@foreach ($problems as $problem)
    <option data-deadline="{{ $problem->deadline }}" value="{{ $problem->id }}">{{ $problem->name }}</option>
@endforeach