setpoint.factory('Color', function (ModelBase,$q,$http) {    
    var Color = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Color , {   
        alias: 'color',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'pref',
            'rgb'
        ],
        relations : []
    }, {
    });
    return Color;
});