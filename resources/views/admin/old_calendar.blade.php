{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Calendar') }}
@endsection

@section('bodyBg')
secondary-bg
@endsection

{{-- active menu  --}}
@section('savIndex')
active
@endsection

@push('plugins-link')
	<link rel="stylesheet" href="{{ asset('crm_assets/assets/plugins/fullcalendar/css/main.min.css') }}">
@endpush



{{-- Main Content Part  --}}
@section('content')

<!-- Banner Section -->
<section class="py-4 position-relative">
	<div class="container">
		{{-- <a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a> --}}
		<div class="row bg-white py-3 rounded-lg shadow-sm">
			<div class="col-md-2">
				<div class="text-center text-md-left">
					@if (checkAction(Auth::id(), 'calendar', 'add event') || role() == 's_admin')
					<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="addEvent-btn primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 w-100">{{ __('Add Event') }}</button>
					@endif
					<button data-toggle="modal" data-target="#leftAsideModal" type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 mt-3">{{ __('Add Event Category') }}</button>
				</div>
				<h4 class="mt-4 mb-3">{{ __('Filters') }}</h4>
				@foreach ($category as $item)
				<div class="calendar-filter-card d-flex align-items-center" style="background-color: {{ $item->color }}">
					<p class="calendar-filter-card__text mb-0">{{ $item->name }}</p>
					<div class="custom-control custom-checkbox mb-0 ml-auto">
						<input value="{{ $item->id }}" type="checkbox" class="custom-control-input calendar-filter-checkbox" id="eventFilterCheck-{{ $item->id }}" checked>
						<label class="custom-control-label" for="eventFilterCheck-{{ $item->id }}"></label>
					</div>
					{{-- <button type="button" class="calendar-filter-card__action-btn">
						<i class="bi bi-pencil-square"></i>
					</button>
					<button type="button" class="calendar-filter-card__action-btn">
						<i class="bi bi-trash3-fill"></i>
					</button> --}}
				</div>
				@endforeach
			</div>
			<div class="col-md-10">
				<div id='calendar'></div>
			</div>
		</div>
	</div>
</section>

<!-- Right Aside Modal -->
<div class="modal modal--aside fade rightAsideModal" id="rightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
	<div class="modal-dialog m-0 h-100 bg-white">
		<div class="modal-content simple-bar border-0 h-100 rounded-0">
			<div class="modal-header border-0 pb-0">
				<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
					<span class="novecologie-icon-close"></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="d-flex flex-column align-items-center mb-2">
					<h1 id="addEventheader" class="modal-title text-center">{{ __('Add Event') }}</h1>
					<a id="client_details_id" class="secondary-btn primary-btn--md d-none border-0">{{ __('Client Details') }}</a>
				</div>
				<form action="{{ route('event.store') }}" class="form" id="addEventForm" method="POST">
					@csrf
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
								<input type="text" name="title" id="title" class="form-control shadow-none" placeholder="{{ __('Event Title') }}">
								<input type="hidden" name="event_id" id="event_id" value="">
								@error('title')
								<span class="alert text-danger">{{ $message }} **</span>
								@enderror
							</div>
						</div>
						<div class="col-12 mb-3">
							<div class="form-group" id="categorySelectWrapper">
								<label class="form-label" for="categorySelect">{{ __('Category') }} <span class="text-danger">*</span></label>
								<select class="custom-select shadow-none form-control" name="category_id" id="categorySelect">
									<option value="">{{ __('Select') }}</option>
									@foreach ($category as $item)
									<option id="selected{{ $item->id }}" value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
							@error('category_id')
							<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
						<div class="col-12 mb-3">
							<div class="form-group" id="UserSelectWrapper">
								<label class="form-label" for="UserSelect">{{ __('Assignee') }} <span class="text-danger">*</span></label>
								<select class="select2_select_option custom-select shadow-none form-control" name="user_id[]" id="UserSelect" multiple required>
									@foreach ($users as $item)
									<option value="{{ $item->id }}">{{ $item->name }}</option>
									@endforeach
								</select>
							</div>
							@error('category_id')
							<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="startDate">{{ __('Start Date') }} <span class="text-danger">*</span></label>
								<input type="datetime-local" name="start_date" id="startDate" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select start date') }}">
								@error('start_date')
								<span class="alert text-danger">{{ $message }} **</span>
								@enderror
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="endDate">{{ __('End Date') }}</label>
								<input type="datetime-local" id="endDate" name="end_date" class="flatpickr form-control shadow-none bg-transparent" placeholder="{{ __('Select End date') }}">
								@error('end_date')
								<span class="alert text-danger">{{ $message }} **</span>
								@enderror
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input" name="all_day" value="yes" id="customSwitch1">
									<label class="custom-control-label" for="customSwitch1">{{ __('All Day') }}</label>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="clientSelect">{{ __('Client') }} <span class="text-danger">*</span></label>
								<select class="custom-select shadow-none form-control" id="clientSelect" name="client_id">
									<option value="">{{ __('Select') }}</option>
									@foreach ($clients as $item)
										@if ($client && $client->id == $item->id)
										<option id="clientSeleted{{ $item->id }}" selected value="{{ $item->id }}">{{ $item->first_name }}</option>
										@else
										<option id="clientSeleted{{ $item->id }}" value="{{ $item->id }}">{{ $item->first_name }}</option>
										@endif
									@endforeach
								</select>
							</div>
							@error('client')
							<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="projectSelect">{{ __('Project') }} <span class="text-danger">*</span></label>
								<select class="custom-select shadow-none form-control" id="projectSelect" name="project_id">
									<option value="">{{ __('Select') }}</option>
									@if($client)
										 @foreach (getProject($client->id) as $item)
										 <option value="{{ $item->id }}">{{ $item->project_name }}</option>
										 @endforeach
									@endif
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="location">{{ __('Location') }} <span class="text-danger">*</span></label>
								<input type="text" id="location" name="location" class="form-control shadow-none" placeholder="{{ __('Enter Location') }}">
								@error('location')
								<span class="alert text-danger">{{ $message }} **</span>
								@enderror
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label class="form-label" for="description">{{ __('Description') }}</label>
								<textarea type="text" id="description" name="description" class="form-control shadow-none"></textarea>
								@error('description')
								<span class="alert text-danger">{{ $message }} **</span>
								@enderror
							</div>
						</div>
						<div class="col-12 text-center">
							<button id="eventAddButton" type="submit" class="secondary-btn primary-btn--md border-0 mb-2">{{ __('Add') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Left Aside Modal -->
<div class="modal modal--aside fade leftAsideModal" id="leftAsideModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
	<div class="modal-dialog m-0 h-100 bg-white">
	<div class="modal-content simple-bar border-0 h-100 rounded-0">
		<div class="modal-header border-0">
			<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
				<span class="novecologie-icon-close"></span>
			</button>
		</div>
		<div class="modal-body">
			<h1 id="updatedCategoryTitle" class="modal-title text-center mb-5">{{ __('Add Category') }}</h1>
			<form action="{{ route('category.store') }}" class="form" method="POST">
				@csrf
				<div class="row">
					<div class="col-12">
						<div class="form-group">
							<input type="text" id="categoryId" name="name" class="form-control shadow-none" placeholder="{{ __('Category Name') }}*">
							<input type="hidden" id="existing_category_id" name="existing_category_id" value="">
							@error('name')
								<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							{{-- <select class="custom-select shadow-none form-control" id="select" name="color">
								<option data-display="Select Colour" value="">Select Colour *</option>
								<option class="selectColor" value="event--primary">Primary</option>
								<option class="selectColor" value="event--success">Success</option>
								<option class="selectColor" value="event--danger">danger</option>
								<option class="selectColor" value="event--info">info</option>
								<option class="selectColor" value="event--warning">warning</option>
								<option class="selectColor" value="event--purple">purple</option>
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
								<option class="selectColor" value="event--tea-green">tea green</option>
							</select> --}}
							<input type="color" name="color" class="form-control shadow-none">
							@error('color')
								<span class="alert text-danger">{{ $message }} **</span>
							@enderror
						</div>
					</div>
					<div class="col-12 text-center">
						<button id="updatedCategoryButton" type="submit" class="primary-btn primary-btn--primary primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0 mt-3">{{ __('Add') }} </button>
					</div>
				</div>
			</form>
			<h1 class="modal-title text-center my-5">{{ __('All Event Category') }}</h1>
			<div class="col-12 px-3">
				<div class="database-table-wrapper bg-white border">
					<div class="table-responsive simple-bar">
						<table class="table database-table w-100 mb-0">
							<thead class="database-table__header">
								<tr>
									<th>{{ __('Serial') }}</th>
									<th>{{ __('Category Name') }}</th>
									<th>{{ __('Color Name') }}</th>
									<th class="text-center">{{ __('Action') }}</th>
								</tr>
							</thead>
							<tbody class="database-table__body">
								@foreach ($category as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td id="categoryName{{ $item->id }}">{{ $item->name }}</td>
										<td id="categoryColor{{ $item->id }}">{{ $item->color }}</td>
										<td class="text-center">
											<div class="dropdown dropdown--custom p-0 d-inline-block">
												<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="novecologie-icon-dots-horizontal-triple"></span>
												</button>
												<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
													<button data-id="{{ $item->id }}" type="button" class="dropdown-item border-0 editEventCategory">
														<span class="novecologie-icon-edit mr-1"></span>
														{{ __('Edit') }}
													</button>
													<form action="{{ route('event.category.delete') }}" method="POST">
														@csrf
														<input type="hidden" name="event_category_id" value="{{ $item->id }}">
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
								{{-- <tr>

									<td>l:2874793949439305</td>

									<td>+33666098000</td>
									<td>redonromuald@hotmail.fr</td>


									<td>
										<div class="d-flex align-items-center justify-content-around">
											<div class="navbar dropdown dropdown--custom p-0 d-inline-block">
												<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="novecologie-icon-dots-horizontal-triple"></span>
												</button>
												<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
													<button type="button" class="dropdown-item border-0">
														<span class="novecologie-icon-edit mr-1"></span>
														Edit
													</button>
													<button type="button" class="dropdown-item border-0">
														<span class="novecologie-icon-trash mr-1"></span>
														Delete
													</button>
												</div>
											</div>
										</div>
									</td>
								</tr>  --}}
							</tbody>
						</table>
					</div>
					{{-- <div class="pagination-wrapper">
						<nav>
							<ul class="pagination">
								<li class="page-item disabled">
									<a class="page-link" href="#!" rel="prev" aria-label="« Previous">‹</a>
								</li>
								<li class="page-item active" aria-current="page">
									<span class="page-link">1</span>
								<li class="page-item">
									<a class="page-link" href="#!">2</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">3</a>
								</li>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">4</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">...</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!">52</a>
								</li>
								<li class="page-item">
									<a class="page-link" href="#!" rel="next" aria-label="Next »">›</a>
								</li>
							</ul>
						</nav>
					</div> --}}
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
		@if ($errors->has('name')||$errors->has('color'))
			@push('js')
			<script>
			$("#leftAsideModal").modal('show');
			</script>
			@endpush
		@endif

		@if ($errors->has('title')||$errors->has('category_id')||$errors->has('start_date')||$errors->has('location')||$errors->has('description'))
			@push('js')
			<script>
			$("#rightAsideModal").modal('show');
			</script>
			@endpush
		@endif
@endsection

@push('plugins-script')
<script src="{{ asset('crm_assets/assets/plugins/fullcalendar/js/main.min.js') }}"></script>
<script src="{{ asset('crm_assets/assets/plugins/fullcalendar/js/locales-all.min.js') }}"></script>
@endpush

@push('js')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		let filterCheckbox = document.querySelectorAll(".calendar-filter-checkbox");
		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'timeGridWeek',
			headerToolbar: {
				left: 'prev,next',
				center: 'title',
				right: 'dayGridMonth,timeGridWeek,timeGridDay'
			},
			timeZone: 'local',
			navLinks: false,
			editable: true,
			selectable: true,
			selectMirror: true,
			eventTimeFormat: {
				hour: 'numeric',
				minute: '2-digit',
				meridiem: 'short',
			},
			eventDrop : function(e) {
				$('#successMessage').text("Event Updated");
				$('.toast.toast--success').toast('show');
				let movement = e.delta.days;
				let event_id = e.event._def.extendedProps.eventid;
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url:"{{ route('event.drag') }}",
					data: {
						event_id	:event_id,
						movement	:movement,
					},
					success: function(data){
						console.log(data);
					},
				});
			},
			dateClick: function(currentDate) {
				@if (checkAction(Auth::id(), 'calendar', 'add event') || role() == 's_admin')
				$('#rightAsideModal').modal('show')
				 @endif
				 $("#addEventForm")[0].reset();
				 $('#projectSelect').html("<option value=''>{{ __('Select') }}</option>");
				 $("#UserSelect").val(null).trigger("change");
				$("#startDate").flatpickr({
					altInput: true,
					enableTime: true,
					defaultDate: currentDate.date,
				});
				$("#endDate").flatpickr({
					altInput: true,
					enableTime: true,
					minDate: currentDate.date,
					defaultDate: "",
				}).clear();
				$("#title").val("");
				$("#description").val("");
				$("#location").val("");
				$('#eventAddButton').text("{{ __('Add') }}");
				$('#addEventheader').text('Add Event');
				@if ($client)
				$('#clientSelect').val("{{ $client->id }}").prop('selected', true);
				@else
				$('#clientSelect').val('').prop('selected', true);
				@endif
				$('#categorySelect').val('').prop('selected', true);
				$('#customSwitch1').prop('checked', false);
				$('#event_id').val('');
				$('#client_details_id').removeClass("d-inline-block");
				$('#client_details_id').addClass("d-none");

			},
			eventClick: function(currentEvent) {
				@if (checkAction(Auth::id(), 'calendar', 'edit') || role() == 's_admin')
				$('#rightAsideModal').modal('show')
				 @endif

				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url:"{{ route('event.assignee') }}",
					data: {
						event_id	:currentEvent.event.extendedProps.eventid,
					},

					success: function(data){
						$('#UserSelect').html(data);
					},
				});

				$.ajax({
					type: "POST",
					url:"{{ route('event.project') }}",
					data: {
						client_id	:currentEvent.event.extendedProps.client_id,
						project_id	:currentEvent.event.extendedProps.project_id,
					},

					success: function(data){
						$('#projectSelect').html(data);
					},
				});

				$('#endDate').val('');
				$("#startDate").flatpickr({
					altInput: true,
					enableTime: true,
					defaultDate: currentEvent.event.start,
				});
				$("#endDate").flatpickr({
					altInput: true,
					enableTime: true,
					defaultDate: currentEvent.event.end,
				});
				var id = currentEvent.event.extendedProps.category;
				event_id = currentEvent.event.extendedProps.eventid;
				$("#title").val(currentEvent.event.title);
				$("#description").val(currentEvent.event.extendedProps.description);
				$("#location").val(currentEvent.event.extendedProps.location);
				$('#eventAddButton').text("{{ __('Update') }}");
				$('#addEventheader').text('View Event');
				$('#event_id').val(event_id);
				$('#client_details_id').removeClass("d-none");
				$('#client_details_id').addClass("d-inline-block");
				$('#client_details_id').attr("href", "{{ url('admin/client-update') }}/"+currentEvent.event.extendedProps.client_id);


				if(currentEvent.event.extendedProps.all_day == 'yes'){
					$('#customSwitch1').prop('checked', true);
				}

				$('#categorySelect option').each(function(){
					let categoryOptionValue = $(this);
					if(categoryOptionValue.val() == currentEvent.event.extendedProps.cid){
						categoryOptionValue.prop('selected', true);
					}
				});
				$('#clientSelect option').each(function(){
					let clientOptionValue = $(this);
					if(clientOptionValue.val() == currentEvent.event.extendedProps.client_id){
						clientOptionValue.prop('selected', true);
					}
				});

				// @foreach ($category as $cid)
				// 	if(currentEvent.event.extendedProps.cid == "{{ $cid->id }}"){
				// 	$("#selected{{ $cid->id }}").attr('selected', true);
				// 	}
				// @endforeach

				// @foreach ($clients as $client)
				// 	if(currentEvent.event.extendedProps.client_id == "{{ $client->id }}"){
				// 	$("#clientSeleted{{ $client->id }}").attr('selected', true);
				// 	}
				// @endforeach

			},
			events: function (fetchInfo, successCallback, failureCallback) {
				successCallback([
					@foreach ($event as $item)
						{
							eventid: "{{ $item->id }}",
							cid: "{{ $item->category_id }}",
							title: '{{ $item->title }}',
							start: '{{ $item->start_date }}',
							end: '{{ $item->end_date }}',
							description: '{{ $item->description }}',
							location: '{{ $item->location }}',
							client_id: '{{ $item->client_id }}',
							project_id: '{{ $item->project_id }}',
							all_day : '{{ $item->all_day }}',
							backgroundColor: '{{ $item->getCategory->color }}',
						},
						@endforeach
				]);
			},
			eventDidMount: function (arg) {
				filterCheckbox.forEach(function (v) {
					if (v.checked) {
						if (arg.event.extendedProps.cid === v.value) {
							arg.el.style.display = "flex";
						}
					} else {
						if (arg.event.extendedProps.cid === v.value) {
							arg.el.style.display = "none";
						}
					}
				});
			},
		});
		calendar.getOption('locale', 'fr');
		calendar.render();

		filterCheckbox.forEach(function (el) {
			el.addEventListener("change", function () {
				calendar.refetchEvents();
			});
		});
	});

	$(".addEvent-btn").click(function(){
		$("#addEventForm")[0].reset();
		$('#eventAddButton').text("{{ __('Add') }}");
		$('#projectSelect').html("<option value='' disabled>{{ __('Select') }}</option>");
		$("#UserSelect").val(null).trigger("change");
		$('#client_details_id').removeClass("d-inline-block");
		$('#client_details_id').addClass("d-none");
	});

	$(".flatpickr").flatpickr({
		altInput: true,
		enableTime: true,
		// altFormat: "d-m-Y",
		// dateFormat: "Y-m-d",
	});

	$('.editEventCategory').click(function(){
		var id = $(this).attr('data-id');
		var name = $('#categoryName'+id).text();
		var color = $('#categoryColor'+id).text();
		$('#updatedCategoryTitle').text("{{ __('Update Category') }}");
		$('#updatedCategoryButton').text("{{ __('Update') }}");
		$('#existing_category_id').val(id);
		$('#categoryId').val(name);

		$('.selectColor').each(function(){
			if($(this).attr('value') == color){
				$(this).attr('selected', true);
			};
		});

	});

	$('#eventAddButton').click(function(e){
		e.preventDefault();
		 var title 			= $('#title').val();
		 var categorySelect = $('#categorySelect').val();
		 var UserSelect 	= $('#UserSelect').val();
		 var startDate 		= $('#startDate').val();
		 var clientSelect 	= $('#clientSelect').val();
		 var projectSelect 	= $('#projectSelect').val();
		 var location 		= $('#location').val();

		 if( title == ''){
			$('#errorMessage').text("{{ __('Please Enter Title') }}");
			$('.toast.toast--error').toast('show');
			$('#title').focus();
		 }

		 else if(categorySelect == ''){
			$('#errorMessage').text("{{ __('Please Select Category') }}");
			$('.toast.toast--error').toast('show');
			$('#categorySelect').focus();
		 }
		 else if(UserSelect == null){
			$('#errorMessage').text("{{ __('Please Select Assignee') }}");
			$('.toast.toast--error').toast('show');
			$('#UserSelect').focus();
		 }
		 else if(startDate == ''){
			$('#errorMessage').text("{{ __('Please Select Start Date') }}");
			$('.toast.toast--error').toast('show');
			$('#startDate').focus();
		 }
		 else if(clientSelect == ''){
			$('#errorMessage').text("{{ __('Please Select Client') }}");
			$('.toast.toast--error').toast('show');
			$('#clientSelect').focus();
		 }
		 else if(projectSelect == ''){
			$('#errorMessage').text("{{ __('Please Select Project') }}");
			$('.toast.toast--error').toast('show');
			$('#projectSelect').focus();
		 }
		 else if(location == ''){
			$('#errorMessage').text("{{ __('Please Enter Location') }}");
			$('.toast.toast--error').toast('show');
			$('#location').focus();
		 }

		 else{
			 $('#addEventForm').submit();
		 }

	});

	$('#clientSelect').change(function(e){
		var id = $(this).val();
		if(id != ''){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url:"{{ route('event.client.project') }}",
			data: {
				client_id	:id,
			},

			success: function(data){
				$('#projectSelect').html(data);
			},
		});
		}
	});
</script>
@endpush
