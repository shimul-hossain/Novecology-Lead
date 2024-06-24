@foreach ($rapplers as $rappler)
    <div class="modal modal--aside fade" id="rapplerStatusAddModal{{ $feature_type }}{{ $rappler->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body text-center pt-0">
                    <h1 class="form__title position-relative mb-4">Rappel type</h1>
                    <form action="{{ route('rappler.type.change') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="feature_id" value="{{ $rappler->id }}">
                        <input type="hidden" name="type" value="{{ $feature_type }}">
                        <input type="hidden" name="expired_date" value="{{ $rappler->callback_time }}">
                        <input type="hidden" name="callback_user_id" value="{{ $rappler->callback_user_id }}">
                        <div class="form-group">
                            <label for="#">Sélectionner une type</label>
                            <select class="shadow-none form-control" name="status" required>
                                <option value="" selected>{{ __('Select') }}</option>
                                <option value="Réalisé">Réalisé</option>
                                <option value="Reporté">Reporté</option>
                                <option value="Annulé">Annulé</option> 
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="primary-btn btn-success primary-btn--md rounded border-0 my-3 mx-1">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach