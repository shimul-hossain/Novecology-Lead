@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('SousStatutProspectTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-lead_sub_status" role="tabpanel" aria-labelledby="v-pills-lead_sub_status-tab">
        <form action="{{ route('lead.sub-status.create') }}" class="setting-form" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">Sous statut prospect</h3>
                    <div class="form-group">
                        <label class="form-label" for="lead_sub_statuse_name">Nom<span class="text-danger">*</span></label>
                        <input type="text" id="lead_sub_statuse_name" name="name" class="form-control shadow-none rounded" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label for="#">Etiquette :</label>
                        <select class="select2_select_option form-control" name="status_id[]" multiple>
                            @foreach ($lead_statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="lead_sub_statuse_background_color">Couleur de fond<span class="text-danger">*</span></label>
                        <input type="color" id="lead_sub_statuse_background_color" name="background_color" class="form-control shadow-none rounded" value="#8e27b3" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="lead_sub_statuse_text_color">Couleur du texte<span class="text-danger">*</span></label>
                        <input type="color" id="lead_sub_statuse_text_color" name="text_color" class="form-control shadow-none rounded" value="#ffffff" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="lead_sub_statuse_order">Order</label>
                        <input type="number" id="lead_sub_statuse_order" name="order" class="form-control shadow-none rounded" value="#ffffff">
                    </div>
                </div>
                <div class="col-12 mt-3">
                    @if (checkAction(Auth::id(), 'general__setting-lead_sub_status', 'create') || role() == 's_admin')
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
                                    <th>Prévisualisation</th>
                                    <th>Etuquette</th>
                                    <th>Order</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="database-table__body">
                                @foreach ($lead_sub_statuses as $lead_sub_status)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lead_sub_status->name }}</td>
                                        <td><span class="rounded-pill" style="background-color: {{ $lead_sub_status->background_color }}; color: {{ $lead_sub_status->text_color }} ; padding:10px 30px"> {{ $lead_sub_status->name }}</span></td>
                                        <td>
                                            @foreach ($lead_sub_status->getStatus as $status)
                                                {{ $status->status }}{{ $loop->last ? '':', ' }}
                                            @endforeach
                                        </td>
                                        <td>{{ $lead_sub_status->order }}</td>
                                        <td>
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    {{-- @if ($lead_sub_status->id == 5)
                                                        <button  type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            Non modifiable
                                                        </button>
                                                    @else --}}
                                                        @if (checkAction(Auth::id(), 'general__setting-lead_sub_status', 'edit') || role() == 's_admin')
                                                            <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#lead_sub_status_edit{{ $lead_sub_status->id }}">
                                                                <span class="novecologie-icon-edit mr-1"></span>
                                                                {{ __('Edit') }}
                                                            </button>
                                                        @else
                                                            <button  type="button" class="dropdown-item border-0">
                                                                <span class="novecologie-icon-lock py-1"></span>
                                                                {{ __('Edit') }}
                                                            </button>
                                                        @endif
                                                    {{-- @endif --}}

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
    @foreach ($lead_sub_statuses as $lead_sub_status)
        <div class="modal modal--aside fade leftAsideModal" id="lead_sub_status_edit{{ $lead_sub_status->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">Sous statut prospect</h1>
                    <form action="{{ route('lead.sub-status.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="lead_sub_statuss__edit{{ $lead_sub_status->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
                            <input type="text" id="lead_sub_statuss__edit{{ $lead_sub_status->id }}" name="name" value="{{ $lead_sub_status->name }}" class="form-control shadow-none rounded" required>
                            <input type="hidden" name="id" value="{{ $lead_sub_status->id }}">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="#">Etiquette :</label>
                            <select class="select2_select_option form-control" name="status_id[]" multiple>
                                @foreach ($lead_statuses as $status)
                                    <option {{ $lead_sub_status->getStatus->where('id', $status->id)->first() ? 'selected':'' }} value="{{ $status->id }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="lead_sub_statuse_background_color{{ $lead_sub_status->id }}">Couleur de fond<span class="text-danger">*</span></label>
                            <input type="color" id="lead_sub_statuse_background_color{{ $lead_sub_status->id }}" name="background_color" class="form-control shadow-none rounded" value="{{ $lead_sub_status->background_color }}" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="lead_sub_statuse_text_color{{ $lead_sub_status->id }}">Couleur du texte<span class="text-danger">*</span></label>
                            <input type="color" id="lead_sub_statuse_text_color{{ $lead_sub_status->id }}" name="text_color" class="form-control shadow-none rounded" value="{{ $lead_sub_status->text_color }}" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="lead_sub_statuse_order{{ $lead_sub_status->id }}">Order</label>
                            <input type="number" id="lead_sub_statuse_order{{ $lead_sub_status->id }}" name="order" value="{{ $lead_sub_status->order }}" class="form-control shadow-none rounded" value="#ffffff">
                        </div>

                        <div class="form-group mt-4 d-flex justify-content-between">
                            <button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
                            @if (checkAction(Auth::id(), 'general__setting-lead_sub_status', 'delete') || role() == 's_admin')
                                <button type="button" class="btn btn-danger rounded border-0 mb-3 shadow-none" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#lead_sub_status_delete{{ $lead_sub_status->id }}">
                                    <span class="novecologie-icon-trash mr-1"></span>
                                        Supprimer
                                </button>
                            @else
                                <button type="button" class="btn btn-danger rounded border-0 mb-3 shadow-none">
                                    <span class="novecologie-icon-lock py-1"></span>
                                        Supprimer
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <div class="modal modal--aside fade" id="lead_sub_status_delete{{ $lead_sub_status->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('lead.sub-status.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $lead_sub_status->id }}">
                            <div class="d-flex justify-content-center">
                                <button type="button" class="primary-btn primary-btn--danger primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
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