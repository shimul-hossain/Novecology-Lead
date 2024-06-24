<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF 53</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/css/style.css' }}">
</head>
<body>

    <div class="header">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/logo.png' }}" alt="logo" height="20">
    </div>
    <div class="body">
        <center>
            <h1 class="title"><span class="solid-line">Attestation de Fin de Travaux</span></h1>
        </center>
        <p><span class="solid-line">Je soussigné(e) :</span></p>
        <table>
            <tr>
                <td>
                    <p>Nom</p>
                </td>
                <td><p>: {{ $data['Nom'] }}</p></td>
            </tr>
            <tr>
                <td>
                    <p>Prénom</p>
                </td>
                <td><p>: {{ $data['Prénom'] }}</p></td>
            </tr>
            <tr>
                <td>
                    <p>Téléphone</p>
                </td>
                <td><p>: {{ $data['Téléphone'] }}</p></td>
            </tr>
            <tr>
                <td style="padding-right: 50px;">
                    <p>Adresse Travaux</p>
                </td>
                <td><p>: {{ $data['Adresse_Travaux'] }}</p></td>
            </tr>
            <tr>
                <td>
                    <p>Code Postal</p>
                </td>
                <td><p>: {{ $data['Code_Postal'] }}</p></td>
            </tr>
            <tr>
                <td>
                    <p>Ville</p>
                </td>
                <td><p>: {{ $data['Ville'] }}</p></td>
            </tr>
        </table>
        <br>
        <p><span class="solid-line">Atteste : (cocher les cases)</span></p>
        <br>
        <table>
            <tr>
                <td width="20">
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                </td>
                <td>
                    <p>de l’achèvement total des travaux.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                </td>
                <td>
                    <p>de la réception du devis et du cadre de contribution avant l’engagement des travaux.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                </td>
                <td>
                    <p>de la réception de la facture.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                </td>
                <td>
                    <p>que les informations indiquées dans le dossier sont correctes.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                </td>
                <td>
                    <p>que les travaux peuvent faire l’objet d’un éventuel contrôle par un organisme accrédité.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                </td>
                <td>
                    <p>En cas de demande, j’autorise l’accès aux travaux.</p>
                </td>
            </tr>
        </table>
        <br>
        <p><span class="solid-line">J’atteste que mon mode de chauffage principal est le suivant: (cocher la case)</span></p>
        <table class="option-table">
            <tr>
                <td>
                    @if ($data['Mode_de_chauffage'] == 'Fiou')
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="15" draggable="false">
                    @else
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                    @endif
                </td>
                <td>
                    <p><small>Fioul</small></p>
                </td>
                <td>
                    @if ($data['Mode_de_chauffage'] == 'Gaz')
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="15" draggable="false">
                    @else
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                    @endif
                </td>
                <td>
                    <p><small>Gaz</small></p>
                </td>
                <td>
                    @if ($data['Mode_de_chauffage'] == 'Bois')
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="15" draggable="false">
                    @else
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                    @endif
                </td>
                <td>
                    <p><small>Bois</small></p>
                </td>
                <td>
                    @if ($data['Mode_de_chauffage'] == 'Convecteur électrique')
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="15" draggable="false">
                    @else
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                    @endif
                </td>
                <td>
                    <p><small>Convecteur électrique</small></p>
                </td>
                <td>
                    @if ($data['Mode_de_chauffage'] == 'PAC')
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="15" draggable="false">
                    @else
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                    @endif
                </td>
                <td>
                    <p><small>PAC</small></p>
                </td>
                <td>
                    @if ($data['Mode_de_chauffage'] == 'Autres')
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="15" draggable="false">
                    @else
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-53/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" draggable="false">
                    @endif
                </td>
                <td>
                    <p><small>Autres : <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></small></p>
                </td>
            </tr>
        </table>
        <br>
        <p><span class="solid-line">J’atteste que les matériaux suivants ont été posés : (à compléter suivant les travaux effectués)</span></p>
        <p class="dotted-line">&nbsp;</p>
        <p class="dotted-line">&nbsp;</p>
        <p class="dotted-line">&nbsp;</p>
        <p class="dotted-line">&nbsp;</p>
        <br>
        <p><span class="solid-line">Je donne mon avis sur la qualité de la prestation : (mettre une croix dans la case correspondante)</span></p>
        <br>
        <table class="border-table" cellspacing="0" cellpadding="0">
            <tr>
                <td class="no-border"></td>
                <td style="background-color: #00af50;" width="70">++</td>
                <td style="background-color: #92d050;" width="70">+</td>
                <td style="background-color: #ff7c78;" width="70">-</td>
                <td style="background-color: #ff2018;" width="70">--</td>
            </tr>
            <tr>
                <td>L’équipe</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>L’installation (matériaux, pose)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>La propreté après le chantier</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>La durée des travaux</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Impression générale</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br>
        <p><span class="solid-line">Commentaires :</span></p>
        <br>
        <table>
            <tr>
                <td>Fait à</td>
                <td>: {{ $data['Fait_à'] }}</td>
            </tr>
            <tr>
                <td>Le</td>
                <td>:
                    @if (strtotime($data['Le']))
                        {{ \Carbon\Carbon::parse($data['Le'])->format('d-m-Y') }}
                    @else
                        {{ $data['Le'] }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding-right: 30px;">Signature du déclarant</td>
                <td>:</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Prè des Aulnes 77340 Pontault-Combault-01 87 66 57 30-support@novecology.fr SAS au capital de 10 000€-</p>
        <p>SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809 -</p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>

