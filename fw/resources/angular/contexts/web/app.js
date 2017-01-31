var setpoint = angular.module('setpoint', [
    'slugifier',
    'angular-owl-carousel',
    'LocalStorageModule',
    'devtics-angular-modelbase',
    'remoteValidation',
    'datatables'
]);

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