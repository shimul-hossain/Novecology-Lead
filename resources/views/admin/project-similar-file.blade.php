{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
Dossier similaire 
@endsection

{{-- active menu  --}}
@section('projectIndex')
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
						<h1 class="banner__title text-center text-white">Dossier similaire</h1> 
					</div>
					<div class="col-lg mb-2 text-center text-lg-left">
						<input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input" id="client_search_bar">
					</div> 
					<div class="col-12">
                        <div class="alert bg-danger mb-0 text-white">
                            <div class="alert-body">Attention, dossier(s) similaire(s) déja saisi(s).</div>
                        </div>
						<div class="database-table-wrapper bg-white">
							<div class="table-responsive simple-bar">
								<table class="table database-table table--dashboard w-100 mb-0" id="dataTabless">
									<thead class="database-table__header">
										<tr> 
                                            <th>#</th>
                                            <th>Client</th>  
                                            <th>Adresse</th>  
                                            <th>Code postal</th>  
                                            <th>TAG</th>  
                                            <th>Téléphone</th>  
                                            <th>Type</th>  
                                            <th>Statut</th>  
                                            <th>Telecommercial</th>  
                                            <th>LIEN</th>  
										</tr>
									</thead>
									<tbody class="database-table__body"> 
										{{-- <tr> 
                                            <td>1</td>
                                            <td>{{ $primary_tax->first_name .' '.$primary_tax->last_name}}</td>
                                            @if ($primary_tax->same_as_work_address == 'no')
                                                <td>{{ $primary_tax->Adresse_Travaux }}</td>
                                            @else
                                                <td>{{ $primary_tax->address2 }}</td>
                                            @endif
                                            <td>{{ $primary_tax->postal_code }}</td>
                                            <td>
												@if ($primary_tax->getProject)
													@foreach ($primary_tax->getProject->ProjectBareme->where('rank', 1) as $tag)
														{{ $tag->tag .', '?? '' }}
													@endforeach
												@endif
											</td>
                                            <td>{{ $primary_tax->phone }}</td>
                                            <td>Chantier</td>
                                            <td>{{ $primary_tax->getProject ? ($primary_tax->getProject->projectStatus ? $primary_tax->getProject->projectStatus->status :'' ) : '' }}</td>
											<td>
												@if ($primary_tax->getProject)
													{{ $primary_tax->getProject->getProjectTelecommercial->name ?? '' }}
												@endif
											</td>
                                            <td><a href="{{ route('files.index',$primary_tax->project_id) }}" class="search-result-list-item__btn">
												<svg width="1em" height="1em" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M26.5622 29.9996H3.43731C1.54106 29.9996 0 28.4583 0 26.5623V8.43731C0 6.54106 1.541 5 3.43731 5H7.81235C8.32984 5 8.74984 5.42 8.74984 5.93749C8.74984 6.45499 8.32984 6.87498 7.81235 6.87498H3.43731C2.57599 6.87498 1.87498 7.57605 1.87498 8.43731V26.5623C1.87498 27.4233 2.57605 28.1246 3.43731 28.1246H26.5622C27.4235 28.1246 28.1247 27.4233 28.1247 26.5623V15.9372C28.1247 15.4197 28.5447 14.9997 29.0622 14.9997C29.5797 14.9997 29.9997 15.4197 29.9997 15.9372V26.5623C29.9997 28.4584 28.4584 29.9996 26.5622 29.9996Z" fill="currentColor"></path>
													<path d="M8.43608 19.984C8.36655 19.9843 8.29725 19.9758 8.22984 19.9588C7.80621 19.8601 7.5 19.4976 7.5 19.0627V17.1877C7.5 10.4678 12.9674 5.00035 19.6874 5.00035H19.9998V0.937737C19.9999 0.750699 20.0559 0.567963 20.1606 0.412958C20.2653 0.257953 20.4139 0.137745 20.5873 0.0677459C20.7606 -0.00201931 20.9508 -0.0183533 21.1334 0.0208444C21.3161 0.0600421 21.4828 0.152979 21.6122 0.287705L29.7372 8.72512C30.0872 9.0877 30.0872 9.66261 29.7372 10.0252L21.6122 18.4626C21.3472 18.7389 20.9384 18.824 20.5873 18.6826C20.4139 18.6126 20.2653 18.4924 20.1606 18.3374C20.0559 18.1823 19.9999 17.9996 19.9998 17.8126V13.7502H18.5148C14.5825 13.7502 11.0485 15.9351 9.29119 19.4513C9.12983 19.7764 8.7911 19.984 8.43608 19.984ZM19.6874 6.87534C14.4373 6.87534 10.09 10.819 9.45373 15.9C11.726 13.3652 14.9848 11.8752 18.5148 11.8752H20.9373C21.4548 11.8752 21.8748 12.2952 21.8748 12.8127V15.4876L27.7609 9.37516L21.8748 3.26271V5.93784C21.8748 6.45534 21.4548 6.87534 20.9373 6.87534H19.6874Z" fill="currentColor"></path>
												</svg>
											</a>
											@if (role() == 's_admin')
												<button type="button" data-toggle="modal" data-target="#leadSingleDeleteModal{{ $primary_tax->id }}"  class="btn btn-icon shadow-none ml-auto mt-auto">
													<i class="bi bi-trash3"></i>
												</button>  
												@push('all_modals')
													<div class="modal modal--aside fade" id="leadSingleDeleteModal{{ $primary_tax->id }}" tabindex="-1" aria-labelledby="TicketMessageStoreModal" aria-hidden="true">
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
																	<form action="{{ route('project.single.delete') }}" method="POST">
																		@csrf
																		<input type="hidden" name="id" value="{{ $primary_tax->project_id }}">
																		<input type="hidden" name="similar_status" value="1">
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
												@endpush
											@endif
										</td>
                                        </tr>  --}}
                                        @foreach ($projects as $project)
                                            <tr> 
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ ucwords($project->Prenom) .' '. ucwords($project->Nom) }}</td>
                                                <td>{{ $project->Adresse }}</td>
												<td>{{ $project->Code_Postal }}</td>
												<td>
													@foreach ($project->ProjectBareme->where('rank', 1) as $tag)
														{{ $tag->tag .', '?? '' }}
													@endforeach
												</td>
                                                <td>{{ $project->phone }}</td>
												<td>Chantier</td>
                                                <td>{{ $project->getSubStatus->name ?? ''  }}</td>
												<td> 
													{{ $project->getProjectTelecommercial->name ?? '' }}
												</td>
												<td><a href="{{ route('files.index',$project->id) }}" class="search-result-list-item__btn">
													<svg width="1em" height="1em" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M26.5622 29.9996H3.43731C1.54106 29.9996 0 28.4583 0 26.5623V8.43731C0 6.54106 1.541 5 3.43731 5H7.81235C8.32984 5 8.74984 5.42 8.74984 5.93749C8.74984 6.45499 8.32984 6.87498 7.81235 6.87498H3.43731C2.57599 6.87498 1.87498 7.57605 1.87498 8.43731V26.5623C1.87498 27.4233 2.57605 28.1246 3.43731 28.1246H26.5622C27.4235 28.1246 28.1247 27.4233 28.1247 26.5623V15.9372C28.1247 15.4197 28.5447 14.9997 29.0622 14.9997C29.5797 14.9997 29.9997 15.4197 29.9997 15.9372V26.5623C29.9997 28.4584 28.4584 29.9996 26.5622 29.9996Z" fill="currentColor"></path>
														<path d="M8.43608 19.984C8.36655 19.9843 8.29725 19.9758 8.22984 19.9588C7.80621 19.8601 7.5 19.4976 7.5 19.0627V17.1877C7.5 10.4678 12.9674 5.00035 19.6874 5.00035H19.9998V0.937737C19.9999 0.750699 20.0559 0.567963 20.1606 0.412958C20.2653 0.257953 20.4139 0.137745 20.5873 0.0677459C20.7606 -0.00201931 20.9508 -0.0183533 21.1334 0.0208444C21.3161 0.0600421 21.4828 0.152979 21.6122 0.287705L29.7372 8.72512C30.0872 9.0877 30.0872 9.66261 29.7372 10.0252L21.6122 18.4626C21.3472 18.7389 20.9384 18.824 20.5873 18.6826C20.4139 18.6126 20.2653 18.4924 20.1606 18.3374C20.0559 18.1823 19.9999 17.9996 19.9998 17.8126V13.7502H18.5148C14.5825 13.7502 11.0485 15.9351 9.29119 19.4513C9.12983 19.7764 8.7911 19.984 8.43608 19.984ZM19.6874 6.87534C14.4373 6.87534 10.09 10.819 9.45373 15.9C11.726 13.3652 14.9848 11.8752 18.5148 11.8752H20.9373C21.4548 11.8752 21.8748 12.2952 21.8748 12.8127V15.4876L27.7609 9.37516L21.8748 3.26271V5.93784C21.8748 6.45534 21.4548 6.87534 20.9373 6.87534H19.6874Z" fill="currentColor"></path>
													</svg>
												</a>
												@if (role() == 's_admin')
													<button type="button" data-toggle="modal" data-target="#leadSingleDeleteModal{{ $project->id }}"  class="btn btn-icon shadow-none ml-auto mt-auto">
														<i class="bi bi-trash3"></i>
													</button>  
													@push('all_modals')
														<div class="modal modal--aside fade" id="leadSingleDeleteModal{{ $project->id }}" tabindex="-1" aria-labelledby="TicketMessageStoreModal" aria-hidden="true">
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
																		<form action="{{ route('project.single.delete') }}" method="POST">
																			@csrf
																			<input type="hidden" name="id" value="{{ $project->id }}">
																			<input type="hidden" name="similar_status" value="1">
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
													@endpush
												@endif
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
		</section>  
@include('includes.crm.footer-contact')

@endsection

@push('js')
<script>
	$(document).ready(function(){ 
		$("#client_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTabless tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
	});

</script>
@endpush
