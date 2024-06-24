@extends('admin.settings.layout')

@section('ParamètresCollapseActive', 'true')
@section('ParamètresCollapse', 'show')
@section('CommentCategoryTabActive', 'active')

@section('tab-content')
    <div class="tab-pane fade show active" id="v-pills-comment_category" role="tabpanel" aria-labelledby="v-pills-comment_category-tab">
        <form action="{{ route('comment.category.add') }}" class="setting-form" id="generalInfoFormtravaux" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-4">{{ __('Comment Category') }}</h3>
                    <div class="form-group">
                        <label class="form-label" for="category_name">{{ __('Name') }} <span class="text-danger">*</span></label>
                        <input type="text" id="category_name" name="name" class="form-control shadow-none rounded" placeholder="{{ __('Enter Category Name') }}" required>
                        <input type="hidden" id="comment_category_id" name="id" value="0">
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="role_id">Rôle <span class="text-danger">*</span></label>
                        <select name="role_id[]" id="role_id" class="select2_select_option custom-select shadow-none form-control" multiple required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="background_color">{{ __('Background Color') }} <span class="text-danger">*</span></label>
                        <input type="color" id="background_color" name="background_color" class="form-control shadow-none rounded" placeholder="{{ __('Enter Background Color') }}" required>
                        <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    @if (checkAction(Auth::id(), 'general__setting-comment_category', 'create') || role() == 's_admin')
                        <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Submit') }}</button>
                    @else
                        <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">
                            <span class="novecologie-icon-lock py-1"></span>
                            {{ __('Submit') }}
                        </button>
                    @endif
                </div>
                <div class="col-12" >
                    <div class="table-responsive simple-bar">
                        <table class="table database-table w-100 mb-0">
                            <thead class="database-table__header">
                                <tr>
                                    <th>{{ __('Serial') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th class="w-50">Rôle</th>
                                    <th>{{ __('Background Color') }}</th>
                                    <th class="text-center">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody class="database-table__body">
                                @foreach ($comment_categories as $comment_category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $comment_category->name }}</td>
                                        <td  class="w-50">
                                            {{-- {{ $comment_category->roleCategory->name ?? '' }} --}} 
                                                
                                                @forelse ($comment_category->roles as $role)
                                                    {{ $role->name }} {{ $loop->last? '': ', ' }}
                                                @empty
                                                {{ __('No assignee') }}
                                                @endforelse
                                            {{-- <div class="avatar-group d-flex">
                                                @if ($comment_category->assignee->count() > 3)
                                                    @foreach($comment_category->assignee as $assigne_item)
                                                    <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assigne_item->name }}">
                                                        @if ($assigne_item->profile_photo)
                                                        <img src="{{ asset('uploads/crm/profiles') }}/{{ $assigne_item->profile_photo }}" alt="{{ $assigne_item->name }}" class="avatar-group__image w-100 h-100">
                                                        @else
                                                        <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                                                        @endif
                                                    </a>
                                                    @if ($loop->iteration > 3)
                                                        @if ($comment_category->assignee->count() > 4)
                                                        <a href="#!" class="avatar-group__more">+{{ $comment_category->assignee->count() - 4 }} {{ __('more') }}</a>
                                                        @endif
                                                        @break
                                                    @endif
                                                    @endforeach
                                                @else
                                                    @forelse ($comment_category->assignee as $assignee_item)
                                                    <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assignee_item->name }}">
                                                        @if ($assignee_item->profile_photo)
                                                        <img src="{{ asset('uploads/crm/profiles') }}/{{ $assignee_item->profile_photo }}" alt="{{ $assignee_item->name }}" class="avatar-group__image w-100 h-100">
                                                        @else
                                                        <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                                                        @endif
                                                    </a>
                                                    @empty
                                                    {{ __('No assignee') }}
                                                    @endforelse
                                                @endif
                                            </div> --}}
                                        </td>
                                        <td style="background-color: {{ $comment_category->background_color }}"></td>
                                        <td class="text-center">
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    @if (checkAction(Auth::id(), 'general__setting-comment_category', 'edit') || role() == 's_admin')
                                                        <button  type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#comment_category_edit{{ $comment_category->id }}">
                                                            <span class="novecologie-icon-edit mr-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @else
                                                        <button  type="button" class="dropdown-item border-0">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @endif
                                                    @if (checkAction(Auth::id(), 'general__setting-comment_category', 'delete') || role() == 's_admin')
                                                        <button type="button" class="dropdown-item border-0" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#comment_category_delete{{ $comment_category->id }}">
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
    @foreach ($comment_categories as $comment_category)
        <div class="modal modal--aside fade leftAsideModal" id="comment_category_edit{{ $comment_category->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center mb-5">{{ __('Comment Category') }}</h1>
                    <form action="{{ route('comment.category.add') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="commentCategroy{{ $comment_category->id }}">{{ __("Name") }}<span class="text-danger">*</span></label>
                            <input type="text" id="commentCategroy{{ $comment_category->id }}" name="name" value="{{ $comment_category->name }}" class="form-control shadow-none rounded" required>
                            <input type="hidden" name="id" value="{{ $comment_category->id }}">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="role_id{{ $comment_category->id }}">Rôle <span class="text-danger">*</span></label>
                            <select name="role_id[]" id="role_id{{ $comment_category->id }}" class="select2_select_option custom-select shadow-none form-control" multiple required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $comment_category->roles->where('id', $category->id)->first() ? 'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="background_color{{ $comment_category->id }}">{{ __('Background Color') }} <span class="text-danger">*</span></label>
                            <input type="color" id="background_color{{ $comment_category->id }}" name="background_color" value="{{ $comment_category->background_color }}" class="form-control shadow-none rounded" placeholder="{{ __('Enter Background Color') }}" required>
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
        <div class="modal modal--aside fade" id="comment_category_delete{{ $comment_category->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('comment.category.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $comment_category->id }}">
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