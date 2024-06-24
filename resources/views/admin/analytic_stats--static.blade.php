<div class="col">
    @if ($login_user_role == 's_admin' || $login_user_role == 'manager_direction')
        <div class="ticket-analytic-card flex-column">
            <div class="w-100 d-flex align-items-center">
                <div class="ticket-analytic-card__icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <div class="ticket-analytic-card__content d-flex justify-content-between align-items-end flex-grow-1">
                    <div>
                        <h4 class="ticket-analytic-card__content__sub-title">{{ __('Users') }}</h4>
                        <h3 class="ticket-analytic-card__content__title" id="total__User">-----</h3>
                    </div>
                    <div>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#analyticUsersCollapse" aria-expanded="false">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
                </div>
            </div> 
        </div>
    @else 
        <h1 class="dashboard-title mt-5 mr-auto">{{ __('Dashboard Analytics') }}</h1> 
    @endif
</div>
@if ($login_user_role != 'Gestionnaire' && $login_user_role != 'manager')
    <div class="col">
        <div class="ticket-analytic-card flex-column">
            <div class="w-100 d-flex align-items-center">
                <div class="ticket-analytic-card__icon ticket-analytic-card__icon--danger">
                    <i class="bi bi-bar-chart-steps"></i>
                </div>
                <div class="ticket-analytic-card__content d-flex justify-content-between align-items-end flex-grow-1">
                    <div>
                        <h4 class="ticket-analytic-card__content__sub-title">{{ __('Leads') }}</h4>
                        <h3 class="ticket-analytic-card__content__title" id="total__Lead">-----</h3>
                    </div>
                    <div>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#analyticLeadsCollapse" aria-expanded="false">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
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
                        <h3 class="ticket-analytic-card__content__title" id="total__Client">-----</h3>
                    </div>
                    <div>
                        <button class="btn" type="button" data-toggle="collapse" data-target="#analyticClientsCollapse" aria-expanded="false">
                            <i class="bi bi-chevron-down"></i>
                        </button>
                    </div>
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
                    <h3 class="ticket-analytic-card__content__title" id="total__Project">-----</h3>
                </div>
                <div>
                    <button class="btn" type="button" data-toggle="collapse" data-target="#analyticChantiersCollapse" aria-expanded="false">
                        <i class="bi bi-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div> 
    </div>
</div>