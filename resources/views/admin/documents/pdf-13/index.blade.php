<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -13</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-13/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page">
        <center>
            <h1 class="title"><u>DEMANDE DE COMMENCER LES PRESTATIONS AVANT LA FIN DU DELAI DE RETRACTATION DE 14 JOUR</u></h1>
        </center>
        <p>Je reconnais avoir été informé de mon droit à rétractation conformément à l’article L 221-18 du Code de la consommation qui me permet dans un délai de quatorze (14) jours à compter de la conclusion du contrat pour les contrats de prestation de services et de la réception du bien pour les contrats de vente de biens, d’exercer mon droit à rétractation.</p>
        <br>
        <p>Cependant, je souhaite que l'exécution de la prestation commence avant la fin du délai de rétractation de quatorze (14) jours.</p>
        <br>
        <p>Je suis informé que, conformément à l’article L 221-25 du Code de la consommation, le consommateur qui a exercé son droit de rétractation d'un contrat dont l'exécution a commencé, à sa demande expresse, avant la fin du délai de rétractation, verse au professionnel un montant correspondant au service fourni jusqu'à la communication de sa décision de se rétracter ; ce montant est proportionné au prix total de la prestation convenue dans le contrat ou si le prix total est excessif, le montant approprié est calculé sur la base de la valeur marchande de ce qui a été fourni</p>
        <br>
        <p>Cette information m’a été délivrée par la remise des CGV ou du projet de contrat (conditions particulières et générales), et par un échange oral préalable à la conclusion du contrat</p>
        <br>
        <p>En signant ce document, je reconnais avoir été informé de tous ces éléments et être en mesure de donner un consentement libre et éclairé au contrat.</p>
        <br>
        <br>
        <p>Fait à : {{ $data['Fait_à'] }}</p>
        <p>Le : {{ $data['Le'] }}</p>
        <br>
        <p>Signature :</p>
    </div>
</body>
</html>
