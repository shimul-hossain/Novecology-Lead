@forelse ($leads as $lead)
    <div class="search-result-list-item">
        <div class="search-result-list-item-row">
            <div class="search-result-list-item__details">
                <h3 class="search-result-list-item__details__title">Prospect</h3>
                <ul class="search-result-list-item__details__list">
                    <li class="search-result-list-item__details__list__item">{{ $lead->Nom .' '.$lead->Prenom }} ({{ $lead->Code_Postal }}) {{ $lead->LeadTravaxTags->count() > 0 ? implode(',', $lead->LeadTravaxTags->pluck('tag')->toArray()) : '' }}</li>
                    <li class="search-result-list-item__details__list__item">ID: BH{{ sprintf('%08d', $lead->id) }}</li>
                    <li class="search-result-list-item__details__list__item">
                        @if ($lead->lead_label == 1)
                            @if ($lead->getRegie)
                                {{ $lead->getRegie->name ?? __('No Regie') }},
                            @else
                                {{ __('No Regie') }},
                            @endif
                        @else
                            @if ($lead->leadTelecommercial)
                                {{ $lead->leadTelecommercial->getRegie->name ?? __('No Regie') }},
                            @else
                                {{ __('No Regie') }},
                            @endif
                        @endif
                         {{ $lead->getStatus->status ?? '' }}, {{ $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->lead_label == 2) ? 'Nouvelle demande': 'Pas de sous statut') }}</li>
                </ul>
            </div>
            @if (checkAction(Auth::id(), 'lead', 'edit') || role() == 's_admin')
                <a href="{{ route('leads.index',[$lead->company_id ,$lead->id]) }}" class="search-result-list-item__btn">
                    <svg width="1em" height="1em" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.5622 29.9996H3.43731C1.54106 29.9996 0 28.4583 0 26.5623V8.43731C0 6.54106 1.541 5 3.43731 5H7.81235C8.32984 5 8.74984 5.42 8.74984 5.93749C8.74984 6.45499 8.32984 6.87498 7.81235 6.87498H3.43731C2.57599 6.87498 1.87498 7.57605 1.87498 8.43731V26.5623C1.87498 27.4233 2.57605 28.1246 3.43731 28.1246H26.5622C27.4235 28.1246 28.1247 27.4233 28.1247 26.5623V15.9372C28.1247 15.4197 28.5447 14.9997 29.0622 14.9997C29.5797 14.9997 29.9997 15.4197 29.9997 15.9372V26.5623C29.9997 28.4584 28.4584 29.9996 26.5622 29.9996Z" fill="currentColor"/>
                        <path d="M8.43608 19.984C8.36655 19.9843 8.29725 19.9758 8.22984 19.9588C7.80621 19.8601 7.5 19.4976 7.5 19.0627V17.1877C7.5 10.4678 12.9674 5.00035 19.6874 5.00035H19.9998V0.937737C19.9999 0.750699 20.0559 0.567963 20.1606 0.412958C20.2653 0.257953 20.4139 0.137745 20.5873 0.0677459C20.7606 -0.00201931 20.9508 -0.0183533 21.1334 0.0208444C21.3161 0.0600421 21.4828 0.152979 21.6122 0.287705L29.7372 8.72512C30.0872 9.0877 30.0872 9.66261 29.7372 10.0252L21.6122 18.4626C21.3472 18.7389 20.9384 18.824 20.5873 18.6826C20.4139 18.6126 20.2653 18.4924 20.1606 18.3374C20.0559 18.1823 19.9999 17.9996 19.9998 17.8126V13.7502H18.5148C14.5825 13.7502 11.0485 15.9351 9.29119 19.4513C9.12983 19.7764 8.7911 19.984 8.43608 19.984ZM19.6874 6.87534C14.4373 6.87534 10.09 10.819 9.45373 15.9C11.726 13.3652 14.9848 11.8752 18.5148 11.8752H20.9373C21.4548 11.8752 21.8748 12.2952 21.8748 12.8127V15.4876L27.7609 9.37516L21.8748 3.26271V5.93784C21.8748 6.45534 21.4548 6.87534 20.9373 6.87534H19.6874Z" fill="currentColor"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
