var setpoint = angular.module('setpoint', [
    'slugifier',
    'angular-owl-carousel',
    'LocalStorageModule'
]);

setpoint.config(function (localStorageServiceProvider) {
    localStorageServiceProvider
        .setPrefix('estrasol')
//        .setStorageType('sessionStorage')
    ;
});