{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('SAV') }}
@endsection

{{-- Backgroud color  --}}
@section('bodyBg')
secondary-bg    
@endsection

{{-- active menu  --}}
@section('sav')
active
@endsection


{{-- Main Content Part  --}}
@section('content')




<!-- Banner Section -->
    <section class="banner section-gap position-relative">
        <div class="container"> 
            <div class="row justify-content-center">
                <div class="col-12">
                    <h1 class="banner__title text-center text-white">{{ __('SAV') }}</h1> 
                </div>
                <div class="col-12 d-flex flex-wrap align-items-center justify-content-md-end mb-3">
                    <input type="search" placeholder="{{ __('Search') }}..." class="database-table__search-input w-25 mr-auto" id="sav_search_bar"> 
                    <button data-toggle="modal" data-target="#rightAsideModal" type="button" class="secondary-btn border-0 mt-3 mt-xl-0">+ {{ __('Add filter') }}</button>
                </div>
                <div class="col-12">
                    <div class="database-table-wrapper bg-white">
                        <div class="table-responsive simple-bar">
                            <table class="table database-table w-100 mb-0" id="dataTables">
                                <thead class="database-table__header"> 
                                    <tr>  
                                        @if ($filter_status->count()== 0)
                                        <th>{{ __('ID') }}</th>
                                        <th> 
                                            {{ __('Name') }}
                                        </th> 
                                        <th> 
                                            {{ __('Project Name') }}
                                        </th> 
                                        <th class="text-center">
                                            {{ __('Actions') }}
                                        </th> 
										@else 
											@foreach ($headers as $header)
												@foreach ($filter_status as $item) 
													@if ($item->sav_header_id == $header->id) 
                                                        @if ($header->header == 'Actions')
                                                            <th class="text-center">  
                                                                {{ $header->header }}
                                                            </th>   
                                                        @else
                                                            <th>  
                                                                {{ $header->header }}
                                                            </th>   
                                                        @endif
													@endif 
												@endforeach 
											@endforeach 
                                        @endif  

                                    </tr>
                                </thead>
                                <tbody class="database-table__body" id="all_user">
                                    @if ($filter_status->count()== 0)
                                        @forelse ($savs as $sav)
                                        <tr> 
                                            <td>{{ $sav->id }}</td>
                                            <td> {{ $sav->name }}</td>  
                                            <td>{{ $sav->getProject->project_name }}</td> 
                                            <td>
                                                <div class="d-flex align-items-center justify-content-around"> 
                                                    <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                        <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">  
                                                            <a  class="dropdown-item border-0 permission_modal_btn" href="{{ route('files.index', $sav->project_id) }}">
                                                                <span class="novecologie-icon-chevron-right mr-1"></span>
                                                                {{ __('Go To Project') }}
                                                            </a>  
                                                            @if (checkAction(Auth::id(), 'SAV', 'delete') || role() == 's_admin')
                                                            <form action="{{ route('project.sav.delete') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $sav->id }}">
                                                                <button type="submit" class="dropdown-item border-0">
                                                                    <span class="novecologie-icon-trash mr-1"></span>
                                                                    {{ __('Delete') }}
                                                                </button> 
                                                            </form> 
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  
                                        @empty 
                                        @endforelse 

                                    @else
                                       @forelse ($savs as $sav)
                                       <tr> 
                                            @foreach ($filter_status as $item)
                                                @php
                                                    $header = \App\Models\CRM\SavHeader::where('id', $item->sav_header_id)->first()->header;  
                                                @endphp
                                                @if($header == 'ID')
                                                    <td>{{ $sav->id??__('Not Provided') }}</td>
                                                @endif
                                                @if($header == 'Name'|| $header == 'Nom')
                                                    <td>{{ $sav->name??__('Not Provided') }}</td>
                                                @endif
                                                @if($header == 'Project name'|| $header == 'Nom du projet')
                                                    <td>{{ $sav->getProject->project_name??__('Not Provided') }}</td>
                                                @endif
                                                @if($header == 'Actions')
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-around"> 
                                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">  
                                                                    <a  class="dropdown-item border-0 permission_modal_btn" href="{{ route('files.index', $sav->project_id) }}">
                                                                        <span class="novecologie-icon-chevron-right mr-1"></span>
                                                                        {{ __('Go To Project') }}
                                                                    </a>  
                                                                    @if (checkAction(Auth::id(), 'SAV', 'delete') || role() == 's_admin')
                                                                    <form action="{{ route('project.sav.delete') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="id" value="{{ $sav->id }}">
                                                                        <button type="submit" class="dropdown-item border-0">
                                                                            <span class="novecologie-icon-trash mr-1"></span>
                                                                            {{ __('Delete') }}
                                                                        </button> 
                                                                    </form> 
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif 
                                            @endforeach  
                                        </tr>  
                                        @empty 
                                        @endforelse 



                                    @endif
                                </tbody>
                            </table>
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
                        <h1 class="modal-title text-center">{{ __('Additional filters') }}</h1>
                        <p class="modal-text text-center mb-5">{{ __('Filter your tables with your custom columns') }}</p>
                        <form action="{{ route('sav.header.filter') }}" class="form" id="clientsValidateForm" method="POST">
                            @csrf 
    
                            <h2 class="modal-sub-title position-relative">{{ __('Sav Filter') }}</h2>
                            <div class="row my-3">
                                @if ($filter_status->count() == 0)
                                    @foreach ($headers as $key => $header)
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox"> 
                                                <input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" checked >
                                                <label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
                                            </div>
                                        </div>
                                    @endforeach 
                                @else
                                    @foreach ($headers as $key => $header) 
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox"> 
                                                <input type="checkbox"  class="custom-control-input" value="{{ $header->id }}" id="foyerFormCheck-{{ $key }}" name="header_id[]" 
                                                    @foreach ($filter_status as $item)
                                                        @if ( $header->id == $item->sav_header_id)
                                                            checked
                                                        @endif
                                                    @endforeach
                                                >
                                                <label class="custom-control-label" for="foyerFormCheck-{{ $key }}">{{ ucfirst($header->header) }}</label>
                                            </div>
                                        </div>
                                    @endforeach 
                                @endif  
                            </div> 
                            <div class="row">
                                <div class="col"> 
                                    <button type="submit" class="secondary-btn border-0 mt-3">{{ __('Filter') }}</button> 
                                </div>
                            </div> 
                        </form> 
                    </div>
                </div>
            </div>
        </div>
@endsection






@push('js')
 <script>
     $(document).ready(function(){   
		$("#sav_search_bar").on("input", function() {
			var value = $(this).val().toLowerCase();
			$("#dataTables tbody tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			}); 
	    });
    });
 </script>
@endpush