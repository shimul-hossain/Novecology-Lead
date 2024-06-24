<option value="" selected>{{ __('Select') }}</option> 
@foreach ($travaux->getProducts as $product)
    <option value="{{ $product->id }}">{{ $product->reference }} </option>
@endforeach 