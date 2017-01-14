
@extends('public.base')
@section('body')
<div ng-controller="AddressesCtrl">	
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Direcciones</span>
    </div>
	<div class="cajadatos margentop30">
		<div class="col-md-12">
		   	<div class="card-box">
		        <button class="btn btn-primary" ng-click="newItem()">
		            <span><img src="{{asset('img/new-document.png')}}" height="16" style="margin-right: 5px"></span>Nueva</button>
		    </div>
		    <div class="card-box table-responsive">
				<table style="width: 100%; " datatable="" dt-options="dtOptions" dt-columns="dtColumns" dt-instance="dtInstance" class="table table-striped"></table>
		    </div>
		</div>            
	</div>
</div>
@stop
