@if (role() == 's_admin')
    <div class="text-right">
        <button type="button" class="secondary-btn secondary-btn--cuccess border-0 mb-2 mr-2" data-toggle="modal" data-target="#prescriptionChantierNote">
            @if ($travaux->getPrescriptionChantierNote)
                Note éditée
            @else
                Ajouter une note
            @endif
        </button>
    </div>
@endif
<div class="modal modal--aside fade" id="prescriptionChantierNote" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content simple-bar border-0 h-100 rounded-0">
            <div class="modal-header border-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('prescription.chantier.note') }}" class="form mx-auto" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="note">Note</label>  
                        <input type="hidden" name="travaux_id" value="{{ $travaux->id }}">
                        <input type="hidden" name="id" value="{{ $travaux->getPrescriptionChantierNote->id ?? 0 }}">
                        {{-- @if ($travaux->getPrescriptionChantierNote)
                            <input type="hidden" name="id" value="{{ $travaux->getPrescriptionChantierNote->id }}">
                            <textarea name="note" id="note" class="form-control" rows="5" required>{{ $travaux->getPrescriptionChantierNote->note }}</textarea>
                        @else
                            <input type="hidden" name="id" value="0">
                            <textarea name="note" id="note" class="form-control" rows="5" required></textarea>
                        @endif --}} 
                        <div class="custom-editor-wrapper">
                            <div class="custom-editor">
                                {!! $travaux->getPrescriptionChantierNote->note ?? '' !!}
                            </div>
                            <input type="hidden" class="custom-editor-input" name="note" value="{{ $travaux->getPrescriptionChantierNote->note ?? '' }}">
                        </div>
                        @error('note')
                        <span class="text-danger">{{$message}}</span>
                        @enderror 
                    </div> 
                    <div class="form-group mt-4 d-flex justify-content-between">
                        <button type="submit"  class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Submit') }}</button> 
                        @if ($travaux->getPrescriptionChantierNote)
                            <button type="button" class="btn btn-danger rounded border-0 mb-3 shadow-none" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#prescriptionChantierNoteDelete">
                                <span class="novecologie-icon-trash mr-1"></span>
                                    Supprimer
                            </button> 
                        @endif
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@if ($travaux->getPrescriptionChantierNote)
    <div class="modal modal--aside fade" id="prescriptionChantierNoteDelete" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body text-center pt-0">
                    <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                    <span>{{ __('Are You Sure To Delete this') }} ?</span>
                    <form action="{{ route('prescription.chantier.note.delete') }}" method="POST">
                        @csrf 
                        <input type="hidden" name="travaux_id" value="{{ $travaux->id }}">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="primary-btn primary-btn--danger primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                Annuler
                            </button>
                            <button type="submit" class="primary-btn btn-danger primary-btn--md rounded border-0 my-3 mx-1">
                                Confirmer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<table class="table database-table w-100 mb-0">
    <thead class="database-table__header">
        <tr>
            <th>{{ __('Serial') }}</th>  
            <th>{{ __('Title') }}</th> 
            <th>{{ 'Input Type' }}</th>  
            <th>order</th>  
            <th class="text-center">{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody class="database-table__body">
        @forelse ($travaux->travauxQuestion as $input)
        <tr> 
            <td>{{ $loop->iteration }}</td>
            <td>{{ $input->title }}</td>
            <td> 
                @if ($input->type == 'text')
                {{ __('Text') }}
                @elseif ($input->type == 'number')
                {{ __('Number') }}
                @elseif ($input->type == 'email')
                {{ __('Email') }}
                @elseif ($input->type == 'radio')
                {{ __('Radio') }}
                @elseif ($input->type == 'checkbox')
                {{ __('Checkbox') }}
                @elseif ($input->type == 'select')
                {{ __('Dropdown') }}
                @else
                {{ __('Textarea') }} 
                @endif 
            </td>
            <td>
                {{ $input->order }}
            </td>
            {{-- <td>{{ $input->options }}</td> --}}
            <td class="text-center">
                <div class="dropdown dropdown--custom p-0 d-inline-block">
                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">  
                        @if (checkAction(Auth::id(), 'general__setting-question', 'edit') || role() == 's_admin')
                            <button  type="button" class="dropdown-item border-0"  data-toggle="modal" data-target="#question_edit{{ $input->id }}">
                                <span class="novecologie-icon-edit mr-1"></span>
                                {{ __('Edit') }}
                            </button> 
                        @else
                            <button  type="button" class="dropdown-item border-0">
                                <span class="novecologie-icon-lock py-1"></span> {{ __('Edit') }}
                            </button> 
                        @endif 
                        @if (checkAction(Auth::id(), 'general__setting-question', 'delete') || role() == 's_admin')
                            <button type="button" class="dropdown-item border-0 question_input_delete_btn" data-id="{{ $input->id }}" data-travaux="{{ $input->travaux }}">
                                <span class="novecologie-icon-trash mr-1"></span> 
                                    {{ __('Delete') }} 
                            </button>
                        @else
                            <button type="button" class="dropdown-item border-0"> 
                                <span class="novecologie-icon-lock py-1"></span> {{ __('Delete') }} 
                            </button> 
                        @endif 
                    </div>
                </div>
            </td>
        </tr>  							
        @empty
        <tr>
            <td  class="text-center" colspan="5">{{ __('No Question Found') }}</td>
        </tr>
        @endforelse
    </tbody>
</table> 