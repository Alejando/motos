setpoint.factory('Profile', function (ModelBase, $q, $http) {    
    var Profile = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Profile , {
        alias: 'size',
        setters : {
        },
        attributes: [
            'id',
            'name'
        ],
        relations : []
    }, {
    });
    return Profile;
});