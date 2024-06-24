<div class="form-group">
    <label class="form-label">Département</label>
    <input type="text" readonly value="{{ getDepartment2($project->Code_Postal) }}" class="form-control shadow-none px-3">
</div>
<div class="form-group">
    <label class="form-label">Travaux</label>
    <select disabled class="select2_select_option shadow-none form-control" multiple> 
         @foreach ($project->ProjectTravaux as $travaux)
           <option selected>{{ $travaux->travaux }}</option>  
         @endforeach
    </select> 
</div>
<div class="form-group">
    <label class="form-label">TAG</label>
    <select disabled class="select2_select_option shadow-none form-control" multiple> 
        @foreach ($project->ProjectTravauxTags as $tag)
            <option selected>{{ $tag->tag }}</option>  
        @endforeach
    </select> 
</div> 
<div class="form-group">
    <label class="form-label">Gestionnaire projet</label>
    <select disabled class="select2_select_option shadow-none form-control"> 
        @if ($project->projectGestionnaire)
            <option selected>{{ $project->projectGestionnaire->name }}</option>  
        @endif
    </select>
</div>
<div class="form-group">
    <label class="form-label">Telecommercial projet</label>
    <select disabled class="select2_select_option shadow-none form-control">
        @if ($project->getProjectTelecommercial)
            <option selected>{{ $project->getProjectTelecommercial->name }}</option>  
        @endif
    </select>
</div>
<div class="form-group">
    <label class="form-label">Responsable Commercial</label>
    <select disabled class="select2_select_option shadow-none form-control">
        @if ($project->getProjectTelecommercial && $project->getProjectTelecommercial->getRegie)
            <option selected>{{ $project->getProjectTelecommercial->getRegie->getUser->name ?? '' }} ({{ $project->getProjectTelecommercial->getRegie->name }})</option>  
        @endif
    </select>
</div>