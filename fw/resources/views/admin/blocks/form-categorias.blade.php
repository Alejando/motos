<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveCategory($event)" name="categoryForm" novalidate>
    <div ng-show="newParent">
            
    </div>
    <div  class="form-group" ng-show="!newParent">
        <span><span class="label label-primary">Damas</span> /</span>
        <span><span class="label label-primary">Zapatos</span> /</span>
        <span><span class="label label-primary">xsas</span> /</span>
        <span ng-show="categoryTemp.name"><span class="label label-primary">@{{categoryTemp.name}}</span> /</span>
    </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre</label>
            <div class="col-md-8">
                <input  type="text" 
                        ng-model="categoryTemp.name"    
                        class="form-control" 
                        placeholder="Nueva Categoria/Sub-Categoria"
                        name="name"
                        required>
                        <!-- ng-remote-validate="{{\DwSetpoint\Models\Category::getValidateUniqueCategoryURL()}}" -->
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="categoryForm.name.$touched && categoryForm.name.$invalid">
            <div ng-show="categoryForm.name.$error.required">* Campo obligatorio</div>
            <!-- <div ng-show="categoryForm.name.$error.ngRemoteValidate">* Ya existe la categoría" </div> -->
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Ocultar</label>
            <div class="col-md-8">
                <br>
                <div class="material-switch">
                    <input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox" ng-model="categoryTemp.hidden" ng-true-value="1" ng-false-value="0">
                    <label for="someSwitchOptionDefault" class="label-default"></label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Tipo deportista</label>
            <div class="col-md-8">
                <br>
                <div class="material-switch">
                    <input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox" ng-model="categoryTemp.type" ng-true-value="1" ng-false-value="0">
                    <label for="someSwitchOptionDefault" class="label-default"></label>
                </div>
            </div>
        </div>
        <div class="form-group" ng-show="categoryTemp.type">
            <label class="col-md-2 control-label">Foto</label>
            <div class="col-md-8">
                <input type="file" fileread="icon" onselectfile="onselectIcon" accept="image/*">
                <img class="brand-icon" ng-src="@{{iconSrc}}">
            </div>
        </div>
        
        
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>