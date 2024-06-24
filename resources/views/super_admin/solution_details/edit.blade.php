@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Edit Our Solution Details
@endsection

{{-- Menu Active --}}
@section('ourSolutionIndex')
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
                <h2 class="content-header-title float-left mb-0">Super Admin Dashboard</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Solution Details</li>
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
                    <h4 class="card-title">Solution Name : <b>{{  $solution->title }}</b></h4>
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
                    <div class="table-responsive">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reasonAdd">+ Add
                            Reason</button>
                        <table class="table table-bordered table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($details as $detail)
                                <tr>
                                    <td>
                                        <span>{{$loop->index + 1}}</span>
                                    </td>
                                    <td>
                                        <span>{{$detail->question}}</span>
                                    </td>

                                    <td>
                                        <span>{!! $detail->answer !!}</span>
                                    </td>


                                    <td>
                                        <div class="dropdown">
                                            <button type="button"
                                                class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
                                                data-toggle="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-vertical">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" data-toggle="modal"
                                                    data-target="#reasonEdit{{ $detail->id }}">
                                                    <i data-feather="edit-2"></i>
                                                    <span>Edit</span>
                                                </a>

                                                <form action="{{ route('solutionDetails.destroy',$detail->id) }}"
                                                    method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf

                                                    <a class="dropdown-item"
                                                        href="{{ route('solutionDetails.destroy',$detail->id) }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i data-feather='trash-2'></i>
                                                        <span>Delete</span>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!--Reason Add Modal -->
<div class="modal fade" id="reasonAdd" tabindex="-1" role="dialog" aria-labelledby="reasonAddTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('solutionDetails.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input name="solution_id" type="text" hidden value="{{ $solution->id }}">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" class="form-control" class="form-control" id="question"
                            value="{{ old('question') }}">
                        @error('question')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        {{-- <input  value="{{ old('answer') }}"> --}}
                        <input type="hidden" id="answer" class="form-control" name="answer">
                        <trix-editor input="answer"></trix-editor>
                        @error('answer')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


@foreach ($details as $detail)
<div class="modal fade" id="reasonEdit{{ $detail->id }}" tabindex="-1" role="dialog" aria-labelledby="reasonAddTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('solutionDetails.update',$detail->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input name="solution_id" type="text" hidden value="{{ $solution->id }}">

                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" class="form-control" class="form-control" id="question"
                            value="{{ $detail->question }}">
                        @error('question')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        {{-- <input  value="{{ old('answer') }}"> --}}
                        <input type="hidden" id="answer{{ $detail->id }}" class="form-control" name="answer"
                            value="{{ $detail->answer }}">
                        <trix-editor input="answer{{ $detail->id }}"></trix-editor>

                        {{-- <textarea id="answer" class="form-control" name="answer">{{ $detail->answer }}</textarea> --}}
                        @error('answer')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- <label for="course_overview">Course Overview</label>
                    <input name="course_overview" value="{{ $course->course_overview }}" id="course_overview"
                        type="hidden">
                    <trix-editor input="course_overview" placeholder="Write course overview"></trix-editor>
                    @error('course_overview')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror --}}

            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection