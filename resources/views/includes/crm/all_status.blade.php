<table class="table database-table w-100 mb-0">
    <thead class="database-table__header">
        <tr>
            <th>{{ __('Serial') }}</th>  
            <th class="text-center">{{ __('Status') }}</th> 
            <th>{{ __('Status Color') }}</th> 
            <th>{{ __('Background Color') }}</th>  
            <th class="text-center">{{ __('Action') }}</th>
        </tr>
    </thead>
    <tbody class="database-table__body">
        @forelse ($items as $status)
        <tr> 
            <td>{{ $loop->iteration }}</td>
            <td class="text-center">
                <button style="color:{{ $status->status_color ?? '' }}; background: {{ $status->background_color ?? '' }}" type="button" class=" primary-btn primary-btn--blue-light primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0 pl-2">
                    {{ $status->status }}
                    {{-- <span class="novecologie-icon-chevron-right pl-1"></span> --}}
                </button>  
            </td>
            <td>  
                 {{ $status->status_color }} 
            </td>
            <td>  
                 {{ $status->background_color }} 
            </td> 
            <td class="text-center">
                <div class="dropdown dropdown--custom p-0 d-inline-block">
                    <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="novecologie-icon-dots-horizontal-triple"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">  
                        @if (checkAction(Auth::id(), 'general__setting-status', 'delete') || role() == 's_admin')
                            <button type="button" class="dropdown-item border-0 status_delete_btn" data-id="{{ $status->id }}" data-type="{{ $type }}">
                                <span class="novecologie-icon-trash mr-1"></span> 
                                    {{ __('Delete') }} 
                            </button> 
                        @else
                            <button type="button" class="dropdown-item border-0"> 
                                <span class="novecologie-icon-lock py-1"></span> {{ __('Delete') }} 
                            </button> 
                        @endif
                    </div>
                </div>
            </td>
        </tr>  							
        @empty
        <tr>
            <td  class="text-center" colspan="5">{{ __('No Status Found') }}</td>
        </tr>
        @endforelse
    </tbody>
</table>