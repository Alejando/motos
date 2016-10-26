var setpoint = angular.module('setpoint', [
    'slugifier',
    'angular-owl-carousel'
]);
//Fork of http://jsfiddle.net/jamseernj/6guy3sp9/
setpoint.directive('currencyOnly', function() {
      return {
        require: '?ngModel',
        link: function(scope, element, attrs, ngModelCtrl) {
          if(!ngModelCtrl) {
            return; 
          }

          ngModelCtrl.$parsers.push(function(val) {
            if (angular.isUndefined(val)) {
                var val = '';
            }
            
            var clean = val.replace(/[^-0-9\.]/g, '');
            var negativeCheck = clean.split('-');
			var decimalCheck = clean.split('.');
            if(!angular.isUndefined(negativeCheck[1])) {
                negativeCheck[1] = negativeCheck[1].slice(0, negativeCheck[1].length);
                clean =negativeCheck[0] + '-' + negativeCheck[1];
                if(negativeCheck[0].length > 0) {
                	clean =negativeCheck[0];
                }
                
            }
              
            if(!angular.isUndefined(decimalCheck[1])) {
                decimalCheck[1] = decimalCheck[1].slice(0,2);
                clean =decimalCheck[0] + '.' + decimalCheck[1];
            }

            if (val !== clean) {
              ngModelCtrl.$setViewValue(clean);
              ngModelCtrl.$render();
            }
            return clean;
          });

          element.bind('keypress', function(event) {
            if(event.keyCode === 32) {
              event.preventDefault();
            }
          });
        }
      };
  });
setpoint.directive("fileread", [function () {
    return {
        scope: {
            fileread: "=",
            onselectfile: "="
        },
        link: function (scope, element, attributes) {
            element.bind("change", function (changeEvent) {

                if(scope.onselectfile){
                    scope.onselectfile(changeEvent,event.target.files);
                }
                if(event.target.files[0]){
                    scope.fileread = event.target.files[0];
                }
//                var reader = new FileReader();
//                reader.onload = function (loadEvent) {
//                    scope.$apply(function () {
//                        scope.fileread = loadEvent.target.result;
//                    });
//                }
//                reader.readAsDataURL(changeEvent.target.files[0]);
            });
        }
    }
}]);

setpoint.directive('filesDagAndDrop',[
    function (){
        return {
            scope : {
                fileread: "=",
                onselectfile: "="
            },
            link : function(scope, element, attributes){
                var inputFile = angular.element(
                    '<input type="file" multiple accept=".jpg,.png" style="display:none">'
                );

                element.append(inputFile);

                inputFile.bind('click', function(e) {
                     e.stopPropagation();
                });

                inputFile.bind('change', function(e) {
                    scope.onselectfile(this.files);
                    e.stopPropagation();
                });

                element.bind('click', function ($event) {
                    $(inputFile).click();
                    $event.preventDefault();
                });

                element.bind('drop',function($event) {
                    scope.onselectfile($event.originalEvent.dataTransfer.files);
                    //element.find('input').val('');
                    $event.preventDefault();
                });

                element.bind('dragover', function ($event) {
                    $event.preventDefault();
                });
            }
        }
    }
]);

//fork: http://codepen.io/apuchkov/pen/ILjFr
setpoint.directive('numbersOnly', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (text) {
                    var transformedInput = text.replace(/[^0-9]/g, '');
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }            
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
});
//http://embed.plnkr.co/pOIh2mOkj9N5HajbiC9h/
setpoint.directive("owlCarousel", function() {
	return {
		restrict: 'E',
		transclude: false,
		link: function (scope) {
			scope.initCarousel = function(element) {
			  // provide any default options you want
				var defaultOptions = {
				};
				var customOptions = scope.$eval($(element).attr('data-options'));
				// combine the two options objects
				for(var key in customOptions) {
					defaultOptions[key] = customOptions[key];
				}
				// init carousel
				$(element).owlCarousel(defaultOptions);
			};
		}
	};
})
.directive('owlCarouselItem', [function() {
	return {
		restrict: 'A',
		transclude: false,
		link: function(scope, element) {
		  // wait for the last item in the ng-repeat then call init
			if(scope.$last) {
				scope.initCarousel(element.parent());
			}
		}
	};
}]);

