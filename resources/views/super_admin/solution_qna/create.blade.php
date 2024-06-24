@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} |Our Solution Create
@endsection

{{-- Menu Active --}}
@section('oursolutionCreate')
active
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
                    <li class="breadcrumb-item">Our Solution Section</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-6">
        
            <div class="card">
                
                <div class="card-header">
                    <h4>Create Our Solution Section</h4>
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
                    <form action="{{ route('solutionDetails.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="solution_title">Our Solution Title</label>
                            <select class="form-control" name="our_solutions_id" id="solution_title">
                                <option selected>---Select A a Solution---</option>
                                @foreach ($solutions as $solution)
                                <option value="{{$solution->id}}">{{$solution->title}}</option>
                                @endforeach
                            </select>
                            @error('our_solutions_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="first_qsn">First Question</label>
                            <input type="text" name="first_qsn" class="form-control" id="first_qsn" >
                            @error('first_qsn')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="first_ans">First Answer</label>
                            <input id="first_ans" type="hidden"  name="first_ans">
                            <trix-editor input="first_ans"></trix-editor>
                            @error('first_ans')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="second_qsn">Second Question</label>
                            <input type="text" name="second_qsn" class="form-control" id="second_qsn"  >
                            @error('second_qsn')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="second_ans">Second Answer</label>
                            <input id="second_ans" type="hidden"  name="second_ans">
                            <trix-editor input="second_ans"></trix-editor>
                            @error('second_ans')
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