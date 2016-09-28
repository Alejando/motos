setpoint.factory('Product', function (ModelBase,$q,$http) {    
    var Product = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Product , {   
        alias: 'size',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'sizes',
            'colors'
        ],
        relations : []
    }, {
    });
    return Product;
});