setpoint.factory('ModelBase', function (Paginacion, $q, $http, $timeout, $interval, $filter) {
    //<editor-fold defaultstate="collapsed" desc="constructor">
    var ModelBase = function (args) {
        this.setProperties(args);
        this.relations = {};
        this._bk_attrs = {};
        this._FILES = false;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="Metodos de Instancia (prototype)">
    ModelBase.prototype = {
        addFile : function (name, data) {
            if(!this._FILES){
                this._FILES = {};
            }
            this._FILES[name] = data;
        },
        backup : function() {
            var self = this;
            var attributes = self.model().attributes; 
            angular.forEach(attributes, function(attr){
                self._bk_attrs[attr] = self[attr];
            });
            return this;
        },
        rollback : function() {
            var self = this;
            angular.forEach(self._bk_attrs, function(i ,attr){
                self[attr] = self._bk_attrs[attr];
            });
            return this;
        },
        //<editor-fold defaultstate="collapsed" desc="setProperties">
        setProperties: function (data) {            
            var self = this;
            var atributes = self.model().attributes; 
            var setters = self.model().setters;
            angular.forEach(atributes, function (attr) {
                if(setters && setters[attr]){
                    self[attr] = setters[attr].apply(self,[data[attr]]);
                    return;
                }
                self[attr] = data[attr];
            });
        },
        selfUpdate : function (milisecons, $scope) {  
            var self = this;
            $interval(function() {
                console.log("Inicia --- re", milisecons);
                self.refresh();
            },milisecons);            
        },
        refresh : function () {
            var data = {};
            var self = this;
            var $defer =  $q.defer();
            var model = this.model();
            data[model.aliasUrl()] = this.id;
            var url = laroute.route(model.aliasUrl() + '.show', data);            
            $http({
                'method' : 'GET',
                'url' : url
            }).then(function(result) {
                self.setProperties(result.data);
            }, function(r) {                
                $defer.reject(r);
            });
            return $defer;
        },
        getProperties : function () {
            var self = this;
            var data = {};
            var attributes = self.model().attributes;
            angular.forEach(attributes, function (attr){
                data[attr] = self[attr];
            });
            return data;
        },
        create : function () {
            var  data = this.getProperties();
            var model = this.model();
            var self = this;
            var url = laroute.route(model.aliasUrl());        
            var $defer = $q.defer();
            $http({
                'method' : 'POST',
                'data' : data,
                'url' : url
            }).then(function(result) {
                self.setProperties(result.data.model);
                instancias =model.model().addCache(self);
                $defer.resolve(model);
            },function(r){
                $defer.reject(r);
            });
            return $defer.promise;
        },
        update : function () {
            var self = this;
            var data = {};
            var atributes = self.model().attributes; 
            var preparers = self.model().preparers;
            angular.forEach(atributes, function (attr) {
                if(preparers && preparers[attr]){
                    console.log(attr);
                    data[attr] = preparers[attr].apply(self,[self[attr]]);
                    return;
                }
                data[attr] = self[attr];
            });
            var alias= this.model().alias;
            var relations = this.model().conf_relations;
            angular.forEach(relations, function (conf, relation) {
                if(conf[ModelBase.RELATIONS.FUNCTION] === "hasMany") {
                    data[relation] = [];
                    angular.forEach(self[relation + "_ids"], function(item){
                        data[relation].push(item);
                    });
                } else if(conf[ModelBase.RELATIONS.FUNCTION] ==='x') {
                    
                }
            });
            
            var datalaroute = {};
            datalaroute[alias] = this.id;
            var url = laroute.route(alias+'.update', datalaroute);
            var $def = $q.defer();
            $http({
                url : url,
                method : 'PUT',
                data : data
            }).then(function(r){
                $def.resolve(r.data);
            });
            return $def.promise;
        },
        saveWithFiles : function () {
            var $def = $q.defer();
            var self = this;
            var fd = new FormData();
            var model = this.model();
            var data = this.getProperties();
            var url = laroute.route(model.aliasUrl()); 
            angular.forEach(this._FILES,function(file, name) { 
                fd.append(name, file);
            });
            var relations = this.model().conf_relations;
            angular.forEach(relations, function (conf, relation) {
                if(conf[ModelBase.RELATIONS.FUNCTION] === "hasMany") {
                    angular.forEach(self[relation+"_ids"], function(item){
                        fd.append(relation + "[]", item);
                    });
                } else if(conf[ModelBase.RELATIONS.FUNCTION] ==='x') {
                    
                }
            });
            angular.forEach(data, function (value, field) {
                if(value!==undefined) {
                    if(angular.isArray(value)){
                        angular.forEach(value,function(item) {
                            fd.append(field+"[]", item);
                        });
                    } else {
                        fd.append(field, value);  
                    }
                }
            }); 
            $http.post(url,fd, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            }).success(function(){
                $def.resolve();
            }).error(function(){
                $def.reject() 
           });
            return $def.promise;
        },
        save : function () {
            if(this._FILES) {
                return this.saveWithFiles();
            }
            if(this.id){
                return this.update();
            }
            return this.create();
        
        },
        detach : function (strRelation, entity) {
            var fn = this.model().conf_relations[strRelation][ModelBase.RELATIONS.FUNCTION];
            if(fn === "hasMany"){
                var index = this.relations[strRelation].indexOf(entity);
                if(index != -1) {
                    this.relations[strRelation].splice(index,1);
                }
                index = this[strRelation + "_ids"].indexOf(entity.id);
                if(index !=-1) {
                    this[strRelation + "_ids"].splice(index,1);
                }
            }else {
                throw Error(strRelation + " Fn no implementada");
            }
            return this;
        },
        relate : function (strRelation, entity) {
            var fn = this.model().conf_relations[strRelation][ModelBase.RELATIONS.FUNCTION];
            if(fn === "hasMany"){
                if(this.relations[strRelation]==undefined) {
                    this.relations[strRelation] = [];
                    this[strRelation + "_ids"] = [];
                }
                this.relations[strRelation].push(entity);
                this[strRelation + "_ids"].push(entity.id);
            } else if(fn === "belongsTo") {
                this.relations[strRelation] = entity;
                this[strRelation +"_id"] = entity.id;
            } else {
                throw Error(strRelation + " Fn no implementada");
            }
            return this;
        },
        remove : function() {
            var model = this.model();
            var url = laroute.route(model.aliasUrl())+"/"+this.id;        
            var $defer = $q.defer();
            $http({
                'method' : 'DELETE',
                'url' : url
            }).then(function(result) {
                //Todo implemenetar elminar de cache
                $defer.resolve(result);
            },function(r){
                $defer.reject(r);
            });
            return $defer.promise;
        },
        getter : function (key){
            return this["_obj_" + key];
        },
        hasMany : function (Model, key) {
            var self = this;
            var defer = $q.defer();
            if(self.id){
                var url = laroute.route(self.model().aliasUrl()  + '.relation',{
                    'id' : self.id,
                    'relation' :  key
                });
                $http({
                    'method' : 'GET',
                    'url' : url
                }).then(function(result){                
                    var arrIds = [];
                    var instancias = Model.build(result.data, function(obj){
                        arrIds.push(obj.id);
                    });
                    self.relations[key] = instancias;
                    self[key+"_ids"] = arrIds;
                    defer .resolve(instancias);                                
                },function(r) {                
                    defer .reject(r);
                });
            } else {
                $timeout(function(){
                    defer .resolve([]);
                });
            }
            return defer.promise;
        },
        belongsTo : function (Model, key) {
            console.log("ok");
            var self = this;
            var defer = $q.defer();
            var id = this[key + "_id"];
            if(id) {
                Model.getById(id).then(function(entidad) {                                  
                    self.relations[key] = entidad;                         
                    defer.resolve(entidad);
                }, function(r){
                    defer.reject(r);
                });
            } else {
                $timeout(function() {
                    defer.reject();
                }, 10);
            }
            
            return defer.promise;
        }
        //</editor-fold>
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="Metodos Estaticos">
    ModelBase.findCache = function(obj){        
        var cache = this.model().cache;                       
        obj = cache[obj.id];
        if(obj){
            return obj;
        } else {
            return false;
        }
    };
    ModelBase.setFloat = function (value) {
        if(value){
            return parseFloat(value);
        }
        return undefined;
    },
    //Helper para setear fechas 
   
    ModelBase.setDate = function (value) {
        if(angular.isString(value)) {
            var date = new Date(value);
            if(isNaN(date.getTime())){
                return null;
            }
            return date;
        }
        return value;
    };
    ModelBase.prepareDate = function (date){
        var dateTemp = new Date(date);
        dateTemp.setHours(0);
        dateTemp.setMinutes(0);
        dateTemp.setSeconds(0);
        if(dateTemp.getTime && !isNaN(dateTemp.getTime())){
            return $filter('date')(dateTemp,'yyyy-MM-ddTHH:mm:ssZ');;
        } else {
            return undefined;
        }
    };
    ModelBase.model = function () {
        return this.prototype.model();
    };
    ModelBase.getCache = function () {
        return this.cache;
    };    
    ModelBase.RELATIONS = {
        KEY : 0,
        MODEL : 1,
        FUNCTION : 2
    };
    
    ModelBase.addRelation = function (key, fnModel, fn) {
        var model = this.model();        
        if(angular.isString(fn)){//funciones de relaciones por defecto                
            switch(fn){
                case 'belongsTo' :
                    fn = function () {                           
                        return this.belongsTo(fnModel, key);
                    };
                    model.attributes.push(key + "_id");
                    break;
                case 'hasMany' : 
                    fn = function () {                              
                        return this.hasMany(fnModel, key);
                    };
                break;
            }                
        } 
        model.prototype[key] = fn;
    };
    
    ModelBase.createModel = function (model, statics, prototype) {
        angular.extend(model.prototype, ModelBase.prototype, prototype);
        angular.extend(model, ModelBase, statics);
        model.prototype.model = function () {            
            return model;
        };
        model.cache = [];
        model.conf_relations = {};
        angular.forEach(model.relations, function(v){            
            var key = v[ModelBase.RELATIONS.KEY];            
            var fn = v[ModelBase.RELATIONS.FUNCTION];
            var fnModel = v[ModelBase.RELATIONS.MODEL];
            model.addRelation(key,fnModel,fn);
            model.conf_relations[key] = v;
        });
//        console.log("models->"+model.attributes);
        return model;
    };
    ModelBase.aliasUrl = function () {
        return this.alias;
    };
    ModelBase.addCache = function(obj) {        
        var Model = this.model();        
        var cache = Model.getCache();
        cache[obj.id] = obj;        
        return obj;
    };
    //<editor-fold defaultstate="collapsed" desc="build">
    ModelBase.build = function (data, fnSteep) {        
        if(fnSteep === undefined) {
            fnSteep = $.noop;
        }
        var Model = this.model(), obj;
        if (angular.isArray(data)) {            
            var arrInst = [];
            var i = 0;
            angular.forEach(data, function (d) {                
                obj = Model.findCache(d);                                
                if(obj) {
                    obj.setProperties(d);
                    arrInst.push(obj);
                    i++;
                } else {
                    obj = Model.addCache(new Model(d));  
                    arrInst.push(obj);
                }
                fnSteep(obj);
            });
            return arrInst;
        }
        obj = Model.findCache(data);
        if(!obj) {                   
            obj = Model.addCache(new Model(data));
        }
        fnSteep(obj);
        return obj;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getAll">
    ModelBase.getAll = function () {
        var self = this.model();
        var url = laroute.route(this.aliasUrl());        
        var $defer = $q.defer();
        $http({
            'method' : 'GET',
            'params' : {
                'paginacion' : false
            },
            'url' : url
        }).then(function(result) {
            var instancias =self.model().build(result.data);
            $defer.resolve(instancias);
        },function(r){
            $defer.reject(r);
        });
        return $defer.promise;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="paginado">
    ModelBase.paginado = function () {            
        var self = this;        
        var url = laroute.route(this.aliasUrl());
        var $defer = $q.defer();        
        $http({
            'method' : 'GET',
            'params' : { 
                'paginacion' : true
            },
            'url' : url
        }).then(function(result) {
            var arrInst = [], pojsos, paginacion;            
                pojsos = result.data.data;
                paginacion = new Paginacion.build(result.data, self.model());
            $defer.resolve({
                'instancias': arrInst,
                'paginacion' : paginacion
            });
        });
        return $defer.promise;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getURLForAllDataTables">
    ModelBase.getURLForAllDataTables = function () {
        var self = this;
        var url = laroute.route(self.model().aliasUrl()  + '.all-for-datatables', {});
        return url;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getallForDataTables">
    ModelBase.getAllForDataTables = function() {
        var self = this;
        var url = self.getURLForAllDataTables();
        var $defer = $q.defer();
        $http({
            'method' : 'GET',
            'url' : url
        }).then(function(result) {
            $defer.resolve(result.data);
        });
        return $defer.promise;
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="getById">
    ModelBase.getById = function(id, args) {        
        var data = angular.extend(args || {} , {
            id : id
        });        
        var self = this; 
        var $defer = $q.defer();                
        var objCache = self.model().findCache(data);     
//        console.log(objCache);
        if(objCache !== false) {
            $timeout(function() {
                $defer.resolve(objCache);
            }, 10);
        } else {   
            data = {};
            data[this.aliasUrl()] = id;
            var url = laroute.route(this.aliasUrl() + '.show', data);            
            $http({
                'method' : 'GET',
                'url' : url
            }).then(function(result) {
                var instancias = self.model().build(result.data);
                $defer.resolve(instancias);
            }, function(r) {                
                $defer.reject(r);
            });
        }
        return $defer.promise;
    };
    //</editor-fold>
    //</editor-fold>
    return ModelBase;
});

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
            'parent_category_id'
        ],
        relations : []
    }, {
    });
    return Category;
});
setpoint.factory('Color', function (ModelBase,$q,$http) {    
    var Color = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Color , {   
        alias: 'color',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'pref',
            'rgb'
        ],
        relations : []
    }, {
    });
    return Color;
});
/* global angular, glimglam */
setpoint.factory('Paginacion', function () {
    var Paginacion = function (args) {        
        this.setPropieties(args);
    };
    //Se hereda el prototipo base y se agregan los metodos personalizados
    Paginacion.prototype = {
        setPropieties: function (data) {            
            var self = this;
            var atributes = this.getAttributes();
            angular.forEach(atributes, function (value) {                
                self[value] = data[value];
            });
        },
        getAttributes: function () {
            return [
                'current_page',
                'from',
                'last_page',
                'next_page_url',
                'per_page',
                'prev_page_url',
                'to',
                'total'
            ];
        }
    };
    Paginacion.build = function (data) {        
        return new Paginacion(data);
    };
    return Paginacion;
});
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
                $defer.resolve(request.data);
            });
            return $defer.promise;
        }
    });
    return Product;
});

