<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -08</title> 
    <style>
        *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            font-family: sans-serif;
        }

        body{
            margin: 0;
            padding: 0;
            font-size: 16px;
            font-family: sans-serif;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        img{
            display: block;
            max-width: 100%;
        }

        p{
            line-height: 1.8;
        }

        @page {
            size: A4;
            margin-left: 0;
            margin-right: 0;
            margin-top: 0;
            margin-bottom: 0;
            -webkit-print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        .header{
            padding: 20px 30px 80px;
        }

        .body{
            padding-left: 40px;
            padding-right: 40px;
        }

        .title{
            color:white;
            text-align: center;
            font-weight: normal;
            margin-top: 0;
            margin-bottom: 50px;
            padding-top: 8px;
            padding-bottom: 8px;
            line-height: 1.4;
            background-color: #086FC6;
            width: 70%;
            font-family: "SF Pro Display Bold", sans-serif;
        }

        .footer{
            font-size: 8pt;
            /* position: absolute; */
            width: 100%;
            /* right: 0;
            bottom: 30px;
            left: 0; */
            text-align: center;
            margin-top: -100px;
            page-break-before: always;
        }

        .footer p{
            line-height: 1.2;
        }

        .main-table{
            width: 100%;  
        }
        .main-table tr td{
            padding: 0;
            margin: 0;
            width: 50%;  
        }

        .input-field{ 
            font-size: 13px; 
            border-color: #dddddd;
            height: 2.4rem;
            text-shadow: none !important;
            border-radius: 3px;
            box-shadow: none!important;
            display: block;
            width: 100%; 
            padding: 0 12px; 
            font-weight: 400;
            line-height: 1.5; 
            background-clip: padding-box;
            border: 1px solid #ced4da; 
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            background-color: #f8c9cd;
            margin: 10px;
        }
        .input-field-disabled{ 
            font-size: 13px; 
            border-color: #dddddd;
            height: 2.4rem;
            text-shadow: none !important;
            border-radius: 3px;
            box-shadow: none!important;
            display: block;
            width: 100%; 
            padding: 0 12px; 
            font-weight: 400;
            line-height: 1.5; 
            background-clip: padding-box;
            border: 1px solid #ced4da; 
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            background-color: #ECF6FF;
            margin: 10px;
        }

    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('uploads/new/setting/logo.png') }}" alt="logo" width="190">
    </div>
    <div class="body">
        <center>
            <h3 class="title">NOTE DE DIMENSIONNEMENT</h3>
        </center>
        <table class="main-table">
            <tr>
                <td colspan="2">
                    <h2 >Bénéficiaire</h2>
                </td>
            </tr>
            <tr>
                <td>Nom</td>
                <td ><input type="text" @if (isset($data['Nom']))
                    value="{{ $data['Nom'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td>Adresse</td>
                <td ><input type="text" @if (isset($data['Adresse']))
                    value="{{ $data['Adresse'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2 style="margin: 10px 0">Caractéristique de logement</h2>
                </td>
            </tr>
            <tr>
                <td>M2 superficie à chauffer</td>
                <td ><input type="text" @if (isset($data['M2_superficie_à_chauffer']))
                    value="{{ $data['M2_superficie_à_chauffer'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td>Hauteur sous plafond</td>
                <td ><input type="text" @if (isset($data['Hauteur_sous_plafond']))
                    value="{{ $data['Hauteur_sous_plafond'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td><p style="line-height: 1.2;"> Volume à chauffer <br>
                    <small><em> Surface chauffée x Hauteur sous plafond
                    </em></small></p></td>
                <td ><input type="text" @if (isset($data['Volume_à_chauffer']))
                    value="{{ $data['Volume_à_chauffer'] }}"
                @endif class="input-field-disabled"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2 style="margin: 40px 0">Coefficient global de déperdition</h2>
                </td>
            </tr>
            <tr>
                <td>Coefficient</td>
                <td ><input type="text" @if (isset($data['Coefficient']))
                    value="{{ $data['Coefficient'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <h2 style="margin: 25px 0">Zone climatique</h2>
                </td>
            </tr>
            <tr>
                <td>Zone</td>
                <td ><input type="text" @if (isset($data['Zone']))
                    value="{{ $data['Zone'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td>Altitude</td>
                <td ><input type="text" @if (isset($data['Altitude']))
                    value="{{ $data['Altitude'] }}"
                @endif class="input-field"></td>
            </tr>
        </table> 
        <div style="page-break-after: always;"></div>
        <table class="main-table">
            <tr>
                <td>Température extérieure de base</td>
                <td ><input type="text" @if (isset($data['Température_extérieure_de_base']))
                    value="{{ $data['Température_extérieure_de_base'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td>Température ambiante souhaitée</td>
                <td ><input type="text" @if (isset($data['Température_ambiante_souhaitée']))
                    value="{{ $data['Température_ambiante_souhaitée'] }}"
                @endif class="input-field"></td>
            </tr>
            <tr>
                <td>Ecart température</td>
                <td ><input type="text" @if (isset($data['Ecart_température']))
                    value="{{ $data['Ecart_température'] }}"
                @endif class="input-field-disabled"></td>
            </tr>
        </table> 
        <h2 style="margin: 25px 0">Résultats </h2>
        <p>
            Les déperditions concernent les pièces du logement desservies par le réseau de chauffage, sans considération des éventuels autres générateurs présents, sont donc estimés à …… {{ $data['resultWith100Input'] }} …….
        </p>

    </div>
    <div class="footer">
        <p><strong>NOVECOLOGY</strong> - 2 Rue du Pré des Aulnes 77340 Pontault-Combault - <a href="mailto:support@novecology.fr">support@novecology.fr</a></p>
        <p>SAS au capital de 10 000€- SIRET 849 947 809 00026 - APE/NAF 4322B - TVA FR74 849 947 809</p>
        <p>Assurance de responsabilité décennale n°41563726B/S17603428, souscrite auprès de GROUPAMA</p>
    </div>
</body>
</html>
<script>
    window.print()
</script>
