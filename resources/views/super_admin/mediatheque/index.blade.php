@extends('backoffice.app')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Mediatheque
@endsection

{{-- Menu Active --}}
@section('mediathequeIndex')
active
@endsection

@section('css')
<link rel="stylesheet" href="/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

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
                    <li class="breadcrumb-item">Mediatheque</li>
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
                    <h4 class="card-title">Mediatheque List</h4>
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
                        <table class="table table-bordered table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Title') }}</th> 
                                    <th>{{ __('Logo') }}</th> 
                                    <th>{{ __('File') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mediatheques as $item)
                                <tr>
                                    <td> 
                                        <span>{{$loop->index + 1}}</span> 
                                    </td>
                                    <td> 
                                        <span>{{ $item->getCategory->name ?? ''}}</span> 
                                    </td>
    
                                    <td>
                                        <span>{{ $item->title }}</span> 
                                    </td> 
                                    <td>
                                        <img src="{{asset('uploads/mediatheques')}}/{{ $item->logo}}" width="200">
                                    </td> 
                                    <td>
                                        <a href="{{asset('uploads/mediatheques')}}/{{ $item->file_name}}" target="_blank">{{ $item->file_original_name}}</a>
                                    </td> 
    
                                    <td>
                                        <div class="dropdown">
                                            <button type="button"
                                                class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
                                                data-toggle="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-vertical">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.mediatheque.edit',$item->id) }}">
                                                    <i data-feather="eye"></i>
                                                    <span>{{ __('Edit') }}</span>
                                                </a>
    
                                                <form action="{{ route('admin.mediatheque.delete') }}" method="POST"> 
                                                    @csrf  
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <a class="dropdown-item"
                                                        href="#!"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i data-feather='trash-2'></i>
                                                        <span>{{ __('Delete') }}</span>
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