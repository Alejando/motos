

<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Colores:</b></h4>
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)" name="colorForm" novalidate>
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.name" 
                        class="form-control" 
                        placeholder="ej. Ultra Verde"
                        name="name"
                        required
                        ng-remote-validate="{{\DwSetpoint\Models\Color::getValidateUniqueColorURL()}}" 
                        >
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="colorForm.name.$touched && colorForm.name.$invalid">
            <div ng-show="colorForm.name.$error.required">* Campo obligatorio</div>
            <div ng-show="colorForm.name.$error.ngRemoteValidate">* Ya existe el color" </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Prefijo</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="selectedItem.pref" 
                        class="form-control" 
                        placeholder="ej. uverd"
                        name="pref"
                        required
                        ng-remote-validate="{{\DwSetpoint\Models\Color::getValidateUniquePrefURL()}}" 
                        >
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="colorForm.pref.$touched && colorForm.pref.$invalid">
            <div ng-show="colorForm.pref.$error.required">* Campo obligatorio</div>
            <div ng-show="colorForm.pref.$error.ngRemoteValidate">* Ya existe el prefijo" </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Color</label>
            <div class="col-md-8">
                <!--<input type="text" ng-model="objSize.rgb" class="form-control" placeholder="Color">-->
                <color-picker   ng-model="selectedItem.rgb" 
                                options="colorPickerOptions"
                                name="rgb"
                                required
                                ></color-picker>
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="colorForm.rgb.$touched && colorForm.rgb.$invalid">
            <div ng-show="colorForm.rgb.$error.required">* Campo obligatorio</div>
            <div ng-show="colorForm.rgb.$error.ngRemoteValidate">* Ya existe el codigo" </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>
