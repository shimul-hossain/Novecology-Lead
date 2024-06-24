@extends('backoffice.app')

@section('referenceCategory', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Références
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
                    <li class="breadcrumb-item">Références</li>
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
                        <h4 class="card-title">Liste des Références</h4>
                        <button class="btn btn-outline-success" data-toggle="modal" data-target="#createModal">Créer</button> 
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="data_table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Catégorie</th> 
                                        <th>Image</th> 
                                        <th>{{ __('Actions') }}</th>
                                        
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($all_reference as $reference)
                                        <tr>
                                            <td> 
                                                {{ $loop->iteration }} 
                                            </td>
                                            <td> 
                                                {{ $reference->getCategory->name ?? '' }} 
                                            </td>    
                                            <td>
                                                <img width="200" src="{{asset('uploads/new/reference')}}/{{ $reference->image }}" alt="reference image">
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
                                                        <button class="dropdown-item w-100" data-toggle="modal" data-target="#editModal{{ $reference->id }}">
                                                            <i data-feather="eye"></i>
                                                            <span>{{ __('Edit') }}</span>
                                                        </button> 
                                                        <form action="{{ route('backoffice.reference.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $reference->id }}">
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
                                            <div class="modal fade" id="editModal{{ $reference->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLongTitle">{{ __('Edit') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('backoffice.reference.update') }}" method="post" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $reference->id }}">
                                                                <div class="form-group">
                                                                    <label for="title">Catégorie *</label> 
                                                                    <select name="category_id" id="category_id" class="form-control" required>
                                                                        <option value="" selected>Sélectionnez</option>
                                                                        @foreach ($categories as $category)
                                                                            <option {{ $reference->category_id == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('category_id')
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div> 
                                                                @if ($reference->image)
                                                                    <div class="form-group">
                                                                        <label for="icon">Image existante</label>
                                                                        <br>
                                                                        <img width="200" src="{{asset('uploads/new/reference')}}/{{ $reference->image }}" alt="reference image">
                                                                    </div>
                                                                @endif

                                                                <div class="form-group">
                                                                    <label for="image">Image</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" id="image" accept="image/*" name="image">
                                                                        <label class="custom-file-label" for="image">{{ __('Choose a image') }}</label>
                                                                    </div>
                                                                    @error('image')
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
                <form action="{{ route('backoffice.reference.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf  
                        <div class="form-group">
                            <label for="title">Catégorie *</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" selected>Sélectionnez</option>
                                @foreach ($categories as $category)
                                    <option {{ old('category_id') == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div> 
                        <div class="form-group">
                            <label for="image">Image*</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" accept="image/*" name="image">
                                <label class="custom-file-label" for="image">{{ __('Choose a image') }}</label>
                            </div>
                            @error('image')
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
        @if($errors->has('category_id') && old('id'))
            $('#editModal'+"{{ old('id') }}").modal('show');
        @elseif ($errors->has('category_id'))
            $('#createModal').modal('show');
        @endif
    });
</script>
@endsection