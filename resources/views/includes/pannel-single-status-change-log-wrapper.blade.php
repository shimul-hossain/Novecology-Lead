<tr> 
    <td style="white-space: inherit;">  
        <div class="d-sm-flex align-items-center">
            <a href="#!" class="avatar-group__image-wrapper d-inline-block flex-shrink-0 rounded-circle overflow-hidden mr-2 mb-2 mb-sm-0" style="width: 45px; height: 45px;" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($activity->user_id)->name }}">
                @if($activity->getUser->profile_photo)  
                <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $activity->getUser->profile_photo }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                @else
                <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                @endif
            </a> 
            <div class="row w-100">
                <div class="col-md-4">
                    <p class="mb-1"> 
                        @if ($activity->key == 'etiquette') 
                            {{ $activity->getUser->name }} change l'étiquette de  
                            @else 
                            {{ $activity->getUser->name }} change statut de    
                        @endif
                    </p> 
                    <small>{{ \Carbon\Carbon::parse($activity->created_at)->format('d-m-Y, h:i a') }}</small> 
                </div>
                <div class="col-md-auto mt-3 mt-md-0">
                    @if ($activity->feature_type == 'lead')
                        @if ($activity->key == 'etiquette')
                            <div class="arrow-btn-group">
                                <button type="button" class="arrow-btn" style="color: {{ $activity->leadPrevStatus->background_color }}">
                                    <span class="arrow-btn__text">{{ $activity->leadPrevStatus->status }}</span> 
                                </button>
                                &nbsp;&nbsp;&nbsp; a &nbsp;
                                <button type="button" class="arrow-btn" style="color: {{ $activity->leadStatus->background_color }}">
                                    <span class="arrow-btn__text">{{ $activity->leadStatus->status }}</span> 
                                </button>
                                @if ($activity->label_id == 5)
                                    <button class="ml-3 primary-btn primary-btn--pink primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0"> Raison : {{ $activity->dead_reason }} </button>
                                @endif
                            </div>
                        @else   
                            <button data-toggle="modal" style="background-color:{{ $activity->leadPrevSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->leadPrevSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                {{ $activity->leadPrevSubStatus->name ?? 'Nouvelle demande' }}
                            </button> 
                            &nbsp; a &nbsp;
                            <button data-toggle="modal" style="background-color:{{ $activity->leadSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->leadSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                {{ $activity->leadSubStatus->name ?? 'supprimé' }} 
                            </button> 
                        @endif
                    @else
                        @if ($activity->key == 'etiquette')
                            <div class="arrow-btn-group">
                                <button type="button" class="arrow-btn" style="color: {{ $activity->projectPrevStatus->background_color }}">
                                    <span class="arrow-btn__text">{{ $activity->projectPrevStatus->status }}</span> 
                                </button>
                                &nbsp;&nbsp;&nbsp; a &nbsp;
                                <button type="button" class="arrow-btn" style="color: {{ $activity->projectStatus->background_color }}">
                                    <span class="arrow-btn__text">{{ $activity->projectStatus->status }}</span> 
                                </button>
                            </div>
                            @if ($activity->label_id == 7)
                                <button class="ml-3 primary-btn primary-btn--pink primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0"> Raison : {{ $activity->dead_reason }} </button>
                            @endif
                        @else   
                            <button data-toggle="modal" style="background-color:{{ $activity->projectPrevSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->projectPrevSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                {{ $activity->projectPrevSubStatus->name ?? 'Nouvelle demande' }}
                            </button> 
                            &nbsp; a &nbsp;
                            <button data-toggle="modal" style="background-color:{{ $activity->projectSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->projectSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                {{ $activity->projectSubStatus->name ?? 'supprimé' }} 
                            </button> 
                        @endif 
                    @endif
                </div> 
                <div class="col-md-auto mt-3 mt-md-0 d-flex align-items-center">
                    @if ($activity->feature_type == 'lead')
                    <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom  : 'Inconnue'}}: Prospect</span>
                    @else
                    <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom  : 'Inconnue' }}: Chantier</span> 
                    @endif
                </div>
            </div>
        </div> 
    </td> 
</tr> 