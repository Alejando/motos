setpoint.factory('Address', function (ModelBase,$q,$http, State, Country) {    
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
            'state_id',
            'label',
            'first_name',
            'last_name',
            'tel'
        ],
        relations : [
            ['state', State, 'belongsTo'],
            ['country', Country, 'belongsTo']
        ]
    }, {
    });
    return Address;
});