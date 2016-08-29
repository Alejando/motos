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
        dictDefaultMessage:'Click o arrastra una imagen aquí'
        
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
    $scope.pics = [];
    $scope.creando = false;
    

    $scope.$parent.subSeccion = "Nueva Subasta";
    $scope.titulo = "Nueva Subasta";
});
