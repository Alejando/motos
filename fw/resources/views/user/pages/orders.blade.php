@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Pedidos</span>
    </div>

    
<div class="cajadatos margentop30">
	<div class="col-md-12">       
	    <div class="card-box table-responsive">
	        <!-- <table datatable="" dt-options="dtOptions"  dt-instance="dtInstance" dt-columns="dtColumns" class="table table-striped table-bordered"></table> -->
	        <table>
			  <tr>
			    <th>ID</th>
			    <th>Subtotal</th> 
			    <th>Impuesto</th>
			  </tr>
			  <tr>
			    <td>Jill</td>
			    <td>Smith</td> 
			    <td>50</td>
			  </tr>
			</table>
	    </div>
	</div>            
</div>
@stop