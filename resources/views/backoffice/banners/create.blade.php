@extends('backoffice.app')

@section('bannerCreate', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Bannière
@endsection

 

@section('css') 

@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('backoffice.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Bannière</li>
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
                        <h4 class="card-title">Création de bannière</h4>
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
                        <form action="{{ route('backoffice.banner.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="form-group">
                                <label for="title">Titre *</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="button_text">Texte du bouton *</label>
                                <input type="text" name="button_text" id="button_text" class="form-control" value="{{ old('button_text') ?? 'En savoir plus' }}">
                                @error('button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="button_link">Lien du bouton</label>
                                <input type="text" name="button_link" id="button_link" class="form-control" value="{{ old('button_link') ?? '#!' }}">
                                @error('button_link')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="order">Order</label>
                                <input type="number" name="order" id="order" class="form-control" value="{{ old('order') }}">
                                @error('order')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
            
    
                            <div class="form-group">
                                <label for="image">{{ __('Banner Image') }} * <small>(Ratio attendu: <strong>5:2</strong>)</small></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image"  name="image">
                                    <label class="custom-file-label" for="image">{{ __('Choose a banner') }}</label>
                                </div>
                                @error('image')
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

@section('js')

@endsection