@extends('admin.settings.layout')

@section('stockCollapseActive', 'true')
@section('stockCollapse', 'show')
@section('fournisseurMaterielTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-fournisseur_materiel" role="tabpanel" aria-labelledby="v-pills-fournisseur_materiel-tab">
        <form action="{{ route('fournisseur.materiel.create') }}" class="setting-form" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">Fournisseur materiel</h3>
                    <div class="form-group">
                        <label class="form-label" for="fournisseur_materiele_name">Nom<span class="text-danger">*</span></label>
                        <input type="text" id="fournisseur_materiele_name" name="name" class="form-control shadow-none rounded" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    @if (checkAction(Auth::id(), 'general__setting-fournisseur_materiel', 'create') || role() == 's_admin')
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Submit') }}</button>
                    @else
                        <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Submit') }}</button>
                    @endif
                </div>
                <div class="col-12" >
                    <div class="table-responsive">
                        <table class="table database-table w-100 mb-0">
                            <thead class="database-table__header">
                                <tr>
                                    <th>{{ __('Serial') }}</th>
                                    <th>Nom</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="database-table__body">
                                @foreach ($fournisseur_materiels as $fournisseur_materiel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $fournisseur_materiel->name }}</td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    @if (checkAction(Auth::id(), 'general__setting-fournisseur_materiel', 'edit') || role() == 's_admin')
                                                        <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#fournisseur_materiel_edit{{ $fournisseur_materiel->id }}">
                                                            <span class="novecologie-icon-edit mr-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @else
                                                        <button  type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @endif
                                                    @if (checkAction(Auth::id(), 'general__setting-fournisseur_materiel', 'delete') || role() == 's_admin')
                                                        <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#fournisseur_materiel_delete{{ $fournisseur_materiel->id }}">
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
    @foreach ($fournisseur_materiels as $fournisseur_materiel)
        <div class="modal modal--aside fade leftAsideModal" id="fournisseur_materiel_edit{{ $fournisseur_materiel->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">Fournisseur materiel</h1>
                    <form action="{{ route('fournisseur.materiel.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="fournisseur_materiels__edit{{ $fournisseur_materiel->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
                            <input type="text" id="fournisseur_materiels__edit{{ $fournisseur_materiel->id }}" name="name" value="{{ $fournisseur_materiel->name }}" class="form-control shadow-none rounded" required>
                            <input type="hidden" name="id" value="{{ $fournisseur_materiel->id }}">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal modal--aside fade" id="fournisseur_materiel_delete{{ $fournisseur_materiel->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('fournisseur.materiel.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $fournisseur_materiel->id }}">
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