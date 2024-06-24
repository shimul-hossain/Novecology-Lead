@if ($filter_status->count()== 0)
@foreach ($projects as $project)
@if ($project->user_status != $item_data->id)
   @continue 
@endif
    @if (role() != 's_admin')
        @if (!getProjectAccess(Auth::id(), $project->id))
            @continue
        @endif
    @endif

    
<tr>
    <td>
        <div class="custom-control custom-checkbox">
            <input value="1" type="checkbox" data-project-id="{{ $project->id }}"  class="custom-control-input table-select-checkbox" id="tableRowSelectCheck-{{ $project->id }}">
            <label class="custom-control-label" for="tableRowSelectCheck-{{ $project->id }}"></label>
        </div>
    </td>
    <td>{{ $project->id }}</td>
    <td>
        <div>
            <div class="first-name pl-2">{{ $project->project_name }}</div>
        </div>
    </td>
    <td> {{ $project->first_name }}</td>
    <td>{{ $project->phone }}</td>
    <td>{{ $project->email }}</td>
    <td>{{ $project->postal_code }}</td> 
    <td>
        <div class="d-flex align-items-center"> 
            <textarea name="commentTextarea" id="commentTextarea{{ $project->id }}" placeholder="{{ __('To write a comment') }}" class="database-table__textarea commentTextareaField" data-id="{{ $project->id }}">{{ $project->comment }}</textarea>
        </div>
    </td> 
    <td class="text-left">
        <button style="color:{{ $project->getStatus->status_color ?? '' }}; background: {{ $project->getStatus->background_color ?? '' }}" data-toggle="modal" data-project-id="{{ $project->id }}" data-target="#userStatusModel" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn pl-2">
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
@endforeach 
@else
@foreach ($projects as $project)
@if ($project->user_status != $item_data->id)
   @continue 
@endif
@if (role() != 's_admin')
    @if (!getProjectAccess(Auth::id(), $project->id))
        @continue
    @endif
@endif
<tr>
    <td>
        <div class="custom-control custom-checkbox">
            <input value="1" type="checkbox" data-project-id="{{ $project->id }}" class="custom-control-input table-select-checkbox clientCheckboxBtn" id="tableRowSelectCheck-{{ $project->id }}">
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
        @if($header == 'Project name' || $header == 'Nom du projet')
        <td>{{ $project->project_name??__('Not Provided') }}</td>
        @endif
        @if($header == 'first name'|| $header == 'prénom')
        <td>{{ $project->first_name??__('Not Provided') }}</td>
        @endif
        @if($header == 'last name'||$header =='nom de famille')
        <td>{{ $project->last_name??__('Not Provided') }}</td>
        @endif
        @if($header == 'phone'||$header =='téléphone')
        <td>{{ $project->phone??__('Not Provided') }}</td>
        @endif
        @if($header == 'email'||$header =='e-mail')
        <td>{{ $project->email??__('Not Provided') }}</td>
        @endif
        @if($header == 'country'||$header =='pays')
        <td>{{ $project->pays??__('Not Provided') }}</td>
        @endif
        @if($header == 'postal code'||$header == 'code postal')
        <td>{{ $project->postal_code??__('Not Provided') }}</td>
        @endif 
        @if($header == 'zone'||$header == 'zone')
        <td>{{ $project->zone??__('Not Provided') }}</td>
        @endif 
        @if($header == 'city'||$header == 'ville')
        <td>{{ $project->city??__('Not Provided') }}</td>
        @endif    
    @endforeach 
    <td>
        <div class="d-flex align-items-center"> 
            <textarea name="commentTextarea" id="commentTextarea{{ $project->id }}" placeholder="{{ __('To write a comment') }}" class="database-table__textarea commentTextareaField" data-id="{{ $project->id }}">{{ $project->comment }}</textarea> 
        </div>
    </td> 
    <td class="text-left">
        <button style="color:{{ $project->getStatus->status_color ?? '' }}; background: {{ $project->getStatus->background_color ?? '' }}" data-toggle="modal" data-project-id="{{ $project->id }}" data-target="#userStatusModel" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 user_status_btn pl-2">
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
@endforeach

@endif 