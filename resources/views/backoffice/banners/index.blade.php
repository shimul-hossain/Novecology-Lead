@extends('backoffice.app')

@section('bannerIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Bannière
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
                    <li class="breadcrumb-item">Bannière</li>
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
                <div id="alertWrapSection">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <div class="alert-body">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des bannières</h4> 
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="data_table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Titre</th>
                                        <th>Lien du bouton</th>
                                        <th>Image</th>
                                        <th>Order</th>
                                        <th>{{ __('Actions') }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td> 
                                                {{ $loop->iteration }} 
                                            </td>
                                            <td> 
                                                {{ $banner->title }}
                                            </td>
                                            <td>
                                                {{ $banner->button_link }}
                                            </td>
                                            <td>
                                                <img width="200" src="{{asset('uploads/new/banner')}}/{{ $banner->image }}" alt="Banner image">
                                            </td> 
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" min="1" class="form-control text-center bannerOrderChange" data-id="{{ $banner->id }}" value="{{ $banner->order }}">
                                                </div>
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
                                                        <a class="dropdown-item" href="{{ route('backoffice.banner.edit', $banner->id) }}">
                                                            <i data-feather="eye"></i>
                                                            <span>{{ __('Edit') }}</span>
                                                        </a> 
                                                        <form action="{{ route('backoffice.banner.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $banner->id }}">
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
    <script>
        $(document).ready(function(){
            $('.bannerOrderChange').blur(function(){
                let order = $(this).val();
                let banner_id = $(this).data('id'); 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }); 
                $.ajax({
                    type : "POST",
                    url  : "{{ route('banner.order.update') }}",
                    data : {order, banner_id},
                    success : response => {
                        if(response == 'updated'){
                            $("#alertWrapSection").html(`
                            <div class="alert alert-success">
                                <div class="alert-body">
                                    Mis à jour avec succés
                                </div>
                            </div>
                            `);
                        }
                    }
                })
            });
        })
    </script>
@endsection