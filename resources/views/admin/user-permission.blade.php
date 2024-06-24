@extends('layouts.master')

{{-- Title part  --}}
@section('title')
    Autorisation de l'utilisateur
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
            <div class="row justify-content-center"> 
                <div class="col-md-8">
                    <div class="role-table">
                        <aside class="role-table__aside"> 
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
                            {{-- <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--todo" aria-expanded="false">
                                    {{ __('Todo') }}
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--todo">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Add Task') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Add Tags') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--calendar" aria-expanded="false">
                                    {{ __('Calendar') }}
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--calendar">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Create Event') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Edit Event') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Create Event Category') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Edit Event Category') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Delete Event Category') }}</div>
                                    </div>
                                </div>
                            </div> --}}
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
                            {{-- <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--app" aria-expanded="false">
                                    {{ __('App Permission') }}
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--app">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Access to app') }}</div>
                                    </div>
                                </div>
                            </div> --}}
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
                                        {{-- <div class="role-table__card__body__data">{{ __('Custom Field') }}</div>
                                        <div class="role-table__card">
                                            <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--leadTabCustom" aria-expanded="false">
                                                {{ __('Custom Field') }}
                                            </button>
                                            <div class="role-table__card__body role-table__card__collapse permission--leadTabCustom">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">{{ __('Add field') }}</div>
                                                    <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                    <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                </div>
                                            </div>
                                        </div> --}}
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
                                                            <div class="role-table__card__body__data">{{ __('Delete') }}</div>
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
                                                            <div class="role-table__card__body__data">{{ __('Delete') }}</div>
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
                                                            <div class="role-table__card__body__data">{{ __('Delete') }}</div>
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
                                                            <div class="role-table__card__body__data">{{ __('Delete') }}</div>
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
                                                            <div class="role-table__card__body__data">{{ __('Delete') }}</div>
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
                                                            <div class="role-table__card__body__data">{{ __('Delete') }}</div>
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
                                                            <div class="role-table__card__body__data">{{ __('Delete') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectCustomTab" aria-expanded="false">
                                    {{ __('Project Custom Tab') }}
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--projectCustomTab">
                                    <div class="overflow-hidden">
                                        @foreach (\App\Models\CRM\CustomTab::all() as $c_tab)
                                            <div class="role-table__card__body__data">{{ $c_tab->name }}</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--projectCustomTab{{ $c_tab->id }}" aria-expanded="false">
                                                    {{ $c_tab->item_name }}
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--projectCustomTab{{ $c_tab->id }}">
                                                    <div class="overflow-hidden">
                                                        <div class="role-table__card__body__data">{{ __('Add Field') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('View') }}</div>
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> --}}
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
                                            <div class="role-table__card__body__data">Paramètres de couleur utilisateur</div>
                                            <div class="role-table__card">
                                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--general_settings-87" aria-expanded="false">
                                                    Paramètres de couleur utilisateur
                                                </button>
                                                <div class="role-table__card__body role-table__card__collapse permission--general_settings-87">
                                                    <div class="overflow-hidden"> 
                                                        <div class="role-table__card__body__data">{{ __('Edit') }}</div> 
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

                            {{-- <div class="role-table__card">
                                <button class="role-table__card__head" type="button" data-toggle="css-collapse" data-target=".permission--other" aria-expanded="false">
                                    {{ __('Others') }}
                                </button>
                                <div class="role-table__card__body role-table__card__collapse permission--other">
                                    <div class="overflow-hidden">
                                        <div class="role-table__card__body__data">{{ __('Produits') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Project Financement') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Status Planning') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Status Insatallation') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Statut previsite') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Statut Client Prévisite') }}</div>
                                        <div class="role-table__card__body__data">{{ __('PDF Generate') }}</div>
                                        <div class="role-table__card__body__data">{{ __('Document Generate') }}</div>
                                    </div>
                                </div>
                            </div> --}}

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
                                    <div class="role-table__col"> 
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
                                                        $permission = App\Models\CRM\Permission::where('navigation_id', $header->id)->where('user_id', $user->id)->exists();
                                                    @endphp
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input data-user-id="{{ $user->id }}"
                                                            data-role-id="{{ $user->role_id }}" 
                                                            data-nav-id="{{ $header->id }}"
                                                            data-route="{{ $header->route }}" type="checkbox" {{ ($permission)? 'checked': '' }} class="circle-checkbox__input checkboxLabel">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    @endforeach

                                                    @foreach ($headerNotnav as $header)
                                                    @php 
                                                        $permission2 = App\Models\CRM\Permission::where('name', $header->route)->where('user_id', $user->id)->exists();
                                                    @endphp
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input {{ ($permission2)? 'checked': '' }}
                                                            data-user-id="{{ $user->id }}"
                                                            data-role-id="{{ $user->role_id }}" 
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
                                                            <input @if (checkAction($user->id, 'lead', 'create'))checked  @endif value="1" data-module="lead" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'assign'))checked  @endif value="1" data-module="lead" data-action="assign" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'edit'))checked  @endif value="1" data-module="lead" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'delete'))checked  @endif value="1" data-module="lead" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'reset'))checked  @endif value="1" data-module="lead" data-action="reset" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'dispatch'))checked  @endif value="1" data-module="lead" data-action="dispatch" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'import')) checked @endif value="1" data-module="lead" data-action="import" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'export')) checked @endif value="1" data-module="lead" data-action="export" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'add_filter')) checked @endif value="1" data-module="lead" data-action="add_filter" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'filter_blue_button')) checked @endif value="1" data-module="lead" data-action="filter_blue_button" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'statut_blue_button')) checked @endif value="1" data-module="lead" data-action="statut_blue_button" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'rappel_create')) checked @endif value="1" data-module="lead" data-action="rappel_create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'rappel_edit')) checked @endif value="1" data-module="lead" data-action="rappel_edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'activity')) checked @endif value="1" data-module="lead" data-action="activity" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'create_comment')) checked @endif value="1" data-module="lead" data-action="create_comment" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'ringover')) checked @endif value="1" data-module="lead" data-action="ringover" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'assign_supplier')) checked @endif value="1" data-module="lead" data-action="assign_supplier" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'bulk_status')) checked @endif value="1" data-module="lead" data-action="bulk_status" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'similar-prospect')) checked @endif value="1" data-module="lead" data-action="similar-prospect" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead', 'similar-prospect-link')) checked @endif value="1" data-module="lead" data-action="similar-prospect-link" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                            <input @if (checkAction($user->id, 'client', 'assign')) checked @endif value="1" data-module="client" data-action="assign" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'edit')) checked @endif value="1" data-module="client" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'delete')) checked @endif value="1" data-module="client" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'export')) checked @endif value="1" data-module="client" data-action="export" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'add_filter')) checked @endif value="1" data-module="client" data-action="add_filter" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'filter_blue_button')) checked @endif value="1" data-module="client" data-action="filter_blue_button" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'rappel_create')) checked @endif value="1" data-module="client" data-action="rappel_create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'rappel_edit')) checked @endif value="1" data-module="client" data-action="rappel_edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'activity')) checked @endif value="1" data-module="client" data-action="activity" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'create_comment')) checked @endif value="1" data-module="client" data-action="create_comment" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'client', 'ringover')) checked @endif value="1" data-module="client" data-action="ringover" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                            <input @if (checkAction($user->id, 'project', 'create')) checked @endif value="1" data-module="project" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'assign')) checked @endif value="1" data-module="project" data-action="assign" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'edit')) checked @endif value="1" data-module="project" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'delete')) checked @endif value="1" data-module="project" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'import')) checked @endif value="1" data-module="project" data-action="import" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'add_filter')) checked @endif value="1" data-module="project" data-action="add_filter" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'filter_blue_button')) checked @endif value="1" data-module="project" data-action="filter_blue_button" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'blue_button')) checked @endif value="1" data-module="project" data-action="blue_button" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'mpr_button')) checked @endif value="1" data-module="project" data-action="mpr_button" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'statut_visible')) checked @endif value="1" data-module="project" data-action="statut_visible" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'statut_edit')) checked @endif value="1" data-module="project" data-action="statut_edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'rappel_create')) checked @endif value="1" data-module="project" data-action="rappel_create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'rappel_edit')) checked @endif value="1" data-module="project" data-action="rappel_edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'add_tab')) checked @endif value="1" data-module="project" data-action="add_tab" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'activity')) checked @endif value="1" data-module="project" data-action="activity" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'lead-activity')) checked @endif value="1" data-module="project" data-action="lead-activity" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'timeline')) checked @endif value="1" data-module="project" data-action="timeline" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'create_comment')) checked @endif value="1" data-module="project" data-action="create_comment" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'ringover')) checked @endif value="1" data-module="project" data-action="ringover" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'magic-planning')) checked @endif value="1" data-module="project" data-action="magic-planning" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'similar-chantier')) checked @endif value="1" data-module="project" data-action="similar-chantier" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'similar-chantier-link')) checked @endif value="1" data-module="project" data-action="similar-chantier-link" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'project', 'pixel-create')) checked @endif value="1" data-module="project" data-action="pixel-create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--todo">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'todo', 'add task')) checked @endif value="1" data-module="todo" data-action="add task" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'todo', 'add tags')) checked @endif value="1" data-module="todo" data-action="add tags" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'todo', 'edit')) checked @endif value="1" data-module="todo" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'todo', 'delete')) checked @endif value="1" data-module="todo" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--calendar">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input  @if (checkAction($user->id, 'calendar', 'add event')) checked @endif value="1" data-module="calendar" data-action="add event" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'calendar', 'edit')) checked @endif value="1" data-module="calendar" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'event_category', 'create')) checked @endif value="1" data-module="event_category" data-action="create" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'event_category', 'edit')) checked @endif value="1" data-module="event_category" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'event_category', 'delete')) checked @endif value="1" data-module="event_category" data-action="delete" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--ticketing">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'ticketing', 'create')) checked @endif value="1" data-module="ticketing" data-action="create" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'ticketing', 'assign')) checked @endif value="1" data-module="ticketing" data-action="assign" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'ticketing', 'comment')) checked @endif value="1" data-module="ticketing" data-action="comment" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'ticketing', 'close')) checked @endif value="1" data-module="ticketing" data-action="close" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                            <input @if (checkAction($user->id, 'notion', 'create')) checked @endif value="1" data-module="notion" data-action="create" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'notion', 'edit')) checked @endif value="1" data-module="notion" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                            <input @if (checkAction($user->id, 'user', 'view')) checked @endif value="1" data-module="user" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'user', 'permission')) checked @endif value="1" data-module="user" data-action="permission" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div> --}}
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'user', 'edit')) checked @endif value="1" data-module="user" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'user', 'delete')) checked @endif value="1" data-module="user" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--app">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'app_permission', 'access')) checked @endif value="1" data-module="app_permission" data-action="access" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
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
                                                                    <input @if (checkAction($user->id, 'lead_tab_access', $lead_tab->slug)) checked @endif value="1" data-module="lead_tab_access" data-action="{{ $lead_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_lead_tracing_lead', 'view')) checked @endif value="1" data-module="collapse_lead_tracing_lead" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_lead_tracing_lead', 'edit')) checked @endif value="1" data-module="collapse_lead_tracing_lead" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'lead_tab_access', $lead_tab->slug)) checked @endif value="1" data-module="lead_tab_access" data-action="{{ $lead_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'lead_collapse_tax_notice', 'view')) checked @endif value="1" data-module="lead_collapse_tax_notice" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'lead_collapse_tax_notice', 'edit')) checked @endif value="1" data-module="lead_collapse_tax_notice" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'lead_collapse_personal_information', 'view')) checked @endif value="1" data-module="lead_collapse_personal_information" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'lead_collapse_personal_information', 'edit')) checked @endif value="1" data-module="lead_collapse_personal_information" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'lead_collapse_eligibility', 'view')) checked @endif value="1" data-module="lead_collapse_eligibility" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'lead_collapse_eligibility', 'edit')) checked @endif value="1" data-module="lead_collapse_eligibility" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'lead_collapse_work_site', 'view')) checked @endif value="1" data-module="lead_collapse_work_site" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'lead_collapse_work_site', 'edit')) checked @endif value="1" data-module="lead_collapse_work_site" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'lead_collapse_situation_foyer', 'view')) checked @endif value="1" data-module="lead_collapse_situation_foyer" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'lead_collapse_situation_foyer', 'edit')) checked @endif value="1" data-module="lead_collapse_situation_foyer" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'lead_tab_access', $lead_tab->slug)) checked @endif value="1" data-module="lead_tab_access" data-action="{{ $lead_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'lead_collapse__project', 'view')) checked @endif value="1" data-module="lead_collapse__project" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'lead_collapse__project', 'edit')) checked @endif value="1" data-module="lead_collapse__project" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'lead_collapse_prescription_chantier', 'view')) checked @endif value="1" data-module="lead_collapse_prescription_chantier" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'lead_collapse_prescription_chantier', 'edit')) checked @endif value="1" data-module="lead_collapse_prescription_chantier" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                    {{-- <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'lead_tab_access', 'custom_field')) checked @endif value="1" data-module="lead_tab_access" data-action="custom_field" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card">
                                                        <div class="role-table__card__head">
                                                            {{ __('Access') }}
                                                        </div>
                                                        <div class="role-table__card__body role-table__card__collapse permission--leadTabCustom">
                                                            <div class="overflow-hidden">
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'custom_field', 'add_field')) checked @endif value="1" data-module="custom_field" data-action="add_field" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'custom_field', 'view')) checked @endif value="1" data-module="custom_field" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'custom_field', 'edit')) checked @endif value="1" data-module="custom_field" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
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
                                                                    <input @if (checkAction($user->id, 'client_tab_access', $client_tab->slug)) checked @endif value="1" data-module="client_tab_access" data-action="{{ $client_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_lead_tracing_client', 'view')) checked @endif value="1" data-module="collapse_lead_tracing_client" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_lead_tracing_client', 'edit')) checked @endif value="1" data-module="collapse_lead_tracing_client" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'client_tab_access', $client_tab->slug)) checked @endif value="1" data-module="client_tab_access" data-action="{{ $client_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'client_collapse_tax_notice', 'view')) checked @endif value="1" data-module="client_collapse_tax_notice" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'client_collapse_tax_notice', 'edit')) checked @endif value="1" data-module="client_collapse_tax_notice" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'client_collapse_personal_information', 'view')) checked @endif value="1" data-module="client_collapse_personal_information" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'client_collapse_personal_information', 'edit')) checked @endif value="1" data-module="client_collapse_personal_information" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'client_collapse_eligibility', 'view')) checked @endif value="1" data-module="client_collapse_eligibility" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'client_collapse_eligibility', 'edit')) checked @endif value="1" data-module="client_collapse_eligibility" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'client_collapse_work_site', 'view')) checked @endif value="1" data-module="client_collapse_work_site" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'client_collapse_work_site', 'edit')) checked @endif value="1" data-module="client_collapse_work_site" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'client_collapse_situation_foyer', 'view')) checked @endif value="1" data-module="client_collapse_situation_foyer" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'client_collapse_situation_foyer', 'edit')) checked @endif value="1" data-module="client_collapse_situation_foyer" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_lead_tracing', 'view')) checked @endif value="1" data-module="collapse_lead_tracing" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_lead_tracing', 'edit')) checked @endif value="1" data-module="collapse_lead_tracing" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input  @if (checkAction($user->id, 'collapse_tax_notice', 'view')) checked @endif value="1" data-module="collapse_tax_notice" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_tax_notice', 'edit')) checked @endif value="1" data-module="collapse_tax_notice" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_personal_information', 'view')) checked @endif value="1" data-module="collapse_personal_information" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_personal_information', 'edit')) checked @endif value="1" data-module="collapse_personal_information" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_eligibility', 'view')) checked @endif value="1" data-module="collapse_eligibility" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_eligibility', 'edit')) checked @endif value="1" data-module="collapse_eligibility" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_work_site', 'view')) checked @endif value="1" data-module="collapse_work_site" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_work_site', 'edit')) checked @endif value="1" data-module="collapse_work_site" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_situation_foyer', 'view')) checked @endif value="1" data-module="collapse_situation_foyer" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input  @if (checkAction($user->id, 'collapse_situation_foyer', 'edit')) checked @endif value="1" data-module="collapse_situation_foyer" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_travaux', 'view')) checked @endif value="1" data-module="collapse_travaux" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_travaux', 'edit')) checked @endif value="1" data-module="collapse_travaux" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_question', 'view')) checked @endif value="1" data-module="collapse_question" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_question', 'edit')) checked @endif value="1" data-module="collapse_question" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_intervention_prev', 'view')) checked @endif value="1" data-module="collapse_intervention_prev" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_intervention_prev', 'edit')) checked @endif value="1" data-module="collapse_intervention_prev" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_compte', 'view')) checked @endif value="1" data-module="collapse_compte" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_compte', 'edit')) checked @endif value="1" data-module="collapse_compte" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                <div class="role-table__card__body role-table__card__collapse 1permission--projectTab4{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'montant_disponible', 'view')) checked @endif value="1" data-module="montant_disponible" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'montant_disponible', 'edit')) checked @endif value="1" data-module="montant_disponible" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                <div class="role-table__card__body role-table__card__collapse permission--projectTab1{{ $project_tab->id }}">
                                                                    <div class="overflow-hidden">
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_subvention', 'create')) checked @endif value="1" data-module="collapse_subvention" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_subvention', 'view')) checked @endif value="1" data-module="collapse_subvention" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_subvention', 'edit')) checked @endif value="1" data-module="collapse_subvention" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_subvention', 'delete')) checked @endif value="1" data-module="collapse_subvention" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_suivi_mpr', 'view')) checked @endif value="1" data-module="collapse_suivi_mpr" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_suivi_mpr', 'edit')) checked @endif value="1" data-module="collapse_suivi_mpr" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_informaton_2', 'view')) checked @endif value="1" data-module="collapse_informaton_2" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_informaton_2', 'edit')) checked @endif value="1" data-module="collapse_informaton_2" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_depot', 'create')) checked @endif value="1" data-module="collapse_depot" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_depot', 'view')) checked @endif value="1" data-module="collapse_depot" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_depot', 'edit')) checked @endif value="1" data-module="collapse_depot" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_depot', 'delete')) checked @endif value="1" data-module="collapse_depot" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_audit', 'create')) checked @endif value="1" data-module="collapse_audit" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_audit', 'view')) checked @endif value="1" data-module="collapse_audit" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_audit', 'edit')) checked @endif value="1" data-module="collapse_audit" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_audit', 'delete')) checked @endif value="1" data-module="collapse_audit" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_intervention', 'create')) checked @endif value="1" data-module="collapse_intervention" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_intervention', 'view')) checked @endif value="1" data-module="collapse_intervention" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_intervention', 'edit')) checked @endif value="1" data-module="collapse_intervention" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_rapports', 'create')) checked @endif value="1" data-module="collapse_rapports" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_rapports', 'view')) checked @endif value="1" data-module="collapse_rapports" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_rapports', 'edit')) checked @endif value="1" data-module="collapse_rapports" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'view')) checked @endif value="1" data-module="collapse_comptability" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'edit')) checked @endif value="1" data-module="collapse_comptability" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'create_operation_cee')) checked @endif value="1" data-module="collapse_comptability" data-action="create_operation_cee" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'edit_operation_cee')) checked @endif value="1" data-module="collapse_comptability" data-action="edit_operation_cee" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'delete_operation_cee')) checked @endif value="1" data-module="collapse_comptability" data-action="delete_operation_cee" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'create_prestations')) checked @endif value="1" data-module="collapse_comptability" data-action="create_prestations" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'edit_prestations')) checked @endif value="1" data-module="collapse_comptability" data-action="edit_prestations" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_comptability', 'delete_prestations')) checked @endif value="1" data-module="collapse_comptability" data-action="delete_prestations" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse__qc', 'create')) checked @endif value="1" data-module="collapse__qc" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__qc', 'view')) checked @endif value="1" data-module="collapse__qc" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__qc', 'edit')) checked @endif value="1" data-module="collapse__qc" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__qc', 'delete')) checked @endif value="1" data-module="collapse__qc" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__qc', 'create_question')) checked @endif value="1" data-module="collapse__qc" data-action="create_question" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__qc', 'create_header')) checked @endif value="1" data-module="collapse__qc" data-action="create_header" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse__section_sur_site', 'create')) checked @endif value="1" data-module="collapse__section_sur_site" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__section_sur_site', 'view')) checked @endif value="1" data-module="collapse__section_sur_site" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__section_sur_site', 'edit')) checked @endif value="1" data-module="collapse__section_sur_site" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse__section_sur_site', 'delete')) checked @endif value="1" data-module="collapse__section_sur_site" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_suivi_facturation', 'view')) checked @endif value="1" data-module="collapse_suivi_facturation" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_suivi_facturation', 'edit')) checked @endif value="1" data-module="collapse_suivi_facturation" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_suivi_facturation', 'delete')) checked @endif value="1" data-module="collapse_suivi_facturation" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_controle_de_gestion', 'view')) checked @endif value="1" data-module="collapse_controle_de_gestion" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_controle_de_gestion', 'edit')) checked @endif value="1" data-module="collapse_controle_de_gestion" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_generate_document', 'view')) checked @endif value="1" data-module="collapse_generate_document" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_generate_document', 'edit')) checked @endif value="1" data-module="collapse_generate_document" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_email', 'view')) checked @endif value="1" data-module="collapse_email" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_email', 'edit')) checked @endif value="1" data-module="collapse_email" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                    <input @if (checkAction($user->id, 'tab_access', $project_tab->slug)) checked @endif value="1" data-module="tab_access" data-action="{{ $project_tab->slug }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                                <input @if (checkAction($user->id, 'collapse_demande_mairie', 'create')) checked @endif value="1" data-module="collapse_demande_mairie" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_demande_mairie', 'view')) checked @endif value="1" data-module="collapse_demande_mairie" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_demande_mairie', 'edit')) checked @endif value="1" data-module="collapse_demande_mairie" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                                <span class="circle-checkbox__label"></span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="role-table__card__body__data">
                                                                            <label class="circle-checkbox">
                                                                                <input @if (checkAction($user->id, 'collapse_demande_mairie', 'delete')) checked @endif value="1" data-module="collapse_demande_mairie" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                        {{-- <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--projectCustomTab">
                                                <div class="overflow-hidden">
                                                    @foreach (\App\Models\CRM\CustomTab::all() as $c_tab)
                                                        <div class="role-table__card__body__data">
                                                            <label class="circle-checkbox">
                                                                <input @if (checkAction($user->id, 'c_tab_access', $c_tab->id)) checked @endif value="1" data-module="c_tab_access" data-action="{{ $c_tab->id }}" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                <span class="circle-checkbox__label"></span>
                                                            </label>
                                                        </div>
                                                        <div class="role-table__card">
                                                            <div class="role-table__card__head">
                                                                {{ __('Access') }}
                                                            </div>
                                                            <div class="role-table__card__body role-table__card__collapse permission--projectCustomTab{{ $c_tab->id }}">
                                                                <div class="overflow-hidden">
                                                                    <div class="role-table__card__body__data">
                                                                        <label class="circle-checkbox">
                                                                            <input @if (checkAction($user->id, 'collapse_custom_tab'.$c_tab->id, 'create')) checked @endif value="1" data-module="collapse_custom_tab{{ $c_tab->id }}" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                            <span class="circle-checkbox__label"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="role-table__card__body__data">
                                                                        <label class="circle-checkbox">
                                                                            <input @if (checkAction($user->id, 'collapse_custom_tab'.$c_tab->id, 'view')) checked @endif value="1" data-module="collapse_custom_tab{{ $c_tab->id }}" data-action="view" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                            <span class="circle-checkbox__label"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="role-table__card__body__data">
                                                                        <label class="circle-checkbox">
                                                                            <input @if (checkAction($user->id, 'collapse_custom_tab'.$c_tab->id, 'edit')) checked @endif value="1" data-module="collapse_custom_tab{{ $c_tab->id }}" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                            <span class="circle-checkbox__label"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--general_settings">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'regie')) checked @endif value="1" data-module="general__setting" data-action="regie" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-regie', 'create')) checked @endif value="1" data-module="general__setting-regie" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-regie', 'edit')) checked @endif value="1" data-module="general__setting-regie" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-regie', 'delete')) checked @endif value="1" data-module="general__setting-regie" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'question')) checked @endif value="1" data-module="general__setting" data-action="question" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-question', 'create')) checked @endif value="1" data-module="general__setting-question" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-question', 'edit')) checked @endif value="1" data-module="general__setting-question" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-question', 'delete')) checked @endif value="1" data-module="general__setting-question" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'controle_des_documents')) checked @endif value="1" data-module="general__setting" data-action="controle_des_documents" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-controle_des_documents', 'create')) checked @endif value="1" data-module="general__setting-controle_des_documents" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-controle_des_documents', 'edit')) checked @endif value="1" data-module="general__setting-controle_des_documents" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-controle_des_documents', 'delete')) checked @endif value="1" data-module="general__setting-controle_des_documents" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'banque')) checked @endif value="1" data-module="general__setting" data-action="banque" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-banque', 'create')) checked @endif value="1" data-module="general__setting-banque" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-banque', 'edit')) checked @endif value="1" data-module="general__setting-banque" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-banque', 'delete')) checked @endif value="1" data-module="general__setting-banque" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'status_audit')) checked @endif value="1" data-module="general__setting" data-action="status_audit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-status_audit', 'create')) checked @endif value="1" data-module="general__setting-status_audit" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_audit', 'edit')) checked @endif value="1" data-module="general__setting-status_audit" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_audit', 'delete')) checked @endif value="1" data-module="general__setting-status_audit" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'status_rapport_audit')) checked @endif value="1" data-module="general__setting" data-action="status_rapport_audit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-status_rapport_audit', 'create')) checked @endif value="1" data-module="general__setting-status_rapport_audit" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_rapport_audit', 'edit')) checked @endif value="1" data-module="general__setting-status_rapport_audit" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_rapport_audit', 'delete')) checked @endif value="1" data-module="general__setting-status_rapport_audit" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'resultat_du_rapport')) checked @endif value="1" data-module="general__setting" data-action="resultat_du_rapport" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-resultat_du_rapport', 'create')) checked @endif value="1" data-module="general__setting-resultat_du_rapport" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-resultat_du_rapport', 'edit')) checked @endif value="1" data-module="general__setting-resultat_du_rapport" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-resultat_du_rapport', 'delete')) checked @endif value="1" data-module="general__setting-resultat_du_rapport" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'commercial_terrain')) checked @endif value="1" data-module="general__setting" data-action="commercial_terrain" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-commercial_terrain', 'create')) checked @endif value="1" data-module="general__setting-commercial_terrain" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-commercial_terrain', 'edit')) checked @endif value="1" data-module="general__setting-commercial_terrain" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-commercial_terrain', 'delete')) checked @endif value="1" data-module="general__setting-commercial_terrain" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'status_du_probleme_ticket')) checked @endif value="1" data-module="general__setting" data-action="status_du_probleme_ticket" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-status_du_probleme_ticket', 'create')) checked @endif value="1" data-module="general__setting-status_du_probleme_ticket" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_du_probleme_ticket', 'edit')) checked @endif value="1" data-module="general__setting-status_du_probleme_ticket" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_du_probleme_ticket', 'delete')) checked @endif value="1" data-module="general__setting-status_du_probleme_ticket" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'type_energie_chaud')) checked @endif value="1" data-module="general__setting" data-action="type_energie_chaud" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-type_energie_chaud', 'create')) checked @endif value="1" data-module="general__setting-type_energie_chaud" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-type_energie_chaud', 'edit')) checked @endif value="1" data-module="general__setting-type_energie_chaud" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-type_energie_chaud', 'delete')) checked @endif value="1" data-module="general__setting-type_energie_chaud" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'prestations_group')) checked @endif value="1" data-module="general__setting" data-action="prestations_group" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-prestations_group', 'create')) checked @endif value="1" data-module="general__setting-prestations_group" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-prestations_group', 'edit')) checked @endif value="1" data-module="general__setting-prestations_group" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-prestations_group', 'delete')) checked @endif value="1" data-module="general__setting-prestations_group" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'comment_category')) checked @endif value="1" data-module="general__setting" data-action="comment_category" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-comment_category', 'create')) checked @endif value="1" data-module="general__setting-comment_category" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-comment_category', 'edit')) checked @endif value="1" data-module="general__setting-comment_category" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-comment_category', 'delete')) checked @endif value="1" data-module="general__setting-comment_category" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'quality_control')) checked @endif value="1" data-module="general__setting" data-action="quality_control" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-quality_control', 'create')) checked @endif value="1" data-module="general__setting-quality_control" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-quality_control', 'edit')) checked @endif value="1" data-module="general__setting-quality_control" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-quality_control', 'view')) checked @endif value="1" data-module="general__setting-quality_control" data-action="view" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-quality_control', 'delete')) checked @endif value="1" data-module="general__setting-quality_control" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'notion_category')) checked @endif value="1" data-module="general__setting" data-action="notion_category" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-notion_category', 'create')) checked @endif value="1" data-module="general__setting-notion_category" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-notion_category', 'edit')) checked @endif value="1" data-module="general__setting-notion_category" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-notion_category', 'delete')) checked @endif value="1" data-module="general__setting-notion_category" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'notion_sub_category')) checked @endif value="1" data-module="general__setting" data-action="notion_sub_category" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-notion_sub_category', 'create')) checked @endif value="1" data-module="general__setting-notion_sub_category" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-notion_sub_category', 'edit')) checked @endif value="1" data-module="general__setting-notion_sub_category" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-notion_sub_category', 'delete')) checked @endif value="1" data-module="general__setting-notion_sub_category" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'lead_sub_status')) checked @endif value="1" data-module="general__setting" data-action="lead_sub_status" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-lead_sub_status', 'create')) checked @endif value="1" data-module="general__setting-lead_sub_status" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-lead_sub_status', 'edit')) checked @endif value="1" data-module="general__setting-lead_sub_status" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-lead_sub_status', 'delete')) checked @endif value="1" data-module="general__setting-lead_sub_status" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'heating_mode')) checked @endif value="1" data-module="general__setting" data-action="heating_mode" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-heating_mode', 'create')) checked @endif value="1" data-module="general__setting-heating_mode" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-heating_mode', 'edit')) checked @endif value="1" data-module="general__setting-heating_mode" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-heating_mode', 'delete')) checked @endif value="1" data-module="general__setting-heating_mode" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'campagne_type')) checked @endif value="1" data-module="general__setting" data-action="campagne_type" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-campagne_type', 'create')) checked @endif value="1" data-module="general__setting-campagne_type" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-campagne_type', 'edit')) checked @endif value="1" data-module="general__setting-campagne_type" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-campagne_type', 'delete')) checked @endif value="1" data-module="general__setting-campagne_type" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'project_sub_status')) checked @endif value="1" data-module="general__setting" data-action="project_sub_status" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-project_sub_status', 'create')) checked @endif value="1" data-module="general__setting-project_sub_status" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_sub_status', 'edit')) checked @endif value="1" data-module="general__setting-project_sub_status" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_sub_status', 'delete')) checked @endif value="1" data-module="general__setting-project_sub_status" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'status_planning_intervention')) checked @endif value="1" data-module="general__setting" data-action="status_planning_intervention" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-status_planning_intervention', 'create')) checked @endif value="1" data-module="general__setting-status_planning_intervention" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_planning_intervention', 'edit')) checked @endif value="1" data-module="general__setting-status_planning_intervention" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-status_planning_intervention', 'delete')) checked @endif value="1" data-module="general__setting-status_planning_intervention" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'project_ko_reason')) checked @endif value="1" data-module="general__setting" data-action="project_ko_reason" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-project_ko_reason', 'create')) checked @endif value="1" data-module="general__setting-project_ko_reason" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_ko_reason', 'edit')) checked @endif value="1" data-module="general__setting-project_ko_reason" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_ko_reason', 'delete')) checked @endif value="1" data-module="general__setting-project_ko_reason" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'project_reflection_reason')) checked @endif value="1" data-module="general__setting" data-action="project_reflection_reason" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-project_reflection_reason', 'create')) checked @endif value="1" data-module="general__setting-project_reflection_reason" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_reflection_reason', 'edit')) checked @endif value="1" data-module="general__setting-project_reflection_reason" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_reflection_reason', 'delete')) checked @endif value="1" data-module="general__setting-project_reflection_reason" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'project_control_photo')) checked @endif value="1" data-module="general__setting" data-action="project_control_photo" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-project_control_photo', 'create')) checked @endif value="1" data-module="general__setting-project_control_photo" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_control_photo', 'edit')) checked @endif value="1" data-module="general__setting-project_control_photo" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-project_control_photo', 'delete')) checked @endif value="1" data-module="general__setting-project_control_photo" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'statut_maprimerenov')) checked @endif value="1" data-module="general__setting" data-action="statut_maprimerenov" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-statut_maprimerenov', 'create')) checked @endif value="1" data-module="general__setting-statut_maprimerenov" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-statut_maprimerenov', 'edit')) checked @endif value="1" data-module="general__setting-statut_maprimerenov" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-statut_maprimerenov', 'delete')) checked @endif value="1" data-module="general__setting-statut_maprimerenov" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'reject_reason')) checked @endif value="1" data-module="general__setting" data-action="reject_reason" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-reject_reason', 'create')) checked @endif value="1" data-module="general__setting-reject_reason" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-reject_reason', 'edit')) checked @endif value="1" data-module="general__setting-reject_reason" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-reject_reason', 'delete')) checked @endif value="1" data-module="general__setting-reject_reason" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'user_color')) checked @endif value="1" data-module="general__setting" data-action="user_color" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-user_color', 'edit')) checked @endif value="1" data-module="general__setting-user_color" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'type_fournisseur')) checked @endif value="1" data-module="general__setting" data-action="type_fournisseur" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-type_fournisseur', 'create')) checked @endif value="1" data-module="general__setting-type_fournisseur" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-type_fournisseur', 'edit')) checked @endif value="1" data-module="general__setting-type_fournisseur" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-type_fournisseur', 'delete')) checked @endif value="1" data-module="general__setting-type_fournisseur" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'technical_referee')) checked @endif value="1" data-module="general__setting" data-action="technical_referee" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-technical_referee', 'create')) checked @endif value="1" data-module="general__setting-technical_referee" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-technical_referee', 'edit')) checked @endif value="1" data-module="general__setting-technical_referee" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-technical_referee', 'delete')) checked @endif value="1" data-module="general__setting-technical_referee" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'nature_mouvement')) checked @endif value="1" data-module="general__setting" data-action="nature_mouvement" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-nature_mouvement', 'create')) checked @endif value="1" data-module="general__setting-nature_mouvement" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-nature_mouvement', 'edit')) checked @endif value="1" data-module="general__setting-nature_mouvement" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-nature_mouvement', 'delete')) checked @endif value="1" data-module="general__setting-nature_mouvement" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'entrepot')) checked @endif value="1" data-module="general__setting" data-action="entrepot" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-entrepot', 'create')) checked @endif value="1" data-module="general__setting-entrepot" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-entrepot', 'edit')) checked @endif value="1" data-module="general__setting-entrepot" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-entrepot', 'delete')) checked @endif value="1" data-module="general__setting-entrepot" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'personnel_autorise_reception')) checked @endif value="1" data-module="general__setting" data-action="personnel_autorise_reception" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-personnel_autorise_reception', 'create')) checked @endif value="1" data-module="general__setting-personnel_autorise_reception" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-personnel_autorise_reception', 'edit')) checked @endif value="1" data-module="general__setting-personnel_autorise_reception" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-personnel_autorise_reception', 'delete')) checked @endif value="1" data-module="general__setting-personnel_autorise_reception" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'statut_commande')) checked @endif value="1" data-module="general__setting" data-action="statut_commande" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-statut_commande', 'create')) checked @endif value="1" data-module="general__setting-statut_commande" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-statut_commande', 'edit')) checked @endif value="1" data-module="general__setting-statut_commande" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-statut_commande', 'delete')) checked @endif value="1" data-module="general__setting-statut_commande" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'fournisseur_materiel')) checked @endif value="1" data-module="general__setting" data-action="fournisseur_materiel" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-fournisseur_materiel', 'create')) checked @endif value="1" data-module="general__setting-fournisseur_materiel" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-fournisseur_materiel', 'edit')) checked @endif value="1" data-module="general__setting-fournisseur_materiel" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-fournisseur_materiel', 'delete')) checked @endif value="1" data-module="general__setting-fournisseur_materiel" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'type_de_livraison')) checked @endif value="1" data-module="general__setting" data-action="type_de_livraison" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-type_de_livraison', 'create')) checked @endif value="1" data-module="general__setting-type_de_livraison" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-type_de_livraison', 'edit')) checked @endif value="1" data-module="general__setting-type_de_livraison" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-type_de_livraison', 'delete')) checked @endif value="1" data-module="general__setting-type_de_livraison" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'baremes')) checked @endif value="1" data-module="general__setting" data-action="baremes" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-baremes', 'create')) checked @endif value="1" data-module="general__setting-baremes" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-baremes', 'edit')) checked @endif value="1" data-module="general__setting-baremes" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-baremes', 'delete')) checked @endif value="1" data-module="general__setting-baremes" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'delegataires')) checked @endif value="1" data-module="general__setting" data-action="delegataires" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-delegataires', 'create')) checked @endif value="1" data-module="general__setting-delegataires" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-delegataires', 'edit')) checked @endif value="1" data-module="general__setting-delegataires" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-delegataires', 'delete')) checked @endif value="1" data-module="general__setting-delegataires" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'deals_tarifs')) checked @endif value="1" data-module="general__setting" data-action="deals_tarifs" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-deals_tarifs', 'create')) checked @endif value="1" data-module="general__setting-deals_tarifs" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-deals_tarifs', 'edit')) checked @endif value="1" data-module="general__setting-deals_tarifs" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-deals_tarifs', 'delete')) checked @endif value="1" data-module="general__setting-deals_tarifs" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'installateurs_rge')) checked @endif value="1" data-module="general__setting" data-action="installateurs_rge" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-installateurs_rge', 'create')) checked @endif value="1" data-module="general__setting-installateurs_rge" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-installateurs_rge', 'edit')) checked @endif value="1" data-module="general__setting-installateurs_rge" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-installateurs_rge', 'delete')) checked @endif value="1" data-module="general__setting-installateurs_rge" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'amo')) checked @endif value="1" data-module="general__setting" data-action="amo" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-amo', 'create')) checked @endif value="1" data-module="general__setting-amo" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-amo', 'edit')) checked @endif value="1" data-module="general__setting-amo" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-amo', 'delete')) checked @endif value="1" data-module="general__setting-amo" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'mandataire_anah')) checked @endif value="1" data-module="general__setting" data-action="mandataire_anah" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-mandataire_anah', 'create')) checked @endif value="1" data-module="general__setting-mandataire_anah" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-mandataire_anah', 'edit')) checked @endif value="1" data-module="general__setting-mandataire_anah" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-mandataire_anah', 'delete')) checked @endif value="1" data-module="general__setting-mandataire_anah" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'auditeur_energetique')) checked @endif value="1" data-module="general__setting" data-action="auditeur_energetique" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-auditeur_energetique', 'create')) checked @endif value="1" data-module="general__setting-auditeur_energetique" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-auditeur_energetique', 'edit')) checked @endif value="1" data-module="general__setting-auditeur_energetique" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-auditeur_energetique', 'delete')) checked @endif value="1" data-module="general__setting-auditeur_energetique" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'zones_d_intervention')) checked @endif value="1" data-module="general__setting" data-action="zones_d_intervention" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-zones_d_intervention', 'create')) checked @endif value="1" data-module="general__setting-zones_d_intervention" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-zones_d_intervention', 'edit')) checked @endif value="1" data-module="general__setting-zones_d_intervention" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-zones_d_intervention', 'delete')) checked @endif value="1" data-module="general__setting-zones_d_intervention" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'bureaux_de_controle')) checked @endif value="1" data-module="general__setting" data-action="bureaux_de_controle" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-bureaux_de_controle', 'create')) checked @endif value="1" data-module="general__setting-bureaux_de_controle" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-bureaux_de_controle', 'edit')) checked @endif value="1" data-module="general__setting-bureaux_de_controle" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-bureaux_de_controle', 'delete')) checked @endif value="1" data-module="general__setting-bureaux_de_controle" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'marques')) checked @endif value="1" data-module="general__setting" data-action="marques" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-marques', 'create')) checked @endif value="1" data-module="general__setting-marques" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-marques', 'edit')) checked @endif value="1" data-module="general__setting-marques" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-marques', 'delete')) checked @endif value="1" data-module="general__setting-marques" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'prestations')) checked @endif value="1" data-module="general__setting" data-action="prestations" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-prestations', 'create')) checked @endif value="1" data-module="general__setting-prestations" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-prestations', 'edit')) checked @endif value="1" data-module="general__setting-prestations" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-prestations', 'delete')) checked @endif value="1" data-module="general__setting-prestations" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'fournisseurs')) checked @endif value="1" data-module="general__setting" data-action="fournisseurs" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-fournisseurs', 'create')) checked @endif value="1" data-module="general__setting-fournisseurs" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-fournisseurs', 'edit')) checked @endif value="1" data-module="general__setting-fournisseurs" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-fournisseurs', 'delete')) checked @endif value="1" data-module="general__setting-fournisseurs" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'societe_client')) checked @endif value="1" data-module="general__setting" data-action="societe_client" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-societe_client', 'create')) checked @endif value="1" data-module="general__setting-societe_client" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-societe_client', 'edit')) checked @endif value="1" data-module="general__setting-societe_client" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-societe_client', 'delete')) checked @endif value="1" data-module="general__setting-societe_client" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'produits')) checked @endif value="1" data-module="general__setting" data-action="produits" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-produits', 'create')) checked @endif value="1" data-module="general__setting-produits" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-produits', 'edit')) checked @endif value="1" data-module="general__setting-produits" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-produits', 'delete')) checked @endif value="1" data-module="general__setting-produits" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'produits_categorie')) checked @endif value="1" data-module="general__setting" data-action="produits_categorie" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-produits_categorie', 'create')) checked @endif value="1" data-module="general__setting-produits_categorie" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-produits_categorie', 'edit')) checked @endif value="1" data-module="general__setting-produits_categorie" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-produits_categorie', 'delete')) checked @endif value="1" data-module="general__setting-produits_categorie" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'general__setting', 'produits_sous_categorie')) checked @endif value="1" data-module="general__setting" data-action="produits_sous_categorie" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'general__setting-produits_sous_categorie', 'create')) checked @endif value="1" data-module="general__setting-produits_sous_categorie" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-produits_sous_categorie', 'edit')) checked @endif value="1" data-module="general__setting-produits_sous_categorie" data-action="edit" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'general__setting-produits_sous_categorie', 'delete')) checked @endif value="1" data-module="general__setting-produits_sous_categorie" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--other">
                                                <div class="overflow-hidden">
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'product')) checked @endif value="1" data-module="others" data-action="product" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'financement')) checked @endif value="1" data-module="others" data-action="financement" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'status_planning')) checked @endif value="1" data-module="others" data-action="status_planning" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'status_installation')) checked @endif value="1" data-module="others" data-action="status_installation" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'status_previsite')) checked @endif value="1" data-module="others" data-action="status_previsite" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'status_client_previsite')) checked @endif value="1" data-module="others" data-action="status_client_previsite" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'pdf_generate')) checked @endif value="1" data-module="others" data-action="pdf_generate" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'others', 'document_generate')) checked @endif value="1" data-module="others" data-action="document_generate" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="role-table__card">
                                            <div class="role-table__card__head">
                                                {{ __('Access') }}
                                            </div>
                                            <div class="role-table__card__body role-table__card__collapse permission--documents">
                                                <div class="overflow-hidden">
                                                    @foreach ($documents as $document)
                                                        <div class="role-table__card__body__data">
                                                            <label class="circle-checkbox">
                                                                <input @if (checkAction($user->id, 'document-file', $document->id)) checked @endif value="1" data-module="document-file" data-action="{{ $document->id }}" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                            <input @if (checkAction($user->id, 'stocks', 'dashboard')) checked @endif value="1" data-module="stocks" data-action="dashboard" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'stocks', 'mouvements')) checked @endif value="1" data-module="stocks" data-action="mouvements" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'stocks_mouvements', 'create')) checked @endif value="1" data-module="stocks_mouvements" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_mouvements', 'edit')) checked @endif value="1" data-module="stocks_mouvements" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_mouvements', 'delete')) checked @endif value="1" data-module="stocks_mouvements" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_mouvements', 'activity')) checked @endif value="1" data-module="stocks_mouvements" data-action="activity" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'stocks', 'etat_des_stocks')) checked @endif value="1" data-module="stocks" data-action="etat_des_stocks" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                            <span class="circle-checkbox__label"></span>
                                                        </label>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'stocks', 'commandes')) checked @endif value="1" data-module="stocks" data-action="commandes" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'stocks_commandes', 'create')) checked @endif value="1" data-module="stocks_commandes" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_commandes', 'edit')) checked @endif value="1" data-module="stocks_commandes" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_commandes', 'delete')) checked @endif value="1" data-module="stocks_commandes" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_commandes', 'activity')) checked @endif value="1" data-module="stocks_commandes" data-action="activity" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="role-table__card__body__data">
                                                        <label class="circle-checkbox">
                                                            <input @if (checkAction($user->id, 'stocks', 'installations')) checked @endif value="1" data-module="stocks" data-action="installations" data-user-id="{{ $user->id }}"  type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                                                                        <input @if (checkAction($user->id, 'stocks_installations', 'vehicle')) checked @endif value="1" data-module="stocks_installations" data-action="vehicle" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_installations', 'create')) checked @endif value="1" data-module="stocks_installations" data-action="create" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_installations', 'edit')) checked @endif value="1" data-module="stocks_installations" data-action="edit" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_installations', 'filter')) checked @endif value="1" data-module="stocks_installations" data-action="filter" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_installations', 'export')) checked @endif value="1" data-module="stocks_installations" data-action="export" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_installations', 'delete')) checked @endif value="1" data-module="stocks_installations" data-action="delete" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
                                                                        <span class="circle-checkbox__label"></span>
                                                                    </label>
                                                                </div>
                                                                <div class="role-table__card__body__data">
                                                                    <label class="circle-checkbox">
                                                                        <input @if (checkAction($user->id, 'stocks_installations', 'activity')) checked @endif value="1" data-module="stocks_installations" data-action="activity" data-user-id="{{ $user->id }}" type="checkbox" class="circle-checkbox__input permission_btn_check">
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
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </section> 

