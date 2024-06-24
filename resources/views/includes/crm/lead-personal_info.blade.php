@php
    $i = 1;
@endphp
<div class="card-body row">
    <div class="col custom-space">
        @foreach ($tax as $item)
            @if($item->mark_check == 'yes' || ($tax->where('mark_check', 'yes')->count() == 0 && $item->primary == 'yes'))
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="title{{ $item->id }}">{{ __('Title') }} {{ ($i == 1)? '':$i }} *</label>
                            <select name="title[]" id="title{{ $item->id }}" class="form-control custom-select shadow-none personal_info_disabled info_title @if ($item->primary == 1)primary_tax_title @endif" required>
                                <option value="">{{ __('Select') }}</option>
                                <option @if ($item->title == 'Mr')
                                    selected
                                @endif  value="Mr-{{ $item->id }}">{{ __('Mr') }}</option>
                                <option @if ($item->title == 'Mme')
                                    selected
                                @endif  value="Mme-{{ $item->id }}">{{ __('Mme') }}</option>
                                <option @if ($item->title == 'Mlle')
                                    selected
                                @endif  value="Mlle-{{ $item->id }}">{{ __('Mlle') }}</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="first_name{{ $item->id }}">{{ __('Prenom') }} {{ ($i == 1)? '':$i }} *</label>
                            <input type="text" name="first_name[]" id="first_name{{ $item->id }}" class="form-control shadow-none personal_info_disabled info_first_name" value="{{ $item->first_name }}" required> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="last_name{{ $item->id }}">{{ __('Nom') }} {{ ($i == 1)? '':$i }} *</label>
                            <input type="text" name="last_name[]" id="last_name{{ $item->id }}" class="form-control shadow-none personal_info_disabled info_last_name" value="{{ $item->last_name }}" required>
                        </div>
                    </div>
                </div>
                @php
                    $i = $i+1;
                @endphp
            @endif
        @endforeach
        @foreach ($tax as $item)
        <div class="row"> 
            {{-- @if ($item->second_first_name)
            <div class="col-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="second_title{{ $item->id }}">{{ __('Title') }} </label>
                            <select name="second_title" id="second_title{{ $item->id }}" class="form-control custom-select shadow-none personal_info_disabled">
                                <option value="">{{ __('Select') }}</option>
                                <option @if ($item->second_title =='mr')
                                selected
                                @endif value="mr">{{ __('Mr') }}</option>
                                <option @if ($item->second_title =='ms')
                                selected
                                @endif value="ms">{{ __('Ms') }}</option>
                                <option @if ($item->second_title =='mrs')
                                selected
                                @endif value="mrs">{{ __('Mrs') }}</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="second_first_name">{{ __('Prenom 2') }}</label>
                            <input type="text" name="second_first_name" id="second_first_name{{ $item->id }}" class="form-control shadow-none personal_info_disabled" value="{{ $item->second_first_name }}"> 
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="second_last_name">{{ __('Nom 2') }}</label>
                            <input type="text" name="second_last_name" id="second_last_name{{ $item->id }}" class="form-control shadow-none personal_info_disabled" value="{{ $item->second_last_name }}">
                        </div>
                    </div>
                </div> 
            </div> 
            @endif --}}
            @if ($item->primary == 'yes')  
                {{-- <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="kids">{{ __('nombre de personnes') }}</label>
                        <input type="number" name="kids" id="kids{{ $item->id }}" class="form-control shadow-none personal_info_disabled" value="{{ $item->kids }}">
                    </div>
                </div> --}}
                <div class="col-12">
                    <label class="form-label" for="address2">{{ __('Adresse') }} </label>
                    <div class="form-group d-flex flex-column align-items-center position-relative"> 
                        <input type="text" name="address2" id="address2" class="form-control shadow-none personal_info_disabled" value="{{ $item->address2 }}">  

                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label" for="address1">{{ __('Compléement adresse') }} </label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        {{-- <span class="novecologie-icon-home form-group__icon position-absolute"></span> --}}
                        <input type="text" name="address" id="address1" class="form-control shadow-none personal_info_disabled" value="{{ $item->address }}"> 
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="postal_code">{{ __('Code Postal') }}</label>
                        <input type="number" name="postal_code" id="postal_code" class="form-control shadow-none personal_info_disabled" value="{{ $item->postal_code }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label" for="city">{{ __('City') }}</label>
                        <input type="text" name="city" id="city" class="form-control shadow-none personal_info_disabled" required value="{{ $item->city }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                    <div class="form-group d-flex flex-column align-items-center position-relative"> 
                        <input type="email" name="email" id="email" class="form-control shadow-none personal_info_disabled" value="{{ $item->email }}">
                    </div>
                </div> 

                <div class="col-md-6">
                    <label class="form-label" for="phone">{{ __('N° Mobile') }} <span class="text-danger">*</span> </label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        {{-- <span class="novecologie-icon-phone form-group__icon position-absolute"></span> --}}
                        <input type="number" name="phone" id="phone" class="form-control shadow-none personal_info_disabled" value="{{ $item->phone }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="home_telephone">{{ __('N° Fixe') }}</label>
                    <div class="form-group d-flex flex-column align-items-center position-relative">
                        {{-- <span class="novecologie-icon-phone form-group__icon position-absolute"></span> --}}
                        <input type="number" name="home_telephone" id="home_telephone" class="form-control shadow-none personal_info_disabled" value="{{ $item->telephone }}">
                    </div>
                </div> 
                
                {{-- <div class="col-4">
                    <label class="form-label" for="pays">{{ __('Revenu fiscal de référence') }}</label>
                    <div class="form-group d-flex flex-column align-items-center position-relative"> 
                        <input type="number" name="pays" id="pays{{ $item->id }}" class="form-control shadow-none personal_info_disabled" value="{{ $item->pays }}">
                    </div>
                </div> --}} 
                @if (checkAction(Auth::id(), $type, 'edit') || role() == 's_admin')
                    <div class="col-12 text-center mb-3">
                        <button id="infoValidate" data-tax-id="{{ $item->id }}" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 infoValidateBtn personal_info_disabled">
                            {{ __('Verify') }}
                        </button>
                    </div>
                @else
                    <div class="col-12 text-center mb-3">
                        <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                            <span class="novecologie-icon-lock py-1"></span>
                        </button>
                    </div>
                @endif
            @endif
        </div>
        @endforeach
    </div>
</div>