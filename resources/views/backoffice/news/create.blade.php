@extends('backoffice.app')

@section('newsCreate', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Conseils
@endsection


@push('plugin-css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/plugins/forms/form-quill-editor.css') }}">
@endpush

@push('plugin-js')
<script src="{{ asset('dashboard_assets/vendors/js/editors/quill/quill.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script> --}}
@endpush

@section('js')
    <script>
        $(document).ready(function () {
            $(".custom-editor-wrapper").each(function (index, element) {
                let quillEditor = new Quill(element.children[0], {
                    modules: {
                        // imageResize: {
                        //     displaySize: true
                        // },
                        toolbar: [
                            [{ header: [1, 2, 3, 4, 5, 6, false] }],
                            ["bold", "italic", "underline", "strike"],
                            ["blockquote", "code-block"],
                            // ["image", "video"],
                            ["link"],
                            [{ script: "sub" }, { script: "super" }],
                            [{ list: "ordered" }, { list: "bullet" }],
                            [{ color: [] }, { background: [] }],
                            [{ align: [] }],
                            ["clean"]
                        ]
                    },
                    theme: "snow"
                });
                quillEditor.on("text-change", function (delta, source) {
                    $(element).find(".custom-editor-input").val(quillEditor.root.innerHTML);
                });
            });
        });
    </script>
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
                    <li class="breadcrumb-item">Conseils</li>
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
                        <h4 class="card-title">Création de conseils</h4>
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
                        <form action="{{ route('backoffice.news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Catégorie *</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" selected>Sélectionnez</option>
                                    @foreach ($categories as $category)
                                        <option {{ old('category_id') == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Titre *</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description *</label>
                                <div class="custom-editor-wrapper">
                                    <div class="custom-editor">
                                        {!! old('description') !!}
                                    </div>
                                    <input type="hidden" class="custom-editor-input" name="description" value="{{ old('description') }}">
                                </div>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="feature_image">Image vedette *</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="feature_image" accept="image/*" name="feature_image">
                                    <label class="custom-file-label" for="feature_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('feature_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="thumbnail_image">Image miniature *</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="thumbnail_image" name="thumbnail_image" accept="image/*">
                                    <label class="custom-file-label" for="thumbnail_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('thumbnail_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="banner_image">{{ __('Banner Image') }} *</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="banner_image" accept="image/*" name="banner_image">
                                    <label class="custom-file-label" for="banner_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('banner_image')
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
