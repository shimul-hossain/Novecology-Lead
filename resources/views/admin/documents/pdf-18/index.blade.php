<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -18</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-18/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="d-block w-100" src="{{ public_path().'/crm_assets/pdf_assets/pdf-18/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <img class="d-block" src="{{ public_path().'/crm_assets/pdf_assets/pdf-18/pdf_assets/images/logo.png' }}" alt="logo">
        <div class="box">
            <div class="title" align="center">ATTESTATION DE RESTE A CHARGE</div>
        </div>
        <p class="text-right" align="right">A <span>Pontault Combault</span>, le <span>{{ $data['DATE_DU_JOUR'] }}</span></p>
        <p>La société NOVECOLOGY atteste par la présente que le bénéficiaire :</p>
        <br>
        <p>Monsieur/Madame : {{ $data['NOM_CLIENT'] }}</p>
        <br>
        <p>Demeurant au : {{ $data['FULL_ADRESSE'] }}</p>
        <br>
        <p>Bénéficiera d’une installation : <span>{{ $data['travaux'] }}</span> <span>{{ $data['PRODUIT'] }}</span></p>
        <br>
        <br>
        <br>
        <p>dont le numéro de devis est le suivant : {{ $data['NUMÉRO_DE_DEVIS'] }}</p>
        <br>
        <p>La société NOVECOLOGY s’engage à réaliser une compensation commerciale équivalente au montant de:</p>
        <p><span style="padding: 0 20px;">-</span><span>{{ $data['Montant_attestation_RAC'] }}</span> € pour l’installation d’une chaudière à granules uniquement pour le modèle Loki.</p>
        <br>
        <p>sous la forme, et au choix du client : de la location d’un espace publicitaire le jour de l’installation, d’une action marketing visant à faire connaître la société NOVECOLOGY auprès de son entourage, ou d’une attestation de satisfaction recommandant la société NOVECOLOGY.</p>
        <br>
        <p><strong>Le Bénéficiaire s'engage à garde <u>strictement confidenti</u> l et à ne pas divulguer ou communiquer à des tiers, par quelque moyen que ce soit, cette attestation et toutes les informations contenues.</strong></p>
        <br>
        <p><strong><u>NOVECOLOGY</u></strong></p>
        <table class="w-100" style="table-layout: fixed;">
            <tr>
                <td style="vertical-align: top;">
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-18/pdf_assets/images/pdf_18_sig.png' }}" alt="sign" width="160" style="float: left; padding-top: 20px;">
                    <strong><u>Le client</u></strong>
                </td>
                <td>
                    <div class="sign-box" align="center">Signature</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
