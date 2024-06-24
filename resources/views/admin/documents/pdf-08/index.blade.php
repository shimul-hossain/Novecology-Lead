<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -08</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/logo.png' }}" alt="logo" width="190">
    </div>
    <div class="body">
        <center>
            <h1 class="title">Attestation de chauffage</h1>
        </center>
        <p>Je soussigné (NOM /Prénom)</p><br>
        <p style="margin-left: 40px;" class="small"><span class="dotted-line">{{ $data['NOM_CLIENT'] }}</span></p><br>
        <p>Demeurant au</p><br>
        <p style="margin-left: 40px;" class="small"><span class="dotted-line" style="white-space: pre-line;">{{ $data['FULL_ADRESSE'] }}</span></p><br>
        <p>Certifie par la présente que cette adresse est celle de mon habitation principale et que mon mode de chauffage principal est :</p>
        <br>
        <table class="list-table">
            <tr>
                <td style="padding-left: 0;">
                    @if($data['Mode_de_chauffage']  == 'FIOUL')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">FIOUL</span>
                </td>
                <td>
                    @if($data['Mode_de_chauffage'] == 'GAZ')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">GAZ</span>
                </td>
                <td>
                    @if($data['Mode_de_chauffage'] == 'BOIS')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">BOIS</span>
                </td>
                <td style="padding-right: 0;">
                    @if($data['Mode_de_chauffage'] == 'ELECTRICITE')
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="35" draggable="false">
                    @else
                        <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="35" draggable="false">
                    @endif
                    <span class="list-table__text">ELECTRICITE</span>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <div class="address-box">
            <table>
                <tr>
                    <td width="55">
                        <p>Fait à</p>
                    </td>
                    <td>
                        <p class="dotted-line small">{{ $data['Fait_à'] }}</p>
                    </td>
                </tr>
                <tr>
                    <td width="55">
                        <p>Le</p>
                    </td>
                    <td>
                        <p class="dotted-line small">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </td>
                </tr>
            </table>
            <p style="margin-top: 10px;">Signature du bénéficiaire</p>
        </div>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
