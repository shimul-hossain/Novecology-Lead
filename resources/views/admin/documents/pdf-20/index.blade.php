<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -20</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('crm_assets/pdf_assets/pdf-20/pdf_assets/css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-20/pdf_assets/css/style.css' }}">
</head>
<body>
    <!-- page 1 start -->
    <div class="page">
        <div class="header-logo-area">
            <div class="logo-item top-left-logo">
                {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-left-img.png') }}" alt="left-img"> --}}
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-left-img.png' }}" alt="left-img">
            </div>
            <div class="logo-item logo-title">
                <p class="header-title">DIRECTION GÉNÉRALE DES FINANCES PUBLIQUES</p>
            </div>
            <div class="logo-item top-right-logo">
                <p class="pera1">N°1301-SD</p>
                {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-right-img.png') }}" alt="right-img"> --}}
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-right-img.png' }}" alt="right-img">
                <p class="pera2">N°13948*05</p>
                <p class="pera pera3">(09-2016)</pc>
            </div>
        </div>
        <div class="container">
            <!-- header area start -->
            <div class="header">
                <span class="header-title1">ATTESTATION SIMPLIFIEE <span class="header-power">1</span></span>
            </div>    
            <!-- header area end -->

            <!-- body area start -->
            <div class="pera-area">
                <p class="pera pera4"><a class="serial-number">1</a> IDENTITÉ DU CLIENT OU DE SON REPRÉSENTANT :</p>
                <p class="pera">Je soussigné(e) :</p>
                <div class="first-field-area d-flex">
                    <p class="pera text-italic">Nom : <span class="dash">{{ $data['Nom'] }}</span></p>
                    <p class="pera text-italic">Prénom : <span class="dash">{{ $data['Prénom'] }}</span></p>
                </div>
                <div class="second-field-area d-flex">
                    <p class="pera text-italic">Adresse : <span class="dash">{{ $data['Adresse'] }}</span></p>
                    <p class="pera text-italic">Code postal : <span class="dash">{{ $data['Code_postal'] }}</span></p>
                    <p class="pera text-italic"> Commune<span class="dash">{{ $data['Commune'] }}</span></p>
                </div>
            </div>
            <div class="pera-area pera-area1">
                <p class="pera pera4"><a class="serial-number">2</a> NATURE DES LOCAUX</p>
                <p class="pera pera5">J’atteste que les travaux à réaliser portent sur un immeuble achevé depuis plus de deux ans à la date de commencement des travaux et
                    affecté à l’habitation à l’issue de ces travaux :
                </p>
                <div class="checkbox d-flex">
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px; ">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['NATURE_DES_LOCAUX']) && in_array('maison ou immeuble individuel', $data['NATURE_DES_LOCAUX']))&check;@endif</span>
                        <span class="pera text-italic">maison ou immeuble individuel</span>
                    </div>
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['NATURE_DES_LOCAUX']) && in_array('immeuble collectif', $data['NATURE_DES_LOCAUX']))&check;@endif</span>
                        <span class="pera text-italic">immeuble collectif</span>
                    </div>
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['NATURE_DES_LOCAUX']) && in_array('appartement individuel', $data['NATURE_DES_LOCAUX']))&check;@endif</span>
                        <span class="pera text-italic">appartement individuel</span>
                    </div>
                </div>
                <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                    <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['NATURE_DES_LOCAUX']) && in_array('autre (précisez la nature du local à usage d’habitation)', $data['NATURE_DES_LOCAUX']))&check;@endif</span>
                    <span class="pera text-italic">autre (précisez la nature du local à usage d’habitation)</span>
                    <span class="dash"> {{ $data['NATURE_DES_LOCAUX_autre'] }}</span>
                </div>
                <p class="pera">Les travaux sont réalisés dans :</p>
                <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                    <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Les_travaux_sont_réalisés_dans']) && in_array('un local affecté exclusivement ou principalement à l’habitation', $data['Les_travaux_sont_réalisés_dans']))&check;@endif</span>
                    <span class="pera text-italic">un local affecté exclusivement ou principalement à l’habitation</span>
                </div>
                <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                    <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Les_travaux_sont_réalisés_dans']) && in_array('des pièces affectées exclusivement', $data['Les_travaux_sont_réalisés_dans']))&check;@endif</span>
                    <span class="pera text-italic">des pièces affectées exclusivement à l’habitation situées dans un local affecté pour moins de 50 % à cet usage</span>
                </div>
                <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                    <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Les_travaux_sont_réalisés_dans']) && in_array('des parties communes de locaux affectés exclusivement', $data['Les_travaux_sont_réalisés_dans']))&check;@endif</span>
                    <span class="pera text-italic">des parties communes de locaux affectés exclusivement ou principalement à l’habitation dans une proportion de (……………….)
                        millièmes de l’immeuble</span>
                </div>
                <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                    <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['Les_travaux_sont_réalisés_dans']) && in_array('un local antérieurement affecté à un usage autre', $data['Les_travaux_sont_réalisés_dans']))&check;@endif</span>
                    <span class="pera text-italic">un local antérieurement affecté à un usage autre que d’habitation et transformé à cet usage</span>
                </div>
                <div class="third-field-area d-flex">
                    <p class="pera text-italic pera6">Adresse<span class="address-power">2</span>   <span class="clone">:</span> <span class="dash">{{ $data['Adresse2'] }}</span></p>
                    <p class="pera text-italic"> Commune<span class="dash">{{ $data['Code_postal2'] }}</span></p>
                    <p class="pera text-italic">Code postal : <span class="dash">{{ $data['Commune2'] }}</span></p>
                </div>
                <div class="fourth-field-area d-flex">
                    <p class="pera">dont je suis : </p>
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['dont_je_suis']) && in_array('propriétaire', $data['dont_je_suis']))&check;@endif</span>
                        <span class="pera text-italic">propriétaire</span>
                    </div>
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['dont_je_suis']) && in_array('locataire', $data['dont_je_suis']))&check;@endif</span>
                        <span class="pera text-italic">locataire</span>
                    </div>
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span style="display: grid; place-items:center" class="custom-bullet-point">@if (isset($data['dont_je_suis']) && in_array('autre (précisez votre qualité)', $data['dont_je_suis']))&check;@endif</span>
                        <span class="pera text-italic">autre (précisez votre qualité) :</span>
                        <span class="dash">{{ $data['dont_je_suis_autre'] }}</span>
                    </div>
                </div>
            </div>
            <div class="pera-area pera-area2">
                <p class="pera pera4"><a class="serial-number">3</a> NATURE DES TRAVAUX</p>
                <p class="pera pera5">J’atteste que <span class="text-underline">sur la période de deux ans précédant ou suivant la réalisation des travaux décrits dans la présente attestation</span>, les
                    travaux :
                </p>
                <div class="checkbox d-flex">
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span style="display: grid; place-items:center; flex-shrink: 0;" class="custom-bullet-point">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('n’affectent ni les fondations', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                        <span class="pera text-italic">n’affectent ni les fondations, ni les éléments, hors fondations, déterminant la résistance et la rigidité de l’ouvrage, ni la
                            consistance des façades (hors ravalement).</span>
                    </div>
                </div>
                <div class="checkbox d-flex">
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span style="display: grid; place-items:center; flex-shrink: 0;" class="custom-bullet-point">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('n’affectent pas plus de cinq des six', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                        <span class="pera text-italic">n’affectent pas plus de cinq des six éléments de second œuvre suivants :</span>
                    </div>
                </div>
                
                <!-- <p > <a class="checked checked2">&check;</a>  <a class="checked checked2">&check;</a> s <a class="checked checked2">&check;</a>  <a class="checked checked2">&check;</a>  <a class="checked checked2">&check;</a> 
                    <a class="checked checked2">&check;</a> </p> -->
                    <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                        <span class="pera pera7 text-italic">Cochez les cases correspondant aux éléments affectés :
                        <span style="display: inline-grid; place-items:center; flex-shrink: 0; margin-right: 5px;" class="custom-bullet-point checked2">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('planchers qui ne déterminent pas', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>planchers qui ne déterminent pas la résistance ou la rigidité de
                            l’ouvrage <span style="display: inline-grid; place-items:center; flex-shrink: 0; margin-right: 3px;" class="custom-bullet-point checked2">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('huisseries extérieures', $data['NATURE_DES_TRAVAUX']))&check;@endif</span> huisseries extérieure
                            <span style="display: inline-grid; place-items:center; flex-shrink: 0; margin-right: 3px;" class="custom-bullet-point checked2">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('cloisons intérieures', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                            cloisons intérieures
                            <span style="display: inline-grid; place-items:center; flex-shrink: 0; margin-right: 3px;" class="custom-bullet-point checked2">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('installations sanitaires et de plomberie', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                            installations sanitaires et de plomberie
                            <span style="display: inline-grid; place-items:center; flex-shrink: 0; margin-right: 3px;" class="custom-bullet-point checked2">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('installations électriques', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                            installations électriques
                            <span style="display: inline-grid; place-items:center; flex-shrink: 0; margin-right: 3px;" class="custom-bullet-point checked2">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('système de chauffage', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                            système de chauffage (pour les immeubles situés en métropole)
                        </span>
                    </div>
                
                <p class="pera">NB : tous autres travaux sont sans incidence sur le bénéfice du taux réduit.</p>
                <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 3px">
                    <span style="display: grid; place-items:center; flex-shrink: 0;" class="custom-bullet-point">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('n’entraînent pas une augmentation de la', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                    <span class="pera text-italic">n’entraînent pas une augmentation de la surface de plancher de la construction existante supérieure à 10 %</span>
                </div>
                <div class="d-flex" style="align-items: center; gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 4px">
                    <span style="display: grid; place-items:center; flex-shrink: 0;" class="custom-bullet-point">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('ne consistent pas en une surélévation ou une addition de construction.', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                    <span class="pera text-italic">ne consistent pas en une surélévation ou une addition de construction.</span>
                </div>
                <div class="d-flex" style=" gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 4px">
                    <span style="display: grid; place-items:center; flex-shrink: 0;" class="custom-bullet-point">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('J’atteste que les travaux visent', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                    <span class="pera text-italic">J’atteste que les travaux visent à améliorer la qualité énergétique du logement et portent sur la fourniture, la pose, l’installation ou
                        l’entretien des matériaux, appareils et équipements dont la liste figure dans la notice (1 de l’article 200 quater du code général des
                        impôts – CGI) et respectent les caractéristiques techniques et les critères de performances minimales fixés par un arrêté du ministre
                        du budget (article 18 bis de l’annexe IV au CGI).
                    </span>
                </div>
                <div class="d-flex" style=" gap:5px; line-height: 1; margin-bottom: 3px; margin-top: 4px">
                    <span style="display: grid; place-items:center; flex-shrink: 0;" class="custom-bullet-point">@if (isset($data['NATURE_DES_TRAVAUX']) && in_array('J’atteste que les travaux ont la nature', $data['NATURE_DES_TRAVAUX']))&check;@endif</span>
                    <span class="pera text-italic">J’atteste que les travaux ont la nature de travaux induits indissociablement liés à des travaux d’amélioration de la qualité
                        énergétique soumis au taux de TVA de 5,5 %.
                    </span>
                </div>
            </div>
            <div class="pera-area pera-area3">
                <p class="pera pera4"><a class="serial-number">4</a> CONSERVATION DE L’ATTESTATION ET DES PIÈCES JUSTIFICATIVES</p>
                <p class="pera pera8">
                    Je conserve une copie de cette attestation ainsi que de toutes les factures ou notes émises par les entreprises prestataires jusqu’au
                    31 décembre de la cinquième année suivant la réalisation des travaux et m’engage à en produire une copie à l’administration fiscale
                    sur sa demande.
                </p>
            </div>
            <div class="pera-area pera-area4">
                <div class="inner-pera-area">
                    <p class="pera">Si les mentions portées sur l’attestation s’avèrent inexactes de votre fait et ont eu pour conséquence l’application erronée du taux
                        réduit de la TVA, vous êtes solidairement tenu au paiement du complément de taxe résultant de la différence entre le montant de la
                        taxe due (TVA au taux de 20 % ou 10 %) et le montant de la TVA effectivement payé au taux de :
                    </p>
                    <div class="d-flex">
                        <p class="pera">- </p>
                        <p class="pera pera9">10 % pour les travaux d’amélioration, de transformation, d’aménagement et d’entretien portant sur des locaux à usage
                            d’habitation achevés depuis plus de 2 ans ;</p>
                    </div>
                    <div class="d-flex">
                        <p class="pera">- </p>
                        <p class="pera pera9">5,5 % pour les travaux d’amélioration de la qualité énergétique des locaux à usage d’habitation achevés depuis plus de 2 ans
                            ainsi que sur les travaux induits qui leur sont indissociablement liés.</p>
                    </div>
                </div>
            </div>
            <div class="footer-field-area">
                <div class="footer-field1">
                    <p class="pera pera10">Fait à<span class="dash">{{ $data['Fait_à'] }}</span>, le<span class="dash">{{ $data['Le'] }}</span></p>
                </div>
                <div class="footer-field2">
                    <p class="pera pera11">Signature du client ou de son représentant :</p>
                </div>
            </div>
            <div class="footer-text">
                <p class="pera pera12"><span class="footer-power">1</span>Pour remplir cette attestation, cochez les cases correspondant à votre situation et complétez les rubriques en pointillés. Vous pouvez vous aider de la notice explicative</p>
                <p class="pera pera13"><span class="footer-power">2</span>
                    Si différente de l’adresse indiquée dans le cadre <a class="serial-number">1</a></p>
                <div class="footer-img">
                    {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-footer-img.png') }}" alt="footer-img"> --}}
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-footer-img.png' }}" alt="footer-img">
                </div>
            </div>
            <!-- body area end -->
        </div>
        <!-- <div class="footer-line"></div> -->
    </div>
    <!-- page 1 end -->

    <!-- page 2 start -->
    <div class="page">
        <p class="pera1 page-pera1">N°1301-SD-NOT</p>
        <div class="header-logo-area">
            <div class="logo-item top-left-logo">
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-left-img.png' }}" alt="left-img">
                {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-left-img.png') }}" alt="left-img"> --}}
            </div>
            <div class="logo-item logo-title">
                <p class="header-title">DIRECTION GÉNÉRALE DES FINANCES PUBLIQUES</p>
            </div>
            
            <div class="logo-item top-right-logo">
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-right-img.png' }}" alt="right-img">
                {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-right-img.png') }}" alt="right-img"> --}}
                <p class="pera2">N°51383#05</p>
                <p class="pera page2-pera3">(09-2016)</pc>
            </div>
        </div>
        <div class="container">
            <!-- header area start -->
            <div class="header">
                <span class="header-title1">NOTICE (ATTESTATION SIMPLIFIEE)</span>
            </div>    
            <!-- header area end -->

            <!-- body area start -->
            <div class="pera-area">
                <p class="pag2-pera text-bold">           
                    Le taux réduit de TVA de 10 % prévu à l’article 279-0 bis du code général des impôts (CGI) s’applique, sous certaines
                    conditions, aux travaux d’amélioration, de transformation, d’aménagement et d’entretien de locaux à usage d’habitation achevés
                    depuis plus de deux ans.
                </p>
                <p class="pag2-pera pera19 text-bold">Le taux réduit de TVA de 5,5 % prévu à l’article 278-0 bis A du code général des impôts (CGI) s’applique, sous certaines
                    conditions, aux travaux d’amélioration de la qualité énergétique des locaux à usage d’habitation achevés depuis plus de deux ans
                    ainsi que sur les travaux induits qui leur sont indissociablement liés.</p>
                <p class="pag2-pera text-bold">Pour bénéficier des taux réduits vous devez attester que ces conditions sont réunies.</p>    
                <p class="pag2-pera pera20 text-bold">Deux modèles d’attestation sont à votre disposition pour effectuer cette démarche.</p>    
                <p class="pag2-pera text-bold">Vous pouvez utiliser l’attestation simplifiée pour tous les travaux n’affectant, sur une période de deux ans, aucun des éléments de
                    gros œuvre et pas plus de cinq des six lots de second œuvre définis au 2) du A ci-dessous. L’attestation normale est à utiliser dans
                    les autres cas.</p>    
                
                <p class="pag2-pera pera21 text-bold">
                    NOTA : Afin d’alléger la charge administrative pesant sur les clients et les professionnels, il est admis que l’attestation simplifiée
                    ne soit pas établie lorsque le montant des travaux pour réparation et entretien, toutes taxes comprises, est inférieur à 300 euros, à
                    condition que la facture comporte les informations suivantes : nom et adresse du client et de l’immeuble objet des travaux,
                    nature des travaux et mention selon laquelle l’immeuble est achevé depuis plus de 2 ans.
                </p>
            </div> 
            <p class="pag2-pera text-bold pera14">
                A – Quel est l’objet de cette attestation ?
            </p>
            <p class="pag2-pera pera15">Elle garantit que sont réunies les conditions prévues :</p>
            <div class="d-flex">
                <p class="pag2-pera">- </p>
                <p class="pag2-pera pera16">
                    par l’article 279-0 bis du code général des impôts (CGI) pour bénéficier du taux réduit de 10 % de la taxe sur la valeur ajoutée
                    (TVA) sur les travaux d’amélioration, de transformation, d’aménagement et d’entretien, autres que ceux mentionnés à
                    l’article 278-0 bis A du CGI, de locaux à usage d’habitation achevés depuis plus de deux ans,
                </p>
            </div>
            <div class="d-flex">
                <p class="pag2-pera pera17">- </p>
                <p class="pag2-pera pera18">
                    par l’article 278-0 bis A du code général des impôts (CGI) pour bénéficier du taux réduit de 5,5 % de la taxe sur la valeur ajoutée
                    (TVA) sur les travaux d’amélioration de la qualité énergétique des locaux à usage d’habitation achevés depuis plus de deux ans ainsi
                    que sur les travaux induits qui leur sont indissociablement liés. Les travaux portent sur la fourniture, la pose, l’installation et
                    l’entretien des matériaux, appareils et équipements mentionnés au 1 de l’article 200 quater du CGI, à savoir :
                </p>
            </div>
            <div class="page2-list">
                <p class="pag2-pera">– les chaudières à haute performance énergétique ;</p>
                <p class="pag2-pera list-pera-gap">– les matériaux d’isolation thermique des parois vitrées, de volets isolants ou de portes d’entrée donnant sur l’extérieur ;</p>
                <p class="pag2-pera list-pera-gap">– les matériaux d’isolation thermique des parois opaques, dans la limite d’un plafond de dépenses par mètre carré ;</p>
                <p class="pag2-pera list-pera-gap">– les matériaux de calorifugeage de tout ou partie d’une installation de production ou de distribution de chaleur ou d’eau chaude
                    sanitaire ;</p>
                <p class="pag2-pera list-pera-gap">– les appareils de régulation de chauffage ;</p>
                <p class="pag2-pera list-pera-gap">– les équipements de chauffage ou de fourniture d’eau chaude sanitaire utilisant une source d’énergie renouvelable, dans la
                    limite d’un plafond de dépenses par mètre carré de capteurs solaires pour les équipements de chauffage ou de fourniture d’eau
                    chaude sanitaire utilisant l’énergie solaire thermique, fixé par arrêté conjoint des ministres chargés de l’énergie, du logement et
                    du budget</p>
                <p class="pag2-pera list-pera-gap">– les équipements intégrant un équipement de production d’électricité utilisant l’énergie radiative du soleil et un équipement de
                    chauffage ou de production d’eau chaude sanitaire utilisant l’énergie solaire thermique dans la limite d’une surface de capteurs
                    solaires fixée par arrêté conjoint des ministres chargés de l’énergie, du logement et du budget, et après application à la surface
                    ainsi déterminée d’un plafond de dépenses par mètre carré de capteurs solaires ;
                </p>
                <p class="pag2-pera list-pera-gap">– les systèmes de fourniture d’électricité à partir de l’énergie hydraulique ou à partir de la biomasse ;</p>
                <p class="pag2-pera list-pera-gap">– les pompes à chaleur, autres que air/air, dont la finalité essentielle est la production de chaleur ou d’eau chaude sanitaire ainsi
                    que l’échangeur de chaleur souterrain des pompes à chaleur géothermiques ;
                </p>
                <p class="pag2-pera list-pera-gap">– les équipements de raccordement à un réseau de chaleur, alimenté majoritairement par des énergies renouvelables ou par une
                    installation de cogénération ;</p>
                <p class="pag2-pera list-pera-gap">– les chaudières à micro-cogénération gaz d’une puissance de production électrique inférieure ou égale à
                    3 kilovolt-ampères (kvA) par logement ;</p>
                <p class="pag2-pera list-pera-gap">– les appareils permettant d’individualiser les frais de chauffage ou d’eau chaude sanitaire dans un bâtiment équipé d’une
                    installation centrale ou alimenté par un réseau de chaleur ;</p>
                <p class="pag2-pera list-pera-gap">– les systèmes de charge pour véhicules électriques.</p>
            </div>
            <div class="page2-footer-text footer-text">
                <div class="footer-img">
                    <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-footer-img.png' }}" alt="footer-img">
                    {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-20/pdf_assets/images/pdf-20-footer-img.png') }}" alt="footer-img"> --}}
                </div>
            </div>
            <!-- body area end -->
        </div>
        <!-- <div class="footer-line"></div> -->
    </div>
    <!-- page 2 end -->

    <!-- page 3 start -->
    <div class="page">
        <div class="container">
            <!-- body area start -->
            <div class="main-container">
                <p class="pera">Les taux réduits de TVA prévus aux articles 279-0 bis et 278-0 bis A du CGI ne s’appliquent pas aux travaux qui :</p>
                <div class="d-flex">
                    <p class="pera pera22">1) </p>
                    <p class="pera page3-top-list-gap pera22">
                        soit portent sur des locaux autres que d’habitation à l’issue des travaux, ou achevés depuis moins de deux ans ;
                    </p>
                </div>
                <div class="d-flex">
                    <p class="pera">2) </p>
                    <p class="pera page3-top-list-gap">
                        soit concourent à la production d’un immeuble neuf, c’est-à-dire les travaux qui rendent à l’état neuf le gros œuvre (la majorité des
                        fondations ou des autres éléments qui déterminent la résistance et la rigidité de l’ouvrage ou de la consistance des façades hors
                        ravalement) ou au moins deux tiers de chacun des éléments de second œuvre (les planchers non porteurs, c’est-à-dire ne déterminant
                        pas la résistance ou la rigidité de l’ouvrage ; les huisseries extérieures ; les cloisons intérieures ; les installations sanitaires et de
                        plomberie ; les installations électriques ; le système de chauffage (en métropole) ;
                    </p>
                </div>
                <div class="d-flex">
                    <p class="pera">3) </p>
                    <p class="pera page3-top-list-gap ">
                        soit augmentent la surface de plancher de la construction existante de plus de 10 % ;
                    </p>
                </div>
                <div class="d-flex">
                    <p class="pera">4) </p>
                    <p class="pera page3-top-list-gap ">
                        soit conduisent à une surélévation du bâtiment ou à une addition de construction ;
                    </p>
                </div>
                <div class="d-flex">
                    <p class="pera">5) </p>
                    <p class="pera page3-top-list-gap ">
                        soit consistent en des travaux de nettoyage, soit concernent l’aménagement et l’entretien des espaces verts, soit correspondent à la
                        fourniture d’équipements ménagers ou mobiliers ou de gros équipements listés à l’article 30-00 A de l’annexe IV au CGI
                        (uniquement pour l’appréciation du taux réduit de TVA portant sur les travaux mentionnés à l’article 279-0 bis du CGI).
                    </p>
                </div>
                <p class="pera text-bold pera24">B – Comment remplir cette attestation ?</p>
                <p class="pera">
                    Cadre <a class="serial-number">1</a> IDENTITÉ DU CLIENT OU DE SON REPRÉSENTANT : L’attestation est remplie par la personne qui fait effectuer les travaux
                    (propriétaire occupant, propriétaire bailleur, locataire, syndicat de copropriétaires, etc.). C’est à elle de justifier qu’elle a respecté les
                    mentions portées sur l’attestation. Si l’administration conteste les informations portées sur l’attestation, c'est l'administration qui devra
                    apporter la preuve que celles-ci sont inexactes.
                </p>
                <p class="pera pera24">
                    Cadre <a class="serial-number">2</a> NATURE DES LOCAUX : Pour bénéficier des taux réduits de la TVA, les travaux doivent porter sur des locaux à usage
                    d’habitation achevés depuis plus de deux ans. Les taux réduits sont également applicables aux travaux qui ont pour objet d’affecter
                    principalement à un usage d’habitation un local précédemment affecté à un autre usage sauf s’ils concourent à la production d’un
                    immeuble neuf.
                </p>
                <p class="pera pera23">
                    Cadre <a class="serial-number">3</a> NATURE DES TRAVAUX : cochez les cases correspondant à votre situation.
                </p>
                <p class="pera pera24 text-bold">C – A qui remettre l’attestation ?</p>
                <p class="pera pera23">Cadre <a class="serial-number">4</a> REMISE DE L’ATTESTATION ET CONSERVATION DES PIÈCES JUSTIFICATIVES : L’attestation, une fois complétée, datée et signée,
                    doit être remise au prestataire effectuant les travaux, avant leur commencement (ou au plus tard avant la facturation).
                </p>
                <p class="pera pera23">Lorsqu’il y a plusieurs prestataires, un original de l’attestation doit être remis à chacun d’entre eux</p>
                <p class="pera">Vous devez conserver une copie de l’attestation ainsi que l’ensemble des factures ou notes émises par le(s) prestataire(s) ayant réalisé des
                    travaux jusqu’au 31 décembre de la cinquième année suivant leur réalisation. En cas de réalisation de travaux d’amélioration de la qualité
                    énergétique, vous devez conserver la facture comportant les mentions prévues au b du 6 de l’article 200 quater du CGI.
                </p>
                <p class="pera pera23">Ces factures doivent comporter, outre les mentions prévues à l’article 289 :</p>
                <p class="pera">– le lieu de réalisation des travaux ;</p>
                <p class="pera pera23">– la nature de ces travaux ainsi que la désignation, le montant et, le cas échéant, les caractéristiques et les critères de performances des
                    équipements, matériaux et appareils ;</p>
                <p class="pera">– dans le cas de l’acquisition et de la pose de matériaux d’isolation thermique des parois opaques, la surface en mètres carrés des parois
                    opaques isolées, en distinguant ce qui relève de l’isolation par l’extérieur de ce qui relève de l’isolation par l’intérieur ;
                </p>
                <p class="pera pera23">
                    – dans le cas de l’acquisition d’équipements de production d’énergie utilisant une source d’énergie renouvelable, la surface en mètres
                    carrés des équipements de production d’énergie utilisant l’énergie solaire thermique.
                </p>
                <p class="pera">
                    Elles devront en effet être produites si l’administration vous demande de justifier de l’application du taux réduit de la TVA.
                </p>
                <p class="pera text-bold pera24">D – Quelles sont les conséquences de la remise d’une attestation erronée ?</p>
                <p class="pera">Si les mentions portées sur l’attestation s’avèrent inexactes de votre fait et ont eu pour conséquence l’application erronée du taux réduit
                    de la TVA, vous êtes solidairement tenu au paiement du complément de taxe résultant de la différence entre le montant de la taxe due
                    (TVA au taux de 20 % ou 10 %) et le montant effectivement payé, TVA au taux de :
                </p>
                <p class="pera pera23">
                    – 10 % pour les travaux d’amélioration, de transformation, d’aménagement et d’entretien portant sur des locaux à usage d’habitation
                    achevés depuis plus de 2 ans ;
                </p>
                <p class="pera">– 5,5 % pour les travaux d’amélioration de la qualité énergétique des locaux à usage d’habitation achevés depuis plus de
                    2 ans ainsi que sur les travaux induits qui leur sont indissociablement liés.
                </p>
                <p class="pera text-bold pera25">* *</p>
                <p class="pera">Pour toute question relative à ces attestations, vous pouvez consulter le site internet <a href="https://www.impots.gouv.fr">www.impots.gouv.fr</a>, rubrique « documentation »,
                    contacter « Impôts-Service » au 0810.IMPOTS (0810 467 687, prix d’un appel local depuis un poste fixe), ou vous adresser à votre
                    service des impôts (dont les coordonnées figurent en haut de votre déclaration de revenus). Toutes précisions sont apportées par ailleurs
                    dans le bulletin officiel des finances publiques-impôts (BOFiP – Impôts) BOI-TVA-LIQ-30-20-90 consultable sur le site Internet déjà
                    cité.</p>
            </div>

            <!-- body area end -->
        </div>
        <!-- <div class="footer-line"></div> -->
    </div>
    <!-- page 3 end -->
    <script>
        window.print();
    </script>
</body>
</html>