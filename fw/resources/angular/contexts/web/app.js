var setpoint = angular.module('setpoint', [
    'slugifier',
    'angular-owl-carousel',
    'LocalStorageModule',
    'devtics-angular-modelbase',
    'remoteValidation',
    'datatables'
]);

setpoint.directive('ngElevateZoom', function() {
          return {
            restrict: 'A',
            scope: {
                zoomEventsObject : '='
            },
            link: function(scope, element, attrs) {
                var $element, ez;
                scope.zoomEventsObject.changeImgs = function(smallImage, largeImage) {                    
                    ez.swaptheimage(smallImage, largeImage);
                };
                //Will watch for changes on the attribute
                attrs.$observe('zoomImage',function(){
                    linkElevateZoom();
                });
                function linkElevateZoom() {
                    if (!attrs.zoomImage) return;
                    element.attr('data-zoom-image',attrs.zoomImage);
                    $element = $(element);
                    $element.elevateZoom({
                        //scrollZoom : true
                        // zoomType                : "lens",
                        // lensShape : "round",
                        // lensSize    : 200
                    });
                    ez = $element.data('elevateZoom');
                };
                linkElevateZoom();
            }
          };
        });

setpoint.config(function (localStorageServiceProvider, $httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    localStorageServiceProvider
        .setPrefix('estrasol')
//        .setStorageType('sessionStorage')
    ;
});

setpoint.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);

setpoint.constant('IVA', '16');