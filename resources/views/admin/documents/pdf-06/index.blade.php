<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF -06</title>
    {{-- <link rel="stylesheet" href="{{ asset('crm_assets/pdf_assets/pdf-06/pdf_assets/css/style.css') }}"> --}}
    <link rel="stylesheet" href="{{ public_path().'/crm_assets/pdf_assets/pdf-06/pdf_assets/css/style.css' }}">
</head>
<body>
    <div class="page">
        <div class="container">
            <!-- logo area start -->
            <div class="logo-img">
                {{-- <img src="{{ asset('crm_assets/pdf_assets/pdf-06/pdf_assets/images/pdf-6-logo.png') }}" alt="pdf-6-logo"> --}}
                <img src="{{ public_path().'/crm_assets/pdf_assets/pdf-06/pdf_assets/images/pdf-6-logo.png' }}" alt="pdf-6-logo">
            </div>
            <!-- logo area end -->
            
            <!-- body area start -->
            <div class="body-area">
                <div class="body-header">
                    <p class="pera pera1 text-bold">L'administration fiscale certifie l'authenticité du document présenté pour les données suivantes :</p>
                </div>
                <div class="body-container">
                    <p class="pera pera2 text-bold">Impôt 2020 sur les revenus de l'année 2019</p>

                    <table class="table-1">
                        <tr>
                            <td>
                                <div class="main-table">
                                    <div class="tr" style="border-left-color: transparent;">
                                        <div class="th" style="border-top-color: transparent;"></div>
                                        <div class="th"><p class="pera">Déclarant 1</p></div>
                                        <div class="th"><p class="pera">Déclarant 2</p></div>
                                    </div>
                                    <div class="tr row-1">
                                        <div class="td"><p class="pera">Nom</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_1_Nom'] }}</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_2_Nom'] }}</p></div>
                                    </div>
                                    <div class="tr">
                                        <div class="td"><p class="pera">Nom de naissance</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_1_Nom_de_naissance'] }}</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_2_Nom_de_naissance'] }}</p></div>
                                    </div>
                                    <div class="tr row-1">
                                        <div class="td"><p class="pera">Prénom(s)</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_1_Prénom'] }}</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_2_Prénom'] }}</p></div>
                                    </div>

                                    <div class="tr row-2">
                                        <div class="td"><p class="pera">Date de naissance</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_1_Date_de_naissance'] }}</p></div>
                                        <div class="td"><p class="pera">{{ $data['Déclarant_2_Date_de_naissance'] }}</p></div>
                                    </div>
                                    <div class="tr row-1">
                                        <div class="td"><p class="pera">Adresse déclarée au 1er janvier 2020</p></div>
                                        <div class="td"><p class="pera">{{ $data['Adresse_déclarée'] }}</p></div>
                                        <div class="td"></div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="table-2">
                        <div class="d-flex row-1">
                            <div class="text">
                                <p class="pera">Date de mise en recouvrement de l'avis d'impôt</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ $data['Date_de_mise_en_recouvrement'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-2">
                            <div class="text">
                                <p class="pera">Date d'établissement</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ $data['Date_établissement'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-1">
                            <div class="text">
                                <p class="pera">Nombre de part(s)</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ $data['Nombre_de_part'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-2">
                            <div class="text">
                                <p class="pera">Situation de famille</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ $data['Situation_de_famille'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-1">
                            <div class="text">
                                <p class="pera">Nombre de personne(s) à charge</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ $data['Nombre_de_personne'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-2">
                            <div class="text">
                                <p class="pera">Revenu brut global</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ EuroFormat($data['Revenu_brut_global']) }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-1">
                            <div class="text">
                                <p class="pera">Revenu imposable</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ EuroFormat($data['Revenu_imposable']) }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-2">
                            <div class="text">
                                <p class="pera">Impôt sur le revenu net avant corrections</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ $data['Impôt_sur_le_revenu_net_avant_corrections'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-1">
                            <div class="text">
                                <p class="pera">Montant de l'impôt</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ $data['Montant_de_impôt'] }}</p>
                            </div>
                        </div>
                        <div class="d-flex row-2">
                            <div class="text">
                                <p class="pera">Revenu fiscal de référence</p>
                            </div>
                            <div class="data">
                                <p class="pera">{{ EuroFormat($data['Revenu_fiscal_de_référence']) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- body area end -->
            <p class="pera pera3">© Ministère de l'Économie et des Finances</p>
        </div>   
        <div class="outer-container">
            <div class="outer-row">
                <div class="d-flex row-3">
                    <div class="text">
                        <p class="pera">Numéro fiscal</p>
                    </div>
                    <div class="data">
                        <p class="pera">{{ $data['Numéro_fiscal'] }}</p>
                    </div>
                </div>
                <div class="d-flex row-4">
                    <div class="text">
                        <p class="pera">Référence avis</p>
                    </div>
                    <div class="data">
                        <p class="pera">{{ $data['Référence_avis'] }}</p>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>