@extends('backoffice.app')

@section('historyIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Notre histoire
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
                    <li class="breadcrumb-item">Notre histoire</li>
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
                        <h4 class="card-title">Notre histoire</h4>
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
                        <form action="{{ route('backoffice.history.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <div class="form-group">
                                <label for="first_block_title">Titre du premier bloc *</label>
                                <input type="text" name="first_block_title" id="first_block_title" class="form-control" value="{{ $history->first_block_title }}" >
                                @error('first_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="first_block_description">Description du premier bloc *</label>
                                <textarea  name="first_block_description" id="first_block_description" class="form-control" >{{ $history->first_block_description }}</textarea>
                                @error('first_block_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            @if ($history->first_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/history')}}/{{ $history->first_block_image }}" alt="history image">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="first_block_image">Image du premier bloc</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="first_block_image" accept="image/*" name="first_block_image">
                                    <label class="custom-file-label" for="first_block_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('first_block_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>   
                              
                            <div class="form-group">
                                <label for="second_block_title">Titre du deuxième bloc *</label>
                                <input type="text" name="second_block_title" id="second_block_title" class="form-control" value="{{ $history->second_block_title }}" >
                                @error('second_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="second_block_description">Description du deuxième bloc *</label>
                                <textarea  name="second_block_description" id="second_block_description" class="form-control" >{{ $history->second_block_description }}</textarea>
                                @error('second_block_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div> 
                            @if ($history->second_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/history')}}/{{ $history->second_block_image }}" alt="history image">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="second_block_image">Image du deuxième bloc</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="second_block_image" accept="image/*" name="second_block_image">
                                    <label class="custom-file-label" for="second_block_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('second_block_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>   
                              
                            <div class="form-group">
                                <label for="third_block_title">Titre du troisième bloc *</label>
                                <input type="text" name="third_block_title" id="third_block_title" class="form-control" value="{{ $history->third_block_title }}" >
                                @error('third_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="third_block_description">Description du troisième bloc *</label>
                                <textarea  name="third_block_description" id="third_block_description" class="form-control" >{{ $history->third_block_description }}</textarea>
                                @error('third_block_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 

                            @if ($history->third_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/history')}}/{{ $history->third_block_image }}" alt="history image">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="third_block_image">Image du troisième bloc</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="third_block_image" accept="image/*" name="third_block_image">
                                    <label class="custom-file-label" for="third_block_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('third_block_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>   
                              
                            <div class="card-body" id="third_block__Wrap" style="background: rgb(239, 238, 238);">  
                                @foreach ($infos as $third_block_info)
                                    <div class="blockWrap">   
                                        <input type="hidden" name="x_third_block_id[]" value="{{ $third_block_info->id }}">
                                        <div class="form-group"> 
                                            @if ($loop->first)
                                                <div class="alert alert-warning">
                                                    <div class="alert-body">
                                                        <a target="_blank" href="https://fontawesome.com/search?o=r&m=free" class="text-warning">Go to fontawesome website for add icons</a>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="d-flex align-items-center justify-content-between">
                                                <label for="icon{{ $third_block_info->id }}">Lien d'icône *</label>
                                                @if (!$loop->first)
                                                    <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                    </button>
                                                @else
                                                <button type="button" class="btn btn-primary" id="third_block__Addnew" style="margin-bottom: 2px">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                                </button>
                                                @endif
                                            </div>
                                            <input type="text" name="icon[{{ $third_block_info->id }}]" id="icon{{ $third_block_info->id }}" value="{{ $third_block_info->icon }}" class="form-control third_block_" > 
                                        </div>
                                        <div class="form-group">
                                            <label for="description{{ $third_block_info->id }}">Description *</label>
                                            <textarea  name="description[{{ $third_block_info->id }}]" id="description{{ $third_block_info->id }}" class="form-control third_block_" >{{ $third_block_info->description }}</textarea> 
                                        </div>  
                                    </div> 
                                @endforeach
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
                            <label for="icon">Lien d'icône *</label>
                            <button type="button" class="btn btn-danger removedBtn"  style="margin-bottom: 2px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            </button>
                        </div>
                        <input type="text" name="icon[]" id="icon" class="form-control third_block_" > 
                    </div>
                    <div class="form-group">
                        <label for="description">Description *</label>
                        <textarea  name="description[]" id="description" class="form-control third_block_" ></textarea> 
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