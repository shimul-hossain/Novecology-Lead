<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page Title -->
    <title>novecology-pdf</title>
    <!-- Page Style -->
    <link rel="stylesheet" href="{{ asset('crm_assets/pdf_assets/css/style.css') }}">

    <style>
        .section-header{
            color: #212529;
            background-color: #9fbfe6;
            max-width: 540px;
            font-size: 17px;
            font-weight: 500;
            padding: .375rem .75rem;
            text-align: center;
            border-radius: .25rem;
            margin: 15px auto;
        }

        .form-group{
            margin-bottom: 20px;
        }

        .form-label{
            color: #000000;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: .5rem;
        }

        .form-input{
            display: flex;
            flex-wrap: wrap;
            gap: 0.375rem;
            font-size: 1rem;
            color: #5E5873;
            border: 1px solid #dddddd;
            min-height: 2.4rem;
            border-radius: 3px;
            padding: 0.375rem;
            line-height: 1.5;
        }

        .form-input__option{
            color: #ffffff;
            background-color: #54adf6;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
            padding: 0.375rem;
            border-radius: 4px;
        }

    </style>
</head>
<body>
    <table class="page">
        <thead class="header">
            <tr>
                <th class="header-shape">
                    <img src="{{ asset('crm_assets/pdf_assets/images/header-shape.png') }}" alt="shape" class="header-shape__image">
                </th>
            </tr>
            <tr>
                <th class="container header-logo">
                    <img src="{{ asset('crm_assets/pdf_assets/images/logo.png') }}" alt="logo" class="header-logo__image">
                </th>
            </tr>
        </thead>
        <tbody class="body">
            <tr>
                <td class="container">
                    <h2 class="body__title text-center text-underline">FICHE INTERVENTION</h2>
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong> Client :</strong>
                    {{ $project->Prenom.' '.$project->Nom }}
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong>Téléphone :</strong>
                    {{ $project->phone }}
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong>Date intervention :</strong>
                    @if ($intervention->Date_intervention && strtotime($intervention->Date_intervention))
                        {{ \Carbon\Carbon::parse($intervention->Date_intervention)->format('d/m/Y') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong>Type d’intervention :</strong>
                    <span class="text-underline">{{ $intervention->type }}</span>
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong>Horaire intervention :</strong>
                    {{ $intervention->Horaire_intervention }}
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong>Statut planning :</strong>
                    {{ $intervention->Statut_planning }}
                </td>
            </tr>
            @if ($intervention->type == 'Etude')
                <tr>
                    <td class="body__data container">
                        <strong>Chargé d’étude :</strong>
                        {{ $intervention->getUser ? $intervention->getUser->name : ''  }}
                    </td>
                </tr>
            @elseif ($intervention->type == 'Pré-Visite Technico-Commercial' || $intervention->type == 'DPE')
                <tr>
                    <td class="body__data container">
                        <strong>Prévisiteur Technico-Commercial :</strong>
                        {{ $intervention->getUser ? $intervention->getUser->name : '' }}
                    </td>
                </tr>
            @elseif ($intervention->type == 'Contre Visite Technique')
                <tr>
                    <td class="body__data container">
                        <strong>Contre prévisiteur :</strong>
                        {{ $intervention->getUser ? $intervention->getUser->name : '' }}
                    </td>
                </tr>
            @elseif ($intervention->type == 'Installation')
                <tr>
                    <td class="body__data container">
                        <strong>Installateur technique :</strong>
                        {{ $intervention->getUser ? $intervention->getUser->name : '' }}
                    </td>
                </tr>
                <tr>
                    <td class="body__data container">
                        <strong>Chef D'Équipe :</strong>
                        {{ $intervention->getUser ? ($intervention->getUser->getTeamLeader ?  $intervention->getUser->getTeamLeader->name : '') : '' }}
                    </td>
                </tr>
            @elseif ($intervention->type == 'SAV')
                <tr>
                    <td class="body__data container">
                        <strong>Technicien SAV :</strong>
                        {{ $intervention->getUser ? $intervention->getUser->name : '' }}
                    </td>
                </tr>
            @elseif ($intervention->type == 'Déplacement' || $intervention->type == 'Prévisite virtuelle')
                <tr>
                    <td class="body__data container">
                        <strong>Technicien :</strong>
                        {{ $intervention->getUser ? $intervention->getUser->name : '' }}
                    </td>
                </tr>
            @endif
            <tr>
                <td class="body__data container">
                    <strong>Adresse intervention :</strong>
                    {{ $project->Adresse .' '.$project->Ville }}
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong>Complément adresse :</strong>
                    {{ $project->Complément_adresse }}
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    <strong>Travaux projet :</strong>
                    @foreach ($project->ProjectTravaux as $travaux)
                        {{ $travaux->travaux }} {{  $loop->last ? '':', ' }}
                    @endforeach
                </td>
            </tr>
            @if ($intervention->type == 'Installation' || $intervention->type == 'SAV' || $intervention->type == 'Déplacement')
                <tr>
                    <td class="body__data container">
                        <strong>Produits projet :</strong>
                        @foreach ($project->projectTagItem as $product_tag)
                            @if ($product_tag->getTag && $product_tag->getTag->id != 7 && $product_tag->getTag->id != 29)
                                <div class="section-header">{{ $product_tag->getTag->travaux }}</div>
                                @if ($product_tag->getTag->tag == 'CAG' || $product_tag->getTag->tag == 'POELE' || $product_tag->getTag->tag == 'PAC R/R' || $product_tag->getTag->tag == 'PAC R/O' || $product_tag->getTag->tag == 'CESI' || $product_tag->getTag->tag == 'BTD' || $product_tag->getTag->tag == 'SSC')
                                    <div class="form-group">
                                        <p class="form-label">Marque</p>
                                        <div class="form-input">
                                            @foreach ($marques as $marque)
                                                @if ($product_tag->marque == $marque->id)
                                                <span class="form-input__option">{{ $marque->description }}</span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if ($product_tag->getTag->tag == 'PAC R/R')
                                    <div class="form-group">
                                        <p class="form-label">Nombre de split</p>
                                        <div class="form-input">{{ $product_tag->Nombre_de_split ?? '' }}</div>
                                    </div>
                                @endif
                                @if ($product_tag->getTag->rank == '1')
                                    <div class="form-group">
                                        <p class="form-label">Produit {{ $product_tag->getTag->tag  }}</p>
                                        <div class="form-input">
                                            @foreach ($product_tag->getTag->getProducts as $product)
                                                @if ($project->getTagProduct()->where('product_id', $product->id)->where('tag_id',  $product_tag->id)->exists())
                                                    <div class="form-input__option">{{ $product->reference }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if ($product_tag->getTag->tag == 'ITI_101' || $product_tag->getTag->tag == 'ITI_102' || $product_tag->getTag->tag == 'ITE_102' || $product_tag->getTag->tag == 'ITI_103'|| $product_tag->getTag->tag == 'Crépis' || $product_tag->getTag->tag == 'ITE hors zone')
                                    @if ($product_tag->getTag->tag == 'ITI_101')
                                        <div class="form-group">
                                            <p class="form-label">Type de comble</p>
                                            <div class="form-input">
                                                @if ($product_tag->Type_de_comble && $product_tag->Type_de_comble == 'Comble perdu')
                                                    <div class="form-input__option">Comble perdu</div>
                                                @endif
                                                @if ($product_tag->Type_de_comble && $product_tag->Type_de_comble == 'Comble aménagés/aménagéable')
                                                    <div class="form-input__option">Comble aménagés/aménagéable</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <p class="form-label" for="surface{{ $product_tag->tag_id }}">Surface {{ $product_tag->getTag->tag  }}</p>
                                        <div class="form-input">{{ $product_tag->surface }} m2</div>
                                    </div>
                                @endif
                                @if ($product_tag->getTag->tag == 'StoreBanne')
                                    <div class="form-group">
                                        <p class="form-label">Nombre de store banne</p>
                                        <div class="form-input">{{ $product_tag->Nombre_de_split ?? '' }}</div>
                                    </div>
                                @endif
                                @if ($product_tag->getTag->tag == 'GD ITE')
                                    <div class="form-group">
                                        <p class="form-label">Nombre</p>
                                        <div class="form-input">{{ $product_tag->Nombre_de_split ?? '' }}</div>
                                    </div>
                                @endif
                                @if ($product_tag->getTag->id == 2 || $product_tag->getTag->id == 6)
                                    @foreach ($project->getTagProduct()->where('tag_id',  $product_tag->id)->get()  as $selected_product)
                                        <div class="form-group">
                                            <p class="form-label">{{ \App\Models\CRM\Product::find($selected_product->product_id)->reference ?? '' }} : <span>Nombre</span></p>
                                            <div class="form-input">{{ \App\Models\CRM\ProjectProductNombre::where('project_id', $project->id)->where('tag_id', $product_tag->getTag->id)->where('product_id', $selected_product->product_id)->first()->number ?? '' }}</div>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($product_tag->getTag->tag == 'THERMO')
                                    <div class="form-group">
                                        <p class="form-label">SHAB:</p>
                                        <div class="form-input"> {{ $product_tag->shab }}</div>
                                    </div>
                                    <div class="form-group">
                                        <p class="form-label">Nombre de pièces dans le logement:</p>
                                        <div class="form-input"> {{ $product_tag->Nombre_de_pièces_dans_le_logement }}</div>
                                    </div>
                                    <div class="form-group">
                                        <p class="form-label">Nombre de radiateurs total dans le logement</p>
                                        <div class="form-input"><div class="form-input__option">{{ $product_tag->Nombre_de_radiateur_total_dans_le_logement }}</div></div> 
                                    </div>
                                    <div class="form-group">
                                        <p class="form-label" >Type de radiateurs à équiper</p>
                                        <div class="form-input">
                                            <div class="form-input__option">{{ $product_tag->Type_de_radiateur }}</div>
                                        </div> 
                                    </div>
                                    <div class="form-group" id="Nombre_de_radiateurs_électrique_input" style="display: {{ ($product_tag->Type_de_radiateur == 'mixte' || $product_tag->Type_de_radiateur == 'électrique') ? '':'none'  }}">
                                        <p class="form-label">Nombre de radiateurs électrique à équiper:</p> 
                                        <div class="form-input">{{ $product_tag->Nombre_de_radiateurs_électrique }}</div>
                                    </div>
                                    <div class="form-group" id="Nombre_de_radiateurs_combustible_input" style="display: {{ ($product_tag->Type_de_radiateur == 'mixte' || $product_tag->Type_de_radiateur == 'combustible') ? '':'none'  }}">
                                        <p class="form-label">Nombre de radiateurs combustible à équiper:</p> 
                                        <div class="form-input">{{ $product_tag->Nombre_de_radiateurs_combustible }}</div>
                                    </div>
                                    <div class="form-group">
                                        <p class="form-label">Thermostat supplémentaire:</p>
                                        <div class="form-input"><div class="form-input__option">{{ $product_tag->Thermostat_supplémentaire }}</div></div> 
                                    </div>
                                    <div class="Thermostat_supplémentaire_wrap"  style="display: {{ ($product_tag->Thermostat_supplémentaire == 'Oui')? '':'none' }}">
                                        <div class="form-group">
                                            <p class="form-label">Nombre thermostat supplémentaire:</p> 
                                            <div class="form-input">{{ $product_tag->Nombre_thermostat_supplémentaire }}</div> 
                                        </div>
                                        <div class="form-group">
                                            <p class="form-label">Montant:</p> 
                                            <div class="form-input">{{ EuroFormat($product_tag->Nombre_thermostat_supplémentaire*$product_tag->getTag->price) }}</div> 
                                        </div>
                                    </div> 
                                @endif
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endif
            <tr>
                <td class="body__data container">
                    <strong>Observations :</strong>
                    {{ $intervention->Observations }}
                </td>
            </tr>
        </tbody>
        <tfoot class="footer">
            <tr>
                <td>
                    <div class="footer__fixed">
                        <div class="container text-center">
                            <small class="footer__text"><strong>NOVECOLOGY</strong> – 2 Rue du Prè des Aulnes 77340 Pontault-Combault – 01 87 66 57 30 – support@novecology.fr SAS au capital de 10 000€ - SIRET 849 947 809 00026 - APE / NAF 4322B – TVA FR74 849 947 809</small>
                        </div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>

<script>
    window.print();
</script>
