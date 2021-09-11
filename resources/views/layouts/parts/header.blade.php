<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <!-- HTML Meta Tags -->
    <meta name="description" content="Vote for your favorite contestants for the MISS FASHION FESTIVAL VOTING PLATFORM. Brought to you by the Shosa Empire - Culture of Excellence.">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="https://vote.shosaempire.org/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="MISS FASHION FESTIVAL VOTING PLATFORM">
    <meta property="og:description" content="Vote for your favorite contestants for the MISS FASHION FESTIVAL VOTING PLATFORM. Brought to you by the Shosa Empire - Culture of Excellence.">
    <meta property="og:image" content="{{ asset('images/logo/mffa.png') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="vote.shosaempire.org">
    <meta property="twitter:url" content="https://vote.shosaempire.org/">
    <meta name="twitter:title" content="MISS FASHION FESTIVAL VOTING PLATFORM">
    <meta name="twitter:description" content="Vote for your favorite contestants for the MISS FASHION FESTIVAL VOTING PLATFORM. Brought to you by the Shosa Empire - Culture of Excellence.">
    <meta name="twitter:image" content="{{ asset('images/logo/mffa.png') }}">

    <!-- Meta Tags Generated via https://www.opengraph.xyz -->
      

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo/mffa.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d1697f2fa9.js" crossorigin="anonymous"></script>

    <!-- AOS Animate -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- FlutterWave Payment -->
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>


    <!-- Calendar -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.0/main.css"/>


</head>