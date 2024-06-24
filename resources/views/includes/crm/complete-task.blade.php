<ul class="todo-list mb-0 simple-bar">
    @foreach ($complete_tasks as $task)
    @if (!taskAssign(Auth::id(), $task->id) && role() != 's_admin')
        @continue
    @endif
    @php
        $assignees = \App\Models\CRM\TaskAssign::where('task_id', $task->id)->get();
        $tagg = \App\Models\CRM\TaskTag::where('task_id', $task->id)->get();
    @endphp
        <li class="todo-list__items px-3 @if ($complete_tasks->count() == '1')
            pt-5
        @endif ">
            <div class="todo-list__items__wrapper d-xl-flex align-items-center justify-content-between">
                <div class="todo-list__items__wrapper__details d-flex align-items-center">
                    <div class="custom-control custom-checkbox mb-0">
                        <input value="{{ $task->id }}" type="checkbox" disabled checked class="custom-control-input calendar-filter-checkbox" id="{{ $task->id }}">
                        <label class="custom-control-label" for="{{ $task->id }}"></label>
                    </div>
                    <div class="custom-control custom-checkbox mb-0">
                        <span class="novecologie-icon-star taskImportantButton"  @if ($task->is_important == 1)
                            style="color: #FF9F43"
                        @endif data-task-id="{{ $task->id }}"></span>
                    </div>
                    <p  data-toggle="modal" data-id={{ $task->id }} data-target="#rrrightAsideModal" class="todo-title mb-0 ml-2 taskEditModal">{{ $task->title }}</p>
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
                                <img src="{{ asset('uploads/crm/profiles') }}/{{ $assignee->getUser->profile_photo }}"  alt="avatar image" class="w-100 h-100">
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
{{-- @foreach ($complete_tasks as $task)
<div class="modal rightAsideModal fade" id="rrrightAsideModal{{ $task->id }}" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
    <div class="modal-dialog m-0 h-100 bg-white">
        <div class="modal-content border-0 h-100 rounded-0 simple-bar">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <h1 class="modal-title text-center">Add Task</h1>
                <form action="#!" class="form" id="addEventForm">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" name="title" id="title{{ $task->id }}" value="{{ $task->title }}" class="form-control shadow-none" placeholder="Event Title">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="select">Assignee</label>
                                <select class="select2_select_option selectElement wide" id="user_id{{ $task->id }}" name="user_id[]" multiple required>
                                    @foreach ($users as $user)
                                    @if (taskAssign($user->id, $task->id))
                                    <option selected value="{{ $user->id }}">{{ $user->name }}</option>
                                    @else
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="endDate">Due Date</label>
                                <input type="datetime-local" value="{{ $task->due_date }}" id="endDate{{ $task->id }}" class="flatpickr form-control shadow-none bg-transparent" placeholder="Select End date">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="client">Client</label>
                                <select class="selectElement wide" name="client_id" id="client_id{{ $task->id }}"  required>
                                    <option value="">Select</option>
                                    @foreach ($clients as $client)
                                        @if ($client->id == $task->client_id)
                                        <option selected value="{{ $client->id }}">{{ $client->first_name }}</option>
                                        @else
                                        <option value="{{ $client->id }}">{{ $client->first_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="select">Priority</label>
                                <select class="selectElement wide" id="priority{{ $task->id }}">
                                    <option value="">Select</option>
                                    <option @if ($task->priority == 'High')
                                        selected
                                    @endif value="High">High</option>
                                    <option @if ($task->priority == 'Medium')
                                        selected
                                    @endif value="Medium">Medium</option>
                                    <option @if ($task->priority == 'Low')
                                        selected
                                    @endif value="Low">Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label class="form-label" for="select">Tags</label>
                                <select class="select2_select_option selectElement wide" id="task_tags{{ $task->id }}" name="tag_id[]" multiple required>
                                    @foreach ($tags as $tag)
                                    @if (getTaskTag($tag->id, $task->id))
                                    <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endif
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <textarea type="text" id="description{{ $task->id }}" class="form-control shadow-none">{{ $task->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button  type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" >Add</button>
                            <button type="submit" class="outline-btn mb-2">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach --}}
