<div class="modal modal--aside fade" id="newTaskEditModal" tabindex="-1" aria-labelledby="mnewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <h1 class="form__title position-relative text-center mb-3">Modifier une tâche</h1>
                <form action="{{ route('new.task.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $task->id }}">

                    <div class="form-group">
                        <label class="form-label">Type *</label>
                        <select name="task_type" class="select2_select_option form-control w-100 taskTypeChange" id="taskTypeChange{{ $task->id }}" data-id="{{ $task->id }}" required>
                            <option value="" selected>{{ __('Select') }}</option>
                            <option {{ $task->type == 'Prospect' ? 'selected':'' }} value="Prospect">Prospect</option> 
                            <option {{ $task->type == 'Chantier' ? 'selected':'' }} value="Chantier">Chantier</option>
                        </select>
                    </div>
                    @if ($task->type == 'Prospect')     
                        <div class="form-group"  id="typeChangeWrap{{ $task->id }}">
                            <label class="form-label">Prospect *</label>
                            <select name="project_id" class="select2_select_option form-control w-100 projectChange" data-id="{{ $task->id }}" required>
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($lead_items as $lead_item)
                                    <option {{ $task->project_id == $lead_item->id ? 'selected':'' }} value="{{ $lead_item->id }}">{{ $lead_item->Prenom.' '.$lead_item->Nom }} - {{ $lead_item->LeadTravaxTags()->count() > 0 ? implode(', ', $lead_item->LeadTravaxTags->pluck('tag')->toArray()) : '' }} - {{ $lead_item->Code_Postal }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div id="projectChangeWrap{{ $task->id }}">
                            @if ($task->getLead)
                                <div class="form-group">
                                    <label class="form-label">Département</label>
                                    <input type="text" readonly value="{{ getDepartment2($task->getLead->Code_Postal) }}" class="form-control shadow-none px-3">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Travaux</label>
                                    <select disabled class="select2_select_option shadow-none form-control" multiple>
                                        @foreach ($task->getLead->LeadTravax as $travaux)
                                        <option selected>{{ $travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">TAG</label>
                                    <select disabled class="select2_select_option shadow-none form-control" multiple>
                                        @foreach ($task->getLead->LeadTravaxTags as $travaux)
                                        <option selected>{{ $travaux->tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="form-label">Département</label>
                                    <input type="text" disabled class="form-control shadow-none px-3">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Travaux</label>
                                    <select disabled class="select2_select_option shadow-none form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">TAG</label>
                                    <select disabled class="select2_select_option shadow-none form-control">
                                    </select>
                                </div>
                            @endif
                        </div> 
                    @elseif ($task->type == 'Chantier')
                        <div class="form-group"  id="typeChangeWrap{{ $task->id }}">
                            <label class="form-label">Chantier *</label>
                            <select name="project_id" class="select2_select_option form-control w-100 projectChange" data-id="{{ $task->id }}" required>
                                <option value="" selected>{{ __('Select') }}</option>
                                @foreach ($project_items as $project_item)
                                    <option {{ $task->project_id == $project_item->id ? 'selected':'' }} value="{{ $project_item->id }}">{{ $project_item->Prenom.' '.$project_item->Nom }} - {{ $project_item->ProjectTravauxTags()->count() > 0 ? implode(', ', $project_item->ProjectTravauxTags->pluck('tag')->toArray()) : '' }} - {{ $project_item->Code_Postal }}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div id="projectChangeWrap{{ $task->id }}">
                            @if ($task->getProject)
                                <div class="form-group">
                                    <label class="form-label">Département</label>
                                    <input type="text" readonly value="{{ getDepartment2($task->getProject->Code_Postal) }}" class="form-control shadow-none px-3">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Travaux</label>
                                    <select disabled class="select2_select_option shadow-none form-control" multiple>
                                        @foreach ($task->getProject->ProjectTravaux as $travaux)
                                        <option selected>{{ $travaux->travaux }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">TAG</label>
                                    <select disabled class="select2_select_option shadow-none form-control" multiple>
                                        @foreach ($task->getProject->ProjectTravauxTags as $travaux)
                                        <option selected>{{ $travaux->tag }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="form-label">Département</label>
                                    <input type="text" disabled class="form-control shadow-none px-3">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Travaux</label>
                                    <select disabled class="select2_select_option shadow-none form-control">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">TAG</label>
                                    <select disabled class="select2_select_option shadow-none form-control">
                                    </select>
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="shadow-none form-control" placeholder="Écrivez votre description">{{  $task->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Statut</label>
                        <select name="status" id="" class="select2_select_option form-control w-100">
                            <option {{ $task->status == 'Terminé' ? 'selected' : '' }} value="Terminé">Terminé</option>
                            <option {{ $task->status == 'En traitement' ? 'selected' : '' }} value="En traitement">En traitement</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0">
                            {{ __('Submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>