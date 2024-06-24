@extends('backoffice.app')

@section('offerCreate', 'active')

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
                        <h4 class="card-title">Création de Offre</h4>
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
                        <form action="{{ route('backoffice.offer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="form-group">
                                <label for="title">Catégorie *</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected>Sélectionnez</option>
                                    @foreach ($categories as $category)
                                        <option {{ old('category_id') == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Titre *</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="subtitle">Sous-titre *</label>
                                <textarea  name="subtitle" id="subtitle" class="form-control" required>{{ old('subtitle') }}</textarea>
                                @error('subtitle')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="icon">{{ __('Icon Image') }} * <small>(Ratio attendu: <strong>1:1</strong>)</small></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="icon" name="icon" accept="image/*" required>
                                    <label class="custom-file-label" for="icon">{{ __('Choose a image') }}</label>
                                </div>
                                @error('icon')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="feature_image">Image vedette *</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="feature_image" accept="image/*" name="feature_image" required>
                                    <label class="custom-file-label" for="feature_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('feature_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="banner_image">{{ __('Banner Image') }} *</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="banner_image" accept="image/*" name="banner_image" required>
                                    <label class="custom-file-label" for="banner_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('banner_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="home_page_button_text">Texte du bouton de la page d'accueil *</label>
                                <input type="text" name="home_page_button_text" id="home_page_button_text" class="form-control" value="{{ old('home_page_button_text') }}" required>
                                @error('home_page_button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="short_description">Brève description *</label>
                                <textarea  name="short_description" id="short_description" class="form-control" required>{{ old('short_description') }}</textarea>
                                @error('short_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="long_description">Longue description *</label>
                                <textarea  name="long_description" id="long_description" class="form-control" required>{{ old('long_description') }}</textarea>
                                @error('long_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            
                            <div class="form-group">
                                <label for="banner_button_text">Texte du bouton de bannière *</label>
                                <input type="text" name="banner_button_text" id="banner_button_text" class="form-control" value="{{ old('banner_button_text') }}" required>
                                @error('banner_button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="banner_button_link">Lien du bouton de la bannière</label>
                                <input type="text" name="banner_button_link" id="banner_button_link" class="form-control" value="{{ old('banner_button_link') }}">
                                @error('banner_button_link')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="card">
                                <div class="card-body" id="bannerServiceWrap" style="background: rgb(239, 238, 238);">
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="banner_button_link">Service de bannière *</label>
                                            <button type="button" class="btn btn-primary" id="bannerServiceAddnew" style="margin-bottom: 2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button> 
                                        </div>
                                        <input type="text" name="banner_service[]" id="banner_button_link" class="form-control" required> 
                                    </div> 
                                </div>
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="first_block_status" data-block="first_block" data-required-class="first_block_required" class="custom-control-input blockStatusChange" id="first_block_status">
                                <label class="custom-control-label" for="first_block_status">Premier bloc</label>
                            </div>
                            <div class="mt-1 first_block" style="display: none">
                                <div class="form-group">
                                    <label for="first_block_title">Titre du premier bloc *</label>
                                    <input type="text" name="first_block_title" id="first_block_title" class="form-control first_block_required" value="{{ old('first_block_title') }}">
                                    @error('first_block_title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="first_block_image">Image du premier bloc *</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input first_block_required" id="first_block_image" accept="image/*" name="first_block_image">
                                        <label class="custom-file-label" for="first_block_image">{{ __('Choose a image') }}</label>
                                    </div>
                                    @error('first_block_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="first_block_desciption">Description du premier bloc *</label>
                                    <textarea  name="first_block_desciption" id="first_block_desciption" class="form-control first_block_required">{{ old('first_block_desciption') }}</textarea>
                                    @error('first_block_desciption')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
    
                                {{-- <div class="form-group">
                                    <label for="first_block_button_text">Premier bloc texte du bouton*</label>
                                    <input type="text" name="first_block_button_text" id="first_block_button_text" class="form-control first_block_required" value="{{ old('first_block_button_text') }}">
                                    @error('first_block_button_text')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="first_block_button_link">Premier bloc lien du bouton</label>
                                    <input type="text" name="first_block_button_link" id="first_block_button_link" class="form-control" value="{{ old('first_block_button_link') }}">
                                    @error('first_block_button_link')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> --}}
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="second_block_status" data-block="second_block" data-required-class="second_block_required" class="custom-control-input blockStatusChange" id="second_block_status">
                                <label class="custom-control-label" for="second_block_status">Deuxième bloc</label>
                            </div>
                            <div class="mt-1 second_block" style="display: none">
                                <div class="form-group">
                                    <label for="second_block_title">Titre du deuxième bloc *</label>
                                    <input type="text" name="second_block_title" id="second_block_title" class="form-control second_block_required" value="{{ old('second_block_title') }}">
                                    @error('second_block_title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="second_block_image">Image du deuxième bloc *</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input second_block_required" id="second_block_image" accept="image/*" name="second_block_image">
                                        <label class="custom-file-label" for="second_block_image">{{ __('Choose a image') }}</label>
                                    </div>
                                    @error('second_block_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="second_block_desciption">Description du deuxième bloc *</label>
                                    <textarea  name="second_block_desciption" id="second_block_desciption" class="form-control second_block_required">{{ old('second_block_desciption') }}</textarea>
                                    @error('second_block_desciption')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
    
                                {{-- <div class="form-group">
                                    <label for="second_block_button_text">Deuxième bloc texte du bouton*</label>
                                    <input type="text" name="second_block_button_text" id="second_block_button_text" class="form-control second_block_required" value="{{ old('second_block_button_text') }}">
                                    @error('second_block_button_text')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="second_block_button_link">Deuxième bloc lien du bouton</label>
                                    <input type="text" name="second_block_button_link" id="second_block_button_link" class="form-control" value="{{ old('second_block_button_link') }}">
                                    @error('second_block_button_link')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> --}}
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="third_block_status" data-block="third_block" data-required-class="third_block_required" class="custom-control-input blockStatusChange" id="third_block_status">
                                <label class="custom-control-label" for="third_block_status">Troisième bloc</label>
                            </div>
                            <div class="card third_block" style="display: none"> 
                                <div class="card-body" id="third_block__Wrap" style="background: rgb(239, 238, 238);"> 
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="third_block_title">Titre du troisième bloc *</label>
                                            <button type="button" class="btn btn-primary" id="third_block__Addnew" style="margin-bottom: 2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button> 
                                        </div> 
                                        <input type="text" name="third_block_title" id="third_block_title" class="form-control third_block_required">
                                        @error('third_block_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div> 
                                    <div class="blockWrap">
                                        <div class="form-group">
                                            <label for="third__title">Titre *</label>
                                            <input type="text" name="third__title[]" id="third__title" class="form-control third_block_required"> 
                                        </div>
                                        <div class="form-group">
                                            <label for="third__description">Description *</label>
                                            <textarea  name="third__description[]" id="third__description" class="form-control third_block_required"></textarea> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="third__image">Image *</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input third_block_required" id="third__image" accept="image/*" name="third__image[]">
                                                <label class="custom-file-label" for="third__image">{{ __('Choose a image') }}</label>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div> 
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="fourth_block_status" data-block="fourth_block" data-required-class="fourth_block_required" class="custom-control-input blockStatusChange" id="fourth_block_status">
                                <label class="custom-control-label" for="fourth_block_status">Quatrième bloc</label>
                            </div>
                            <div class="mt-1 fourth_block" style="display: none">
                                <div class="form-group">
                                    <label for="fourth_block_title">Titre du quatrième bloc *</label>
                                    <input type="text" name="fourth_block_title" id="fourth_block_title" class="form-control fourth_block_required" value="{{ old('fourth_block_title') }}">
                                    @error('fourth_block_title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fourth_block_image">Image du quatrième bloc *</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input fourth_block_required" id="fourth_block_image" accept="image/*" name="fourth_block_image">
                                        <label class="custom-file-label" for="fourth_block_image">{{ __('Choose a image') }}</label>
                                    </div>
                                    @error('fourth_block_image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="fourth_block_desciption">Description du quatrième bloc *</label>
                                    <textarea  name="fourth_block_desciption" id="fourth_block_desciption" class="form-control fourth_block_required">{{ old('fourth_block_desciption') }}</textarea>
                                    @error('fourth_block_desciption')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
    
                                {{-- <div class="form-group">
                                    <label for="fourth_block_button_text">Quatrième bloc texte du bouton*</label>
                                    <input type="text" name="fourth_block_button_text" id="fourth_block_button_text" class="form-control fourth_block_required" value="{{ old('fourth_block_button_text') }}">
                                    @error('fourth_block_button_text')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fourth_block_button_link">Quatrième bloc lien du bouton</label>
                                    <input type="text" name="fourth_block_button_link" id="fourth_block_button_link" class="form-control" value="{{ old('fourth_block_button_link') }}">
                                    @error('fourth_block_button_link')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> --}}
                            </div>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="fifth_block_status" data-block="fifth_block" data-required-class="fifth_block_required" class="custom-control-input blockStatusChange" id="fifth_block_status">
                                <label class="custom-control-label" for="fifth_block_status">Cinquième bloc</label>
                            </div>
                            <div class="card fifth_block" style="display: none"> 
                                <div class="card-body" id="fifth_block__Wrap" style="background: rgb(239, 238, 238);"> 
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="fifth_block_title">Titre du cinquième bloc *</label>
                                            <button type="button" class="btn btn-primary" id="fifth_block__Addnew" style="margin-bottom: 2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button> 
                                        </div> 
                                        <input type="text" name="fifth_block_title" id="fifth_block_title" class="form-control fifth_block_required">
                                        @error('fifth_block_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div> 
                                    <div class="form-group">
                                        <label for="fifth_block_description">Description du cinquième bloc *</label>
                                        <textarea  name="fifth_block_description" id="fifth_block_description" class="form-control fifth_block_required"></textarea> 
                                    </div> 
                                    <div class="blockWrap">
                                        <div class="form-group">
                                            <label for="fifth__title">Titre *</label>
                                            <input type="text" name="fifth__title[]" id="fifth__title" class="form-control fifth_block_required"> 
                                        </div>
                                        <div class="form-group">
                                            <label for="fifth__description">Description *</label>
                                            <textarea  name="fifth__description[]" id="fifth__description" class="form-control fifth_block_required"></textarea> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="fifth__image">Image *</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input fifth_block_required" id="fifth__image" accept="image/*" name="fifth__image[]">
                                                <label class="custom-file-label" for="fifth__image">{{ __('Choose a image') }}</label>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" name="sixth_block_status" data-block="sixth_block" data-required-class="sixth_block_required" class="custom-control-input blockStatusChange" id="sixth_block_status">
                                <label class="custom-control-label" for="sixth_block_status">Sixième bloc</label>
                            </div>
                            <div class="card sixth_block" style="display: none"> 
                                <div class="card-body" id="sixth_block__Wrap" style="background: rgb(239, 238, 238);"> 
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <label for="sixth_block_title">Titre du sixième bloc *</label>
                                            <button type="button" class="btn btn-primary" id="sixth_block__Addnew" style="margin-bottom: 2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                            </button> 
                                        </div> 
                                        <input type="text" name="sixth_block_title" id="sixth_block_title" class="form-control sixth_block_required">
                                        @error('sixth_block_title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>  
                                    <div class="blockWrap">
                                        <div class="form-group">
                                            <label for="sixth__title">Titre *</label>
                                            <input type="text" name="sixth__title[]" id="sixth__title" class="form-control sixth_block_required"> 
                                        </div>
                                        <div class="form-group">
                                            <label for="sixth__description">Description *</label>
                                            <textarea  name="sixth__description[]" id="sixth__description" class="form-control sixth_block_required"></textarea> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="sixth__image">Image *</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input sixth_block_required" id="sixth__image" accept="image/*" name="sixth__image[]">
                                                <label class="custom-file-label" for="sixth__image">{{ __('Choose a image') }}</label>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <br>
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
                        <label for="third__image">Image*</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input third_block_required" id="third__image" accept="image/*" name="third__image[]" required>
                            <label class="custom-file-label" for="third__image">{{ __('Choose a image') }}</label>
                        </div> 
                    </div> 
                </div>
                `);

                $('.blockWrap').slideDown();
            });
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
                        <label for="fifth__image">Image*</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input fifth_block_required" id="fifth__image" accept="image/*" name="fifth__image[]" required>
                            <label class="custom-file-label" for="fifth__image">{{ __('Choose a image') }}</label>
                        </div> 
                    </div> 
                </div>
                `);

                $('.blockWrap').slideDown();
            });
            $('body').on('click', '#sixth_block__Addnew', function(){
                $("#sixth_block__Wrap").append(`
                <div class="blockWrap"  style="display:none">
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <label for="sixth__title">Titre *</label>
                            <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </div>
                        <input type="text" name="sixth__title[]" id="sixth__title" class="form-control sixth_block_required" required> 
                    </div>
                    <div class="form-group">
                        <label for="sixth__description">Description *</label>
                        <textarea  name="sixth__description[]" id="sixth__description" class="form-control sixth_block_required" required></textarea> 
                    </div> 
                    <div class="form-group">
                        <label for="sixth__image">Image*</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input sixth_block_required" id="sixth__image" accept="image/*" name="sixth__image[]" required>
                            <label class="custom-file-label" for="sixth__image">{{ __('Choose a image') }}</label>
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