@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('ParamètresCouleurUtilisateurTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-color_user" role="tabpanel" aria-labelledby="v-pills-color_user-tab">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4 pt-3 pl-3">Couleur utilisateur</h3>
            </div>

            <div class="col-12" >
                <div class="table-responsive">
                    <table class="table database-table w-100 mb-0">
                        <thead class="database-table__header">
                            <tr>
                                <th>{{ __('Serial') }}</th>
                                <th>{{ __("Name") }}</th>
                                <th>Prévisualisation</th>
                                <th class="text-center">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
                            @foreach ($color_users as $color_user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $color_user->name }}</td>
                                    <td><span class="rounded-pill" style="background-color: {{ $color_user->background_color }}; color: {{ $color_user->color }} ; padding:10px 30px"> {{ $color_user->name }}</span></td>
                                    <td class="text-center">
                                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-boundary="viewport">
                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                @if (checkAction(Auth::id(), 'general__setting-user_color', 'edit') || role() == 's_admin')
                                                    <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#color_user_edit{{ $color_user->id }}">
                                                        <span class="novecologie-icon-edit mr-1"></span>
                                                        {{ __('Edit') }}
                                                    </button>
                                                @else
                                                    <button  type="button" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-lock py-1"></span>
                                                        {{ __('Edit') }}
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
    </div>
@endsection

@section('modal-content')
    @foreach ($color_users as $color_user)
        <div class="modal modal--aside fade leftAsideModal" id="color_user_edit{{ $color_user->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">Couleur utilisateur : {{ $color_user->name }}</h1>
                    <form action="{{ route('user.color.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="user_text_color{{ $color_user->id }}">Couleur du texte</label>
                            <input type="color" id="user_text_color{{ $color_user->id }}" name="color" value="{{ $color_user->color }}" class="form-control shadow-none rounded">
                            <input type="hidden" name="id" value="{{ $color_user->id }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="user_background_color{{ $color_user->id }}">Couleur de l'arrière plan</label>
                            <input type="color" id="user_background_color{{ $color_user->id }}" name="background_color" value="{{ $color_user->background_color }}" class="form-control shadow-none rounded">
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3 mr-2">{{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    @endforeach
@endsection