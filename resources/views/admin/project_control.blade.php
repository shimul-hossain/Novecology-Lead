@if ($project_control_photos->where('tag_id', $travaux_id)->count() > 0)
<div class="card">
    <div class="card-body" style="background-color: #F2F2F2">
        <div class="row">
            @foreach ($project_control_photos->where('tag_id', $travaux_id) as $project_control_photo) 
                <div class="col-12  mt-3"> 
                    <h4 class="mb-0 mr-2">{{ $project_control_photo->name }}</h4>
                    {{-- <label class="switch-checkbox">  
                        <input type="checkbox" name="project_control_photo[{{ $travaux_number }}][]" value="{{ $project_control_photo->id }}" class="switch-checkbox__input intervention_disabled">
                        <span class="switch-checkbox__label"></span>
                    </label> --}}

                    <select name="project_control_photo[{{ $travaux_number }}][{{ $project_control_photo->id }}]" class="select2_select_option form-control intervention_disabled">
                        <option value="" selected>{{ __('Select') }}</option>
                        <option value="Oui">Oui</option>
                        <option value="Non">Non</option> 
                        <option value="Non verifiable">Non verifiable</option> 
                    </select> 
                </div> 
            @endforeach
        </div>
    </div>  
</div>  
@endif