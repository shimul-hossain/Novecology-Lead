 
@php
    $clients =  [];
    $days =  [];
    for ($i = 0; $i <= 29; $i++) { 
        $days[] = \Carbon\Carbon::now()->subDays($i)->locale(app()->getLocale())->translatedFormat('d-M');
        $clients[] = rand(00,99);
    }

    $regie_interne = \App\Models\CRM\Regie::find(6);
    $regie_imene = \App\Models\CRM\Regie::find(10);
    $regie_rudy = \App\Models\CRM\Regie::find(7);

    $all_prospect_logs = \App\Models\CRM\StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'lead')->where('status_type', 'main')->get();
    $all_chantier_logs = \App\Models\CRM\StatusChangeLog::whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'))->where('type', 'project')->where('status_type', 'main')->get();

    $regie_interne_users = \App\Models\User::where('regie_id', 6)->where('deleted_status', 'no')->pluck('id')->toArray();
    $regie_imene_users = \App\Models\User::where('regie_id', 10)->where('deleted_status', 'no')->pluck('id')->toArray();
    $regie_rudy_users = \App\Models\User::where('regie_id', 7)->where('deleted_status', 'no')->pluck('id')->toArray();
    
    $project_labels = \App\Models\CRM\ProjectNewStatus::all();

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eamil</title>
</head>

