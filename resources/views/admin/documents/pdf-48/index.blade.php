<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF 48</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-48/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="body">
        <div class="logo">
            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-48/pdf_assets/images/logo.png' }}" alt="logo"/>
        </div>
        <br>
        <center>
            <p class="title">PAGE DE GARDE</p>
        </center>
    </div>
    <br>
    <div class="divider">
        <strong>Bénéficiaire</strong>
        <strong style="float: right;">GUYOTON ROMAIN</strong>
    </div>
    <br>
    <div class="body">
        <table class="common-table zikzak-table w-100" cellpadding="0" cellspacing="0">
            <tr>
                <td>Type précarité</td>
                <td><strong>{{ $data['precariousness'] }}</strong></td>
                <td>Téléphone &nbsp;&nbsp;&nbsp;<strong>{{ $data['Téléphone'] }}</strong></td>
                <td>Courriel &nbsp;&nbsp;&nbsp;<strong>{{ $data['Email'] }}</strong></td>
            </tr>
            <tr>
                <td>Revenu fiscal</td>
                <td><strong>{{ EuroFormat($data['Revenu_fiscal']) }}</strong></td>
                <td>Nombre foyers &nbsp;&nbsp;&nbsp;<strong>{{ $data['Nombre_foyers'] }}</strong></td>
                <td>Nombre personnes &nbsp;&nbsp;&nbsp;<strong>{{ $data['Nombr_personnes'] }}</strong></td>
            </tr>
        </table>
        <table class="common-table w-100" cellpadding="0" cellspacing="0">
            <tr>
                <td>Avis Fiscal 1 &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $data['Avis_Fiscal_1'] }}</strong></td>
                <td>Avis Fiscal 2 &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $data['Avis_Fiscal_2'] }}</strong></td>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="divider">
        <strong>Site des travaux</strong>
    </div>
    <br>
    <div class="body">
        <table class="common-table zikzak-table w-100" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>Adresse</td>
                    <td><strong>{{ $data['Adresse'] }}</strong></td>
                </tr>
                <tr>
                    <td width="120">Code postal / Ville</td>
                    <td><strong>{{ $data['Code_postal_Ville'] }}</strong></td>
                </tr>
                <tr>
                    <td>Zone</td>
                    <td><strong>{{ $data['Zone'] }}</strong></td>
                </tr>
                <tr>
                    <td>Mode de chauffage</td>
                    <td><strong>{{ $data['Mode_de_chauffage'] }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div> 
    <br>
    <div class="divider">
        <strong>Récapitulatif financier</strong>
    </div>
    <br>
    <div class="body">
        <table class="full-zikzak-table layout-fixed w-100" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <table class="common-table">
                            <tr>
                                <td width="120">Total H.T</td>
                                <td><strong>{{ EuroFormat($data['Total_HT']) }}</strong></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="common-table">
                            <tr>
                                <td width="120">Total TVA</td>
                                <td><strong>{{ EuroFormat($data['Total_TVA']) }}</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="common-table">
                            <tr>
                                <td width="120">Total T.T.C</td>
                                <td><strong>{{ EuroFormat($data['Total_T_T_C']) }}</strong></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="common-table">
                            <tr>
                                <td width="120">Prime CEE</td>
                                <td><strong>{{ EuroFormat($data['Prime_CEE']) }}</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="common-table">
                            <tr>
                                <td width="120">Prime MaPrimeRénov'</td>
                                <td><strong>{{ EuroFormat($data['Prime_MaPrimeRénov']) }}</strong></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="common-table">
                            <tr>
                                <td width="120">Reste à payer</td>
                                <td><strong>{{ EuroFormat($data['Reste_à_payer']) }}</strong></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <div class="divider">
        <strong>Liste des travaux</strong>
    </div>
    <br>
    <div class="body">
        <p><strong>- {{ $data['Liste_des_travaux_1'] }}</strong> Chaudière - Marque : <strong>{{ $data['Marque1'] }}</strong> - Référence : <strong>{{ $data['Référence1'] }}</strong></p>
        <p>&nbsp;&nbsp;<strong>Montant HT : {{ EuroFormat($data['Montant_HT1']) }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Montant TTC : {{ EuroFormat($data['Montant_TTC1']) }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Prime CEE : {{ EuroFormat($data['Prime_CEE1']) }}</strong></p>
        <p><strong>- {{ $data['Liste_des_travaux_2'] }}</strong> Chauffe-eau - Marque : <strong>{{ $data['Marque2'] }}</strong> - Référence : <strong>{{ $data['Référence2'] }}</strong></p>
        <p>&nbsp;&nbsp;<strong>Montant HT : {{ EuroFormat($data['Montant_HT2']) }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Montant TTC : {{ EuroFormat($data['Montant_TTC2']) }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Prime CEE : {{ EuroFormat($data['Prime_CEE2']) }}</strong></p>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 -</p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
