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
        getPrice : function () {
           var product = this.getRelation('product');
           if(!product){
               throw new Error("Carga la relación de producto (product()) antes de usar getPrice");
           }
           var discount = product.discount_percentage;
           var price = this.price;
           if(discount) {
               return price - ((price / 100) * discount);
           }
           return price;
        }
    });
    
    Product.addRelation('stocks',Stock,'hasMany');
    
    return Stock;
});
