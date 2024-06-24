
@php
$filter_status = App\Models\CRM\ProjectHeaderFilter::where('user_id', Auth::id())->orderBy('project_header_id', 'asc')->get();
$x_code = 'empty';
// $project_status = App\Models\CRM\ProjectTableStatus::all();
// dd($project_status[0]);
@endphp 
@if ($filter_status->count()== 0)
    @forelse ($project_status[0] as $project) 
        @if ($x_code != substr($project->postal_code, 0,2))
            <tr>
                <td colspan="500" class="text-white" style="background-color: #000">{{ $project->postal_code ? getDepartment3($project->postal_code). ' '.substr($project->postal_code, 0,2) : __('No Department') }}</td>
            </tr>
        @endif
        <tr>
            <td>
                <div class="custom-control custom-checkbox">
                    <input value="1" type="checkbox" data-project-id="{{ $project->id }}"  class="custom-control-input table-select-checkbox projectCheckboxBtn projectCheckboxBtn__0" id="tableRowSelectCheck-{{ $project->id }}">
                    <label class="custom-control-label" for="tableRowSelectCheck-{{ $project->id }}"></label>
                </div>
            </td>
            <td>{{ $project->id }}</td>
            <td>
                <div>
                    <div class="first-name pl-2">{{ $project->project_name??__('Not Provided') }}<a href="{{ route('files.index', $project->id) }}">
                    </a></div>
                </div>
            </td>
            <td><a href="{{ route('files.index', $project->id) }}">{{ $project->first_name??__('Not Provided') }}</a></td>
            <td><a href="{{ route('files.index', $project->id) }}">{{ $project->phone??__('Not Provided') }}</a></td>
            <td><a href="{{ route('files.index', $project->id) }}">{{ $project->email??__('Not Provided') }}</a></td>
            <td><a href="{{ route('files.index', $project->id) }}">{{ $project->postal_code??__('Not Provided') }}</a></td> 
            <td>
                <div class="d-flex align-items-center"> 
                    <textarea name="commentTextarea" id="commentTextarea{{ $project->id }}" placeholder="{{ __('To write a comment') }}" class="database-table__textarea commentTextareaField" data-id="{{ $project->id }}">{{ $project->comment }}</textarea>
                </div>
            </td> 
            <td class="text-left">
                <button style="color:{{ $project->getStatus->status_color ?? '' }}; background: {{ $project->getStatus->background_color ?? '' }}" data-toggle="modal" data-project-id="{{ $project->id }}" data-target="#userStatusModel" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn">
                    {{ $project->getStatus->status ?? __('No Status') }}
                    <span class="novecologie-icon-chevron-right pl-1"></span>
                </button> 
            </td>
            <td>
                <div class="avatar-group d-flex">
                    @if (getProjectAssignee($project->id)->count() > 3)                       
                        @foreach(getProjectAssignee($project->id) as $item) 
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a> 
                        @if ($loop->iteration > 3)
                            @if (getProjectAssignee($project->id)->count() > 4)
                            <a href="#!" class="avatar-group__more">+{{ getProjectAssignee($project->id)->count() - 4 }} {{ __('more') }}</a>     
                            @endif
                            @break
                        @endif
                        @endforeach 
                    @else
                        @forelse (getProjectAssignee($project->id) as $item)
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
                <div class="d-flex align-items-center justify-content-center">
            
                @if (checkAction(Auth::id(), 'project', 'edit') || role() == 's_admin') 
                <a href="{{ route('files.index', $project->id) }}" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle">
                    <span class="novecologie-icon-chevron-right"></span>
                </a> 
                @endif
                <div class="dropdown dropdown--custom p-0 d-inline-block">
                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                        @if (checkAction(Auth::id(), 'project', 'assign') || role() == 's_admin')
                        <button  data-toggle="modal" data-target="#projectAssign{{ $project->id }}" type="button" class="dropdown-item border-0">
                            <span class="novecologie-icon-edit mr-1"></span>
                            {{ __('Assignee') }}
                        </button>
                        @endif
                        @if (checkAction(Auth::id(), 'project', 'delete') || role() == 's_admin') 
                        <form action="{{ route('project.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
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
        @php
            $x_code = substr($project->postal_code, 0,2);
        @endphp
    @empty 
    <tr>
        <td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
    </tr>
    @endforelse 
