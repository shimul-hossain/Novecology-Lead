@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Working With') }}
@endsection

{{-- Menu Active --}}
@section('workingwithIndex')
active
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('superadmin.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Working With Section') }}</li>
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
                    <h4 class="card-title">{{ __('Workting With List') }}</h4>
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
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Edit') }}</th>
                                    <th>{{ __('Delete') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($works as $work)
                                <tr>
                                    <td> 
                                        <span>{{ $loop->index + 1 }}</span> 
                                    </td>
                                    <td> 
                                        <span>{{ $work->title }}</span> 
                                    </td>
    
                                    <td>
                                        <span>{{ $work->details }}</span> 
                                    </td>
    
                                    <td>
                                        <img src="{{ asset('uploads/workwith')}}/{{  $work->image  }}" alt="Working Eith Image" width="60">
                                    </td>
    
                                    <td>
                                        <a href="{{ route('workingwith.edit',$work->id) }}" class="btn btn-info btn-sm" >{{ __('Edit') }}</a>
                                    </td>
    
                                    <td>
                                        <form action="{{ route('workingwith.destroy',$work->id) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            
                                            <a href="{{ route('workingwith.destroy',$work->id) }}"
                                              onclick="event.preventDefault(); this.closest('form').submit();" 
                                              type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}
                                            </a>
                                        </form>
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