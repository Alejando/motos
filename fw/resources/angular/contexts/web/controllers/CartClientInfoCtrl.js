setpoint.controller('CartClientInfoCtrl', [
    '$scope', 'AuthSevice', '$q', 'Address', 'State', 'Country', 'BillingInformation',
    function($scope, AuthSevice, $q, Address, State, Country, BillingInformation) {
        console.log("BillingInformation=>", BillingInformation);
        
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
            $scope.addresses = addresses[0];
            if($scope.addresses.length) {
                $scope.address = $scope.addresses[0];
                $scope.selectAddress();
            } else {
                $scope.newAddress();
            }
            
            if($scope.billingInformation.length) {
                $scope.billInfo = $scope.billingInformation[0];                
            } else {
                $scope.newBillInfo();
            }
        });
        
        $scope.selectAddress = function () {
            $scope.address.state();
            $scope.address.country();
        }
        
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
        }
        $scope.copyAddres = ""; 
        $scope.newBillInfo = function() {
            if($scope.tempNewBillInfo) {
                $scope.billInfo = $sopce.tempNewBillInfo;
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
        $scope.chooseBillInfoCountry = function(){
            $scope.billInfo.relations.country = $scope.selectedBillCoutry;
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
        }
        
        $scope.copyAddress = function () {
            var address = $scope.ojbCopyAddres;
            console.log(address);
            if(address != null) {
                console.log(":...");
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
            
        };
        
        
        $scope.nextStep = function ($event) {
            $event.preventDefault();
            console.log($scope.address);
            $scope.address.save().then(function(){
                console.log("Se guardo la direecion");
            });
            alert("sieguiente");
        };
    }
]);