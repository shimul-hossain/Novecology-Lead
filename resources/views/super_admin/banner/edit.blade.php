@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Banner Edit') }}
@endsection

{{-- Menu Active --}}
@section('bannerIndex')
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
                    <li class="breadcrumb-item">{{ __('Banner Update') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Update Banner') }}</h4>

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
                    <form action="{{ route('banner.update',$banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first_line">{{ __('First Line') }}</label>
                            <textarea name="first_line" class="form-control" id="first_line" >{{ $banner->first_line }}</textarea>
                            @error('text')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="second_line">{{ __('Second line') }}</label>
                            <textarea name="second_line" class="form-control" id="second_line" >{{ $banner->second_line }}</textarea>
                            @error('text')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="banner_image">{{ __('Banner Image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="banner_image"  name="banner_image" value="{{ $banner->banner_image }}">
                                <label class="custom-file-label" for="banner_image">{{ __('Choose a banner') }}</label>
                            </div>
                            @error('iamge')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
    
    
                        <div class="from-group">
                            <img src="{{ asset('uploads/banner') }}/{{ $banner->banner_image }}" alt="" style="height:180px;width:300px;">
                        </div>
                        
                        <br>
                        <br>
    
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>

                {{-- <div class="card-body">
                    <form class="form form-horizontal">
                        <div class="row">
                            
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Email</label>
                                    <input type="email" id="email-id-vertical" class="form-control" name="email-id" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Email</label>
                                    <input type="email" id="email-id-vertical" class="form-control" name="email-id" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-id-vertical">Email</label>
                                    <input type="email" id="email-id-vertical" class="form-control" name="email-id" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-sm-9 offset-sm-3">
                                <button type="reset" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                
                            </div>
                        </div>
                    </form>
                </div> --}}
              
            </div>
        </div>
    </div>
</section>
    
@endsection