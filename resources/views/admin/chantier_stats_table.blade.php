@foreach ($fournisseur_de_leads as $fournisseur_de_lead)
    <tr>
        <td>{{ $loop->iteration }}</td> 
        <td>{{ $fournisseur_de_lead->suplier }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->where('project_label', 1)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->where('project_label', 2)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->where('project_label', 3)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->where('project_label', 4)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->where('project_label', 8)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->where('project_label', 5)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->where('project_label', 7)->count() }}</td>
        <td>{{ $fournisseur_de_lead->getProjects->count() > 0 ? number_format(($fournisseur_de_lead->getProjects->where('project_label', 5)->count()*100)/$fournisseur_de_lead->getProjects->count(), 2) : '0.00' }}%
            <span class="ml-3">
                @if ($fournisseur_de_lead->getProjects->count() > 0 && ($fournisseur_de_lead->getProjects->where('project_label', 5)->count()*100)/$fournisseur_de_lead->getProjects->count() > 50) 
                    <i class="bi bi-graph-up-arrow text-success"></i>
                @else
                    <i class="bi bi-graph-down-arrow text-danger"></i>
                @endif
            </span> 
        </td>
    </tr> 
@endforeach