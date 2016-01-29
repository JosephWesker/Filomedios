angular.module("demo", ["ngRoute", "dndLists"])
    .config(function($routeProvider) {
        $routeProvider
            .when('/simple', {
                templateUrl: 'list/simple/simple-frame.html',
                controller: 'SimpleDemoController'
            })
            .otherwise({redirectTo: 'simple'});
    });