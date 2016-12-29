<form class="form-horizontal" ng-submit="saveItem($event)" name="colorForm" novalidate>
    <div class="form-group">
        <label class="col-md-3 control-label" for="name">C.P</label>  
        <div class="col-md-3">
            <input id="name" ng-model="selectedItem.name" name="name" type="text" placeholder="Nombre" class="form-control input-md">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary waves-effect waves-light">Agregar</button>
        </div>
    </div>
</form>