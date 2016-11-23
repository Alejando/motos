setpoint.factory('Brand', function (ModelBase,$q,$http, Slug) {    
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
        getLogo : function (w, h) {
            var url = laroute.route('brand.getLogo',{
                slugSEO : Slug.slugify(this.name) + "-",
                id : this.id,
                width : w,
                heigth :  h
            });
            return url;
        }
    });
    return Brand;
});