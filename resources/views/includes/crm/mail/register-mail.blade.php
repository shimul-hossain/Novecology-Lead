{{-- @component('mail::message')
# {{ $subject }} 
<strong> {{ $body }}</strong> <br><br>  
<strong>Email       :  {{ $email }}</strong> <br> 
<strong>Password    :  {{ $password }}</strong> <br> 


<h4><b>Note: Please change the default password !!!</b></h4>
Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
</head>

<body style="margin: 0; padding:0; outline: 0; box-sizing: border-box; background-color: #eeeeee;">

    <table style="margin-top: 0; padding-top: 0; max-width: 600px; font-family:Arial,sans-serif; height: 100vh;" align="center"
        cellspacing="0" cellpadding="0" border="0" width="100%">
        <tbody>
            <tr>
                <td>
                    <table style="text-align: center" align="center" cellspacing="0" cellpadding="0" border="0"
                        width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <table align="center" cellspacing="0" width="100%" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 20px 0;">
                                                    <!-- <h2>Novecology</h2> -->
                                                    <a style="font-size: 32px; text-decoration:none; color: #000000; font-weight: bold;"
                                                        href="https://novecology.fr/admin/dashboard">
                                                        <img src="https://novecology.fr/frontend_assets/images/logo/logo.png" alt="logo">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 30px 20px; background-color: rgba(62, 29, 113, .9);">
                                    <table align="center" cellspacing="0" width="100%" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img style="height: 80px; background: #fff; border-radius: 5px;"
                                                        src="https://i.postimg.cc/6Qch8DGk/businessman.png" alt="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h1 style="margin: 0; margin-top: 12px; color: #ffffff;">
                                                        {{ $subject }} </h1>
                                                    <h2 style="margin: 0; font-weight: 500; margin-top: 10px; color: #ffffff;"> 
                                                        {{ $body }}
                                                    </h2>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr style="text-align: left;">
                                <td style="background-color: #ffffff; padding:10px 20px;">
                                    <table align="center" cellspacing="0" width="100%" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h3 style="font-weight: 500; margin: 5px 0;">Your Email and Password
                                                        Below</h3>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p style="margin: 5px 0;"><strong>User-Email :</strong>
                                                        {{ $email }}</p>
                                                    <p style="margin: 5px 0;"><strong>Password :</strong> {{ $password }}
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p><b>Note: Please Change the Default Password After you login</b></p>
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
                                                <p style="margin:0;font-size:14px;line-height:16px;color: #949492;">
                                                    &reg; All Rights Reserved By NOVECOLOGY
                                                </p>
                                                <br> 
                                            </td>
                                        </tr> 
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
