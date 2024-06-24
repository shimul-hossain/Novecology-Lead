<div class="modal modal--aside fade" id="projectSubStatusChangeModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body text-center pt-0">
                <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                <form action="{{ route('project.status.change') }}" method="POST" class="status_change__modal">
                    @csrf
                    <input type="hidden" name="id" value="{{ $project->id }}">
                    <input type="hidden" name="status" value="{{ $project->project_label }}">
                    <div class="status_change__input text-left">
                        <div class="form-group text-left mt-3">
                            <label class="form-label" for="lead_staus_news{{ $project->id }}">Merci de renseigner le nouveau statut de votre chantier</label>
                            <select name="sub_status" id="lead_staus_news{{ $project->id }}" class="select2_color_option custom-select shadow-none form-control" data-placeholder="{{ __('Select') }}" required>
                                <option value="" selected>{{ __("Select") }}</option>
                                @foreach ($project_sub_status as $sub_status)
                                    <option data-color="{{ $sub_status->text_color }}" data-background="{{ $sub_status->background_color }}" {{ $project->project_sub_status == $sub_status->id ? 'selected':'' }} value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($project->project_label == 7)
                            <div class="form-group">
                                <label class="form-label" for="dead-reason">Raisons <span class="text-danger">*</span></label>
                                <textarea rows="3" name="dead_reason"  id="dead-reason" class="form-control shadow-none" required>{{ $project->project_ko_reason }}</textarea>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div> 