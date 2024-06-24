@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('CommercialTerrainTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-commercial" role="tabpanel" aria-labelledby="v-pills-commercial-tab">
        <form action="{{ route('commercial.terrain.create') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">Commercial Terrain</h3>
                    <div class="form-group">
                        <label class="form-label" for="commercial">Nom<span class="text-danger">*</span></label>
                        <input type="text" id="commercial" name="name" class="form-control shadow-none rounded" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    @if (checkAction(Auth::id(), 'general__setting-commercial_terrain', 'create') || role() == 's_admin')
                        <button type="submit" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2">{{ __('Create') }}</button>
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
                                    <th>Nom</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="database-table__body">
                                @foreach ($commercial_terrain as $commercial)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $commercial->name }}</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    @if (checkAction(Auth::id(), 'general__setting-commercial_terrain', 'edit') || role() == 's_admin')
                                                        <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#commercial_edit{{ $commercial->id }}">
                                                            <span class="novecologie-icon-edit mr-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @else
                                                        <button  type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @endif
                                                    @if (checkAction(Auth::id(), 'general__setting-commercial_terrain', 'delete') || role() == 's_admin')
                                                        <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#commercial_delete{{ $commercial->id }}">
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
    @foreach ($commercial_terrain as $commercial)
        <div class="modal modal--aside fade leftAsideModal" id="commercial_edit{{ $commercial->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">Commercial Terrain</h1>
                    <form action="{{ route('commercial.terrain.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Nom <span class="text-danger">*</span></label>
                            <input type="hidden" name="id" value="{{ $commercial->id }}">
                            <input type="text" name="name" value="{{ $commercial->name }}" class="form-control shadow-none rounded" required>
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
        <div class="modal modal--aside fade" id="commercial_delete{{ $commercial->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('commercial.terrain.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $commercial->id }}">
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