setpoint.factory('Product', function(ModelBase, $q, $http, Category, Color, Brand, Size) {
    var Product = function(args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Product, {
        alias: 'product',
        setters : {
            price_from : function (v) { 
                return parseFloat(v, 10); 
            }
        },
        attributes: [  
            'id',  
            'name',
            'code',
            'slug',  
            'brand_id',
            'price_from',
            'description',
            'multi_galeries',
            'default_color_id',
            'serial_number',
            'discount_percentage',
            'main_banner'
        ],
        relations: [
            ['categories', Category, 'hasMany'],
            ['sizes', Size, 'hasMany'],
            ['colors', Color, 'hasMany'],
            ['defaultColor', Color, 'belongsTo', 'default_color_id'], 
            ['brand', Brand, 'belongsTo']
//            ['stocks', Stock, 'belongTo'],
        ],
    }, {
        renameImg: function() {
            var $defer = $q.defer();
            var url = laroute.route('product.renameImg', {
                'id': this.id
            });
            $http.put(url, {
                img: img,
                name: name
            }).then(function(request) {
                //                console.log(request);
            });
            $defer.promise;
        },
        removeImg: function(img) {
            var $defer = $q.defer();
            var url = laroute.route('product.getImgs', {
                'id': this.id
            });
            $http.delete(url, {
                img: img
            }).then(function(request) {
                //                console.log(request);
            });
            $defer.promise;
        },
        getImg: function(img, width, height, absoluteURL) {
            var url = laroute.route('product.img', {
                id: this.id,
                width: width,
                height: height,
                img: img
            });
            if(absoluteURL){
                return laroute.url(url,[]);
            }
            return url;
        },
        getURLCoverSize : function (width, height) {
            return laroute.route('product.getURLCoverSize', {
                id : this.id,
                width : width,
                height : height
            });
        },
        getURLCover : function () {
            return laroute.route('product.getCover', {
                id : this.id
            });
        }, 
        getImgs: function() {
            var $defer = $q.defer();
            var url = laroute.route('product.getImgs', {
                'id': this.id
            });
            var self = this;
            $http.get(url).then(function(request) {
                self.imgs = request.data;
                $defer.resolve(request.data);
            });
            return $defer.promise;
        },
        checkStock : function (quantity, size, color) {
            var $defer = $q.defer();
            var url = laroute.route('product.checkstock', {
                'id' : this.id
            });
            $http.post(url, {
                'quantity' : quantity,
                'size' : size, 
                'color' : color
            }).then(function(request) {
                console.log(request.data);
                if(request.data.success) {
                    $defer.resolve(request.data);
                }
                console.log("...");
                $defer.reject(request.data.message);
            });
            return $defer.promise;
        }
    });
    return Product;
});
