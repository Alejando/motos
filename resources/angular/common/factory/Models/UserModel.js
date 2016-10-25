setpoint.factory('User', function (ModelBase, $q, $http) {    
    var User = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(User , {   
        alias: 'user',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'email',
            'password',
            'profile'
        ],
        relations : []
    }, {
    });
    return User;
});