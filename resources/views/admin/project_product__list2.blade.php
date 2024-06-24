@foreach ($project->projectTagItem as $product_tag)
@if ($product_tag->getTag && $product_tag->getTag->id != 7 && $product_tag->getTag->id != 29)
    <div class="col-12 my-2 text-center"> 
        <button type="button" class="btn w-100" style="background-color: #9fbfe6; max-width: 540px;">{{ $product_tag->getTag->travaux }}</button>
    </div>
    <input type="hidden" data-tag-id="{{ $product_tag->tag_id }}"  class="tag__product">
    @if ($product_tag->getTag->tag == 'PAC R/R') 
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Nombre de split</label> 
            <input type="number" value="{{ $product_tag->Nombre_de_split ?? ''  }}" id="Nombre_de_split{{ $product_tag->tag_id }}" name="Nombre_de_split" class="form-control shadow-none travaux_disabled">
        </div> 
    </div> 
    @endif
    {{-- @if ($project->Type_de_contrat && $project->Statut_Projet == 'Devis signé')
        <div class="col-md-6">
            <div class="form-group">
                <div class="d-flex align-items-center">
                    <label class="form-label" for="status">Produit {{ $product_tag->getTag->tag  }}</label>
                </div>
                <select id="product{{ $product_tag->tag_id }}" data-tag-id="{{ $product_tag->tag_id }}" class="select2_select_option custom-select shadow-none tag__product form-control travaux_disabled" multiple>
                    @foreach ($product_tag->getTag->getProducts as $product)
                        <option {{ \App\Models\CRM\ProjectTagProduct::where('project_id', $project->id)->where('tag_id',  $product_tag->id)->where('product_id',  $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="Montant_TTC{{ $product_tag->tag_id }}">Montant TTC:</label>
                <input type="hidden" value="{{ $product_tag->Montant_TTC  }}" name="Montant_TTC" id="Montant_TTC{{ $product_tag->tag_id }}" class="montant_value"> 
				<input type="text" class="form-control shadow-none montant_format travaux_disabled" value="{{ EuroFormat($product_tag->Montant_TTC) }}"> 
            </div> 
        </div> 
    @else
    @endif --}}
    @if ($product_tag->getTag->rank == '1')
        <div class="col-12">
            <div class="form-group">
                <div class="d-flex align-items-center">
                    <label class="form-label" for="status">Produit {{ $product_tag->getTag->tag  }}</label>
                </div>
                <select id="product{{ $product_tag->tag_id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled  project-tag-product--change"  data-tag-id="{{ $product_tag->getTag->id }}" multiple>
                    @foreach ($product_tag->getTag->getProducts as $product)
                        <option {{ \App\Models\CRM\ProjectTagProduct::where('project_id', $project->id)->where('tag_id',  $product_tag->id)->where('product_id',  $product->id)->exists() ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                    @endforeach
                </select>
            </div>
        </div>
	@endif
    @if ($product_tag->getTag->tag == 'ITI_101' || $product_tag->getTag->tag == 'ITI_102' || $product_tag->getTag->tag == 'ITE_102' || $product_tag->getTag->tag == 'ITI_103'|| $product_tag->getTag->tag == 'Crépis' || $product_tag->getTag->tag == 'ITE hors zone')
        @if ($product_tag->getTag->tag == 'ITI_101')
            <div class="col-12">
                <div class="form-group">
                    <label class="form-label" for="Type_de_comble{{ $product_tag->tag_id }}">Type de comble</label>
                    <select name="Type_de_comble" id="Type_de_comble{{ $product_tag->tag_id }}" class="select2_select_option custom-select shadow-none form-control travaux_disabled">
                        <option value="" selected>{{ __('Select') }}</option>
                        <option {{ $product_tag->Type_de_comble == 'Comble perdu' ? 'selected':'' }} value="Comble perdu">Comble perdu</option>
                        <option {{ $product_tag->Type_de_comble == 'Comble aménagés/aménagéable' ? 'selected':'' }} value="Comble aménagés/aménagéable">Comble aménagés/aménagéable</option>
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
            <input type="number" value="{{ $product_tag->Nombre_de_split ?? ''  }}" id="Nombre_de_split{{ $product_tag->tag_id }}" name="Nombre_de_split" class="form-control shadow-none travaux_disabled">
        </div> 
    </div> 
    @endif
    @if ($product_tag->getTag->tag == 'GD ITE') 
    <div class="col-12">
        <div class="form-group">
            <label class="form-label">Nombre</label> 
            <input type="number" value="{{ $product_tag->Nombre_de_split ?? ''  }}" id="Nombre_de_split{{ $product_tag->tag_id }}" name="Nombre_de_split" class="form-control shadow-none travaux_disabled">
        </div> 
    </div> 
    @endif
    <div class="col-12">
        <div id="projectTagProductWrap{{ $product_tag->getTag->id }}">
            @if ($product_tag->getTag->id == 2 || $product_tag->getTag->id == 6) 
                @foreach (\App\Models\CRM\ProjectTagProduct::where('project_id', $project->id)->where('tag_id',  $product_tag->id)->get()  as $selected_product)
                    <div class="form-group">
                        <label class="form-label">{{ \App\Models\CRM\Product::find($selected_product->product_id)->reference ?? '' }} : <button style="background-color: #B4C7E6" type="button" class="primary-btn primary-btn--sm rounded">Nombre</button></label> 
                        <input type="number" class="form-control shadow-none travaux_disabled tag_product_nombre" value="{{ \App\Models\CRM\ProjectProductNombre::where('project_id', $project->id)->where('tag_id', $product_tag->getTag->id)->where('product_id', $selected_product->product_id)->first()->number ?? '' }}" data-product-id="{{ $selected_product->product_id }}" data-tag-id="{{ $product_tag->getTag->id }}">
                    </div>
                @endforeach 
            @endif
        </div>
    </div>
@endif
@endforeach