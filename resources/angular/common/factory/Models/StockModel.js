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
            'price',
            'code',
            'codebar'
        ],
        relations : [
            ['product', Product, 'belongsTo'],
            ['color', Color, 'belongsTo'],
            ['size', Size, 'belongsTo']
        ]
    }, {
    });
    return Stock;
});
