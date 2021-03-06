setpoint.controller('CategoriesCtrl', function ($scope,$q, $http, $compile, Category) {
    
    var $tree;
    var intervalTree=
    setInterval(function(){
        $tree = $('.div-js-tree .jstree');
        if($tree.size()){
            jsTree = $tree.jstree(true);
            clearInterval(intervalTree);
        }
    },100);

    $scope.newParent = false;
    $scope.categoryTemp;
    // $scope.type = false;
    $scope.newCategory = function () {
        $scope.categoryTemp = new Category({});
        $scope.showCategoryForm();
    }
    $scope.edit = function () {
        var selecteds = ($tree.jstree('get_selected'));
//        console.log(selecteds);
        var id = selecteds[0];
        if(id && id!="root"){
            Category.getById(id).then(function(category){
                $scope.categoryTemp = category;
                $scope.showCategoryForm();
            });
        } else {
            BootstrapDialog.alert("Selecciona la categoria a editar");
        }
        window.categoria = $scope.categoryTemp;
    }
    $scope.remove = function ($event) {
        var selecteds = ($tree.jstree('get_selected'));
        var id = selecteds[0];
        if(id && id!="root") {
            $event.preventDefault();
            var selecteds = ($tree.jstree('get_selected'));
            var id = selecteds[0];
            var node = $tree.jstree(true).get_node(id);
            Category.getById(id).then(function(categoy){
                BootstrapDialog.show({
                    message: 'Deseas eliminar la categoria "' + categoy.name + '"',
                    buttons: [{
                        label: 'SI',
                        cssClass: 'btn btn-primary waves-effect waves-light',
                        action: function(dialogRef) {
                            categoy.remove().then(function(result) {
                                if(result.data.error){
                                    BootstrapDialog.alert(result.data.msj);
                                } else {
                                    $tree.jstree(true).delete_node(node);
                                    dialogRef.close();
                                }
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
        } else {
            BootstrapDialog.alert("Selecciona la categoria a eliminar");
        }
        
    }
    $scope.cancel = function ($event) {
        $event.preventDefault();
        var $dialog = $($event.target).closest('.modal');
        $dialog.modal('hide');
        $scope.categoryTemp = new Category();
    }; 
    $scope.validateForm = function() {
        $scope.categoryForm.name.$touched = true;
       
        if($scope.categoryForm.name.$invalid){
            setTimeout(function() {
                $('.form-coupons .error:eq(0)').focus();
            },100);
            return false;
        }
    };

    $scope.saveCategory = function ($event) {
        console.log("fuction saveCategory");
        if($scope.validateForm){
            if($scope.validateForm() === false) {
                return;
            }
        }
        if($scope.prepareItem){
            $scope.prepareItem();
        }
        if(!$scope.newParent && !$scope.categoryTemp.id) {
            $scope.categoryTemp.parent_category_id = $scope.parentId;
        }
        var id = $scope.categoryTemp.id;

        $scope.categoryTemp.save().then(function(){
            $event.preventDefault();
            var parent  = $scope.categoryTemp.parent_category_id;
            var _parent = parent ? parent : 'root';
            var $dialog = $($event.target).closest('.modal');
            if(!id){
                $tree.jstree(true).create_node( _parent, {
                    "id" : $scope.categoryTemp.id, 
                    "text" : $scope.categoryTemp.name 
                }, "last", function() {
                    var node = $tree.jstree(true).get_node(_parent);
                    $tree.jstree(true).open_node(node);
                    $dialog.modal('hide');
                });
            } else {
                var node = $tree.jstree(true).get_node(id);
                var name = $scope.categoryTemp.name;
                $tree.jstree('rename_node',node, name);
                $dialog.modal('hide');
            }
        }, function(e){
            $scope.categoryForm.slug.$touched = true;
            $scope.categoryForm.slug.$invalid = true;
            $scope.categoryForm.slug.$errorServer = e.data.message;
        });
    };

    $scope.showCategoryForm = function (){
        var selecteds = ($tree.jstree('get_selected'));
        $scope.newParent = !(selecteds.length && (selecteds[0]!=='root'));
        $scope.parentId = selecteds[0];
        var $message = $('<div>Cargando...</div>');
            var defer = $q.defer();
            BootstrapDialog.show({
                title: ($scope.newParent ? 'Categoria' : 'Sub-categoria'),
                message: $message
            });
            var url = laroute.route('page', {view: 'form-categorias'});
            $.get(url,{},'html').done(function(txt){
                $message.fadeOut('fast', function(){ 
                    $(this).html(txt).slideDown('slow');
                    $compile(angular.element($message).contents())($scope);
                    defer.resolve();
                });
            });
            return defer.promise;
    }
    $scope.prepareItem = function(){
        console.log("entro a addFile 1");
        if($scope.categoryTemp.type == '1'){
            console.log("entro a addFile 2");
            $scope.categoryTemp.addFile('icon', $scope.icon);
        }
    };
    $scope.colorPickerOptions = {
        'format' : 'hex',
        'alpha' : false,
        'swatchBootstrap' : false
    };
    $scope.icon = null;
    $scope.imgICon = null;
    $scope.iconSrc =  '';
    $scope.onselectIcon = function(changeEvent, files){
        var reader = new FileReader();
        reader.onload = function (loadEvent) {
            $scope.$apply(function () {
                $scope.iconSrc = loadEvent.target.result;
            });
        };
        reader.readAsDataURL(changeEvent.target.files[0]);
    };
});