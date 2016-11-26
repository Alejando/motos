setpoint.controller('ProductListCtrl', ['$scope', 'User', 'Product',
    function($scope, User, Product){

        var favoritos = [];
        //console.log(favoritos);
        //favoritos = Bookmarks; //Temporal
        //console.log(favoritos);
        //console.log(Bookmarks);
        User.getIdProductInBookmarks().then(function(data){
            favoritos =  data;        
        });
            
        $scope.checkFav = function(id){
            return favoritos.indexOf(id) > -1;
            //console.log(favoritos);
            //console.log(Bookmarks);
        }
        
        
        $scope.addBookmark = function($event, id){
            $event.stopPropagation();
            $event.preventDefault();

            //console.log(favoritos);
            //console.log(Bookmarks);  
        

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