setpoint.factory('Product', function(ModelBase, $q, $http, Category, Color, Brand, Size, $location) {
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
        renameImg: function(img, newName) {
            var $defer = $q.defer();
            var self = this;
            var url = laroute.route('product.img.edit', {
                'product': this.id,
                'img' : img
            });
            $http.put(url, {                
                'newName': newName
            }).then(
                function(request){
                    var index = self.imgs.indexOf(img);
                    self.imgs[index] = newName;
                    $defer.resolve(request);
                },
                function(request) {
                    $defer.reject(request); 
                }
            );
            return $defer.promise;
        },
        removeImg: function(img) {
            var $defer = $q.defer();
            var self = this;
            var url = laroute.route('product.img.remove', {
                'id' : this.id,
                'img' : img 
            });
            $http.delete(url, { 
                img : img
            }).then(function(request) { 
                var index = self.imgs.indexOf(img);
                self.imgs.splice(index, 1); 
                $defer.resolve(request);
            }, function (request) {
                $defer.reject(request); 
            });
            return $defer.promise;
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
        getZoomImg: function(img, width, height, absoluteURL) {
            //var img2 = encodeURIComponent(img.trim());
            var host = $location.host();
            var url = laroute.route('product.img', {
                id: this.id,
                width: width,
                height: height,
                img: img
            });
            var urlAbsolute = host+url;
            if(absoluteURL){
                return laroute.url(url,[]);
            }
            return urlAbsolute;
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
