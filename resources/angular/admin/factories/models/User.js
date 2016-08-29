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