@php
$x_code= 'empty';
@endphp
@if ($filter_status->count()== 0)
    @foreach ($clients as $client)
        @if (role() != 's_admin')
            @if (!getClientAccess(Auth::id(), $client->id))
                @continue
            @endif
        @endif
        @if ($x_code != substr($client->postal_code, 0,2))
            <tr>
                <td colspan="500" class="text-white" style="background-color: #000">{{ $client->postal_code ? getDepartment3($client->postal_code).' '.substr($client->postal_code, 0,2) : __('No Department') }}</td>
            </tr>
        @endif
        <tr>
            <td>
                <div class="custom-control custom-checkbox">
                    <input value="1" type="checkbox" class="custom-control-input table-select-checkbox" id="tableRowSelectCheck-{{ $client->id }}">
                    <label class="custom-control-label" for="tableRowSelectCheck-{{ $client->id }}"></label>
                </div>
            </td>
            <td>{{ $client->id }}</td>
            <td>
                <div>
                    <div class="first-name pl-2">{{ $client->first_name }}</div>
                </div>
            </td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->postal_code }}</td>
            <td>{{ $client->heating_type }}</td>  
            <td class="text-left">
                <button style="color:{{ $client->getStatus->status_color ?? '' }}; background: {{ $client->getStatus->background_color ?? '' }}" data-toggle="modal" data-project-id="{{ $client->id }}" data-target="#SubStatusChangeModal{{ $client->id }}" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn">
                    {{ $client->getStatus->status ?? 'New' }}
                    <span class="novecologie-icon-chevron-right pl-1"></span>
                </button> 
            </td>
            <td>
                <div class="avatar-group d-flex">
                    @if (getClientAssignee($client->id)->count() > 3)                       
                        @foreach(getClientAssignee($client->id) as $item) 
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a> 
                        @if ($loop->iteration > 3)
                            @if (getClientAssignee($client->id)->count() > 4)
                            <a href="#!" class="avatar-group__more">+{{ getClientAssignee($client->id)->count() - 4 }} {{ __('more') }}</a>     
                            @endif
                            @break
                        @endif
                        @endforeach 
                    @else
                        @forelse (getClientAssignee($client->id) as $item)
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a>
                        @empty
                        {{ __('No assignee') }}
                        @endforelse
                    @endif
                </div>  
            </td>
            <td>
                <div class="d-flex align-items-center flex-wrap">  
                    @foreach (getProject($client->id) as $project)
                    @if (role() != 's_admin')
                        @if (!getProjectAccess(Auth::id(), $project->id))
                            @continue
                        @endif
                    @endif
                        <a class="primary-btn primary-btn--purple primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 m-1" href="{{ route('files.index',$project->id) }}"> {{ $project->project_name }}</a> 
                    @endforeach 
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center justify-content-center"> 
                    @if (checkAction(Auth::id(), 'client', 'edit') || role() == 's_admin') 
                    <a href="{{ route('client.lead.update', $client->id) }}" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle">
                        <span class="novecologie-icon-chevron-right"></span>
                    </a>
                    @endif	 
                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                            @if (checkAction(Auth::id(), 'client', 'assign') || role() == 's_admin')
                            <button  data-client-id="{{ $client->id }}"  type="button" class="dropdown-item border-0 clientAssigneeButton">
                                <span class="novecologie-icon-edit mr-1"></span>
                                {{ __('Assignee') }}
                            </button>
                            @endif	
                            @if (checkAction(Auth::id(), 'client', 'delete') || role() == 's_admin') 
                            <form action="{{ route('client.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="dropdown-item border-0" id="customSelectDropdown" >
                                    <span class="novecologie-icon-trash mr-1"></span> 
                                    {{ __('Delete') }}
                                </button> 
                            </form>
                            @endif
                        </div>
                    </div>  
                </div>
            </td>
        </tr>
        @push('all_modals')
            <div class="modal modal--aside fade" id="SubStatusChangeModal{{ $client->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                <span class="novecologie-icon-close"></span>
                            </button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1> 
                            <form action="{{ route('client.status.change') }}" method="POST" class="status_change__modal">
                                @csrf
                                <input type="hidden" name="id" value="{{ $client->id }}">  
                                <div class="status_change__input text-left">
                                    <div class="form-group text-left mt-3">
                                        <label class="form-label" for="lead_staus_news{{ $client->id }}">Merci de renseigner le nouveau statut de votre client</label>
                                        <select name="sub_status" id="lead_staus_news{{ $client->id }}" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option> 
                                            @foreach ($client_status as $sub_status)
                                                <option {{ $client->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->status }}</option> 
                                            @endforeach
                                        </select>
                                    </div> 
                                </div> 
                                <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                    {{ __('Submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        @endpush
        @php
            $x_code = substr($client->postal_code, 0,2);
        @endphp
    @endforeach 
@else
    @foreach ($clients as $client)
        @if (role() != 's_admin')
            @if (!getClientAccess(Auth::id(), $client->id))
                @continue
            @endif
        @endif
        @if ($x_code != substr($client->postal_code, 0,2))
            <tr>
                <td colspan="500" class="text-white" style="background-color: #000">{{ $client->postal_code ? getDepartment3($client->postal_code).' '.substr($client->postal_code, 0,2) : __('No Department') }}</td>
            </tr>
        @endif
        <tr>
            <td>
                <div class="custom-control custom-checkbox">
                    <input value="1" type="checkbox" data-client-id="{{ $client->id }}" class="custom-control-input table-select-checkbox clientCheckboxBtn" id="tableRowSelectCheck-{{ $client->id }}">
                    <label class="custom-control-label" for="tableRowSelectCheck-{{ $client->id }}"></label>
                </div>
            </td>

            @foreach ($filter_status as $item)
                @php
                    $header = \App\Models\CRM\ClientHeader::where('id', $item->client_header_id)->first()->header;  
                @endphp
                @if($header == 'ID')
                <td>{{ $client->id??__('Not Provided') }}</td>
                @endif
                @if($header == 'first name'|| $header == 'prénom')
                <td>{{ $client->first_name??__('Not Provided') }}</td>
                @endif
                @if($header == 'last name'||$header =='nom de famille')
                <td>{{ $client->last_name??__('Not Provided') }}</td>
                @endif
                @if($header == 'phone'||$header =='téléphone')
                <td>{{ $client->phone??__('Not Provided') }}</td>
                @endif
                @if($header == 'email'||$header =='e-mail')
                <td>{{ $client->email??__('Not Provided') }}</td>
                @endif
                @if($header == 'country'||$header =='pays')
                <td>{{ $client->pays??__('Not Provided') }}</td>
                @endif
                @if($header == 'postal code'||$header == 'code postal')
                <td>{{ $client->postal_code??__('Not Provided') }}</td>
                @endif 
                @if($header == 'zone'||$header == 'zone')
                <td>{{ $client->zone??__('Not Provided') }}</td>
                @endif 
                @if($header == 'city'||$header == 'ville')
                <td>{{ $client->city??__('Not Provided') }}</td>
                @endif 
                @if($header == 'house type'||$header == 'type de maison')
                <td>{{ $client->house_type??__('Not Provided') }}</td>
                @endif 
                @if($header == 'electricity connection'||$header == 'branchement électrique')
                <td>{{ $client->electricity_connection??__('Not Provided') }}</td>
                @endif 
                @if($header == 'heating type'|| $header == 'type de chauffage')
                <td>{{ $client->heating_type??__('Not Provided') }}</td>
                @endif  
            @endforeach  
            <td class="text-left">
                <button style="color:{{ $client->getStatus->status_color ?? '' }}; background: {{ $client->getStatus->background_color ?? '' }}" data-toggle="modal" data-project-id="{{ $client->id }}" data-target="#SubStatusChangeModal{{ $client->id }}" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn">
                    {{ $client->getStatus->status ?? 'New' }}
                    <span class="novecologie-icon-chevron-right pl-1"></span>
                </button> 
            </td>
            <td>
                <div class="avatar-group d-flex">
                    @if (getClientAssignee($client->id)->count() > 3)                       
                        @foreach(getClientAssignee($client->id) as $item) 
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a> 
                        @if ($loop->iteration > 3)
                            @if (getClientAssignee($client->id)->count() > 4)
                            <a href="#!" class="avatar-group__more">+{{ getClientAssignee($client->id)->count() - 4 }} {{ __('more') }}</a>     
                            @endif
                            @break
                        @endif
                        @endforeach 
                    @else
                        @forelse (getClientAssignee($client->id) as $item)
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a>
                        @empty
                        {{ __('No assignee') }}
                        @endforelse
                    @endif
                </div>  
            </td>
            
            <td>
                <div class="d-flex align-items-center flex-wrap">  
                    @foreach (getProject($client->id) as $project)
                    @if (role() != 's_admin')
                        @if (!getProjectAccess(Auth::id(), $project->id))
                            @continue
                        @endif
                    @endif
                        <a class="primary-btn primary-btn--purple primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 m-1" href="{{ route('files.index',$project->id) }}"> {{ $project->project_name }}</a> 
                    @endforeach  
                </div>
            </td>

            <td>
                <div class="d-flex align-items-center justify-content-around">
                    
                    @if (checkAction(Auth::id(), 'client', 'edit') || role() == 's_admin') 
                    <a href="{{ route('client.lead.update', $client->id) }}" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle">
                        <span class="novecologie-icon-chevron-right"></span>
                    </a>
                    @endif	 
                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                            @if (checkAction(Auth::id(), 'client', 'assign') || role() == 's_admin')
                            <button  data-client-id="{{ $client->id }}"  type="button" class="dropdown-item border-0 clientAssigneeButton">
                                <span class="novecologie-icon-edit mr-1"></span>
                                {{ __('Assignee') }}
                            </button>
                            @endif
                            @if (checkAction(Auth::id(), 'client', 'delete') || role() == 's_admin') 
                            <form action="{{ route('client.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="dropdown-item border-0" id="customSelectDropdown" >
                                    <span class="novecologie-icon-trash mr-1"></span> 
                                    {{ __('Delete') }}
                                </button> 
                            </form>
                            @endif
                        </div>
                    </div>  
                    
                </div>
            </td>
        </tr>	 
        @push('all_modals')
            <div class="modal modal--aside fade" id="SubStatusChangeModal{{ $client->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                                <span class="novecologie-icon-close"></span>
                            </button>
                        </div>
                        <div class="modal-body text-center pt-0">
                            <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1> 
                            <form action="{{ route('client.status.change') }}" method="POST" class="status_change__modal">
                                @csrf
                                <input type="hidden" name="id" value="{{ $client->id }}">  
                                <div class="status_change__input text-left">
                                    <div class="form-group text-left mt-3">
                                        <label class="form-label" for="lead_staus_news{{ $client->id }}">Merci de renseigner le nouveau statut de votre client</label>
                                        <select name="sub_status" id="lead_staus_news{{ $client->id }}" class="select2_select_option custom-select shadow-none form-control">
                                            <option value="" selected>{{ __('Select') }}</option> 
                                            @foreach ($client_status as $sub_status)
                                                <option {{ $client->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->status }}</option> 
                                            @endforeach
                                        </select>
                                    </div> 
                                </div> 
                                <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                    {{ __('Submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> 
        @endpush
        @php
            $x_code = substr($client->postal_code, 0,2);
        @endphp
    @endforeach

@endif 