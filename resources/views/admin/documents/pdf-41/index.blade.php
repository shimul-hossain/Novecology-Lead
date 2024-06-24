<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF 41</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-41/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="d-block w-100" src="{{ public_path().'/crm_assets/pdf_assets/pdf-41/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <img class="d-block" src="{{ public_path().'/crm_assets/pdf_assets/pdf-41/pdf_assets/images/logo.png' }}" alt="logo">
        <div class="box">
            <div class="title" align="center"><strong>MANDAT DE REPRESENTATION NOVECOLOGY</strong></div>
        </div>
        <br>
        <p>Je soussigné(e) Monsieur/Madame</p>
        <br>
        <p><span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;{{ $data['NOM_CLIENT'] }}&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <p>Demeurant au</p>
        <br>
        <p><span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;{{ $data['FULL_ADRESSE'] }}&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <p>Autorise la société NOVECOLOGY (SIRET : 84994780900026) dont le siège social est au 2 rue du Pré des Aulnes 77340 Pontault Combault à me représenter administrativement pour la constitution d’une demande d’aide à la rénovation énergétique et sa demande de paiement</p>
        <br>
        <table class="list-table">
            <tr>
                <td>-</td>
                <td>Le Bénéficiaire donne mandat à NOVECOLOGY pour la transmission du dossier de demande d’aide à MAPRIMEPRENOV ou tout autre organisme financeur, y compris quand un service en ligne est disponible</td>
            </tr>
            <tr>
                <td>-</td>
                <td>Le Bénéficiaire donne mandat à NOVECOLOGY pour la création d’une adresse courriel le représentant afin d’obtenir l’accès aux plateformes dématérialisées permettant l’inscription, la transmission, le suivi du dossier de demande auprès de tout organisme financeur pour le compte du Bénéficiaire, jusqu’à la réalisation complète des travaux objets de la mission.</td>
            </tr>
            <tr>
                <td>-</td>
                <td>Le Bénéficiaire reconnait et accepte que NOVECOLOGY soit nommé mandataire administratif et financier auprès de MAPRIMERENOV. Le montant de l'aide MAPRIMERENOV sera versé par MAPRIMERENOV au mandataire à la fin des travaux.</td>
            </tr>
            <tr>
                <td>-</td>
                <td>Le Bénéficiaire donne mandat à NOVECOLOGY pour la réalisation d’un audit énergétique visant l'amélioration de l'efficacité énergétique de son logement. Cet audit sera pris en charge par MAPRIMERENOV.</td>
            </tr>
        </table>
        <br>
        <p class="text-right" align="right">A <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;{{ $data['Ville'] }}&nbsp;&nbsp;&nbsp;&nbsp;</span> le <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>/<span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>/<span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
        <br>
        <table class="w-100">
            <tr>
                <td>
                    <div class="sign-box">
                        <div>SIGNATURE DU BENEFICIAIRE</div>
                        <div><span class="solid-line">Avec la mention « Bon pour Accord »</span></div>
                    </div>
                </td>
                <td align="center">
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-41/pdf_assets/images/sign.png' }}" alt="sign" style="vertical-align: top;" width="150">
                </td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 - </p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
