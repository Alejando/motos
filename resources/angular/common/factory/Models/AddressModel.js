setpoint.factory('Address', function (ModelBase,$q,$http) {    
    var Address = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Address , {   
        alias: 'address',
        setters : {
        },
        attributes: [
            'id',
            'street',
            'streetNumber',
            'suiteNumber',
            'neighborhood',
            'postal_code',
            'city',
            'instructions',
            'user_id',
            'country_id',
            'state_id'
        ],
        relations : []
    }, {
    });
    return Address;
});