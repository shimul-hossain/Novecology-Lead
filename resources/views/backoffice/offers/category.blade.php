@extends('backoffice.app')

@section('offerCategory', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Catégorie d'offre
@endsection

 

@section('css') 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <li class="breadcrumb-item">Catégorie d'offre</li>
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
                        <h4 class="card-title">Liste des catégories d'offres</h4>
                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#createModal">Créer</button> 
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="data_table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Titre</th>
                                        <th>logo</th>
                                        <th>{{ __('Actions') }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td> 
                                                {{ $loop->iteration }} 
                                            </td>
                                            <td> 
                                                {{ $category->title }}
                                            </td> 
                                            <td>
                                                <img width="200" src="{{asset('uploads/new/offer')}}/{{ $category->logo }}" alt="offer logo">
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
                                                        <button class="dropdown-item w-100" data-toggle="modal" data-target="#editModal{{ $category->id }}">
                                                            <i data-feather="eye"></i>
                                                            <span>{{ __('Edit') }}</span>
                                                        </button> 
                                                        <form action="{{ route('backoffice.offer.category.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                                            <button type="submit" class="dropdown-item w-100">
                                                                <i data-feather='trash-2'></i>
                                                                <span>{{ __('Delete') }}</span>
                                                            </button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>  

                                        @push('all_modals')
                                            <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLongTitle">{{ __('Edit') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('backoffice.offer.category.update') }}" method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf  
                                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                                <div class="form-group"> 
                                                                    <label for="title">Titre *</label>
                                                                    <input type="text" name="title" id="title" class="form-control" value="{{ $category->title }}">
                                                                    @error('title')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>  

                                                                <div class="form-group">
                                                                    <label>logo existante </label>
                                                                    <br>
                                                                    <img width="200" src="{{asset('uploads/new/offer')}}/{{ $category->logo }}" alt="Banner image">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="image">{{ __('Logo') }} <small>(Ratio attendu: <strong>1:1</strong>)</small></label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="image"  name="logo">
                                                                        <label class="custom-file-label" for="image">Choisissez un logo</label>
                                                                    </div>
                                                                    @error('logo')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endpush
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLongTitle">Créer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('backoffice.offer.category.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf  
                        <div class="form-group"> 
                            <label for="title">Titre * </label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="image">{{ __('Logo') }} * <small>(Ratio attendu: <strong>1:1</strong>)</small></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image"  name="logo">
                                <label class="custom-file-label" for="image">Choisissez un logo</label>
                            </div>
                            @error('logo')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        @if(($errors->has('title') || $errors->has('logo')) && old('id'))
            $('#editModal'+"{{ old('id') }}").modal('show');
        @elseif ($errors->has('title') || $errors->has('logo'))
            $('#createModal').modal('show');
        @endif
    });
</script>
@endsection