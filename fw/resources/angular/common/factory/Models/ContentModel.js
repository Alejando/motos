setpoint.factory('Content', function(ModelBase, $q, $http) {
    var Content = function(args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Content, {
        alias: 'content',
        setters: {},
        attributes: [
            'id',
            'title',
            'name',
            'slug',
            'content'
        ],
        relations: []
    }, {});
    return Content;
});