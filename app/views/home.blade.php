<html manifest="cache.appcache" ng-app="svodka">
    <head>
        <title>Сводки</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <link href="http://web-service.ms/favicon.ico" rel="shortcut icon" type="image/x-icon">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ URL::asset('production.min.css') }}" />
    </head>

    <body>

        <div class="left_side">
            <div class="logo">Taskboard</div>
            <div class="copyryght">by @nemon</div>
            <div>
                <ul class="menu" ng-controller="menuCtrl">
                    @if (Auth::user()->hasRole('admin'))
                    <li ng-class="menuClass('/')"><a href='/'>Task</a></li>
                    <li ng-class="menuClass('/history')"><a href='/history'>History</a></li>
                    <li ng-class="menuClass('/setting')"><a href='/setting'>Setting</a></li>
                    <li ng-class="menuClass('/adminka')"><a href='/adminka'>Team</a></li>
                    <li ng-class="menuClass('/down')"><a href='/down'>Download</a></li>
                    @else
                    <li ng-class="menuClass('/')"><a href='/'>Task</a></li>
                    <li ng-class="menuClass('/history')"><a href='/history'>History</a></li>
                    <li ng-class="menuClass('/setting')"><a href='/setting'>Setting</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="right_side">

            <div ng-view></div>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-resource.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-route.min.js"></script>
        <script src="{{ URL::asset('production.min.js') }}"></script>
    </body>
</html>