@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Clint Opinion') }}
@endsection

{{-- Menu Active --}}
@section('clintOpinionsCreate')
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
                    <li class="breadcrumb-item">{{ __('Clint Opinion') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-6">
        
            <div class="card">
                
                <div class="card-header">
                    <h4>{{ __('Create Clint Opinion Section') }}</h4>
                </div>
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
                <div class="card-body">
                    <form action="{{ route('clintOpinions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" id="name"  >
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="opinion">{{ __('Description') }}</label>
                            <textarea name="opinion" class="form-control" id="opinion" ></textarea>
                            @error('opinion')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection