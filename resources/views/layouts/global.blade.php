<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Dental</title>
    <link rel="preload" href="{{ asset('fonts/Anakotmai/anakotmai-medium.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/Anakotmai/anakotmai-bold.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/Anakotmai/anakotmai-light.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/Thongterm/tt-bold.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/Thongterm/tt-reg.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link href="{{asset('js/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link rel="stylesheet" href="{{ asset('js/select2/css/select2.min.css') }}" type='text/css' media='all'>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}?ver={{config('app.version')}}" type='text/css' media='all'>
    <link rel="stylesheet" href="{{ asset('css/mobile.css') }}?ver={{config('app.version')}}" type='text/css' media='all'>
    <link rel="stylesheet" href="{{ asset('css/desktop.css') }}?ver={{config('app.version')}}" type='text/css' media='(min-width: 990px)'>
    <script src="{{asset('js/sweetalert2/sweetalert2.min.js')}}"></script>
</head>
<body>
    <header class="header">
        
    </header>
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        
    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{asset('js/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
</body>
</html>