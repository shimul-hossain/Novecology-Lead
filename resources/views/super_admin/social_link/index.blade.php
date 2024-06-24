@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Social Links') }}
@endsection

{{-- Menu Active --}}
@section('socialIndex')
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
                    <li class="breadcrumb-item">{{ __('Advice Reasons Section') }}</li>
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
                    <h4 class="card-title">{{ __('Advice Reasons') }}</h4>
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
                    <div>
                        <button class="btn btn-success" type="button" data-toggle="modal"
                            data-target="#socialAdd">+{{ __('Add') }}</button>
                    </div>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Icon') }}</th>
                                    <th>{{ __('Link') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
    
    
                                <tr>
                                    <td class="text-center">
                                        <span>{{ $loop->index + 1 }}</span>
                                    </td>
    
                                    <td class="text-center">
                                        <span>{{ $item->icon }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span>{{ $item->link }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button"
                                                class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light"
                                                data-toggle="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-more-vertical">
                                                    <circle cx="12" cy="12" r="1"></circle>
                                                    <circle cx="12" cy="5" r="1"></circle>
                                                    <circle cx="12" cy="19" r="1"></circle>
                                                </svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" type="button" data-toggle="modal"
                                                    data-target="#socialedit{{ $item->id }}">
                                                    <i data-feather='edit-3'></i>"
                                                    <span>{{ __('Edit') }}</span>
                                                </a>
    
                                                <form action="{{ route('socialLinks.destroy',$item->id)}}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
    
                                                    <a class="dropdown-item"
                                                        href="{{ route('socialLinks.destroy',$item->id)}}"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i data-feather='trash-2'></i>
                                                        <span>{{ __('Delete') }}</span>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
    
    
                                <!--Edit Modal -->
                                <div class="modal fade" id="socialedit{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="socialedit{{ $item->id }}Title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="socialedit{{ $item->id }}Title">{{ __('Modal title') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('socialLinks.update',$item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
    
                                                        <div class="form-group">
                                                            <label for="icon">{{ __('Icon') }} <a href="https://fontawesome.com/v5/search?o=r&m=free" target="_blank" class="ml-25">Get Icons <i data-feather='external-link' class="ml-25"></i></a></label>
                                                            <input type="text" name="icon" class="form-control" id="icon"
                                                                value="{{ $item->icon }}">
                                                            @error('icon')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="link">{{ __('link') }}</label>
                                                            <input type="text" name="link" class="form-control" id="link"
                                                            value="{{ $item->link }}">
                                                            @error('link')
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





<!--Add Modal -->
<div class="modal fade" id="socialAdd" tabindex="-1" role="dialog" aria-labelledby="socialAddTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="socialAddTitle">{{ __('Modal title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('socialLinks.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="icon">{{ __('Icon') }} <a href="https://fontawesome.com/v5/search?o=r&m=free" target="_blank" class="ml-25">Get Icons <i data-feather='external-link' class="ml-25"></i></a></label>
                            <input type="text" name="icon" class="form-control" id="icon" placeholder="Icon Tag">
                            @error('icon')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="link">{{ __('link') }}</label>
                            <input type="text" name="link" class="form-control" id="link" placeholder="Link">
                            @error('link')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection