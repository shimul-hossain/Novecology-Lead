<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - 32</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-32/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="d-block w-100" src="{{ public_path().'/crm_assets/pdf_assets/pdf-32/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <div class="box">
            <div class="title" align="center"><strong>CONTROLE QUALITE - INSTALLATION CHAUDIERE A GRANULE</strong></div>
        </div>
        <p>Dans le cadre de notre démarche qualité, et à la suite de votre installation, nous vous prions de nous aider à améliorer la qualité de nos prestations, en prenant quelques instants pour exprimer votre niveau de satisfaction.</p>
        <br>
        <div class="subtitle" align="center"><strong>INFORMATION BENEFICIAIRE</strong></div>
        <p>CLIENT : NOM / PRÉNOM  <span class="solid-line">{{ $data['NOM_CLIENT'] }}</span></p>
        <br>
        <div class="subtitle subtitle--border" align="center"><strong>EVALUATION</strong></div>
        <br>
        <p><i><strong class="large">1)</strong></i> <i><strong class="solid-line">Êtes satisfait de la pose de la CHAUDIERE A GRANULE ?</strong></i>&nbsp;&nbsp;<span class="radio-option">OUI</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="radio-option">NON</span></p>
        <br>
        <p><strong>Si non, merci de nous préciser :</strong></p>
        <br>
        <p class="dotted-line"></p>
        <br>
        <table class="w-100">
            <tr>
                <td>
                    <p><strong class="large">2)</strong><strong>Qualité du conseil commerciale</strong></p>
                    <p><i>Commentaires :</i></p>
                    <br>
                </td>
                <td align="center">
                    <p><strong>Moyen</strong></p>
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <p><strong>Satisfaisant</strong></p>
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <p><strong>Bon</strong></p>
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <p><strong>Excellent</strong></p>
                    <span class="checkbox-option"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong class="large">3)</strong><strong>Présence/ponctualité</strong></p>
                    <p><i>Commentaires :</i></p>
                    <br>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong class="large">4)</strong><strong>Qualité du travail réalisé</strong></p>
                    <p><i>Commentaires :</i></p>
                    <br>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
                <td align="center">
                    <span class="checkbox-option"></span>
                </td>
            </tr>
        </table>
        <p><strong class="large">5)</strong><strong>Recommanderiez-vous notre entreprise ?</strong>&nbsp;&nbsp;<span class="radio-option">OUI</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="radio-option">NON</span></p>
        <br>
        <p><strong class="large">6)</strong><strong><i>Évaluation globale <u>(de 1 à 10)</u> à l’ensemble de la prestation</i></strong> <i>(accueil et explication du commercial, présentation du technicien, pose de la chaudière)</i></p>
        <br>
        <table class="w-100 fixed-layout" border="1" cellspacing="0" cellspacing="0" >
            <tr>
                <td align="center">1</td>
                <td align="center">2</td>
                <td align="center">3</td>
                <td align="center">4</td>
                <td align="center">5</td>
                <td align="center">6</td>
                <td align="center">7</td>
                <td align="center">8</td>
                <td align="center">9</td>
                <td align="center">10</td>
            </tr>
        </table>
        <br>
        <br>
        <div class="dashed-box">
            <strong>Observations / Suggestions d’amélioration :</strong>
            <br><br><br><br>
        </div>
        <br>
        <table class="w-100 fixed-layout">
            <tr>
                <td>
                    <p>FAIT LE :</p>
                    <br>
                    <p>A : {{ $data['Ville'] }}</p>
                    <br><br>
                    <div class="solid-box" style="margin-right: 50px;">
                        <strong>Signature client :</strong>
                        <br><br><br><br><br><br>
                    </div>
                </td>
                <td class="dashed-box" style="vertical-align: top;">
                    <p align="center"><strong class="solid-line large" style="padding-right: 0;">CADRE RESERVE A NOVECOLOGY</strong></p>
                    <br>
                    <p><strong class="solid-line">2<sup>ème</sup> CQ REALISE PAR :</strong></p>
                    <br>
                    <p><strong class="solid-line">DATE :</strong></p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
