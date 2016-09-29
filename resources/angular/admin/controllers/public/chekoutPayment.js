glimglam.controller('public.checkoutPayCtrl', function ($scope, Auction, $http) {
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
    $('.btn-subasta-boton-pago').click(function(e){
        e.preventDefault();
        var self = this;
        var code = self.dataset.code;
        if($(".facturar").is(':checked')) {            
            $scope.valido = true;
            $scope.$apply(function(){
                $scope.errors={};
                $scope.errors.rfc = false;
                if(!/^([A-Z,Ñ,&]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z|\d]{3})$/.test($scope.billInfo.rfc)){
                    $scope.errors.rfc = "* El RFC ingresado no cumple con el formato requerido";
                    $scope.valido = false; 
                    return;
                } 
                var fnbreak=angular.forEach($scope.billInfo, function(e, i)  {
                        if(!e && i != 'user_id') {
                                $scope.errors[i] = "* Campo obligatorio.";
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
                        var href = laroute.route('auction.pay',{
                            'code' : code,
                            'bill' : true
                        });
                        $scope.send(href);
                    });
                });
            }
        } else {
            console.log('se hara laroute con auction.pay');
            $scope.$apply(function(){
                console.log(laroute.route('auction.pay',{
                    'code' : code,
                    'bill' : false
                }));
                var href = laroute.route('auction.pay',{
                    'code' : code,
                    'bill' : false
                });
                console.log(href);
                $scope.send(href);
            });
        }
    });
    $scope.send = function (href) {
        console.log(href);
        window.open(href, '_self');
    };
    //Requiere factura o no
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