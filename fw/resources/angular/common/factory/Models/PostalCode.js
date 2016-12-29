setpoint.factory('PostalCode', function (ModelBase,$q,$http, Slug) {    
    var PostalCode = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(PostalCode, {   
        alias: 'postalcode',
        setters : {
        },
        attributes: [
            'id',
            'code'
        ],
        relations : []
    }, {
    });
    return PostalCode;
});