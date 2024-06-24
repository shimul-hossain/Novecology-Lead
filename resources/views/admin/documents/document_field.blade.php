@foreach ($document->fields as $field)
    @if ($field->field_type == 'checkbox')
        @if ($field->column_value == 'Matériel_existant')
            <div class="col-12">
                <h4>
                    Matériel existant :
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_existant" value="yes" class="custom-control-input" id="Matériel_existant">
                        <label class="custom-control-label" for="Matériel_existant">Le bénéficiaire atteste que la chaudière existante n’est pas une chaudière gaz à condensation</label>
                    </div>
                </div> 
            </div>
        @elseif ($field->column_value == 'Matériel_posé')
            <div class="col-12">
                <h4>
                    Matériel posé :
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_posé[]" value="Pompe à chaleur (BAR-TH-104 / 129)" class="custom-control-input" id="Matériel_posé1">
                        <label class="custom-control-label" for="Matériel_posé1">Pompe à chaleur (BAR-TH-104 / 129) </label>
                    </div>
                </div> 
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_posé[]" value="Chaudière (BAR-TH-106)" class="custom-control-input" id="Matériel_posé2">
                        <label class="custom-control-label" for="Matériel_posé2">Chaudière (BAR-TH-106)</label>
                    </div>
                </div> 
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_posé[]" value="Chauffe-eau thermodynamique (BAR-TH-148)" class="custom-control-input" id="Matériel_posé3">
                        <label class="custom-control-label" for="Matériel_posé3">Chauffe-eau thermodynamique (BAR-TH-148)</label>
                    </div>
                </div> 
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_posé[]" value="Chauffe-eau solaire indiv (BAR-TH-101)" class="custom-control-input" id="Matériel_posé4">
                        <label class="custom-control-label" for="Matériel_posé4">Chauffe-eau solaire indiv (BAR-TH-101)</label>
                    </div>
                </div> 
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_posé[]" value="Système de ventilation (BAR-TH-125/127)" class="custom-control-input" id="Matériel_posé5">
                        <label class="custom-control-label" for="Matériel_posé5">Système de ventilation (BAR-TH-125/127)</label>
                    </div>
                </div> 
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_posé[]" value="Poêle à granules (BAR-TH-112)" class="custom-control-input" id="Matériel_posé6">
                        <label class="custom-control-label" for="Matériel_posé6">Poêle à granules (BAR-TH-112)</label>
                    </div>
                </div> 
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_posé[]" value="Chaudière biomasse (BAR-TH-113)" class="custom-control-input" id="Matériel_posé7">
                        <label class="custom-control-label" for="Matériel_posé7">Chaudière biomasse (BAR-TH-113)</label>
                    </div>
                </div> 
            </div>
        @elseif ($field->column_value == 'Matériel_Problèmes_éventuels')
            <div class="col-12">
                <h4>
                    Matériel posé :
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="radio" name="Matériel_Problèmes_éventuels" value="Oui" class="custom-control-input" id="Matériel_Problèmes_éventuels1">
                        <label class="custom-control-label" for="Matériel_Problèmes_éventuels1">Oui </label>
                    </div>
                </div> 
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="radio" name="Matériel_Problèmes_éventuels" value="Non" class="custom-control-input" id="Matériel_Problèmes_éventuels2">
                        <label class="custom-control-label" for="Matériel_Problèmes_éventuels2">Non</label>
                    </div>
                </div> 
            </div> 
        @elseif ($field->column_value == 'Matériel_Le_bénéficiaire_atteste')
            <div class="col-12">
                <h4>
                    Le bénéficiaire atteste...
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Matériel_Le_bénéficiaire_atteste" value="Oui" class="custom-control-input" id="Matériel_Le_bénéficiaire_atteste1">
                        <label class="custom-control-label" for="Matériel_Le_bénéficiaire_atteste1">Le bénéficiaire atteste avoir souscrit à une convention de maintenance conformément à la législation en vigueur </label>
                    </div>
                </div> 
            </div> 
        @elseif ($field->column_value == 'NATURE_DES_LOCAUX')
            <div class="col-12">
                <h4>
                    NATURE DES LOCAUX
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_LOCAUX[]" value="maison ou immeuble individuel" class="custom-control-input" id="NATURE_DES_LOCAUX1">
                        <label class="custom-control-label" for="NATURE_DES_LOCAUX1">maison ou immeuble individuel</label>
                    </div>
                </div> 
            </div> 
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_LOCAUX[]" value="immeuble collectif" class="custom-control-input" id="NATURE_DES_LOCAUX2">
                        <label class="custom-control-label" for="NATURE_DES_LOCAUX2">immeuble collectif</label>
                    </div>
                </div> 
            </div> 
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_LOCAUX[]" value="appartement individuel" class="custom-control-input" id="NATURE_DES_LOCAUX3">
                        <label class="custom-control-label" for="NATURE_DES_LOCAUX3">appartement individuel</label>
                    </div>
                </div> 
            </div> 
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_LOCAUX[]" value="autre (précisez la nature du local à usage d’habitation)" class="custom-control-input" id="NATURE_DES_LOCAUX4">
                        <label class="custom-control-label" for="NATURE_DES_LOCAUX4">autre (précisez la nature du local à usage d’habitation)</label>
                    </div>
                </div> 
            </div> 
            <div class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="NATURE_DES_LOCAUX_autre">
                </div> 
            </div> 
        @elseif ($field->column_value == 'Les_travaux_sont_réalisés_dans')
            <div class="col-12">
                <h4>
                    Les travaux sont réalisés dans
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Les_travaux_sont_réalisés_dans[]" value="un local affecté exclusivement ou principalement à l’habitation" class="custom-control-input" id="Les_travaux_sont_réalisés_dans1">
                        <label class="custom-control-label" for="Les_travaux_sont_réalisés_dans1">un local affecté exclusivement ou principalement à l’habitation</label>
                    </div>
                </div> 
            </div> 
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Les_travaux_sont_réalisés_dans[]" value="des pièces affectées exclusivement" class="custom-control-input" id="Les_travaux_sont_réalisés_dans2">
                        <label class="custom-control-label" for="Les_travaux_sont_réalisés_dans2">des pièces affectées exclusivement à l’habitation situées dans un local affecté pour moins de 50 % à cet usage</label>
                    </div>
                </div> 
            </div> 
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Les_travaux_sont_réalisés_dans[]" value="des parties communes de locaux affectés exclusivement" class="custom-control-input" id="Les_travaux_sont_réalisés_dans3">
                        <label class="custom-control-label" for="Les_travaux_sont_réalisés_dans3">des parties communes de locaux affectés exclusivement ou principalement à l’habitation dans une proportion de (……………….) millièmes de l’immeuble</label>
                    </div>
                </div> 
            </div> 
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Les_travaux_sont_réalisés_dans[]" value="un local antérieurement affecté à un usage autre" class="custom-control-input" id="Les_travaux_sont_réalisés_dans4">
                        <label class="custom-control-label" for="Les_travaux_sont_réalisés_dans4">un local antérieurement affecté à un usage autre que d’habitation et transformé à cet usage</label>
                    </div>
                </div> 
            </div>  
        @elseif ($field->column_value == 'dont_je_suis')
            <div class="col-12">
                <h4>
                    dont je suis
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="dont_je_suis[]" value="propriétaire" class="custom-control-input" id="dont_je_suis1">
                        <label class="custom-control-label" for="dont_je_suis1">propriétaire</label>
                    </div>
                </div> 
            </div>  
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="dont_je_suis[]" value="locataire" class="custom-control-input" id="dont_je_suis2">
                        <label class="custom-control-label" for="dont_je_suis2">locataire</label>
                    </div>
                </div> 
            </div>  
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="dont_je_suis[]" value="autre (précisez votre qualité)" class="custom-control-input" id="dont_je_suis3">
                        <label class="custom-control-label" for="dont_je_suis3">autre (précisez votre qualité)</label>
                    </div>
                </div> 
            </div>  
            <div class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="dont_je_suis_autre">
                </div> 
            </div> 
        @elseif ($field->column_value == 'NATURE_DES_TRAVAUX')
            <div class="col-12">
                <h4>
                    NATURE DES TRAVAUX
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="n’affectent ni les fondations" class="custom-control-input" id="NATURE_DES_TRAVAUX1">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX1">n’affectent ni les fondations, ni les éléments, hors fondations, déterminant la résistance et la rigidité de l’ouvrage, ni la consistance des façades (hors ravalement).</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="n’affectent pas plus de cinq des six" class="custom-control-input" id="NATURE_DES_TRAVAUX2">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX2">n’affectent pas plus de cinq des six éléments de second œuvre suivants :</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="planchers qui ne déterminent pas" class="custom-control-input" id="NATURE_DES_TRAVAUX3">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX3"> planchers qui ne déterminent pas la résistance ou la rigidité de l’ouvrage</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="huisseries extérieures" class="custom-control-input" id="NATURE_DES_TRAVAUX4">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX4">huisseries extérieures</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="cloisons intérieures" class="custom-control-input" id="NATURE_DES_TRAVAUX5">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX5">cloisons intérieures</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="installations sanitaires et de plomberie" class="custom-control-input" id="NATURE_DES_TRAVAUX6">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX6">installations sanitaires et de plomberie</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="installations électriques" class="custom-control-input" id="NATURE_DES_TRAVAUX7">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX7">installations électriques</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="système de chauffage" class="custom-control-input" id="NATURE_DES_TRAVAUX8">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX8">système de chauffage (pour les immeubles situés en métropole)</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="n’entraînent pas une augmentation de la" class="custom-control-input" id="NATURE_DES_TRAVAUX9">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX9">n’entraînent pas une augmentation de la surface de plancher de la construction existante supérieure à 10 %.</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="ne consistent pas en une surélévation ou une addition de construction." class="custom-control-input" id="NATURE_DES_TRAVAUX10">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX10">ne consistent pas en une surélévation ou une addition de construction.</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="J’atteste que les travaux visent" class="custom-control-input" id="NATURE_DES_TRAVAUX11">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX11">J’atteste que les travaux visent à améliorer la qualité énergétique du logement et portent sur la fourniture, la pose, l’installation ou l’entretien des matériaux, appareils et équipements dont la liste figure dans la notice (1 de l’article 200 quater du code général des impôts – CGI) et respectent les caractéristiques techniques et les critères de performances minimales fixés par un arrêté du ministre du budget (article 18 bis de l’annexe IV au CGI).</label>
                    </div>
                </div> 
            </div>    
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="NATURE_DES_TRAVAUX[]" value="J’atteste que les travaux ont la nature" class="custom-control-input" id="NATURE_DES_TRAVAUX12">
                        <label class="custom-control-label" for="NATURE_DES_TRAVAUX12">J’atteste que les travaux ont la nature de travaux induits indissociablement liés à des travaux d’amélioration de la qualité énergétique soumis au taux de TVA de 5,5 %.</label>
                    </div>
                </div> 
            </div>
        @elseif ($field->column_value == 'Avoir_mandaté_un_mandataire')
            <div class="col-12">
                <h4>
                    Avoir mandaté un mandataire (cocher la case correspondant à votre situation):
                </h4>
            </div>
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Avoir_mandaté_un_mandataire[]" value="un mandataire ADMINISTRATIF" class="custom-control-input" id="Avoir_mandaté_un_mandataire1">
                        <label class="custom-control-label" for="Avoir_mandaté_un_mandataire1">un mandataire ADMINISTRATIF (le mandataire effectue les démarches administratives sur la plateforme
                            maprimerenov.gouv.fr à ma place)</label>
                    </div>
                </div> 
            </div>  
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Avoir_mandaté_un_mandataire[]" value="un mandataire FINANCIER" class="custom-control-input" id="Avoir_mandaté_un_mandataire2">
                        <label class="custom-control-label" for="Avoir_mandaté_un_mandataire2">un mandataire FINANCIER (le mandataire perçoit la prime MaPrimeRénov’ à ma place)</label>
                    </div>
                </div> 
            </div>  
            <div class="col-12">
                <div class="form-group d-flex">
                    <div class="custom-control custom-checkbox ml-1">
                        <input type="checkbox" name="Avoir_mandaté_un_mandataire[]" value="un mandataire MIXTE ADMINISTRATIF ET FINANCIER" class="custom-control-input" id="Avoir_mandaté_un_mandataire3">
                        <label class="custom-control-label" for="Avoir_mandaté_un_mandataire3">un mandataire MIXTE ADMINISTRATIF ET FINANCIER (le mandataire effectue les démarches administratives
                            sur la plateforme maprimerenov.gouv.fr ET perçoit la prime à ma place)</label>
                    </div>
                </div> 
            </div>   
        @endif
    @else
        @php
            $column = $field->column_value;
        @endphp
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="document_field{{ $field->id }}">{{ $field->field_title }}</label>
                @if ($field->field_type == 'textarea')
                    <textarea name="{{ $field->field_name }}" id="document_field{{ $field->id }}" class="form-control shadow-none">@if ($field->column_value =='full_address') {{ $project->Adresse }} 
{{ $project->Code_Postal }} {{ $project->Ville }}@else{{ $project->$column }}@endif</textarea>
                @elseif($field->field_type == 'select')
                    @if ($field->column_value == 'travaux')
                        <select name="travaux[]" class="select2_select_option custom-select shadow-none form-control" multiple>
                            @foreach ($bareme_travaux_tags as $travaux) 
                                <option {{ $project->ProjectTravaux->where('id',  $travaux->id)->first() ? 'selected':'' }} value="{{ $travaux->travaux }}">{{ $travaux->travaux }}</option>
                            @endforeach
                        </select>
                    @elseif ($field->column_value == 'Nature_des_travaux')
                        <select name="Nature_des_travaux" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            @foreach ($bareme_travaux_tags as $travaux) 
                                <option value="{{ $travaux->bareme.'--'.$travaux->travaux  }}">{{ $travaux->travaux }}</option>
                            @endforeach
                        </select>
                    @elseif ($field->column_value == 'Liste_des_travaux_1' || $field->column_value == 'Liste_des_travaux_2')
                        <select name="{{ $field->column_value }}" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            @foreach ($bareme_travaux_tags as $travaux) 
                                <option value="{{ $travaux->bareme }}">{{ $travaux->bareme }}</option>
                            @endforeach
                        </select>
                    @elseif ($field->column_value == 'marque_dropdown')
                        <select name="{{ $field->field_name }}" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            @foreach ($marques as $marque) 
                                <option value="{{ $marque->description }}">{{ $marque->description }}</option>
                            @endforeach
                        </select>
                    @elseif ($field->column_value == 'product_refrence')
                        <select name="Référence" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            @foreach ($products as $product) 
                                <option value="{{ $product->reference }}">{{ $product->reference }}</option>
                            @endforeach
                        </select>
                    @elseif($field->column_value == 'Mode_de_chauffage__static')
                        <select name="{{ $field->field_name }}" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            <option value="FIOUL">FIOUL</option>
                            <option value="GAZ">GAZ</option>
                            <option value="BOIS">BOIS</option>
                            <option value="ELECTRICITE">ELECTRICITE</option>
                            <option value="Autre">Autre</option>
                        </select>
                    @elseif($field->column_value == 'Mode_de_chauffage__static1')
                        <select name="{{ $field->field_name }}" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            <option value="FIOUL">FIOUL</option>
                            <option value="GAZ">GAZ</option>
                            <option value="BOIS">BOIS</option>
                            <option value="ELECTRICITE">ELECTRICITE</option>
                        </select>
                    @elseif($field->column_value == 'Mode_de_chauffage__static2')
                        <select name="{{ $field->field_name }}" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            <option value="Fiou">Fiou</option>
                            <option value="Gaz">Gaz</option>
                            <option value="Bois">Bois</option>
                            <option value="Convecteur électrique">Convecteur électrique</option>
                            <option value="PAC">PAC</option>
                            <option value="Autres">Autres</option>
                        </select>
                    @elseif($field->column_value == 'Atteste_static')
                        <select name="{{ $field->field_name }}" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            <option value="de l’achèvement total des travaux">de l’achèvement total des travaux</option>
                            <option value="de la réception du devis et du cadre de contribution avant l’engagement des travaux">de la réception du devis et du cadre de contribution avant l’engagement des travaux</option>
                            <option value="de la réception de la facture.">de la réception de la facture.</option>
                            <option value="que les informations indiquées dans le dossier sont correctes.">que les informations indiquées dans le dossier sont correctes.</option>
                            <option value="que les travaux peuvent faire l’objet d’un éventuel contrôle par un organisme accrédité">que les travaux peuvent faire l’objet d’un éventuel contrôle par un organisme accrédité</option>
                            <option value="En cas de demande, j’autorise l’accès aux travaux.">En cas de demande, j’autorise l’accès aux travaux.</option>
                        </select>

                    @elseif($field->column_value == 'Matériel_existant')
                        <select name="{{ $field->field_name }}" class="select2_select_option custom-select shadow-none form-control">
                            <option value="">{{ __('Select') }}</option>
                            <option value="de l’achèvement total des travaux">de l’achèvement total des travaux</option>
                            <option value="de la réception du devis et du cadre de contribution avant l’engagement des travaux">de la réception du devis et du cadre de contribution avant l’engagement des travaux</option>
                            <option value="de la réception de la facture.">de la réception de la facture.</option>
                            <option value="que les informations indiquées dans le dossier sont correctes.">que les informations indiquées dans le dossier sont correctes.</option>
                            <option value="que les travaux peuvent faire l’objet d’un éventuel contrôle par un organisme accrédité">que les travaux peuvent faire l’objet d’un éventuel contrôle par un organisme accrédité</option>
                            <option value="En cas de demande, j’autorise l’accès aux travaux.">En cas de demande, j’autorise l’accès aux travaux.</option>
                        </select> 
                    @elseif ($field->field_name == 'TRAVAUX1' || $field->field_name == 'TRAVAUX2' || $field->field_name == 'TRAVAUX3' || $field->field_name == 'TRAVAUX4' || $field->field_name == 'TRAVAUX5')
                    <select name="{{ $field->field_name }}" class="select2_select_option custom-select shadow-none form-control">
                        <option value="">{{ __('Select') }}</option>
                        @foreach ($bareme_travaux_tags as $travaux) 
                            <option value="{{ $travaux->travaux }}">{{ $travaux->travaux }}</option>
                        @endforeach
                    </select>
                    @else
                        <input type="text" name="{{ $field->field_name }}" id="document_field{{ $field->id }}" class="form-control shadow-none">
                    @endif
                @else
                    <input type="{{ $field->field_type }}"
                    @if ($field->column_value)
                        @if ($field->column_value == 'Avis_Fiscal_2') 
                            @foreach ($project->allTaxs as $tax_project)
                                @if ($loop->index == 1)
                                    value="{{ $tax_project->tax_number .' / '. $tax_project->tax_reference }}"
                                @endif
                            @endforeach
                        @else
                            @switch($field->column_value)
                                @case('full_name')
                                    value="{{ $project->Prenom.' '.$project->Nom }}"
                                    @break
                                @case('installer_technique')
                                    value="{{ $project->getIntervention->where('type', 'Installation')->first() ?  ($project->getIntervention->where('type', 'Installation')->first()->getUser->name ?? '') : '' }}"
                                    @break
                                @case('date_intervention')
                                    value="{{ $project->getIntervention->where('type', 'Installation')->first() ?  $project->getIntervention->where('type', 'Installation')->first()->Date_intervention : '' }}"
                                    @break
                                @case('dossier_number')
                                    value="{{ $project->getSubventions->first() ?  $project->getSubventions->first()->numero_de_dossier : '' }}"
                                    @break
                                @case('Numéro_fiscal')
                                    value="{{ $project->primaryTax ?  $project->primaryTax->tax_number : '' }}"
                                    @break
                                @case('Référence_avis')
                                    value="{{ $project->primaryTax ?  $project->primaryTax->tax_reference : '' }}"
                                    @break
                                @case('Avis_Fiscal_1')
                                    value="{{ $project->primaryTax ?  $project->primaryTax->tax_number .' / '. $project->primaryTax->tax_reference : '' }}"
                                    @break
                                @case('Code_postal_Ville')
                                    value="{{ $project->Code_Postal.' '.$project->Ville }}"
                                    @break
                                @default 
                                    value="{{ $project->$column }}"
                            @endswitch
                        @endif
                    @endif
                    name="{{ $field->field_name }}" id="document_field{{ $field->id }}" {{ $field->field_type == 'number' ? 'step=any':'' }} class="form-control shadow-none {{ $field->field_type == 'date' ? 'flatpickr flatpickr-input':'' }}" placeholder="{{ $field->field_type == 'date' ? 'dd/mm/yyyy':'' }}">
                @endif
            </div>
        </div>
    @endif
@endforeach
