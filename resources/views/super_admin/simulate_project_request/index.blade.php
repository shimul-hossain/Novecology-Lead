@extends('super_admin.dashboard')


{{-- Title --}}
@section('title')
 {{config('app.name')}}| {{ __('Simulation Requests') }} 
@endsection 

{{-- Menu Active --}}
@section('simulationIndex') 
active 
@endsection 


{{-- Breadcrumb --}}
@section('breadcrumb') <div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('superadmin.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Project Simulations Requests') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>@endsection @section('content') <section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success">
                <div class="alert-body">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            @if (session('update'))
            <div class="alert alert-warning">
                <div class="alert-body">
                    {{ session('update') }}
                </div>
            </div>
            @endif
            @if (session('delete'))
            <div class="alert alert-danger">
                <div class="alert-body">
                    {{ session('delete') }}
                </div>
            </div>
            @endif
            @if (session('deny'))
            <div class="alert alert-danger">
                <div class="alert-body">
                    {{ session('deny') }}
                </div>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('Requests List') }}</h4> 
                    <div class="d-flex flex-wrap align-items-center gap-15">
                        <div class="dropdown-button">
                            <div class="dropdown d-none" id="bulk_action_section">
                                <button class="btn btn-warning dropdown-toggle white-arrow w-sm-auto" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather='grid'></i>
                                    {{ __('Bulk Action') }}
                                </button> 
                                <div class="dropdown-menu w-100">   
                                    <a class="dropdown-item bulkExport" data-status="0">{{ __('Export') }}</a>
                                    <a class="dropdown-item" data-toggle="modal" data-target="#bulkDeleteModal">{{ __('Delete') }}</a>
                                </div>
                            </div>
                        </div> 
                        <button class="btn btn-outline-warning bulkExport" data-status="1" type="button"><span>Exporter All</span></button>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped" id="data_table">
                            <thead>
                                <tr> 
                                    <th>
                                        <div class="custom-control custom-checkbox" cursorshover="true">
                                            <input type="checkbox" name="check_all" value="1" id="all-select" class="check_all custom-control-input">
                                            <label class="custom-control-label" for="all-select" cursorshover="true"></label>
                                        </div>
                                    </th>
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('First Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Address') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>@foreach ($data as $item) <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox" cursorshover="true">
                                            <input type="checkbox" id="customCheck{{ $item->id }}" class="custom-control-input single_checkbox" data-id="{{ $item->id }}">
                                            <label class="custom-control-label" for="customCheck{{ $item->id }}" cursorshover="true"></label>
                                        </div> 
                                    </td>
                                    <td>
                                        <span> {{$loop->index+1}}</span>
                                    </td>
                                    <td>
                                        <span> {{$item->first_name}}</span>
                                    </td>
                                    <td>
                                        <span> {{$item->email}}</span>
                                    </td>
                                    <td>
                                        <span>{{$item->address}}</span>
                                    </td>
                                  
                                    <td>
                                        <div class="dropdown"><button type="button"
                                                class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
                                                data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                    height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-vertical">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#exampleModalLong"
                                                    href="{{ route('simulateProjects.show',$item->id) }}"><i
                                                        data-feather="eye"></i>
                                                        <span>{{ __('Details') }}</span>
                                                </a> 
                                                        {{-- <a class="dropdown-item"
                                                    href="{{ route('ourSocieties.edit',$item->id) }}"><i
                                                        data-feather='edit-3'></i>"
                                                    <span>Edit</span></a>--}}
    
                                                <form action="{{ route('simulateProjects.destroy',$item->id) }}"
                                                    method="POST">
                                                    {{method_field('DELETE')}}
    
                                                    @csrf <a class="dropdown-item"
                                                        href="{{ route('simulateProjects.destroy',$item->id) }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit()">
                                                        <i data-feather='trash-2'></i>
                                                        <span>{{ __('Delete') }}</span>
                                                    </a>
                                                </form>
                                            </div>
    
                                             {{-- Modal --}}
                                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Simulation Requests Details') }}</h5><button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">&times;
    
                                                    </span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table id="" class="table table-striped table-bordered">
                                                        <tbody>
                                                            <tr>
                                                                <th class="font-weight-bold">{{ __('First Name') }}</th>
                                                                <td>
                                                                    <span> {{$item->second_name}}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="font-weight-bold">{{ __('First Name') }}</th>
                                                                <td>
                                                                    <span>{{$item->second_name}}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="font-weight-bold">{{ __('Email') }}</th>
                                                                <td>
                                                                    <span> {{$item->email}}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="font-weight-bold">{{ __('Phone Number') }}</th>
                                                                <td>
                                                                    <span> {{$item->phone}}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="font-weight-bold">{{ __('Address') }}</th>
                                                                <td>
                                                                    <span> {{$item->address}}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="font-weight-bold">{{ __('Address') }}</th>
                                                                <td>
                                                                    <span> {{$item->postal_code}}</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th class="font-weight-bold">{{ __('Delete') }}</th>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('simulateProjects.destroy',$item->id) }}"
                                                                        method="POST"> 
                                                                        {{method_field('DELETE')}}
    
                                                                        @csrf
                                                                         <a class="btn btn-sm btn-danger"
                                                                            href="{{ route('simulateProjects.destroy',$item->id) }}"
                                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                                            <span>{{ __('Delete') }}</span></a>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
