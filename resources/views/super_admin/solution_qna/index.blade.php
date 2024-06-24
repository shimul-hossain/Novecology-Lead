@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Our Solution Details 
@endsection

{{-- Menu Active --}}
@section('oursolutionDetailsIndex')
active
@endsection
@section('css')
    <style>
        .trix-button--icon-attach
        {
            display: none !important;
        }
        .trix-button
        {
            display: none !important;
        }
        .trix-button--icon
        {
            display: none !important;
        }

    </style>
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('superadmin.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">Super Admin Dashboard</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Our Solution Details Section</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Our Solution Details List</h4>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('update'))
                    <div class="alert alert-warning">{{ session('update') }}</div>
                    @endif
                    @if (session('delete'))
                    <div class="alert alert-danger">{{ session('delete') }}</div>
                    @endif
                    @if (session('deny'))
                    <div class="alert alert-danger">{{ session('deny') }}</div>
                    @endif
                </div>
             
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped" id="data_table">
                            <thead>
                                <tr>
                                    <th>Our Solution Title</th>
                                    <th>First Qsn</th>
                                    <th>Second Qsn</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                <tr>
                                    <td> 
                                        <span>{{$detail->solution->title}}</span> 
                                    </td>
                                    <td> 
                                        <span>{{$detail->first_qsn}}</span> 
                                    </td>
                                 
                                    <td> 
                                        <span>{{$detail->second_qsn}}</span> 
                                    </td>
    
     
                                    <td>
                                        <div class="dropdown">
                                                <button type="button"
                                                    class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
                                                    data-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-more-vertical">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('solutionDetails.show',$detail->id) }}">
                                                        <i data-feather="eye"></i>
                                                        <span>Details</span>
                                                    </a>
    
                                                    <a class="dropdown-item" href="{{ route('solutionDetails.edit',$detail->id) }}">
                                                      <i data-feather='edit-3'></i>"
                                                        <span>Edit</span>
                                                    </a>
                                                   
                                                    <form action="{{ route('solutionDetails.destroy',$detail->id) }}" method="POST">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                     
                                                        <a class="dropdown-item" href="{{ route('solutionDetails.destroy',$detail->id) }}"
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                            <i data-feather='trash-2'></i>
                                                            <span>Delete</span>
                                                        </a>
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
</section>
    
@endsection