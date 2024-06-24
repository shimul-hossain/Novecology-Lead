@extends('backoffice.app')

@section('offerIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Offres
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
                    <li class="breadcrumb-item">Offres</li>
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
                @if (session('success'))
                    <div class="alert alert-success">
                        <div class="alert-body">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des Offres</h4> 
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="data_table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Catégorie</th>
                                        <th>Titre</th> 
                                        <th>Image</th>
                                        <th>{{ __('Actions') }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($offers as $offer)
                                        <tr>
                                            <td> 
                                                {{ $loop->iteration }} 
                                            </td>
                                            <td> 
                                                {{ $offer->getCategory->title ?? '' }}
                                            </td> 
                                            <td> 
                                                {{ $offer->title }}
                                            </td> 
                                            <td>
                                                <img width="200" src="{{asset('uploads/new/offer')}}/{{ $offer->banner_image }}" alt="Offer image">
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
                                                        <a class="dropdown-item" href="{{ route('backoffice.offer.edit', $offer->id) }}">
                                                            <i data-feather="eye"></i>
                                                            <span>{{ __('Edit') }}</span>
                                                        </a> 
                                                        <form action="{{ route('backoffice.offer.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $offer->id }}">
                                                            <button type="submit" class="dropdown-item w-100">
                                                                <i data-feather='trash-2'></i>
                                                                <span>{{ __('Delete') }}</span>
                                                            </button>

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

@section('js')

@endsection