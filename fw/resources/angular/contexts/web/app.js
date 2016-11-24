var setpoint = angular.module('setpoint', [
    'slugifier',
    'angular-owl-carousel',
    'LocalStorageModule',
    'devtics-angular-modelbase'
]);

setpoint.config(function (localStorageServiceProvider, $httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    localStorageServiceProvider
        .setPrefix('estrasol')
//        .setStorageType('sessionStorage')
    ;
});
