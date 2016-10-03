<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Productos:</b></h4>
    <form class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-md-3 control-label">Nombre</label>
            <div class="col-md-8">
                <input type="text" ng-model="objSize.name" class="form-control" placeholder="Nuevo Producto">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Descripcion</label>
            <div class="col-md-8">
                <textarea ng-model="objSize.name" class="form-control textarea-control" placeholder="Descripción"></textarea>
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
            <label class="col-md-2 control-label">¿Diversos colores?</label><span class="col-md-1"><input type="checkbox" ng-model="check" checked></span>
            <div id="gallery-colors" class="col-md-8" ng-show="check">
                <div class="col-md-6">
                    <div class="col-md-3 text-center"><input type="checkbox" name="" checked></div><div class="col-md-9 text-left">Sin color (sin)</div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-3 text-center"><input type="checkbox" name=""></div><div class="col-md-9 text-left">Azul (azu)</div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-3 text-center"><input type="checkbox" name=""></div><div class="col-md-9 text-left">Sin color (sin)</div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-3 text-center"><input type="checkbox" name=""></div><div class="col-md-9 text-left">Azul (azu)</div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-3 text-center"><input type="checkbox" name=""></div><div class="col-md-9 text-left">Sin color (sin)</div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-3 text-center"><input type="checkbox" name=""></div><div class="col-md-9 text-left">Azul (azu)</div>
                </div>
                <div class="col-md-12 drag-drop"><span>Arrastre sus imagenes aquí</span></div>
            </div>
        </div>
        <button class="btn btn-primary waves-effect waves-light" ng-click="save">Guardar</button>
        <button class="btn btn-danger waves-effect waves-light">Cancelar</button>
    </form>
</div>
