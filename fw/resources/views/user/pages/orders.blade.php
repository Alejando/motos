@extends('public.base')


@section('body')
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