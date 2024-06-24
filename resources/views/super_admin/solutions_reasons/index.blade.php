@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Our Solution Reasons
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
                    <li class="breadcrumb-item">Solution Reasons Section</li>
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
                    <h4 class="card-title">Solution Name : <b>{{ $ourSolution->title }}</b></h4>
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
                                    <th>Our Solution Title</th>
                                    <th>Details</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($solutionReasons as $detail)
                                <tr>
                                    <td>
                                        <span>{{$loop->index + 1}}</span>
                                    </td>
                                    <td>
                                        <span>{{$detail->title}}</span>
                                    </td>

                                    <td>
                                        <span>{!! $detail->details!!}}</span>
                                    </td>

                                    <td>
                                        <img src="{{ asset('uploads/our_solutionReasons')}}/{{ $detail->image }}"
                                            alt="">
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
                                                    data-target="#reasonEdit{{ $detail->id }}"">
                                                    <i data-feather="edit"></i>
                                                    <span>Edit</span>
                                                </a>

                                                <form action="{{ route('solutionResons.destroy',$detail->id) }}"
                                                    method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf

                                                    <a class="dropdown-item"
                                                        href="{{ route('solutionResons.destroy',$detail->id) }}"
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
                <form action="{{ route('solutionResons.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input name="our_solutions_id" type="text" hidden value="{{ $ourSolution->id }}">
                    <div class="form-group">
                        <label for="title">Reasons Title</label>
                        <input type="text" name="title" class="form-control" id="title">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="details">Reasons Details</label>
                        <input type="hidden" name="details" id="details" class="form-control">
                        <trix-editor input="details"></trix-editor>
                        @error('details')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="banner_image">Image</label>
                        </div>
                        @error('image')
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


<!--Reason Edit Modal -->
@foreach ($solutionReasons as $detail)
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
                <form action="{{ route('solutionResons.update',$detail->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input name="our_solutions_id" type="text" hidden value="{{ $ourSolution->id }}">
                    <div class="form-group">
                        <label for="title">Reasons Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{ $detail->title }}">
                        @error('title')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="details">Reasons Details</label>
                        <input type="hidden" name="details" id="details{{ $detail->id }}" class="form-control" value="{{  $detail->details }}">
                        <trix-editor input="details{{ $detail->id }}"></trix-editor>
                        @error('details')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="banner_image">Image</label>
                        </div>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <img src="{{asset('uploads/our_solutionReasons')}}/{{ $detail->image }}" alt="No Image">
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
@endforeach

@endsection