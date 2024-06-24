@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Advice Details') }}
@endsection

{{-- Menu Active --}}
@section('adviceDetailsIndex')
active
@endsection
@section('css')
<style>
    .trix-button--icon-attach {
        display: none !important;
    }

    .trix-button {
        display: none !important;
    }

    .trix-button--icon {
        display: none !important;
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
                    <li class="breadcrumb-item">{{ __('Advice Details Section') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Advice Details Answer') }}</h4>

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
                    <p class="card-text">

                    </p>
                    <div class="table-responsive">
                        <table id="" class="table table-striped table-bordered">

                            <tbody>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Title') }}</th>
                                    <td>{{$adviceDetails->title}}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Thumbnail') }}</th>
                                    <td><img width="200" src="{{ asset('uploads/our_advice')}}/{{ $adviceDetails->thumbnail}}" alt=""></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Details') }}</th>
                                    <td>{!!$adviceDetails->details!!}</td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Image 1') }}</th>
                                    <td><img width="200" src="{{ asset('uploads/our_advice')}}/{{ $adviceDetails->image1}}" alt=""></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Image 2') }}</th>
                                    <td><img width="200" src="{{ asset('uploads/our_advice')}}/{{ $adviceDetails->image2}}" alt=""></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Image 3') }}</th>
                                    <td><img width="200" src="{{ asset('uploads/our_advice')}}/{{ $adviceDetails->image3}}" alt=""></td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Image 4') }}</th>
                                    <td><img width="200" src="{{ asset('uploads/our_advice')}}/{{ $adviceDetails->image4}}" alt=""></td>
                                </tr>
                              
                                <tr>
                                    <th class="font-weight-bold">{{ __('Edit') }}</th>
                                    <td>
                                        <a class="btn btn-sm btn-secondary"
                                            href="{{ route('adviceGrants.edit',$adviceDetails->id) }}">
                                            <span>{{ __('Edit') }}</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="font-weight-bold">{{ __('Delete') }}</th>

                                    <td>
                                        <form action="{{route('adviceGrants.destroy',$adviceDetails->id)}}" method="POST">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                         
                                            <a class="btn btn-sm btn-danger" href="{{route('adviceGrants.destroy',$adviceDetails->id) }}"
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
</section>

@endsection