<option value="">{{ __('Select') }}</option>
@foreach ($projects as $item)
    <option value="{{ $item->id }}">{{ $item->Prenom }}</option>
@endforeach 