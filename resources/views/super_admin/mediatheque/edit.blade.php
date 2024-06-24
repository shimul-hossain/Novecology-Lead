@extends('backoffice.app')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Mediatheque Edit
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
                    <li class="breadcrumb-item">Mediatheque Update</li>
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
                    <h4>Update Mediatheque</h4>

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
                    <form action="{{ route('admin.mediatheque.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label for="category_id">{{ __('Category') }} *</label> 
                            <input type="hidden" name="id" value="{{ $mediatheque->id }}">
                            <select name="category" id="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option {{ $category->id == $mediatheque->category_id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label for="title">{{ __('Title') }} *</label>
                            <input type="text" name="title" value="{{ $mediatheque->title }}" class="form-control" id="title">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label for="logo">{{ __('Logo') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo"  name="logo">
                                <label class="custom-file-label" for="file">{{ __('Choose a banner') }}</label>
                            </div>
                            @error('logo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="from-group">
                            <label for="file">Existing Logo: </label> 
                            <img src="{{asset('uploads/mediatheques')}}/{{ $mediatheque->logo}}" width="300">
                        </div>

                        <div class="form-group">
                            <label for="file">{{ __('File') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file"  name="file">
                                <label class="custom-file-label" for="file">{{ __('Choose a banner') }}</label>
                            </div>
                            @error('file')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
    
    
                        <div class="from-group">
                            <label for="file">Existing file: </label> 
                            <a href="{{asset('uploads/mediatheques')}}/{{ $mediatheque->file_name}}" target="_blank">{{ $mediatheque->file_original_name}}</a>
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