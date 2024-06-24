<h3 class="mb-2 font-weight-bold">Nom du fichier: {{ $original_file_name }}</h3>
<div class="accordion" id="LeadImportAccordian">
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#lead_tracking" aria-expanded="true">
            {{ __('Lead Tracking (Form and response)') }}
          </button>
        </h2>
      </div>

      <div id="lead_tracking" class="collapse show" data-parent="#LeadImportAccordian">
        <div class="card-body">
            <div class="database-table-wrapper bg-white">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    Champs CRM
                                </th>
                                <th>
                                    Champs Excel
                                </th>
                                <th>
                                    Exemple
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
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

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="{{ $header->header }}" id="" class="leadImportSelectChange form-control shadow-none select2">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($headings as $heading_key => $lead_tracking_header)
                                                        @if ($lead_tracking_header)
                                                            <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                                    <option value=""></option>
                                                    @foreach ($second_headings as $key => $second_heading)
                                                        @if ($second_heading)
                                                            <option value="{{ $key }}">{{ $second_heading }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($custom_fields->where('collapse_name', 'collapse_lead_tracing_lead') as $custom_field)
                            <tr>
                                <td>
                                    {{ $custom_field->title }}
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="lead_tracking_custom__field[{{ $custom_field->name }}]" id="" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $lead_tracking_header)
                                                @if ($lead_tracking_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $lead_tracking_header }}">{{ str_replace('_', ' ', $lead_tracking_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading)
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
    </div>
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#personal_info" aria-expanded="false">
            Informations personnelles
          </button>
        </h2>
      </div>

      <div id="personal_info" class="collapse" data-parent="#LeadImportAccordian">
        <div class="card-body">
            <div class="database-table-wrapper bg-white">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    Champs CRM
                                </th>
                                <th>
                                    Champs Excel
                                </th>
                                <th>
                                    Exemple
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
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
                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="{{ $header->header }}" id="" class="leadImportSelectChange form-control select2 shadow-none">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($headings as $heading_key => $personal_info_header)
                                                        @if ($personal_info_header)
                                                            <option data-key-value="{{ $heading_key }}" value="{{ $personal_info_header }}">{{ str_replace('_', ' ', $personal_info_header) }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                                    <option value=""></option>
                                                    @foreach ($second_headings as $key => $second_heading)
                                                        @if ($second_heading)
                                                            <option value="{{ $key }}">{{ $second_heading }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($custom_fields->where('collapse_name', 'collapse__personal_information') as $custom_field)
                            <tr>
                                <td>
                                    {{ $custom_field->title }}
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="personal_information_custom__field[{{ $custom_field->name }}]" id="" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $personal_information_header)
                                                @if ($personal_information_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $personal_information_header }}">{{ str_replace('_', ' ', $personal_information_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading)
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
    </div>
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#eligibility" aria-expanded="false">
            Éligibilité
          </button>
        </h2>
      </div>

      <div id="eligibility" class="collapse" data-parent="#LeadImportAccordian">
        <div class="card-body">
            <div class="database-table-wrapper bg-white">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    Champs CRM
                                </th>
                                <th>
                                    Champs Excel
                                </th>
                                <th>
                                    Exemple
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
                            @foreach ($headers as $header)
                                @if ($header->header == 'Type_occupation'
                                || $header->header == 'Parcelle_cadastrale'
                                || $header->header == 'Revenue_Fiscale_de_Référence'
                                || $header->header == 'Nombre_de_foyer'
                                || $header->header == 'Nombre_de_personnes'
                                || $header->header == 'Age_du_bâtiment'
                                || $header->header == 'Zone'
                                || $header->header == 'precariousness')

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="{{ $header->header }}" id="" class="leadImportSelectChange form-control select2 shadow-none">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($headings as $heading_key => $eligibility_header)
                                                        @if ($eligibility_header)
                                                            <option data-key-value="{{ $heading_key }}" value="{{ $eligibility_header }}">{{ str_replace('_', ' ', $eligibility_header) }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                                    <option value=""></option>
                                                    @foreach ($second_headings as $key => $second_heading)
                                                        @if ($second_heading)
                                                            <option value="{{ $key }}">{{ $second_heading }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($custom_fields->where('collapse_name', 'lead_collapse_eligibility') as $custom_field)
                            <tr>
                                <td>
                                    {{ $custom_field->title }}
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="eligibility_custom__field[{{ $custom_field->name }}]" id="" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $eligibility_header)
                                                @if ($eligibility_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $eligibility_header }}">{{ str_replace('_', ' ', $eligibility_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading)
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
    </div>
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#information_logement" aria-expanded="false">
            Information logement
          </button>
        </h2>
      </div>

      <div id="information_logement" class="collapse" data-parent="#LeadImportAccordian">
        <div class="card-body">
            <div class="database-table-wrapper bg-white">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    Champs CRM
                                </th>
                                <th>
                                    Champs Excel
                                </th>
                                <th>
                                    Exemple
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
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

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="{{ $header->header }}" id="" class="leadImportSelectChange form-control select2 shadow-none">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($headings as $heading_key => $information_logement_header)
                                                        @if ($information_logement_header)
                                                            <option data-key-value="{{ $heading_key }}" value="{{ $information_logement_header }}">{{ str_replace('_', ' ', $information_logement_header) }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                                    <option value=""></option>
                                                    @foreach ($second_headings as $key => $second_heading)
                                                        @if ($second_heading)
                                                            <option value="{{ $key }}">{{ $second_heading }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($custom_fields->where('collapse_name', 'lead_collapse_information_logement') as $custom_field)
                            <tr>
                                <td>
                                    {{ $custom_field->title }}
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="information_logement_custom__field[{{ $custom_field->name }}]" id="" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $information_logement_header)
                                                @if ($information_logement_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $information_logement_header }}">{{ str_replace('_', ' ', $information_logement_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading)
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
    </div>
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#situation_foyer" aria-expanded="false">
            {{ __('Situation foyer') }}
          </button>
        </h2>
      </div>

      <div id="situation_foyer" class="collapse" data-parent="#LeadImportAccordian">
        <div class="card-body">
            <div class="database-table-wrapper bg-white">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    Champs CRM
                                </th>
                                <th>
                                    Champs Excel
                                </th>
                                <th>
                                    Exemple
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
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

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="{{ $header->header }}" id="" class="leadImportSelectChange form-control select2 shadow-none">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($headings as $heading_key => $situation_foyer_header)
                                                        @if ($situation_foyer_header)
                                                            <option data-key-value="{{ $heading_key }}" value="{{ $situation_foyer_header }}">{{ str_replace('_', ' ', $situation_foyer_header) }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                                    <option value=""></option>
                                                    @foreach ($second_headings as $key => $second_heading)
                                                        @if ($second_heading)
                                                            <option value="{{ $key }}">{{ $second_heading }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($custom_fields->where('collapse_name', 'lead_collapse_situation_foyer') as $custom_field)
                            <tr>
                                <td>
                                    {{ $custom_field->title }}
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="situation_foyer_custom__field[{{ $custom_field->name }}]" id="" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $situation_foyer_header)
                                                @if ($situation_foyer_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $situation_foyer_header }}">{{ str_replace('_', ' ', $situation_foyer_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading)
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
    </div>
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#projet" aria-expanded="false">
            Projet
          </button>
        </h2>
      </div>

      <div id="projet" class="collapse" data-parent="#LeadImportAccordian">
        <div class="card-body">
            <div class="database-table-wrapper bg-white">
                <div class="table-responsive simple-bar">
                    <table class="table w-100 mb-0 table-bordered">
                        <thead class="database-table__header">
                            <tr>
                                <th>
                                    Champs CRM
                                </th>
                                <th>
                                    Champs Excel
                                </th>
                                <th>
                                    Exemple
                                </th>
                            </tr>
                        </thead>
                        <tbody class="database-table__body">
                            @foreach ($headers as $header)
                                @if ($header->header == 'Type_de_contrat'
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
                                    || $header->header == 'advance_visit'
                                    || $header->header == 'Projet_observations')

                                    <tr>
                                        <td>
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
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="{{ $header->header }}" id="" class="leadImportSelectChange form-control select2 shadow-none">
                                                    <option value="">{{ __('Select') }}</option>
                                                    @foreach ($headings as $heading_key => $projet_header)
                                                        @if ($projet_header)
                                                            <option data-key-value="{{ $heading_key }}" value="{{ $projet_header }}">{{ str_replace('_', ' ', $projet_header) }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                         <td>
                                            <div class="form-group mb-0">
                                                <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                                    <option value=""></option>
                                                    @foreach ($second_headings as $key => $second_heading)
                                                        @if ($second_heading)
                                                            <option value="{{ $key }}">{{ $second_heading }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div> 
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @foreach ($custom_fields->where('collapse_name', 'lead_collapse__project') as $custom_field)
                            <tr>
                                <td>
                                    {{ $custom_field->title }}
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="project_custom__field[{{ $custom_field->name }}]" id="" class="leadImportSelectChange form-control shadow-none select2">
                                            <option value="">{{ __('Select') }}</option>
                                            @foreach ($headings as $heading_key => $project_header)
                                                @if ($project_header)
                                                    <option data-key-value="{{ $heading_key }}" value="{{ $project_header }}">{{ str_replace('_', ' ', $project_header) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                 <td>
                                    <div class="form-group mb-0">
                                        <select class="leadImportSelectExample form-control shadow-none select2 border-0" style="-webkit-appearance: none" readonly disabled>
                                            <option value=""></option>
                                            @foreach ($second_headings as $key => $second_heading)
                                                @if ($second_heading)
                                                    <option value="{{ $key }}">{{ $second_heading }}</option>
                                                @endif
                                            @endforeach
                                        </select>
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
    </div>
</div>

<div class="form-group text-left mt-3">
    <label class="form-label" for="">Regie <span class="text-danger">*</span></label>
    <select id="importRegieSelector" name="selected_regie" class="select2_select_option custom-select shadow-none form-control" required>
        <option value="" selected>{{ __('Select') }}</option> 
        @foreach ($regies as $regie)
            <option value="{{ $regie->id }}">{{ $regie->name }}</option>
        @endforeach 
    </select>
</div>

<div class="importRegieSelectorWrap" style="display: none">

</div>

<div class="form-group text-left mt-3">
    <label class="form-label" for="">Etiquette <span class="text-danger">*</span></label>
    <select name="selected_label" data-id="leadImort" class="select2_select_option custom-select shadow-none form-control lead_staus__change" required> 
        <option value="" disabled selected>{{ __("Select") }}</option>
        @foreach ($labels as $label)
            <option value="{{ $label->id }}">{{ $label->status }}</option>
        @endforeach
    </select>
</div>
<div class="form-group text-left mt-3">
    <label class="form-label" for="">Statut</label>
    <select name="selected_sub_status" id="lead_sub_staus_newleadImort" class="select2_select_option custom-select shadow-none form-control">
        <option value="" selected>{{ __('Select') }}</option> 
        {{-- @foreach ($lead_sub_status as $sub_status)
            <option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
        @endforeach --}}
    </select>
</div>