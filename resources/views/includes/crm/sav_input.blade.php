<table class="table database-table w-100 mb-0">
    <thead class="database-table__header">
        <tr>
            <th>{{ __('Serial') }}</th>  
            <th>{{ __('Title') }}</th> 
            <th>{{ 'Input Type' }}</th>  
            <th class="text-center">{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody class="database-table__body">
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
            {{-- <td>{{ $input->options }}</td> --}}
            <td class="text-center">
                <div class="dropdown dropdown--custom p-0 d-inline-block">
                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">  
                            <button type="button" class="dropdown-item border-0 sav_input_delete_btn" data-id="{{ $input->id }}" data-sav="{{ $input->sav_id }}" data-type="{{ $input->sav_type }}">
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
    </tbody>
</table>