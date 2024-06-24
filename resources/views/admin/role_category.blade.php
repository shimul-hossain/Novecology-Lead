@extends('layouts.master')

{{-- Title part  --}}
@section('title')
    {{ __('Role') }}
@endsection

{{-- Body Background  --}}
@section('bodyBg')
secondary-bg
@endsection

{{-- Active menu  --}}
@section('settingsIndex')
    active
@endsection
@push('css')
    <style>

    </style>
@endpush
@php
    $headers = App\Models\CRM\Navigation::all();
    $headerNotnav = App\Models\CRM\NonNavigation::all();
@endphp
{{-- Main Content Part  --}}
@section('content')

    <!-- New Role Section -->
    <section class="role section-gap pt-4">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-sm text-center text-sm-left">
                            <a href="{{ route('role.category.index') }}" class="primary-btn primary-btn--primary primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0 mb-1 mb-sm-0">{{ __('Role Category') }}</a>
                            <a href="{{ route('role.index') }}" class="primary-btn primary-btn--primary primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0 mb-1 mb-sm-0">{{ __('Role') }}</a>
                        </div>
                        <div class="col-sm-auto text-center text-sm-right">
                            <button data-toggle="modal" data-target="#middleModal" type="button" class="primary-btn primary-btn--primary primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0">+ {{ __('Add Role') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="role-table">
                        <aside class="role-table__aside">
                            <header class="role-table__header"></header>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--module" aria-expanded="true">
                                    {{ __('Module') }}
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--module show">
                                    <div class="overflow-hidden">
                                        @foreach ($headers as $header)
                                            @if ($header->route == 'super_admin.landing')
                                                @continue
                                            @endif
                                            <div class="role-table__card__body__data">{{ $header->name }}</div>
                                        @endforeach

                                        @foreach ($headerNotnav as $header)
                                             <div class="role-table__card__body__data">{{ $header->name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--lead" aria-expanded="false">
                                    Prospects
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--lead">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Assign') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                        <div class="role-table__card__body__data">{{ __('reset') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Dispatcher') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Import') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Export') }}</div>
                                        <div class="role-table__card__body__data">Ajouter un filtre</div>
                                        <div class="role-table__card__body__data">Filtre blue button</div>
                                        <div class="role-table__card__body__data">Statut blue button</div>
                                        <div class="role-table__card__body__data">Créer un rappel</div>
                                        <div class="role-table__card__body__data">Modifier en rappel</div>
                                        <div class="role-table__card__body__data">Activité</div>
                                        <div class="role-table__card__body__data">Commentaires</div>
                                        <div class="role-table__card__body__data">Historique des appels</div>
                                        <div class="role-table__card__body__data">Attribuer un fournisseur de lead</div>
                                        <div class="role-table__card__body__data">Changer statut groupé</div>
                                        <div class="role-table__card__body__data">Analyse doublons</div>
                                        <div class="role-table__card__body__data">Analyse doublons lien</div>
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--client" aria-expanded="false">
                                    Clients
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--client">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Assign') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                        {{-- <div class="role-table__card__body__data">{{ __('Delete') }}</div> --}}
                                        <div class="role-table__card__body__data">{{ __('Export') }}</div>
                                        <div class="role-table__card__body__data">Ajouter un filtre</div>
                                        <div class="role-table__card__body__data">Filtre blue button</div>
                                        <div class="role-table__card__body__data">Créer un rappel</div>
                                        <div class="role-table__card__body__data">Modifier en rappel</div>
                                        <div class="role-table__card__body__data">Activité</div>
                                        <div class="role-table__card__body__data">Commentaires</div>
                                        <div class="role-table__card__body__data">Historique des appels</div>
                                    </div>
                                </div>
                            </div>

                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--project" aria-expanded="false">
                                    Chantiers
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--project">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Assign') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                        {{-- <div class="role-table__card__body__data">{{ __('Delete') }}</div> --}}
                                        <div class="role-table__card__body__data">{{ __('Import') }}</div>
                                        <div class="role-table__card__body__data">Ajouter un filtre</div>
                                        <div class="role-table__card__body__data">Filtre blue button</div>
                                        <div class="role-table__card__body__data">Statut blue button</div>
                                        <div class="role-table__card__body__data">MPR button</div>
                                        <div class="role-table__card__body__data">Statut visible</div>
                                        <div class="role-table__card__body__data">Statut edit</div>
                                        <div class="role-table__card__body__data">Créer un rappel</div>
                                        <div class="role-table__card__body__data">Modifier en rappel</div>
                                        {{-- <div class="role-table__card__body__data">{{ __('Add Custom Tab') }}</div> --}}
                                        <div class="role-table__card__body__data">Activité Chantier</div>
                                        <div class="role-table__card__body__data">Activité Prospect</div>
                                        <div class="role-table__card__body__data">Timeline</div>
                                        <div class="role-table__card__body__data">Commentaires</div>
                                        <div class="role-table__card__body__data">Historique des appels</div>
                                        <div class="role-table__card__body__data">Magic Planning</div>
                                        <div class="role-table__card__body__data">Analyse doublons</div>
                                        <div class="role-table__card__body__data">Analyse doublons lien</div>
                                        <div class="role-table__card__body__data">Pixel</div>
                                    </div>
                                </div>
                            </div>
 
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--ticketing" aria-expanded="false">
                                    Tickets
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--ticketing">
                                    <div class="overflow-hidden">
                                    <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                    <div class="role-table__card__body__data">{{ __('Assigne') }}</div>
                                    <div class="role-table__card__body__data">Commentaire</div>
                                    <div class="role-table__card__body__data">{{ __('Close') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--notion" aria-expanded="false">
                                    Notions
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--notion">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--user" aria-expanded="false">
                                    Utilisateurs
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--user">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('View') }}</div>
                                        {{-- <div class="role-table__card__body__data">{{ __('Permission') }}</div> --}}
                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab" aria-expanded="false">
                                    Prospects Tab
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--leadTab">
                                    <div class="overflow-hidden">
                                        @foreach (getAllStaticTab() as $lead_tab)
                                            @if ($lead_tab->slug == 'lead-tracking')
                                                <div class="role-table__card__body__data">{{ $lead_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab{{ $lead_tab->id }}" aria-expanded="false">
                                                        {{ __('Lead Tracking (Form and response)') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($lead_tab->slug == 'information-personnel')
                                                <div class="role-table__card__body__data">{{ $lead_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab1{{ $lead_tab->id }}" aria-expanded="false">
                                                        {{ __('Tax Notice') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab1{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab2{{ $lead_tab->id }}" aria-expanded="false">
                                                        {{ __('Personal informations') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab2{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab3{{ $lead_tab->id }}" aria-expanded="false">
                                                        Éligibilité
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab3{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab4{{ $lead_tab->id }}" aria-expanded="false">
                                                        Information logement
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab4{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab5{{ $lead_tab->id }}" aria-expanded="false">
                                                        {{ __('Situation foyer') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab5{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($lead_tab->slug == 'information-logement')
                                                <div class="role-table__card__body__data">Projet</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab1{{ $lead_tab->id }}" aria-expanded="false">
                                                        Projet
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab1{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTab2{{ $lead_tab->id }}" aria-expanded="false">
                                                        Prescription chantier
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--leadTab2{{ $lead_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--clientTab" aria-expanded="false">
                                    Clients Tab
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--clientTab">
                                    <div class="overflow-hidden">
                                        @foreach (getAllStaticTab() as $client_tab)
                                            @if ($client_tab->slug == 'lead-tracking')
                                                <div class="role-table__card__body__data">{{ $client_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--clientTab{{ $client_tab->id }}" aria-expanded="false">
                                                        {{ __('Lead Tracking (Form and response)') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--clientTab{{ $client_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($client_tab->slug == 'information-personnel')
                                                <div class="role-table__card__body__data">{{ $client_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--clientTab1{{ $client_tab->id }}" aria-expanded="false">
                                                        {{ __('Tax Notice') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--clientTab1{{ $client_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--clientTab2{{ $client_tab->id }}" aria-expanded="false">
                                                        {{ __('Personal informations') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--clientTab2{{ $client_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--clientTab3{{ $client_tab->id }}" aria-expanded="false">
                                                        Éligibilité
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--clientTab3{{ $client_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--clientTab4{{ $client_tab->id }}" aria-expanded="false">
                                                        Information logement
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--clientTab4{{ $client_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--clientTab5{{ $client_tab->id }}" aria-expanded="false">
                                                        {{ __('Situation foyer') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--clientTab5{{ $client_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab" aria-expanded="false">
                                    Chantiers Tab
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--projectTab">
                                    <div class="overflow-hidden">
                                        @foreach (getAllStaticTab() as $project_tab)
                                            @if ($project_tab->slug == 'lead-tracking')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ __('Lead Tracking (Form and response)') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'information-personnel')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ __('Tax Notice') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab2{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ __('Personal informations') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab3{{ $project_tab->id }}" aria-expanded="false">
                                                        Éligibilité
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab3{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab4{{ $project_tab->id }}" aria-expanded="false">
                                                        Information logement
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab4{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab5{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ __('Situation foyer') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab5{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'section-projet')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Projet
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab2{{ $project_tab->id }}" aria-expanded="false">
                                                        Prescriptions chantier
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                            @if ($project_tab->slug == 'section-previsite')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Contrôles des pièces
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'section-MAPRIMERENOV')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab3{{ $project_tab->id }}" aria-expanded="false">
                                                        Compte
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab3{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".1permission--projectTab4{{ $project_tab->id }}" aria-expanded="false">
                                                        Montant Disponible
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse 1permission--projectTab4{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ __('Subvention') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab2{{ $project_tab->id }}" aria-expanded="false">
                                                        MyPrimeMPR
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                            @if ($project_tab->slug == 'section-action-logement')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Subvention
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'banque')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ __('Depot') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'audit')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Audit
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'intervention')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Intervention
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'rapports')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Rapports client
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'comptability')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Comptability
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Create Opérations CEE') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit Opérations CEE') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Delete Opérations CEE') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Create Prestations') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit Prestations') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Delete Prestations') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'section-controle-qualite')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ $project_tab->name }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Create Question') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Create Header') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'section-sur-site')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        {{ $project_tab->name }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'facturation')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Suivi Facturation
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab2{{ $project_tab->id }}" aria-expanded="false">
                                                        Contrôle de gestion
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'section-documents')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                       {{ __('Generation de document') }}
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'email')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                       Email
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($project_tab->slug == 'demande_mairie')
                                                <div class="role-table__card__body__data">{{ $project_tab->name }}</div>
                                                <div class="role-table__card">
                                                    <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectTab1{{ $project_tab->id }}" aria-expanded="false">
                                                        Demande Mairie
                                                    </button>
                                                    <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                        <div class="overflow-hidden">
                                                            <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                            <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings" aria-expanded="false">
                                    Paramètres généraux
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--general_settings">
                                    <div class="overflow-hidden">
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Regie') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-1" aria-expanded="false">
                                                    {{ __('Regie') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-1">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Prescription chantier</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-2" aria-expanded="false">
                                                    Prescription chantier
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-2">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Contrôle des Documents</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-6" aria-expanded="false">
                                                    Contrôle des Documents
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-6">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Banque</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-7" aria-expanded="false">
                                                    Banque
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-7">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Statut audit</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-9" aria-expanded="false">
                                                    Statut audit
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-9">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Statut rapport audit</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-10" aria-expanded="false">
                                                    Statut rapport audit
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-10">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Résultat du rapport audit</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-11" aria-expanded="false">
                                                    Résultat du rapport audit
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-11">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Commercial Terrain</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-12" aria-expanded="false">
                                                    Commercial Terrain
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-12">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Type de problème</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-49" aria-expanded="false">
                                                    Type de problème
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-49">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Type énergie Chaud</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-50" aria-expanded="false">
                                                    Type énergie Chaud
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-50">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Prestations group') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-51" aria-expanded="false">
                                                    {{ __('Prestations group') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-51">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Comment Category') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-68" aria-expanded="false">
                                                    {{ __('Comment Category') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-68">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Contrôle Qualité</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-69" aria-expanded="false">
                                                    Contrôle Qualité
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-69">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Notion Catégorie</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-70" aria-expanded="false">
                                                    Notion Catégorie
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-70">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Notion Sous Catégorie</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-82" aria-expanded="false">
                                                    Notion Sous Catégorie
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-82">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Sous statut prospect</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-71" aria-expanded="false">
                                                    Sous statut prospect
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-71">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Mode de chauffage</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-72" aria-expanded="false">
                                                    Mode de chauffage
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-72">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Type de campagne</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-73" aria-expanded="false">
                                                    Type de campagne
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-73">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Sous statut chantier</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-74" aria-expanded="false">
                                                    Sous statut chantier
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-74">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Statut planning intervention</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-76" aria-expanded="false">
                                                    Statut planning intervention
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-76">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Chantiers KO - Raisons</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-77" aria-expanded="false">
                                                    Chantiers KO - Raisons
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-77">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Chantiers Reflexion - Raisons</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-78" aria-expanded="false">
                                                    Chantiers Reflexion - Raisons
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-78">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Contrôle conformité photo chantier</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-79" aria-expanded="false">
                                                    Contrôle conformité photo chantier
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-79">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Statut MaPrimeRénov</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-80" aria-expanded="false">
                                                    Statut MaPrimeRénov
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-80">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div>
                                            <div class="role-table__card__body__data">Motif rejet</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-84" aria-expanded="false">
                                                    Motif rejet
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-84">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Type de fournisseur</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-85" aria-expanded="false">
                                                    Type de fournisseur
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-85">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Réfèrent technique</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-86" aria-expanded="false">
                                                    Réfèrent technique
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-86">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Nature mouvement</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-87" aria-expanded="false">
                                                    Nature mouvement
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-87">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Entrepôt</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-88" aria-expanded="false">
                                                    Entrepôt
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-88">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div>
                                            <div class="role-table__card__body__data">Personnel autorise réception</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-89" aria-expanded="false">
                                                    Personnel autorise réception
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-89">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Statut Commande</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-90" aria-expanded="false">
                                                    Statut Commande
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-90">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Fournisseur materiel</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-91" aria-expanded="false">
                                                    Fournisseur materiel
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-91">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Type de livraison</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-92" aria-expanded="false">
                                                    Type de livraison
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-92">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Barèmes/Travaux/Tag</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-52" aria-expanded="false">
                                                    Barèmes/Travaux/Tag
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-52">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Délégataires') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-53" aria-expanded="false">
                                                    {{ __('Délégataires') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-53">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Deals / Tarifs') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-54" aria-expanded="false">
                                                    {{ __('Deals / Tarifs') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-54">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Entreprise de travaux</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-55" aria-expanded="false">
                                                    Entreprise de travaux
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-55">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('AMO') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-56" aria-expanded="false">
                                                    {{ __('AMO') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-56">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Mandataire Anah') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-57" aria-expanded="false">
                                                    {{ __('Mandataire Anah') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-57">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Auditeur énergétique') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-58" aria-expanded="false">
                                                    {{ __('Auditeur énergétique') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-58">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Zones d'intervention</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-59" aria-expanded="false">
                                                    Zones d'intervention
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-59">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">Bureau de contrôle</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-60" aria-expanded="false">
                                                    Bureau de contrôle
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-60">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Marques') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-61" aria-expanded="false">
                                                    {{ __('Marques') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-61">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Prestations') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-62" aria-expanded="false">
                                                    {{ __('Prestations') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-62">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Fournisseurs') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-63" aria-expanded="false">
                                                    {{ __('Fournisseurs') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-63">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Societé client') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-64" aria-expanded="false">
                                                    {{ __('Societé client') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-64">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Produits') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-65" aria-expanded="false">
                                                    {{ __('Produits') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-65">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Produits Catégorie') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-66" aria-expanded="false">
                                                    {{ __('Produits Catégorie') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-66">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="role-table__card__body__data">{{ __('Produits Sous-Catégorie') }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-67" aria-expanded="false">
                                                    {{ __('Produits Sous-Catégorie') }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-67">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Create') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--documents" aria-expanded="false">
                                    Documents
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--documents">
                                    <div class="overflow-hidden">
                                        @foreach ($documents as $document)
                                            <div class="role-table__card__body__data">{{ $document->name }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--stocks" aria-expanded="false">
                                    Stock
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--stocks">
                                    <div class="overflow-hidden"> 
                                        <div class="role-table__card__body__data">Dashboard</div> 
                                        <div class="role-table__card__body__data">Mouvements</div> 
                                        <div class="role-table__card">
                                            <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--stocks-mouvements" aria-expanded="false">
                                                Mouvements
                                            </button>
                                            <div class="role-table__card__body role-table__card__collapse permission--stocks-mouvements">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">Ajouter Entrée/Sortie</div>
                                                    <div class="role-table__card__body__data">Modifier</div> 
                                                    <div class="role-table__card__body__data">{{ __('Delete') }}</div> 
                                                    <div class="role-table__card__body__data">Activité</div> 
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="role-table__card__body__data">Etat des Stocks</div>
                                        <div class="role-table__card__body__data">Commandes</div>
                                        <div class="role-table__card">
                                            <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--stocks-commandes" aria-expanded="false">
                                                Commandes
                                            </button>
                                            <div class="role-table__card__body role-table__card__collapse permission--stocks-commandes">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">Ajouter Commande</div>
                                                    <div class="role-table__card__body__data">Modifier</div> 
                                                    <div class="role-table__card__body__data">{{ __('Delete') }}</div> 
                                                    <div class="role-table__card__body__data">Activité</div> 
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="role-table__card__body__data">Installations</div>
                                        <div class="role-table__card">
                                            <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--stocks-installations" aria-expanded="false">
                                                Installations
                                            </button>
                                            <div class="role-table__card__body role-table__card__collapse permission--stocks-installations">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">Véhicule</div>
                                                    <div class="role-table__card__body__data">Nouvelle Installation</div>
                                                    <div class="role-table__card__body__data">Modifier</div> 
                                                    <div class="role-table__card__body__data">Installtation Filtres</div> 
                                                    <div class="role-table__card__body__data">Installtation Télécharger</div>
                                                    <div class="role-table__card__body__data">{{ __('Delete') }}</div> 
                                                    <div class="role-table__card__body__data">Activité</div> 
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </aside>
                        <main class="role-table__main simple-bar">
                            <div class="role-table__main-wrapper">
                                @foreach ($categories as $category)
                                    <div class="role-table__col">
                                        <header class="role-table__header">
                                            <div class="role-table__header__top">
                                                <h5 class="role-table__header__top__title">{{ __('Category Name') }}</h5>
                                                <div class="dropdown dropdown--custom ml-auto">
                                                    <button class="btn border btn-sm shadow-none dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button type="button" class="dropdown-item editRoleBtn" id="editRoleBtn" data-role-id="{{ $category->id }}" data-role-name="{{ $category->name }}">
                                                            <span class="novecologie-icon-edit mr-1"></span>
                                                            {{ __('Edit') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <h3 class="role-table__header__title">{{ $category->name }}</h3>
                                        </header>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--module show">
                                                <div class="overflow-hidden">
                                                    @foreach ($headers as $header)
                                                    @if ($header->route == 'super_admin.landing')
                                                        @continue
                                                    @endif
                                                    @php
                                                        $permission = App\Models\CRM\RoleCategoryNavPermission::where('navigation_id', $header->id)->where('category_id', $category->id)->exists();
                                                    @endphp
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input data-role-id="{{ $category->id }}"
                                                            data-nav-id="{{ $header->id }}"
                                                            data-route="{{ $header->route }}" type="checkbox" {{ ($permission)? 'checked': '' }} class="circle-checkbox__input checkboxLabel">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    @endforeach

                                                    @foreach ($headerNotnav as $header)
                                                    @php
                                                        $permission2 = App\Models\CRM\RoleCategoryNavPermission::where('route', $header->route)->where('category_id', $category->id)->exists();
                                                    @endphp
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input {{ ($permission2)? 'checked': '' }}
                                                            data-role-id="{{ $category->id }}"
                                                            data-nav-id=""
                                                            data-route="{{ $header->route }}" type="checkbox" class="circle-checkbox__input checkboxLabel">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--lead">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'create'))checked  @endif value="1" data-module="lead" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'assign'))checked  @endif value="1" data-module="lead" data-action="assign" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'edit'))checked  @endif value="1" data-module="lead" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'delete'))checked  @endif value="1" data-module="lead" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'reset'))checked  @endif value="1" data-module="lead" data-action="reset" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'dispatch'))checked  @endif value="1" data-module="lead" data-action="dispatch" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'import')) checked @endif value="1" data-module="lead" data-action="import" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'export')) checked @endif value="1" data-module="lead" data-action="export" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'add_filter')) checked @endif value="1" data-module="lead" data-action="add_filter" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'filter_blue_button')) checked @endif value="1" data-module="lead" data-action="filter_blue_button" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'statut_blue_button')) checked @endif value="1" data-module="lead" data-action="statut_blue_button" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'rappel_create')) checked @endif value="1" data-module="lead" data-action="rappel_create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'rappel_edit')) checked @endif value="1" data-module="lead" data-action="rappel_edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'activity')) checked @endif value="1" data-module="lead" data-action="activity" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'create_comment')) checked @endif value="1" data-module="lead" data-action="create_comment" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'ringover')) checked @endif value="1" data-module="lead" data-action="ringover" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'assign_supplier')) checked @endif value="1" data-module="lead" data-action="assign_supplier" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'bulk_status')) checked @endif value="1" data-module="lead" data-action="bulk_status" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'similar-prospect')) checked @endif value="1" data-module="lead" data-action="similar-prospect" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'lead', 'similar-prospect-link')) checked @endif value="1" data-module="lead" data-action="similar-prospect-link" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--client">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'assign')) checked @endif value="1" data-module="client" data-action="assign" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'edit')) checked @endif value="1" data-module="client" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'delete')) checked @endif value="1" data-module="client" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'export')) checked @endif value="1" data-module="client" data-action="export" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'add_filter')) checked @endif value="1" data-module="client" data-action="add_filter" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'filter_blue_button')) checked @endif value="1" data-module="client" data-action="filter_blue_button" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'rappel_create')) checked @endif value="1" data-module="client" data-action="rappel_create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'rappel_edit')) checked @endif value="1" data-module="client" data-action="rappel_edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'activity')) checked @endif value="1" data-module="client" data-action="activity" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'create_comment')) checked @endif value="1" data-module="client" data-action="create_comment" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'client', 'ringover')) checked @endif value="1" data-module="client" data-action="ringover" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--project">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'create')) checked @endif value="1" data-module="project" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'assign')) checked @endif value="1" data-module="project" data-action="assign" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'edit')) checked @endif value="1" data-module="project" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'delete')) checked @endif value="1" data-module="project" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'import')) checked @endif value="1" data-module="project" data-action="import" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'add_filter')) checked @endif value="1" data-module="project" data-action="add_filter" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'filter_blue_button')) checked @endif value="1" data-module="project" data-action="filter_blue_button" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'blue_button')) checked @endif value="1" data-module="project" data-action="blue_button" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'mpr_button')) checked @endif value="1" data-module="project" data-action="mpr_button" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'statut_visible')) checked @endif value="1" data-module="project" data-action="statut_visible" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'statut_edit')) checked @endif value="1" data-module="project" data-action="statut_edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'rappel_create')) checked @endif value="1" data-module="project" data-action="rappel_create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'rappel_edit')) checked @endif value="1" data-module="project" data-action="rappel_edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'update')) checked @endif value="1" data-module="project" data-action="update" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>   --}}
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'add_tab')) checked @endif value="1" data-module="project" data-action="add_tab" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'activity')) checked @endif value="1" data-module="project" data-action="activity" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'lead-activity')) checked @endif value="1" data-module="project" data-action="lead-activity" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'timeline')) checked @endif value="1" data-module="project" data-action="timeline" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'create_comment')) checked @endif value="1" data-module="project" data-action="create_comment" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'ringover')) checked @endif value="1" data-module="project" data-action="ringover" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'magic-planning')) checked @endif value="1" data-module="project" data-action="magic-planning" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'similar-chantier')) checked @endif value="1" data-module="project" data-action="similar-chantier" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'similar-chantier-link')) checked @endif value="1" data-module="project" data-action="similar-chantier-link" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'pixel-create')) checked @endif value="1" data-module="project" data-action="pixel-create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'project', 'comment_category')) checked @endif value="1" data-module="project" data-action="comment_category" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>   --}}
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--ticketing">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'ticketing', 'create')) checked @endif value="1" data-module="ticketing" data-action="create" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'ticketing', 'assign')) checked @endif value="1" data-module="ticketing" data-action="assign" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'ticketing', 'comment')) checked @endif value="1" data-module="ticketing" data-action="comment" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'ticketing', 'close')) checked @endif value="1" data-module="ticketing" data-action="close" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--notion">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'notion', 'create')) checked @endif value="1" data-module="notion" data-action="create" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'notion', 'edit')) checked @endif value="1" data-module="notion" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--user">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'user', 'view')) checked @endif value="1" data-module="user" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'user', 'permission')) checked @endif value="1" data-module="user" data-action="permission" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'user', 'edit')) checked @endif value="1" data-module="user" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'user', 'delete')) checked @endif value="1" data-module="user" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--leadTab">
                                                <div class="overflow-hidden">
                                                    @foreach (getAllStaticTab() as $lead_tab)
                                                        @if ($lead_tab->slug == 'lead-tracking')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'lead_tab_access', $lead_tab->slug)) checked @endif value="1" data-module="lead_tab_access" data-action="{{ $lead_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_lead_tracing_lead', 'view')) checked @endif value="1" data-module="collapse_lead_tracing_lead" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_lead_tracing_lead', 'edit')) checked @endif value="1" data-module="collapse_lead_tracing_lead" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($lead_tab->slug == 'information-personnel')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'lead_tab_access', $lead_tab->slug)) checked @endif value="1" data-module="lead_tab_access" data-action="{{ $lead_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab1{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_tax_notice', 'view')) checked @endif value="1" data-module="lead_collapse_tax_notice" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_tax_notice', 'edit')) checked @endif value="1" data-module="lead_collapse_tax_notice" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab2{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_personal_information', 'view')) checked @endif value="1" data-module="lead_collapse_personal_information" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_personal_information', 'edit')) checked @endif value="1" data-module="lead_collapse_personal_information" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab3{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_eligibility', 'view')) checked @endif value="1" data-module="lead_collapse_eligibility" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_eligibility', 'edit')) checked @endif value="1" data-module="lead_collapse_eligibility" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab4{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_work_site', 'view')) checked @endif value="1" data-module="lead_collapse_work_site" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_work_site', 'edit')) checked @endif value="1" data-module="lead_collapse_work_site" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab5{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_situation_foyer', 'view')) checked @endif value="1" data-module="lead_collapse_situation_foyer" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_situation_foyer', 'edit')) checked @endif value="1" data-module="lead_collapse_situation_foyer" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($lead_tab->slug == 'information-logement')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'lead_tab_access', $lead_tab->slug)) checked @endif value="1" data-module="lead_tab_access" data-action="{{ $lead_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab1{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse__project', 'view')) checked @endif value="1" data-module="lead_collapse__project" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse__project', 'edit')) checked @endif value="1" data-module="lead_collapse__project" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--leadTab2{{ $lead_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_prescription_chantier', 'view')) checked @endif value="1" data-module="lead_collapse_prescription_chantier" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'lead_collapse_prescription_chantier', 'edit')) checked @endif value="1" data-module="lead_collapse_prescription_chantier" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--clientTab">
                                                <div class="overflow-hidden">
                                                    @foreach (getAllStaticTab() as $client_tab)
                                                        @if ($client_tab->slug == 'lead-tracking')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'client_tab_access', $client_tab->slug)) checked @endif value="1" data-module="client_tab_access" data-action="{{ $client_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--clientTab{{ $client_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_lead_tracing_client', 'view')) checked @endif value="1" data-module="collapse_lead_tracing_client" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_lead_tracing_client', 'edit')) checked @endif value="1" data-module="collapse_lead_tracing_client" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($client_tab->slug == 'information-personnel')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'client_tab_access', $client_tab->slug)) checked @endif value="1" data-module="client_tab_access" data-action="{{ $client_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--clientTab1{{ $client_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_tax_notice', 'view')) checked @endif value="1" data-module="client_collapse_tax_notice" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_tax_notice', 'edit')) checked @endif value="1" data-module="client_collapse_tax_notice" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--clientTab2{{ $client_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_personal_information', 'view')) checked @endif value="1" data-module="client_collapse_personal_information" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_personal_information', 'edit')) checked @endif value="1" data-module="client_collapse_personal_information" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--clientTab3{{ $client_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_eligibility', 'view')) checked @endif value="1" data-module="client_collapse_eligibility" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_eligibility', 'edit')) checked @endif value="1" data-module="client_collapse_eligibility" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--clientTab4{{ $client_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_work_site', 'view')) checked @endif value="1" data-module="client_collapse_work_site" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_work_site', 'edit')) checked @endif value="1" data-module="client_collapse_work_site" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--clientTab5{{ $client_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_situation_foyer', 'view')) checked @endif value="1" data-module="client_collapse_situation_foyer" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'client_collapse_situation_foyer', 'edit')) checked @endif value="1" data-module="client_collapse_situation_foyer" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--projectTab">
                                                <div class="overflow-hidden">
                                                    @foreach (getAllStaticTab() as $project_tab)
                                                        @if ($project_tab->slug == 'lead-tracking')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_lead_tracing', 'view')) checked @endif value="1" data-module="collapse_lead_tracing" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_lead_tracing', 'edit')) checked @endif value="1" data-module="collapse_lead_tracing" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'information-personnel')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input  @if (checkRoleCategoryAction($category->id, 'collapse_tax_notice', 'view')) checked @endif value="1" data-module="collapse_tax_notice" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_tax_notice', 'edit')) checked @endif value="1" data-module="collapse_tax_notice" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_personal_information', 'view')) checked @endif value="1" data-module="collapse_personal_information" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_personal_information', 'edit')) checked @endif value="1" data-module="collapse_personal_information" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab3{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_eligibility', 'view')) checked @endif value="1" data-module="collapse_eligibility" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_eligibility', 'edit')) checked @endif value="1" data-module="collapse_eligibility" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab4{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_work_site', 'view')) checked @endif value="1" data-module="collapse_work_site" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_work_site', 'edit')) checked @endif value="1" data-module="collapse_work_site" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab5{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_situation_foyer', 'view')) checked @endif value="1" data-module="collapse_situation_foyer" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input  @if (checkRoleCategoryAction($category->id, 'collapse_situation_foyer', 'edit')) checked @endif value="1" data-module="collapse_situation_foyer" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                         
                                                        @if ($project_tab->slug == 'section-projet')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_travaux', 'view')) checked @endif value="1" data-module="collapse_travaux" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_travaux', 'edit')) checked @endif value="1" data-module="collapse_travaux" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_question', 'view')) checked @endif value="1" data-module="collapse_question" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_question', 'edit')) checked @endif value="1" data-module="collapse_question" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'section-previsite')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_intervention_prev', 'view')) checked @endif value="1" data-module="collapse_intervention_prev" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_intervention_prev', 'edit')) checked @endif value="1" data-module="collapse_intervention_prev" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        @endif
                                                        @if ($project_tab->slug == 'section-MAPRIMERENOV')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab3{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_compte', 'view')) checked @endif value="1" data-module="collapse_compte" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_compte', 'edit')) checked @endif value="1" data-module="collapse_compte" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body collapse 1permission--projectTab4{{ $project_tab->id }}">
                                                                    <div class="role-table__card__body__data">
                                                                        <label class="circle-checkbox">
                                                                            <input @if (checkRoleCategoryAction($category->id, 'montant_disponible', 'view')) checked @endif value="1" data-module="montant_disponible" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                            <span class="circle-checkbox__label"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="role-table__card__body__data">
                                                                        <label class="circle-checkbox">
                                                                            <input @if (checkRoleCategoryAction($category->id, 'montant_disponible', 'edit')) checked @endif value="1" data-module="montant_disponible" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                            <span class="circle-checkbox__label"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_subvention', 'create')) checked @endif value="1" data-module="collapse_subvention" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_subvention', 'view')) checked @endif value="1" data-module="collapse_subvention" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_subvention', 'edit')) checked @endif value="1" data-module="collapse_subvention" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_suivi_mpr', 'view')) checked @endif value="1" data-module="collapse_suivi_mpr" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_suivi_mpr', 'edit')) checked @endif value="1" data-module="collapse_suivi_mpr" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'section-action-logement')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_informaton_2', 'view')) checked @endif value="1" data-module="collapse_informaton_2" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_informaton_2', 'edit')) checked @endif value="1" data-module="collapse_informaton_2" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'banque')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_depot', 'create')) checked @endif value="1" data-module="collapse_depot" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_depot', 'view')) checked @endif value="1" data-module="collapse_depot" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_depot', 'edit')) checked @endif value="1" data-module="collapse_depot" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'audit')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_audit', 'create')) checked @endif value="1" data-module="collapse_audit" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_audit', 'view')) checked @endif value="1" data-module="collapse_audit" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_audit', 'edit')) checked @endif value="1" data-module="collapse_audit" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'intervention')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_intervention', 'create')) checked @endif value="1" data-module="collapse_intervention" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_intervention', 'view')) checked @endif value="1" data-module="collapse_intervention" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_intervention', 'edit')) checked @endif value="1" data-module="collapse_intervention" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'rapports')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_rapports', 'create')) checked @endif value="1" data-module="collapse_rapports" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_rapports', 'view')) checked @endif value="1" data-module="collapse_rapports" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_rapports', 'edit')) checked @endif value="1" data-module="collapse_rapports" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'comptability')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'view')) checked @endif value="1" data-module="collapse_comptability" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'edit')) checked @endif value="1" data-module="collapse_comptability" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'create_operation_cee')) checked @endif value="1" data-module="collapse_comptability" data-action="create_operation_cee" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'edit_operation_cee')) checked @endif value="1" data-module="collapse_comptability" data-action="edit_operation_cee" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'delete_operation_cee')) checked @endif value="1" data-module="collapse_comptability" data-action="delete_operation_cee" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'create_prestations')) checked @endif value="1" data-module="collapse_comptability" data-action="create_prestations" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'edit_prestations')) checked @endif value="1" data-module="collapse_comptability" data-action="edit_prestations" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_comptability', 'delete_prestations')) checked @endif value="1" data-module="collapse_comptability" data-action="delete_prestations" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'section-controle-qualite')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__qc', 'create')) checked @endif value="1" data-module="collapse__qc" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__qc', 'view')) checked @endif value="1" data-module="collapse__qc" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__qc', 'edit')) checked @endif value="1" data-module="collapse__qc" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__qc', 'create_question')) checked @endif value="1" data-module="collapse__qc" data-action="create_question" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__qc', 'create_header')) checked @endif value="1" data-module="collapse__qc" data-action="create_header" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'section-sur-site')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__section_sur_site', 'create')) checked @endif value="1" data-module="collapse__section_sur_site" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__section_sur_site', 'view')) checked @endif value="1" data-module="collapse__section_sur_site" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse__section_sur_site', 'edit')) checked @endif value="1" data-module="collapse__section_sur_site" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'facturation')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_suivi_facturation', 'view')) checked @endif value="1" data-module="collapse_suivi_facturation" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_suivi_facturation', 'edit')) checked @endif value="1" data-module="collapse_suivi_facturation" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab2{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_controle_de_gestion', 'view')) checked @endif value="1" data-module="collapse_controle_de_gestion" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_controle_de_gestion', 'edit')) checked @endif value="1" data-module="collapse_controle_de_gestion" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'section-documents')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_generate_document', 'view')) checked @endif value="1" data-module="collapse_generate_document" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_generate_document', 'edit')) checked @endif value="1" data-module="collapse_generate_document" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'email')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_email', 'view')) checked @endif value="1" data-module="collapse_email" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_email', 'edit')) checked @endif value="1" data-module="collapse_email" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        @if ($project_tab->slug == 'demande_mairie')
                                                            <div class="role-table__card__body__data">
                                                                <label class="circle-checkbox">
                                                                    <input @if (checkRoleCategoryAction($category->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                    <span class="circle-checkbox__label"></span>
                                                                </label>
                                                            </div>
                                                            <div class="role-table__card">
                                                                <div class="role-table__card__head">
                                                                    {{ __('Access') }}
                                                                </div>
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_demande_mairie', 'create')) checked @endif value="1" data-module="collapse_demande_mairie" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_demande_mairie', 'view')) checked @endif value="1" data-module="collapse_demande_mairie" data-action="view" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkRoleCategoryAction($category->id, 'collapse_demande_mairie', 'edit')) checked @endif value="1" data-module="collapse_demande_mairie" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--general_settings">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'regie')) checked @endif value="1" data-module="general__setting" data-action="regie" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-1">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-regie', 'create')) checked @endif value="1" data-module="general__setting-regie" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-regie', 'edit')) checked @endif value="1" data-module="general__setting-regie" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-regie', 'delete')) checked @endif value="1" data-module="general__setting-regie" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'question')) checked @endif value="1" data-module="general__setting" data-action="question" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-2">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-question', 'create')) checked @endif value="1" data-module="general__setting-question" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-question', 'edit')) checked @endif value="1" data-module="general__setting-question" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-question', 'delete')) checked @endif value="1" data-module="general__setting-question" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'controle_des_documents')) checked @endif value="1" data-module="general__setting" data-action="controle_des_documents" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-6">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-controle_des_documents', 'create')) checked @endif value="1" data-module="general__setting-controle_des_documents" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-controle_des_documents', 'edit')) checked @endif value="1" data-module="general__setting-controle_des_documents" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-controle_des_documents', 'delete')) checked @endif value="1" data-module="general__setting-controle_des_documents" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'banque')) checked @endif value="1" data-module="general__setting" data-action="banque" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-7">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-banque', 'create')) checked @endif value="1" data-module="general__setting-banque" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-banque', 'edit')) checked @endif value="1" data-module="general__setting-banque" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-banque', 'delete')) checked @endif value="1" data-module="general__setting-banque" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'status_audit')) checked @endif value="1" data-module="general__setting" data-action="status_audit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-9">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_audit', 'create')) checked @endif value="1" data-module="general__setting-status_audit" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_audit', 'edit')) checked @endif value="1" data-module="general__setting-status_audit" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_audit', 'delete')) checked @endif value="1" data-module="general__setting-status_audit" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'status_rapport_audit')) checked @endif value="1" data-module="general__setting" data-action="status_rapport_audit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-10">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_rapport_audit', 'create')) checked @endif value="1" data-module="general__setting-status_rapport_audit" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_rapport_audit', 'edit')) checked @endif value="1" data-module="general__setting-status_rapport_audit" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_rapport_audit', 'delete')) checked @endif value="1" data-module="general__setting-status_rapport_audit" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'resultat_du_rapport')) checked @endif value="1" data-module="general__setting" data-action="resultat_du_rapport" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-11">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-resultat_du_rapport', 'create')) checked @endif value="1" data-module="general__setting-resultat_du_rapport" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-resultat_du_rapport', 'edit')) checked @endif value="1" data-module="general__setting-resultat_du_rapport" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-resultat_du_rapport', 'delete')) checked @endif value="1" data-module="general__setting-resultat_du_rapport" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'commercial_terrain')) checked @endif value="1" data-module="general__setting" data-action="commercial_terrain" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-12">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-commercial_terrain', 'create')) checked @endif value="1" data-module="general__setting-commercial_terrain" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-commercial_terrain', 'edit')) checked @endif value="1" data-module="general__setting-commercial_terrain" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-commercial_terrain', 'delete')) checked @endif value="1" data-module="general__setting-commercial_terrain" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'status_du_probleme_ticket')) checked @endif value="1" data-module="general__setting" data-action="status_du_probleme_ticket" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-49">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_du_probleme_ticket', 'create')) checked @endif value="1" data-module="general__setting-status_du_probleme_ticket" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_du_probleme_ticket', 'edit')) checked @endif value="1" data-module="general__setting-status_du_probleme_ticket" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_du_probleme_ticket', 'delete')) checked @endif value="1" data-module="general__setting-status_du_probleme_ticket" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'type_energie_chaud')) checked @endif value="1" data-module="general__setting" data-action="type_energie_chaud" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-50">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_energie_chaud', 'create')) checked @endif value="1" data-module="general__setting-type_energie_chaud" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_energie_chaud', 'edit')) checked @endif value="1" data-module="general__setting-type_energie_chaud" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_energie_chaud', 'delete')) checked @endif value="1" data-module="general__setting-type_energie_chaud" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'prestations_group')) checked @endif value="1" data-module="general__setting" data-action="prestations_group" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-51">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-prestations_group', 'create')) checked @endif value="1" data-module="general__setting-prestations_group" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-prestations_group', 'edit')) checked @endif value="1" data-module="general__setting-prestations_group" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-prestations_group', 'delete')) checked @endif value="1" data-module="general__setting-prestations_group" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'comment_category')) checked @endif value="1" data-module="general__setting" data-action="comment_category" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-68">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-comment_category', 'create')) checked @endif value="1" data-module="general__setting-comment_category" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-comment_category', 'edit')) checked @endif value="1" data-module="general__setting-comment_category" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-comment_category', 'delete')) checked @endif value="1" data-module="general__setting-comment_category" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'quality_control')) checked @endif value="1" data-module="general__setting" data-action="quality_control" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-69">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-quality_control', 'create')) checked @endif value="1" data-module="general__setting-quality_control" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-quality_control', 'edit')) checked @endif value="1" data-module="general__setting-quality_control" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-quality_control', 'view')) checked @endif value="1" data-module="general__setting-quality_control" data-action="view" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-quality_control', 'delete')) checked @endif value="1" data-module="general__setting-quality_control" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'notion_category')) checked @endif value="1" data-module="general__setting" data-action="notion_category" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-70">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-notion_category', 'create')) checked @endif value="1" data-module="general__setting-notion_category" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-notion_category', 'edit')) checked @endif value="1" data-module="general__setting-notion_category" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-notion_category', 'delete')) checked @endif value="1" data-module="general__setting-notion_category" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'notion_sub_category')) checked @endif value="1" data-module="general__setting" data-action="notion_sub_category" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-82">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-notion_sub_category', 'create')) checked @endif value="1" data-module="general__setting-notion_sub_category" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-notion_sub_category', 'edit')) checked @endif value="1" data-module="general__setting-notion_sub_category" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-notion_sub_category', 'delete')) checked @endif value="1" data-module="general__setting-notion_sub_category" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'lead_sub_status')) checked @endif value="1" data-module="general__setting" data-action="lead_sub_status" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-71">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-lead_sub_status', 'create')) checked @endif value="1" data-module="general__setting-lead_sub_status" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-lead_sub_status', 'edit')) checked @endif value="1" data-module="general__setting-lead_sub_status" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-lead_sub_status', 'delete')) checked @endif value="1" data-module="general__setting-lead_sub_status" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'heating_mode')) checked @endif value="1" data-module="general__setting" data-action="heating_mode" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-72">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-heating_mode', 'create')) checked @endif value="1" data-module="general__setting-heating_mode" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-heating_mode', 'edit')) checked @endif value="1" data-module="general__setting-heating_mode" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-heating_mode', 'delete')) checked @endif value="1" data-module="general__setting-heating_mode" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'campagne_type')) checked @endif value="1" data-module="general__setting" data-action="campagne_type" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-73">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-campagne_type', 'create')) checked @endif value="1" data-module="general__setting-campagne_type" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-campagne_type', 'edit')) checked @endif value="1" data-module="general__setting-campagne_type" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-campagne_type', 'delete')) checked @endif value="1" data-module="general__setting-campagne_type" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'project_sub_status')) checked @endif value="1" data-module="general__setting" data-action="project_sub_status" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-74">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_sub_status', 'create')) checked @endif value="1" data-module="general__setting-project_sub_status" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_sub_status', 'edit')) checked @endif value="1" data-module="general__setting-project_sub_status" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_sub_status', 'delete')) checked @endif value="1" data-module="general__setting-project_sub_status" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'status_planning_intervention')) checked @endif value="1" data-module="general__setting" data-action="status_planning_intervention" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-76">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_planning_intervention', 'create')) checked @endif value="1" data-module="general__setting-status_planning_intervention" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_planning_intervention', 'edit')) checked @endif value="1" data-module="general__setting-status_planning_intervention" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-status_planning_intervention', 'delete')) checked @endif value="1" data-module="general__setting-status_planning_intervention" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'project_ko_reason')) checked @endif value="1" data-module="general__setting" data-action="project_ko_reason" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-77">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_ko_reason', 'create')) checked @endif value="1" data-module="general__setting-project_ko_reason" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_ko_reason', 'edit')) checked @endif value="1" data-module="general__setting-project_ko_reason" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_ko_reason', 'delete')) checked @endif value="1" data-module="general__setting-project_ko_reason" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'project_reflection_reason')) checked @endif value="1" data-module="general__setting" data-action="project_reflection_reason" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-78">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_reflection_reason', 'create')) checked @endif value="1" data-module="general__setting-project_reflection_reason" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_reflection_reason', 'edit')) checked @endif value="1" data-module="general__setting-project_reflection_reason" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_reflection_reason', 'delete')) checked @endif value="1" data-module="general__setting-project_reflection_reason" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'project_control_photo')) checked @endif value="1" data-module="general__setting" data-action="project_control_photo" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-79">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_control_photo', 'create')) checked @endif value="1" data-module="general__setting-project_control_photo" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_control_photo', 'edit')) checked @endif value="1" data-module="general__setting-project_control_photo" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-project_control_photo', 'delete')) checked @endif value="1" data-module="general__setting-project_control_photo" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'statut_maprimerenov')) checked @endif value="1" data-module="general__setting" data-action="statut_maprimerenov" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-80">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-statut_maprimerenov', 'create')) checked @endif value="1" data-module="general__setting-statut_maprimerenov" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-statut_maprimerenov', 'edit')) checked @endif value="1" data-module="general__setting-statut_maprimerenov" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-statut_maprimerenov', 'delete')) checked @endif value="1" data-module="general__setting-statut_maprimerenov" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'reject_reason')) checked @endif value="1" data-module="general__setting" data-action="reject_reason" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-84">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-reject_reason', 'create')) checked @endif value="1" data-module="general__setting-reject_reason" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-reject_reason', 'edit')) checked @endif value="1" data-module="general__setting-reject_reason" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-reject_reason', 'delete')) checked @endif value="1" data-module="general__setting-reject_reason" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'type_fournisseur')) checked @endif value="1" data-module="general__setting" data-action="type_fournisseur" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-85">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_fournisseur', 'create')) checked @endif value="1" data-module="general__setting-type_fournisseur" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_fournisseur', 'edit')) checked @endif value="1" data-module="general__setting-type_fournisseur" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_fournisseur', 'delete')) checked @endif value="1" data-module="general__setting-type_fournisseur" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'technical_referee')) checked @endif value="1" data-module="general__setting" data-action="technical_referee" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-86">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-technical_referee', 'create')) checked @endif value="1" data-module="general__setting-technical_referee" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-technical_referee', 'edit')) checked @endif value="1" data-module="general__setting-technical_referee" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-technical_referee', 'delete')) checked @endif value="1" data-module="general__setting-technical_referee" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'nature_mouvement')) checked @endif value="1" data-module="general__setting" data-action="nature_mouvement" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-87">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-nature_mouvement', 'create')) checked @endif value="1" data-module="general__setting-nature_mouvement" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-nature_mouvement', 'edit')) checked @endif value="1" data-module="general__setting-nature_mouvement" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-nature_mouvement', 'delete')) checked @endif value="1" data-module="general__setting-nature_mouvement" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'entrepot')) checked @endif value="1" data-module="general__setting" data-action="entrepot" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-88">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-entrepot', 'create')) checked @endif value="1" data-module="general__setting-entrepot" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-entrepot', 'edit')) checked @endif value="1" data-module="general__setting-entrepot" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-entrepot', 'delete')) checked @endif value="1" data-module="general__setting-entrepot" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'personnel_autorise_reception')) checked @endif value="1" data-module="general__setting" data-action="personnel_autorise_reception" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-89">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-personnel_autorise_reception', 'create')) checked @endif value="1" data-module="general__setting-personnel_autorise_reception" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-personnel_autorise_reception', 'edit')) checked @endif value="1" data-module="general__setting-personnel_autorise_reception" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-personnel_autorise_reception', 'delete')) checked @endif value="1" data-module="general__setting-personnel_autorise_reception" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'statut_commande')) checked @endif value="1" data-module="general__setting" data-action="statut_commande" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-90">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-statut_commande', 'create')) checked @endif value="1" data-module="general__setting-statut_commande" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-statut_commande', 'edit')) checked @endif value="1" data-module="general__setting-statut_commande" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-statut_commande', 'delete')) checked @endif value="1" data-module="general__setting-statut_commande" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'fournisseur_materiel')) checked @endif value="1" data-module="general__setting" data-action="fournisseur_materiel" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-91">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-fournisseur_materiel', 'create')) checked @endif value="1" data-module="general__setting-fournisseur_materiel" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-fournisseur_materiel', 'edit')) checked @endif value="1" data-module="general__setting-fournisseur_materiel" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-fournisseur_materiel', 'delete')) checked @endif value="1" data-module="general__setting-fournisseur_materiel" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'type_de_livraison')) checked @endif value="1" data-module="general__setting" data-action="type_de_livraison" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-92">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_de_livraison', 'create')) checked @endif value="1" data-module="general__setting-type_de_livraison" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_de_livraison', 'edit')) checked @endif value="1" data-module="general__setting-type_de_livraison" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-type_de_livraison', 'delete')) checked @endif value="1" data-module="general__setting-type_de_livraison" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'baremes')) checked @endif value="1" data-module="general__setting" data-action="baremes" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-52">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-baremes', 'create')) checked @endif value="1" data-module="general__setting-baremes" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-baremes', 'edit')) checked @endif value="1" data-module="general__setting-baremes" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-baremes', 'delete')) checked @endif value="1" data-module="general__setting-baremes" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'delegataires')) checked @endif value="1" data-module="general__setting" data-action="delegataires" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-53">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-delegataires', 'create')) checked @endif value="1" data-module="general__setting-delegataires" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-delegataires', 'edit')) checked @endif value="1" data-module="general__setting-delegataires" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-delegataires', 'delete')) checked @endif value="1" data-module="general__setting-delegataires" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'deals_tarifs')) checked @endif value="1" data-module="general__setting" data-action="deals_tarifs" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-54">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-deals_tarifs', 'create')) checked @endif value="1" data-module="general__setting-deals_tarifs" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-deals_tarifs', 'edit')) checked @endif value="1" data-module="general__setting-deals_tarifs" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-deals_tarifs', 'delete')) checked @endif value="1" data-module="general__setting-deals_tarifs" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'installateurs_rge')) checked @endif value="1" data-module="general__setting" data-action="installateurs_rge" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-55">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-installateurs_rge', 'create')) checked @endif value="1" data-module="general__setting-installateurs_rge" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-installateurs_rge', 'edit')) checked @endif value="1" data-module="general__setting-installateurs_rge" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-installateurs_rge', 'delete')) checked @endif value="1" data-module="general__setting-installateurs_rge" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'amo')) checked @endif value="1" data-module="general__setting" data-action="amo" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-56">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-amo', 'create')) checked @endif value="1" data-module="general__setting-amo" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-amo', 'edit')) checked @endif value="1" data-module="general__setting-amo" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-amo', 'delete')) checked @endif value="1" data-module="general__setting-amo" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'mandataire_anah')) checked @endif value="1" data-module="general__setting" data-action="mandataire_anah" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-57">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-mandataire_anah', 'create')) checked @endif value="1" data-module="general__setting-mandataire_anah" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-mandataire_anah', 'edit')) checked @endif value="1" data-module="general__setting-mandataire_anah" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-mandataire_anah', 'delete')) checked @endif value="1" data-module="general__setting-mandataire_anah" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'auditeur_energetique')) checked @endif value="1" data-module="general__setting" data-action="auditeur_energetique" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-58">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-auditeur_energetique', 'create')) checked @endif value="1" data-module="general__setting-auditeur_energetique" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-auditeur_energetique', 'edit')) checked @endif value="1" data-module="general__setting-auditeur_energetique" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-auditeur_energetique', 'delete')) checked @endif value="1" data-module="general__setting-auditeur_energetique" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'zones_d_intervention')) checked @endif value="1" data-module="general__setting" data-action="zones_d_intervention" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-59">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-zones_d_intervention', 'create')) checked @endif value="1" data-module="general__setting-zones_d_intervention" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-zones_d_intervention', 'edit')) checked @endif value="1" data-module="general__setting-zones_d_intervention" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-zones_d_intervention', 'delete')) checked @endif value="1" data-module="general__setting-zones_d_intervention" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'bureaux_de_controle')) checked @endif value="1" data-module="general__setting" data-action="bureaux_de_controle" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-60">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-bureaux_de_controle', 'create')) checked @endif value="1" data-module="general__setting-bureaux_de_controle" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-bureaux_de_controle', 'edit')) checked @endif value="1" data-module="general__setting-bureaux_de_controle" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-bureaux_de_controle', 'delete')) checked @endif value="1" data-module="general__setting-bureaux_de_controle" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'marques')) checked @endif value="1" data-module="general__setting" data-action="marques" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-61">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-marques', 'create')) checked @endif value="1" data-module="general__setting-marques" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-marques', 'edit')) checked @endif value="1" data-module="general__setting-marques" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-marques', 'delete')) checked @endif value="1" data-module="general__setting-marques" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'prestations')) checked @endif value="1" data-module="general__setting" data-action="prestations" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-62">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-prestations', 'create')) checked @endif value="1" data-module="general__setting-prestations" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-prestations', 'edit')) checked @endif value="1" data-module="general__setting-prestations" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-prestations', 'delete')) checked @endif value="1" data-module="general__setting-prestations" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'fournisseurs')) checked @endif value="1" data-module="general__setting" data-action="fournisseurs" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-63">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-fournisseurs', 'create')) checked @endif value="1" data-module="general__setting-fournisseurs" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-fournisseurs', 'edit')) checked @endif value="1" data-module="general__setting-fournisseurs" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-fournisseurs', 'delete')) checked @endif value="1" data-module="general__setting-fournisseurs" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'societe_client')) checked @endif value="1" data-module="general__setting" data-action="societe_client" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-64">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-societe_client', 'create')) checked @endif value="1" data-module="general__setting-societe_client" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-societe_client', 'edit')) checked @endif value="1" data-module="general__setting-societe_client" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-societe_client', 'delete')) checked @endif value="1" data-module="general__setting-societe_client" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'produits')) checked @endif value="1" data-module="general__setting" data-action="produits" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-65">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits', 'create')) checked @endif value="1" data-module="general__setting-produits" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits', 'edit')) checked @endif value="1" data-module="general__setting-produits" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits', 'delete')) checked @endif value="1" data-module="general__setting-produits" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'produits_categorie')) checked @endif value="1" data-module="general__setting" data-action="produits_categorie" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-66">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits_categorie', 'create')) checked @endif value="1" data-module="general__setting-produits_categorie" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits_categorie', 'edit')) checked @endif value="1" data-module="general__setting-produits_categorie" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits_categorie', 'delete')) checked @endif value="1" data-module="general__setting-produits_categorie" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'general__setting', 'produits_sous_categorie')) checked @endif value="1" data-module="general__setting" data-action="produits_sous_categorie" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--general_settings-67">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits_sous_categorie', 'create')) checked @endif value="1" data-module="general__setting-produits_sous_categorie" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits_sous_categorie', 'edit')) checked @endif value="1" data-module="general__setting-produits_sous_categorie" data-action="edit" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'general__setting-produits_sous_categorie', 'delete')) checked @endif value="1" data-module="general__setting-produits_sous_categorie" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--documents">
                                                <div class="overflow-hidden">
                                                    @foreach ($documents as $document)
                                                        <div class="role-table__card__body__data">
                                                            <label class="circle-checkbox">
                                                                <input @if (checkRoleCategoryAction($category->id, 'document-file', $document->id)) checked @endif value="1" data-module="document-file" data-action="{{ $document->id }}" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                <span class="circle-checkbox__label"></span>
                                                            </label>
                                                        </div>
                                                    @endforeach 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--stocks">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'stocks', 'dashboard')) checked @endif value="1" data-module="stocks" data-action="dashboard" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'stocks', 'mouvements')) checked @endif value="1" data-module="stocks" data-action="mouvements" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--stocks-mouvements">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_mouvements', 'create')) checked @endif value="1" data-module="stocks_mouvements" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_mouvements', 'edit')) checked @endif value="1" data-module="stocks_mouvements" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_mouvements', 'delete')) checked @endif value="1" data-module="stocks_mouvements" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_mouvements', 'activity')) checked @endif value="1" data-module="stocks_mouvements" data-action="activity" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'stocks', 'etat_des_stocks')) checked @endif value="1" data-module="stocks" data-action="etat_des_stocks" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'stocks', 'commandes')) checked @endif value="1" data-module="stocks" data-action="commandes" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--stocks-commandes">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_commandes', 'create')) checked @endif value="1" data-module="stocks_commandes" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_commandes', 'edit')) checked @endif value="1" data-module="stocks_commandes" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_commandes', 'delete')) checked @endif value="1" data-module="stocks_commandes" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_commandes', 'activity')) checked @endif value="1" data-module="stocks_commandes" data-action="activity" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkRoleCategoryAction($category->id, 'stocks', 'installations')) checked @endif value="1" data-module="stocks" data-action="installations" data-role-id="{{ $category->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--stocks-installations">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_installations', 'vehicle')) checked @endif value="1" data-module="stocks_installations" data-action="vehicle" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_installations', 'create')) checked @endif value="1" data-module="stocks_installations" data-action="create" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_installations', 'edit')) checked @endif value="1" data-module="stocks_installations" data-action="edit" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_installations', 'filter')) checked @endif value="1" data-module="stocks_installations" data-action="filter" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_installations', 'export')) checked @endif value="1" data-module="stocks_installations" data-action="export" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_installations', 'delete')) checked @endif value="1" data-module="stocks_installations" data-action="delete" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkRoleCategoryAction($category->id, 'stocks_installations', 'activity')) checked @endif value="1" data-module="stocks_installations" data-action="activity" data-role-id="{{ $category->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Middle Modal -->
    <div class="modal modal--aside fade" id="middleModal" tabindex="-1" aria-labelledby="middleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form action="{{ route('role.category.store') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
                        @csrf
                        <h1 class="form__title position-relative text-center mb-4">{{ __('Create Role Category') }}</h1>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="text" name="name" class="form-control shadow-none rounded" placeholder="{{ __('New Role Category Name') }}" required>
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{ __('Create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Middle Modal -->
    <div class="modal modal--aside fade" id="middleModal2" tabindex="-1" aria-labelledby="middleModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close d-inline-flex align-items-center justify-content-center rounded-circle m-0 p-0 ml-auto" data-dismiss="modal" aria-label="Close">
                        <span class="novecologie-icon-close"></span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form action="{{ route('role.category.update') }}" method="POST" class="form mx-auto needs-validation" id="login-form" novalidate>
                        @csrf
                        <h1 class="form__title position-relative text-center mb-4">{{__('Update Role Category')}}</h1>
                        <div class="form-group d-flex flex-column align-items-center position-relative">
                            <input type="text" name="name" id="role_name_update" class="form-control shadow-none rounded"required>
                            <input type="hidden" name="role_id" id="role_id_update">
                            <div class="invalid-feedback">{{ __('This field is necessary') }}</div>
                        </div>
                        <div class="form-group d-flex flex-column align-items-center mt-4">
                            <button type="submit" class="primary-btn primary-btn--primary primary-btn--lg rounded border-0 mb-3">{{__('Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $('.checkboxLabel').click(function(){

            var category_id = $(this).attr('data-role-id');
            var nav_id  = $(this).attr('data-nav-id');
            var route   = $(this).attr('data-route');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(this.checked){
                var value = 'yes';
            }else{
                var value = 'no';
            }
            $.ajax({

                url: "{{ route('category.permission.update') }}",
                type:"POST",
                data:{
                    category_id     :category_id,
                    navigation_id   : nav_id,
                    value           :value,
                    route           :route,
                },
                success:function(data){
                    $('#successMessage').text(data);
					$('.toast.toast--success').toast('show');
                },
            });

        });

        // edit modal call
        $(".editRoleBtn").on("click", function (e) {

           var role_id = $(this).attr('data-role-id');
           var name = $(this).attr('data-role-name');

            $('#role_name_update').val(name);
            $('#role_id_update').val(role_id);

			$('#middleModal2').modal('show')
		});

        // permission added
        $('body').on('click', '.permission_btn_check', function(){
            var module_name = $(this).attr('data-module');
            var action = $(this).attr('data-action');
            var category_id =$(this).attr('data-role-id');

            $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url :"{{ route('role.category.permission.action') }}",
					data: {
						module_name 	: module_name,
						action_name 	: action,
						category_id 	: category_id,
					},

					success: function(data){
						console.log(data);
                        $('#successMessage').text(data);
						$('.toast.toast--success').toast('show');
					},

				});
        });

        $(document).ready(function () {
            $(document).on('click', '[data-toggle="css-collapse"]', function(){
                if($(this).attr('aria-expanded') == 'true'){
                    $(this).attr('aria-expanded', false);
                    $($(this).data('target')).removeClass('show');
                }else{
                    $($(this).data('target')).addClass('show');
                    $(this).attr('aria-expanded', true);
                }
            })
        });

    </script>
@endpush
