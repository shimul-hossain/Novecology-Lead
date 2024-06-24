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

@section('bodyBg', 'secondary-bg')

@push('css')
<style>
    #tables-pills-tab.nav-pills .nav-link{
        background-color: #ffffff;
    }
    .nav.nav-pills{
        white-space: nowrap;
        flex-wrap: nowrap;
        overflow: auto;
    }
    .custom-select{
        width: max-content;
    }
    #tables-pills-tab.nav-pills .nav-link{
        border: 1px solid #ffffff;
    }
    #tables-pills-tab.nav-pills .nav-link.active{
        border-color: #000000;
        border-bottom-color: #ffffff;
    }
</style>
@endpush

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
						<h1 class="ml-lg-5 text-white">Prospects</h1>
					</div>
					<div class="col-12 pb-3">
                        <div class="row">
                            <div class="col-lg">
                                <input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input rounded" id="all_lead_search_bar">
                            </div>
                            <div class="col-md-auto">
                                <div class="button-group-spacing">
                                    <div class="dropdown p-0 d-none" id="allActionButton">
                                        <button type="button" class="primary-btn primary-btn--white primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 Actions sur vos prospects
                                        </button>
                                        <div class="dropdown-menu">
                                            @if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
                                                <button type="button" class="dropdown-item border-0" id="leadBulkAssignFormButton" form="leadBulkAssignForm" data-toggle="modal" data-target="#middleModal3">
                                                    Attribuer un télécommercial
                                                </button>
                                            @endif
                                           <form action="{{ route('lead.tracking.date.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="ids" class="bulk_selected_lead">
                                                <button type="submit" class="dropdown-item border-0">
                                                    Remise à zéro des prospects
                                                </button>
                                            </form>
                                            @if (checkAction(Auth::id(), 'lead', 'assign') || role() == 's_admin')
                                                <form action="{{ route('lead.bulk.unassign') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="ids" class="bulk_selected_lead">
                                                    <button type="submit" class="dropdown-item border-0">
                                                        Désattribuer télécommercial
                                                    </button>
                                                </form>
                                            @endif
                                           @if (checkAction(Auth::id(), 'lead', 'delete') || role() == 's_admin')
                                                <button type="button" class="dropdown-item border-0" id="leadDeleteFormButton">
                                                    Supprimer lead
                                                </button>
                                            @endif
                                            @if ($status == 1)
                                                @if (checkAction(Auth::id(), 'lead', 'dispatch') || role() == 's_admin')
                                                <button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#distribute-modal">
                                                    Dispatcher
                                                </button>
                                                @endif
                                            @endif
                                            {{-- <button type="button" class="dropdown-item border-0" id="Click2CopyNumber">
                                                Copier Numéro de téléphone
                                            </button> --}}
                                        </div>
                                    </div>
                                    {{-- @if (checkAction(Auth::id(), 'general__setting', 'status') || role() == 's_admin')
                                        <button type="button" data-toggle="modal" data-target="#leadStatusModel" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                            {{ __('Create Status') }}
                                        </button>
                                    @endif --}}

                                    @if (checkAction(Auth::id(), 'lead', 'create') || role() == 's_admin')
                                        <button type="button" class="primary-btn primary-btn--white primary-btn--md d-inline-flex align-items-center justify-content-center border-0 rounded">
                                            <a href="{{ route('create-leads.index') }}">{{ __('Create New Lead') }}</a>
                                        </button>
                                    @endif
                                    @if (checkAction(Auth::id(), 'lead', 'import') || role() == 's_admin')
                                        <button class="primary-btn primary-btn--white primary-btn--md d-inline-flex align-items-center justify-content-center border-0 rounded" data-toggle="modal" data-target="#leadImportModal">
                                            {{ __('Import a lead') }}
                                        </button>
                                   @endif
                                    {{-- @if (checkAction(Auth::id(), 'lead', 'export') || role() == 's_admin')
                                        <button type="button" class="primary-btn primary-btn--white primary-btn--md rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                            <span class="novecologie-icon-csv-icon primary-btn__icon"></span>
                                            <a id="downloadBtn" href="{{ route('leads.export', 'in-progress') }}">{{ __('Download') }}</a>
                                        </button>
                                    @endif	 --}}
                                    <button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0">+ {{ __('Add filter') }}</button>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col-12">
						<ul class="nav nav-pills" id="tables-pills-tab" role="tablist">
							@foreach ($lead_status as $key => $item_data)
								<li class="nav-item" role="presentation" data-tab-id="{{ $key }}">
									<a class="nav-link {{ $status ? ($item_data->id == $status ? 'active':''): ($item_data->id == '2'? 'active':'') }}"  href="{{ route('leads.all', $item_data->id) }}"> {{ $item_data->status }}</a>
								</li>
							@endforeach
								<li class="ml-auto">
                                    <select id="paginationCount" class="custom-select">
                                        <option {{ paginationNumber('lead') == '25' ? 'selected':'' }} value="25">25</option>
                                        <option {{ paginationNumber('lead') == '50' ? 'selected':'' }} value="50">50</option>
                                        <option {{ paginationNumber('lead') == '100' ? 'selected':'' }} value="100">100</option>
                                    </select>
								</li>
						</ul>
						<form action="{{ route('lead.assign.checkbox', 'in-progress') }}" method="POST" id="leadAssignForm">
							@csrf
							<div id="pu">
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
							</div>
						</form>
						<div class="tab-content bg-white" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-" role="tabpanel" aria-labelledby="pills-tab-">
								<div class="database-table-wrapper bg-white">
									<div class="table-responsive simple-bar">
										<table class="table database-table w-100 mb-0" id="dataTables">

											<thead class="database-table__header">
												<tr>
													<th>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" name="checkAll" data-id="" value="1" class="custom-control-input table-all-select-checkbox lead_checkbox_all" id="progress_lead_custom_check-">
															<label class="custom-control-label" for="progress_lead_custom_check-"></label>
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
													<th class="text-center">
														Dossier
													</th>

												</tr>
											</thead>
											<tbody class="database-table__body" id="progressLeadSearch">
												@include('includes.crm.lead__by_status_new_design')
											</tbody>
										</table>
									</div>
									<div class="pagination-wrapper">
										{{ $leads->onEachSide(1)->links() }}
									</div>
								</div>
							</div>
						</div>
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
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
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

		{{-- Bulk Delete Form  --}}
		{{-- <form id="leadDeleteForm" action="{{ route('lead.bulk.delete') }}" method="post">
			@csrf
			<div id="du">
				<input type="hidden" name="checkedLead" id="bulkLeadDelete" value="">
			</div>
		</form> --}}
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
								<input type="hidden" name="checkedLead" class="bulk_selected_lead" value="">
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
							<input type="hidden" name="selected_lead_id" class="bulk_selected_lead">
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

		<form action="{{ route('pagination.number.change') }}" id="paginationCountForm" method="POST">
			@csrf
			<input type="hidden" name="module" value="lead">
			<input type="hidden" name="number" id="paginationCountInput">
		</form>

		@include('includes.crm.footer-contact')

