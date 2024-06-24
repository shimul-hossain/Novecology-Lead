@extends('backoffice.app')

@section('testimonialIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Témoignage
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
                    <li class="breadcrumb-item">Témoignage</li>
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
                        <h4 class="card-title">Modifier témoignage</h4>
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
                        <form action="{{ route('backoffice.testimonial.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Titre *</label>
                                <input type="hidden" name="id" value="{{ $testimonial->id }}">
                                <input type="text" name="title" id="title" class="form-control" value="{{ $testimonial->title }}">
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            @if ($testimonial->embed_id)
                            <div class="form-group">
                                <label for="embed_id">Vidéo existante</label>
                                <br>
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $testimonial->embed_id }}?autoplay=1&enablejsapi=1&controls=1&autopause=0&muted=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen frameborder="0" loading="lazy"></iframe>
                            </div> 
                            @endif
                            <div class="form-group">
                                <label for="embed_id">Youtube video embed id *</label>
                                <input type="text" name="embed_id" id="embed_id" class="form-control" value="{{ $testimonial->embed_id }}">
                                @error('embed_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="description">description *</label>
                                <textarea  name="description" id="description" class="form-control">{{ $testimonial->description }}</textarea>
                                @error('description')
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
    <script>
        $(document).ready(function(){
        });
    </script>
@endsection