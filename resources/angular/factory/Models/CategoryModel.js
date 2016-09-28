setpoint.factory('Category', function (ModelBase,$q,$http) {    
    var Category = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Category , {   
        alias: 'category',
        setters : {
        },
        attributes: [
            'id',
            'name'
        ],
        relations : []
    }, {
    });
    return Category;
});