<h1></h1>

<div>
    <h4 class="page-title">Administración de usuario</h4>
</div>
<div>
    <div class="card-box ">
        <button class="btn btn-primary" ng-click="newItem()">
            <span><img src="{{asset('img/new-document.png')}}" height="16" style="margin-right: 5px"></span>Nuevo</button>
        </div>
    <div class="card-box table-responsive">
        <h4 class="m-t-0 header-title"><b>Usuarios</b></h4>
         <table datatable="" dt-options="dtOptions"  dt-instance="dtInstance" dt-columns="dtColumns" class="table table-striped table-bordered"></table>
    </div>
</div>