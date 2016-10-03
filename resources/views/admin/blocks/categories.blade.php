<div>
    <h4 class="page-title">Catalogos de categorias</h4>
    <p class="text-muted page-title-alt">Administración</p>
</div>
<div>
    
    <div class="card-box">
        <button class="btn btn-primary" ng-click="newCategory()">
        <span><img src="{{asset('img/new-document.png')}}" height="16" style="margin-right: 5px"></span>Nueva categoria</button>
        <button class="btn btn-primary" ng-click="edit($event)">
            <span class="fa fa-pencil"></span> Editar</button>
        <button class="btn btn-danger" ng-click="remove($event)">
            <span class="fa fa-pencil"></span> Eliminar</button>
    </div>
    <div class="card-box table-responsive">
        <div class="div-js-tree">
            <js-tree 
                tree-plugins="types" 
                tree-data="json" 
                tree-src="{{route('categories.tree')}}"></js-tree>
        </div>
    </div>
</div>