<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveCategory($event)">
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
                <input type="text" ng-model="categoryTemp.name" class="form-control" placeholder="Nueva Categoria/Sub-Categoria">
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>