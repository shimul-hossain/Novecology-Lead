@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('RegieTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-regie" role="tabpanel" aria-labelledby="v-pills-regie-tab">
        <div class="setting-form">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">{{ __('Add New Regie') }}</h3>
                    <form action="{{ route('user.regie.add') }}" method="POST" id="generalInfoFormRegie">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="regie_name">{{ __('Regie Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="regie_name" id="regie_name" class="form-control shadow-none">
                            <input type="hidden" name="regie_id" id="regie_id" value="0" class="form-control shadow-none">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="responsable_commercial">Responsable Commercial <span class="text-danger">*</span></label>
                            <select name="responsable_commercial" id="responsable_commercial"  class="select2_select_option custom-select shadow-none form-control">
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($responsable_commercials as $r_commercial)
                                    <option value="{{ $r_commercial->id }}">{{ $r_commercial->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="col-12 mt-3">
                    @if (checkAction(Auth::id(), 'general__setting-regie', 'create') || role() == 's_admin')
                        <button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" id="regie_form_submit">{{ __('Save changes') }}</button>
                    @else
                        <button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2"><span class="novecologie-icon-lock py-1"></span> {{ __('Save changes') }}</button>
                    @endif
                </div>
                <div class="col-12">
                    <div class="table-responsive simple-bar">
                        <table class="table database-table w-100 mb-0">
                            <thead class="database-table__header">
                                <tr>
                                    <th>{{ __('Serial') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>Responsable Commercial</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="database-table__body">
                                @forelse ($regies as $regie)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $regie->name }}</td>
                                    <td>{{ $regie->getUser->name ?? '' }}</td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                @if (checkAction(Auth::id(), 'general__setting-regie', 'edit') || role() == 's_admin')
                                                    <button  type="button" class="dropdown-item border-0 regie_edit_button" data-responsable_commercial="{{ $regie->team_leader_id }}" data-id="{{ $regie->id }}" data-name="{{ $regie->name }}">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                <button  type="button" class="dropdown-item border-0">
                                                    <span class="novecologie-icon-lock py-1"></span> {{ __('Edit') }}
                                                </button>
                                                @endif
                                                @if (checkAction(Auth::id(), 'general__setting-regie', 'delete') || role() == 's_admin')
                                                    <form action="{{ route('user.regie.destroy') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $regie->id }}">
                                                        <button type="button" data-toggle="modal" data-target="#regieModalDelete{{ $regie->id }}" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-trash mr-1"></span>
                                                                Supprimer
                                                        </button>
                                                    </form>
                                                @else
                                                    <button type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span> Supprimer
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td  class="text-center" colspan="5">{{ __('No Question Found') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-content')
    @foreach ($regies as $regie) 
        <div class="modal modal--aside fade" id="regieModalDelete{{ $regie->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('user.regie.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $regie->id }}">
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