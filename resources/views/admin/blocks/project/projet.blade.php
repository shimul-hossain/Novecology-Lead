@php
    $primary_tax = \App\Models\CRM\ProjectTax::where('project_id', $project->id)->where('primary', 'yes')->first();
    $bareme_travaux_tags = \App\Models\CRM\BaremeTravauxTag::orderBy('order')->get();
    $selected_baremes = $project->ProjectBareme;
    $all_inputs = \App\Models\CRM\ProjectCustomField::all();
    $marques = \App\Models\Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();
@endphp
<div class="accordion" id="leadAccordion3">
    @if ($user_actions->where('module_name', 'collapse_travaux')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_travaux')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-8">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="travaux-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4

            "></span>
            Projet
            <small class="btn btn-sm ml-auto" id="proejctCollapseStatusBtn" style="background-color:{{ $project->Type_de_contrat && $project->Statut_Projet ? '#93C47D':'#F4CCCC' }};">Projet : <span id="proejctCollapseStatus">{{ $project->Type_de_contrat && $project->Statut_Projet ? 'Statué':'Non Statué' }}</span></small>
                <button data-tab="Section Projet" data-block="Travaux" data-tab-class="travaux__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-8" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('travaux__part') }} position-relative ml-3 {{ session('travaux__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-8" class="collapse {{ session('travaux__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-8">
        <div class="card-body row">
            <div class="col custom-space">
                <div class="row">
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
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="bareme"> Barème <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="d-flex align-item-center justify-content-end">
                                        <select name="bareme[]" id="bareme" {{ $project->Type_de_contrat && $project->Statut_Projet == 'Devis signé' ? 'disabled':'' }} class="select2_select_option custom-select shadow-none form-control travaux_disabled project_lock_input" multiple>
                                            @foreach ($bareme_travaux_tags->where('rank', 1) as $baremes)
                                            @if ($selected_baremes->whereIn('id',  [7,29])->first())
                                                @if ($selected_baremes->where('id',  $baremes->id)->first())
                                                    <option selected value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
                                                @endif
                                            @else
                                                <option {{ $selected_baremes->where('id',  $baremes->id)->first()? 'selected':'' }} value="{{ $baremes->id }}">{{ $baremes->bareme }}-{{ $baremes->bareme_description }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <button type="button" data-input-id="bareme" class="{{ $project->Type_de_contrat && $project->Statut_Projet == 'Devis signé' ? '':'d-none' }} border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                        @if($role == 'manager' || $role == 's_admin' || $role == 'manager_direction')
                                            project_lock_button
                                        @endif
                                         ">
                                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="travaux"> Travaux <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="d-flex align-item-center justify-content-end">
                                        <select name="travaux[]" id="travaux" {{ $project->Type_de_contrat && $project->Statut_Projet == 'Devis signé' ? 'disabled':'' }} class="select2_select_option custom-select shadow-none form-control travaux_disabled project_lock_input" multiple>
                                            @foreach ($bareme_travaux_tags as $travaux)
                                                @if ($selected_baremes->whereIn('id',  [7,29])->first())
                                                    @if ($selected_baremes->where('id',  $travaux->id)->first())
                                                        <option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>
                                                    @else
                                                        <option {{ $project->ProjectTravaux->where('id',  $travaux->id)->first() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                    @endif
                                                @else
                                                    @if ($travaux->rank == '1')
                                                        @if ($project->ProjectTravaux->where('id',  $travaux->id)->first())
                                                            <option value="disabled" disabled="disabled" selected>{{ $travaux->travaux }}</option>
                                                        @endif
                                                    @else
                                                        <option {{ $project->ProjectTravaux->where('id',  $travaux->id)->first() ? 'selected':'' }} value="{{ $travaux->id }}">{{ $travaux->travaux }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="button" data-input-id="travaux" class="{{ $project->Type_de_contrat && $project->Statut_Projet == 'Devis signé' ? '':'d-none' }} border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                        @if($role == 'manager' || $role == 's_admin' || $role == 'manager_direction')
                                            project_lock_button
                                        @endif
                                            ">
                                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="tag">TAG <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="d-flex align-item-center justify-content-end">
                                        <select name="tag[]" id="tag" {{ $project->Type_de_contrat && $project->Statut_Projet == 'Devis signé' ? 'disabled':'' }} class="select2_select_option custom-select shadow-none form-control travaux_disabled project_lock_input" multiple>
                                            @foreach ($bareme_travaux_tags as $tag)
                                                @if ($project->ProjectTravauxTags->where('id',  $tag->id)->first())
                                                    <option  value="disabled" disabled="disabled" selected>{{ $tag->tag }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="button" data-input-id="tag" class="{{ $project->Type_de_contrat && $project->Statut_Projet == 'Devis signé' ? '':'d-none' }} border-0 edit-toggler position-absolute ml-auto mt-1 mr-1
                                        @if($role == 'manager' || $role == 's_admin' || $role == 'manager_direction')
                                            project_lock_button
                                        @endif
                                            ">
                                            <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                                            <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row"  id="productListBlock">
                            @foreach ($project->projectTagItem as $product_tag)
                                @if ($product_tag->getTag && $product_tag->getTag->id != 7 && $product_tag->getTag->id != 29)
                                    <div class="col-12 my-2 text-center"> 
                                        <button type="button" class="btn w-100" style="background-color: #9fbfe6; max-width: 540px;">{{ $product_tag->getTag->travaux }}</button>
                                    </div>
                                    <input type="hidden" data-tag-id="{{ $product_tag->tag_id }}" class="tag__product">
                                    @if ($product_tag->getTag->tag == 'CAG' || $product_tag->getTag->tag == 'POELE' || $product_tag->getTag->tag == 'PAC R/R' || $product_tag->getTag->tag == 'PAC R/O' || $product_tag->getTag->tag == 'CESI' || $product_tag->getTag->tag == 'BTD' || $product_tag->getTag->tag == 'SSC')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label" for="status">Marque</label>
                                                </div>
                                                <select id="marque{{ $product_tag->tag_id }}" class="select2_select_option shadow-none form-control travaux_disabled prjectMarquelist" data-tag-id="{{ $product_tag->tag_id }}">
                                                    <option value="">{{ __("Select") }}</option>
                                                    @foreach ($marques as $marque)
                                                    @if(in_array($marque->id, $product_tag->getTag->getProducts->pluck('marque_id')->toArray()))
                                                        <option {{ $product_tag->marque == $marque->id ? 'selected':'' }} value="{{ $marque->id }}">{{ $marque->description }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product_tag->getTag->tag == 'PAC R/R')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre de split</label>
                                                <input type="number" name="Nombre_de_split" id="Nombre_de_split{{ $product_tag->tag_id }}" class="form-control shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_split ?? ''  }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product_tag->getTag->rank == '1')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center">
                                                    <label class="form-label" for="status">Produit {{ $product_tag->getTag->tag  }}</label>
                                                </div>
                                                <select id="product{{ $product_tag->tag_id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled project-tag-product--change" data-tag-id="{{ $product_tag->getTag->id }}" multiple>
                                                    @foreach ($product_tag->getTag->getProducts as $product)
                                                        @if ($product_tag->getTag->tag == 'CAG' || $product_tag->getTag->tag == 'POELE' || $product_tag->getTag->tag == 'PAC R/R' || $product_tag->getTag->tag == 'PAC R/O' || $product_tag->getTag->tag == 'CESI' || $product_tag->getTag->tag == 'BTD' || $product_tag->getTag->tag == 'SSC')
                                                            @if ($product_tag->marque == $product->marque_id)
                                                                <option {{ $project->getTagProduct()->where('product_id', $product->id)->where('tag_id',  $product_tag->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                            @endif
                                                        @else
                                                            <option {{ $project->getTagProduct()->where('product_id', $product->id)->where('tag_id',  $product_tag->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @else
                                        <input type="hidden" id="product{{ $product_tag->tag_id }}">
									@endif
                                    @if ($product_tag->getTag->tag == 'ITI_101' || $product_tag->getTag->tag == 'ITI_102' || $product_tag->getTag->tag == 'ITE_102' || $product_tag->getTag->tag == 'ITI_103'|| $product_tag->getTag->tag == 'Crépis' || $product_tag->getTag->tag == 'ITE hors zone')
                                        @if ($product_tag->getTag->tag == 'ITI_101')
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="Type_de_comble{{ $product_tag->tag_id }}">Type de comble</label>
                                                    <select name="Type_de_comble" id="Type_de_comble{{ $product_tag->tag_id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
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
                                                <input type="hidden" value="{{ $product_tag->surface  }}" id="surface{{ $product_tag->tag_id }}" class="hidden_surface_m2_value">
                                                <input type="text" class="surface_m2_value form-control shadow-none travaux_disabled" value="{{ $product_tag->surface }} m2">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product_tag->getTag->tag == 'StoreBanne')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre de store banne</label>
                                                <input type="number" name="Nombre_de_split" id="Nombre_de_split{{ $product_tag->tag_id }}" class="form-control shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_split ?? ''  }}">
                                            </div>
                                        </div>
                                    @endif
                                    @if ($product_tag->getTag->tag == 'GD ITE')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Nombre</label>
                                                <input type="number" name="Nombre_de_split" id="Nombre_de_split{{ $product_tag->tag_id }}" class="form-control shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_split ?? ''  }}">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        <div id="projectTagProductWrap{{ $product_tag->getTag->id }}">
                                            @if ($product_tag->getTag->id == 2 || $product_tag->getTag->id == 6)
                                                @foreach ($project->getTagProduct()->where('tag_id',  $product_tag->id)->get()  as $selected_product)
                                                    <div class="form-group">
                                                        <label class="form-label">{{ \App\Models\CRM\Product::find($selected_product->product_id)->reference ?? '' }} : <button style="background-color: #B4C7E6" type="button" class="primary-btn primary-btn--sm rounded">Nombre</button></label>
                                                        <input type="number" class="form-control shadow-none travaux_disabled tag_product_nombre" value="{{ \App\Models\CRM\ProjectProductNombre::where('project_id', $project->id)->where('tag_id', $product_tag->getTag->id)->where('product_id', $selected_product->product_id)->first()->number ?? '' }}" data-product-id="{{ $selected_product->product_id }}" data-tag-id="{{ $product_tag->getTag->id }}">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        @if ($product_tag->getTag->tag == 'THERMO')
                                            <div class="form-group">
                                                <label class="form-label">SHAB:</label>
                                                <input type="number" step="any" name="shab" id="shab{{ $product_tag->getTag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $product_tag->shab }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nombre de pièces dans le logement:</label>
                                                <input type="number" step="any" name="Nombre_de_pièces_dans_le_logement" id="Nombre_de_pièces_dans_le_logement{{ $product_tag->getTag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_pièces_dans_le_logement }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nombre de radiateurs total dans le logement <span class="only--positive--value--alert"></span></label>
                                                <input type="number" step="any" min="0" name="Nombre_de_radiateur_total_dans_le_logement" id="Nombre_de_radiateur_total_dans_le_logement{{ $product_tag->getTag->id }}" class="form-control shadow-none travaux_disabled only--positive--value" value="{{ $product_tag->Nombre_de_radiateur_total_dans_le_logement }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="Type_de_radiateur{{ $product_tag->getTag->id }}">Type de radiateurs à équiper</label>
                                                <select name="Type_de_radiateur" id="Type_de_radiateur{{ $product_tag->getTag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled Type_de_radiateur_select_input">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option {{ $product_tag->Type_de_radiateur && $product_tag->Type_de_radiateur == 'combustible' ? 'selected':'' }} value="combustible">combustible</option>
                                                    <option {{ $product_tag->Type_de_radiateur && $product_tag->Type_de_radiateur == 'électrique' ? 'selected':'' }} value="électrique">électrique</option>
                                                    <option {{ $product_tag->Type_de_radiateur && $product_tag->Type_de_radiateur == 'mixte' ? 'selected':'' }} value="mixte">mixte</option>
                                                </select>
                                            </div>
                                            <div class="form-group" id="Nombre_de_radiateurs_électrique_input" style="display: {{ ($product_tag->Type_de_radiateur == 'mixte' || $product_tag->Type_de_radiateur == 'électrique') ? '':'none'  }}">
                                                <label class="form-label">Nombre de radiateurs électrique à équiper:</label>
                                                <input type="number" step="any" name="Nombre_de_radiateurs_électrique" id="Nombre_de_radiateurs_électrique{{ $product_tag->getTag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_radiateurs_électrique }}">
                                            </div>
                                            <div class="form-group" id="Nombre_de_radiateurs_combustible_input" style="display: {{ ($product_tag->Type_de_radiateur == 'mixte' || $product_tag->Type_de_radiateur == 'combustible') ? '':'none'  }}">
                                                <label class="form-label">Nombre de radiateurs combustible à équiper:</label>
                                                <input type="number" step="any" name="Nombre_de_radiateurs_combustible" id="Nombre_de_radiateurs_combustible{{ $product_tag->getTag->id }}" class="form-control shadow-none travaux_disabled" value="{{ $product_tag->Nombre_de_radiateurs_combustible }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="Thermostat_supplémentaire{{ $product_tag->getTag->id }}">Thermostat supplémentaire:</label>
                                                <select name="Thermostat_supplémentaire" id="Thermostat_supplémentaire{{ $product_tag->getTag->id }}" data-autre-box="Thermostat_supplémentaire_wrap" class="select2_select_option custom-select shadow-none form-control travaux_disabled other_field__system2">
                                                    <option value="" selected>{{ __('Select') }}</option>
                                                    <option {{ $product_tag->Thermostat_supplémentaire && $product_tag->Thermostat_supplémentaire == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                    <option {{ $product_tag->Thermostat_supplémentaire && $product_tag->Thermostat_supplémentaire == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                                </select>
                                            </div>
                                            <div class="Thermostat_supplémentaire_wrap"  style="display: {{ ($product_tag->Thermostat_supplémentaire == 'Oui')? '':'none' }}">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre thermostat supplémentaire:</label>
                                                    <input type="number" step="any" name="Nombre_thermostat_supplémentaire" id="Nombre_thermostat_supplémentaire{{ $product_tag->getTag->id }}" class="form-control shadow-none travaux_disabled Nombre_thermostat_supplémentaire_input" data-price="{{ $product_tag->getTag->price }}" value="{{ $product_tag->Nombre_thermostat_supplémentaire }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Montant:</label>
                                                    <input type="text" disabled class="form-control shadow-none" id="Nombre_thermostat_supplémentaire_montant" value="{{ EuroFormat($product_tag->Nombre_thermostat_supplémentaire*$product_tag->getTag->price) }}">
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
                                <label class="form-label" for="Type_de_contrat">Type de contrat:</label>
                            </div>
                            <select name="Type_de_contrat" id="Type_de_contrat"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
                                <option value=" " selected>{{ __('Select') }}</option>
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
                                <label class="form-label" for="Faisabilité_du_projet">Faisabilité du projet: </span></label>
                            </div>
                            <select name="Faisabilité_du_projet" id="Faisabilité_du_projet"  class="select2_color_option shadow-none form-control travaux_disabled">
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
                                <label class="form-label" for="Statut_Projet">Statut Projet:</label>
                            </div>
                            <select name="Statut_Projet" id="Statut_Projet"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
                                <option value=" " selected>{{ __('Select') }}</option>
                                <option data-color="#ffffff" data-background="green" {{ $project->Statut_Projet == 'Devis signé' ? 'selected':'' }} value="Devis signé">Devis signé</option>
                                <option data-color="#ffffff" data-background="orange" {{ $project->Statut_Projet == 'Réflexion' ? 'selected':'' }} value="Réflexion">Réflexion</option>
                                <option data-color="#ffffff" data-background="red" {{ $project->Statut_Projet == 'KO' ? 'selected':'' }} value="KO">KO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 RaisonsBlock" style="display: {{ $project->Statut_Projet == 'KO' || $project->Statut_Projet == 'Réflexion' ? '':'none' }}">
                        <div class="form-group">
                            <label class="form-label" for="Raisons">Raisons</label>
                            <textarea name="Raisons" id="Raisons" class="form-control shadow-none travaux_disabled">{{ $project->Raisons ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 DevisSignéFinancementIMBlock" style="display:{{ $project->Type_de_contrat && ($project->Statut_Projet == 'Devis signé' || $project->Statut_Projet == 'Réflexion') ? '':'none' }}">
                        <div class="form-group">
                            <label class="form-label" for="Bon_De_Commande">Montant TTC Devis / Bon De Commande :</label>
                            <input type="number" step="any" name="Bon_De_Commande" value="{{ $project->Bon_De_Commande }}" id="Bon_De_Commande" class="form-control shadow-none travaux_disabled">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Bon_De_Commande_signé_le">Devis / Bon De Commande signé le</label>
                            <input type="date" name="Bon_De_Commande_signé_le" id="Bon_De_Commande_signé_le"  value="{{ $project->Bon_De_Commande_signé_le }}" class="flatpickr form-control shadow-none travaux_disabled">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="Reste_à_charge_devis">Reste à charge devis :</label>
                            <input type="number" step="any" name="Reste_à_charge_devis" value="{{ $project->Reste_à_charge_devis }}" id="Reste_à_charge_devis" class="form-control shadow-none travaux_disabled">
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <label class="form-label" for="Attestation_de_reste_à_charge">Attestation de reste à charge MaPrimeRenov</label>
                                    <select name="Attestation_de_reste_à_charge" id="Attestation_de_reste_à_charge" data-autre-box="work__Attestation_de_reste_à_charge" class="other_field__system2 custom-select shadow-none travaux_disabled w-auto">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $project->Attestation_de_reste_à_charge == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                        <option {{ $project->Attestation_de_reste_à_charge == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group d-flex align-items-center">
                                    <h4 class="mb-0 mr-2">Attestation de reste à charge</h4>
                                    <label class="switch-checkbox">
                                        <input type="checkbox" data-autre-box="work__Attestation_de_reste_à_charge" class="switch-checkbox__input other_field__system travaux_disabled" id="Attestation_de_reste_à_charge"  name="Attestation_de_reste_à_charge" {{ ($project->Attestation_de_reste_à_charge == 'yes')? 'checked':'' }}>
                                        <span class="switch-checkbox__label"></span>
                                    </label>
                                </div>
                            </div> --}}
                            <div class="col-12 work__Attestation_de_reste_à_charge" style="display: {{ ($project->Attestation_de_reste_à_charge == 'Oui')? '':'none' }}">
                                <div class="form-group">
                                    <label class="form-label" for="Reste_à_charge_client">Reste à charge client :</label>
                                    <input type="number" step="any" name="Reste_à_charge_client" value="{{ $project->Reste_à_charge_client }}" id="Reste_à_charge_client" class="form-control shadow-none travaux_disabled">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="Montant_attestation_RAC">Montant attestation RAC :</label>
                                    <input type="hidden" value="{{ $project->Montant_attestation_RAC  }}" name="Montant_attestation_RAC" id="Montant_attestation_RAC" class="montant_value">
                                    <input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($project->Montant_attestation_RAC) }}">
                                </div>
                            </div>
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
                                    <input type="checkbox" data-autre-box="work__MaPrimeRenov" class="switch-checkbox__input other_field__system travaux_disabled" id="MaPrimeRenov"  name="MaPrimeRenov" {{ ($project->MaPrimeRenov == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__MaPrimeRenov" style="display: {{ ($project->MaPrimeRenov == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                @if ($primary_tax)
                                    <h4 class="mb-0">Montant estimée de l’aide: <span id="MaPrimeRenovEstimatedAmount">{{ MaPrimeRenovEstimatedAmount($project->Mode_de_chauffage, $project->precariousness,  $selected_baremes->pluck('id')) }}</span></h4>
                                    <h4 class="mb-0 mt-4">Précarité du client: <span class="precarious p-2 d-inline-block" style="border-radius: 5px; background-color:
                                    @if ($project->precariousness == 'Classique')
                                            #FF00FF;
                                            color:white;
                                    @elseif($project->precariousness == 'Intermediaire')
                                            #9900FF;
                                            color:white;
                                    @elseif($project->precariousness == 'Precaire')
                                            #FFD966;
                                            color:black;
                                    @elseif($project->precariousness == 'Grand Precaire')
                                            #3C78D8;
                                            color:white;
                                    @endif
                                    ">{{ $project->precariousness }}</span></h4>
                                    {{-- <div class="mt-4 d-flex align-items-center">
                                        <span class="mb-0 mr-2">Subvention MaPrimeRénov déduit du devis ?</span>
                                        <div class="multi-option-switch">
                                            <div class="multi-option-switch__body">
                                                <input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input travaux_disabled" id="Subvention_MaPrimeRénov_déduit_du_devis--off" name="Subvention_MaPrimeRénov_déduit_du_devis" {{ ($project->Subvention_MaPrimeRénov_déduit_du_devis == 'no')? 'checked':'' }}>
                                                <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input travaux_disabled" value="n/a" id="Subvention_MaPrimeRénov_déduit_du_devis--disabled" name="Subvention_MaPrimeRénov_déduit_du_devis" {{ ($project->Subvention_MaPrimeRénov_déduit_du_devis != 'yes' && $project->Subvention_MaPrimeRénov_déduit_du_devis != 'no')? 'checked':'' }}>
                                                <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input travaux_disabled"  value="yes" id="Subvention_MaPrimeRénov_déduit_du_devis--on" name="Subvention_MaPrimeRénov_déduit_du_devis" {{ ($project->Subvention_MaPrimeRénov_déduit_du_devis == 'yes')? 'checked':'' }}>
                                                <span class="multi-option-switch__float-indicator"></span>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Subvention_MaPrimeRénov_déduit_du_devis--off">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-x-lg"></i>
                                                    </span>
                                                </label>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Subvention_MaPrimeRénov_déduit_du_devis--disabled">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-circle"></i>
                                                    </span>
                                                </label>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Subvention_MaPrimeRénov_déduit_du_devis--on">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-check-lg"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group mt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Subvention_MaPrimeRénov_déduit_du_devis">Subvention MaPrimeRénov déduit du devis ?</label>
                                        </div>
                                        <select name="Subvention_MaPrimeRénov_déduit_du_devis" id="Subvention_MaPrimeRénov_déduit_du_devis"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
                                            <option value=" " selected>{{ __('Select') }}</option>
                                            <option  data-color="#000000" data-background="#93C47D" {{ $project->Subvention_MaPrimeRénov_déduit_du_devis == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                            <option data-color="#000000" data-background="#EA9999" {{ $project->Subvention_MaPrimeRénov_déduit_du_devis == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                        </select>
                                    </div>

                                    {{-- <div class="mt-4 d-flex align-items-center">
                                        <span class="mb-0 mr-2">Le demandeur a déjà fait une demande à MaPrimeRenov ?</span>
                                        <div class="multi-option-switch">
                                            <div class="multi-option-switch__body">
                                                <input type="radio" value="no" data-multi-switch-input="switch--off" class="multi-option-switch__input travaux_disabled" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--off" name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" {{ ($project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'no')? 'checked':'' }}>
                                                <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input travaux_disabled" value="n/a" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--disabled" name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" {{ ($project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov != 'yes' && $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov != 'no')? 'checked':'' }}>
                                                <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input travaux_disabled"  value="yes" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--on" name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" {{ ($project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'yes')? 'checked':'' }}>
                                                <span class="multi-option-switch__float-indicator"></span>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--off">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-x-lg"></i>
                                                    </span>
                                                </label>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--disabled">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-circle"></i>
                                                    </span>
                                                </label>
                                                <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov--on">
                                                    <span class="multi-option-switch__label__btn">
                                                        <i class="bi bi-check-lg"></i>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group mt-4">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov">Le demandeur a déjà fait une demande à MaPrimeRenov ?</label>
                                        </div>
                                        <select name="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" id="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov"  class="select2_color_option custom-select shadow-none form-control travaux_disabled">
                                            <option value=" " selected>{{ __('Select') }}</option>
                                            <option  data-color="#000000" data-background="#EA9999" {{ $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                            <option data-color="#000000" data-background="#93C47D" {{ $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov == 'Non' ? 'selected':'' }} value="Non">Non</option>
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
                                    <input type="checkbox" data-autre-box="work__Action_Logement"  class="switch-checkbox__input other_field__system travaux_disabled"  id="Action_Logement"  name="Action_Logement" {{ ($project->Action_Logement == 'yes')? 'checked':'' }}>
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
                                    <input type="checkbox" data-autre-box="work__CEE"  class="switch-checkbox__input travaux_disabled other_field__system"  id="CEE"  name="CEE" {{ ($project->CEE == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__CEE" style="display: {{ ($project->CEE == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                @if ($primary_tax)
                                    <h4 id="CEEEstimatedCalculate" class="mb-0 {{ ($selected_baremes->count() == 1 && $selected_baremes->first()->id == 7) ? 'd-none':'' }}">Montant estimée de l’aide : 
                                        @if ($project->projectSecondTable && ($project->projectSecondTable->manual_import == 1 || $project->projectSecondTable->manual_import == 2))
                                            <span>
                                                {{ EuroFormat($project->projectSecondTable->montant_cee) }}
                                            </span>
                                        @else 
                                            <span id="CEEEstimatedAmount">{{ CEEEstimatedAmount($project->Mode_de_chauffage, $project->precariousness,  $selected_baremes->pluck('id')) }}</span>
                                        @endif
                                    </h4>
                                        <div id="CEEEstimatedWrap" class="{{ ($selected_baremes->count() == 1 && $selected_baremes->first()->id == 7) ? '':'d-none' }}">
                                            <div class="form-group d-flex align-items-center">
                                                <h4 class="mr-2">Montant estimée de l’aide :</h4>
                                                <div class="d-flex align-item-center justify-content-end">
                                                    <input type="text" readonly name="Montant_estimée_de_lapostropheaide" id="Montant_estimée_de_lapostropheaide" class="form-control shadow-none travaux_disabled" value="{{ $project->Montant_estimée_de_lapostropheaide }}">
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

                                    <h4 class="mb-0 mt-4">Précarité du client: <span class="precarious p-2 d-inline-block"  style="border-radius: 5px; background-color:
                                        @if ($project->precariousness == 'Classique')
                                                #FF00FF;
                                                color:white;
                                        @elseif($project->precariousness == 'Intermediaire')
                                                #9900FF;
                                                color:white;
                                        @elseif($project->precariousness == 'Precaire')
                                                #FFD966;
                                                color:black;
                                        @elseif($project->precariousness == 'Grand Precaire')
                                                #3C78D8;
                                                color:white;
                                        @endif
                                        ">{{ $project->precariousness }}</span></h4>
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
                                    <input type="checkbox" data-autre-box="work__credit"  class="switch-checkbox__input travaux_disabled other_field__system"  id="Credit"  name="Credit" {{ ($project->Credit == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__credit" style="display: {{ ($project->Credit == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                <div class="form-group">
                                    <label class="form-label" for="Montant_Crédit">Montant Crédit</label>
                                    <input type="hidden" value="{{ $project->Montant_Crédit  }}" name="Montant_Crédit" id="Montant_Crédit" class="montant_value">
                                    <input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($project->Montant_Crédit) }}">
                                </div>
                                <div class="mt-4 d-flex align-items-center">
                                    <span class="mb-0 mr-2">Report du crédit</span>
                                    <label class="switch-checkbox">
                                        <input type="checkbox" data-autre-box="work__Report_du_crédit" class="switch-checkbox__input travaux_disabled other_field__system" {{ $project->Report_du_crédit == 'yes'? 'checked':'' }} name="Report_du_crédit" id="Report_du_crédit">
                                        <span class="switch-checkbox__label"></span>
                                    </label>
                                </div>
                                <div class="mt-2 work__Report_du_crédit" style="display: {{ ($project->Report_du_crédit == 'yes') ? "": 'none' }}">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Nombre_de_jours_report">Nombre de jours report:</label>
                                        </div>
                                        <select name="Nombre_de_jours_report" id="Nombre_de_jours_report"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            <option {{ $project->Nombre_de_jours_report == '0 jours' ? 'selected':'' }} value="0 jours">0 jours</option>
                                            <option {{ $project->Nombre_de_jours_report == '90 jours' ? 'selected':'' }} value="90 jours">90 jours</option>
                                            <option {{ $project->Nombre_de_jours_report == '140 jours' ? 'selected':'' }} value="140 jours">140 jours</option>
                                            <option {{ $project->Nombre_de_jours_report == '180 jours' ? 'selected':'' }} value="180 jours">180 jours</option>
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
                                    <input type="checkbox" data-autre-box="work__Reste_à_charge"  class="switch-checkbox__input travaux_disabled other_field__system"  id="Reste_à_charge"  name="Reste_à_charge" {{ ($project->Reste_à_charge == 'yes')? 'checked':'' }}>
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 work__Reste_à_charge" style="display: {{ ($project->Reste_à_charge == 'yes')? '':'none' }}">
                        <div class="card">
                            <div class="card-body" style="background-color: #F2F2F2">
                                <div class="form-group">
                                    <label class="form-label" for="Reste_à_charge_Montant">Montant</label>
                                    <input type="hidden" value="{{ $project->Reste_à_charge_Montant  }}" name="Reste_à_charge_Montant" id="Reste_à_charge_Montant" class="montant_value">
                                    <input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($project->Reste_à_charge_Montant) }}">
                                </div>
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="Mode_de_paiement">Mode de paiement:</label>
                                    </div>
                                    <select name="Mode_de_paiement" id="Mode_de_paiement" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $project->Mode_de_paiement == 'Comptant' ? 'selected':'' }} value="Comptant">Comptant</option>
                                        <option {{ $project->Mode_de_paiement == 'Différé' ? 'selected':'' }} value="Différé">Différé</option>
                                    </select>
                                </div>
                                <div class="form-group work__Mode_de_paiement"  style="display: {{ $project->Mode_de_paiement == 'Différé' ? '':'none' }}">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="form-label" for="Nombre_de_mensualités">Nombre de mensualités:</label>
                                    </div>
                                    <select name="Nombre_de_mensualités" id="Nombre_de_mensualités"  class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                                        <option value="" selected>{{ __('Select') }}</option>
                                        <option {{ $project->Nombre_de_mensualités == '1' ? 'selected':'' }} value="1">1</option>
                                        <option {{ $project->Nombre_de_mensualités == '2' ? 'selected':'' }} value="2">2</option>
                                        <option {{ $project->Nombre_de_mensualités == '3' ? 'selected':'' }} value="3">3</option>
                                        <option {{ $project->Nombre_de_mensualités == '4' ? 'selected':'' }} value="4">4</option>
                                        <option {{ $project->Nombre_de_mensualités == '5' ? 'selected':'' }} value="5">5</option>
                                    </select>
                                </div>
                                @if (\Auth::user()->getRoleName->category_id != 1)
                                    <div class="p-3" style="background-color: #ffffff"> 
                                        <div class="form-group d-flex align-items-center justify-content-between">
                                            <label class="form-label" for="Survente">Survente</label>
                                            <select name="Survente" id="Survente" data-autre-box="work__Survente" class="other_field__system2 custom-select shadow-none w-auto travaux_disabled">
                                                <option value="" selected>{{ __('Select') }}</option>
                                                <option {{ $project->Survente == 'Oui' ? 'selected':'' }} value="Oui">Oui</option>
                                                <option {{ $project->Survente == 'Non' ? 'selected':'' }} value="Non">Non</option>
                                            </select>
                                        </div>  
                                        <div class="form-group work__Survente" style="display: {{ ($project->Survente == 'Oui')? '':'none' }}">
                                            <label class="form-label" for="Montant_survente">Montant survente :</label>
                                            <input type="hidden" value="{{ $project->Montant_survente  }}" name="Montant_survente" id="Montant_survente" class="montant_value">
                                            <input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($project->Montant_survente) }}">
                                        </div> 
                                        <div class="form-group">
                                            <label class="form-label" for="Observations_reste_à_charge">Observations reste à charge</label>
                                            <textarea name="Observations_reste_à_charge" id="Observations_reste_à_charge" class="form-control shadow-none travaux_disabled">{{ $project->Observations_reste_à_charge }}</textarea>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="form-group">
                            <label class="form-label" for="advance_visit">Disponibilité pour prévisite (jour /horaire)</label>
                            <textarea name="advance_visit" id="advance_visit" class="form-control shadow-none travaux_disabled">{{ $project->advance_visit ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label" for="Projet_observations">Projet Observations</label>
                            <textarea name="Projet_observations" id="Projet_observations" class="form-control shadow-none travaux_disabled">{{ $project->Projet_observations ?? '' }}</textarea>
                        </div>
                    </div>
                    @include('admin.custom_field_data', ['inputs' => $all_inputs->where('collapse_name', 'lead_collapse__project'), 'custom_field_data' => $project->project_custom_field_data, 'class' => 'project__custom_field', 'disabled_class' => 'travaux_disabled'])
                    @if ($user_actions->where('module_name', 'collapse_travaux')->where('action_name', 'edit')->first() || $role == 's_admin')
                        <div class="col-12 text-center ">
                            <button id="travauxValidate"
                            type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5 travaux_disabled">
                                {{ __('Submit') }}
                            </button>
                            @if ($role == 's_admin')
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
    @if ($user_actions->where('module_name', 'collapse_question')->where('action_name', 'view')->first() ||$user_actions->where('module_name', 'collapse_question')->where('action_name', 'edit')->first() || $role == 's_admin')
    <div class="card lead__card border-0">
        <div class="card-header bg-transparent border-0 p-0" id="leadCard-9">
        <h2 class="mb-0">
            <div class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn">
            <span id="question-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
            @isset($question->height)
            verified
            @endisset
            "></span>
            Prescriptions chantier
                <button data-tab="Section Projet" data-block="Questionnaire" data-tab-class="questions__part" type="button" data-toggle="collapse" data-target="#leadCardCollapse-9" aria-expanded="false" class="d-flex border-0 edit-toggler edit-toggler--lock__access {{ session('questions__part') }} position-relative ml-auto mr-1 {{ session('questions__part') == 'active' ? 'collapsed':'' }}">
                    <span class="novecologie-icon-lock edit-toggler__icon edit-toggler__icon--lock"></span>
                    <span class="novecologie-icon-unlock edit-toggler__icon edit-toggler__icon--unlock"></span>
                </button>
            </div>
        </h2>
        </div>
        <div id="leadCardCollapse-9" class="collapse {{ session('questions__part') == 'active' ? 'show':'' }}" aria-labelledby="leadCard-9">
        <div class="card-body row">
            <div class="col custom-space" id="questionBlock">
            @include('includes.crm.project_question')
            </div>
        </div>
        </div>
    </div>
    @endif
</div>
