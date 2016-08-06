glimglam.factory('Auction', function (ModelBase,$q,$http) {    
    var Auction = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Auction , {   
        FINISHED : 2,
        STARTED : 1,
        STAND_BY : 0,
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
            'status',
            'totalEnrollments',
            'inflows',
            'soldFor',
            'winner'
        ],
        relations : [],
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
        }
    }, {
        getStartDate : function () {
            return "Fecha de inicio";
        },
        getEndDate : function () {
            return "Fecha de Termino";
        },
        getStatusStr : function () {
           switch(this.status){
               case Auction.STARTED: return "Iniciada";
               case Auction.FINISHED: return "Terminada";
               case Auction.STAND_BY: return "En espera";
           }
        }
    });    
    //<editor-fold defaultstate="collapsed" desc="buscarFolio">
    return Auction;
});