</section>
<div class="modal fade" id="bulkDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('project.bulk.delete') }}" method="post" class="py-1">
                @csrf
                <input type="hidden" name="selected_id" class="selected_id">
                <div class="modal-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" style="font-size: 100px" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle text-danger">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <h2 class="font-weight-normal mt-1">{{ __('Are you sure') }}?</h2>
                    <h4 class="font-weight-light mb-0">{{ __("You won't be able to revert this!") }}</h4>
                </div>
                <div class="modal-footer border-top-0 justify-content-center">
                    <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        {{ __('Close') }}
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-float waves-light">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                        {{ __('Delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="bulkExportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Select Headers')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('project.bulk.download') }}" method="POST">
                <div class="modal-body">
                    @csrf 
                    <input type="hidden" name="is_all" class="selected_status" value="0">  
                    <input type="hidden" name="selected_id" class="selected_id">  
                    <div class="demo-inline-spacing">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="first_name" value="first_name" class="custom-control-input" id="download_first_name" checked>
                            <label class="custom-control-label" for="download_first_name">{{ __('First Name') }}</label>
                        </div>
                    </div> 
                    <div class="demo-inline-spacing">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="email" value="email" class="custom-control-input" id="download_email" checked>
                            <label class="custom-control-label" for="download_email">{{ __('Email') }}</label>
                        </div>
                    </div> 
                    <div class="demo-inline-spacing">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="address" value="address" class="custom-control-input" id="download_address" checked>
                            <label class="custom-control-label" for="download_address">{{ __('Address') }}</label>
                        </div>
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Download')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js') 
    <script>
        $(document).ready(function () { 
            $('body').on('click', '.bulkExport', function(){
                $('.selected_status').val($(this).data('status'));
                $('#bulkExportModal').modal('show');
            });

            $('body').on("change", "#all-select",function(){
                selected_ids = [];
                
                if($(this).is(":checked")){
                    $('.single_checkbox').prop('checked', true); 
                    $('.single_checkbox').each(function(){
                        selected_ids.push($(this).attr('data-id'));
                    });

                    if(selected_ids.length == 0){ 
                        $("#bulk_action_section").addClass('d-none'); 
                    }
                    else
                    { 
                        $("#bulk_action_section").removeClass('d-none'); 
                        $('.selected_id').val(selected_ids); 
                    }

                }else{ 
                    $('.single_checkbox').prop('checked', false); 
                    $("#bulk_action_section").addClass('d-none'); 
                } 
            });
            
            
            $('body').on("change", ".single_checkbox",function(){
                selected_ids = [];
                
                $('.single_checkbox').each(function(){
                    if($(this).is(":checked")){
                        selected_ids.push($(this).attr('data-id')); 
                    }
                });

                if(selected_ids.length == 0){ 
                    $("#bulk_action_section").addClass('d-none'); 
                } 
                else {   
                    $("#bulk_action_section").removeClass('d-none'); 
                    $('.selected_id').val(selected_ids); 
                } 
            });
        })
    </script>
@endsection
