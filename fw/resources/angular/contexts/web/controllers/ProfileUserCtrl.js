setpoint.controller('ProfileUserCtrl', function (
    $scope,
    $compile,
    $q, 
    $http,
    User, 
    $timeout,
    AuthSevice
    ) {

    $scope.test = "Profile user";
    $scope.model = User;

    $scope.user = AuthSevice.user();

    $scope.user.birthdate = new Date($scope.user.birthdate);
    console.log($scope.user.birthdate);
    // $scope.model.getById($scope.user.id).then(function(data){
    //              $scope.selectedItem = data;
    //              $scope.user.email = "ffdgdf";
    //              console.log($scope.selectedItem);
    //              console.log(User.cache);
    //         });

    // console.log($scope.selectedItem);


    console.log("Profile");

    $scope.testFunction = function(){
        alert("test");
    }
    
    $scope.editProfile = function(){
        // $scope.model.getById($scope.user.id).then(function(data){
        //          $scope.selectedItem = data;
        //     });

        var $message = $('<div>Cargando...</div>');

        $scope.user.backup();
        BootstrapDialog.show({
            title: 'Editar datos personales',
            message: $message,
            onhide: function(dialog){
                // $timeout(function(){
                //     $scope.user.rollback();
                // },5);
                $scope.user.rollback();
            },
            onhidden: function(dialog){
                
                // $scope.$apply(function(){
                //     alert("cdfdd");
                //     $scope.user.rollback();
                // });
            },
            buttons: [{
                label: 'Guardar',
                cssClass: 'btn-primary',
                action: function(dialogRef, event){
                    $scope.$apply(function(){
                       $scope.saveItem(event);
                    });
                }},{
                label: 'Cancelar',
                cssClass: 'btn-danger',
                action: function(dialogRef,event){
                    $scope.$apply(function(){
                       $scope.cancel(event);
                    });
                }}]
        }); 

        $http.get(laroute.route('user.pages', {
            'view' : 'form-profile'
        })).then(function(result){
            $message.fadeOut('slow', function(){
                var $div = $(this);
                $div.html(result.data).slideDown("slow"); 
                $content = angular.element(this).contents();
                $scope.$apply(function(){
                    $compile($content)($scope);
                });
            })
        });

     }

     $scope.resetPassword = function(){

        $http.post(laroute.route('reset.password', {
            'email' : 'manzanares.gael@gmail.com'
        })).then(function(result){
            alert(result);
        });

     }

     $scope.saveItem = function ($event) {
            console.log("guardado...");
            
            $scope.user.save().then(function () {
                $scope.user.backup();
                var $dialog = $($event.target).closest('.modal');
                $dialog.modal('hide')
                $scope.dtInstance.reloadData(function(){
                }, !true);
            });
        };
    $scope.cancel = function ($event) {
            $event.preventDefault();
            var $dialog=$($event.target).closest('.modal');
            $dialog.modal('hide');
        };
    var newObj = function () {
            return new $scope.model({});
        };
    
});
