@extends('admin.settings.layout')

@section('OperationsCEECollapseActive', 'true')
@section('OperationsCEECollapse', 'show')
@section('AMOTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade active show" id="v-pills-9" role="tabpanel" aria-labelledby="v-pills-9-tab">

        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
                <h3 class="m-2">{{ __('AMO') }}</h3>
                @if (checkAction(Auth::id(), 'general__setting-amo', 'create') || role() == 's_admin')
                    <button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#AMOModal">+ {{ __('Add new') }}</button>
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
                                        <input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-amo">
                                        <label class="custom-control-label" for="tableAllSelectCheckss-amo"></label>
                                    </div>
                                </th>
                                <th>{{ __('Logo') }}</th>
                                <th>{{ __('Raison sociale') }}</th>
                                <th>{{ __('Numéro SIREN') }}</th>
                                <th>{{ __('Signataire') }}</th>
                                <th>{{ __('Par défault') }}</th>
                                <th>{{ __('Activé') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body" style="min-height: 350px">
                            @forelse ($amos as $amo)
                                <tr>
                                    <td> <div class="custom-control custom-checkbox">
                                            <input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckamo-{{ $amo->id }}">
                                            <label class="custom-control-label" for="tableRowSelectCheckamo-{{ $amo->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="{{ asset('uploads/amo') }}/{{ $amo->logo }}" alt="" width="100" height="100">
                                    </td>
                                    <td>
                                        {{ $amo->company_name }}
                                    </td>
                                    <td>
                                        {{ $amo->number }}
                                    </td>
                                    <td>
                                        {{ $amo->signatory }}
                                    </td>
                                    <td>
                                        @if ($amo->default == 'Oui')
                                            <span class="text-success">&check;</span>
                                            @else
                                            <span class="text-danger">&times;</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($amo->active == 'Oui')
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
                                                @if (checkAction(Auth::id(), 'general__setting-amo', 'edit') || role() == 's_admin')
                                                    <button data-toggle="modal" data-target="#AmoModalEdit{{ $amo->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0" data-user-id="2">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @endif
                                                @if (checkAction(Auth::id(), 'general__setting-amo', 'delete') || role() == 's_admin') 
                                                    <button data-toggle="modal" data-target="#AmoModalDelete{{ $amo->id }}" type="button" class="dropdown-item border-0">
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
                                <td colspan="8" class="text-center py-5">
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
    <div class="modal modal--aside fade leftAsideModal" id="AMOModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('AMO') }}</h1>
                <form action="{{ route('amo.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="logo">{{ __('Logo') }} :</label>
                        <input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="company_name3">{{ __('Raison sociale') }} :</label>
                        <input type="text" id="company_name3" name="company_name" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
                        <input type="number" id="number" name="number" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
                        <input type="text" id="signatory" name="signatory" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="defaultt">{{ __('Par défault') }} :</label>
                        <select id="defaultt" name="default" class="form-control shadow-none rounded">
                            <option value="Oui">OUI</option>
                            <option value="Non">NON</option>
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="activeee">{{ __('Activé') }} :</label>
                        <select id="activeee" name="active" class="form-control shadow-none rounded">
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
    @foreach ($amos as $amo)
        <div class="modal modal--aside fade leftAsideModal" id="AmoModalEdit{{ $amo->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('AMO') }}</h1>
                    <form action="{{ route('amo.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                        @csrf
                        <div>
                            <img src="{{ asset('uploads/amo') }}/{{ $amo->logo }}" width="150px" alt="">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ $amo->id }}">
                            <label class="form-label" for="logo">{{ __('Logo') }} :</label>
                            <input type="file" id="logo" name="logo" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="company_name3">{{ __('Raison sociale') }} :</label>
                            <input type="text" id="company_name3" value="{{ $amo->company_name }}" name="company_name" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="number">{{ __('Numéro SIREN') }} :</label>
                            <input type="number" id="number" value="{{ $amo->number }}" name="number" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="signatory">{{ __('Signataire') }} :</label>
                            <input type="text" id="signatory" value="{{ $amo->signatory }}" name="signatory" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="defaulttt">{{ __('Par défault') }} :</label>
                            <select id="defaulttt" name="default" class="form-control shadow-none rounded">
                                <option {{ ($amo->default == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
                                <option {{ ($amo->default == 'Non' )? 'selected': '' }} value="Non">NON</option>
                            </select>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="activeee">{{ __('Activé') }} :</label>
                            <select id="activeee" name="active" class="form-control shadow-none rounded">
                                <option {{ ($amo->active == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
                                <option {{ ($amo->active == 'Non' )? 'selected': '' }} value="Non">NON</option>
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
        <div class="modal modal--aside fade" id="AmoModalDelete{{ $amo->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('amo.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $amo->id }}">
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