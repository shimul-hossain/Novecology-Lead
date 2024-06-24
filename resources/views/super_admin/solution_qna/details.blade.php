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
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Solution Question Answer</h4>

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
                    <p class="card-text">

                    </p>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered">

                            <tbody>
                                <tr>
                                    <th class="font-weight-bold">Solution Title</th>
                                    <td>{{$detail->solution->title}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">First Question</th>
                                    <td>{{$detail->first_qsn}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">First Answer</th>
                                    <td>{!!$detail->first_ans!!}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">Second Question</th>
                                    <td>{{ $detail->second_qsn }}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">Second Question</th>
                                    <td>{!!$detail->second_ans!!}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">Edit</th>
                                    <td>
                                        <a class="btn btn-sm btn-secondary" href="{{ route('solutionDetails.edit',$detail->id) }}">
                                          <span>Edit</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">Delete</th>
                                    <td>
                                        <form action="{{ route('solutionDetails.destroy',$detail->id) }}" method="POST">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                         
                                            <a class="btn btn-sm btn-danger" href="{{ route('solutionDetails.destroy',$detail->id) }}"
                                                onclick="event.preventDefault(); this.closest('form').submit();">
                                                <i data-feather='trash-2'></i>
                                                <span>Delete</span>
                                            </a>
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
</section>
    
@endsection