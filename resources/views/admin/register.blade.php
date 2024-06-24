{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title')
 	{{ __('Sign Up') }}
@endsection

 

{{-- Main Content Part  --}}
@section('content')
    <!-- Banner Section -->
    <section class="banner section-gap position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9">
                    <div class="banner__card bg-white">
                        <form action="{{ route('user.register') }}" class="form mx-auto"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <h1 class="form__title position-relative text-center">Nouvel Utilisateur</h1>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Prenom <span class="text-danger">*</span></label>
                                        {{-- <span class="novecologie-icon-envelope form-group__icon position-absolute"></span> --}}
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control shadow-none" placeholder="Prenom">
                                        @error('name')
                                            <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="f_name" class="form-label">Nom</label>
                                        <input type="text" id="f_name" name="first_name" value="{{ old('first_name') }}" class="form-control shadow-none" placeholder="Nom">
                                        @error('first_name')
                                            <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror 
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="role_id" class="form-label">Sélectionner rôle<span class="text-danger">*</span></label>
                                        <select name="role_id" id="role_id" class="custom-select shadow-none form-control" required>
                                            <option value="" selected>{{ __('Select') }}</option>
                                            @foreach ($categories as $category)
                                                <optgroup label="{{ $category->name }}">
                                                    @foreach ($category->role as $role)
                                                    <option {{ old('role_id') == $role->id ? 'selected':''  }} value="{{ $role->id }}">{{ $role->name }}</option>                                            
                                                    @endforeach 
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                            <div class=" invalid-feedback d-block text-danger">{{ $message }}</div>
                                        @enderror 
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control shadow-none" placeholder="Email" required>
                                        @error('email')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label d-block">{{ __('Password') }} <span class="text-danger">*</span></label>
                                    <div class="form-group d-flex flex-column align-items-center position-relative"> 
                                        <input type="password" id="password" name="password" class="form-control form-control--password shadow-none" placeholder="{{ __('Password') }}" required>
                                        <button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
                                            <span class="password-toggler__icon novecologie-icon-eye"></span>
                                        </button> 
                                        @error('password')
                                            <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="con_password" class="form-label d-block">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                    <div class="form-group d-flex flex-column align-items-center position-relative"> 
                                        <input type="password" id="con_password" name="confirm_password" class="form-control form-control--password shadow-none" placeholder="{{ __('Confirm Password') }}" required>
                                        <button type="button" class="form-group__password-toggler position-absolute bg-transparent border-0">
                                            <span class="password-toggler__icon novecologie-icon-eye"></span>
                                        </button>
                                        @error('confirm_password')
                                            <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="email_professional" class="form-label">Email professionnel</label>
                                        <input type="email" id="email_professional" name="email_professional" value="{{ old('email_professional') }}" class="form-control shadow-none" placeholder="Email professionnel">
                                        @error('email_professional')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"> 
                                        <label for="phone_professional" class="form-label">Téléphone professionnel</label>
                                        <input type="text" id="phone_professional" name="phone_professional" value="{{ old('phone_professional') }}" class="form-control shadow-none" placeholder="Téléphone professionnel">
                                        @error('phone_professional')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group"> 
                                        <label for="prenom_professional" class="form-label">Prénom professionnel</label>
                                        <input type="text" id="prenom_professional" name="prenom_professional" value="{{ old('prenom_professional') }}" class="form-control shadow-none" placeholder="Prénom professionnel">
                                        @error('prenom_professional')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="avator_photo" class="form-label d-block">Photo</label>
                                    <div class="input-group mb-3"> 
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input" id="avator_photo">
                                            <label class="custom-file-label" for="avator_photo">Ajouter photo</label>
                                        </div>
                                    </div>
                                    @error('photo')
                                        <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="form-group"> 
                                <input type="text" name="team_leader" id="team_leader" readonly class="form-control shadow-none" placeholder="{{ __('Team Leader') }}">
                                @error('team_leader')
                                    <div class="text-danger invalid-feedback d-block">{{ $message }}</div>
                                @enderror 
                            </div> --}}
                            <div class="form-group d-flex align-items-center justify-content-between"> 
                                <label for="regie_id" class="form-label">{{ __('Regie') }}</label>
                                <label class="switch-checkbox ml-2">
                                    <input type="checkbox" class="switch-checkbox__input" {{ old('regie') ? 'checked':'' }} name="regie" id="regieCheckbox">
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                            <div class="form-group" style="display: {{ old('regie')? '':'none' }}" id="regieBlock">  
                                <select name="regie_id" id="regie_id" class="custom-select shadow-none form-control">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($regies as $regie)
                                    <option {{ old('regie_id') == $regie->id ? "selected":'' }} value="{{ $regie->id }}">{{ $regie->name }}</option>                                            
                                    @endforeach 
                                </select>
                                @error('regie_id')
                                    <div class=" invalid-feedback d-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between"> 
                                <label for="team_leader" class="form-label">Chef d’Équipe</label>
                                <label class="switch-checkbox ml-2">
                                    <input type="checkbox" class="switch-checkbox__input" {{ old('teamLeader') ? 'checked':'' }} name="teamLeader" id="teamLeaderCheckbox">
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div>
                            <div class="form-group" style="display: {{ old('teamLeader')? '':'none' }}" id="teamLeaderBlock">  
                                <select name="team_leader" id="team_leader" class="custom-select shadow-none form-control">
                                    <option value="" selected>{{ __('Select') }}</option>
                                    @foreach ($team_leader as $leader)
                                    <option {{ old('team_leader') == $leader->id ? 'selected':''  }} value="{{ $leader->id }}">{{ $leader->name }}</option>                                         
                                    @endforeach 
                                </select>
                                @error('team_leader')
                                    <div class=" invalid-feedback d-block text-danger">{{ $message }}</div>
                                @enderror 
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between"> 
                                <label for="" class="form-label">{{ __('Active') }}</label>
                                <label class="switch-checkbox ml-2">
                                    <input type="checkbox" class="switch-checkbox__input" {{ old('status') ? 'checked':'' }} name="status">
                                    <span class="switch-checkbox__label"></span>
                                </label>
                            </div> 
                            <div class="form-group d-flex flex-column align-items-center mt-4"> 
                                <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3">{{ __('Register') }}</button>
                                {{-- @if (checkAction(Auth::id(), 'user', 'view') || role() == 's_admin')  
                                    <a class="primary-btn primary-btn--primary primary-btn--lg rounded-pill border-0 mb-3" href="{{ route('user.all') }}">
                                        <span class="novecologie-icon-user mr-2"></span>
                                        {{ __('View All Users') }}
                                    </a> 
                                @endif  --}}
                            </div>
                        </form>
                        {{-- <div class="text-center">
                            <div class="multi-option-switch">
                                <div class="multi-option-switch__body">
                                    <input type="radio" data-multi-switch-input="switch--off" class="multi-option-switch__input" id="switch--off" name="multi-option-switch">
                                    <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input" id="switch--disabled" name="multi-option-switch" checked>
                                    <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input" id="switch--on" name="multi-option-switch" >
                                    <span class="multi-option-switch__float-indicator"></span>
                                    <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="switch--off">
                                        <span class="multi-option-switch__label__btn">
                                            <i class="bi bi-x-lg"></i>
                                        </span>
                                    </label>
                                    <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="switch--disabled">
                                        <span class="multi-option-switch__label__btn">
                                            <i class="bi bi-circle"></i>
                                        </span>
                                    </label>
                                    <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="switch--on">
                                        <span class="multi-option-switch__label__btn">
                                            <i class="bi bi-check-lg"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="multi-option-switch">
                                <div class="multi-option-switch__body">
                                    <input type="radio" data-multi-switch-input="switch--off" class="multi-option-switch__input" id="switch--off--2" name="multi-option-switch--2">
                                    <input type="radio" data-multi-switch-input="switch--disabled" class="multi-option-switch__input" id="switch--disabled--2" name="multi-option-switch--2" checked>
                                    <input type="radio" data-multi-switch-input="switch--on" class="multi-option-switch__input" id="switch--on--2" name="multi-option-switch--2">
                                    <span class="multi-option-switch__float-indicator"></span>
                                    <label class="multi-option-switch__label" data-multi-switch-label="switch--off" for="switch--off--2">
                                        <span class="multi-option-switch__label__btn">
                                            <i class="bi bi-x-lg"></i>
                                        </span>
                                    </label>
                                    <label class="multi-option-switch__label" data-multi-switch-label="switch--disabled" for="switch--disabled--2">
                                        <span class="multi-option-switch__label__btn">
                                            <i class="bi bi-circle"></i>
                                        </span>
                                    </label>
                                    <label class="multi-option-switch__label" data-multi-switch-label="switch--on" for="switch--on--2">
                                        <span class="multi-option-switch__label__btn">
                                            <i class="bi bi-check-lg"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')
 <script>
    $(document).ready(function(){
        // $('#regie_id').change(function(){
        //     $('#team_leader').val($("#regie_id :selected").attr('data-lead_name'));
        // }); 
        $('#regieCheckbox').click(function(){
            if(this.checked){
				$("#regieBlock").slideDown();
			}else{
				$("#regieBlock").slideUp();
			}
        })
        $('#teamLeaderCheckbox').click(function(){
            if(this.checked){
				$("#teamLeaderBlock").slideDown();
			}else{
				$("#teamLeaderBlock").slideUp();
			}
        })
        // $('#role_id').change(function(){
        //     console.log($(this).val());
        //     if($(this).val() == 7 || $(this).val() == 8){
        //         $('#regie_id').prop('required', true); 
        //     }else{
        //         $('#regie_id').prop('required', false);    
        //     } 
        //     if($(this).val() == 2){
        //         $('#teamLeadHimSelf').slideDown(); 
        //     }else{
        //         $('#teamLeadHimSelf').slideUp(); 
        //     } 

        // }); 
    });
 </script>
@endpush




















