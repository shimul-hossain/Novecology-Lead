<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -47</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-47/pdf_assets/css/style.css' }}">
    {{-- <link rel="stylesheet" href="{{ asset('crm_assets/pdf_assets/pdf-47/pdf_assets/css/style.css') }}"> --}}
</head>
<body>
    <div class="page">
        <div class="main">
            <div class="side-img">
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-left-side-img.png' }}" alt="left-side-img">
                {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-left-side-img.png') }}" alt="left-side-img"> --}}
            </div>
            <div class="container">
                <!-- header area start -->
                <div class="header-logo-area">
                    <div class="logo-item top-left-logo">
                        {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-top-left.png') }}" alt="top-left"> --}}
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-top-left.png' }}" alt="top-left">
                    </div>
                    <div class="logo-item top-right-logo">
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-top-right.png' }}" alt="top-right">
                        {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-top-right.png') }}" alt="top-right"> --}}
                    </div>
                </div>
                <div class="header">
                    <span class="header-title">DÉSIGNATION D’UN REPRESENTANT UNIQUE </span>
                    <span class="header-title">DANS LE CADRE D’UNE DEMANDE DE PRIME DE TRANSITION ENERGETIQUE </span>
                    <span class="header-title">PORTANT SUR UN BIEN EN INDIVISION </span>
                </div>
                <div class="header-pera">
                    <p class="pera">
                        Nous soussignés [Renseigner ci-après les noms, prénoms, date de naissance et lieu de résidence
                        principale (adresse complète) de l’ensemble des indivisaires. Si la propriété comporte plus de 6
                        indivisaires, merci de compléter les mêmes informations en fin d’attestation] :
                    </p>
                </div>
                <!-- header area end -->
    
                <!-- body area start -->
                <p class="dash-field">NOM PRENOM <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_1'] }}</span></p>
                <p class="dash-field">DATE DE NAISSANCE <span class="dash">{{ $data['DATE_DE_NAISSANCE_PROPRIETAIRE_1'] }}</span></p>
                <p class="dash-field">DEMEURANT AU <span class="dash">{{ $data['FULL_ADRESSE_PROPRIETAIRE_1'] }}</span></p>

                <p class="dash-field field-gap">NOM PRENOM <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_2'] }}</span></p>
                <p class="dash-field">DATE DE NAISSANCE <span class="dash">{{ $data['DATE_DE_NAISSANCE_PROPRIETAIRE_2'] }}</span></p>
                <p class="dash-field">DEMEURANT AU <span class="dash">{{ $data['FULL_ADRESSE_PROPRIETAIRE_2'] }}</span></p>

                <p class="dash-field field-gap">NOM PRENOM <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_3'] }}</span></p>
                <p class="dash-field">DATE DE NAISSANCE <span class="dash">{{ $data['DATE_DE_NAISSANCE_PROPRIETAIRE_3'] }}</span></p>
                <p class="dash-field">DEMEURANT AU <span class="dash">{{ $data['FULL_ADRESSE_PROPRIETAIRE_3'] }}</span></p>
 
                <p class="dash-field field-gap">NOM PRENOM <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_4'] }}</span></p>
                <p class="dash-field">DATE DE NAISSANCE <span class="dash">{{ $data['DATE_DE_NAISSANCE_PROPRIETAIRE_4'] }}</span></p>
                <p class="dash-field">DEMEURANT AU <span class="dash">{{ $data['FULL_ADRESSE_PROPRIETAIRE_4'] }}</span></p>

                <p class="dash-field field-gap">NOM PRENOM <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_5'] }}</span></p>
                <p class="dash-field">DATE DE NAISSANCE <span class="dash">{{ $data['DATE_DE_NAISSANCE_PROPRIETAIRE_5'] }}</span></p>
                <p class="dash-field">DEMEURANT AU <span class="dash">{{ $data['FULL_ADRESSE_PROPRIETAIRE_5'] }}</span></p>

                <p class="dash-field field-gap">NOM PRENOM <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_6'] }}</span></p>
                <p class="dash-field">DATE DE NAISSANCE <span class="dash">{{ $data['DATE_DE_NAISSANCE_PROPRIETAIRE_6'] }}</span></p>
                <p class="dash-field">DEMEURANT AU <span class="dash">{{ $data['FULL_ADRESSE_PROPRIETAIRE_6'] }}</span></p>

                <p class="dash-field">
                    Attestons sur l’honneur être propriétaire en indivision du bien situé au <span class="dash"> {{ $data['FULL_ADRESSE'] }}</span>
                </p>
                <span class="dash-field line-break">(mentionner l’adresse du bien appartenant à l’indivision)</span>
                
                <p class="dash-field pera1">Nous avons décidé d’un <span class="text-bold">commun accord :</span></p>
                <ul class="first-page-listing">
                    <li>
                        <a class="dash-field page1-list">d’effectuer des travaux de rénovation énergétique dans ce logement et de faire financer ces
                            travaux par MaPrimeRénov’,</a>
                    </li>
                    <li>
                        <a class="dash-field page1-list">
                            de désigner <span class="dash"></span> [{{ $data['NOM_CLIENT'] }}] aux fins de déposer en notre nom à tous
                            une demande de prime n° MPR-<span class="dash"></span> [{{ $data['NUMERO_DOSSIER'] }}] et de percevoir le bénéfice de cette même prime.
                        </a>
                    </li>
                </ul>
    
                    <div class="footer-img">
                        {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-footer-logo.png') }}" alt="footer-logo"> --}}
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-footer-logo.png' }}" alt="footer-logo">
                    </div>
                    <span class="footer-page-no">1</span>
                <!-- body area end -->
            </div>
        </div>
    </div>    
    <div class="page">
        <div class="main">
            <div class="container">
                <!-- body area start -->
                <p class="dash-field">
                    Nous nous engageons collectivement à respecter les engagements liés au bénéfice de la prime, à savoir
                    [cochez la case appropriée] :
                </p>
                <div class="page2-checkbox">
                    <div class="box"></div>
                    <div class="box-pera">
                        <p class="dash-field">
                            <span class="text-bold">si la demande de prime a été déposée en tant que propriétaire occupant,</span> à ce qu’au moins un des
                            indivisaires occupe le logement dans les 6 mois après la réalisation des travaux,
                        </p>
                    </div>
                </div>
                <div class="page2-checkbox">
                    <div class="box1"></div>
                    <div class="box-pera">
                        <p class="dash-field">
                            <span class="text-bold">si la demande de prime a été déposée en tant que propriétaire bailleur, </span>à :
                        </p>
                        <p class="dash-field">
                            <span class="dash-field line-break">
                                • louer à titre de résidence principale le logement rénové pendant une durée minimale de 5 ans à
                                partir de la demande de paiement de la prime ;
                            </span>
                            • avoir un locataire dans ce logement au plus tard dans les 6 mois suivant la date de paiement du
                            solde de la prime MaPrimeRénov ;
                            <span class="dash-field line-break">
                                • informer mon locataire de la réalisation de travaux financés par la prime ;
                            </span>    
                            • dans le cas d’une éventuelle réévaluation du montant du loyer, déduire le montant de la prime
                            du montant des travaux d’amélioration ou de mise en conformité justifiant cette réévaluation du
                            montant du loyer
                        </p>
                    </div>
                </div>
                <p class="dash-field">
                    Nous reconnaissons n’avoir déposé qu’une seule demande de prime pour le bien indivis et qu’aucune
                    autre demande n’est en cours. 
                </p>
                <p class="dash-field pera2">
                    Nous sommes informé(e)s que :
                </p>
                <p class="dash-field pera3">
                    <span class="dash-field line-break">
                        • tout ou partie du montant de la prime pourra nous être retiré en cas de non-respect de ces
                        engagements et de la réglementation en vigueur notamment de la limite de trois logements visées à
                        l’article 3 VII du décret n°2020-26 du 14 janvier 2020 modifié ou en cas de fraude ou de tentative de
                        fraude ;
                    </span>
                    • nous nous exposons à une sanction financière pouvant aller jusqu’à la moitié du montant de la
                    prime et à l’interdiction de déposer un dossier auprès de l’Anah pour une durée maximale de cinq
                    ans, en application du II de l’article 15 modifié de la loi n° 1479 du 28 décembre 2019, ainsi qu’à des
                    poursuites judiciaires en cas de fausse déclaration, de fraude ou de tentative de fraude.
                </p>
                <p class="dash-field pera4">
                    Nous certifions l’exactitude des renseignements portés sur la présente attestation. 
                </p>
                <p class="dash-field pera5">
                    Fait à <span class="dash">{{ $data['Fait_à'] }}</span>,
                </p>
                <p class="dash-field">
                    le<span class="dash">{{ $data['Le'] }}</span>
                </p>

                <div class="page2-field">
                    <div class="left">
                        <p class="dash-field">Nom, prénom, signature</p>
                        <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_1'] }}</span>
                        <p class="dash-field pera6">Nom, prénom, signature</p>
                        <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_2'] }}</span>
                        <p class="dash-field pera7">Nom, prénom, signature</p>
                        <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_3'] }}</span>
                    </div>
                    <div class="right">
                        <p class="dash-field">Nom, prénom, signature</p>
                        <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_4'] }}</span>
                        <p class="dash-field pera8">Nom, prénom, signature</p>
                        <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_5'] }}</span>
                        <p class="dash-field pera9">Nom, prénom, signature</p>
                        <span class="dash">{{ $data['NOM_PRENOM_PROPRIETAIRE_6'] }}</span>
                    </div>
                </div>
                <p class="dash-field">Le cas échéant, liste complétée des membres de l’indivision (nom, prénom, date de naissance et adresse) :</p>
                    <div class="footer-img">
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-footer-logo.png' }}" alt="footer-logo">
                        {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-47/pdf_assets/images/pdf-44-footer-logo.png') }}" alt="footer-logo"> --}}
                    </div>
                    <span class="footer-page-no">2</span>
                <!-- body area end -->
            </div>
        </div>
    </div> 
    <script>
        window.print();
    </script>   
</body>
</html>