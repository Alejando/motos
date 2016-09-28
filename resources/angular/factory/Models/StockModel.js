setpoint.factory('Stock', function (ModelBase, $q, $http) {    
    var Product = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Product , {   
        alias: 'stock',
        setters : {
        },
        attributes: [
            'id',
            'quantity'
        ],
        relations : []
    }, {
    });
    return Product;
});