setpoint.factory('Profile', function (ModelBase, $q, $http) {    
    var Profile = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Profile , {
        alias: 'size',
        setters : {
        },
        attributes: [
            'id',
            'name'
        ],
        relations : []
    }, {
    });
    return Profile;
});
setpoint.factory('Size', function (ModelBase,$q,$http) {    
    var Size = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Size , {   
        alias: 'size',
        setters : {
        },
        attributes: [
            'id',
            'name'
        ],
        relations : []
    }, {
    });
    return Size;
});
setpoint.factory('Stock', function (ModelBase, $q, $http,
    Product,
    Color,
    Size) {
    var Stock = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Stock , {
        alias: 'stock',
        setters : {
        },
        attributes: [
            'id',
            'quantity',
            'price',
            'code',
            'codebar'
        ],
        relations : [
            ['product', Product, 'belongsTo'],
            ['color', Color, 'belongsTo'],
            ['size', Size, 'belongsTo']
        ]
    }, {
    });
    return Stock;
});

setpoint.factory('User', function (ModelBase, $q, $http) {    
    var User = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(User , {   
        alias: 'user',
        setters : {
        },
        attributes: [
            'id',
            'name',
            'email',
            'password',
            'profile'
        ],
        relations : []
    }, {
        addBookmark: function(id_product){
            var def = $q.defer();
            var url = laroute.route('user.addBookmark', {'id_product':id_product});
            $http.post(url).then(function(){
                def.resolve();
            });
            return def.promise;
        },
        deleteBookmark: function(id_product){
            var def = $q.defer();
            var url = laroute.route('user.deleteBookmark', {'id_product':id_product});
            $http.delete(url).then(function(){
                def.resolve();
            });
            return def.promise;
        }
    });
    return User;
});
!function() {
    setpoint.controller("ProdcutDetailsCtrl", function($scope, Product, Color, $q) {
        var loadProduct = Product.getById(window.product);
        $scope.changeColor = function(id_color) {
            Color.getById(id_color).then(function(color) {
                console.log(color);
            });
        };
        $scope.ok = function(img) {
            $scope.selectedImg = img;
            $scope.product.getImgs().then(function(img){
                $scope.selectedImgs = img;
            });   
        }
       
        
        loadProduct.then(function(product) {
            $scope.product = product;
            console.log($scope.product);
            var loadColors = $scope.product.colors();
            var loadSizes = $scope.product.sizes();
            var loadImgs = $scope.product.getImgs();            
            $q.all([loadColors, loadSizes, loadImgs]).then(function(data){
                $scope.colors = data[0];
                $scope.sizes = data[1];
                $scope.imgs = data[2];
                $scope.selectedImgs = $scope.imgs;
            });
        })
        
    });
}();
//# sourceMappingURL=web-angular.js.map
