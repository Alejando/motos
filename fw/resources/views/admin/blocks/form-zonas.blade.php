<form class="form-horizontal" ng-submit="saveItem($event)" name="colorForm" novalidate>
        <div class="form-group">
            <label class="col-md-4 control-label" for="name">Nombre</label>  
            <div class="col-md-4">
                <input id="name" ng-model="selectedItem.name" name="name" type="text" placeholder="Nombre" class="form-control input-md">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label" for="prices">Precio de envíos</label>  
            <div class="col-md-4">
                <input id="prices" ng-model="selectedItem.price" name="prices" type="text" placeholder="Precio" class="form-control input-md">
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
</form>