
<html>
    <head>
        <title>Сводки</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link href="http://web-service.ms/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ URL::asset('production.min.css') }}" />
    </head>

    <body ng-app="svodka">

        @yield('content')

        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.24/angular.min.js"></script>
        <script src="{{ URL::asset('production.min.js') }}"></script>
        <script>angular.module("svodka").constant("CSRF_TOKEN", '{{ csrf_token() }}');</script>
    </body>
</html>