<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YonezuMorseGenerator|米津玄師のモールス信号生成サイト</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Twitter Card -->
    <meta name="twitter:creator" content="@shioyaoshi21" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:title" content="YonezuMorseGenerator|米津玄師のモールス信号生成サイト" />
    <meta name="twitter:card" content="summary" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body>
    <div id="app"></div>
</body>
</html>