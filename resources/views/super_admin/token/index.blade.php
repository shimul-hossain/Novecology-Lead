@extends('super_admin.dashboard')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Token For App') }}
@endsection

{{-- Menu Active --}}
@section('token')
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
                    <li class="breadcrumb-item">{{ __('Token') }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<section id="basic-vertical-layouts">
    <div class="row justify-content-center">
        <div class="col-lg-12">
        
            <div class="card">
                
                <div class="card-header">
                    <h4>{{ __('Create Token') }}</h4>
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
                        <div class="form-group">
                            <label for="token">{{ __('Your Token For App') }}</label>
                            <input type="text" class="form-control" id="token" name="token" value="{{ $token->token }}" readonly>
                        </div>
                        <button type="button" data-toggle="modal" data-target="#tokenModal" class="btn btn-primary">{{ __('Generate New Token') }}</button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="tokenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Are you sure?') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                         {{ __('Generating a new token might break down your Mobile app. Please make sure to update the new token in your app.') }}
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">{{ __('No, I am not sure') }} !!!</button>
                        <form action="{{ route('token.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">{{ __('Save changes') }}</button>
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection