glimglam.factory('User', function (ModelBase,$q,$http) {    
    var User = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(User , {   
        FINISHED : 2,
        STARTED : 1,
        STAND_BY : 0,
        alias: 'user',
//        cache : [],
        setters : {
            startDate : ModelBase.setDate,
            endDate : ModelBase.setDate
        },
        attributes: [
            'id',
            'name',
            'email'
        ],
        relations : []
    }, {
    });    
    //<editor-fold defaultstate="collapsed" desc="buscarFolio">
    return User;
});