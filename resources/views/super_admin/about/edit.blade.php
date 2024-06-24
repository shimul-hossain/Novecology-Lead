@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('About Section Edit') }}
@endsection

{{-- Menu Active --}}
@section('aboutCreate')
active
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('superadmin.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('About Section') }}</li>
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
                    <h4>{{ __('Eit About Section') }}</h4>
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
                    <form action="{{ route('abouts.update',$about->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $about->title }}" >
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">{{ __('Description') }}</label>
                            <textarea name="details" class="form-control" id="text" >{{$about->details}}</textarea>
                            @error('text')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">{{ __('Image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image"  name="image">
                                <label class="custom-file-label" for="banner_image">{{ __('Image') }}</label>
                            </div>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img src="{{ asset('uploads/about_us')}}/{{$about->image}}" class="img-fluid" alt="">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection