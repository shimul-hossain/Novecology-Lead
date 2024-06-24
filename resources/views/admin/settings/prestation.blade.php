@extends('admin.settings.layout')

@section('CatalogueCollapseActive', 'true')
@section('CatalogueCollapse', 'show')
@section('PrestationsTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-15" role="tabpanel" aria-labelledby="v-pills-15-tab">

        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
                <h3 class="m-2">
                    {{ __('Prestations') }}
                </h3>
                @if (checkAction(Auth::id(), 'general__setting-prestations', 'create') || role() == 's_admin')
                    <button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#benefitModal">+ {{ __('Add new') }}</button>
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
                                        <input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-benefit">
                                        <label class="custom-control-label" for="tableAllSelectCheckss-benefit"></label>
                                    </div>
                                </th>
                                <th>{{ __('Alias') }}</th>
                                <th>{{ __('Titre') }}</th>
                                <th>{{ __('Designation') }}</th>
                                <th>{{ __('Opérations liées') }}</th>
                                <th>{{ __('Quantité') }}</th>
                                <th>{{ __('Prix de vente') }}</th>
                                <th>{{ __('Activé') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body" style="min-height: 350px">
                            @forelse ($benefits as $benefit)
                                <tr>
                                    <td> <div class="custom-control custom-checkbox">
                                            <input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckbenefit-{{ $benefit->id }}">
                                            <label class="custom-control-label" for="tableRowSelectCheckbenefit-{{ $benefit->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $benefit->alias }}
                                    </td>
                                    <td>
                                        {{ $benefit->title }}
                                    </td>
                                    <td class="wrap">
                                        {{ $benefit->designation }}
                                    </td>
                                    <td>
                                        @foreach ($scales->where('active', 'yes') as $scale)
                                            @if (getFeature($benefit->operation, $scale->id))
                                                {{ $scale->wording }} <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $benefit->quantity }}{{ $benefit->quantity? ',00':'0,00' }}
                                    </td>
                                    <td>
                                        {{ $benefit->price }} {{ $benefit->price? ',00':'0,00' }} &euro;
                                    </td>
                                    <td>
                                        @if ($benefit->active == 'on')
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
                                                @if (checkAction(Auth::id(), 'general__setting-prestations', 'edit') || role() == 's_admin')
                                                    <button data-toggle="modal" data-target="#benefitModalEdit{{ $benefit->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @endif
                                                {{-- <form action="{{ route('benefit.delete') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $benefit->id }}">
                                                    <button type="submit" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-trash mr-1"></span>
                                                        Supprimer
                                                    </button>
                                                </form> --}}
                                                @if (checkAction(Auth::id(), 'general__setting-prestations', 'delete') || role() == 's_admin')
                                                    <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#benefitModalDelete{{ $benefit->id }}">
                                                            <span class="novecologie-icon-trash mr-1"></span>
                                                                Supprimer
                                                        </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                            Supprimer
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <span>{{ __('No Item Found') }}</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-content')
    <div class="modal modal--aside fade leftAsideModal" id="benefitModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Prestations') }}</h1>
                <form action="{{ route('benefit.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="alias">{{ __('Alias') }} : <span class="text-danger">*</span></label>
                                <input type="text" id="alias" name="alias" class="form-control shadow-none rounded" required>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="title">{{ __('Titre') }} :<span class="text-danger">**</span></label>
                                <input type="text" id="title" name="title" class="form-control shadow-none rounded" required>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="#" class="form-label m-0">Récupérer la référence du produit lié :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="reference_link" class="custom-control-input" id="titleDisabled">
                                    <label class="custom-control-label" for="titleDisabled"></label>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="designation">{{ __('Designation') }} : <span class="text-danger">**</span></label>
                                <textarea id="designation" name="designation" class="form-control shadow-none rounded" required></textarea>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="#" class="form-label m-0">Récupérer la désignation du produit lié :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="designation_link" class="custom-control-input" id="designationDisabled">
                                    <label class="custom-control-label" for="designationDisabled"></label>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <p class="m-0">(<span class="text-danger">**</span>)L'un des deux champs est obligatoire</p>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="#" class="form-label">Position d'affichage :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary shadow-none position_decrease" data-id="0" type="button" id="button-addon1">-</button>
                                </div>
                                <input type="number" class="form-control shadow-none" id="position0" name="position" value="1" min="0" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary shadow-none position_increase" data-id="0" type="button" id="button-addon2">+</button>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                            <label for="#" class="form-label">Quantité :</label>
                            <input type="number" name="quantity" class="form-control shadow-none rounded">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label for="#" class="form-label">Unité :</label>
                            <select id="active" name="unit" class="select2_select_option form-control select2-hidden-accessible rounded">
                                <option value="m²">m²</option>
                                <option value="m³">m³</option>
                                <option value="ml">ml</option>
                                <option value="litre">litre</option>
                                <option value="heure">heure</option>
                                <option value="jour">jour</option>
                            </select>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="#" class="form-label">Barèmes concernés :</label>
                            <select id="operation" name="operation[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                @foreach ($scales->where('active', 'yes') as $scale)
                                    <option value="{{ $scale->id }}">{{ $scale->wording }}-{{ $scale->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="one">Prix de vente :</label>
                            <div class="input-group">
                                <input type="text" id="price" name="price" class="form-control shadow-none">
                                <div class="input-group-append">
                                <span class="input-group-text">Є</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="priceDesabled" class="form-label m-0">Ou prendre le prix du produit lié :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="related_price" class="custom-control-input" id="priceDesabled">
                                    <label class="custom-control-label" for="priceDesabled"></label>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="custom_label--1">Taux TVA :</label>
                            <select id="tax" name="tax" class="select2_select_option form-control select2-hidden-accessible rounded">
                                <option value="0">Non spécifiée</option>
                                <option value="5.5">Taux réduit à 5,5 %</option>
                                <option value="20">Taux normal à 20 %</option>
                            </select>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="customSwitch4" class="form-label m-0">Activer :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="active" class="custom-control-input" id="customSwitch4" checked>
                                    <label class="custom-control-label" for="customSwitch4"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="customSwitch5" class="form-label m-0">Afficher les prix :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="price_show" class="custom-control-input" id="customSwitch5" checked>
                                    <label class="custom-control-label" for="customSwitch5"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="customSwitch6" class="form-label m-0">A rappeler dynamiquement :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="recall" class="custom-control-input" id="customSwitch6">
                                    <label class="custom-control-label" for="customSwitch6"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
                            <button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @foreach ($benefits as $benefit)
    <div class="modal modal--aside fade leftAsideModal" id="benefitModalEdit{{ $benefit->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Prestations') }}</h1>
                <form action="{{ route('benefit.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="alias">{{ __('Alias') }} : <span class="text-danger">*</span></label>
                                <input type="text" id="alias" name="alias" value="{{ $benefit->alias }}" class="form-control shadow-none rounded" required>
                                <input type="hidden" name="id" value="{{ $benefit->id }}">
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="title">{{ __('Titre') }} :<span class="text-danger">**</span></label>
                                <input type="text" id="title{{ $benefit->id }}" {{ ($benefit->reference_link == 'on')? 'disabled':'' }} name="title" value="{{ $benefit->title }}" class="form-control shadow-none rounded" required>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="#" class="form-label m-0">Récupérer la référence du produit lié :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="reference_link" {{ ($benefit->reference_link == 'on')? 'checked':'' }} class="custom-control-input titleDisabled"  data-id="{{ $benefit->id }}" id="customSwitch1a{{ $benefit->id }}">
                                    <label class="custom-control-label" for="customSwitch1a{{ $benefit->id }}"></label>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="designation{{ $benefit->id }}">{{ __('Designation') }} : <span class="text-danger">**</span></label>
                                <textarea id="designation{{ $benefit->id }}" {{ ($benefit->designation_link == 'on')? 'disabled':'' }} name="designation" class="form-control shadow-none rounded" required> {{ $benefit->designation }}</textarea>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="#" class="form-label m-0">Récupérer la désignation du produit lié :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="designation_link" {{ ($benefit->designation_link == 'on')? 'checked':'' }} class="custom-control-input designationDisabled" data-id="{{ $benefit->id }}" id="customSwitch2a{{ $benefit->id }}">
                                    <label class="custom-control-label" for="customSwitch2a{{ $benefit->id }}"></label>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <p class="m-0">(<span class="text-danger">**</span>)L'un des deux champs est obligatoire</p>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="#" class="form-label">Position d'affichage :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary shadow-none position_decrease"  data-id="{{ $benefit->id }}"  type="button" id="button-addon1">-</button>
                                </div>
                                <input type="number" id="position{{ $benefit->id }}" class="form-control shadow-none" name="position" value="{{ $benefit->position }}" min="0" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary shadow-none position_increase" data-id="{{ $benefit->id }}" type="button" id="button-addon2">+</button>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100 my-1">
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                            <label for="#" class="form-label">Quantité :</label>
                            <input type="number" name="quantity" value="{{ $benefit->quantity }}" class="form-control shadow-none rounded">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label for="#" class="form-label">Unité :</label>
                            <select id="active" name="unit" class="select2_select_option form-control select2-hidden-accessible rounded">
                                <option {{ ($benefit->unit == 'm²')? 'selected':'' }} value="m²">m²</option>
                                <option {{ ($benefit->unit == 'm³')? 'selected':'' }} value="m³">m³</option>
                                <option {{ ($benefit->unit == 'ml')? 'selected':'' }} value="ml">ml</option>
                                <option {{ ($benefit->unit == 'litre')? 'selected':'' }} value="litre">litre</option>
                                <option {{ ($benefit->unit == 'heure')? 'selected':'' }} value="heure">heure</option>
                                <option {{ ($benefit->unit == 'jour')? 'selected':'' }} value="jour">jour</option>
                            </select>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="#" class="form-label">Barèmes concernés :</label>
                            <select id="" name="operation[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                                @foreach ($scales->where('active', 'yes') as $scale)
                                @if (getFeature($benefit->operation, $scale->id))
                                    <option selected value="{{ $scale->id }}">{{ $scale->wording }}-{{ $scale->description }}</option>
                                @else
                                    <option value="{{ $scale->id }}">{{ $scale->wording }}-{{ $scale->description }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="one">Prix de vente :</label>
                            <div class="input-group">
                                <input type="text" id="price{{ $benefit->id }}" {{ ($benefit->related_price == 'on')? 'disabled':'' }} name="price" value="{{ $benefit->price }}" class="form-control shadow-none" aria-label="Dollar amount (with dot and two decimal places)">
                                <div class="input-group-append">
                                <span class="input-group-text">Є</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="customSwitch3" class="form-label m-0">Ou prendre le prix du produit lié :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="related_price" {{ ($benefit->related_price == 'on')? 'checked':'' }} class="custom-control-input priceDesabled"  data-id="{{ $benefit->id }}" id="customSwitch3a{{ $benefit->id }}">
                                    <label class="custom-control-label" for="customSwitch3a{{ $benefit->id }}"></label>
                                </div>
                            </div>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label for="custom_label--1">Taux TVA :</label>
                            <select id="tax{{ $benefit->id }}" name="tax" {{ ($benefit->related_price == 'on')? 'disabled':'' }} class="select2_select_option form-control select2-hidden-accessible rounded">
                                <option {{ ($benefit->tax == '0')? 'selected':'' }} value="0">Non spécifiée</option>
                                <option {{ ($benefit->tax == '5.5')? 'selected':'' }} value="5.5">Taux réduit à 5,5 %</option>
                                <option {{ ($benefit->tax == '20')? 'selected':'' }} value="20">Taux normal à 20 %</option>
                            </select>
                        </div>
                        <hr class="w-100">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="customSwitch4" class="form-label m-0">Activer :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="active" {{ ($benefit->active == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch4a{{ $benefit->id }}">
                                    <label class="custom-control-label" for="customSwitch4a{{ $benefit->id }}"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="customSwitch5" class="form-label m-0">Afficher les prix :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="price_show" {{ ($benefit->price_show == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch5a{{ $benefit->id }}">
                                    <label class="custom-control-label" for="customSwitch5a{{ $benefit->id }}"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="switches d-flex justify-content-between align-items-center">
                                <label for="customSwitch6" class="form-label m-0">A rappeler dynamiquement :</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" name="recall" {{ ($benefit->recall == 'on')? 'checked':'' }} class="custom-control-input" id="customSwitch6a{{ $benefit->id }}">
                                    <label class="custom-control-label" for="customSwitch6a{{ $benefit->id }}"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <button class="btn submit-btn-trans shadow-none">Retour à la liste</button>
                            <button type="submit" class="btn submit_btn_color shadow-none ml-3">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="modal modal--aside fade" id="benefitModalDelete{{ $benefit->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                    <form action="{{ route('benefit.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $benefit->id }}">
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
    @endforeach
@endsection