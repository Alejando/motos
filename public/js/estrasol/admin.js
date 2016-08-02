var glimglam = angular.module("glimglamAdmin", [
    'ngRoute',
    'angular-clockpicker',
    'ui.bootstrap',
    'ui.bootstrap.datetimepicker',
    'ngDropzone',
    'textAngular'
]);

glimglam.constant('uiDatetimePickerConfig', {
    dateFormat: 'yyyy-MM-dd HH:mm',
    defaultTime: '00:00:00',
    html5Types: {
        date: 'yyyy-MM-dd',
        'datetime-local': 'yyyy-MM-ddTHH:mm:ss.sss',
        'month': 'yyyy-MM'
    },
    initialPicker: 'date',
    reOpenDefault: false,
    enableDate: true,
    enableTime: true,
    buttonBar: {
        show: true,
        now: {
            show: true,
            text: 'Now'
        },
        today: {
            show: true,
            text: 'Hoy'
        },
        clear: {
            show: true,
            text: 'Limpiar'
        },
        date: {
            show: true,
            text: 'Date'
        },
        time: {
            show: true,
            text: 'Time'
        },
        close: {
            show: true,
            text: 'Close'
        }
    },
    closeOnDateSelection: true,
    closeOnTimeNow: true,
    appendToBody: false,
    altInputFormats: [],
    ngModelOptions: {},
    saveAs: false,
    readAs: false
});


glimglam.config(function ($routeProvider) {
    $routeProvider.
            when('/', {
                templateUrl: 'pages/admin/welcome.html',
                controller: 'homeCtrl'
            }).
            when('subastas/sin-publicar', {
                templateUrl: 'pages/admin/subastas-admin.html',
                controller: 'nuevaSubastaCtrl'
            })              
    .when('/subastas/nueva', {
        templateUrl: 'pages/admin/subastas-form.html',
        controller: 'nuevaSubastaCtrl'
    })
    .when('/actulizar-masiva', { 
        templateUrl: 'pages/admin/actulizar-masiva.html',
        controller: 'actualizacionMasivaCtrl'
    })
    .when('/subastas/:status', {
        templateUrl: 'pages/admin/subastas-admin.html',
        controller: 'subastasCtrl'
    });
    $routeProvider.when('/subasta/:id',{
        templateUrl: 'pages/admin/subasta.html',
        controller: 'subastaCtrl'
    });     
    
    $routeProvider.
            when('/subastas/editar', {
                templateUrl: 'pages/admin/subastas-form.html',
                controller: 'edicionSubastaCtrl'
            }).
            when('/subastas/usuarios-lista', {
                templateUrl: 'pages/admin/usuarios-lista.html',
                controller: 'usuariosListaCtrl'
            }).
            when('/subastas/edicion-usuario', {
                templateUrl: 'pages/admin/usuarios-lista.html',
                controller: 'edicionDeUsuarioCtrl'
            }).
            when('/subastas/edicion', {
                templateUrl: 'pages/admin/form-contenidos.html',
                controller: 'edicionContenidoCtrl'
            }).
            when('/subastas/edicion/guia-de-uso', {
                templateUrl: 'pages/admin/form-contenidos.html',
                controller: 'edicionGuiaCtrl'
            }).
            when('/subastas/edicion/terminos', {
                templateUrl: 'pages/admin/form-contenidos.html',
                controller: 'edicionminosTerCtrl'
            }).
            when('/subastas/edicion/avisos', {
                templateUrl: 'pages/admin/form-contenidos.html',
                controller: 'edicionAvisoCtrl'
            })

            ;
});

