<ul class="todo-list mb-0 simple-bar">
    @foreach ($pending_tasks as $task)
    @if (!taskAssign(Auth::id(), $task->id) && role() != 's_admin')
        @continue
    @endif
    @php
        $assignees = \App\Models\CRM\TaskAssign::where('task_id', $task->id)->get();
        $tagg = \App\Models\CRM\TaskTag::where('task_id', $task->id)->get();
        
    @endphp
        <li class="todo-list__items px-3 @if ($pending_tasks->count() == '1')
            pt-5
        @endif">
            <div class="todo-list__items__wrapper d-xl-flex align-items-center justify-content-between">
                <div class="todo-list__items__wrapper__details d-flex align-items-center">
                    {{-- <div class="custom-control custom-checkbox mb-0">
                        <input value="{{ $task->id }}"  type="checkbox"
                        @if (role() != 's_admin') 
                        disabled
                        @endif
                        class="custom-control-input calendar-filter-checkbox taskCheckButton
                        " id="{{ $task->id }}">
                        <label class="custom-control-label" for="{{ $task->id }}"></label>
                    </div>  --}}
                    @if (role() == 's_admin')  
                    <div class="custom-control custom-checkbox mb-0" data-toggle="tooltip" data-placement="top" title="Confirm">
                        <span class="text-success novecologie-icon-check taskConfirmButton" data-task-id="{{ $task->id }}"></span>
                    </div>
                    <div class="custom-control custom-checkbox mb-0" data-toggle="tooltip" data-placement="top" title="Decline">
                        <span class="text-danger novecologie-icon-close taskReassignButton" data-task-id="{{ $task->id }}"></span>
                    </div>
                    @endif
                     
                    <div class="custom-control custom-checkbox mb-0">
                        <span class="novecologie-icon-star " @if ($task->is_important == 1)
                            style="color: #FF9F43"
                        @endif data-task-id="{{ $task->id }}"></span>
                    </div>
                    <p data-id={{ $task->id }} data-toggle="modal" data-target="#rrrightAsideModal" class="todo-title mb-0 ml-2 taskEditModal">{{ $task->title }}</p>
                    @if ($task->getClient->first_name)
                    <p class="todo-title mb-0 ml-5"> <a href="{{ route('client.lead.update', $task->client_id) }}">{{ $task->getClient->first_name }} </a></p>
                    @endif
                </div>
                <div class="todo-list__items__wrapper__info d-flex align-items-center justify-content-between justify-content-xl-center mt-3 mt-xl-0">
                    <div class="badge-wrapper mr-3 flex-shrink-0">
                        {{-- <span class="badge-btn d-inline-block rounded-pill">Team</span> --}}
                        <span class="badge-btn 
                        @if ($task->priority == 'High')
                        badge-btn--danger
                        @elseif ($task->priority == 'Medium')
                        badge-btn--warning
                        @else
                        badge-btn--success  
                        @endif                        
                        d-inline-block rounded-pill">
                        @if ($task->priority == 'High')
                        {{ __('High') }}
                        @elseif ($task->priority == 'Medium')
                        {{ __('Medium') }}
                        @else
                        {{ __('Low') }}  
                        @endif</span>
                        @foreach ($tagg as $tag)
                        <span class="badge-btn badge-btn--{{ $tag->getTag->color }} d-inline-block rounded-pill">{{ $tag->getTag->name }}</span> 
                        @endforeach
                        {{-- <span class="badge-btn badge-btn--info d-inline-block rounded-pill">Update</span>
                        <span class="badge-btn badge-btn--danger d-inline-block rounded-pill">High</span>
                        <span class="badge-btn badge-btn--success d-inline-block rounded-pill">Low</span> --}}
                    </div>
                    <div class="d-flex align-items-center flex-shrink-0">
                        <span class="todo__due-date text-muted mr-2">{{ \Carbon\Carbon::parse($task->created_at)->format('M d') }}</span>
                        @foreach ($assignees as $assignee)
                            @if($assignee->getUser->profile_photo)
                            <div class="todo__avatar rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assignee->getUser->name }}">
                                <img src="{{ asset('uploads/crm/profiles') }}/{{ $assignee->getUser->profile_photo }}" data-toggle="tooltip" data-placement="top" title="{{ $assignee->getUser->name }}" alt="avatar image" class="w-100 h-100">
                            </div>  
                            @else 
                            <div class="todo__avatar rounded-circle overflow-hidden" data-toggle="tooltip" data-placement="top" title="{{ $assignee->getUser->name }}">
                                <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="w-100 h-100">
                            </div> 
                            @endif
                        @endforeach 
                    </div>
                </div>
            </div>
        </li>
    @endforeach 
</ul>
 