@extends('backoffice.app')

@section('newsInfo', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Info
@endsection

 

@section('css') 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <li class="breadcrumb-item">Info</li>
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
                        <h4 class="card-title">Modifier Info </h4>
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
                        <form action="{{ route('backoffice.news.info.update') }}" method="POST">
                            @csrf 
                            <div class="form-group">
                                <label for="home_page_title">Titre de la page d'accueil *</label>
                                <input type="text" name="home_page_title" id="home_page_title" class="form-control" value="{{ $info->home_page_title }}">
                                @error('home_page_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="home_page_subtitle">Sous-titre de la page d'accueil *</label>
                                <textarea  name="home_page_subtitle" id="home_page_subtitle" class="form-control">{{ $info->home_page_subtitle }}</textarea>
                                @error('home_page_subtitle')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="main_page_title">Titre de la page principale *</label>
                                <input type="text" name="main_page_title" id="main_page_title" class="form-control" value="{{ $info->main_page_title }}">
                                @error('main_page_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="main_page_subtitle">Sous-titre de la page principale *</label>
                                <textarea  name="main_page_subtitle" id="main_page_subtitle" class="form-control">{{ $info->main_page_subtitle }}</textarea>
                                @error('main_page_subtitle')
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