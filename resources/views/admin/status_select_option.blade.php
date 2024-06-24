<option value="">Etiquette</option>
@foreach ($statuses as $status)
    <option value="{{ $status->id }}">{{ $status->status }}</option>
@endforeach