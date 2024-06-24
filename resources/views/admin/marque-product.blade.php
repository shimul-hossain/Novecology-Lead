@foreach ($products as $product)
    @if ($product->marque_id == $marque)
        <option value="{{ $product->id }}">{{ $product->reference }}</option>
    @endif
@endforeach