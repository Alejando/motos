setpoint.controller('CartClientInfoCtrl', [
    '$scope', 'AuthSevice', '$q', 'Address', 'State', 'Country',
    function($scope, AuthSevice, $q, Address, State, Country) {
        var user = AuthSevice.user();
        var loadAddress = user.addresses();
        var loadStates = State.getAll().then(function(states) {
            $scope.states = states
            console.log(states);
        });
        var loadCountry = Country.getAll().then(function(countries){
            $scope.countries = countries;
        });
        $q.all([loadAddress]).then(function (addresses) {
            $scope.addresses = addresses[0];
            if($scope.addresses.length > 1) {
                $scope.address = $scope.addresses[0];
                $scope.selectAddress()
            } else {
                $scope.newAddress();
            }
        });
        
        $scope.selectAddress = function () {
            $scope.address.state().then(function(){
                console.log($scope.address);
            });
        }
        
        $scope.newAddress = function(){ 
            $scope.address = new Address({
                label : ""
            });
            $scope.addresses.push($scope.address);
            
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