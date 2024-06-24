@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Advice (FAQ)') }}
@endsection

{{-- Menu Active --}}
@section('adviceIndex')
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('adviceGrants.index') }}"> {{ __('Advices And Grant') }}</a>
                    </li>
                    <li class="breadcrumb-item">{{ __('Advices And Grant FAQ') }}</li>
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
                    <h3 class="card-title">{{ __('Advice Title') }}:<b>{{ $adviceDetails->title }}</b></h3>
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
                    @error('question')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    @error('answer')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <!-- Add FAQ Button -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#faq">
                        + {{ __('Add') }}
                    </button>

                    <!-- Add FAQ  Modal -->
                    <div class="modal fade" id="faq" tabindex="-1" role="dialog" aria-labelledby="faqTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Modal title') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('faqAdvice.store')}}" method="POST">
                                        @csrf

                                        <input name="advice_id" type="text" hidden value="{{ $adviceDetails->id }}">
                                        <div class="form-group">
                                            <label for="question">{{ __('Question') }}</label>
                                            <input type="text" name="question" class="form-control" id="question"
                                                value="{{ old('question') }}">
                                           
                                        </div>
                                        <div class="form-group">
                                            <label for="answer">{{ __('Answer') }}</label>
                                            <textarea name="answer" class="form-control" id="answer"
                                                rows="5">{{ old('answer') }}</textarea>

                                         
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-header">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('Sl') }}</th>
                                    <th>{{ __('Question') }}</th>
                                    <th>{{ __('Answer') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adviceFaq as $item)
                                <tr>
                                    <td>
                                        <span>{{ $loop->index + 1}}</span>
                                    </td>
                                    <td>
                                        <span>{{ $item->question }}</span>
                                    </td>

                                    <td>
                                        <span>{{ $item->answer }}</span>
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
                                                <a class="dropdown-item" data-toggle="modal" data-target="#edit">
                                                    <i data-feather='edit-3'></i>"
                                                    <span>{{ __('Edit') }}</span>
                                                </a>

                                                <form action="{{ route('faqAdvice.destroy',$item->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <a class="dropdown-item"
                                                        href="{{ route('faqAdvice.destroy',$item->id) }}"
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
                                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="editTitle"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Modal title') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('faqAdvice.update',$item->id)}}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <input name="advice_id" type="text" hidden
                                                        value="{{ $adviceDetails->id }}">
                                                    <div class="form-group">
                                                        <label for="question">{{ __('Question') }}</label>
                                                        <input type="text" name="question" class="form-control"
                                                            id="question" value="{{ $item->question }}">
                                                        @error('question')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="answer">{{ __('Answer') }}</label>
                                                        <textarea name="answer" class="form-control" id="answer"
                                                            rows="5">{{ $item->answer }}</textarea>

                                                        @error('question')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                </form>
                                            </div>
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

@endsection