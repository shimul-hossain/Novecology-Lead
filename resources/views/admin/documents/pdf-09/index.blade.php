<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -09</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-09/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page">
        <div class="container">
            <div class="logo">
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-09/pdf_assets/images/logo.png' }}" alt="logo">
            </div>
            <div class="header">
                <h1 class="top-header">Attestation sur l’Honneur –</h1>
                <h1>Décharge de responsabilité</h1>
            </div>
            <div class="field-one">
                <div class="field-title f-title1">
                    <p>Je soussigné(e)</p>
                </div>
                <div class="field-dash1">
                    <span>{{ $data['NOM_CLIENT'] }}</span>
                </div>
            </div>
            <div class="field-two">
                <div class="field-title f-title2">
                    <p>Demeurant au</p>
                </div>
                <div class="field-dash2">
                    <span>{{ $data['FULL_ADRESSE'] }}</span>
                </div>
            </div>
            <div class="paragraph">
                <p class="para1">Atteste par la présente avoir été informé par la société NOVECOLOGY que les préconisations du
                    fabricant en termes d’entretien et de sécurité avec une hauteur minimal de 1,80 pour l’installation
                    d’une chaudière ne pourront être respecté lors de l’installation dans mon logement.</p>
                <p class="para2">Malgré les préconisations contraires de NOVECOLOGY, J’accepte ces risques en pleine connaissance
                    de cause et ne peut tenir responsable Novecology des difficultés d’entretiens ou de maintenance de
                    la machine liée à une hauteur sous plafond inferieur au préconisation du fabricant</p>
            </div>
            <div class="field">
                <div class="field1">
                    <p>A {{ $data['Ville'] }}</p>
                </div>
                <div class="field2">
                    <p>Le {{ $data['Le'] }}</p>
                </div>
            </div>
            <div class="signature">
                <p>Signature avec mention lu et approuvé</p>
                <div class="signature-box"></div>
            </div>
        </div>
    </div>
</body>
</html>
