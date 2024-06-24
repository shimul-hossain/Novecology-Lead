@extends('backoffice.app')

@section('backofficeIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | {{ __('Dashboard') }}
@endsection

 

@section('css') 

@endsection


{{-- Breadcrumb --}}
@section('breadcrumb')
<div class="content-header-left col-md-12 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <a href="{{ route('backoffice.dashboard') }}">
                <h2 class="content-header-title float-left mb-0">{{ __('Super Admin Dashboard') }}</h2>
            </a>
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">{{ __('Dashboard') }}</li>
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
                    <div class="card-body">
                        <h3 class="text-center">Bienvenue en novécologie</h3>
                    </div> 
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection