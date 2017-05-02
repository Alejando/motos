
setpoint.controller('PaginatorCtrl',['$scope','$location', function($scope,$location) {

    var order=$location.absUrl().substring($location.absUrl().indexOf('order')+6,($location.absUrl().indexOf('&per_page')));
    var per_page=$location.absUrl().substring($location.absUrl().indexOf('&per_page')+10);
    if(order.length>4){
        $scope.order="asc";
    }else{
         $scope.order=order;
    }
    if(per_page.length>2){
        $scope.per_page="6";
    }else{
        
        $scope.per_page=per_page;
    }
    $scope.changePagination=function () {
        window.location=url+'&order='+$scope.order+'&per_page='+$scope.per_page;
    }

}]);