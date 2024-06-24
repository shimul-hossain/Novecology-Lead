@extends('backoffice.app')

@section('auditEnergetiqueIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Audit énergétique
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
                    <li class="breadcrumb-item">Audit énergétique</li>
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
                        <h4 class="card-title">Audit énergétique</h4>
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
                        <form action="{{ route('backoffice.audit-energetique.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <div class="form-group">
                                <label for="banner_title">Titre de la bannière *</label>
                                <input type="text" name="banner_title" id="banner_title" class="form-control" value="{{ $item->banner_title }}" >
                                @error('banner_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="banner_subtitle">Sous-titre de la bannière *</label>
                                <textarea  name="banner_subtitle" id="banner_subtitle" class="form-control" >{{ $item->banner_subtitle }}</textarea>
                                @error('banner_subtitle')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="banner_description">Description de la bannière *</label>
                                <textarea  name="banner_description" id="banner_description" class="form-control" >{{ $item->banner_description }}</textarea>
                                @error('banner_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="banner_button_text">Texte du bouton de bannière *</label>
                                <input type="text" name="banner_button_text" id="banner_button_text" class="form-control" value="{{ $item->banner_button_text }}" >
                                @error('banner_button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="banner_button_link">Lien vers le bouton bannière </label>
                                <input type="text" name="banner_button_link" id="banner_button_link" class="form-control" value="{{ $item->banner_button_link }}" >
                                @error('banner_button_link')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            @if ($item->banner_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/audit-energetique')}}/{{ $item->banner_image }}" alt="audit-energetique image">
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
                                <label for="title">Titre *</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}" >
                                @error('title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description *</label>
                                <textarea  name="description" id="description" class="form-control" >{{ $item->description }}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>   
                            <div class="form-group">
                                <label for="first_block_title">Titre du premier bloc *</label>
                                <input type="text" name="first_block_title" id="first_block_title" class="form-control first_block_" value="{{ $item->first_block_title }}">
                                @error('first_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            @if ($item->first_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/audit-energetique')}}/{{ $item->first_block_image }}" alt="audit-energetique image">
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
                                <textarea  name="first_block_desciption" id="first_block_desciption" class="form-control first_block_">{{ $item->first_block_desciption }}</textarea>
                                @error('first_block_desciption')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="first_block_button_text">Premier bloc texte du bouton*</label>
                                <input type="text" name="first_block_button_text" id="first_block_button_text" class="form-control first_block_" value="{{ $item->first_block_button_text }}">
                                @error('first_block_button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first_block_button_link">Premier bloc lien du bouton</label>
                                <input type="text" name="first_block_button_link" id="first_block_button_link" class="form-control" value="{{ $item->first_block_button_link }}">
                                @error('first_block_button_link')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>  
                            <div class="form-group">
                                <label for="second_block_title">Titre du deuxième bloc *</label>
                                <input type="text" name="second_block_title" id="second_block_title" class="form-control second_block_"  value="{{ $item->second_block_title }}">
                                @error('second_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            @if ($item->second_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/audit-energetique')}}/{{ $item->second_block_image }}" alt="audit-energetique image">
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
                                <textarea  name="second_block_desciption" id="second_block_desciption" class="form-control second_block_" >{{ $item->second_block_desciption }}</textarea>
                                @error('second_block_desciption')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 

                            <div class="form-group">
                                <label for="second_block_button_text">Deuxième bloc texte du bouton*</label>
                                <input type="text" name="second_block_button_text" id="second_block_button_text" class="form-control second_block_"  value="{{ $item->second_block_button_text }}">
                                @error('second_block_button_text')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="second_block_button_link">Deuxième bloc lien du bouton</label>
                                <input type="text" name="second_block_button_link" id="second_block_button_link" class="form-control" value="{{ $item->second_block_button_link }}">
                                @error('second_block_button_link')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>   
                            <div class="card-body" id="third_block__Wrap" style="background: rgb(239, 238, 238);"> 
                                <div class="form-group">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label for="third_block_title">Titre du troisième bloc *</label>
                                        <button type="button" class="btn btn-primary" id="third_block__Addnew" style="margin-bottom: 2px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                        </button> 
                                    </div> 
                                    <input type="text" name="third_block_title" id="third_block_title" value="{{ $item->third_block_title }}" class="form-control third_block_" {{ $item->third_block_status == 'yes'? '':'' }}>
                                    @error('third_block_title')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> 
                                @forelse ($infos as $third_block_info)
                                <div class="blockWrap"> 
                                        <div class="form-group">
                                            <input type="hidden" name="x_third_block_id[]" value="{{ $third_block_info->id }}">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label for="third__title">Titre *</label>
                                                @if (!$loop->first)
                                                    <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                    </button>
                                                @endif
                                            </div>
                                            <input type="text" name="third__title[{{ $third_block_info->id }}]" id="third__title" value="{{ $third_block_info->title }}" class="form-control third_block_" > 
                                        </div>
                                        <div class="form-group">
                                            <label for="third__description">Description *</label>
                                            <textarea  name="third__description[{{ $third_block_info->id }}]" id="third__description" class="form-control third_block_" >{{ $third_block_info->description }}</textarea> 
                                        </div> 
                                        @if ($third_block_info->image)
                                            <div class="form-group">
                                                <label for="icon">Image existante</label>
                                                <br>
                                                <img width="200" src="{{asset('uploads/new/audit-energetique')}}/{{ $third_block_info->image }}" alt="audit-energetique image">
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
                                            <input type="text" name="third__title[]" id="third__title" class="form-control third_block_" {{ $item->third_block_status == 'yes'? '':'' }}> 
                                        </div>
                                        <div class="form-group">
                                            <label for="third__description">Description *</label>
                                            <textarea  name="third__description[]" id="third__description" class="form-control third_block_" {{ $item->third_block_status == 'yes'? '':'' }}></textarea> 
                                        </div> 
                                        <div class="form-group">
                                            <label for="third__image">Image *</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input third_block_" id="third__image" accept="image/*" name="third__image[]" {{ $item->third_block_status == 'yes'? '':'' }}>
                                                <label class="custom-file-label" for="third__image">{{ __('Choose a image') }}</label>
                                            </div> 
                                        </div> 
                                    </div>
                                @endforelse
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
                        <input type="text" name="third__title[]" id="third__title" class="form-control third_block_" > 
                    </div>
                    <div class="form-group">
                        <label for="third__description">Description *</label>
                        <textarea  name="third__description[]" id="third__description" class="form-control third_block_" ></textarea> 
                    </div> 
                    <div class="form-group">
                        <label for="third__image">Image *</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input third_block_" id="third__image" accept="image/*" name="third__image[]" >
                            <label class="custom-file-label" for="third__image">{{ __('Choose a image') }}</label>
                        </div> 
                    </div> 
                </div>
                `);

                $('.blockWrap').slideDown();
            }); 
            $('body').on('click', '.removedBtn', function(){
                $(this).closest('.blockWrap').slideUp(function(){
                    $(this).remove();
                })
            }); 
        });
    </script>
@endsection