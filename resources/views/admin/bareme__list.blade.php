@foreach ($barame_travaux_tags->where('rank', 1) as $bareme)
    @if ($selected_bareme && (in_array(7, $selected_bareme) || in_array(29, $selected_bareme))) 
        @if ($selected_bareme && in_array($bareme->id, $selected_bareme))
            <option value="{{ $bareme->id }}" selected>{{ $bareme->bareme }}-{{ $bareme->bareme_description }}</option>      
        @endif
    @else     
        <option value="{{ $bareme->id }}" {{ $selected_bareme && in_array($bareme->id, $selected_bareme) ? 'selected':'' }}>{{ $bareme->bareme }}-{{ $bareme->bareme_description }}</option> 
    @endif
@endforeach
 

