@forelse ($tax as $item)     
<div class="col-12 mb-4"> 
    <div class="row mt-3 align-items-center pb-3">
        <div class="col-12">
            <div class="card"> 
                <div class="card-body">  
                    <h3 class="card-title"> Avis fiscale {{ $loop->iteration }}: <span id="AvisFiscaleName{{ $item->id }}">{{ $item->first_name.' '.$item->last_name }}</span></h3>  
                    <form action="{{ route('lead.tax.declarant.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tax_id" value="{{ $item->id }}"> 
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="card mb-3">
                                    <div class="card-body" style="background-color: #f2f2f2">
                                        <div class="row">
                                            <div class="col-md-6"> 
                                                <div class="form-group">
                                                    <label class="form-label" for="Nom_et_prénom_déclarant_1{{ $item->id }}">Nom et prénom déclarant 1 <span class="text-danger">*</span></label>
                                                    <input type="text" name="Nom_et_prénom_déclarant_1" id="Nom_et_prénom_déclarant_1{{ $item->id }}" value="{{ $item->Nom_et_prénom_déclarant_1 }}" class="form-control shadow-none tax_input_disabled" required oninvalid="this.setCustomValidity('Nom et prénom déclarant 1 est requis')" 
                                                    onchange="this.setCustomValidity('')">
                                                </div> 
                                            </div> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="Date_de_naissance_déclarant_1{{ $item->id }}">Date de naissance déclarant 1</label>
                                                    <input type="text" name="Date_de_naissance_déclarant_1" id="Date_de_naissance_déclarant_1{{ $item->id }}"  value="{{ $item->Date_de_naissance_déclarant_1 }}"  class="date-mask form-control shadow-none tax_input_disabled" placeholder="__/__/____">
                                                </div> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-12 mt-3">
                                <h4 class="mb-0 mr-2">MaPrimeRénov: @if ($item->MaPrimeRénov_status == '1')
                                    Pas de compte
                                @elseif ($item->MaPrimeRénov_status == '2')
                                    Compte déjà existant
                                @else
                                    Impossible de determiner l’existence d’un compte MPR
                                @endif</h4>  
                            </div>
                            <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 mr-2">Est-il/elle propriétaire de la maison ? <span class="text-danger">*</span></h4> 
                                <select name="house_owner_status" class="custom-select shadow-none tax_input_disabled w-auto" required  oninvalid="this.setCustomValidity('Est-il/elle propriétaire de la maison ? est requis')" 
                                onchange="this.setCustomValidity('')">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $item->house_owner_status == 'Oui' ? 'selected':'' }} value="Oui">Oui</option> 
                                    <option {{ $item->house_owner_status == 'Non' ? 'selected':'' }} value="Non">Non</option> 
                                </select>
                            </div>
                            <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 mr-2">Son nom figure sur la taxe foncière ou l’acte de propriété du logement ? <span class="text-danger">*</span></h4>  
                                <select name="property_tax_status" class="custom-select shadow-none tax_input_disabled w-auto" required  oninvalid="this.setCustomValidity('Son nom figure sur la taxe foncière ou l\'acte de propriété du logement ? est requis')" 
                                onchange="this.setCustomValidity('')">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $item->property_tax_status == 'Oui' ? 'selected':'' }} value="Oui">Oui</option> 
                                    <option {{ $item->property_tax_status == 'Non' ? 'selected':'' }} value="Non">Non</option> 
                                </select>
                            </div>
                            <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 mr-2">Existe-t-il un co-déclarant ? <span class="text-danger">*</span></h4>  
                                 <select name="Existe_déclarant" data-autre-box="secondDeclarantWrap{{ $item->id }}" class="other_field__system2 custom-select shadow-none tax_input_disabled w-auto" required  oninvalid="this.setCustomValidity('Existe-t-il un co-déclarant ? est requis')" 
                                    onchange="this.setCustomValidity('')">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    <option {{ $item->Existe_déclarant == 'Oui' ? 'selected':'' }} value="Oui">Oui</option> 
                                    <option {{ $item->Existe_déclarant == 'Non' ? 'selected':'' }} value="Non">Non</option> 
                                </select>
                            </div>
                            <div class="col-12 mt-3 secondDeclarantWrap{{ $item->id }}" style="display: {{ $item->Existe_déclarant == 'Oui' ? '':'none' }}">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mb-3">
                                            <div class="card-body" style="background-color: #f2f2f2">
                                                <div class="row">
                                                    <div class="col-md-6"> 
                                                        <div class="form-group">
                                                            <label class="form-label" for="Nom_et_prénom_déclarant_2{{ $item->id }}">Nom et prénom déclarant 2 </label>
                                                            <input type="text" name="Nom_et_prénom_déclarant_2" value="{{ $item->Nom_et_prénom_déclarant_2 }}" id="Nom_et_prénom_déclarant_2{{ $item->id }}" class="form-control shadow-none tax_input_disabled">
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="Date_de_naissance_déclarant_2{{ $item->id }}">Date de naissance déclarant 2</label>
                                                            <input type="text" name="Date_de_naissance_déclarant_2" value="{{ $item->Date_de_naissance_déclarant_2 }}" id="Date_de_naissance_déclarant_2{{ $item->id }}" class="date-mask form-control shadow-none tax_input_disabled" placeholder="__/__/____">
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3"> 
                                        <div class="form-group">
                                            <label class="form-label">Numéro fiscal du co-déclarant</label>
                                            <input type="number" name="Existe_déclarant_number" value="{{ $item->Existe_déclarant_number }}" class="form-control shadow-none tax_input_disabled">
                                        </div> 
                                    </div>
                                    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 mr-2">Le(a) co-déclarant(e) est il/elle propriétaire de la maison ?</h4> 
                                        <label class="switch-checkbox">
                                            <input type="checkbox" name="house_owner_status_déclarant_2" {{ $item->house_owner_status_déclarant_2 == 'yes' ? 'checked':'' }} class="switch-checkbox__input tax_input_disabled">
                                            <span class="switch-checkbox__label"></span>
                                        </label>
                                    </div>
                                    <div class="col-12 mt-3 d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0 mr-2">Le(a) co-déclarant(e) figure sur la taxe foncière ou l'acte de propriété du logement ? </h4> 
                                        <label class="switch-checkbox">
                                            <input type="checkbox"name="property_tax_status_déclarant_2" {{ $item->property_tax_status_déclarant_2 == 'yes' ? 'checked':'' }} class="switch-checkbox__input tax_input_disabled">
                                            <span class="switch-checkbox__label"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>  

                        <div class="text-center my-3"> 
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mt-3 tax_input_disabled">
                                Valider
                            </button> 
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</div> 
@empty
  
@endforelse