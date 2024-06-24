<input type="hidden" name="lead_id" id="lead_id_assignee">
<select class="select2_select_option form-control w-100" name="user_id" required> 
        @foreach ($users as $user)
        @if (getLeadAssign($lead_id, $user->id))
                <option selected value="{{ $user->id }}">{{ $user->name }}</option> 
        @else
                <option value="{{ $user->id }}">{{ $user->name }}</option> 
        @endif
        @endforeach
</select>
<div class="invalid-feedback">{{ __('This field is necessary') }}</div>