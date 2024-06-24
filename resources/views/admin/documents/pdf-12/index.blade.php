<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -12</title>
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-12/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page">
        <div class="container">
            <div class="header">
                <h1 class="header1">INFORMATION PRECONTRACTUELLE</h1>
            </div>
            <form action="">
                <div class="input-group uper-body">
                    <div class="input-main">
                        <div class="field-title">
                            <p class="field-one">Le Client reconnait avoir reçu les informations préalables à la conclusion de son contrat de vente ou de contrat de
                                production portant sur :</p>
                        </div>
                    </div>
                </div>
                <div class="input-group uper-body">
                    <div class="second-main-field">
                        <ul>
                            <li>1° Les caractéristiques essentielles du bien ou du service ;</li>
                            <li>2° Le prix du bien ou du service ;</li>
                            <li>3° La date ou le délai auquel le professionnel s'engage à livrer le bien ou à exécuter le service ;</li>
                            <li>4° Les garanties et les autres conditions contractuelles ;</li>
                            <li class="last-listing">5° L’éventuelle existence, en fonction du mode de commercialisation, d’un droit de rétractation, de ses conditions,
                            délai et modalités d’exercice.</li>
                        </ul>
                    </div>
                </div>

                <div class="input-group uper-body">
                    <p class="field-one para-1">Cette information a été délivrée par la remise des CGV ou du projet de contrat (conditions particulières et
                        générales), et par un échange oral préalable à la conclusion du contrat.</p>
                </div>

                <div class="input-group uper-body">
                    <p class="field-one para-2">En signant ce document, le consommateur reconnaît avoir été informé de tous ces éléments et être en mesure
                        de donner un consentement libre et éclairé au contrat.</p>
                    <p class="field-one">Je soussigné Mr/Mme <span class="dotted-line"> {{ $data['NOM_CLIENT'] }}</span></p>
                </div>

                <div class="signature-box">
                    <div class="input-group">
                        <div class="input-main">
                            <div class="sig-input-title input-title1">
                                <p class="sig-title sig-title1">Fait à : <span class="second-input">{{ $data['Fait_à'] }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-main">
                            <div class="sig-input-title input-title2">
                                <p class="sig-title sig-title2">Le : <span class="third-input">{{ $data['Le'] }}</span></p></p>
                            </div>
                        </div>
                    </div>
                    <div class="signature-title">
                        <p class="sig-label">Signature :</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
