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
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Fournisseur_de_lead" id="informations_personnelles-2" name="selected_header[Fournisseur de lead]">
                        <label class="custom-control-label" for="informations_personnelles-2">Fournisseur de lead</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Type_de_campagne" id="informations_personnelles-3" name="selected_header[Type de campagne]">
                        <label class="custom-control-label" for="informations_personnelles-3">Type de campagne</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Nom_campagne" id="informations_personnelles-4" name="selected_header[Nom campagne]">
                        <label class="custom-control-label" for="informations_personnelles-4">Nom campagne</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Date_demande_lead" id="informations_personnelles-5" name="selected_header[Date demande lead]">
                        <label class="custom-control-label" for="informations_personnelles-5">Date demande lead</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Date_attribution_télécommercial" id="informations_personnelles-6" name="selected_header[Date attribution télécommercial]">
                        <label class="custom-control-label" for="informations_personnelles-6">Date attribution télécommercial</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Type_de_travaux_souhaité" id="informations_personnelles-7" name="selected_header[Type de travaux souhaité]">
                        <label class="custom-control-label" for="informations_personnelles-7">Type de travaux souhaité</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Nom_Prénom" id="informations_personnelles-8" name="selected_header[Nom Prénom]">
                        <label class="custom-control-label" for="informations_personnelles-8">Nom Prénom</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Code_postal" id="informations_personnelles-9" name="selected_header[Code postal]">
                        <label class="custom-control-label" for="informations_personnelles-9">Code postal</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Email" id="informations_personnelles-10" name="selected_header[Email]">
                        <label class="custom-control-label" for="informations_personnelles-10">Email</label>
                    </div>
                   <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__téléphone" id="informations_personnelles-11" name="selected_header[Téléphone ]">
                        <label class="custom-control-label" for="informations_personnelles-11">Téléphone</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Département" id="informations_personnelles-12" name="selected_header[Département]">
                        <label class="custom-control-label" for="informations_personnelles-12">Département</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Mode_de_chauffage" id="informations_personnelles-13" name="selected_header[Mode de chauffage]">
                        <label class="custom-control-label" for="informations_personnelles-13">Mode de chauffage</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Propriétaire" id="informations_personnelles-14" name="selected_header[Propriétaire]">
                        <label class="custom-control-label" for="informations_personnelles-14">Propriétaire</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans" id="informations_personnelles-15" name="selected_header[Votre maison a-t-elle plus de 15 ans]">
                        <label class="custom-control-label" for="informations_personnelles-15">Votre maison a-t-elle plus de 15 ans</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Audience" id="informations_personnelles-Audience" name="selected_header[Audience]">
                        <label class="custom-control-label" for="informations_personnelles-Audience">
                            Audience
                        </label>
                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             </div>
                {{-- <div class="card-body">
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
                </div> --}}
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
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Titre" id="informations_personnelles-16" name="selected_header[Titre]">
                        <label class="custom-control-label" for="informations_personnelles-16">Titre</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Prenom" id="informations_personnelles-17" name="selected_header[Prenom]">
                        <label class="custom-control-label" for="informations_personnelles-17">Prenom</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Nom" id="informations_personnelles-18" name="selected_header[Nom]">
                        <label class="custom-control-label" for="informations_personnelles-18">Nom</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Adresse" id="informations_personnelles-19" name="selected_header[Adresse]">
                        <label class="custom-control-label" for="informations_personnelles-19">Adresse</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Complément_adresse" id="informations_personnelles-20" name="selected_header[Complément adresse]">
                        <label class="custom-control-label" for="informations_personnelles-20">Complément adresse</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Code_Postal" id="informations_personnelles-21" name="selected_header[Code Postal]">
                        <label class="custom-control-label" for="informations_personnelles-21">Code Postal</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Ville" id="informations_personnelles-22" name="selected_header[Ville]">
                        <label class="custom-control-label" for="informations_personnelles-22">Ville</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Département" id="informations_personnelles-23" name="selected_header[Département]">
                        <label class="custom-control-label" for="informations_personnelles-23">Département</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Email" id="informations_personnelles-24" name="selected_header[Email]">
                        <label class="custom-control-label" for="informations_personnelles-24">Email</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="phone" id="informations_personnelles-25" name="selected_header[N° Mobile ]">
                        <label class="custom-control-label" for="informations_personnelles-25">N° Mobile</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="fixed_number" id="informations_personnelles-26" name="selected_header[N° Fixe ]">
                        <label class="custom-control-label" for="informations_personnelles-26">N° Fixe</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Observations" id="informations_personnelles-27" name="selected_header[Observations]">
                        <label class="custom-control-label" for="informations_personnelles-27">Observations</label>
                    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   </div>
                {{-- <div class="card-body">
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
                </div> --}}
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
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Type_occupation" id="informations_personnelles-28" name="selected_header[Type occupation]">
                        <label class="custom-control-label" for="informations_personnelles-28">Type occupation</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Parcelle_cadastrale" id="informations_personnelles-29" name="selected_header[Parcelle cadastrale]">
                        <label class="custom-control-label" for="informations_personnelles-29">Parcelle cadastrale</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Revenue_Fiscale_de_Référence" id="informations_personnelles-30" name="selected_header[Revenue Fiscale de Référence]">
                        <label class="custom-control-label" for="informations_personnelles-30">Revenue Fiscale de Référence</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Nombre_de_foyer" id="informations_personnelles-31" name="selected_header[Nombre de foyer]">
                        <label class="custom-control-label" for="informations_personnelles-31">Nombre de foyer</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Nombre_de_personnes" id="informations_personnelles-32" name="selected_header[Nombre de personnes]">
                        <label class="custom-control-label" for="informations_personnelles-32">Nombre de personnes</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Age_du_bâtiment" id="informations_personnelles-33" name="selected_header[Age du bâtiment]">
                        <label class="custom-control-label" for="informations_personnelles-33">Age du bâtiment</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Zone" id="informations_personnelles-34" name="selected_header[Zone]">
                        <label class="custom-control-label" for="informations_personnelles-34">Zone</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="precariousness" id="informations_personnelles-35" name="selected_header[Précarité ]">
                        <label class="custom-control-label" for="informations_personnelles-35">Précarité</label>
                    </div>
                </div>
                {{-- <div class="card-body">
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
                                <input type="checkbox" class="custom-control-input" value="{{ $header->header }}" id="informations_personnelles-{{ $header->id }}" name="selected_header[@if ($header->header == 'fixed_number')N° Fixe @elseif ($header->header == 'phone')N° Mobile @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')Consommation Chauffage Annuel (litres,kWh,m3) @elseif ($header->header == 'auxiliary_heating_status')Le logement possède t - il un chauffage d’appoint ? @elseif ($header->header == 'auxiliary_heating')Le logement possède t - il un chauffage d’appoint @elseif ($header->header == 'second_heating_generator_status')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'second_heating_generator')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'precariousness')Précarité @elseif ($header->header == 'advance_visit') Disponibilité pour prévisite (jour /horaire) @else{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}@endif]">
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
                </div> --}}
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
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Mode_de_chauffage" id="informations_personnelles-36" name="selected_header[Mode de chauffage]">
                        <label class="custom-control-label" for="informations_personnelles-36">Mode de chauffage</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_construction_maison" id="informations_personnelles-37" name="selected_header[Date construction maison]">
                        <label class="custom-control-label" for="informations_personnelles-37">Date construction maison</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Surface_habitable" id="informations_personnelles-38" name="selected_header[Surface habitable]">
                        <label class="custom-control-label" for="informations_personnelles-38">Surface habitable</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Surface_à_chauffer" id="informations_personnelles-39" name="selected_header[Surface à chauffer]">
                        <label class="custom-control-label" for="informations_personnelles-39">Surface à chauffer</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Consommation_chauffage_annuel" id="informations_personnelles-40" name="selected_header[Consommation chauffage annuel]">
                        <label class="custom-control-label" for="informations_personnelles-40">Consommation chauffage annuel</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Consommation_Chauffage_Annuel_2" id="informations_personnelles-41" name="selected_header[Consommation Chauffage Annuel (litres,kWh,m3) ]">
                        <label class="custom-control-label" for="informations_personnelles-41">Consommation Chauffage Annuel (litres,kWh,m3)</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Depuis_quand_occupez_vous_le_logement" id="informations_personnelles-42" name="selected_header[Depuis quand occupez vous le logement]">
                        <label class="custom-control-label" for="informations_personnelles-42">Depuis quand occupez vous le logement</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Type_du_courant_du_logement" id="informations_personnelles-43" name="selected_header[Type du courant du logement]">
                        <label class="custom-control-label" for="informations_personnelles-43">Type du courant du logement</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="auxiliary_heating_status" id="informations_personnelles-44" name="selected_header[Le logement possède t - il un chauffage d’appoint ? ]">
                        <label class="custom-control-label" for="informations_personnelles-44">Le logement possède t - il un chauffage d’appoint ?</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="auxiliary_heating" id="informations_personnelles-45" name="selected_header[Le logement possède t - il un chauffage d’appoint ]">
                        <label class="custom-control-label" for="informations_personnelles-45">Le logement possède t - il un chauffage d’appoint</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="second_heating_generator_status" id="informations_personnelles-46" name="selected_header[La maison possède-t-elle un second générateur de chauffage ]">
                        <label class="custom-control-label" for="informations_personnelles-46">La maison possède-t-elle un second générateur de chauffage</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="second_heating_generator" id="informations_personnelles-47" name="selected_header[La maison possède-t-elle un second générateur de chauffage ]">
                        <label class="custom-control-label" for="informations_personnelles-47">La maison possède-t-elle un second générateur de chauffage</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Quels_sont_les_différents_émetteurs_de_chaleur_du_logement" id="informations_personnelles-48" name="selected_header[Quels sont les différents émetteurs hydraulique de chaleur du logement]">
                        <label class="custom-control-label" for="informations_personnelles-48">Quels sont les différents émetteurs hydraulique de chaleur du logement</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Aluminium" id="informations_personnelles-49" name="selected_header[Préciser le type de radiateurs Aluminium]">
                        <label class="custom-control-label" for="informations_personnelles-49">Préciser le type de radiateurs Aluminium</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs" id="informations_personnelles-50" name="selected_header[Préciser le type de radiateurs Aluminium Nombre de radiateurs]">
                        <label class="custom-control-label" for="informations_personnelles-50">Préciser le type de radiateurs Aluminium Nombre de radiateurs</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Fonte" id="informations_personnelles-51" name="selected_header[Préciser le type de radiateurs Fonte]">
                        <label class="custom-control-label" for="informations_personnelles-51">Préciser le type de radiateurs Fonte</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs" id="informations_personnelles-52" name="selected_header[Préciser le type de radiateurs Fonte Nombre de radiateurs]">
                        <label class="custom-control-label" for="informations_personnelles-52">Préciser le type de radiateurs Fonte Nombre de radiateurs</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Acier" id="informations_personnelles-53" name="selected_header[Préciser le type de radiateurs Acier]">
                        <label class="custom-control-label" for="informations_personnelles-53">Préciser le type de radiateurs Acier</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs" id="informations_personnelles-54" name="selected_header[Préciser le type de radiateurs Acier Nombre de radiateurs]">
                        <label class="custom-control-label" for="informations_personnelles-54">Préciser le type de radiateurs Acier Nombre de radiateurs</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Autre" id="informations_personnelles-55" name="selected_header[Préciser le type de radiateurs Autre]">
                        <label class="custom-control-label" for="informations_personnelles-55">Préciser le type de radiateurs Autre</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs" id="informations_personnelles-56" name="selected_header[Préciser le type de radiateurs Autre Nombre de radiateurs]">
                        <label class="custom-control-label" for="informations_personnelles-56">Préciser le type de radiateurs Autre Nombre de radiateurs</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Production_dapostropheeau_chaude_sanitaire" id="informations_personnelles-57" name="selected_header[Production d’eau chaude sanitaire]">
                        <label class="custom-control-label" for="informations_personnelles-57">Production d’eau chaude sanitaire</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Instantanné" id="informations_personnelles-58" name="selected_header[Instantanné]">
                        <label class="custom-control-label" for="informations_personnelles-58">Instantanné</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Accumulation" id="informations_personnelles-59" name="selected_header[Accumulation]">
                        <label class="custom-control-label" for="informations_personnelles-59">Accumulation</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude" id="informations_personnelles-60" name="selected_header[Le logement possède t- il un ballon d’eau chaude]">
                        <label class="custom-control-label" for="informations_personnelles-60">Le logement possède t- il un ballon d’eau chaude</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Précisez_le_volume_du_ballon_dapostropheeau_chaude" id="informations_personnelles-61" name="selected_header[Précisez le volume du ballon d’eau chaude]">
                        <label class="custom-control-label" for="informations_personnelles-61">Précisez le volume du ballon d’eau chaude</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Information_logement_observations" id="informations_personnelles-62" name="selected_header[Information logement observations]">
                        <label class="custom-control-label" for="informations_personnelles-62">Information logement observations</label>
                    </div>
                </div>
                {{-- <div class="card-body">
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
                </div> --}}
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
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Situation_familiale" id="informations_personnelles-63" name="selected_header[Situation familiale]">
                        <label class="custom-control-label" for="informations_personnelles-63">Situation familiale</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Y_a_t_il_des_enfants_dans_le_foyer_fiscale" id="informations_personnelles-64" name="selected_header[Y a t il des enfants dans le foyer fiscale]">
                        <label class="custom-control-label" for="informations_personnelles-64">Y a t il des enfants dans le foyer fiscale</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Personne_1" id="informations_personnelles-65" name="selected_header[Personne 1]">
                        <label class="custom-control-label" for="informations_personnelles-65">Personne 1</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Quel_est_le_contrat_de_travail_de_Personne_1" id="informations_personnelles-66" name="selected_header[Quel est le contrat de travail de Personne 1]">
                        <label class="custom-control-label" for="informations_personnelles-66">Quel est le contrat de travail de Personne 1</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Revenue_Personne_1" id="informations_personnelles-67" name="selected_header[Revenue Personne 1]">
                        <label class="custom-control-label" for="informations_personnelles-67">Revenue Personne 1</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Existehyphenthyphenil_un_conjoint" id="informations_personnelles-68" name="selected_header[Existe-t-il un conjoint]">
                        <label class="custom-control-label" for="informations_personnelles-68">Existe-t-il un conjoint</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Personne_2" id="informations_personnelles-69" name="selected_header[Personne 2]">
                        <label class="custom-control-label" for="informations_personnelles-69">Personne 2</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Quel_est_le_contrat_de_travail_de_Personne_2" id="informations_personnelles-70" name="selected_header[Quel est le contrat de travail de Personne 2]">
                        <label class="custom-control-label" for="informations_personnelles-70">Quel est le contrat de travail de Personne 2</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Revenue_Personne_2" id="informations_personnelles-71" name="selected_header[Revenue Personne 2]">
                        <label class="custom-control-label" for="informations_personnelles-71">Revenue Personne 2</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Crédit_du_foyer_mensuel" id="informations_personnelles-72" name="selected_header[Crédit du foyer mensuel]">
                        <label class="custom-control-label" for="informations_personnelles-72">Crédit du foyer mensuel</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Commentaires_revenue_et_crédit_du_foyer" id="informations_personnelles-73" name="selected_header[Commentaires revenue et crédit du foyer]">
                        <label class="custom-control-label" for="informations_personnelles-73">Commentaires revenue et crédit du foyer</label>
                    </div>
                </div>
                {{-- <div class="card-body">
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
                </div> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#collapseProjet" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Projet
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="collapseProjet">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Barème" id="projet-Barème" name="selected_header[Barème]">
                        <label class="custom-control-label" for="projet-Barème">
                            Barème
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Travaux" id="projet-Travaux" name="selected_header[Travaux]">
                        <label class="custom-control-label" for="projet-Travaux">
                            Travaux
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Type_de_contrat" id="projet-78" name="selected_header[Type de contrat]">
                        <label class="custom-control-label" for="projet-78">Type de contrat</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="MaPrimeRenov" id="projet-79" name="selected_header[MaPrimeRenov]">
                        <label class="custom-control-label" for="projet-79">MaPrimeRenov</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Subvention_MaPrimeRénov_déduit_du_devis" id="projet-80" name="selected_header[Subvention MaPrimeRénov déduit du devis]">
                        <label class="custom-control-label" for="projet-80">Subvention MaPrimeRénov déduit du devis</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov" id="projet-81" name="selected_header[Le demandeur a déjà fait une demande à MaPrimeRenov]">
                        <label class="custom-control-label" for="projet-81">Le demandeur a déjà fait une demande à MaPrimeRenov</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Action_Logement" id="projet-82" name="selected_header[Action Logement]">
                        <label class="custom-control-label" for="projet-82">Action Logement</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="CEE" id="projet-83" name="selected_header[CEE]">
                        <label class="custom-control-label" for="projet-83">CEE</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Credit" id="projet-84" name="selected_header[Credit]">
                        <label class="custom-control-label" for="projet-84">Credit</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Montant_Crédit" id="projet-85" name="selected_header[Montant Crédit]">
                        <label class="custom-control-label" for="projet-85">Montant Crédit</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Report_du_crédit" id="projet-86" name="selected_header[Report du crédit]">
                        <label class="custom-control-label" for="projet-86">Report du crédit</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Nombre_de_jours_report" id="projet-87" name="selected_header[Nombre de jours report]">
                        <label class="custom-control-label" for="projet-87">Nombre de jours report</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Reste_à_charge" id="projet-88" name="selected_header[Reste à charge]">
                        <label class="custom-control-label" for="projet-88">Reste à charge</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Reste_à_charge_Montant" id="projet-89" name="selected_header[Reste à charge Montant]">
                        <label class="custom-control-label" for="projet-89">Reste à charge Montant</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Mode_de_paiement" id="projet-90" name="selected_header[Mode de paiement]">
                        <label class="custom-control-label" for="projet-90">Mode de paiement</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Nombre_de_mensualités" id="projet-91" name="selected_header[Nombre de mensualités]">
                        <label class="custom-control-label" for="projet-91">Nombre de mensualités</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Projet_observations" id="projet-92" name="selected_header[Projet observations]">
                        <label class="custom-control-label" for="projet-92">Projet observations</label>
                    </div>
                </div>
                {{-- <div class="card-body">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Barème" id="projet-Barème" name="selected_header[Barème]">
                        <label class="custom-control-label" for="projet-Barème">
                            Barème
                        </label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Travaux" id="projet-Travaux" name="selected_header[Travaux]">
                        <label class="custom-control-label" for="projet-Travaux">
                            Travaux
                        </label>
                    </div>
                    @foreach ($headers as $header)
                    @if ($header->header == 'Type_de_contrat'
                        || $header->header == 'Statut_Projet'
                        || $header->header == 'MaPrimeRenov'
                        || $header->header == 'Subvention_MaPrimeRénov_déduit_du_devis'
                        || $header->header == 'Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov'
                        || $header->header == 'Action_Logement'
                        || $header->header == 'CEE'
                        || $header->header == 'Credit'
                        || $header->header == 'Montant_Crédit'
                        || $header->header == 'Report_du_crédit'
                        || $header->header == 'Nombre_de_jours_report'
                        || $header->header == 'Reste_à_charge'
                        || $header->header == 'Reste_à_charge_Montant'
                        || $header->header == 'Mode_de_paiement'
                        || $header->header == 'Nombre_de_mensualités'
                        || $header->header == 'Projet_observations')

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="{{ $header->header }}" id="projet-{{ $header->id }}" name="selected_header[@if ($header->header == 'fixed_number')N° Fixe @elseif ($header->header == 'phone')N° Mobile @elseif ($header->header == 'Consommation_Chauffage_Annuel_2')Consommation Chauffage Annuel (litres,kWh,m3) @elseif ($header->header == 'auxiliary_heating_status')Le logement possède t - il un chauffage d’appoint ? @elseif ($header->header == 'auxiliary_heating')Le logement possède t - il un chauffage d’appoint @elseif ($header->header == 'second_heating_generator_status')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'second_heating_generator')La maison possède-t-elle un second générateur de chauffage @elseif ($header->header == 'advance_visit') Disponibilité pour prévisite (jour /horaire) @else{{ str_replace('_',' ',str_replace('apostrophe','’',str_replace('hyphen','-',str_replace('__projet__','',str_replace('__tracking__', '', $header->header))))) }}@endif]">
                            <label class="custom-control-label" for="projet-{{ $header->id }}">
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
                </div> --}}
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#ContrôlesDesPièces" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Contrôles des pièces
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="ContrôlesDesPièces">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Pièces_manquante" id="Pièces_manquante" name="selected_header[Pièces manquante]">
                        <label class="custom-control-label" for="Pièces_manquante">Pièces manquante</label>
                    </div>
                    @foreach ($document_controls as $document)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="controle___{{ $document->id }}___le" id="Pièces_manquante-le{{ $document->id }}" name="selected_header[{{ $document->name }} Réceptionné le]">
                            <label class="custom-control-label" for="Pièces_manquante-le{{ $document->id }}">{{ $document->name }} Réceptionné le</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="controle___{{ $document->id }}___par" id="Pièces_manquante-par{{ $document->id }}" name="selected_header[{{ $document->name }} Réceptionné par]">
                            <label class="custom-control-label" for="Pièces_manquante-par{{ $document->id }}">{{ $document->name }} Réceptionné par</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#interventionsCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Interventions
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="interventionsCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="intervention_1" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_1">intervention 1</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="2" id="intervention_2" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_2">intervention 2</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="3" id="intervention_3" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_3">intervention 3</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="4" id="intervention_4" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_4">intervention 4</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="5" id="intervention_5" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_5">intervention 5</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="6" id="intervention_6" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_6">intervention 6</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="7" id="intervention_7" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_7">intervention 7</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="8" id="intervention_8" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_8">intervention 8</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="9" id="intervention_9" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_9">intervention 9</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="10" id="intervention_10" name="selected_intervention_header[]">
                        <label class="custom-control-label" for="intervention_10">intervention 10</label>
                    </div>  
                </div>
            </div>
        </div>
    </div> 
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#compteCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Compte
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="compteCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_email" id="campte-1" name="selected_header[Compte Email]">
                        <label class="custom-control-label" for="campte-1">Compte Email</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_Mots_de_passe" id="campte-2" name="selected_header[Compte Email Mots de passe]">
                        <label class="custom-control-label" for="campte-2">Compte Email Mots de passe</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_crée_le" id="campte-3" name="selected_header[Compte Email Compte crée le]">
                        <label class="custom-control-label" for="campte-3">Compte Email Compte crée le</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_crée_par" id="campte-4" name="selected_header[Compte Email Compte crée par]">
                        <label class="custom-control-label" for="campte-4">Compte Email Compte crée par</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_Email_de_récupération_email" id="campte-5" name="selected_header[Compte email de récupération Email]">
                        <label class="custom-control-label" for="campte-5">Compte email de récupération Email</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_Email_de_récupération_Mots_de_passe" id="campte-6" name="selected_header[Compte email de récupération Mots de passe]">
                        <label class="custom-control-label" for="campte-6">Compte email de récupération Mots de passe</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_Email_de_récupération_crée_le" id="campte-7" name="selected_header[Compte email de récupération Compte crée le]">
                        <label class="custom-control-label" for="campte-7">Compte email de récupération Compte crée le</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_Email_de_récupération_crée_par" id="campte-8" name="selected_header[Compte email de récupération Compte crée par]">
                        <label class="custom-control-label" for="campte-8">Compte email de récupération Compte crée par</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Téléphone_de_récupération_Téléphone" id="campte-9" name="selected_header[Téléphone de récupération]">
                        <label class="custom-control-label" for="campte-9">Téléphone de récupération</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Email_de_transfert_Email" id="campte-10" name="selected_header[Email de transfert]">
                        <label class="custom-control-label" for="campte-10">Email de transfert</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_MaPrimeRenov_email" id="campte-11" name="selected_header[Compte MaPrimeRénov Email]">
                        <label class="custom-control-label" for="campte-11">Compte MaPrimeRénov Email</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_MaPrimeRenov_Mots_de_passe" id="campte-12" name="selected_header[Compte MaPrimeRénov Mots de passe]">
                        <label class="custom-control-label" for="campte-12">Compte MaPrimeRénov Mots de passe</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_MaPrimeRenov_Compte_crée_le" id="campte-13" name="selected_header[Compte MaPrimeRénov Compte crée le]">
                        <label class="custom-control-label" for="campte-13">Compte MaPrimeRénov Compte crée le</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_MaPrimeRenov_Compte_crée_par" id="campte-14" name="selected_header[Compte MaPrimeRénov Compte crée par]">
                        <label class="custom-control-label" for="campte-14">Compte MaPrimeRénov Compte crée par</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Compte_Observations" id="campte-15" name="selected_header[Observations]">
                        <label class="custom-control-label" for="campte-15">Observations</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#myPrimeMPR" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    MyPrimeMPR
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="myPrimeMPR">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_de_dépôt_MyMPR" id="Date_de_dépôt_MyMPR" name="selected_header[Date de dépôt MyMPR]">
                        <label class="custom-control-label" for="Date_de_dépôt_MyMPR">Date de dépôt MyMPR</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="N_Dossier_MPR_hyphen_MyMPR" id="N_Dossier_MPR_hyphen_MyMPR" name="selected_header[N° Dossier MPR - MyMPR]">
                        <label class="custom-control-label" for="N_Dossier_MPR_hyphen_MyMPR">N° Dossier MPR - MyMPR</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Montant_subvention_prévisionnel_hyphen_MyMPR" id="Montant_subvention_prévisionnel_hyphen_MyMPR" name="selected_header[Montant subvention prévisionnel - MyMPR]">
                        <label class="custom-control-label" for="Montant_subvention_prévisionnel_hyphen_MyMPR">Montant subvention prévisionnel - MyMPR</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Travaux_deposés_hyphen_MyMPR" id="Travaux_deposés_hyphen_MyMPR" name="selected_header[Travaux deposés - MyMPR]">
                        <label class="custom-control-label" for="Travaux_deposés_hyphen_MyMPR">Travaux deposés - MyMPR</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Statut_1_hyphen_MyMPR" id="Statut_1_hyphen_MyMPR" name="selected_header[Statut 1 - MyMPR]">
                        <label class="custom-control-label" for="Statut_1_hyphen_MyMPR">Statut 1 - MyMPR</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Statut_2_hyphen_MyMPR" id="Statut_2_hyphen_MyMPR" name="selected_header[Statut 2 - MyMPR]">
                        <label class="custom-control-label" for="Statut_2_hyphen_MyMPR">Statut 2 - MyMPR</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Adresse_hyphen_MyMPR" id="Adresse_hyphen_MyMPR" name="selected_header[Adresse - MyMPR]">
                        <label class="custom-control-label" for="Adresse_hyphen_MyMPR">Adresse - MyMPR</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#SubventionCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Subvention
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="SubventionCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_de_dépôt" id="Date_de_dépôt" name="selected_header[Date de dépôt]">
                        <label class="custom-control-label" for="Date_de_dépôt">Date de dépôt</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Number_Dossier_Action_Logement" id="Number_Dossier_Action_Logement" name="selected_header[N° Dossier Action Logement]">
                        <label class="custom-control-label" for="Number_Dossier_Action_Logement">N° Dossier Action Logement</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Montant_subvention_prévisionnelle" id="Montant_subvention_prévisionnelle" name="selected_header[Montant subvention prévisionnelle]">
                        <label class="custom-control-label" for="Montant_subvention_prévisionnelle">Montant subvention prévisionnelle</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Travaux_déposés" id="Travaux_déposés" name="selected_header[Travaux déposés]">
                        <label class="custom-control-label" for="Travaux_déposés">Travaux déposés</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Statut_Action_logement" id="Statut_Action_logement" name="selected_header[Statut Action logement]">
                        <label class="custom-control-label" for="Statut_Action_logement">Statut Action logement</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_mise_à_jour" id="Date_mise_à_jour" name="selected_header[Date mise à jour]">
                        <label class="custom-control-label" for="Date_mise_à_jour">Date mise à jour</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="amo" id="amo" name="selected_header[AMO]">
                        <label class="custom-control-label" for="amo">AMO</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Subvention_Observations" id="Subvention_Observations" name="selected_header[Observations]">
                        <label class="custom-control-label" for="Subvention_Observations">Observations</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#banqueCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Banque
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="banqueCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="banque_id" id="Banque" name="selected_header[Banque]">
                        <label class="custom-control-label" for="Banque">Banque</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="banque_montant" id="Montant" name="selected_header[Montant]">
                        <label class="custom-control-label" for="Montant">Montant</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="date_depot" id="Date-de-dépôt" name="selected_header[Date de dépôt]">
                        <label class="custom-control-label" for="Date-de-dépôt">Date de dépôt</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="banque_numero_de_dossier" id="Numéro-de-dossier" name="selected_header[Numéro de dossier]">
                        <label class="custom-control-label" for="Numéro-de-dossier">Numéro de dossier</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="banque_status" id="Statut-dépôt-banque" name="selected_header[Statut dépôt banque]">
                        <label class="custom-control-label" for="Statut-dépôt-banque">Statut dépôt banque</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Préciser_pièces_manquantes" id="Préciser-pièces-manquantes" name="selected_header[Préciser pièces manquantes]">
                        <label class="custom-control-label" for="Préciser-pièces-manquantes">Préciser pièces manquantes</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Statut_accord_banque" id="Statut-accord-banque" name="selected_header[Statut accord banque]">
                        <label class="custom-control-label" for="Statut-accord-banque">Statut accord banque</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Montant_crédit_accepté" id="Montant-crédit-accepté" name="selected_header[Montant crédit accepté]">
                        <label class="custom-control-label" for="Montant-crédit-accepté">Montant crédit accepté</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_de_notification_accord" id="Date-de-notification-accord" name="selected_header[Date de notification accord]">
                        <label class="custom-control-label" for="Date-de-notification-accord">Date de notification accord</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Raison_refus_du_crédit" id="Raison-refus-du-crédit" name="selected_header[Raison refus du crédit]">
                        <label class="custom-control-label" for="Raison-refus-du-crédit">Raison refus du crédit</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#MairieCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Demande Mairie
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="MairieCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Mairie" id="Mairie" name="selected_header[Mairie]">
                        <label class="custom-control-label" for="Mairie">Mairie</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Statut_demande" id="Statut_demande" name="selected_header[Statut demande]">
                        <label class="custom-control-label" for="Statut_demande">Statut demande</label>
                    </div>
                    {{-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_de_réception_de_l_accord_de_mairie" id="Date_de_réception_de_l_accord_de_mairie" name="selected_header[Date de réception de l'accord de mairie]">
                        <label class="custom-control-label" for="Date_de_réception_de_l_accord_de_mairie">Date de réception de l'accord de mairie</label>
                    </div> --}}
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_de_dépôt2" id="Date_de_dépôt2" name="selected_header[Date de dépôt]">
                        <label class="custom-control-label" for="Date_de_dépôt2">Date de dépôt</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Demande_de_travaux" id="Demande_de_travaux" name="selected_header[Demande de travaux]">
                        <label class="custom-control-label" for="Demande_de_travaux">Demande de travaux</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Réception_du_récépissé_de_dépôt" id="Réception_du_récépissé_de_dépôt" name="selected_header[Réception du récépissé de dépôt]">
                        <label class="custom-control-label" for="Réception_du_récépissé_de_dépôt">Réception du récépissé de dépôt</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Date_de_réception_de_récépissé_de_mairie" id="Date_de_réception_de_récépissé_de_mairie" name="selected_header[Date de réception de récépissé de mairie]">
                        <label class="custom-control-label" for="Date_de_réception_de_récépissé_de_mairie">Date de réception de récépissé de mairie</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="MairieObservations" id="MairieObservations" name="selected_header[Observations]">
                        <label class="custom-control-label" for="MairieObservations">Observations</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#auditCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Audit
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="auditCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="audit_type" id="audit_type" name="selected_header[Audit réalisé]">
                        <label class="custom-control-label" for="audit_type">Audit réalisé</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="study_office" id="study_office" name="selected_header[Bureau étude]">
                        <label class="custom-control-label" for="study_office">Bureau étude</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="audit_status" id="audit_status" name="selected_header[Statut audit]">
                        <label class="custom-control-label" for="audit_status">Statut audit</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="audit_user" id="audit_user" name="selected_header[Audit réalisé par]">
                        <label class="custom-control-label" for="audit_user">Audit réalisé par</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="release_date" id="release_date" name="selected_header[Audit réalisé le]">
                        <label class="custom-control-label" for="release_date">Audit réalisé le</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="report_result" id="report_result" name="selected_header[Résultat du rapport audit]">
                        <label class="custom-control-label" for="report_result">Résultat du rapport audit</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Audit_envoyé_le" id="Audit_envoyé_le" name="selected_header[Audit envoyé le]">
                        <label class="custom-control-label" for="Audit_envoyé_le">Audit envoyé le</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Audit_reçu_le" id="Audit_reçu_le" name="selected_header[Audit reçu le]">
                        <label class="custom-control-label" for="Audit_reçu_le">Audit reçu le</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Scénario_choisi" id="Scénario_choisi" name="selected_header[Scénario choisi]">
                        <label class="custom-control-label" for="Scénario_choisi">Scénario choisi</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Travaux_du_scénario_choisi" id="Travaux_du_scénario_choisi" name="selected_header[Travaux du scénario choisi]">
                        <label class="custom-control-label" for="Travaux_du_scénario_choisi">Travaux du scénario choisi</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="report_reference" id="report_reference" name="selected_header[Référence du rapport]">
                        <label class="custom-control-label" for="report_reference">Référence du rapport</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="auditObservations" id="auditObservations" name="selected_header[Observations]">
                        <label class="custom-control-label" for="auditObservations">Observations</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#suiviFacturationCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Suivi Facturation
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="suiviFacturationCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="suivi_facturation_1" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_1">Encaissement 1</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="2" id="suivi_facturation_2" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_2">Encaissement 2</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="3" id="suivi_facturation_3" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_3">Encaissement 3</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="4" id="suivi_facturation_4" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_4">Encaissement 4</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="5" id="suivi_facturation_5" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_5">Encaissement 5</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="6" id="suivi_facturation_6" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_6">Encaissement 6</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="7" id="suivi_facturation_7" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_7">Encaissement 7</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="8" id="suivi_facturation_8" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_8">Encaissement 8</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="9" id="suivi_facturation_9" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_9">Encaissement 9</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="10" id="suivi_facturation_10" name="selected_suivi_facturation_header[]">
                        <label class="custom-control-label" for="suivi_facturation_10">Encaissement 10</label>
                    </div>  
                </div>
            </div>
        </div>
    </div> 
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#contrôleDeGestionCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Contrôle de gestion
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="contrôleDeGestionCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="1" id="gestion_1" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_1">Paiement 1</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="2" id="gestion_2" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_2">Paiement 2</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="3" id="gestion_3" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_3">Paiement 3</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="4" id="gestion_4" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_4">Paiement 4</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="5" id="gestion_5" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_5">Paiement 5</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="6" id="gestion_6" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_6">Paiement 6</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="7" id="gestion_7" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_7">Paiement 7</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="8" id="gestion_8" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_8">Paiement 8</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="9" id="gestion_9" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_9">Paiement 9</label>
                    </div>  
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="10" id="gestion_10" name="selected_gestion_header[]">
                        <label class="custom-control-label" for="gestion_10">Paiement 10</label>
                    </div>  
                </div>
            </div>
        </div>
    </div> 
    <div class="col-xl-4 col-md-6">
        <div class="ticket-analytic-card border flex-column mb-3 p-0">
            <div class="w-100 position-relative d-flex align-items-center justify-content-end p-3 cursor-pointer" data-toggle="collapse" data-target="#autreCollapse" aria-expanded="false">
                <h4 class="card-title mb-0 mr-auto">
                    Autre
                </h4>
                <button class="btn btn-icon bg-white position-absolute shadow-none" type="button">
                    <span>
                        <i class="bi bi-chevron-down"></i>
                    </span>
                </button>
            </div>
            <div class="collapse w-100" id="autreCollapse">
                <div class="card-body pt-0">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Statut" id="Statut" name="selected_header[Statut]">
                        <label class="custom-control-label" for="Statut">Statut</label>
                    </div> 
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Etiquette" id="Etiquette" name="selected_header[Etiquette]">
                        <label class="custom-control-label" for="Etiquette">Etiquette</label>
                    </div> 
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Telecommercial" id="Telecommercial" name="selected_header[Telecommercial]">
                        <label class="custom-control-label" for="Telecommercial">Telecommercial</label>
                    </div> 
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Regie" id="Regie" name="selected_header[Regie]">
                        <label class="custom-control-label" for="Regie">Regie</label>
                    </div> 
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" value="Responsable_commercial" id="Responsable_commercial" name="selected_header[Responsable commercial]">
                        <label class="custom-control-label" for="Responsable_commercial">Responsable commercial</label>
                    </div> 
                </div>
            </div>
        </div>
    </div>  
</div>
