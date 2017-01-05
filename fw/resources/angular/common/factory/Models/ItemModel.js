setpoint.factory('Item', function (ModelBase, $q, $http, Product, Stock) {    
    var Item = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Item , {   
        alias: 'item',
        setters : {
        },
        attributes: [
            'id',
            'quantity',
            'price',
            'product_id',
            'stock_id',
            'order_id'
        ],
        relations : [
            ['product', Product, 'belongsTo'],
            ['stock', Stock, 'belongsTo']
        ]
    }, {
    });
    return Item;
});