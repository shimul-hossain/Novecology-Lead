@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Bienvenue') }}
@endsection

{{-- Menu Active --}}
@section('bienvenueIndex')
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
                    <li class="breadcrumb-item">{{ __('Bienvenue') }}</li>
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
                    <h4>{{ __('Update Bienvenue') }}</h4>

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
                    <form action="{{ route('bienvenue.update',$dienvenue->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="bienvenue">{{ __('Bienvenue') }}</label>
                            <textarea name="bienvenue_text" class="form-control" id="bienvenue"  rows="5">{{ $dienvenue->bienvenue_text }}</textarea>
                            @error('bienvenue')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="bienvenue">{{ __('Bienvenue video') }}</label>
                            <input type="text" name="bienvenue" class="form-control" id="bienvenue" value="{{ $dienvenue->video }}">
                            {{-- <textarea name="bienvenue" class="form-control" id="bienvenue"  rows="5">{{ $dienvenue->video }}</textarea> --}}
                            @error('bienvenue')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label for="video">Bienvenue video</label>
                            <input type="file" name="video" class="form-control" id="video">
                            @error('video')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            {{-- <video width="100%" controls>
                                <source src="{{ asset('uploads/bienvenue') }}/{{ $dienvenue->video }}" type="video/mp4">
                            </video> --}}

                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ bienvenue()->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection