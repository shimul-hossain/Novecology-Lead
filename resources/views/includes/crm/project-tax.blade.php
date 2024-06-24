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
                        <input type="text" name="tax_number" id="tax_number__edit{{ $item->id }}" value="{{ $item->tax_number }}" class="form-control shadow-none tax_input_disabled" disabled placeholder="Tax number">
                        <input type="hidden" name="tax_id" id="tax_id" value="{{ $item->id }}">
                    </div>
                    <div class="form-group__bottom position-absolute d-flex align-items-center py-1">
                        <label class="circle-checkbox" style="font-size: 17px">
                            <input id="taxPrimaryCheck{{ $loop->iteration }}" type="radio" name="same" @if ($item->primary == 'yes') checked @endif class="circle-checkbox__input taxCheckedBtn tax_input_disabled" data-tax-id="{{ $item->id }}">
                            <span class="circle-checkbox__label"></span>
                        </label>
                        <label class="pl-1 mb-0" for="taxPrimaryCheck{{ $loop->iteration }}"><small>Selectionnez comme primaire</small></label>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-5 pb-lg-0">
                    <div class="form-group mb-lg-0">
                        <input type="text" name="tax_reference" id="tax_reference__edit{{ $item->id }}" value="{{ $item->tax_reference }}" class="form-control shadow-none tax_input_disabled" disabled placeholder="Reference notice">
                    </div>
                </div>
                {{-- @if (checkAction(Auth::id(), 'collapse_tax_notice', 'edit') || role() == 's_admin')  --}}
                <div class="col-auto"> 
                    <button type="button" class="add-btn d-inline-flex align-items-center justify-content-center button tax_input_disabled" data-toggle="modal" data-target="#taxEditModal{{ $item->id }}"><i class="bi bi-pencil-square"></i></button> 
                </div>
                    {{-- <div class="col-auto">
                        <form action="{{ route('project.tax.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tax_id" value="{{ $item->id }}">
                            <button type="submit" class="remove-btn d-inline-flex align-items-center justify-content-center button tax_input_disabled">&times;</button>
                        </form>
                    </div>  --}}
                    @if ($loop->index == 0)
                    <div class="col-auto">
                        <button type="button" class="add-btn d-inline-flex align-items-center justify-content-center button tax_input_disabled" id="addTextItem">+</button>  
                    </div> 
                    @endif
                {{-- @endif --}}
            </div>
        </div>
        <input type="hidden" value="{{ $tax->count() + 1 }}" id="notice_number">  
        
        <div class="modal modal--aside fade" id="taxEditModal{{ $item->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                            <span class="novecologie-icon-close"></span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">
                        <h1 class="position-relative mb-4 text-center">Modifier</h1> 
                        <form action="#!">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="form-group mt-3">
                                <label class="form-label">{{ __('Fiscal number') }}*</label>
                                <input type="text" value="{{ $item->tax_number }}" class="form-control shadow-none tax_input_disabled edit_tax_number">
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('Reference notice') }}*</label>
                                <input type="text" value="{{ $item->tax_reference }}" class="form-control shadow-none tax_input_disabled edit_tax_reference">
                            </div> 
                            <div class="lead__card__loader-wrapper d-none text-center" id="tax__card__loader2{{ $item->id }}">
                                <div class="lead__card__loader">
                                    <svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                        <path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                        <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center lead__card__btn-wrapper" id="tax__card__btn2{{ $item->id }}">
                                <button type="button" data-id="{{ $item->id }}" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 taxValiderBtn2">
                                    Passer
                                </button>
                                <button type="button" data-id="{{ $item->id }}" class="primary-btn btn-success primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 tax_input_disabled taxVerifyBtn2">
                                    Vérifier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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