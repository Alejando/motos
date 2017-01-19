setpoint.factory('Address', function (ModelBase,$q,$http, State, Country) {    
    var Address = function (args) {
        ModelBase.apply(this, arguments);
    };
    ModelBase.createModel(Address , {   
        alias: 'address',
        setters : {
        },
        attributes: [
            'id',
            'street',
            'street_number',
            'suite_number',
            'neighborhood',
            'postal_code',
            'city',
            'instructions',
            'user_id',
            'country_id',
            'state_id',
            'label',
            'first_name',
            'last_name',
            'tel',
            'delegation'
        ],
        relations : [
            ['state', State, 'belongsTo'],
            ['country', Country, 'belongsTo']
        ],
        getShippingRules : function (address_id) {
            var $def = $q.defer();
            var url = laroute.route('address.get-shipping-rules', {
                'address_id' : address_id
            }); 
            $http.get(url).then(
                function(r) {
                    $def.resolve(r.data);
                } ,
                function() {
                    $def.reject();
                }
            );
            return $def.promise;
        }
    }, {
        
    });
    return Address;
});