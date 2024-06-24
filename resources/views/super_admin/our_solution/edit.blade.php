@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Edit Our Solution Section') }}
@endsection

{{-- Menu Active --}}
@section('ourSolutionIndex')
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
                    <li class="breadcrumb-item">{{ __('Our Solution') }}</li>
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
                    <h4>{{ __('Eit Our Solution') }}</h4>
                </div>
               
                <div class="card-body">
                    <form action="{{ route('ourSolutions.update',$ourSolution->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ $ourSolution->title }}" >
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subtitle">{{ __('Subtitle') }}</label>
                            <textarea name="subtitle" class="form-control" id="subtitle" rows="5">{{ $ourSolution->subtitle }}</textarea>
                            @error('subtitle')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="short_details">{{ __('Short Details (Optional)') }}</label>
                            <textarea name="short_details" class="form-control" id="short_details" rows="5">{{ $ourSolution->short_details}}</textarea>
                            @error('short_details')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">{{ __('Category') }}</label>

                            <select name="category" class="form-control" id="category">
                                <option value="{{ $ourSolution->category }}">{{ $ourSolution->category }}</option>
                                @if ($ourSolution->category == 'Professional')
                                <option value="Particular">{{ __('Particular') }}</option>
                                @endif
                                @if ($ourSolution->category == 'Particular')
                                <option value="Professional">{{ __('Professional') }}</option>
                                @endif

                            </select>
                            @error('category')
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
                            <img src="{{ asset('uploads/our_solution')}}/{{$ourSolution->image}}" class="img-fluid" alt="">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection