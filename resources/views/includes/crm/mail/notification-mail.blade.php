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
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643; text-align: center;">
                                        <img style="margin-bottom: 10px;"
                                            src="https://i.postimg.cc/vBgQmspZ/Approved-2.png" alt="success" width="80"
                                            height="80">
                                        <p style="margin:0;font-size:20px;line-height:24px;text-align: center;">
                                            {{ $body }}
                                        </p>

                                        <p style="text-align: center; font-size:18px margin-top:10px">
                                            {{ $subject }} 
                                        </p>
                                    </td>
                                </tr>
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
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
