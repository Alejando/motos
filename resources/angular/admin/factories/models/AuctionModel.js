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