@empty
    <div class="search-result-list-item">
        <div class="search-result-list-item-row">
            <div class="search-result-list-item__details">
                <h3 class="search-result-list-item__details__title">Prospect</h3>
                <ul class="search-result-list-item__details__list">
                    <li class="search-result-list-item__details__list__item">Aucun prospect</li>
                </ul>
            </div>
        </div>
    </div>
@endforelse

@forelse ($clients as $client)
    <div class="search-result-list-item">
        <div class="search-result-list-item-row">
            <div class="search-result-list-item__details">
                <h3 class="search-result-list-item__details__title">Client</h3>
                <ul class="search-result-list-item__details__list">
                    <li class="search-result-list-item__details__list__item">{{ $client->Nom .' '.$client->Prenom }} ({{ $client->Code_Postal }})</li>
                    <li class="search-result-list-item__details__list__item">ID: BH{{ sprintf('%08d', $client->id) }}</li>
                </ul>
            </div>
            @if (checkAction(Auth::id(), 'client', 'edit') || role() == 's_admin')
                <a href="{{ route('client.lead.update', $client->id) }}" class="search-result-list-item__btn">
                    <svg width="1em" height="1em" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.5622 29.9996H3.43731C1.54106 29.9996 0 28.4583 0 26.5623V8.43731C0 6.54106 1.541 5 3.43731 5H7.81235C8.32984 5 8.74984 5.42 8.74984 5.93749C8.74984 6.45499 8.32984 6.87498 7.81235 6.87498H3.43731C2.57599 6.87498 1.87498 7.57605 1.87498 8.43731V26.5623C1.87498 27.4233 2.57605 28.1246 3.43731 28.1246H26.5622C27.4235 28.1246 28.1247 27.4233 28.1247 26.5623V15.9372C28.1247 15.4197 28.5447 14.9997 29.0622 14.9997C29.5797 14.9997 29.9997 15.4197 29.9997 15.9372V26.5623C29.9997 28.4584 28.4584 29.9996 26.5622 29.9996Z" fill="currentColor"/>
                        <path d="M8.43608 19.984C8.36655 19.9843 8.29725 19.9758 8.22984 19.9588C7.80621 19.8601 7.5 19.4976 7.5 19.0627V17.1877C7.5 10.4678 12.9674 5.00035 19.6874 5.00035H19.9998V0.937737C19.9999 0.750699 20.0559 0.567963 20.1606 0.412958C20.2653 0.257953 20.4139 0.137745 20.5873 0.0677459C20.7606 -0.00201931 20.9508 -0.0183533 21.1334 0.0208444C21.3161 0.0600421 21.4828 0.152979 21.6122 0.287705L29.7372 8.72512C30.0872 9.0877 30.0872 9.66261 29.7372 10.0252L21.6122 18.4626C21.3472 18.7389 20.9384 18.824 20.5873 18.6826C20.4139 18.6126 20.2653 18.4924 20.1606 18.3374C20.0559 18.1823 19.9999 17.9996 19.9998 17.8126V13.7502H18.5148C14.5825 13.7502 11.0485 15.9351 9.29119 19.4513C9.12983 19.7764 8.7911 19.984 8.43608 19.984ZM19.6874 6.87534C14.4373 6.87534 10.09 10.819 9.45373 15.9C11.726 13.3652 14.9848 11.8752 18.5148 11.8752H20.9373C21.4548 11.8752 21.8748 12.2952 21.8748 12.8127V15.4876L27.7609 9.37516L21.8748 3.26271V5.93784C21.8748 6.45534 21.4548 6.87534 20.9373 6.87534H19.6874Z" fill="currentColor"/>
                    </svg>
                </a>
            @endif
        </div>
    </div>
@empty
    <div class="search-result-list-item">
        <div class="search-result-list-item-row">
            <div class="search-result-list-item__details">
                <h3 class="search-result-list-item__details__title">Client</h3>
                <ul class="search-result-list-item__details__list">
                    <li class="search-result-list-item__details__list__item">Aucun client</li>
                </ul>
            </div>
        </div>
    </div>
@endforelse

