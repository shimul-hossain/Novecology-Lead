<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -01</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-01/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page">
        <center>
            <h1 class="title">ATTESTATION</h1>
        </center>
        <p>Je soussigné(é) Monsieur /Madame <span class="dotted-line">{{ $data['NOM_CLIENT'] }}</span></p>
        <p>Propriétaire occupant du logement à rénover situé a <span class="dotted-line">{{ $data['FULL_ADRESSE'] }}</span></p>
        <p>confirme être à l’origine du dossier MaPrimeRenov <span class="dotted-line">{{ $data['NUMERO_DOSSIER'] }}</span> crée avec mon adresse email <span class="dotted-line">{{ $data['Email'] }}</span> qui est l’une des adresses email que j’utilise.</p>
        <br>
        <br>
        <table>
            <tr>
                <td width="130"><p>Fait à</p></td>
                <td><p>:<span class="solid-line">{{ $data['Fait_à'] }}</span></p></td>
            </tr>
            <tr>
                <td width="130">Le</td>
                <td><p>:<span class="solid-line">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></p></td>
            </tr>
            <tr>
                <td width="130" style="vertical-align: top;"><p>Signature</p></td>
                <td>
                    <br><br>
                    <table border="3" cellspacing="0" cellpadding="0" style="border: 3px solid #000000; border-collapse: collapse; margin-left: 60px;">
                        <tr>
                            <td width="230" height="110" cellspacing="0" cellpadding="0" style="border-collapse: collapse;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
