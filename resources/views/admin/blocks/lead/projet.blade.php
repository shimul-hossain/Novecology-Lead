@php
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();
    $tax = \App\Models\CRM\LeadTax::where('lead_id', $lead->id)->orderBy('primary', 'asc')->get();
    $marques = \App\Models\Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();
    if($tax->count()>0){
        $collapse_status = true;
    }else {
        $collapse_status = false;
    }

    $primary_tax = \App\Models\CRM\LeadTax::where('lead_id', $lead->id)->where('primary', 'yes')->first();
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get();

    $edit_access = false;
    if($lead->lead_label == 6){
        if ($lead->sub_status  == 50 && \Auth::user()->getRoleName->category_id == 2) {
            $edit_status = true;
        }
        if(\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4){
            $edit_status = true;
        } 
    }
    
@endphp
<div class="accordion" id="leadAccordion22">
    @if (checkAction(Auth::id(), 'lead_collapse__project', 'view') ||checkAction(Auth::id(), 'lead_collapse__project', 'edit') || role() == 's_admin' || $edit_access)
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-8">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="travaux-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4

            "></span>
            Projet
            <button data-tab="Projet" data-block="Projet" data-tab-class="lead__project" type="button" data-toggle="collapse" data-target="#leadCardCollapse-8" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__project') }} position-relative ml-auto mr-1 {{ session('lead__project') == 'active' ? 'collapsed':'' }}">
                <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
            </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-8" class="collapse {{ session('lead__project') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-8">
        <div class="card-body row">
            <div class="col custom-space">
                <div class="row collapseRow"  style="display: {{ $collapse_status ? '':'none' }}">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Adresse_des_travaux"> Adresse des travaux</label>
                            <input type="text" name="Adresse_des_travaux" id="Adresse_des_travaux" class="form-control shadow-none travaux_disabled" readonly
                            @if ($primary_tax)
                                @if ($primary_tax->same_as_work_address == 'no')
                                    value="{{ $primary_tax->Adresse_Travaux }}"
                                @else
                                    value="{{ $primary_tax->address2 }}"
                                @endif
                            @endif
                            >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="complement_Adresse_des_travaux">Complément adresse Travaux</label>
                            <input type="text" name="complement_Adresse_des_travaux" id="complement_Adresse_des_travaux" class="form-control shadow-none travaux_disabled" readonly
                            @if ($primary_tax)
                                @if ($primary_tax->same_as_work_address == 'no')
                                    value="{{ $primary_tax->Complément_adresse_Travaux }}"
                                @else
                                    value="{{ $primary_tax->address }}"
                                @endif
                            @endif
                            >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Code_postale_des_travaux">Code postale des travaux</label>
                            <input type="text" name="Code_postale_des_travaux" id="Code_postale_des_travaux" class="form-control shadow-none travaux_disabled" readonly
                            @if ($primary_tax)
                                @if ($primary_tax->same_as_work_address == 'no')
                                    value="{{ $primary_tax->Code_postal_Travaux }}"
                                @else
                                    value="{{ $primary_tax->postal_code }}"
                                @endif
                            @endif
                            >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Ville_des_travaux">Ville des travaux</label>
                            <input type="text" name="Ville_des_travaux" id="Ville_des_travaux" class="form-control shadow-none travaux_disabled" readonly
                            @if ($primary_tax)
                                @if ($primary_tax->same_as_work_address == 'no')
                                    value="{{ $primary_tax->Ville_Travaux }}"
                                @else
                                    value="{{ $primary_tax->city }}"
                                @endif
                            @endif
                            >
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Département_des_travaux">Département des travaux</label>
                            <input type="text" name="Département_des_travaux" id="Département_des_travaux" class="form-control shadow-none travaux_disabled" readonly
                            @if ($primary_tax)
                                @if ($primary_tax->same_as_work_address == 'no')
                                    value="{{ getDepartment2($primary_tax->Code_postal_Travaux) }}"
                                @else
                                    value="{{ getDepartment2($primary_tax->postal_code) }}"
                                @endif
                            @endif
                            >
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Google Adresse</label>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="text" id="google_address2" class="form-control shadow-none" disabled value="{{ $primary_tax->google_address ?? '' }}">
                        </div>
                    </div>
                    <div class="col-12 my-4">
                        <a target="_blank" id="googleMapImage2" href="https://www.google.com/maps?q={{ $primary_tax && $primary_tax->google_address ? urlencode($primary_tax->google_address) : '' }}">
                            <img  loading="lazy"  height="80" src="{{ asset('crm_assets/assets/images/Google-Maps-Logo-Transparent 1.png') }}" alt="">
                        </a>
                        <a target="_blank" href="https://www.geoportail.gouv.fr/" class="mx-5">
                            <img  loading="lazy"  width="150" src="{{ asset('crm_assets/assets/images/geo-logo.png') }}" alt="">
                        </a>
                        <a target="_blank" href="https://cadastre.gouv.fr/scpc/accueil.do">
                            <img  loading="lazy"  height="80" src="{{ asset('crm_assets/assets/images/cadastre-gouv-logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-12 p-3" style="border: 1px solid black">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="bareme"> Barème <span class="text-danger">*</span></label>
                                    </div>
                                    <select name="bareme[]" id="bareme"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
                                        @foreach ($bareme_travaux_tags->where('rank', 1) as $baremes)
                                        @if ($lead->LeadBareme->whereIn('id',  [7,29])->first())
                                            @if ($lead->LeadBareme->where('id',  $baremes->id)->first())
                                                <option selected value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
                                            @endif
                                        @else
                                            <option {{ $lead->LeadBareme->where('id',  $baremes->id)->first()? 'selected':'' }} value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="travaux"> Travaux <span class="text-danger">*</span></label>
                                    </div>
                                    <select name="travaux[]" id="travaux"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
                                        @foreach ($bareme_travaux_tags as $travaux)
                                            @if ($lead->LeadBareme->whereIn('id',  [7,29])->first())
                                                @if ($lead->LeadBareme->where('id', $travaux->id)->first())
                                                    <option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>
                                                @else
                                                    <option {{ \App\Models\CRM\LeadWorkTravaux::where('work_id', $lead->id)->where('travaux_id',  $travaux->id)->exists() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                @endif
                                            @else
                                                @if ($travaux->rank == '1')
                                                    @if (\App\Models\CRM\LeadWorkTravaux::where('work_id', $lead->id)->where('travaux_id',  $travaux->id)->exists())
                                                        <option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>
                                                    @endif
                                                @else
                                                    <option {{ \App\Models\CRM\LeadWorkTravaux::where('work_id', $lead->id)->where('travaux_id',  $travaux->id)->exists() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="tag">TAG <span class="text-danger">*</span></label>
                                    </div>
                                    <select name="tag[]" id="tag"  class="select2_select_option custom-select shadow-none form-control travaux_disabled" multiple>
                                        @foreach ($bareme_travaux_tags as $tag)
                                            @if ($lead->LeadTravaxTags->where('id',  $tag->id)->first())
                                                <option  value="disabled" disabled="disabled" selected>{{ $tag->tag }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="productListBlock">
                        @foreach ($bareme_travaux_tags as $product_tag)
                            @php
                                $lead_travaux_tags = \App\Models\CRM\LeadTravauxTag::where('lead_id', $lead->id)->where('tag_id', $product_tag->id)->first();
                            @endphp
                            @if ($lead->LeadTravaxTags->where('id',  $product_tag->id)->first() && $product_tag->id != 7 && $product_tag->id != 29)
                                <div class="my-2 text-center"> 
                                    <button type="button" class="btn w-100" style="background-color: #9fbfe6; max-width: 540px;">{{ $product_tag->travaux }}</button>
                                </div>

                                <input type="hidden" data-tag-id="{{ $product_tag->id }}" class="tag__product">

                                @if ($product_tag->tag == 'CAG' || $product_tag->tag == 'POELE' || $product_tag->tag == 'PAC R/R' || $product_tag->tag == 'PAC R/O' || $product_tag->tag == 'CESI' || $product_tag->tag == 'BTD' || $product_tag->tag == 'SSC')
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <label class="form-label" for="status">Marque</label>
                                        </div>
                                        <select id="marque{{ $product_tag->id }}" class="select2_select_option shadow-none form-control travaux_disabled prjectMarquelist" data-tag-id="{{ $product_tag->id }}">
                                            <option value="">{{ __("Select") }}</option>
                                            @foreach ($marques as $marque)
                                                @if(in_array($marque->id, $product_tag->getProducts->pluck('marque_id')->toArray()))
                                                    <option {{ $lead_travaux_tags->marque == $marque->id ? 'selected':'' }} value="{{ $marque->id }}">{{ $marque->description }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                @if ($product_tag->tag == 'PAC R/R')
                                    <div class="form-group">
                                        <label class="form-label">Nombre de split</label>
                                        <input type="number" name="Nombre_de_split" id="Nombre_de_split{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->Nombre_de_split ?? '' }}">
                                    </div>
                                @endif
                                @if ($product_tag->rank == '1')
                                    <div class="form-group">
                                        <div class="d-flex align-items-center">
                                            <label class="form-label" for="status">Produit {{ $product_tag->tag }}</label>
                                        </div>
                                        <select id="product{{ $product_tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled project-tag-product--change" data-tag-id="{{ $product_tag->id }}" multiple>
                                            @foreach ($product_tag->getProducts as $product)
                                                @if ($product_tag->tag == 'CAG' || $product_tag->tag == 'POELE' || $product_tag->tag == 'PAC R/R' || $product_tag->tag == 'PAC R/O' || $product_tag->tag == 'CESI' || $product_tag->tag == 'BTD' || $product_tag->tag == 'SSC')
                                                    @if ($lead_travaux_tags->marque == $product->marque_id)
                                                    <option {{ \App\Models\CRM\LeadWorkTagProduct::where('work_id', $lead->id)->where('tag_id',  $product_tag->id)->where('product_id',  $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                    @endif
                                                @else
                                                    <option {{ \App\Models\CRM\LeadWorkTagProduct::where('work_id', $lead->id)->where('tag_id',  $product_tag->id)->where('product_id',  $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
								@endif
                                @if ($product_tag->tag == 'ITI_101' || $product_tag->tag == 'ITI_102' || $product_tag->tag == 'ITE_102' || $product_tag->tag == 'ITI_103' || $product_tag->tag == 'Crépis' || $product_tag->tag == 'ITE hors zone')
                                    @if ($product_tag->tag == 'ITI_101')
                                        <div class="form-group">
                                            <label class="form-label" for="Type_de_comble{{ $product_tag->id }}">Type de comble</label>
                                            <select name="Type_de_comble" id="Type_de_comble{{ $product_tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option {{ $lead_travaux_tags->Type_de_comble && $lead_travaux_tags->Type_de_comble == 'Comble perdu' ? 'selected':'' }} value="Comble perdu">Comble perdu</option>
                                                <option {{ $lead_travaux_tags->Type_de_comble && $lead_travaux_tags->Type_de_comble == 'Comble aménagés/aménagéable' ? 'selected':'' }} value="Comble aménagés/aménagéable">Comble aménagés/aménagéable</option>
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-label" for="surface{{ $product_tag->id }}">Surface {{ $product_tag->tag  }}</label>
                                        <input type="hidden" value="{{ $lead_travaux_tags->surface ?? ''  }}" id="surface{{ $product_tag->id }}" class="hidden_surface_m2_value">
                                        <input type="text" class="surface_m2_value form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->surface ?? '' }} m2">
                                    </div>
                                @endif
                                @if ($product_tag->tag == 'StoreBanne')
                                    <div class="form-group">
                                        <label class="form-label">Nombre de store banne</label>
                                        <input type="number" name="Nombre_de_split" id="Nombre_de_split{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->Nombre_de_split ?? '' }}">
                                    </div>
                                @endif
                                @if ($product_tag->tag == 'GD ITE')
                                    <div class="form-group">
                                        <label class="form-label">Nombre</label>
                                        <input type="number" name="Nombre_de_split" id="Nombre_de_split{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->Nombre_de_split ?? '' }}">
                                    </div>
                                @endif
                                <div id="projectTagProductWrap{{ $product_tag->id }}">
                                    @if ($product_tag->id == 2 || $product_tag->id == 6)
                                        @foreach (\App\Models\CRM\LeadWorkTagProduct::where('work_id', $lead->id)->where('tag_id',  $product_tag->id)->get()  as $selected_product)
                                            <div class="form-group">
                                                <label class="form-label">{{ \App\Models\CRM\Product::find($selected_product->product_id)->reference ?? '' }} : <button style="background-color: #B4C7E6" type="button" class="primary-btn primary-btn--sm rounded">Nombre</button></label>
                                                <input type="number" class="form-control shadow-none travaux_disabled tag_product_nombre" value="{{ \App\Models\CRM\LeadProductNombre::where('lead_id', $lead->id)->where('tag_id', $product_tag->id)->where('product_id', $selected_product->product_id)->first()->number ?? '' }}" data-product-id="{{ $selected_product->product_id }}" data-tag-id="{{ $product_tag->id }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                @if ($product_tag->tag == 'THERMO')
                                    <div class="form-group">
                                        <label class="form-label">SHAB:</label>
                                        <input type="number" step="any" name="shab" id="shab{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->shab }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nombre de pièces dans le logement:</label>
                                        <input type="number" step="any" name="Nombre_de_pièces_dans_le_logement" id="Nombre_de_pièces_dans_le_logement{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->Nombre_de_pièces_dans_le_logement }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nombre de radiateurs total dans le logement <span class="only--positive--value--alert"></span></label>
                                        <input type="number" step="any" min="0" name="Nombre_de_radiateur_total_dans_le_logement" id="Nombre_de_radiateur_total_dans_le_logement{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled only--positive--value" value="{{ $lead_travaux_tags->Nombre_de_radiateur_total_dans_le_logement }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="Type_de_radiateur{{ $product_tag->id }}">Type de radiateurs à équiper</label>
                                        <select name="Type_de_radiateur" id="Type_de_radiateur{{ $product_tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled Type_de_radiateur_select_input">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $lead_travaux_tags->Type_de_radiateur && $lead_travaux_tags->Type_de_radiateur == 'combustible' ? 'selected':'' }} value="combustible">combustible</option>
                                            <option {{ $lead_travaux_tags->Type_de_radiateur && $lead_travaux_tags->Type_de_radiateur == 'électrique' ? 'selected':'' }} value="électrique">électrique</option>
                                            <option {{ $lead_travaux_tags->Type_de_radiateur && $lead_travaux_tags->Type_de_radiateur == 'mixte' ? 'selected':'' }} value="mixte">mixte</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="Nombre_de_radiateurs_électrique_input" style="display: {{ ($lead_travaux_tags->Type_de_radiateur == 'mixte' || $lead_travaux_tags->Type_de_radiateur == 'électrique') ? '':'none'  }}">
                                        <label class="form-label">Nombre de radiateurs électrique à équiper:</label>
                                        <input type="number" step="any" name="Nombre_de_radiateurs_électrique" id="Nombre_de_radiateurs_électrique{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->Nombre_de_radiateurs_électrique }}">
                                    </div>
                                    <div class="form-group" id="Nombre_de_radiateurs_combustible_input" style="display: {{ ($lead_travaux_tags->Type_de_radiateur == 'mixte' || $lead_travaux_tags->Type_de_radiateur == 'combustible') ? '':'none'  }}">
                                        <label class="form-label">Nombre de radiateurs combustible à équiper:</label>
                                        <input type="number" step="any" name="Nombre_de_radiateurs_combustible" id="Nombre_de_radiateurs_combustible{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $lead_travaux_tags->Nombre_de_radiateurs_combustible }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="Thermostat_supplémentaire{{ $product_tag->id }}">Thermostat supplémentaire:</label>
                                        <select name="Thermostat_supplémentaire" id="Thermostat_supplémentaire{{ $product_tag->id }}" data-autre-box="Thermostat_supplémentaire_wrap" class="select2_select_option custom-select shadow-none form-control travaux_disabled other_field__system2">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $lead_travaux_tags->Thermostat_supplémentaire && $lead_travaux_tags->Thermostat_supplémentaire == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                            <option {{ $lead_travaux_tags->Thermostat_supplémentaire && $lead_travaux_tags->Thermostat_supplémentaire == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                        </select>
                                    </div>
                                    <div class="Thermostat_supplémentaire_wrap"  style="display: {{ ($lead_travaux_tags->Thermostat_supplémentaire == 'Oui')? '':'none' }}">
                                        <div class="form-group">
                                            <label class="form-label">Nombre thermostat supplémentaire:</label>
                                            <input type="number" step="any" name="Nombre_thermostat_supplémentaire" id="Nombre_thermostat_supplémentaire{{ $product_tag->id }}" class="form-control shadow-none travaux_disabled Nombre_thermostat_supplémentaire_input" data-price="{{ $product_tag->price }}" value="{{ $lead_travaux_tags->Nombre_thermostat_supplémentaire }}">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Montant:</label>
                                            <input type="text" disabled class="form-control shadow-none" id="Nombre_thermostat_supplémentaire_montant" value="{{ EuroFormat($lead_travaux_tags->Nombre_thermostat_supplémentaire*$product_tag->price) }}">
                                        </div>
                                    </div> 
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="d-flex align-items-center justify-content-between">
                                <label class="form-label" for="Type_de_contrat">Type de contrat:</label>
                            </div>
                            <select name="Type_de_contrat" id="Type_de_contrat"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
                                {{-- <option value="" selected>{{ __('Select') }}</option>
                                <option {{ $lead->Type_de_contrat == 'Credit' ? 'selected':'' }} value="Credit">Credit</option>
                                <option {{ $lead->Type_de_contrat == 'MaPrimeRenov' ? 'selected':'' }} value="MaPrimeRenov">MaPrimeRenov</option>
                                <option {{ $lead->Type_de_contrat == 'Bar TH 164' ? 'selected':'' }} value="Bar TH 164">Bar TH 164</option> --}}

                                <option value=" " selected>{{ __('Select') }}</option>
                                <option data-color="#ffffff" data-background="#00818E" {{ $lead->Type_de_contrat == 'Credit' ? 'selected':'' }} value="Credit">Credit</option>
                                <option data-color="#000000" data-background="#B2E6D9" {{ $lead->Type_de_contrat == 'MaPrimeRenov' ? 'selected':'' }} value="MaPrimeRenov">MaPrimeRenov</option>
                                <option data-color="#000000" data-background="#ff0000" {{ $lead->Type_de_contrat == 'BAR TH 164 – 2022' ? 'selected':'' }} value="BAR TH 164 – 2022">BAR TH 164 – 2022</option>
                                <option data-color="#000000" data-background="#F8A0EE" {{ $lead->Type_de_contrat == 'BAR TH 164 – 2023' ? 'selected':'' }} value="BAR TH 164 – 2023">BAR TH 164 – 2023</option>
                                <option data-color="#000000" data-background="#9BB8CD" {{ $lead->Type_de_contrat == 'BAR TH 164 – 2023 (après 01/07/2023)' ? 'selected':'' }} value="BAR TH 164 – 2023 (après 01/07/2023)">BAR TH 164 – 2023 (après 01/07/2023)</option>
                                <option data-color="#000000" data-background="#EADFB4" {{ $lead->Type_de_contrat == 'BAR TH 145' ? 'selected':'' }} value="BAR TH 145">BAR TH 145</option>
                                <option data-color="#000000" data-background="#FFB996" {{ $lead->Type_de_contrat == 'BAR TH 173' ? 'selected':'' }} value="BAR TH 173">BAR TH 173</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button id="MaPrimeRenovUpdateBtn" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                            Calcul des aides
                        </button>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="mb-0 text-right">MaPrimeRenov</h4>
                            </div>
                            <div class="col-md-10">
                                <label class="switch-checkbox">
                                    <input type="checkbox" data-autre-box="work__MaPrimeRenov" class="switch-checkbox__input other_field__system travaux_disabled" id="MaPrimeRenov"  name="MaPrimeRenov" {{ ($lead->MaPrimeRenov == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__MaPrimeRenov" style="display: {{ ($lead->MaPrimeRenov == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                @if ($primary_tax)
                                    <h4 class="mb-0">Montant estimée de l’aide: <span id="MaPrimeRenovEstimatedAmount">{{ MaPrimeRenovEstimatedAmount($lead->Mode_de_chauffage, $lead->precariousness,  $lead->LeadBareme->pluck('id')) }}</span></h4>
                                    <h4 class="mb-0 mt-4">Précarité du client: <span class="precarious p-2 d-inline-block" style="border-radius: 5px; background-color:
                                    @if ($lead->precariousness == 'Classique')
                                         #FF00FF;
                                         color:black;
                                    @elseif($lead->precariousness == 'Intermediaire')
                                         #9900FF;
                                         color:white;
                                    @elseif($lead->precariousness == 'Precaire')
                                         #FFD966;
                                         color:black;
                                    @elseif($lead->precariousness == 'Grand Precaire')
                                         #3C78D8;
                                         color:white;
                                    @endif
                                    ">{{ $lead->precariousness }}</span></h4>
                                    <div class="form-group mt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Subvention_MaPrimeRénov_déduit_du_devis">Subvention MaPrimeRénov déduit du devis ?</label>
                                        </div>
                                        <select name="Subvention_MaPrimeRénov_déduit_du_devis" id="Subvention_MaPrimeRénov_déduit_du_devis"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
                                            <option value=" " selected>{{ __('Select') }}</option>
                                            <option  data-color="#000000" data-background="#93C47D" {{ $lead->Subvention_MaPrimeRénov_déduit_du_devis == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                            <option data-color="#000000" data-background="#EA9999" {{ $lead->Subvention_MaPrimeRénov_déduit_du_devis == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                        </select>
                                    </div>
                                    <div class="form-group mt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov">Le demandeur a déjà fait une demande à MaPrimeRenov ?</label>
                                        </div>
                                        <select name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
                                            <option value=" " selected>{{ __('Select') }}</option>
                                            <option  data-color="#000000" data-background="#EA9999" {{ $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                            <option data-color="#000000" data-background="#93C47D" {{ $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                        </select>
                                    </div>
                                @else
                                    <h4 class="mb-0">Avis impôt non renseigné </h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="mb-0 text-right">Action Logement</h4>
                            </div>
                            <div class="col-md-10">
                                <label class="switch-checkbox">
                                    <input type="checkbox" data-autre-box="work__Action_Logement"  class="switch-checkbox__input other_field__system travaux_disabled"  id="Action_Logement"  name="Action_Logement" {{ ($lead->Action_Logement == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="mb-0 text-right">CEE</h4>
                            </div>
                            <div class="col-md-10">
                                <label class="switch-checkbox">
                                    <input type="checkbox" data-autre-box="work__CEE"  class="switch-checkbox__input travaux_disabled other_field__system"  id="CEE"  name="CEE" {{ ($lead->CEE == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__CEE" style="display: {{ ($lead->CEE == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                @if ($primary_tax)
                                    <h4 id="CEEEstimatedCalculate" class="mb-0 {{ ($lead->LeadBareme->count() == 1 && $lead->LeadBareme->first()->id == 7) ? 'd-none':'' }}">Montant estimée de l’aide : <span id="CEEEstimatedAmount">{{ CEEEstimatedAmount($lead->Mode_de_chauffage, $lead->precariousness,  $lead->LeadBareme->pluck('id')) }}</span></h4>
                                    <div id="CEEEstimatedWrap" class="{{ ($lead->LeadBareme->count() == 1 && $lead->LeadBareme->first()->id == 7) ? '':'d-none' }}">
                                        <div class="form-group d-flex align-items-center">
                                            <h4 class="mr-2">Montant estimée de l’aide :</h4>
                                            <div class="d-flex align-item-center justify-content-end">
                                                <input type="text" readonly name="Montant_estimée_de_lapostropheaide" id="Montant_estimée_de_lapostropheaide" class="form-control shadow-none travaux_disabled" value="{{ $lead->Montant_estimée_de_lapostropheaide }}">
                                                <button type="button" data-input-id="Montant_estimée_de_lapostropheaide" class="border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                                @if(role() == 'manager' || role() == 's_admin' || role() == 'manager_direction')
                                                    informations_personal
                                                @endif
                                                ">
                                                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="mb-0 mt-2">Précarité du client: <span class="precarious p-2 d-inline-block"  style="border-radius: 5px; background-color:
                                        @if ($lead->precariousness == 'Classique')
                                             #FF00FF;
                                             color:black;
                                        @elseif($lead->precariousness == 'Intermediaire')
                                             #9900FF;
                                             color:white;
                                        @elseif($lead->precariousness == 'Precaire')
                                             #FFD966;
                                             color:black;
                                        @elseif($lead->precariousness == 'Grand Precaire')
                                             #3C78D8;
                                             color:white;
                                        @endif
                                        ">{{ $lead->precariousness }}</span></h4>
                                @else
                                    <h4 class="mb-0">Avis impôt non renseigné </h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="mb-0 text-right">Credit</h4>
                            </div>
                            <div class="col-md-10">
                                <label class="switch-checkbox">
                                    <input type="checkbox" data-autre-box="work__credit"  class="switch-checkbox__input travaux_disabled other_field__system"  id="Credit"  name="Credit" {{ ($lead->Credit == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__credit" style="display: {{ ($lead->Credit == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                <div class="form-group">
                                    <label class="form-label" for="Montant_Crédit">Montant Crédit</label>
                                    <input type="hidden" value="{{ $lead->Montant_Crédit  }}" name="Montant_Crédit" id="Montant_Crédit" class="montant_value">
                                    <input type="text" class="form-control shadow-none travaux_disabled montant_format" value="{{ EuroFormat($lead->Montant_Crédit) }}">
                                </div>
                                <div class="mt-4 d-flex align-items-center">
                                    <span class="mb-0 mr-2">Report du crédit</span>
                                    <label class="switch-checkbox">
                                        <input type="checkbox" data-autre-box="work__Report_du_crédit" class="switch-checkbox__input travaux_disabled other_field__system" {{ $lead->Report_du_crédit == 'yes'? 'checked':'' }} name="Report_du_crédit" id="Report_du_crédit">
                                        <span class="switch-checkbox__label"></span>
                                    </label>
                                </div>
                                <div class="mt-2 work__Report_du_crédit" style="display: {{ ($lead->Report_du_crédit == 'yes') ? "": 'none' }}">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Nombre_de_jours_report">Nombre de jours report:</label>
                                        </div>
                                        <select name="Nombre_de_jours_report" id="Nombre_de_jours_report"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $lead->Nombre_de_jours_report == '0 jours' ? 'selected':'' }} value="0 jours">0 jours</option>
                                            <option {{ $lead->Nombre_de_jours_report == '90 jours' ? 'selected':'' }} value="90 jours">90 jours</option>
                                            <option {{ $lead->Nombre_de_jours_report == '140 jours' ? 'selected':'' }} value="140 jours">140 jours</option>
                                            <option {{ $lead->Nombre_de_jours_report == '180 jours' ? 'selected':'' }} value="180 jours">180 jours</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-md-2">
                                <h4 class="mb-0 text-right">Reste à  charge</h4>
                            </div>
                            <div class="col-md-10">
                                <label class="switch-checkbox">
                                    <input type="checkbox" data-autre-box="work__Reste_à_charge"  class="switch-checkbox__input travaux_disabled other_field__system"  id="Reste_à_charge"  name="Reste_à_charge" {{ ($lead->Reste_à_charge == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__Reste_à_charge" style="display: {{ ($lead->Reste_à_charge == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                <div class="form-group">
                                    <label class="form-label" for="Reste_à_charge_Montant">Montant</label>
                                    <input type="hidden" value="{{ $lead->Reste_à_charge_Montant  }}" name="Reste_à_charge_Montant" id="Reste_à_charge_Montant" class="montant_value">
                                    <input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($lead->Reste_à_charge_Montant) }}">
                                </div>
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="Mode_de_paiement">Mode de paiement:</label>
                                    </div>
                                    <select name="Mode_de_paiement" id="Mode_de_paiement" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $lead->Mode_de_paiement == 'Comptant' ? 'selected':'' }} value="Comptant">Comptant</option>
                                        <option {{ $lead->Mode_de_paiement == 'Différé' ? 'selected':'' }} value="Différé">Différé</option>
                                    </select>
                                </div>
                                <div class="form-group work__Mode_de_paiement"  style="display: {{ $lead->Mode_de_paiement == 'Différé' ? '':'none' }}">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="Nombre_de_mensualités">Nombre de mensualités:</label>
                                    </div>
                                    <select name="Nombre_de_mensualités" id="Nombre_de_mensualités"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $lead->Nombre_de_mensualités == '1' ? 'selected':'' }} value="1">1</option>
                                        <option {{ $lead->Nombre_de_mensualités == '2' ? 'selected':'' }} value="2">2</option>
                                        <option {{ $lead->Nombre_de_mensualités == '3' ? 'selected':'' }} value="3">3</option>
                                        <option {{ $lead->Nombre_de_mensualités == '4' ? 'selected':'' }} value="4">4</option>
                                        <option {{ $lead->Nombre_de_mensualités == '5' ? 'selected':'' }} value="5">5</option>
                                    </select>
                                </div>
                                @if (\Auth::user()->getRoleName->category_id != 1)
                                    <div class="p-3" style="background-color: #ffffff"> 
                                        <div class="form-group d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Survente">Survente</label>
                                            <select name="Survente" id="Survente" data-autre-box="work__Survente" class="other_field__system2 custom-select shadow-none w-auto travaux_disabled">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option {{ $lead->Survente == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                <option {{ $lead->Survente == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                            </select>
                                        </div>  
                                        <div class="form-group work__Survente" style="display: {{ ($lead->Survente == 'Oui')? '':'none' }}">
                                            <label class="form-label" for="Montant_survente">Montant survente :</label>
                                            <input type="hidden" value="{{ $lead->Montant_survente  }}" name="Montant_survente" id="Montant_survente" class="montant_value">
                                            <input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($lead->Montant_survente) }}">
                                        </div> 
                                        <div class="form-group">
                                            <label class="form-label" for="Observations_reste_à_charge">Observations reste à charge</label>
                                            <textarea name="Observations_reste_à_charge" id="Observations_reste_à_charge" class="form-control shadow-none travaux_disabled">{{ $lead->Observations_reste_à_charge }}</textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label class="form-label" for="advance_visit">Disponibilité pour prévisite (jour /horaire)</label>
                            <textarea name="advance_visit" id="advance_visit" class="form-control shadow-none travaux_disabled">{{ $lead->advance_visit ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="Projet_observations">Observations</label>
                            <textarea name="Projet_observations" id="Projet_observations" class="form-control shadow-none travaux_disabled">{{ $lead->Projet_observations ?? '' }}</textarea>
                        </div>
                    </div>
                    @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'lead_collapse__project'), 'custom_field_data' => $lead->project_custom_field_data, 'class' => 'project__custom_field', 'disabled_class' => 'travaux_disabled'])

                    @if (checkAction(Auth::id(), 'lead_collapse__project', 'edit') || role() == 's_admin' || $edit_access)
                        <div class="col-12 text-center ">
                            <button id="travauxValidate"
                            type="button"  class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 travaux_disabled">
                                {{ __('Submit') }}
                            </button>
                            @if (role() == 's_admin')
                                <button type="button" data-collapse="lead_collapse__project" data-callapse_active="projet_active" class="addCustomFieldBtn primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 travaux_disabled">
                                    Ajouter un champ
                                </button>
                            @endif
                        </div>
                    @else
                        <div class="col-12 text-center">
                            <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
                                <span class="novecologie-icon-lock py-1"></span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>
    @endif
    @if (checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'view') ||checkAction(Auth::id(), 'lead_collapse_prescription_chantier', 'edit') || role() == 's_admin' || $edit_access)
        <div class="card lead__card border-0">
            <div class="card-header bg-transparent border-0 p-0" id="leadCard-9">
            <h2 class="mb-0">
                <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
                <span id="travaux-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4"></span>
                Prescriptions chantier
                <button data-tab="Projet" data-block="Prescriptions chantier" data-tab-class="lead__prescription_chantier" type="button" data-toggle="collapse" data-target="#leadCardCollapse-9" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('lead__prescription_chantier') }} position-relative ml-auto mr-1 {{ session('lead__prescription_chantier') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
                </div>
            </h2>
            </div>
            <div id="leadCardCollapse-9" class="collapse {{ session('lead__prescription_chantier') == 'active' ? 'show':'' }} aria-labelledby="leadCard-9">
            <div class="card-body row">
                <div class="col custom-space">
                    <div class="col custom-space collapseRow" style="display: {{ $collapse_status ? '':'none' }}" id="questionBlock">
                        @include('includes.crm.lead_question')
                    </div>
                </div>
            </div>
            </div>
        </div>
    @endif
    {{-- @endif  --}}
</div>
