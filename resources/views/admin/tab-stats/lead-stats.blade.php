<div class="col-12">
    <div class="dashboard-card">
        <div class="dashboard-card__header d-flex">
            <h3 class="dashboard-card__header__title">LEAD</h3>
            <div class="dropdown dropdown--custom ml-auto">
                <button id="leadListLabel" class="btn btn-sm shadow-none text-black dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Fournisseur de lead
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item lead_stats_change" data-value="Fournisseur de lead" href="#!">Fournisseur de lead</a>
                    <a class="dropdown-item lead_stats_change" data-value="Type de campagne" href="#!">Type de campagne</a>
                    <a class="dropdown-item lead_stats_change" data-value="Nom campagne" href="#!">Nom campagne</a>
                </div>
            </div>
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
                    <tbody id="leadStatsTable">
                        @include('admin.lead_stats_table')
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
                    <tbody id="chantierStatsTable">
                        @include('admin.chantier_stats_table')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>