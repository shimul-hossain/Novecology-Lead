@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Menue Contact Us Section') }}
@endsection

{{-- Menu Active --}}
@section('contactUsIndex')
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
                    <li class="breadcrumb-item">{{ __('Menue Contact Us Section') }}</li>
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
                    <h4>{{ __('Menue Contact Us Section') }}</h4>

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
                    <form action="{{ route('menueContactus.update',$contactUs->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input name="title" class="form-control" id="title" type="text" value="{{ $contactUs->title}}">
                            @error('bienvenue')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subtitle">{{ __('Subtitle') }}</label>
                            <input type="text" name="subtitle" class="form-control" id="subtitle" value="{{ $contactUs->subtitle}}">
                            @error('subtitle')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="details">{{ __('Details') }}</label>
                            <input name="details" value="{{ $contactUs->details}}" id="details"
                                type="hidden">
                            <trix-editor input="details" placeholder="Description"></trix-editor>
                            @error('details')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div>
                            <img src="{{ asset('uploads/menu_contactUs') }}/{{ $contactUs->image}}" alt="No Image">
                        </div>
                        <br>
                        <br> --}}
                     
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection