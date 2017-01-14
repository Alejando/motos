<style type="text/css">
.material-switch > input[type="checkbox"] {
    display: none;   
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}
</style>
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
            <label class="col-md-2 control-label">Tipo deportista</label>
            <div class="col-md-8">
                <br>
                <div class="material-switch">
                    <input id="someSwitchOptionDefault" name="someSwitchOption001" type="checkbox" ng-model="categoryTemp.type"/>
                    <label for="someSwitchOptionDefault" class="label-default"></label>
                </div>
            </div>
            <!-- <div class="col-md-8">
               <input type="checkbox" ng-model="categoryTemp.type">
            </div> -->
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