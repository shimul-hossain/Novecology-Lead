@if ($project)
@php 
    $marques = \App\Models\Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();
@endphp
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Adresse travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address2 }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Complément adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Complément_adresse_Travaux }}"
                @else
                    value="{{ $project->primaryTax->address }}"
                @endif
            @endif
            class="form-control shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Ville des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ $project->primaryTax->Ville_Travaux }}"
                @else
                    value="{{ $project->primaryTax->city }}"
                @endif
            @endif
            class="form-control  shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Département des travaux:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                @if ($project->primaryTax->same_as_work_address == 'no')
                    value="{{ getDepartment2($project->primaryTax->Code_postal_Travaux) }}"
                @else
                    value="{{ getDepartment2($project->primaryTax->postal_code) }}"
                @endif
            @endif
            class="form-control  shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Google Adresse:</label>
            <input type="text" disabled
            @if ($project->primaryTax)
                value="{{ $project->primaryTax->google_address }}"
            @endif
            class="form-control  shadow-none">
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Projet</h3>
            </div>
            <div class="card-body" style="background-color: #f2f2f2">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Travaux :</label>
                            <select disabled class="select2_select_option custom-select shadow-none form-control bg--gray" multiple>
                                @foreach ($project->ProjectTravaux as $travaux)
                                    {{-- @if ($project->ProjectTravaux->where('id',  $travaux->id)->first()) --}}
                                        <option selected value="disabled" disabled="disabled" >{{ $travaux->travaux }}</option>
                                    {{-- @endif --}}
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="row">
                            @foreach ($project->projectTagItem as $product_tag)
                                @if ($product_tag->getTag && $product_tag->getTag->id != 7 && $product_tag->getTag->id != 29)
                                    <div class="col-12 my-2 text-center"> 
                                        <button type="button" class="btn w-100" style="background-color: #9fbfe6; max-width: 540px;">{{ $product_tag->getTag->travaux }}</button>
                                    </div>
                                    @if ($product_tag->getTag->tag == 'CAG' || $product_tag->getTag->tag == 'POELE' || $product_tag->getTag->tag == 'PAC R/R' || $product_tag->getTag->tag == 'PAC R/O' || $product_tag->getTag->tag == 'CESI' || $product_tag->getTag->tag == 'BTD' || $product_tag->getTag->tag == 'SSC')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label" for="status">Marque</label>
                                                </div>
                                                <select disabled class="select2_select_option shadow-none form-control travaux_disabled bg--gray">
                                                    <option value="">{{ __("Select") }}</option>
                                                    @foreach ($marques as $marque)
                                                        <option {{ $product_tag->marque == $marque->id ? 'selected':'' }} value="{{ $marque->id }}">{{ $marque->description }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product_tag->getTag->tag == 'PAC R/R') 
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre de split</label> 
                                                <input disabled type="number" class="form-control bg--gray shadow-none" value="{{ $product_tag->Nombre_de_split ?? ''  }}">
                                            </div> 
                                        </div> 
                                    @endif 
                                    @if ($product_tag->getTag->rank == '1')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label">Produit {{ $product_tag->getTag->tag  }}</label>
                                                </div>
                                                <select disabled class="select2_select_option custom-select shadow-none form-control bg--gray" multiple>
                                                    @foreach ($product_tag->getTag->getProducts as $product)
                                                        <option {{ $project->getTagProduct()->where('product_id', $product->id)->where('tag_id',  $product_tag->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
									@endif
                                    @if ($product_tag->getTag->tag == 'ITI_101' || $product_tag->getTag->tag == 'ITI_102' || $product_tag->getTag->tag == 'ITE_102' || $product_tag->getTag->tag == 'ITI_103'|| $product_tag->getTag->tag == 'Crépis' || $product_tag->getTag->tag == 'ITE hors zone')
                                        @if ($product_tag->getTag->tag == 'ITI_101')
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Type de comble</label>
                                                    <select disabled class="select2_select_option custom-select shadow-none form-control bg--gray">
                                                        <option value="" selected>{{ __('Select') }}</option>
                                                        <option {{ $product_tag->Type_de_comble && $product_tag->Type_de_comble == 'Comble perdu' ? 'selected':'' }} value="Comble perdu">Comble perdu</option>
                                                        <option {{ $product_tag->Type_de_comble && $product_tag->Type_de_comble == 'Comble aménagés/aménagéable' ? 'selected':'' }} value="Comble aménagés/aménagéable">Comble aménagés/aménagéable</option>
                                                    </select>
                                                </div> 
                                            </div> 
                                        @endif
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="surface{{ $product_tag->tag_id }}">Surface {{ $product_tag->getTag->tag  }}</label> 
                                                <input disabled type="text" class="form-control bg--gray shadow-none" value="{{ $product_tag->surface }} m2">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product_tag->getTag->tag == 'StoreBanne') 
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre de store banne</label> 
                                                <input disabled type="number" class="form-control bg--gray shadow-none" value="{{ $product_tag->Nombre_de_split ?? ''  }}">
                                            </div> 
                                        </div> 
                                    @endif 
                                    @if ($product_tag->getTag->tag == 'GD ITE') 
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label> 
                                                <input disabled type="number" class="form-control bg--gray shadow-none" value="{{ $product_tag->Nombre_de_split ?? ''  }}">
                                            </div> 
                                        </div> 
                                    @endif 
                                    <div class="col-12"> 
                                        @if ($product_tag->getTag->id == 2 || $product_tag->getTag->id == 6) 
                                            @foreach ($project->getTagProduct()->where('tag_id',  $product_tag->id)->get()  as $selected_product)
                                                <div class="form-group">
                                                    <label class="form-label">{{ \App\Models\CRM\Product::find($selected_product->product_id)->reference ?? '' }} : <button style="background-color: #B4C7E6" type="button" class="primary-btn primary-btn--sm rounded">Nombre</button></label> 
                                                    <input disabled type="number" class="form-control shadow-none bg--gray" value="{{ \App\Models\CRM\ProjectProductNombre::where('project_id', $project->id)->where('tag_id', $product_tag->getTag->id)->where('product_id', $selected_product->product_id)->first()->number ?? '' }}">
                                                </div>
                                            @endforeach 
                                        @endif 
                                        @if ($product_tag->getTag->tag == 'THERMO')
                                            <div class="form-group">
                                                <label class="form-label">SHAB:</label>
                                                <input type="number" step="any" disabled class="form-control bg--gray shadow-none travaux_disabled" value="{{ $product_tag->shab }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nombre de pièces dans le logement:</label>
                                                <input type="number" step="any" disabled class="form-control bg--gray shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_pièces_dans_le_logement }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nombre de radiateurs total dans le logement</label>
                                                <input type="number" step="any" disabled class="form-control bg--gray shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_radiateur_total_dans_le_logement }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" >Type de radiateurs à équiper</label>
                                                <select disabled class="select2_select_option custom-select shadow-none form-control bg--gray travaux_disabled Type_de_radiateur_select_input">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option {{ $product_tag->Type_de_radiateur && $product_tag->Type_de_radiateur == 'combustible' ? 'selected':'' }} value="combustible">combustible</option>
                                                    <option {{ $product_tag->Type_de_radiateur && $product_tag->Type_de_radiateur == 'électrique' ? 'selected':'' }} value="électrique">électrique</option>
                                                    <option {{ $product_tag->Type_de_radiateur && $product_tag->Type_de_radiateur == 'mixte' ? 'selected':'' }} value="mixte">mixte</option>
                                                </select>
                                            </div>
                                            <div class="form-group" style="display: {{ ($product_tag->Type_de_radiateur == 'mixte' || $product_tag->Type_de_radiateur == 'électrique') ? '':'none'  }}">
                                                <label class="form-label">Nombre de radiateurs électrique à équiper:</label>
                                                <input type="number" step="any" disabled class="form-control bg--gray shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_radiateurs_électrique }}">
                                            </div>
                                            <div class="form-group" style="display: {{ ($product_tag->Type_de_radiateur == 'mixte' || $product_tag->Type_de_radiateur == 'combustible') ? '':'none'  }}">
                                                <label class="form-label">Nombre de radiateurs combustible à équiper:</label>
                                                <input type="number" step="any" disabled class="form-control bg--gray shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_radiateurs_combustible }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Thermostat supplémentaire:</label>
                                                <select disabled class="select2_select_option custom-select shadow-none form-control bg--gray travaux_disabled">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option {{ $product_tag->Thermostat_supplémentaire && $product_tag->Thermostat_supplémentaire == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                    <option {{ $product_tag->Thermostat_supplémentaire && $product_tag->Thermostat_supplémentaire == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                </select>
                                            </div>
                                            <div class="Thermostat_supplémentaire_wrap"  style="display: {{ ($product_tag->Thermostat_supplémentaire == 'Oui')? '':'none' }}">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre thermostat supplémentaire:</label>
                                                    <input type="number" step="any" disabled class="form-control bg--gray shadow-none travaux_disabled Nombre_thermostat_supplémentaire_input" data-price="{{ $product_tag->getTag->price }}" value="{{ $product_tag->Nombre_thermostat_supplémentaire }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Montant:</label>
                                                    <input type="text" disabled class="form-control bg--gray shadow-none" id="Nombre_thermostat_supplémentaire_montant" value="{{ EuroFormat($product_tag->Nombre_thermostat_supplémentaire*$product_tag->getTag->price) }}">
                                                </div>
                                            </div> 
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label" >Type de contrat:</label>
                            </div>
                            <select disabled class="select2_color_option custom-select shadow-none form-control bg--gray">
                                <option value=" " selected>{{ __('Select') }}</option>
                                {{-- <option data-color="#ffffff" data-background="#00818E" {{ $project->Type_de_contrat == 'Credit' ? 'selected':'' }} value="Credit">Credit</option>
                                <option data-color="#000000" data-background="#B2E6D9" {{ $project->Type_de_contrat == 'MaPrimeRenov' ? 'selected':'' }} value="MaPrimeRenov">MaPrimeRenov</option>
                                <option data-color="#000000" data-background="#FBE8C8" {{ $project->Type_de_contrat == 'Bar TH 164' ? 'selected':'' }} value="Bar TH 164">Bar TH 164</option> --}}

                                <option data-color="#ffffff" data-background="#00818E" {{ $project->Type_de_contrat == 'Credit' ? 'selected':'' }} value="Credit">Credit</option>
                                <option data-color="#000000" data-background="#B2E6D9" {{ $project->Type_de_contrat == 'MaPrimeRenov' ? 'selected':'' }} value="MaPrimeRenov">MaPrimeRenov</option>
                                <option data-color="#000000" data-background="#ff0000" {{ $project->Type_de_contrat == 'BAR TH 164 – 2022' ? 'selected':'' }} value="BAR TH 164 – 2022">BAR TH 164 – 2022</option>
                                <option data-color="#000000" data-background="#F8A0EE" {{ $project->Type_de_contrat == 'BAR TH 164 – 2023' ? 'selected':'' }} value="BAR TH 164 – 2023">BAR TH 164 – 2023</option>
                                <option data-color="#000000" data-background="#9BB8CD" {{ $project->Type_de_contrat == 'BAR TH 164 – 2023 (après 01/07/2023)' ? 'selected':'' }} value="BAR TH 164 – 2023 (après 01/07/2023)">BAR TH 164 – 2023 (après 01/07/2023)</option>
                                <option data-color="#000000" data-background="#EADFB4" {{ $project->Type_de_contrat == 'BAR TH 145' ? 'selected':'' }} value="BAR TH 145">BAR TH 145</option>
                                <option data-color="#000000" data-background="#FFB996" {{ $project->Type_de_contrat == 'BAR TH 173' ? 'selected':'' }} value="BAR TH 173">BAR TH 173</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label" >Faisabilité du projet: </span></label>
                            </div>
                            <select disabled class="select2_color_option shadow-none form-control bg--gray">
                                <option value=" " selected>{{ __('Select') }}</option>
                                <option data-color="#ffffff" data-background="green" {{ ($project->Faisabilité_du_projet == 'Faisable') ? 'selected':'' }} value="Faisable">Faisable</option>
                                <option data-color="#ffffff" data-background="red" {{ ($project->Faisabilité_du_projet == 'Infaisable') ? 'selected':'' }} value="Infaisable">Infaisable</option>
                                <option data-color="#ffffff" data-background="orange" {{ ($project->Faisabilité_du_projet == 'Faisable sous condition') ? 'selected':'' }} value="Faisable sous condition">Faisable sous condition</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label">Statut Projet:</label>
                            </div>
                            <select disabled class="select2_color_option custom-select shadow-none form-control bg--gray">
                                <option value=" " selected>{{ __('Select') }}</option>
                                <option data-color="#ffffff" data-background="green" {{ $project->Statut_Projet == 'Devis signé' ? 'selected':'' }} value="Devis signé">Devis signé</option>
                                <option data-color="#ffffff" data-background="orange" {{ $project->Statut_Projet == 'Réflexion' ? 'selected':'' }} value="Réflexion">Réflexion</option>
                                <option data-color="#ffffff" data-background="red" {{ $project->Statut_Projet == 'KO' ? 'selected':'' }} value="KO">KO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 RaisonsBlock" style="display: {{ $project->Statut_Projet == 'KO' || $project->Statut_Projet == 'Réflexion' ? '':'none' }}">
                        <div class="form-group">
                            <label class="form-label">Raisons</label>
                            <textarea disabled class="form-control bg--gray shadow-none">{{ $project->Raisons ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12" style="display:{{ $project->Type_de_contrat && ($project->Statut_Projet == 'Devis signé' || $project->Statut_Projet == 'Réflexion') ? '':'none' }}">
                        <div class="form-group">
                            <label class="form-label">Montant TTC Devis / Bon De Commande :</label>
                            <input disabled type="number" step="any" value="{{ $project->Bon_De_Commande }}" class="form-control bg--gray shadow-none">
                        </div>
                        <div class="form-group">
                            <label class="form-label" >Devis / Bon De Commande signé le</label>
                            <input disabled type="date" value="{{ $project->Bon_De_Commande_signé_le }}" class="flatpickr form-control bg--gray shadow-none">
                        </div>
                        <div class="form-group">
                            <label class="form-label" >Reste à charge devis :</label>
                            <input disabled type="number" step="any" value="{{ $project->Reste_à_charge_devis }}" class="form-control bg--gray shadow-none">
                        </div> 
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <label class="form-label">Attestation de reste à charge</label>
                                    <select disabled class="custom-select shadow-none  w-auto">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $project->Attestation_de_reste_à_charge == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                        <option {{ $project->Attestation_de_reste_à_charge == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-12" style="display: {{ ($project->Attestation_de_reste_à_charge == 'Oui')? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label">Reste à charge client :</label>
                                    <input disabled type="number" step="any" value="{{ $project->Reste_à_charge_client }}" class="form-control bg--gray shadow-none">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" >Montant attestation RAC :</label>
                                    <input disabled type="text" class="form-control bg--gray shadow-none" value="{{ EuroFormat($project->Montant_attestation_RAC) }}">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <label class="form-label">Survente</label>
                                    <select disabled class="custom-select shadow-none w-auto">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $project->Survente == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                        <option {{ $project->Survente == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12" style="display: {{ ($project->Survente == 'Oui')? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label">Montant survente :</label>
                                    <input disabled type="text" class="form-control bg--gray shadow-none" value="{{ EuroFormat($project->Montant_survente) }}">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="mb-0">Reste à  charge</h4>
                            </div>
                            <div class="col-md-10">
                                <label class="switch-checkbox">
                                    <input disabled type="checkbox" class="switch-checkbox__input" {{ ($project->Reste_à_charge == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="display: {{ ($project->Reste_à_charge == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                <div class="form-group">
                                    <label class="form-label">Montant</label>
                                    <input disabled type="text" class="form-control bg--gray shadow-none" value="{{ EuroFormat($project->Reste_à_charge_Montant) }}">
                                </div>
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label">Mode de paiement:</label>
                                    </div>
                                    <select disabled class="select2_select_option custom-select shadow-none form-control bg--gray">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $project->Mode_de_paiement == 'Comptant' ? 'selected':'' }} value="Comptant">Comptant</option>
                                        <option {{ $project->Mode_de_paiement == 'Différé' ? 'selected':'' }} value="Différé">Différé</option>
                                    </select>
                                </div>
                                <div class="form-group"  style="display: {{ $project->Mode_de_paiement == 'Différé' ? '':'none' }}">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label">Nombre de mensualités:</label>
                                    </div>
                                    <select disabled class="select2_select_option custom-select shadow-none form-control bg--gray">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $project->Nombre_de_mensualités == '1' ? 'selected':'' }} value="1">1</option>
                                        <option {{ $project->Nombre_de_mensualités == '2' ? 'selected':'' }} value="2">2</option>
                                        <option {{ $project->Nombre_de_mensualités == '3' ? 'selected':'' }} value="3">3</option>
                                        <option {{ $project->Nombre_de_mensualités == '4' ? 'selected':'' }} value="4">4</option>
                                        <option {{ $project->Nombre_de_mensualités == '5' ? 'selected':'' }} value="5">5</option>
                                    </select>
                                </div>
                                @if (\Auth::user()->getRoleName->category_id != 1) 
                                    <div class="form-group d-flex align-items-center justify-content-between">
                                        <label class="form-label">Survente</label>
                                        <select disabled data-autre-box="work__Survente" class="other_field__system2 custom-select shadow-none w-auto travaux_disabled  bg--gray">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $project->Survente == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                            <option {{ $project->Survente == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                        </select>
                                    </div>  
                                    <div class="form-group work__Survente pl-3" style="display: {{ ($project->Survente == 'Oui')? '':'none' }}">
                                        <label class="form-label" for="Montant_survente">Montant survente :</label>
                                        <input disabled type="text" class="form-control shadow-none montant_format travaux_disabled  bg--gray" value="{{ EuroFormat($project->Montant_survente) }}">
                                    </div> 
                                    <div class="form-group">
                                        <label class="form-label" for="Observations_reste_à_charge">Observations reste à charge</label>
                                        <textarea disabled class="form-control shadow-none travaux_disabled  bg--gray">{{ $project->Observations_reste_à_charge }}</textarea>
                                    </div> 
                                @endif
                            </div>
                        </div>
                    </div> 
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <label class="form-label">Projet Observations</label>
                            <textarea disabled class="form-control bg--gray shadow-none">{{ $project->Projet_observations ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

 