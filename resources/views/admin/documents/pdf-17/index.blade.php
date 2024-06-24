<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -17</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-17/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="header__image" src="{{ public_path().'/crm_assets/pdf_assets/pdf-17/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <div class="logo">
            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-17/pdf_assets/images/logo.png' }}" alt="logo">
        </div>
        <div class="box">
            <div class="title" align="center">ATTESTATION SUR L’HONNEUR – NON DEPOSE DE CUVE</div>
        </div>
        <p>Je soussigné(e) Monsieur/Madame <span class="dotted-line">{{ $data['NOM_CLIENT'] }}</span></p>
        <br>
        <br>
        <p>Demeurant au <span class="dotted-line">{{ $data['FULL_ADRESSE'] }}</span></p>
        <br>
        <p>Atteste sur l’honneur avoir pris connaissance que lors de l’installation de mon nouveau système de chauffage, la société NOVECOLOGY ne se chargera pas de la désinstallation, du dégazage, de la neutralisation, de la dépose de mon ancienne cuve.</p>
        <br>
        <br>
        <p>A <span class="dotted-line"> {{ $data['Ville'] }} </span></p>
        <br>
        <p>le <span class="dotted-line"> {{ $data['DATE_DU_JOUR'] }} </span></p>
        <br>
        <p>Signature Client :</p>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
