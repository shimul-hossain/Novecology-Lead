@if ($filter_status->count() + $customFilterStatus->count() == 0)
    @forelse ($lead_status[0] as $lead) 
        <tr>
            <td>
                <div class="custom-control custom-checkbox"> 
                    <input type="checkbox"name="checkedLead[]" value="{{ $lead->id }}" class="custom-control-input table-select-checkbox progress_lead_checked lead_checkbox_item lead_checkbox_item__0" data-id="{{ $lead->id }}"  id="tableThreeRowSelectCheck-{{ $lead->id }}">
                    <label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $lead->id }}"></label>
                </div>
            </td> 

            <td>{{ $lead->id }}</td> 
            <td><a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->first_name??__('Not Provided') }}</a></td>
            <td><a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->phone??__('Not Provided') }}</a></td>
            <td><a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->email??__('Not Provided') }}</a></td>
            <td><a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->postal_code??__('Not Provided') }}</a></td>
            <td><a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->heating_type??__('Not Provided') }}</a></td>
            {{-- @if() --}}
            @isset($company_name)
            <td><a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->company_name }}</a></td> 
            @endisset
            {{-- @if($company_name)
            @endif  --}}
            {{-- <td>
                <textarea name="commentTextarea" id="commentTextarea{{ $lead->id }}" placeholder="{{ __('To write a comment') }}" class="database-table__textarea commentTextareaField" data-id="{{ $lead->id }}">{{ $lead->comment }}</textarea>
            </td>  --}}
            <td class="text-left">
                <button style="color:{{ $lead->getStatus->status_color ?? '' }}; background: {{ $lead->getStatus->background_color ?? '' }}" data-toggle="modal" data-lead-id="{{ $lead->id }}" data-target="#userStatusModel" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn pl-2">
                    {{ $lead->getStatus->status ?? __('No Status') }}
                    <span class="novecologie-icon-chevron-right pl-1"></span>
                </button> 
            </td>
            <td>
                <div class="avatar-group d-flex">
                    @if (getLeadAssignee($lead->id)->count() > 3)                       
                        @foreach(getLeadAssignee($lead->id) as $item) 
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a> 
                        @if ($loop->iteration > 3)
                            @if (getLeadAssignee($lead->id)->count() > 4)
                            <a href="#!" class="avatar-group__more">+{{ getLeadAssignee($lead->id)->count() - 4 }} {{ __('more') }}</a>     
                            @endif
                            @break
                        @endif
                        @endforeach 
                    @else
                        @forelse (getLeadAssignee($lead->id) as $item)
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a>
                        @empty
                        {{ __('No assignee') }}
                        @endforelse
                    @endif
                </div> 
            </td>
            <td>
                <div class="d-flex align-items-center justify-content-end action-btns-wrapper"> 
                    {{-- <div class="dropdown dropdown--custom p-0 d-inline-block">
                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                            @if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
                                <button type="button" data-lead-id="{{ $lead->id }}" class="dropdown-item border-0 leadAssigneeButton">
                                    <span class="novecologie-icon-edit mr-1"></span>
                                    {{ __('Assignee') }}
                                </button> 
                            @endif	
                            @if (checkAction(Auth::id(), 'lead', 'delete') || role() == 's_admin') 
                                <form action="{{ route('lead.delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                                    <button type="submit" class="dropdown-item border-0" id="customSelectDropdown" >
                                        <span class="novecologie-icon-trash mr-1"></span> 
                                        {{ __('Delete') }}
                                    </button> 
                                </form>
                            @endif
                        </div>
                    </div>   --}}
                    
                    @if (checkAction(Auth::id(), 'lead', 'edit') || role() == 's_admin')
                        <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                            {{ __('Update') }}
                        </a>
                    @endif	
                </div>
            </td>
        </tr> 
    @empty
        <tr>
            <td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
        </tr>
    @endforelse
