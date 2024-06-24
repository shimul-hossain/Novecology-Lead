@foreach ($fournisseur_de_leads as $fournisseur_de_lead)
    <tr>
        <td>{{ $loop->iteration }}</td> 
        <td>{{ $fournisseur_de_lead->suplier }}</td>
        <td>{{ $fournisseur_de_lead->getLead->where('lead_label', 2)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getLead->where('lead_label', 3)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getLead->where('lead_label', 4)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getLead->where('lead_label', 6)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getLead->where('lead_label', 7)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getLead->where('lead_label', 5)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getLead->count() > 0 ? number_format(($fournisseur_de_lead->getLead->where('lead_label', 7)->count()*100)/$fournisseur_de_lead->getLead->count(), 2) : '0.00' }}% 
            <span class="ml-3">
                @if ($fournisseur_de_lead->getLead->count() > 0 && ($fournisseur_de_lead->getLead->where('lead_label', 7)->count()*100)/$fournisseur_de_lead->getLead->count() > 50) 
                    <i class="bi bi-graph-up-arrow text-success"></i>
                @else
                    <i class="bi bi-graph-down-arrow text-danger"></i>
                @endif
            </span>
        </td>
    </tr> 
@endforeach