@forelse ($projects as $project)
<div class="search-result-list-item">
    <div class="search-result-list-item-row">
        <div class="search-result-list-item__details">
            <h3 class="search-result-list-item__details__title">Chantier</h3>
            <ul class="search-result-list-item__details__list mb-0">
                <li class="search-result-list-item__details__list__item">{{ $project->Nom .' '.$project->Prenom }} ({{ $project->Code_Postal }}) {{ $project->ProjectTravauxTags->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '' }}</li>
                <li class="search-result-list-item__details__list__item">ID: BH{{ sprintf('%08d', $project->id) }}</li>
                <li class="search-result-list-item__details__list__item">
                    @if ($project->getProjectTelecommercial)
                        {{ $project->getProjectTelecommercial->getRegie->name ?? __('No Regie') }},
                    @else
                        {{ __('No Regie') }},
                    @endif
                     {{ $project->projectStatus->status ?? '' }}, {{ $project->getSubStatus ? $project->getSubStatus->name : (($project->project_label == 1) ? 'Nouveau chantier': 'Pas de sous statut') }}</li>
            </ul>
        </div>
        @if (checkAction(Auth::id(), 'project', 'edit') || role() == 's_admin')
            <a href="{{ route('files.index', $project->id) }}" class="search-result-list-item__btn">
                <svg width="1em" height="1em" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M26.5622 29.9996H3.43731C1.54106 29.9996 0 28.4583 0 26.5623V8.43731C0 6.54106 1.541 5 3.43731 5H7.81235C8.32984 5 8.74984 5.42 8.74984 5.93749C8.74984 6.45499 8.32984 6.87498 7.81235 6.87498H3.43731C2.57599 6.87498 1.87498 7.57605 1.87498 8.43731V26.5623C1.87498 27.4233 2.57605 28.1246 3.43731 28.1246H26.5622C27.4235 28.1246 28.1247 27.4233 28.1247 26.5623V15.9372C28.1247 15.4197 28.5447 14.9997 29.0622 14.9997C29.5797 14.9997 29.9997 15.4197 29.9997 15.9372V26.5623C29.9997 28.4584 28.4584 29.9996 26.5622 29.9996Z" fill="currentColor"/>
                    <path d="M8.43608 19.984C8.36655 19.9843 8.29725 19.9758 8.22984 19.9588C7.80621 19.8601 7.5 19.4976 7.5 19.0627V17.1877C7.5 10.4678 12.9674 5.00035 19.6874 5.00035H19.9998V0.937737C19.9999 0.750699 20.0559 0.567963 20.1606 0.412958C20.2653 0.257953 20.4139 0.137745 20.5873 0.0677459C20.7606 -0.00201931 20.9508 -0.0183533 21.1334 0.0208444C21.3161 0.0600421 21.4828 0.152979 21.6122 0.287705L29.7372 8.72512C30.0872 9.0877 30.0872 9.66261 29.7372 10.0252L21.6122 18.4626C21.3472 18.7389 20.9384 18.824 20.5873 18.6826C20.4139 18.6126 20.2653 18.4924 20.1606 18.3374C20.0559 18.1823 19.9999 17.9996 19.9998 17.8126V13.7502H18.5148C14.5825 13.7502 11.0485 15.9351 9.29119 19.4513C9.12983 19.7764 8.7911 19.984 8.43608 19.984ZM19.6874 6.87534C14.4373 6.87534 10.09 10.819 9.45373 15.9C11.726 13.3652 14.9848 11.8752 18.5148 11.8752H20.9373C21.4548 11.8752 21.8748 12.2952 21.8748 12.8127V15.4876L27.7609 9.37516L21.8748 3.26271V5.93784C21.8748 6.45534 21.4548 6.87534 20.9373 6.87534H19.6874Z" fill="currentColor"/>
                </svg>
            </a>
        @endif
    </div>
</div>
@empty
<div class="search-result-list-item">
    <div class="search-result-list-item-row">
        <div class="search-result-list-item__details">
            <h3 class="search-result-list-item__details__title">Chantier</h3>
            <ul class="search-result-list-item__details__list mb-0">
                <li class="search-result-list-item__details__list__item">Aucun chantier</li>
            </ul>
        </div>
    </div>
</div>
@endforelse
