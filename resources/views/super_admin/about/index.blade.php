@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | About Us
@endsection

{{-- Menu Active --}}
@section('aboutIndex')
active
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
                    <li class="breadcrumb-item">Working With Section</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Working With List</h4>
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($abouts as $about)
                            <tr>
                                <td> 
                                    <span>{{ $about->title }}</span> 
                                </td>

                                <td>
                                    <span>{{ $about->details }}</span> 
                                </td>

                                <td>
                                    <img src="{{ asset('uploads/about_us')}}/{{  $about->image  }}" alt="Working Eith Image" width="150">
                                </td>

                                <td>
                                    <a href="{{ route('abouts.edit',$about->id) }}" class="btn btn-info btn-sm" >Edit</a>
                                </td>

                                <td>
                                    <form action="{{ route('abouts.destroy',$about->id) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        
                                        <a href="{{ route('abouts.destroy',$about->id) }}"
                                          onclick="event.preventDefault(); this.closest('form').submit();" 
                                          type="submit" class="btn btn-danger btn-sm">Delete
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