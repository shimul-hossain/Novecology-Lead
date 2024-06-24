@php
    $field_data = 'empty'; 
@endphp
@forelse ($similar_leads as $lead)
    @if ($loop->first)
        <thead>
            <tr> 
                <th></th>
                <th>ID</th>
                <th>Client</th>  
                <th>Adresse</th>  
                <th>Code postal</th>  
                <th>TAG</th>
                <th>Téléphone</th>  
                <th>Etiquette</th>  
                <th>Statut</th>  
                <th>Telecommercial</th>  
                @if (checkAction(Auth::id(), 'lead', 'similar-prospect-link') || role() == 's_admin')
                    <th>LIEN</th>  
                @endif
            </tr>
        </thead>
        <tbody class="tbody-group">
    @elseif (strtolower($lead->$field) != strtolower($field_data))
        </tbody>
        <tbody class="tbody-empty">
            <tr><td colspan="10000"></td></tr>
        </tbody>
    <tbody class="tbody-group">
    @endif
    <tr> 
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" data-lead-id="{{ $lead->id }}" class="custom-control-input table-select-checkbox similarLeadCheckboxBtn" id="similar_leads-{{ $lead->id }}">
                <label class="custom-control-label" for="similar_leads-{{ $lead->id }}"></label>
            </div>
        </td>
        <td>{{ "BH".sprintf('%08d', $lead->id) }}</td>
        <td>{{ ucwords($lead->Prenom) .' '. ucwords($lead->Nom) }}</td>
        <td>{{ $lead->Adresse }}</td>
        <td>{{ $lead->Code_Postal }}</td>
        <td> 
            @foreach ($lead->LeadTravaxTags as $tag)
                {{ $tag->tag .', ' ?? '' }}
            @endforeach 
        </td>
        <td>{{ $lead->phone }}</td>
        <td>{{ $lead->getStatus->status ?? '' }}</td>
        <td>{{ $lead->getSubStatus->name ?? ''  }}</td>
        <td> 
            {{ $lead->leadTelecommercial->name ?? '' }}
        </td>
        @if (checkAction(Auth::id(), 'lead', 'similar-prospect-link') || role() == 's_admin')
            <td>
                <div class="d-flex">
                    <a href="{{ route('leads.index',[1 ,$lead->id]) }}" class="search-result-list-item__btn">
                        <svg width="1em" height="1em" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.5622 29.9996H3.43731C1.54106 29.9996 0 28.4583 0 26.5623V8.43731C0 6.54106 1.541 5 3.43731 5H7.81235C8.32984 5 8.74984 5.42 8.74984 5.93749C8.74984 6.45499 8.32984 6.87498 7.81235 6.87498H3.43731C2.57599 6.87498 1.87498 7.57605 1.87498 8.43731V26.5623C1.87498 27.4233 2.57605 28.1246 3.43731 28.1246H26.5622C27.4235 28.1246 28.1247 27.4233 28.1247 26.5623V15.9372C28.1247 15.4197 28.5447 14.9997 29.0622 14.9997C29.5797 14.9997 29.9997 15.4197 29.9997 15.9372V26.5623C29.9997 28.4584 28.4584 29.9996 26.5622 29.9996Z" fill="currentColor"></path>
                            <path d="M8.43608 19.984C8.36655 19.9843 8.29725 19.9758 8.22984 19.9588C7.80621 19.8601 7.5 19.4976 7.5 19.0627V17.1877C7.5 10.4678 12.9674 5.00035 19.6874 5.00035H19.9998V0.937737C19.9999 0.750699 20.0559 0.567963 20.1606 0.412958C20.2653 0.257953 20.4139 0.137745 20.5873 0.0677459C20.7606 -0.00201931 20.9508 -0.0183533 21.1334 0.0208444C21.3161 0.0600421 21.4828 0.152979 21.6122 0.287705L29.7372 8.72512C30.0872 9.0877 30.0872 9.66261 29.7372 10.0252L21.6122 18.4626C21.3472 18.7389 20.9384 18.824 20.5873 18.6826C20.4139 18.6126 20.2653 18.4924 20.1606 18.3374C20.0559 18.1823 19.9999 17.9996 19.9998 17.8126V13.7502H18.5148C14.5825 13.7502 11.0485 15.9351 9.29119 19.4513C9.12983 19.7764 8.7911 19.984 8.43608 19.984ZM19.6874 6.87534C14.4373 6.87534 10.09 10.819 9.45373 15.9C11.726 13.3652 14.9848 11.8752 18.5148 11.8752H20.9373C21.4548 11.8752 21.8748 12.2952 21.8748 12.8127V15.4876L27.7609 9.37516L21.8748 3.26271V5.93784C21.8748 6.45534 21.4548 6.87534 20.9373 6.87534H19.6874Z" fill="currentColor"></path>
                        </svg>
                    </a> 
        
                    @if (role() == 's_admin')
                        <button type="button" data-toggle="modal" data-target="#leadSingleDeleteModal{{ $lead->id }}"  class="btn btn-icon shadow-none ml-auto mt-auto">
                            <i class="bi bi-trash3"></i>
                        </button>  
                    @endif
                </div>
            </td>    
        @endif
    </tr>	
    @if ($loop->last)
    </tbody>
    @endif

    @php
        $field_data = $lead->$field; 
    @endphp 
@empty
    <thead>
        <tr> 
            <th></th>
            <th>ID</th>
            <th>Client</th>  
            <th>Adresse</th>  
            <th>Code postal</th>  
            <th>TAG</th>
            <th>Téléphone</th>  
            <th>Etiquette</th>  
            <th>Statut</th>  
            <th>Telecommercial</th>  
            <th>LIEN</th>  
        </tr>
    </thead>
    <tbody> 
        <tr>
            <td colspan="2000"><h3 class="text-center">Aucun résultat trouvé.</h3></td>
        </tr> 
    </tbody>
@endforelse