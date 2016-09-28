

<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Colores:</b></h4>
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)">
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.name" class="form-control" placeholder="Nueva Color">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Prefijo</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.pref" class="form-control" placeholder="prefijo">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Color</label>
            <div class="col-md-8">
                <!--<input type="text" ng-model="objSize.rgb" class="form-control" placeholder="Color">-->
                <color-picker ng-model="selectedItem.rgb" options="colorPickerOptions"></color-picker>
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>
