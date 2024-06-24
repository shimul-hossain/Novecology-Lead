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
                    <h2 class="body__title text-center text-underline">FICHE INSPECTION @if ($controle_sur_site->type == 'COFRAC')
                        COFRAC
                    @else
                        MISE
                    @endif</h2>
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
                    <strong>Adresse des travaux :</strong> 
                    {{ $project->Adresse }}
                </td>
            </tr>
            @if ($controle_sur_site->type == 'COFRAC')
                <tr>
                    <td class="body__data container">
                        <strong>Bureau de contrôle  :</strong>
                        {{ $controle_sur_site->getBureau ? $controle_sur_site->getBureau->company_name : ''  }}
                    </td>
                </tr>
                <tr>
                    <td class="body__data container">
                        <strong>Date de contrôle :</strong>
                        @if ($controle_sur_site->Date_de_contrôle)
                            {{ \Carbon\Carbon::parse($controle_sur_site->Date_de_contrôle)->format('d/m/Y') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="body__data container">
                        <strong>Horaire du contrôle :</strong>
                        {{ $controle_sur_site->horaire_intervention }}
                    </td>
                </tr>
                <tr>
                    <td class="body__data container">
                        <strong>Etape du contrôle :</strong>
                        {{ $controle_sur_site->Étape_du_contrôle }}
                    </td>
                </tr> 
            @else
                <tr>
                    <td class="body__data container">
                        <strong>Société MES :</strong>
                        {{ $controle_sur_site->getMes ? $controle_sur_site->getMes->company_name : ''  }}
                    </td>
                </tr>
                <tr>
                    <td class="body__data container">
                        <strong>Date MES :</strong>
                        @if ($controle_sur_site->Date_MES)
                            {{ \Carbon\Carbon::parse($controle_sur_site->Date_MES)->format('d/m/Y') }}
                        @endif
                    </td>
                </tr>
            @endif 
            <tr>
                <td class="body__data container">
                    <strong>Travaux contrôlés :</strong> 
                    @foreach ($controle_sur_site->getTravaux as $travaux)
                        {{ $travaux->travaux  }} {{ $loop->last ? '':', ' }}
                    @endforeach
                </td>
            </tr>
            
            <tr>
                <td class="body__data container">
                    <strong>Conformité du chantier :</strong>
                    {{ $controle_sur_site->Conformité_du_chantier }}
                </td>
            </tr> 
            @if ($controle_sur_site->type == 'COFRAC')
                @foreach ($controle_sur_site->getReason as $reason)  
                    <tr>
                        <td class="body__data container">
                            <strong>Raisons de non-conformité {{ $loop->iteration }} :</strong>
                            {{ $reason->reason }}
                        </td>
                    </tr> 
                    <tr>
                        <td class="body__data container">
                            <strong>Description action corrective {{ $loop->iteration }} :</strong>
                            {{ $reason->Description_action_corrective }}
                        </td>
                    </tr> 
                @endforeach 
            @else
                @foreach ($controle_sur_site->getReason as $reason)  
                    <tr>
                        <td class="body__data container">
                            <strong>Raisons de non-conformité {{ $loop->iteration }} :</strong>
                            {{ $reason->reason }}
                        </td>
                    </tr> 
                @endforeach 
            @endif
            <tr>
                <td class="body__data container">
                    <strong>Observations :</strong>
                    {{ $controle_sur_site->Observations }}
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