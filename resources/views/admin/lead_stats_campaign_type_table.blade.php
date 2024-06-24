@foreach ($type_de_campagnes as $type_de_campagne)
    <tr>
        <td>{{ $loop->iteration }}</td> 
        <td>{{ $type_de_campagne->name }}</td>
        <td>{{ $type_de_campagne->getLead->where('lead_label', 3)->count() }}</td>
        <td>{{ $type_de_campagne->getLead->where('lead_label', 4)->count() }}</td>
        <td>{{ $type_de_campagne->getLead->where('lead_label', 6)->count() }}</td>
        <td>{{ $type_de_campagne->getLead->where('lead_label', 7)->count() }}</td>
        <td>{{ $type_de_campagne->getLead->where('lead_label', 5)->count() }}</td>
        <td>{{ $type_de_campagne->getLead->count() > 0 ? round(($type_de_campagne->getLead->where('lead_label', 7)->count()*100)/$type_de_campagne->getLead->count()) : 0 }}% 
            <span class="ml-3">
                @if ($type_de_campagne->getLead->count() > 0 && ($type_de_campagne->getLead->where('lead_label', 7)->count()*100)/$type_de_campagne->getLead->count() > 50) 
                    <i class="bi bi-graph-up-arrow text-success"></i>
                @else
                    <i class="bi bi-graph-down-arrow text-danger"></i>
                @endif
            </span>
        </td>
    </tr> 
@endforeach