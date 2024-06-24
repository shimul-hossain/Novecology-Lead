@forelse ($rapplers as $rappler)
    <li class="dashboard-list__item">
        <div class="media media--success"  style="cursor: pointer" data-target="#rapplerStatusAddModal{{ $rappler->id }}"> 
            <div class="media-body align-items-center d-flex justify-content-between">
                <div>
                    <h3 class="media-body__title font-weight-normal">{{ $rappler->Prenom .' '. $rappler->Nom }}</h3>
                    <p class="media-body__sub-title d-flex">
                        {{ $rappler->callbackUser->name ?? ''  }}
                    </p>
                </div>
                <span>{{ \Carbon\Carbon::parse($rappler->callback_time)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rappler->callback_time)->format('H:i') }}</span>  
            </div>
        </div>
    </li>  
@empty
    <li class="dashboard-list__item text-center">
        <h3>Aucune donnée trouvée</h3>
    </li>
@endforelse