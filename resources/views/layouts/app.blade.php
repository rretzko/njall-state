<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <title>{{ __('panel.site_title') }}</title>

    <!-- ATTRIBUTIONS
   \*******************************************************************************************************
   We would like to thank the following for their contributions to this project:
   - Barbara Retzko for her unconditional support and love.
   - Sidney Volmar for her assistance in the page styling
   - Taylor Otwell for his wonderful Laravel
   - Caleb Porzio for his wonderful Livewire and Alpine.js
   - Povilas Korop for his worderful QuickAdminPanel and ongoing generous contributions to the Laravel community
   \*******************************************************************************************************
   -->
</head>

<body class="text-blueGray-700 bg-blueGray-800 antialiased">
    <main>
        @yield('content')
    </main>
</body>

</html>
