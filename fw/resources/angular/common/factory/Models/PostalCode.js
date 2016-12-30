setpoint.factory('PostalCode', function (ModelBase,$q,$http, Slug) {    
    var PostalCode = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(PostalCode, {   
        alias: 'postalCode',
        setters : {
        },
        attributes: [
            'id',
            'code'
        ],
        relations : [],
        urlGetAllByGroup : function (id) {
            return laroute.route('postalCode.by-group', {
                'id' : id
            });
        },
        saveGroup : function (cps, group) {
            var def = $q.defer();
            var url = laroute.route('postalCode.saveGroup');
            $http.post(url, {
                'cps' : cps,
                'group': group
            }).then(function(){ 
                def.resolve();
            });
            return def.promise;
        }
    }, {
    });
    return PostalCode;
});