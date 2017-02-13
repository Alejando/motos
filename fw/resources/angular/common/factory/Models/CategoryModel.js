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
            'name',
            'parent_category_id', 
            'type',
            'hidden', 
            'slug'
        ],
        relations : []
    }, {  
    });
    return Category;
});