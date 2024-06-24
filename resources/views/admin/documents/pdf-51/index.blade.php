<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF 51</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="d-block w-100" src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <div class="logo-container">
            <img class="d-block" src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/logo.png' }}" alt="logo" width="220">
        </div>
        <br>
        <h1 class="title" align="center"><span class="solid-line" style="margin-right: -150px">INSTALLATION CAG</span><span class="title__box">FINANCEMENT</span></h1>
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
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>DEMANDE DE DEBLOCAGE DE FOND</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>ATTESTATION SIMPLIFIEE DE TVA</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>ATTESTATION SUR L’HONNEUR (POLLUEUR)</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>FICHE AUTOCONTROLE INSTALLATION :</strong> <span class="solid-line">A REMPLIR PAR L’INSTALLATEUR A LA FIN</span></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PV DE RECEPTION DE TRAVAUX (IMPORTANT)</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>CONTROLE QUALITE : A REMPLIR PAR LE CLIENT A LA FIN DE L’INSTALLATION</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>ATTESTATION SUR L’HONNEUR – CHAUFFAGE</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>FICHE INFORMATION MPR</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>FICHE DE DEMANDE D'EXECUTION</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>FICHE INFORMATION PRECONTRACTUEL</strong></td>
            </tr>
        </table>
        <br>
        <p align="center"><strong><span class="marker">DEMANDE DE FACTURE PAR MAIL : <span class="solid-line" style="color: #0462c1;">{{ $data['DEMANDE_DE_FACTURE_PAR_MAIL'] }}</span></span></strong></p>
        <p class="text-danger" align="center"><strong>PHOTOS À TRANSMETTRE</strong></p>
        <table>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PHOTO CAG</strong></td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-51/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="50">
                </td>
                <td style="padding-left: 15px;"><strong>PHOTO BALLON ECS</strong></td>
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
