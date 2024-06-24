
@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Simulation Requests') }}
@endsection

{{-- Menu Active --}}
@section('simulationIndex')
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
                    <li class="breadcrumb-item">{{ __('Project Simulations Requests') }}</li>
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
                    <h4>{{ __('Project Request Details') }}</h4>

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
                                    <th class="font-weight-bold">{{ __('Author Name') }}</th>
                                    <td>{{$details->user->name}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold" >{{ __('Category') }}</th>
                                    <td>{{$details->category->name}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Subcategory') }}</th>

                                    @if ($details->subcategory_id != null)
                                    <td>{{$details->subcategory->name}}</td>
                                    @else
                                    <td class="text-danger">{{ __('No Subcategory') }}</td>
                                    @endif
                                    
                                    
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Title') }}</th>
                                    <td>{{$details->title}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Quote') }}</th>
                                    <td>{{$details->quote}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Short Description') }}</th>
                                    <td>{{$details->short_description}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Description') }}</th>
                                    <td>{{$details->description}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Thumbnail') }}</th>
                                    <td><img src="{{ asset('uploads/blogs/'.$details->thumbnail) }}" width="150"
                                            alt="Thumbnail"></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Image') }}</th>
                                   
                                    @if ($details->image == 'null')
                                    <td><img src="{{ asset('uploads/blogs/'.$details->image) }}" width="150"
                                        alt="Image"></td>
                                    @else
                                    <td><span class="">{{ __('No Image') }}</span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Payment Status') }}</th>
                                    @if ($details->payment_status == 'pending')
                                    <td class="text-danger">{{ __('Pending') }}</td>
                                    @else
                                    <td class="text-success">{{ __('Paid') }}</td>
                                    @endif
                                </tr>

                                <tr>
                                    <th class="font-weight-bold">{{ __('Post Status') }}</th>
                                    @if ($details->access_status == 'not_published')
                                    <td class="text-danger">{{ __('Not published yet') }}</td>
                                    @else
                                    <td class="text-success">{{ __('Published') }}</td>
                                    @endif
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