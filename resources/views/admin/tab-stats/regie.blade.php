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
                            <th>Non attribué</th>
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
                        @foreach ($stats_regies as $regie)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $regie->name }}</td>
                                <td>{{ $regie->getNonAttribueLead->count() }}</td>
                                <td>{{ \App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 2)->count() }}</td>
                                <td>{{ \App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 3)->count() }}</td>
                                <td>{{ \App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 4)->count() }}</td>
                                <td>{{ \App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 6)->count() }}</td>
                                <td>{{ \App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 7)->count() }}</td>
                                <td>{{ \App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 5)->count() }}</td>
                                <td>{{ \App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->count() > 0 ? number_format((\App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 7)->count()*100)/\App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->count(), 2) : '0.00' }}%
                                    <span class="ml-3">
                                        @if (\App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->count() > 0 && (\App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->where('lead_label', 7)->count()*100)/\App\Models\CRM\LeadClientProject::whereIn('lead_telecommercial', $regie->getAllUser->pluck('id'))->where('lead_deleted_status', 0)->count() > 50)
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
                        @foreach ($stats_regies as $regie)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $regie->name }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 1)->count() }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 2)->count() }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 3)->count() }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 4)->count() }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 8)->count() }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 5)->count() }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 7)->count() }}</td>
                                <td>{{ \App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->count() > 0 ? number_format((\App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 5)->count()*100)/\App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->count(), 2) : '0.00' }}%
                                    <span class="ml-3">
                                        @if (\App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->count() > 0 && (\App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->where('project_label', 5)->count()*100)/\App\Models\CRM\NewProject::whereIn('project_telecommercial', $regie->getAllUser->pluck('id'))->where('deleted_status', 0)->count() > 50)
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