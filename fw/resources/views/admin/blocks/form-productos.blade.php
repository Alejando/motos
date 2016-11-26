<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Productos:</b></h4>
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)" name="productForm" novalidate>
        <div class="form-group">
            <label class="col-md-3 control-label">Nombre</label>
            <div class="col-md-8">
                <input  type="text" ng-model="selectedItem.name" 
                        class="form-control" 
                        placeholder="Nuevo Producto"
                        name="name"
                        required
                        ng-class="{error:productForm.name.$isvalid && productForm.name.$touched}">
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="productForm.name.$touched && productForm.name.$invalid">
            <div ng-show="productForm.name.$error.required">* Campo obligatorio</div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label">Código:</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.code" class="form-control" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Marca</label>
            <div class="col-md-8">
                <ui-select ng-model="$parent.selectedBrand">
                    <ui-select-match>
                        <span style="
                              background-image: url(@{{$select.selected.getLogo(20,20)}});
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
                    <ui-select-choices repeat="brand in brands track by (brand.name + brand.id)">
                        <span style="
                              background-image: url(@{{brand.getLogo(20,20)}});
                                  display: block;
                                    margin: 0px;
                                    padding: 0px;
                                    background-repeat: no-repeat;
                                    width: 20px;
                                    height: 20px;
                                    float: left;
                                    margin-right: 10px;"
                        ></span><span> @{{brand.name}} </span>
                    </ui-select-choices>
                </ui-select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Precio desde:</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.price_from" class="form-control" placeholder="Precio desde">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">% de descuento:</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.discount_percentage" class="form-control" placeholder="Porcentaje de descuento">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Descripcion</label>
            <div class="col-md-8">
                <textarea ng-model="selectedItem.description" class="form-control textarea-control" placeholder="Descripción"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Categorias</label>
            <div class="col-md-8">
                <div class="div-js-tree">
                    <js-tree
                        tree-plugins="checkbox,dnd"
                        tree-data="json"
                        tree-src="{{route('categories.tree')}}"></js-tree>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12 control-label text-left" style="text-align: left;">
                Tamaños/Tallas
            </label>
        </div>
        <div class="form-group">
            <div id="" class="col-md-12">
                <div class="col-md-6" ng-repeat="size in sizes | orderBy:['name','id']">
                    <div class="col-md-12 text-left">
                        <label>
                            <input type="checkbox" name="" ng-checked="inSizes(size)" ng-click="addSize($event, size)">
                            <div style="width: 10px;height: 10px;display:inline-block;background-color:@{{size.rgb}};margin: 0 auto;"> </div>
                            <span>@{{size.name}}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12 control-label text-left" style="text-align: left;">
                <input type="checkbox" ng-model="selectedItem.multi_galeries" ng-checked="selectedItem.multi_galeries==1"> Manejar catalogo por color
            </label>
        </div>
        <div class="form-group">
            <div id="gallery-colors" class="col-md-12">
                <div class="col-md-6" ng-repeat="color in colors" ng-show="selectedItem.multi_galeries">
                    <div class="col-md-12 text-left">
                        <label>
                            <input type="checkbox" name="" ng-checked="inColors(color)" ng-click="addColor($event, color)">
                            <div style="width: 10px;height: 10px;display:inline-block;background-color:@{{color.rgb}};margin: 0 auto;"> </div>
                            <span>@{{color.name}} (@{{color.pref}})</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12 control-label text-left" style="text-align: left;" >
                 Catalogo(s)
            </label>
        </div>
        <div class="form-group">
            <div class="col-md-12 drag-drop" files-dag-and-drop="img[]" onselectfile="onselectfile">
                <span>Arrastre sus imagenes aquí</span>
            </div>
            <div class="col-md-12">
                <ul>
                    <li ng-repeat="file in files">
                        <span class="fa fa-file-image-o"></span>
                        <span>@{{file.name}}</span>
                        <span><a href="" ng-click="removeSelectedFile(file)" class="fa fa-times"></a></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <div ng-repeat="img in selectedItem.imgs">
                <img ng-src="@{{selectedItem.getImg(img, 50, 50)}}">
                <span>@{{img}}</span>
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light"  ng-click="cancel($event)">Cancelar</button>
    </form>
</div>
