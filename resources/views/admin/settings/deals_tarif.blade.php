@extends('admin.settings.layout')

@section('OperationsCEECollapseActive', 'true')
@section('OperationsCEECollapse', 'show')
@section('DealsTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-7-tab">

        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
                <h3 class="m-2">{{ __('Deals / Tarifs') }}</h3>
                @if (checkAction(Auth::id(), 'general__setting-deals_tarifs', 'create') || role() == 's_admin')
                    <button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#dealModal">+ {{ __('Add new') }}</button>
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
                                        <input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheckss-deal">
                                        <label class="custom-control-label" for="tableAllSelectCheckss-deal"></label>
                                    </div>
                                </th>
                                <th>{{ __('Nom') }}</th>
                                <th>{{ __('Délégataire') }}</th>
                                <th>{{ __('Version') }}</th>
                                <th>{{ __('Volume Cumac') }}</th>
                                <th>{{ __('Par défault') }}</th>
                                <th>{{ __('Verrouillé') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body" style="min-height: 350px">
                            @forelse ($deals as $deal)
                                <tr>
                                    <td> <div class="custom-control custom-checkbox">
                                            <input value="1" type="checkbox""  class="custom-control-input table-select-checkbox" id="tableRowSelectCheckDeal-{{ $deal->id }}">
                                            <label class="custom-control-label" for="tableRowSelectCheckDeal-{{ $deal->id }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $deal->name }}
                                    </td>
                                    <td>
                                        {{ $deal->delegate }}
                                    </td>
                                    <td>
                                        {{ $deal->version }}
                                    </td>
                                    <td>
                                        {{ $deal->volume }}
                                    </td>
                                    <td>
                                        {{ $deal->default }}
                                    </td>
                                    <td>
                                        {{ $deal->locked }}
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                @if (checkAction(Auth::id(), 'general__setting-deals_tarifs', 'edit') || role() == 's_admin')
                                                    <button data-toggle="modal" data-target="#DealModalEdit{{ $deal->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @endif
                                                @if (checkAction(Auth::id(), 'general__setting-deals_tarifs', 'delete') || role() == 's_admin') 
                                                    <button  data-toggle="modal" data-target="#DealModalDelete{{ $deal->id }}" type="button" class="dropdown-item border-0">
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
    <div class="modal modal--aside fade leftAsideModal" id="dealModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Deals') }}</h1>
                <form action="{{ route('deal.create') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">{{ __('Nom') }} :</label>
                        <input type="text" id="name" name="name" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="delegate">{{ __('Délégataire') }} :</label>
                        <input type="text" id="delegate" name="delegate" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="terms_and_conditions">Termes et conditions CEE :</label>
                        <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control shadow-none rounded" required></textarea>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="version">{{ __('Version') }} :</label>
                        <input type="text" id="version" name="version" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="volume">{{ __('Volume Cumac') }} :</label>
                        <input type="text" id="volume" name="volume" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="default">{{ __('Par défault') }} :</label>
                        <select id="default" name="default" class="form-control shadow-none rounded">
                            <option value="Oui">OUI</option>
                            <option value="Non">NON</option>
                        </select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="locked">{{ __('Verrouillé') }} :</label>
                        <select id="locked" name="locked" class="form-control shadow-none rounded">
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
    @foreach ($deals as $deal)
        <div class="modal modal--aside fade leftAsideModal" id="DealModalEdit{{ $deal->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Deals') }}</h1>
                    <form action="{{ route('deal.update') }}" class="form mx-auto needs-validation" enctype="multipart/form-data" novalidate method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ $deal->id }}">
                            <label class="form-label" for="name">{{ __('Nom') }} :</label>
                            <input type="text" id="name" value="{{ $deal->name }}" name="name" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="delegate">{{ __('Délégataire') }} :</label>
                            <input type="text" id="delegate" value="{{ $deal->delegate }}" name="delegate" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="terms_and_conditions">Termes et conditions CEE :</label>
                            <textarea name="terms_and_conditions" id="terms_and_conditions" class="form-control shadow-none rounded" required>{{ $deal->terms_and_conditions }}</textarea>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="version">{{ __('Version') }} :</label>
                            <input type="text" id="version" value="{{ $deal->version }}" name="version" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="volume">{{ __('Volume Cumac') }} :</label>
                            <input type="text" id="volume" value="{{ $deal->volume }}" name="volume" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="default">{{ __('Par défault') }} :</label>
                            <select id="default"  name="default" class="form-control shadow-none rounded">
                                <option {{ ($deal->default == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
                                <option {{ ($deal->default == 'Non' )? 'selected': '' }} value="Non">NON</option>
                            </select>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="locked">{{ __('Verrouillé') }} :</label>
                            <select id="locked" name="locked" class="form-control shadow-none rounded">
                                <option {{ ($deal->locked == 'Oui' )? 'selected': '' }} value="Oui">OUI</option>
                                <option {{ ($deal->locked == 'Non' )? 'selected': '' }} value="Non">NON</option>
                            </select>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>

                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Updated') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div> 
        <div class="modal modal--aside fade" id="DealModalDelete{{ $deal->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('deal.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $deal->id }}">
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