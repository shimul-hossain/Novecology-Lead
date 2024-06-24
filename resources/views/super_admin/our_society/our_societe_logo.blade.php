@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Solution logos') }}
@endsection

{{-- Menu Active --}}
@section('ourSolutionLogo')
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
                    <li class="breadcrumb-item">{{ __('Our Solution logos') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Update Our Solution logos') }}</h4>

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
                    <form action="{{ route('ourSocieteLogo.update',$logo->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class='form-group'>
                            <label for='image1'>{{ __('Image 1') }}</label>
                            <div class='custom-file'>
                                <input type='file' class='custom-file-input' id='image1' name='image1'>
                                <label class='custom-file-label' for='image1'>{{ __('Select') }}</label>
                            </div>
                            @error('image1')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <img width="100" src="{{ asset('uploads/OurSocieteLogo') }}/{{ $logo->image1 }}" alt="">
                        </div>


                        <div class='form-group'>
                            <label for='image2'>{{ __('Image 2') }}</label>
                            <div class='custom-file'>
                                <input type='file' class='custom-file-input' id='image2' name='image2'>
                                <label class='custom-file-label' for='image2'>{{ __('Select') }}</label>
                            </div>
                            @error('image2')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img width="100" src="{{ asset('uploads/OurSocieteLogo') }}/{{ $logo->image2 }}" alt="">
                        </div>



                        <div class='form-group'>
                            <label for='image3'>{{ __('Image 3') }}</label>
                            <div class='custom-file'>
                                <input type='file' class='custom-file-input' id='image3' name='image3'>
                                <label class='custom-file-label' for='image3'>{{ __('Select') }}</label>
                            </div>
                            @error('image3')
                            <span class='text-danger'>{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img width="100" src="{{ asset('uploads/OurSocieteLogo') }}/{{ $logo->image3 }}" alt="">
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