
    @foreach ($inputs as $input) 
        <div class="modal modal--aside fade leftAsideModal" id="question_edit{{ $input->id }}" tabindex="-1" aria-labelledby="leftAsideModalLabel" aria-hidden="true">
            <div class="modal-dialog m-0 h-100 bg-white">
            <div class="modal-content simple-bar border-0 h-100 rounded-0">
                <div class="modal-header border-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <h1 id="updatedtagTitle" class="modal-title text-center mb-5">{{ __('Update Question') }}</h1>
                    <form action="{{ route('travaux.question.update') }}" class="form mx-auto needs-validation"  novalidate method="POST">
                        @csrf 
                        <div class="form-group">
                            <label class="form-label" for="label_title">{{ __('Question') }} <span class="text-danger">*</span></label>
                            <input type="text" name="label_title" id="label_title" value="{{ $input->title }}" class="form-control shadow-none" required>
                            <input type="hidden" name="input_id" value="{{ $input->id }}">

                        </div> 
                        <div class="form-group">
                            <label class="form-label" for="input_type">{{ __('Select Input Type') }} <span class="text-danger">*</span></label>
                            <select name="input_type" id="input_type"  class="select2_select_option custom-select shadow-none form-control">
                                <option {{ ($input->type == 'text') ? 'selected':'' }} value="text">{{ __('Text') }}</option>
                                <option {{ ($input->type == 'number') ? 'selected':'' }} value="number">{{ __('Number') }}</option>
                                <option {{ ($input->type == 'email') ? 'selected':'' }} value="email">{{ __('Email') }}</option>
                                <option {{ ($input->type == 'radio') ? 'selected':'' }} value="radio">{{ __('Radio') }}</option>
                                <option {{ ($input->type == 'checkbox') ? 'selected':'' }} value="checkbox">{{ __('Checkbox') }}</option>
                                <option {{ ($input->type == 'select') ? 'selected':'' }} value="select">{{ __('Dropdown') }}</option>
                                <option {{ ($input->type == 'textarea') ? 'selected':'' }} value="textarea">{{ __('Textarea') }}</option>
                            </select> 
                        </div> 
                        <div class="form-group">
                            <label class="form-label" for="required_optional">{{ __('Required/Optional') }} <span class="text-danger">*</span></label>
                            <select name="required_optional" id="required_optional"  class="select2_select_option custom-select shadow-none form-control">
                                <option {{ ($input->required == 'no') ? 'selected':'' }} value="no">{{ __('Optional') }}</option>
                                <option {{ ($input->required == 'yes') ? 'selected':'' }} value="yes">{{ __('Required') }}</option> 
                            </select> 
                        </div>   
                        <div class="form-group">
                            <label class="form-label" for="options">{{ __('Options') }}</label>
                            <textarea name="options" id="options" class="form-control shadow-none" placeholder="Enter Options. Each option seperate with comma ','">{{ $input->options }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="order">{{ __('Order') }}</label>
                            <input type="number" name="order" id="order" value="{{ $input->order }}" class="form-control shadow-none">
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Update') }}</button>
                        </div>
                    </form> 
                </div>
            </div>
            </div>
        </div>
    @endforeach