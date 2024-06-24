<div class="col-12">
    <div class="dashboard-card">
        <div class="dashboard-card__header">
            <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">LEAD</h3>
        </div>
        <div class="overflow-hidden h-100">
            <div class="dashboard-card__body p-0 simple-bar h-100">
                <table class="table table--dashboard no-wrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CLASSEMENT</th>
                            <th>Nouveau</th>
                            <th>En Cours</th>
                            <th>NRP</th>
                            <th>Validation</th>
                            <th>Converti</th>
                            <th>KO</th>
                            <th>Statistiques</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lead_sub_statuses as $sub_status)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sub_status->name }}</td>
                            <td>{{ $sub_status->getLeads->where('lead_label', 2)->count() }}</td>
                            <td>{{ $sub_status->getLeads->where('lead_label', 3)->count() }}</td>
                            <td>{{ $sub_status->getLeads->where('lead_label', 4)->count() }}</td>
                            <td>{{ $sub_status->getLeads->where('lead_label', 6)->count() }}</td>
                            <td>{{ $sub_status->getLeads->where('lead_label', 7)->count() }}</td>
                            <td>{{ $sub_status->getLeads->where('lead_label', 5)->count() }}</td>
                            <td>{{ $sub_status->getLeads->count() > 0 ? number_format(($sub_status->getLeads->where('lead_label', 7)->count()*100)/$sub_status->getLeads->count(), 2) : '0.00' }}%
                                <span class="ml-3">
                                    @if ($sub_status->getLeads->count() > 0 && ($sub_status->getLeads->where('lead_label', 7)->count()*100)/$sub_status->getLeads->count() > 50)
                                        <i class="bi bi-graph-up-arrow text-success"></i>
                                    @else
                                        <i class="bi bi-graph-down-arrow text-danger"></i>
                                    @endif
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="dashboard-card">
        <div class="dashboard-card__header">
            <h3 class="dashboard-card__header__title dashboard-card__header__title--lg my-0">CHANTIER</h3>
        </div>
        <div class="overflow-hidden h-100">
            <div class="dashboard-card__body p-0 simple-bar h-100">
                <table class="table table--dashboard no-wrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CLASSEMENT</th>
                            <th>En Cours</th>
                            <th>Prévisite Réalisé</th>
                            <th>Déposé</th>
                            <th>Accepté</th>
                            <th>Installation en cours</th>
                            <th>Installé</th>
                            <th>KO</th>
                            <th>Statistiques</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project_sub_statuses as $project_sub_status)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $project_sub_status->name }}</td>
                                <td>{{ $project_sub_status->getProjects->where('project_label', 1)->count() }}</td>
                                <td>{{ $project_sub_status->getProjects->where('project_label', 2)->count() }}</td>
                                <td>{{ $project_sub_status->getProjects->where('project_label', 3)->count() }}</td>
                                <td>{{ $project_sub_status->getProjects->where('project_label', 4)->count() }}</td>
                                <td>{{ $project_sub_status->getProjects->where('project_label', 8)->count() }}</td>
                                <td>{{ $project_sub_status->getProjects->where('project_label', 5)->count() }}</td>
                                <td>{{ $project_sub_status->getProjects->where('project_label', 7)->count() }}</td>
                                <td>{{ $project_sub_status->getProjects->count() > 0 ? number_format(($project_sub_status->getProjects->where('project_label', 5)->count()*100)/$project_sub_status->getProjects->count(), 2) : '0.00' }}%
                                    <span class="ml-3">
                                        @if ($project_sub_status->getProjects->count() > 0 && ($project_sub_status->getProjects->where('project_label', 5)->count()*100)/$project_sub_status->getProjects->count() > 50)
                                            <i class="bi bi-graph-up-arrow text-success"></i>
                                        @else
                                            <i class="bi bi-graph-down-arrow text-danger"></i>
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>