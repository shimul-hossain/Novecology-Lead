@if ($tax->count()>0)


    @foreach ($tax as $item) 

    
        <div class="col-12 mb-4">
            <div class="row align-items-center pb-3">
                {{-- <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="checkedTax" @if ($item->mark_check == 'yes')
                        checked
                    @endif value="{{ $item->id }}"  data-tax-id="{{ $item->id }}" class="custom-control-input tax_input_disabled table-select-checkbox taxMarkChecked" id="tableThreeRowSelectCheck-{{ $loop->iteration }}">
                    <label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $loop->iteration }}"></label>
                </div> --}}
                <div class="col-lg-auto">
                    <h4 class="mb-lg-0 font-weight-bold">{{ __('Notice') }} {{ $loop->iteration }}</h4>
                </div>  
                <div class="col-lg-4 col-md-6 pb-5 pb-lg-0">
                    <div class="form-group mb-lg-0">
                        <input type="text" name="tax_number" value="{{ $item->tax_number }}" class="form-control shadow-none tax_input_disabled" disabled placeholder="Tax number">
                        <input type="hidden" name="tax_id" id="tax_id" value="{{ $item->id }}">
                    </div>
                    <div class="form-group__bottom position-absolute d-flex align-items-center py-1">
                        <label class="circle-checkbox" style="font-size: 17px">
                            <input id="taxPrimaryCheck{{ $loop->iteration }}" type="radio" name="same" @if ($item->primary == 'yes') checked @endif class="circle-checkbox__input taxCheckedBtn tax_input_disabled" data-tax-id="{{ $item->id }}">
                            <span class="circle-checkbox__label"></span>
                        </label>
                        <label class="pl-1 mb-0" for="taxPrimaryCheck{{ $loop->iteration }}"><small>Sélectionner comme primaire</small></label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-5 pb-lg-0">
                    <div class="form-group mb-lg-0">
                        <input type="text" name="tax_reference" value="{{ $item->tax_reference }}" class="form-control shadow-none tax_input_disabled" disabled placeholder="Reference notice">
                    </div>
                </div>
                {{-- @if (checkAction(Auth::id(), 'collapse_tax_notice', 'edit') || role() == 's_admin')  --}}
                    <div class="col-auto">
                        <form action="{{ route('tax.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tax_id" value="{{ $item->id }}">
                            <button type="submit" class="remove-btn d-inline-flex align-items-center justify-content-center button tax_input_disabled">&times;</button>
                        </form>
                    </div> 
                    @if ($loop->index == 0)
                    <div class="col-auto">
                        <button type="button" class="add-btn d-inline-flex align-items-center justify-content-center button tax_input_disabled" id="addTextItem">+</button>  
                    </div> 
                    @endif
                {{-- @endif --}}
            </div>
        </div>
        <input type="hidden" value="{{ $tax->count() + 1 }}" id="notice_number">  
    @endforeach
@else
    <div class="col-12 mb-4">
        <div class="row align-items-center">
            <div class="col-lg-auto">
                <h4 class="mb-lg-0 font-weight-bold">{{ __('Notice') }} 1</h4>
            </div>
            {{-- <form action="{{ route('lead.tax.update') }}" method="POST"> --}}
                {{-- @csrf   --}}
                <div class="col-lg-4 col-md-6">
                    <div class="form-group mb-lg-0">
                        <input type="text" id="tax_number" name="tax_number" class="form-control shadow-none tax_input_disabled" placeholder="{{ __('Fiscal number') }}*">
                        <input type="hidden" name="tax_id" id="tax_id", value="0">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group mb-lg-0">
                        <input type="text" id="tax_reference" name="tax_reference" class="form-control shadow-none tax_input_disabled" placeholder="{{ __('Reference notice') }}*">
                        <input type="hidden" id="existingAddMore" value="exist">
                    </div>
                </div>
                {{-- @if (checkAction(Auth::id(), 'collapse_tax_notice', 'edit') || role() == 's_admin')  --}}
                    <div class="col-lg-auto"> 
                        <button type="button" class="add-btn d-inline-flex align-items-center justify-content-center button tax_input_disabled" id="addTextItem">+</button>  
                    </div> 
                {{-- @endif --}}
                
            {{-- </form> --}}
        </div>
    </div>
    <input type="hidden" value="2" id="notice_number">  
@endif 