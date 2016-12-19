<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)" name="brandForm" novalidate>
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.name" 
                        class="form-control" 
                        placeholder="Nueva Marca"
                        name="name"
                        required
                        ng-remote-validate="{{\DwSetpoint\Models\Brand::getValidateUniqueBrandURL()}}">
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="brandForm.name.$touched && brandForm.name.$invalid">
            <div ng-show="brandForm.name.$error.required">* Campo obligatorio</div>
            <div ng-show="brandForm.name.$error.ngRemoteValidate">* Ya existe la marca" </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Imagen</label>
            <div class="col-md-8">
                <input type="file" placeholder="Nueva Marca" fileread="icon" onselectfile="onselectIcon" accept="image/*">
                <img class="brand-icon" ng-src="@{{iconSrc}}">
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>
