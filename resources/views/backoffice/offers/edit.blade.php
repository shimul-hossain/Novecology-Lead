@extends('backoffice.app')

@section('offerIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Offre
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
                    <li class="breadcrumb-item">Offre</li>
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
                        <h4 class="card-title">Modifier l'offre </h4>
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
                        <form action="{{ route('backoffice.offer.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="form-group">
                                <label for="title">Catégorie *</label>
                                <input type="hidden" name="id" value="{{ $offer->id }}">
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected>Sélectionnez</option>
                                    @foreach ($categories as $category)
                                        <option {{ $offer->category_id == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Titre *</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $offer->title }}" required>
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Sous-titre *</label>
                                <textarea  name="subtitle" id="subtitle" class="form-control" required>{{ $offer->subtitle }}</textarea>
                                @error('subtitle')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            @if ($offer->icon)
                                <div class="form-group">
                                    <label for="icon">Icône existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/offer')}}/{{ $offer->icon }}" alt="Offer image">
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="icon">{{ __('Icon Image') }} * <small>(Ratio attendu: <strong>1:1</strong>)</small></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="icon" name="icon" accept="image/*">
                                    <label class="custom-file-label" for="icon">{{ __('Choose a image') }}</label>
                                </div>
                                @error('icon')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            @if ($offer->feature_image)
                                <div class="form-group">
                                    <label for="feature_image">Image vedette existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/offer')}}/{{ $offer->feature_image }}" alt="Offer image">
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="feature_image">Image vedette</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="feature_image" accept="image/*" name="feature_image">
                                    <label class="custom-file-label" for="feature_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('feature_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            @if ($offer->banner_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/offer')}}/{{ $offer->banner_image }}" alt="Offer image">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="banner_image">{{ __('Banner Image') }}</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="banner_image" accept="image/*" name="banner_image">
                                    <label class="custom-file-label" for="banner_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('banner_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="home_page_button_text">Texte du bouton de la page d'accueil *</label>
                                <input type="text" name="home_page_button_text" id="home_page_button_text" class="form-control" value="{{ $offer->home_page_button_text }}" required>
                                @error('home_page_button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="short_description">Brève description *</label>
                                <textarea  name="short_description" id="short_description" class="form-control" required>{{ $offer->short_description }}</textarea>
                                @error('short_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="long_description">Longue description *</label>
                                <textarea  name="long_description" id="long_description" class="form-control" required>{{ $offer->long_description }}</textarea>
                                @error('long_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            
                            <div class="form-group">
                                <label for="banner_button_text">Texte du bouton de bannière *</label>
                                <input type="text" name="banner_button_text" id="banner_button_text" class="form-control" value="{{ $offer->banner_button_text }}" required>
                                @error('banner_button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="banner_button_link">Lien du bouton de la bannière</label>
                                <input type="text" name="banner_button_link" id="banner_button_link" class="form-control" value="{{ $offer->banner_button_link }}">
                                @error('banner_button_link')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="card">
                                <div class="card-body" id="bannerServiceWrap" style="background: rgb(239, 238, 238);">
                                    @forelse ($offer->bannerService as $service)    
                                        <div class="form-group blockWrap">
                                            <input type="hidden" name="x_service_id[]" value="{{ $service->id }}">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label for="banner_button_link">Service de bannière</label>
                                                @if ($loop->first)
                                                    <button type="button" class="btn btn-primary" id="bannerServiceAddnew" style="margin-bottom: 2px">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                    </button> 
                                                @else
                                                    <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                    </button>
                                                @endif
                                            </div>
                                            <input type="text" name="banner_service[{{ $service->id }}]" id="banner_button_link" value="{{ $service->name }}" class="form-control" required> 
                                        </div> 
                                    @empty
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label for="banner_button_link">Service de bannière</label>
                                                <button type="button" class="btn btn-primary" id="bannerServiceAddnew" style="margin-bottom: 2px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </button> 
                                            </div>
                                            <input type="text" name="banner_service[]" id="banner_button_link" class="form-control" required> 
                                        </div> 
                                    @endforelse
                                </div>
                            </div> 
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="first_block_status" {{ $offer->first_block_status == 'yes'? 'checked':'' }} data-block="first_block" data-required-class="first_block_required" class="custom-control-input blockStatusChange" id="first_block_status">
                                <label class="custom-control-label" for="first_block_status">premier bloc</label>
                            </div>
                            <div class="mt-1 first_block" style="display: {{ $offer->first_block_status == 'yes'? '':'none' }}">
                                <div class="form-group">
                                    <label for="first_block_title">Titre du premier bloc *</label>
                                    <input type="text" name="first_block_title" id="first_block_title" class="form-control first_block_required" {{ $offer->first_block_status == 'yes'? 'required':'' }} value="{{ $offer->first_block_title }}">
                                    @error('first_block_title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                @if ($offer->first_block_image)
                                    <div class="form-group">
                                        <label for="icon">Image existante</label>
                                        <br>
                                        <img width="200" src="{{asset('uploads/new/offer')}}/{{ $offer->first_block_image }}" alt="Offer image">
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="first_block_image">Image du premier bloc *</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="first_block_image" accept="image/*" name="first_block_image">
                                        <label class="custom-file-label" for="first_block_image">{{ __('Choose a image') }}</label>
                                    </div>
                                    @error('first_block_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="first_block_desciption">Description du premier bloc *</label>
                                    <textarea  name="first_block_desciption" id="first_block_desciption" class="form-control first_block_required" {{ $offer->first_block_status == 'yes'? 'required':'' }}>{{ $offer->first_block_desciption }}</textarea>
                                    @error('first_block_desciption')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
    
                                {{-- <div class="form-group">
                                    <label for="first_block_button_text">Premier bloc texte du bouton*</label>
                                    <input type="text" name="first_block_button_text" id="first_block_button_text" class="form-control first_block_required" {{ $offer->first_block_status == 'yes'? 'required':'' }} value="{{ $offer->first_block_button_text }}">
                                    @error('first_block_button_text')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="first_block_button_link">Premier bloc lien du bouton</label>
                                    <input type="text" name="first_block_button_link" id="first_block_button_link" class="form-control" value="{{ $offer->first_block_button_link }}">
                                    @error('first_block_button_link')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> --}}
                            </div> 
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="second_block_status" data-block="second_block" {{ $offer->second_block_status == 'yes'? 'checked':'' }} data-required-class="second_block_required" class="custom-control-input blockStatusChange" id="second_block_status">
                                <label class="custom-control-label" for="second_block_status">Deuxième bloc</label>
                            </div>
                            <div class="mt-1 second_block" style="display: {{ $offer->second_block_status == 'yes'? '':'none' }}">
                                <div class="form-group">
                                    <label for="second_block_title">Titre du deuxième bloc *</label>
                                    <input type="text" name="second_block_title" id="second_block_title" class="form-control second_block_required" {{ $offer->second_block_status == 'yes'? 'required':'' }} value="{{ $offer->second_block_title }}">
                                    @error('second_block_title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                @if ($offer->second_block_image)
                                    <div class="form-group">
                                        <label for="icon">Image existante</label>
                                        <br>
                                        <img width="200" src="{{asset('uploads/new/offer')}}/{{ $offer->second_block_image }}" alt="Offer image">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="second_block_image">Image du deuxième bloc *</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="second_block_image" accept="image/*" name="second_block_image">
                                        <label class="custom-file-label" for="second_block_image">{{ __('Choose a image') }}</label>
                                    </div>
                                    @error('second_block_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="second_block_desciption">Description du deuxième bloc *</label>
                                    <textarea  name="second_block_desciption" id="second_block_desciption" class="form-control second_block_required" {{ $offer->second_block_status == 'yes'? 'required':'' }}>{{ $offer->second_block_desciption }}</textarea>
                                    @error('second_block_desciption')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
    
                                {{-- <div class="form-group">
                                    <label for="second_block_button_text">Deuxième bloc texte du bouton*</label>
                                    <input type="text" name="second_block_button_text" id="second_block_button_text" class="form-control second_block_required" {{ $offer->second_block_status == 'yes'? 'required':'' }} value="{{ $offer->second_block_button_text }}">
                                    @error('second_block_button_text')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="second_block_button_link">Deuxième bloc lien du bouton</label>
                                    <input type="text" name="second_block_button_link" id="second_block_button_link" class="form-control" value="{{ $offer->second_block_button_link }}">
                                    @error('second_block_button_link')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> --}}
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="third_block_status"  {{ $offer->third_block_status == 'yes'? 'checked':'' }} data-block="third_block" data-required-class="third_block_required" class="custom-control-input blockStatusChange" id="third_block_status">
                                <label class="custom-control-label" for="third_block_status">Troisième bloc</label>
                            </div>
                            <div class="card third_block" style="display: {{ $offer->third_block_status == 'yes'? '':'none' }}"> 
                                <div class="card-body" id="third_block__Wrap" style="background: rgb(239, 238, 238);"> 
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="third_block_title">Titre du troisième bloc *</label>
                                            <button type="button" class="btn btn-primary" id="third_block__Addnew" style="margin-bottom: 2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button> 
                                        </div> 
                                        <input type="text" name="third_block_title" id="third_block_title" value="{{ $offer->third_block_title }}" class="form-control third_block_required" {{ $offer->third_block_status == 'yes'? 'required':'' }}>
                                        @error('third_block_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div> 
                                    @forelse ($offer->thirdBlockInfo as $third_block_info)
                                        <div class="blockWrap"> 
                                            <input type="hidden" name="x_third_block_id[]" value="{{ $third_block_info->id }}">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <label for="third__title">Titre *</label>
                                                    @if (!$loop->first)
                                                        <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </button>
                                                    @endif
                                                </div>
                                                <input type="text" name="third__title[{{ $third_block_info->id }}]" id="third__title" value="{{ $third_block_info->title }}" class="form-control third_block_required" required> 
                                            </div>
                                            <div class="form-group">
                                                <label for="third__description">Description *</label>
                                                <textarea  name="third__description[{{ $third_block_info->id }}]" id="third__description" class="form-control third_block_required" required>{{ $third_block_info->description }}</textarea> 
                                            </div> 
                                            @if ($third_block_info->image)
                                                <div class="form-group">
                                                    <label for="icon">Image existante</label>
                                                    <br>
                                                    <img width="200" src="{{asset('uploads/new/offer')}}/{{ $third_block_info->image }}" alt="Offer image">
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="third__image">Image *</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="third__image" accept="image/*" name="third__image[{{ $third_block_info->id }}]">
                                                    <label class="custom-file-label" for="third__image">{{ __('Choose a image') }}</label>
                                                </div> 
                                            </div> 
                                        </div>
                                    @empty
                                        <div class="blockWrap">
                                            <div class="form-group">
                                                <label for="third__title">Titre *</label>
                                                <input type="text" name="third__title[]" id="third__title" class="form-control third_block_required" {{ $offer->third_block_status == 'yes'? 'required':'' }}> 
                                            </div>
                                            <div class="form-group">
                                                <label for="third__description">Description *</label>
                                                <textarea  name="third__description[]" id="third__description" class="form-control third_block_required" {{ $offer->third_block_status == 'yes'? 'required':'' }}></textarea> 
                                            </div> 
                                            <div class="form-group">
                                                <label for="third__image">Image *</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input third_block_required" id="third__image" accept="image/*" name="third__image[]" {{ $offer->third_block_status == 'yes'? 'required':'' }}>
                                                    <label class="custom-file-label" for="third__image">{{ __('Choose a image') }}</label>
                                                </div> 
                                            </div> 
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="fourth_block_status" data-block="fourth_block" {{ $offer->fourth_block_status == 'yes'? 'checked':'' }} data-required-class="fourth_block_required" class="custom-control-input blockStatusChange" id="fourth_block_status">
                                <label class="custom-control-label" for="fourth_block_status">Quatrième bloc</label>
                            </div> 
                            <div class="mt-1 fourth_block" style="display: {{ $offer->fourth_block_status == 'yes'? '':'none' }}">
                                <div class="form-group">
                                    <label for="fourth_block_title">Titre du quatrième bloc *</label>
                                    <input type="text" name="fourth_block_title" id="fourth_block_title" class="form-control fourth_block_required" {{ $offer->fourth_block_status == 'yes'? 'required':'' }} value="{{ $offer->fourth_block_title }}">
                                    @error('fourth_block_title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                @if ($offer->fourth_block_image)
                                    <div class="form-group">
                                        <label for="icon">Image existante</label>
                                        <br>
                                        <img width="200" src="{{asset('uploads/new/offer')}}/{{ $offer->fourth_block_image }}" alt="Offer image">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="fourth_block_image">Image du quatrième bloc *</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fourth_block_image" accept="image/*" name="fourth_block_image">
                                        <label class="custom-file-label" for="fourth_block_image">{{ __('Choose a image') }}</label>
                                    </div>
                                    @error('fourth_block_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="fourth_block_desciption">Description du quatrième bloc *</label>
                                    <textarea  name="fourth_block_desciption" id="fourth_block_desciption" class="form-control fourth_block_required" {{ $offer->fourth_block_status == 'yes'? 'required':'' }}>{{ $offer->fourth_block_desciption }}</textarea>
                                    @error('fourth_block_desciption')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
    
                                {{-- <div class="form-group">
                                    <label for="fourth_block_button_text">Quatrième bloc texte du bouton*</label>
                                    <input type="text" name="fourth_block_button_text" id="fourth_block_button_text" class="form-control fourth_block_required" {{ $offer->fourth_block_status == 'yes'? 'required':'' }} value="{{ $offer->fourth_block_button_text }}">
                                    @error('fourth_block_button_text')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fourth_block_button_link">Quatrième bloc lien du bouton</label>
                                    <input type="text" name="fourth_block_button_link" id="fourth_block_button_link" class="form-control" value="{{ $offer->fourth_block_button_link }}">
                                    @error('fourth_block_button_link')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> --}}
                            </div> 
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="fifth_block_status"  {{ $offer->fifth_block_status == 'yes'? 'checked':'' }} data-block="fifth_block" data-required-class="fifth_block_required" class="custom-control-input blockStatusChange" id="fifth_block_status">
                                <label class="custom-control-label" for="fifth_block_status">Cinquième bloc</label>
                            </div>
                            <div class="card fifth_block" style="display: {{ $offer->fifth_block_status == 'yes'? '':'none' }}"> 
                                <div class="card-body" id="fifth_block__Wrap" style="background: rgb(239, 238, 238);"> 
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="fifth_block_title">Titre du cinquième bloc *</label>
                                            <button type="button" class="btn btn-primary" id="fifth_block__Addnew" style="margin-bottom: 2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button> 
                                        </div> 
                                        <input type="text" name="fifth_block_title" id="fifth_block_title" value="{{ $offer->fifth_block_title }}" class="form-control fifth_block_required" {{ $offer->fifth_block_status == 'yes'? 'required':'' }}>
                                        @error('fifth_block_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label for="fifth_block_description">Description du cinquième bloc *</label>
                                        <textarea  name="fifth_block_description" id="fifth_block_description" class="form-control fifth_block_required" {{ $offer->fifth_block_status == 'yes'? 'required':'' }}>{{ $offer->fifth_block_description }}</textarea> 
                                    </div> 
                                    @forelse ($offer->fifthBlockInfo as $fifth_block_info)
                                        <div class="blockWrap"> 
                                            <input type="hidden" name="x_fifth_block_id[]" value="{{ $fifth_block_info->id }}">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <label for="fifth__title">Titre *</label>
                                                    @if (!$loop->first)
                                                        <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </button>
                                                    @endif
                                                </div>
                                                <input type="text" name="fifth__title[{{ $fifth_block_info->id }}]" id="fifth__title" value="{{ $fifth_block_info->title }}" class="form-control fifth_block_required" required> 
                                            </div>
                                            <div class="form-group">
                                                <label for="fifth__description">Description *</label>
                                                <textarea  name="fifth__description[{{ $fifth_block_info->id }}]" id="fifth__description" class="form-control fifth_block_required" required>{{ $fifth_block_info->description }}</textarea> 
                                            </div> 
                                            @if ($fifth_block_info->image)
                                                <div class="form-group">
                                                    <label for="icon">Image existante</label>
                                                    <br>
                                                    <img width="200" src="{{asset('uploads/new/offer')}}/{{ $fifth_block_info->image }}" alt="Offer image">
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="fifth__image">Image *</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fifth__image" accept="image/*" name="fifth__image[{{ $fifth_block_info->id }}]">
                                                    <label class="custom-file-label" for="fifth__image">{{ __('Choose a image') }}</label>
                                                </div> 
                                            </div> 
                                        </div>
                                    @empty
                                        <div class="blockWrap">
                                            <div class="form-group">
                                                <label for="fifth__title">Titre *</label>
                                                <input type="text" name="fifth__title[]" id="fifth__title" class="form-control fifth_block_required" {{ $offer->fifth_block_status == 'yes'? 'required':'' }}> 
                                            </div>
                                            <div class="form-group">
                                                <label for="fifth__description">Description *</label>
                                                <textarea  name="fifth__description[]" id="fifth__description" class="form-control fifth_block_required" {{ $offer->fifth_block_status == 'yes'? 'required':'' }}></textarea> 
                                            </div> 
                                            <div class="form-group">
                                                <label for="fifth__image">Image *</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input fifth_block_required" id="fifth__image" accept="image/*" name="fifth__image[]" {{ $offer->fifth_block_status == 'yes'? 'required':'' }}>
                                                    <label class="custom-file-label" for="fifth__image">{{ __('Choose a image') }}</label>
                                                </div> 
                                            </div> 
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="sixth_block_status"  {{ $offer->sixth_block_status == 'yes'? 'checked':'' }} data-block="sixth_block" data-required-class="sixth_block_required" class="custom-control-input blockStatusChange" id="sixth_block_status">
                                <label class="custom-control-label" for="sixth_block_status">Sixième bloc</label>
                            </div>
                            <div class="card sixth_block" style="display: {{ $offer->sixth_block_status == 'yes'? '':'none' }}"> 
                                <div class="card-body" id="sixth_block__Wrap" style="background: rgb(239, 238, 238);"> 
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="sixth_block_title">Titre du sixième bloc *</label>
                                            <button type="button" class="btn btn-primary" id="sixth_block__Addnew" style="margin-bottom: 2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button> 
                                        </div> 
                                        <input type="text" name="sixth_block_title" id="sixth_block_title" value="{{ $offer->sixth_block_title }}" class="form-control sixth_block_required" {{ $offer->sixth_block_status == 'yes'? 'required':'' }}>
                                        @error('sixth_block_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>  
                                    @forelse ($offer->sixthBlockInfo as $sixth_block_info)
                                        <div class="blockWrap"> 
                                            <input type="hidden" name="x_sixth_block_id[]" value="{{ $sixth_block_info->id }}">
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <label for="sixth__title">Titre *</label>
                                                    @if (!$loop->first)
                                                        <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </button>
                                                    @endif
                                                </div>
                                                <input type="text" name="sixth__title[{{ $sixth_block_info->id }}]" id="sixth__title" value="{{ $sixth_block_info->title }}" class="form-control sixth_block_required" required> 
                                            </div>
                                            <div class="form-group">
                                                <label for="sixth__description">Description *</label>
                                                <textarea  name="sixth__description[{{ $sixth_block_info->id }}]" id="sixth__description" class="form-control sixth_block_required" required>{{ $sixth_block_info->description }}</textarea> 
                                            </div> 
                                            @if ($sixth_block_info->image)
                                                <div class="form-group">
                                                    <label for="icon">Image existante</label>
                                                    <br>
                                                    <img width="200" src="{{asset('uploads/new/offer')}}/{{ $sixth_block_info->image }}" alt="Offer image">
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="sixth__image">Image *</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="sixth__image" accept="image/*" name="sixth__image[{{ $sixth_block_info->id }}]">
                                                    <label class="custom-file-label" for="sixth__image">{{ __('Choose a image') }}</label>
                                                </div> 
                                            </div> 
                                        </div>
                                    @empty
                                        <div class="blockWrap">
                                            <div class="form-group">
                                                <label for="sixth__title">Titre *</label>
                                                <input type="text" name="sixth__title[]" id="sixth__title" class="form-control sixth_block_required" {{ $offer->sixth_block_status == 'yes'? 'required':'' }}> 
                                            </div>
                                            <div class="form-group">
                                                <label for="sixth__description">Description *</label>
                                                <textarea  name="sixth__description[]" id="sixth__description" class="form-control sixth_block_required" {{ $offer->sixth_block_status == 'yes'? 'required':'' }}></textarea> 
                                            </div> 
                                            <div class="form-group">
                                                <label for="sixth__image">Image *</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input sixth_block_required" id="sixth__image" accept="image/*" name="sixth__image[]" {{ $offer->sixth_block_status == 'yes'? 'required':'' }}>
                                                    <label class="custom-file-label" for="sixth__image">{{ __('Choose a image') }}</label>
                                                </div> 
                                            </div> 
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <br>
        
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </form>
                    </div>
                
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('body').on('click', '#fifth_block__Addnew', function(){
                $("#fifth_block__Wrap").append(`
                <div class="blockWrap"  style="display:none">
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="fifth__title">Titre *</label>
                            <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </div>
                        <input type="text" name="fifth__title[]" id="fifth__title" class="form-control fifth_block_required" required> 
                    </div>
                    <div class="form-group">
                        <label for="fifth__description">Description *</label>
                        <textarea  name="fifth__description[]" id="fifth__description" class="form-control fifth_block_required" required></textarea> 
                    </div> 
                    <div class="form-group">
                        <label for="fifth__image">Image *</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input fifth_block_required" id="fifth__image" accept="image/*" name="fifth__image[]" required>
                            <label class="custom-file-label" for="fifth__image">{{ __('Choose a image') }}</label>
                        </div> 
                    </div> 
                </div>
                `);

                $('.blockWrap').slideDown();
            });
            $('body').on('click', '#third_block__Addnew', function(){
                $("#third_block__Wrap").append(`
                <div class="blockWrap"  style="display:none">
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="third__title">Titre *</label>
                            <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </div>
                        <input type="text" name="third__title[]" id="third__title" class="form-control third_block_required" required> 
                    </div>
                    <div class="form-group">
                        <label for="third__description">Description *</label>
                        <textarea  name="third__description[]" id="third__description" class="form-control third_block_required" required></textarea> 
                    </div> 
                    <div class="form-group">
                        <label for="third__image">Image *</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input third_block_required" id="third__image" accept="image/*" name="third__image[]" required>
                            <label class="custom-file-label" for="third__image">{{ __('Choose a image') }}</label>
                        </div> 
                    </div> 
                </div>
                `);

                $('.blockWrap').slideDown();
            });

            $('body').on('click', '#bannerServiceAddnew', function(){
                $("#bannerServiceWrap").append(`
                <div class="form-group blockWrap" style="display:none">
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="banner_button_link">Service de bannière</label> 
                        <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        </button>
                    </div>
                    <input type="text" name="banner_service[]" id="banner_button_link" class="form-control" required> 
                </div>
                `);

                $('.blockWrap').slideDown();
            });
            $('body').on('click', '.removedBtn', function(){
                $(this).closest('.blockWrap').slideUp(function(){
                    $(this).remove();
                })
            });
            $('body').on('change', '.blockStatusChange', function(){
                let block = $(this).data('block');
                let required_class = $(this).data('required-class');
                if($(this).is(':checked')){
                    $('.'+block).slideDown();
                    $('.'+required_class).attr('required', true);
                }else{
                    $('.'+block).slideUp();
                    $('.'+required_class).attr('required', false);
                }
            });


        });
    </script>
@endsection