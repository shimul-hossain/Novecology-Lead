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
                            <p class="pdf-card__text">{{ $preInstallation->quality_control_date }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Operateur</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->operator }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Nom & Prénom Client</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->client_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Code Postal</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->postal_code }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Date RDV commercial</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->sales_meeting_date }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Projet</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->project }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Commercial</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->commercial }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center">
                <h3 class="pdf-card__head__title">Introduction</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">OPERATEUR</h4>
                        </div>
                        <div class="col-12 mt-20">
                            <p class="pdf-card__text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod cumque nulla enim esse aperiam impedit sunt, commodi nam nesciunt sequi dignissimos officiis cum nisi, modi voluptates minus minima eveniet eos?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center">
                <h3 class="pdf-card__head__title">PROJET</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">OPERATEUR</h4>
                        </div>
                        <div class="col-12 mt-20">
                            <p class="pdf-card__text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod cumque nulla enim esse aperiam impedit sunt, commodi nam nesciunt sequi dignissimos officiis cum nisi, modi voluptates minus minima eveniet eos?</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">1. Comment s'est déroulé le rendez-vous ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->meeting_experience }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">2. Évaluation globale (de 1 à 10) à l'ensemble de la prestation (prise de contact téléphonique, accueil et explication du commercial, présentation du commercial) </h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->evaluation_rating }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center">
                <h3 class="pdf-card__head__title">HABITATION</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">1. Pourriez-vous me rappeler si vous êtes Propriétaire ou Locataire Si AUTRE, précisez :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->remind_me }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">2. Pourriez-vous me rappeler le nombre ? d'occupants dans le logement ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->occupants_number }}</p>
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
                            <h4 class="pdf-card__title">3. Pourriez-vous me rappeler la date de construction de votre logement ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->home_built_time }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">4. Pourriez-vous me rappeler la surface de votre maison ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->surface }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">5. Pourriez-vous me rappeler le type de chauffage de votre maison ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->heating_type }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">6. Pourriez-vous me rappeler le nombre, de niveaux chauffés ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->heated_levels }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">7. Pourriez-vous me rappeler le type d'émetteurs :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->transmitters_type }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Si AUTRE, précisez :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->other_transmitters_type }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">8. Pourriez-vous me rappeler votre Production d'eau chaude sanitaire</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->hot_water_production }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Si AUTRE, précisez :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->other_hot_water_production }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">9. Pourriez-vous me rappeler si vous avez une isolation au niveau de vos combles ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->have_insulation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">10. Pourriez-vous me rappeler si vous avez une isolation au niveau de vos murs ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->have_insulation_wall }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">11. Pourriez-vous me rappeler si vous avez une isolation au niveau de votre sous sol?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->have_insulation_basement }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center">
                <h3 class="pdf-card__head__title">MATERIEL RECOMMANDE</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">12. Pourriez-vous me préciser le modèle chaudière recommandé ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->boiler_model }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="pdf-card__title">Observations</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">13. Pourriez-vous me préciser le modèle ECS recommandé ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->esc_model }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">14. Pourriez-vous me préciser si le technicien vous à mentionner BioServices ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->bio_services }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">15. Avez-vous d'autres questions au sujet du materiel ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->question_material }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center">
                <h3 class="pdf-card__head__title">CLIENT</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">16. Pourriez-vous me rappeler votre situation professionnelle</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->professional_situation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Si AUTRE, précisez :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->other_professional_situation }}</p>
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
                            <h4 class="pdf-card__title">17. Pourriez-vous me rappeler votre situation familiale</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->family_situation }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">18. Pourriez-vous me rappeler si vous avez des enfants et combien ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->have_children }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">19. Pourriez-vous me rappeler votre revenu mensuel ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->monthly_income }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">20. Pourriez-vous me rappeler si vous avez des crédits actuels ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->current_credits }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">CREDIT 1 (origine, mensualité, date d'échéance)</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->credit_1 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">CREDIT 2 (origine, mensualité, date d'échéance)</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->credit_2 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">CREDIT 3 (origine, mensualité, date d'échéance)</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->credit_3 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">CREDIT 4 (origine, mensualité, date d'échéance)</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->credit_4 }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">21. Pourriez-vous me préciser votre banque ? Depuis quand ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->bank_status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center">
                <h3 class="pdf-card__head__title">FINANCEMENT</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">22. Pourriez-vous me préciser si vous avez un double du BDC ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->have_bdc_copy }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">23. Pourriez-vous me préciser le montant du financement en cas de validation de votre dossier ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->approved_funding }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">24. Pourriez-vous me préciser le nombre de mensualité en cas de validation de votre dossier ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->monthly_payments }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">25. Pourriez-vous me préciser le nom du partenaire dans le financement de votre dossier ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->financing_partner }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">26. Pourriez-vous me préciser le montant du CEE auquel vous avez droit en cas de validation de votre dossier ? </h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->eec_amount }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <small class="pdf-card__text">Notes : Bien préciser que le montant CEE est déduit du BDC</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">27. Pourriez-vous me préciser le montant de la subvention MaPrimeRenov' auquel vous avez le droit en cas de validation de votre dossier</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->renov_amount }}</p>
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
                            <h4 class="pdf-card__title">28. Est-ce que le technicien vous a précisé que la subvention MaPrimeRenov doit être reinjecté à la maison de financement par anticipation pour faire baisser vos mensualités ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->renov_paid }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">29. Est-ce que le technicien vous a bien expliqué le système des 180 j de report qui sera mis en place suite au financement ?</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->deferral_system }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <small class="pdf-card__text">NOTE : Bien préciser que le report permet de percevoir les subventions durant cette période pour ensuite les réinjecter avant la première échéance de façon à réduire la durée d'amortissement ou le montant des échéances.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pdf-card">
            <div class="pdf-card__head text-center">
                <h3 class="pdf-card__head__title">CONCLUSION</h3>
            </div>
            <div class="pdf-card__body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">30. Avez-vous des questions ou des elements que vous souhaitez approfondir</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->know_more }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Note de motivation CLIENT :</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->motivational_note }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="pdf-card__title">Observations generales</h4>
                        </div>
                        <div class="col-6">
                            <p class="pdf-card__text">{{ $preInstallation->general_comments }}</p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <small class="pdf-card__text">Je valide votre dossier pour le transmettre en instruction, dossier il faut compter 5 à 7 jours pour la réponse définitive</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- 
    <section>
        <button type="button" class="print-btn">Click to Print</button>
    </section> --}}

    <script>
      window.print();
    </script> 

</body>
</html>