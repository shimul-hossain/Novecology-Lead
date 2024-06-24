@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Our Solution') }}
@endsection

{{-- Menu Active --}}
@section('ourSolutionCreate')
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
                    <h4>{{ __('Create Our Solution') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('ourSolutions.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">{{ __('Title') }}</label>
                            <input type="text" name="title" class="form-control" id="title">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subtitle">{{ __('Subtitle') }}</label>
                            <textarea name="subtitle" class="form-control" id="subtitle" rows="5"></textarea>
                            @error('subtitle')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category">{{ __('Category') }}</label>
                            <select name="category" class="form-control" id="category">
                                <option value="">-------{{ __('select') }}--------</option>
                                <option value="Particular">{{ __('Particular') }}</option>
                                <option value="Professional">{{ __('Professional') }}</option>
                            </select>
                            @error('category')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="short_details">{{ __('Short Details (Optional)') }}</label>
                            <textarea name="short_details" class="form-control" id="short_details" rows="5"></textarea>
                            @error('short_details')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">{{ __('Image') }}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="banner_image">{{ __('Image') }}</label>
                            </div>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        {{-- <small>--------------Our Solution Details-------------------</small>


                        <div id="details1" class="mt-2">
                            <div class='form-group'>
                                <label for='question'>Question</label>
                                <input type='text' name='question[]' class='form-control' id='question'>
                                @error('question')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>


                            <div class='form-group'>
                                <label for='answer'>Answer</label>
                                <textarea class='form-control' name='answer[]'></textarea>
                                @error('answer')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>

                            <span class="removeDetails btn btn-danger btn-sm mt-2 d-none">Remove</span>
                        </div>

                        <div id="detailsadbtn" class="form-group">

                        </div> --}}




                        {{-- <small>--------------Our Solution Reasons-------------------</small>

                        <div id="reason1" class="mt-2">
                            <div class='form-group'>
                                <label for='title'>Reasons Title</label>
                                <input type='text' name='reason_title[]' class='form-control' id='title'>
                                @error('title')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>


                            <div class='form-group'>
                                <label for='details'>Reasons Details</label>
                                <textarea name='reason_details[]' id='details' class='form-control'></textarea>
                                @error('details')<span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>

                            <div class='form-group'>
                                <label for='image'>Image</label>
                                <div class='custom-file'>
                                    <input type='file' class='custom-file-input' id='image' name='reason_image[]'>
                                    <label class='custom-file-label' for='banner_image'>Image</label>
                                </div>
                                @error('image')
                                <span class='text-danger'>{{$message}}</span>
                                @enderror
                            </div>
                            <span class="remove btn btn-danger btn-sm mt-2 d-none">Remove</span>
                        </div>

                        <div id="adbtn" class="form-group">

                        </div> --}}


                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')


{{-- <script>
    $(document).ready(function () {

        var adbtn = "<span id='addReasons' class='btn btn-info btn-sm mt-2'>+Add More</span>"
        $('#adbtn').append(adbtn);

        $('#addReasons').click(function () {
            var reason1 = $('#reason1').clone();
            reason1.find('#addReasons').remove();
            reason1.find('#add').remove();
            reason1.find('#reason1').attr('id', 'reason' + (parseInt(Math.random() * 100)));
            $('#adbtn').append(reason1);
            reason1.find('.remove').removeClass('d-none');

        });

        $('#add').click(function () {
            var details = $('#details').clone();
            details.find('#add').remove();
            details.find('#details').attr('id', 'detail' + (parseInt(Math.random() * 100)));
            $('#adbtn').append(details);
        });

        $(document).on('click', '.remove', function () {
            $(this).closest('div').remove();
        });



    });
</script>



<script>
    $(document).ready(function () {

        var detailsadbtn = "<span id='addDetails' class='btn btn-info btn-sm mt-2'>+Add More</span>"
        $('#detailsadbtn').append(detailsadbtn);

        $('#addDetails').click(function () {
            var details1 = $('#details1').clone();
            details1.find('#addDetails').remove();
            details1.find('#add').remove();
            details1.find('#details1').attr('id', 'question' + (parseInt(Math.random() * 100)));
            $('#detailsadbtn').append(details1);
            details1.find('.removeDetails').removeClass('d-none');

        });

        $('#add').click(function () {
            var details = $('#details').clone();
            details.find('#add').remove();
            details.find('#details').attr('id', 'answer' + (parseInt(Math.random() * 100)));
            $('#detailsadbtn').append(details);
        });

        $(document).on('click', '.removeDetails', function () {
            $(this).closest('div').remove();
        });
    });
</script> --}}






@endsection