angular.module('taskService', ['ngResource'])
    .factory('taskFactory', function($resource) {
        return $resource('/api/task/:todoId',
            { todoId:'@id' },
            { update: { method: 'PUT',
                        transformResponse: function (data) {return angular.fromJson(data)},
                        isArray: false}
            },
            { 'get': { method:'GET', cache: true},
            'query': { method:'GET', cache: true, isArray:true } }
        );
    })
    .factory('historyFactory', function($resource) {
        return $resource('/api/history/:historyId',
            { historyId:'@id' }
        );
    })
    .factory('tagFactory', function($resource) {
        return $resource('/api/tag/:tagId',
            {   tagId:'@id'},
            { 'get': { method:'GET', cache: true},
                'query': { method:'GET', cache: true, isArray:true } }

        );
    })

    .factory('userFactory', function($resource) {
        return $resource('/api/user/:userId',
            { userId:'@id' }
        );
    })
    .factory('userTwoFactory', function($resource) {
        return $resource('/api/usertwo/:usertId',
            { usertId:'@id' },
            { update: { method: 'PUT',
                        transformResponse: function (data) {return angular.fromJson(data)},
                        isArray: false}
            }
        );
    })
    .factory('adminkaFactory', function($resource) {
        return $resource('/api/user/:tagId',
            { userId:'@id' }
        );
    });


