@forelse ($inputs as $input)
<tr> 
    <td>{{ $loop->iteration }}</td>
    <td>{{ $input->title }}</td>
    <td> 
        @if ($input->input_type == 'text')
        {{ __('Text') }}
        @elseif ($input->input_type == 'date')
        {{ __('Date') }}
        @elseif ($input->input_type == 'number')
        {{ __('Number') }}
        @elseif ($input->input_type == 'email')
        {{ __('Email') }}
        @elseif ($input->input_type == 'radio')
        {{ __('Radio') }}
        @elseif ($input->input_type == 'checkbox')
        {{ __('Checkbox') }}
        @elseif ($input->input_type == 'select')
        {{ __('Dropdown') }}
        @else
        {{ __('Textarea') }} 
        @endif 
    </td> 
    <td class="text-center">
        <div class="dropdown dropdown--custom p-0 d-inline-block">
            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="novecologie-icon-dots-horizontal-triple"></span>
            </button>
            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100">  
                    <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#customInputFieldDelete{{ $input->id }}" class="dropdown-item border-0">
                        <span class="novecologie-icon-trash mr-1"></span> 
                            {{ __('Delete') }} 
                    </button> 
            </div>
        </div>
    </td>
</tr>  							
@empty
<tr>
    <td  class="text-center" colspan="5">{{ __('No Field Found') }}</td>
</tr>
@endforelse