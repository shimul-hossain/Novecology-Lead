@extends('backoffice.app')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Mediatheque Category Edit
@endsection

{{-- Menu Active --}}
@section('mediathequeCategoryIndex')
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
                    <li class="breadcrumb-item">Mediatheque Category Update</li>
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
                    <h4>Update Mediatheque Category</h4>

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
                    <form action="{{ route('admin.mediatheque.category.update') }}" method="POST">
                        @csrf 
                        <div class="form-group">
                            <input type="hidden" name="id" value="{{ $category->id }}">
                            <label for="name">{{ __('Name') }} *</label>
                            <input type="text" name="name" id="name"  class="form-control" value="{{ $category->name }}">
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <br>
                        <br>
    
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</section>
    
@endsection