@else
    @forelse ($project_status[0] as $project) 
        @if ($x_code != substr($project->postal_code, 0,2))
            <tr>
                <td colspan="500" class="text-white" style="background-color: #000">{{ $project->postal_code ? getDepartment3($project->postal_code). ' '.substr($project->postal_code, 0,2) : __('No Department') }}</td>
            </tr>
        @endif
        <tr>
            <td>
                <div class="custom-control custom-checkbox">
                    <input value="1" type="checkbox" data-project-id="{{ $project->id }}" class="custom-control-input table-select-checkbox projectCheckboxBtn projectCheckboxBtn__0" id="tableRowSelectCheck-{{ $project->id }}">
                    <label class="custom-control-label" for="tableRowSelectCheck-{{ $project->id }}"></label>
                </div>
            </td>

            @foreach ($filter_status as $item)
                @php
                    $header = \App\Models\CRM\ProjectHeader::where('id', $item->project_header_id)->first()->header;  
                @endphp
                @if($header == 'ID')
                <td>{{ $project->id??__('Not Provided') }}</td>
                @endif
                @if($header == 'project name' || $header == 'nom du projet')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->project_name??__('Not Provided') }}
                    </a>
                </td>
                @endif
                @if($header == 'first name'|| $header == 'prénom')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->first_name??__('Not Provided') }}
                    </a>
                </td>
                @endif
                @if($header == 'last name'||$header =='nom de famille')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->last_name??__('Not Provided') }}
                    </a>
                </td>
                @endif
                @if($header == 'phone'||$header =='téléphone')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->phone??__('Not Provided') }}
                    </a>
                </td>
                @endif
                @if($header == 'email'||$header =='e-mail')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->email??__('Not Provided') }}
                    </a>
                </td>
                @endif
                @if($header == 'country'||$header =='pays')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->pays??__('Not Provided') }}
                    </a>
                </td>
                @endif
                @if($header == 'postal code'||$header == 'code postal')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->postal_code??__('Not Provided') }}
                    </a>
                </td>
                @endif 
                @if($header == 'zone'||$header == 'zone')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->zone??__('Not Provided') }}
                    </a>
                </td>
                @endif 
                @if($header == 'city'||$header == 'ville')
                <td> 
                    <a href="{{ route('files.index', $project->id) }}">
                        {{ $project->city??__('Not Provided') }}
                    </a>
                </td>
                @endif    
            @endforeach 
            <td>
                <div class="d-flex align-items-center"> 
                    <textarea name="commentTextarea" id="commentTextarea{{ $project->id }}" placeholder="{{ __('To write a comment') }}" class="database-table__textarea commentTextareaField" data-id="{{ $project->id }}">{{ $project->comment }}</textarea> 
                </div>
            </td> 
            <td class="text-left">
                <button style="color:{{ $project->getStatus->status_color ?? '' }}; background: {{ $project->getStatus->background_color ?? '' }}" data-toggle="modal" data-project-id="{{ $project->id }}" data-target="#userStatusModel" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn">
                    {{ $project->getStatus->status ?? __('No Status') }}
                    <span class="novecologie-icon-chevron-right pl-1"></span>
                </button> 
            </td>
            <td>
                <div class="avatar-group d-flex">
                    @if (getProjectAssignee($project->id)->count() > 3)                       
                        @foreach(getProjectAssignee($project->id) as $item) 
                        <a href="#!" class="avatar-group__image-wrapper rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($item->user_id)->name }}">
                            @if (getAssigneePhoto($item->user_id)->profile_photo)
                            <img src="{{ asset('uploads/crm/profiles') }}/{{ getAssigneePhoto($item->user_id)->profile_photo }}" alt="{{ getAssigneePhoto($item->user_id)->name }}" class="avatar-group__image w-100 h-100">
                            @else
                            <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100">
                            @endif
                        </a> 
                        @if ($loop->iteration > 3)
                            @if (getProjectAssignee($project->id)->count() > 4)
                            <a href="#!" class="avatar-group__more">+{{ getProjectAssignee($project->id)->count() - 4 }} {{ __('more') }}</a>     
                            @endif
                            @break
                        @endif
                        @endforeach 
                    @else
                        @forelse (getProjectAssignee($project->id) as $item)
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
                <div class="d-flex align-items-center justify-content-around">
                    @if (checkAction(Auth::id(), 'project', 'edit') || role() == 's_admin') 
                    <a href="{{ route('files.index', $project->id) }}" class="next-btn d-inline-flex justify-content-center align-items-center rounded-circle">
                        <span class="novecologie-icon-chevron-right"></span>
                    </a> 
                    @endif
                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                            @if (checkAction(Auth::id(), 'project', 'assign') || role() == 's_admin')
                            <button  data-toggle="modal" data-target="#projectAssign{{ $project->id }}" type="button" class="dropdown-item border-0">
                                <span class="novecologie-icon-edit mr-1"></span>
                                {{ __('Assignee') }}
                            </button>
                            @endif
                            @if (checkAction(Auth::id(), 'project', 'delete') || role() == 's_admin') 
                            <form action="{{ route('project.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="project_id" value="{{ $project->id }}">
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
        @php
            $x_code = substr($project->postal_code, 0,2);
        @endphp
    @empty 
    <tr>
        <td colspan="100" class="text-center"> <h3>Aucune donnée trouvée</h3></td>
    </tr>
    @endforelse

@endif 