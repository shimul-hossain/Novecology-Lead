@foreach ($lead_nom_campagnes as $nom_campagne)
    <tr>
        <td>{{ $loop->iteration }}</td> 
        <td>{{ $nom_campagne }}</td>
        <td>{{ $leads->where('__tracking__Nom_campagne', $nom_campagne)->where('lead_label', 3)->count() }}</td>
        <td>{{ $leads->where('__tracking__Nom_campagne', $nom_campagne)->where('lead_label', 4)->count() }}</td>
        <td>{{ $leads->where('__tracking__Nom_campagne', $nom_campagne)->where('lead_label', 6)->count() }}</td>
        <td>{{ $leads->where('__tracking__Nom_campagne', $nom_campagne)->where('lead_label', 7)->count() }}</td>
        <td>{{ $leads->where('__tracking__Nom_campagne', $nom_campagne)->where('lead_label', 5)->count() }}</td>
        <td>{{ $leads->where('__tracking__Nom_campagne', $nom_campagne)->count() > 0 ? round(($leads->where('__tracking__Nom_campagne', $nom_campagne)->where('lead_label', 7)->count()*100)/$leads->where('__tracking__Nom_campagne', $nom_campagne)->count()) : 0 }}% 
            <span class="ml-3">
                @if ($leads->where('__tracking__Nom_campagne', $nom_campagne)->count() > 0 && ($leads->where('__tracking__Nom_campagne', $nom_campagne)->where('lead_label', 7)->count()*100)/$leads->where('__tracking__Nom_campagne', $nom_campagne)->count() > 50) 
                    <i class="bi bi-graph-up-arrow text-success"></i>
                @else
                    <i class="bi bi-graph-down-arrow text-danger"></i>
                @endif
            </span>
        </td>
    </tr> 
@endforeach