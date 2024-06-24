<option value="" selected disabled>{{ __('Select') }}</option>
@if ($status == 2)
    <option selected value="0">Nouvelle demande</option>	
@endif
@foreach ($lead_sub_status as $sub_status)
    {{-- @if ($sub_status->id != 5)
        <option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
    @endif --}}
    @if ($status == 6)
        @if ($sub_status->id == 25)
        <option  value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
        @endif 
        @if (\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4)
            @if ($sub_status->id == 52 || $sub_status->id == 53 || $sub_status->id == 54 || $sub_status->id == 50 || $sub_status->id == 56)
                <option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
            @endif
        @endif
    @else
        @if ($sub_status->id != 5)
            <option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
        @endif
    @endif
@endforeach