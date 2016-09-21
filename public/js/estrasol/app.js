var setpoint = angular.module('setpoint', [
    'ngRoute',
    'datatables'
]);
//setpoint.constat('Config', {
//    DATE_FORMAT : 'dd/MMMM/yyyy', //https://docs.angularjs.org/api/ng/filter/date
//    HOUR_FORMAT : 'HH:mm:ss', 
//    DATE_SERVER_FORMAT : 'yyyy-MM-ddTHH:mm:ssZ',
//    CALENDAR_DATE_FORMAT : 'dd/MM/yyyy' //http://bootstrap-datepicker.readthedocs.org/en/stable/options.html#format
//});
setpoint.config(function ($routeProvider) {
    var pathAdmin = function (arrRoutes){
        angular.forEach(arrRoutes, function(route){
            var path = route[0], 
            template = 'pages/admin/'+route[1]+'.html', 
            ctrl = route[2]+'Ctrl';
            console.log(path);
            $routeProvider.when(path,{
                templateUrl : template,
                controller: ctrl
            });
        });
    };
    
    pathAdmin([
        ['/', 'welcome', 'Home'],
        ['/catalogos/:catalog', 'catalog', 'Catalog'],
        ['/contenidos/:content', 'content-form', 'Content'],
        ['/configuracion/:config', 'config', 'Config']
    ]);
});
!function () {

    setpoint.controller('CatalogCtrl', function (
            $scope,
            $compile,
            $routeParams,
            $q, $http,
            Size,
            DTOptionsBuilder,
            DTColumnBuilder) {
        //<editor-fold defaultstate="collapsed" desc="catalogo de productos">

        //</editor-fold>
        this.productos = function () {
            $scope.catalog = "lalala";
        };
        //<editor-fold defaultstate="collapsed" desc="catalogo de tallas">
        this.tallas = function () {
            $scope.selectedItem = new Size({});
            $scope.selectedItem.name = "XL";
//            $scope.selectedItem.id=false;
//            $scope.selectedItem.save();     
            console.log(Size);

        };
        //</editor-fold>
        $scope.saveItem = function () {
            $scope.selectedItem.save().then(function () {
                console.log("se guardo");
                $scope.showForm = false;
                $scope.selectedItem = newObj();
            });
        };

        $scope.newItem = function () {
            $scope.showForm = true;
            $scope.selectedItem = newObj();
        };

        $scope.cancel = function () {
            $scope.showForm = false;
            $scope.selectedItem = newObj();
        };

        var newObj = function () {
            var prototipes = {
                'tallas': Size
            };
            return new prototipes[$scope.catalog]({});
        };
        $scope.catalog = $routeParams.catalog;
        $scope.showForm = true;
        $scope.form = laroute.route('page', {view: 'form-' + $scope.catalog});

        $scope.selected = {};
        $scope.selectAll = false;

        $scope.toggleAll = function (selectAll, selectedItems) {
            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    selectedItems[id] = selectAll;
                }
            }
        };
        $scope.toggleOne = function (selectedItems) {
            console.log($scope.items=[]);
            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    if (!selectedItems[id]) {
                        $scope.selectAll = false;
                        return;
                    }
                }
            }

            $scope.selectAll = true;
        };

        $scope.items;
        var url = laroute.route('size.all-for-datatables');
        $scope.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
            var defer = $q.defer();
            $http.get(url).then(function (result) {
                $scope.items = result.data;
                defer.resolve(result.data);
            });
            return defer.promise;
        }).withOption('createdRow', function (row, data, dataIndex) {
                    // Recompiling so we can bind Angular directive to the DT
                    $compile(angular.element(row).contents())($scope);
                }).withOption('headerCallback', function (header) {
            if (!$scope.headerCompiled) {
                // Use this headerCompiled field to only compile header once
                $scope.headerCompiled = true;
                $compile(angular.element(header).contents())($scope);
            }
        })
                .withPaginationType('full_numbers');

        var titleHtml = '<input type="checkbox" ng-model="selectAll" ng-click="toggleAll(selectAll, selected)">';
        $scope.dtColumns = [
            DTColumnBuilder.newColumn(null).withTitle(titleHtml).notSortable()
                    .renderWith(function (data, type, full, meta) {
                        $scope.selected[full.id] = false;
                        return '<input type="checkbox" ng-model="selected[' + data.id + ']" ng-click="toggleOne(selected)">';
                    }),
            DTColumnBuilder.newColumn('id').withTitle('ID'),
            DTColumnBuilder.newColumn('name').withTitle('Name')
        ];
        this[$scope.catalog]();
    });
}();
setpoint.controller('ContentCtrl', function ($scope,$routeParams) {
    switch($routeParams.content){
        case 'nosotros':
            $scope.content = 'Nosotros';
            break;
        case 'ventajas':
            $scope.content = 'Ventajas';
            break;
        case 'formas-de-pago':
            $scope.content = 'Formas de pago';
            break;
        case 'terminos-y-condiciones':
            $scope.content = 'Terminos y condiciones';
            break;
        case 'condiciones-de-envio':
            $scope.content = 'Condiciones de envío';
            break;
        case 'ccondiciones-de-retorno':
            $scope.content = 'Condiciones de retorno';
            break;
        case 'protecion-de-datos':
            $scope.content = 'Proctección de datos';
            break;
        default:  $scope.content =  'Contenido';
    } 
//    console.log("mainController");    
});
setpoint.controller('HomeCtrl', function ($scope) {
    $scope.msj = "Bienvenido ";    
//    console.log("mainController") ;    
});
setpoint.controller('MainCtrl', function ($scope) {
//    $scope.mensaje = "hola mundo"; 
//    console.log("mainController");    
});

