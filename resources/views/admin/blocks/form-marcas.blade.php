<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)">
        <div class="form-group">
            <label class="col-md-2 control-label">Nombre</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.name" class="form-control" placeholder="Nueva Marca">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">Imagen</label>
            <div class="col-md-8">
                <input type="file" placeholder="Nueva Marca" fileread="icon">
                <img src="@{{uploadme}}">
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>