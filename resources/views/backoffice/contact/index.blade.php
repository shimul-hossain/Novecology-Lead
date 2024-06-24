@extends('backoffice.app')

@section('contactIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Nous Contacter
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
                    <li class="breadcrumb-item">Nous Contacter</li>
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
                        <h4 class="card-title">Nous Contacter</h4>
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
                        <form action="{{ route('backoffice.contact.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <div class="form-group">
                                <label for="title">Titre *</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}" >
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Sous-titre *</label>
                                <textarea  name="subtitle" id="subtitle" class="form-control" >{{ $item->subtitle }}</textarea>
                                @error('subtitle')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description *</label>
                                <textarea  name="description" id="description" class="form-control" >{{ $item->description }}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            {{-- <div class="form-group">
                                <label for="button_text">Texte du bouton *</label>
                                <input type="text" name="button_text" id="button_text" class="form-control" value="{{ $item->button_text }}" >
                                @error('button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="button_link">Lien du bouton </label>
                                <input type="text" name="button_link" id="button_link" class="form-control" value="{{ $item->button_link }}" >
                                @error('button_link')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>  --}}

                            @if ($item->image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/contact')}}/{{ $item->image }}" alt="contact image">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" accept="image/*" name="image">
                                    <label class="custom-file-label" for="image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>   
                              
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
    <script>
        $(document).ready(function(){ 
        });
    </script>
@endsection