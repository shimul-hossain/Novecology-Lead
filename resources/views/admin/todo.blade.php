{{-- Main Layouts  --}}
@extends('layouts.master')

{{-- title part  --}}
@section('title')
{{ __('To Do') }}
@endsection



{{-- Active Menu  --}}
@section('todoIndex')
    active
@endsection




@section('bodyBg')
secondary-bg
@endsection




@push("css")
<style>
    .nav-pills .badge{
        width: 20px;
        height: 20px;
        font-size: 10px;
        line-height: 0;
    }
</style>

@endpush

@section('content')

	<!-- Todo Section -->
    <section class="py-4 todo-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-white rounded-lg shadow-sm border px-3">
                        <div class="row">
                            <div class="col-lg-2 border-right py-3">
                                @if (checkAction(Auth::id(), 'todo', 'add task') || role() == 's_admin')
                                <div class="text-center">
                                    <button data-toggle="modal" data-target="#rightAsideModal" type="button" class="addEvent-btn primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">{{ __('Add Task') }}</button>
                                </div>
                                @endif
                                @if (checkAction(Auth::id(), 'todo', 'add tags') || role() == 's_admin')
                                <div class="text-center mt-2">
                                    <button data-toggle="modal" data-target="#leftAsideModal" type="button" class="addEvent-btn primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0">{{ __('Add Tag') }}</button>
                                </div>
                                @endif
                                <div class="nav task-filter-pills flex-column nav-pills my-3" id="task-filter-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link bg-transparent position-relative d-flex align-items-center active" id="v-pills-task-tab" data-toggle="pill" href="#v-pills-task" role="tab" aria-controls="v-pills-task" aria-selected="true">
                                        <span class="novecologie-icon-envelope"></span>
                                        <span class="ml-2">{{ __('My Task') }}</span>
                                        <small class="badge d-inline-flex align-items-center justify-content-center ml-auto rounded-circle badge-primary" id="my_Task">{{ $my_Task_count }}</small>
                                    </a>
                                    <a class="nav-link bg-transparent position-relative d-flex align-items-center" id="v-pills-important-tab" data-toggle="pill" href="#v-pills-important" role="tab" aria-controls="v-pills-important" aria-selected="false">
                                        <span class="novecologie-icon-star"></span>
                                        <span class="ml-2">{{ __('Important') }}</span>
                                        <small class="badge d-inline-flex align-items-center justify-content-center ml-auto rounded-circle badge-info" id="important_Task">{{ $important_Task_count }}</small>

                                    </a>
                                    <a class="nav-link bg-transparent position-relative d-flex align-items-center" id="v-pills-pending-tab" data-toggle="pill" href="#v-pills-pending" role="tab" aria-controls="v-pills-pending" aria-selected="false">
                                        <span class="novecologie-icon-clock"></span>
                                        <span class="ml-2">{{ __('Awaiting For Approval') }}</span>
                                        <small class="badge d-inline-flex align-items-center justify-content-center ml-auto rounded-circle badge-warning" id="pending_Task">{{ $pending_Task_count }}</small>
                                    </a>
                                    <a class="nav-link bg-transparent position-relative d-flex align-items-center" id="v-pills-completed-tab" data-toggle="pill" href="#v-pills-completed" role="tab" aria-controls="v-pills-completed" aria-selected="false">
                                        <span class="novecologie-icon-check"></span>
                                        <span class="ml-2">{{ __('Completed') }}</span>
                                        <small class="badge d-inline-flex align-items-center justify-content-center ml-auto rounded-circle badge-success" id="completed_Task">{{ $completed_Task_count }}</small>
                                    </a>
                                    <a class="nav-link bg-transparent position-relative d-flex align-items-center" id="v-pills-deleted-tab" data-toggle="pill" href="#v-pills-deleted" role="tab" aria-controls="v-pills-deleted" aria-selected="false">
                                        <span class="novecologie-icon-trash"></span>
                                        <span class="ml-2">{{ __('Deleted') }}</span>
                                        <small class="badge d-inline-flex align-items-center justify-content-center ml-auto rounded-circle badge-danger" id="deleted_Task">{{ $deleted_Task_count }}</small>
                                    </a>
                                </div>
                                {{-- <div class="text-left">
                                    <span>{{ __('PRIORITY') }}</span>
                                </div>
                                <div class="nav task-filter-pills flex-column nav-pills my-3" id="task-filter-tab" role="tablist" aria-orientation="vertical">
                                    <a data-priority="All" class="nav-link bg-transparent position-relative priority_filter_btn active" data-toggle="pill" href="#!"  role="tab"  aria-selected="true">
                                        <span class="ml-2">{{ __('All') }}</span>
                                    </a>
                                    <a data-priority="Low" class="nav-link bg-transparent position-relative priority_filter_btn" data-toggle="pill"  href="#!"  role="tab"  aria-selected="false">
                                        <span class="ml-2">{{ __('Low') }}</span>
                                    </a>
                                    <a data-priority="Medium" class="nav-link bg-transparent position-relative priority_filter_btn" data-toggle="pill"  href="#!"  role="tab"  aria-selected="false">

                                        <span class="ml-2">{{ __('Medium') }}</span>
                                    </a>
                                    <a data-priority="High" class="nav-link bg-transparent position-relative priority_filter_btn" data-toggle="pill"  href="#!"  role="tab"  aria-selected="false">

                                        <span class="ml-2">{{ __('High') }}</span>
                                    </a>
                                </div> --}}
                                <div class="text-left">
                                    <span>{{ __('Tags') }}</span>
                                </div>
                                <div class="nav task-filter-pills flex-column nav-pills my-3" id="task-filter-tab" role="tablist" aria-orientation="vertical">
                                    <a data-tag-id="All" class="nav-link bg-transparent position-relative tag_filter_btn active" data-toggle="pill" href="#!">
                                        <span class="ml-2">{{ __('All') }}</span>
                                    </a>
                                    @foreach ($tags as $tag)
                                    <a data-tag-id="{{ $tag->id }}" class="nav-link bg-transparent position-relative tag_filter_btn" data-toggle="pill" href="#!">
                                        <span class="ml-2">{{ $tag->name }}</span>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="form-group d-flex align-items-center mb-0 border-bottom border-top border-top-lg-0 w-100 px-3">
                                        <button type="submit" class="btn bg-transparent border-0 shadow-none">
                                            <span class="novecologie-icon-search"></span>
                                        </button>
                                        <input type="search" name="search" class="form-control bg-transparent shadow-none border-0 pl-0" id="search">
                                        {{-- <div class="dropdown dropdown--custom p-0 d-inline-block">
                                            <button type="button" class="btn shadow-none actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                <button type="button" class="dropdown-item border-0">Sort A - Z</button>
                                                <button type="button" class="dropdown-item border-0">Sort Z - A</button>
                                                <button type="button" class="dropdown-item border-0">Sort Assignee</button>
                                                <button type="button" class="dropdown-item border-0">Sort Due Date</button>
                                                <button type="button" class="dropdown-item border-0">Sort Today</button>
                                                <button type="button" class="dropdown-item border-0">Sort 1 Week</button>
                                                <button type="button" class="dropdown-item border-0">Sort 2 Week</button>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="tab-content shadow-none w-100" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-task" role="tabpanel" aria-labelledby="v-pills-task-tab">
                                            <div class="todo-wrapper" id="allTask">
                                                @include('includes.crm.all-task')
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-important" role="tabpanel" aria-labelledby="v-pills-important-tab">
                                            <div class="todo-wrapper" id="importantTask">
                                                @include('includes.crm.important-task')
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-pending" role="tabpanel" aria-labelledby="v-pills-pending-tab">
                                            <div class="todo-wrapper" id="pendingTask">
                                                @include('includes.crm.pending-task')
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-completed" role="tabpanel" aria-labelledby="v-pills-completed-tab">
                                            <div class="todo-wrapper" id="completedTask">
                                                @include('includes.crm.complete-task')
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-deleted" role="tabpanel" aria-labelledby="v-pills-deleted-tab">
                                            <div class="todo-wrapper" id="deletedTask">
                                                @include('includes.crm.deleted-task')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Right Aside Modal -->
    <div class="modal rightAsideModal modal--aside fade" id="rightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center">{{ __('Add Task') }}</h1>
                    <form action="#!" class="form" id="addEventForm">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="title">{{ __('Title') }}  <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control shadow-none" placeholder="{{ __('Task Title') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="select">{{ __('Assignee') }}  <span class="text-danger">*</span></label>
                                    <select class="select2_select_option selectElement wide" id="user_id" name="user_id[]" multiple required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <select class="selectElement wide" id="select">
                                        <option data-display="Select">Select</option>
                                        <option value="validate">Validate</option>
                                        <option value="invalidate">invalidate</option>
                                        <option value="toEnd">To End</option>
                                        <option value="etc">ETC</option>
                                    </select> --}}
                                </div>
                                {{-- <div class="form-group d-flex flex-column align-items-center position-relative" id="bu" >
                                    <input type="hidden" name="lead_id" id="lead_id_assignee">
                                    <select class="select2_select_option form-control w-100" name="user_id[]" multiple required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                                </div> --}}
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="endDate">{{ __('Due Date') }}  <span class="text-danger">*</span></label>
                                    <input type="datetime-local" id="endDate" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select End date') }}">
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">All Day</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="client">{{ __('Client') }}  <span class="text-danger">*</span></label>
                                    <select class="selectElement wide" name="client_id" id="client_id"  required>
                                        <option value="">{{ __('Select') }}</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="select">{{ __('Priority') }}  <span class="text-danger">*</span></label>
                                    <select class="selectElement wide" id="priority">
                                        <option value="">{{ __('Select') }}</option>
                                        <option value="High">{{ __('High') }}</option>
                                        <option value="Medium">{{ __('Medium') }}</option>
                                        <option value="Low">{{ __('Low') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="select">{{ __('Tags') }}  <span class="text-danger">*</span></label>
                                    <select class="select2_select_option selectElement wide" id="task_tags" name="tag_id[]" multiple required>
                                        @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="location">Location</label>
                                    <input type="text" id="location" class="form-control shadow-none" placeholder="Enter Location">
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">{{ __('Description') }}  <span class="text-danger">*</span></label>
                                    <textarea type="text" id="description" class="form-control shadow-none"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button id="addTaskBtn" type="button" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" >{{ __('Add') }}</button>
                                {{-- <button type="submit" class="outline-btn mb-2">Reset</button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal rightAsideModal fade" id="rrrightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content border-0 h-100 rounded-0 simple-bar">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 class="modal-title text-center">{{ __('Update Task') }}</h1>
                    <form action="#!" class="form" id="addEventForm">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="title">{{ __('Title') }}  <span class="text-danger">*</span></label>
                                    <input type="hidden" name="task_id" id="task_id">
                                    <input type="text" name="title" id="title_update" value="" class="form-control shadow-none" placeholder="{{ __('Task Title') }}">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="select">{{ __('Assignee') }}  <span class="text-danger">*</span></label>
                                    <select class="select2_select_option selectElement wide" id="user_id_update" name="user_id[]" multiple required>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="endDate">{{ __('Due Date') }} <span class="text-danger">*</span></label>
                                    <input type="datetime-local"  id="endDate_update" class="form-control shadow-none bg-transparent flatpickr">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="client">{{ __('Client') }} <span class="text-danger">*</span></label>
                                    <select class="select2_select_option selectElement wide" name="client_id" id="client_id_update"  required>

                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="select">{{ __('Priority') }} <span class="text-danger">*</span></label>
                                    <select class="select2_select_option selectElement wide" id="priority_update">

                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="select">{{ __('Tags') }} <span class="text-danger">*</span></label>
                                    <select class="select2_select_option selectElement wide" id="tag_id_update" name="tag_id[]" multiple required>

                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">{{ __('Description') }} <span class="text-danger">*</span></label>
                                    <textarea type="text" id="description_update" class="form-control shadow-none"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                @if (checkAction(Auth::id(), 'todo', 'edit') || role() == 's_admin')
                                <button  type="button" id="taskUpdateBtn" class="secondary-btn secondary-btn--primary border-0 mb-2 mr-2" >{{ __('Update') }}</button>
                                @endif

                                @if (checkAction(Auth::id(), 'todo', 'delete') || role() == 's_admin')
                                <button type="button" id="taskDeleteBtn" class="outline-btn mb-2">{{ __('Delete') }}</button>
                                <button type="button" id="taskRestoreBtn" class="outline-btn mb-2 d-none">{{ __('Restore') }}</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal--aside fade leftAsideModal" id="leftAsideModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
        <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Add Tag') }}</h1>
                    <form action="{{ route('task.tag.store') }}" class="form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" id="tagId" name="name" class="form-control shadow-none" placeholder="{{ __('Tag Name') }} *" required>
                                    <input type="hidden" id="existing_tag_id" name="existing_tag_id" value="">
                                    @error('name')
                                        <span class="alert text-danger">{{ $message }} **</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="shadow-none custom-select form-control  " id="selectColor" name="color" required>
                                        <option data-display="Select Colour" value="">{{ __('Select Color') }}*</option>
                                        <option class="selectColor" value="primary">Primary</option>
                                        <option class="selectColor" value="secondary">Secondary</option>
                                        <option class="selectColor" value="success">Success</option>
                                        <option class="selectColor" value="danger">danger</option>
                                        <option class="selectColor" value="info">info</option>
                                        <option class="selectColor" value="warning">warning</option>
                                        <option class="selectColor" value="light">Light</option>
                                        <option class="selectColor" value="dark">Dark</option>

                                        {{-- <option class="selectColor" value="event--purple">purple</option>
                                        <option class="selectColor" value="event--cyan">cyan</option>
                                        <option class="selectColor" value="event--pest">Pest</option>
                                        <option class="selectColor" value="event--pink">pink</option>
                                        <option class="selectColor" value="event--light-green">light green</option>
                                        <option class="selectColor" value="event--dark-green">dark green</option>
                                        <option class="selectColor" value="event--charleston-green">charleston green</option>
                                        <option class="selectColor" value="event--magenta">magenta</option>
                                        <option class="selectColor" value="event--darken">darken</option>
                                        <option class="selectColor" value="event--teal">teal</option>
                                        <option class="selectColor" value="event--light-blue">light blue</option>
                                        <option class="selectColor" value="event--blue">blue</option>
                                        <option class="selectColor" value="event--dark-blue">dark blue</option>
                                        <option class="selectColor" value="event--dark-orange">dark orange</option>
                                        <option class="selectColor" value="event--majorelle-blue">majorelle blue</option>
                                        <option class="selectColor" value="event--dark-slate-blue">dark-slate blue</option>
                                        <option class="selectColor" value="event--rosy-brown">rosy brown</option>
                                        <option class="selectColor" value="event--camel">camel</option>
                                        <option class="selectColor" value="event--black-coral">black coral</option>
                                        <option class="selectColor" value="event--dark-purple">dark purple</option>
                                        <option class="selectColor" value="event--dark-goldenrod">dark goldenrod</option>
                                        <option class="selectColor" value="event--davys-grey">davys grey</option>
                                        <option class="selectColor" value="event--key-lime">key lime</option>
                                        <option class="selectColor" value="event--yellow">yellow</option>
                                        <option class="selectColor" value="event--alabaster">alabaster</option>
                                        <option class="selectColor" value="event--antique-ruby">antique ruby</option>
                                        <option class="selectColor" value="event--russian-violet">russian violet</option>
                                        <option class="selectColor" value="event--charcoal">charcoal</option>
                                        <option class="selectColor" value="event--cadet">cadet</option>
                                        <option class="selectColor" value="event--feldgrau">feldgrau</option>
                                        <option class="selectColor" value="event--russian-green">russian green</option>
                                        <option class="selectColor" value="event--dark-lava">dark-lava</option>
                                        <option class="selectColor" value="event--lilac-luster">lilac luster</option>
                                        <option class="selectColor" value="event--tart-orange">tart orange</option>
                                        <option class="selectColor" value="event--true-blue">true blue</option>
                                        <option class="selectColor" value="event--chocolate-traditional">chocolate traditional</option>
                                        <option class="selectColor" value="event--queen-blue">queen blue</option>
                                        <option class="selectColor" value="event--yellow-green">yellow green</option>
                                        <option class="selectColor" value="event--popstar">popstar</option>
                                        <option class="selectColor" value="event--opal">opal</option>
                                        <option class="selectColor" value="event--gainsboro">gainsboro</option>
                                        <option class="selectColor" value="event--sea-green-crayola">sea green crayola</option>
                                        <option class="selectColor" value="event--orange-yellow-crayola">orange yellow crayola</option>
                                        <option class="selectColor" value="event--lemon-meringue">lemon meringue</option>
                                        <option class="selectColor" value="event--tea-green">tea green</option> --}}
                                    </select>
                                    @error('color')
                                        <span class="alert text-danger">{{ $message }} **</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button id="updatedtagButton" type="submit" class="primary-btn primary-btn--primary primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0 mt-3">{{ __('Add') }} </button>
                            </div>
                        </div>
                    </form>
                    <h1 class="modal-title text-center my-5">{{ __('All Tags') }}</h1>
                    <div class="col-12 px-3">
                        <div class="database-table-wrapper bg-white border">
                            <div class="table-responsive simple-bar">
                                <table class="table database-table w-100 mb-0">
                                    <thead class="database-table__header">
                                        <tr>
                                            <th>{{ __('Serial') }}</th>
                                            <th>{{ __('Tag Name') }}</th>
                                            <th>{{ __('Color Name') }}</th>
                                            <th class="text-center">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="database-table__body">
                                        @foreach ($tags as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td id="tagName{{ $item->id }}">{{ $item->name }}</td>
                                                <td id="tagColor{{ $item->id }}">{{ $item->color }}</td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                            <button data-id="{{ $item->id }}" type="button" class="dropdown-item border-0 edittasktag">
                                                                <span class="novecologie-icon-edit mr-1"></span>
                                                                {{ __('Edit') }}
                                                            </button>
                                                            <form action="{{ route('task.tag.delete') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="task_tag_id" value="{{ $item->id }}">
                                                                <button type="submit" class="dropdown-item border-0">
                                                                    <span class="novecologie-icon-trash mr-1"></span>
                                                                        {{ __('Delete') }}
                                                                </button>
                                                            </form>
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
            </div>
        </div>
    </div>
@endsection

@push('js')

<script>
		$(".flatpickr").flatpickr({
			altInput: true,
			enableTime: true,
			altFormat: "d-m-Y",
			dateFormat: "Y-m-d",
		});
		$(document).ready(function() {
			$('select').niceSelect();
            $('#selectColor').niceSelect('destroy');
		});

		// $(".todo-list__items").on("click", function () {
		// 	if( $('.custom-control:hover').length > 0){
		// 		$("#rightAsideModal").removeClass("show")
		// 	}else{
		// 		// $(".addEvent-btn").click()
		// 	}
		// });

        $('#addTaskBtn').click(function(){
             var title = $('#title').val();
             var user_id = $('#user_id').val();
             var endDate = $('#endDate').val();
             var client_id = $('#client_id').val();
             var priority = $('#priority').val();
             var task_tags = $('#task_tags').val();
             var description = $('#description').val();

            if(title == ''){
                $('#errorMessage').text("{{ __('Please Enter title') }}");
				$('.toast.toast--error').toast('show');
                $('#title').focus();
            }
            else if(user_id == null){
                $('#errorMessage').text("{{ __('Please Select Assignee') }}");
				$('.toast.toast--error').toast('show');
                $('#user_id').focus();
            }
            else if(endDate == ''){
                $('#errorMessage').text("{{ __('Please Select Due Date') }}");
				$('.toast.toast--error').toast('show');
                $('#endDate').focus();
            }
            else if(client_id == ''){
                $('#errorMessage').text("{{ __('Please Select Client') }}");
				$('.toast.toast--error').toast('show');
                $('#client_id').focus();
            }

            else if(priority == ''){
                $('#errorMessage').text("{{ __('Please Select Priority') }}");
				$('.toast.toast--error').toast('show');
                $('#priority').focus();
            }
            else if(task_tags == null){
                $('#errorMessage').text("{{ __('Please Select Tags') }}");
				$('.toast.toast--error').toast('show');
                $('#task_tags').focus();
            }
            else if(description == ''){
                $('#errorMessage').text("{{ __('Please Enter Description') }}");
				$('.toast.toast--error').toast('show');
                $('#description').focus();
            }


            else{
                $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('add.task') }}",
					data: {

						title 		    : title,
						assignee 		: user_id,
						due_date 		: endDate,
						client_id 		: client_id,
						priority 	    : priority,
						tags 	        : task_tags,
						description 	: description,

					},
					success: function(data){
                        $('#addEventForm').trigger('reset');
                        $('#rightAsideModal').modal('hide');

                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#notificationCount').text(data.count);
						$('#notificationList').html(data.response);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);

                        $('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
            }
        });

        $('#taskUpdateBtn').click(function(){

             var task_id        = $('#task_id').val();
             var title          = $('#title_update').val();
             var user_id        = $('#user_id_update').val();
             var endDate        = $('#endDate_update').val();
             var client_id      = $('#client_id_update').val();
             var priority       = $('#priority_update').val();
             var task_tags      = $('#tag_id_update').val();
             var description    = $('#description_update').val();

            if(title == ''){
                $('#errorMessage').text("{{ __('Please Enter title') }}");
				$('.toast.toast--error').toast('show');
                $('#title').focus();
            }
            else if(user_id == null){
                $('#errorMessage').text("{{ __('Please Select Assignee') }}");
				$('.toast.toast--error').toast('show');
                $('#user_id').focus();
            }
            else if(endDate == ''){
                $('#errorMessage').text("{{ __('Please Select Due Date') }}");
				$('.toast.toast--error').toast('show');
                $('#endDate').focus();
            }
            else if(client_id == ''){
                $('#errorMessage').text("{{ __('Please Select Client') }}");
				$('.toast.toast--error').toast('show');
                $('#client_id').focus();
            }

            else if(priority == ''){
                $('#errorMessage').text("{{ __('Please Select Priority') }}");
				$('.toast.toast--error').toast('show');
                $('#priority').focus();
            }
            else if(task_tags == null){
                $('#errorMessage').text("{{ __('Please Select Tags') }}");
				$('.toast.toast--error').toast('show');
                $('#task_tags').focus();
            }
            else if(description == ''){
                $('#errorMessage').text("{{ __('Please Enter Description') }}");
				$('.toast.toast--error').toast('show');
                $('#description').focus();
            }


            else{
                $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('update.task') }}",
					data: {
						task_id         : task_id,
 						title 		    : title,
						assignee 		: user_id,
						due_date 		: endDate,
						client_id 		: client_id,
						priority 	    : priority,
						tags 	        : task_tags,
						description 	: description,

					},
					success: function(data){
                        $('#rrrightAsideModal').modal('hide');

                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#completedTask').html(data.complete);
                        $('#pendingTask').html(data.pending);
                        $('#deletedTask').html(data.delete);
                        $('#my_Task').text(data.my_Task_count);
                        $('#notificationCount').text(data.count);
						$('#notificationList').html(data.response);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
            }
        });

        $('#taskDeleteBtn').click(function(){
            var task_id = $('#task_id').val();
             $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('task.destroy') }}",
					data: {

						task_id    : task_id,

					},
					success: function(data){
                        $('#rrrightAsideModal').modal('hide');
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#completedTask').html(data.complete);
                        $('#pendingTask').html(data.pending);
                        $('#deletedTask').html(data.delete);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
        });

        $('#taskRestoreBtn').click(function(){
            var task_id = $('#task_id').val();
             $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('task.restore') }}",
					data: {

						task_id    : task_id,

					},
					success: function(data){
                        $('#rrrightAsideModal').modal('hide');
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
        });

        $('body').on('click', '.taskCheckButton', function(){
             var task_id = $(this).val();
             $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('task.completed') }}",
					data: {

						task_id    : task_id,

					},
					success: function(data){
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#notificationCount').text(data.count);
						$('#notificationList').html(data.response);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
        });

        $('body').on('click', '.taskConfirmButton', function(){
             var task_id = $(this).attr('data-task-id');
             $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('task.confirm') }}",
					data: {

						task_id    : task_id,

					},
					success: function(data){
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
        });
        $('body').on('click', '.taskReassignButton', function(){
             var task_id = $(this).attr('data-task-id');
             $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('task.reassign') }}",
					data: {

						task_id    : task_id,

					},
					success: function(data){
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#notificationCount').text(data.count);
						$('#notificationList').html(data.response);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
        });

        $('body').on('click', '.taskImportantButton', function(){
             var task_id = $(this).attr('data-task-id');
             $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('task.important') }}",
					data: {

						task_id    : task_id,

					},
					success: function(data){
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('#successMessage').text(data.alert);
                        $('.toast.toast--success').toast('show');
                        $('[data-toggle="tooltip"]').tooltip()
					},

				});
        });

        $('#search').on('input', function(){
            var search = $(this).val();

            $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('task.search') }}",
					data: {

						search    : search,

					},
					success: function(data){
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('[data-toggle="tooltip"]').tooltip()

                        // $('#successMessage').text(data.alert);
                        // $('.toast.toast--success').toast('show');
					},

				});

        })

        $('body').on('click', '.taskEditModal', function(){

            let id =  $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({

                type: "POST",
                url: "{{ route('task.modal.update') }}",
                data: {
                    id : id,
                },
                success: function(data)
                {
                    if(data.deleted == 1){
                        $('#taskRestoreBtn').removeClass('d-none');
                    }else{
                        $('#taskRestoreBtn').addClass('d-none');
                    }
                    $('#task_id').val(id);
                    $("#user_id_update").html(data.assigned);
                    $("#tag_id_update").html(data.tags);
                    $("#priority_update").html(data.priority);
                    $("#title_update").val(data.title);
                    // $("#endDate_update").val(data.due_date);
                    $("#description_update").val(data.desc);
                    $("#client_id_update").html(data.clients);
                    $("#endDate_update").flatpickr({
                    defaultDate: data.due_date
                });
                    console.log(data.due_date);
                    // $("#user_id_update").html(data.users);

                }

            });

        });

        $('body').on('click', '.priority_filter_btn', function(){
            var priority = $(this).attr('data-priority');
            $.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST",
					url:"{{ route('priority.filter') }}",
					data: {

						priority    : priority,

					},
					success: function(data){
                        $('#rrrightAsideModal').modal('hide');
                        $('#allTask').html(data.all);
                        $('#importantTask').html(data.important);
                        $('#pendingTask').html(data.pending);
                        $('#completedTask').html(data.complete);
                        $('#deletedTask').html(data.delete);
                        $('#my_Task').text(data.my_Task_count);
                        $('#important_Task').text(data.important_Task_count);
                        $('#pending_Task').text(data.pending_Task_count);
                        $('#completed_Task').text(data.completed_Task_count);
                        $('#deleted_Task').text(data.deleted_Task_count);
                        $('[data-toggle="tooltip"]').tooltip()
                        // $('#successMessage').text(data.alert);
						// $('.toast.toast--success').toast('show');
					},

				});

        });

        $('body').on('click', '.tag_filter_btn', function(){
            var tag = $(this).attr('data-tag-id');

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: "POST",
                url:"{{ route('tag.filter') }}",
                data: {
                    tag    : tag,

                },
                success: function(data){
                    $('#rrrightAsideModal').modal('hide');
                    $('#allTask').html(data.all);
                    $('#importantTask').html(data.important);
                    $('#pendingTask').html(data.pending);
                    $('#completedTask').html(data.complete);
                    $('#deletedTask').html(data.delete);
                    $('#my_Task').text(data.my_Task_count);
                    $('#important_Task').text(data.important_Task_count);
                    $('#pending_Task').text(data.pending_Task_count);
                    $('#completed_Task').text(data.completed_Task_count);
                    $('#deleted_Task').text(data.deleted_Task_count);
                    $('[data-toggle="tooltip"]').tooltip()
                },

            });

        });

        $('.edittasktag').click(function(){
		var id = $(this).attr('data-id');
		// alert();
		var name = $('#tagName'+id).text();
		var color = $('#tagColor'+id).text();
		$('#updatedtagTitle').text("{{ __('Update Tag') }}");
		$('#updatedtagButton').text("{{ __('Update') }}");
		$('#existing_tag_id').val(id);
		$('#tagId').val(name);

		$('.selectColor').each(function(){
			if($(this).attr('value') == color){
				$(this).attr('selected', true);
			};
		});

	});


</script>

@endpush
