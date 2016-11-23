setpoint.factory('State', function (ModelBase,$q,$http) {    
    var State = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(State , {   
        alias: 'state',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'country_id'
        ],
        relations : []
    }, {
    });
    return State;
});