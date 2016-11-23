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
        relations : [],
        login : function (email, password) {            
            var def = $q.defer();
            var url = laroute.url('',[])+"login";
            var data = {
                'email' : email,
                'password' : password
            } 
            $http.post(url,data).then(function(r){
                if(!r.data.error){
                    def.resolve(r.data);
                }else{
                    def.reject(r.data);
                }
            }, function(e){
                def.reject(e);
            });
            return def.promise;
        }
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