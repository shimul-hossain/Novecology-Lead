@extends('admin.settings.layout')

@section('CatalogueCollapseActive', 'true')
@section('CatalogueCollapse', 'show')
@section('ProduitsTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-18" role="tabpanel" aria-labelledby="v-pills-18-tab">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
                <h3 class="m-2">{{ __('Produits') }}
                </h3>
                {{-- @if (role() == 's_admin')
                    <form action="{{ route('product.import') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <label for="importProduct">Import Produits</label>
                        <input type="file" hidden name="file" id="importProduct" onchange="this.closest('form').submit()">
                    </form>
                @endif --}}
                @if (checkAction(Auth::id(), 'general__setting-produits', 'create') || role() == 's_admin')
                    <button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#produitsCreateModal">+ {{ __('Add new') }}</button>
                @else
                    <button type="button" class="secondary-btn border-0 m-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Add new') }}</button>
                @endif
            </div>
            <div class="col-12">
                <div class="table-responsive simple-bar">
                    <table class="table database-table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th class="text-left">
                                    <div class="custom-control custom-checkbox">
                                        <input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckProductd">
                                        <label class="custom-control-label" for="tableAllSelectCheckProductd"></label>
                                    </div>
                                </th>
                                {{-- <th>{{ __('Photo') }}</th>     --}}
                                {{-- <th>{{ __('Catégorie ') }}</th> --}}
                                <th>{{ __('Référence / Designation ') }}</th>
                                <th class="text-center">{{ __('Marque') }}</th>
                                <th class="text-center">Tags</th>
                                <th class="text-center">prestation</th>
                                {{-- <th>{{ __('Mode de pose') }}</th> --}}
                                <th>{{ __('Activé') }}</th>
                                <th>{{ __('Action') }}</th>
                                {{-- <th class="text-center">{{ __('Actions') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckProducts_{{ $product->id }}">
                                            <label class="custom-control-label" for="tableRowSelectCheckProducts_{{ $product->id }}"></label>
                                        </div>
                                    </td>
                                    {{-- <td>
                                        <img src="gfdg" alt="" width="100" height="100">
                                    </td> --}}
                                    {{-- <td data-toggle="modal" data-target="#product_edit{{ $product->id }}" class="cursor-pointer">
                                        {{ $product->getCategory->name ?? '' }}
                                    </td> --}}
                                    <td class="wrap">
                                        <b>{{ $product->reference }}</b>/
                                        <i>{{ $product->designation }}</i>
                                    </td>
                                    <td class="text-center">
                                        {{ $product->getMarque->description ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        @foreach ($product->getTags  as $tag)
                                            {{ $tag->tag }} {{ $loop->last ? '':', ' }}
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @foreach ($product->prestations  as $prestation)
                                            {{ $prestation->alias }} {{ $loop->last ? '':', ' }}
                                        @endforeach
                                    </td>
                                    {{-- <td class="text-center">
                                        {{ $product->covering_capacity }}
                                    </td> --}}
                                    {{-- <td class="text-center">
                                        {{ $product->installation_mode }}
                                    </td> --}}
                                    <td class="text-center">
                                        @if ($product->activate == 'on')
                                            <span class="text-success">&check;</span>
                                        @else
                                            <span class="text-danger">&times;</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                @if (checkAction(Auth::id(), 'general__setting-produits', 'edit') || role() == 's_admin')
                                                    <button data-dismiss="modal" aria-label="Close" data-product_id="{{ $product->id }}" type="button" class="dropdown-item border-0 editBtn" data-user-id="2">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @endif
                                                @if (checkAction(Auth::id(), 'general__setting-produits', 'delete') || role() == 's_admin')
                                                    <button data-dismiss="modal" aria-label="Close" data-product_id="{{ $product->id }}" type="button" class="dropdown-item border-0 deleteBtn" data-user-id="2">
                                                        <span class="novecologie-icon-trash mr-1"></span>
                                                        {{ __('Delete') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Delete') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-content')
    <div class="modal modal--aside fade leftAsideModal" id="produitsCreateModal" tabindex="-1" aria-labelledby="produitsCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body mr-2">
                <h1 class="modal-title text-center mb-5">{{ __('Nouveau Produit') }}</h1>
                <form action="{{ route('product.store') }}" class="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="#">Type isolant/ Produit :</label>
                                <input type="text" name="product_type" class="form-control shadow-none rounded">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="#">Catégorie :</label>
                                <select class="select2_select_option form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="#">Marque : <span class="text-danger">*</span></label>
                                <select class="select2_select_option form-control" name="marque_id" required>
                                    @foreach ($brands as $marque)
                                        <option value="{{ $marque->id }}"> {{ $marque->description }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="#">Sous-Catégorie :</label>
                                <select class="select2_select_option form-control" name="subcategory_id">
                                    @foreach ($subcategories as $sub_cat)
                                        <option value="{{ $sub_cat->id }}">{{ $sub_cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="#">Référence : <span class="text-danger">*</span></label>
                                <input type="text" name="reference" class="form-control shadow-none rounded" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="form-group">
                                <label for="#">Norme  :</label>
                                <input type="text" name="standard" class="form-control shadow-none rounded">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="#">Designation :<span class="text-danger">*</span></label>
                                <textarea class="form-control shadow-none rounded" name="designation" rows="3" required></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="switches d-flex">
                                <label for="productProjet">Projet :</label>
                                <div class="custom-control custom-switch ml-4">
                                    <input type="checkbox" name="projet_status" checked class="custom-control-input" id="productProjet">
                                    <label class="custom-control-label" for="productProjet"></label>
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 .col-sm-6">
                            <div class="switches d-flex">
                                <label for="productStock">Stock :</label>
                                <div class="custom-contro2 custom-switch ml-4">
                                    <input type="checkbox" name="stock_status" checked class="custom-control-input" id="productStock">
                                    <label class="custom-control-label" for="productStock"></label>
                                    </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <label for="#">Note de dimensionnement :</label>
                                <textarea class="form-control shadow-none rounded"  name="sizing_note" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Acermi :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <input type="text" placeholder="Référence" name="acermi_reference" class="form-control shadow-none rounded">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <input type="date" name="acermi_date" class="flatpickr form-control shadow-none rounded">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                <input type="file" name="acermi_file" class="custom-file-input form-control" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Certita :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <input type="text" placeholder="Référence" name="certita_reference" class="form-control shadow-none rounded">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                                <input type="date" name="certita_date" class="flatpickr form-control shadow-none rounded">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                <input type="file" name="certita_file" class="custom-file-input form-control" id="inputGroupFile03">
                                <label class="custom-file-label" for="inputGroupFile03" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Avis technique :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" name="notice_reference" class="form-control shadow-none rounded" placeholder="Référence">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="date" name="notice_date" class="flatpickr form-control shadow-none rounded" placeholder="Date de Validité">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                <input type="file" name="notice_file" class="custom-file-input form-control" id="inputGroupFile04">
                                <label class="custom-file-label" for="inputGroupFile04" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Fiche Technique :</label>
                        </div>
                        <div class="col-lg-8 col-md-9 col-sm-8">
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                <input type="file" name="data_file" class="custom-file-input form-control" id="inputGroupFile05">
                                <label class="custom-file-label" for="inputGroupFile05" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="switches d-flex">
                                <label for="customSwitch43">Marquage CE :</label>
                                <div class="custom-control custom-switch ml-4">
                                    <input type="checkbox" name="ce_marking" class="custom-control-input" id="customSwitch43">
                                    <label class="custom-control-label" for="customSwitch43"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 .col-sm-6">
                            <div class="switches d-flex">
                                <label for="customSwitch44">Activer :</label>
                                <div class="custom-contro2 custom-switch ml-4">
                                    <input type="checkbox" name="activate" class="custom-control-input" id="customSwitch44" checked>
                                    <label class="custom-control-label" for="customSwitch44"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Barèmes concernés en B2C :</label>
                            <select name="baremes[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                @foreach ($scales->where('active', 'yes') as $scale)
                                <option value="{{ $scale->id }}">{{ $scale->wording }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="col-12">
                            <label for="#">Barèmes : <span class="text-danger">*</span></label>
                            <select name="tags[]" class="select2_select_option custom-select shadow-none form-control" multiple required>
                                @foreach ($bareme_travaux_tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->bareme }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label"> Prestation :</label>
                            <select name="prestation_id[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                @foreach ($benefits as $prestation)
                                    <option value="{{ $prestation->id }}">{{ $prestation->alias }}</option>
                                @endforeach
                            </select>
                        </div> 
                        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Travaux :</label>
                            <select id="travaux_id11" class="cselect2_select_option custom-select shadow-none form-control" required>
                                <option value="">{{ __('Select') }}</option>
                                @foreach ($travaux_list as $travau)
                                    <option value="{{ $travau->id }}">{{ $travau->travaux }}</option>
                                @endforeach
                            </select>
                        </div>  --}}
                        {{-- <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Mode de Pose :</label>
                            <select class="select2_select_option form-control" name="installation_mode" required>
                                <option value="Soufflé">Soufflé</option>
                                <option value="Deroulé">Deroulé</option>
                            </select>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Cap. de couverture :</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="covering_capacity" aria-label="Dollar amount (with dot and two decimal places)">
                                <div class="input-group-append">
                                <span class="input-group-text">m2</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Epaisseur :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="thikness" aria-label="Dollar amount (with dot and two decimal places)">
                                <div class="input-group-append">
                                <span class="input-group-text">mm</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label for="#">Rés. thermique 1 :</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="thermal_res" aria-label="Dollar amount (with dot and two decimal places)">
                                <div class="input-group-append">
                                <span class="input-group-text">m².K/W</span>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                            <div class="form_submit_btn text-right">
                                <button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
                                <button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
                            </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="modal modal--aside fade" id="productDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body text-center pt-0">
                    <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                    <span>{{ __('Are You Sure To Delete this') }} ?</span>
                    <form action="{{ route('product.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="productDeletedId">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                Annuler
                            </button>
                            <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                Confirmer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal">

    </div>
@endsection

@push('scriptJs')
    <script>
        $(document).ready(function(){
            $('body').on('click', '.deleteBtn', function(){
                $('#productDeletedId').val($(this).data('product_id'));
                $('#productDeleteModal').modal('show');
            });
            $('body').on('click', '.editBtn', function(){
                 let product_id = $(this).data('product_id');
                 $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    type: "POST",
                    url: "{{ route('product.edit-modal') }}",
                    data: {product_id},
                    success: function (response) {
                        $('#editModal').html(response);
                        $('#productEditModal').modal('show');
                        $('.select2_select_option').select2();
                        $('.select2_select_option').each(function(){
                            $(this).select2({
                                dropdownParent: $(this).parent(),
                                templateSelection : function (tag, container){
                                    var $option = $('.select2_select_option option[value="'+tag.id+'"]');
                                    if ($option.attr('disabled')){
                                    $(container).addClass('removed-remove-btn');
                                    }
                                    return tag.text;
                                },
                            })
                        })

                        $('.simple-bar').each((index, element) => new SimpleBar(element, { autoHide: true }));
                    }
                });
            });
        });
    </script>
@endpush