<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Productos:</b></h4>
    <form class="form-horizontal" role="form" ng-submit="saveItem($event)">
        <div class="form-group">
            <label class="col-md-3 control-label">Código</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.code" class="form-control" placeholder="Código">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Nombre</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.name" class="form-control" placeholder="Nuevo Producto">
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
                <input type="checkbox" ng-model="check" checked> Manejar catalogo por color
            </label>
        </div>
        <div class="form-group">
            <div id="gallery-colors" class="col-md-12">
                <div class="col-md-6" ng-repeat="color in colors" ng-show="check">
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
            <button class="btn btn-primary waves-effect waves-light">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light"  ng-click="cancel($event)">Cancelar</button>
    </form>
</div>
