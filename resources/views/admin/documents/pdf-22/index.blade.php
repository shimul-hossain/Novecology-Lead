<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -22</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-22/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="header__image" src="{{ public_path().'/crm_assets/pdf_assets/pdf-22/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <div class="logo">
            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-22/pdf_assets/images/logo.png' }}" alt="logo">
        </div>
        <div class="box">
            <div class="title" align="center">ATTESTATION SUR L’HONNEUR</div>
            <div class="title" align="center">Mise en conformité : Réalisation des ventilations Haute et/ou Basse</div>
        </div>
        <p>Je soussigné(e) Monsieur/Madame</p>
        <p>{{ $data['NOM_CLIENT'] }}</p>
        <p>Demeurant au</p>
        <p>{{ $data['FULL_ADRESSE'] }}</p>
        <br>
        <p>Atteste sur l’honneur et m’engage à procéder dans les plus bref delais, à la réalisation des ventilations haute et basse dans le local où se situe la chaudière à granulés.</p>
        <br>
        <br>
        <p style="text-align: right;" align="right">A <span>{{ $data['Ville'] }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; le <span>{{ $data['DATE_DU_JOUR'] }}</span></p>
        <br>
        <br>
        <br>
        <div align="right">
            <div class="signature-box">SIGNATURE CLIENT :</div>
        </div>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 -</p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
