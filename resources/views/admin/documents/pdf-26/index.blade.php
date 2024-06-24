<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF 26</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page">
        <div class="body">
            <table class="w-100">
                <tr>
                    <td style="padding-left: 10px;">
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/badge.png' }}" alt="badge" height="100">
                    </td>
                    <td align="right" style="padding-right: 20px;">
                        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/logo.png' }}" alt="logo" height="40">
                    </td>
                </tr>
            </table>
            <p>Le dispositif national des certificats d’économies d’énergie (CEE) mis en place par le Ministère de la Transition Ecologique et Solidaire impose à l’ensemble des fournisseurs d’énergie (électricité, gaz, fioul domestique, chaleur ou froid, carburants automobiles), de réaliser des économies et de promouvoir les comportements vertueux auprès des consommateurs d’énergie.</p>
            <p>Dans ce cadre, la société VERTIGO s’engage à vous apporter :</p>
            <div style="padding-left: 50px;">
                <table>
                    <tr>
                        <td>
                            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/checkbox-checked.png' }}" alt="checkbox" width="15" class="d-block">
                        </td>
                        <td style="padding-left: 6px;">une prime d’un montant de <span class="blue-solid-line">&nbsp;&nbsp;{{ $data['prime_montant'] }}&nbsp;&nbsp;</span> euros;</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" class="d-block">
                        </td>
                        <td style="padding-left: 6px;">un bon d’achat pour des produits de consommation courante d’un montant de [à compléter en €] euros ;</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" class="d-block">
                        </td>
                        <td style="padding-left: 6px;">un prêt bonifié d’un montant de <span class="text-blue">[à compléter]</span> euros proposés par <span class="text-blue">[nom de l’organisme financier]</span> au taux effectif global (TEG) de <span class="text-blue">[à compléter]</span> % (valeur de la bonification = <span class="text-blue">[à compléter à €])</span> ;</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" class="d-block">
                        </td>
                        <td style="padding-left: 6px;">un audit ou conseil personnalisé, remis sous forme écrite au bénéficiaire (valeur =€ ) ;</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/checkbox.png' }}" alt="checkbox" width="15" class="d-block">
                        </td>
                        <td style="padding-left: 6px;">un produit ou service offert <span class="text-blue blue-dotted-line">: &nbsp;&nbsp;[nature à préciser]&nbsp;&nbsp;</span> d’une valeur de <span class="dotted-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>€ dans le cadre des travaux suivants (1 ligne par opération) :</td>
                    </tr>
                </table>
            </div>
            <br>
            <br>
            <table class="table w-100" border="1" style="table-layout: fixed;">
                <tr>
                    <td align="center"><strong class="text-blue">Nature des travaux</strong></td>
                    <td align="center" width="180" style="width: 180px;"><strong class="text-blue">Fiche CEE</strong></td>
                    <td align="center"><strong class="text-blue">Conditions à respecter</strong></td>
                </tr>
                <tr>
                    <td>
                        <br>
                        @php
                            $Nature_des_travaux = explode('--', $data['Nature_des_travaux']);
                        @endphp
                        @if (count($Nature_des_travaux) > 1)
                            {{ $Nature_des_travaux[1] }}
                        @endif
                        <br>
                        &nbsp;
                        <br>
                    </td>
                    <td align="center" width="180" style="width: 180px;">
                        @if (count($Nature_des_travaux) > 1)
                            {{ $Nature_des_travaux[0] }}
                        @endif
                    </td>
                    <td style="vertical-align: top;">Voir le site du Ministère de l’Ecologie et de la Transition Ecologique et Solidaire : https:// <span class="text-link">www.ecologique-solidaire.gouv.fr/operations-standardisees-deconomies-denergie</span> et sur le devis</td>
                </tr>
            </table>
            <br>
            <br>
            <p>au bénéfice de :</p>
            <ul>
                <li>Nom : <span class="solid-line">&nbsp;&nbsp; {{ $data['Nom'] }} &nbsp;&nbsp;</span></li>
                <li>Prénom : <span class="solid-line">&nbsp;&nbsp; {{ $data['Prénom'] }} &nbsp;&nbsp;</span></li>
                <li>Adresse : <span class="solid-line">&nbsp;&nbsp; {{ $data['Adresse'] }} &nbsp;&nbsp;</span></li>
                <li>Téléphone : <span class="solid-line">&nbsp;&nbsp; {{ $data['Téléphone'] }} &nbsp;&nbsp;</span></li>
                <li>Adresse E-mail : <span class="solid-line">&nbsp;&nbsp; {{ $data['Email'] }} &nbsp;&nbsp;</span></li>
            </ul>
            <br>
            <p>
                Date de cette proposition : {{ $data['Date_de_cette_proposition'] }}
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/stamp.png' }}" alt="stamp" height="100" style="float: right; margin-top: -50px;">
            </p>
            <div align="right">
                <div align="left" style="display: inline-block; margin-right: -50px;">
                    <p>Signature :</p>
                    <p>Benjamin HENRY</p>
                    <p>Directeur Général de VERTIGO</p>
                </div>
            </div>
            <br>
            <p><img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/text-image.png' }}" alt="text" width="20" style="vertical-align: middle;"> Faites réaliser plusieurs devis afin de prendre une décision éclairée. Attention, seules les propositions remises avan l’acceptation du devis ou du bon de commande sont valables, et vous ne pouvez pas cumuler plusieurs offres CEE différente pour la même opération.</p>
            <div class="blue-box">
                <p><span class="solid-line">Où se renseigner pour bénéficier de cette offre ?</span></p>
                <p align="center"><span class="text-link">https://vertigo-energy.com/primes-certificats-deconomies-denergie/coup-de-pouce/</span></p>
                <p align="center"><span class="text-link">https://www.ecologie.gouv.fr/operations-standardisees-deconomies-denergie</span></p>
                <br>
                <p><span class="solid-line">Où s’informer sur les aides pour les travaux d’économies d’énergie ?</span></p>
                <p align="center"><strong>Site du réseau FAIRE :</strong><span class="text-link">https://www.faire.gouv.fr</span></p>
                <br>
                <p align="center"><span class="text-link">Tél. :</span>&nbsp;&nbsp; <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-26/pdf_assets/images/number-image.png' }}" alt="number" height="30" style="vertical-align: bottom;"></p>
                <br>
                <p><span class="text-link">En cas de litige avec le porteur de l’offre ou son partenaire, vous pouvez faire appel gratuitement au médiateur de la consommation (6° de l’article L. 6111-1 du code de la consommation)</span></p>
                <br>
                <p align="center"><strong class="big">Centre de Médiation et d’Arbitrage de Paris (CMAP)</strong></p>
                <ul>
                    <li>formulaire à disposition sur le site du CMAP à l’adresse www.mediateur-conso.cmap.fr,</li>
                    <li>courrier électronique : consommation@cmap.fr,</li>
                    <li>courrier postal à l’adresse CMAP – Service Médiation de la consommation, 39 avenue Franklin Roosevelt, 75008 Paris.</li>
                </ul>
            </div>
        </div>
        <p align="right">p 1 sur 1</p>
    </div>
</body>
</html>
