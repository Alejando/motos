glimglam.controller('public.checkoutEnrollCtrl', function ($scope, Auction, $http) {
//    $scope.pay = function () {
//        alert("CheckOut");
//    };
   $scope.billInfo = {
        rfc: '1',
        business_name: '2',
        address: '3',
        neighborhood: '4',
        postal_code: '5',
        city: '6',
        state: '7',
        user_id: '1'
    };
    $(".form-factura").hide();
    var $subTotal = $('#enroll-sub-total');
    var $iva = $('#enroll-iva');
    var $total = $('#enroll-total');    
    
    $('.subasta-boton-pago').click(function(e){
        e.preventDefault();
        var href = this.href;
        if($(".facturar").is(':checked')) {
            var url = laroute.route('user.bills-info');            
            $scope.$apply(function(){
                $http({
                    'url' : url,
                    'data' : $scope.billInfo
                }).then(function(){
                    $scope.send(href);
                });
            });
        } else {
            $scope.$apply(function(){
                $scope.send(href);
            });
        }
    });
    $scope.send = function (href) {
        window.open(href, '_self');
    };
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