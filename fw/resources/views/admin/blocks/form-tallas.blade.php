<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)" name="sizeForm" novalidate>
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.name" 
                        class="form-control" 
                        placeholder="Nueva Talla"
                        name="name"
                        required
                        ng-remote-validate="{{\DwSetpoint\Models\Size::getValidateUniqueSizeURL()}}" 
                        >
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="sizeForm.name.$touched && sizeForm.name.$invalid">
            <div ng-show="sizeForm.name.$error.required">* Campo obligatorio</div>
            <div ng-show="sizeForm.name.$error.ngRemoteValidate">* Ya existe la talla" </div>
        </div>    
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>