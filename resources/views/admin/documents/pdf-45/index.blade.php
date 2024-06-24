<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -45</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-45/pdf_assets/css/style.css' }}">
    {{-- <link rel="stylesheet" href="{{ asset('crm_assets/pdf_assets/pdf-45/pdf_assets/css/style.css') }}"> --}}
</head>
<body>
    <div class="page">
        <div class="main">
            <div class="side-img">
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-left-side-img.png' }}" alt="left-side-img">
                {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-left-side-img.png') }}" alt="left-side-img"> --}}
            </div>
            <div class="container">
                <!-- header area start -->
                <div class="header-logo-area">
                    <div class="logo-item top-left-logo">
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-top-left.png' }}" alt="top-left">
                        {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-top-left.png') }}" alt="top-left"> --}}
                    </div>
                    <div class="logo-item top-right-logo">
                        {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-top-right.png') }}" alt="top-right"> --}}
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-top-right.png' }}" alt="top-right">
                    </div>
                </div>
                <div class="header">
                    <span class="header-title">ATTESTATION DE CONSENTEMENT</span>
                    <span class="header-title">À LA DEMANDE DE PRIME MAPRIMERÉNOV’</span>
                </div>
                <div class="header-two">
                    <span class="header-sub-title"><span class="text-color">•</span> Préalable à la validation de l’octroi de la prime MaPrimeRénov’</span>
                </div>
                <div class="header-pera">
                    <p class="pera">
                        Ce document a pour objectif de vérifier que vous êtes bien à l’origine de la demande de prime
                        MaPrimeRénov’ déposée en votre nom. <span class="text-bold">Si vous n’êtes pas à l’origine de cette demande de prime,</span> nous
                        vous invitons à nous le signaler par retour de mail.
                    </p>
                </div>
                <!-- header area end -->
    
                <!-- body area start -->
                <p class="field-title line-break pera6">Je, soussigné(e):</p>
                 <p class="dash-field">Nom: <span class="dash">{{ $data['Nom'] }}</span> <span class="first-filed">Prénom:</span> <span class="dash">{{ $data['Prénom'] }}</span></p>   
                <p class="dash-field">Demeurant au: <span class="dash">{{ $data['FULL_ADRESSE'] }}</span></p>
                <span class="field-title"><span class="text-color">•</span> Atteste sur l’honneur :</span>
                <p class="dash-field text-bold">– Avoir créé moi-même un dossier sur la plateforme <span class="text-color">maprimerenov.gouv.fr</span></p>
                <p class="dash-field">– Pour rénover mon logement <span class="text-bold">situé au:</span><span class="dash">{{ $data['FULL_ADRESSE2'] }}</span></p>
                <p class="dash-field">– Connaître mon <span class="text-bold">numéro de dossier</span> <span class="text-color">MaPrimeRénov’</span><span class="text-bold">: </span><span class="dash">{{ $data['NUMERO_DOSSIER'] }}</span></p>
                <p class="dash-field">– Que la prime <span class="text-color">MaPrimeRénov’</span> va me permettre de <span class="text-bold">financer les travaux suivants:</span></p>
                <p class="dash-field">• Travaux 1 <span class="dash">{{ $data['TRAVAUX1'] }}</span></p>
                <p class="dash-field">• Travaux 2 <span class="dash">{{ $data['TRAVAUX2'] }}</span></p>
                <p class="dash-field">• Travaux 3 <span class="dash">{{ $data['TRAVAUX3'] }}</span></p>
                <p class="dash-field">• Travaux 4 <span class="dash">{{ $data['TRAVAUX4'] }}</span></p>
                <p class="dash-field">• Travaux 5 <span class="dash">{{ $data['TRAVAUX5'] }}</span></p>
                <p class="dash-field">– Par <span class="text-bold">les ou l’entreprise(s)</span> qui a (ont) émis le devis :</p>
                <div class="enterprise">
                    <div class="enterprise-item">
                        <p class="dash-field">• Entreprise 1: Nom: <span class="dash">{{ $data['Entreprise_1_Nom'] }}</span></p>
                    </div>
                    <div class="enterprise-item">
                        <p class="dash-field">N° de SIRET: <span class="dash">{{ $data['Entreprise_1_de_SIRET'] }}</span></p>
                    </div>
                </div>
                <div class="enterprise">
                    <div class="enterprise-item">
                        <p class="dash-field">• Entreprise 2: Nom: <span class="dash">{{ $data['Entreprise_2_Nom'] }}</span></p>
                    </div>
                    <div class="enterprise-item">
                        <p class="dash-field">N° de SIRET: <span class="dash">{{ $data['Entreprise_2_de_SIRET'] }}</span></p>
                    </div>
                </div>
                <div class="enterprise">
                    <div class="enterprise-item">
                        <p class="dash-field">• Entreprise 3: Nom: <span class="dash">{{ $data['Entreprise_3_Nom'] }}</span></p>
                    </div>
                    <div class="enterprise-item">
                        <p class="dash-field">N° de SIRET: <span class="dash">{{ $data['Entreprise_3_de_SIRET'] }}</span></p>
                    </div>
                </div>
                <p class="dash-field">– Pour un <span class="text-bold">montant total TTC</span> de: <span class="dash">{{ frenceNumberFormat($data['montant_total_TTC']) }} </span> €</p>
                <p class="dash-field">– Que le <span class="text-bold">montant qui restera à ma charge,</span> une fois toutes les aides déduites, s’élèvera à: <span class="dash">{{ frenceNumberFormat($data['montant_qui_restera_à_ma_charge']) }} </span> €</p>
                <p class="field-title"><span class="text-color">•</span> Avoir mandaté un mandataire <span class="pera1">(cocher la case correspondant à votre situation):</span></p>
                <div class="check-div"> 
                    <div class="checkbox">@if (isset($data['Avoir_mandaté_un_mandataire']) && in_array('un mandataire ADMINISTRATIF', $data['Avoir_mandaté_un_mandataire']))&times;@endif</div>
                    <p class="text-bold check-pera dash-field">
                        un mandataire ADMINISTRATIF <span class="pera1"> 
                            (le mandataire effectue les démarches administratives sur la plateforme 
                            <span class="text-color pera2">maprimerenov.gouv.fr</span> à ma place)</span>
                    </p>
                </div>
                <div class="check-div">
                    <div class="checkbox">@if (isset($data['Avoir_mandaté_un_mandataire']) && in_array('un mandataire FINANCIER', $data['Avoir_mandaté_un_mandataire']))&times;@endif</div>
                    <p class="text-bold check-pera dash-field">
                        un mandataire FINANCIER <span class="pera1"> 
                            (le mandataire perçoit la prime <span class="text-color pera2">MaPrimeRénov’</span> à ma place)
                    </p>
                </div>
                <div class="check-div">
                    <div class="checkbox">@if (isset($data['Avoir_mandaté_un_mandataire']) && in_array('un mandataire MIXTE ADMINISTRATIF ET FINANCIER', $data['Avoir_mandaté_un_mandataire']))&times;@endif</div>
                    <p class="text-bold check-pera dash-field">
                        un mandataire MIXTE ADMINISTRATIF ET FINANCIER <span class="pera1"> 
                            (le mandataire effectue les démarches administratives
                            sur la plateforme <span class="text-color pera2">maprimerenov.gouv.fr</span> ET perçoit la prime à ma place)
                    </p>
                </div>
                <p class="dash-field">
                    Nous vous rappelons que pour désigner un mandataire, <span class="text-bold">vous devez avoir rempli, signé et téléversé dans votre dossier de
                        demande de prime le mandat disponible ici:</span> <a class="pdf-link text-color" href="https://www.anah.fr/fileadmin/user_upload/cerfa-mandat-general-MPR.pdf">https://www.anah.fr/fileadmin/user_upload/cerfa-mandat-general-MPR.pdf</a>
                </p>
                <p class="dash-field">
                    Je suis informé(e) que <span class="text-bold">si je ne complète pas toutes les informations demandées</span> dans cette attestation de consentement,
                    ma <span class="text-bold">demande de prime sera rejetée.</span>
                </p>
                <p class="dash-field">Je certifie l’exactitude des renseignements portés sur la présente attestation. </p>
                <p class="dash-field text-bold pera2">Fait à <span class="dash">{{ $data['Fait_à'] }}</span>, <span class="dash-field text-bold pera3">le <span class="dash">{{ $data['Le'] }}</span></span></p>
                <p class="dash-field text-bold pera4">Nom, prénom et signature* <span class="dash">.....................................</span></p>
                <div class="footer-img">
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-footer-logo.png' }}" alt="footer-logo">
                    {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-45/pdf_assets/images/pdf-44-footer-logo.png') }}" alt="footer-logo"> --}}
                </div>
                <!-- body area end -->
            </div>
            <div class="side-text ">
                <p class="dash-field pera5">*Signature manuscrite obligatoire</p>
            </div>
        </div>

    <script>
        window.print();
    </script>
</body>
</html>