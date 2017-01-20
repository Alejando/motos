setpoint.factory('DBConfig', function (ModelBase, $q, $http, Product, Stock) {    
    var DBConfig = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(DBConfig , {   
        alias: 'dbconfig',
        setters : {},
        attributes: [
            'id',
            'code',
            'name',
            'value',
            'type'
        ],
        relations : []
    }, {
    });
    return DBConfig;
});