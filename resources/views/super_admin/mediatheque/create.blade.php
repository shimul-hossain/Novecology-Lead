@extends('backoffice.app')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Mediatheque Create
@endsection

{{-- Menu Active --}}
@section('mediathequeCreate')
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
                    <li class="breadcrumb-item">Mediatheque Create</li>
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
                    <h4>Create Mediatheque</h4>

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
                    <form action="{{ route('admin.mediatheque.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label for="category_id">{{ __('Category') }} *</label> 
                            <select name="category" id="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option {{ old('category_id') == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label for="title">{{ __('Title') }} *</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 

                        <div class="form-group">
                            <label for="logo">{{ __('Logo') }} *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo"  name="logo">
                                <label class="custom-file-label" for="file">{{ __('Choose a banner') }}</label>
                            </div>
                            @error('logo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="file">{{ __('File') }} *</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file"  name="file">
                                <label class="custom-file-label" for="file">{{ __('Choose a banner') }}</label>
                            </div>
                            @error('file')
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