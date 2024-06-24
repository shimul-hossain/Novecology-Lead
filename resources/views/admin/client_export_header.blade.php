<div class="row">
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#collapseLeadTracking" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    {{ __('Lead Tracking (Form and response)') }}
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="collapseLeadTracking">
                <div class="card-body pt-0">
                    @foreach ($headers as $header)
                        @if ($header->header == '__tracking__Fournisseur_de_lead'
                            || $header->header == '__tracking__Type_de_campagne'
                            || $header->header == '__tracking__Nom_campagne'
                            || $header->header == '__tracking__Date_demande_lead'
                            || $header->header == '__tracking__Date_attribution_télécommercial'
                            || $header->header == '__tracking__Type_de_travaux_souhaité'
                            || $header->header == '__tracking__Nom_Prénom'
                            || $header->header == '__tracking__Code_postal'
                            || $header->header == '__tracking__Email'
                            || $header->header == '__tracking__téléphone'
                            || $header->header == '__tracking__Département'
                            || $header->header == '__tracking__Mode_de_chauffage'
                            || $header->header == '__tracking__Propriétaire'
                            || $header->header == '__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans')

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="{{ $header->header }}" id="informations_personnelles-{{ $header->id }}" name="selected_header[@if ($header->header == 'fixed_number')N° Fixe @elseif ($header->header == 'phone')N° Mobile @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')Consommation Chauffage Annuel (litres,kWh,m3) @elseif ($header->header == 'auxiliary_heating_status')Le logement possède t - il un chauffage d’appoint ? @elseif ($header->header == 'auxiliary_heating')Le logement possède t - il un chauffage d’appoint @elseif ($header->header == 'second_heating_generator_status')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'second_heating_generator')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == '__tracking__téléphone')Téléphone @elseif ($header->header == 'advance_visit') Disponibilité pour prévisite (jour /horaire) @else{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}@endif]">
                                <label class="custom-control-label" for="informations_personnelles-{{ $header->id }}">
                                    @if ($header->header == 'fixed_number')
                                        N° Fixe
                                    @elseif ($header->header == 'phone')
                                        N° Mobile
                                    @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')
                                        Consommation Chauffage Annuel (litres,kWh,m3)
                                    @elseif ($header->header == 'auxiliary_heating_status')
                                        Le logement possède t - il un chauffage d’appoint ?
                                    @elseif ($header->header == 'auxiliary_heating')
                                        Le logement possède t - il un chauffage d’appoint
                                    @elseif ($header->header == 'second_heating_generator_status')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'second_heating_generator')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == '__tracking__téléphone')
                                        Téléphone
                                    @elseif ($header->header == 'advance_visit')
                                        Disponibilité pour prévisite (jour /horaire)
                                    @else
                                        {{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
                                    @endif
                                </label>
                            </div>

                        @endif
                    @endforeach
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Audience" id="informations_personnelles-Audience" name="selected_header[Audience]">
                        <label class="custom-control-label" for="informations_personnelles-Audience">
                            Audience
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#collapseInformationsPersonnelles" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Informations personnelles
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="collapseInformationsPersonnelles">
                <div class="card-body pt-0">
                    @foreach ($headers as $header)
                        @if ($header->header == 'Titre'
                        || $header->header == 'Prenom'
                        || $header->header == 'Nom'
                        || $header->header == 'Adresse'
                        || $header->header == 'Complément_adresse'
                        || $header->header == 'Code_Postal'
                        || $header->header == 'Ville'
                        || $header->header == 'Département'
                        || $header->header == 'Email'
                        || $header->header == 'phone'
                        || $header->header == 'fixed_number'
                        || $header->header == 'Observations')

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="{{ $header->header }}" id="informations_personnelles-{{ $header->id }}" name="selected_header[@if ($header->header == 'fixed_number')N° Fixe @elseif ($header->header == 'phone')N° Mobile @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')Consommation Chauffage Annuel (litres,kWh,m3) @elseif ($header->header == 'auxiliary_heating_status')Le logement possède t - il un chauffage d’appoint ? @elseif ($header->header == 'auxiliary_heating')Le logement possède t - il un chauffage d’appoint @elseif ($header->header == 'second_heating_generator_status')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'second_heating_generator')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'advance_visit') Disponibilité pour prévisite (jour /horaire) @else{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}@endif]">
                                <label class="custom-control-label" for="informations_personnelles-{{ $header->id }}">
                                    @if ($header->header == 'fixed_number')
                                        N° Fixe
                                    @elseif ($header->header == 'phone')
                                        N° Mobile
                                    @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')
                                        Consommation Chauffage Annuel (litres,kWh,m3)
                                    @elseif ($header->header == 'auxiliary_heating_status')
                                        Le logement possède t - il un chauffage d’appoint ?
                                    @elseif ($header->header == 'auxiliary_heating')
                                        Le logement possède t - il un chauffage d’appoint
                                    @elseif ($header->header == 'second_heating_generator_status')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'second_heating_generator')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'advance_visit') 
                                        Disponibilité pour prévisite (jour /horaire)
                                    @else
                                        {{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
                                    @endif
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#collapseEligibilite" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Éligibilité
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="collapseEligibilite">
                <div class="card-body pt-0">
                    @foreach ($headers as $header)
                        @if ($header->header == 'Type_occupation'
                            || $header->header == 'Parcelle_cadastrale'
                            || $header->header == 'Revenue_Fiscale_de_Référence'
                            || $header->header == 'Nombre_de_foyer'
                            || $header->header == 'Nombre_de_personnes'
                            || $header->header == 'Age_du_bâtiment'
                            || $header->header == 'Zone'
                            || $header->header == 'precariousness')

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="{{ $header->header }}" id="informations_personnelles-{{ $header->id }}" name="selected_header[@if ($header->header == 'fixed_number')N° Fixe @elseif ($header->header == 'phone')N° Mobile @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')Consommation Chauffage Annuel (litres,kWh,m3) @elseif ($header->header == 'auxiliary_heating_status')Le logement possède t - il un chauffage d’appoint ? @elseif ($header->header == 'auxiliary_heating')Le logement possède t - il un chauffage d’appoint @elseif ($header->header == 'second_heating_generator_status')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'second_heating_generator')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'advance_visit') Disponibilité pour prévisite (jour /horaire) @elseif ($header->header == 'precariousness')Précarité @else{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}@endif]">
                                <label class="custom-control-label" for="informations_personnelles-{{ $header->id }}">
                                    @if ($header->header == 'fixed_number')
                                        N° Fixe
                                    @elseif ($header->header == 'phone')
                                        N° Mobile
                                    @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')
                                        Consommation Chauffage Annuel (litres,kWh,m3)
                                    @elseif ($header->header == 'auxiliary_heating_status')
                                        Le logement possède t - il un chauffage d’appoint ?
                                    @elseif ($header->header == 'auxiliary_heating')
                                        Le logement possède t - il un chauffage d’appoint
                                    @elseif ($header->header == 'second_heating_generator_status')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'second_heating_generator')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'precariousness')
                                        Précarité
                                    @elseif ($header->header == 'advance_visit') 
                                        Disponibilité pour prévisite (jour /horaire)
                                    @else
                                        {{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
                                    @endif
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#collapseInformationLogement" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Information logement
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="collapseInformationLogement">
                <div class="card-body pt-0">
                    @foreach ($headers as $header)
                        @if ($header->header == 'Mode_de_chauffage'
                            || $header->header == 'Date_construction_maison'
                            || $header->header == 'Surface_habitable'
                            || $header->header == 'Surface_à_chauffer'
                            || $header->header == 'Consommation_chauffage_annuel'
                            || $header->header == 'Consommation_Chauffage_Annuel_2'
                            || $header->header == 'Depuis_quand_occupez_vous_le_logement'
                            || $header->header == 'Type_du_courant_du_logement'
                            || $header->header == 'auxiliary_heating_status'
                            || $header->header == 'auxiliary_heating'
                            || $header->header == 'second_heating_generator_status'
                            || $header->header == 'second_heating_generator'
                            || $header->header == 'Quels_sont_les_différents_émetteurs_de_chaleur_du_logement'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Aluminium'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Fonte'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Acier'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Autre'
                            || $header->header == 'Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs'
                            || $header->header == 'Production_dapostropheeau_chaude_sanitaire'
                            || $header->header == 'Instantanné'
                            || $header->header == 'Accumulation'
                            || $header->header == 'Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude'
                            || $header->header == 'Précisez_le_volume_du_ballon_dapostropheeau_chaude'
                            || $header->header == 'Information_logement_observations')

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="{{ $header->header }}" id="informations_personnelles-{{ $header->id }}" name="selected_header[@if ($header->header == 'fixed_number')N° Fixe @elseif ($header->header == 'phone')N° Mobile @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')Consommation Chauffage Annuel (litres,kWh,m3) @elseif ($header->header == 'auxiliary_heating_status')Le logement possède t - il un chauffage d’appoint ? @elseif ($header->header == 'auxiliary_heating')Le logement possède t - il un chauffage d’appoint @elseif ($header->header == 'second_heating_generator_status')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'second_heating_generator')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'advance_visit') Disponibilité pour prévisite (jour /horaire) @else{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}@endif]">
                                <label class="custom-control-label" for="informations_personnelles-{{ $header->id }}">
                                    @if ($header->header == 'fixed_number')
                                        N° Fixe
                                    @elseif ($header->header == 'phone')
                                        N° Mobile
                                    @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')
                                        Consommation Chauffage Annuel (litres,kWh,m3)
                                    @elseif ($header->header == 'auxiliary_heating_status')
                                        Le logement possède t - il un chauffage d’appoint ?
                                    @elseif ($header->header == 'auxiliary_heating')
                                        Le logement possède t - il un chauffage d’appoint
                                    @elseif ($header->header == 'second_heating_generator_status')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'second_heating_generator')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'advance_visit') 
                                        Disponibilité pour prévisite (jour /horaire)
                                    @else
                                        {{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
                                    @endif
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#collapseSituationFoyer" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    {{ __('Situation foyer') }}
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="collapseSituationFoyer">
                <div class="card-body pt-0">
                    @foreach ($headers as $header)
                        @if ($header->header == 'Situation_familiale'
                            || $header->header == 'Y_a_t_il_des_enfants_dans_le_foyer_fiscale'
                            || $header->header == 'Personne_1'
                            || $header->header == 'Quel_est_le_contrat_de_travail_de_Personne_1'
                            || $header->header == 'Revenue_Personne_1'
                            || $header->header == 'Existehyphenthyphenil_un_conjoint'
                            || $header->header == 'Personne_2'
                            || $header->header == 'Quel_est_le_contrat_de_travail_de_Personne_2'
                            || $header->header == 'Revenue_Personne_2'
                            || $header->header == 'Crédit_du_foyer_mensuel'
                            || $header->header == 'Commentaires_revenue_et_crédit_du_foyer')

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" value="{{ $header->header }}" id="informations_personnelles-{{ $header->id }}" name="selected_header[@if ($header->header == 'fixed_number')N° Fixe @elseif ($header->header == 'phone')N° Mobile @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')Consommation Chauffage Annuel (litres,kWh,m3) @elseif ($header->header == 'auxiliary_heating_status')Le logement possède t - il un chauffage d’appoint ? @elseif ($header->header == 'auxiliary_heating')Le logement possède t - il un chauffage d’appoint @elseif ($header->header == 'second_heating_generator_status')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'second_heating_generator')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'advance_visit') Disponibilité pour prévisite (jour /horaire) @else{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}@endif]">
                                <label class="custom-control-label" for="informations_personnelles-{{ $header->id }}">
                                    @if ($header->header == 'fixed_number')
                                        N° Fixe
                                    @elseif ($header->header == 'phone')
                                        N° Mobile
                                    @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')
                                        Consommation Chauffage Annuel (litres,kWh,m3)
                                    @elseif ($header->header == 'auxiliary_heating_status')
                                        Le logement possède t - il un chauffage d’appoint ?
                                    @elseif ($header->header == 'auxiliary_heating')
                                        Le logement possède t - il un chauffage d’appoint
                                    @elseif ($header->header == 'second_heating_generator_status')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'second_heating_generator')
                                        La maison possède-t-elle un second générateur de chauffage
                                    @elseif ($header->header == 'advance_visit') 
                                        Disponibilité pour prévisite (jour /horaire)
                                    @else
                                        {{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}
                                    @endif
                                </label>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
