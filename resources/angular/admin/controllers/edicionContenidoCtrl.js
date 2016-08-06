glimglam.controller('edicionContenidoCtrl', function ($scope, $routeParams) {
    $scope.$parent.subSeccion = "Edición Contenido \"Acerca de\"";
    $scope.titulo = $routeParams.slug;
});