setpoint.factory('Product', function (ModelBase,$q,$http, Category, Color, Brand, Size) {
    var Product = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Product , {
        alias: 'product',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'code',
            'slug',
            'codebar',
            'description',
            'multi_galeries',
//            'colors',
//            'categoriesC',
            'brand_id'
        ],
        relations : [
            ['categories', Category, 'hasMany'],
            ['sizes', Size, 'hasMany'],
            ['colors', Color, 'hasMany'],
            ['brand', Brand, 'belongsTo']
        ],
    }, {
        renameImg : function () {
            var $defer = $q.defer();
            var url = laroute.route('product.renameImg', {
                'id' : this.id
            });
            $http.put(url,{
                img : img,
                name : name
            }).then(function (request){
//                console.log(request);
            });
            $defer.promise;
        },
        removeImg : function (img) {
            var $defer = $q.defer();
            var url = laroute.route('product.getImgs', {
                'id' : this.id
            });
            $http.delete(url,{
                img : img
            }).then(function (request){
//                console.log(request);
            });
            $defer.promise;
        },
        getImg : function (img, width, height) {
            var url = laroute.route('product.img', {
                id : this.id,
                width : width,
                height: height,
                img : img
            });
//            console.log(url);
            return url;
        },
        getImgs : function () {
            var $defer = $q.defer();
            var url = laroute.route('product.getImgs', {
                'id' : this.id
            });
            var self = this;
            $http.get(url).then(function (request){
                self.imgs = request.data;
            });
            $defer.promise;
        }
    });
    return Product;
});
