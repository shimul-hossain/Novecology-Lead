<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
       .print-btn {
        font-size: 18px;
        padding: 10px 25px;
        cursor: pointer;
        margin-top: 50px;
        }

        @media print {
        .print-btn {
            display: none;
        }
        }

        /* PDF Page CSS Style */
        /* Reset CSS */
        * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
        margin: 0;
        padding: 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        }

        @page {
        size: A4;
        margin-left: 0px;
        margin-right: 0px;
        margin-top: 0px;
        margin-bottom: 0px;
        margin: 0px;
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
        }

        @media print {
        html {
            font-size: 14px;
        }
        }

        @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
        }

        body {
        color: #281d26;
        font-size: 1rem;
        font-family: sans-serif;
        font-weight: 400;
        width: 100%;
        max-width: 210mm;
        margin: auto;
        }

        @media screen {
        body {
            padding: 50px 0;
        }
        }

        img {
        max-width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        }

        a {
        display: inline-block;
        text-decoration: none;
        }

        ul {
        list-style-type: none;
        }

        address {
        font-style: normal;
        }

        table, figure {
        page-break-inside: avoid;
        }

        .row {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-flex-wrap: wrap;
            -ms-flex-wrap: wrap;
                flex-wrap: wrap;
        }

        .col-6 {
        width: 100%;
        }

        @media (min-width: 576px) {
        .col-6 {
            width: 50%;
        }
        }

        .col-12 {
        width: 100%;
        }

        .mt-20 {
        margin-top: 20px;
        }

        .form-group {
        margin-bottom: 18px;
        }

        .page-logo {
        display: none;
        margin-bottom: 30px;
        }

        @media print {
        .page-logo {
            display: block;
        }
        }

        .text-center {
        text-align: center;
        }

        @media (min-width: 576px) {
        .col-6 .pdf-card__text {
            padding-left: 20px;
        }
        }

        .pdf-page {
        page-break-after: always;
        }

        @media print {
        .pdf-page {
            padding: 30px 30px 10px;
        }
        }

        .pdf-card__head {
        background-color: #f5deb3;
        margin-bottom: 25px;
        }

        .pdf-card__head--blue {
        background-color: #1e90ff;
        }
        .pdf-card__head--green {
        background-color: #8fbc8f;
        }
        .pdf-card__head--orange {
        background-color: #ffa07a;
        }
        .pdf-card__head--pink {
        background-color: #ff69b4;
        }
        .pdf-card__head--yellow {
        background-color: #eee8aa;
        }

        .pdf-card__title {
        font-size: 16px;
        }

        .pdf-card__text {
        color: #645f5d;
        font-size: 16px;
        font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="pdf-page">
        <div class="pdf-card">
            <div class="pdf-card__head pdf-card__head--blue text-center">
                <h3 class="pdf-card__head__title">Contrôle Qualité</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Date Controle Qualité</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->quality_control_date2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Operateur</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->operator2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Nom & Prénom Client</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->client_name2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Code Postal</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->postal_code2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Date Pose</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->installed_date }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Projet</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->project2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Poseur</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->installer }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Si AUTRE, précisez :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->other_installer }}</p>
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Commercial</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->commercial2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Si autre, précisez</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->other_commercial }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">1) êtes satisfait de la pose ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->satisfied }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">2) êtes satisfait du matériel installé ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->equipment_installed }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">6) Évaluation globale (de 1 à 10) à l'ensemble de la prestation (accueil et explication du commercial, présentation du technicien, pose de la chaudière)</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->evaluation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Si note inférieur à 7, merci de demander la raison</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->score }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Recommanderiez vous Novecology ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->recommend }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center pdf-card__head--green">
                <h3 class="pdf-card__head__title">MAPRIMERENOV</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Savez vous que MPR va vous recontacter ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->mpr_contact }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">1. Validation identitá. Confirmez votre identité ?</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Réponse bénéficiaire</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->address_validation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title"> 2 - Validation dossier : Etes vous bien à l'origine du dossier ?</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Réponse bénéficiaire</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->file_validation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title"> 3- Validation adresse: Pouvez vous me confirmer l'adresse où à eu lieu les travaux ?</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Adresse est elle identique entre facturation et celle des travaux?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->address_validation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title"> 4- Validation entreprise : Pouvez vous me confirmer quel entreprise a réalisé les travaux ?</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Réponse bénéficiaire</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->company_validation }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="pdf-page">
        <img src="{{ asset('logo_pdf.png') }}" alt="logo" class="page-logo">
        <div class="pdf-card">
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title"> Si AUTRE, précisez :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->other_validation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">  5 - Validation travaux : Pouvez vous me confirmer les travaux que vous avez réalisé ?</h4>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title"> Réponse bénéficiaire</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->work_validation }}</p>
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">  6 - Validation mandataire : Pouvez vous me confirmer votre mandataire ?</h4>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title"> Réponse bénéficiaire</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->proxy_validation }}</p>
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Commentaires</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->validation_comment }}</p>
                        </div>
                    </div>
                </div> 
            </div>
            
            <div class="pdf-card__head pdf-card__head--orange">
                <h3 class="pdf-card__head__title">Explication rôle Mandataire Axdis</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">7- Validation montant travaux : Pouvez vous me confirmer le montant des travaux que vous avez réalisé ?</h4>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">INFORMER LE BENEFICIAIRE QU'IL RECEVRA SA FACTURE SOUS 10 JOURS PAR EMAIL</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->amount_validation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">8 - Validation montant Reste à charge : Pouvez vous me confirmer le montant de votre reste à charge ?</h4>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Réponse bénéficiaire</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->expense_validation }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pdf-card__head pdf-card__head--orange">
                <h3 class="pdf-card__head__title">1&euro; Interdit - Attesation confidentiel</h3>
            </div>
            <div class="pdf-card__head text-center pdf-card__head--yellow">
                <h3 class="pdf-card__head__title">Merci d'informer le client sur les informations suivantes</h3>
            </div>
            <div class="pdf-card__body"> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">1) Le client a 7 jours pour répondre à MPR</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text"> <input type="checkbox" @if ($postInstallation->client_respond == '1')
                                checked
                            @endif> </p>
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title"> 2)  NOVECOLOGY ne sera pas payer sans le consentement</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text"><input type="checkbox" @if ($postInstallation->paid_consent == '1')
                                checked
                            @endif></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title"> 3) En cas de doute sur les réponses, le client doit nous appeler </h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text"><input type="checkbox"  @if ($postInstallation->customer_call == '1')
                                checked
                            @endif > </p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title"> 4) Le client recevra sa facture par email sous 10 jours</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text"> <input type="checkbox"  @if ($postInstallation->receive_invoice == '1')
                                checked
                            @endif> </p>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="pdf-card__head text-center pdf-card__head--yellow">
                <h3 class="pdf-card__head__title">-</h3>
            </div>
            <div class="pdf-card__body"> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">SI CLIENT SATISFAIT - Etes vous interessé par nous laisser un avis ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text"> {{ $postInstallation->review }} </p>
                        </div>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title"> Souhaitez vous réaliser un projet d'ITE avec NOVECOLOGY ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text"> {{ $postInstallation->carry_out }} </p>
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="pdf-card__head text-center pdf-card__head--light-yellow">
                <h3 class="pdf-card__head__title">ZONE ITE NOVECOLOGY : 02, 08, 10, 18, 27, 28, 41, 45, 51, 52, 55, 59, 60, 61, 62, 76, 77,78, 80
                    89,91,92,93,94,95</h3>
            </div>
        </div>
         
    </div>

    <div class="pdf-page">
        <img src="{{ asset('logo_pdf.png') }}" alt="logo" class="page-logo">
        <div class="pdf-card">
            <div class="pdf-card__head text-center pdf-card__head--green">
                <h3 class="pdf-card__head__title">ACTION LOGEMENT</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Etes vous informé que Action Logement Non va vous contacter ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->action_logement }}</p>
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="pdf-card__head text-center pdf-card__head--green">
                <h3 class="pdf-card__head__title">-</h3>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center pdf-card__head--pink">
                <h3 class="pdf-card__head__title">FINANCEMENT</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Savez vous que MaPrimeRenov va vous contacter ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->contact_us }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <small class="pdf-card__text">Informer le client que MaPrimeRenov va le contacter pour avoir son consentement pour le déblocage des fonds</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Savez vous que l'organisme qui a financé votre installation va vous contacter prochainement ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->contact_soon }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <small class="pdf-card__text">Informer le client que l'organisme va le contacter prochainement pour avoir un contrôle qualité de l'installation, avoir votre avis sur la société Novecology, et valider le déblocage des fonds.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Est ce que vous validez le déblocage des fonds ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->release_fund }}</p>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="pdf-card__head text-center pdf-card__head--pink">
                <h3 class="pdf-card__head__title text">.</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">observations generales</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $postInstallation->observations }}</p>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
 


<!-- 
    <section>
        <button type="button" class="print-btn">Click to Print</button>
    </section>

    <script>
        document.querySelector("button").addEventListener('click', () => {
            window.print();
        });
    </script> -->
    <script>
        window.print();
    </script> 

</body>
</html>