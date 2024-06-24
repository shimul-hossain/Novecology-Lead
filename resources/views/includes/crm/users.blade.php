@if ($filter_status->count()== 0)
@foreach ($users as $user)
    <tr>
        <td>
            <div class="custom-control custom-checkbox">
                <input value="1" type="checkbox" data-id="{{ $user->id }}" class="custom-control-input table-select-checkbox user_single_select_checkbox" id="tableRowSelectCheck-{{ $user->id }}">
                <label class="custom-control-label" for="tableRowSelectCheck-{{ $user->id }}"></label>
            </div>
        </td>
        <td>{{ $user->id }}</td>
        <td> {{ $user->name }}</td>
        <td> {{ $user->first_name ?? __('Not Provided') }}</td>
        <td> {{ $user->getRegie->name ?? __('Not Provided') }}</td> 
        <td>{{ $user->email }}</td>
        <td>{{ $user->getRoleName->name }}</td>
        {{-- <td>{{ $user->status ?? 'Active' }}</td> --}}
        <td class="text-center">
            <label class="switch-checkbox">
                <input type="checkbox" class="switch-checkbox__input user_active__btn" data-id="{{ $user->id }}" {{ $user->status == 'active' ? 'checked':'' }}>
                <span class="switch-checkbox__label"></span>
            </label>
        </td>
        @if (Auth::user()->role == 's_admin')
            <td class="text-center">
                <label class="switch-checkbox">
                    <input type="checkbox" class="switch-checkbox__input bar_th_164_permission" data-id="{{ $user->id }}" {{ $user->bar_th_164 == 'Oui' ? 'checked':'' }}>
                    <span class="switch-checkbox__label"></span>
                </label>
            </td> 
        @endif
        {{-- <td>Instagram</td> --}}
        {{-- <td>
            <div class="d-flex align-items-center">
                <textarea name="commentTextarea" id="commentTextarea" placeholder="To write a comment" class="database-table__textarea"></textarea>
                <button data-toggle="modal" data-target="#leftAsideModal" type="button" class="primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 ml-3">
                    NRP
                    <span class="novecologie-icon-chevron-right pl-2"></span>
                </button>
            </div>
        </td> --}}
        <td>
            <div class="d-flex align-items-center justify-content-around"> 
                <div class="dropdown dropdown--custom p-0 d-inline-block">
                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">  
                        {{-- @if (checkAction(Auth::id(), 'user', 'permission') || role() == 's_admin')   --}}
                        @if (role() == 's_admin')  
                        <a href="{{ route('admin.user.permission', $user->id) }}" class="dropdown-item border-0">
                            <span class="novecologie-icon-check mr-1"></span>
                            {{ __('Permission') }}
                        </a> 
                        @endif
                        @if (checkAction(Auth::id(), 'user', 'edit') || role() == 's_admin')
                        <button  data-toggle="modal" data-target="#EditUser{{ $user->id }}" type="button" class="dropdown-item border-0" data-user-id="{{ $user->id }}">
                            <span class="novecologie-icon-edit mr-1"></span>
                            {{ __('Edit') }}
                        </button> 
 				        @endif
                        @if (checkAction(Auth::id(), 'user', 'delete') || role() == 's_admin')   
                            <button type="button" data-toggle="modal" data-target="#userSingeDeleteModal{{ $user->id }}" class="dropdown-item border-0">
                                <span class="novecologie-icon-trash mr-1"></span>
                                {{ __('Delete') }}
                            </button> 
                        @endif
                    </div>
                </div>
            </div>
        </td>
    </tr>
@endforeach 
@else
@foreach ($users as $user)
<tr>
    <td>
        <div class="custom-control custom-checkbox">
            <input value="1" type="checkbox" data-id="{{ $user->id }}" class="custom-control-input table-select-checkbox user_single_select_checkbox" id="tableRowSelectCheck-{{ $user->id }}">
            <label class="custom-control-label" for="tableRowSelectCheck-{{ $user->id }}"></label>
        </div>
    </td>

    @foreach ($filter_status as $item)
        @php
            $header = \App\Models\CRM\UserHeader::where('id', $item->user_header_id)->first()->header;  
        @endphp
        @if($header == 'ID')
        <td>{{ $user->id??__('Not Provided') }}</td>
        @endif
        @if($header == 'First Name'|| $header == 'Prenom')
        <td>{{ $user->name ?? __('Not Provided') }}</td>
        @endif
        @if($header == 'Name'|| $header == 'Nom')
        <td>{{ $user->first_name??__('Not Provided') }}</td>
        @endif
        @if($header == 'Regie'|| $header == 'Regie')
        <td>{{ $user->getRegie->name ?? __('Not Provided') }}</td>
        @endif 
        @if($header == 'email'||$header =='e-mail')
        <td>{{ $user->email??__('Not Provided') }}</td>
        @endif
        @if($header == 'Role'||$header =='Rôle')
        <td>{{ $user->getRoleName->name??__('Not Provided') }}</td>
        @endif  
        @if($header == 'Status'||$header =='Statut')
            <td class="text-center">
                <label class="switch-checkbox">
                    <input type="checkbox" class="switch-checkbox__input user_active__btn" data-id="{{ $user->id }}" {{ $user->status == 'active' ? 'checked':'' }}>
                    <span class="switch-checkbox__label"></span>
                </label>
            </td>
        {{-- <td class="text-center">{{ $user->status ?? 'Active' }}</td> --}}
        @endif  
    @endforeach 
    @if (Auth::user()->role == 's_admin')
        <td class="text-center">
            <label class="switch-checkbox">
                <input type="checkbox" class="switch-checkbox__input bar_th_164_permission" data-id="{{ $user->id }}" {{ $user->bar_th_164 == 'Oui' ? 'checked':'' }}>
                <span class="switch-checkbox__label"></span>
            </label>
        </td> 
    @endif
    <td>
        <div class="d-flex align-items-center justify-content-around"> 
            <div class="dropdown dropdown--custom p-0 d-inline-block">
                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                </button>
                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                    {{-- @if (checkAction(Auth::id(), 'user', 'permission') || role() == 's_admin') --}}
                    @if (role() == 's_admin')  
                    <a href="{{ route('admin.user.permission', $user->id) }}" class="dropdown-item border-0">
                        <span class="novecologie-icon-check mr-1"></span>
                        {{ __('Permission') }}
                    </a> 
                    @endif
                    @if (checkAction(Auth::id(), 'user', 'edit') || role() == 's_admin')
                    <button  data-toggle="modal" data-target="#EditUser{{ $user->id }}" type="button" class="dropdown-item border-0 permission_modal_btn" data-user-id="{{ $user->id }}">
                        <span class="novecologie-icon-edit mr-1"></span>
                        {{ __('Edit') }}
                    </button> 
                     @endif
                    @if (checkAction(Auth::id(), 'user', 'delete') || role() == 's_admin')   
                        <button type="button" data-toggle="modal" data-target="#userSingeDeleteModal{{ $user->id }}" class="dropdown-item border-0">
                            <span class="novecologie-icon-trash mr-1"></span>
                            {{ __('Delete') }}
                        </button>  
                    @endif
                </div>
            </div>
        </div>
    </td>
</tr> 
@endforeach 
@endif   