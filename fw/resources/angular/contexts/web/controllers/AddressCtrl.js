setpoint.controller('AddressesCtrl', function (
    $scope,
    $compile,
    $q, 
    $http,
    User,
    Address,
    State, 
    Country, 
    DTOptionsBuilder,
    DTColumnBuilder,
    $timeout,
    AuthSevice
    ) {
    $scope.model = Address;

    var user = AuthSevice.user();

    var loadCountry = Country.getAll().then(function(countries){
        $scope.countries = countries,
        $scope.selectedCoutry = countries[0];
        console.log($scope.countries);
    });

    var loadStates = State.getAll().then(function(states){
        $scope.states = states;
        console.log($scope.states);
    }); 

    var url = laroute.route('user.getAddressesUser');
    console.log(url);
    $scope.items;
    $scope.dtOptions = DTOptionsBuilder.fromFnPromise(function () {
        var defer = $q.defer();
            $http.get(url).then(function (result) {
                $scope.items = result.data;
                console.log($scope.items);
                defer.resolve(result.data);
            });
            return defer.promise;
        }).withOption('createdRow', function (row, data, dataIndex) {
                    // Recompiling so we can bind Angular directive to the DT
                    $compile(angular.element(row).contents())($scope);
                }).withOption('headerCallback', function (header) {
            if (!$scope.headerCompiled) {
                // Use this headerCompiled field to only compile header once
                $scope.headerCompiled = true;
                $compile(angular.element(header).contents())($scope);
            }
        }).withPaginationType('full_numbers').withLanguage({
                    "sEmptyTable":     "No hay datos disponibles en la tabla",
                    "sInfo":           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
                    "sInfoEmpty":      "Mostrando 0 a 0 de 0 elementos",
                    "sInfoFiltered":   "(filtrado de _MAX_ total elementos)",
                    "sInfoPostFix":    "",
                    "sInfoThousands":  ",",
                    "sLengthMenu":     "Ver _MENU_ elementos",
                    "sLoadingRecords": "Cargando...",
                    "sProcessing":     "Procesando...",
                    "sSearch":         "Busqueda:",
                    "sZeroRecords":    "No se encontraron coincidencias",
                    "oPaginate": {
                        "sFirst":    "Primera",
                        "sLast":     "Ultima",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna ascendente",
                        "sSortDescending": ": Activar para ordenar la columna descendente"
                    }
                });

    $scope.dtColumns =   [
                       DTColumnBuilder.newColumn('label').withTitle('Etiqueta'),
                       DTColumnBuilder.newColumn('street').withTitle('Calle'),
                       DTColumnBuilder.newColumn('street_number').withTitle('Número Ext.'),
                       DTColumnBuilder.newColumn('suite_number').withTitle('Número Int.'),
                       DTColumnBuilder.newColumn('neighborhood').withTitle('Colonia'),
                       DTColumnBuilder.newColumn('postal_code').withTitle('Codigo Postal'),
                       DTColumnBuilder.newColumn(null).withTitle("Opciones").notSortable().renderWith(function(data, type,full,meta){
                            return '<a href="#" class="on-default edit-row icon" uib-tooltip="Editar"  ng-click="editItem('+full.id+', $event)"><i class="fa fa-pencil"></i></a>'+
                                '<a href="#" class="on-default remove-row icon danger" uib-tooltip="Eliminar" ng-click="removeItem('+full.id+', $event)"><i class="fa fa-trash-o"></i></a>';
                        })
                   ];

    $scope.removeItem = function (id,$event) {
            $event.preventDefault();
            $scope.model.getById(id).then(function(item){
                console.log(item);
                $scope.selectedItem = item;
                BootstrapDialog.show({
                    message: getRemoveTitle(),
                    title: 'Eliminar',
                    buttons: [{
                        label: 'SI',
                        cssClass: 'btn btn-primary waves-effect waves-light',
                        action: function(dialogRef) {
                            $scope.selectedItem.remove().then(function(){
                                $scope.dtInstance.reloadData(function(){
                                    $.noop();
                                }, !true);
                                dialogRef.close();
                            });
                            dialogRef.setClosable(false);
                        }
                    }, {
                        label: 'NO',
                        cssClass: 'btn btn-danger waves-effect waves-light',
                        action: function(dialogRef){
                            dialogRef.close();
                        }
                    }]
                });
            });
        };

    getRemoveTitle = function () {
                return "¿Desea eliminar el cupon \""+$scope.selectedItem.label+"\"";
            };

    $scope.showFormDialog = function() {
        var $message = $('<div>Cargando...</div>');
        // var defer = $q.defer();
        var dialog = BootstrapDialog.show({
            title: 'Cargando formulario',
            message: $message,
            onhide: function(dialog){
                $scope.selectedItem.rollback();
            },
            onhidden: function(dialog){
                 $scope.selectedItem = newObj();
            },
            buttons: [{
                label: 'Guardar',
                cssClass: 'btn-primary',
                action: function(dialogRef, event){
                    $scope.$apply(function(){
                       $scope.saveItem(event);
                    });
                }},{
                label: 'Cancelar',
                cssClass: 'btn-danger',
                action: function(dialogRef,event){
                    $scope.$apply(function(){
                       $scope.cancel(event);
                    });
                }}]
            });
        $http.get(laroute.route('user.pages', {
            'view' : 'form-address'
        })).then(function(result){
            $message.fadeOut('slow', function(){
                var $div = $(this);
                $div.html(result.data).slideDown("slow"); 
                $content = angular.element(this).contents();
                $scope.$apply(function(){
                    $compile($content)($scope);
                });
            })
        });   
    };


    $scope.chooseCountry = function() {
        $scope.selectedItem.relate('country', $scope.selectedCoutry);
    };

    $scope.chooseState = function() {
        $scope.selectedItem.relate('state', $scope.selectedState);
    };

    var newObj = function () {
            return new $scope.model({});
        };
    $scope.cancel = function ($event) {
            $event.preventDefault();
            var $dialog=$($event.target).closest('.modal');
            $dialog.modal('hide');
        };
    $scope.newItem = function () {
            $scope.selectedItem = newObj();
            $scope.showFormDialog();
        };
    $scope.saveItem = function ($event) {
        $scope.chooseCountry();
        console.log($scope.selectedItem);
        $scope.selectedItem.save().then(function () {
            $scope.selectedItem.backup();
            var $dialog = $($event.target).closest('.modal');
            $dialog.modal('hide');
            $scope.dtInstance.reloadData(function() {
            }, !true);
        }, function (response) {
            if(response.status===501){
                $scope.checkEmail = response.statusText;
            }
        });
    };
    $scope.editItem = function (id,e) {
        $scope.model.getById(id).then(function(data){
             $scope.selectedItem = data;
             $scope.selectedItem.state().then(function (state) {
                    $scope.selectedState = state;
                });
             $scope.showFormDialog();
        });
        e.preventDefault();
    };
    $scope.dtInstance = {};

});