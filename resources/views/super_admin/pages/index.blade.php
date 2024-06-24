@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Our Solution') }}
@endsection



{{-- Menu Active --}}
@section('pageIndex')
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
                    <li class="breadcrumb-item">{{ __('Pages List') }}</li>
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
                    <h4 class="card-title">{{ __('Pages List') }}</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Slug') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pages as $page)
                                <tr>
                                    <td>
                                        <span>{{ $loop->index + 1 }}</span>
                                    </td>
    
                                    <td>
                                        <span>{{ $page->title }}</span>
                                    </td>
    
                                    <td>
                                        <span>{{ $page->link }}</span>
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
                                                <a class="dropdown-item" type="button"
                                                    href="{{ route('pages.edit',$page->id)}}">
                                                    <i data-feather='edit-3'></i>
                                                    <span>{{ __('Edit') }}</span>
                                                </a>
                                                <a class="dropdown-item" type="button" data-toggle="modal"
                                                    data-target="#details{{ $page->id}}">
                                                    <i data-feather='eye'></i>
                                                    <span>{{ __('Details') }}</span>
                                                </a>
    
                                                <form action="{{ route('pages.destroy',$page->id)}}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
    
                                                    <a class="dropdown-item" href="{{ route('pages.destroy',$page->id)}}"
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

@foreach ($pages as $page)

<!--Edit Modal -->
<div class="modal fade" id="details{{ $page->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailsTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Modal title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="data_table" class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th class="font-weight-bold">{{ __('Page Title') }}</th>
                                <td>{{$page->title}}</td>
                            </tr>
                            {{-- <tr>
                                <th class="font-weight-bold">Page Subtitle</th>
                                <td>{{$page->subtitle}}</td>
                            </tr> --}}

                            {{-- <tr>
                                <th class="font-weight-bold">Thumbnail</th>
                                <td><img width="200"
                                        src="{{ asset('uploads/extra_page')}}/{{ $page->thumbnail}}"
                                        alt=""></td>
                            </tr> --}}
                            {{-- <tr>
                                <th class="font-weight-bold">Quote</th>
                                <td>{{$page->short_description}}</td>
                            </tr> --}}
                            <tr>
                                <th class="font-weight-bold">{{ __('Details') }}</th>
                                <td>{!!$page->long_description!!}</td>
                            </tr>

                            {{-- <tr>
                                <th class="font-weight-bold">Image 2</th>
                                <td><img width="200"
                                        src="{{ asset('uploads/extra_page')}}/{{ $page->image}}"
                                        alt=""></td>
                            </tr> --}}

                            {{-- <tr>
                                <th class="font-weight-bold">Lists</th>
                                <td>{!!$page->list!!}</td>
                            </tr> --}}
                            <tr>
                                <th class="font-weight-bold">{{ __('Edit') }}</th>
                                <td>
                                    <a class="btn btn-sm btn-secondary"
                                        href="{{ route('pages.edit',$page->id)}}">
                                        <span>Edit</span>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="font-weight-bold">{{ __('Delete') }}</th>

                                <td>
                                    <form action="{{ route('pages.destroy',$page->id)}}"
                                        method="POST">
                                        {{ method_field('DELETE') }}
                                        @csrf

                                        <a class="btn btn-sm btn-danger"
                                            href="{{ route('pages.destroy',$page->id)}}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">

                                            <span>{{ __('Delete') }}</span>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection