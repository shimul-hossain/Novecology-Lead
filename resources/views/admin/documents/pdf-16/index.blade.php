<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -16</title>
    {{-- <link rel="stylesheet" href="{{ asset('crm_assets/pdf_assets/pdf-16/pdf_assets/css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-16/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page">
        <div class="container">
            <!-- header area start -->
            <div class="header-area">
                <h2 class="header">ATTESTATION DE MISE EN SERVICE</h2>
            </div>
            <!-- header area end -->

            <!-- body area start -->

            <div class="box">
                <p class="pera">Société : <span class="dash">{{ $data['MAÎTRE_Société'] }}</span></p>
                <p class="pera">Nom du correspondant : <span class="dash">{{ $data['MAÎTRE_Nom_du_correspondant'] }}</span></p>
                <p class="pera">Adresse : <span class="dash">{{ $data['MAÎTRE_Adresse'] }}</span></p>
                <div class="d-flex">
                    <div class="field1">
                        <p class="pera">Code postal : <span class="dash">{{ $data['MAÎTRE_Code_postal'] }}</span></p>
                    </div>
                    <div class="field2">
                        <p class="pera">Ville : <span class="dash">{{ $data['MAÎTRE_Ville'] }}</span></p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="field1">
                        <p class="pera">Téléphone : <span class="dash">{{ $data['MAÎTRE_Téléphone'] }}</span></p>
                    </div>
                    <div class="field2">
                        <p class="pera">Portable : <span class="dash">{{ $data['MAÎTRE_Portable'] }}</span></p>
                    </div>
                </div>
                <p class="pera">E-mail : <span class="dash">{{ $data['MAÎTRE_Email'] }}</span></p>
                <p class="pera">L’installateur atteste que le matériel ci-après désigné a été mis en service le : <span class="dash">{{ $data['MAÎTRE_Linstallateur_atteste'] }}</span></p>
                <div class="egg">
                    <p class="egg-text text-bold">MAÎTRE <br> D'ŒUVRE</p>
                </div>
            </div>
            <div class="box">
                <p class="pera">Société : <span class="dash">{{ $data['mise_en_Société'] }}</span></p>
                <p class="pera">Nom du correspondant : <span class="dash">{{ $data['mise_en_Nom_du_correspondant'] }}</span></p>
                <p class="pera">Adresse : <span class="dash">{{ $data['mise_en_Adresse'] }}</span></p>
                <div class="d-flex">
                    <div class="field1">
                        <p class="pera">Code postal : <span class="dash">{{ $data['mise_en_Code_postal'] }}</span></p>
                    </div>
                    <div class="field2">
                        <p class="pera">Ville : <span class="dash">{{ $data['mise_en_Ville'] }}</span></p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="field1">
                        <p class="pera">Téléphone : <span class="dash">{{ $data['mise_en_Téléphone'] }}</span></p>
                    </div>
                    <div class="field2">
                        <p class="pera">Portable : <span class="dash">{{ $data['mise_en_Portable'] }}</span></p>
                    </div>
                </div>
                <p class="pera">L’installateur atteste que le matériel ci-après désigné a été mis en service le : <span class="dash">{{ $data['mise_en_Linstallateur_atteste'] }}</span></p>
                <div class="egg">
                    <p class="egg-text text-bold">MISE EN <br> PLACE PAR</p>
                </div>
            </div>
            <div class="box">
                <p class="pick-line-text">Adresse de l’intervention</p>
                <div class="d-flex">
                    <div class="field1">
                        <p class="pera">Nom : <span class="dash">{{ $data['BÉNÉFICIAIRE_Nom'] }}</span></p>
                    </div>
                    <div class="field2">
                        <p class="pera">Prénom : <span class="dash">{{ $data['BÉNÉFICIAIRE_Prénom'] }}</span></p>
                    </div>
                </div>
                <p class="pera">Adresse : <span class="dash">{{ $data['BÉNÉFICIAIRE_Adresse'] }}</span></p>
                <div class="d-flex">
                    <div class="field1">
                        <p class="pera">Code postal : <span class="dash">{{ $data['BÉNÉFICIAIRE_Code_postal'] }}</span></p>
                    </div>
                    <div class="field2">
                        <p class="pera">Ville : <span class="dash">{{ $data['BÉNÉFICIAIRE_Ville'] }}</span></p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="field1">
                        <p class="pera">Téléphone : <span class="dash">{{ $data['BÉNÉFICIAIRE_Téléphone'] }}</span></p>
                    </div>
                    <div class="field2">
                        <p class="pera">Portable : <span class="dash">{{ $data['BÉNÉFICIAIRE_Portable'] }}</span></p>
                    </div>
                </div>
                <p class="pera">E-mail : <span class="dash">{{ $data['BÉNÉFICIAIRE_Email'] }}</span></p>
                <div class="egg box-3-egg">
                    <p class="egg-text text-bold">BÉNÉFICIAIRE</p>
                </div>
            </div>
            <div class="box box-4">
                <p class="pera text-bold pera1">Matériel existant :</p>
                <div class="check">
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_existant']))&times;@endif</span>
                        <span class="pera d-inline">Le bénéficiaire atteste que la chaudière existante n’est pas une chaudière gaz à condensation</span>
                    </div>
                </div>
                <p class="pera text-bold pera1">Matériel posé :</p>
                <div class="d-flex">
                    <div class="check">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_posé']) && in_array('Pompe à chaleur (BAR-TH-104 / 129)', $data['Matériel_posé']))&times;@endif</span>
                            <span class="pera d-inline">Pompe à chaleur 
                                <span class="small-text">(BAR-TH-104 / 129)</span>
                            </span>
                        </div>
                    </div>
                    <div class="check check1">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_posé']) && in_array('Chaudière (BAR-TH-106)', $data['Matériel_posé']))&times;@endif</span>
                            <span class="pera d-inline">Chaudière 
                                <span class="small-text">(BAR-TH-106)</span>
                            </span>
                        </div>
                    </div>
                    <div class="check">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_posé']) && in_array('Chauffe-eau thermodynamique (BAR-TH-148)', $data['Matériel_posé']))&times;@endif</span>
                            <span class="pera d-inline">Chauffe-eau thermodynamique 
                                <span class="small-text">(BAR-TH-148)</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="check">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_posé']) && in_array('Chauffe-eau solaire indiv (BAR-TH-101)', $data['Matériel_posé']))&times;@endif</span>
                            <span class="pera d-inline">Chauffe-eau solaire indiv 
                                <span class="small-text">(BAR-TH-101)</span>
                            </span>
                        </div>
                    </div>
                    <div class="check">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_posé']) && in_array('Système de ventilation (BAR-TH-125/127)', $data['Matériel_posé']))&times;@endif</span>
                            <span class="pera d-inline">Système de ventilation 
                                <span class="small-text">(BAR-TH-125/127)</span>
                            </span>
                        </div>
                    </div>
                    <div class="check">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_posé']) && in_array('Poêle à granules (BAR-TH-112)', $data['Matériel_posé']))&times;@endif</span>
                            <span class="pera d-inline">Poêle à granules 
                                <span class="small-text">(BAR-TH-112)</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="check">
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_posé']) && in_array('Chaudière biomasse (BAR-TH-113)', $data['Matériel_posé']))&times;@endif</span>
                        <span class="pera d-inline">Chaudière biomasse 
                            <span class="small-text">(BAR-TH-113)</span>
                        </span>
                    </div>
                </div>
                <p class="pera">Type : <span class="dash">{{ $data['Matériel_type'] }}</span></p>
                <p class="pera pera2">Date de première mise en route : <span class="dash">{{ $data['Matériel_Date_de_première_mise_en_route'] }}</span></p>
                <div class="d-flex">
                    <p class="pera">Problèmes éventuels :</p>
                    <div class="check check2">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_Problèmes_éventuels']) && $data['Matériel_Problèmes_éventuels'] == 'Oui')&times;@endif</span>
                            <span class="pera d-inline">Oui</span>
                        </div>
                    </div>
                    <div class="check check2">
                        <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                            <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_Problèmes_éventuels']) && $data['Matériel_Problèmes_éventuels'] == 'Non')&times;@endif</span>
                            <span class="pera d-inline">Non</span>
                        </div>
                    </div>
                    <p class="pera pera3">Si oui, lesquels : <span class="dash"></span></p>
                </div>
                <div class="check check3">
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Matériel_Le_bénéficiaire_atteste']))&times;@endif</span>
                        <span class="pera d-inline">Le bénéficiaire atteste avoir souscrit à une convention de maintenance conformément à la législation en vigueur</span>
                    </div>
                </div>
                <div class="egg box-3-egg">
                    <p class="egg-text text-bold">MATÉRIEL</p>
                </div>
            </div>
            <p class="pera text-bold pera5">A noter :</p>
            <div class="d-flex">
                <div class="dots"></div>
                <p class="pera pera6">L’ensemble des installations doivent être accessibles à hauteur d’homme</p>
            </div>
            <div class="d-flex">
                <div class="dots1"></div>
                <p class="pera pera6">Les demandes seront envoyées à l’installateur par mail à l’adresse indiquée ci-dessus</p>
            </div>
            <div class="d-flex">
                <div class="dots1"></div>
                <p class="pera pera6">Facturation au demandeur : à chaque facture sera joint le rapport d’intervention et un courrier de validation de la mise en service</p>
            </div>

            <div class="d-flex footer-box-gap">
                <div class="footer-box">
                    <div class="box-body">
                        <p class="footer-text text-bold pera7">MAÎTRE D'ŒUVRE</p>
                        <p class="pera text-bold pera7">Nom : <span class="dash">{{ $data['MAÎTRE_Nom_du_correspondant'] }}</span></p>
                        <p class="pera text-bold pera7">Date : <span class="dash">_____________</span></p>
                        <p class="pera text-bold pera7 pera8">Cachet et signature précédés de la mention</p>
                        <p class="text-bold pera9">«bon pour accord»</p>
                    </div>
                </div>
                <div class="footer-box">
                    <div class="box-body">
                        <p class="footer-text text-bold pera7">MISE EN PLACE PAR</p>
                        <p class="pera text-bold pera7">Nom : <span class="dash">{{ $data['mise_en_Nom_du_correspondant'] }}</span></p>
                        <p class="pera text-bold pera7">Date : <span class="dash">_____________</span></p>
                        <p class="pera text-bold pera7 pera8">Cachet et signature précédés de la mention</p>
                        <p class="text-bold pera9">«bon pour accord»</p>
                    </div>
                </div>
                <div class="footer-box">
                    <div class="box-body">
                        <p class="footer-text text-bold pera7">BÉNÉFICIAIRE</p>
                        <p class="pera text-bold pera7">Nom : <span class="dash">{{ $data['BÉNÉFICIAIRE_Nom'] }} {{ $data['BÉNÉFICIAIRE_Prénom'] }}</span></p>
                        <p class="pera text-bold pera7">Date : <span class="dash">_____________</span></p>
                        <p class="pera text-bold pera7 pera8">Cachet et signature précédés de la mention</p>
                        <p class="text-bold pera9">«bon pour accord»</p>
                    </div>
                </div>
            </div>
            <!-- body area end -->
        </div>
    </div>
</body>
</html>