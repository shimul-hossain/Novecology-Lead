<option value="" selected>{{ __('Select') }}</option>  
@foreach ($users as $user)
    <option value="{{ $user->id }}">{{ $user->name }}</option>
@endforeach 