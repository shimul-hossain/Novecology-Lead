{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Company Leads') }}
@endsection

{{-- active menu  --}}
@section('leadIndex')
active
@endsection

{{-- php code  --}}


@php
$filter_status = App\Models\CRM\LeadHeaderFilter::where('user_id', Auth::id())->orderBy('lead_header_id', 'asc')->get();
$customFilterStatus = \App\Models\CustomLeadFilter::where('user_id', Auth::id())->get();
@endphp

{{-- Main Content Part  --}}
@section('content')
    	<!-- Banner Section -->
		<section class="banner section-gap position-relative">
			<div class="container">
				<a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a>
				<div class="row justify-content-center">
					<div class="col-12">
						<h1 class="text-center text-white">{{ $company->company_name }}</h1>
						<p class="text-center text-white mb-2 mb-xl-0">{{ $company->company_title }}</p>
					</div>
					<div class="col-12 d-flex flex-wrap align-items-center justify-content-md-end mb-3">
						<input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input w-25 mr-auto" id="company_lead_search_bar">
						@if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
						<button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill  align-items-center justify-content-center border-0 mr-2 mt-3 mt-xl-0 d-none" id="leadBulkAssignFormButton" form="leadBulkAssignForm" data-toggle="modal" data-target="#middleModal3">
							{{ __('Bulk Assign') }}
						</button>
						@endif	 
						@if (checkAction(Auth::id(), 'lead', 'delete') || role() == 's_admin')
						<button type="buttoh" class="primary-btn primary-btn--white primary-btn--md rounded-pill  align-items-center justify-content-center border-0 mr-2 mt-3 mt-xl-0 d-none" id="leadDeleteFormButton">
							{{ __('Delete') }}
					   </button>
					   @endif
						<button type="submit" class="primary-btn primary-btn--white primary-btn--md rounded-pill  align-items-center justify-content-center border-0 mr-2 mt-3 mt-xl-0 d-none" id="leadAssignFormButton" form="leadAssignForm">
							{{ __('Selected Download') }}
					   </button>
					   @if (checkAction(Auth::id(), 'general__setting', 'status') || role() == 's_admin') 
						<button type="button" data-toggle="modal" data-target="#leadStatusModel" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0 mr-2 mt-3 mt-xl-0">
							{{ __('Create Status') }}
							</button> 
						@endif
						@if (checkAction(Auth::id(), 'lead', 'create') || role() == 's_admin')
							<button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0 mr-2 mt-3 mt-xl-0">
								<a href="{{ route('leads.index', $company->id) }}">{{ __('Create New Lead') }}</a> 
							</button>
						@endif	
						<label class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0 mr-2 mb-0 mt-3 mt-xl-0" for="fileLeadImport">
							 {{ __('Import a lead') }} 
						</label>
						<button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0 mr-2 mt-3 mt-xl-0">
							<span class="novecologie-icon-csv-icon primary-btn__icon mr-2"></span>
							<a id="downloadBtn" href="{{ route('leads.export', 'in-progress') }}">{{ __('Download') }}</a>
						</button>
						{{-- <button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 d-xl-none mt-3">+ {{ __('Add filter') }}</button> --}}
						<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 d-inline-block mt-3 mt-xl-0">+ {{ __('Add filter') }}</button>
					</div>
					<div class="col-12">
						<ul class="nav nav-pills" id="tables-pills-tab" role="tablist">
							<li class="nav-item" role="presentation" >
								<a class="nav-link active" id="pills-tab-1" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">{{ __('In Progress') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-tab-2" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">{{ __('Pre-validate') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-tab-3" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">{{ __('Checked') }}</a>
							</li>
						</ul>
						<form action="{{ route('lead.assign.checkbox', ['in-progress', $company->id]) }}" method="POST" id="leadAssignForm">
							@csrf
							<div id="pu"></div>
						<div class="tab-content bg-white" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-tab-1">
								<div class="database-table-wrapper bg-white">
									<div class="table-responsive simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
											<thead class="database-table__header">
												<tr>
													<th>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" name="checkAll" value="1" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheck-1">
															<label class="custom-control-label" for="tableAllSelectCheck-1"></label>
														</div>
													</th>
													@if ($filter_status->count() == 0)
														<th class="text-left">{{ __('ID') }}</th>
														<th>
															{{-- <input type="search" data-item="first name" placeholder="{{ __('First name') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('First name') }}
														</th>
														<th>
															{{-- <input type="search" data-item="phone" placeholder="{{ __('Phone number') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Phone number') }}
														</th>
														<th>
															{{-- <input type="search" data-item="email" placeholder="{{ __('Email') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Email') }}
														</th>
														<th>
															{{-- <input type="search" data-item="postal code" placeholder="{{ __('Postal code') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Postal code') }}
														</th>
														<th>
															{{-- <input type="search" data-item="heating type" placeholder="{{ __('Heating mode') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Heating mode') }}
														</th>  
													@else 
														@foreach ($headers as $header)  
															@foreach ($filter_status as $item)

																@if ($item->lead_header_id == $header->id)
																	{{-- @if ($header->header == 'ID')
																		<th>
																			{{ $header->header }}
																		</th>
																	@else --}}
																		<th> 
																			{{-- <input type="search" data-item="{{ $header->header }}" placeholder="{{ $header->header }}" class="database-table__search-input w-100
																			@if ($header->header == 'zone' 
																				|| $header->header == 'phone'
																				|| $header->header == 'téléphone'
																				|| $header->header == 'postal code'
																				|| $header->header == 'code postal'
																			)
																			database-table__search-input--auto
																			@endif
																			companyLeadSearchBox"> --}}
																			{{ $header->header }}
																		</th> 	
																	{{-- @endif  --}}
																	
																@endif 
															@endforeach  
														@endforeach 	
													@endif
													<th>
														{{ __('Comment') }}
													</th>
													<th>
														{{ __('Status') }}
													</th>
													<th class="text-center">
														{{ __('Assignee') }}
													</th>
													
													<th class="text-center">
														{{ __('Actions') }}
													</th>
												</tr>
											</thead>
											<tbody class="database-table__body" id="progressLeadSearch">
												@include('includes.crm.progress_leads')
											</tbody>
										</table>
									</div>

									<div class="pagination-wrapper">
										{{ $progress_leads->onEachSide(1)->links() }}
									</div> 
								</div>
							</div>
							<div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-tab-2">
								<div class="database-table-wrapper bg-white">
									<div class="table-responsive simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
											<thead class="database-table__header">
												<tr>
													<th>
														<div class="custom-control custom-checkbox">
															<input type="checkbox"
															name="checkAll" value="1"  class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheck-2">
															<label class="custom-control-label" for="tableAllSelectCheck-2"></label>
														</div>
													</th>
													@if ($filter_status->count() == 0)
														<th class="text-left">{{ __('ID') }}</th>
														<th>
															{{-- <input type="search" data-item="first name" placeholder="{{ __('First name') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('First name') }}
														</th>
														<th>
															{{-- <input type="search" data-item="phone" placeholder="{{ __('Phone number') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Phone number') }}
														</th>
														<th>
															{{-- <input type="search" data-item="email" placeholder="{{ __('Email') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Email') }}
														</th>
														<th>
															{{-- <input type="search" data-item="postal code" placeholder="{{ __('Postal code') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Postal code') }}
														</th>
														<th>
															{{-- <input type="search" data-item="heating type" placeholder="{{ __('Heating mode') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Heating mode') }}
														</th>  
													@else 
														@foreach ($headers as $header)  
															@foreach ($filter_status as $item)

																@if ($item->lead_header_id == $header->id)
																	{{-- @if ($header->header == 'ID')
																		<th>
																			{{ $header->header }}
																		</th>
																	@else --}}
																		<th> 
																			{{-- <input type="search" data-item="{{ $header->header }}" placeholder="{{ $header->header }}" class="database-table__search-input w-100
																			@if ($header->header == 'zone' 
																					|| $header->header == 'phone'
																					|| $header->header == 'téléphone'
																					|| $header->header == 'postal code'
																					|| $header->header == 'code postal'
																				)
																				database-table__search-input--auto
																				@endif
																			companyLeadSearchBox"> --}}
																			{{ $header->header }}
																		</th> 	
																	{{-- @endif --}}
																	
																@endif 
															@endforeach  
														@endforeach 	
													@endif
													<th>
														{{ __('Comment') }}
													</th>
													<th>
														{{ __('Status') }}
													</th>
													<th class="text-center">
														{{ __('Assignee') }}
													</th>
													<th class="text-center">
														{{ __('Actions') }}
													</th>
												</tr>
											</thead>
											<tbody class="database-table__body" id="preValidateLeadSearch">
												 @include('includes.crm.pre_validate_leads')
											</tbody>
										</table>
									</div>
									<div class="pagination-wrapper">
										{{ $pre_validate_leads->onEachSide(1)->links() }}  
									</div> 
								</div>
							</div>
							<div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-tab-3">
								<div class="database-table-wrapper bg-white">
									<div class="table-responsive simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
											<thead class="database-table__header">
												<tr>
													<th>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" 
															name="checkAll" value="1" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheck-3">
															<label class="custom-control-label" for="tableAllSelectCheck-3"></label>
														</div>
													</th>
													@if ($filter_status->count() == 0)
														<th class="text-left">{{ __('ID') }}</th>
														<th>
															{{-- <input type="search" data-item="first name" placeholder="{{ __('First name') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('First name') }}
														</th>
														<th>
															{{-- <input type="search" data-item="phone" placeholder="{{ __('Phone number') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Phone number') }}
														</th>
														<th>
															{{-- <input type="search" data-item="email" placeholder="{{ __('Email') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Email') }}
														</th>
														<th>
															{{-- <input type="search" data-item="postal code" placeholder="{{ __('Postal code') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Postal code') }}
														</th>
														<th>
															{{-- <input type="search" data-item="heating type" placeholder="{{ __('Heating mode') }}" class="database-table__search-input w-100 companyLeadSearchBox"> --}}
															{{ __('Heating mode') }}
														</th> 
													@else 
														@foreach ($headers as $header)  
															@foreach ($filter_status as $item)

																@if ($item->lead_header_id == $header->id)
																	{{-- @if ($header->header == 'ID')
																		<th>
																			{{ $header->header }}
																		</th>
																	@else --}}
																		<th> 
																			{{-- <input type="search" data-item="{{ $header->header }}" placeholder="{{ $header->header }}" class="database-table__search-input w-100
																			@if ($header->header == 'zone' 
																				|| $header->header == 'phone'
																				|| $header->header == 'téléphone'
																				|| $header->header == 'postal code'
																				|| $header->header == 'code postal'
																			)
																			database-table__search-input--auto
																			@endif
																			companyLeadSearchBox"> --}}
																			{{ $header->header }}
																		</th> 	
																	{{-- @endif --}}
																	
																@endif 
															@endforeach  
														@endforeach 	
													@endif
													<th>
														{{ __('Comment') }}
													</th>
													<th>
														{{ __('Status') }}
													</th>
													<th>
														{{ __('Assignee') }}
													</th>
													  
													<th class="text-center">
														{{ __('Actions') }}
													</th>
												</tr>
											</thead>
											<tbody class="database-table__body" id="verifiedLeadSearch">
												
												@include('includes.crm.verified_leads')
											</tbody>
										</table>
									</div>
									<div class="pagination-wrapper">
										 {{ $verified_leads->onEachSide(1)->links() }} 
									</div> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		 {{-- Company Id field  --}}
		 <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">

		<!-- Left Aside Modal -->
	<!-- Left Aside Modal -->
	@foreach ($all_leads as $lead)
		<div class="modal modal--aside fade leftAsideModal" id="leftAsideModal{{ $lead->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body text-center">
					<h1 class="modal-title mb-5">{{ __('Choose a status') }}</h1>
					{{-- <button class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">To remind</button>
					<button class="primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">NRP</button>
					<button class="primary-btn primary-btn--pink-dark primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3" type="button">No more news</button> --}}
					<button data-lead_id="{{ $lead->id }}" class="primary-btn primary-btn--purple primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3 leadStatusToCurrent" type="button">{{ __('Lead in-progress') }}</button>
					<button data-lead_id="{{ $lead->id }}" class="primary-btn primary-btn--pink primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3 leadStatusToValidate" type="button">{{ __('Lead pre-validate') }}</button>
					<button data-lead_id="{{ $lead->id }}" class="primary-btn primary-btn--sky primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3 leadStatusToVerify" type="button">{{ __('Verified lead') }}</button>
				</div>
			</div>
			</div>
		</div> 
	@endforeach

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
						<h1 class="modal-title text-center">{{ __('Additional filters') }}</h1>
						<p class="modal-text text-center mb-4">{{ __('Filter your tables with your custom columns') }}</p>
						<form action="{{ route('lead.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
							@csrf 
							<h2 class="modal-sub-title position-relative">{{ __('Foyer') }}</h2>
							<div class="row">
								@if ($filter_status->count() == 0)
									@foreach ($headers as $key => $header)
												@if (
												   $header->header == 'heating type' 
												|| $header->header == 'type de chauffage' 
												|| $header->header == 'electricity connection' 
												|| $header->header == 'branchement électrique' 
												|| $header->header =='house type' 
												|| $header->header =='type de maison' 
												
												)
												<div class="col-md-3">
													<div class="custom-control custom-checkbox"> 
														<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]"
															@if(
																$header->header == 'heating type' 
															|| 	$header->header == 'type de 
															chauffage'  
															)
															checked
															@endif
														>
														<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
													</div>
												</div> 
												@endif 
									@endforeach 
								@else
									@foreach ($headers as $key => $header) 
												@if (
												   $header->header == 'heating type' 
												|| $header->header == 'type de chauffage' 
												|| $header->header == 'electricity connection' 
												|| $header->header == 'branchement électrique' 
												|| $header->header =='house type' 
												|| $header->header =='type de maison' 
												)
											

												<div class="col-md-4">
													<div class="custom-control custom-checkbox"> 
														<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" 
															@foreach ($filter_status as $item)
																@if ( $header->id == $item->lead_header_id)
																	checked
																@endif
															@endforeach
														>
														<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
													</div>
												</div> 
												@endif 
									@endforeach 
								@endif  
							</div>
							<h2 class="modal-sub-title position-relative mt-5">{{ __('Address') }}</h2>
							<div class="row">
								@if ($filter_status->count() == 0)
									@foreach ($headers as $key => $header)
												@if (
										
												$header->header == 'postal code'
												|| $header->header == 'code postal'  
												|| $header->header == 'country'
												|| $header->header =='pays' 
												|| $header->header =='zone'
												|| $header->header == 'zone' 
												|| $header->header == 'city' 
												|| $header->header =='ville' 
												
												)
												<div class="col-md-3">
													<div class="custom-control custom-checkbox"> 
														<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]"
															@if ($header->header == 'postal code'
															|| $header->header == 'code postal'
															)
															checked
															@endif
														>
														<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
													</div>
												</div> 
												@endif 
									@endforeach 
								@else
									@foreach ($headers as $key => $header) 
												@if (
												$header->header == 'postal code'
												|| $header->header == 'code postal'  
												|| $header->header == 'country'
												|| $header->header =='pays' 
												|| $header->header =='zone'
												|| $header->header == 'zone' 
												|| $header->header == 'city' 
												|| $header->header =='ville' 
												)
											

												<div class="col-md-4">
													<div class="custom-control custom-checkbox"> 
														<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" 
															@foreach ($filter_status as $item)
																@if ( $header->id == $item->lead_header_id)
																	checked
																@endif
															@endforeach
														>
														<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
													</div>
												</div> 
												@endif 
									@endforeach 
								@endif  
							</div>
							<h2 class="modal-sub-title position-relative mt-5">{{ __('Personal Info') }}</h2>
							<div class="row">
								@if ($filter_status->count() == 0)
									@foreach ($headers as $key => $header)
												@if (
												$header->header == 'ID'
												|| $header->header == 'first name'  
												|| $header->header =='prénom' 
												|| $header->header =='email'
												|| $header->header == 'e-mail' 
												|| $header->header == 'phone' 
												|| $header->header =='téléphone'  
												
												)
												<div class="col-md-3">
													<div class="custom-control custom-checkbox"> 
														<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" 
														@if ($header->header == 'ID'|| $header->header == 'first name'  
														|| $header->header =='prénom'
														|| $header->header =='email'
														|| $header->header == 'e-mail' 
														|| $header->header == 'phone' 
														|| $header->header =='téléphone'   )
															checked
														@endif
														>
														<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
													</div>
												</div> 
												@endif 
									@endforeach 
								@else
									@foreach ($headers as $key => $header) 
												@if (
									
												$header->header == 'ID'
												|| $header->header == 'first name'  
												|| $header->header =='prénom' 
												|| $header->header =='email'
												|| $header->header == 'e-mail' 
												|| $header->header == 'phone' 
												|| $header->header =='téléphone'   
												)
											

												<div class="col-md-4">
													<div class="custom-control custom-checkbox"> 
														<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" 
															@foreach ($filter_status as $item)
																@if ( $header->id == $item->lead_header_id)
																	checked
																@endif
															@endforeach
														>
														<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
													</div>
												</div> 
												@endif 
									@endforeach 
								@endif  
							</div>
							<h2 class="modal-sub-title position-relative mt-5">{{ __('Others') }}</h2>
							<div class="row">
								@if ($filter_status->count() == 0)
									@foreach ($headers as $key => $header)
										@if (
											$header->header == 'heating type' 
											|| $header->header == 'type de chauffage' 
											|| $header->header == 'electricity connection' 
											|| $header->header == 'branchement électrique' 
											|| $header->header =='house type' 
											|| $header->header =='type de maison'
											|| $header->header == 'postal code'
											|| $header->header == 'code postal'  
											|| $header->header == 'country'
											|| $header->header =='pays' 
											|| $header->header =='zone'
											|| $header->header == 'zone' 
											|| $header->header == 'city' 
											|| $header->header =='ville'
											|| $header->header == 'ID'
											|| $header->header == 'first name'  
											|| $header->header =='prénom' 
											|| $header->header =='email'
											|| $header->header == 'e-mail' 
											|| $header->header == 'phone' 
											|| $header->header =='téléphone'   
											)
										@continue
										@else 
										<div class="col-md-3">
											<div class="custom-control custom-checkbox"> 
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]">
												<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
											</div>
										</div> 
										@endif 
									@endforeach 
								@else
									@foreach ($headers as $key => $header) 
										@if (
											$header->header == 'heating type' 
										|| $header->header == 'type de chauffage' 
										|| $header->header == 'electricity connection' 
										|| $header->header == 'branchement électrique' 
										|| $header->header =='house type' 
										|| $header->header =='type de maison'
										|| $header->header == 'postal code'
										|| $header->header == 'code postal'  
										|| $header->header == 'country'
										|| $header->header =='pays' 
										|| $header->header =='zone'
										|| $header->header == 'zone' 
										|| $header->header == 'city' 
										|| $header->header =='ville'
										|| $header->header == 'ID'
										|| $header->header == 'first name'  
										|| $header->header =='prénom' 
										|| $header->header =='email'
										|| $header->header == 'e-mail' 
										|| $header->header == 'phone' 
										|| $header->header =='téléphone'   
										)
										@continue
										@else 

										<div class="col-md-4">
											<div class="custom-control custom-checkbox"> 
												<input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" 
													@foreach ($filter_status as $item)
														@if ( $header->id == $item->lead_header_id)
															checked
														@endif
													@endforeach
												>
												<label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
											</div>
										</div> 
										@endif 
									@endforeach 
								@endif  
							</div> 
							<div class="row">
								<div class="col text-center"> 
									<button type="submit" class="secondary-btn primary-btn--md border-0 mt-4">{{ __('Filter') }}</button> 
								</div>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>

 
		<!-- Lead Import Modal -->
		<div class="modal fade" id="leadImportModal" tabindex="-1" aria-labelledby="leadImportModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
				<h3 class="modal-title" id="leadImportModalLabel">{{ __('Import a lead') }} </h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>
				<div class="modal-body">
					<form action="{{ route('leads.import') }}" class="form" method="POST" id="leadImportForm" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<input type="file" id="fileLeadImport" name="file" class="form-control shadow-none">
								</div>
							</div> 
							<div class="col-12 text-center">
								<button id="newCompanyForm" type="submit" data-toggle="collapse" data-target="#leadCardCollapse-2" aria-expanded="false" aria-controls="leadCardCollapse-2" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0">
									{{ __('Import') }} <span class="novecologie-icon-arrow-right ml-3"></span>
								</button>
							</div>
						</div>
					</form>
				</div> 
			</div>
			</div>
		</div>

		<!-- lead Assign Modal -->
		<div class="modal modal--aside fade" id="middleModal2" tabindex="-1" aria-labelledby="middleModal2Label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.assign') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">{{__('Assign Leads')}}</h1> 
							<div class="form-group d-flex flex-column align-items-center position-relative" id="leadAssignModal"> 
								@include('includes.crm.leadassign')
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{__('Assign')}}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Middle Modal -->
		<div class="modal modal--aside fade" id="middleModal3" tabindex="-1" aria-labelledby="middleModal3Label" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.bulk.assign') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">{{__('Assign Leads')}}</h1> 
							<div class="form-group d-flex flex-column align-items-center position-relative" id="bu"> 
								<input type="hidden" name="lead_id" id="lead_id_assignee">
								<select class="select2_select_option form-control w-100" name="user_id[]" multiple required> 
										@foreach ($users as $user)
											<option value="{{ $user->id }}">{{ $user->name }}</option>  
										@endforeach
								</select>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{__('Assign')}}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal modal--aside fade" id="leadStatusModel" tabindex="-1" aria-labelledby="leadStatusModelLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body pt-0">
						<form action="{{ route('lead.create.status') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">{{ __('Create Lead Status') }}</h1>
							<div class="form-group">
								<label for="status" class="form-label">{{ __('Status') }}  <span class="text-danger">*</span></label>
								<input type="text" id="status" name="status" class="form-control shadow-none px-3"  placeholder="{{ __('Enter Status') }}" required> 
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div>
							<div class="form-group">
								<label for="status_color" class="form-label">{{ __('Status Color') }}  <span class="text-danger">*</span></label>
								<input type="color" id="status_color" name="status_color" class="form-control shadow-none px-3" placeholder="{{ __('Enter Status Color') }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div> 
							<div class="form-group">
								<label for="background_color" class="form-label">{{ __('Background Color') }}  <span class="text-danger">*</span></label>
								<input type="color" id="background_color" name="background_color" class="form-control shadow-none px-3" placeholder="{{ __('Enter Background Color') }}" required>
								<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
							</div> 
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Submit') }}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal modal--aside fade leftAsideModal" id="userStatusModel" tabindex="-1" aria-labelledby="userStatusModelLabel"  aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content border-0 h-100 rounded-0 simple-bar">
					<div class="modal-header border-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center">
						<h1 class="modal-title mb-5">{{ __('Status') }}</h1> 
						<form action="{{ route('lead.user_status.change') }}" id="leadStatusChangeForm" method="POST">
							@csrf
							<div class="row">
								<input type="hidden" name="lead_id" id="lead_id">
								<input type="hidden" name="lead_status_id" id="lead_status_id">

								@foreach ($lead_status as $status)

								<div class="col-4">
									<button style="color: {{ $status->status_color }}; background-color: {{ $status->background_color }};" data-status_id="{{ $status->id }}" class="primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 mb-3 laedStatusChange" type="button">{{ $status->status }}</button>  
									<span style="cursor: pointer" data-status-id="{{ $status->id }}" data-status="{{ $status->status }}" data-status-color="{{ $status->status_color }}" data-background-color="{{ $status->background_color }}" class="novecologie-icon-edit mr-1 leadStatusEditBtn"></span>
									
									&nbsp;<span style="cursor: pointer" class="novecologie-icon-trash mr-1 leadStatusDeleteBtn" data-status-id="{{ $status->id }}"></span>
								</div>
								@endforeach 
							</div>	
						</form>
						<form action="{{ route('lead.update.status') }}" method="POST" class="form needs-validation w-100" id="leadStatusEditForm" novalidate>
							@csrf
							
							<div class="text-left">
								<button type="button" id="bannerSliderBack" class="next-btn d-inline-block rounded border-0">
									<span class="novecologie-icon-chevron-left"></span>
								</button>
							</div>
							<div class="px-5">
								<div class="form-group text-left">
									<label for="status_edit" class="form-label">{{ __('Status') }}</label>
									<input type="text" id="status_edit" name="status" class="form-control shadow-none px-3"  placeholder="{{ __('Enter Status') }}" required> 
									<input type="hidden" name="status_id" id="status_id">
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div>
								<div class="form-group text-left">
									<label for="status_color_edit" class="form-label">{{ __('Status Color') }}</label>
									<input type="color" id="status_color_edit" name="status_color" class="form-control shadow-none px-3" placeholder="{{ __('Enter Status Color') }}" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div> 
								<div class="form-group text-left">
									<label for="background_color_edit" class="form-label">{{ __('Background Color') }}</label>
									<input type="color" id="background_color_edit" name="background_color" class="form-control shadow-none px-3" placeholder="{{ __('Enter Background Color') }}" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div> 
								<div class="form-group d-flex flex-column align-items-center mt-4">
									<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Submit') }}</button>
								</div>
							</div>
						</form>
						<form action="{{ route('lead.delete.status') }}" method="POST" id="leadStatusDeleteForm">
							@csrf
							<input type="hidden" name="lead_status_id" id="lead_status_id_dt">
						</form>
						 
					</div>
				</div>
			</div>
		</div>


		{{-- Bulk Delete Form  --}}
		<form id="leadDeleteForm" action="{{ route('lead.bulk.delete') }}" method="post">
			@csrf
			<div id="du"> 
			</div>
		</form>

@include('includes.crm.footer-contact')
		
@endsection 

@push('js') 
<script>
	$(document).ready(function(){
		$('#leadStatusEditForm').hide();
		
		$("#tableAllSelectCheck-1").on("click", function(){
			
			if($("#tableAllSelectCheck-1").is(":checked"))
			{
				$("#leadAssignFormButton").removeClass('d-none')
				$("#leadAssignFormButton").addClass('d-inline-flex')
				$("#leadBulkAssignFormButton").removeClass('d-none')
				$("#leadBulkAssignFormButton").addClass('d-inline-flex')
				$("#leadDeleteFormButton").removeClass('d-none')
				$("#leadDeleteFormButton").addClass('d-inline-flex')
				$(".checked").each(function(){
				$(this).attr("checked", true);

					
					// If the checkbox is checked put the values into an array 
					// and push the values into the array
					// Create an input with the value 
					// and append it to the div
					$('#pu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');
					$('#bu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');
					$('#du').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');



				});
			}
			else 
			{
				$("#leadAssignFormButton").removeClass('d-inline-flex')
				$("#leadAssignFormButton").addClass('d-none')
				$("#leadBulkAssignFormButton").removeClass('d-inline-flex')
				$("#leadBulkAssignFormButton").addClass('d-none')
				$("#leadDeleteFormButton").removeClass('d-inline-flex')
				$("#leadDeleteFormButton").addClass('d-none')
				$(".checked").each(function(){
				$(this).attr("checked", false);

					
					// If the checkbox is checked put the values into an array 
					// and push the values into the array
					// Create an input with the value
					// and append it to the div
					//  $('#pu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');



				});
			}

		});
		$("#tableAllSelectCheck-2").on("click", function(){
			
			if($("#tableAllSelectCheck-2").is(":checked"))
			{
				$("#leadAssignFormButton").removeClass('d-none')
				$("#leadAssignFormButton").addClass('d-inline-flex')
				$("#leadBulkAssignFormButton").removeClass('d-none')
				$("#leadBulkAssignFormButton").addClass('d-inline-flex')
				$("#leadDeleteFormButton").removeClass('d-none')
				$("#leadDeleteFormButton").addClass('d-inline-flex')
				$(".checked").each(function(){
				$(this).attr("checked", true);

					
					// If the checkbox is checked put the values into an array 
					// and push the values into the array
					// Create an input with the value 
					// and append it to the div
					$('#pu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');
					$('#bu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');
					$('#du').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');



				});
			}
			else 
			{
				$("#leadAssignFormButton").removeClass('d-inline-flex')
				$("#leadAssignFormButton").addClass('d-none')
				$("#leadBulkAssignFormButton").removeClass('d-inline-flex')
				$("#leadBulkAssignFormButton").addClass('d-none')
				$("#leadDeleteFormButton").removeClass('d-inline-flex')
				$("#leadDeleteFormButton").addClass('d-none')
				$(".checked").each(function(){
				$(this).attr("checked", false);

					
					// If the checkbox is checked put the values into an array 
					// and push the values into the array
					// Create an input with the value
					// and append it to the div
					//  $('#pu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');



				});
			}

		});
		$("#tableAllSelectCheck-3").on("click", function(){
			
			if($("#tableAllSelectCheck-3").is(":checked"))
			{
				$("#leadAssignFormButton").removeClass('d-none')
				$("#leadAssignFormButton").addClass('d-inline-flex')
				$("#leadBulkAssignFormButton").removeClass('d-none')
				$("#leadBulkAssignFormButton").addClass('d-inline-flex')
				$("#leadDeleteFormButton").removeClass('d-none')
				$("#leadDeleteFormButton").addClass('d-inline-flex')
				$(".checked").each(function(){
				$(this).attr("checked", true);

					
					// If the checkbox is checked put the values into an array 
					// and push the values into the array
					// Create an input with the value 
					// and append it to the div
					$('#pu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');
					$('#bu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');
					$('#du').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');



				});
			}
			else 
			{
				$("#leadAssignFormButton").removeClass('d-inline-flex')
				$("#leadAssignFormButton").addClass('d-none')
				$("#leadBulkAssignFormButton").removeClass('d-inline-flex')
				$("#leadBulkAssignFormButton").addClass('d-none')
				$("#leadDeleteFormButton").removeClass('d-inline-flex')
				$("#leadDeleteFormButton").addClass('d-none')
				$(".checked").each(function(){
				$(this).attr("checked", false);

					
					// If the checkbox is checked put the values into an array 
					// and push the values into the array
					// Create an input with the value
					// and append it to the div
					//  $('#pu').append('<input type="hidden" name="checkedLead[]" value="'+$(this).attr('data-id')+'">');



				});
			}

		});

		$('.checked').click( function(){

			var exist = $(this).val();
			if($(".checked").is(":checked"))
			{
				 $('.checked-lead').each(function(){
					if(exist == $(this).val()){
						 $(this).remove();
						 exit();
					}
				 });

				$("#leadAssignFormButton").removeClass('d-none')
				$("#leadAssignFormButton").addClass('d-inline-flex')
				$("#leadBulkAssignFormButton").removeClass('d-none')
				$("#leadBulkAssignFormButton").addClass('d-inline-flex')
				$("#leadDeleteFormButton").removeClass('d-none')
				$("#leadDeleteFormButton").addClass('d-inline-flex')
				$('#pu').append('<input type="hidden" class="checked-lead" name="checkedLead[]" value="'+$(this).val()+'">');
				$('#bu').append('<input type="hidden" class="checked-lead" name="checkedLead[]" value="'+$(this).val()+'">');
				$('#du').append('<input type="hidden" class="checked-lead" name="checkedLead[]" value="'+$(this).val()+'">');
			}
			else 
			{
				$('.checked-lead').each(function(){
					if(exist == $(this).val()){
						 $(this).remove(); 
					}
				 });

				$("#leadAssignFormButton").removeClass('d-inline-flex')
				$("#leadAssignFormButton").addClass('d-none')
				$("#leadBulkAssignFormButton").removeClass('d-inline-flex')
				$("#leadBulkAssignFormButton").addClass('d-none')
				$("#leadDeleteFormButton").removeClass('d-inline-flex')
				$("#leadDeleteFormButton").addClass('d-none')

			}
		})
		

	});	

	$('.commentTextareaField').blur(function(){
		var currentField = $(this);
		var comment = $(this).val();
		var lead_id = $(this).attr('data-id');
		if(currentField.val() != ''){
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				}); 

			$.ajax({
				type: "POST",
				url: "{{ route('update.comment') }}",
				data: {
					lead_id 	: lead_id,
					comment   	: comment,
				},
				success: function (response) {  
					currentField.val(response.comment); 
					$('#successMessage').text(response.alert);
					$('.toast.toast--success').toast('show');


				}, 
				error: function(response){  
					console.log(response);
				}
			});
		} 
		
	});

	$("#fileLeadImport").change(function(){
		$('#leadImportForm').submit();
	});

	$('#pills-tab-1').click(function(){ 
		  $('#downloadBtn').attr('href',"{{ route('leads.export', 'in-progress') }}");
		  $('#leadAssignForm').attr('action', "{{ route('lead.assign.checkbox', ['in-progress', $company->id]) }}");
	});
	$('#pills-tab-2').click(function(){ 
		  $('#downloadBtn').attr('href',"{{ route('leads.export', 'pre-validated') }}");
		  $('#leadAssignForm').attr('action', "{{ route('lead.assign.checkbox', ['pre-validated', $company->id]) }}");
	});
	$('#pills-tab-3').click(function(){ 
		  $('#downloadBtn').attr('href',"{{ route('leads.export', 'verified') }}");
		  $('#leadAssignForm').attr('action', "{{ route('lead.assign.checkbox', ['verified', $company->id]) }}");
	});

	// lead status change 
	$('.leadStatusToCurrent').click(function(){ 
		var lead_id = $(this).attr('data-lead_id');
		alert(lead_id);
	});	
	$('.leadStatusToValidate').click(function(){
		 
		var lead_id = $(this).attr('data-lead_id');
		alert(lead_id);
	});	
	$('.leadStatusToVerify').click(function(){
		 
		var lead_id = $(this).attr('data-lead_id');
		alert(lead_id);
	});	

	$('body').on('keyup', '.companyLeadSearchBox', function(){
		var search = $(this).val();
		var data = $(this).attr('data-item');
		var company_id = $('#company_id').val();

		if(search.length != ''){
			$('.pagination-wrapper').removeClass('d-block');
			$('.pagination-wrapper').addClass('d-none'); 
		}else{
			$('.pagination-wrapper').removeClass('d-none');
			$('.pagination-wrapper').addClass('d-block'); 

		}

			if(data == 'company name'){
		    	var column = 'company_name';
			}
			if(data == 'tracker name'||data == 'nom du traqueur'){
		    	var column = 'tracker_name';
			}
			
			if(data == 'tracker platform'||data == 'plateforme de suivi'){
		    	var column = 'tracker_platform';
			}
			
			if(data == 'tracker email'||data == 'e-mail de suivi'){
		    	var column = 'tracker_email';
			}
			
			if(data == 'tracker phone'||data == 'téléphone traqueur'){
		    	var column = 'tracker_phone';
			}
			
			if(data == 'project name'||data == 'project name'){
		    	var column = 'project_name';
			}
			
			if(data == 'first name'|data == 'prénom'){
				var column = 'first_name';
			}
			
			if(data == 'last name'||data == 'nom de famille'){
		    	var column = 'last_name';
			}
			
			if(data == 'phone'||data == 'téléphone'){
		    	var column = 'phone';
			}
			
			if(data == 'email'|| data == 'e-mail'){
		    	var column = 'email';
			}
			
			if(data == 'department' || data == 'département'){
		    	var column = 'department';
			}
			
			if(data == 'precariousness' || data == 'précarité'){
		    	var column = 'precariousness';
			}
			
			if(data == 'zone'|| data == 'zone'){
		    	var column = 'zone';
			}
			
			if(data == 'postal code' || data == 'code postal'){
		    	var column = 'postal_code';
			}
			
			if(data == 'country' || data == 'pays'){
		    	var column = 'country';
			}
			
			if(data == 'city'||data =='ville'){
		    	var column = 'city';
			}
			
			if(data == 'address'||data == 'adresse'){
		    	var column = 'address';
			}
			
			if(data == 'nature occupation'|| data == 'métier de la nature'){
		    	var column = 'nature_occupation';
			}
			
			if(data == 'heating type'|| data == 'type de chauffage'){
		    	var column = 'heating_type';
			}
			
			if(data == 'electricity connection'|| data == 'branchement électrique'){
		    	var column = 'electricity_connection';
			}
			
			if(data == 'living space'||data == 'espace vital'){
		    	var column = 'living_space';
			}
			
			if(data == 'cadstrable plot'|| data == 'parcelle cadastrable'){
		    	var column = 'cadstrable_plot';
			}
			
			if(data == 'floor area'||data =='surface de plancher'){
		    	var column = 'floor_area';
			}
			
			if(data == 'house type'||data =='type de maison'){
		    	var column = 'house_type';
			}
			
			if(data == 'with basement'||data =='avec sous-sol'){
		    	var column = 'with_basement';
			}
			
			if(data == 'owner'||data =='propriétaire'){
		    	var column = 'owner';
			}
			
			if(data == 'house over 15 years'||data =='maison de plus de 15 ans'){
		    	var column = 'house_over_15_years';
			}
			
			if(data == 'date'||data =='date'){
		    	var column = 'date';
			}
			
			if(data == 'duplicate analysis'||data =='analyse des doublons'){
		    	var column = 'tracker_name';
			}
			
			if(data == 'management'||data =='la gestion'){
		    	var column = 'management';
			}
			
			if(data == 'transfer office 17'||data =='bureau de transfert 17'){
		    	var column = 'transfer_office_17';
			}

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});  

			$.ajax({
				type: "POST",
				url: "{{ route('company-lead.search') }}",
				data: {
					search 		: search,
					column		: column, 
					company_id 	: company_id,
				},
				success: function (response) {
					$('#progressLeadSearch').html(response.progress);
					$('#preValidateLeadSearch').html(response.pre_validate);
					$('#verifiedLeadSearch').html(response.verified);
				}, 
				error: function(response){  
					console.log(response);
				}
			});
               
	}); 

	$('body').on('click', '.leadAssigneeButton', function(){

		var lead_id = $(this).attr('data-lead-id'); 
		$('#lead_id_assignee').val(lead_id);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		}); 

		$.ajax({
			type: "POST",
			url: "{{ route('leads.assignee') }}",
			data: {
				lead_id 	: lead_id,
			},
			success: function (response) {
				console.log(response.response); 

				$('#leadAssignModal').html(response.response); 
				$('.select2_select_option').select2();
				$('#lead_id_assignee').val(lead_id);
				$('#middleModal2').modal('show');
			}, 
			error: function(response){  
				console.log(response);
			}
		});

	});

	$('body').on('click', '#leadDeleteFormButton', function(){
		var text = "{{ __('Are You Sure To Delete this') }}";
		if(confirm(text) == true){
			$('#leadDeleteForm').submit();
		}
		else{
			return false
		}
	});

	$('body').on('click', '.user_status_btn', function(){ 
		var lead_id = $(this).attr('data-lead-id');  
		$('#lead_id').val(lead_id); 
	});

	$('body').on('click', '.laedStatusChange', function(){ 
		var lead_status_id = $(this).attr('data-status_id');
		$('#lead_status_id').val(lead_status_id);
		$('#leadStatusChangeForm').submit(); 
	});

	$('body').on('click', '.leadStatusEditBtn', function(){ 
		var lead_status_id = $(this).attr('data-status-id');
		var status = $(this).attr('data-status');
		var status_color = $(this).attr('data-status-color');
		var background_color = $(this).attr('data-background-color');


		$('#status_id').val(lead_status_id);
		$('#status_edit').val(status);
		$('#status_color_edit').val(status_color);
		$('#background_color_edit').val(background_color);
		$('#leadStatusChangeForm').hide('fadeOut'); 
		$('#leadStatusEditForm').show('fadeIn'); 
	});

	$('body').on('click', '.leadStatusDeleteBtn', function(){ 
		var lead_status_id = $(this).attr('data-status-id');

		$('#lead_status_id_dt').val(lead_status_id);  
		$('#leadStatusDeleteForm').submit(); 
	});
	$('#bannerSliderBack').click(function(){
		$('#leadStatusEditForm').hide('fadeOut'); 
		$('#leadStatusChangeForm').show('fadeIn'); 
	});

	$(document).ready(function(){
		$("#company_lead_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTables tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});
	
</script>
@endpush
