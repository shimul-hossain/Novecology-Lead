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

{{-- php code  --}}
@php
$filter_status = App\Models\CRM\LeadHeaderFilter::where('user_id', Auth::id())->orderBy('lead_header_id', 'asc')->get();
$customFilterStatus = \App\Models\CustomLeadFilter::where('user_id', Auth::id())->get();
@endphp


{{-- main content  --}}
@section('content')
     	<!-- Banner Section -->
		 <section class="banner section-gap position-relative">
			<div class="container">
				<a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a>
				<div class="row justify-content-center">
					<div class="col-12">
						<h1 class="text-center text-white">{{  __('All Leads') }}</h1>
						{{-- <p class="text-center text-white mb-2 mb-xl-0"> </p> --}}
					</div>
					<div class="col-12 text-center">
						<input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input rounded-pill" id="all_lead_search_bar">
					</div>
					<div class="col-12">
						<div class="py-3">
							<div class="button-group-spacing d-flex flex-wrap align-items-center justify-content-center">
								<div class="dropdown p-0 d-none" id="allActionButton">
									<button type="button" class="primary-btn primary-btn--white primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
											 Actions sur vos prospects 
									</button>
									<div class="dropdown-menu">    
										@if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
											<button type="button" class="dropdown-item border-0" id="leadBulkAssignFormButton" form="leadBulkAssignForm" data-toggle="modal" data-target="#middleModal3">
												Attribuer un télécommercial
											</button>
										@endif  
										{{-- @if (checkAction(Auth::id(), 'lead', 'export') || role() == 's_admin')
											<button type="submit" class="dropdown-item border-0" id="leadAssignFormButton" form="leadAssignForm">
												E Exporter vos prospects
											</button>
										@endif --}}
									   <form action="{{ route('lead.tracking.date.update') }}" method="POST">
											@csrf
											<input type="hidden" name="ids" class="selectedLeadId">
											<button type="submit" class="dropdown-item border-0">
												Remise à zéro des prospects
											</button>
										</form>
										@if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
											<form action="{{ route('lead.bulk.unassign') }}" method="POST">
												@csrf
												<input type="hidden" name="ids" class="selectedLeadId">
												<button type="submit" class="dropdown-item border-0">
													Désattribuer télécommercial
												</button>
											</form> 
										@endif
									   @if (checkAction(Auth::id(), 'lead', 'delete') || role() == 's_admin')
											<button type="buttoh" class="dropdown-item border-0" id="leadDeleteFormButton">
												Supprimer lead
											</button>
										@endif 
										@if (checkAction(Auth::id(), 'lead', 'dispatch') || role() == 's_admin')
										<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#distribute-modal">
											Dispatcher
									   </button>
										@endif
									</div>
								</div>

								{{-- <button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
									<span class="mr-2"></span>
									  Envoyer des SMS/Mails de masse	
								</button> --}}
								{{-- <button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
									<a href="{{ route('leads.index', $company->id) }}">{{ __('Create New Lead') }}</a> 
								</button>
								<button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#leadImportModal">
									 {{ __('Import a lead') }} 
								</button> --}} 
									{{-- <a id="downloadSeletedBtn" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0" href="#"><span class="novecologie-icon-csv-icon primary-btn__icon mr-2"></span> {{ __('Seleceted Download') }}</a> --}}
									 
									{{-- <a id="downloadBtn" href="{{ route('leads.export', 'in-progress') }}">{{ __('Download') }}</a> --}}
								{{-- @if (checkAction(Auth::id(), 'custom_field', 'add_field') || role() == 's_admin')
									<button type="button" data-toggle="modal" data-target="#customTabDataField" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
										<span class="mr-2"></span>
										+ {{ __('Add Custom Field') }}	
									</button>
								@endif --}}
								@if (checkAction(Auth::id(), 'general__setting', 'status') || role() == 's_admin') 
									<button type="button" data-toggle="modal" data-target="#leadStatusModel" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
										{{ __('Create Status') }}
									</button> 
								@endif
								
								@if (checkAction(Auth::id(), 'lead', 'create') || role() == 's_admin')
									<button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
										<a href="{{ route('create-leads.index') }}">{{ __('Create New Lead') }}</a> 
									</button>
								@endif							
								@if (checkAction(Auth::id(), 'lead', 'import') || role() == 's_admin') 
									<button class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0" data-toggle="modal" data-target="#leadImportModal">
										{{ __('Import a lead') }} 
									</button>
							   @endif
								@if (checkAction(Auth::id(), 'lead', 'export') || role() == 's_admin')
									<button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
										<span class="novecologie-icon-csv-icon primary-btn__icon"></span>
										<a id="downloadBtn" href="{{ route('leads.export', 'in-progress') }}">{{ __('Download') }}</a>
									</button>
								@endif	
								<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 rounded-pill">+ {{ __('Add filter') }}</button>
							</div>
						</div>

					</div>
					<div class="col-12">
						<ul class="nav nav-pills" id="tables-pills-tab" role="tablist">
							@foreach ($lead_status as $key => $item_data)
								@if ($key == 0)
									@continue
								@endif
							<li class="nav-item nav-item__active" role="presentation" data-tab-id="{{ $key }}">
								<a class="nav-link 
								@if (session('lead_tab_active') != null) 
									@if(session('lead_tab_active') == $key)
										active
									@endif
								@else
									@if ($loop->iteration == 1 && session('lead_tab_active') != '0')
										active
									@endif
								@endif" id="pills-tab-{{ $key }}" data-toggle="pill" href="#pills-{{ $key }}" role="tab" aria-controls="pills-{{ $key }}" aria-selected="
								@if (session('lead_tab_active') != null)
									@if(session('lead_tab_active') == $key)
										true
									@else
										false
									@endif
								@else
									@if ($loop->iteration == 1 && session('lead_tab_active') != '0')
										true
									@else
										false
									@endif
								@endif"> {{ \App\Models\CRM\LeadStatus::find($key)->status }}</a>
							</li>
							@endforeach
							<li class="nav-item nav-item__active" role="presentation" data-tab-id="0">
								<a class="nav-link 
								@if (session('lead_tab_active') != null)
									@if(session('lead_tab_active') == '0')
										active
									@endif
								@else
									@if (count($lead_status) == 1)
										active
									@endif
								@endif" id="pills-tab-0" data-toggle="pill" href="#pills-0" role="tab" aria-controls="pills-0" aria-selected="
								@if (session('lead_tab_active') != null)
									@if(session('lead_tab_active') == '0')
										true
									@else
										false
									@endif
								@else
									@if (count($lead_status) == 1)
										true
									@else
										false
									@endif
								@endif">{{ __('No Status') }}</a>
							</li>
							{{-- <li class="nav-item" role="presentation" >
								<a class="nav-link active" id="pills-tab-1" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true">{{ __('In Progress') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-tab-2" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false">{{ __('Pre-validate') }}</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="pills-tab-3" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false">{{ __('Checked') }}</a>
							</li> --}}
						</ul>
						<form action="{{ route('lead.assign.checkbox', 'in-progress') }}" method="POST" id="leadAssignForm">
							@csrf
							<div id="pu">
								<input type="hidden" name="checkedLead" id="bulkLeadDownload" value="">
							</div>
						</form>
						<div class="tab-content bg-white" id="pills-tabContent">
							@foreach ($lead_status as $key => $item_data)
								@if ($key == 0)
									@continue
								@endif
								<div class="tab-pane fade  
								@if (session('lead_tab_active') != null) 
									@if(session('lead_tab_active') == $key)
										show active
									@endif
								@else
									@if ($loop->iteration == 1 && session('lead_tab_active') != '0')
										show active
									@endif
								@endif" id="pills-{{ $key }}" role="tabpanel" aria-labelledby="pills-tab-{{ $key }}">
									<div class="database-table-wrapper bg-white">
										<div class="table-responsive simple-bar">
											<table class="table database-table w-100 mb-0" id="dataTables">
											
												<thead class="database-table__header">
													<tr>
														<th>
															<div class="custom-control custom-checkbox">
																<input type="checkbox" name="checkAll" data-id="{{ $key }}" value="1" class="custom-control-input table-all-select-checkbox lead_checkbox_all" id="progress_lead_custom_check-{{ $key }}">
																<label class="custom-control-label" for="progress_lead_custom_check-{{ $key }}"></label>
															</div>
														</th>
														@if ($filter_status->count() + $customFilterStatus->count() == 0)
															<th class="text-left">{{ __('ID') }}</th>
															<th> 
																{{ __('First name') }}
															</th>
															<th> 
																{{ __('Phone number') }}
															</th>
															<th> 
																{{ __('Email') }}
															</th>
															<th> 
																{{ __('Postal code') }}
															</th>
															<th> 
																{{ __('Heating mode') }}
															</th>  
														@else 
															@foreach ($headers as $header)  
																@foreach ($filter_status as $item) 
																	@if ($item->lead_header_id == $header->id) 
																		<th>  
																			{{ ucfirst($header->header) }}
																		</th> 	 
																	@endif 
																@endforeach  
															@endforeach 	
															@foreach (\App\Models\LeadCustomField::all() as $custom_header)  
																@foreach ($customFilterStatus as $item)
																	@if($item->header_id == $custom_header->id)
																		<th>
																			{{ ucfirst(str_replace('_', ' ', $custom_header->title)) }}
																		</th>
																	@endif
																@endforeach 
															@endforeach 
														@endif
														<th>
															{{ __('Company Name') }}
														</th> 
														{{-- <th>
															{{ __('Comment') }}
														</th> --}}
														
														<th>
															{{ __('Status') }}
														</th>

														<th>
															Télécommerciale
														</th>
														
														<th class="text-center">
															{{ __('Actions') }}
														</th>
													</tr>
												</thead>
												<tbody class="database-table__body" id="progressLeadSearch">
													@include('includes.crm.lead_by_status')
												</tbody>
											</table>
										</div>
										<div class="pagination-wrapper">
											{{ $item_data->onEachSide(1)->links() }}
										</div>  
									</div>
								</div> 
							@endforeach
							<div class="tab-pane fade  
							@if (session('lead_tab_active') != null)
								@if(session('lead_tab_active') == '0')
									show active
								@endif
							@else
								@if (count($lead_status) == 1)
									show active
								@endif
							@endif" id="pills-0" role="tabpanel" aria-labelledby="pills-tab-0">
								<div class="database-table-wrapper bg-white">
									<div class="table-responsive simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
										
											<thead class="database-table__header">
												<tr>
													<th>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" name="checkAll" value="1" data-id="0" class="custom-control-input table-all-select-checkbox lead_checkbox_all" id="progress_lead_custom_check-0">
															<label class="custom-control-label" for="progress_lead_custom_check-0"></label>
														</div>
													</th>
													@if ($filter_status->count() + $customFilterStatus->count() == 0)
														<th class="text-left">{{ __('ID') }}</th>
														<th> 
															{{ __('First name') }}
														</th>
														<th> 
															{{ __('Phone number') }}
														</th>
														<th> 
															{{ __('Email') }}
														</th>
														<th> 
															{{ __('Postal code') }}
														</th>
														<th> 
															{{ __('Heating mode') }}
														</th>  
													@else 
														@foreach ($headers as $header)  
															@foreach ($filter_status as $item) 
																@if ($item->lead_header_id == $header->id) 
																	<th>
																		{{ ucfirst($header->header) }}
																	</th> 	 
																@endif 
															@endforeach  
														@endforeach 	
														@foreach (\App\Models\LeadCustomField::all() as $key => $custom_header)  
															@foreach ($customFilterStatus as $item)
																@if($item->header_id == $custom_header->id)
																	<th>
																		{{ ucfirst(str_replace('_', ' ', $custom_header->title)) }}
																	</th>
																@endif
															@endforeach 
														@endforeach 
													@endif
													<th>
														{{ __('Company Name') }}
													</th> 
													  
													
													<th>
														{{ __('Status') }}
													</th>

													<th>
														Télécommerciale
													</th>
													
													<th class="text-center">
														{{ __('Actions') }}
													</th>
												</tr>
											</thead>
											<tbody class="database-table__body" id="progressLeadSearch">
												@include('includes.crm.lead_no_status')
											</tbody>
										</table>
									</div>
									<div class="pagination-wrapper">
										{{ $lead_status[0]->onEachSide(2)->links() }}
									</div>  
								</div>
							</div>
							{{-- <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-tab-2">
								<div class="database-table-wrapper bg-white">
									<div class="table-responsive simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">
											<thead class="database-table__header">
												<tr>
													<th>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" name="checkAll" value="1" class="custom-control-input table-all-select-checkbox" id="pre_validate_lead_custom_check">
															<label class="custom-control-label" for="pre_validate_lead_custom_check"></label>
														</div>
													</th>
													@if ($filter_status->count() + $customFilterStatus->count() == 0)
														<th class="text-left">{{ __('ID') }}</th>
														<th> 
															{{ __('First name') }}
														</th>
														<th> 
															{{ __('Phone number') }}
														</th>
														<th> 
															{{ __('Email') }}
														</th>
														<th> 
															{{ __('Postal code') }}
														</th>
														<th> 
															{{ __('Heating mode') }}
														</th> 
													@else
														@foreach ($headers as $header)  
															@foreach ($filter_status as $item)

																@if ($item->lead_header_id == $header->id) 
																	<th>  
																		{{ $header->header }}
																	</th> 	 
																	
																@endif 
															@endforeach  
														@endforeach 	
														@foreach (\App\Models\LeadCustomField::all() as $key => $custom_header)  
															@foreach ($customFilterStatus as $item)
																@if($item->header_id == $custom_header->id)
																	<th>
																		{{ $custom_header->title }}
																	</th>
																@endif
															@endforeach 
														@endforeach 
													@endif
													<th>
														{{ __('Company Name') }}
													</th>
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
															<input type="checkbox" name="checkAll" value="1" class="custom-control-input table-all-select-checkbox" id="verified_lead_custom_check">
															<label class="custom-control-label" for="verified_lead_custom_check"></label>
														</div>
													</th>
													@if ($filter_status->count() + $customFilterStatus->count() == 0)
														<th class="text-left">{{ __('ID') }}</th>
														<th> 
															{{ __('First name') }}
														</th>
														<th> 
															{{ __('Phone number') }}
														</th>
														<th> 
															{{ __('Email') }}
														</th>
														<th> 
															{{ __('Postal code') }}
														</th>
														<th> 
															{{ __('Heating mode') }}
														</th> 
													@else 
														@foreach ($headers as $header)  
															@foreach ($filter_status as $item)

																@if ($item->lead_header_id == $header->id) 
																	<th>  
																		{{ $header->header }}
																	</th> 	 
																	
																@endif 
															@endforeach  
														@endforeach 	
														@foreach (\App\Models\LeadCustomField::all() as $key => $custom_header)  
															@foreach ($customFilterStatus as $item)
																@if($item->header_id == $custom_header->id)
																	<th>
																		{{ $custom_header->title }}
																	</th>
																@endif
															@endforeach 
														@endforeach 
													@endif
													<th>
														{{ __('Company Name') }}
													</th>
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
							</div> --}}
						</div> 
					</div>
				</div>
			</div>
		</section>

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
					<div class="modal-body pt-0">
						<h1 class="modal-title text-center">{{ __('Additional filters') }}</h1>
						<p class="modal-text text-center mb-2">{{ __('Filter your tables with your custom columns') }}</p>
						<form action="{{ route('lead.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
							@csrf 
							<h2 class="modal-sub-title position-relative">{{ __('Foyer') }}</h2>
							<div class="row">
								@if ($filter_status->count() + $customFilterStatus->count() == 0)
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
							<h2 class="modal-sub-title position-relative mt-3">{{ __('Address') }}</h2>
							<div class="row">
								@if ($filter_status->count() + $customFilterStatus->count() == 0)
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
							<h2 class="modal-sub-title position-relative mt-3">{{ __('Personal Info') }}</h2>
							<div class="row">
								@if ($filter_status->count() + $customFilterStatus->count() == 0)
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
							<h2 class="modal-sub-title position-relative mt-3">{{ __('Others') }}</h2>
							<div class="row">
								@if ($filter_status->count() + $customFilterStatus->count() == 0)
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
							<h2 class="modal-sub-title position-relative mt-3">{{ __('Custom Field') }}</h2>
							<div class="row">  
								@foreach (\App\Models\LeadCustomField::all() as $key => $item)
									@php
										$exist = \App\Models\CustomLeadFilter::where('user_id', Auth::id())->get();
									@endphp
									<div class="col-xl-4 col-md-6">
										<div class="custom-control custom-checkbox"> 
											<input type="checkbox"  class="custom-control-input" value="{{ $item->id }}" id="foyerFormCheckCustom-{{ $key }}" name="custom_header_id[]"
											@foreach ($exist as $ex)
												@if($ex->header_id == $item->id)
												checked
												@endif
											@endforeach
												>
											<label class="custom-control-label" for="foyerFormCheckCustom-{{ $key }}">{{ ucfirst($item->title) }}</label>
										</div>
									</div> 
								@endforeach
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

		<!-- Middle Modal -->
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
							<div class="form-group d-flex flex-column align-items-center position-relative" id="bu" > 
								<input type="hidden" name="lead_id" id="lead_id_assignee">
								<input type="hidden" name="checkedLead" id="bulkLeadAssign" value="">
								<select class="select2_select_option form-control w-100" name="user_id" required> 
									@foreach ($telecommercials as $user)
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

   
		<div class="modal modal--aside fade" id="leadBulkDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>{{ __('Are You Sure To Delete this') }} ?</span> 
						<form  action="{{ route('lead.bulk.delete') }}" method="post">
							@csrf
							<div id="du"> 
								<input type="hidden" name="checkedLead" id="bulkLeadDelete" value="">
							</div>

							<div class="d-flex justify-content-center">
								<button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
									Annuler
								</button> 
								<button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1"> 
									Confirmer
								</button>
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

								@foreach ($l_status as $status)

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

		{{-- Custom field  --}}
		<div class="modal modal--aside fade leftAsideModal" id="customTabDataField" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
			<div class="modal-content simple-bar border-0 h-100 rounded-0">
				<div class="modal-header border-0 ml-3">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body pt-0">
					<div class="px-3">
						<h1 id="updatedtagTitle" class="modal-title mb-1">{{ __('Custom Tab Field') }}</h1>
						<form action="{{ route('lead.custom.field.store') }}" class="form mx-auto needs-validation"  novalidate method="POST">
							@csrf
							<div id="CustomTabInput"> 
								<div class="form-group">
									<label class="form-label" for="title">{{ __('Title') }} <span class="text-danger">*</span></label>
									<input type="text" name="title[]" id="title" class="form-control shadow-none" required>
									<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
								</div> 
								<div class="form-group">
									<label class="form-label" for="input_type">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
									<select name="input_type[]" id="input_type2"  class="select2_select_option custom-select shadow-none form-control">
										<option value="text">{{ __('Text') }}</option>
										<option value="date">{{ __('Date') }}</option>
										<option value="number">{{ __('Number') }}</option>
										<option value="email">{{ __('Email') }}</option>
										<option value="radio">{{ __('Radio') }}</option>
										<option value="checkbox">{{ __('Checkbox') }}</option>
										<option value="select">{{ __('Dropdown') }}</option>
										<option value="textarea">{{ __('Textarea') }}</option>
									</select> 
								</div>
								<div class="form-group">
									<label class="form-label" for="options">{{ __('Options') }} <span class="text-danger">*</span></label>
									<textarea name="options[]" id="options" class="form-control shadow-none" placeholder="Enter Options. Each option seperate with comma ','"></textarea>
								</div> 
							</div> 
							<div class="form-group text-center mt-4">
								<button type="submit" id="xProjectUpdateBtn4" class="primary-btn primary-btn--primary primary-btn--lg border-0 mb-3 rounded-pill">{{ __('Create') }}</button>
								<button type="button" class="secondary-btn secondary-btn--cuccess primary-btn--lg rounded-pill border-0 mb-3" id="add_more_custom_field_input_btn">{{ __('Add More') }}</button> 
							</div>
						</form> 
						<h1 class="modal-title my-2">{{ __('Custom Tab Field') }}</h1>
						<div class="database-table-wrapper bg-white border">
							<div class="table-responsive simple-bar">
								<table class="table database-table w-100 mb-0">
									<thead class="database-table__header">
										<tr>
											<th>{{ __('Serial') }}</th>  
											<th>{{ __('Title') }}</th> 
											<th>{{ 'Input Type' }}</th>  
											<th class="text-center">{{ __('Action') }}</th>
										</tr>
									</thead>
									<tbody class="database-table__body">
										@forelse ($inputs as $input)
										<tr> 
											<td>{{ $loop->iteration }}</td>
											<td>{{ $input->title }}</td>
											<td> 
												@if ($input->input_type == 'text')
												{{ __('Text') }}
												@elseif ($input->input_type == 'date')
												{{ __('Date') }}
												@elseif ($input->input_type == 'number')
												{{ __('Number') }}
												@elseif ($input->input_type == 'email')
												{{ __('Email') }}
												@elseif ($input->input_type == 'radio')
												{{ __('Radio') }}
												@elseif ($input->input_type == 'checkbox')
												{{ __('Checkbox') }}
												@elseif ($input->input_type == 'select')
												{{ __('Dropdown') }}
												@else
												{{ __('Textarea') }} 
												@endif 
											</td>
											{{-- <td>{{ $input->options }}</td> --}}
											<td class="text-center">
												<div class="dropdown dropdown--custom p-0 d-inline-block">
													<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<span class="novecologie-icon-dots-horizontal-triple"></span>
													</button>
													<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">  
														<form action="{{ route('lead.custom.field.delete') }}" method="post">
															@csrf
															<input type="hidden" name="input_id" value="{{ $input->id }}"> 
															<button type="submit" class="dropdown-item border-0">
																<span class="novecologie-icon-trash mr-1"></span> 
																{{ __('Delete') }} 
															</button> 
														</form>
													</div>
												</div>
											</td>
										</tr>  							
										@empty
										<tr>
											<td  class="text-center" colspan="5">{{ __('No Field Found') }}</td>
										</tr>
										@endforelse
									</tbody>
								</table>
							</div> 
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>

		<!-- Lead Import Modal -->
		<div class="modal modal--aside fade" id="leadImportModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content border-0">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
						<span class="novecologie-icon-close"></span>
					</button>
				</div>
				<div class="modal-body pt-0">
					<form action="{{ route('leads.import') }}" class="form" method="POST" enctype="multipart/form-data">
						@csrf
						<h1 class="form__title position-relative text-center mb-4">{{ __('Import a lead') }}</h1>
						<div class="input-group mb-3"> 
							<div class="custom-file">
								<input type="file" name="file" class="custom-file-input" id="leadFileImportField" aria-describedby="inputGroupFileAddon01" required>
								<label class="custom-file-label" for="leadFileImportField">Choose file</label>
							</div>
						</div>
						<div class="text-center">
							<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0">
								{{ __('Import') }} <span class="novecologie-icon-arrow-right ml-3"></span>
							</button>
						</div>
					</form>
				</div> 
			</div>
			</div>
		</div>

		<div class="modal modal--aside fade" id="distribute-modal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content distribute-wrapper border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>	
					</div>
					<div class="modal-header d-block border-0 pt-0 pb-0">
						<h1 class="form__title position-relative text-center mb-4">Répartir les prospects</h1>
						<h4 class="text-muted text-center mb-3">Répartissez les prospects à vos collaborateur</h4>
						<div class="distribute-search mx-auto">
							<span class="distribute-search__icon">
								<i class="bi bi-search"></i>
							</span>
							<input type="search" class="distribute-search__input" placeholder="Search...">
						</div>
						<div class="text-center py-2">
							<button type="submit" form="distributeForm" class="primary-btn primary-btn--success primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
								Submit
							</button>
						</div>
						<div class="text-center">
							<div class="distribute-search__input py-2">Sélectionné : <span id="selectedLeadCount"></span></div>
						</div>
					</div>
					<div class="modal-body pt-0">
						<form id="distributeForm" action="{{ route('lead.dispatcher') }}" method="post">
							@csrf
							<input type="hidden" name="selected_lead_id" id="selected_lead_id">
							<div class="distribute-list">
								@php
									$nv_data = \App\Models\CRM\LeadStatus::where('status', 'Nouveau')->first();
									$enc_data = \App\Models\CRM\LeadStatus::where('status', 'En Cours')->first();
									$nrp_data = \App\Models\CRM\LeadStatus::where('status', 'NRP')->first();
									$nv_id = $nv_data->id ?? '';
									$enc_id = $enc_data->id ?? '';
									$nrp_id = $nrp_data->id ?? '';
								@endphp
								@foreach ($telecommercials as $t_user)
								<div class="distribute-list__item">
										<div class="distribute-list__item__content">
											<div class="distribute-list__item__avatar">
												{{ nameShorter($t_user->name) }}
											</div>
											<div class="distribute-list__item__info">
												<div class="distribute-list__item__info__top">
													<h3 class="distribute-list__item__info__title">{{ $t_user->name }}</h3>
													<span class="distribute-list__item__info__badge">{{ $t_user->getRoleName->name ?? '' }}</span>
												</div>
												<a href="mailto:{{ $t_user->email }}" class="distribute-list__item__info__text">{{ $t_user->email }}</a>
											</div>
										</div>
										<div class="distribute-list__item__actions">
											<div class="distribute-list__item__actions__counters">
												<div class="distribute-list__item__actions__counters__item number-spinner__input--value" data-name="NV">{{ $t_user->leads->where('user_status', $nv_id)->count() }}</div>
												<div class="distribute-list__item__actions__counters__item" data-name="EnC">{{ $t_user->leads->where('user_status', $enc_id)->count() }}</div>
												<div class="distribute-list__item__actions__counters__item" data-name="NRP">{{ $t_user->leads->where('user_status', $nrp_id)->count() }}</div>
											</div>
											<div class="number-spinner">
												<button type="button" class="number-spinner__btn number-spinner__btn--decrease" data-id="{{ $t_user->id }}">
													<i class="bi bi-dash-lg"></i>
												</button> 
												<input type="number" name="lead_dispatcher_id[{{ $t_user->id }}]" class="number-spinner__input number-spinner__input__value{{ $t_user->id }} text-center" value="0" readonly>
												<input type="hidden" class="assignedLead{{ $t_user->id }}" value="{{ $t_user->leads->where('user_status', $nv_id)->count() + $t_user->leads->where('user_status', $enc_id)->count() + $t_user->leads->where('user_status', $nrp_id)->count() }}">
												<button type="button" class="number-spinner__btn number-spinner__btn--increase" data-id="{{ $t_user->id }}">
													<i class="bi bi-plus-lg"></i>
												</button>
											</div>
										</div>
									</div>
								@endforeach 
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> 

		@include('includes.crm.footer-contact')

@endsection

@push('js')
<script>
	// Number Spinner And Search Functions
	$(document).ready(function () {
		$(document).on("input", ".distribute-search__input", function() {
			let searchValue = $(this).val().toLowerCase();
			$(this).closest(".distribute-wrapper").find(".distribute-list__item").filter(function() {
				$(this).toggle($(this).find(".distribute-list__item__info__title").text().toLowerCase().indexOf(searchValue) > -1)
			});
		}); 

		// $(document).on("input", ".number-spinner__input", function(e){
		// 	console.log($(this).val());
		// 	if($(this).val() >= $(this).attr("min")){
		// 		return true;
		// 	}else{
		// 		return false;
		// 	}
		// });


	});


	$(document).ready(function(){
		function countTotalInput(){
			var inputValue = 0;
			$('.number-spinner__input').each(function(){
				inputValue += +$(this).val();
			});

			return inputValue;
		}
		$('#leadStatusEditForm').hide();
		var lead_id_array = [];  
		$('body').on('click', '.lead_checkbox_item', function(){  
			var id = $(this).attr('data-id'); 
			$('.lead_checkbox_item').each(function(){ 
					if($(this).is(':checked')){
					$('#progress_lead_custom_check').prop('checked', true) 
					} else{
						$('#progress_lead_custom_check').prop('checked', false) 
						return false;
					}
				}); 
			if(lead_id_array.indexOf(id)  != -1){

				lead_id_array = lead_id_array.filter(item => item !== id) 
				$('#bulkLeadDelete').val(lead_id_array);
				$('#bulkLeadDownload').val(lead_id_array);
				$('#bulkLeadAssign').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
				$('#selected_lead_id').val(lead_id_array);
				$('.selectedLeadId').val(lead_id_array);
			}
			else{
				lead_id_array.push(id)
				$('#bulkLeadDelete').val(lead_id_array);
				$('#bulkLeadDownload').val(lead_id_array);
				$('#bulkLeadAssign').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
				$('#selected_lead_id').val(lead_id_array);
				$('.selectedLeadId').val(lead_id_array);
			}

			console.log(lead_id_array);
			if(lead_id_array.length == 0)
			{ 
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
				// $("#leadAssignFormButton").removeClass('d-inline-flex');
				// $("#leadAssignFormButton").addClass('d-none');
				// $("#leadBulkAssignFormButton").removeClass('d-inline-flex');
				// $("#leadBulkAssignFormButton").addClass('d-none');
				// $("#leadDeleteFormButton").removeClass('d-inline-flex');
				// $("#leadDeleteFormButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
				// $("#leadAssignFormButton").removeClass('d-none');
				// $("#leadAssignFormButton").addClass('d-inline-flex');
				// $("#leadBulkAssignFormButton").removeClass('d-none');
				// $("#leadBulkAssignFormButton").addClass('d-inline-flex');
				// $("#leadDeleteFormButton").removeClass('d-none');
				// $("#leadDeleteFormButton").addClass('d-inline-flex');
			}
		}); 
		
		$('.lead_checkbox_all').click(function(){
			lead_id_array = [];  
			let key = $(this).attr('data-id');
			if(this.checked)
			{ 
				console.log($('.lead_checkbox_item__'+key).length);
				$('.lead_checkbox_item__'+key).each(function(){ 
					lead_id_array.push($(this).attr('data-id'))
					$('#bulkLeadDelete').val(lead_id_array);
					$('#bulkLeadDownload').val(lead_id_array);
					$('#bulkLeadAssign').val(lead_id_array);
					$('#selectedLeadCount').text(lead_id_array.length);
					$('#selected_lead_id').val(lead_id_array);
					$('.selectedLeadId').val(lead_id_array); 
				});
			} 
			console.log(lead_id_array);
			if(lead_id_array.length == 0)
			{ 
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
				// $("#leadAssignFormButton").removeClass('d-inline-flex');
				// $("#leadAssignFormButton").addClass('d-none');
				// $("#leadBulkAssignFormButton").removeClass('d-inline-flex');
				// $("#leadBulkAssignFormButton").addClass('d-none');
				// $("#leadDeleteFormButton").removeClass('d-inline-flex');
				// $("#leadDeleteFormButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
				// $("#leadAssignFormButton").removeClass('d-none');
				// $("#leadAssignFormButton").addClass('d-inline-flex');
				// $("#leadBulkAssignFormButton").removeClass('d-none');
				// $("#leadBulkAssignFormButton").addClass('d-inline-flex');
				// $("#leadDeleteFormButton").removeClass('d-none');
				// $("#leadDeleteFormButton").addClass('d-inline-flex');
			}	 
		});


		$(document).on("click", ".number-spinner__btn--increase", function(e){
			let user = $(this).attr('data-id'); 
			 
			if(countTotalInput() == lead_id_array.length){
				$('#errorMessage').text("{{ __('Maximum limit reached') }}");
				$('.toast.toast--error').toast('show');
			}else{
				$(".number-spinner__input__value"+user).val(+$(".number-spinner__input__value"+user).val()+1);
			}


			// $.ajaxSetup({
			// 	headers: {
			// 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			// 	}
			// }); 

			// $.ajax({
			// 	type: "POST",
			// 	url: "{{ route('lead.user.limit') }}",
			// 	data: {
			// 		id 	: user, 
			// 		type: 'increase' 
			// 	},
			// 	success: function (response) {  
			// 		 console.log(response);
			// 	}, 
			// 	error: function(response){  
			// 	}
			// });
		});

		$(document).on("click", ".number-spinner__btn--decrease", function(e){
			let user = $(this).attr('data-id');
			let assigned = $('.assignedLead'+user).val();
			let value = $(".number-spinner__input__value"+user);

			if(value.val() < 1){
				$('#errorMessage').text("{{ __('Minimum limit reached') }}");
				$('.toast.toast--error').toast('show');
				value.val(0); 
			}else{
				value.val(+value.val()-1);
			}

			// if(assigned == value.val()){
			// 	$('#errorMessage').text("{{ __('Minimum limit reached') }}");
			// 		$('.toast.toast--error').toast('show');
			// 		value.val(assigned); 
			// 	}else{ 
			// 	value.val(+value.val()-1);
			// 	$.ajaxSetup({
			// 		headers: {
			// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			// 		}
			// 	}); 
	
			// 	$.ajax({
			// 		type: "POST",
			// 		url: "{{ route('lead.user.limit') }}",
			// 		data: {
			// 			id 	: user,  
			// 			type: 'descrease'
			// 		},
			// 		success: function (response) {  
			// 			 console.log(response);
			// 		}, 
			// 		error: function(response){  
			// 		}
			// 	});
			// }

		});

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
		});

		$('body').on('click', '.nav-item__active', function(){
		var tab_id = $(this).attr('data-tab-id');
		$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			}); 

			$.ajax({
				type: "POST",
				url: "{{ route('update.active.tab') }}",
				data: {
					id 	: tab_id, 
					module : 'lead',
				},
				success: function (response) {  
					 
				}, 
				error: function(response){  
				}
			});
	});

		

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



	$('#pills-tab-1').click(function(){ 
		  $('#downloadBtn').attr('href',"{{ route('leads.export', 'in-progress') }}");
		  $('#leadAssignForm').attr('action', "{{ route('lead.assign.checkbox', 'in-progress') }}");
	});
	$('#pills-tab-2').click(function(){ 
		  $('#downloadBtn').attr('href',"{{ route('leads.export', 'pre-validated') }}");
		  $('#leadAssignForm').attr('action', "{{ route('lead.assign.checkbox', 'pre-validated') }}");
	});
	$('#pills-tab-3').click(function(){ 
		  $('#downloadBtn').attr('href',"{{ route('leads.export', 'verified') }}");
		  $('#leadAssignForm').attr('action', "{{ route('lead.assign.checkbox', 'verified') }}");
	});



	$('body').on('keyup', '.leadSearchBox', function(){
		var search = $(this).val();
		var data = $(this).attr('data-item');

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
				url: "{{ route('all-lead.search') }}",
				data: {
					search 	: search,
					column	: column, 
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
		// var text = "{{ __('Are You Sure To Delete this') }}";
		// if(confirm(text) == true){
			$('#leadBulkDeleteModal').modal('show');
		// }
		// else{
		// 	return false
		// }
	});

	$('body').on('click', '.progress_leads_checked', function(){
		var car = [];

		if (this.checked) {
			car = car.push($(this).val());
			console.log(car);
		}
		else{ 
			arr = car.filter(item => item !== $(this).val());
			console.log(arr);

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

	$('#add_more_custom_field_input_btn').click(function(){ 
		var string = Math.random().toString(10).substring(2,12); 
		var data = `<div id="remove`+string+`">
						<div class="form-group">
							<div class="d-flex align-items-center justify-content-between"> 
								<label class="form-label" for="label_title`+string+`">{{ __('Title') }} <span class="text-danger">*</span></label> 
								<button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button mb-1 remove_tab_input_block" data-id="`+string+`">×</button>
							</div> 
							<input type="text" name="title[]" id="label_title`+string+`" class="form-control shadow-none" required>
							<div class="invalid-feedback">{{ __('This field is necessary') }}</div>
						</div> 
						<div class="form-group">
							<label class="form-label" for="input_type`+string+`">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
							<select name="input_type[]" id="input_type`+string+`"  class="select2_select_option custom-select shadow-none form-control">
								<option value="text">{{ __('Text') }}</option>
								<option value="number">{{ __('Number') }}</option>
								<option value="email">{{ __('Email') }}</option>
								<option value="radio">{{ __('Radio') }}</option>
								<option value="checkbox">{{ __('Checkbox') }}</option>
								<option value="select">{{ __('Dropdown') }}</option>
								<option value="textarea">{{ __('Textarea') }}</option>
							</select> 
						</div>  
						<div class="form-group" id="optional_options">
							<label class="form-label" for="options">{{ __('Options') }} <span class="text-danger">*</span></label>
							<textarea name="options[]" id="options" class="form-control shadow-none" placeholder="Enter Options. Each option seperate with comma ','"></textarea>
						</div>
					</div>`;
					
		$('#CustomTabInput').append(data);
	});

	$('body').on('click', '.remove_tab_input_block', function(){
		var id = $(this).attr('data-id');
		$('#remove'+id).remove();
	});  

	// $('#all_lead_search_bar').keyup(function(){
	// 	var search = $(this).val();
	// 	$.ajaxSetup({
	// 		headers: {
	// 			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 		}
	// 	}); 

	// 	$.ajax({
	// 		type: "POST",
	// 		url: "{{ route('all-lead.search.new') }}",
	// 		data: {
	// 			search 	: search,  
	// 		},
	// 		success: function (response) {
	// 			$('#progressLeadSearch').html(response.progress);
	// 			$('#preValidateLeadSearch').html(response.pre_validate);
	// 			$('#verifiedLeadSearch').html(response.verified);
	// 		}, 
	// 		error: function(response){  
	// 			console.log(response);
	// 		}
	// 	});
	// });


	$(document).ready(function(){
		$("#all_lead_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTables tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});



	 

</script>
	
@endpush