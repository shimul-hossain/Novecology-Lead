
@forelse ($childrens as $children)
<div class="row align-items-end">
    <div class="col-md-5">
        <div class="form-group">
            <label class="form-label">Nom</label>
            <input type="text" name="name" id="birth_name{{ $children->id }}" value="{{ $children->name }}" disabled class="form-control shadow-none foyer_disabled">
        </div>
    </div> 
    <div class="col-md-5">
        <div class="form-group" id="birth_date_wrap{{ $children->id }}">
            <label class="form-label">Date de naissance</label>
            <input type="text" name="birth_date" id="birth_date{{ $children->id }}" value="{{ $children->birth_date }}" disabled class="date-mask form-control shadow-none foyer_disabled" placeholder="__/__/____">
        </div> 
    </div>
    <div class="col-md-2">
        <div class="form-group pb-md-2">
            <button type="button" class="add-btn d-inline-flex align-items-center justify-content-center button foyer_disabled" data-toggle="modal" data-target="#childrenInfoEditModal{{ $children->id }}"><i class="bi bi-pencil-square"></i></button>
            @if ($loop->iteration != '1')
                <button type="button" class="remove-btn d-inline-flex align-items-center justify-content-center button foyer_disabled remove_dependent_children" data-id="{{ $children->id }}"><i class="bi bi-trash"></i></button>
            @endif
            @if ($loop->iteration == '1')
            <button type="button" class="add-btn d-inline-flex align-items-center justify-content-center button foyer_disabled" id="add_dependent_children">+</button>
            @endif
        </div>
    </div>
</div>
<div class="modal modal--aside fade" id="childrenInfoEditModal{{ $children->id }}" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                    <span class="novecologie-icon-close"></span>
                </button>
            </div>
            <div class="modal-body pt-0">
                <h1 class="position-relative mb-4 text-center">Modifier</h1> 
                <form action="#!">
                    @csrf
                    <input type="hidden" name="id" value="{{ $children->id }}">
                    <div class="form-group mt-3">
                        <label class="form-label">Nom</label>
                        <input type="text" value="{{ $children->name }}" class="form-control shadow-none foyer_disabled edit_birth_name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Date de naissance</label>
                        <input type="text" value="{{ $children->birth_date }}" class="date-mask form-control shadow-none foyer_disabled edit_birth_date" placeholder="__/__/____">
                    </div>
                    <button type="button" class="primary-btn primary-btn--primary primary-btn--lg rounded-pill d-inline-flex align-items-center justify-content-center border-0 mt-2 update_children_info"  data-id="{{ $children->id }}">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@empty
<div class="row align-items-end birth_info">
    <div class="col-md-5">
        <div class="form-group">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control shadow-none foyer_disabled birth_name">
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <label class="form-label">Date de naissance </label>
            <input type="text" class="date-mask form-control shadow-none foyer_disabled birth_date" placeholder="__/__/____">
        </div> 
    </div>
    <div class="col-md-2">
        <div class="form-group pb-md-2">
            <button type="button" class="add-btn d-inline-flex align-items-center justify-content-center button foyer_disabled" id="add_dependent_children">+</button>
        </div>
    </div>
</div>  
@endforelse