@endsection

@push('js')
    <script>
        // $('.checkboxLabel').click(function(){

        //     var role_id = $(this).attr('data-user-id');
        //     var nav_id  = $(this).attr('data-nav-id');
        //     var route   = $(this).attr('data-route');

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     if(this.checked){
        //     $.ajax({

        //         url: "{{ route('permission.add') }}",
        //         type:"POST",
        //         data:{
        //             role_id         :role_id,
        //             navigation_id   : nav_id,
        //             route           :route,
        //         },
        //         success:function(data){
        //             $('#successMessage').text(data);
		// 			$('.toast.toast--success').toast('show');
        //         },
        //     });
        //     }
        //     else{
        //      $.ajax({

        //         url: "{{ route('permission.remove') }}",
        //         type:"POST",
        //         data:{
        //             role_id         :role_id,
        //             navigation_id   : nav_id,
        //             route           :route,
        //         },
        //         success:function(data){
        //             $('#successMessage').text(data);
		// 			$('.toast.toast--success').toast('show');
        //         },
        //     });
        //     }
        // });

        // permission added
        // $('body').on('click', '.permission_btn_check', function(){
        //     var module_name = $(this).attr('data-module');
        //     var action = $(this).attr('data-action');
        //     var role_id =$(this).attr('data-user-id');

        //     $.ajaxSetup({
		// 			headers: {
		// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 			}
		// 		});
		// 		$.ajax({
		// 			type: "POST",
		// 			url :"{{ route('role.permission.action') }}",
		// 			data: {
		// 				module_name 	: module_name,
		// 				action_name 	: action,
		// 				role_id 		: role_id,
		// 			},

		// 			success: function(data){
		// 				console.log(data);
        //                 $('#successMessage').text(data);
		// 				$('.toast.toast--success').toast('show');
		// 			},

		// 		});
        // });

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


        $('body').on('click', '.checkboxLabel', function(){ 
            var user_id = $(this).attr('data-user-id');
            var role_id = $(this).attr('data-role-id');
            var nav_id  = $(this).attr('data-nav-id');
            var route   = $(this).attr('data-route');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            $.ajax({

                url: "{{ route('user.permission') }}",
                type:"POST",
                data:{
                    user_id         :user_id,
                    role_id         :role_id,
                    navigation_id   : nav_id,
                    name            :route, 
                },
                success:function(data){
                    $('#successMessage').text(data);
                    $('.toast.toast--success').toast('show');
                },  
            }); 
        }); 
        
        $('body').on('click', '.permission_btn_check', function(){
            var module_name = $(this).attr('data-module');
            var action = $(this).attr('data-action');
            var user_id =$(this).attr('data-user-id');

            $.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST", 
					url :"{{ route('permission.action') }}",
					data: { 
						module_name 	: module_name, 
						action_name 	: action,
						user_id 		: user_id, 
					},
					 
					success: function(data){ 
						console.log(data);
                        $('#successMessage').text(data);
						$('.toast.toast--success').toast('show');
					},
					
				}); 
        });
    </script>
@endpush