setpoint.factory('ModelBase', function (Paginacion, $q, $http, $timeout, $interval, $filter) {
    //<editor-fold defaultstate="collapsed" desc="constructor">
    var ModelBase = function (args) {
        this.setProperties(args);
        this.relations = {};
        this._bk_attrs = {};
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="Metodos de Instancia (prototype)">
    ModelBase.prototype = {
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
                if(setters[attr]){
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
                if(preparers[attr]){
                    data[attr] = preparers[attr].apply(self,[self[attr]]);
                    return;
                }
                data[attr] = self[attr];
            });
            var alias= this.model().alias;
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
        save : function () {
            if(this.id){
                return this.update();
            }
            return this.create();
        
        },
        getter : function (key){
            return this["_obj_" + key];
        },
        hasMany : function (Model, key) {
            var self = this;
            var defer = $q.defer();
            var url = laroute.route(self.model().aliasUrl()  + '.relation',{
                'id' : self.id,
                'relation' :  key
            });
            $http({
                'method' : 'GET',
                'url' : url
            }).then(function(result){                
                var instancias = Model.build(result.data);
                self.relations[key] = instancias;
                defer .resolve(instancias);                                
            },function(r) {                
                defer .reject(r);
            });
            return defer.promise;
        },
        belongsTo : function (Model, key) {            
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
                case 'belongsTo' : fn = function () {                           
                        return this.belongsTo(fnModel, key);
                    };
                    model.attributes.push(key + "_id");
                    break;
                case 'hasMany' : fn = function () {                              
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
        angular.forEach(model.relations, function(v){            
            var key = v[ModelBase.RELATIONS.KEY];            
            var fn = v[ModelBase.RELATIONS.FUNCTION];
            var fnModel = v[ModelBase.RELATIONS.MODEL];
            model.addRelation(key,fnModel,fn);
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
    ModelBase.build = function (data) {        
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
            });
            return arrInst;
        }
        obj = Model.findCache(data);
        if(obj) {              
            return obj;
        } else {                        
            obj = Model.addCache(new Model(data));
        }
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
    ModelBase.remove = function () {
        console.log("pediente crear metodo de eliminacion");
    };
    ModelBase.save  = function () {
        console.log("pendiente crear método de creacion/actualizacion");
    };
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
//# sourceMappingURL=app.js.map
