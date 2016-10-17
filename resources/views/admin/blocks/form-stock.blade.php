<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Stock:</b></h4>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-md-3 control-label">Producto</label>
            <div class="col-md-8">
                <ui-select ng-model="$parent.selectedProduct" on-select="onSelectProduct()"> 
                    <ui-select-match>                       
                        <span>@{{$select.selected.name}} </span>
                    </ui-select-match>
                    <ui-select-choices repeat="product in products | orderBy:['name','id']">
                        <span> @{{product.name}} </span>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Color</label>
            <div class="col-md-8">
                <ui-select ng-model="$parent.selectedColor"> 
                    <ui-select-match>                       
                        <span>@{{$select.selected.name}} </span>
                    </ui-select-match>
                    <ui-select-choices repeat="color in colors | orderBy:['name','id']">
                        <span> @{{color.name}} </span>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Talla</label>
            <div class="col-md-8">
                <ui-select ng-model="$parent.selectedSize"> 
                    <ui-select-match>                       
                        <span>@{{$select.selected.name}} </span>
                    </ui-select-match>
                    <ui-select-choices repeat="size in sizes | orderBy:['name','id']">
                        <span> @{{size.name}} </span>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Precio unitario</label>
            <div class="col-md-8">
                <input type="text" ng-model="objSize.name" class="form-control" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Existencias:</label>
            <div class="col-md-8">
                <input type="text" ng-model="objSize.name" class="form-control" placeholder="">
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light" ng-click="save">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light">Cancelar</button>
    </form>
</div>
