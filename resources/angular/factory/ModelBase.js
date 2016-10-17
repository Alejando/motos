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
            console.log(fn);
            if(fn === "hasMany"){
                if(this.relations[strRelation]==undefined) {
                    this.relations[strRelation] = [];
                    this[strRelation + "_ids"] = [];
                }
                this.relations[strRelation].push(entity);
                this[strRelation + "_ids"].push(entity.id);
            } if(fn === "belongsTo") {
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
