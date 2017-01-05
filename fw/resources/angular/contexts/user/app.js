var setpoint = angular.module('setpoint_user', [
    'ngRoute',
    'datatables',
    'ui.tinymce',
    'color.picker',
    'jsTree.directive',
    'ngSanitize',
    'ui.select',
    'slugifier',
    'fiestah.money',
    'ui.bootstrap',
    'rzModule',
    'ui.bootstrap.datetimepicker',
    'remoteValidation',
    'devtics-angular-modelbase'
]);

setpoint.config(['$qProvider', function ($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);