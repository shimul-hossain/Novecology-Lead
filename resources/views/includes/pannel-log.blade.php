{{-- Main Layouts --}}
@extends('layouts.master')

{{-- Title part  --}}
@section('title', 'Pannel Log')

{{-- active menu  --}}
@section('notionActive', 'active')

@section('bodyBg', 'secondary-bg')
{{-- @push('plugins-link') 
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>
@endpush  --}}
@section('content')
{{-- <script>
    function formatedDate(data, span_id){ 
        console.log(moment(data).tz(moment.tz.guess()).format('DD-MM-YYYY HH:mm a'));
        document.getElementById(span_id).innerText = moment(data).tz(moment.tz.guess()).format('DD-MM-YYYY HH:mm a');
    }
</script> --}}
<div class="notion">
	<div class="notion__header"> 
		<img  loading="lazy"  src="{{ asset('crm_assets/assets/images/banner/banner.png') }}" alt="cover image" class="notion__header__image notion-cover-image"> 
	</div>
</div>    

<section class="py-5">
	<div class="container"> 
        <ul class="nav nav-pills nav-pills--horizontal p-3" id="pills-tab-activities" role="tablist"> 
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-activities-Détails-tab" data-toggle="pill" href="#pills-Détails-tab" role="tab" aria-controls="pills-two" aria-selected="true">Détails</a>
            </li> 
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-activities-Statuts-tab" data-toggle="pill" href="#pills-Statuts-tab" role="tab" aria-controls="pills-one" aria-selected="false">Statuts</a>
            </li> 
        </ul>
        <div class="tab-content" id="pills-tabContent-activities">
            <div class="tab-pane fade show active" id="pills-Détails-tab" role="tabpanel" aria-labelledby="pills-tab-activities">
                <div class="table-responsive database-table-wrapper--custom simple-bar">
                    <table class="table database-table w-100 mb-0" id="dataTables">
                        <thead class="database-table__header">
                            <tr>
                                <th class="text-left">
                                    {{ __('Détails') }}
                                </th>
                                {{-- <th class="text-left">
                                    {{ __('Commentaire') }}
                                </th> --}}
                                <th>
                                {{ __('Action') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body" id="default_activity_log_wrap">  
                            @foreach ($default_activities as $activity)
                                <tr> 
                                    <td style="white-space: inherit;">  
                                        <div class="d-sm-flex align-items-center">
                                            <a href="#!" class="avatar-group__image-wrapper d-inline-block flex-shrink-0 rounded-circle overflow-hidden mr-2 mb-2 mb-sm-0" style="width: 45px; height: 45px;" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($activity->user_id)->name }}">
                                                @if($activity->getUser->profile_photo)  
                                                <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $activity->getUser->profile_photo }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                                                @else
                                                <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                                                @endif
                                            </a>
                                            <div>
                                                @if ($activity->key == 'lock_access__activity')
                                                <p class="mb-1">
                                                    {{ $activity->getUser->name }}  <strong>@if ($activity->value == 'open')
                                                        Déverrouiller
                                                    @elseif ($activity->value == 'close')
                                                        Serrure
                                                    @else
                                                        {{ $activity->value }}
                                                    @endif
                                                    {{ $activity->block_name }} </strong> sous cartouche sous la cartouche de <strong>{{ $activity->tab_name }}</strong>
                                                    @if ($activity->feature_type == 'lead')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{  $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                    @elseif ($activity->feature_type == 'project')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom : 'Inconnue' }}: Chantier</span>
                                                    @elseif ($activity->feature_type == 'client')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getClientName ? $activity->getClientName->Prenom.' '.$activity->getClientName->Nom : 'Inconnue' }}: Client</span>
                                                    @endif
                                                </p>
                                                @elseif ($activity->key == 'callback_setting__activity')
                                                <p class="mb-1">
                                                    {{ $activity->getUser->name }}  <strong>Régler Rappler à {{ \Carbon\Carbon::parse($activity->value)->format('d-m-Y, h:i a') }}  </strong>
                                                    @if ($activity->feature_type == 'lead')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom  : 'Inconnue'}}: Prospect</span>
                                                    @elseif ($activity->feature_type == 'project')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom : 'Inconnue' }}: Chantier</span>
                                                    @elseif ($activity->feature_type == 'client')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getClientName ? $activity->getClientName->Prenom.' '.$activity->getClientName->Nom : 'Inconnue' }}: Client</span>
                                                    @endif
                                                </p>
                                                @elseif ($activity->key == 'telecommercial__change')
                                                    <p class="mb-1">
                                                        {{ $activity->getUser->name }}  Attribuer un télécommercial  à <strong> {{ $activity->assignUser->name ?? '' }}  </strong> @if ($activity->feature_type == 'lead')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                    @elseif ($activity->feature_type == 'project')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom : 'Inconnue' }}: Chantier</span>
                                                    @elseif ($activity->feature_type == 'client')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getClientName ? $activity->getClientName->Prenom.' '.$activity->getClientName->Nom : 'Inconnue' }}: Client</span>
                                                    @endif
                                                    </p> 
                                                @elseif ($activity->key == 'gestionnaire__change')
                                                    <p class="mb-1">
                                                        {{ $activity->getUser->name }}  Attribuer un gestionnaire  à <strong> {{ $activity->assignUser->name ?? '' }}  </strong> @if ($activity->feature_type == 'lead')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                    @elseif ($activity->feature_type == 'project')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom : 'Inconnue' }}: Chantier</span>
                                                    @elseif ($activity->feature_type == 'client')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getClientName ? $activity->getClientName->Prenom.' '.$activity->getClientName->Nom : 'Inconnue' }}: Client</span>
                                                    @endif
                                                    </p>
                                                @elseif ($activity->key == 'lead_reset__by')
                                                    <p class="mb-1"> <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}">
                                                        <strong> {{ $activity->getUser->name }} à zéro le prospect  </strong> 
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                    </p> 
                                                    @elseif ($activity->key == 'new_prospect__create')
                                                        <p class="mb-1">
                                                            <strong> {{ $activity->getUser->name }} a créé ce prospect</strong> 
                                                            <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                        </p> 
                                                    @elseif ($activity->key == 'new_prospect__import')
                                                        <p class="mb-1">
                                                            <strong> {{ $activity->getUser->name }} a importé ce prospect</strong> 
                                                            <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                        </p> 
                                                    @elseif ($activity->key == 'comment_pin_status__change')
                                                        <p class="mb-1">
                                                            {{ $activity->getUser->name }} j'ai épinglé un commentaire: <strong>"{{ $activity->value }}"</strong>
                                                            @if ($activity->feature_type == 'lead')
                                                                <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                            @elseif ($activity->feature_type == 'project')
                                                                <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom : 'Inconnue' }}: Chantier</span>
                                                            @elseif ($activity->feature_type == 'client')
                                                                <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getClientName ? $activity->getClientName->Prenom.' '.$activity->getClientName->Nom : 'Inconnue' }}: Client</span>
                                                            @endif
                                                        </p> 
                                                @else
                                                <p class="mb-1">{{ $activity->getUser->name }} mis à jour 
                                                    <strong>
                                                        @switch($activity->key)
                                                            @case('precariousness_year')
                                                                Précarité
                                                                @break
                                                            @case('advance_visit')
                                                                Disponibilité pour prévisite (jour /horaire)
                                                                @break
                                                            @case('same_as_work_address')
                                                                L'adresse fiscale et l'adresse des travaux sont elle les même ?
                                                                @break
                                                            @case('second_title')
                                                                Title
                                                                @break
                                                            @case('phone')
                                                                N° Mobile
                                                                @break
                                                            @case('telephone')
                                                                N° Fixe
                                                                @break
                                                            @case('heating_type')
                                                                Type de chauffage
                                                                @break
                                                            @case('nature_occupation')
                                                                Occupation
                                                                @break
                                                            @case('occupation_type')
                                                                Type occupation
                                                                @break
                                                            @case('cadstrable_plot')
                                                                Parcelle cadastrale
                                                                @break
                                                            @case('foyer')
                                                                Nombre de foyer
                                                                @break
                                                            @case('house_over_15_years')
                                                                Age du batiment
                                                                @break
                                                            @case('project_name')
                                                                Nom du projet
                                                                @break 
                                                            @case('address2')
                                                                adresse
                                                                @break
                                                            @case('address')
                                                                adresse
                                                                @break
                                                            @case('last_name')
                                                                Nom
                                                                @break
                                                            @case('first_name')
                                                                Prenom
                                                                @break
                                                            @case('second_last_name')
                                                                Nom 2
                                                                @break
                                                            @case('second_first_name')
                                                                Prenom 2
                                                                @break
                                                            @case('present_address')
                                                                Nouvelle adresse
                                                                @break
                                                            @case('other_heating')
                                                                Si Autre Précisez
                                                                @break
                                                            @case('specify_heating')
                                                                Precisez le chauffage d appoint
                                                                @break
                                                            @case('heating_generator')
                                                                La maison possède un second générateur de chauffage
                                                                @break
                                                            @case('supplementary')
                                                                Le logement possède un chauffage d’appoint ?
                                                                @break
                                                            @case('with_basement')
                                                                Depuis Quand Occupez Vous Le Logement
                                                                @break
                                                            @case('annual_heating2')
                                                                Consommation Chauffage Annuel En Volume
                                                                @break
                                                            @case('date_fo_construction')
                                                                Date construction maison
                                                                @break
                                                            @case('living_area')
                                                                Surface habitable
                                                                @break
                                                            @case('auxiliary_heating')
                                                                Chauffage d'appoint
                                                                @break
                                                            @case('second_heating_type')
                                                                La maison possède un second générateur de chauffage
                                                                @break
                                                            @case('other_second_heating_type')
                                                                Si autre précisez(Second mode de chauffage)
                                                                @break
                                                            @case('transmitter_type')
                                                                Type d'émetteur
                                                                @break
                                                            @case('number_of_radiator')
                                                                Nombre de radiateur
                                                                @break
                                                            @case('radiator_type')
                                                                Type de radiateur
                                                                @break
                                                            @case('other_radiator_type')
                                                                Si autre précisez(Type de radiateur)
                                                                @break
                                                            @case('hot_water_production')
                                                                Production d'eau chaude sanitaire
                                                                @break
                                                            @case('hot_water_feature')
                                                                Production d'eau chaude sanitaire
                                                                @break
                                                            @case('volume')
                                                                Volume Ballon Eau chaude
                                                                @break
                                                            @case('annual_heating')
                                                                Consommation chauffage Annuel
                                                                @break
                                                            @case('adult_occupants')
                                                                Nombre d'occupants adultes
                                                                @break
                                                            @case('child_occupants')
                                                                Nombre d'occupants enfants
                                                                @break
                                                            @case('family_situation')
                                                                Situation familiale 
                                                                @break
                                                            @case('birth_name')
                                                                Nom
                                                                @break
                                                            @case('birth_date')
                                                                Date de naissance
                                                                @break
                                                            @case('mr_activity')
                                                                Quel est le contrat de travail du conjoint 1
                                                                @break
                                                            @case('mr_revenue')
                                                                Revenue Conjoint 1
                                                                @break
                                                            @case('mrs_activity')
                                                                Activité Madame
                                                                @break
                                                            @case('credit_amount')
                                                                Bon De Commande
                                                                @break
                                                            @case('credit_item')
                                                                CREDIT
                                                                @break
                                                            @case('subvention_amount')
                                                                Bon De Commande
                                                                @break
                                                            @case('subvention_item')
                                                                Subvention
                                                                @break
                                                            @case('mrs_revenue')
                                                                Revenue Madame,Conjoint
                                                                @break
                                                            @case('monthly_credit')
                                                                Credit du foyer mensue
                                                                @break
                                                            @case('revenue_credit')
                                                                Commentaires revenue et credit
                                                                @break
                                                            @case('reste_charge')
                                                                Reste à charge
                                                                @break
                                                            @case('comments')
                                                                Commentaires
                                                                @break
                                                            @case('comment')
                                                                Commentaires
                                                                @break
                                                            @case('example_project')
                                                                Exemple Projet Chaudiere a Granules
                                                                @break
                                                            @case('question_cag')
                                                                Questionnaire technique CAG
                                                                @break
                                                            @case('access_door')
                                                                Porte d'acces
                                                                @break
                                                            @case('boiler_room_size')
                                                                Dimension Chaufferie
                                                                @break
                                                            @case('height')
                                                                Hauteur
                                                                @break
                                                            @case('boiler_location')
                                                                Emplacement chaudière
                                                                @break
                                                            @case('other')
                                                                Si autre, précisez
                                                                @break
                                                            @case('accessibility')
                                                                Accessibilité chaufferie
                                                                @break
                                                            @case('other_question')
                                                                Autres questionnaires à construire ; ITE / PAC / POELE
                                                                @break
                                                            @case('previsite')
                                                                Previsite realisé
                                                                @break
                                                            @case('projet_valide')
                                                                Projet valide
                                                                @break
                                                            @case('devis_signe')
                                                                Devis signe
                                                                @break
                                                            @case('project_charge')
                                                                Reste a charge Projet
                                                                @break
                                                            @case('additional_work')
                                                                Travaux supplementaire
                                                                @break
                                                            @case('additional_work_payable')
                                                                Reste a charge travaux supplementaire
                                                                @break
                                                            @case('preview_date')
                                                                Date de previsite
                                                                @break
                                                            @case('schedule')
                                                                horaire
                                                                @break
                                                            @case('status')
                                                                Status Planning
                                                                @break
                                                            @case('status_previsite')
                                                                Statut previsite
                                                                @break
                                                            @case('customer_status_previsite')
                                                                Statut Client Prévisite 
                                                                @break
                                                            @case('valid_project')
                                                                Projet Valide
                                                                @break
                                                            @case('predicted_report')
                                                                Rapport previsite
                                                                @break
                                                            @case('additional_work2')
                                                                Travaux supplementaire
                                                                @break
                                                            @case('circuit2_devis')
                                                                Plancher chauffant - 2 circuits
                                                                @break
                                                            @case('circuit2_amount')
                                                                Montant
                                                                @break
                                                            @case('circuit1_devis')
                                                                Plancher chauffant - 1 circuit
                                                                @break
                                                            @case('circuit1_amount')
                                                                Montant
                                                                @break
                                                            @case('conduit_double')
                                                                Creation conduit double paroi
                                                                @break
                                                            @case('conduit_double_amount')
                                                                Montant
                                                                @break
                                                            @case('conduit')
                                                                Rehausse conduit
                                                                @break
                                                            @case('conduit_amount')
                                                                Montant
                                                                @break
                                                            @case('water_inlet')
                                                                Creation arrivé d'eau
                                                                @break
                                                            @case('water_inlet_amount')
                                                                Montant
                                                                @break
                                                            @case('electricity')
                                                                Creation forfait "electricité"
                                                                @break
                                                            @case('electricity_amount')
                                                                Montant
                                                                @break
                                                            @case('subvention_deposit_date')
                                                                Date de depot
                                                                @break
                                                            @case('subvention_mpr_file')
                                                                N° Dossier MPR
                                                                @break
                                                            @case('subvention_estimated_amount')
                                                                Montant Sub Previsionnel
                                                                @break
                                                            @case('subvention_deposited_work')
                                                                Travaux deposé 
                                                                @break
                                                            @case('deposit_date')
                                                                Date de depot
                                                                @break
                                                            @case('mpr_file')
                                                                N° Dossier MPR
                                                                @break
                                                            @case('estimated_amount')
                                                                Montant Sub Previsionnel
                                                                @break
                                                            @case('deposited_work')
                                                                Travaux deposé 
                                                                @break
                                                            @case('status_1')
                                                                Status 1
                                                                @break
                                                            @case('status_2')
                                                                Status 2 
                                                                @break
                                                            @case('Logement_file')
                                                                N° Dossier Action Logement    
                                                                @break
                                                            @case('installation_status')
                                                                Statut Installation
                                                                @break
                                                            @case('work_done')
                                                                Travaux réalisé
                                                                @break
                                                            @case('photos')
                                                                Reception photos
                                                                @break
                                                            @case('quality_control_date')
                                                                Date Contrôle Qualité
                                                                @break
                                                            @case('client_name')
                                                                Nom & Prénom Client
                                                                @break
                                                            @case('postal_code')
                                                                Code Postal
                                                                @break
                                                            @case('sales_meeting_date')
                                                                Date RDV commercial 
                                                                @break
                                                            @case('introduction_operator')
                                                                OPERATEUR
                                                                @break
                                                            @case('project_details')
                                                                OPERATEUR
                                                                @break
                                                            @case('meeting_experience')
                                                                Comment s'est déroulé le rendez-vous ?
                                                                @break
                                                            @case('evaluation_rating')
                                                                Évaluation globale (de 1 à 10) à l'ensemble de la prestation
                                                                @break
                                                            @case('remind_me')
                                                                Pourriez-vous me rappeler si vous êtes Propriétaire ou Locataire
                                                                @break
                                                            @case('occupants_number')
                                                                Pourriez-vous me rappeler le nombre ? d'occupants dans le logement ?
                                                                @break
                                                            @case('home_built_time')
                                                                Pourriez-vous me rappeler la date de construction de votre logement ?
                                                                @break
                                                            @case('surface')
                                                                Pourriez-vous me rappeler la surface de votre maison ? 
                                                                @break
                                                            @case('heated_levels')
                                                                Pourriez-vous me rappeler le nombre, de niveaux chauffés ?
                                                                @break
                                                            @case('transmitters_type')
                                                                Pourriez-vous me rappeler le type d'émetteurs 
                                                                @break
                                                            @case('other_transmitters_type')
                                                                Si AUTRE, précisez 
                                                                @break
                                                            @case('hot_water_production')
                                                                Pourriez-vous me rappeler votre Production d'eau chaude sanitaire
                                                                @break
                                                            @case('other_hot_water_production')
                                                                Si AUTRE, précisez
                                                                @break
                                                            @case('have_insulation')
                                                                Pourriez-vous me rappeler si vous avez une isolation au niveau de vos combles ?
                                                                @break
                                                            @case('have_insulation_wall')
                                                                Pourriez-vous me rappeler si vous avez une isolation au niveau de vos murs ?
                                                                @break
                                                            @case('have_insulation_basement')
                                                                Pourriez-vous me rappeler si vous avez une isolation au niveau de votre sous sol?
                                                                @break
                                                            @case('boiler_model')
                                                                Pourriez-vous me préciser le modèle chaudière recommandé ?
                                                                @break
                                                            @case('esc_model')
                                                                Pourriez-vous me préciser le modèle ECS recommandé ?
                                                                @break
                                                            @case('bio_services')
                                                                Pourriez-vous me préciser si le technicien vous à mentionner BioServices ?
                                                                @break
                                                            @case('question_material')
                                                                Avez-vous d'autres questions au sujet du materiel ?
                                                                @break
                                                            @case('professional_situation')
                                                                Pourriez-vous me rappeler votre situation professionnelle
                                                                @break
                                                            @case('other_professional_situation')
                                                                Si AUTRE, précisez 
                                                                @break
                                                            @case('have_children')
                                                                Pourriez-vous me rappeler si vous avez des enfants et combien ?
                                                                @break
                                                            @case('monthly_income')
                                                                Pourriez-vous me rappeler votre revenu mensuel ?
                                                                @break
                                                            @case('current_credits')
                                                                Pourriez-vous me rappeler si vous avez des crédits actuels ?
                                                                @break
                                                            @case('credit_1')
                                                                CREDIT 1 (origine, mensualité, date d'échéance)
                                                                @break
                                                            @case('credit_2')
                                                                CREDIT 2 (origine, mensualité, date d'échéance)
                                                                @break
                                                            @case('credit_3')
                                                                CREDIT 3 (origine, mensualité, date d'échéance)
                                                                @break
                                                            @case('credit_4')
                                                                CREDIT 4 (origine, mensualité, date d'échéance)
                                                                @break
                                                            @case('bank_status')
                                                                Pourriez-vous me préciser votre banque ? Depuis quand ?
                                                                @break
                                                            @case('have_bdc_copy')
                                                                Pourriez-vous me préciser si vous avez un double du BDC ?
                                                                @break
                                                            @case('approved_funding')
                                                                Pourriez-vous me préciser le montant du financement en cas de validation de votre dossier ?
                                                                @break
                                                            @case('monthly_payments')
                                                                Pourriez-vous me préciser le nombre de mensualité en cas de validation de votre dossier ?
                                                                @break
                                                            @case('financing_partner')
                                                                Pourriez-vous me préciser le nom du partenaire dans le financement de votre dossier ?
                                                                @break
                                                            @case('eec_amount')
                                                                Pourriez-vous me préciser le montant du CEE auquel vous avez droit en cas de validation de votre dossier ?
                                                                @break
                                                            @case('renov_amount')
                                                                Pourriez-vous me préciser le montant de la subvention MaPrimeRenov' auquel vous avez le droit en cas de validation de votre dossier
                                                                @break
                                                            @case('renov_paid')
                                                                Est-ce que le technicien vous a précisé que la subvention MaPrimeRenov doit être reinjecté à la maison de financement par anticipation pour faire baisser vos mensualités ?
                                                                @break
                                                            @case('deferral_system')
                                                                Est-ce que le technicien vous a bien expliqué le système des 180 j de report qui sera mis en place suite au financement ?
                                                                @break
                                                            @case('know_more')
                                                                Avez-vous des questions ou des elements que vous souhaitez approfondir
                                                                @break
                                                            @case('motivational_note')
                                                                Note de motivation CLIENT 
                                                                @break
                                                            @case('general_comments')
                                                                Observations generales
                                                                @break
                                                            @case('quality_control_date2')
                                                                Date Contrôle Qualité
                                                                @break
                                                            @case('operator2')
                                                                Operateur
                                                                @break
                                                            @case('client_name2')
                                                                Nom & Prénom Client
                                                                @break
                                                            @case('postal_code2')
                                                                Code Postal
                                                                @break
                                                            @case('installed_date')
                                                                Date Pose
                                                                @break
                                                            @case('project2')
                                                                Projet
                                                                @break
                                                            @case('installer')
                                                                Poseur
                                                                @break
                                                            @case('other_installer')
                                                                Si AUTRE, précisez 
                                                                @break
                                                            @case('commercial2')
                                                                Commercial
                                                                @break
                                                            @case('other_commercial')
                                                                Si autre, précisez
                                                                @break
                                                            @case('satisfied')
                                                                êtes satisfait de la pose ?
                                                                @break
                                                            @case('equipment_installed')
                                                                êtes satisfait du matériel installé ?
                                                                @break
                                                            @case('evaluation')
                                                                Évaluation globale (de 1 à 10) à l'ensemble de la prestation
                                                                @break
                                                            @case('score')
                                                                Si note inférieur à 7, merci de demander la raison
                                                                @break
                                                            @case('recommend')
                                                                Recommanderiez vous Novecology ?
                                                                @break
                                                            @case('mpr_contact')
                                                                Savez vous que MPR va vous recontacter ?
                                                                @break
                                                            @case('identity_validation')
                                                                Validation identitá. Confirmez votre identité ?
                                                                @break
                                                            @case('file_validation')
                                                                Validation dossier : Etes vous bien à l'origine du dossier ?
                                                                @break
                                                            @case('address_validation')
                                                                Adresse est elle identique entre facturation et celle des travaux?
                                                                @break
                                                            @case('company_validation')
                                                                Validation entreprise : Pouvez vous me confirmer quel entreprise a réalisé les travaux ?
                                                                @break
                                                            @case('other_validation')
                                                                Si AUTRE, précisez
                                                                @break
                                                            @case('work_validation')
                                                                Validation travaux : Pouvez vous me confirmer les travaux que vous avez réalisé ?
                                                                @break
                                                            @case('proxy_validation')
                                                                Validation mandataire : Pouvez vous me confirmer votre mandataire ?
                                                                @break
                                                            @case('validation_comment')
                                                                Commentaires
                                                                @break
                                                            @case('amount_validation')
                                                                Validation montant travaux : Pouvez vous me confirmer le montant des travaux que vous avez réalisé ?
                                                                @break
                                                            @case('expense_validation')
                                                                Validation montant Reste à charge : Pouvez vous me confirmer le montant de votre reste à charge ?
                                                                @break
                                                            @case('client_respond')
                                                                Le client a 7 jours pour répondre à MPR
                                                                @break
                                                            @case('paid_consent')
                                                                NOVECOLOGY ne sera pas payer sans le consentement
                                                                @break
                                                            @case('customer_call')
                                                                En cas de doute sur les réponses, le client doit nous appeler
                                                                @break
                                                            @case('receive_invoice')
                                                                Le client recevra sa facture par email sous 10 jours
                                                                @break
                                                            @case('review')
                                                                SI CLIENT SATISFAIT - Etes vous interessé par nous laisser un avis ?
                                                                @break
                                                            @case('carry_out')
                                                                Souhaitez vous réaliser un projet d'ITE avec NOVECOLOGY ?
                                                                @break
                                                            @case('action_logement')
                                                                Etes vous informé que Action Logement Non va vous contacter ?
                                                                @break
                                                            @case('contact_us')
                                                                Savez vous que MaPrimeRenov va vous contacter ?
                                                                @break
                                                            @case('contact_soon')
                                                                Savez vous que l'organisme qui a financé votre installation va vous contacter prochainement ?
                                                                @break
                                                            @case('release_fund')
                                                                Est ce que vous validez le déblocage des fonds ?
                                                                @break
                                                            @case('observations')
                                                                observations generales 
                                                                @break
                                                            @case('campaign_type')
                                                                Type De Campagne
                                                                @break
                                                            @case('request_date')
                                                                Date Demande
                                                                @break
                                                            @case('award_date')
                                                                Date D’attribution Commercial
                                                                @break
                                                            @case('first_last_name')
                                                                Nom Et Prénom
                                                                @break
                                                            @case('p_code')
                                                                Code Postal
                                                                @break
                                                            @case('telephone')
                                                                Téléphone
                                                                @break
                                                            @case('h_mode')
                                                                Mode De Chauffage
                                                                @break
                                                            @case('email_address')
                                                                Email
                                                                @break
                                                            @case('owner')
                                                                Propriétaire
                                                                @break
                                                            @case('over_then_15')
                                                                Votre maison a-t-elle plus de 15 ans ? 
                                                                @break
                                                            @case('precariousness')
                                                                Eligibilite MaPrimeRenov 
                                                                @break
                                                            @case('family_person')
                                                                Nmbre De Personne
                                                                @break
                                                            @case('fiscal_amount')
                                                                Revenue Fiscale De Reference
                                                                @break
                                                            @case('house_over_15_years')
                                                                Age Du Batiment 
                                                                @break
                                                            @case('compte_observations')
                                                                Observations
                                                                @break
                                                            @case('password_email')
                                                                Compte email Mots De Passe
                                                                @break
                                                            @case('email_email')
                                                                Compte email
                                                                @break
                                                            @case('password_mpr')
                                                                Compte MPR Mots De Passe
                                                                @break
                                                            @case('email_mpr')
                                                                Compte MPR Email
                                                                @break
                                                            @case('date_mise')
                                                                Date Mise À Jour
                                                                @break
                                                            @case('banque_montant')
                                                                Montant
                                                                @break
                                                            @case('date_depot')
                                                                Date de dépôt
                                                                @break
                                                            @case('banque_numero_de_dossier')
                                                                Numero de dossier
                                                                @break
                                                            @case('banque_status')
                                                                Statut
                                                                @break
                                                            @case('manque_document')
                                                                Manque document – Detail
                                                                @break
                                                            @case('montant_credit')
                                                                On affiche Montant du crédit accepté
                                                                @break
                                                            @case('banque_notification_date')
                                                                Date de notification d’accord
                                                                @break
                                                            @case('audit_type')
                                                                Audit réalisé
                                                                @break
                                                            @case('study_office')
                                                                Bureau etude
                                                                @break
                                                            @case('audit_user')
                                                                Audit realise par
                                                                @break
                                                            @case('release_date')
                                                                Audit realise le
                                                                @break
                                                            @case('audit_status')
                                                                Statut audit
                                                                @break
                                                            @case('report_status')
                                                                Statut rapport audit
                                                                @break
                                                            @case('report_reference')
                                                                Référence du rapport
                                                                @break
                                                            @case('report_result')
                                                                Resultat du rapport
                                                                @break
                                                            @case('study_date')
                                                                Date Etude
                                                                @break
                                                            @case('hour')
                                                                Horaire
                                                                @break
                                                            @case('status_planning_study')
                                                                Statut Planning Etude
                                                                @break
                                                            @case('technician_study')
                                                                Technicien Etude
                                                                @break
                                                            @case('technique_referee')
                                                                Réfèrent technique
                                                                @break
                                                            @case('status_feasibility_study')
                                                                Statut Faisabilité Etude
                                                                @break
                                                            @case('status_document_study')
                                                                Statut document etude
                                                                @break
                                                            @case('if_complete')
                                                                si incomplet
                                                                @break
                                                            @case('contract_status')
                                                                Statut contrat
                                                                @break
                                                            @case('travaux_list')
                                                                Travaux 1
                                                                @break
                                                            @case('additional_travaux')
                                                                Travaux supplémentaire
                                                                @break
                                                            @case('estimate_amount_ttc')
                                                                Montant TTC du devis / Bon de Commande
                                                                @break
                                                            @case('reflection_reason')
                                                                Réflexion Raison
                                                                @break
                                                            @case('dead_reason')
                                                                Mort Raison
                                                                @break
                                                            @case('date_de_previsite')
                                                                Date de previsite
                                                                @break
                                                            @case('status_planning_previsite')
                                                                Statut Planning previsite
                                                                @break
                                                            @case('technician_previsite')
                                                                Technicien previsite
                                                                @break
                                                            @case('technique_referee')
                                                                Réfèrent technique
                                                                @break
                                                            @case('status_previsite')
                                                                Statut Prévisite
                                                                @break
                                                            @case('status_feasibility_previsite')
                                                                Statut Faisabilité Prévisite
                                                                @break
                                                            @case('status_document_previsite')
                                                                Statut document prévisite
                                                                @break
                                                            @case('paid_by_estimate')
                                                                Reste à charge devis
                                                                @break
                                                            @case('paid_by_customer')
                                                                Reste à charge client
                                                                @break
                                                            @case('over_sale')
                                                                Survente
                                                                @break
                                                            @case('amount_over_selling')
                                                                Montant survente
                                                                @break
                                                            @case('reflection_reason')
                                                                Réflexion Raison 
                                                                @break
                                                            @case('counter_visit_technique_date')
                                                                Date de Contre Visite Technique
                                                                @break
                                                            @case('status_planning_counter_visit')
                                                                Statut Planning Contre Visite
                                                                @break
                                                            @case('technician_counter_visit')
                                                                Technicien Contre visite
                                                                @break
                                                            @case('status_counter_visit')
                                                                Statut Contre visite
                                                                @break
                                                            @case('status_feasibility_counter_visit')
                                                                Statut Faisabilité contre visite
                                                                @break
                                                            @case('installation_date')
                                                                Date Installation 
                                                                @break
                                                            @case('technician_installation')
                                                                Technicien
                                                                @break
                                                            @case('team_leader_installation')
                                                                Chef d’equipe
                                                                @break
                                                            @case('status_planning_installation')
                                                                Statut Planning Installation
                                                                @break
                                                            @case('installation_file')
                                                                Dossier Installation
                                                                @break
                                                            @case('travaux_release_installation')
                                                                Travaux réalisés
                                                                @break
                                                            @case('reception_photo')
                                                                Réception photo
                                                                @break
                                                            @case('reception_file')
                                                                Réception dossier
                                                                @break
                                                            @case('sav_date')
                                                                Date de SAV
                                                                @break
                                                            @case('stutus_planning_sav')
                                                                Statut Planning SAV
                                                                @break
                                                            @case('technician_sav')
                                                                Technicien SAV
                                                                @break
                                                            @case('status_resolution_sav')
                                                                Statut Resolution SAV
                                                                @break
                                                            @case('status_planning_deplacement')
                                                                Statut Planning Deplacement
                                                                @break
                                                            @case('controle_office')
                                                                Bureau de contrôle 
                                                                @break
                                                            @case('control_date')
                                                                Date de contrôle 
                                                                @break
                                                            @case('inspection_status')
                                                                Statut du contrôle COFRAC 
                                                                @break
                                                            @case('controlled_workd')
                                                                Travaux contrôlé 
                                                                @break
                                                            @case('compliance')
                                                                Conformité du chantier 
                                                                @break
                                                            @case('m2_controlled')
                                                                M2 controlé 
                                                                @break
                                                            @case('m2_achieved')
                                                                M2 réalisé 
                                                                @break
                                                            @case('difference_m2')
                                                                Ecart m2 
                                                                @break
                                                            @case('company_commissioned')
                                                                Société mise en service 
                                                                @break
                                                            @case('date_of_commissioning')
                                                                Date de mise en service 
                                                                @break
                                                            @case('technician')
                                                                Technicien de mise en service 
                                                                @break
                                                            @case('commissioning_status')
                                                                Statut du mise en service 
                                                                @break
                                                            @case('audit_report')
                                                                Compte rendu Audit 
                                                                @break
                                                            @case('compliance_resolved')
                                                                Mise en conformité A régler en urgence (pb sécurité ou fonctionnelle) 
                                                                @break
                                                            @case('compliance_resolved_reason')
                                                                Raisons 
                                                                @break
                                                            @case('compliance_sattled')
                                                                Mise en conformité : A régler rapidement pour finaliser le chantier 
                                                                @break
                                                            @case('audit_facture')
                                                                Audit Facture 
                                                                @break
                                                            @case('compliance_sattled_reason')
                                                                Raisons 
                                                                @break
                                                            @case('invoice_number')
                                                                Numero de facture
                                                                @break 
                                                            @case('status_facture')
                                                                Statut facture societe mes 
                                                                @break
                                                            @case('mes_price')
                                                                Prix mes 
                                                                @break
                                                            @case('observation_company')
                                                                Observations societe mes 
                                                                @break
                                                            @case('controle_office_csp')
                                                                Bureau de contrôle CSP MPR 
                                                                @break
                                                            @case('control_date_csp')
                                                                Date de contrôle CSP MPR 
                                                                @break
                                                            @case('csp_status')
                                                                Statut contrôle CSP MPR 
                                                                @break
                                                            @case('transit_slip')
                                                                Réception du bordereau de passage 
                                                                @break
                                                            @case('observation_control')
                                                                Observation du contrôle  
                                                                @break
                                                            @case('observation')
                                                                Observation 
                                                                @break
                                                            @case('customer_payment')
                                                                Reglement Client 
                                                                @break
                                                            @case('status_invoice_customer_payment')
                                                                Statut FACTURATION REGLEMENT CLIENT 
                                                                @break
                                                            @case('invoice_customer_amount')
                                                                Statut FACTURATION REGLEMENT CLIENT Montant 
                                                                @break
                                                            @case('invoice_customer_forme')
                                                                Statut FACTURATION REGLEMENT CLIENT Forme 
                                                                @break
                                                            @case('invoice_customer_mode')
                                                                Statut FACTURATION REGLEMENT CLIENT Mode 
                                                                @break
                                                            @case('invoice_customer_nubmer_of_month')
                                                                nombre de mensualité 
                                                                @break
                                                            @case('invoice_customer_date1')
                                                                Règlement 1 Date 
                                                                @break
                                                            @case('invoice_customer_amount21')
                                                                Règlement 1 Montant  
                                                                @break
                                                            @case('invoice_customer_status1')
                                                                Règlement 1 Statut
                                                                @break
                                                            @case('invoice_customer_mode21')
                                                                Règlement 1 mode
                                                                @break
                                                            @case('invoice_customer_date2')
                                                                Règlement 2 Date 
                                                                @break
                                                            @case('invoice_customer_amount22')
                                                                Règlement 2 Montant  
                                                                @break
                                                            @case('invoice_customer_status2')
                                                                Règlement 2 Statut
                                                                @break
                                                            @case('invoice_customer_mode22')
                                                                Règlement 2 mode
                                                                @break
                                                            @case('invoice_customer_date3')
                                                                Règlement 3 Date 
                                                                @break
                                                            @case('invoice_customer_amount23')
                                                                Règlement 3 Montant  
                                                                @break
                                                            @case('invoice_customer_status3')
                                                                Règlement 3 Statut
                                                                @break
                                                            @case('invoice_customer_mode23')
                                                                Règlement 3 mode
                                                                @break
                                                            @case('invoice_customer_date4')
                                                                Règlement 4 Date 
                                                                @break
                                                            @case('invoice_customer_amount24')
                                                                Règlement 4 Montant  
                                                                @break
                                                            @case('invoice_customer_status4')
                                                                Règlement 4 Statut
                                                                @break
                                                            @case('invoice_customer_mode24')
                                                                Règlement 4 mode
                                                                @break
                                                            @case('invoice_customer_date5')
                                                                Règlement 5 Date 
                                                                @break
                                                            @case('invoice_customer_amount25')
                                                                Règlement 5 Montant  
                                                                @break
                                                            @case('invoice_customer_status5')
                                                                Règlement 5 Statut
                                                                @break
                                                            @case('invoice_customer_mode25')
                                                                Règlement 5 mode
                                                                @break
                                                            @case('invoice_customer_date6')
                                                                Règlement 6 Date 
                                                                @break
                                                            @case('invoice_customer_amount26')
                                                                Règlement 6 Montant  
                                                                @break
                                                            @case('invoice_customer_status6')
                                                                Règlement 6 Statut
                                                                @break
                                                            @case('invoice_customer_mode26')
                                                                Règlement 6 mode
                                                                @break
                                                            @case('invoice_customer_date7')
                                                                Règlement 7 Date 
                                                                @break
                                                            @case('invoice_customer_amount27')
                                                                Règlement 7 Montant  
                                                                @break
                                                            @case('invoice_customer_status7')
                                                                Règlement 7 Statut
                                                                @break
                                                            @case('invoice_customer_mode27')
                                                                Règlement 7 mode
                                                                @break
                                                            @case('invoice_customer_date8')
                                                                Règlement 8 Date 
                                                                @break
                                                            @case('invoice_customer_amount28')
                                                                Règlement 8 Montant  
                                                                @break
                                                            @case('invoice_customer_status8')
                                                                Règlement 8 Statut
                                                                @break
                                                            @case('invoice_customer_mode28')
                                                                Règlement 8 mode
                                                                @break
                                                            @case('invoice_customer_date9')
                                                                Règlement 9 Date 
                                                                @break
                                                            @case('invoice_customer_amount29')
                                                                Règlement 9 Montant  
                                                                @break
                                                            @case('invoice_customer_status9')
                                                                Règlement 9 Statut
                                                                @break
                                                            @case('invoice_customer_mode29')
                                                                Règlement 9 mode
                                                                @break
                                                            @case('invoice_customer_date10')
                                                                Règlement 10 Date 
                                                                @break
                                                            @case('invoice_customer_amount210')
                                                                Règlement 10 Montant  
                                                                @break
                                                            @case('invoice_customer_status10')
                                                                Règlement 10 Statut
                                                                @break
                                                            @case('invoice_customer_mode210')
                                                                Règlement 10 mode
                                                                @break
                                                            @case('invoice_customer_date11')
                                                                Règlement 11 Date 
                                                                @break
                                                            @case('invoice_customer_amount211')
                                                                Règlement 11 Montant  
                                                                @break
                                                            @case('invoice_customer_status11')
                                                                Règlement 11 Statut
                                                                @break
                                                            @case('invoice_customer_mode211')
                                                                Règlement 11 mode
                                                                @break
                                                            @case('invoice_customer_date12')
                                                                Règlement 12 Date 
                                                                @break
                                                            @case('invoice_customer_amount212')
                                                                Règlement 12 Montant  
                                                                @break
                                                            @case('invoice_customer_status12')
                                                                Règlement 12 Statut
                                                                @break
                                                            @case('invoice_customer_mode212')
                                                                Règlement 12 mode
                                                                @break
                                                            @case('regulation_cee')
                                                                Reglement CEE 
                                                                @break
                                                            @case('invoice_status_cee')
                                                                Statut Facturation CEE 
                                                                @break
                                                            @case('delegataire')
                                                                Delegataire 
                                                                @break
                                                            @case('cumac')
                                                                CUMAC 
                                                                @break
                                                            @case('amount_cee_bonus')
                                                                Montant prime C.E.E bénéficiaire 
                                                                @break
                                                            @case('amount_cee_noveco')
                                                                Montant prime C.E.E Novecology 
                                                                @break
                                                            @case('business_support_amount')
                                                                Montant Apporteur d’affaires Novecology 
                                                                @break
                                                            @case('regulation_lot')
                                                                LOT 
                                                                @break
                                                            @case('date_depot_polluter')
                                                                Date Depot Pollueur 
                                                                @break
                                                            @case('invoice_number_noveco')
                                                                Numero Facture Novecology 
                                                                @break
                                                            @case('regulation_maprimerenonv')
                                                                Reglement MAPRIMERENONV 
                                                                @break
                                                            @case('invoice_status_mpr')
                                                                Statut Facturation MPR 
                                                                @break
                                                            @case('invoice_amount_mpr')
                                                                Montant Facturation MPR 
                                                                @break
                                                            @case('manager')
                                                                Mandataire 
                                                                @break
                                                            @case('construction_company')
                                                                Entreprise de travaux 
                                                                @break
                                                            @case('invoice_date_deposit_mpr')
                                                                Date depot facturation MPR 
                                                                @break
                                                            @case('regulation_action_logement')
                                                                Reglement Action Logement 
                                                                @break
                                                            @case('regulation_banque')
                                                                Reglement Banque 
                                                                @break
                                                            @case('invoice_status_banque')
                                                                Statut Facturation Banque 
                                                                @break
                                                            @case('section_banque')
                                                                Banque 
                                                                @break
                                                            @case('agency_file')
                                                                N* Dossier organisme 
                                                                @break
                                                            @case('invoice_banque_amount')
                                                                Montant facturation banque 
                                                                @break
                                                            @case('date_contract_sent')
                                                                Date envoi contrat 
                                                                @break
                                                            @case('tracking_number')
                                                                Numero suivi envoi contrat 
                                                                @break
                                                            @case('date_of_application')
                                                                Date demande de financement 
                                                                @break
                                                            @case('pay_the')
                                                                Paye le 
                                                                @break
                                                            @case('material_invoice')
                                                                Ajouter facture matériel 
                                                                @break
                                                            @case('material_invoice_status')
                                                                Statut facture matériel 
                                                                @break
                                                            @case('material_invoice_supplier')
                                                                Fournisseur 
                                                                @break
                                                            @case('equipment_list')
                                                                Liste matériel 
                                                                @break
                                                            @case('material_invoice_number')
                                                                Numéro de facture 
                                                                @break
                                                            @case('material_invoice_date')
                                                                Date de facture 
                                                                @break
                                                            @case('material_invoice_paid_date')
                                                                Payé le 
                                                                @break
                                                            @case('material_invoice_amount_ht')
                                                                Montant HT 
                                                                @break
                                                            @case('material_invoice_amount_ttc')
                                                                Montant TTC 
                                                                @break
                                                            @case('material_invoice_amount_tva')
                                                                Montant TVA 
                                                                @break
                                                            @case('material_invoice_observation')
                                                                Observation 
                                                                @break
                                                            @case('installer_invoice')
                                                                Ajouter facture installateur 
                                                                @break
                                                            @case('installer_invoice_status')
                                                                Statut facture Installateur 
                                                                @break
                                                            @case('installer_invoice_installer')
                                                                Installateur 
                                                                @break
                                                            @case('installer_invoice_number')
                                                                Numéro de facture 
                                                                @break
                                                            @case('installer_invoice_paid_date')
                                                                Payé le 
                                                                @break
                                                            @case('installer_invoice_observation')
                                                                Observation
                                                                @break
                                                            @case('installer_invoice_amount_ht')
                                                                Montant HT 
                                                                @break
                                                            @case('installer_invoice_amount_ttc')
                                                                Montant TTC 
                                                                @break
                                                            @case('installer_invoice_amount_tva')
                                                                Montant TVA 
                                                                @break
                                                            @case('commercial_invoice')
                                                                Ajouter facture commercial 
                                                                @break
                                                            @case('commercial_invoice_status')
                                                                Statut facture commercial 
                                                                @break
                                                            @case('commercial_invoice_commercial')
                                                                Commercial 
                                                                @break
                                                            @case('commercial_invoice_number')
                                                                Numéro de facture 
                                                                @break
                                                            @case('commercial_invoice_paid_date')
                                                                Payé le 
                                                                @break
                                                            @case('commercial_invoice_amount_ht')
                                                                Montant HT 
                                                                @break
                                                            @case('commercial_invoice_comment')
                                                                Commentaires 
                                                                @break
                                                            @case('provider_invoice')
                                                                Ajouter facture previsiteur 
                                                                @break
                                                            @case('provider_invoice_status')
                                                                Statut facture previsiteur 
                                                                @break
                                                            @case('provider_invoice_preview')
                                                                Previsiteur 
                                                                @break
                                                            @case('provider_invoice_number')
                                                                Numéro de facture 
                                                                @break
                                                            @case('provider_invoice_paid_date')
                                                                Payé le 
                                                                @break
                                                            @case('provider_invoice_comment')
                                                                Commentaires 
                                                                @break
                                                            @case('other_invoice_1')
                                                                Ajouter facture Autre dépense 1 
                                                                @break
                                                            @case('other_invoice_1_designation')
                                                                Désignation 
                                                                @break
                                                            @case('other_invoice_1_other_status')
                                                                Statut AUTRE 1 
                                                                @break
                                                            @case('other_invoice_1_number')
                                                                Numéro de facture 
                                                                @break
                                                            @case('other_invoice_1_paid_date')
                                                                Payé le 
                                                                @break
                                                            @case('other_invoice_1_amount_ht')
                                                                Montant HT 
                                                                @break
                                                            @case('other_invoice_1_comment')
                                                                Commentaires 
                                                                @break
                                                            @case('other_invoice_2')
                                                                Ajouter facture Autre dépense 2 
                                                                @break
                                                            @case('other_invoice_2_designation')
                                                                Désignation 
                                                                @break
                                                            @case('other_invoice_2_other_status')
                                                                Statut AUTRE 1 
                                                                @break
                                                            @case('other_invoice_2_number')
                                                                Numéro de facture 
                                                                @break
                                                            @case('other_invoice_2_paid_date')
                                                                Payé le 
                                                                @break
                                                            @case('other_invoice_2_amount_ht')
                                                                Montant HT 
                                                                @break
                                                            @case('other_invoice_2_comment')
                                                                Commentaires 
                                                                @break
                                                            @case('other_invoice_3')
                                                                Ajouter facture Autre dépense 3 
                                                                @break
                                                            @case('other_invoice_3_designation')
                                                                Désignation 
                                                                @break
                                                            @case('other_invoice_3_other_status')
                                                                Statut AUTRE 1 
                                                                @break
                                                            @case('other_invoice_3_number')
                                                                Numéro de facture 
                                                                @break
                                                            @case('other_invoice_3_paid_date')
                                                                Payé le 
                                                                @break
                                                            @case('rapport__list')
                                                                Rapport 
                                                                @break
                                                            @case('deposited__work')
                                                                Travaux Deposé 
                                                                @break
                                                            @case('project_equipe_user')
                                                                Equipe
                                                                @break
                                                            @case('other_invoice_3_amount_ht')
                                                                Montant HT 
                                                                @break
                                                            @case('other_invoice_3_comment')
                                                                Commentaires  
                                                                @break
                                                            @case('Type_du_courant_du_logement')
                                                                type de compteur du logement
                                                                @break
                                                            @case('auxiliary_heating__Insert_à_bois_Nombre')
                                                                Insert à bois Nombre
                                                                @break
                                                            @case('auxiliary_heating__Poêle_à_bois_Nombre')
                                                                Poêle à bois Nombre
                                                                @break
                                                            @case('auxiliary_heating__Poêle_à_gaz_Nombre')
                                                                Poêle à gaz Nombre
                                                                @break
                                                            @case('auxiliary_heating__Convecteur_électrique_Nombre')
                                                                Convecteur électrique Nombre
                                                                @break
                                                            @case('auxiliary_heating__Sèche_serviette_Nombre')
                                                                Sèche-serviette Nombre
                                                                @break
                                                            @case('auxiliary_heating__Panneau_rayonnant_Nombre')
                                                                Panneau rayonnant Nombre
                                                                @break
                                                            @case('auxiliary_heating__Radiateur_bain_dhuile_Nombre')
                                                                Radiateur bain d'huile Nombre
                                                                @break
                                                            @case('auxiliary_heating__Radiateur_soufflan_électrique_Nombre')
                                                                Radiateur soufflant électrique Nombre
                                                                @break
                                                            @case('auxiliary_heating__Autre_Nombre')
                                                                Autre Nombre
                                                                @break
                                                            @default
                                                                @php
                                                                    $field = explode('__', $activity->key);
                                                                @endphp
                                                                @if ($field[0] == 'autre_field')
                                                                    Merci de préciser
                                                                @else
                                                                {{ str_replace('_', ' ', $activity->key) }}  
                                                                @endif  
                                                        @endswitch 
                                                    {{-- @if ($activity->key == 'second_title')
                                                        Title
                                                        @elseif($activity->key == 'phone')
                                                        N° Mobile
                                                        @elseif($activity->key == 'telephone')
                                                        N° Fixe
                                                        @elseif($activity->key == 'heating_type')
                                                        Type de chauffage
                                                        @elseif($activity->key == 'nature_occupation')
                                                        Occupation
                                                        @elseif($activity->key == 'occupation_type')
                                                        Type occupation
                                                        @elseif($activity->key == 'cadstrable_plot')
                                                        Parcelle cadastrale
                                                        @elseif($activity->key == 'foyer')
                                                        Nombre de foyer
                                                        @elseif($activity->key == 'house_over_15_years')
                                                        Age du batiment
                                                        @elseif($activity->key == 'project_name')
                                                        Nom du projet
                                                        @elseif($activity->key == 'address' && $activity->block_name == 'Personal informations')
                                                        Compléement Adresse 
                                                        @elseif($activity->key == 'address' && $activity->block_name == 'Travaux')
                                                        Addresse Du Projet
                                                        @elseif($activity->key == 'address2')
                                                        adresse
                                                        @elseif($activity->key == 'address')
                                                        adresse
                                                        @elseif($activity->key == 'last_name')
                                                        Nom
                                                        @elseif($activity->key == 'first_name')
                                                        Prenom
                                                        @elseif($activity->key == 'present_address')
                                                        Nouvelle adresse
                                                        @elseif($activity->key == 'other_heating')
                                                        Si Autre Précisez
                                                        @elseif($activity->key == 'specify_heating')
                                                        Precisez le chauffage d appoint
                                                        @elseif($activity->key == 'heating_generator')
                                                        La maison possède un second générateur de chauffage
                                                        @elseif($activity->key == 'supplementary')
                                                        Le logement possède un chauffage d’appoint ?
                                                        @elseif($activity->key == 'with_basement')
                                                        Depuis Quand Occupez Vous Le Logement
                                                        @elseif($activity->key == 'annual_heating2')
                                                        Consommation Chauffage Annuel En Volume
                                                        @elseif($activity->key == 'date_fo_construction')
                                                        Date construction maison
                                                        @elseif($activity->key == 'living_area')
                                                        Surface habitable
                                                        @elseif($activity->key == 'auxiliary_heating')
                                                        Chauffage d'appoint
                                                        @elseif($activity->key == 'second_heating_type')
                                                        La maison possède un second générateur de chauffage
                                                        @elseif($activity->key == 'other_second_heating_type')
                                                        Si autre précisez(Second mode de chauffage)
                                                        @elseif($activity->key == 'transmitter_type')
                                                        Type d'émetteur
                                                        @elseif($activity->key == 'number_of_radiator')
                                                        Nombre de radiateur
                                                        @elseif($activity->key == 'radiator_type')
                                                        Type de radiateur
                                                        @elseif($activity->key == 'other_radiator_type')
                                                        Si autre précisez(Type de radiateur)
                                                        @elseif($activity->key == 'hot_water_production')
                                                        Production d'eau chaude sanitaire
                                                        @elseif($activity->key == 'hot_water_feature')
                                                        Production d'eau chaude sanitaire
                                                        @elseif($activity->key == 'volume')
                                                        Volume Ballon Eau chaude
                                                        @elseif($activity->key == 'annual_heating')
                                                        Consommation chauffage Annuel
                                                        @elseif($activity->key == 'adult_occupants')
                                                        Nombre d'occupants adultes
                                                        @elseif($activity->key == 'child_occupants')
                                                        Nombre d'occupants enfants
                                                        @elseif($activity->key == 'family_situation')
                                                        Situation familiale 
                                                        @elseif($activity->key == 'birth_name')
                                                        Nom
                                                        @elseif($activity->key == 'birth_date')
                                                        Date de naissance
                                                        @elseif($activity->key == 'mr_activity')
                                                        Quel est le contrat de travail du conjoint 1
                                                        @elseif($activity->key == 'mr_revenue')
                                                        Revenue Conjoint 1
                                                        @elseif($activity->key == 'mrs_activity')
                                                        Activité Madame
                                                        @elseif($activity->key == 'credit_amount')
                                                        Bon De Commande
                                                        @elseif($activity->key == 'credit_item')
                                                        CREDIT
                                                        @elseif($activity->key == 'subvention_amount')
                                                        Bon De Commande
                                                        @elseif($activity->key == 'subvention_item')
                                                        Subvention
                                                        @elseif($activity->key == 'mrs_revenue')
                                                        Revenue Madame,Conjoint
                                                        @elseif($activity->key == 'monthly_credit')
                                                        Credit du foyer mensue
                                                        @elseif($activity->key == 'revenue_credit')
                                                        Commentaires revenue et credit
                                                        @elseif($activity->key == 'reste_charge')
                                                        Reste à charge
                                                        @elseif($activity->key == 'comments')
                                                        Commentaires
                                                        @elseif($activity->key == 'comment')
                                                        Commentaires
                                                        @elseif($activity->key == 'example_project')
                                                        Exemple Projet Chaudiere a Granules
                                                        @elseif($activity->key == 'question_cag')
                                                        Questionnaire technique CAG
                                                        @elseif($activity->key == 'access_door')
                                                        Porte d'acces
                                                        @elseif($activity->key == 'boiler_room_size')
                                                        Dimension Chaufferie
                                                        @elseif($activity->key == 'height')
                                                        Hauteur
                                                        @elseif($activity->key == 'boiler_location')
                                                        Emplacement chaudière
                                                        @elseif($activity->key == 'other')
                                                        Si autre, précisez
                                                        @elseif($activity->key == 'accessibility')
                                                        Accessibilité chaufferie
                                                        @elseif($activity->key == 'other_question')
                                                        Autres questionnaires à construire ; ITE / PAC / POELE
                                                        @elseif($activity->key == 'previsite')
                                                        Previsite realisé
                                                        @elseif($activity->key == 'projet_valide')
                                                        Projet valide
                                                        @elseif($activity->key == 'devis_signe')
                                                        Devis signe
                                                        @elseif($activity->key == 'project_charge')
                                                        Reste a charge Projet
                                                        @elseif($activity->key == 'additional_work')
                                                        Travaux supplementaire
                                                        @elseif($activity->key == 'additional_work_payable')
                                                        Reste a charge travaux supplementaire
                                                        @elseif($activity->key == 'preview_date')
                                                        Date de previsite
                                                        @elseif($activity->key == 'schedule')
                                                        horaire
                                                        @elseif($activity->key == 'status')
                                                        Status Planning
                                                        @elseif($activity->key == 'status_previsite')
                                                        Statut previsite
                                                        @elseif($activity->key == 'customer_status_previsite')
                                                        Statut Client Prévisite 
                                                        @elseif($activity->key == 'valid_project')
                                                        Projet Valide
                                                        @elseif($activity->key == 'predicted_report')
                                                        Rapport previsite
                                                        @elseif($activity->key == 'additional_work2')
                                                        Travaux supplementaire
                                                        @elseif($activity->key == 'circuit2_devis')
                                                        Plancher chauffant - 2 circuits
                                                        @elseif($activity->key == 'circuit2_amount')
                                                        Montant
                                                        @elseif($activity->key == 'circuit1_devis')
                                                        Plancher chauffant - 1 circuit
                                                        @elseif($activity->key == 'circuit1_amount')
                                                        Montant
                                                        @elseif($activity->key == 'conduit_double')
                                                        Creation conduit double paroi
                                                        @elseif($activity->key == 'conduit_double_amount')
                                                        Montant
                                                        @elseif($activity->key == 'conduit')
                                                        Rehausse conduit
                                                        @elseif($activity->key == 'conduit_amount')
                                                        Montant
                                                        @elseif($activity->key == 'water_inlet')
                                                        Creation arrivé d'eau
                                                        @elseif($activity->key == 'water_inlet_amount')
                                                        Montant
                                                        @elseif($activity->key == 'electricity')
                                                        Creation forfait "electricité"
                                                        @elseif($activity->key == 'electricity_amount')
                                                        Montant
                                                        @elseif($activity->key == 'subvention_deposit_date')
                                                        Date de depot
                                                        @elseif($activity->key == 'subvention_mpr_file')
                                                        N° Dossier MPR
                                                        @elseif($activity->key == 'subvention_estimated_amount')
                                                        Montant Sub Previsionnel
                                                        @elseif($activity->key == 'subvention_deposited_work')
                                                        Travaux deposé 
                                                        @elseif($activity->key == 'deposit_date')
                                                        Date de depot
                                                        @elseif($activity->key == 'mpr_file')
                                                        N° Dossier MPR
                                                        @elseif($activity->key == 'estimated_amount')
                                                        Montant Sub Previsionnel
                                                        @elseif($activity->key == 'deposited_work')
                                                        Travaux deposé 
                                                        @elseif($activity->key == 'status_1')
                                                        Status 1
                                                        @elseif($activity->key == 'status_2')
                                                        Status 2 
                                                        @elseif($activity->key == 'Logement_file')
                                                        N° Dossier Action Logement    
                                                        @elseif($activity->key == 'installation_status')
                                                        Statut Installation
                                                        @elseif($activity->key == 'work_done')
                                                        Travaux réalisé
                                                        @elseif($activity->key == 'photos')
                                                        Reception photos
                                                        @elseif($activity->key == 'quality_control_date')
                                                        Date Contrôle Qualité
                                                        @elseif($activity->key == 'client_name')
                                                        Nom & Prénom Client
                                                        @elseif($activity->key == 'postal_code')
                                                        Code Postal
                                                        @elseif($activity->key == 'sales_meeting_date')
                                                        Date RDV commercial 
                                                        @elseif($activity->key == 'introduction_operator')
                                                        OPERATEUR
                                                        @elseif($activity->key == 'project_details')
                                                        OPERATEUR
                                                        @elseif($activity->key == 'meeting_experience')
                                                        Comment s'est déroulé le rendez-vous ?
                                                        @elseif($activity->key == 'evaluation_rating')
                                                        Évaluation globale (de 1 à 10) à l'ensemble de la prestation
                                                        @elseif($activity->key == 'remind_me')
                                                        Pourriez-vous me rappeler si vous êtes Propriétaire ou Locataire
                                                        @elseif($activity->key == 'occupants_number')
                                                        Pourriez-vous me rappeler le nombre ? d'occupants dans le logement ?
                                                        @elseif($activity->key == 'home_built_time')
                                                        Pourriez-vous me rappeler la date de construction de votre logement ?
                                                        @elseif($activity->key == 'surface')
                                                        Pourriez-vous me rappeler la surface de votre maison ? 
                                                        @elseif($activity->key == 'heated_levels')
                                                        Pourriez-vous me rappeler le nombre, de niveaux chauffés ?
                                                        @elseif($activity->key == 'transmitters_type')
                                                        Pourriez-vous me rappeler le type d'émetteurs 
                                                        @elseif($activity->key == 'other_transmitters_type')
                                                        Si AUTRE, précisez 
                                                        @elseif($activity->key == 'hot_water_production')
                                                        Pourriez-vous me rappeler votre Production d'eau chaude sanitaire
                                                        @elseif($activity->key == 'other_hot_water_production')
                                                        Si AUTRE, précisez
                                                        @elseif($activity->key == 'have_insulation')
                                                        Pourriez-vous me rappeler si vous avez une isolation au niveau de vos combles ?
                                                        @elseif($activity->key == 'have_insulation_wall')
                                                        Pourriez-vous me rappeler si vous avez une isolation au niveau de vos murs ?
                                                        @elseif($activity->key == 'have_insulation_basement')
                                                        Pourriez-vous me rappeler si vous avez une isolation au niveau de votre sous sol?
                                                        @elseif($activity->key == 'boiler_model')
                                                        Pourriez-vous me préciser le modèle chaudière recommandé ?
                                                        @elseif($activity->key == 'esc_model')
                                                        Pourriez-vous me préciser le modèle ECS recommandé ?
                                                        @elseif($activity->key == 'bio_services')
                                                        Pourriez-vous me préciser si le technicien vous à mentionner BioServices ?
                                                        @elseif($activity->key == 'question_material')
                                                        Avez-vous d'autres questions au sujet du materiel ?
                                                        @elseif($activity->key == 'professional_situation')
                                                        Pourriez-vous me rappeler votre situation professionnelle
                                                        @elseif($activity->key == 'other_professional_situation')
                                                        Si AUTRE, précisez 
                                                        @elseif($activity->key == 'have_children')
                                                        Pourriez-vous me rappeler si vous avez des enfants et combien ?
                                                        @elseif($activity->key == 'monthly_income')
                                                        Pourriez-vous me rappeler votre revenu mensuel ?
                                                        @elseif($activity->key == 'current_credits')
                                                        Pourriez-vous me rappeler si vous avez des crédits actuels ?
                                                        @elseif($activity->key == 'credit_1')
                                                        CREDIT 1 (origine, mensualité, date d'échéance)
                                                        @elseif($activity->key == 'credit_2')
                                                        CREDIT 2 (origine, mensualité, date d'échéance)
                                                        @elseif($activity->key == 'credit_3')
                                                        CREDIT 3 (origine, mensualité, date d'échéance)
                                                        @elseif($activity->key == 'credit_4')
                                                        CREDIT 4 (origine, mensualité, date d'échéance)
                                                        @elseif($activity->key == 'bank_status')
                                                        Pourriez-vous me préciser votre banque ? Depuis quand ?
                                                        @elseif($activity->key == 'have_bdc_copy')
                                                        Pourriez-vous me préciser si vous avez un double du BDC ?
                                                        @elseif($activity->key == 'approved_funding')
                                                        Pourriez-vous me préciser le montant du financement en cas de validation de votre dossier ?
                                                        @elseif($activity->key == 'monthly_payments')
                                                        Pourriez-vous me préciser le nombre de mensualité en cas de validation de votre dossier ?
                                                        @elseif($activity->key == 'financing_partner')
                                                        Pourriez-vous me préciser le nom du partenaire dans le financement de votre dossier ?
                                                        @elseif($activity->key == 'eec_amount')
                                                        Pourriez-vous me préciser le montant du CEE auquel vous avez droit en cas de validation de votre dossier ?
                                                        @elseif($activity->key == 'renov_amount')
                                                        Pourriez-vous me préciser le montant de la subvention MaPrimeRenov' auquel vous avez le droit en cas de validation de votre dossier
                                                        @elseif($activity->key == 'renov_paid')
                                                        Est-ce que le technicien vous a précisé que la subvention MaPrimeRenov doit être reinjecté à la maison de financement par anticipation pour faire baisser vos mensualités ?
                                                        @elseif($activity->key == 'deferral_system')
                                                        Est-ce que le technicien vous a bien expliqué le système des 180 j de report qui sera mis en place suite au financement ?
                                                        @elseif($activity->key == 'know_more')
                                                        Avez-vous des questions ou des elements que vous souhaitez approfondir
                                                        @elseif($activity->key == 'motivational_note')
                                                        Note de motivation CLIENT 
                                                        @elseif($activity->key == 'general_comments')
                                                        Observations generales
                                                        @elseif($activity->key == 'quality_control_date2')
                                                        Date Contrôle Qualité
                                                        @elseif($activity->key == 'operator2')
                                                        Operateur
                                                        @elseif($activity->key == 'client_name2')
                                                        Nom & Prénom Client
                                                        @elseif($activity->key == 'postal_code2')
                                                        Code Postal
                                                        @elseif($activity->key == 'installed_date')
                                                        Date Pose
                                                        @elseif($activity->key == 'project2')
                                                        Projet
                                                        @elseif($activity->key == 'installer')
                                                        Poseur
                                                        @elseif($activity->key == 'other_installer')
                                                        Si AUTRE, précisez 
                                                        @elseif($activity->key == 'commercial2')
                                                        Commercial
                                                        @elseif($activity->key == 'other_commercial')
                                                        Si autre, précisez
                                                        @elseif($activity->key == 'satisfied')
                                                        êtes satisfait de la pose ?
                                                        @elseif($activity->key == 'equipment_installed')
                                                        êtes satisfait du matériel installé ?
                                                        @elseif($activity->key == 'evaluation')
                                                        Évaluation globale (de 1 à 10) à l'ensemble de la prestation
                                                        @elseif($activity->key == 'score')
                                                        Si note inférieur à 7, merci de demander la raison
                                                        @elseif($activity->key == 'recommend')
                                                        Recommanderiez vous Novecology ?
                                                        @elseif($activity->key == 'mpr_contact')
                                                        Savez vous que MPR va vous recontacter ?
                                                        @elseif($activity->key == 'identity_validation')
                                                        Validation identitá. Confirmez votre identité ?
                                                        @elseif($activity->key == 'file_validation')
                                                        Validation dossier : Etes vous bien à l'origine du dossier ?
                                                        @elseif($activity->key == 'address_validation')
                                                        Adresse est elle identique entre facturation et celle des travaux?
                                                        @elseif($activity->key == 'company_validation')
                                                        Validation entreprise : Pouvez vous me confirmer quel entreprise a réalisé les travaux ?
                                                        @elseif($activity->key == 'other_validation')
                                                        Si AUTRE, précisez
                                                        @elseif($activity->key == 'work_validation')
                                                        Validation travaux : Pouvez vous me confirmer les travaux que vous avez réalisé ?
                                                        @elseif($activity->key == 'proxy_validation')
                                                        Validation mandataire : Pouvez vous me confirmer votre mandataire ?
                                                        @elseif($activity->key == 'validation_comment')
                                                        Commentaires
                                                        @elseif($activity->key == 'amount_validation')
                                                        Validation montant travaux : Pouvez vous me confirmer le montant des travaux que vous avez réalisé ?
                                                        @elseif($activity->key == 'expense_validation')
                                                        Validation montant Reste à charge : Pouvez vous me confirmer le montant de votre reste à charge ?
                                                        @elseif($activity->key == 'client_respond')
                                                        Le client a 7 jours pour répondre à MPR
                                                        @elseif($activity->key == 'paid_consent')
                                                        NOVECOLOGY ne sera pas payer sans le consentement
                                                        @elseif($activity->key == 'customer_call')
                                                        En cas de doute sur les réponses, le client doit nous appeler
                                                        @elseif($activity->key == 'receive_invoice')
                                                        Le client recevra sa facture par email sous 10 jours
                                                        @elseif($activity->key == 'review')
                                                        SI CLIENT SATISFAIT - Etes vous interessé par nous laisser un avis ?
                                                        @elseif($activity->key == 'carry_out')
                                                        Souhaitez vous réaliser un projet d'ITE avec NOVECOLOGY ?
                                                        @elseif($activity->key == 'action_logement')
                                                        Etes vous informé que Action Logement Non va vous contacter ?
                                                        @elseif($activity->key == 'contact_us')
                                                        Savez vous que MaPrimeRenov va vous contacter ?
                                                        @elseif($activity->key == 'contact_soon')
                                                        Savez vous que l'organisme qui a financé votre installation va vous contacter prochainement ?
                                                        @elseif($activity->key == 'release_fund')
                                                        Est ce que vous validez le déblocage des fonds ?
                                                        @elseif($activity->key == 'observations')
                                                        observations generales 
                                                        @elseif($activity->key == 'campaign_type')
                                                        Type De Campagne
                                                        @elseif($activity->key == 'request_date')
                                                        Date Demande
                                                        @elseif($activity->key == 'award_date')
                                                        Date D’attribution Commercial
                                                        @elseif($activity->key == 'first_last_name')
                                                        Nom Et Prénom
                                                        @elseif($activity->key == 'p_code')
                                                        Code Postal
                                                        @elseif($activity->key == 'telephone')
                                                        Téléphone
                                                        @elseif($activity->key == 'h_mode')
                                                        Mode De Chauffage
                                                        @elseif($activity->key == 'email_address')
                                                        Email
                                                        @elseif($activity->key == 'owner')
                                                        Propriétaire
                                                        @elseif($activity->key == 'over_then_15')
                                                        Votre maison a-t-elle plus de 15 ans ? 
                                                        @elseif($activity->key == 'precariousness')
                                                        Eligibilite MaPrimeRenov 
                                                        @elseif($activity->key == 'family_person')
                                                        Nmbre De Personne
                                                        @elseif($activity->key == 'fiscal_amount')
                                                        Revenue Fiscale De Reference
                                                        @elseif($activity->key == 'house_over_15_years')
                                                        Age Du Batiment 
                                                        @elseif($activity->key == 'compte_observations')
                                                        Observations
                                                        @elseif($activity->key == 'password_email')
                                                        Compte email Mots De Passe
                                                        @elseif($activity->key == 'email_email')
                                                        Compte email
                                                        @elseif($activity->key == 'password_mpr')
                                                        Compte MPR Mots De Passe
                                                        @elseif($activity->key == 'email_mpr')
                                                        Compte MPR Email
                                                        @elseif($activity->key == 'date_mise')
                                                        Date Mise À Jour
                                                        @elseif($activity->key == 'banque_montant')
                                                        Montant
                                                        @elseif($activity->key == 'date_depot')
                                                        Date de dépôt
                                                        @elseif($activity->key == 'banque_numero_de_dossier')
                                                        Numero de dossier
                                                        @elseif($activity->key == 'banque_status')
                                                        Statut
                                                        @elseif($activity->key == 'manque_document')
                                                        Manque document – Detail
                                                        @elseif($activity->key == 'montant_credit')
                                                        On affiche Montant du crédit accepté
                                                        @elseif($activity->key == 'banque_notification_date')
                                                        Date de notification d’accord
                                                        @elseif($activity->key == 'audit_type')
                                                        Audit réalisé
                                                        @elseif($activity->key == 'study_office')
                                                        Bureau etude
                                                        @elseif($activity->key == 'audit_user')
                                                        Audit realise par
                                                        @elseif($activity->key == 'release_date')
                                                        Audit realise le
                                                        @elseif($activity->key == 'audit_status')
                                                        Statut audit
                                                        @elseif($activity->key == 'report_status')
                                                        Statut rapport audit
                                                        @elseif($activity->key == 'report_reference')
                                                        Référence du rapport
                                                        @elseif($activity->key == 'report_result')
                                                        Resultat du rapport
                                                        @elseif($activity->key == 'study_date')
                                                        Date Etude
                                                        @elseif($activity->key == 'hour')
                                                        Horaire
                                                        @elseif($activity->key == 'status_planning_study')
                                                        Statut Planning Etude
                                                        @elseif($activity->key == 'technician_study')
                                                        Technicien Etude
                                                        @elseif($activity->key == 'technique_referee')
                                                        Réfèrent technique
                                                        @elseif($activity->key == 'status_feasibility_study')
                                                        Statut Faisabilité Etude
                                                        @elseif($activity->key == 'status_document_study')
                                                        Statut document etude
                                                        @elseif($activity->key == 'if_complete')
                                                        si incomplet
                                                        @elseif($activity->key == 'contract_status')
                                                        Statut contrat
                                                        @elseif($activity->key == 'travaux_list')
                                                        Travaux 1
                                                        @elseif($activity->key == 'additional_travaux')
                                                        Travaux supplémentaire
                                                        @elseif($activity->key == 'estimate_amount_ttc')
                                                        Montant TTC du devis / Bon de Commande
                                                        @elseif($activity->key == 'reflection_reason')
                                                        Réflexion Raison
                                                        @elseif($activity->key == 'dead_reason')
                                                        Mort Raison
                                                        @elseif($activity->key == 'date_de_previsite')
                                                        Date de previsite
                                                        @elseif($activity->key == 'status_planning_previsite')
                                                        Statut Planning previsite
                                                        @elseif($activity->key == 'technician_previsite')
                                                        Technicien previsite
                                                        @elseif($activity->key == 'technique_referee')
                                                        Réfèrent technique
                                                        @elseif($activity->key == 'status_previsite')
                                                        Statut Prévisite
                                                        @elseif($activity->key == 'status_feasibility_previsite')
                                                        Statut Faisabilité Prévisite
                                                        @elseif($activity->key == 'status_document_previsite')
                                                        Statut document prévisite
                                                        @elseif($activity->key == 'paid_by_estimate')
                                                        Reste à charge devis
                                                        @elseif($activity->key == 'paid_by_customer')
                                                        Reste à charge client
                                                        @elseif($activity->key == 'over_sale')
                                                        Survente
                                                        @elseif($activity->key == 'amount_over_selling')
                                                        Montant survente
                                                        @elseif($activity->key == 'reflection_reason')
                                                        Réflexion Raison 
                                                        @elseif($activity->key == 'counter_visit_technique_date')
                                                        Date de Contre Visite Technique
                                                        @elseif($activity->key == 'status_planning_counter_visit')
                                                        Statut Planning Contre Visite
                                                        @elseif($activity->key == 'technician_counter_visit')
                                                        Technicien Contre visite
                                                        @elseif($activity->key == 'status_counter_visit')
                                                        Statut Contre visite
                                                        @elseif($activity->key == 'status_feasibility_counter_visit')
                                                        Statut Faisabilité contre visite
                                                        @elseif($activity->key == 'installation_date')
                                                        Date Installation 
                                                        @elseif($activity->key == 'technician_installation')
                                                        Technicien
                                                        @elseif($activity->key == 'team_leader_installation')
                                                        Chef d’equipe
                                                        @elseif($activity->key == 'status_planning_installation')
                                                        Statut Planning Installation
                                                        @elseif($activity->key == 'installation_file')
                                                        Dossier Installation
                                                        @elseif($activity->key == 'travaux_release_installation')
                                                        Travaux réalisés
                                                        @elseif($activity->key == 'reception_photo')
                                                        Réception photo
                                                        @elseif($activity->key == 'reception_file')
                                                        Réception dossier
                                                        @elseif($activity->key == 'sav_date')
                                                        Date de SAV
                                                        @elseif($activity->key == 'stutus_planning_sav')
                                                        Statut Planning SAV
                                                        @elseif($activity->key == 'technician_sav')
                                                        Technicien SAV
                                                        @elseif($activity->key == 'status_resolution_sav')
                                                        Statut Resolution SAV
                                                        @elseif($activity->key == 'status_planning_deplacement')
                                                        Statut Planning Deplacement
                                                        @elseif($activity->key == 'controle_office')
                                                        Bureau de contrôle 
                                                        @elseif($activity->key == 'control_date')
                                                        Date de contrôle 
                                                        @elseif($activity->key == 'inspection_status')
                                                        Statut du contrôle COFRAC 
                                                        @elseif($activity->key == 'controlled_workd')
                                                        Travaux contrôlé 
                                                        @elseif($activity->key == 'compliance')
                                                        Conformité du chantier 
                                                        @elseif($activity->key == 'm2_controlled')
                                                        M2 controlé 
                                                        @elseif($activity->key == 'm2_achieved')
                                                        M2 réalisé 
                                                        @elseif($activity->key == 'difference_m2')
                                                        Ecart m2 
                                                        @elseif($activity->key == 'company_commissioned')
                                                        Société mise en service 
                                                        @elseif($activity->key == 'date_of_commissioning')
                                                        Date de mise en service 
                                                        @elseif($activity->key == 'technician')
                                                        Technicien de mise en service 
                                                        @elseif($activity->key == 'commissioning_status')
                                                        Statut du mise en service 
                                                        @elseif($activity->key == 'audit_report')
                                                        Compte rendu Audit 
                                                        @elseif($activity->key == 'compliance_resolved')
                                                        Mise en conformité A régler en urgence (pb sécurité ou fonctionnelle) 
                                                        @elseif($activity->key == 'compliance_resolved_reason')
                                                        Raisons 
                                                        @elseif($activity->key == 'compliance_sattled')
                                                        Mise en conformité : A régler rapidement pour finaliser le chantier 
                                                        @elseif($activity->key == 'audit_facture')
                                                        Audit Facture 
                                                        @elseif($activity->key == 'compliance_sattled_reason')
                                                        Raisons 
                                                        @elseif($activity->key == 'invoice_number' && $activity->block_name == 'Suivi Facturation')
                                                        Numero de facture
                                                        @elseif($activity->key == 'invoice_number')
                                                        Numero facture societe mes 
                                                        @elseif($activity->key == 'status_facture')
                                                        Statut facture societe mes 
                                                        @elseif($activity->key == 'mes_price')
                                                        Prix mes 
                                                        @elseif($activity->key == 'observation_company')
                                                        Observations societe mes 
                                                        @elseif($activity->key == 'controle_office_csp')
                                                        Bureau de contrôle CSP MPR 
                                                        @elseif($activity->key == 'control_date_csp')
                                                        Date de contrôle CSP MPR 
                                                        @elseif($activity->key == 'csp_status')
                                                        Statut contrôle CSP MPR 
                                                        @elseif($activity->key == 'transit_slip')
                                                        Réception du bordereau de passage 
                                                        @elseif($activity->key == 'observation_control')
                                                        Observation du contrôle  
                                                        @elseif($activity->key == 'observation')
                                                        Observation 
                                                        @elseif($activity->key == 'customer_payment')
                                                        Reglement Client 
                                                        @elseif($activity->key == 'status_invoice_customer_payment')
                                                        Statut FACTURATION REGLEMENT CLIENT 
                                                        @elseif($activity->key == 'invoice_customer_amount')
                                                        Statut FACTURATION REGLEMENT CLIENT Montant 
                                                        @elseif($activity->key == 'invoice_customer_forme')
                                                        Statut FACTURATION REGLEMENT CLIENT Forme 
                                                        @elseif($activity->key == 'invoice_customer_mode')
                                                        Statut FACTURATION REGLEMENT CLIENT Mode 
                                                        @elseif($activity->key == 'invoice_customer_nubmer_of_month')
                                                        nombre de mensualité 
                                                        @elseif($activity->key == 'invoice_customer_date1')
                                                        Règlement 1 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount21')
                                                        Règlement 1 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status1')
                                                        Règlement 1 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode21')
                                                        Règlement 1 mode
                                                        @elseif($activity->key == 'invoice_customer_date2')
                                                        Règlement 2 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount22')
                                                        Règlement 2 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status2')
                                                        Règlement 2 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode22')
                                                        Règlement 2 mode
                                                        @elseif($activity->key == 'invoice_customer_date3')
                                                        Règlement 3 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount23')
                                                        Règlement 3 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status3')
                                                        Règlement 3 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode23')
                                                        Règlement 3 mode
                                                        @elseif($activity->key == 'invoice_customer_date4')
                                                        Règlement 4 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount24')
                                                        Règlement 4 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status4')
                                                        Règlement 4 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode24')
                                                        Règlement 4 mode
                                                        @elseif($activity->key == 'invoice_customer_date5')
                                                        Règlement 5 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount25')
                                                        Règlement 5 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status5')
                                                        Règlement 5 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode25')
                                                        Règlement 5 mode
                                                        @elseif($activity->key == 'invoice_customer_date6')
                                                        Règlement 6 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount26')
                                                        Règlement 6 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status6')
                                                        Règlement 6 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode26')
                                                        Règlement 6 mode
                                                        @elseif($activity->key == 'invoice_customer_date7')
                                                        Règlement 7 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount27')
                                                        Règlement 7 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status7')
                                                        Règlement 7 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode27')
                                                        Règlement 7 mode
                                                        @elseif($activity->key == 'invoice_customer_date8')
                                                        Règlement 8 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount28')
                                                        Règlement 8 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status8')
                                                        Règlement 8 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode28')
                                                        Règlement 8 mode
                                                        @elseif($activity->key == 'invoice_customer_date9')
                                                        Règlement 9 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount29')
                                                        Règlement 9 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status9')
                                                        Règlement 9 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode29')
                                                        Règlement 9 mode
                                                        @elseif($activity->key == 'invoice_customer_date10')
                                                        Règlement 10 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount210')
                                                        Règlement 10 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status10')
                                                        Règlement 10 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode210')
                                                        Règlement 10 mode
                                                        @elseif($activity->key == 'invoice_customer_date11')
                                                        Règlement 11 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount211')
                                                        Règlement 11 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status11')
                                                        Règlement 11 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode211')
                                                        Règlement 11 mode
                                                        @elseif($activity->key == 'invoice_customer_date12')
                                                        Règlement 12 Date 
                                                        @elseif($activity->key == 'invoice_customer_amount212')
                                                        Règlement 12 Montant  
                                                        @elseif($activity->key == 'invoice_customer_status12')
                                                        Règlement 12 Statut
                                                        @elseif($activity->key == 'invoice_customer_mode212')
                                                        Règlement 12 mode
                                                        @elseif($activity->key == 'regulation_cee')
                                                        Reglement CEE 
                                                        @elseif($activity->key == 'invoice_status_cee')
                                                        Statut Facturation CEE 
                                                        @elseif($activity->key == 'delegataire')
                                                        Delegataire 
                                                        @elseif($activity->key == 'cumac')
                                                        CUMAC 
                                                        @elseif($activity->key == 'amount_cee_bonus')
                                                        Montant prime C.E.E bénéficiaire 
                                                        @elseif($activity->key == 'amount_cee_noveco')
                                                        Montant prime C.E.E Novecology 
                                                        @elseif($activity->key == 'business_support_amount')
                                                        Montant Apporteur d’affaires Novecology 
                                                        @elseif($activity->key == 'regulation_lot')
                                                        LOT 
                                                        @elseif($activity->key == 'date_depot_polluter')
                                                        Date Depot Pollueur 
                                                        @elseif($activity->key == 'invoice_number_noveco')
                                                        Numero Facture Novecology 
                                                        @elseif($activity->key == 'regulation_maprimerenonv')
                                                        Reglement MAPRIMERENONV 
                                                        @elseif($activity->key == 'invoice_status_mpr')
                                                        Statut Facturation MPR 
                                                        @elseif($activity->key == 'invoice_amount_mpr')
                                                        Montant Facturation MPR 
                                                        @elseif($activity->key == 'manager')
                                                        Mandataire 
                                                        @elseif($activity->key == 'construction_company')
                                                        Entreprise de travaux 
                                                        @elseif($activity->key == 'invoice_date_deposit_mpr')
                                                        Date depot facturation MPR 
                                                        @elseif($activity->key == 'regulation_action_logement')
                                                        Reglement Action Logement 
                                                        @elseif($activity->key == 'regulation_banque')
                                                        Reglement Banque 
                                                        @elseif($activity->key == 'invoice_status_banque')
                                                        Statut Facturation Banque 
                                                        @elseif($activity->key == 'section_banque')
                                                        Banque 
                                                        @elseif($activity->key == 'agency_file')
                                                        N* Dossier organisme 
                                                        @elseif($activity->key == 'invoice_banque_amount')
                                                        Montant facturation banque 
                                                        @elseif($activity->key == 'date_contract_sent')
                                                        Date envoi contrat 
                                                        @elseif($activity->key == 'tracking_number')
                                                        Numero suivi envoi contrat 
                                                        @elseif($activity->key == 'date_of_application')
                                                        Date demande de financement 
                                                        @elseif($activity->key == 'pay_the')
                                                        Paye le 
                                                        @elseif($activity->key == 'material_invoice')
                                                        Ajouter facture matériel 
                                                        @elseif($activity->key == 'material_invoice_status')
                                                        Statut facture matériel 
                                                        @elseif($activity->key == 'material_invoice_supplier')
                                                        Fournisseur 
                                                        @elseif($activity->key == 'equipment_list')
                                                        Liste matériel 
                                                        @elseif($activity->key == 'material_invoice_number')
                                                        Numéro de facture 
                                                        @elseif($activity->key == 'material_invoice_date')
                                                        Date de facture 
                                                        @elseif($activity->key == 'material_invoice_paid_date')
                                                        Payé le 
                                                        @elseif($activity->key == 'material_invoice_amount_ht')
                                                        Montant HT 
                                                        @elseif($activity->key == 'material_invoice_amount_ttc')
                                                        Montant TTC 
                                                        @elseif($activity->key == 'material_invoice_amount_tva')
                                                        Montant TVA 
                                                        @elseif($activity->key == 'material_invoice_observation')
                                                        Observation 
                                                        @elseif($activity->key == 'installer_invoice')
                                                        Ajouter facture installateur 
                                                        @elseif($activity->key == 'installer_invoice_status')
                                                        Statut facture Installateur 
                                                        @elseif($activity->key == 'installer_invoice_installer')
                                                        Installateur 
                                                        @elseif($activity->key == 'installer_invoice_number')
                                                        Numéro de facture 
                                                        @elseif($activity->key == 'installer_invoice_paid_date')
                                                        Payé le 
                                                        @elseif($activity->key == 'installer_invoice_observation')
                                                        Observation
                                                        @elseif($activity->key == 'installer_invoice_amount_ht')
                                                        Montant HT 
                                                        @elseif($activity->key == 'installer_invoice_amount_ttc')
                                                        Montant TTC 
                                                        @elseif($activity->key == 'installer_invoice_amount_tva')
                                                        Montant TVA 
                                                        @elseif($activity->key == 'commercial_invoice')
                                                        Ajouter facture commercial 
                                                        @elseif($activity->key == 'commercial_invoice_status')
                                                        Statut facture commercial 
                                                        @elseif($activity->key == 'commercial_invoice_commercial')
                                                        Commercial 
                                                        @elseif($activity->key == 'commercial_invoice_number')
                                                        Numéro de facture 
                                                        @elseif($activity->key == 'commercial_invoice_paid_date')
                                                        Payé le 
                                                        @elseif($activity->key == 'commercial_invoice_amount_ht')
                                                        Montant HT 
                                                        @elseif($activity->key == 'commercial_invoice_comment')
                                                        Commentaires 
                                                        @elseif($activity->key == 'provider_invoice')
                                                        Ajouter facture previsiteur 
                                                        @elseif($activity->key == 'provider_invoice_status')
                                                        Statut facture previsiteur 
                                                        @elseif($activity->key == 'provider_invoice_preview')
                                                        Previsiteur 
                                                        @elseif($activity->key == 'provider_invoice_number')
                                                        Numéro de facture 
                                                        @elseif($activity->key == 'provider_invoice_paid_date')
                                                        Payé le 
                                                        @elseif($activity->key == 'provider_invoice_comment')
                                                        Commentaires 
                                                        @elseif($activity->key == 'other_invoice_1')
                                                        Ajouter facture Autre dépense 1 
                                                        @elseif($activity->key == 'other_invoice_1_designation')
                                                        Désignation 
                                                        @elseif($activity->key == 'other_invoice_1_other_status')
                                                        Statut AUTRE 1 
                                                        @elseif($activity->key == 'other_invoice_1_number')
                                                        Numéro de facture 
                                                        @elseif($activity->key == 'other_invoice_1_paid_date')
                                                        Payé le 
                                                        @elseif($activity->key == 'other_invoice_1_amount_ht')
                                                        Montant HT 
                                                        @elseif($activity->key == 'other_invoice_1_comment')
                                                        Commentaires 
                                                        @elseif($activity->key == 'other_invoice_2')
                                                        Ajouter facture Autre dépense 2 
                                                        @elseif($activity->key == 'other_invoice_2_designation')
                                                        Désignation 
                                                        @elseif($activity->key == 'other_invoice_2_other_status')
                                                        Statut AUTRE 1 
                                                        @elseif($activity->key == 'other_invoice_2_number')
                                                        Numéro de facture 
                                                        @elseif($activity->key == 'other_invoice_2_paid_date')
                                                        Payé le 
                                                        @elseif($activity->key == 'other_invoice_2_amount_ht')
                                                        Montant HT 
                                                        @elseif($activity->key == 'other_invoice_2_comment')
                                                        Commentaires 
                                                        @elseif($activity->key == 'other_invoice_3')
                                                        Ajouter facture Autre dépense 3 
                                                        @elseif($activity->key == 'other_invoice_3_designation')
                                                        Désignation 
                                                        @elseif($activity->key == 'other_invoice_3_other_status')
                                                        Statut AUTRE 1 
                                                        @elseif($activity->key == 'other_invoice_3_number')
                                                        Numéro de facture 
                                                        @elseif($activity->key == 'other_invoice_3_paid_date')
                                                        Payé le 
                                                        @elseif($activity->key == 'other_invoice_3_amount_ht')
                                                        Montant HT 
                                                        @elseif($activity->key == 'other_invoice_3_comment')
                                                        Commentaires  
                                                        @else
                                                        {{ str_replace('_', ' ', $activity->key) }}
                                                    @endif --}}
                                                    </strong>
                                                    
                                                    à 
                                                    <strong>
                                                        @if ($activity->value === '0')
                                                        non marqué 
                                                        @elseif ($activity->value === 'no' || $activity->value === 'No')
                                                            Non
                                                        @elseif ($activity->value === 'yes' || $activity->value === 'Yes')
                                                            Oui
                                                        @else
                                                            @if ($activity->key == 'tag' && $activity->block_name == 'Travaux')
                                                                {{ $activity->tag->name ?? '' }}
                                                            @elseif ($activity->key == 'technician_installation')
                                                                {{ \App\Models\user::find($activity->value)->name ?? '' }}
                                                            @elseif ($activity->key == 'audit_user' && $activity->block_name == 'Audit')
                                                                {{ \App\Models\user::find($activity->value)->name ?? '' }}
                                                            @elseif ($activity->key == 'travaux' && $activity->block_name == 'Travaux')
                                                                {{ $activity->travaux->travaux ?? '' }}
                                                            @elseif ($activity->key == 'bareme' && $activity->block_name == 'Travaux')
                                                                {{ $activity->barames->wording ?? '' }}
                                                            @elseif ($activity->key == 'Produits' && $activity->block_name == 'Travaux')
                                                                @foreach (explode(',', $activity->value) as $key => $item)
                                                                        {{ \App\Models\CRM\Product::find($item)->reference ?? '' }}{{ $loop->last ? '':', ' }}
                                                                @endforeach
                                                            @elseif ($activity->key == 'Techniciens' && $activity->block_name == 'Intervention PREV')
                                                                @foreach (explode(',', $activity->value) as $key => $item)
                                                                        {{ \App\Models\user::find($item)->name ?? '' }}{{ $loop->last ? '':', ' }}
                                                                @endforeach
                                                            @elseif ($activity->key == 'project_equipe_user' && $activity->block_name == 'Intervention INST')
                                                                @foreach (explode(',', $activity->value) as $key => $item)
                                                                        {{ \App\Models\user::find($item)->name ?? '' }}{{ $loop->last ? '':', ' }}
                                                                @endforeach
                                                            @elseif ($activity->key == 'rapport__list')
                                                                @foreach (explode(',', $activity->value) as $key => $item)
                                                                    @if ($item == 'list_item_1')
                                                                        Plancher chauffant - 2 circuits
                                                                    @elseif ($item == 'list_item_2')
                                                                        Plancher chauffant - 1 circuit
                                                                    @elseif ($item == 'list_item_3')
                                                                    Creation conduit double paroi
                                                                    @elseif ($item == 'list_item_4')
                                                                    Rehausse conduit
                                                                    @elseif ($item == 'list_item_5')
                                                                    Creation arrivé d eau
                                                                    @elseif ($item == 'list_item_6')
                                                                    Creation forfait electricité
                                                                    @endif        
                                                                    {{ $loop->last ? '':', ' }}
                                                                @endforeach
                                                            @elseif ($activity->key == 'Age_du_bâtiment')
                                                                {{ $activity->value == 'Oui' ? 'Plus de 15 ans' : ($activity->value == 'Non' ? 'plus de 2 ans et moins de 15 ans' : $activity->value) }}
                                                            @elseif (($activity->key == 'supplier' || $activity->key == '__tracking__Fournisseur_de_lead') && $activity->block_name == 'Suivi des prospects (formulaire et réponse)')
                                                                {{ \App\Models\CRM\Fournisseur::find($activity->value)->suplier ?? '' }}
                                                            @else
                                                                {{ $activity->value }}
                                                            @endif
                                                        @endif
                                                    </strong>
                                                    
                                                        dans la {{ $activity->block_name }}  Sous cartouche de {{ $activity->tab_name }} Cartouche @if ($activity->feature_type == 'lead')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom : 'Inconnue' }}: Prospect</span>
                                                    @elseif ($activity->feature_type == 'project')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom : 'Inconnue' }}: Chantier</span>
                                                    @elseif ($activity->feature_type == 'client')
                                                        <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getClientName ? $activity->getClientName->Prenom.' '.$activity->getClientName->Nom : 'Inconnue' }}: Client</span>
                                                    @endif</p>
                                                @endif
                                                {{-- <small><script> document.write(moment("{{ $activity->created_at }}").tz(moment.tz.guess()).format('DD-MM-YYYY hh:mm a')) </script></small>  --}}
                                                <small>{{ \Carbon\Carbon::parse($activity->created_at)->format('d-m-Y, h:i a') }}</small>
                                            </div>
                                        </div> 
                                    </td> 
                                    {{-- <td>
                                        <textarea name="commentTextarea" data-log-id="{{ $activity->id }}" placeholder="{{ __('To write a comment') }}" class="database-table__textarea log_comment">{{ $activity->comment }}</textarea>
                                    </td> --}}
                                    <td>
                                        <div class="d-flex align-items-center justify-content-around">
                                            <div class="dropdown dropdown--custom p-0 d-inline-block">
                                                <button type="button" class="actions-btn bg-transparent border-0 dropdown-toggle" id="customSelectDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="novecologie-icon-dots-horizontal-triple"></span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                    @if (role() == 's_admin')
                                                        <form action="{{ route('log.delete') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $activity->id }}">
                                                            <button type="submit" class="dropdown-item border-0">
                                                                <span class="novecologie-icon-trash mr-1"></span>
                                                                {{ __('Remove') }}
                                                            </button> 
                                                        </form> 
                                                    @else
                                                        <button type="button" class="dropdown-item border-0" data-toggle="tooltip" data-placement="top" title="Seulement Admin">
                                                            <span class="novecologie-icon-lock py-1"></span>
                                                            {{ __('Remove') }}
                                                        </button>  
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                            @endforeach 
                        </tbody>
                    </table>
                </div> 
            </div>
            <div class="tab-pane fade" id="pills-Statuts-tab" role="tabpanel" aria-labelledby="pills-tab-activities">
                <div class="table-responsive database-table-wrapper--custom simple-bar">
                    <table class="table database-table w-100 mb-0" id="dataTables">
                        {{-- <thead class="database-table__header">
                            <tr>
                                <th class="text-left">
                                    {{ __('Détails') }}
                                </th> 
                                <th>
                                {{ __('Action') }}
                                </th>
                            </tr>
                        </thead> --}}
                        <tbody class="database-table__body"id="status_change_activity_log_wrap">
                            @foreach ($change_etiquette_activities as $activity)
                                <tr> 
                                    <td style="white-space: inherit;">  
                                        <div class="d-sm-flex align-items-center">
                                            <a href="#!" class="avatar-group__image-wrapper d-inline-block flex-shrink-0 rounded-circle overflow-hidden mr-2 mb-2 mb-sm-0" style="width: 45px; height: 45px;" data-toggle="tooltip" data-placement="top" title="{{ getAssigneePhoto($activity->user_id)->name }}">
                                                @if($activity->getUser->profile_photo)  
                                                <img  loading="lazy"  src="{{ asset('uploads/crm/profiles') }}/{{ $activity->getUser->profile_photo }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                                                @else
                                                <img  loading="lazy"  src="{{ asset('crm_assets/assets/images/icons/user.png') }}" alt="avatar image" class="avatar-group__image w-100 h-100"> 
                                                @endif
                                            </a> 
                                            <div class="row w-100">
                                                <div class="col-md-4">
                                                    <p class="mb-1"> 
                                                        @if ($activity->key == 'etiquette') 
                                                            {{ $activity->getUser->name }} change l'étiquette de  
                                                            @else 
                                                            {{ $activity->getUser->name }} change statut de    
                                                        @endif
                                                    </p> 
                                                    <small>{{ \Carbon\Carbon::parse($activity->created_at)->format('d-m-Y, h:i a') }}</small> 
                                                </div>
                                                <div class="col-md-auto mt-3 mt-md-0">
                                                    @if ($activity->feature_type == 'lead')
                                                        @if ($activity->key == 'etiquette')
                                                            <div class="arrow-btn-group">
                                                                <button type="button" class="arrow-btn" style="color: {{ $activity->leadPrevStatus->background_color }}">
                                                                    <span class="arrow-btn__text">{{ $activity->leadPrevStatus->status }}</span> 
                                                                </button>
                                                                &nbsp;&nbsp;&nbsp; a &nbsp;
                                                                <button type="button" class="arrow-btn" style="color: {{ $activity->leadStatus->background_color }}">
                                                                    <span class="arrow-btn__text">{{ $activity->leadStatus->status }}</span> 
                                                                </button>
                                                                @if ($activity->label_id == 5)
                                                                    <button class="ml-3 primary-btn primary-btn--pink primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0"> Raison : {{ $activity->dead_reason }} </button>
                                                                @endif
                                                            </div>
                                                        @else   
                                                            <button data-toggle="modal" style="background-color:{{ $activity->leadPrevSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->leadPrevSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                                                {{ $activity->leadPrevSubStatus->name ?? 'Nouvelle demande' }}
                                                            </button> 
                                                            &nbsp; a &nbsp;
                                                            <button data-toggle="modal" style="background-color:{{ $activity->leadSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->leadSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                                                {{ $activity->leadSubStatus->name ?? 'supprimé' }} 
                                                            </button> 
                                                        @endif
                                                    @else
                                                        @if ($activity->key == 'etiquette')
                                                            <div class="arrow-btn-group">
                                                                <button type="button" class="arrow-btn" style="color: {{ $activity->projectPrevStatus->background_color }}">
                                                                    <span class="arrow-btn__text">{{ $activity->projectPrevStatus->status }}</span> 
                                                                </button>
                                                                &nbsp;&nbsp;&nbsp; a &nbsp;
                                                                <button type="button" class="arrow-btn" style="color: {{ $activity->projectStatus->background_color }}">
                                                                    <span class="arrow-btn__text">{{ $activity->projectStatus->status }}</span> 
                                                                </button>
                                                                @if ($activity->label_id == 7)
                                                                    <button class="ml-3 primary-btn primary-btn--pink primary-btn--sm rounded d-inline-flex align-items-center justify-content-center border-0"> Raison : {{ $activity->dead_reason }} </button>
                                                                @endif
                                                            </div>
                                                        @else   
                                                            <button data-toggle="modal" style="background-color:{{ $activity->projectPrevSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->projectPrevSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                                                {{ $activity->projectPrevSubStatus->name ?? 'Nouvelle demande' }}
                                                            </button> 
                                                            &nbsp; a &nbsp;
                                                            <button data-toggle="modal" style="background-color:{{ $activity->projectSubStatus->background_color ?? '#8e27b3' }} ; color: {{ $activity->projectSubStatus->text_color ?? '#fff'  }}" data-target="#leadSubStatusChangeModal4" type="button" class=" primary-btn  primary-btn--sm rounded-pill d-inline-flex align-items-center justify-content-center border-0">
                                                                {{ $activity->projectSubStatus->name ?? 'supprimé' }} 
                                                            </button> 
                                                        @endif 
                                                    @endif
                                                </div> 
                                                <div class="col-md-auto mt-3 mt-md-0 d-flex align-items-center">
                                                    @if ($activity->feature_type == 'lead')
                                                    <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getLeadName ? $activity->getLeadName->Prenom.' '.$activity->getLeadName->Nom  : 'Inconnue'}}: Prospect</span>
                                                    @else
                                                    <span class="ml-3 btn btn-sm" style="border:1px solid #5a616a; background-color: #FFD966">{{ $activity->getProjectName ? $activity->getProjectName->Prenom.' '.$activity->getProjectName->Nom  : 'Inconnue' }}: Chantier</span> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div> 
                                    </td> 
                                </tr> 
                            @endforeach 
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>     
    </div> 
</section>

@endsection

@push('plugins-script')
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

@push('js') 

<script>
	$(document).ready(function () {
		window.Echo.channel('activity-log').listen('PannelLog', (e) => {
            let log_id = e.message; 
            $.ajax({
                type : "post",
                url  : "{{ route('admin.pannel.log') }}",
                data : {log_id},
                success : response => { 
                    if(response.status == 'default'){
                        $('#default_activity_log_wrap').prepend(response.default)
                    }else{
                        $('#status_change_activity_log_wrap').prepend(response.status_change)
                    }
                }
            });
        }); 
	});
</script>
@endpush