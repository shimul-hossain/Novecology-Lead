<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -15</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-15/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="head" align="right">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-15/pdf_assets/images/pdf_15_logo.png' }}" alt="logo" height="56" class="head__image">
        <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-15/pdf_assets/images/pdf_15_logo1.png' }}" alt="logo" height="56">
    </div>
    <div class="body">
        <div align="center" class="box">
            <div class="title">ATTESTATION <br>ADRESSE DU LOGEMENT A RENOVER <br>MaPrimeRenov’</div>
        </div>
        <p>Je soussigné Mr / Mme <span class="dotted-line">{{ $data['NOM_CLIENT'] }}</span></p>
        <br>
        <p>Atteste par la présente que le logement à rénover dans le cadre des travaux de rénovation énergétique avec l’aide MaPrimeRenov’ est situé au :</p>
        <br>
        <p>Adresse : <span class="dotted-line">{{ $data['FULL_ADRESSE'] }}</span></p>
        <br>
        <p>Code postal : <span class="dotted-line">{{ $data['Code_Postal'] }}</span></p>
        <br>
        <p>Ville : <span class="dotted-line">{{ $data['Ville'] }}</span></p>
        <br>
        <p>J’atteste avoir un justificatif de propriété avec la même adresse du logement à rénover que mentionnée ci-dessus.</p>
        <br>
        <p>Les justificatifs autorisés par MaPrimeRénov’ sont l’un des justificatifs suivants : attestation notariale de propriété, avis de taxe foncière ou copie de l'acte d'acquisition</p>
        <br>
        <p>Date : <span class="dotted-line">{{ $data['DATE_DU_JOUR'] }}</span></p>
        <br>
        <p>Signature :</p>
    </div>
</body>
</html>
