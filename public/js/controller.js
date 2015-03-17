angular.module('mainCtrl', [])
    .controller('todoCtrl', function($http, taskFactory, tagFactory, userTwoFactory){

        var todo = this;
        todo.todos = [];

        //получаю данные о пользователе(о проекте по умолчанию)
        var users = userTwoFactory.query(function() {

           var user = users[0];
           todo.newTag = user.default_tag;
         });

        //получаю все записи
        todo.todos = taskFactory.query();
        todo.tags = tagFactory.query();

        //функция добавление новой задачи
        todo.addTodo = function(){
            //формируем массив из данных формы
            var newItem = new Array();
            newItem = {'name':todo.newTodo, 'done':false, 'tag': todo.newTag};
            //отправляем даные в на сервер и если что-то пошло не так - выводим ошибку
            taskFactory.save(newItem, function(res) {
                newItem.id = res.id;
                newItem.tagname = res.tagname;
            },function(errorResult) {
                todo.error = "Ошибка добавление задачи. Перезагрузите страницу и попробуйте снова";
                return;
             });
            //обновляем модель с задачами
            todo.todos.push(newItem);
            todo.newTodo = '';
        };

        todo.removeTodo = function(item){
            var id = item.id;
            todo.todos.splice(todo.todos.indexOf(item), 1);
            taskFactory.delete({'todoId':id});
        };

        todo.update = function(item){
            taskFactory.update(item);
        }

        todo.saveSetting = function(){
            userTwoFactory.save(todo.newDefault, function(res) {
                if(res['error'] === false){
                    todo.settingMessage = "Settings stored";
                }
            });
        }

    })
    .controller('historyCtrl', function(historyFactory){
        var hist = this;
        hist.items = historyFactory.query();
    })

    //страница скачивания отчета
    .controller('downCtrl', function($filter){
        var down = this;

        var date_old = new Date();
        date_old.setDate(date_old.getDate() - 7);

        down.date_ot = $filter("date")(date_old, 'yyyy-MM-dd');
        down.date_do = $filter("date")(Date.now(), 'yyyy-MM-dd');

    })
    //админка
    .controller('adminkaCtrl', function(adminkaFactory) {

        this.user = adminkaFactory.query();

        this.dayfrom = function(date){
            var a = moment(date);
                var b = moment();
                var days = b.diff(a, 'days');

                if(days > 7){
                    return true;
                }else{
                    return false;
                }
        }

        this.datefrom = function(date){
                return moment(date).fromNow();
        };

    })
    //управление меню
    .controller('menuCtrl', function($scope, $location) {
         $scope.menuClass = function(page) {
            var current = $location.path();
            return page === current ? "active" : "";
          };
    });