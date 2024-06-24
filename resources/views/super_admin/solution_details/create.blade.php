@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Our Solution Details
@endsection

{{-- Menu Active --}}
@section('solutionDetailsCreate')
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
                <h2 class="content-header-title float-left mb-0">Super Admin Dashboard</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Our Solution Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-10">
        
            <div class="card">
                
                <div class="card-header">
                    <h4>Create Our Solution Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('solutionDetails.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
 
                        <div class="fprm-group">
                            <select name="solution_id" class="form-control">
                                <option>--Select--</option>
                                @foreach ($solutions as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
 

                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" name="question" class="form-control" id="question" value="{{ old('question') }}">
                            @error('question')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <input id="answer" type="hidden"  name="answer" value="{{ old('answer') }}">
                            <trix-editor input="answer"></trix-editor>
                            @error('answer')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection