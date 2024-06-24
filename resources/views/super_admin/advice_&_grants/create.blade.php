@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Advice') }}
@endsection

{{-- Menu Active --}}
@section('adviceCreate')
active
@endsection

@section('css')
<style>
    .trix-button-group.trix-button-group--file-tools {
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
                    <li class="breadcrumb-item">{{ __('Advice And Grant Section') }}</li>
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
                    <h4>{{ __('Advice And Grant Section') }}</h4>

                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#categoty">+ {{ __('Add category') }}</button>
                        <a href="{{ route('categoriesAdvices.index')}}" class="btn btn-sm btn-primary">{{ __('View All Category') }}</a>
                    </div>
                    <form action="{{ route('adviceGrants.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="category_id">{{ __('Category') }}</label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="">--{{ __('Select') }}--</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="details">{{ __('Details') }}</label>
                            <input id="details" type="hidden" name="details" value="{{ old('details') }}">
                            <trix-editor input="details"></trix-editor>
                            @error('details')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="thumbnail">{{ __('Thumbnail') }}</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                <label class="custom-file-label" for="thumbnail">{{ __('Browse') }}</label>
                            </div>
                            @error('thumbnail')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image1">{{ __('First image') }}</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image1" name="image1">
                                <label class="custom-file-label" for="image1">{{ __('Browse') }}</label>
                            </div>
                            @error('image1')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image2">{{ __('Second image') }}</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image2" name="image2">
                                <label class="custom-file-label" for="image2">{{ __('Browse') }}</label>
                            </div>
                            @error('image2')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image3">{{ __('Third image') }}</label>

                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image3" name="image3">
                                <label class="custom-file-label" for="image3">{{ __('Browse') }}</label>
                            </div>
                            @error('image3')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image4">{{ __('Forth image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image4" name="image4">
                                <label class="custom-file-label" for="image4">{{ __('Browse') }}</label>
                            </div>
                            @error('image4')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_title">{{ __('Meta Title') }}</label>
                            <textarea name="meta_title" class="form-control" id="meta_title" rows="5">{{ old('meta_title') }}</textarea>

                            @error('meta_title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_author">{{ __('Meta author') }}</label>
                            <textarea name="meta_author" class="form-control" id="meta_author" rows="5">{{ old('meta_author') }}</textarea>

                            @error('meta_author')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keyword">{{ __('Meta keyword') }}</label>
                            <textarea name="meta_keyword" class="form-control" id="meta_keyword" rows="5">{{ old('meta_keyword') }}</textarea>

                            @error('meta_keyword')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description">{{ __('Meta description') }}</label>
                            <textarea name="meta_description" class="form-control" id="meta_description" rows="5">{{ old('meta_description') }}</textarea>

                            @error('meta_description')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="og_type">{{ __('OG type') }}</label>
                            <textarea name="og_type" class="form-control" id="og_type" rows="5">{{ old('og_type') }}</textarea>

                            @error('og_type')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="og_title">{{ __('OG title') }}</label>
                            <textarea name="og_title" class="form-control" id="og_title" rows="5">{{ old('og_title') }}</textarea>

                            @error('og_title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="og_description">{{ __('OG description') }}</label>
                            <textarea name="og_description" class="form-control" id="og_description" rows="5">{{ old('og_description') }}</textarea>

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
                        
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- Category Modal --}}
<div class="modal fade" id="categoty" tabindex="-1" role="dialog" aria-labelledby="categotyTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Modal title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categoriesAdvices.store') }}" method="POST"5>
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="category_name">{{ __('Category Name') }}</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" value="{{ old('category_name') }}" required>
                        @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
   
    // $(document).ready(function() {
    //     @if(count($errors) > 0)
    //         $("#categoty").modal('show');
    //     @endif
    // });
  
</script>
@endsection