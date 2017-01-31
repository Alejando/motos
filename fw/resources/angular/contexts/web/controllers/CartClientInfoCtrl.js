/* global setpoint */

setpoint.controller('CartClientInfoCtrl', [
    '$scope', 'AuthService', '$q', 'Address', 'State', 'Country', 'BillingInformation', '$timeout', 'Cart',
    function($scope, AuthService, $q, Address, State, Country, BillingInformation, $timeout, Cart) {
        var user = AuthService.user();
        $scope.cart = Cart;
        if(user) {
            //<editor-fold defaultstate="collapsed" desc="Init">
            var loadAddress = user.addresses();
            var selectedAddress = Cart.getShippingAddress();
            $scope.defaultState = new State({
                id : null,
                name : "Estado/Provincia"
            });
            //<editor-fold defaultstate="collapsed" desc="var loadStates = ...">
            var loadStates = State.getAll().then(function(states){
                $scope.states = states;
                $scope.states.unshift($scope.defaultState);
            });
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="var loadBillingInformation = ...">
            var loadBillingInformation = user.billingInformation().then(function (billingInformation) {
                $scope.billingInformation = billingInformation;
            }, function (fail) {
                console.log(fail);
            });
            //</editor-fold>      
            //<editor-fold defaultstate="collapsed" desc="$scope.chooseBillInfoCountry = function(){...">
            $scope.chooseBillInfoCountry = function(){
                if($scope.billInfo){
                    $scope.billInfo.relate('country', $scope.selectedBillCoutry)
                }
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="var loadCountry =  ...">
            var loadCountry = Country.getAll().then(function(countries){
                $scope.countries = countries,
                $scope.selectedCoutry = countries[0];
                $scope.selectedBillCoutry = countries[0];
                $scope.chooseBillInfoCountry();
            });
            //</editor-fold>
            $scope.chooseCountry = function() {
                $scope.address.relate('country', $scope.selectedCoutry);
            };
            $q.all([loadAddress, loadBillingInformation, loadCountry, loadStates]).then(function (addresses) {
                $('.infoShipping').show("slow");
                if(Cart.getBillingInformation()){
                    Cart.loadBillingInformation().then(function(billingInfo){
                        $scope.requestBill = true;
                        $("#factura").click();
                        $scope.billInfo = billingInfo;
                    });
                }
                $scope.addresses = addresses[0];
                $scope.addressesBill =  $scope.addresses.slice();
                $scope.objCopyAddres = $scope.defaultBillAddress = new Address({
                    'id' : null,
                    'label' : "(Ninguna)"
                });
                $scope.addressesBill.unshift($scope.defaultBillAddress);
                if($scope.addresses.length) {
                    if (selectedAddress) {
                        var selectAddressId = null;
                        angular.forEach($scope.addresses, function(address) {
                           if(address.id === selectedAddress) {
                                $scope.address = address;
                                $scope.selectAddress();
                                selectAddressId = address.id;
                           }
                        });
                        Cart.setShippingAddress(selectAddressId);                        
                   } 
                   if(!$scope.address){
                        $scope.address = $scope.addresses[0];
                        console.log($scope.addresses[0]);
                        $scope.selectAddress();
                    }
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
            $scope.tempNewAddress = null;
            $scope.objCopyAddres = "";
            //<editor-fold defaultstate="collapsed" desc="var addressFields = [...">
            var addressFields = [
                'first_name',
                'last_name',
                'street',
                'street_number',
                'neighborhood',  
                'state',
                'city',
                'pc',
                'tel'
            ];
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="var billFields = [...">
            var billFields = [
                'rfc',
                'business_name',
                'street',
                'street_number',
                'neighborhood',  
                'state',
                'postal_code'
            ];
            //</editor-fold>
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.selectAddress = function () {...">
            $scope.selectAddress = function () {
                $scope.address.state().then(function (state) {
                    $scope.selectedShippingState = state;
                }, function() {
                    console.log("Fail");
                });
                $scope.address.country();
            };
            //</editor-fold>            
            //<editor-fold defaultstate="collapsed" desc="$scope.saveNewAddress = function () {...">
            $scope.saveNewAddress = function () {
                if($scope.validAddress(true)) {
                    $scope.tempNewAddress.save().then(function() {
                        $scope.address = $scope.tempNewAddress ;
                        $scope.tempNewAddress = null;
                    });
                }
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.selectState = function () {...">
            $scope.selectState = function () {
                $scope.address.relate('state', $scope.selectedState);
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.chooseBillingState = function () {...">
            $scope.chooseBillingState = function () {
                $scope.billInfo.relate(
                    'state',
                    $scope.selectedBillingState
                );  
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.cancelNewAddress = function () {...">
            $scope.cancelNewAddress = function () {
                $scope.unTouchAddressFields();
                var index = $scope.addresses.indexOf($scope.tempNewAddress);
                $scope.addresses.splice(index,1);            
                $scope.address = $scope.addresses[$scope.addresses.length-1];                
                var index = $scope.addressesBill.indexOf($scope.tempNewAddress);
                $scope.addressesBill.splice(index, 1);
                $scope.tempNewAddress = null;
                $scope.selectAddress();
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.newAddress = function() {...">
            $scope.newAddress = function() {
                $scope.unTouchAddressFields();
                if($scope.tempNewAddress) { 
                    $scope.address = $scope.tempNewAddress;
                } else {
                    $scope.tempNewAddress =
                    $scope.address = new Address({
                        label : ""
                    });
                    $scope.chooseCountry();
                    $scope.selectedShippingState = $scope.defaultState;
                    $scope.addresses.push($scope.address);  
                    $scope.objCopyAddres = $scope.defaultBillAddress;
                }
                $scope.addressesBill.push($scope.address);
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.newBillInfo = function() {...">
            $scope.newBillInfo = function() {
                $scope.unTouchBillingInfo();
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
                    $scope.objCopyAddres = $scope.defaultBillAddress;
                }
                setTimeout(function(){
                    $('#rfc').focus();
                },10);
            };
            //</editor-fold>            
            //<editor-fold defaultstate="collapsed" desc="$scope.cancelNewBillInfo = function ($event) {...">
            $scope.cancelNewBillInfo = function ($event) {
                $event.preventDefault();
                var index = $scope.billingInformation.indexOf($scope.tempNewBillInfo);
                $scope.billingInformation.splice(index,1);            
                $scope.billInfo = $scope.billingInformation[$scope.billingInformation.length-1];            
                $scope.tempNewBillInfo = null;
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.saveNewBillInfo = function () {...">
            $scope.saveNewBillInfo = function () {
                if(!$scope.validBillInfo(true)){
                    return false;
                }
                $scope.tempNewBillInfo.save().then(function(){
                    $scope.tempNewBillInfo = null;
                });
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.selectShippingState = function () {...">
            $scope.selectShippingState = function () {
                var state = $scope.selectedShippingState;
                if($scope.address){
                    $scope.address.relate('state', state);
                }
            };
            //</editor-fold>            
            //<editor-fold defaultstate="collapsed" desc="$scope.copyAddress = function () { ...">
            $scope.copyAddress = function () {
                var address = $scope.objCopyAddres;
                if(address != $scope.defaultBillAddress) {
                    var loadCountry = address.country();
                    var loadState = address.state();
                    $q.all([loadCountry, loadState]).then(function() {
                        $scope.billInfo.street = address.street ? address.street : '';
                        $scope.billInfo.street_number = address.street_number ? address.street_number : '';
                        $scope.billInfo.suite_number = address.suite_number ? address.suite_number : '';
                        $scope.billInfo.neighborhood = address.neighborhood ? address.neighborhood : '';
                        $scope.billInfo.postal_code = address.postal_code ? address.postal_code : '';
                        $scope.billInfo.city = address.city ? address.city : '';
                        $scope.billInfo.relate('country', address.relations.country);
                        $scope.billInfo.relate('state', address.relations.state);                
                        $scope.selectedBillingState = $scope.billInfo.relations.state;
                        
                    }, function(fail){
                        console.log("fail", fail);
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
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.selectBillInfo = function() { ...">
            $scope.selectBillInfo = function() {
                $scope.billInfo.state().then(function(state){
                    $scope.selectedBillingState = state;
                });
                $scope.billInfo.country().then(function(country){
                    $scope.selectedBillCoutry = country;
                });
            };
            //</editor-fold>            
            //<editor-fold defaultstate="collapsed" desc="$scope.unTouchAddressFields = function() { ...">
            $scope.unTouchAddressFields = function () {
                var fields = addressFields.splice();
                fields.push('label');
                angular.forEach(fields, function(field) {
                    $scope.shippingForm[field].$touched = false;
                });
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.unTouchBillingInfo = function() { ...">
            $scope.unTouchBillingInfo = function () {
                angular.forEach(billFields, function(field) {
                    $scope.billInfoForm[field].$touched = false;
                });
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.validAddress = function() { ...">
            $scope.validAddress = function (touchFields) {
                var valid = true;
                angular.forEach(addressFields, function(field) {
                    if(touchFields) {
                        $scope.shippingForm[field].$touched = true;
                    }
                    if(!$scope.shippingForm[field].$valid) {
                        valid = false;
                    }
                });
                if(!$scope.address || !$scope.address.id) {
                    if(touchFields) {
                        $scope.shippingForm.label.$touched = true;
                    }
                    if(!$scope.shippingForm.label.$valid) {
                        valid = false;
                    }
                } 
                if(!$scope.selectedShippingState || $scope.selectedShippingState.id == null) {
                    valid = shippingForm.state.$touched =
                    shippingForm.state.$invalid = false;
                }
                return valid;
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.validBillInfo = function() { ...">
            $scope.validBillInfo = function (touchFields) {
                var valid = true;
                angular.forEach(billFields, function(field) {
                    if(touchFields) {
                        $scope.billInfoForm[field].$touched = true;
                    }
                    if(!$scope.billInfoForm[field].$valid) {
                        valid = false;
                    }
                });
                return valid;
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.valid = function() { ...">
            $scope.valid = function (touchFields) {
                var okAddress = $scope.validAddress(touchFields);
                if($scope.requestBill) {
                    var okBillInfo = $scope.validBillInfo(touchFields);
                    return okBillInfo && okAddress
                }
                return okAddress;
            };
            //</editor-fold>
            //<editor-fold defaultstate="collapsed" desc="$scope.nextStep = function() { ...">
            $scope.nextStep = function ($event) {
                $event.preventDefault();
                if(!$scope.valid(true)) {
                    return;
                }
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
                
                $q.all([saveBillInfo, saveAddress]).then(function(a) {
                    Cart.setShippingAddress($scope.address);
                    Cart.setBillingInformation(null);
                    
                    if(requestBill) {
                        Cart.setBillingInformation($scope.billInfo);
                    } else {
                        Cart.removeBillingInformation($scope.billInfo);
                    }  
                    Cart.persitInfo();   
                    window.open(laroute.route('cart.confirmCheckout'),'_self');
                        
                });
            };
            //</editor-fold>            
        } else {
            $('.infoShipping').slideDown("slow");
        }
    }
]);
