@extends('admin.settings.layout')

@section('OperationsCEECollapseActive', 'true')
@section('OperationsCEECollapse', 'show')
@section('BarèmesTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between flex-wrap">
                <h3 class="m-2">Barèmes/Travaux/Tag</h3>
                @if (checkAction(Auth::id(), 'general__setting-baremes', 'create') || role() == 's_admin')
                    <button type="button" class="secondary-btn border-0 m-2" data-toggle="modal" data-target="#BarèmesModal">+ {{ __('Add new') }}</button>
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
                                    #
                                </th>
                                <th>Barèmes</th>
                                <th>Travaux</th>
                                <th>Tag</th>
                                <th>Rank</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
                            @forelse ($bareme_travaux_tags as $barame_tag)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $barame_tag->rank == '1'? $barame_tag->bareme:"NO CEE" }}
                                    </td>
                                    <td>
                                        {{ $barame_tag->travaux }}
                                    </td>
                                    <td>
                                        {{ $barame_tag->tag }}
                                    </td>
                                    <td>
                                        {{ $barame_tag->rank }}
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                @if (checkAction(Auth::id(), 'general__setting-baremes', 'edit') || role() == 's_admin')
                                                    <button data-toggle="modal" data-target="#BarèmesTravauxTagEditModal{{ $barame_tag->id }}" type="button" class="dropdown-item border-0" data-user-id="2">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @endif
                                                @if (checkAction(Auth::id(), 'general__setting-baremes', 'delete') || role() == 's_admin')
                                                    <button type="button" data-toggle="modal"   data-target="#BarèmesTravauxTagDeleteModal{{ $barame_tag->id }}" class="dropdown-item border-0">
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
                                <td colspan="4" class="text-center py-5">
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
    <div class="modal modal--aside fade leftAsideModal" id="BarèmesModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 id="updatedtagTitle" class="modal-title text-center mb-5">Barèmes/Travaux/Tag</h1>
                <form action="{{ route('bareme.travaux.tag.create') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="rank">Rank</label>
                        <Select id="rank" name="rank" data-id="baremesFieldBox" data-bareme-id="0" class="select2_select_option custom-select shadow-none form-control rankChange" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </Select>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div id="baremesFieldBox">
                        <div class="form-group">
                            <label class="form-label" for="bareme0">Barèmes</label>
                            <input type="text" id="bareme0" name="bareme" class="form-control shadow-none rounded" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="bareme_description0">Barèmes {{ __('Description') }}</label>
                            <textarea  id="bareme_description0" name="bareme_description" class="form-control shadow-none rounded" required></textarea>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="travauxx">Travaux</label>
                        <input type="text" id="travauxx" name="travaux" class="form-control shadow-none rounded" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="tag">Tag</label>
                        <input type="text" id="tag" name="tag" class="form-control shadow-none rounded" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="grand_precaire_montant_maprime_no_fioul">Grand Precaire Montant MAPRIMERENOV No Fioul €</label>
                        <input type="number" step="any" value="0" id="grand_precaire_montant_maprime_no_fioul" name="grand_precaire_montant_maprime_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="grand_precaire_montant_maprime_fioul">Grand Precaire Montant MAPRIMERENOV Fioul €</label>
                        <input type="number" step="any" value="0" id="grand_precaire_montant_maprime_fioul" name="grand_precaire_montant_maprime_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="grand_precaire_montant_cee_no_fioul">Grand Precaire Montant C.E.E No Fioul €</label>
                        <input type="number" step="any" value="0" id="grand_precaire_montant_cee_no_fioul" name="grand_precaire_montant_cee_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="grand_precaire_montant_cee_fioul">Grand Precaire Montant C.E.E Fioul €</label>
                        <input type="number" step="any" value="0" id="grand_precaire_montant_cee_fioul" name="grand_precaire_montant_cee_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="precaire_montant_maprime_no_fioul">Precaire Montant MAPRIMERENOV No Fioul €</label>
                        <input type="number" step="any" value="0" id="precaire_montant_maprime_no_fioul" name="precaire_montant_maprime_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="precaire_montant_maprime_fioul">Precaire Montant MAPRIMERENOV Fioul €</label>
                        <input type="number" step="any" value="0" id="precaire_montant_maprime_fioul" name="precaire_montant_maprime_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="precaire_montant_cee_no_fioul">Precaire Montant C.E.E No Fioul €</label>
                        <input type="number" step="any" value="0" id="precaire_montant_cee_no_fioul" name="precaire_montant_cee_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="precaire_montant_cee_fioul">Precaire Montant C.E.E Fioul €</label>
                        <input type="number" step="any" value="0" id="precaire_montant_cee_fioul" name="precaire_montant_cee_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="intermediaire_montant_maprime_no_fioul">Intermediaire Montant MAPRIMERENOV No Fioul €</label>
                        <input type="number" step="any" value="0" id="intermediaire_montant_maprime_no_fioul" name="intermediaire_montant_maprime_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="intermediaire_montant_maprime_fioul">Intermediaire Montant MAPRIMERENOV Fioul €</label>
                        <input type="number" step="any" value="0" id="intermediaire_montant_maprime_fioul" name="intermediaire_montant_maprime_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="intermediaire_montant_cee_no_fioul">Intermediaire Montant C.E.E No Fioul €</label>
                        <input type="number" step="any" value="0" id="intermediaire_montant_cee_no_fioul" name="intermediaire_montant_cee_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="intermediaire_montant_cee_fioul">Intermediaire Montant C.E.E Fioul €</label>
                        <input type="number" step="any" value="0" id="intermediaire_montant_cee_fioul" name="intermediaire_montant_cee_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="classique_montant_maprime_no_fioul">Classique Montant MAPRIMERENOV No Fioul €</label>
                        <input type="number" step="any" value="0" id="classique_montant_maprime_no_fioul" name="classique_montant_maprime_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="classique_montant_maprime_fioul">Classique Montant MAPRIMERENOV Fioul €</label>
                        <input type="number" step="any" value="0" id="classique_montant_maprime_fioul" name="classique_montant_maprime_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="classique_montant_cee_no_fioul">Classique Montant C.E.E No Fioul €</label>
                        <input type="number" step="any" value="0" id="classique_montant_cee_no_fioul" name="classique_montant_cee_no_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="classique_montant_cee_fioul">Classique Montant C.E.E Fioul €</label>
                        <input type="number" step="any" value="0" id="classique_montant_cee_fioul" name="classique_montant_cee_fioul" class="form-control shadow-none rounded">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="price">Price €</label>
                        <input type="number" step="any" value="0" id="price" name="price" class="form-control shadow-none rounded">
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
    @foreach ($bareme_travaux_tags as $bareme_tag)
        <div class="modal modal--aside fade leftAsideModal" id="BarèmesTravauxTagEditModal{{ $bareme_tag->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="updatedtagTitle" class="modal-title text-center mb-5">Barèmes/Travaux/Tag</h1>
                    <form action="{{ route('bareme.travaux.tag.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $bareme_tag->id }}">
                        <div class="form-group">
                            <label class="form-label" for{{ $bareme_tag->id }}="rank">Rank</label>
                            <Select id="rank{{ $bareme_tag->id }}" data-id="baremesField{{ $bareme_tag->id }}" data-bareme-id="{{ $bareme_tag->id }}" name="rank" class="select2_select_option custom-select shadow-none form-control rankChange" required>
                                <option {{ $bareme_tag->rank == '1' ? 'selected':'' }} value="1">1</option>
                                <option {{ $bareme_tag->rank == '2' ? 'selected':'' }} value="2">2</option>
                            </Select>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div id="baremesField{{ $bareme_tag->id }}" style="display: {{ $bareme_tag->rank == '1' ? '':'none' }}">
                            <div class="form-group">
                                <label class="form-label" for="bareme{{ $bareme_tag->id }}">Barèmes</label>
                                <input type="text" id="bareme{{ $bareme_tag->id }}" name="bareme" value="{{ $bareme_tag->bareme }}" class="form-control shadow-none rounded" {{ $bareme_tag->rank == '1' ? 'required':'' }}>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="bareme_description{{ $bareme_tag->id }}">Barèmes {{ __('Description') }}</label>
                                <textarea  id="bareme_description{{ $bareme_tag->id }}" name="bareme_description" class="form-control shadow-none rounded" {{ $bareme_tag->rank == '1' ? 'required':'' }}>{{ $bareme_tag->bareme_description }}</textarea>
                                <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="travauxx{{ $bareme_tag->id }}">Travaux</label>
                            <input type="text" id="travauxx{{ $bareme_tag->id }}" name="travaux" value="{{ $bareme_tag->travaux }}" class="form-control shadow-none rounded" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="tag{{ $bareme_tag->id }}">Tag</label>
                            <input type="text" id="tag{{ $bareme_tag->id }}" name="tag" value="{{ $bareme_tag->tag }}" class="form-control shadow-none rounded" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="grand_precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}">Grand Precaire Montant MAPRIMERENOV No Fioul €</label>
                            <input type="number" step="any" id="grand_precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_maprime_no_fioul" value="{{ $bareme_tag->grand_precaire_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="grand_precaire_montant_maprime_fioul{{ $bareme_tag->id }}">Grand Precaire Montant MAPRIMERENOV Fioul €</label>
                            <input type="number" step="any" id="grand_precaire_montant_maprime_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_maprime_fioul" value="{{ $bareme_tag->grand_precaire_montant_maprime_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="grand_precaire_montant_cee_no_fioul{{ $bareme_tag->id }}">Grand Precaire Montant C.E.E No Fioul €</label>
                            <input type="number" step="any" id="grand_precaire_montant_cee_no_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_cee_no_fioul" value="{{ $bareme_tag->grand_precaire_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="grand_precaire_montant_cee_fioul{{ $bareme_tag->id }}">Grand Precaire Montant C.E.E Fioul €</label>
                            <input type="number" step="any" id="grand_precaire_montant_cee_fioul{{ $bareme_tag->id }}" name="grand_precaire_montant_cee_fioul" value="{{ $bareme_tag->grand_precaire_montant_cee_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}">Precaire Montant MAPRIMERENOV No Fioul €</label>
                            <input type="number" step="any" id="precaire_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="precaire_montant_maprime_no_fioul" value="{{ $bareme_tag->precaire_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="precaire_montant_maprime_fioul{{ $bareme_tag->id }}">Precaire Montant MAPRIMERENOV Fioul €</label>
                            <input type="number" step="any" id="precaire_montant_maprime_fioul{{ $bareme_tag->id }}" name="precaire_montant_maprime_fioul" value="{{ $bareme_tag->precaire_montant_maprime_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="precaire_montant_cee_no_fioul{{ $bareme_tag->id }}">Precaire Montant C.E.E No Fioul €</label>
                            <input type="number" step="any" id="precaire_montant_cee_no_fioul{{ $bareme_tag->id }}" name="precaire_montant_cee_no_fioul" value="{{ $bareme_tag->precaire_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="precaire_montant_cee_fioul{{ $bareme_tag->id }}">Precaire Montant C.E.E Fioul €</label>
                            <input type="number" step="any" id="precaire_montant_cee_fioul{{ $bareme_tag->id }}" name="precaire_montant_cee_fioul" value="{{ $bareme_tag->precaire_montant_cee_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="intermediaire_montant_maprime_no_fioul{{ $bareme_tag->id }}">Intermediaire Montant MAPRIMERENOV No Fioul €</label>
                            <input type="number" step="any" id="intermediaire_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_maprime_no_fioul" value="{{ $bareme_tag->intermediaire_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="intermediaire_montant_maprime_fioul{{ $bareme_tag->id }}">Intermediaire Montant MAPRIMERENOV Fioul €</label>
                            <input type="number" step="any" id="intermediaire_montant_maprime_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_maprime_fioul" value="{{ $bareme_tag->intermediaire_montant_maprime_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="intermediaire_montant_cee_no_fioul{{ $bareme_tag->id }}">Intermediaire Montant C.E.E No Fioul €</label>
                            <input type="number" step="any" id="intermediaire_montant_cee_no_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_cee_no_fioul" value="{{ $bareme_tag->intermediaire_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="intermediaire_montant_cee_fioul{{ $bareme_tag->id }}">Intermediaire Montant C.E.E Fioul €</label>
                            <input type="number" step="any" id="intermediaire_montant_cee_fioul{{ $bareme_tag->id }}" name="intermediaire_montant_cee_fioul" value="{{ $bareme_tag->intermediaire_montant_cee_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="classique_montant_maprime_no_fioul{{ $bareme_tag->id }}">Classique Montant MAPRIMERENOV No Fioul €</label>
                            <input type="number" step="any" id="classique_montant_maprime_no_fioul{{ $bareme_tag->id }}" name="classique_montant_maprime_no_fioul" value="{{ $bareme_tag->classique_montant_maprime_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="classique_montant_maprime_fioul{{ $bareme_tag->id }}">Classique Montant MAPRIMERENOV Fioul €</label>
                            <input type="number" step="any" id="classique_montant_maprime_fioul{{ $bareme_tag->id }}" name="classique_montant_maprime_fioul" value="{{ $bareme_tag->classique_montant_maprime_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="classique_montant_cee_no_fioul{{ $bareme_tag->id }}">Classique Montant C.E.E No Fioul €</label>
                            <input type="number" step="any" id="classique_montant_cee_no_fioul{{ $bareme_tag->id }}" name="classique_montant_cee_no_fioul" value="{{ $bareme_tag->classique_montant_cee_no_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="classique_montant_cee_fioul{{ $bareme_tag->id }}">Classique Montant C.E.E Fioul €</label>
                            <input type="number" step="any" id="classique_montant_cee_fioul{{ $bareme_tag->id }}" name="classique_montant_cee_fioul" value="{{ $bareme_tag->classique_montant_cee_fioul }}" class="form-control shadow-none rounded">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="price{{ $bareme_tag->id }}">Price €</label>
                            <input type="number" step="any" id="price{{ $bareme_tag->id }}" name="price" value="{{ $bareme_tag->price ?? 0 }}" class="form-control shadow-none rounded">
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
        <div class="modal modal--aside fade" id="BarèmesTravauxTagDeleteModal{{ $bareme_tag->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('bareme.travaux.tag.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $bareme_tag->id }}">
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