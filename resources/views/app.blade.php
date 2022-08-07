<!DOCTYPE html>
<html class="h-full bg-trueGray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Impii Connected Protection">
    <meta name="keywords" content="Protection, Impii, Security">


    <!--  Essential META Tags -->
    <meta property="og:title" content="Impii Connected Protection">
    <meta property="og:image" content="'/impii_logo_black.png'">
    <meta property="og:url" content="https://app.impii.co.za/">

    <!--  Non-Essential, But Recommended -->
    <meta property="og:description" content="Impii Connected Protection">
    <meta property="og:site_name" content="Impii Connected Protection">


    <meta name="author" content="Impii">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Inertia --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=smoothscroll,NodeList.prototype.forEach,Promise,Object.values,Object.assign" defer></script>

    {{-- Ping CRM --}}
    <script src="https://polyfill.io/v3/polyfill.min.js?features=String.prototype.startsWith" defer></script>

    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
</head>
<body class="font-sans leading-none text-gray-700 antialiased">
    @inertia
</body>
</html>