@endsection

@push('js')
<script>
	$(document).ready(function(){
		$('body').on('change','.lead_staus__change', function(){
			if($(this).val() == 5){
				$(this).closest('.status_change__modal').find('.dead_reason__wrap').slideDown();
				$(this).closest('.status_change__modal').find('.dead_reason__wrap').find('.form-control').attr('required', true);
			}else{
				$(this).closest('.status_change__modal').find('.dead_reason__wrap').slideUp();
				$(this).closest('.status_change__modal').find('.dead_reason__wrap').find('.form-control').attr('required', false);
			}
		});
		$('body').on('click','.status_change__btn', function(){
			$(this).closest('.status_change__modal').find('.status_change__btn_block').slideUp();
			$(this).closest('.status_change__modal').find('.status_change__input').slideDown();
		});
		$(document).on('click', '#Click2CopyNumber', function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type : "POST",
				url  : "{{ route('lead.number.copy') }}",
				data : {
					lead_id : lead_id_array,
				},
				success : response => {
					numbers = response.numbers.replace(/<\/?br>/g, '\r');
					var $temp = $("<textarea>");
					$("body").append($temp);
					$temp.val(numbers).select();
					document.execCommand("copy");
					$temp.remove();
					if(response.status){
						$('#successMessage').html('Numéros copiés dans le presse-papiers');
						$('.toast.toast--success').toast('show');
					}else{
						$('#errorMessage').html("Aucun numéro trouvé");
                		$('.toast.toast--error').toast('show');
					}
				}
			})
		});
		$(document).on('change', '#paginationCount', function(){
			$('#paginationCountInput').val($(this).val());
			$('#paginationCountForm').submit();
		});

		$(document).on("input", ".distribute-search__input", function() {
			let searchValue = $(this).val().toLowerCase();
			$(this).closest(".distribute-wrapper").find(".distribute-list__item").filter(function() {
				$(this).toggle($(this).find(".distribute-list__item__info__title").text().toLowerCase().indexOf(searchValue) > -1)
			});
		});

		function countTotalInput(){
			var inputValue = 0;
			$('.number-spinner__input').each(function(){
				inputValue += +$(this).val();
			});

			return inputValue;
		}

		var lead_id_array = [];
		$('body').on('click', '.lead_checkbox_item', function(){
			var id = $(this).attr('data-id');
			if(lead_id_array.indexOf(id)  != -1){
				lead_id_array = lead_id_array.filter(item => item !== id)
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
			}
			else{
				lead_id_array.push(id)
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
			}

			if(lead_id_array.length == 0)
			{
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
			}
		});

		$('.lead_checkbox_all').click(function(){
			lead_id_array = [];
			if(this.checked)
			{
			$('.lead_checkbox_item').each(function(){
				lead_id_array.push($(this).attr('data-id'))
				$('.bulk_selected_lead').val(lead_id_array);
				$('#selectedLeadCount').text(lead_id_array.length);
			});
			}
			if(lead_id_array.length == 0)
			{
				$("#allActionButton").removeClass('d-inline-flex');
				$("#allActionButton").addClass('d-none');
			}else{
				$("#allActionButton").removeClass('d-none');
				$("#allActionButton").addClass('d-inline-flex');
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

		});


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

	$('body').on('click', '#leadDeleteFormButton', function(){
		// var text = "{{ __('Are You Sure To Delete this') }}";
		// if(confirm(text) == true){
			$('#leadBulkDeleteModal').modal('show');
		// }
		// else{
		// 	return false
		// }
	});

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
