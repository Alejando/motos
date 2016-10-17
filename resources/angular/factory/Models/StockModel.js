setpoint.factory('Stock', function (ModelBase, $q, $http,
    Product,
    Color, 
    Size) {    
    var Stock = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Stock , {   
        alias: 'stock',
        setters : {
        },
        attributes: [
            'id',
            'quantity',
            'prices'
        ],
        relations : [
            ['product', Product,''],
            ['color', Color, ''],
            ['size', Size, '']
        ]
    }, {
    });
    return Stock;
});