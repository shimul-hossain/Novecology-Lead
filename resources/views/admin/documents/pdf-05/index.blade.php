<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - 05</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-05/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-05/pdf_assets/images/logo.png' }}" alt="logo" class="d-block" height="20">
    </div>
    <div class="body">
        <h1 class="title" align="center">NOTE DE DIMENSIONNEMENT</h1>
        <p><strong><i>Informations sur le logement concerné :</i></strong></p>
        <div class="box">
            <table class="w-100">
                <tr>
                    <td>Bénéficiaire</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['NOM_CLIENT'] }}</strong></p></td>
                </tr>
                <tr>
                    <td>Adresse des travaux</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Adresse_des_travaux'] }}</strong></p></td>
                </tr>
                <tr>
                    <td>Parcelle cadastrale</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong><strong style="padding-left: 10px;">{{ $data['Parcelle_cadastrale'] }}</strong></p></td>
                </tr>
                <tr>
                    <td>Tél</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Tél'] }}</strong></p></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Email'] }}</strong></p></td>
                </tr>
                <tr>
                    <td>Zone</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Zone'] }}</strong></p></td>
                </tr>
                <tr>
                    <td>Surface chauffée</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ frenceNumberFormat($data['Surface_chauffée']) }} m²</strong></p></td>
                </tr>
                <tr>
                    <td>Hauteur sous plafond</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ frenceNumberFormat($data['Hauteur_sous_plafond']) }} m</strong></p></td>
                </tr>
                <tr>
                    <td>Altitude</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ frenceNumberFormat($data['Altitude']) }} m</strong></p></td>
                </tr>
                <tr>
                    <td>Emetteur de chauffage existant</td>
                    <td><p class="dotted-line" style="margin-right: 30px;"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Emetteur_de_chauffage'] }}</strong></p></td>
                </tr>
            </table>
            <p>Température d’eau au sein du circuit défini en fonction des radiateurs existants &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>:</strong><strong class="dotted-line" style="padding-left: 10px;">{{ $data['Température'] }}</strong></p>
        </div>
        <p><strong><i>Informations sur le matériel installé :</i></strong></p>
        <table class="w-100 fixed-layout">
            <tr>
                <td>
                    <div class="box">
                        <table class="w-100">
                            <tr>
                                <td>Type de produit</td>
                                <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Type_de_produit'] }}</strong></p></td>
                            </tr>
                            <tr>
                                <td>Marque</td>
                                <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Marque'] }}</strong></p></td>
                            </tr>
                            <tr>
                                <td>Référence</td>
                                <td><p><strong>:</strong></p></td>
                            </tr>
                        </table>
                        <p class="dotted-line"><strong>{{ $data['Référence'] }}</strong></p>
                        <p class="dotted-line">&nbsp;</p>
                    </div>
                </td>
                <td align="right">
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-05/pdf_assets/images/map.png' }}" alt="map" height="150" class="d-block">
                </td>
            </tr>
        </table>
        <br>
        <div class="box" style="padding: 0;">
            <p align="center" class="small" style="color: #984806;"><small>Déperditions (en Watt) = Volume à chauffer en m3 x Coefficient de construction x (Température ambiante – Température extérieure de base)</small></p>
        </div>
        <br>
        <table class="w-100">
            <tr>
                <td>
                    <div class="box">
                        <table class="w-100">
                            <tr>
                                <td>
                                    <ul>
                                        <li>
                                            <p>Volume à chauffer <br><small class="small">Surface chauffée x Hauteur sous plafond</small></p>
                                        </li>
                                    </ul>
                                </td>
                                <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ frenceNumberFormat($data['Surface_chauffée'] * $data['Hauteur_sous_plafond']) }} m³</strong></p></td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <li>
                                            <p>Température ambiante souhaitée</p>
                                        </li>
                                    </ul>
                                </td>
                                <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Température_ambiante'] }} °C</strong></p></td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <li>
                                            <p>Température extérieure de base</p>
                                        </li>
                                    </ul>
                                </td>
                                <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Température_extérieure'] }} °C</strong></p></td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <li>
                                            <p>Coefficient de construction</p>
                                        </li>
                                    </ul>
                                </td>
                                <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Coefficient_de_construction'] }}</strong></p></td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td align="right">
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-05/pdf_assets/images/table.png' }}" alt="table" height="150" class="d-block">
                </td>
            </tr>
        </table>
        <br>
        <div class="box">
            <ul>
                <li><p>Les déperditions concernent les pièces du logement desservies par le réseau de chauffage, sans considération des éventuels autres générateurs présents, sont donc estimés à &nbsp;<strong class="dotted-line">{{ frenceNumberFormat($data['déperditions']) }} Watts</strong>, soit &nbsp;<strong class="dotted-line">{{ frenceNumberFormat($data['Puissance_définie_du_à_la_température']) }} KWs</strong></p></li>
                <li><p>Le dimensionnement correct du matériel à installer est donc de &nbsp;<strong class="dotted-line">{{ frenceNumberFormat($data['Puissance_définie_du_à_la_température']) }} KWs</strong></p></li>
                <li><p>Puissance définie du matériel à la température de base : &nbsp;<strong class="dotted-line">{{ frenceNumberFormat($data['Puissance_définie_du_à_la_température']) }} KWs</strong></p></li>
                <li><p>Taux de couverture par rapport aux besoins de chauffage à la température de base (en %) &nbsp;<strong class="dotted-line">{{ $data['Taux_de_couverture'] }} %</strong><br><small>(Puissance définie du produit x 100) / Déperdition du logement</small></p></li>
            </ul>
        </div>
        <br>
        <table class="w-100">
            <tr>
                <td style="vertical-align: top;">
                    <table>
                        <tr>
                            <td>Fait à &nbsp;&nbsp;</td>
                            <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Fait_à'] }}</strong></p></td>
                        </tr>
                        <tr>
                            <td>Date &nbsp;&nbsp;</td>
                            <td><p class="dotted-line"><strong>:</strong> <strong style="padding-left: 10px;">{{ $data['Le'] }}</strong></p></td>
                        </tr>
                    </table>
                </td>
                <td align="right" style="vertical-align: top;">
                    <p style="padding-right: 20px;">Cachet et Signature du professionnel</p>
                    <br>
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-05/pdf_assets/images/sign.png' }}" alt="sign" height="80" class="d-block">
                </td>
                <td width="60"></td>
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