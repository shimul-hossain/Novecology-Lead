@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Our Solutions') }}
@endsection

{{-- Menu Active --}}
@section('ourSolutionIndex')
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
                    <li class="breadcrumb-item">{{ __('Our Solutions Section') }}</li>
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
                    <h4 class="card-title">{{ __('Our Solutions List') }}</h4>
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
                        <table class="table table-striped table-bordered" id="data_table">
                            <thead>
                                <tr>
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Image') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ourSolution as $item)
                                <tr>
                                    <td>
                                        <span>{{$item->title }}</span>
                                    </td>

                                    <td>
                                        <img src="{{ asset('uploads/our_solution')}}/{{ $item->image  }}"
                                            alt="Working Eith Image" width="150">
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
                                                <a class="dropdown-item"
                                                    href="{{ route('ourSolutions.show',$item->id) }}">
                                                    <i data-feather="eye"></i>
                                                    <span>{{ __('Details') }}</span>
                                                </a>

                                                <a class="dropdown-item"
                                                    href="{{ route('solutionDetails.edit',$item->id) }}">
                                                    <i data-feather='briefcase'></i>
                                                    <span>{{ __('Solution Details') }} <span class="badge badge-danger badge-sm badge-glow">{{ solutionDetailsCount($item->id) }}</span></span>
                                                </a>


                                                <a class="dropdown-item"
                                                    href="{{ route('solutionResons.show',$item->id) }}">
                                                    <i data-feather='compass'></i>
                                                    <span>{{ __('Solution Reasons') }} <span class="badge badge-danger badge-sm badge-glow">{{ solutionReasonCount($item->id) }}</span></span>
                                                </a>

                                                <a class="dropdown-item"
                                                    href="{{ route('ourSolutions.edit',$item->id) }}">
                                                    <i data-feather='edit-3'></i>
                                                    <span>{{ __('Edit') }}</span>
                                                </a>

                                                <form action="{{ route('ourSolutions.destroy',$item->id) }}"
                                                    method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf

                                                    <a class="dropdown-item"
                                                        href="{{ route('ourSolutions.destroy',$item->id) }}"
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

@endsection