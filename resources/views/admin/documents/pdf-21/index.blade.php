<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -21</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-21/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="header__image" src="{{ public_path().'/crm_assets/pdf_assets/pdf-21/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <div class="logo">
            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-21/pdf_assets/images/logo.png' }}" alt="logo">
        </div>
        <center>
            <h1 class="title"><span class="title__line">ATTESTATION SUR L’HONNEUR</span> <br><span class="title__line">Date de construction du logement supérieur à 15 ans</span></h1>
        </center>
        <p>Je soussignée Monsieur/Madame</p><br>
        <p>{{ $data['NOM_CLIENT'] }}</p><br>
        <p>Demeurant au</p><br>
        <p>{{ $data['FULL_ADRESSE'] }}</p><br>
        <p>Engage ma responsabilité et certifie par la présente que mon logement a été <br>construit et achevé il y a plus de quinze ans.</p>
        <br>
        <p style="text-align: right;" align="right">A : <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <p style="text-align: right;" align="right">Le : <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>/<span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>/<span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <div class="signature-box">Signature Client :</div>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
