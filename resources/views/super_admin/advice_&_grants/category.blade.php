@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Advice category') }}
@endsection

{{-- Menu Active --}}
@section('adviceCreate')
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
                    <li class="breadcrumb-item">{{ __('Advices And Grant categories') }}</li>
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
                    <h4 class="card-title">{{ __('Advices And Grants Categories List') }}</h4>
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
                    <div class="mb-2">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#categoty">+ {{ __('Add category') }}</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                <tr>
                                    <td>
                                        <span>{{ $loop->index + 1 }}</span>
                                    </td>

                                    <td>
                                        <span>{{ $item->category_name }}</span>
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

                                                <a class="dropdown-item" data-toggle="modal" data-target="#categoty{{ $item->id }}">
                                                    <i data-feather='edit-3'></i>
                                                    <span>{{ __('Edit') }}</span>
                                                </a>

                                                <form action="{{ route('categoriesAdvices.destroy',$item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <a class="dropdown-item"
                                                        href="{{ route('categoriesAdvices.destroy',$item->id) }}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i data-feather='trash-2'></i>
                                                        <span>{{ __('Delete') }}</span>
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

@foreach ($category as $item)
    {{-- Category Edit Modal --}}
<div class="modal fade" id="categoty{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="categoty{{ $item->id }}Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categoriesAdvices.update',$item->id) }}" method="POST"5>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" value="{{$item->category_name}}">
                        @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
              
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Category Modal --}}
<div class="modal fade" id="categoty" tabindex="-1" role="dialog" aria-labelledby="categotyTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categoriesAdvices.store') }}" method="POST"5>
                    @csrf

                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name" value="{{ old('category_name') }}">
                        @error('category_name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
              
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection