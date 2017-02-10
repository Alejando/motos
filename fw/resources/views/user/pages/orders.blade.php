@extends('public.base')


@section('body')
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<div ng-controller="OrderCtrl">	
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Pedidos</span>
    </div>
	<div class="cajadatos margentop30">
		<div class="col-md-12">
		   
		    <div class="card-box table-responsive">
				<table style="width: 100%; " datatable="" dt-options="dtOptions" dt-columns="dtColumns" dt-instance="dtInstance" class="table table-striped"></table>
				   
		    </div>
		</div>            
	</div>
</div>
@stop