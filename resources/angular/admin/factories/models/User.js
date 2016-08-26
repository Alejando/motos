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
            'email',
            'profile',
            'birthday',
            'gender'
        ],
        relations : []
    }, {
        fnGender : function(gender){
            console.log(gender);
            if(gender === undefined){
                return this.gender.toString();
            }
            this.gender = parseInt(gender, 10);
        }
    });
    
    //<editor-fold defaultstate="collapsed" desc="buscarFolio">
    return User;
});