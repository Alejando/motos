setpoint.controller('CartClientInfoCtrl', [
    '$scope', 'AuthSevice', '$q', 'Address', 'State', 'Country',
    function($scope, AuthSevice, $q, Address, State, Country) {
        var user = AuthSevice.user();
        var loadAddress = user.addresses();
        var loadStates = State.getAll().then(function(states){
            $scope.states = states;
        });
        
        var loadCountry = Country.getAll().then(function(countries){
            $scope.countries = countries,
            $scope.selectedCoutry = countries[0];
        });
        
        $scope.chooseCountry = function() {
            $scope.address.relations.country = $scope.selectedCoutry;
        };
        $q.all([loadAddress], loadCountry, loadStates).then(function (addresses) {
            $scope.addresses = addresses[0];
            if($scope.addresses.length) {
                $scope.address = $scope.addresses[0];
                $scope.selectAddress();
            } else { 
               
                $scope.newAddress();
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
                    label : "Nueva Dirección"
                });
                $scope.chooseCountry();
                $scope.addresses.push($scope.address);                
            }
        }
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