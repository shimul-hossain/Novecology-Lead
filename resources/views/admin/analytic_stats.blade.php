<div class="col">
    @if (Auth::user()->role == 's_admin' || Auth::user()->role == 'manager_direction')
        <div class="ticket-analytic-card flex-column">
            <div class="w-100 d-flex align-items-center">
                <div class="ticket-analytic-card__icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="ticket-analytic-card__content d-flex justify-content-between align-items-end flex-grow-1">
                    <div>
                        <h4 class="ticket-analytic-card__content__sub-title">{{ __('Users') }}</h4>
                        <h3 class="ticket-analytic-card__content__title" id="total__User">{{ $totalUsers }}</h3>
                    </div>
                    <div>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#analyticUsersCollapse" aria-expanded="false">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-100 collapse" id="analyticUsersCollapse">
                <div class="pt-3 analytic-collapse-list">
                    @foreach ($roles as $role)
                        @if ($role->getUsers->count() > 0)
                            <p class="analytic-collapse-item"><strong>{{ $role->name }}: </strong> <span class="badge badge-success rounded-pill"> {{ $role->getUsers->count() }}</span></p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @else 
        <h1 class="dashboard-title mt-5 mr-auto">{{ __('Dashboard Analytics') }}</h1> 
    @endif
</div>
@if (Auth::user()->role != 'Gestionnaire' && Auth::user()->role != 'manager')
    <div class="col">
        <div class="ticket-analytic-card flex-column">
            <div class="w-100 d-flex align-items-center">
                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--danger">
                    <i class="bi bi-bar-chart-steps"></i>
                </div>
                <div class="ticket-analytic-card__content d-flex justify-content-between align-items-end flex-grow-1">
                    <div>
                        <h4 class="ticket-analytic-card__content__sub-title">{{ __('Leads') }}</h4>
                        <h3 class="ticket-analytic-card__content__title" id="total__Lead">{{ $totalLeads->count() }}</h3>
                    </div>
                    <div>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#analyticLeadsCollapse" aria-expanded="false">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-100 collapse" id="analyticLeadsCollapse">
                <div class="pt-3 analytic-collapse-list">
                    @foreach ($lead_statuses as $lead_status)
                        <p class="analytic-collapse-item"><strong>{{ $lead_status->status }}: </strong><span class="badge badge-success rounded-pill"> {{ $totalLeads->where('lead_label', $lead_status->id)->count() }}</span></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="ticket-analytic-card flex-column">
            <div class="w-100 d-flex align-items-center">
                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--info">
                    <i class="bi bi-people"></i>
                </div>
                <div class="ticket-analytic-card__content d-flex justify-content-between align-items-end flex-grow-1">
                    <div>
                        <h4 class="ticket-analytic-card__content__sub-title">{{ __('Clients') }}</h4>
                        <h3 class="ticket-analytic-card__content__title" id="total__Client">{{ $totalClients->count() }}</h3>
                    </div>
                    <div>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#analyticClientsCollapse" aria-expanded="false">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            @php
                $opened = 0;
                $closed = 0;
                foreach ($totalClients as $client) {
                    if($client->getProject()->whereIn('project_label', [1,2,3,4,5])->where('deleted_status', 0)->first()){
                        $opened += 1;
                    }else{
                        $closed += 1;
                    }
                }
            @endphp
            <div class="w-100 collapse" id="analyticClientsCollapse">
                <div class="pt-3 analytic-collapse-list">
                    <p class="analytic-collapse-item"><strong>Ouvert:</strong> <span class="badge badge-success rounded-pill">{{ $opened }}</span></p>
                    <p class="analytic-collapse-item"><strong>Cloture:</strong> <span class="badge badge-success rounded-pill">{{ $closed }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endif
<div class="col ml-auto">
    <div class="ticket-analytic-card flex-column">
        <div class="w-100 d-flex align-items-center">
            <div class="ticket-analytic-card__icon ticket-analytic-card__icon--success">
                <i class="bi bi-bar-chart"></i>
            </div>
            <div class="ticket-analytic-card__content d-flex justify-content-between align-items-end flex-grow-1">
                <div>
                    <h4 class="ticket-analytic-card__content__sub-title">Chantiers</h4>
                    <h3 class="ticket-analytic-card__content__title" id="total__Project">{{ $totalProjects->count() }}</h3>
                </div>
                <div>
                    <button class="btn" type="button" data-toggle="collapse" data-target="#analyticChantiersCollapse" aria-expanded="false">
                        <i class="bi bi-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="w-100 collapse" id="analyticChantiersCollapse">
            <div class="pt-3 analytic-collapse-list">
                @foreach ($project_statuses as $project_status)
                    <p class="analytic-collapse-item"><strong>{{ $project_status->status }}: </strong><span class="badge badge-success rounded-pill"> {{ $totalProjects->where('project_label', $project_status->id)->count() }}</span></p>
                @endforeach
            </div>
        </div>
    </div>
</div>