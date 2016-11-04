<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Cupon:</b></h4>
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)">
        <div class="form-group">
            <label class="col-md-3 control-label">Código:</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.code" class="form-control" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Tipo:</label>
            <div class="col-md-8">
                <select class="form-control" ng-model="coupontype">
                    <option value="percent">Porcentaje</option>
                    <option value="amount">Cantidad</option>
                    <option value="product">Producto Gratis</option>
                </select>
            </div>
        </div>
        <div ng-switch="coupontype">
            <div ng-switch-when="product">
                <div class="form-group">
                    <label class="col-md-3 control-label">Producto</label>
                    <div class="col-md-8">
                        <input type="text" ng-model="selectedItem.code" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Stock</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <div ng-switch-when="percent">
                <div class="form-group">
                    <label class="col-md-3 control-label">Descuento %</label>
                    <div class="col-md-8">
                        <input type="text" ng-model="selectedItem.percent" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
            <div ng-switch-when="amount">
                <div class="form-group">
                    <label class="col-md-3 control-label">Descuento $</label>
                    <div class="col-md-8">
                        <input type="text" ng-model="selectedItem.discount" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Inicia @{{dataPikers.startDate.open}}</label>
            <div class="col-md-8">
                <p class="input-group">
                    <input type="text" class="form-control" datetime-picker="dd MMM yyyy HH:mm" ng-model="selectedItem.start_date" is-open="dataPikers.startDate.open"  />
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="openCalendar($event, 'startDate')"><i class="fa fa-calendar"></i></button>
                    </span>
                </p>
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Termina</label>
            <div class="col-md-8">
                <p class="input-group">
                    <input type="text" class="form-control" datetime-picker="dd MMM yyyy HH:mm" ng-model="selectedItem.expire_date" is-open="dataPikers.expireDate.open"  />
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="openCalendar($event, 'expireDate')"><i class="fa fa-calendar"></i></button>
                    </span>
                </p>
            </div>
        </div>
        <div>
            <button class="btn btn-primary waves-effect waves-light" ng-click="save">Guardar</button>
            <button class="btn btn-danger waves-effect waves-light"  ng-click="cancel($event)">Cancelar</button>
        </div>
    </form>
</div>
