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
                    Veuillez trouver ci-joint la commande suivante pour le compte de Novecology : 
                </td>
            </tr> 
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    Numéro de commande : Commande {{ $commande->id }}
                </td>
            </tr> 
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    Date de commande : {{ \Carbon\Carbon::parse($commande->date)->format('d-m-Y') }}
                </td>
            </tr> 
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    Référence de commande : {{ $commande->reference_commande }}
                </td>
            </tr> 
            <tr>
                <td class="body__data container" style="margin-bottom: 16px">
                    Fournisseur : {{ $commande->fournisseur->name ?? '' }}
                </td>
            </tr> 
            <tr>
                <td class="body__data container" style="margin: 60px 0 20px 35px">
                    <table>
                        @foreach ($commande->products as $commande_product)
                            <tr>
                                <td 
                                @if ($loop->last)
                                    style="border:2px solid; width: 280px; padding: 8px"
                                @else
                                    style="border-width:2px 2px 0 2px; border-style: solid; width: 280px; padding: 8px"
                                @endif
                                >{{ $commande_product->product->reference ?? '' }}</td>
                                <td 
                                @if ($loop->last)
                                    style="border:2px solid; width: 280px; padding: 8px"
                                @else
                                    style="border-width:2px 2px 0 2px; border-style: solid; width: 280px; padding: 8px"
                                @endif
                                >{{ $commande_product->quantity }}</td>
                            </tr>
                        @endforeach 
                    </table>
                </td>
            </tr>
            <tr>
                <td class="body__data container" style="margin: 0 0 60px 35px">
                    <table> 
                        <tr>
                            <td style="border:2px solid; width: 280px; padding: 8px; background-color: #D9D9D9;">TOTAL</td>
                            <td style="border:2px solid; width: 280px; padding: 8px; background-color: #D9D9D9;">{{ $commande->products->sum('quantity') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
             
            <tr>
                <td class="body__data container" style="min-height: 110px">
                    Observations : {{ $commande->observation }}
                </td>
            </tr>
            <tr> 
                <td class="body__data container" style="margin-left: 500px">
                    Merci,
                    <br>
                    <strong>Novecology</strong>
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
