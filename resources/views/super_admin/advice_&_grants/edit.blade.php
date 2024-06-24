@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Our Solution Edit') }}
@endsection

{{-- Menu Active --}}
@section('adviceIndex')
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
            </a>            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Our Solution Section') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-md-12">
        
            <div class="card">
                
                <div class="card-header">
                    <h4>{{ __('Edit Our Solution Section') }}</h4>
                </div>
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
                <div class="card-body">
                    <form action="{{ route('adviceGrants.update',$advice->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="category_id">{{ __('Category') }}</label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="{{ $advice->category_id }}">{{ $advice->getCategory->category_name }}</option>
                                @foreach ($categories as $category)
                                    @if ( $category->id != $advice->category_id)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$advice->title }}" >
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="details">{{ __('Details') }}</label>
                            <input id="details" type="hidden" name="details" value="{{$advice->details}}">
                            <trix-editor input="details"></trix-editor>
                            @error('details')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="thumbnail">{{ __('Thumbnail') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail"  name="thumbnail">
                                <label class="custom-file-label" for="thumbnail">{{ __('Browse') }}</label>
                            </div>
                            @error('thumbnail')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img width="100%" src="{{ asset('uploads/our_advice')}}/{{$advice->thumbnail}}" alt="Thumbnail">
                        </div>
                        <br>
                        <br>

                        <div class="form-group">
                            <label for="image1">{{ __('First image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image1"  name="image1">
                                <label class="custom-file-label" for="image1">{{ __('Browse') }}</label>
                            </div>
                            @error('image1')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <img width="50%" src="{{ asset('uploads/our_advice')}}/{{$advice->image1}}" alt="Thumbnail">
                        </div>
                        <br>
                        <br>


                        <div class="form-group">
                            <label for="image2">{{ __('Second image') }}</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image2"  name="image2">
                                <label class="custom-file-label" for="image2">{{ __('Browse') }}</label>
                            </div>
                            @error('image2')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <img width="50%" src="{{ asset('uploads/our_advice')}}/{{$advice->image2}}" alt="Thumbnail">
                        </div>
                        <br>
                        <br>

                        <div class="form-group">
                            <label for="image3">{{ __('Third image') }}</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image3"  name="image3">
                                <label class="custom-file-label" for="image3">{{ __('Browse') }}</label>
                            </div>
                            @error('image3')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <img width="50%" src="{{ asset('uploads/our_advice')}}/{{$advice->image3}}" alt="Thumbnail">
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="image4">{{ __('Forth image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image4"  name="image4">
                                <label class="custom-file-label" for="image4">{{ __('Browse') }}</label>
                            </div>
                            @error('image4')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <img width="50%" src="{{ asset('uploads/our_advice')}}/{{$advice->image4}}" alt="Thumbnail">
                        </div>
                        <br>
                        <br>


                        <div class="form-group">
                            <label for="meta_title">{{ __('Meta Title') }}</label>
                            <textarea name="meta_title" class="form-control" id="meta_title" rows="5">{{ $advice->meta_title }}</textarea>

                            @error('meta_title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_author">{{ __('Meta author') }}</label>
                            <textarea name="meta_author" class="form-control" id="meta_author" rows="5">{{ $advice->meta_author }}</textarea>

                            @error('meta_author')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keyword">{{ __('Meta keyword') }}</label>
                            <textarea name="meta_keyword" class="form-control" id="meta_keyword" rows="5">{{ $advice->meta_keyword }}</textarea>

                            @error('meta_keyword')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description">{{ __('Meta description') }}</label>
                            <textarea name="meta_description" class="form-control" id="meta_description" rows="5">{{ $advice->meta_description }}</textarea>

                            @error('meta_description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="og_type">{{ __('OG type') }}</label>
                            <textarea name="og_type" class="form-control" id="og_type" rows="5">{{ $advice->og_type }}</textarea>

                            @error('og_type')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="og_title">{{ __('OG title') }}</label>
                            <textarea name="og_title" class="form-control" id="og_title" rows="5">{{ $advice->og_title }}</textarea>

                            @error('og_title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="og_description">{{ __('OG description') }}</label>
                            <textarea name="og_description" class="form-control" id="og_description" rows="5">{{ $advice->og_description }}</textarea>

                            @error('og_description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="og_image">{{ __('OG image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="og_image" name="og_image">
                                <label class="custom-file-label" for="og_image">{{ __('Browse') }}</label>
                            </div>
                            @error('og_image')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        @if ($advice->og_image != null)
                            <div class="form-group">
                                <img src="{{ asset('uploads/our_advice')}}/{{$advice->og_image}}" alt="OG Image" width="20%">
                            </div>
                            <br>
                            <br>
                        @endif

                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection