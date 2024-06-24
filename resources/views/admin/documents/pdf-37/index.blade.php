<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF 37</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-37/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-37/pdf_assets/images/logo.png' }}" alt="logo" height="20">
    </div>
    <div class="body">
        <div class="heading">
            <center>
                <h1 class="title">DECHARGE RELATIVE A LA MAINTENANCE</h1>
                <p><small>Articles R.132-1 et R.132-2 du Code la consommation</small></p>
            </center>
        </div>
        <p>JE SOUSSIGNE(E) : <strong><span class="dotted-line">&nbsp;&nbsp; {{ $data['NOM_CLIENT'] }} &nbsp;&nbsp;</span></strong></p>
        <br><br><br>
        <table class="list-table">
            <tr>
                <td style="padding-left: 0;">
                    <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-37/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="70" draggable="false">
                </td>
                <td>ATTESTE ÊTRE PARFAITEMENT INFORMÉ PAR LE PRESTATAIRE DE SOUSCRIRE À UN CONTRAT DE MAINTENANCE DE MON ÉQUIPEMENT AUPRÈS D’UN PROFESSIONNEL CONFORMÉMENT AU DÉCRET N° 2020-912 DU 28 JUILLET 2020 RELATIF À L'INSPECTION ET À L'ENTRETIEN DES CHAUDIÈRES, DES SYSTÈMES DE CHAUFFAGES ET DES SYSTÈMES DE CLIMATISATION</td>
            </tr>
            <tr>
                <td style="padding-left: 0;">
                    <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-37/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="70" draggable="false">
                </td>
                <td>M’ENGAGE À SOUSCRIRE UN CONTRAT DE MAINTENANCE AUPRÈS D’UN PROFESSIONNEL</td>
            </tr>
            <tr>
                <td style="padding-left: 0;">
                    <img class="list-table__checkbox" src="{{ public_path().'/crm_assets/pdf_assets/pdf-37/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="70" draggable="false">
                </td>
                <td>DÉCHARGE LE PRESTATAIRE DE DE TOUTE RESPONSABILITÉ AU TITRE DE SON OBLIGATION DE CONSEIL PRÉCONTRACTUELLE, D'INFORMATION ET DE MISE EN GARDE.</td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <p><small>FAIT À</small> <strong><span class="dotted-line">&nbsp;&nbsp; {{ $data['Fait_à'] }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong> , <small>LE</small> <strong><span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></strong></p>
        <br>
        <p><small>SIGNATURE DU CLIENT</small></p>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 -</p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
