@extends('backoffice.app')

@section('settingIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Paramètres généraux
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
                    <li class="breadcrumb-item">Paramètres généraux</li>
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
                        <h4 class="card-title">Paramètres généraux</h4>
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
                        <form action="{{ route('backoffice.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf   
                            <div class="form-group">
                                <label for="phone">Téléphone *</label>
                                <input type="text" name="phone" id="phone" value="{{ $setting->phone }}" class="form-control">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            @if ($setting->logo)
                                <div class="form-group">
                                    <label for="logo">Logo existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/setting')}}/{{ $setting->logo }}" alt="setting image">
                                </div>
                            @endif 
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="logo" accept="image/*" name="logo">
                                    <label class="custom-file-label" for="logo">{{ __('Choose a image') }}</label>
                                </div>
                                @error('logo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>  
                            @if ($setting->favicon)
                                <div class="form-group">
                                    <label for="favicon">Favicon existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/setting')}}/{{ $setting->favicon }}" alt="setting image">
                                </div>
                            @endif 
                            <div class="form-group">
                                <label for="favicon">favicon</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="favicon" accept="image/*" name="favicon">
                                    <label class="custom-file-label" for="favicon">{{ __('Choose a image') }}</label>
                                </div>
                                @error('favicon')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>  
                            @if ($setting->dashboard_logo)
                                <div class="form-group">
                                    <label for="icon">Dashboard logo existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/setting')}}/{{ $setting->dashboard_logo }}" alt="setting image">
                                </div>
                            @endif 
                            <div class="form-group">
                                <label for="dashboard_logo">Dashboard logo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="dashboard_logo" accept="image/*" name="dashboard_logo">
                                    <label class="custom-file-label" for="dashboard_logo">{{ __('Choose a image') }}</label>
                                </div>
                                @error('dashboard_logo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>  
                            <div class="form-group">
                                <label for="footer_description">Footer description *</label>
                                <textarea  name="footer_description" id="footer_description" class="form-control" >{{ $setting->footer_description }}</textarea>
                                @error('footer_description')
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