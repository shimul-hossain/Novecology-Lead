<option value="" selected>{{ __('Select') }}</option> 
@foreach ($sub_categories as $sub_category)
    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
@endforeach