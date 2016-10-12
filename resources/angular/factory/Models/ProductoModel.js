setpoint.factory('Product', function (ModelBase,$q,$http) {    
    var Product = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Product , {   
        alias: 'product',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'code',
            'sizes',
            'description',
            'multi_galeries',
            'colors',
            'categories',
            'brand_id'
        ],
        relations : [
            //['colors', Color, 'hasMany']
        ]
    }, {
    });
    return Product;
});