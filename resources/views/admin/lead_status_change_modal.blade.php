<div class="modal modal--aside fade" id="lead_status__change" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <span>Confirmer le nouvelle etiquette de votre prospect</span>
                <form action="{{ route('lead.status.change') }}" method="POST" class="status_change__modal">
                    @csrf
                    <input type="hidden" name="id" value="{{ $lead->id }}">
                    <div class="status_change__btn_block">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
                                Non
                            </button>
                            <button type="button" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1 status_change__btn">
                                Oui
                            </button>
                        </div>
                    </div>
                    <div class="status_change__input text-left" style="display: none">
                        <div class="form-group mt-3">
                            <label class="form-label" for="lead_staus_new{{ $lead->id }}">Merci de renseigner le nouveau etiquette de votre prospect</label>
                            <select name="status" id="lead_staus_new{{ $lead->id }}" data-id="{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control lead_staus__change" required>
                                <option value="" selected disabled>{{ __('Select') }}</option>
                                <option {{ $lead->lead_label == 2 ? 'selected':'' }} value="2">Nouveau</option>
                                <option {{ $lead->lead_label == 3 ? 'selected':'' }} value="3">En cours</option>
                                <option {{ $lead->lead_label == 4 ? 'selected':'' }} value="4">NRP</option>
                                <option {{ $lead->lead_label == 5 ? 'selected':'' }} value="5">KO</option>
                                <option {{ $lead->lead_label == 6 ? 'selected':'' }}  
                                    @if (!$lead->leadTelecommercial || !$lead->Type_de_contrat)
                                        disabled
                                    @endif
                                     value="6">Validation
                                     @if (!$lead->leadTelecommercial)
                                        Pas de télécommercial
                                    @elseif (!$lead->Type_de_contrat)
                                        Le type de contrat est vide
                                    @endif</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="lead_sub_staus_new{{ $lead->id }}">Merci de renseigner le nouveau statut de votre prospect</label>
                            <select name="sub_status" id="lead_sub_staus_new{{ $lead->id }}" class="select2_select_option custom-select shadow-none form-control" required>
                                <option value="" selected disabled>{{ __('Select') }}</option>
                                @if ($status == 2)
                                    <option selected value="0">Nouvelle demande</option>	
                                @endif
                                @foreach ($lead_sub_status as $sub_status)
                                    @if ($status == 6)
                                        @if ($sub_status->id == 25)
                                        <option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
                                        @endif 
                                        @if (\Auth::user()->getRoleName->category_id == 3 || \Auth::user()->getRoleName->category_id == 4)
                                            @if ($sub_status->id == 52 || $sub_status->id == 53 || $sub_status->id == 54 || $sub_status->id == 50 || $sub_status->id == 56)
                                                <option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
                                            @endif
                                        @endif
                                    @else
                                        @if ($sub_status->id != 5)
                                            <option {{ $lead->sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>	
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group dead_reason__wrap" style="display: {{ $status == '5' ? '':'none' }}">
                            <label class="form-label" for="dead-reason{{ $lead->id }}">Raisons</label>
                            <textarea rows="3" name="dead_reason" id="dead-reason{{ $lead->id }}" class="form-control shadow-none">{{ $lead->lead_ko_reason }}</textarea>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>