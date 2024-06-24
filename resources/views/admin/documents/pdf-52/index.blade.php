<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF 52</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-52/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="header">
        <img class="d-block w-100" src="{{ public_path().'/crm_assets/pdf_assets/pdf-52/pdf_assets/images/header-shape.png' }}" alt="shape">
    </div>
    <div class="body">
        <center>
            <h1 class="title">PROCES-VERBAL DE RECEPTION DES TRAVAUX</h1>
        </center>
        <br>
        <p>Nous vous remercions de la confiance que vous nous avez accordée pour la réalisation de votre chantier.</p>
        <br>
        <p>Je soussigné <span class="dotted-line">{{ $data['NOM_CLIENT'] }}</span> maitre de l’ouvrage, après avoir procédé à la visite des travaux effectués par l’entreprise NOVECOLOGY pour les travaux portant sur l’installation de :</p>
        <p style="padding-left: 20px;"><strong>- <span class="dotted-line">{{ $data['MATERIEL_UTILISE'] }}</span></strong></p>
        <br>
        <p>Déclare : (cocher la case appropriée)</p>
        <div style="padding-left: 20px;">
            <div class="list">
                <table class="w-100">
                    <tr>
                        <td>
                            <span class="list__square"></span>
                        </td>
                        <td>Accepter la réception des travaux sans réserve</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="list__square"></span>
                        </td>
                        <td>Accepter la réception assortie de réserves</td>
                    </tr>
                </table>
                <div class="list">
                    <table class="w-100">
                        <tr>
                            <td>
                                <span class="list__circle"></span>
                            </td>
                            <td>
                                Nature des réserves :
                                <p class="dotted-line"></p>
                                <p class="dotted-line">&nbsp;</p>
                                <p class="dotted-line">&nbsp;</p>
                                <p class="dotted-line">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="list__circle"></span>
                            </td>
                            <td>
                                Travaux à exécuter :
                                <p class="dotted-line"></p>
                                <p class="dotted-line">&nbsp;</p>
                                <p class="dotted-line">&nbsp;</p>
                                <p class="dotted-line">&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="list__circle"></span>
                            </td>
                            <td>
                                <p>Délai imparti à compter de ce jour :</p>
                                <p class="dotted-line"></p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <br>
            <p><small>La réception constitue également Ie point de départ de la garantie du bon fonctionnement prévu par I'articl 1792-3 du code civil et la responsabilité décennale des constructeurs définie aux articles 1792, 1792-2 et 2270 du code civil.</small></p>
            <p><small>En application de I’articIe 1792-6 du code civil, les entrepreneurs demeurent tenus de la garantie de parfai achèvement pendant I ’année qui suit la réception.</small></p>
        </div>
        <br>
        <table>
            <tr>
                <td width="130"><p>Fait à</p></td>
                <td><p>:<span class="solid-line">{{ $data['Fait_à'] }}</span></p></td>
            </tr>
            <tr>
                <td width="130">Le</td>
                <td>
                    <p>:<span class="solid-line">&nbsp;
                    @if(strtotime($data['Le']))
                        {{ \Carbon\Carbon::parse($data['Le'])->format('d-m-Y') }}
                    @else
                        {{ $data['Le'] }}
                    @endif &nbsp;</span>
                    </p>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="vertical-align: top;">
                    <br>
                    <p>Signature du déclarant</p>
                </td>
                <td>
                    <table border="3" cellspacing="0" cellpadding="0" style="border: 3px solid #000000; border-collapse: collapse; margin-left: 50px;">
                        <tr>
                            <td width="220" height="110" cellspacing="0" cellpadding="0" style="border-collapse: collapse;"></td>
                        </tr>
                    </table>
                </td>
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