<body style="margin:0;padding:0; ">
    <table role="presentation"
        style="width:100% !important;border-collapse:collapse;border:0;border-spacing:0;background:#f0f0f0; height: 100vh; font-family:Arial,sans-serif;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation" style="width:992px;border-collapse:collapse; border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:5px 0 15px 0;">
                            <a style="font-size: 32px; text-decoration:none; color: #000000; font-weight: bold;"
                                href="https://novecology.fr/admin/dashboard">
                                <img src="https://novecology.fr/frontend_assets/images/logo/logo.png" alt="logo">
                            </a>
                        </td>
                    </tr> 
                </table>
                <table role="presentation" style="width:992px;border-collapse:collapse; text-align:left; background-color: #ffffff;"> 
                    <tr>
                        <td style="padding: 100px  50px  25px 50px">
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr >
                                    <td colspan="5">    
                                        <h3 style="text-align: center; ">REPORTING DU {{ \Carbon\Carbon::today()->format('d/m/Y') }}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">    
                                        <h4 style="text-align: center">
                                            Analyse des Prospect  <br>
                                            (the overall total not the total of the day)
                                        </h4>
                                    </td>
                                </tr> 
                            </table>
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <th width="28%" style="padding:10px; border: 1px solid black;"></th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">TOTAL</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE INTERNE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE IMENE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE RUDY</th>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de prospect NON ATTRIBUE 
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('lead_label', 1)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('import_regie', 6)->where('lead_label', 1)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('import_regie', 10)->where('lead_label', 1)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('import_regie', 7)->where('lead_label', 1)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de prospect NOUVEAU 
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('lead_label', 2)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_interne_users)->where('lead_label', 2)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_imene_users)->where('lead_label', 2)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_rudy_users)->where('lead_label', 2)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de prospect EN COURS  
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('lead_label', 3)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;"> 
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_interne_users)->where('lead_label', 3)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_imene_users)->where('lead_label', 3)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_rudy_users)->where('lead_label', 3)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de prospect NRP
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('lead_label', 4)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;"> 
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_interne_users)->where('lead_label', 4)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;"> 
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_imene_users)->where('lead_label', 4)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_rudy_users)->where('lead_label', 4)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de prospect VALIDATION 
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                         {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where('lead_label', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;"> 
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_interne_users)->where('lead_label', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;"> 
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_imene_users)->where('lead_label', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->whereIn('lead_telecommercial', $regie_rudy_users)->where('lead_label', 6)->count() }}
                                    </td>
                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table> 
                <table role="presentation" style="width:992px;border-collapse:collapse; text-align:left; background-color: #ffffff;"> 
                    <tr>
                        <td style="padding: 25px 50px">
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr >
                                    <td colspan="5">    
                                        <h4 style="text-align: center; ">Performance Commerciale</h4>
                                    </td>
                                </tr> 
                            </table>
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <th width="28%" style="padding:10px; border: 1px solid black;"></th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">TOTAL</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE INTERNE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE IMENE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE RUDY</th>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de prospect VALIDATION  
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 6)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 6)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 6)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de prospect CONVERTI
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 7)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 7)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 7)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_prospect_logs->where('to_id', 7)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table> 

                <table role="presentation" style="width:992px;border-collapse:collapse; border-spacing:0; background-color: #ffffff;">
                    <tr>
                        <tr>
                            <td colspan="5">    
                                <h4 style="text-align: center; margin-top: 50px">Section : CONVERTI</h4>
                            </td>
                        </tr> 
                        <tr>
                            <td style="padding:0 30px; text-align: center">
                                <img style="margin-bottom: 10px;" src="{{ asset('uploads/chart-image') }}/{{ $chart['section_converti_chart'] }}" alt="chart">
                            </td>
                        </tr> 
                    </tr>
                </table>
                <table role="presentation" style="width:992px;border-collapse:collapse; border-spacing:0; background-color: #ffffff;">
                    <tr> 
                        <td colspan="5" style="padding:0 50px;">    
                            <h3 style="margin-top: 50px">Nombre de prospect KO : {{ $all_prospect_logs->where('to_id', 5)->count() }}</h3>
                        </td>  
                    </tr>
                </table>
                <table role="presentation" style="width:992px;border-collapse:collapse; border-spacing:0; background-color: #ffffff;">
                    <tr>
                        <tr>
                            <td colspan="5">    
                                <h3 style="text-align: center; margin-top: 50px">Section : KO</h3>
                            </td>
                        </tr> 
                        @if ($chart['section_ko_regie_chart'])
                            <tr>
                                <td colspan="5">    
                                    <h4 style="text-align: center;">Per Regie</h4>
                                </td>
                            </tr>  
                            <tr>
                                <td style="padding:0 30px; text-align: center">
                                    <img style="margin-bottom: 10px;" src="{{ asset('uploads/chart-image') }}/{{ $chart['section_ko_regie_chart'] }}" alt="chart">
                                </td>
                            </tr> 
                        @endif
                        <tr>
                            <td colspan="5">    
                                <h4 style="text-align: center;">Per Telecommercial</h4>
                            </td>
                        </tr> 
                        <tr>
                            <td style="padding:0 30px; text-align: center">
                                <img style="margin-bottom: 10px;" src="{{ asset('uploads/chart-image') }}/{{ $chart['section_ko_telecommercial_chart'] }}" alt="chart">
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="5">    
                                <h4 style="text-align: center;">Per Statut</h4>
                            </td>
                        </tr> 
                        <tr>
                            <td style="padding:0 30px; text-align: center">
                                <img style="margin-bottom: 10px;" src="{{ asset('uploads/chart-image') }}/{{ $chart['section_ko_statut_chart'] }}" alt="chart">
                            </td>
                        </tr> 
                    </tr>
                </table>
                
                <table role="presentation" style="width:992px;border-collapse:collapse; text-align:left; background-color: #ffffff;"> 
                    <tr>
                        <td style="padding: 25px 50px">
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr >
                                    <td colspan="5">    
                                        <h3 style="text-align: center; ">CHANTIER</h3>
                                    </td>
                                </tr> 
                                <tr >
                                    <td colspan="5">    
                                        <h4 style="text-align: center; ">Analyse des Chantiers <br>
                                            (the overall total not the total of the day {{ \Carbon\Carbon::today()->format('d/m/Y') }})
                                        </h4>
                                    </td>
                                </tr> 
                            </table>
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <th width="28%" style="padding:10px; border: 1px solid black;"></th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">TOTAL</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE INTERNE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE IMENE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE RUDY</th>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de chantier EN COURS 
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->where('project_label', 1)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_interne_users)->where('project_label', 1)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_imene_users)->where('project_label', 1)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_rudy_users)->where('project_label', 1)->count() }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de chantier Prévisite Réalisés 
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                         {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->where('project_label', 2)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_interne_users)->where('project_label', 2)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_imene_users)->where('project_label', 2)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_rudy_users)->where('project_label', 2)->count() }}
                                    </td>
                                </tr> 
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de chantier Déposé
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                         {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->where('project_label', 3)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_interne_users)->where('project_label', 3)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_imene_users)->where('project_label', 3)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_rudy_users)->where('project_label', 3)->count() }}
                                    </td>
                                </tr> 
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de chantier Accepté
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                         {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->where('project_label', 4)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_interne_users)->where('project_label', 4)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_imene_users)->where('project_label', 4)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_rudy_users)->where('project_label', 4)->count() }}
                                    </td>
                                </tr> 
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Nombre de chantier Installation en cours 

                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                         {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->where('project_label', 8)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_interne_users)->where('project_label', 8)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_imene_users)->where('project_label', 8)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_rudy_users)->where('project_label', 8)->count() }}
                                    </td>
                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table> 
                <table role="presentation" style="width:992px;border-collapse:collapse; text-align:left; background-color: #ffffff;"> 
                    <tr>
                        <td style="padding: 25px 50px">
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <td colspan="5">    
                                        <h4 style="text-align: center; ">Analyse des Chantiers par statut</h4>
                                    </td>
                                </tr> 
                            </table>
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <th width="28%" style="padding:10px; border: 1px solid black;"></th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">TOTAL</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE INTERNE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE IMENE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE RUDY</th>
                                </tr>
                                @foreach ($project_labels as $project_label)
                                    <tr>
                                        <td style="padding:10px; border: 1px solid black;">
                                            Nombre de chantier {{ $project_label->status }}
                                        </td>
                                        <td style="padding:10px; border: 1px solid black;">
                                            {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->where('project_label', $project_label->id)->count() }}
                                        </td>
                                        <td style="padding:10px; border: 1px solid black;">
                                            {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_interne_users)->where('project_label', $project_label->id)->count() }}
                                        </td>
                                        <td style="padding:10px; border: 1px solid black;">
                                            {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_imene_users)->where('project_label', $project_label->id)->count() }}
                                        </td>
                                        <td style="padding:10px; border: 1px solid black;">
                                            {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_rudy_users)->where('project_label', $project_label->id)->count() }}
                                        </td>
                                    </tr> 
                                    @foreach ($project_label->getSubStatus as $sub_status)
                                        <tr>
                                            <td style="padding:10px; border: 1px solid black;">
                                                Statut : {{ $sub_status->name }}
                                            </td>
                                            <td style="padding:10px; border: 1px solid black;">
                                                {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->where('project_label', $project_label->id)->where('project_sub_status', $sub_status->id)->count() }}
                                            </td>
                                            <td style="padding:10px; border: 1px solid black;">
                                                {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_interne_users)->where('project_label', $project_label->id)->where('project_sub_status', $sub_status->id)->count() }}
                                            </td>
                                            <td style="padding:10px; border: 1px solid black;">
                                                {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_imene_users)->where('project_label', $project_label->id)->where('project_sub_status', $sub_status->id)->count() }}
                                            </td>
                                            <td style="padding:10px; border: 1px solid black;">
                                                {{ \App\Models\CRM\NewProject::where('deleted_status', 0)->whereIn('project_telecommercial', $regie_rudy_users)->where('project_label', $project_label->id)->where('project_sub_status', $sub_status->id)->count() }}
                                            </td>
                                        </tr> 
                                    @endforeach
                                    
                                    
                                @endforeach
                            </table>
                        </td>
                    </tr>
                </table> 
                <table role="presentation" style="width:992px;border-collapse:collapse; text-align:left; background-color: #ffffff;"> 
                    <tr>
                        <td style="padding: 25px 50px">
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <td colspan="5">    
                                        <h4 style="text-align: center; ">Changement de statut <br>
                                            All the statut change for day {{ \Carbon\Carbon::today()->format('d/m/Y') }}
                                        </h4>
                                    </td>
                                </tr> 
                            </table>
                            <table role="presentation" style="width:100%;border-collapse:collapse;">
                                <tr>
                                    <th width="28%" style="padding:10px; border: 1px solid black;"></th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">TOTAL</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE INTERNE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE IMENE</th>
                                    <th width="18%" style="padding:10px; border: 1px solid black;">REGIE RUDY</th>
                                </tr> 
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « EN COURS » à « Prévisite Réalisés »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 2)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 2)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 2)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 2)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « EN COURS » à « KO »    
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 7)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 7)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 7)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 1)->where('to_id', 7)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « Prévisite Réalisés » à « Déposé »                                         
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 3)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 3)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 3)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 3)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « Prévisite Réalisés » à « KO »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 7)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 7)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 7)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 2)->where('to_id', 7)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut  « Déposé » à « Accepté »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 4)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 4)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 4)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 4)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « Déposé » à « KO »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 7)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 7)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 7)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 3)->where('to_id', 7)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « Accepté » à « Installation en cours »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 8)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 8)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 8)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 8)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « Accepté » à « KO »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 7)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 7)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 7)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 4)->where('to_id', 7)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « Installation en cours » à « Installé »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 5)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 5)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 5)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 5)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                                <tr>
                                    <td style="padding:10px; border: 1px solid black;">
                                        Changement de Statut « Installation en cours » à « Terminé »
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 6)->where('regie_id', 6)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 6)->where('regie_id', 10)->count() }}
                                    </td>
                                    <td style="padding:10px; border: 1px solid black;">
                                        {{ $all_chantier_logs->where('from_id', 8)->where('to_id', 6)->where('regie_id', 7)->count() }}
                                    </td>
                                </tr>    
                            </table>
                        </td>
                    </tr>
                </table>
                <table role="presentation" style="width:992px;border-collapse:collapse; border-spacing:0; background-color: #ffffff;">
                    <tr> 
                        <td colspan="5" style="padding:0 50px;">    
                            <h3 style="margin-top: 50px">Nombre de chantier KO : {{ $all_chantier_logs->where('to_id', 7)->count() }}</h3>
                        </td>  
                    </tr>
                </table> 
                <table role="presentation" style="width:992px;border-collapse:collapse; border-spacing:0; background-color: #ffffff;">
                    <tr>
                        <tr>
                            <td colspan="5">    
                                <h3 style="text-align: center; margin-top: 50px">Section : KO</h3>
                            </td>
                        </tr> 
                        @if ($chart['chantier_section_ko_regie_chart'])
                            <tr>
                                <td colspan="5">    
                                    <h4 style="text-align: center;">Per Regie</h4>
                                </td>
                            </tr>  
                            <tr>
                                <td style="padding:0 30px; text-align: center">
                                    <img style="margin-bottom: 10px;" src="{{ asset('uploads/chart-image') }}/{{ $chart['chantier_section_ko_regie_chart'] }}" alt="chart">
                                </td>
                            </tr> 
                        @endif
                        <tr>
                            <td colspan="5">    
                                <h4 style="text-align: center;">Per Telecommercial</h4>
                            </td>
                        </tr> 
                        <tr>
                            <td style="padding:0 30px; text-align: center">
                                <img style="margin-bottom: 10px;" src="{{ asset('uploads/chart-image') }}/{{ $chart['chantier_section_ko_telecommercial_chart'] }}" alt="chart">
                            </td>
                        </tr> 
                        <tr>
                            <td colspan="5">    
                                <h4 style="text-align: center;">Per Statut</h4>
                            </td>
                        </tr> 
                        <tr>
                            <td style="padding:0 30px; text-align: center">
                                <img style="margin-bottom: 10px;" src="{{ asset('uploads/chart-image') }}/{{ $chart['chantier_section_ko_statut_chart'] }}" alt="chart">
                            </td>
                        </tr> 
                    </tr>
                </table>
                
                <table role="presentation" style="width:992px;border-collapse:collapse; border-spacing:0;text-align:left; background-color: #ffffff;">
                    <tr>
                        <td style="padding:30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                                <tr>
                                    <td style="padding:0;" align="center">
                                        <p style="margin:0;font-size:14px;line-height:16px;color: #949492; text-align:center">
                                            &reg; All Rights Reserved By NOVECOLOGY
                                        </p>
                                        <br> 
                                    </td>
                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table> 
</body>

</html>
