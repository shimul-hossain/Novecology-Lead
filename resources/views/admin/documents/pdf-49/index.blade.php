<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF 49</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="d-block w-100" src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <div class="logo-container">
            <img class="logo-container__logo d-block" src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/logo.png' }}" alt="logo" width="220">
        </div>
        <br>
        <h1 class="title" align="center"><span class="solid-line" style="margin-right: -200px">INSTALLATION CAG</span><span class="title__box text-danger">RESTE A CHARGE : <span class="marker">{{ $data['RESTE_A_CHARGE_CLIENT'] ?? '0' }}</span> € <br>UNIQUEMENT PAR CHEQUE</span></h1>
        <div class="box">
            <table class="w-100 layout-fixed">
                <tr>
                    <td><p><strong><span class="solid-line">NOM CLIENT :</span></strong> <span class="marker">{{ $data['NOM_CLIENT'] }}</span></p></td>
                    <td><p><strong><span class="solid-line">POSEUR :</span></strong> <span class="marker">{{ $data['POSEUR'] }}</span></p></td>
                </tr>
                <tr>
                    <td><p><strong><span class="solid-line">DATE POSE :</span></strong> <span class="marker">{{ $data['DATE_POSE'] }}</span></p></td>
                    <td><p><strong><span class="solid-line">MATERIEL :</span></strong> <span class="marker">{{ $data['MATERIEL'] }}</span></p></td>
                </tr>
            </table>
        </div>
        <p class="text-danger" align="center"><strong>DOCUMENTS À SIGNER</strong></p>
        <br>
        <table>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>MANDAT POUR LA CONSTITUTION D’UNE DEMANDE D’AIDE (MAPRIMERENOV)</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>DEMANDE DE CONSENTEMENT MAPRIMERENOV (MAPRIMERENOV)</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>ATTESTATION SIMPLIFIEE DE TVA</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>ATTESTATION SUR L’HONNEUR (POLLUEUR)</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>FICHE AUTOCONTROLE INSTALLATION :</strong> <span class="solid-line">A REMPLIR PAR L’INSTALLATEUR A LA FIN</span></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PV DE RECEPTION DE TRAVAUX</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>CONTROLE QUALITE : A REMPLIR PAR LE CLIENT A LA FIN DE L’INSTALLATION</strong></td>
            </tr>
        </table>
        <br>
        <p align="center"><strong><span class="marker">DEMANDE DE FACTURE PAR MAIL : {{ $data['DEMANDE_DE_FACTURE_PAR_MAIL'] }}</span></strong></p>
        <p class="text-danger" align="center"><strong>DOCUMENTS À RECUPERER</strong></p>
        <table>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>JUSTIFICATIF DE DOMICILE + TAXE FONCIERE 2021</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PIECE IDENTITE (RECTO / VERSO)</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>AVIS D’IMPOSITION 2021</strong></td>
            </tr>
        </table>
        <br>
        <p class="text-danger" align="center"><strong>PHOTOS À TRANSMETTRE</strong></p>
        <table>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PHOTO CAG + <span class="solid-line">FUMISTERIE</span></strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PHOTO BALLON ECS</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-49/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PHOTO DU CHEQUE</strong></td>
            </tr>
        </table>
        <br>
        <div class="border">
            <p class="text-danger"><strong>OBSERVATIONS</strong></p>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
</body>
</html>
