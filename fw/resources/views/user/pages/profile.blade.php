@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Perfil</span>
    </div>

    
<div class="cajadatos margentop30">       
    <div class="col-md-6">
    	<h2 class="subtitulo">Datos personales</h2>
    	<br>
    	<br>
    	<div class="form-group">
		    <label>Nombre:			</label> Velkan Gael <!-- @{{ name }} -->
		 </div>
		 <div class="form-group">
		    <label>Apellidos:		</label> Manzanares Quiñones <!-- @{{ name }} -->
		 </div>
		 <div class="form-group">
		    <label>Correo:			</label> gmanzanares@estrasol.com.mx
		 </div>
		 <div class="form-group">
		    <label>Teléfono:		</label> (492) 161-17-42
		 </div>
    </div>
    <div class="col-md-6">
    	<h2 class="subtitulo">Datos de facturación</h2>
    	<br>
    	<br>
    	<div class="form-group">
		    <label>RFC:					</label> Velkan Gael <!-- @{{ name }} -->
		 </div>
		 <div class="form-group">
		    <label>Razón social/Nombre:	</label> Manzanares Quiñones <!-- @{{ name }} -->
		 </div>
		 <div class="form-group">
		    <label>Dirección:			</label> gmanzanares@estrasol.com.mx
		 </div>
		 <div class="form-group">
		    <label>Colonia:				</label> Arcos Vallarta
		 </div>
		 <div class="form-group">
		    <label>Codigo Postal:		</label> 44600
		 </div>
		 <div class="form-group">
		    <label>Estado:				</label> Jalisco
		 </div>
		 <div class="form-group">
		    <label>Municipio:			</label> Guadalajara
		 </div>
    </div>   
            
</div>
@stop