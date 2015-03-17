(function(){ 
    var app = angular.module('svodka', ['mainCtrl', 'taskService', 'taskFilter', 'ngRoute']);

    // configure our routes
    app.config(function($routeProvider, $locationProvider) {
        $routeProvider
            .when('/', {
                templateUrl : 'pages/task.html'
            })
            .when('/setting', {
                templateUrl : 'pages/setting.html'
            })
            .when('/history', {
                templateUrl : 'pages/history.html'
            })
            .when('/adminka', {
                templateUrl : 'pages/admin.html'
            })
            .when('/down', {
                templateUrl : 'pages/down.html',
                controller  : 'downCtrl'
            })
            .otherwise({
                redirectTo: '/'
            });

            // use the HTML5 History API
            $locationProvider.html5Mode(true);
    });

    var xhReq = new XMLHttpRequest();
    xhReq.open("GET", "//" + window.location.hostname + "/auth/csrf_token", false);
    xhReq.send(null);
    app.constant("CSRF_TOKEN", xhReq.responseText);


    app.run(function($http, CSRF_TOKEN){
        $http.defaults.headers.common['csrftoken'] = CSRF_TOKEN;
    });


})();
