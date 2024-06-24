<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -11</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-11/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-08/pdf_assets/images/logo.png' }}" alt="logo" width="190">
    </div>
    <div class="body">
        <center>
            <h1 class="title">ATTESTATION SUR L’HONNEUR</h1>
        </center>
        <p>Je soussigné(e) Monsieur /Madame <span class="dotted-line">{{ $data['NOM_CLIENT'] }}</span></p>
        <p>Atteste sur l’honneur que je demeure au <span class="dotted-line" style="white-space: pre-line;">{{ $data['FULL_ADRESSE'] }}</span></p>
        <p>Fait pour servir et valoir ce que de droit.</p>
        <br>
        <br>
        <div class="address-box">
            <table>
                <tr>
                    <td width="55">
                        <p>Fait à</p>
                    </td>
                    <td>
                        <p class="solid-line">{{ $data['Fait_à'] }}</p>
                    </td>
                </tr>
                <tr>
                    <td width="55">
                        <p>Date</p>
                    </td>
                    <td>
                        <p class="solid-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    </td>
                </tr>
            </table>
            <p style="margin-top: 10px;">Signature</p>
        </div>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
