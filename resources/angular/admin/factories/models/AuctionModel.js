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
            'min_bids'
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