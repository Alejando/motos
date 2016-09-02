!function () {
    var g = window.jsGlimglam = {};
    jsGlimglam.fn = {};
}();
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
!function () {
    window.jsGlimglam.fn.auctions = {
        addFav : function (code) {
            var url = laroute.route('user.add-fav',{
                'code' : code
            });
            return $.get(url,{},$.noop,'json');
        },
        removeFav : function (code) {
            var url = laroute.route('user.remove-fav',{
                 'code' : code
             });
             return $.get(url,{},$.noop,'json');
         }
    };
}();

var glimglam = angular.module("glimglam", ['ui-rangeSlider','timer', 'slugifier']);  
glimglam.factory('ModelBase', function (Paginacion, $q, $http, $timeout, $interval, $filter) {
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

glimglam.factory('Auction', function (ModelBase,$q,$http) {    
    var Auction = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Auction , {   
        FINISHED : 2,
        STARTED : 1,
        STAND_BY : 0,
        //Tipos de portadas
        COVER_HORIZOTAL : 'horizontal',
        COVER_VERTICAL : 'vertical',
        COVER_SLIDER_UPCOMING :'slider-upcoming',
        alias: 'auction',
        setters : {
           start_date : ModelBase.setDate,
            end_date : ModelBase.setDate,
            max_offer : ModelBase.setFloat,
            min_offer : ModelBase.setFloat
        },
        attributes: [
            'id',
            'category',
            'sub_category',
            'target',
            'code',
            'barcode',
            'title',
            'real_price',
            'cover',
            'min_offer',
            'max_offer',
            'bids',
            'max_price',
            'user_quota',
            'users_limit',
            'delay',
            'max_user_quiet',
            'death_time',
            'description',
            'start_date',
            'end_date',
            'ready',
            'status',
            'winner',
            'total_enrollments',
            'inflows',
            'sold_for',
            'last_offer',
            'create_at',
            'update_at',
            'winnername',
            'num_bids',
            'mid_bids'
        ],
        relations : [],
        getFavByUser : function (user) {
            var $defer = $q.defer();
            var self = this;
            var url = laroute.route('user.get-fav',{
                'userId' : user.id
            });
            $http({
                'method' : 'GET',
                'url' : url
            }).then(function(result){
                var objs = self.build(result.data);
                $defer.resolve(objs);
            });
            return $defer.promise;
        },
        getByCode : function (code){
            var $defer = $q.defer();
            var url = laroute.route('auction.getByCode', {
                'code' : code
            });
            var self = this;
            $http({
                'method' : 'GET',
                'url' :  url
            }).then(function(result){
                $defer.resolve(self.build(result.data));
            });
            return $defer.promise;
        },
        getUpcoming : function (n, page) {
            var _page = page?page:1;
            var url = laroute.route('auction.upcoming', {
                n:n,
                page : _page
            });
            var $defer = $q.defer();
            var self = this;
            $http({
                'method' : 'GET',
                'url' :  url
            }).then(function(result){
                $defer.resolve(self.build(result.data.data));
            });
            return $defer.promise;
        },
        getFinished : function (n, page) {
            var _page = page ? page : 1;
            var url = laroute.route('auction.finished', {
                n:n,
                page : _page
            });
            var $defer = $q.defer();
            var self = this;
            $http({
                'method': 'GET',
                'url': url
            }).then(function(result) {
                $defer.resolve(self.build(result.data.data));
            });
            return $defer.promise;
        },
        getStarted : function (n, page){
            var _page = page ? page:1;
            var url = laroute.route('auction.started', {
                n : n,
                page : _page
            });
            var $defer = $q.defer();
            var self = this;
            $http({
                'method' : 'GET',
                'url' : url
            }).then(function(result) {
                $defer.resolve(self.build(result.data.data));
            });
            return $defer.promise;
        }
    }, {
        placeBid : function (bid) {
            var $defer = $q.defer();
            var url = laroute.route('auction.place-bid');
            //console.log(url);
            var data = {
                code : this.code,
                bid : bid
            };
            $http({
                'method' : 'POST',
                'url': url,
                'data' : data
            }).then(function(result) {
                //console.log(result);
                $defer.resolve(result.data);
            }, function(r) {
                $defer.reject(r);
            });
            return $defer.promise;
        },
        getUrlCover : function (version) {
            var url = laroute.route('auction.getCover',{
                version:version,
                code: this.code
            });
            return url;
        },
        getStartDate : function () {
            return new Date(this.start_date);
        },
        getEndDate : function () {
            return "Fecha de Termino";
        },
        getStatusStr : function () {
           switch(this.status) {
               case Auction.STARTED: return "Iniciada";
               case Auction.FINISHED: return "Terminada";
               case Auction.STAND_BY: return "En espera";
           }
        },
        isStarted : function(){
            return  this.status == Auction.STARTED;
        },
        isFinished : function () {
            return this.status == Auction.FINISHED;
        },
        isStandBy : function () {
            return this.status == Auction.STAND_BY;
        },
        getInfoBid : function(){
            var $defer = $q.defer();
            var url = laroute.route('auction.get-info-bid', {
                'code':this.code
            });
            //console.log(url);
            $http({
                'method' : 'GET',
                'url': url
            }).then(function(result) {
                $defer.resolve(result.data);
            }, function(r) {
                $defer.reject(r);
            });
            return $defer.promise;
        }
    });    
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
glimglam.factory('User', function (ModelBase, Auction, $q, $http) {
    var User = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(User , {
        FINISHED : 2,
        STARTED : 1,
        STAND_BY : 0,
        alias: 'user',
//        cache : [],
        setters : {
            startDate : ModelBase.setDate,
            endDate : ModelBase.setDate,
            birthday : ModelBase.setDate
        },
        preparers:{
            birthday : ModelBase.prepareDate
        },
        attributes: [
            'id',
            'name',
            'email',
            'profile',
            'birthday',
            'gender',
            'password',
            'newPassword'
        ],
        relations : [],
        getAuthUser : function () {
            var $def = $q.defer();
            var url = laroute.route('user.get-auth-user');
            var self = this;
            $http.get(url,{}).then(function(result){
                var user = self.build(result.data);
                $def.resolve(user);
            });
            return $def.promise;
        }
    }, {
        getFavs : function ( ){
            return Auction.getFavByUser(this);
        },
        getWins : function () {
            var $def = $q.defer();
            var url = laroute.route('user.get-my-wins',{
                'userId' : this.id
            });
            $http({
                'url':url,
                'method' : 'GET'
            }).then(function(r) {
                var wins = Auction.build(r.data);
                $def.resolve(wins);
            });
            return $def.promise;
        },
        getCurrentAuctions : function () {
            var $def = $q.defer();
            var url = laroute.route('user.get-current-auction',{
                'userId' : this.id
            });
            $http({
                url : url,
                method : 'GET'
            }).then(function(res) {
                var auction = Auction.build(res.data);
                $def.resolve(auction);
            });
            return $def.promise;
        },
        getAuctionsInfo : function (){
            var $def = $q.defer();
            var url = laroute.route('user.get-auctions-info',{
                'userId' : this.id
            });
            $http({
                'url':url,
                'method' : 'GET'
            }).then(function(res){
                $def.resolve(res.data);
            });
            return $def.promise;
        },
        getEnrolled : function() {
            var $def = $q.defer();
            var url = laroute.route('user.get-my-enrollments',{
                'userId' : this.id
            });
            $http({
                'url':url,
                'method':'GET'
            }).then(function(res){
                var enrolleds = Auction.build(res.data);
                $def.resolve(enrolleds);
            });
            return $def.promise; 
        },
        fnGender : function(gender){            
            if(gender === undefined){
                return this.gender.toString();
            }
            this.gender = parseInt(gender, 10);
        }
    });
    
    //<editor-fold defaultstate="collapsed" desc="buscarFolio">
    return User;
});
glimglam.filter('numberFixedLen', function () {
    return function (n, len) {
        var num = parseInt(n, 10);
        len = parseInt(len, 10);
        if (isNaN(num) || isNaN(len)) {
            return n;
        }
        num = '' + num; 
        while (num.length < len) { 
            num = '0' + num;
        }
        return num;
    };
});
glimglam.controller('public.checkOutCtrl', function ($scope, Auction) {
    $scope.pay = function () {
        alert("PayPal");
        console.log("a pay pal");
    };
});
glimglam.controller('public.checkoutEnrollCtrl', function ($scope, Auction, $http) {
    var url = laroute.route('user.bills-info');
    $scope.billInfo = {
        rfc: '',
        business_name: '',
        address: '',
        neighborhood: '',
        postal_code: '',
        city: '',
        state: '',
        user_id: ''
    };
    $http({
        'url' : url,
        'meethod' : 'GET'
    }).then(function(r){
        if(!r.data.error) {
            $scope.billInfo.rfc = r.data.rfc;
            $scope.billInfo.business_name = r.data.business_name;
            $scope.billInfo.address = r.data.address;
            $scope.billInfo.neighborhood = r.data.neighborhood;
            $scope.billInfo.postal_code = r.data.postal_code;
            $scope.billInfo.city = r.data.city;
            $scope.billInfo.state = r.data.state;
            $scope.billInfo.user_id = r.data.user_id;
        }
    });
    
    $(".form-factura").hide();
    
    
    var $subTotal = $('#enroll-sub-total');
    var $iva = $('#enroll-iva');
    var $total = $('#enroll-total');    
    $scope.errors = {};
    $('.subasta-boton-pago').click(function(e){
        e.preventDefault();
        var self = this;
        var code = self.dataset.code;
        if($(".facturar").is(':checked')) {            
            $scope.valido = true;
            $scope.$apply(function(){
                $scope.errors.rfc = false;
                if(!/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/.test($scope.billInfo.rfc)){
                    $scope.errors.rfc = "* El RFC ingresado no cumple con el formato requerido";
                    $scope.valido = false;
                } 
                angular.forEach($scope.billInfo, function(e, i) {
                    if(!$scope.billInfo[e]){
                        $scope.errors[i]="* Campo obligatorio.";
                        $scope.valido = false;
                    }
                });
            });
            if($scope.valido){
                $scope.$apply(function(){
                    $http({
                        'method' : 'POST',
                        'url' : url,
                        'data' : $scope.billInfo
                    }).then(function(){
                        var href = laroute.route('auction.checkout',{
                            'code' : code,
                            'bill' : true
                        });
                        $scope.send(href);
                    });
                });
            }
        } else {
            $scope.$apply(function(){
                var href = laroute.route('auction.checkout',{
                    'code' : code,
                    'bill' : false
                });
                $scope.send(href);
            });
        }
    });
    $scope.send = function (href) {
        window.open(href, '_self');
    };
    $(".facturar").click(function () {
        if ($(this).is(":checked")) {
            var total = parseFloat($total.attr('cant'));
            var subTotal = (total / (window.ivaCant + 1));
            var iva = parseFloat(total - subTotal);
            $iva.attr('cant', iva).html('$' + iva.toFixed(2));
            $subTotal.attr('cant', subTotal).html('$' + subTotal.toFixed(2));
            $(".form-factura").show(600);
        } else {
            var subTotal = parseFloat($total.attr('cant'));
            $iva.attr('cant', '0.00').html('$0.00');
            $subTotal.attr('cant', subTotal.toFixed(2)).html('$' + subTotal.toFixed(2));
            $(".form-factura").hide(200);
        }
    });
});
glimglam.controller('public.IndexCtrl', function ($scope, Auction) {
//    $scope.titulo = "Hello";
//    window.Auction = Auction;
////    Auction.getAll().then(function(all) {
//        console.log(all);
//    });
//    Auction.getByCode("SUB001").then(function(byCode) {
//        console.log("Auction byCode=> %o", byCode);
//        console.log("cover horizontal => %o", byCode.getUrlCover(Auction.COVER_HORIZOTAL));
//        console.log("cover vertical => %o", byCode.getUrlCover(Auction.COVER_VERTICAL));
//        console.log('cover slider => %o',  byCode.getUrlCover(Auction.COVER_SLIDER_UPCOMING));
//    });
//    Auction.getUpcoming(10).then(function(auctions) {
//        console.log('diez proximas => %o', auctions);
//    });
//    Auction.getFinished(10).then(function(auctions) {
//        console.log('las ultimas 10 terminadas => %o', auctions);
//    });
//    Auction.getStarted(10).then(function(auctions){
//        console.log('las ultimas iniciadas => %o', auctions);
//    });
    
    $scope.lastStarted = null;
    
    
    //Fancybox producto
     
    
    Auction.getStarted(1).then(function(auction) {
        if(auction.length) {
            $scope.lastStarted = auction[0];
            $scope.lastStarted.selfUpdate(1500000, $scope);
        } else {
            Auction.getUpcoming(1).then(function(auction){
                $scope.lastStarted = auction[0];
                $scope.lastStarted.selfUpdate(1500000, $scope); 
            });
        }
    });
});
glimglam.controller('public.profileCtrl', function ($scope, User) {
    var setBrithday = function () {
        var birth = $scope.user.birthday;
        if(birth){
            $scope.brithday.day = birth.getDate().toString();
            $scope.brithday.month = (birth.getMonth() + 1).toString();
            $scope.brithday.year = birth.getFullYear().toString();
        }        
    };
    //<editor-fold defaultstate="collapsed" desc="getAuthUser">
    User.getAuthUser().then(function (user) {
        $('.div-profile').slideDown('slow');
        $scope.user = user;
        $scope.user.backup();
        setBrithday();
        $scope.getWins();
        $scope.getEnrolled();
        $scope.user.getCurrentAuctions().then(function(actual){
            console.log(actual);
            $scope.actual = actual;
        });
        $scope.user.getAuctionsInfo().then(function(info){
        $scope.myTotalEnrollments = info.totalEnrollments;
        $scope.myTotalWins = info.totalWins;
            console.log(info);
        });
    });
    //</editor-fold>
    $scope.section = 'profile';
    //<editor-fold defaultstate="collapsed" desc="setSection">
    $scope.setSection = function (section) {
        
        $scope.section = section;
        if(section === 'favs') {
            $scope.getFavs();
        }
        $scope.user.rollback();
        $scope.newPassword = "";
        $scope.confirmPassword = '';
        $scope.password = '';
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="Imagen de perfil">
    $('#img-profile').change(function () {
        var file = this.files[0];
        if (file) {
            console.log(file.type);
            if (file.type !== 'image/jpeg' && file.type !== 'image/jpg') {
                alert("Solo se admiten imagenes JPG");
                return;
            }

            var reader = new FileReader();
            reader.onloadend = function () {
                var data = new FormData();
                data.append('img', file);
                var url = laroute.route('user.save-img-profile');
                $.ajax({
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: 'POST',
                    success: function (data) {
                        var urlImg = laroute.route('user.img-avatar', {
                            'userId': $scope.user.id
                        }) + '?' + (new Date).getTime();
                        console.log(urlImg);
                        $('#foto-perfil').attr('src', urlImg);
                    }
                });
            };
            reader.readAsDataURL(file);
        }
    });
    $scope.changeImg = function () {
        $('#img-profile').click();
    };

    //</editor-fold>
    $scope.brithday = {
        'day': "0",
        'month': "0",
        'year': "0"
    };
    $scope.errors = {};
    $scope.getFavs = function () {
        $scope.user.getFavs().then(function(favs) {
            $scope.favs = favs;
        });
    };
    $scope.getWins = function () {
        $scope.user.getWins().then(function(wins) { 
            $scope.wins = wins;
        });
    };
    $scope.getEnrolled = function() {
        $scope.user.getEnrolled().then(function(enrolleds) {
            $scope.enrolleds = enrolleds;
        });
    };
    $scope.removeFav = function(auction, $event){
        $event.preventDefault();
        jsGlimglam.fn.auctions.removeFav(auction.code).done(function () {
            $scope.$apply(function(){
                $scope.favs.splice($scope.favs.indexOf(auction), 1);
            });
        });
    };
    
    //<editor-fold defaultstate="collapsed" desc="updateProfile">
    $scope.updateProfile = function () {
        console.log($scope.brithday.day, $scope.brithday.month, $scope.brithday.year);
        if(
            $scope.brithday.day==0 ||
            $scope.brithday.month==0 ||
            $scope.brithday.year==0
                
        ) {
            bootbox.alert("Por favor ingresa tu fecha de nacimiento");
            return;
        }
        if(!$scope.user.password){
            bootbox.alert("Ingresa tu contraseña actual para autorizar los cambios");
            return ;
        }
        if ($scope.newPassword) {
            if ($scope.confirmPassword !== $scope.newPassword) {
                $scope.errors.confirmPassword = "Tu confirmación no coicide";
                return;
            } else {
                $scope.errors.confirmPassword = "";
            }
            $scope.user.newPassword = $scope.newPassword;
        }
        if($scope.user.birthday === null) {
            $scope.user.birthday = new Date();
        }
        var birthday = $scope.user.birthday;
        birthday.setDate($scope.brithday.day);
        birthday.setMonth($scope.brithday.month - 1);
        birthday.setYear($scope.brithday.year);
        $scope.user.save().then(function (res) {
            if (res.error) {
                $scope.errors.password = res.msj;
                if($scope.errors.password){
                    bootbox.alert(res.msj);
                    return;
                }
                $scope.errors.confirmPassword = "";
                return;
            }
            $scope.errors.password = false;
            $('#nombre-usr').html("@" + $scope.user.email.split('@')[0]);
            $('.pass').val("");
            var $box = bootbox.alert("Tus datos fueron actualizados correctamente");
            $box.css('zIndex', 2000);
        });
    };
    //</editor-fold>
    //<editor-fold defaultstate="collapsed" desc="rollback">
    $scope.rollback = function () {
        $scope.user.rollback();
        $('.pass').val("");
        if ($scope.user.birthday !== null) {
            setBrithday();
        } else {
            $scope.brithday.day = "0";
            $scope.brithday.month = "0";
            $scope.brithday.year = "0";
        }
    };
    //</editor-fold>

});
glimglam.controller('public.roomCtrl', function ($scope, Auction, $interval, $element,$compile) {
    $scope.id_user = window.id_user;
    $scope.objAuction = new Auction(auction);
    $scope.totalBids = 0;
    $scope.nextBid = new Date();
    $('.section-room').fadeIn('slow');      
    $interval(function() {
        $scope.now = new Date();
    }, 100);
    $interval(function() {
        $scope.getInfo();
    }, 10000);
    $scope.rangeOferta = {
         min: 0,
         max: $scope.objAuction.min_offer,
         limitMax: $scope.objAuction.max_offer,
         limitMin: $scope.objAuction.min_offer
    };
    $scope.help = {
        nextBid : new Date()
    };
    $scope.getInfo = function (){
        $scope.objAuction.getInfoBid().then(function(info){
                $scope.nextBid = new Date(info.nextbid);
                $scope.help.nextBid = $scope.nextBid.getTime();
                $scope.totalBids = info.totalbids;
                $scope.totalFaults = info.faults;
                $scope.unqualified = info.unqualified;
                $element.find('.delay-bid').empty().append('<timer interval="1000" language="es"  class="subasta-tiempo" '+
                                  '  end-time="nextBid">' +
                                      '  <small>Puedes ofertar en</small><br>{{minutes}} min, {{seconds}} seg '+
                                "</timer>");
                $compile($element.find('.delay-bid'))($scope);
            });
    };
    $scope.getInfo();
    $scope.placeBid = function(){
        $scope.objAuction.placeBid($scope.rangeOferta.max).then(function(data) {
            $scope.objAuction.refresh();
            $scope.getInfo();
        });
    };
    $scope.objAuction.selfUpdate(1000, $scope);
});
//# sourceMappingURL=public.js.map
