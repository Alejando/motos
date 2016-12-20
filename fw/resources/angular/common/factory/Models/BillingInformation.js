try{
setpoint.factory('BillingInformation', function (ModelBase, $q, $http, User, Country, State) {    
    var BillingInformation = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(BillingInformation , {   
        alias: 'billingInformation',
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
            'city'
        ],
        relations : [
            ['country', Country, 'belongsTo' ],
            ['state', State, 'belongsTo'],
            ['user', User, 'belongsTo']
        ]
    }, {
        
    });
    User.addRelation('billingInformation', BillingInformation, 'hasMany');
    return BillingInformation;
});
}catch(e){
    alert(e);
}