<h1></h1>

<div>
    <h4 class="page-title">Catalogos de @{{catalog}}</h4>
    <p class="text-muted page-title-alt">Administración</p>
</div>
<div>
    <div class="card-box catalogMenu">
        <button class="btn btn-primary" ng-click="newItem()"><span><img src="{{asset('img/new-document.png')}}" height="16" style="margin-right: 5px"></span>Nuevo</button>
        <button ng-hide="hideExcelExport" onclick="window.open('{{asset('download/productos.xlsx')}}','_self')" class="btn btn-primary"><span><img src="{{asset('img/excel-icon.gif')}}" style="margin-right: 5px"></span>Descargar Plantilla</button>
        <button ng-hide="hideExcelImport" ng-click="import()" class="btn btn-primary"><span><img src="{{asset('img/excel-icon.gif')}}" style="margin-right: 5px"></span>Importar</button>
   
    </div>
    <div class="card-box table-responsive">
        <h4 class="m-t-0 header-title"><b>@{{catalog}}</b></h4>
         <table datatable="" dt-options="dtOptions"  dt-instance="dtInstance" dt-columns="dtColumns" class="table table-striped table-bordered"></table>
    </div>
</div>