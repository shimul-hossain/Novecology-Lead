@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Our Solution') }}
@endsection

@section('css')
<style>
    .trix-button-group.trix-button-group--file-tools{
        display: none;
    }
</style>
@endsection

{{-- Menu Active --}}
@section('pageIndex')
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
                    <li class="breadcrumb-item">{{ __('Edit Pages') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <h4>{{ __('Edit Pages Details') }}</h4>
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
                    <form action="{{ route('pages.update',$page->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}<span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$page->title}}">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        
                        {{-- <div class="form-group">
                            <label for="subtitle">Subtitle <small>(Optional)</small></label>
                            <input type="text" name="subtitle" class="form-control" id="subtitle"
                                value="{{$page->subtitle}}">
                            @error('subtitle')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> --}}


                        {{-- <div class="form-group">
                            <label for="thumbnail">Banner or Thumnail Image<span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                <label class="custom-file-label" for="thumbnail">Image</label>
                            </div>
                            @error('thumbnail')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> --}}

                        {{-- <div  class="form-group">
                            <img width="200"  src="{{ asset('uploads/extra_page') }}/{{$page->thumbnail}}" alt="">
                        </div> --}}

                        {{-- <div class="form-group">
                            <label for="short_description">Quote or Short Description <small>(Optional)</small></label>
                            <textarea name="short_description" class="form-control" id="short_description"
                                rows="3">{!! $page->short_description !!}</textarea>
                            @error('short_description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> --}}


                        <div class="form-group">
                            <label for="long_description">{{ __('Description') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input name="long_description" id="long_description" type="hidden"  value="{{ $page->long_description }}">
                            <trix-editor input="long_description"></trix-editor>
                            @error('long_description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        {{-- <div class="form-group">
                            <label for="list">Points or list<small>(Optional)</small></label>
                            <input name="list" value="{!! $page->list !!}" id="list"
                                type="hidden">
                            <trix-editor input="list" placeholder="Points or list"></trix-editor>
                            @error('list')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="image">Image<small>(Optional)</small></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="banner_image">Image</label>
                            </div>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div  class="form-group">
                            <img width="200" src="{{ asset('uploads/extra_page') }}/{{$page->image}}" alt="">
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