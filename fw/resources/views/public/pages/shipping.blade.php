@extends('public.base')
@section('body')
<div  ng-controller="CartClientInfoCtrl">
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Dirección de envío</span>
    </div>

    <div class="pasos">
        <a href="{{route('cart.list')}}" class="transicion"><span><b>1</b></span></a>
        <a href="{{route('cart.shiping')}}" class="transicion activo"><span><b>2</b></span></a>
        @if(\Auth::user()) 
            <a href="./pago" class="transicion"><span><b>3</b></span></a> 
        @endif
    </div>
    
    <div class="cajadatos margentop30">       
        @if(!\Auth::user())
            @include('public.pages.form-login')
            <div style="clear: both"></div>
        @else
            <h2 class="subtitulo">Datos de Envío</h2>
            <form id="formenvio" method="post"> 
                <div class="row  margentop20">
                    <div class="col-sm-2">
                        <label class="pull-right">
                            Dirrección:
                        </label>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" 
                            ng-model="address" 
                            ng-change="selectAddress()"
                            ng-options="address.label for address in addresses track by address.id">
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <button class="btn btn-primary" ng-click="newAddress()">Nueva Dirección</button>
                    </div>  
                </div>
                
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="" class="pull-right">Etiqueta</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="tel" ng-model="address.label" name="label" id="label" class="form-control"/><br/>
                        <i>*Nombre de la dirección, Ejemplos: Oficina, Casa</i>
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="nombre" class="pull-right">Nombre</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" id="nombre"  ng-model="address.first_name" class="form-control" />
                    </div>
                    <div class="col-sm-2">
                        <label for="apellido" class="espacio pull-right">Apellidos</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="apellido" id="apellido" ng-model="address.last_name" class="form-control" />
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="direccion" class="pull-right">Calle</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="direccion" id="direccion" ng-model="address.street" data-fact="fdireccion" class="form-control" />
                    </div>
                    <div class="col-sm-2">
                        <label for="direccion" class="pull-right">No.</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="direccion" id="direccion" data-fact="fdireccion" ng-model="address.street_number" class="form-control" />
                    </div>
                </div> 
                 <div class="row margentop20">   
                    <div class="col-sm-2">
                        <label for="direccion" class="pull-right">No. Interior</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="direccion" id="direccion" data-fact="fdireccion" class="form-control" ng-model="address.suite_number" />
                    </div>
                    <div class="col-sm-2">
                        <label for="colonia" class="pull-right">Colonia</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="colonia" id="colonia" data-fact="fcolonia" class="form-control" ng-model="address.neighborhood" />
                    </div>
                    
                </div>

                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label class="pull-right">País</label>
                    </div>
                    <div class="col-sm-4">
                        <select name="country" id="country" 
                                ng-model="address.relations.coutry"
                                ng-options="country.name for country in countries track by coountry.name"
                        ></select>
                    </div>
                    <div class="col-sm-2">
                        <label for="estado" class="pull-right">Estado</label>
                    </div>
                    <div class="col-sm-4">
                        <select name="estado"  id="estado" ng-model="address.relations.state"
                            ng-options="state.name for state in states track by state.name"
                            data-fact="festado" class="form-control">
                            <option value="">Estado/Provincia</option>
                        </select>
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="ciudad" class="espacio pull-right">Ciudad</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="ciudad" id="ciudad" data-fact="fciudad" class="form-control" ng-model="address.city"/>
                    </div>
                    <div class="col-sm-2">
                        <label for="cp" class="espacio pull-right">Código Postal</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="cp" id="cp" data-fact="fcp" class="form-control" ng-model="address.postal_code" />
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="telefono" class="pull-right">Teléfono Contacto</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="telefono" id="telefono" class="form-control" ng-model="address.tel" />
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="instrucciones" class="pull-right">Instrucciones</label>
                    </div>
                    <div class="col-sm-10">
                        <textarea name="instrucciones" id="instrucciones" ng-model="address.instructions" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-sm-10 col-sm-offset-2">
                        <label class="qfactura">
                            <input type="checkbox" name="factura" id="factura" /> 
                            <span>¿Requieres factura?</span>
                        </label>
                    </div>
                </div>

                <div class="cajafactura">
                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="razon" class="pull-right">Razón Social</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="razon" id="razon" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <label for="rfc" class="espacio pull-right">R.F.C.</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="rfc" id="rfc" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-10 col-sm-offset-2">
                            <label class="qfactura">
                                <input type="checkbox" name="didentica" id="didentica" /> 
                                <span>Dirección fiscal igual a la de envío</span>
                            </label>
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="fdireccion" class="pull-right">Dirección</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="fdireccion" id="fdireccion" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <label for="fentrecalles" class="espacio pull-right">Entre Calles</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="fentrecalles" id="fentrecalles" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="fcolonia" class="pull-right">Colonia</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="fcolonia" id="fcolonia" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <label for="fcp" class="espacio pull-right">Código Postal</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="fcp" id="fcp" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="festado" class="pull-right">Estado</label>
                        </div>
                        <div class="col-sm-4">
                            <select name="festado" id="festado" class="form-control">
                                <option value="">Estado/Provincia</option>
                                <option value="203">Aguascalientes</option>
                                <option value="195">Baja California</option>
                                <option value="216">Baja California Sur</option>
                                <option value="622">Campeche</option>
                                <option value="219">Chiapas</option>
                                <option value="209">Chihuahua</option>
                                <option value="198">Coahuila</option>
                                <option value="215">Colima</option>
                                <option value="213">Distrito Federal</option>
                                <option value="199">Durango</option>
                                <option value="194">Estado de México</option>
                                <option value="196">Guanajuato</option>
                                <option value="208">Guerrero</option>
                                <option value="211">Hidalgo</option>
                                <option value="190">Jalisco</option>
                                <option value="210">Michoacan</option>
                                <option value="207">Morelos</option>
                                <option value="214">Nayarit</option>
                                <option value="191">Nuevo León</option>
                                <option value="218">Oaxaca</option>
                                <option value="192">Puebla</option>
                                <option value="201">Queretaro</option>
                                <option value="220">Quintana roo</option>
                                <option value="200">San Luis Potosi</option>
                                <option value="206">Sinaloa</option>
                                <option value="620">Sonora</option>
                                <option value="217">Tabasco</option>
                                <option value="204">Tamaulipas</option>
                                <option value="193">Tlaxcala</option>
                                <option value="205">Veracruz</option>
                                <option value="202">Yucatán</option>
                                <option value="222">Zacatecas</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="fciudad" class="espacio pull-right">Ciudad</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="fciudad" id="fciudad" class="form-control" />
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
    @if(\Auth::user())
        <div class="botonera margentop50">
            <a href="#" "./pago" class="transicion" ng-click="nextStep($event)">Continuar</a>
        </div>
    @endif
</div>
@stop