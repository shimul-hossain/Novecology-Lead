@if (Auth::user()->role != 'Gestionnaire' && Auth::user()->role != 'manager')
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
                            @foreach ($stats_telecommercials as $telecommercial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="white-space: inherit;">
                                        <div class="d-sm-flex align-items-center">
                                            <a href="#!" class="avatar-group__image-wrapper d-inline-block flex-shrink-0 rounded-circle overflow-hidden mr-2 mb-2 mb-sm-0" style="width: 45px; height: 45px;">
                                                @if($telecommercial->profile_photo)
                                                    <img src="{{ asset('uploads/crm/profiles') }}/{{ $telecommercial->profile_photo }}" alt="avatar image" loading="lazy" class="avatar-group__image w-100 h-100">
                                                @else
                                                    <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" loading="lazy" class="avatar-group__image w-100 h-100">
                                                @endif
                                            </a>
                                            <div>
                                                <p class="mb-1">
                                                    <strong>{{ $telecommercial->first_name }} {{ $telecommercial->name }}</strong>
                                                </p>
                                                <small>{{ $telecommercial->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $telecommercial->getLeads->where('lead_label', 2)->count() }}</td>
                                    <td>{{ $telecommercial->getLeads->where('lead_label', 3)->count() }}</td>
                                    <td>{{ $telecommercial->getLeads->where('lead_label', 4)->count() }}</td>
                                    <td>{{ $telecommercial->getLeads->where('lead_label', 6)->count() }}</td>
                                    <td>{{ $telecommercial->getLeads->where('lead_label', 7)->count() }}</td>
                                    <td>{{ $telecommercial->getLeads->where('lead_label', 5)->count() }}</td>
                                    <td>{{ $telecommercial->getLeads->count() > 0 ? number_format(($telecommercial->getLeads->where('lead_label', 7)->count()*100)/$telecommercial->getLeads->count(), 2) : '0.00' }}%
                                        <span class="ml-3">
                                            @if ($telecommercial->getLeads->count() > 0 && ($telecommercial->getLeads->where('lead_label', 7)->count()*100)/$telecommercial->getLeads->count() > 50)
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
                            @foreach ($stats_telecommercials as $telecommercial)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="white-space: inherit;">
                                        <div class="d-sm-flex align-items-center">
                                            <a href="#!" class="avatar-group__image-wrapper d-inline-block flex-shrink-0 rounded-circle overflow-hidden mr-2 mb-2 mb-sm-0" style="width: 45px; height: 45px;">
                                                @if($telecommercial->profile_photo)
                                                    <img src="{{ asset('uploads/crm/profiles') }}/{{ $telecommercial->profile_photo }}" alt="avatar image" loading="lazy" class="avatar-group__image w-100 h-100">
                                                @else
                                                    <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" loading="lazy" class="avatar-group__image w-100 h-100">
                                                @endif
                                            </a>
                                            <div>
                                                <p class="mb-1">
                                                    <strong>{{ $telecommercial->first_name }} {{ $telecommercial->name }}</strong>
                                                </p>
                                                <small>{{ $telecommercial->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->where('project_label', 1)->count() }}</td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->where('project_label', 2)->count() }}</td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->where('project_label', 3)->count() }}</td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->where('project_label', 4)->count() }}</td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->where('project_label', 8)->count() }}</td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->where('project_label', 5)->count() }}</td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->where('project_label', 7)->count() }}</td>
                                    <td>{{ $telecommercial->getTelecommiercialProjects->count() > 0 ? number_format(($telecommercial->getTelecommiercialProjects->where('project_label', 5)->count()*100)/$telecommercial->getTelecommiercialProjects->count(), 2) : '0.00' }}%
                                        <span class="ml-3">
                                            @if ($telecommercial->getTelecommiercialProjects->count() > 0 && ($telecommercial->getTelecommiercialProjects->where('project_label', 5)->count()*100)/$telecommercial->getTelecommiercialProjects->count() > 50)
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
@else
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stats_gestionnaires as $gestionnaire)
                                @if ($gestionnaire->getProjects->whereIn('project_label', [1, 2, 3, 4, 5, 7])->count() > 0)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td style="white-space: inherit;">
                                            <div class="d-sm-flex align-items-center">
                                                <a href="#!" class="avatar-group__image-wrapper d-inline-block flex-shrink-0 rounded-circle overflow-hidden mr-2 mb-2 mb-sm-0" style="width: 45px; height: 45px;">
                                                    @if($gestionnaire->profile_photo)
                                                        <img src="{{ asset('uploads/crm/profiles') }}/{{ $gestionnaire->profile_photo }}" alt="avatar image" loading="lazy" class="avatar-group__image w-100 h-100">
                                                    @else
                                                        <img src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" loading="lazy" class="avatar-group__image w-100 h-100">
                                                    @endif
                                                </a>
                                                <div>
                                                    <p class="mb-1">
                                                        <strong>{{ $gestionnaire->first_name }} {{ $gestionnaire->name }}</strong>
                                                    </p>
                                                    <small>{{ $gestionnaire->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $gestionnaire->getProjects->where('project_label', 1)->count() }}</td>
                                        <td>{{ $gestionnaire->getProjects->where('project_label', 2)->count() }}</td>
                                        <td>{{ $gestionnaire->getProjects->where('project_label', 3)->count() }}</td>
                                        <td>{{ $gestionnaire->getProjects->where('project_label', 4)->count() }}</td>
                                        <td>{{ $gestionnaire->getProjects->where('project_label', 8)->count() }}</td>
                                        <td>{{ $gestionnaire->getProjects->where('project_label', 5)->count() }}</td>
                                        <td>{{ $gestionnaire->getProjects->where('project_label', 7)->count() }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif