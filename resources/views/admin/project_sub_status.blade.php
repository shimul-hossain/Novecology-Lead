<option value="" selected disabled>{{ __('Select') }}</option>
@foreach ($project_sub_status as $sub_status)
    <option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
@endforeach