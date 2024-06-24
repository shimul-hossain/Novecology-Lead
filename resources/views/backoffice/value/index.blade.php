@extends('backoffice.app')

@section('valueIndex', 'active')

{{-- Title --}}
@section('title')
{{ config('app.name') }} | Nos valeurs
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
                    <li class="breadcrumb-item">Nos valeurs</li>
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
                        <h4 class="card-title">Nos valeurs</h4>
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
                        <form action="{{ route('backoffice.value.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf  
                            <div class="form-group">
                                <label for="first_block_title">Titre du premier bloc *</label>
                                <input type="text" name="first_block_title" id="first_block_title" class="form-control" value="{{ $value->first_block_title }}" >
                                @error('first_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="first_block_description">Description du premier bloc *</label>
                                <textarea  name="first_block_description" id="first_block_description" class="form-control" >{{ $value->first_block_description }}</textarea>
                                @error('first_block_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            @if ($value->first_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/value')}}/{{ $value->first_block_image }}" alt="value image">
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
                                <input type="text" name="second_block_title" id="second_block_title" class="form-control" value="{{ $value->second_block_title }}" >
                                @error('second_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="second_block_short_description">Brève description du deuxième bloc *</label>
                                <textarea  name="second_block_short_description" id="second_block_short_description" class="form-control" >{{ $value->second_block_short_description }}</textarea>
                                @error('second_block_short_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label for="second_block_long_description">Description longue du deuxième bloc *</label>
                                <textarea  name="second_block_long_description" id="second_block_long_description" class="form-control" >{{ $value->second_block_long_description }}</textarea>
                                @error('second_block_long_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            @if ($value->second_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/value')}}/{{ $value->second_block_image }}" alt="value image">
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
                                <input type="text" name="third_block_title" id="third_block_title" class="form-control" value="{{ $value->third_block_title }}" >
                                @error('third_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="third_block_short_description">Brève description du troisième bloc *</label>
                                <textarea  name="third_block_short_description" id="third_block_short_description" class="form-control" >{{ $value->third_block_short_description }}</textarea>
                                @error('third_block_short_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label for="third_block_long_description">Description longue du troisième bloc *</label>
                                <textarea  name="third_block_long_description" id="third_block_long_description" class="form-control" >{{ $value->third_block_long_description }}</textarea>
                                @error('third_block_long_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            @if ($value->third_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/value')}}/{{ $value->third_block_image }}" alt="value image">
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
                              
                            <div class="form-group">
                                <label for="fourth_block_title">Titre du quatrième bloc *</label>
                                <input type="text" name="fourth_block_title" id="fourth_block_title" class="form-control" value="{{ $value->fourth_block_title }}" >
                                @error('fourth_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="fourth_block_description">Description du quatrième bloc *</label>
                                <textarea  name="fourth_block_description" id="fourth_block_description" class="form-control" >{{ $value->fourth_block_description }}</textarea>
                                @error('fourth_block_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 

                            @if ($value->fourth_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/value')}}/{{ $value->fourth_block_image }}" alt="value image">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="fourth_block_image">Image du quatrième bloc</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fourth_block_image" accept="image/*" name="fourth_block_image">
                                    <label class="custom-file-label" for="fourth_block_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('fourth_block_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>  
                            
                            <div class="form-group">
                                <label for="fifth_block_title">Titre du cinquième bloc *</label>
                                <input type="text" name="fifth_block_title" id="fifth_block_title" class="form-control" value="{{ $value->fifth_block_title }}" >
                                @error('fifth_block_title')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                <label for="fifth_block_short_description">Brève description du cinquième bloc *</label>
                                <textarea  name="fifth_block_short_description" id="fifth_block_short_description" class="form-control" >{{ $value->fifth_block_short_description }}</textarea>
                                @error('fifth_block_short_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label for="fifth_block_long_description">Description longue du cinquième bloc *</label>
                                <textarea  name="fifth_block_long_description" id="fifth_block_long_description" class="form-control" >{{ $value->fifth_block_long_description }}</textarea>
                                @error('fifth_block_long_description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror 
                            </div>
                            @if ($value->fifth_block_image)
                                <div class="form-group">
                                    <label for="icon">Image existante</label>
                                    <br>
                                    <img width="200" src="{{asset('uploads/new/value')}}/{{ $value->fifth_block_image }}" alt="value image">
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="fifth_block_image">Image du cinquième bloc</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="fifth_block_image" accept="image/*" name="fifth_block_image">
                                    <label class="custom-file-label" for="fifth_block_image">{{ __('Choose a image') }}</label>
                                </div>
                                @error('fifth_block_image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
            
        });
    </script>
@endsection