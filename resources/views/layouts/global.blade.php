<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Dental</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}?ver={{config('app.version')}}" type='text/css' media='all'>
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
    <script src="{{asset('js/select2.js')}}"></script>
</body>
</html>