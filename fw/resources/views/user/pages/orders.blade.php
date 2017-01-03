@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Pedidos</span>
    </div>
    <style>
		table {
		    border-collapse: collapse;
		}

		table, th, td {
		    border: 1px solid black;
		}
	</style>
	  
<div class="cajadatos margentop30">
	<div class="col-md-12">       
	    <div class="card-box table-responsive">
	        <!-- <table datatable="" dt-options="dtOptions"  dt-instance="dtInstance" dt-columns="dtColumns" class="table table-striped table-bordered"></table> -->
	        <table>
			  	<tr>
				    <th style="">Creado</th>
				    <th>Subtotal</th> 
				    <th>Impuestos</th>
				    <th>Envio</th>
				    <th>Total</th>
				    <th>Estatus</th>
				    <th>Codigo de rastreo</th>
				    <th>Fecha Estimada</th>
				    <th>Detalles</th>
			  	</tr>
			  	@foreach (\Auth::user()->orders as $order)
			  	<tr>
				    <td>{{ $order->created_at }}</td>
				    <td>{{ $order->subtotal }}</td>
				    <td>{{ $order->tax }}</td>
				    <td>{{ $order->shipping }}</td>
				    <td>{{ $order->total }}</td>
				    @if ($order->status == 1)
					    <td>Pagado</td>
					@elseif ($order->status == 2)
						<td>Pendiente</td>
					@elseif ($order->status == 3)
						<td>Cancelado</td>
					@endif
				    <td>{{ $order->tracking_code }}</td>
				    <td>{{ $order->estimated_date }}</td>
				    <td><a href="#">Detalle</a></td>
			  	</tr>
				@endforeach  
			  
			</table>
	    </div>
	</div>            
</div>
@stop