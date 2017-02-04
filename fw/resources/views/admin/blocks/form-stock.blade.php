<div  class="cols-md-12 card-box     ">
    <h4 class="m-t-0 header-title"><b>Stock:</b></h4>
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)">
        <div class="form-group">
            <label class="col-md-3 control-label">Código de stock(SKU):</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.code" class="form-control" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Código de barras:</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.codebar" class="form-control" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Producto</label>
            <div class="col-md-8">
                <ui-select ng-model="$parent.selectedProduct" on-select="onSelectProduct()">
                    <ui-select-match>
                        <span>@{{$select.selected.name}} </span>
                    </ui-select-match>
                    <ui-select-choices repeat="product in products | orderBy:['name','id'] | filter: $select.search ">                      
                        <span ng-bind-html="product.code +' ' + product.name | highlight: $select.search"></span>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div ng-show="selectedProduct">
            <div class="form-group" ng-show="colors && colors.length">
                <label class="col-md-3 control-label">Color</label>
                <div class="col-md-8">
                    <ui-select ng-model="$parent.selectedColor">
                        <ui-select-match>
                            <span style="
                                background-color: @{{$select.selected.rgb}};
                                display: block;
                                margin: 0px;
                                padding: 0px;
                                background-repeat: no-repeat;
                                width: 20px;
                                height: 20px;
                                float: left;
                                margin-right: 10px;"
                            ></span>
                            <span>@{{$select.selected.name}} </span>
                        </ui-select-match>
                        <ui-select-choices repeat="color in colors | orderBy:['name','id'] | filter: $select.search">
                            <span style="
                                background-color: @{{color.rgb}};
                                display: block;
                                margin: 0px;
                                padding: 0px;
                                background-repeat: no-repeat;
                                width: 20px;
                                height: 20px;
                                float: left;
                                margin-right: 10px;"
                            ></span>
                            <span ng-bind-html="color.name | highlight: $select.search"></span>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>
            <div class="form-group" ng-show="sizes && sizes.length">
                <label class="col-md-3 control-label">Talla</label>
                <div class="col-md-8">
                    <ui-select ng-model="$parent.selectedSize">
                        <ui-select-match>
                            <span>@{{$select.selected.name}} </span>
                        </ui-select-match>
                        <ui-select-choices repeat="size in sizes | orderBy:['name','id'] | filter: $select.search">
                            <span ng-bind-html="size.name | highlight: $select.search"></span>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Precio unitario</label>
                <div class="col-md-8">
                    <input type="text" currency-only ng-model="selectedItem.price" class="form-control" placeholder="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Existencias:</label>
                <div class="col-md-8">
                    <input type="text" numbers-only ng-model="selectedItem.quantity" class="form-control" placeholder="">
                </div>
            </div>
            <button class="btn btn-primary waves-effect waves-light" ng-click="save">Guardar</button>
            <button class="btn btn-danger waves-effect waves-light"  ng-click="cancel($event)">Cancelar</button>
        </div>
    </form>
</div>
