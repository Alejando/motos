setpoint.factory('Size', function (ModelBase,$q,$http) {    
    var Size = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Size , {   
        alias: 'size',
        setters : {
        },
        attributes: [
            'id',
            'name'
        ],
        relations : []
    }, {
    });
    return Size;
});