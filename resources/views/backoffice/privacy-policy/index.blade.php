@extends('backoffice.app')

@section('privacyPolicy', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | POLITIQUE DE CONFIDENTIALITÉ
@endsection

 

@section('css') 

@endsection
@push('plugin-css')
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dashboard_assets/css/plugins/forms/form-quill-editor.css') }}">
@endpush

@push('plugin-js')
<script src="{{ asset('dashboard_assets/vendors/js/editors/quill/quill.min.js') }}"></script> 
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
                    <li class="breadcrumb-item">POLITIQUE DE CONFIDENTIALITÉ</li>
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
                        <h4 class="card-title">POLITIQUE DE CONFIDENTIALITÉ</h4>
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
                        <form action="{{ route('privacy.policy.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <div class="form-group">
                                <label for="title">Titre *</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}" >
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="description">Description *</label>
                                <div class="custom-editor-wrapper">
                                    <div class="custom-editor">
                                        {!! $item->description !!}
                                    </div>
                                    <input type="hidden" class="custom-editor-input" name="description" value="{{ $item->description }}">
                                </div>
                                @error('description')
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

 