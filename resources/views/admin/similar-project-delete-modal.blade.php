
@forelse ($similar_projects as $project)
    <div class="modal modal--aside fade" id="projectSingleDeleteModal{{ $project->id }}" tabindex="-1" aria-labelledby="projectSingleDeleteModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body text-center pt-0">
                    <h1 class="form__title position-relative mb-4">{{ __('Confirmation') }}</h1>
                    <span>{{ __('Are You Sure To Delete this') }} ?</span>
                    <form action="{{ route('project.single.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $project->id }}">
                        <input type="hidden" name="similar_status" value="1">
                        <div class="d-flex justify-content-center">
                            <button type="button" class="primary-btn primary-btn--orange primary-btn--md rounded border-0 my-3 mx-1" data-dismiss="modal" aria-label="Close">
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
@endforeach
