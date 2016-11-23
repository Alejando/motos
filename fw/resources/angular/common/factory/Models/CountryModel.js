setpoint.factory('Country', function (ModelBase,$q,$http) {    
    var Country = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Country , {   
        alias: 'country',
        setters : {
        },
        attributes: [
            'id',
            'name'
        ],
        relations : []
    }, {
    });
    return Country;
});