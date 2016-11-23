setpoint.controller('ProductListCtrl', ['$scope', 'User', 'Product',
    function($scope, User, Product){

        var favoritos = [];
        User.getIdProductInBookmarks().then(function(data){
            favoritos =  data;
        });

        $scope.checkFav = function(id){
           return favoritos.indexOf(id) > -1;
        }
        
        
        $scope.addBookmark = function($event, id){
            $event.stopPropagation();
            $event.preventDefault();    
        

        if (!$scope.checkFav(id)){
            console.log("btnkon"); 
            User.addBookmark(id);
            favoritos.push(id);
        }
        else{
            console.log("btnk");
            User.deleteBookmark(id);
            favoritos.splice(favoritos.indexOf(id),1);
        }


        };
}]);