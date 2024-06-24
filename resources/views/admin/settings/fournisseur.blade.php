@extends('admin.settings.layout')

@section('CatalogueCollapseActive', 'true')
@section('CatalogueCollapse', 'show')
@section('FournisseursTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-16" role="tabpanel" aria-labelledby="v-pills-16-tab">

        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
                <h3 class="m-2">{{ __('Fournisseurs') }}</h3>
                @if (checkAction(Auth::id(), 'general__setting-fournisseurs', 'create') || role() == 's_admin')
                    <button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#fournesserModal">+ {{ __('Add new') }}</button>
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
                                        <input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-fournesser">
                                        <label class="custom-control-label" for="tableAllSelectCheckss-fournesser"></label>
                                    </div>
                                </th>
                                <th>{{ __('Logo') }}</th>
                                <th>{{ __('Fournisseur') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>Type</th>
                                <th>{{ __('Activé') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body" style="min-height: 350px">
                            @forelse ($fournessers as $fournesser)
                                <tr>
                                    <td> <div class="custom-control custom-checkbox">
                                            <input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckfournesser-{{ $fournesser->id }}">
                                            <label class="custom-control-label" for="tableRowSelectCheckfournesser-{{ $fournesser->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($fournesser->logo)
                                        <img src="{{ asset('uploads/fournesser') }}/{{ $fournesser->logo }}" alt="" width="100" height="100">
                                        @endif
                                    </td>
                                    <td>
                                        {{ $fournesser->suplier }}
                                    </td>
                                    <td>
                                        {{ $fournesser->description }}
                                    </td>
                                    <td>
                                        {{ $fournesser->type }}
                                    </td>

                                    <td>
                                        @if ($fournesser->active == 'Oui')
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
                                                @if (checkAction(Auth::id(), 'general__setting-fournisseurs', 'edit') || role() == 's_admin')
                                                    <button data-toggle="modal" data-target="#fournesserModalEdit{{ $fournesser->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @endif
                                                @if (checkAction(Auth::id(), 'general__setting-fournisseurs', 'delete') || role() == 's_admin') 
                                                    <button data-toggle="modal" data-target="#fournesserModalDelete{{ $fournesser->id }}" type="button"  class="dropdown-item border-0">
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
                                <td colspan="6" class="text-center py-5">
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
    <div class="modal modal--aside fade leftAsideModal" id="fournesserModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Fournisseurs') }}</h1>
                <form action="{{ route('fournesser.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="logo">{{ __('Logo') }} :</label>
                        <input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="suplier">{{ __('Fournisseur') }} :</label>
                        <input type="text" id="suplier" name="suplier" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description">{{ __('Description') }} :</label>
                        <textarea id="description" name="description" class="form-control shadow-none rounded"></textarea>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Type :</label>
                        <select name="type" class="form-control shadow-none rounded">
                            <option selected value="">{{ __("Select") }}</option>
                            @foreach ($type_fournisseurs as $type_fournisseur)
                                <option value="{{ $type_fournisseur->name }}">{{ $type_fournisseur->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="active">{{ __('Activé') }} :</label>
                        <select id="active" name="active" class="form-control shadow-none rounded">
                            <option value="Oui">OUI</option>
                            <option value="Non">NON</option>
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group d-flex flex-column align-items-center mt-4">
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @foreach ($fournessers as $fournesser)
        <div class="modal modal--aside fade leftAsideModal" id="fournesserModalEdit{{ $fournesser->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Fournisseurs') }}</h1>
                    <form action="{{ route('fournesser.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                        @csrf
                        <div>
                            <img src="{{ asset('uploads/fournesser') }}/{{ $fournesser->logo }}" width="150px" alt="">
                        </div>
                        <div class="form-group mt-2">
                            <input type="hidden" name="id" value="{{ $fournesser->id }}">
                            <label class="form-label" for="logo">{{ __('Logo') }} :</label>
                            <input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="suplier">{{ __('Fournisseur') }} :</label>
                            <input type="text" id="suplier" name="suplier" value="{{ $fournesser->suplier }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="description">{{ __('Description') }} :</label>
                            <textarea id="description" name="description" class="form-control shadow-none rounded">{{ $fournesser->description }}</textarea>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Type :</label>
                            <select name="type" class="form-control shadow-none rounded">
                                <option selected value="">{{ __("Select") }}</option>
                                @foreach ($type_fournisseurs as $type_fournisseur)
                                    <option {{ ($fournesser->type == $type_fournisseur->name )? 'selected': '' }} value="{{ $type_fournisseur->name }}">{{ $type_fournisseur->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="activeee">{{ __('Activé') }} :</label>
                            <select id="activeee" name="active" class="form-control shadow-none rounded">
                                <option {{ ($fournesser->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
                                <option {{ ($fournesser->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
                            </select>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>

                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div> 
        <div class="modal modal--aside fade" id="fournesserModalDelete{{ $fournesser->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('fournesser.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $fournesser->id }}">
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