<div  class="cols-md-12 card-box ">
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)">
        <div class="form-group">
            <label class="col-md-4 control-label">Nombre</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.name" class="form-control" placeholder="Nombre Usuario">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-8">
                <input type="password" ng-model="selectedItem.password" class="form-control" placeholder="Nuevo Password">
            </div>
        </div>
        <div class="form-group" ng-show="selectedItem.password">
            <label class="col-md-4 control-label">Confirmación password</label>
            <div class="col-md-8">
                <input type="password" ng-model="passwordConfirm" class="form-control" placeholder="Confirma tu nuevo password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-8">
                <input type="email" ng-model="selectedItem.email" class="form-control" placeholder="email">
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light" ng-click="cancel($event)">Cancelar</button>
    </form>
</div>