glimglam.controller('actualizacionMasivaCtrl', function ($scope) {
    $scope.titulo = "Aviso de privacidad";
    $scope.$parent.subSeccion = "Actualización Masiva";
});
glimglam.controller('edicionAvisoCtrl', function ($scope) {
    $scope.titulo = "Aviso de privacidad";
    $scope.$parent.subSeccion = "Edición Contenido \"Aviso de privacidad\"";
});
glimglam.controller('edicionContenidoCtrl', function ($scope) {
    $scope.$parent.subSeccion = "Edición Contenido \"Acerca de\"";
    $scope.titulo = "Acerca de ";
});

glimglam.controller('edicionDeUsuarioCtrl', function ($scope) {
    $scope.titulo = "Edición de usuario";
});
glimglam.controller('edicionGuiaCtrl', function ($scope) {
    $scope.$parent.subSeccion = "Edición Contenido \"Guía de uso\"";
    $scope.titulo = "Guía de uso ";
});
glimglam.controller('edicionSubastaCtrl', function ($scope) {
    $scope.titulo = "Edición de subasta";
});
glimglam.controller('edicionminosTerCtrl', function ($scope) {
    $scope.$parent.subSeccion = "Edición de Contenido \"Términos y condiciones\"";
    $scope.titulo = "Términos y condiciones";
});
glimglam.controller('homeCtrl', function ($scope) {
    $scope.msj = "Bienvenidos";
});
glimglam.controller('mainCtrl', function ($scope) {
    $scope.msj = "Main Controller";
    $scope.subSeccion = false;
});
glimglam.controller('nuevaSubastaCtrl', function ($scope, $log, Auction) {
    //<editor-fold defaultstate="collapsed" desc="configuracion de uis">
    //<editor-fold defaultstate="collapsed" desc="configuracion de hr inicial">
    $scope.optionsStartTime = {
        donetext: 'Establecer Hr. de Inicio',
        twelvehour: true,
        nativeOnMobile: !true,
        placement: 'bottom',
        align: 'right'
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="configuracion de hr final">
    $scope.optionsEndingTime = {
        donetext: 'Establecer Hr. de Final',
        twelvehour: true,
        nativeOnMobile: true,
        placement: 'bottom',
        align: 'right'
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="configuracion de datepiker Inicial">
    $scope.fechaInicio = {
        date: new Date(),
        datepickerOptions: {
            showWeeks: false,
            startingDay: 1,
            language: 'es',
            dateDisabled: function (data) {
                return (data.mode === 'day' && (new Date().toDateString() == data.date.toDateString()));
            }
        }
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="configuracion de datepiker final">
    $scope.picker2 = {
        date: new Date('2015-03-01T00:00:00Z'),
        datepickerOptions: {
            showWeeks: false,
            startingDay: 1,
            language: 'es',
            dateDisabled: function (data) {
                return (data.mode === 'day' && (new Date().toDateString() == data.date.toDateString()));
            }
        }
    };
    
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="configuracion de dropzone fotos">
    $scope.dropzoneConfig = {
        parallelUploads: 3,
        maxFileSize: 30,
        url: 'file-upload',
        dictDefaultMessage:'Click o arrastra una imagen aquí',
        
    };
    $scope.dzProcessing = function () {
      this.options.url = "/api/auction/"+$scope.auction.id+"/addPhoto";
    };
    $scope.dzAddedFile = function (file) {
       $scope.$apply(function () {
           $scope.pics.push(URL.createObjectURL(file));
        });
    };
    $scope.removePic = function (pic){
        $scope.pics.splice($scope.pics.indexOf(pic),1);
    };
    $scope.dzError = function (file, errorMessage) {
        $log.log(errorMessage);
    };
    //</editor-fold>
    //</editor-fold>
    $scope.creating = false;
    $scope.auction = new Auction({});
    $scope.hrBegin = moment(new Date());
    $scope.hrEnd = moment(new Date());
    $scope.createNewAuction = function () {
        var titleTemp = $scope.auction.title; 
        $scope.auction = new Auction({
            title : titleTemp,
            startDate : new Date(),
            endDate : new Date()
        });
        $scope.auction.save().then(function(){
            $scope.creating = true;
        });
    };
    $scope.saveSaveAuction = function () {
        $scope.auction.save();
        window.open("#/subastas/en-proceso",'_self');
    };
    $scope.openCalendar = function (e, picker) {
        $scope[picker].open = true;
    };
    $scope.pics = [
//        'http://demo.estrasol.com.mx/glimglam/img/productos/producto02.png',
//        'http://demo.estrasol.com.mx/glimglam/img/productos/producto02.png',        
//        "http://demo.estrasol.com.mx/glimglam/img/productos/producto02a.png",
//        "http://demo.estrasol.com.mx/glimglam/img/productos/producto02b.png"
    ];
    $scope.creando = false;
    

    $scope.$parent.subSeccion = "Nueva Subasta";
    $scope.titulo = "Nueva Subasta";
});

glimglam.controller('subastaCtrl', function ($scope, $routeParams, Auction, $http) {
    $scope.msj = "Main Controller";
    $scope.subSeccion = false;
    $scope.auction;
    $scope.photos = [];
    Auction.getById($routeParams.id).then(function(a){
        $scope.auction = a;
        var url = laroute.route(Auction.aliasUrl())+'/'+a.id+"/photos/";
        console.log(url);
//        return ;
        $http({
            'method' : 'GET',
//            'data' : data,
            'url' : url
        }).then(function(result) {
            $scope.photos = result.data; 
        },function(r){
           
        });
    });
});
glimglam.controller('subastasCtrl', function ($scope, $routeParams, Auction) {
    var status = $routeParams.status;
    console.log(status);
    var self = this;
    $scope['fn_en-proceso'] = function () {
        $scope.$parent.subSeccion = "Subastas en proceso";
        console.log("as");
    };
    $scope['fn_terminadas'] = function () {
        $scope.titulo = "Terminados";
        $scope.$parent.subSeccion = "Subastas terminadas";
        console.log("ok");
    };
    if($scope["fn_" + status]){
        $scope["fn_" + status]();
    }
    $scope.allAuctions = [];
    Auction.getAll().then(function(allAuctions){
        $scope.allAuctions = allAuctions;
    });
});
glimglam.controller('usuariosListaCtrl', function ($scope) {
    $scope.titulo = "Lista de Usuarios";
});
glimglam.factory('ModelBase', function (Paginacion, $q, $http, $timeout) {
    //<editor-fold defaultstate="collapsed" desc="constructor">
    var ModelBase = function (args) {
        this.setProperties(args);
        this.relations = {};
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="Metodos de Instancia (prototype)">
    ModelBase.prototype = {
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
            console.log("Flata implementar actualizacion");
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
    //Helper para setear fechas 
    ModelBase.setDate = function (value) {
        if(angular.isString(value)) {
            return new Date(value);
        }
        return value;
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
            var i=0;
            angular.forEach(data, function (d) {                
                obj = Model.findCache(d);                                
                if(obj) {
                    arrInst.push(obj);
                    i++;
                    console.log("ya en cache " +i);
                } else {
                    obj = Model.addCache(new Model(d));  
                    arrInst.push(obj);
                }
            });
//            console.log(arrInst);
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

glimglam.factory('Auction', function (ModelBase) {    
    var Auction = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Auction , {        
        alias: 'auction',
//        cache : [],
        setters : {
            startDate : ModelBase.setDate,
            endDate : ModelBase.setDate
        },
        attributes: [
            'id',
            'title',
            'description',
            'maxBid',
            'minBid',
            'maxOffer',
            'userTop',
            'delay',
            'target',
            'startDate',
            'endDate',
            'published',
            'status'
        ],
        relations : []
    }, {});    
    //<editor-fold defaultstate="collapsed" desc="buscarFolio">
    return Auction;
});
/* global angular, glimglam */
glimglam.factory('Paginacion', function () {
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
//# sourceMappingURL=admin.js.map
