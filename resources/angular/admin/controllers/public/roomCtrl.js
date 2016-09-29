glimglam.controller('public.roomCtrl', function ($scope, Auction, $interval, $element,$compile, $q) {
    $scope.id_user = window.id_user;
    $scope.objAuction = new Auction(window.auction);
    $scope.totalBids = 0;
    $scope.nextBid = new Date();
    $('.section-room').fadeIn('slow');      
    var faults;
    var bind12 = false;
    var finishSound = false;
    var firstInfo = true;
    var firstTotalBids;
    var checkInfo = function (info){
        if(faults !== info.faults) {
            sounds.lostbyquiet.play();
            faults = info.faults;
            $scope.losingBidAnimate = true;
            setTimeout(function(){
                $scope.losingBidAnimate = false;
            }, 2000);
        }
        if(!bind12) {
            if(firstTotalBids < 12 && info.totalbids >= 12) {
                bind12 = true;
                console.log("mas doce");
                sounds.bid12.play();
                $scope.requiredBidAnimate = true;
            }
        }
   
        if(!finishSound) {
            if(info.totalbids !== firstTotalBids && parseInt(info.totalbids) + parseInt(info.faults) >= parseInt($scope.objAuction.bids)) {
                sounds.lastbid.play();
                finishSound = true;
            }
        }
    };
    $interval(function() {
        $scope.getInfo().then(checkInfo); 
    }, 1000);
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
        var $d = $q.defer();
        $scope.objAuction.getInfoBid().then(function(info){
                console.log(info.endAt.s);
                if(info.startAt){
                    $scope.startDays = info.startAt.d;
                    $scope.startHours = info.startAt.h;
                    $scope.startMinutes = info.startAt.i;
                    $scope.startSeconds = info.startAt.s;
                    $scope.startYears = info.startAt.y;
                    $scope.startMonths = info.startAt.m;
                }
                if(info.endAt){
                    $scope.endSeconds = info.endAt.s;
                    $scope.endDays = info.endAt.d;
                    $scope.endHours = info.endAt.h;
                    $scope.endMinutes = info.endAt.i;
                    $scope.endYears = info.endAt.y;
                    $scope.endMonths = info.endAt.m;
                }
                
                $scope.now = new Date(info.now);
                $scope.nextPenalty = new Date(info.nextPenalty);
                $scope.help.nextPenalty = $scope.nextPenalty.getTime();
                $scope.nextBid = new Date(info.nextbid);
                $scope.help.nextBid = $scope.nextBid.getTime();
                $scope.totalBids = info.totalbids;
                $scope.totalFaults = info.faults;
                $scope.min_bids = info.min_bids;
                $scope.unqualified = info.unqualified;
                $element.find('.penalty').empty().append('<timer interval="1000" language="es"  class="subasta-tiempo" '+
                                  '  end-time="nextPenalty">' +
                                      '{{minutes}}:{{seconds}}'+
                                "</timer>");
                $element.find('.delay-bid').empty().append('<timer interval="1000" language="es"  class="subasta-tiempo" '+
                                  '  end-time="nextBid">' +
                                      '  <small>Puedes ofertar en</small><br><span ng-show="minutes">{{minutes}} min, </span>{{seconds}} seg '+
                                "</timer>");
                $compile($element.find('.penalty'))($scope);
                $compile($element.find('.delay-bid'))($scope);
                $d.resolve(info);
            });
            return $d.promise;
    };    
    $scope.getInfo().then(function(info){
        faults = info.faults;
        firstTotalBids = info.totalbids;
    });
    $scope.placingBid = false;
    $scope.placingBidAnimate = false;
    $scope.losingBidAnimate = false;
    $scope.requiredBidAnimate = false;
    $scope.placeBid = function(){
        $scope.placingBid = true;
        $scope.objAuction.placeBid($scope.rangeOferta.max).then(function(data) {
            var ref = $scope.objAuction.refresh();
            var getInf = $scope.getInfo();
            getInf.then(checkInfo);
            $q.all([ref, getInf]).then(function() {
                $scope.placingBid = false;
                sounds.bid.play();
                $scope.placingBidAnimate = true;
                setTimeout(function(){
                    $scope.placingBidAnimate = false;
                }, 2000);
            });
        });
    };
    var auctionStatus = $scope.objAuction.status;
    var last_offer = parseFloat($scope.objAuction.last_offer,10);
    var nextOfferAlert = last_offer + 50;
    $scope.objAuction.selfUpdate(1000, $scope, function() {
        if(last_offer!==this.last_offer){
            last_offer = parseFloat(this.last_offer);
            if(nextOfferAlert<last_offer){
               nextOfferAlert=last_offer + 50;               
               sounds.othersBids.play();
            }
        }
        if(this.status !== auctionStatus){ //cambios de estatus            
            switch(auctionStatus) {
                case Auction.STAND_BY:
                    if(this.status === Auction.STARTED) {//La subasta inicia
                        sounds.start.play();
                    }
                    break;
                case Auction.STARTED://Si esta iniciada 
                    if(this.status === Auction.FINISHED) {//finaliza la subasta
                        if(this.winner === $scope.id_user) {
                            sounds.win.play();
                        } else {
                            sounds.lost.play();
                        }
                    }
                break;
            }
            auctionStatus = this.status;
        }
    });
    
    var sounds = {
        bid: new Audio(), //ok
        bid12: new Audio(),//ok
        lastbid: new Audio(),
        lost : new Audio(),//ok
        lostbyquiet: new Audio(),//ok
        othersBids : new Audio(),//ok
        start : new Audio(), //ok
        win :  new Audio()//ok
    };
    
    var soundBaseUrl = laroute.url('sounds',[]);;
    sounds.bid.src = soundBaseUrl + 'bid.wav'; 
    sounds.bid12.src = soundBaseUrl + 'bid12.wav';
    sounds.lastbid.src = soundBaseUrl + 'lastbid.mp3';
    sounds.lost.src = soundBaseUrl + 'lost.wav';
    sounds.lostbyquiet.src = soundBaseUrl + 'lostbyquiet.wav';
    sounds.othersBids.src = soundBaseUrl + 'others_bids.mp3';
    sounds.start.src = soundBaseUrl + 'start_auction.wav';
    sounds.win.src = soundBaseUrl + 'win.wav';
    
    window.sounds = sounds;
    
});