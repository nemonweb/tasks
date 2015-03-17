angular.module('taskFilter', [])
    .filter('taskFilter', function () {
        return function (inputs) {
            var tempClients = [];
            angular.forEach(inputs, function (item) {

                if (item.done == 0) {
                    tempClients.push(item);
                }
            });
            return tempClients;
        };
    });