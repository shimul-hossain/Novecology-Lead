{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
{{ __('Automatisation') }}
@endsection

{{-- active menu  --}}
@section('automatisationIndex')
active
@endsection  



{{-- Main Content Part  --}}
@section('content')
		<!-- Banner Section -->
		<section class="banner section-gap position-relative">
			<div class="container">
				{{-- <a href="{{ url()->previous() }}" class="back-btn d-inline-block p-2"><span class="novecologie-icon-arrow-left"></span></a> --}}
				<div class="row justify-content-center">
					<div class="col-12">
						<h1 class="banner__title text-center text-white">Menu Marketing </h1>
						{{-- <p class="text-center text-white mb-2 mb-md-0">Suivez l'évolution des prospects en temps réel</p> --}}
					</div>
					<div class="col-lg mb-2 text-center text-lg-left">
						<input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input" id="search_bar">
					</div>
					<div class="col-lg-auto d-flex flex-wrap align-items-center justify-content-center justify-content-lg-right mb-2 mb-lg-0"> 
						<div class="dropdown d-none" id="allActionButton">
							<button type="button" class="primary-btn primary-btn--white primary-btn--lg rounded d-inline-flex align-items-center justify-content-center border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Actions
							</button>
							<div class="dropdown-menu">
								<button type="button" class="dropdown-item border-0" data-toggle="modal" data-target="#bulkDeleteModal">
									<span class="novecologie-icon-trash mr-1"></span> Supprimer
								</button>  
							</div>
						</div>   
					</div>
					<div class="col-lg-auto d-flex flex-wrap align-items-center justify-content-center justify-content-lg-right mb-2 mb-lg-0">
						<button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 rounded ">+ {{ __('Nouvelle campagne') }}</button>
                        <select id="paginationCount" class="custom-select w-auto ml-2">
                            <option {{ paginationNumber('automatisation') == '10' ? 'selected':'' }} value="10">10</option>
                            <option {{ paginationNumber('automatisation') == '50' ? 'selected':'' }} value="50">50</option>
                            <option {{ paginationNumber('automatisation') == '100' ? 'selected':'' }} value="100">100</option>
                        </select>
					</div>
					<div class="col-12">
						<div class="database-table-wrapper bg-white">
							<div class="table-responsive simple-bar">
								<table class="table database-table w-100 mb-0" id="dataTabless">
									<thead class="database-table__header">
										<tr>
											<th class="text-left">
												<div class="custom-control custom-checkbox">
													<input value="1" type="checkbox" class="custom-control-input table-all-select-checkbox" id="tableAllSelectCheck">
													<label class="custom-control-label" for="tableAllSelectCheck"></label>
												</div>
											</th> 
											<th>
												Nom Campagne
											</th> 
											<th>
												Crée par
											</th> 
											<th>
												Date début
											</th> 
											<th>
												Date fin
											</th> 
											<th class="text-center">
												{{ __('Actions') }}
											</th>
										</tr>
									</thead>
									<tbody class="database-table__body">  
										@forelse ($items as $item)
											<tr>
												<td>
													<div class="custom-control custom-checkbox">
														<input value="1" type="checkbox" data-id="{{ $item->id }}" class="custom-control-input table-select-checkbox CheckboxBtn" id="tableRowSelectCheck-{{ $item->id }}">
														<label class="custom-control-label" for="tableRowSelectCheck-{{ $item->id }}"></label>
													</div>
												</td>
												<td>{{ $item->nom_campagne }}</td>
												<td>{{ $item->createdBy->name ?? '' }}</td>
												<td>{{ \Carbon\Carbon::parse($item->date_de_debut)->format('d-m-Y') }}</td>
												<td>{{ \Carbon\Carbon::parse($item->date_de_fin)->format('d-m-Y') }}</td> 
												<td>
													<div class="d-flex align-items-center justify-content-center"> 
														<label class="switch-checkbox mr-2">
															<input data-id="{{ $item->id }}" type="checkbox" {{ $item->status == 1 ? 'checked':'' }} class="switch-checkbox__input automatisationStatusChange">
															<span class="switch-checkbox__label"></span>
														</label> 
														<div class="dropdown dropdown--custom p-0 d-inline-block">
															<button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<span class="novecologie-icon-dots-horizontal-triple"></span>
															</button>
															<div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
																<button type="button" data-toggle="modal" data-target="#editModal{{ $item->id }}" class="dropdown-item border-0">
																	<span class="novecologie-icon-edit mr-1"></span>
																	Modifier
																</button> 
																<button type="button" data-toggle="modal" data-target="#singleDeleteModal{{ $item->id }}" class="dropdown-item border-0">
																	<span class="novecologie-icon-trash mr-1"></span>
																	Supprimer
																</button> 
															</div>
														</div>
													</div>
												</td>
											</tr>  
											@push('all_modals')
												{{-- Delete Modal  --}}
												<div class="modal modal--aside fade" id="singleDeleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered">
														<div class="modal-content border-0">
															<div class="modal-header border-0 pb-0">
																<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
																	<span class="novecologie-icon-close"></span>
																</button>
															</div>
															<div class="modal-body text-center pt-0">
																<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
																<span>{{ __('Are You Sure To Delete this') }}?</span>
																<form action="{{ route('automatisation.delete') }}" method="POST">
																	@csrf
																	<input type="hidden" name="id" value="{{ $item->id }}">
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

													<!-- Edit Modal -->
												<div class="modal modal--aside fade rightAsideModal" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
													<div class="modal-dialog m-0 h-100 bg-white">
														<div class="modal-content border-0 h-100 rounded-0 simple-bar">
															<div class="modal-header border-0 pb-0">
																<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
																	<span class="novecologie-icon-close"></span>
																</button>
															</div>
															<div class="modal-body">
																<h1 class="modal-title text-center">Modifier une campagne</h1> 
																<form action="{{ route('automatisation.update') }}" method="POST">
																	@csrf  
																	<div class="row">
																		<div class="col-12">
																			<div class="form-group">
																				<label class="form-label" for="nom_campagne{{ $item->id }}">Nom campagne <span class="text-danger">*</span></label>
																				<input type="hidden" name="id" value="{{ $item->id }}">
																				<input type="text" name="nom_campagne" value="{{ $item->nom_campagne }}" id="nom_campagne{{ $item->id }}" class="form-control shadow-none" required>
																			</div>
																		</div>
																		<div class="col-12">
																			<div class="form-group">
																				<label class="form-label" for="type_de_campagne{{ $item->id }}">Type de campagne <span class="text-danger">*</span></label>
																				<select name="type_de_campagne" id="type_de_campagne{{ $item->id }}" class="select2_select_option shadow-none form-control" required>
																					<option value="" selected>{{ __('Select') }}</option>
																					<option {{ $item->type_de_campagne == 'SMS' ? 'selected':'' }} value="SMS">SMS</option>
																					<option {{ $item->type_de_campagne == 'EMAIL' ? 'selected':'' }} value="EMAIL">EMAIL</option>
																					<option {{ $item->type_de_campagne == 'SMS + EMAIL' ? 'selected':'' }} value="SMS + EMAIL">SMS + EMAIL</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-12">
																			<div class="form-group">
																				<label class="form-label" for="recurrence{{ $item->id }}">Récurrence <span class="text-danger">*</span></label>
																				<select name="recurrence" id="recurrence{{ $item->id }}" class="select2_select_option shadow-none form-control" required>
																					<option value="" selected>{{ __('Select') }}</option>
																					<option {{ $item->recurrence == "Tous les jours" ? 'selected':"" }} value="Tous les jours">Tous les jours</option>
																					<option {{ $item->recurrence == "Tous les 2 jours" ? 'selected':"" }} value="Tous les 2 jours">Tous les 2 jours</option>
																					<option {{ $item->recurrence == "Tous les 3 jours" ? 'selected':"" }} value="Tous les 3 jours">Tous les 3 jours</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-12">
																			<div class="form-group">
																				<label class="form-label" for="date_de_debut{{ $item->id }}">Date de debut <span class="text-danger">*</span></label>
																				<input type="date" name="date_de_debut" id="date_de_debut{{ $item->id }}" value="{{ $item->date_de_debut }}" class="flatpickr flatpickr-input form-control shadow-none" placeholder="{{ __('dd-mm-yyyy') }}" required>
																			</div>
																		</div>
																		<div class="col-12">
																			<div class="form-group">
																				<label class="form-label" for="horaire_de_debut{{ $item->id }}">Horaire de debut <span class="text-danger">*</span></label>
																				<input type="text" name="horaire_de_debut" id="horaire_de_debut{{ $item->id }}" value="{{ $item->horaire_de_debut }}" class="form-control shadow-none" required>
																			</div>
																		</div>
																		<div class="col-12">
																			<div class="form-group">
																				<label class="form-label" for="date_de_fin{{ $item->id }}">Date de fin <span class="text-danger">*</span></label>
																				<input type="date" name="date_de_fin" id="date_de_fin{{ $item->id }}" value="{{ $item->date_de_fin }}" class="flatpickr flatpickr-input form-control shadow-none" placeholder="{{ __('dd-mm-yyyy') }}" required>
																			</div>
																		</div>
																		<div class="col-12 text-right">
																			<button type="submit" class="secondary-btn primary-btn--md border-0 mt-4">{{ __('Submit') }}</button>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div> 
											@endpush
										@empty
											<tr>
												<td colspan="10000">
													<h2 class="text-center py-3">{{ __('No results found.') }}</h2>
												</td>
											</tr>
										@endforelse
									</tbody>
								</table>
							</div>
							<div class="pagination-wrapper">
								{{ $items->onEachSide(1)->links() }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</section> 

		<!-- Right Aside Modal -->
		<div class="modal modal--aside fade rightAsideModal" id="rightAsideModal" tabindex="-1" aria-labelledby="rightAsideModalLabel" aria-hidden="true">
			<div class="modal-dialog m-0 h-100 bg-white">
				<div class="modal-content border-0 h-100 rounded-0 simple-bar">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body">
						<h1 class="modal-title text-center">Cree une campagne</h1> 
						<form action="{{ route('automatisation.store') }}" method="POST">
							@csrf  
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="nom_campagne">Nom campagne <span class="text-danger">*</span></label>
										<input type="text" name="nom_campagne" id="nom_campagne" class="form-control shadow-none" required>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="type_de_campagne">Type de campagne <span class="text-danger">*</span></label>
										<select name="type_de_campagne" id="type_de_campagne" class="select2_select_option shadow-none form-control" required>
											<option value="" selected>{{ __('Select') }}</option>
											<option value="SMS">SMS</option>
											<option value="EMAIL">EMAIL</option>
											<option value="SMS + EMAIL">SMS + EMAIL</option>
										</select>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="recurrence">Récurrence <span class="text-danger">*</span></label>
										<select name="recurrence" id="recurrence" class="select2_select_option shadow-none form-control" required>
											<option value="" selected>{{ __('Select') }}</option>
											<option value="Tous les jours">Tous les jours</option>
											<option value="Tous les 2 jours">Tous les 2 jours</option>
											<option value="Tous les 3 jours">Tous les 3 jours</option>
										</select>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="date_de_debut">Date de debut <span class="text-danger">*</span></label>
										<input type="date" name="date_de_debut" id="date_de_debut" class="flatpickr flatpickr-input form-control shadow-none" placeholder="{{ __('dd-mm-yyyy') }}" required>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="horaire_de_debut">Horaire de debut <span class="text-danger">*</span></label>
										<input type="text" name="horaire_de_debut" id="horaire_de_debut" class="form-control shadow-none" required>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label class="form-label" for="date_de_fin">Date de fin <span class="text-danger">*</span></label>
										<input type="date" name="date_de_fin" id="date_de_fin" class="flatpickr flatpickr-input form-control shadow-none" placeholder="{{ __('dd-mm-yyyy') }}" required>
									</div>
								</div>
								<div class="col-12 text-right">
									<button type="submit" class="secondary-btn primary-btn--md border-0 mt-4">{{ __('Submit') }}</button>
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
						<form action="{{ route('client.assign') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
							@csrf
							<h1 class="form__title position-relative text-center mb-4">{{__('Assign Leads')}}</h1>
							<div class="form-group d-flex flex-column align-items-center position-relative" id="clientAssignModal"> 
							</div>
							<div class="form-group d-flex flex-column align-items-center mt-4">
								<button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{__('Assign')}}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> 

		<div class="modal modal--aside fade" id="bulkDeleteModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content border-0">
					<div class="modal-header border-0 pb-0">
						<button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
							<span class="novecologie-icon-close"></span>
						</button>
					</div>
					<div class="modal-body text-center pt-0">
						<h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
						<span>{{ __('Are You Sure To Delete this') }}?</span>
						<form action="{{ route('automatisation.bulk.delete') }}" method="POST">
							@csrf
							<input type="hidden" name="id" class="bulkSelected">
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
		<form action="{{ route('pagination.number.change') }}" id="paginationCountForm" method="POST">
			@csrf
			<input type="hidden" name="module" value="automatisation">
			<input type="hidden" name="number" id="paginationCountInput">
		</form>
@include('includes.crm.footer-contact')

@endsection

@push('js')
<script>
	$(document).ready(function(){

		$(document).on('change', '#paginationCount', function(){
			$('#paginationCountInput').val($(this).val());
			$('#paginationCountForm').submit();
		});

		$(document).on('click', '.automatisationStatusChange', function(){
			let status, id = $(this).data('id'); 
			if($(this).is(':checked')){
				status = 1;
			}else{
				status = 0
			}
			$.ajax({
				type : "POST",
				url  : "{{ route('automatisation.status.change') }}",
				data : {id, status},
				success : response => {
                    $('#successMessage').html(response);
					$('.toast.toast--success').toast('show');
				}
			});
		});

		var automatisation_id_array = [];
 
		$('body').on('click', '.CheckboxBtn', function(){

			var id = $(this).attr('data-id');
			if(automatisation_id_array.indexOf(id)  != -1){

				automatisation_id_array = automatisation_id_array.filter(item => item !== id)
			}
			else{
				automatisation_id_array.push(id)
			}
			if(automatisation_id_array.length == 0)
			{
				$('.bulkSelected').val('');
				$("#allActionButton").addClass('d-none');
			}else{
				$('.bulkSelected').val(automatisation_id_array);
				$("#allActionButton").removeClass('d-none');
			} 
		});

		$('#tableAllSelectCheck').click(function(){
			automatisation_id_array = [];

			if(this.checked)
			{
				$('.CheckboxBtn').each(function(){
					automatisation_id_array.push($(this).attr('data-id'))
				});
			}
			if(automatisation_id_array.length == 0)
			{
				$('.bulkSelected').val('');
				$("#allActionButton").addClass('d-none');
			}else{
				$('.bulkSelected').val(automatisation_id_array);
				$("#allActionButton").removeClass('d-none');
			} 
		});
   
		$("#search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTabless tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});

</script>
@endpush
