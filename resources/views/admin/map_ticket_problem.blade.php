<option selected value="">{{ __('Select') }}</option>
@foreach ($problems as $problem)
    <option value="{{ $problem->id }}">{{ $problem->name }}</option>
@endforeach