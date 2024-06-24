@foreach ($project_nom_campagnes as $nom_campagne)
    <tr>
        <td>{{ $loop->iteration }}</td> 
        <td>{{ $nom_campagne }}</td>
        <td>{{ $projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 1)->count() }}</td>
        <td>{{ $projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 2)->count() }}</td>
        <td>{{ $projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 3)->count() }}</td>
        <td>{{ $projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 4)->count() }}</td>
        <td>{{ $projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 5)->count() }}</td>
        <td>{{ $projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 7)->count() }}</td>
        <td>{{ $projects->where('__tracking__Nom_campagne', $nom_campagne)->count() > 0 ? round(($projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 5)->count()*100)/$projects->where('__tracking__Nom_campagne', $nom_campagne)->count()) : 0 }}%
            <span class="ml-3">
                @if ($projects->where('__tracking__Nom_campagne', $nom_campagne)->count() > 0 && ($projects->where('__tracking__Nom_campagne', $nom_campagne)->where('project_label', 5)->count()*100)/$projects->where('__tracking__Nom_campagne', $nom_campagne)->count() > 50) 
                    <i class="bi bi-graph-up-arrow text-success"></i>
                @else
                    <i class="bi bi-graph-down-arrow text-danger"></i>
                @endif
            </span> 
        </td>
    </tr> 
@endforeach