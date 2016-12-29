setpoint.factory('PostalCodeGroup', function (ModelBase, PostalCode, $q,$http, Slug) {    
    var PostalCodeGroup = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(PostalCodeGroup, {   
        alias: 'postalCodeGroup',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'price'
        ],
        relations : [
            ['postal_codes', PostalCode, 'hasMany']
        ]
    }, {
    });
    return PostalCodeGroup;
});