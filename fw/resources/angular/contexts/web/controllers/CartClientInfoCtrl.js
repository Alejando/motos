/* global setpoint */

setpoint.controller('CartClientInfoCtrl', [
    '$scope', 'AuthSevice', '$q', 'Address', 'State', 'Country', 'BillingInformation', '$timeout', 'Cart',
    function($scope, AuthSevice, $q, Address, State, Country, BillingInformation, $timeout, Cart) {
        var user = AuthSevice.user();
        var loadAddress = user.addresses();
        var loadStates = State.getAll().then(function(states){
            $scope.states = states;
        });        
        var loadBillingInformation = user.billingInformation().then(function (billingInformation) {
            $scope.billingInformation = billingInformation;
        }, function (fail) {
            console.log(fail);
        });        
        var loadCountry = Country.getAll().then(function(countries){
            $scope.countries = countries,
            $scope.selectedCoutry = countries[0];
        });        
        $scope.chooseCountry = function() {
            $scope.address.relations.country = $scope.selectedCoutry;
        };
        $q.all([loadAddress, loadBillingInformation, loadCountry, loadStates]).then(function (addresses) {
            $('.infoShipping').show("slow");
            $scope.addresses = addresses[0];
            if($scope.addresses.length) {
                $scope.address = $scope.addresses[0];
                $scope.selectAddress();
            } else {
                $scope.newAddress();
            }
            
            if($scope.billingInformation.length) {
                $scope.billInfo = $scope.billingInformation[0];   
                $scope.selectBillInfo();
            } else {
                $scope.newBillInfo();
            }
        });        
        $scope.selectAddress = function () {
            $scope.address.state();
            $scope.address.country();
        };        
        $scope.tempNewAddress = null;
        $scope.saveNewAddress = function () {
            $scope.tempNewAddress.save().then(function(){
                $scope.tempNewAddress = null;
            });
        };        
        $scope.cancelNewAddress = function () {
            var index = $scope.addresses.indexOf($scope.tempNewAddress);
            $scope.addresses.splice(index,1);            
            $scope.address = $scope.addresses[$scope.addresses.length-1];            
             $scope.tempNewAddress = null;
        };        
        $scope.newAddress = function() {
            if($scope.tempNewAddress) {
                $scope.address = $scope.tempNewAddress;
            } else {
                $scope.tempNewAddress =
                $scope.address = new Address({
                    label : ""
                });
                $scope.chooseCountry();
                $scope.addresses.push($scope.address);                
            }
        };
        $scope.copyAddres = ""; 
        $scope.newBillInfo = function() {
            if($scope.tempNewBillInfo) {
                $scope.billInfo = $scope.tempNewBillInfo;
                $scope.chooseBillInfoCountry();
            } else {
                $scope.tempNewBillInfo = 
                $scope.billInfo = new BillingInformation({
                    rfc : ''
                });
                $scope.chooseBillInfoCountry(); 
                $scope.billingInformation.push($scope.tempNewBillInfo);
                
            }
            setTimeout(function(){
                $('#rfc').focus();
            },10);
        };
        $scope.cancelNewBillInfo = function () {
            var index = $scope.billingInformation.indexOf($scope.tempNewBillInfo);
            $scope.billingInformation.splice(index,1);            
            $scope.billInfo = $scope.billingInformation[$scope.billingInformation.length-1];            
            $scope.tempNewBillInfo = null;
        };
        $scope.saveNewBillInfo = function () {
            console.log($scope.tempNewBillInfo);
            $scope.tempNewBillInfo.save().then(function(){
                $scope.tempNewBillInfo = null;
            });
        };
        
        $scope.copyAddress = function () {
            var address = $scope.ojbCopyAddres;
            if(address !== null) {
                var loadCountry = address.country();
                var loadState = address.state();
                $q.all([loadCountry, loadState]).then(function(){
                    $scope.billInfo.street = address.street ? address.street : '';
                    $scope.billInfo.street_number = address.street_number ? address.street_number : '';
                    $scope.billInfo.suite_number = address.suite_number ? address.suite_number : '';
                    $scope.billInfo.neighborhood = address.neighborhood ? address.neighborhood : '';
                    $scope.billInfo.postal_code = address.postal_code ? address.postal_code : '';
                    $scope.billInfo.city = address.city ? address.city : '';
                    $scope.billInfo.relations.country = address.relations.country ? address.relations.country : '';
                    $scope.billInfo.relations.state = address.relations.state ? address.relations.state : '';                
                });
            } else {
                $scope.billInfo.street = 
                $scope.billInfo.street_number = 
                $scope.billInfo.suite_number = 
                $scope.billInfo.neighborhood = 
                $scope.billInfo.postal_code = 
                $scope.billInfo.city = "";
                $scope.billInfo.relations.country = "";
                $scope.billInfo.relations.state = "";
            }
        };
        $scope.selectBillInfo = function() {
            $scope.billInfo.state();
            $scope.billInfo.country();
        };
        $scope.nextStep = function ($event) {
            $event.preventDefault();
            var saveAddress = $scope.address.save();
            var saveBillInfo;
            var requestBill = $scope.requestBill;
            if(requestBill) {
                saveBillInfo = $scope.billInfo.save();
            } else {
                var def = $q.defer();
                saveBillInfo = def.promise;
                $timeout(function() {
                   def.resolve(); 
                }, 10);
            }
            $q.all([saveBillInfo, saveAddress]).then(function(){
                Cart.setShippingAddress($scope.address);
                
                    Cart.setBillingInformation(null);
                if(requestBill){
                    Cart.setBillingInformation($scope.billInfo);
                }
                Cart.persitInfo();
                window.open(laroute.route('cart.checkout'),'_self');
            });
        };
    }
]);