<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -10</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-10/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/logo.png' }}" alt="logo" width="190">
    </div>
    <div class="body">
        <center>
            <h1 class="title">Attestation Déménagement</h1>
        </center>
        <p>Je soussigné (NOM /Prénom) <span class="dotted-line">{{ $data['NOM_CLIENT'] }}</span></p>
        <p>Résidant à la date de signature des présentes à l’adresse :</p>
        <p><span class="dotted-line" style="white-space: pre-line;">{{ $data['FULL_ADRESSE'] }}</span></p>
        <p>Référence de l’avis d’impots : <span class="dotted-line">{{ $data['Référence_de'] }}</span></p><br>
        <p>Atteste sur l’honneur que l’adresse indiquée sur l’avis d’imposition correspond à mon adresse principale avant mon emménagement à mon adresse actuelle.</p><br>
        <p>Pour faire valoir ce que de droit.</p>
        <br>
        <br>
        <div class="address-box">
            <table>
                <tr>
                    <td width="55">
                        <p>Fait à</p>
                    </td>
                    <td>
                        <p class="dotted-line">{{ $data['Fait_à'] }}</p>
                    </td>
                </tr>
                <tr>
                    <td width="55">
                        <p><strong>*Le</strong></p>
                    </td>
                    <td>
                        <p class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </td>
                </tr>
            </table>
            <p style="margin-top: 10px;"><strong>*Signature du bénéficiaire</strong></p>
        </div>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
