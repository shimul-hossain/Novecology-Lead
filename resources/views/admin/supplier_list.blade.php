<div class="table-responsive simple-bar">
    <table class="table database-table w-100 mb-0">
        <thead class="database-table__header">
            <tr>
                <th>{{ __('Serial') }}</th> 
                <th>{{ __('Name') }}</th> 
                <th class="text-center">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody class="database-table__body">


            
            
                <tr>
                    <td>
                        11
                    </td>
                    <td>
                        asdf
                    </td>
                    <td class="text-center">
                        <div class="dropdown dropdown--custom p-0 d-inline-block">
                            <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="novecologie-icon-dots-horizontal-triple"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                <button type="button" class="dropdown-item border-0 commentCategoryEdit" data-id="1" data-name="ads">
                                    <span class="novecologie-icon-edit mr-1"></span>
                                    {{ __('Edit') }}
                                </button>  
                                <button type="button" class="dropdown-item border-0 commentCategoryDelete" data-id="1">
                                    <span class="novecologie-icon-trash mr-1"></span> 
                                        {{ __('Delete') }} 
                                </button> 
                            </div>
                        </div>
                    </td>
                </tr>  
        </tbody>
    </table>
</div> 