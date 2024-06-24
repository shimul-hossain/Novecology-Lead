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
                <th class="container header-logo" style="margin-left: 30px">
                    <img src="{{ asset('crm_assets/pdf_assets/images/logo.png') }}" alt="logo" class="header-logo__image">
                </th>
            </tr>
        </thead>
        <tbody class="body"> 
            <tr>
                <td class="body__data container" style="margin-top:20px; margin-bottom: 40px;">
                    Veuillez trouver ci-joint les détails de votre enlèvement : 
                </td>
            </tr> 
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong> Produit : </strong> {{ $mouvement->product->reference ?? '' }}
                </td>
            </tr> 
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Quantité : </strong> {{ $mouvement->quantity }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Mouvement : </strong> {{ $mouvement->mouvement }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Date :</strong> {{ \Carbon\Carbon::parse($mouvement->date)->format('d-m-Y') }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Nom du chantier : </strong>{{ $mouvement->project->Prenom.' '.$mouvement->project->Nom }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Type : </strong> {{ $mouvement->natureMouvement->name ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Entrepôt : </strong>{{ $mouvement->entrepot->name ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Enlèvement/Retour par : </strong> {{ $mouvement->user->name ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Plaque immatriculation : </strong> {{ $mouvement->plaque_immatriculation }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    <strong>Réception/Servi par : </strong> {{ $mouvement->reception->name ?? '' }}
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="min-height: 110px">
                    <strong>Observations : </strong> {{ $mouvement->observation }}
                </td>
            </tr>
            <tr>
                <td class="body__data container">
                    Signature :
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
