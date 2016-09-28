setpoint.factory('Brand', function (ModelBase,$q,$http) {    
    var Brand = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Brand , {   
        alias: 'brand',
        setters : {
        },
        attributes: [
            'id',
            'name'
        ],
        relations : []
    }, {
    });
    return Brand;
});