var setpoint = angular.module('setpoint', [
    'slugifier',
    'angular-owl-carousel',
    'LocalStorageModule',
    'devtics-angular-modelbase'
]);

setpoint.config(function (localStorageServiceProvider) {
    localStorageServiceProvider
        .setPrefix('estrasol')
//        .setStorageType('sessionStorage')
    ;
});