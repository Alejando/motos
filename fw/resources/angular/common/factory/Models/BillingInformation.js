setpoint.factory('BillingInformation', function (ModelBase,$q,$http, User, Country, STate) {    
    var BillingInformation = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Brand , {   
        alias: 'billing-information',
        setters : {
        },
        attributes: [
            'id',
            'rfc',
            'business_name',
            'street',
            'street_number',
            'suite_number',
            'neighborhood',
            'postal_code',            
        ],
        relations : [
            ['country', Country, 'belongsTo' ],
            ['state', State, 'belongsTo'],
            ['user', User, 'belongsTo']
        ]
    }, {
        
    });
    return BillingInformation;
});