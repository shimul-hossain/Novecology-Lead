@if ($cumac)
    <option value="" selected>{{ __('Select') }}</option>
    @foreach ($cumac->getCumac as $item)
        <option data-value="{{ $item->mode_de_chauffage }}" value="{{ $item->gain_cef }}">{{ $item->mode_de_chauffage }}</option>
    @endforeach
@else
<option value="" selected>{{ __('Select') }}</option>
@endif