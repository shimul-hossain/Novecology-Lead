<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -07</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="header__image" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <div class="logo">
            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/logo.png' }}" alt="logo">
        </div>
        <center>
            <h1 class="title"><span class="title__line">ATTESTATION SUR L’HONNEUR</span> <br><span class="title__line">Mode de Chauffage</span></h1>
        </center>
        <p>Je soussigné(é) Monsieur /Madame</p><br>
        <p>{{ $data['NOM_CLIENT'] }}</p><br>
        <p>Demeurant au</p><br>
        <p>{{ $data['FULL_ADRESSE'] }}</p><br>
        <p>Engage ma responsabilité et certifie par la présente que mon mode de chauffage principale AVANT TRAVAUX est le suivant :</p>
        <br>
        <table class="list-table">
            <tr>
                <td style="padding-left: 0;">
                    @if($data['Mode_de_chauffage']  == 'FIOUL')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox checked" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">FIOUL <i class="small solid-line">(HORS CONDENSATION)</i></span>
                </td>
                <td>
                    @if($data['Mode_de_chauffage']  == 'GAZ')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox checked" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">GAZ <i class="small solid-line">(HORS CONDENSATION)</i></span>
                </td>
                <td style="padding-right: 0;">
                    @if($data['Mode_de_chauffage']  == 'BOIS')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox checked" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">BOIS</span>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 0;">
                    @if($data['Mode_de_chauffage']  == 'ELECTRICITE')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox checked" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">ELECTRICITE</span>
                </td>
                <td>
                    @if($data['Mode_de_chauffage']  == 'Autre')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox checked" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-07/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">Autre</span>
                </td>
                <td style="padding-right: 0;">
                    <span class="list-table__text" style="margin-left: 0;">Si Autre: <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                </td>
            </tr>
        </table>
        <br>
        <p style="text-align: right;" align="right">A : {{ $data['Fait_à'] }}</p>
        <p style="text-align: right;" align="right">Le : <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>/<span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>/<span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
        <div class="signature-box">Signature Client :</div>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
