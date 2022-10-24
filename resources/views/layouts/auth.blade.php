<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel='stylesheet' href="/stylesheets/bootstrap.css">
    <link rel="icon" href="data:,">
    <link rel='stylesheet' href="{{ asset('stylesheets/style.css') }}" />
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
    <script src="{{ mix('/js/app.js') }}"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/javascripts/jquery-3.1.0.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/javascripts/bootstrap.js"></script>
</body>

</html>
