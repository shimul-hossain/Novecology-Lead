<div class="modal modal--aside fade leftAsideModal" id="productEditModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
    <div class="modal-dialog m-0 h-100 bg-white">
    <div class="modal-content simple-bar border-0 h-100 rounded-0">
        <div class="modal-header border-0">
            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                <span class="novecologie-icon-close"></span>
            </button>
        </div>
        <div class="modal-body">
            <h1 class="modal-title text-center mb-1">{{ __('Produit') }}</h1>
            <div class="database-table-wrapper"> 
                <div class="text-right">
                    <ul class="nav nav-pills nav-pills--horizontal d-inline-block my-3" id="pills-tab" role="tablist" style="border: 2px solid #2F528F; border-radius: 7px;"> 
                        <li class="nav-item d-inline-block" role="presentation">
                            <a class="nav-link active px-4 py-1" id="pills-two-tab" data-toggle="pill" href="#pills-two" role="tab" aria-controls="pills-two" aria-selected="true">Descriptif</a>
                        </li>  
                        <li class="nav-item d-inline-block" role="presentation">
                            <a class="nav-link px-4 py-1" id="pills-one-tab" data-toggle="pill" href="#pills-one" role="tab" aria-controls="pills-one" aria-selected="false">Stock</a>
                        </li>  
                    </ul> 
                </div>
                <form action="{{ route('product.update') }}" class="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content" id="pills-tabContent"> 
                        <div class="tab-pane fade" id="pills-one" role="tabpanel" aria-labelledby="pills-one-tab"> 
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Stock intermédiaire <i class="bi bi-exclamation-triangle-fill text-warning"></i></label> 
                                        <input type="number" name="stock_intermediate" value="{{ $product->stock_intermediate }}" class="form-control shadow-none rounded">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="#">Stock Minimum <i class="bi bi-exclamation-triangle-fill text-danger"></i></label> 
                                        <input type="number" name="stock_minimum" value="{{ $product->stock_minimum }}" class="form-control shadow-none rounded">
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="form_submit_btn text-right">
                                        <button  type="button" data-dismiss="modal" aria-label="Close" class="btn submit-btn-trans shadow-none">Retour à la liste</button>
                                        <button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="tab-pane fade show active" id="pills-two" role="tabpanel" aria-labelledby="pills-two-tab">
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="#">Type isolant/ Produit :</label>
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="text" name="product_type" value="{{ $product->product_type }}" class="form-control shadow-none rounded">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="#">Catégorie :</label>
                                        <select class="select2_select_option form-control" name="category_id">
                                            @foreach ($categories as $category)
                                                @if ($category->id == $product->category_id)
                                                <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                                                @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="#">Marque : <span class="text-danger">*</span></label>
                                        <select class="select2_select_option form-control" name="marque_id" required>
                                            @foreach ($brands as $marque)
                                                @if ($marque->id == $product->marque_id)
                                                <option selected value="{{ $marque->id }}"> {{ $marque->description }} </option>
                                                @else
                                                <option value="{{ $marque->id }}"> {{ $marque->description }} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="#">Sous-Catégorie :</label>
                                        <select class="select2_select_option form-control" name="subcategory_id">
                                            @foreach ($subcategories as $sub_cat)
                                                @if ($product->subcategory_id == $sub_cat->id)
                                                <option selected value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
                                                @else
                                                <option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="#">Référence : <span class="text-danger">*</span></label>
                                        <input type="text" name="reference" value="{{ $product->reference }}" class="form-control shadow-none rounded" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="#">Norme  :</label>
                                        <input type="text" name="standard" value="{{ $product->standard }}" class="form-control shadow-none rounded">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="#">Designation :<span class="text-danger">*</span></label>
                                        <textarea class="form-control shadow-none rounded" name="designation" rows="3" required>{{ $product->designation }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="#">Note de dimensionnement :</label>
                                        <textarea class="form-control shadow-none rounded"  name="sizing_note" rows="3">{{ $product->sizing_note }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Acermi :</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="acermi_reference" value="{{ $product->acermi_reference }}" class="form-control shadow-none rounded" placeholder="Référence">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <input type="date" name="acermi_date" value="{{ $product->acermi_date }}" class="flatpickr form-control shadow-none rounded">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="acermi_file" class="custom-file-input form-control" id="inputGroupFile02{{ $product->id }}">
                                            <label class="custom-file-label" for="inputGroupFile02{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Certita :</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <input type="text" name="certita_reference" value="{{ $product->certita_reference }}" class="form-control shadow-none rounded" placeholder="Référence">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <input type="date" name="certita_date" value="{{ $product->certita_date }}" class="flatpickr form-control shadow-none rounded">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="certita_file" class="custom-file-input form-control" id="inputGroupFile03{{ $product->id }}">
                                            <label class="custom-file-label" for="inputGroupFile03{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Avis technique :</label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" name="notice_reference" value="{{ $product->notice_reference }}" class="form-control shadow-none rounded" placeholder="Référence">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="date" name="notice_date" value="{{ $product->notice_date }}" class="flatpickr form-control shadow-none rounded" placeholder="Date de Validité">
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="notice_file" class="custom-file-input form-control" id="inputGroupFile04{{ $product->id }}">
                                            <label class="custom-file-label" for="inputGroupFile04{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                        </div>
                                </div> --}}

                                  
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="switches d-flex">
                                        <label for="productProjet{{ $product->id }}">Projet :</label>
                                        <div class="custom-control custom-switch ml-4">
                                            <input type="checkbox" name="projet_status" {{ ($product->projet_status == 'yes')? 'checked':'' }} class="custom-control-input" id="productProjet{{ $product->id }}">
                                            <label class="custom-control-label" for="productProjet{{ $product->id }}"></label>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 .col-sm-6">
                                    <div class="switches d-flex">
                                        <label for="productStock{{ $product->id }}">Stock :</label>
                                        <div class="custom-contro2 custom-switch ml-4">
                                            <input type="checkbox" name="stock_status" {{ ($product->stock_status == 'yes')? 'checked':'' }} class="custom-control-input" id="productStock{{ $product->id }}">
                                            <label class="custom-control-label" for="productStock{{ $product->id }}"></label>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Fiche Technique :</label>
                                </div>
                                <div class="col-lg-8 col-md-9 col-sm-8">
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="data_file" class="custom-file-input form-control" id="inputGroupFile05{{ $product->id }}">
                                            <label class="custom-file-label" for="inputGroupFile05{{ $product->id }}" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="switches d-flex">
                                        <label for="customSwitch43">Marquage CE :</label>
                                        <div class="custom-control custom-switch ml-4">
                                            <input type="checkbox" name="ce_marking" {{ ($product->ce_marking == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch43{{ $product->id }}">
                                            <label class="custom-control-label" for="customSwitch43{{ $product->id }}"></label>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 .col-sm-6">
                                    <div class="switches d-flex">
                                        <label for="customSwitch44">Activer :</label>
                                        <div class="custom-contro2 custom-switch ml-4">
                                            <input type="checkbox" name="activate" {{ ($product->activate == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch44{{ $product->id }}">
                                            <label class="custom-control-label" for="customSwitch44{{ $product->id }}"></label>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Barèmes concernés en B2C :</label>
                                    <select name="baremes[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                        @foreach ($scales->where('active', 'yes') as $scale)
                                        @if (getFeature($product->baremes, $scale->id))
                                        <option selected value="{{ $scale->id }}">{{ $scale->wording }}</option>
                                        @else
                                        <option value="{{ $scale->id }}">{{ $scale->wording }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-12">
                                    <label for="#">Barèmes : <span class="text-danger">*</span></label>
                                    <select name="tags[]" id="product-bareme{{ $product->id }}" class="select2_select_option custom-select shadow-none form-control" multiple required>
                                        @foreach ($bareme_travaux_tags as $tag)
                                            @if (\App\Models\CRM\ProductTag::where('product_id', $product->id)->where('tag_id', $tag->id)->exists())
                                                <option selected value="{{ $tag->id }}">{{ $tag->bareme }}</option>
                                            @else
                                                <option value="{{ $tag->id }}">{{ $tag->bareme }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label"> Prestation :</label>
                                    <select name="prestation_id[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                        @foreach ($benefits as $prestation)
                                            <option {{ $product->prestations()->where('benefit_id', $prestation->id)->first() ? 'selected':'' }} value="{{ $prestation->id }}">{{ $prestation->alias }}</option>
                                        @endforeach
                                    </select>
                                {{-- </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Mode de Pose :</label>
                                    <select class="select2_select_option form-control" name="installation_mode" required>
                                        <option {{ ($product->installation_mode == 'Soufflé')? 'selected': ''  }} value="Soufflé">Soufflé</option>
                                        <option {{ ($product->installation_mode == 'Deroulé')? 'selected': ''  }} value="Deroulé">Deroulé</option>
                                    </select>
                                </div>
            
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Cap. de couverture :</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="covering_capacity" value="{{ $product->covering_capacity }}" aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">m2</span>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Epaisseur :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="thikness" value="{{ $product->thikness }}" aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">mm</span>
                                        </div>
                                        </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <label for="#">Rés. thermique 1 :</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{ $product->thermal_res }}" name="thermal_res" aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">m².K/W</span>
                                        </div>
                                        </div>
                                </div> --}}
            
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                                    <div class="form_submit_btn text-right">
                                        <button  type="button" data-dismiss="modal" aria-label="Close" class="btn submit-btn-trans shadow-none">Retour à la liste</button>
                                        <button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </form>
            </div> 
        </div>
    </div>
    </div>
</div>