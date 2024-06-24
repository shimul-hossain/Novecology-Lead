@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('About Section Edit') }}
@endsection

{{-- Menu Active --}}
@section('logoIndex')
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
                    <li class="breadcrumb-item">{{ __('Logo') }}</li>
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
                    <h4>{{ __('update Logo') }}</h4>
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
                    <form action="{{ route('logos.update',$logos->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="image">{{ __('White Logo') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image"  name="image">
                                <label class="custom-file-label" for="image">{{ __('Logo') }}</label>
                            </div>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('uploads/logo')}}/{{$logos->image}}" class="img-fluid" alt="">
                        </div>

                        <div class="form-group">
                            <label for="image2">{{ __('Color Logo') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image2"  name="image2">
                                <label class="custom-file-label" for="image2">{{ __('Logo') }}</label>
                            </div>
                            @error('image2')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('uploads/logo')}}/{{$logos->image2}}" class="img-fluid" alt="">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection