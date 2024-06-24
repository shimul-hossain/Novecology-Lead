{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Leads') }}
@endsection

{{-- active menu  --}}
@section('leadIndex')
active
@endsection

{{-- Main Content Part  --}}
@section('content')
{{-- {{ Auth::user()->name }} --}} 
		<!-- Banner Section -->
		<section class="banner section-gap position-relative pb-xl-0">
			<div class="container">
				<a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a>
				<div class="row justify-content-center">
					<div class="col-xl-auto">
						<div class="user-card">
							<div class="user-card__head position-relative">
								<div class="user-card__head__wrapper position-relative">
									<div class="user-card__avatar rounded-circle mx-auto position-relative">
										<div class="overflow-hidden rounded-circle w-100 h-100">
											@if (isset($lead) && $lead->image)
											<img  src="{{ asset('uploads/crm/leads') }}/{{ $lead->image }}" alt="avatar image" class="user-card__avatar__image w-100 h-100">
											@else
											<img  src="{{ asset('crm_assets/assets/images/user/avatar-image.png') }}" alt="avatar image" class="user-card__avatar__image w-100 h-100">
											@endif
										</div>
										@if (isset($lead) && $lead->count()>0)
										    <label for="edit-image"><i class="fas fa-pencil-alt text-light" style="position: absolute; top:44px; right: -15px; cursor: pointer;"></i></label>
										@endif
										
										<form method="POST" action="{{ route('update.image') }}" id="profile-form" enctype="multipart/form-data">
											@csrf
											@if (isset($lead) && $lead->count()>0)
											<input type="hidden" id="lead_id" name="lead_id" value="{{ $lead->id }}">
											@endif
											<input type="file" id="edit-image" name="image" class="d-none">
										</form>
									</div>
									<h3 id="userStatus" class="user-card__title text-center my-4 
									@if ($lead && $lead->status == 'verified')
										verified
									@endif
									">@if ($lead)
										{{ $lead->first_name ." ". $lead->last_name }}
									@endif </h3>
									<div class="table-responsive simple-bar mb-4">
										<table class="user-card__table text-white w-100">
											<tbody>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Tel') }}</th>
													<td class="position-relative">  
														@isset($lead)
														<span id="telephone">{{ $lead->phone }} </span>
														{{-- <span id="edit-telephone-btn" class="">
															<i class="fas fa-pencil-alt" style="position: absolute; top:10px; right: 0;cursor: pointer;"></i>
														</span> --}}
														<input type="text" name="telephone" id="edit-telephone" value="{{ $lead->phone }}" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none"> 
														@endisset 
														 


													</td>
													 
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Email') }}</th>
													<td class="position-relative">
														@isset($lead)
														<span id="email-address"> {{ $lead->email }} </span> 
														{{-- <span id="edit-email">
															<i class="fas fa-pencil-alt" style="cursor: pointer; position: absolute; top:10px; right: 0"></i>
														</span> --}}
														<input type="text" name="email" id="edit-email-address" value="{{ $lead->email }}" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none">
														@endisset 
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Department') }}</th>
													<td class="position-relative"> 
														@isset($lead)
														<span id="department">
															{{ $lead->city }}
														</span> 
														{{-- <span id="edit-department-btn">
															<i class="fas fa-pencil-alt" style=" cursor: pointer; position: absolute; top:10px; right: 0"></i>
														</span> --}}
														<input type="text" name="department" id="edit-department" value="{{ $lead->city }}" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none"> 
														@endisset 
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Precariousness') }}</th>
													<td class="position-relative" class="color-pest">
														@isset($lead)
														<span id="precarious">
															{{ $tax_precariousness }}
														</span>
														{{-- <span id="edit-precarious-btn">
															<i class="fas fa-pencil-alt text-light" style=" cursor: pointer; position: absolute; top:10px; right: 0"></i>
														</span> --}}
														<input type="text" name="department" id="edit-precarious" value="#" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none"> 
														@endisset 
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative">{{ __('Zone') }}</th>
													<td class="position-relative" class="color-pest">
														@isset($lead)
														<span id="zone"> 
														{{ $tax_zone }}
														</span>  
														{{-- <span id="edit-zone-btn">
															<i class="fas fa-pencil-alt text-light" style="cursor: pointer; position: absolute; top:10px; right: 0"></i>
														</span> --}}
														<input type="text" name="department" id="edit-zone" value="#" class="form-control px-1 bg-light text-dark border-0 shadow-none d-none">
														@endisset 
													</td>
												</tr>
												<tr>
													<th class="user-card__table__heade position-relative pt-4">{{ __('Projects') }}</th>
													<td id="projectName" class="pt-4">
														@if($lead && $lead->project_name)
															{{ $lead->project_name }} 
														@endif
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="text-center">
										<button data-toggle="modal" data-target="#leftAsideModal" type="button" class="primary-btn primary-btn--pink primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
											@if ($lead && $lead->status == 'pre-validated')
											<span id="lead_status">{{ __('Pre-Validated') }}</span>

											@elseif ($lead && $lead->status == 'verified')
											<span id="lead_status">{{ __('Verified') }}</span>
											@else
											<span id="lead_status">{{ __('Current lead') }}</span>
												
											@endif
											<span class="novecologie-icon-chevron-right primary-btn__icon ml-2"></span>
										</button>
										
										<button id="TurnToCustomer" data-toggle="modal" data-target="#rightAsideModal" type="button" class=" primary-btn primary-btn--white primary-btn--lg rounded-pill align-items-center justify-content-center border-0 mt-3 verified 
										@if ($lead && $lead->status == 'verified')
										d-inline-flex
										@else
										d-none
										@endif
										">
										@if ($lead && $lead->convert_status == 'yes')
										{{ __('Create A New Project') }}
										@else
										{{ __('Turn the lead into a customer') }}
										@endif</button> 
										
									</div>
								</div>
							</div>
							
							@if (isset($client))
								<div class="user-card__footer text-center bg-white pb-5 " id="appoinmentBtn">
								<a href="{{ route('calendar.index', $client->id) }}" class="primary-btn primary-btn--blue primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center mb-3">
									<span class="novecologie-icon-calendar primary-btn__icon mr-4"></span>
									{{ __('Make an appointment') }}
								</a>
								{{-- <a href="#!" class="primary-btn primary-btn--blue primary-btn--lg rounded-pill align-items-center justify-content-center mb-3 d-none">
									<span class="novecologie-icon-headset primary-btn__icon mr-4"></span>
									{{ __('SAV') }}
								</a>
								<a href="#!" class="primary-btn primary-btn--orange primary-btn--lg rounded-pill align-items-center justify-content-center mb-3 d-none">
									<span class="novecologie-icon-folder primary-btn__icon mr-4 "></span>
									{{ __('Consult the file') }}
								</a> --}}
								</div>
							@endif 
						</div>
					</div>
					<div class="lead__column position-relative col-xl mt-xl-0">
						<div class="d-flex flex-wrap justify-content-between align-items-center">
							<h1 class="text-white text-shadow mb-0">{{ __('New lead') }}</h1>
							<a href="tel:{{ $lead->phone ?? '' }}" class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0" type="button">{{ __('To remind') }}</button>
						</div>
						<div class="lead__wrapper py-3">
							
								<div class="accordion" id="leadAccordion">
									<div class="card lead__card border-0">
									  <div class="card-header bg-transparent border-0 p-0" id="leadCard-1">
										<h2 class="mb-0">
											<button class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100" type="button" data-toggle="collapse" data-target="#leadCardCollapse-1" aria-expanded="false" aria-controls="leadCardCollapse-1">
												<span id="lead-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4 
												@if($lead && $lead->tracker_platform)
												verified
												@endif
												"></span>
												{{ __('Lead Tracking (Form and response)') }}
												<span class="d-block ml-auto">
													<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
												</span>
											</button>
										</h2>
									  </div>
								  
									  <div id="leadCardCollapse-1" class="collapse" aria-labelledby="leadCard-1" data-parent="#leadAccordion">
										<div class="card-body row">
											<div class="col custom-space">
												<form action="{{ route('lead.create') }}" class="form" id="leadCardForm" method="POST">
													@csrf
													<div class="row">
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="tracker_name">{{ __('Lead Tracker name') }}*</label>
																<input type="text" name="tracker_name" id="tracker_name" class="form-control shadow-none" placeholder="{{ __('Name') }}" 
																@isset($lead->tracker_name)
																value="{{ $lead->tracker_name }}"
																@endisset>
																<input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
																<input type="hidden" name="company_name" id="company_name" value="{{ $company->company_name }}">
																<input type="hidden" name="x_lead_id" value="@if ($lead)
																	{{ $lead->id }}
																@endif">
																<input type="hidden" name="user_id" id="user_id" value="{{ Auth::id() }}">
																@error('tracker_name')
																<span class="alert text-danger">{{ $message }}</span>
																@enderror
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="tracker_platform">{{ __('Lead Tracker Platform') }}*</label>
																<input type="text" name="tracker_platform" id="tracker_platform" class="form-control shadow-none" placeholder="{{ __('Platform') }}"
																@isset($lead->tracker_platform)
																value="{{ $lead->tracker_platform }}"
																@endisset>
																@error('tracker_platform')
																<span class="alert text-danger">{{ $message }}</span> 
																@enderror
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="tracker_email">{{ __('Lead Tracker Email') }}*</label>
																<input type="email" name="tracker_email" id="tracker_email" class="form-control shadow-none" placeholder="{{ __('Email') }}"
																@isset($lead->tracker_email)
																value="{{ $lead->tracker_email }}"
																@endisset>
																@error('tracker_email')
																<span class="alert text-danger">{{ $message }}</span> 
																@enderror
															</div>
														</div>
														<div class="col-md-6">
															<div class="form-group">
																<label class="form-label" for="tracker_phone">{{ __('Lead Tracker Phone') }}*</label>
																<input type="text" name="tracker_phone" id="tracker_phone" class="form-control shadow-none" placeholder="{{ __('Phone') }}"
																@isset($lead->tracker_phone)
																value="{{ $lead->tracker_phone }}"
																@endisset>
																@error('tracker_phone')
																<span class="alert text-danger">{{ $message }}</span> 
																@enderror
															</div>
														</div>
														<div class="col-12 text-center">
															<button type="submit" id="leadTrackValidate" data-toggle="false" data-target="#leadCardCollapse-2" aria-expanded="false" aria-controls="leadCardCollapse-2" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																{{ __('Start the project') }}
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									  </div>
									</div> 
									<div class="card lead__card border-0">
									  <div class="card-header bg-transparent border-0 p-0" id="leadCard-2">
										<h2 class="mb-0">
										  <button class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-2" aria-expanded="false" aria-controls="leadCardCollapse-2">
											<span id="project-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4 
											@isset($lead->project_name)
											verified
											@endisset>"></span>
											{{ __('Choose my project') }}
												<span class="d-block ml-auto">
													<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
												</span>
											</button>
										</h2>
									</div>
									<div id="leadCardCollapse-2" class="collapse" aria-labelledby="leadCard-2" data-parent="#leadAccordion">
										<div class="card-body row">
											<div class="col custom-space">
												<form action="#" class="form" id="leadProjectForm" method="POST">
													 
													@csrf
													<span id="project_error" class="text-danger"></span>
													<div class="row">
														<div class="col-4"> 
															<div class="custom-control custom-checkbox">
																<input type="radio" name="project_name" value="Isolation" class="custom-control-input" id="leadCardFormCheck-3"
																
																@if (isset($lead) && $lead->project_name == 'Isolation')
																checked
																@endif >
																<label class="custom-control-label" for="leadCardFormCheck-3">Isolation</label>
															</div>
														</div>
														<div class="col-4"> 
															<div class="custom-control custom-checkbox">
																<input type="radio" name="project_name" value="Heat pump" class="custom-control-input" id="leadCardFormCheck-2" 
															
																@if (isset($lead) && $lead->project_name == 'Heat pump')
																checked
																@endif >
																<label class="custom-control-label" for="leadCardFormCheck-2">Heat pump</label>
															</div> 
														</div>
														<div class="col-4"> 
															<div class="custom-control custom-checkbox">
																<input type="radio" name="project_name" value="Isolation" class="custom-control-input" id="leadCardFormCheck-3"
																
																@if (isset($lead) && $lead->project_name == 'Isolation')
																checked
																@endif >
																<label class="custom-control-label" for="leadCardFormCheck-3">Isolation</label>
															</div>
														</div>
														<div class="col-12 text-center ">
															<button id="projectValidate" type="button" data-toggle="false" data-target="#leadCardCollapse-3" aria-expanded="false" aria-controls="leadCardCollapse-3" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																{{ __('Verify') }}
															</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									  </div>
									</div> 
									<div class="card lead__card border-0">
									  <div class="card-header bg-transparent border-0 p-0" id="leadCard-3">
										<h2 class="mb-0">
										  <button class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-3" aria-expanded="false" aria-controls="leadCardCollapse-3">
											<span id="tax-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4 
												@if($tax->count()>0)
													verified
												@endif
											"></span>
												{{ __('Tax Notice') }}
												<span class="d-block ml-auto">
													<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
												</span>
										  </button>
										</h2>
									  </div>
									  <div id="leadCardCollapse-3" class="collapse" aria-labelledby="leadCard-3" data-parent="#leadAccordion">
										<div class="card-body row">
											<div class="col"> 
												<div class="row align-items-center">
													 <div class="col-12 p-0" id="taxWrapperId">
														@include('includes.crm.lead-tax')
													 </div>
													<div class="col-12 text-center" id="textItem">
														<div class="lead__card__loader-wrapper d-none">
															<div class="lead__card__loader">
																<svg class="lead__card__loader__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
																	<path class="lead__card__loader__icon__path" fill="inherit" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
																	<animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
																	</path>
																</svg>
															</div>
														</div>
														<div class="text-center lead__card__btn-wrapper">
															<button type="button" id="taxValidate" data-toggle="false" aria-expanded="false" aria-controls="leadCardCollapse-4" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
																{{ __('Verify') }}
															</button>
														</div>
													</div>
												</div> 
											</div>
										</div>
									  </div>
									</div>
									<div class="card lead__card border-0">
									  <div class="card-header bg-transparent border-0 p-0" id="leadCard-4">
										<h2 class="mb-0">
										  <button id="personal_info_collapse_btn" class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-4" aria-expanded="false" aria-controls="leadCardCollapse-4">
											<span id="info-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4 
											@isset($tax_zone)
											verified
											@endisset"></span>
											{{ __('Personal informations') }} 
												<span class="d-block ml-auto">
													<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
												</span>
										  </button>
										</h2>
									  </div>
									  <div id="leadCardCollapse-4" class="collapse" aria-labelledby="leadCard-4" data-parent="#leadAccordion">
										@include('includes.crm.personal_info')
									  </div>
									</div>
									<div class="card lead__card border-0">
									  <div class="card-header bg-transparent border-0 p-0" id="leadCard-6">
										<h2 class="mb-0">
										  <button class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-6" aria-expanded="false" aria-controls="leadCardCollapse-6">
											<span id="present-work-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
											@isset($lead->present_country)
											verified
											@endisset"></span>
											{{ __('Work site') }}
												<span class="d-block ml-auto">
													<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
												</span>
										  </button>
										</h2>
									  </div>
									  <div id="leadCardCollapse-6" class="collapse" aria-labelledby="leadCard-6" data-parent="#leadAccordion">
										<div class="card-body row">
											<div class="col custom-space">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="present_country">Country</label>
															<input type="text" name="present_country" id="present_country" class="form-control shadow-none"  
															@isset($lead->present_country)
															value="{{ $lead->present_country }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="present_zipcode">Zip Code</label>
															<input type="text" name="present_zipcode" id="present_zipcode" class="form-control shadow-none"  
															@isset($lead->present_zipcode)
															value="{{ $lead->present_zipcode }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="present_city">City</label>
															<input type="text" name="present_city" id="present_city" class="form-control shadow-none"  
															@isset($lead->present_city)
															value="{{ $lead->present_city }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="present_address">Address</label>
															<input type="text" name="present_address" id="present_address" class="form-control shadow-none"  
															@isset($lead->present_address)
															value="{{ $lead->present_address }}"
															@endisset>
														</div>
													</div> 
													<div class="col-12 text-center ">
														<button id="presentWorkValidate"
														 type="submit" data-toggle="false" data-target="#leadCardCollapse-5" aria-expanded="false" aria-controls="leadCardCollapse-5" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
															{{ __('Submit') }}
														</button>
													</div>
												</div>
											</div>
										</div>
									  </div>
									</div>
									<div class="card lead__card border-0">
									  <div class="card-header bg-transparent border-0 p-0" id="leadCard-5">
										<h2 class="mb-0">
										  <button class="btn text-left lead__card__toggler flex-grow-1 shadow-none d-flex align-items-center w-100 collapseBtn" type="button" data-toggle="collapse" data-target="#leadCardCollapse-5" aria-expanded="false" aria-controls="leadCardCollapse-5">
											<span id="work-verify" class="novecologie-icon-check lead__card__check mr-2 mr-sm-4
											@isset($lead->nature_occupation)
											verified
											@endisset"></span>
											{{ __('Eligibility') }}
												<span class="d-block ml-auto">
													<span class="novecologie-icon-chevron-down d-inline-block lead__card__toggler__icon"></span>
												</span>
										  </button>
										</h2>
									  </div>
									  <div id="leadCardCollapse-5" class="collapse" aria-labelledby="leadCard-5" data-parent="#leadAccordion">
										<div class="card-body row">
											<div class="col custom-space">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="natureOccupation">Nature occupation*</label>
															<input type="text" name="natureOccupation" id="natureOccupation" class="form-control shadow-none"  
															@isset($lead->nature_occupation)
															value="{{ $lead->nature_occupation }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="heatingType">Type of heating</label>
															<input type="text" name="heatingType" id="heatingType" class="form-control shadow-none"  
															@isset($lead->heating_type)
															value="{{ $lead->heating_type }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="housingType">Housing type</label>
															<input type="text" name="housingType" id="housingType" class="form-control shadow-none"  
															@isset($lead->housing_type)
															value="{{ $lead->housing_type }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="electricity_connection">Electricity connection</label>
															<input type="text" name="electricity_connection" id="electricity_connection" class="form-control shadow-none"  
															@isset($lead->electricity_connection)
															value="{{ $lead->electricity_connection }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="livingSpace">Living space</label>
															<input type="text" name="livingSpace" id="livingSpace" class="form-control shadow-none"  
															@isset($lead->living_space)
															value="{{ $lead->living_space }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="form-label" for="cadstrablePlot">Cadstrable plot</label>
															<input type="text" name="cadstrablePlot" id="cadstrablePlot" class="form-control shadow-none"  
															@isset($lead->cadstrable_plot)
															value="{{ $lead->cadstrable_plot }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-label" for="floorArea">Floor area</label>
															<input type="text" name="floorArea" id="floorArea" class="form-control shadow-none"  
															@isset($lead->floor_area)
															value="{{ $lead->floor_area }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-label" for="houseType">House type</label>
															<input type="text" name="houseType" id="houseType" class="form-control shadow-none"  
															@isset($lead->house_type)
															value="{{ $lead->house_type }}"
															@endisset>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="form-label" for="basement">With basement</label>
															<input type="text" name="basement" id="basement" class="form-control shadow-none"  
															@isset($lead->with_basement)
															value="{{ $lead->with_basement }}"
															@endisset>
														</div>
													</div>
													<div class="col-12 text-center ">
														<button id="workValidate"
														 type="submit" data-toggle="false" data-target="#leadCardCollapse-5" aria-expanded="false" aria-controls="leadCardCollapse-5" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
															{{ __('Submit') }}
														</button>
													</div>
												</div>
											</div>
										</div>
									  </div>
									</div>
								</div>
							{{-- </form> --}}
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Left Aside Modal -->
		<div class="modal modal--aside fade leftAsideModal" id="leftAsideModal" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body text-center">
					<h1 class="modal-title mb-5">{{ __('Choose a status') }}</h1>
					<button class="primary-btn primary-btn--purple primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('Current lead') }}</button>
					<button id="preValidateBtn" class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('Pre-validated lead') }}</button>
					<button id="leadVerifyBtn" class="primary-btn primary-btn--sky primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">{{ __('verified lead') }} </button>
				</div>
			</div>
			</div>
		</div>

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
						<h1 class="modal-title text-center">{{ __('Mandatory Step') }}</h1>
						<p class="modal-text text-center mb-5">{{ __('Please validate the client\'s project') }}</p>
						<form action="#!" class="form" id="clientsValidateForm">
							<h2 class="modal-sub-title position-relative mb-5">{{ __('Type of Project') }}</h2> 
							<div class="row mb-5">
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" class="custom-control-input" name="project_name_m" value="Pellet boiler" id="projectTypeFormCheck-1"
										@if (isset($lead) && $lead->project_name == 'Pellet boiler')
										checked
										@endif>
										<label class="custom-control-label" for="projectTypeFormCheck-1">Pellet boiler</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" class="custom-control-input" name="project_name_m" value="Heat pump" id="projectTypeFormCheck-2"
										@if (isset($lead) && $lead->project_name == 'Heat pump')
										checked
										@endif>
										<label class="custom-control-label" for="projectTypeFormCheck-2">Heat pump</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" class="custom-control-input" name="project_name_m" value="Isolation" id="projectTypeFormCheck-3"
										@if (isset($lead) && $lead->project_name == 'Isolation')
										checked
										@endif>
										<label class="custom-control-label" for="projectTypeFormCheck-3">Isolation</label>
									</div>
								</div>
							</div>
							<h2 class="modal-sub-title position-relative mb-5">{{ __('Funding') }}</h2>
							<div class="row">
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" name="funding" value="Housing action" class="custom-control-input" id="fundingFormCheck-1">
										<label class="custom-control-label" for="fundingFormCheck-1">Housing action</label>
									</div>
								</div>
								<div class="col-lg">
									<div class="custom-control custom-checkbox">
										<input type="radio" name="funding" value="MPR" class="custom-control-input" id="fundingFormCheck-2">
										<label class="custom-control-label" for="fundingFormCheck-2">MPR</label>
									</div>
								</div>
								<div class="col-12 text-center">
									<button id="leadToCustomer" type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-5">
										{{ __('Verify') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
@endsection
@isset($leads)
		<script> var lead_id = "{{ $leads->id }}"; </script>
@endisset

@push('js')

<script>
	$(document).ready(function(){

		// $("#taxValidate").on("click", function(){
		// 	$(".lead__card__btn-wrapper").addClass("d-none");
		// 	$(".lead__card__loader-wrapper").removeClass("d-none");
		// });

		// Get User Id form $user that we compact from controller 
		var number = $('#notice_number').val();
		var company_id = "{{ $company->id }}";
		 
	


		// Profile image update 
		$('#edit-image').change(function(e){ 

			 $('#profile-form').submit();
			 
		});


		// Telephone number update 
		$('#edit-telephone-btn').click(function(){
			 $('#telephone, #edit-telephone-btn').addClass('d-none');
			 $('#edit-telephone').removeClass('d-none');
			 $("#edit-telephone").removeClass('border border-danger');
			 $('#edit-telephone').focus();
			

		});
		$('#edit-telephone').blur(function(){ 
			
			var telephone = $(this).val(); 
			var lead_id	  = $('#lead_id').val(); 
			
			$.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 

                $.ajax({
                    type: "POST",
                    url: "{{ route('update.telephone') }}",
                    data: {
                        lead_id 	: lead_id,
                        telephone   : telephone,
                    },
                    success: function (response) { 
						
                        $("#telephone").text(response); 
                        $("#phone").val(response); 
						$('#edit-telephone').addClass('d-none');
						$('#telephone, #edit-telephone-btn').removeClass('d-none');
						$('#successMessage').text('Phone Number Updated');
						$('.toast.toast--success').toast('show');


                    }, 
					error: function(response){ 
						$("#edit-telephone").removeClass('border-0');
						$("#edit-telephone").addClass('border border-danger');
						$("#edit-telephone").focus(); 
					}
                });

		});


		// Email address update 
		$('#edit-email').click(function(){
			$('#email-address, #edit-email').addClass('d-none');
			 $('#edit-email-address').removeClass('d-none');
			 $("#edit-email-address").removeClass('border border-danger');
			 $('#edit-email-address').focus();
		}); 
		$('#edit-email-address').blur(function(){ 
			
			var email = $(this).val();
			var lead_id	  = $('#lead_id').val(); 
			 
			//  if(email == oldEmail){
			// 	$('#edit-email-address').addClass('d-none');
			// 	$('#email-address, #edit-email').removeClass('d-none');	
			// 	exit();
				
			//  }
			 

			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}); 

				$.ajax({
					type: "POST",
					url: "{{ route('update.email') }}",
					data: {
						lead_id 	: lead_id,
						email   	: email,
					},
					success: function (response) {  

						$("#email-address").text(response); 
						$("#email").val(response); 
						$('#edit-email-address').addClass('d-none');
						$('#email-address, #edit-email').removeClass('d-none');
						$('#successMessage').text('Email Address Updated');
						$('.toast.toast--success').toast('show');


					}, 
					error: function(response){ 
						$("#edit-email-address").removeClass('border-0');
						$("#edit-email-address").addClass('border border-danger');
						$("#edit-email-address").focus();
					}
				});

		});


		// Department Update 
		$('#edit-department-btn').click(function(){
			$('#department, #edit-department-btn').addClass('d-none');
			 $('#edit-department').removeClass('d-none');
			 $("#edit-department").removeClass('border border-danger');
			 $('#edit-department').focus();
		}); 
		$('#edit-department').blur(function(){

			var department = $(this).val();  
			var lead_id	  = $('#lead_id').val(); 
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}); 

			$.ajax({
				type: "POST",
				url: "{{ route('update.department') }}",
				data: {
					lead_id 	: lead_id,
					department   : department,
				},
				success: function (response) {  

					$("#department").text(response); 
					$('#edit-department').addClass('d-none');
					$('#department, #edit-department-btn').removeClass('d-none');
					$('#successMessage').text('Department Updated');
						$('.toast.toast--success').toast('show');


				}, 
				error: function(response){ 
					 
					$("#edit-department").removeClass('border-0');
					$("#edit-department").addClass('border border-danger');
					$("#edit-department").focus();
				}
			});

		});
		

		// precarious update 
		$('#edit-precarious-btn').click(function(){
			
			$('#precarious, #edit-precarious-btn').addClass('d-none');
			 $('#edit-precarious').removeClass('d-none');
			 $("#edit-precarious").removeClass('border border-danger');
			 $('#edit-precarious').focus();
		}); 
		$('#edit-precarious').blur(function(){

			var precarious = $(this).val();  
			var lead_id	  = $('#lead_id').val(); 
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}); 

			$.ajax({
				type: "POST",
				url: "{{ route('update.precarious') }}",
				data: {
					lead_id 	: lead_id,
					precarious   : precarious,
				},
				success: function (response) {  

					$("#precarious").text(response); 
					$('#edit-precarious').addClass('d-none');
					$('#precarious, #edit-precarious-btn').removeClass('d-none');
					$('#successMessage').text('Precariousness Updated');
					$('.toast.toast--success').toast('show');


				}, 
				error: function(response){ 
					
					$("#edit-precarious").removeClass('border-0');
					$("#edit-precarious").addClass('border border-danger');
					$("#edit-precarious").focus();
				}
			});

		});


		// Zone update 
		$('#edit-zone-btn').click(function(){
			$('#zone, #edit-zone-btn').addClass('d-none');
			 $('#edit-zone').removeClass('d-none');
			 $("#edit-zone").removeClass('border border-danger');
			 $('#edit-zone').focus();
		}); 
		$('#edit-zone').blur(function(){

			var zone = $(this).val();  
			var lead_id	  = $('#lead_id').val();  

			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}); 

			$.ajax({
				type: "POST",
				url: "{{ route('update.zone') }}",
				data: {
					lead_id 	: lead_id,
					zone   		: zone,
				},
				success: function (response) {  

					$("#zone").text(response); 
					$('#edit-zone').addClass('d-none');
					$('#zone, #edit-zone-btn').removeClass('d-none');
					$('#successMessage').text('Zone Updated');
					$('.toast.toast--success').toast('show');


				}, 
				error: function(response){ 
					
					$("#edit-zone").removeClass('border-0');
					$("#edit-zone").addClass('border border-danger');
					$("#edit-zone").focus();
				}
			});

		});

		
		// Add New Text Item  
		$('body').on('click', '#addTextItem',function(){
			if($('#existingAddMore').val() == 'exist'){
				$('#errorMessage').text('please complete open fiscal information first');
				$('.toast.toast--error').toast('show'); 
				exit();
			}
			var item = '<div class="col-12 mb-4"> <div class="row align-items-center"> <div class="col-lg-auto"> <h4 class="mb-lg-0 font-weight-bold">Notice '+ number+'</h4> </div> <div class="col-lg-4 col-md-6"> <div class="form-group mb-lg-0"> <input type="hidden" id="existingAddMore" value="exist"> <input type="text" name="tax_number" class="form-control shadow-none" placeholder="Fiscal number"  id="tax_number"> </div> </div> <div class="col-lg-4 col-md-6"> <div class="form-group mb-lg-0"> <input type="hidden" name="tax_id" id="tax_id", value="0"> <input type="text" name="tax_reference" id="tax_reference" class="form-control shadow-none" placeholder="Reference notice"> </div> </div> <div class="col-lg-auto">  </div> </div> </div>';

			$('#taxWrapperId').append(item);
			number ++;
		});


		// From Validation 
		$('#leadTrackValidate').click(function(e){
			e.preventDefault();
			var name1 = $('#tracker_name');
			var name2 = $('#tracker_platform');
			var name3 = $('#tracker_email');
			var name4 = $('#tracker_phone');
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(name1.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Tracker Name') }}");
				$('.toast.toast--error').toast('show'); 
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				 name1.focus();
			}
			else if(name2.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Tracker Platform') }}");
				$('.toast.toast--error').toast('show'); 
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				 name2.focus();
			}
			else if(name3.val() == ''){
				$('#errorMessage').text("{{ __('Please Enter Tracker Email') }}");
				$('.toast.toast--error').toast('show'); 
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				 name3.focus();
			}
			else if(!regex.test(name3.val())){
				$('#errorMessage').text("{{ __('Please Enter Valid Email') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				 name3.focus();
			}
			else if(name4.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Tracker Phone Number') }}");
				$('.toast.toast--error').toast('show');
				$('#leadTrackValidate').attr('data-toggle', false);
				$('#lead-verify').removeClass('verified');
				 name4.focus();
			} 
			else{
				$('#leadCardForm').submit();

			}  
		});
		
		$('#projectValidate').click(function(){
			if($('#project-verify').hasClass('verified'))
				{  
					$('#projectValidate').attr('data-toggle', 'collapse');
					exit();
				}

			if ($('input[name="project_name"]:checked').length == 0) { 
			 
				$('#errorMessage').text('Please Select Project');
				$('.toast.toast--error').toast('show'); 
				
		 	} 
          	else{
				// $('#leadProjectForm').submit();
				var project_name = $('input[name="project_name"]:checked').val();
				$('#projectValidate').attr('data-toggle', 'collapse');
				$('#project-verify').addClass('verified');
				$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST", 
					url:"{{ route('lead.project.update') }}",
					data: {
						lead_id			:$('#lead_id').val(), 
						project_name	:project_name,
					 
					},
					success: function(data){  
						$('#projectName').text(data.project_name);
						$('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show'); 
					},
					
				}); 
			}  
		});

		$('#taxValidate').click(function(){ 

			if(!$('#project-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-2').addClass('show');
					$('#errorMessage').text('Select a project to proceed');
					$('.toast.toast--error').toast('show'); 
					exit();
				}
			
				if($('#tax_number').length == 0)
				{ 
					 exit();
				}

			var lead_id 				= $('#lead_id').val(); 
			var company_id 				= $('#company_id').val(); 
			 var tax_number				= $('#tax_number').val();
			 var tax_reference 			= $('#tax_reference').val(); 
			//  var tax_id 				= $("input[name='tax_id[]']").map(function(){return $(this).val();}).get();
			//  var tax_number_value 		= $("input[name='tax_number[]']").map(function(){return $(this).val();}).get();
			//  var tax_reference_value 	= $("input[name='tax_reference[]']").map(function(){return $(this).val();}).get();
			if(tax_number == ''){
				$('#errorMessage').text("{{ __('Please Enter Fiscal Number') }}");
				$('.toast.toast--error').toast('show'); 
				$('#taxValidate').attr('data-toggle', false);
				$('#tax-verify').removeClass('verified'); 
				$('#tax_number').focus();
			} 
			else if(tax_reference == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Reference Notice') }}");
				$('.toast.toast--error').toast('show'); 
				$('#taxValidate').attr('data-toggle', false);
				$('#tax-verify').removeClass('verified'); 
				$('#tax_reference').focus();
			} 
			else{ 
				console.log(lead_id)
				console.log(company_id)
				$(".lead__card__loader-wrapper").removeClass("d-none");
				$(".lead__card__btn-wrapper").addClass("d-none");
				 
				// $('#taxValidate').attr('data-toggle', 'collapse');
				// $('#tax-verify').addClass('verified');
				$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST", 
					url:"{{ route('lead.tax.update') }}",
					data: {
						
						lead_id 		: lead_id, 
						tax_number 		: tax_number, 
						tax_reference 	: tax_reference, 
						company_id 		: company_id, 
					 
					},
					success: function(data){ 
						if(data.error){
						$('#errorMessage').text(data.error);
						$('.toast.toast--error').toast('show');
						$(".lead__card__btn-wrapper").removeClass("d-none");
						$(".lead__card__loader-wrapper").addClass("d-none");
						}
						else{
							if(data.primary == 'yes'){
								$("#zone").text(data.zone); 
								$("#precarious").text(data.precariousness);
								$("#department").text(data.city);
								$("#userStatus").text(data.name);
								$("#email-address").text(data.email);
								$("#telephone").text(data.phone);
							}
						$('#leadCardCollapse-4').html(data.taxes);
						$('#taxWrapperId').html(data.all_tax);

						$('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show'); 
						$('#leadCardCollapse-4').collapse('show'); 
						$('#info-verify').addClass('verified'); 
						$('#tax-verify').addClass('verified');
						$(".lead__card__btn-wrapper").removeClass("d-none");
						$(".lead__card__loader-wrapper").addClass("d-none");
						// location.reload();
						}
					},
					
				}); 
			}  
		});

		$('#infoValidate').click(function(){
			if(!$('#project-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-2').addClass('show');
					$('#errorMessage').text('Select a project to proceed');
					$('.toast.toast--error').toast('show'); 
					exit();
				} 

			 var lead_id 		= $('#lead_id'); 
			 var first_name 	= $('#first_name');
			 var last_name 		= $('#last_name');
			 var phone 			= $('#phone');
			 var email 			= $('#email');
			 var pays 			= $('#pays');
			 var postal_code 	= $('#postal_code');
			 var city 			= $('#city');
			 var address 		= $('#address');
			 var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 
			 if(first_name.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 first_name.focus();
			} 

			 else if(last_name.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 last_name.focus();
			} 

			 else if(phone.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 phone.focus();
			} 
			 
			 else if(email.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 email.focus();
			} 
			else if(!regex.test(email.val())){
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 email.focus();
			}
			 
			 else if(pays.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 pays.focus();
			} 
			 
			 else if(postal_code.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 postal_code.focus();
			} 
			 
			 else if(city.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 city.focus();
			} 
			 
			 else if(address.val() == ''){ 
				$('#infoValidate').attr('data-toggle', false);
				$('#info-verify').removeClass('verified'); 
				 address.focus();
			} 
			 
			else{
				$('#infoValidate').attr('data-toggle', 'collapse');
				$('#info-verify').addClass('verified');

				$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
				$.ajax({
					type: "POST", 
					url:"{{ route('lead.info.update') }}",
					data: {
						lead_id		:lead_id.val(),
						first_name	:first_name.val(),
						last_name	:last_name.val(),
						phone		:phone.val(),
						email		:email.val(),
						pays 		:pays.val(),
						postal_code	:postal_code.val(),
						city		:city.val(),
						address		:address.val(),
					},
					success: function(data){
						$("#email-address").text(data.email);
						$("#telephone").text(data.phone); 
						$("#department").text(data.department); 
						$("#zone").text(data.zone); 
						$("#userStatus").text(data.first_name+" "+data.last_name); 
						
						$('#successMessage').text(data.alert);
						$('.toast.toast--success').toast('show'); 
					},
					
				}); 
			}  
		});

		$('#presentWorkValidate').click(function(e){
			if(!$('#project-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-2').addClass('show');
					$('#errorMessage').text('Select a project to proceed');
					$('.toast.toast--error').toast('show'); 
					exit();
				}

			e.preventDefault();
			 var lead_id 				= $('#lead_id');
			 var present_country 		= $('#present_country');
			 var present_city 			= $('#present_city'); 
			 var present_zipcode 		= $('#present_zipcode');
			 var present_address 		= $('#present_address'); 
 
			 if(present_country.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Country Name') }}");
				$('.toast.toast--error').toast('show'); 
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified'); 
				 present_country.focus();
			} 

			 else if(present_zipcode.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Zip Code') }}");
				$('.toast.toast--error').toast('show'); 
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified'); 
				 present_zipcode.focus();
			} 

			 else if(present_city.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter City Name') }}");
				$('.toast.toast--error').toast('show'); 
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified'); 
				 present_city.focus();
			} 
			 
			 else if(present_address.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Address') }}");
				$('.toast.toast--error').toast('show'); 
				$('#presentWorkValidate').attr('data-toggle', false);
				$('#present-work-verify').removeClass('verified'); 
				 present_address.focus();
			} 
			 
			else{

				$('#present-work-verify').addClass('verified');
				$('#presentWorkValidate').attr('data-toggle', 'collapse');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST", 
					url :"{{ route('lead.present.work.update') }}",
					data: {
						lead_id 			: lead_id.val(),
						present_country		: present_country.val(),
						present_city		: present_city.val(),
						present_zipcode		: present_zipcode.val(),
						present_address		: present_address.val(),
					},
					 
					success: function(data){
						$('#successMessage').text(data);
						$('.toast.toast--success').toast('show');
					},
					
				}); 
			}  
		});
		$('#workValidate').click(function(e){
			if(!$('#project-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-2').addClass('show');
					$('#errorMessage').text('Select a project to proceed');
					$('.toast.toast--error').toast('show'); 
					exit();
				}

			e.preventDefault();
			 var lead_id 				= $('#lead_id');
			 var natureOccupation 		= $('#natureOccupation');
			 var heatingType 			= $('#heatingType'); 
			 var housingType 			= $('#housingType');
			 var electricity_connection = $('#electricity_connection');
			 var livingSpace 			= $('#livingSpace');
			 var cadstrablePlot  		= $('#cadstrablePlot');
			 var floorArea 				= $('#floorArea');
			 var houseType 				= $('#houseType');
			 var basement 				= $('#basement');
 
			 if(natureOccupation.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Nature Occupation') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 natureOccupation.focus();
			} 

			 else if(heatingType.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Heating Type') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 heatingType.focus();
			} 
			 
			 else if(housingType.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Housing Type') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 housingType.focus();
			} 
			 
			 else if(electricity_connection.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Electricity Connection') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 electricity_connection.focus();
			} 
			 else if(livingSpace.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Living Space') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 livingSpace.focus();
			} 
			 
			 else if(cadstrablePlot.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Cadstrable Plot') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 cadstrablePlot.focus();
			} 
			 
			 else if(floorArea.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Floor Area') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 floorArea.focus();
			} 
			 
			 else if(houseType.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter House Type') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 houseType.focus();
			} 
			 
			 else if(basement.val() == ''){ 
				$('#errorMessage').text("{{ __('Please Enter Basement') }}");
				$('.toast.toast--error').toast('show'); 
				$('#workValidate').attr('data-toggle', false);
				$('#work-verify').removeClass('verified'); 
				 basement.focus();
			} 
			 
			else{

				$('#work-verify').addClass('verified');
				$('#workValidate').attr('data-toggle', 'collapse');
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST", 
					url :"{{ route('lead.work.update') }}",
					data: {
						lead_id 					: lead_id.val(),
						nature_occupation			: natureOccupation.val(),
						heating_type				: heatingType.val(),
						housing_type				: housingType.val(),
						electricity_connection		: electricity_connection.val(),
						living_space				: livingSpace.val(),
						cadstrable_plot				: cadstrablePlot.val(),
						floor_area					: floorArea.val(),
						house_type					: houseType.val(),
						with_basement				: basement.val(), 
					},
					success: function(data){
						$('#successMessage').text(data);
						$('.toast.toast--success').toast('show');
					},
					
				}); 
			}  
		});

		$('#preValidateBtn').click(function(){ 

				if(!$('#lead-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-1').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Lead Task");
					$('.toast.toast--error').toast('show');
					exit();
				}
				else if(!$('#project-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-2').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Project Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#tax-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-3').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Tax Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#info-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-4').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Info Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#work-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-5').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Work Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else{ 
					var lead_id 		= $('#lead_id').val();
					var status 			= 'pre-validated';

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST", 
						url: "{{ route('lead.status.update') }}",
						data: {
							lead_id : lead_id,
							status  : status,
						},
						success: function(data){
							if(data.error){
								$('#leftAsideModal').modal('hide');
								$('#errorMessage').text(data.error);
								$('.toast.toast--error').toast('show');
							}
							else{
								$('#lead_status').text("{{ __('Pre-Validated') }}");
								$('#leftAsideModal').modal('hide');
								$('#userStatus').removeClass('verified');
								$('#TurnToCustomer').removeClass('d-inline-flex');
								// $('#appoinmentBtn').removeClass('d-block');
								// $('#appoinmentBtn').addClass('d-none');
								$('#TurnToCustomer').addClass('d-none');
								$('#successMessage').text(data.success);
								$('.toast.toast--success').toast('show');
								$('#notificationCount').text(data.count);
								$('#notificationList').html(data.response);
								$('#notifyIconVibrate').addClass('active');

							}
					
						},
						
					});
				} 
		});

		$('#leadVerifyBtn').click(function(){ 

				if(!$('#lead-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-1').addClass('show'); 
					$('#leftAsideModal').modal('hide'); 
					exit();
				}
				else if(!$('#project-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-2').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Project Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#tax-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-3').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Tax Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#info-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-4').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Info Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else if(!$('#work-verify').hasClass('verified'))
				{
					$('#leadCardCollapse-5').addClass('show'); 
					$('#leftAsideModal').modal('hide');
					$('#errorMessage').text("Please Complete Work Task");
					$('.toast.toast--error').toast('show');
					exit();
				}

				else{ 
					var lead_id 		= $('#lead_id').val();
					var status 			= 'verified';

					$.ajaxSetup({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}
					});
					$.ajax({
						type: "POST", 
						url: "{{ route('lead.status.update') }}",
						data: {
							lead_id : lead_id,
							status  : status,
						},
						success: function(data){
							if(data.error){
								$('#leftAsideModal').modal('hide');
								$('#errorMessage').text(data.error);
								$('.toast.toast--error').toast('show');
							}
							else{
								$('#lead_status').text("{{ __('Verified') }}");
								$('#leftAsideModal').modal('hide');
								$('#userStatus').addClass('verified');
								$('#TurnToCustomer').removeClass('d-none');
								$('#TurnToCustomer').addClass('d-inline-flex');
								// $('#appoinmentBtn').addClass('d-block');
								$('#successMessage').text(data.success);
								$('.toast.toast--success').toast('show');  
								$('#notificationCount').text(data.count); 
								$('#notificationList').html(data.response);
								$('#notifyIconVibrate').addClass('active');
							}
						

						},
						
					});
				} 
		});

		$('#leadToCustomer').click(function(e){
			 
			e.preventDefault();
			var project = $('input[name="project_name_m"]:checked').val();
			var funding = $('input[name="funding"]:checked');
			var company_id = $('#company_id').val();
			var lead_id = $('#lead_id').val();
			if(project.length == 0){ 
				$('#errorMessage').text("{{ __('Please Select Project') }}");
				$('.toast.toast--error').toast('show');
			}
			else if(funding.length == 0){
				$('#errorMessage').text("{{ __('Please Select Funding') }}");
				$('.toast.toast--error').toast('show');
			}
			
			else{
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST", 
					url: "{{ route('lead.to.client') }}",
					data: {
						lead_id 	: lead_id,
						 company_id : company_id ,
						 project	:project,
						 funding	: funding.val(),
					},
					success: function(data){
						// alert(data);
						// if(data.error){
						// 	$('#leftAsideModal').modal('hide');
						// 	$('#errorMessage').text(data.error);
						// 	$('.toast.toast--error').toast('show');
						// }
						// else{
						// 	$('#lead_status').text("{{ __('Verified') }}");
						// 	$('#leftAsideModal').modal('hide');
						// 	$('#userStatus').addClass('verified');
						// 	$('#TurnToCustomer').removeClass('d-none');
						// 	$('#TurnToCustomer').addClass('d-inline-flex');
						// 	// $('#appoinmentBtn').addClass('d-block');

							// $('#TurnToCustomer').text("{{ __('Create A New Project') }}");
							$('#rightAsideModal').modal('hide');
							$('#successMessage').text("{{ __('Lead to Customer Converted') }}");
							$('.toast.toast--success').toast('show'); 
							window.location.href = '/admin/client-update/'+data;
						// }
					

					}, 

					
				});
			}
		});

		$('.collapseBtn').click(function(){
			if(!$('#lead-verify').hasClass('verified')){
				$(this).removeClass('collapsed'); 
				$(this).attr('data-toggle', false);
				$('#leadCardCollapse-1').addClass('show');
				$('#errorMessage').text("{{ __('First Fill Lead Tracking Form') }}");
				$('.toast.toast--error').toast('show');
			} 	
		})
		$('#personal_info_collapse_btn').click(function(){
			if(!$('#lead-verify').hasClass('verified')){
				$(this).removeClass('collapsed'); 
				$(this).attr('data-toggle', false);
				$('#leadCardCollapse-1').addClass('show');
				$('#errorMessage').text("{{ __('First Fill Lead Tracking Form') }}");
				$('.toast.toast--error').toast('show');
			} 
			else if(!$('#tax-verify').hasClass('verified')){
				$(this).removeClass('collapsed'); 
				$(this).attr('data-toggle', false);
				$('#leadCardCollapse-3').addClass('show');
				$('#errorMessage').text("Verify Tax to proceed");
				$('.toast.toast--error').toast('show');
			} 	
		})

		$('body').on('click', '.infoValidateBtn', function(){
			var id = $(this).attr('data-tax-id');
			var  title = $('#title'+id);
			var lead_id 	= $('#lead_id').val(); 
			var company_id 	= $('#company_id').val();  
			var  second_title = $('#second_title'+id); 
			var  phone = $('#phone'+id);
			var  email = $('#email'+id); 

			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				

				if(phone.val() == ''){ 
					$('#errorMessage').text("{{ __('Please Enter Phone Number') }}");
					$('.toast.toast--error').toast('show'); 
					$('#infoValidate').attr('data-toggle', false); 
					phone.focus();
				} 
				else if(phone.val().length > 11){
					$('#errorMessage').text("{{ __('Please Enter Valid Phone Number') }}");
					$('.toast.toast--error').toast('show');  
					$('#infoValidate').attr('data-toggle', false);  
					phone.focus();
				} 
				
				else if(email.val() == ''){ 
					$('#errorMessage').text("{{ __('Please Enter Email') }}");
					$('.toast.toast--error').toast('show'); 
					$('#infoValidate').attr('data-toggle', false); 
					email.focus();
				} 
				else if(!regex.test(email.val())){
					$('#errorMessage').text("{{ __('Please Enter Valid Email') }}");
					$('.toast.toast--error').toast('show'); 
					$('#infoValidate').attr('data-toggle', false); 
					email.focus();
				} 
				else{

					// alert('success');
					// $('#infoValidate').attr('data-toggle', 'collapse');
					// $('#info-verify').addClass('verified');

					$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
					$.ajax({
						type: "POST", 
						url:"{{ route('tax.info.update') }}",
						data: {
							tax_id				:id,
							title				:title.val(),
							lead_id				:lead_id,
							company_id			:company_id,
							// first_name			:first_name.val(),
							// last_name			:last_name.val(),
							second_title		:second_title.val(),
							// second_first_name	:second_first_name.val(),
							// second_last_name	:second_last_name.val(),
							// kids				:kids.val(),
							phone				:phone.val(),
							email				:email.val(),
							// pays 				:pays.val(),
							// postal_code			:postal_code.val(),
							// city				:city.val(),
							// address				:address.val(),
						},

						success: function(data){

							if(data.email){ 
								$("#email-address").text(data.email); 
							}
							if(data.phone){ 
								$("#telephone").text(data.phone);
							}
							if(data.name){
								$("#userStatus").text(data.name); 
							}
							$('#leadCardCollapse-4').collapse('hide');
							$('#info-verify').addClass('verified'); 
							// $("#userStatus").text(data.first_name+" "+data.last_name); 
							
							$('#successMessage').text(data.alert);
							$('.toast.toast--success').toast('show'); 
						},
						
					}); 
				} 

		});

		$('body').on('click', '.taxCheckedBtn', function(){
			var tax_id 		= $(this).attr('data-tax-id');
			var lead_id 	= $('#lead_id').val();
			var company_id 	= $('#company_id').val();

			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			$.ajax({
				type: "POST", 
				url: "{{ route('tax.primary.change') }}",
				data: {
						lead_id 	: lead_id,
						company_id 	: company_id ,
						tax_id		:tax_id,
				},
				success: function(data){

					$('#leadCardCollapse-4').html(data.taxes);
					$('#infoValidate').attr('data-toggle', 'collapse');
					$('#info-verify').addClass('verified');
					$("#zone").text(data.zone); 
					$("#precarious").text(data.precariousness);
					$("#department").text(data.city);
					$("#userStatus").text(data.name);
					$("#email-address").text(data.email);
					$("#telephone").text(data.phone);
					// $("#userStatus").text(data.first_name+" "+data.last_name); 
					
					$('#successMessage').text(data.alert);
					$('.toast.toast--success').toast('show'); 
				

				}, 

				
			});
		});

	});
</script>
	
@endpush