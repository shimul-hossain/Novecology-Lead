<!DOCTYPE html>
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Site Meta Data -->
    <meta name="author" content="Novecology">
    <meta name="keywords" content="Novecology, novecology">
	<!-- Site Title -->
    <title>{{ config('app.name') }} - Site en Rénovation Énergétique</title>
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('uploads/new/setting') }}/{{ generalSetting()->favicon }}">
	<link rel="stylesheet" href="{{ asset('frontend_assets/new/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;800&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Outfit', sans-serif;
        }
    </style>
    <script defer>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '410422680847226');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"src="https://www.facebook.com/tr?id=410422680847226&ev=PageView&noscript=1"/></noscript>
</head>
<body>
    <section class="min-vh-100 d-flex flex-column align-items-center justify-content-center p-3">
        <div class="text-center">
            <h1 class="display-5 fw-semibold mb-3">Site en Rénovation Énergétique</h1>
            <a class="d-inline-block" href="#!">
                <img src="{{ asset('uploads/new/setting') }}/{{ generalSetting()->logo }}" alt="logo" class="img-fluid">
            </a>
        </div>
    </section>
</body>
</html>

