setpoint.controller('OxxoConfirmCtrl',['$scope', function($scope) {
   $scope.print = function () {
        $(".iframe-print")[0].contentWindow.print();
    };
    $scope.download = function () {
        window.open($(".iframe-print")[0].src.replace("html","pdf?download"),'_self');
    }
}]);