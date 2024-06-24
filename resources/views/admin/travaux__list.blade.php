@foreach ($barame_travaux_tags as $travaux)
    @if ($selected_bareme && (in_array(7, $selected_bareme) || in_array(29, $selected_bareme))) 
        @if ($selected_bareme && in_array($travaux->id, $selected_bareme))
            <option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>  
        @else
            <option value="{{ $travaux->id }}" {{ $selected_travaux && in_array($travaux->id, $selected_travaux) ? 'selected':'' }}>{{ $travaux->travaux }}</option>   
        @endif
    @else    
        @if ($travaux->rank == '1')
            @if ($selected_bareme && in_array($travaux->id, $selected_bareme))
                <option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option> 
            @endif
        @else
        <option value="{{ $travaux->id }}" {{ $selected_travaux && in_array($travaux->id, $selected_travaux) ? 'selected':'' }}>{{ $travaux->travaux }}</option>   
        @endif
    @endif
@endforeach
 

