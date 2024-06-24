 
<ul class="nav nav-pills nav-pills--horizontal p-3" id="pills-tab-activities-lead" role="tablist"> 
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="pills-activities-Détails-tab-lead" data-toggle="pill" href="#pills-Détails-tab-lead" role="tab" aria-controls="pills-two" aria-selected="true">Détails</a>
    </li> 
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="pills-activities-Statuts-tab-lead" data-toggle="pill" href="#pills-Statuts-tab-lead" role="tab" aria-controls="pills-one" aria-selected="false">Statuts</a>
    </li> 
</ul>
<div class="tab-content" id="pills-tabContent-activities-lead">
    <div class="tab-pane fade show active" id="pills-Détails-tab-lead" role="tabpanel" aria-labelledby="pills-tab-activities-lead">
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
                <tbody class="database-table__body">
                    @foreach ($activities->where('status', 'default') as $activity)
                        @if (role() != 's_admin' && role() != 'adv' && role() != 'adv_copy_1693686130' && $activity->lead_reset_status == 1)
                            @continue
                        @endif
                    
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
                                        <p class="mb-1"> @if ($activity->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif 
                                            {{ $activity->getUser->name }}  <strong> @if ($activity->value == 'open')
                                                Déverrouiller
                                            @elseif ($activity->value == 'close')
                                                Serrure
                                            @else
                                                {{ $activity->value }}
                                            @endif
                                            {{ $activity->block_name }} </strong> sous cartouche sous la cartouche de <strong>{{ $activity->tab_name }}</strong>
                                        </p>
                                        @elseif ($activity->key == 'callback_setting__activity')
                                            <p class="mb-1"> @if ($activity->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif
                                                {{ $activity->getUser->name }}  <strong>Régler Rappler à {{ \Carbon\Carbon::parse($activity->value)->format('d-m-Y, h:i a') }}  </strong> 
                                            </p> 
                                        @elseif ($activity->key == 'telecommercial__change')
                                            <p class="mb-1"> @if ($activity->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif
                                                {{ $activity->getUser->name }}  Attribuer un télécommercial  à <strong> {{ $activity->assignUser->name ?? '' }}  </strong> 
                                            </p> 
                                        @elseif ($activity->key == 'lead_reset__by')
                                            <p class="mb-1"> <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}">
                                                <strong> {{ $activity->getUser->name }} à zéro le prospect  </strong> 
                                            </p> 
                                        @elseif ($activity->key == 'new_prospect__create')
                                            <p class="mb-1"> @if ($activity->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif
                                                <strong> {{ $activity->getUser->name }} a créé ce prospect</strong> 
                                            </p> 
                                        @elseif ($activity->key == 'new_prospect__import')
                                            {{-- <p class="mb-1"> @if ($activity->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif --}}
                                            <p class="mb-1">
                                                <strong> {{ $activity->getUser->name }} a importé ce prospect</strong> 
                                            </p> 
                                        @elseif ($activity->key == 'comment_pin_status__change')
                                            <p class="mb-1">
                                                {{ $activity->getUser->name }} j'ai épinglé un commentaire: <strong>"{{ $activity->value }}"</strong>
                                            </p> 
                                        @else
                                        <p class="mb-1">@if ($activity->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif {{ $activity->getUser->name }} mis à jour 
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
                                                        Merci de préciser
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
                                                    @case('invoice_number' && $activity->block_name == 'Suivi Facturation')
                                                        Numero de facture
                                                        @break
                                                    @case('invoice_number')
                                                        Numero facture societe mes 
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
                                                    @elseif ($activity->key == 'Produits' && $activity->block_name == 'Projet')
                                                        @foreach (explode(',', $activity->value) as $key => $item)
                                                                {{ \App\Models\CRM\Product::find($item)->reference ?? '' }}{{ $loop->last ? '':', ' }}
                                                        @endforeach
                                                    @elseif ($activity->key == 'Techniciens' && $activity->block_name == 'Intervention PREV')
                                                        @foreach (explode(',', $activity->value) as $key => $item)
                                                                {{ \App\Models\user::find($item)->name ?? '' }}{{ $loop->last ? '':', ' }}
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
                                            
                                            dans la {{ $activity->block_name }}  Sous cartouche de {{ $activity->tab_name }} Cartouche</p>
                                        @endif
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
                                        @if (role() == 's_admin')
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                <form action="{{ route('lead.log.delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $activity->id }}">
                                                    <button type="submit" class="dropdown-item border-0">
                                                        <span class="novecologie-icon-trash mr-1"></span>
                                                        {{ __('Remove') }}
                                                    </button> 
                                                </form> 
                                            </div>
                                        @else
                                            <div class="dropdown-menu dropdown-menu--custom bg-white border-0 w-100" aria-labelledby="customSelectDropdown">
                                                <button type="button" class="dropdown-item border-0" data-toggle="tooltip" data-placement="top" title="Seulement Admin">
                                                    <span class="novecologie-icon-lock py-1"></span>
                                                    {{ __('Remove') }}
                                                </button>  
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>  
                    @endforeach 
                </tbody>
            </table>
        </div> 
    </div>
    <div class="tab-pane fade" id="pills-Statuts-tab-lead" role="tabpanel" aria-labelledby="pills-tab-activities-lead">
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
                <tbody class="database-table__body">
                    @foreach ($activities->where('status' ,'change_etiquette') as $activity)
                        @if (role() != 's_admin' && role() != 'adv' && role() != 'adv_copy_1693686130' && $activity->lead_reset_status == 1)
                            @continue
                        @endif
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
                                    <div class="row w-100 align-items-center">
                                        <div class="col-md-4">
                                            <p class="mb-1"> @if ($activity->lead_reset_status == 1) <img  loading="lazy"  height="40" src="{{ asset('reset-logo.png') }}"> @endif
                                                @if ($activity->key == 'etiquette') 
                                                    {{ $activity->getUser->name }} change l'étiquette de  
                                                    @else 
                                                    {{ $activity->getUser->name }} change statut de    
                                                @endif
                                            </p> 
                                            <small>{{ \Carbon\Carbon::parse($activity->created_at)->format('d-m-Y, h:i a') }}</small> 
                                        </div>
                                        <div class="col-md-8 mt-3 mt-md-0">
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
        
    