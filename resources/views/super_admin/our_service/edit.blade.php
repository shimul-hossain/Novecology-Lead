@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Edit Our Service Section') }}
@endsection

{{-- Menu Active --}}
@section('serviceCreate')
active
@endsection

@section('css')
<style>
    .trix-button-group.trix-button-group--file-tools{
        display: none;
    }
</style>
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
                    <li class="breadcrumb-item">{{ __('Our Service') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-8">
        
            <div class="card">
                
                <div class="card-header">
                    <h4>{{ __('Eit Our Service') }}</h4>
                </div>
               
                <div class="card-body">
                    <form action="{{ route('ourService.update',$ourService->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $ourService->title }}" >
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="text">{{ __('Description') }}</label>
                            <input id="details" type="hidden"  name="details" value="{{$ourService->details}}">
                            <trix-editor input="details"></trix-editor>
                            @error('details')
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
                            <img src="{{ asset('uploads/our_service')}}/{{$ourService->image}}" class="img-fluid" alt="">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection