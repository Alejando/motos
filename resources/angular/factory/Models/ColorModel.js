setpoint.factory('Color', function (ModelBase,$q,$http) {    
    var Color = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Color , {   
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
    return Color;
});