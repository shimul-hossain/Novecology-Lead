@foreach ($companies as $company)
@php
    $companyPermission =  App\Models\CRM\CompanyPermission::where('role_id', $role_id)->where('company_id', $company->id)->exists();
    
@endphp
<tr>
    <td>
        <h3 class="role__card__sub-title mb-0 role__card__sub-title--level-3">{{ $company->company_name }}</h3>
    </td>
    <td class="text-right">
        <div class="custom-control custom-checkbox mb-0">
            <input 
            {{ ($companyPermission)? 'checked': '' }}
            data-role-id="{{ $role_id }}"
            data-company-id="{{ $company->id }}"
            type="checkbox" class="companycheckboxLabel custom-control-input table-all-select-checkbox" id="roleCheckLevel03-{{ $company->id.$role_id }}">
            <label class="custom-control-label" for="roleCheckLevel03-{{ $company->id.$role_id }}"></label>
        </div>
    </td>
</tr>
@endforeach