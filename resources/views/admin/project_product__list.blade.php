
{{-- @foreach ($bareme->product as $product)   
    <option value="{{ $product->id }}">{{ $product->reference }}</option>  
@endforeach  --}}
@foreach ($barame_travaux_tags as $tag) 
    @if ($tagList && $tag->id != 7 && $tag->id != 29 && in_array($tag->id, $tagList))  
        <div class="col-12 my-2 text-center"> 
            <button type="button" class="btn w-100" style="background-color: #9fbfe6; max-width: 540px;">{{ $tag->travaux }}</button>
        </div>
        <input type="hidden" data-tag-id="{{ $tag->id }}" class="tag__product">
        @if ($tag->tag == 'CAG' || $tag->tag == 'POELE' || $tag->tag == 'PAC R/R' || $tag->tag == 'PAC R/O' || $tag->tag == 'CESI' || $tag->tag == 'BTD' || $tag->tag == 'SSC')
            <div class="col-12">
                <div class="form-group">
                    <div class="d-flex align-items-center">
                        <label class="form-label" for="status">Marque</label>
                    </div>
                    <select id="marque{{ $tag->id }}" class="select2_select_option shadow-none form-control travaux_disabled prjectMarquelist" data-tag-id="{{ $tag->id }}">
                        <option value="">{{ __("Select") }}</option>
                        @foreach ($marques as $marque_item)
                            @if(in_array($marque_item->id, $tag->getProducts->pluck('marque_id')->toArray()))
                                <option @if ($marque && isset($marque[$tag->id]) && $marque[$tag->id] == $marque_item->id)
                                    selected
                                    @endif value="{{ $marque_item->id }}">{{ $marque_item->description }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if ($tag->tag == 'PAC R/R') 
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">Nombre de split</label> 
                    <input type="number"  name="Nombre_de_split" id="Nombre_de_split{{ $tag->id }}" @if ($Nombre_de_split && isset($Nombre_de_split[$tag->id]))
                    value="{{ $Nombre_de_split[$tag->id] }}"
                @endif class="form-control shadow-none travaux_disabled">
                </div> 
            </div> 
        @endif
        {{-- @if ($project->Type_de_contrat && $project->Statut_Projet == 'Devis signé')
            <div class="col-md-6">
                <div class="form-group">
                    <div class="d-flex align-items-center">
                        <label class="form-label" for="status">Produit {{ $tag->tag }}</label>  
                    </div> 
                    <select id="product{{ $tag->id }}" data-tag-id="{{ $tag->id }}" class="select2_select_option custom-select shadow-none tag__product form-control travaux_disabled" multiple>  
                        @foreach ($tag->getProducts as $product)  
                            <option value="{{ $product->id }}">{{ $product->reference }}</option> 
                        @endforeach 
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-label" for="Montant_TTC{{ $tag->id }}">Montant TTC:</label>
                    <input type="hidden" name="Montant_TTC" id="Montant_TTC{{ $tag->id }}" class="montant_value"> 
                    <input type="text" class="form-control shadow-none montant_format travaux_disabled"> 
                </div> 
            </div> 
        @else
        @endif --}}
        @if ($tag->rank == '1')
            <div class="col-12">
                <div class="form-group">
                    <div class="d-flex align-items-center">
                        <label class="form-label" for="status">Produit {{ $tag->tag }}</label>  
                    </div> 
                    <select id="product{{ $tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled  project-tag-product--change"  data-tag-id="{{ $tag->id }}" multiple>  
                        @foreach ($tag->getProducts as $product)  
                            @if ($tag->tag == 'CAG' || $tag->tag == 'POELE' || $tag->tag == 'PAC R/R' || $tag->tag == 'PAC R/O' || $tag->tag == 'CESI' || $tag->tag == 'BTD' || $tag->tag == 'SSC')
                                @if ($marque && isset($marque[$tag->id]) && $marque[$tag->id] == $product->marque_id)
                                    <option
                                        @if ($tag_product && isset($tag_product[$tag->id]) && in_array($product->id, $tag_product[$tag->id]))
                                            selected
                                        @endif
                                    value="{{ $product->id }}">{{ $product->reference }}</option> 
                                @endif
                            @else
                                <option
                                    @if ($tag_product && isset($tag_product[$tag->id]) && in_array($product->id, $tag_product[$tag->id]))
                                        selected
                                    @endif
                                value="{{ $product->id }}">{{ $product->reference }}</option> 
                            @endif
                        @endforeach 
                    </select>
                </div>
            </div>
        @else
            <input type="hidden" id="product{{ $tag->id }}">
		@endif
        @if ($tag->tag == 'ITI_101' || $tag->tag == 'ITI_102' || $tag->tag == 'ITE_102' || $tag->tag == 'ITI_103' || $tag->tag == 'Crépis' || $tag->tag == 'ITE hors zone')
            @if ($tag->tag == 'ITI_101')
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="Type_de_comble{{ $tag->id }}">Type de comble</label>
                        <select name="Type_de_comble" id="Type_de_comble{{ $tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                            <option value="" selected>{{ __('Select') }}</option>
                            <option @if ($Type_de_comble && isset($Type_de_comble[$tag->id]) && $Type_de_comble[$tag->id] == "Comble perdu")
                                selected
                           @endif value="Comble perdu">Comble perdu</option>
                            <option @if ($Type_de_comble && isset($Type_de_comble[$tag->id]) && $Type_de_comble[$tag->id] == "Comble aménagés/aménagéable")
                                selected
                           @endif value="Comble aménagés/aménagéable">Comble aménagés/aménagéable</option>
                        </select>
                    </div> 
                </div> 
            @endif
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="surface{{ $tag->id }}">Surface {{ $tag->tag  }}</label>
                    <input type="hidden" @if ($surface && isset($surface[$tag->id]))
                    value="{{ $surface[$tag->id] }}"
                @endif id="surface{{ $tag->id }}" class="hidden_surface_m2_value">
                    <input type="text" class="surface_m2_value form-control shadow-none travaux_disabled"
                    @if ($surface && isset($surface[$tag->id]))
                        value="{{ $surface[$tag->id] }} m2"
                    @else
                        value="m2"
                    @endif
                    >
                </div>
            </div>
        @endif
        @if ($tag->tag == 'StoreBanne') 
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">Nombre de store banne</label> 
                    <input type="number"  name="Nombre_de_split" @if ($Nombre_de_split && isset($Nombre_de_split[$tag->id]))
                    value="{{ $Nombre_de_split[$tag->id] }}"
                @endif id="Nombre_de_split{{ $tag->id }}" class="form-control shadow-none travaux_disabled">
                </div> 
            </div> 
        @endif
        @if ($tag->tag == 'GD ITE') 
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label">Nombre</label> 
                    <input type="number"  name="Nombre_de_split" @if ($Nombre_de_split && isset($Nombre_de_split[$tag->id]))
                    value="{{ $Nombre_de_split[$tag->id] }}"
                @endif id="Nombre_de_split{{ $tag->id }}" class="form-control shadow-none travaux_disabled">
                </div> 
            </div> 
        @endif
        <div class="col-12">
            <div id="projectTagProductWrap{{ $tag->id }}">
                @if ($tag->id == 2 || $tag->id == 6)
                    @if ($tag_product && isset($tag_product[$tag->id]))
                        @foreach ($tag_product[$tag->id]  as $selected_product)
                            <div class="form-group">
                                <label class="form-label">{{ \App\Models\CRM\Product::find($selected_product)->reference ?? '' }} : <button style="background-color: #B4C7E6" type="button" class="primary-btn primary-btn--sm rounded">Nombre</button></label>
                                <input type="number"  name="tag_product_nombre[{{ $tag->id }}__{{ $selected_product }}]" class="form-control shadow-none travaux_disabled tag_product_nombre"
                                @if ($tag_product_nombre && isset($tag_product_nombre[$selected_product]))
                                    @php
                                        $nombre_tag = explode('__', $tag_product_nombre[$selected_product])[0];
                                        $nombre_value = explode('__', $tag_product_nombre[$selected_product])[1];
                                    @endphp
                                    @if ($nombre_tag == $tag->id)
                                        value="{{ $nombre_value }}"
                                    @endif
                                @endif
                                data-product-id="{{ $selected_product }}" data-tag-id="{{ $tag->id }}">
                            </div>
                        @endforeach
                    @endif
                @endif
            </div>
            @if ($tag->tag == 'THERMO')
                <div class="form-group">
                    <label class="form-label">SHAB:</label>
                    <input type="number" step="any" name="shab[{{ $tag->id }}]" id="shab{{ $tag->id }}" class="form-control shadow-none travaux_disabled" 
                    @if ($shab && isset($shab[$tag->id]))
                        value="{{ $shab[$tag->id] }}"
                    @endif 
                    >
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre de pièces dans le logement:</label>
                    <input type="number" step="any" name="Nombre_de_pièces_dans_le_logement[{{ $tag->id }}]" id="Nombre_de_pièces_dans_le_logement{{ $tag->id }}" class="form-control shadow-none travaux_disabled" 
                    @if ($Nombre_de_pièces_dans_le_logement && isset($Nombre_de_pièces_dans_le_logement[$tag->id]))
                        value="{{ $Nombre_de_pièces_dans_le_logement[$tag->id] }}"
                    @endif 
                    >
                </div>
                <div class="form-group">
                    <label class="form-label">Nombre de radiateurs total dans le logement <span class="only--positive--value--alert"></span></label>
                    <input type="number" step="any" min="0" name="Nombre_de_radiateur_total_dans_le_logement[{{ $tag->id }}]" id="Nombre_de_radiateur_total_dans_le_logement{{ $tag->id }}" class="form-control shadow-none travaux_disabled only--positive--value" 
                    @if ($Nombre_de_radiateur_total_dans_le_logement && isset($Nombre_de_radiateur_total_dans_le_logement[$tag->id]))
                        value="{{ $Nombre_de_radiateur_total_dans_le_logement[$tag->id] }}"
                    @endif   
                    >
                </div>
                <div class="form-group">
                    <label class="form-label" for="Type_de_radiateur{{ $tag->id }}">Type de radiateurs à équiper</label>
                    <select name="Type_de_radiateur[{{ $tag->id }}]" id="Type_de_radiateur{{ $tag->id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled Type_de_radiateur_select_input">
                        <option value="" selected>{{ __('Select') }}</option>
                        <option @if ($Type_de_radiateur && isset($Type_de_radiateur[$tag->id]) && $Type_de_radiateur[$tag->id] == "combustible")
                            selected
                    @endif value="combustible">combustible</option>
                        <option @if ($Type_de_radiateur && isset($Type_de_radiateur[$tag->id]) && $Type_de_radiateur[$tag->id] == "électrique")
                            selected
                    @endif value="électrique">électrique</option>
                        <option @if ($Type_de_radiateur && isset($Type_de_radiateur[$tag->id]) && $Type_de_radiateur[$tag->id] == "mixte")
                            selected
                    @endif value="mixte">mixte</option>
                    </select>
                </div>
                <div class="form-group" id="Nombre_de_radiateurs_électrique_input" style="display: 
                @if ($Type_de_radiateur && isset($Type_de_radiateur[$tag->id]) && ($Type_de_radiateur[$tag->id] == "mixte" || $Type_de_radiateur[$tag->id] == "électrique"))
                @else
                none
                @endif 
                ">
                    <label class="form-label">Nombre de radiateurs électrique à équiper:</label>
                    <input type="number" step="any" name="Nombre_de_radiateurs_électrique[{{ $tag->id }}]" id="Nombre_de_radiateurs_électrique{{ $tag->id }}" class="form-control shadow-none travaux_disabled" 
                    @if ($Nombre_de_radiateurs_électrique && isset($Nombre_de_radiateurs_électrique[$tag->id]))
                        value="{{ $Nombre_de_radiateurs_électrique[$tag->id] }}"
                    @endif  
                    >
                </div>
                <div class="form-group" id="Nombre_de_radiateurs_combustible_input" style="display: 
                @if ($Type_de_radiateur && isset($Type_de_radiateur[$tag->id]) && ($Type_de_radiateur[$tag->id] == "mixte" || $Type_de_radiateur[$tag->id] == "combustible"))
                @else
                none
                @endif  
                ">
                    <label class="form-label">Nombre de radiateurs combustible à équiper:</label>
                    <input type="number" step="any" name="Nombre_de_radiateurs_combustible[{{ $tag->id }}]" id="Nombre_de_radiateurs_combustible{{ $tag->id }}" class="form-control shadow-none travaux_disabled" 
                    @if ($Nombre_de_radiateurs_combustible && isset($Nombre_de_radiateurs_combustible[$tag->id]))
                        value="{{ $Nombre_de_radiateurs_combustible[$tag->id] }}"
                    @endif   
                    >
                </div>
                <div class="form-group">
                    <label class="form-label" for="Thermostat_supplémentaire{{ $tag->id }}">Thermostat supplémentaire:</label>
                    <select name="Thermostat_supplémentaire[{{ $tag->id }}]" id="Thermostat_supplémentaire{{ $tag->id }}" data-autre-box="Thermostat_supplémentaire_wrap" class="select2_select_option custom-select shadow-none form-control travaux_disabled other_field__system2">
                        <option value="" selected>{{ __('Select') }}</option>
                        <option
                        @if ($Thermostat_supplémentaire && isset($Thermostat_supplémentaire[$tag->id]) && $Thermostat_supplémentaire[$tag->id] == "Oui")
                            selected
                    @endif value="Oui">Oui</option>
                        <option @if ($Thermostat_supplémentaire && isset($Thermostat_supplémentaire[$tag->id]) && $Thermostat_supplémentaire[$tag->id] == "Non")
                            selected
                    @endif value="Non">Non</option>
                    </select>
                </div>
                <div class="Thermostat_supplémentaire_wrap"  style="display:  
                @if ($Thermostat_supplémentaire && isset($Thermostat_supplémentaire[$tag->id]) && $Thermostat_supplémentaire[$tag->id] == "Oui")
                @else
                none
                @endif
                ">
                    <div class="form-group">
                        <label class="form-label">Nombre thermostat supplémentaire:</label>
                        <input type="number" step="any" name="Nombre_thermostat_supplémentaire[{{ $tag->id }}]" id="Nombre_thermostat_supplémentaire{{ $tag->id }}" class="form-control shadow-none travaux_disabled Nombre_thermostat_supplémentaire_input" data-price="{{ $tag->price }}"
                        @if ($Nombre_thermostat_supplémentaire && isset($Nombre_thermostat_supplémentaire[$tag->id]))
                            value="{{ $Nombre_thermostat_supplémentaire[$tag->id] }}"
                        @endif
                        >
                    </div>
                    <div class="form-group">
                        <label class="form-label">Montant:</label>
                        <input type="text" disabled class="form-control shadow-none" id="Nombre_thermostat_supplémentaire_montant" 
                        @if ($Nombre_thermostat_supplémentaire && isset($Nombre_thermostat_supplémentaire[$tag->id])) 
                            value="{{ EuroFormat($Nombre_thermostat_supplémentaire[$tag->id]*$tag->price) }}"
                        @endif
                        >
                    </div>
                </div> 
            @endif
        </div>
    @endif  
@endforeach 


