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
                            @foreach ($custom_fields->where('collapse_name', 'collapse_personal_information') as $custom_field)
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
                                    || $header->header == 'Faisabilité_du_projet'
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
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#controle_de" aria-expanded="false">
            Contrôles des pièces
          </button>
        </h2>
      </div>

      <div id="controle_de" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'Pièces_manquante' || $header->header == 'Contrôles_des_pièces_observation' )

                                    <tr>
                                        <td>
                                            @if ($header->header == 'Contrôles_des_pièces_observation')
                                                Observation
                                            @else
                                                {{ str_replace('_',' ',$header->header) }}
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
                            @foreach ($custom_fields->where('collapse_name', 'collapse__controle_de') as $custom_field)
                            <tr>
                                <td>    
                                    {{ $custom_field->title }}
                                </td>
                                <td>
                                    <div class="form-group mb-0">
                                        <select name="controle_de_custom__field[{{ $custom_field->name }}]" id="" class="leadImportSelectChange form-control shadow-none select2">
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
    <div class="card">
      <div class="card-header">
        <h2 class="mb-0">
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#interventionPrevisite" aria-expanded="false">
            Intervention Pré-Visite Technico-Commercial
          </button>
        </h2>
      </div>

      <div id="interventionPrevisite" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'Date_intervention' 
                                    || $header->header == 'Horaire_intervention'
                                    || $header->header == 'Statut_planning'
                                    || $header->header == 'Prévisiteur_TechnicohyphenCommercial'
                                    || $header->header == 'Réfèrent_technique'
                                    || $header->header == 'Faisabilité_du_chantier'
                                    || $header->header == 'Statut_contrat'
                                    || $header->header == 'Dossier_administratif_complet'
                                    || $header->header == 'Observations'
                                 )

                                    <tr>
                                        <td>
                                            {{ str_replace('_',' ',str_replace('hyphen','-', $header->header)) }} 
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="intervention___previsite[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#interventionInstallation" aria-expanded="false">
            Intervention Installation
          </button>
        </h2>
      </div>

      <div id="interventionInstallation" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'Date_intervention' 
                                    || $header->header == 'Horaire_intervention'
                                    || $header->header == 'Statut_planning'
                                    || $header->header == 'Installateur_technique'
                                    || $header->header == 'Dossier_Installation' 
                                    || $header->header == 'Statut_Installation' 
                                    || $header->header == 'Observations'
                                 )

                                    <tr>
                                        <td>
                                            {{ str_replace('_',' ',$header->header) }} 
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="intervention___installation[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#interventionInstallation2" aria-expanded="false">
           Intervention Installation 2
          </button>
        </h2>
      </div>

      <div id="interventionInstallation2" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'Date_intervention' 
                                    || $header->header == 'Horaire_intervention'
                                    || $header->header == 'Statut_planning'
                                    || $header->header == 'Installateur_technique'
                                    || $header->header == 'Dossier_Installation' 
                                    || $header->header == 'Statut_Installation' 
                                    || $header->header == 'Observations'
                                 )

                                    <tr>
                                        <td>
                                            {{ str_replace('_',' ',$header->header) }} 
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="intervention___installation2[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#interventionEtude" aria-expanded="false">
            Intervention Etude
          </button>
        </h2>
      </div>

      <div id="interventionEtude" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'Date_intervention' 
                                    || $header->header == 'Horaire_intervention'
                                    || $header->header == 'Statut_planning'
                                    || $header->header == 'Chargé_dapostropheétude'
                                    || $header->header == 'Réfèrent_technique'
                                    || $header->header == 'Faisabilité_du_chantier'
                                    || $header->header == 'Statut_contrat'
                                    || $header->header == 'Dossier_administratif_complet'
                                    || $header->header == 'Observations'
                                 )

                                    <tr>
                                        <td>
                                            {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="intervention___etude[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#Compte" aria-expanded="false">
            Compte
          </button>
        </h2>
      </div> 
      <div id="Compte" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'compte_email_status' 
                                || $header->header == 'Compte_email'
                                || $header->header == 'Compte_Mots_de_passe'
                                || $header->header == 'Compte_crée_le'
                                || $header->header == 'Compte_crée_par'
                                || $header->header == 'compte_email_recovery_status'
                                || $header->header == 'Compte_Email_de_récupération_email'
                                || $header->header == 'Compte_Email_de_récupération_Mots_de_passe'
                                || $header->header == 'Compte_Email_de_récupération_crée_le'
                                || $header->header == 'Compte_Email_de_récupération_crée_par'
                                || $header->header == 'Téléphone_de_récupération'
                                || $header->header == 'Téléphone_de_récupération_Téléphone'
                                || $header->header == 'Email_de_transfert'
                                || $header->header == 'Email_de_transfert_Email'
                                || $header->header == 'compte_MaPrimeRénov_status'
                                || $header->header == 'Compte_MaPrimeRenov_email'
                                || $header->header == 'Compte_MaPrimeRenov_Mots_de_passe'
                                || $header->header == 'Compte_MaPrimeRenov_Compte_crée_le'
                                || $header->header == 'Compte_MaPrimeRenov_Compte_crée_par'
                                || $header->header == 'Compte_Observations')

                                    <tr>
                                        <td>
                                            @if ($header->header == 'compte_email_status')
                                                Compte email statut
                                            @elseif($header->header == 'compte_email_recovery_status')
                                                Compte email de récupération statut
                                            @elseif($header->header == 'Téléphone_de_récupération')
                                            Téléphone de récupération statut
                                            @elseif($header->header == 'Téléphone_de_récupération_Téléphone')
                                            Téléphone de récupération
                                            @elseif($header->header == 'Email_de_transfert')
                                            Email de transfert statut
                                            @elseif($header->header == 'Email_de_transfert_Email')
                                            Email de transfert
                                            @elseif($header->header == 'compte_MaPrimeRénov_status')
                                            Compte MaPrimeRénov statut
                                            @else
                                                {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
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
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importSubvention" aria-expanded="false">
            Subvention (MaPrimeRenov')
          </button>
        </h2>
      </div> 
      <div id="importSubvention" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'subvention_status'
                                || $header->header == 'date_mise'
                                || $header->header == 'date_de_depot'
                                || $header->header == 'subvention_provisional'
                                || $header->header == 'mandataire'
                                || $header->header == 'mondat_depot'
                                || $header->header == 'gestionnaire_depot'
                                || $header->header == 'numero_de_devis'
                                || $header->header == 'Consentement_reçu_le'
                                || $header->header == 'Consentement_répondu_le'
                                || $header->header == 'Consentement_répondu_par'
                                || $header->header == 'Statut_subvention'
                                || $header->header == 'subvention_accorde_le'
                                || $header->header == 'montant_subvention_accorde'
                                || $header->header == 'notification_doctroi'
                                || $header->header == 'Date_forclusion'
                                || $header->header == 'subvention_rejetee_le'
                                || $header->header == 'Motif_rejet'
                                || $header->header == 'Notification_de_rejet'
                                || $header->header == 'Subvention_observation')

                                    <tr>
                                        <td>
                                            @if ($header->header == 'subvention_status')
                                            Statut MPR - Subvention 1
                                            @elseif($header->header == 'date_mise')
                                            Date mise à jour
                                            @elseif($header->header == 'date_de_depot')
                                            Date de dépôt
                                            @elseif($header->header == 'subvention_provisional')
                                            Montant subvention prévisionnelle
                                            @elseif($header->header == 'mandataire')
                                            Mandataire MaPrimeRénov
                                            @elseif($header->header == 'mondat_depot')
                                            Type de mandat MPR
                                            @elseif($header->header == 'gestionnaire_depot')
                                            Gestionnaire
                                            @elseif($header->header == 'notification_doctroi')
                                            Lettre de notification d’octroi
                                            @elseif($header->header == 'Subvention_observation')
                                            Observations
                                            @else
                                                {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-group mb-0">
                                                <select name="import__subvention[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
          <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importSubvention2" aria-expanded="false">
            Subvention (Action Logement)
          </button>
        </h2>
      </div> 
      <div id="importSubvention2" class="collapse" data-parent="#LeadImportAccordian">
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
                                @if ($header->header == 'Date_de_dépôt'
                                || $header->header == 'Number_Dossier_Action_Logement'
                                || $header->header == 'Montant_subvention_prévisionnelle'
                                || $header->header == 'Statut_Action_logement'
                                || $header->header == 'Date_mise_à_jour'
                                || $header->header == 'amo'
                                || $header->header == 'Subvention_Observations')

                                    <tr>
                                        <td>
                                            @if ($header->header == 'Number_Dossier_Action_Logement')
                                            N° Dossier Action Logement
                                            @elseif($header->header == 'amo')
                                            AMO 
                                            @elseif($header->header == 'Subvention_Observations')
                                            Observations
                                            @else
                                                {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importBanque" aria-expanded="false">
              Banque
            </button>
          </h2>
        </div> 
        <div id="importBanque" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'Banque'
                                  || $header->header == 'banque_montant'
                                  || $header->header == 'date_depot'
                                  || $header->header == 'banque_numero_de_dossier'
                                  || $header->header == 'banque_status'
                                  || $header->header == 'Préciser_pièces_manquantes'
                                  || $header->header == 'Statut_accord_banque'
                                  || $header->header == 'Montant_crédit_accepté'
                                  || $header->header == 'Date_de_notification_accord'
                                  || $header->header == 'Raison_refus_du_crédit')
  
                                      <tr>
                                          <td>
                                              @if ($header->header == 'banque_montant')
                                              Montant
                                              @elseif($header->header == 'date_depot')
                                              Date de dépôt
                                              @elseif($header->header == 'banque_numero_de_dossier')
                                              Numéro de dossier
                                              @elseif($header->header == 'banque_status')
                                              Statut dépôt banque 
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__banque[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importDemande" aria-expanded="false">
                Demande Mairie
            </button>
          </h2>
        </div> 
        <div id="importDemande" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'Mairie'
                                  || $header->header == 'Statut_demande'
                                  || $header->header == 'Date_de_réception_de_l_accord_de_mairie'
                                  || $header->header == 'Date_de_dépôt_demande'
                                  || $header->header == 'Demande_de_travaux'
                                  || $header->header == 'Réception_du_récépissé_de_dépôt'
                                  || $header->header == 'Date_de_réception_de_récépissé_de_mairie'
                                  || $header->header == 'demande_Observations')
                                      <tr>
                                          <td>
                                              @if($header->header == 'Date_de_dépôt_demande')
                                                Date de dépôt
                                              @elseif ($header->header == 'demande_Observations')
                                                Observations 
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__demande[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importAudit" aria-expanded="false">
                Audit Energetique
            </button>
          </h2>
        </div> 
        <div id="importAudit" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'audit_type'
                                  || $header->header == 'study_office'
                                  || $header->header == 'audit_status'
                                  || $header->header == 'audit_user'
                                  || $header->header == 'release_date'
                                  || $header->header == 'report_result'
                                  || $header->header == 'Audit_envoyé_le'
                                  || $header->header == 'Audit_reçu_le'
                                  || $header->header == 'Scénario_choisi'
                                  || $header->header == 'Cumac_du_scénario_choisi'
                                  || $header->header == 'Prime_CEE_du_scénario_choisi'
                                  || $header->header == 'report_reference'
                                  || $header->header == 'audit_Observations')
                                      <tr>
                                          <td>
                                              @if($header->header == 'audit_type')
                                               Audit réalisé
                                              @elseif ($header->header == 'study_office')
                                              Bureau étude 
                                              @elseif ($header->header == 'audit_status')
                                              Statut audit
                                              @elseif ($header->header == 'audit_user')
                                              Audit réalisé par
                                              @elseif ($header->header == 'release_date')
                                              Audit réalisé le
                                              @elseif ($header->header == 'report_result')
                                              Résultat du rapport audit
                                              @elseif ($header->header == 'report_reference')
                                              Référence du rapport
                                              @elseif ($header->header == 'audit_Observations')
                                              Observations
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__audit[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importEncaissementCEE" aria-expanded="false">
                Encaissement CEE
            </button>
          </h2>
        </div> 
        <div id="importEncaissementCEE" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'Statut_règlement'
                                  || $header->header == 'Délégataire'
                                  || $header->header == 'CUMAC'
                                  || $header->header == 'Montant_prime_CEE_Bénéficiaire'
                                  || $header->header == 'Montant_prime_CEE_NOVECOLOGY'
                                  || $header->header == 'Montant_apporteur_dapostropheaffaires_NOVECOLOGY'
                                  || $header->header == 'Numero_lot'
                                  || $header->header == 'Date_dépôt_pollueur'
                                  || $header->header == 'Date_paiement_pollueur'
                                  || $header->header == 'Facture_number_NOVECOLOGY'
                                  || $header->header == 'facturation_Observations')
                                      <tr>
                                          <td>
                                              @if ($header->header == 'Facture_number_NOVECOLOGY')
                                              N° facture NOVECOLOGY
                                              @elseif ($header->header == 'facturation_Observations')
                                              Observations
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__cee[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importEncaissementMaPrimeRénov" aria-expanded="false">
                Encaissement MaPrimeRénov’
            </button>
          </h2>
        </div> 
        <div id="importEncaissementMaPrimeRénov" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'Statut_règlement'
                                  || $header->header == 'Montant'
                                  || $header->header == 'Paiement_inférieur_au_montant_prévu'
                                  || $header->header == 'Paiement_inférieur_payé'
                                  || $header->header == 'MaPrimeRénov_Mandataire'
                                  || $header->header == 'Date_facturation_MaPrimeRénov'
                                  || $header->header == 'Facture_number_NOVECOLOGY'
                                  || $header->header == 'Avance_délégataire_MaPrimeRénov'
                                  || $header->header == 'Avance_délégataire_MaPrimeRénov_Mandataire'
                                  || $header->header == 'Montant_avance'
                                  || $header->header == 'Lot_APF'
                                  || $header->header == 'Numéro_de_bordereau_APF'
                                  || $header->header == 'Date_APF'
                                  || $header->header == 'Paye_le'
                                  || $header->header == 'Date_paiement_MaPrimeRénov'
                                  || $header->header == 'Référence_bancaire'
                                  || $header->header == 'Lettre_de_versement'
                                  || $header->header == 'facturation_Observations')
                                      <tr>
                                          <td>
                                              @if ($header->header == 'MaPrimeRénov_Mandataire')
                                              Mandataire
                                              @elseif ($header->header == 'facturation_Observations')
                                              Observations
                                              @elseif ($header->header == 'Facture_number_NOVECOLOGY')
                                              N° facture NOVECOLOGY
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__MaPrimeRénov[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importEncaissementClient" aria-expanded="false">
                Encaissement Client
            </button>
          </h2>
        </div> 
        <div id="importEncaissementClient" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'Statut_règlement'
                                  || $header->header == 'Facture_number'
                                  || $header->header == 'Montant'
                                  || $header->header == 'Prestations'
                                  || $header->header == 'Moyens_de_paiement'
                                  || $header->header == 'Mode'
                                  || $header->header == 'nombre_de_mensualité'
                                  || $header->header == 'facturation_Observations')
                                      <tr>
                                          <td>
                                              @if ($header->header == 'Facture_number')
                                              N° facture
                                              @elseif ($header->header == 'facturation_Observations')
                                              Observations 
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__client[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importEncaissementBanque" aria-expanded="false">
                Encaissement Banque
            </button>
          </h2>
        </div> 
        <div id="importEncaissementBanque" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'Statut_règlement'
                                  || $header->header == 'facturation_Banque'
                                  || $header->header == 'Montant'
                                  || $header->header == 'N_Dossier_organisme'
                                  || $header->header == 'Date_envoi_contrat'
                                  || $header->header == 'Numero_suivi_envoi_contrat'
                                  || $header->header == 'Date_demande_de_financement'
                                  || $header->header == 'Paye_le'
                                  || $header->header == 'Référence_bancaire'
                                  || $header->header == 'facturation_Observations')
                                      <tr>
                                          <td>
                                              @if ($header->header == 'Statut_règlement')
                                              Statut réglement banque
                                              @elseif ($header->header == 'facturation_Banque')
                                              Banque
                                              @elseif ($header->header == 'N_Dossier_organisme')
                                              N* Dossier organisme
                                              @elseif ($header->header == 'facturation_Observations')
                                              Observations 
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__banque_facturation[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
            <button class="btn btn-block text-left shadow-none text-primary collapse-arrow" type="button" data-toggle="collapse" data-target="#importEncaissementActionLogement" aria-expanded="false">
                Encaissement Action Logement
            </button>
          </h2>
        </div> 
        <div id="importEncaissementActionLogement" class="collapse" data-parent="#LeadImportAccordian">
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
                                  @if ($header->header == 'Statut_règlement'
                                  || $header->header == 'Montant'
                                  || $header->header == 'N_Dossier_Action_Logement'
                                  || $header->header == 'facturation_AMO'
                                  || $header->header == 'Date_facturation_Action_Logement'
                                  || $header->header == 'Facture_number_NOVECOLOGY'
                                  || $header->header == 'Date_paiement_Action_Logement'
                                  || $header->header == 'Référence_bancaire'
                                  || $header->header == 'facturation_Observations')
                                      <tr>
                                          <td>
                                              @if ($header->header == 'N_Dossier_Action_Logement')
                                              N° Dossier Action Logement
                                              @elseif ($header->header == 'Facture_number_NOVECOLOGY')
                                              N° facture NOVECOLOGY 
                                              @elseif ($header->header == 'facturation_AMO')
                                              AMO
                                              @elseif ($header->header == 'facturation_Observations')
                                              Observations 
                                              @else
                                                  {{ str_replace('_',' ',str_replace('apostrophe','’', $header->header)) }} 
                                              @endif
                                          </td>
                                          <td>
                                              <div class="form-group mb-0">
                                                  <select name="import__action_logement[{{ $header->header }}]" id="" class="leadImportSelectChange form-control select2 shadow-none">
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
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
        </div>
    </div>
</div>

<div class="form-group text-left mt-3">
    <label class="form-label" for="">Regie</label>
    <select id="importRegieSelector" class="select2_select_option custom-select shadow-none form-control">
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
    <select name="selected_label" data-id="import" class="select2_select_option custom-select shadow-none form-control project_staus__change" required>
        <option value="" selected>{{ __('Select') }}</option>
        @foreach ($labels as $label)
            <option value="{{ $label->id }}">{{ $label->status }}</option>
        @endforeach
    </select>
</div>
<div class="form-group text-left mt-3">
    <label class="form-label" for="">Statut</label>
    <select name="selected_sub_status" id="project_sub_staus_newimport" class="select2_select_option custom-select shadow-none form-control">
        <option value="" selected>{{ __('Select') }}</option> 
        {{-- @foreach ($project_sub_status as $sub_status)
            <option value="{{ $sub_status->id }}">{{ $sub_status->name }}</option>
        @endforeach --}}
    </select>
</div>