@else
    @forelse ($lead_status[0] as $lead)  
        <tr>
            <td>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="checkedLead[]"  value="{{ $lead->id }}" class="custom-control-input table-select-checkbox progress_lead_checked lead_checkbox_item lead_checkbox_item__0"  data-id="{{ $lead->id }}" id="tableThreeRowSelectCheck-{{ $lead->id }}">
                    <label class="custom-control-label" for="tableThreeRowSelectCheck-{{ $lead->id }}"></label>
                </div>
            </td> 
            @foreach ($filter_status as $item)
                @php
                    $header = \App\Models\CRM\LeadHeader::where('id', $item->lead_header_id)->first()->header;
                @endphp
                @if($header == 'ID')
                <td>{{ $lead->id??__('Not Provided') }}</td>
                @endif
                @if($header == 'tracker name'||$header == 'nom du traqueur')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->tracker_name??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'tracker platform'||$header == 'plateforme de suivi')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->tracker_platform??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'tracker email'||$header == 'e-mail de suivi')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->tracker_email??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'tracker phone'||$header == 'téléphone traqueur')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->tracker_phone??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'project name'||$header == 'project name')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->project_name??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'first name'|$header == 'prénom' )
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->first_name??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'last name'||$header == 'nom de famille')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->last_name??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'phone'||$header == 'téléphone')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->phone??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'email'|| $header == 'e-mail')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->email??__('Not Provided') }}</a></td>
                @endif 
                @if($header == 'department' || $header == 'département')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->department??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'precariousness' || $header == 'précarité')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->precariousness??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'zone'|| $header == 'zone')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->zone??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'postal code' || $header == 'code postal')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->postal_code??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'country' || $header == 'pays')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->country??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'city'||$header =='ville')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->city??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'address'||$header == 'adresse')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->address??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'nature occupation'|| $header == 'métier de la nature')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->nature_occupation??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'heating type'|| $header == 'type de chauffage')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->heating_type??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'electricity connection'|| $header == 'branchement électrique')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->electricity_connection??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'living space'||$header == 'espace vital')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->living_space??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'cadstrable plot'|| $header == 'parcelle cadastrable')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->cadstrable_plot??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'floor area'||$header =='surface de plancher')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->floor_area??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'house type'||$header =='type de maison')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->house_type??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'with basement'||$header =='avec sous-sol')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->with_basement??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'owner'||$header =='propriétaire')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->owner??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'house over 15 years'||$header =='maison de plus de 15 ans')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->house_over_15_years??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'date'||$header =='date')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->date??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'duplicate analysis'||$header =='analyse des doublons')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->tracker_name??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'management'||$header =='la gestion')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->management??__('Not Provided') }}</a></td>
                @endif
                @if($header == 'transfer office 17'||$header =='bureau de transfert 17')
                <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->transfer_office_17??__('Not Provided') }}</a></td>
                @endif 
            @endforeach  
            @foreach ($customFilterStatus as $item)
                @php
                    $header_name = \App\Models\LeadCustomField::where('id', $item->header_id)->first()->name;
                @endphp
                <td>
                    <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">
                        @if(getLeadCustomInputValue($lead->id,$header_name)) 
                        {{ getLeadCustomInputValue($lead->id,$header_name)  }}
                        @else
                        {{ __('Not Provided') }}
                        @endif
                    </a>
                </td>
            @endforeach 
            @isset($company_name)
            <td> <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}">{{ $lead->company_name }}</a></td>   
            @endisset
            {{-- <td>
                <textarea name="commentTextarea" id="commentTextarea{{ $lead->id }}" placeholder="{{ __('To write a comment') }}" class="database-table__textarea commentTextareaField" data-id="{{ $lead->id }}">{{ $lead->comment }}</textarea>
            </td> --}}
            <td class="text-left">
                <button style="color:{{ $lead->getStatus->status_color ?? '' }}; background: {{ $lead->getStatus->background_color ?? '' }}" data-toggle="modal" data-lead-id="{{ $lead->id }}" data-target="#userStatusModel" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn pl-2">
                    {{ $lead->getStatus->status ?? __('No Status') }}
                    <span class="novecologie-icon-chevron-right pl-1"></span>
                </button> 
            </td>

            <td>
                <div class="avatar-group d-flex">
                    @if (getLeadAssignee($lead->id)->count() > 3)                       
                        @foreach(getLeadAssignee($lead->id) as $item) 
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a> 
                        @if ($loop->iteration > 3)
                            @if (getLeadAssignee($lead->id)->count() > 4)
                            <a href="#!" class="avatar-group__more">+{{ getLeadAssignee($lead->id)->count() - 4 }} {{ __('more') }}</a>     
                            @endif
                            @break
                        @endif
                        @endforeach 
                    @else
                        @forelse (getLeadAssignee($lead->id) as $item)
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a>
                        @empty
                        {{ __('No assignee') }}
                        @endforelse
                    @endif
                </div> 
            </td>
            <td>
                <div class="d-flex align-items-center justify-content-center action-btns-wrapper">
                     
                    {{-- <div class="dropdown dropdown--custom p-0 d-inline-block">
                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown"> 
                            @if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
                                <button type="button" data-lead-id="{{ $lead->id }}" class="dropdown-item border-0 leadAssigneeButton">
                                    <span class="novecologie-icon-edit mr-1"></span>
                                    {{ __('Assignee') }}
                                </button> 
                            @endif	
                            @if (checkAction(Auth::id(), 'lead', 'delete') || role() == 's_admin') 
                                <form action="{{ route('lead.delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
                                    <button type="submit" class="dropdown-item border-0" id="customSelectDropdown" >
                                        <span class="novecologie-icon-trash mr-1"></span> 
                                        {{ __('Delete') }}
                                    </button> 
                                </form>
                            @endif
                        </div>
                    </div>  --}}
                    @if (checkAction(Auth::id(), 'lead', 'edit') || role() == 's_admin')
                        <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" class="primary-btn primary-btn--blue w-auto d-inline-flex justify-content-center align-items-center rounded px-4">
                            {{ __('Update') }}
                        </a>
                    @endif
                </div>
            </td>
        </tr> 
    @empty
        <tr>
            <td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
        </tr>
    @endforelse 
@endif