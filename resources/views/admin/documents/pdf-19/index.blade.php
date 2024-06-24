<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -19</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-19/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="d-block w-100" src="{{ public_path().'/crm_assets/pdf_assets/pdf-19/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <img class="d-block" src="{{ public_path().'/crm_assets/pdf_assets/pdf-19/pdf_assets/images/logo.png' }}" alt="logo">
        <div class="box">
            <div class="title" align="center">ATTESTATION D’INTERVENTION</div>
        </div>
        <p>Je soussigné(e) Monsieur/Madame</p>
        <p><span class="dotted-line">{{ $data['NOM_CLIENT'] }}&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <p>Demeurant au</p>
        <p><span class="dotted-line">{{ $data['FULL_ADRESSE'] }}&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <br>
        <p>Reconnait que la société NOVECOLOGY est intervenu pour une intervention à mon domicile ce jour, et que l’installation est fonctionnelle.</p>
        <br>
        <br>
        <div class="sign-box">Descriptions des modifications réalisées : {{ $data['Description'] }}</div>
        <br>
        <p class="text-right" align="right">A <span class="dotted-line">&nbsp;{{ $data['Ville'] }}&nbsp;&nbsp;&nbsp;</span> , le <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <br>
        <table class="w-100" style="table-layout: fixed;">
            <tr>
                <td style="vertical-align: top;">
                    <p>SIGNATURE NOVECOLOGY</p>
                    <br>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-19/pdf_assets/images/pdf_19_sig.png' }}" alt="sign" width="160">
                </td>
                <td align="center" style="vertical-align: top;">SIGNATURE CLIENT</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 -</p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
