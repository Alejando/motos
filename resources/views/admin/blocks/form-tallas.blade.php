

<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Nueva Talla:</b></h4>
    <form class="form-horizontal" role="form" ng-submit="saveItem()">
        <div class="form-group">
            <label class="col-md-1 control-label">Nombre</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.name" class="form-control" placeholder="Nueva Talla">
            </div>
        </div>    
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel()">Cancelar</button>
    </form>
</div>
