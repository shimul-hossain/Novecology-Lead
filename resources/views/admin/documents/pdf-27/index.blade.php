<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -27</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-27/pdf_assets/css/style.css' }}">
    {{-- <link rel="stylesheet" href="{{ asset('crm_assets/pdf_assets/pdf-27/pdf_assets/css/style.css') }}"> --}}
</head>
<body>
    <div class="page">
        <div class="overlay-text">
            <!-- header area start -->
            <div class="header-area">
                <p class="title text-bold">NOVECOLOGY</p>
                <p class="title1 text-bold">(Siret : 84994780900026) </p>
                <p class="title1 text-bold">{{ $data['NOM_CLIENT'] }}</p>
                <p class="title1" style="white-space: pre-line;">{{ $data['FULL_ADRESSE'] }}</p> 
            </div>
            <!-- header area end -->

            <!-- text area start -->

            <div class="text-area">
                <p class="pera">Entreprise titulaire de la qualification</p>
                <h2 class="title2 text-bold">QualiPAC module chauffage et ECS</h2>
                <p class="pera">Engagée pour la qualité d’installation des pompes à chaleur aérothermiques et
                    géothermiques ainsi que les chauffe-eau thermodynamiques</p>
                <p class="text-italic pera1">Période couverte par le certificat : 04 septembre 2022 au 04 septembre 2023</p>
                <p class="small-text">Police d'assurance responsabilité civile</p>
                <p class="small-text">- générale au 18/01/2022 : SV750220721/05052 - ERGO VERSICHERUNG</p>
                <p class="small-text">- décennale au 18/01/2022 : SV750220721/05052 - ERGO VERSICHERUNG</p>
            </div>

            <div class="arrow-area">
                <h3 class="title3">Numéro QualiPAC : QPAC/59003</h3>
                <p class="small-text">Forme juridique : SAS</p>
                <p class="small-text">L'entreprise s'engage à renouveler toute assurance obligatoire pendant la durée de son engagement</p>
                <p class="small-text pera2">Fait le 10 août 2022</p>
            </div>

            <div class="sig-text">
                <p class="pera text-bold">Gaël Parrens</p>
                <p class="text-italic sig">Président de l'instance de</p>
                <p class="text-italic sig">qualification</p>
            </div>
            <p class="small-text pera3">Grâce au site <a class="link" href="https://www.qualit-enr.org">www.qualit-enr.org</a>, rubrique « Annuaire » contrôlez en continu la qualification de l'entreprise</p>
            <div class="enr">
                <p class="pera pera4 text-italic text-bold">Association Qualité Energies Renouvelables</p>
                <p class="small-text pera5">Siège social</p>
                <p class="pera">24 rue Saint-Lazare <span class="pera pera6">75009 PARIS</span></p>
                <p class="pera">SIRET 489 907 360 00049</p>
                <p class="small-text pera7"><span class="text-bold">QualiPAC</span> est un signe de qualité géré par <span class="text-bold">Qualit'EnR.</span></p>
                <p class="extra-small-text">L'association Qualit'EnR est propriétaire de la marque collective communautaire QUALIPAC n° 009007105 déposée dans les classes 11, 35, 37, 38, 41 et 42</p>
            </div>
            <p class="extra-small-text pera8">Le présent certificat couvre les périodes de validité précisées ci-dessus pour chaque qualification, sous réserve du respect des conditions définies dans le règlement d’usage des
                qualifications. La qualification est délivrée pour une durée de deux ou quatre ans décomposée en 2 ou 4 certificats de 12 mois délivrés après contrôle du respect des exigences
                définies dans les règlements d'usage. L'échéance de chaque qualification est : 04 septembre 2023 pour QualiPAC module chauffage et ECS
            </p>

            <!-- text area end -->
        </div>
        <p class="pera9 text-italic text-bold">FR-APP-05 Rev18 – Novembre 2021</p>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>