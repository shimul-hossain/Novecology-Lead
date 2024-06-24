{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Users') }}
@endsection

{{-- Backgroud color  --}}
@section('bodyBg')
secondary-bg    
@endsection

{{-- active menu  --}}
@section('settingsIndex')
active
@endsection


{{-- Main Content Part  --}}
@section('content')
@php 
    $navHeaders = App\Models\CRM\Navigation::all();
    $headerNotnav = App\Models\CRM\NonNavigation::all(); 
@endphp
<!-- Banner Section -->
    <section class="banner section-gap position-relative">
        <div class="container">
            {{-- <a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a> --}}
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1 class="banner__title text-center text-white">{{ __('All users') }}</h1>
                    {{-- <p class="text-center text-white mb-2 mb-md-0">Follow the progress of Leads in real time</p> --}}
                </div>
                <div class="col-12 d-flex flex-wrap align-items-center justify-content-md-end mb-3">
                    <input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input w-25 mr-auto" id="user_search_bar">

                    <button data-toggle="modal" data-target="#userBulkDeleteModal" id="userBulkDeleteButton" type="button" class="d-none rounded-pill primary-btn btn-danger border-0 mt-3 mt-xl-0 mr-2">{{ __('Delete') }}</button>
                    <button data-toggle="modal" data-target="#rightAsideModal" type="button" class="rounded-pill secondary-btn border-0 mt-3 mt-xl-0">+ {{ __('Add filter') }}</button>
                    <select id="paginationCount" class="custom-select w-auto ml-2">
                        <option {{ paginationNumber('users') == '25' ? 'selected':'' }} value="25">25</option>
                        <option {{ paginationNumber('users') == '50' ? 'selected':'' }} value="50">50</option>
                        <option {{ paginationNumber('users') == '100' ? 'selected':'' }} value="100">100</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="database-table-wrapper bg-white">
                        <div class="table-responsive simple-bar">
                            <table class="table database-table w-100 mb-0" id="dataTables">
                                <thead class="database-table__header"> 
                                    <tr>
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="checkAll" value="1" class="custom-control-input table-all-select-checkbox user_checkbox_all" id="user_custom_check">
                                                <label class="custom-control-label" for="user_custom_check"></label>
                                            </div>
                                        </th>
                                        
                                        @if ($filter_status->count()== 0)
                                            <th>{{ __('ID') }}</th>
                                            <th>
                                                {{ __('First Name') }}
                                            </th>
                                            <th>
                                                {{-- <input type="search" data-item="Name" placeholder="{{ __('Name') }}" class="database-table__search-input database-table__search-input--name user_search"> --}}
                                                {{ __('Name') }}
                                            </th>
                                            <th>
                                                {{ __('Regie') }}
                                            </th>
                                            {{-- <th>
                                                {{ __('Team Leader') }}
                                            </th> --}}
                                            {{-- <th>
                                                {{ __('User Name') }}
                                            </th> --}}
                                            {{-- <th>
                                                
                                                {{ __('Phone number') }}
                                            </th> --}}
                                            <th>
                                                {{-- <input type="search" data-item="email" placeholder="{{ __('Email') }}" class="database-table__search-input database-table__search-input--email user_search"> --}}
                                                {{ __('Email') }}
                                            </th>
                                            <th>
                                                {{ __('Role') }}
                                            </th> 
                                            <th class="text-center">
                                                {{ __('Status') }}
                                            </th> 
										@else

											@foreach ($headers as $header)
												@foreach ($filter_status as $item) 
													@if ($item->user_header_id == $header->id)

														{{-- @if ($header->header == 'ID' || $header->header == 'Rôle' || $header->header == 'Role')
															<th> 
																 {{ $header->header }} 
															</th> 
														@else --}}
															<th class=" {{ $header->header == 'Status' || $header->header =='Statut' ? 'text-center':'' }} "> 
																{{-- <input type="search" data-item="{{ $header->header }}" placeholder="{{ $header->header }}" class="database-table__search-input database-table__search-input--code w-100 user_search"> --}}
                                                                {{ ucFirst($header->header) }}
															</th> 
														{{-- @endif --}}
													
													@endif 
												@endforeach 
											@endforeach 
                                        @endif 
                                        @if (Auth::user()->role == 's_admin')
                                            <th class="text-center">
                                                Calculette BAR TH 164
                                            </th>
                                        @endif
                                        <th class="text-center">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="database-table__body" id="all_user">
                                   @include('includes.crm.users')
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-wrapper">
                            {{ $users->onEachSide(1)->links() }} 
                       </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Right Aside Modal -->
    <div class="modal modal--aside fade rightAsideModal" id="rightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center">{{ __('Additional filters') }}</h1>
                    <p class="modal-text text-center mb-5">{{ __('Filter your tables with your custom columns') }}</p>
                    <form action="{{ route('user.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
                        @csrf 

                        <h2 class="modal-sub-title position-relative">{{ __('User Filter') }}</h2>
                        <div class="row my-3">
                            @if ($filter_status->count() == 0)
                                @foreach ($headers as $key => $header)
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox"> 
                                            <input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" checked >
                                            <label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
                                        </div>
                                    </div>
                                @endforeach 
                            @else
                                @foreach ($headers as $key => $header) 
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox"> 
                                            <input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" 
                                                @foreach ($filter_status as $item)
                                                    @if ( $header->id == $item->user_header_id)
                                                        checked
                                                    @endif
                                                @endforeach
                                            >
                                            <label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
                                        </div>
                                    </div>
                                @endforeach 
                            @endif  
                        </div> 
                        <div class="row">
                            <div class="col"> 
                                <button type="submit" class="secondary-btn border-0 mt-3">{{ __('Filter') }}</button> 
                            </div>
                        </div> 
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal--aside fade" id="userBulkDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                    <form action="{{ route('user.bulk.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" class="bulk_checked_user_id" value=""> 
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
@foreach ($users as $user)
        <!-- Middle Modal -->
        <div class="modal modal--aside fade" id="EditUser{{ $user->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0 pb-0">
                        <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                            <span class="novecologie-icon-close"></span>
                        </button>
                    </div>
                    <div class="modal-body pt-0 mb-5 px-5"> 
                        <form action="{{ route('update.user') }}" class="form mx-auto" method="POST" enctype="multipart/form-data" id="userUpdateForm{{ $user->id }}">
                            @csrf 
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <h1 class="form__title position-relative text-center">{{ __('Update User') }}</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name{{ $user->id }}" class="form-label">{{ __('First name') }} <span class="text-danger">*</span></label>
                                        <input type="text" id="name{{ $user->id }}" name="name" value="{{ $user->name }}" class="form-control shadow-none px-3">
                                        @if (old('user_id') == $user->id)
                                            @error('name')
                                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name{{ $user->id }}" class="form-label"> {{ __('Name') }}</label>
                                        <input type="text" id="first_name{{ $user->id }}" name="first_name" value="{{ $user->first_name }}" class="form-control shadow-none px-3">
                                        <div class="invalid-feedback d-block text-danger first_nameError{{ $user->id }}"></div>
                                    </div>  
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role{{ $user->id }}" class="form-label">Sélectionner rôle<span class="text-danger">*</span></label>
                                        <select name="role_id" id="role{{ $user->id }}" class="custom-select shadow-none form-control" required> 
                                            @foreach ($roles as $role) 
                                            <option 
                                            @if ($role->id == $user->role_id)
                                            selected                        
                                            @endif
                                            value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach 
                                        </select> 
                                        @if (old('user_id') == $user->id)
                                            @error('role_id')
                                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email{{ $user->id }}" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <input type="text" id="email{{ $user->id }}" name="email" value="{{ $user->email }}" class="form-control shadow-none px-3">
                                        @if (old('user_id') == $user->id)
                                            @error('email')
                                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password{{ $user->id }}" class="form-label d-block">{{ __('Password') }}</label>
                                    <div class="form-group d-flex flex-column align-items-center position-relative"> 
                                        <input type="password" id="password{{ $user->id }}" name="password" autocomplete="new-password" class="form-control form-control--password shadow-none" placeholder="{{ __('Password') }}">
                                        <button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
                                            <span class="password-toggler__icon novecologie-icon-eye"></span>
                                        </button>  
                                    </div>
                                    @if (old('user_id') == $user->id)
                                        @error('password')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="con_password{{ $user->id }}" class="form-label d-block">{{ __('Confirm Password') }}</label>
                                    <div class="form-group d-flex flex-column align-items-center position-relative"> 
                                        <input type="password" id="con_password{{ $user->id }}" name="confirm_password" class="form-control form-control--password shadow-none" placeholder="{{ __('Confirm Password') }}">
                                        <button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
                                            <span class="password-toggler__icon novecologie-icon-eye"></span>
                                        </button> 
                                    </div>
                                    @if (old('user_id') == $user->id)
                                        @error('confirm_password')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="email_professional{{ $user->id }}" class="form-label">Email professionnel</label>
                                        <input type="email" id="email_professional{{ $user->id }}" name="email_professional" value="{{ $user->email_professional }}" class="form-control shadow-none" placeholder="Email professionnel
                                        ">
                                        <div class="invalid-feedback d-block text-danger emailProfessionalError{{ $user->id }}"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="phone_professional{{ $user->id }}" class="form-label">Téléphone professionnel</label>
                                        <input type="text" id="phone_professional{{ $user->id }}" name="phone_professional" value="{{ $user->phone_professional }}" class="form-control shadow-none" placeholder="Téléphone professionnel">
                                        <div class="invalid-feedback d-block text-danger phoneProfessionalError{{ $user->id }}"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group"> 
                                        <label for="prenom_professional{{ $user->id }}" class="form-label">Prénom professionnel</label>
                                        <input type="text" id="prenom_professional{{ $user->id }}" name="prenom_professional" value="{{ $user->prenom_professional }}" class="form-control shadow-none" placeholder="Prénom professionnel">
                                        <div class="invalid-feedback d-block text-danger prenomProfessionalError{{ $user->id }}"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="avator_photo{{ $user->id }}" class="form-label d-block">Photo</label>
                                    <div class="input-group mb-3"> 
                                        <div class="custom-file">
                                            <input type="file" name="photo" accept="image/*" class="custom-file-input" id="avator_photo{{ $user->id }}">
                                            <label class="custom-file-label" for="avator_photo{{ $user->id }}">Ajouter photo</label>
                                        </div>
                                        @if (old('user_id') == $user->id)
                                            @error('photo')
                                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div> 
                                </div> 
                                <div class="col-12">
                                    <div class="form-group d-flex align-items-center justify-content-between"> 
                                        <label for="" class="form-label">{{ __('Regie') }}</label>
                                        <label class="switch-checkbox ml-2">
                                            <input type="checkbox" name="regie" class="switch-checkbox__input  regie__checkbox" {{ $user->regie_id ? 'checked':'' }} id="regieCheckbox{{ $user->id }}" data-id="{{ $user->id }}">
                                            <span class="switch-checkbox__label"></span>
                                        </label>
                                    </div>
                                    <div class="invalid-feedback d-block text-danger regieError{{ $user->id }}"></div>
                                    <div class="form-group" style="display: {{ $user->regie_id ? '':'none' }}" id="regieBlock{{ $user->id }}">  
                                        <select name="regie_id" id="regie_id{{ $user->id }}" class="custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($regies as $regie)
                                            <option {{ $user->regie_id == $regie->id ? "selected":'' }} value="{{ $regie->id }}">{{ $regie->name }}</option>                                            
                                            @endforeach 
                                        </select> 
                                        @if (old('user_id') == $user->id)
                                            @error('regie_id')
                                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div> 
                                    <div class="form-group d-flex align-items-center justify-content-between"> 
                                        <label for="" class="form-label">Chef d’Équipe</label>
                                        <label class="switch-checkbox ml-2">
                                            <input type="checkbox" class="switch-checkbox__input teamLeaderCheck" data-id="{{ $user->id }}" {{ $user->team_leader ? 'checked':'' }} name="teamLeader" id="teamLeaderCheckbox{{ $user->id }}">
                                            <span class="switch-checkbox__label"></span>
                                        </label>
                                    </div>
                                    @if (old('user_id') == $user->id)
                                        @error('teamLeader')
                                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                    <div class="form-group" style="display: {{ $user->team_leader ? '':'none' }}" id="teamLeaderBlock{{ $user->id }}">  
                                        <select name="team_leader" id="team_leader{{ $user->id }}" class="custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($team_leader as $leader)
                                            <option {{ $user->team_leader == $leader->id ? 'selected':''  }} value="{{ $leader->id }}">{{ $leader->name }}</option>                                         
                                            @endforeach 
                                        </select> 
                                        <div class="invalid-feedback d-block text-danger team_leaderError{{ $user->id }}"></div>
                                    </div>
                                
    
                                    <div class="form-group d-flex align-items-center justify-content-between"> 
                                        <label for="" class="form-label">{{ __('Active') }}</label>
                                        <label class="switch-checkbox ml-2">
                                            <input type="checkbox" id="status{{ $user->id }}" class="switch-checkbox__input" {{ $user->status == 'active' ? 'checked':'' }}  name="status">
                                            <span class="switch-checkbox__label"></span>
                                        </label>
                                    </div>  
                                    
                                    <div class="form-group text-center mt-4">
                                        <div class="lead__card__loader-wrapper d-none">
                                            <div class="lead__card__loader">
                                                <svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                                                    <path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                                                    </path>
                                                </svg>
                                            </div>
                                        </div>
                                        <button data-user-id="{{ $user->id }}" type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3 user_update_btn">{{ __('Update') }}</button>  
                                    </div>
                                </div>
                            </div>

                        </form>  
                    </div>
                    <div class="modal-footer border-0 py-0">
                        <button type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" data-dismiss="modal">{{ __('Close') }}</button> 
                      </div>
                </div>
            </div>
        </div>
        <div class="modal modal--aside fade" id="userSingeDeleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
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
                        <form action="{{ route('user.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}"> 
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


<form action="{{ route('pagination.number.change') }}" id="paginationCountForm" method="POST">
    @csrf
    <input type="hidden" name="module" value="users">
    <input type="hidden" name="number" id="paginationCountInput">
</form>


@endsection


@push('js')
 <script>
     $(document).ready(function(){

        @if ($errors->has('name') || $errors->has('regie_id') || $errors->has('team_leader') || $errors->has('email') || $errors->has('email') || $errors->has('email') || $errors->has('password') || $errors->has('password') || $errors->has('confirm_password') || $errors->has('confirm_password') || $errors->has('role_id'))
            $('#EditUser'+{{ old('user_id') }}).modal('show');
        @endif

		$(document).on('change', '#paginationCount', function(){
			$('#paginationCountInput').val($(this).val());
			$('#paginationCountForm').submit();
		});

        $('body').on('keyup', '.user_search', function(){
            var search = $(this).val();
            var data = $(this).attr('data-item');

            if(search.length != ''){
                $('.pagination-wrapper').removeClass('d-block');
                $('.pagination-wrapper').addClass('d-none'); 
            }else{
                $('.pagination-wrapper').removeClass('d-none');
                $('.pagination-wrapper').addClass('d-block'); 

            } 
                if(data == 'Name'||data == 'Nom'){
                    var column = 'name';
                }
                
                if(data == 'User Name'||data == 'Nom d\'utilisateur'){
                    var column = 'username';
                }
                
                if(data == 'phone'||data == 'téléphone'){
                    var column = 'telephone';
                }
                
                if(data == 'email'||data == 'e-mail'){
                    var column = 'email';
                } 
    

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 

                $.ajax({
                    type: "POST",
                    url: "{{ route('all-user.search') }}",
                    data: {
                        search 	: search,
                        column	: column, 
                    },
                    success: function (response) {
                        $('#all_user').html(response.search); 
                    }, 
                    error: function(response){  
                        console.log(response);
                    }
                });
                
	    }); 
        $('body').on('change', '.bar_th_164_permission', function(){
            let user_id = $(this).attr('data-id');
            let data = '';
            if($(this).is(':checked')){
                data = 'Oui';
            }else{
                data = 'Non';
            } 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 

            $.ajax({
                type: "POST",
                url: "{{ route('user.bar_th_164_permission') }}",
                data: {data, user_id},
                success: function (response) {
                    $('#successMessage').html('{{ __("Updated Succesfully") }}');
					$('.toast.toast--success').toast('show');
                }, 
                error: function(response){   

                }
            });
                
	    }); 
        $('body').on('change', '.user_active__btn', function(){
            let user_id = $(this).attr('data-id');
            let data = '';
            if($(this).is(':checked')){
                data = 'active';
            }else{
                data = 'deactive';
            } 

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 

            $.ajax({
                type: "POST",
                url: "{{ route('user.status.change') }}",
                data: {data, user_id},
                success: function (response) {
                    $('#successMessage').html('{{ __("Updated Succesfully") }}');
					$('.toast.toast--success').toast('show');
                }, 
                error: function(response){   

                }
            });
                
	    }); 

        $('body').on('click', '.permission_btn_check', function(){
            var module_name = $(this).attr('data-module');
            var action = $(this).attr('data-action');
            var user_id =$(this).attr('data-user-id');

            $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST", 
					url :"{{ route('permission.action') }}",
					data: { 
						module_name 	: module_name, 
						action_name 	: action,
						user_id 		: user_id, 
					},
					 
					success: function(data){ 
						console.log(data);
                        $('#successMessage').text(data);
						$('.toast.toast--success').toast('show');
					},
					
				}); 
        });
        $('body').on('change', '.regie__checkbox', function(){
            let id = $(this).attr('data-id');
            if(this.checked){
				$("#regieBlock"+id).slideDown();
			}else{
				$("#regieBlock"+id).slideUp();
			}
        }); 
        $('body').on('change', '.teamLeaderCheck', function(){
            let id = $(this).attr('data-id');
            if(this.checked){
				$("#teamLeaderBlock"+id).slideDown();
			}else{
				$("#teamLeaderBlock"+id).slideUp();
			}
        }); 

        // $('body').on('click', '.user_update_btn', function(e){
        //     $(".invalid-feedback").text('');
        //     e.preventDefault();
        //     var id = $(this).attr('data-user-id');   
        //     $(".lead__card__loader-wrapper").removeClass("d-none");
        //     $(".user_update_btn").addClass("d-none");
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: "POST", 
        //         url:"{{ route('update.user') }}",
        //         processData: false,
        //         contentType: false,
        //         data: new FormData($('#userUpdateForm'+id)[0]), 
        //         success: function(data){  
        //             $(".lead__card__loader-wrapper").addClass("d-none");
        //             $(".user_update_btn").removeClass("d-none"); 
        //             $('#EditUser'+id).modal('hide');
        //             $('#successMessage').text(data.alert);
        //             $('.toast.toast--success').toast('show'); 
        //             $('#all_user').html(data.updated_user);
        //         },
        //         error: function(error){  
        //             $(".lead__card__loader-wrapper").addClass("d-none");
        //             $(".user_update_btn").removeClass("d-none");
        //             if(error.responseJSON.errors['name']){
        //                 $('.nameError'+id).text(error.responseJSON.errors['name']); 
        //             }
        //             if(error.responseJSON.errors['regie_id']){
        //                 $('.regie_idError'+id).text(error.responseJSON.errors['regie_id']); 
        //             }
        //             if(error.responseJSON.errors['team_leader']){
        //                 $('.team_leaderError'+id).text(error.responseJSON.errors['team_leader']); 
        //             }
        //             if(error.responseJSON.errors['email']){
        //                 $('.emailError'+id).text(error.responseJSON.errors['email']); 
        //             }
        //             if(error.responseJSON.errors['password']){
        //                 $('.passwordError'+id).text(error.responseJSON.errors['password']); 
        //             }
        //             if(error.responseJSON.errors['confirm_password']){
        //                 $('.confirm_passwordError'+id).text(error.responseJSON.errors['confirm_password']); 
        //             }
        //             if(error.responseJSON.errors['role_id']){
        //                 $('.role_idError'+id).text(error.responseJSON.errors['role_id']); 
        //             }
        //             if(error.responseJSON.errors['email_professional']){
        //                 $('.emailProfessionalError'+id).text(error.responseJSON.errors['email_professional']); 
        //             }
        //             if(error.responseJSON.errors['phone_professional']){
        //                 $('.phoneProfessionalError'+id).text(error.responseJSON.errors['phone_professional']); 
        //             }
        //             if(error.responseJSON.errors['prenom_professional']){
        //                 $('.prenomProfessionalError'+id).text(error.responseJSON.errors['prenom_professional']); 
        //             }
        //             if(error.responseJSON.errors['photo']){
        //                 $('.photoError'+id).text(error.responseJSON.errors['photo']); 
        //             }
        //         }
                
        //     });  
        // }); 
        // $('body').on('click', '.user_update_btn', function(e){
        //     e.preventDefault();
        //     var id = $(this).attr('data-user-id');
        //     var name = $('#name'+id).val();
        //     var first_name = $('#first_name'+id).val();
        //     // var user_name = $('#user_name'+id).val();
        //     var email = $('#email'+id).val();
        //     var phone = $('#phone'+id).val(); 
        //     var regie_id = $('#regie_id'+id).val();
        //     var team_leader = $('#team_leader'+id).val();
        //     var role = $('#role'+id).val();
        //     if($('#status'+id).is(':checked')){
        //         var status = 'active';
        //     }else{
        //         var status = 'deactive'; 
        //     }    

        //     var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        //     if(name == ''){  
        //         $('#errorMessage').text("{{ __('Please enter name') }}");
        //         $('.toast.toast--error').toast('show');  
        //         $('#name'+id).focus();
        //     }else if(first_name == ''){
        //         $('#errorMessage').text("{{ __('Please enter first name') }}");
        //         $('.toast.toast--error').toast('show');  
        //         $('#first_name'+id).focus();
        //     // }else if(user_name == ''){
        //     //     $('#errorMessage').text("{{ __('Please enter user name') }}");
        //     //     $('.toast.toast--error').toast('show');  
        //     //     $('#user_name'+id).focus(); 
		// 	}else if($('#regieCheckbox'+id).is(':checked') && regie_id == null){ 
        //         $('#errorMessage').text("{{ __('Please select regie') }}");
        //         $('.toast.toast--error').toast('show');  
        //         $('#regie_id'+id).focus();
		// 	}else if($('#teamLeaderCheckbox'+id).is(':checked') && team_leader == null){ 
        //         $('#errorMessage').text("{{ __('Please select Chef d’Équipe') }}");
        //         $('.toast.toast--error').toast('show');  
        //         $('#team_leader'+id).focus();
		// 	}else if(role == ''){
        //         $('#errorMessage').text("{{ __('Please select role') }}");
        //         $('.toast.toast--error').toast('show');  
        //         $('#role'+id).focus();
        //     }else if(email == ''){
        //         $('#errorMessage').text("{{ __('Please enter email') }}");
        //         $('.toast.toast--error').toast('show');  
        //         $('#email'+id).focus();
        //     }else if(!regex.test(email)){
        //         $('#errorMessage').text("{{ __('Please enter email address') }}");
        //         $('.toast.toast--error').toast('show');  
        //         $('#email'+id).focus();
        //     }else{
        //         $(".lead__card__loader-wrapper").removeClass("d-none");
		// 		$(".user_update_btn").addClass("d-none");
        //         $.ajaxSetup({
		// 					headers: {
		// 						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 					}
		// 				});
		// 			$.ajax({
		// 				type: "POST", 
		// 				url:"{{ route('update.user') }}",
		// 				data: {
		// 					user_id     : id,
        //                     name        : name,
        //                     first_name  : first_name,
        //                     regie_id    : regie_id,
        //                     team_leader : team_leader,
        //                     // username   : user_name,						 
        //                     email       : email,
        //                     telephone   : phone,
        //                     role_id     : role,
        //                     status      : status,
		// 				},

		// 				success: function(data){
        //                     $(".lead__card__loader-wrapper").addClass("d-none");
		// 		            $(".user_update_btn").removeClass("d-none");
		// 					$('#EditUser'+id).modal('hide');
		// 					$('#successMessage').text(data.alert);
		// 					$('.toast.toast--success').toast('show'); 
        //                     $('#all_user').html(data.updated_user);
		// 				},
        //                 error: function(error){
        //                     $(".lead__card__loader-wrapper").addClass("d-none");
		// 		            $(".user_update_btn").removeClass("d-none");
        //                     if(error.responseJSON.errors['email']){
        //                     $('#errorMessage').text(error.responseJSON.errors['email']);
        //                     $('.toast.toast--error').toast('show');  
        //                     } 
        //                 }
						
		// 			}); 
        //     }
        // }); 
		$("#user_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTables tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			}); 
	    });
        $('body').on('click', '.checkboxLabel', function(){ 
            var user_id = $(this).attr('data-user-id');
            var role_id = $(this).attr('data-role-id');
            var nav_id  = $(this).attr('data-nav-id');
            var route   = $(this).attr('data-route');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            $.ajax({

                url: "{{ route('user.permission') }}",
                type:"POST",
                data:{
                    user_id         :user_id,
                    role_id         :role_id,
                    navigation_id   : nav_id,
                    name            :route, 
                },
                success:function(data){
                    $('#successMessage').text(data);
                    $('.toast.toast--success').toast('show');
                },  
            }); 
        });  
		$('body').on('click', '.user_single_select_checkbox', function(){  
			user_id_array = [];   
            $('.user_single_select_checkbox').each(function(){ 
                if(this.checked){
                    user_id_array.push($(this).attr('data-id'))
                    $('.bulk_checked_user_id').val(user_id_array); 
                }
            }); 
			console.log(user_id_array);

			if(user_id_array.length == 0)
			{  
				$("#userBulkDeleteButton").addClass('d-none'); 
			}else{
				$("#userBulkDeleteButton").removeClass('d-none'); 
			}
		}); 
		
		$('body').on('click', '.user_checkbox_all', function(){
			user_id_array = [];   
            $('.user_single_select_checkbox').each(function(){ 
                if(this.checked){
                    user_id_array.push($(this).attr('data-id'))
                    $('.bulk_checked_user_id').val(user_id_array); 
                }
            }); 
			console.log(user_id_array);
			if(user_id_array.length == 0)
			{  
				$("#userBulkDeleteButton").addClass('d-none'); 
			}else{
				$("#userBulkDeleteButton").removeClass('d-none'); 
			}	 
		});
    });
 </script>
@endpush