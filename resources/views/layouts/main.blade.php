<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="data:,">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
    <title>Geek Bot</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .cancel {
            background-color: red;
            color: white;
            border: none;
            padding: 7.2px 12px 8.4px 12px;
            border-radius: 4px;
        }
    </style>
</head>

<body class="@yield('class')">
    @include('partials.navbar')
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script src="/javascripts/jquery-3.1.0.js"></script>
    @yield('script')

</body>

</html>
