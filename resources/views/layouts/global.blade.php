<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Dental</title>
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}?ver={{config('app.version')}}" type='text/css' media='all'>
    <link rel="stylesheet" href="{{ asset('css/desktop.css') }}?ver={{config('app.version')}}" type='text/css' media='(min-width: 990px)'>
</head>
<body>
    <header class="header">
        
    </header>
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        
    </footer>
</body>
</html>