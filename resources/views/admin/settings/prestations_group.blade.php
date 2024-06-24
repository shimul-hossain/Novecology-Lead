@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('PrestationsGoupTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-prestation_group" role="tabpanel" aria-labelledby="v-pills-prestation_group-tab">
        <form action="{{ route('prestation.group.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">{{ __('Prestations group') }}</h3>
                    <div class="form-group">
                        <label class="form-label" for="prestation_code">Code<span class="text-danger">*</span></label>
                        <input type="text" id="prestation_code" name="code" value="{{ old('code') }}" class="form-control shadow-none rounded" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="prestation_product_id"> Produits :</label>
                        <select name="product_id" id="prestation_product_id"  class="select2_select_option custom-select shadow-none form-control" required>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->reference }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div id="prestationGroupItem">
                        <div class="gruop_item">
                            <div class="form-group">
                                <label class="form-label" for="prestation_id"> Prestation : <span class="text-danger">*</span></label>
                                <select name="prestation_id[]" id="prestation_id"  class="select2_select_option custom-select shadow-none form-control prestationChange" required>
                                    @foreach ($benefits as $prestation)
                                        <option data-price="{{ $prestation->price }}" data-quantity="{{ $prestation->quantity }}" data-tax="{{ $prestation->tax }}" value="{{ $prestation->id }}">{{ $prestation->alias }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="prestation_price">Prix de vente<span class="text-danger">*</span></label>
                                <input type="number" step="any" id="prestation_price" name="price[]" class="form-control shadow-none rounded prestation_price" required>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="prestation_quantity">Quantité<span class="text-danger">*</span></label>
                                <input type="number" id="prestation_quantity" name="quantity[]" class="form-control shadow-none rounded prestation_quantity" required>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="prestation_tax">Taux TVA</label>
                                <select id="prestation_tax" name="tax[]"class="select2_select_option form-control rounded prestation_tax">
                                    <option value="0">Non spécifiée</option>
                                    <option value="5.5">Taux réduit à 5,5 %</option>
                                    <option value="20">Taux normal à 20 %</option>
                                </select>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    @if (checkAction(Auth::id(), 'general__setting-prestations_group', 'create') || role() == 's_admin')
                    <button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
                    <button type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2" id="add_more_prestation_btn">{{ __('Add More') }}</button>
                    @else
                    <button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Create') }}</button>
                    @endif
                </div>
                <div class="col-12" >
                    <div class="table-responsive simple-bar">
                        <table class="table database-table w-100 mb-0">
                            <thead class="database-table__header">
                                <tr>
                                    <th>{{ __('Serial') }}</th>
                                    <th>Code</th>
                                    <th>Produits</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="database-table__body">
                                @foreach ($prestation_groups as $prestation_group)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $prestation_group->code }}</td>
                                        <td>{{ $prestation_group->getProduct->reference ?? '' }}</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#prestation_group_items{{ $prestation_group->id }}">
                                                        <span class="novecologie-icon-eye mr-1"></span>
                                                        {{ __('View items') }}
                                                    </button>
                                                    @if (checkAction(Auth::id(), 'general__setting-prestations_group', 'edit') || role() == 's_admin')
                                                        <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#prestation_group_edit{{ $prestation_group->id }}">
                                                            <span class="novecologie-icon-edit mr-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @else
                                                        <button  type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @endif
                                                    @if (checkAction(Auth::id(), 'general__setting-prestations_group', 'delete') || role() == 's_admin')
                                                        <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#prestation_group_delete{{ $prestation_group->id }}">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('modal-content')
    @foreach ($prestation_groups as $prestation_group)
        <div class="modal modal--aside fade leftAsideModal" id="prestation_group_items{{ $prestation_group->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">{{ $prestation_group->code }}</h1>
                    <div class="row">
                        @foreach ($prestation_group->getItems as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title text-primary border-bottom pb-2">{{ $item->getPrestation->alias }}</h3>
                                        <h4 class="card-subtitle mb-2"><strong>{{ __('Price') }}:</strong> {{ $item->price }}€</h4>
                                        <h4 class="card-subtitle mb-2"><strong>{{ __('Quantity') }}:</strong> {{ $item->quantity }} </h4>
                                        <h4 class="card-subtitle mb-2"><strong>{{ __('Tax') }}:</strong>
                                            @if ($item->tax == 0)
                                                Non spécifiée
                                            @elseif ($item->tax == 5.5)
                                                Taux réduit à 5,5 %
                                            @else
                                                Taux normal à 20 %
                                            @endif
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="modal modal--aside fade leftAsideModal" id="prestation_group_edit{{ $prestation_group->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">{{ __('Prestations group') }}</h1>
                    <form action="{{ route('prestation.group.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="prestation_code1{{ $prestation_group->id }}">Code<span class="text-danger">*</span></label>
                            <input type="text" id="prestation_code1{{ $prestation_group->id }}" name="code" value="{{ $prestation_group->code }}" class="form-control shadow-none rounded" required>
                            <input type="hidden" name="id" value="{{ $prestation_group->id }}">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="prestation_product_id{{ $prestation_group->id }}"> Produits :</label>
                            <select name="product_id" id="prestation_product_id{{ $prestation_group->id }}"  class="select2_select_option custom-select shadow-none form-control" required>
                                @foreach ($products as $product)
                                    <option {{ $prestation_group->product_id == $product->id ? 'selected':'' }} value="{{ $product->id }}">{{ $product->reference }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal modal--aside fade" id="prestation_group_delete{{ $prestation_group->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('prestation.group.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $prestation_group->id }}">
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