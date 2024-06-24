<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -02</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-02/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page" size="A4">
        <div class="header-shape">
            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-02/pdf_assets/images/header-shape.png' }}" alt="header-shape">
        </div>
        <div class="main">
            <span class="title-1">ACCORD DE CONSENTEMENT</span>
            <span class="title-2">MaPrimeRenov’</span>
            <p>Je soussigné(é) Monsieur/Madame <span class="solid-line">{{ $data['NOM_CLIENT'] }}</span></p>
            <p>Propriétaire du logement à rénover situé au <span class="solid-line">{{ $data['FULL_ADRESSE'] }}</span></p>
            <p>Reconnait être à l’origine du dossier MaPrimeRenov <span class="solid-line">{{ $data['NUMERO_DOSSIER'] }} ,</span></p>
            <p>Avoir mandaté l’entreprise NOVECOLOGY pour effectuer ma demande d’aide MaPrimeRénov' et autorise le mandataire de mon dossier MaPrimeRénov’ à percevoir les sommes versées par l'ANAH au titre de l'aide MaPrimeRénov'.</p>
            <p>Je confirme ma volonté de faire financer les travaux dans le cadre de MaPrimeRénov’.</p>
            <br>
            <br>
            <table>
                <tr>
                    <td width="130"><p>Fait à</p></td>
                    <td><p>:<span class="solid-line">{{ $data['Fait_à'] }}</span></p></td>
                </tr>
                <tr>
                    <td width="130">Le</td>
                    <td><p>:<span class="solid-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td width="130" style="vertical-align: top;"><p>Signature du demandeur</p></td>
                    <td>
                        <br><br>
                        <table border="3" cellspacing="0" cellpadding="0" style="border: 3px solid #000000; border-collapse: collapse; margin-left: 60px;">
                            <tr>
                                <td width="230" height="110" cellspacing="0" cellpadding="0" style="border-collapse: collapse;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <!-- main area end -->

        <!-- footer area start -->
        <div class="footer-main">
            <p><strong class="top-word">NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
            <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
            <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
        </div>
        <!-- footer area end -->
    </div>
</body>
</html>
