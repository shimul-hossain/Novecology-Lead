{{-- @component('mail::message')
# {{ $subject }} 
<strong> {{ $body }}</strong> <br>  --}}

{{-- @component('mail::button', ['url' => $url])
View Order
@endcomponent --}}

{{-- Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}

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
                <table role="presentation"
                    style="width:602px;border-collapse:collapse; border-spacing:0;text-align:left;">
                    <tr>
                        <td align="center" style="padding:5px 0 15px 0;">
                            <a style="font-size: 32px; text-decoration:none; color: #000000; font-weight: bold;"
                                href="https://novecology.fr/admin/dashboard">
                                <img src="https://novecology.fr/frontend_assets/images/logo/logo.png" alt="logo">
                            </a>
                        </td>
                    </tr>
                    <tr style="background-color: #ffffff;">
                        <td style="padding:36px 30px 20px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="color:#153643; text-align: center;">
                                        <img style="margin-bottom: 10px;"
                                            src="{{ asset('crm_assets/assets/images/ticket-assign.png') }}" alt="success" width="80"
                                            height="80">
                                        <p style="margin:0;font-size:20px;line-height:24px;text-align: center;">
                                            {{ $subject }}
                                        </p>

                                        <p  style="text-align: center; font-size:18px margin-top:10px; margin-bottom: 0">
                                            {{ $body }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="text-align: left;">
                        <td style="background-color: #ffffff; padding:10px 20px;">
                            <table align="center" cellspacing="0" width="100%" cellpadding="0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h3 style="font-weight: 500; margin: 5px 0;">Informations ticket:</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="margin: 5px 0;"><strong>Ticket :</strong> {{ $number }}</p>
                                            <p style="margin: 5px 0;"><strong>Problème :</strong> {{ $title }} </p>
                                            <p style="margin: 5px 0;"><strong>Détails :</strong>  {{ $details }} </p>
                                            <p style="margin: 5px 0;"><strong>Nom :</strong> {{ $nom }} </p>
                                            <p style="margin: 5px 0;"><strong>Prénom :</strong> {{ $prenom }} </p>
                                            <p style="margin: 5px 0;"><strong>Lien :</strong>  <a href="{{ $url }}">Cliquez ici </a></p>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </td>
                    </tr>
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
                                {{-- <tr>
                                    <td style="padding:20px 0;" align="center">
                                        <table role="presentation"
                                            style="border-collapse:collapse;border:0;border-spacing:0;">
                                            <tr>
                                                <td style="padding:0 0 0 10px; width:34px;">
                                                    <a href="#" style="color:#ffffff;">
                                                        <img src="https://i.postimg.cc/k2PkM08B/facebook.png"
                                                            alt="facebook" width="38"
                                                            style="height:auto;display:block;border:0;" />
                                                    </a>
                                                </td>
                                                <td style="padding:0 0 0 10px;width:34px;">
                                                    <a href="#" style="color:#ffffff;">
                                                        <img src="https://i.postimg.cc/WDXKntyk/linkedin.png"
                                                            alt="linkedin" width="38"
                                                            style="height:auto;display:block;border:0;" />
                                                    </a>
                                                </td>
                                                <td style="padding:0 0 0 10px;width:34px;">
                                                    <a href="#" style="color:#ffffff;">
                                                        <img src="https://i.postimg.cc/751j5KMX/twitter.png"
                                                            alt="twitter" width="38"
                                                            style="height:auto;display:block;border:0;" />
                                                    </a>
                                                </td>
                                                <td style="padding:0 0 0 10px;width:34px;">
                                                    <a href="#" style="color:#ffffff;">
                                                        <img src="https://i.postimg.cc/Y4pZYQd7/github.png" alt="github"
                                                            width="38" style="height:auto;display:block;border:0;" />
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                                        <p
                                            style="margin:0;font-size:14px;line-height:16px;text-align: center; color: #949492;">
                                            You recevied this email because you signed up for startupEmails
                                        </p>
                                        <br>
                                    </td>
                                </tr> --}}
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
