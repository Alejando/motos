@extends('public.base')
@section('body')
<div  ng-controller="CartClientInfoCtrl" class="infoShipping" style="display: none">
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
            <form id="formenvio" method="post" name="shippingForm" novalidate> 
                <div class="row  margentop20" ng-hide="!address.id">
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
                    <div class="col-sm-1" ng-show="address.id"> 
                        <button 
                            class="btn btn-primary" 
                            ng-click="newAddress()"                             
                        >Nueva dirección</button>                        
                    </div>
                </div>
                
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="" class="pull-right">Etiqueta</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="tel" 
                                ng-model="address.label" 
                                name="label" 
                                id="label" 
                                class="form-control" 
                                placeholder="Etiqueta"
                                required/>
                                <br/>
                        <i>*Nombre de la dirección, Ejemplos: Oficina, Casa</i>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.label.$touched && shippingForm.label.$invalid">
                            <div ng-show="shippingForm.label.$error.required">Campo obligatorio</div>
                            <!-- <div ng-show="brandForm.name.$error.ngRemoteValidate">* Ya existe la marca" </div> -->
                        </div>
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="nombre" class="pull-right">Nombre</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="nombre" 
                                id="nombre"  
                                ng-model="address.first_name" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.nombre.$touched && shippingForm.nombre.$invalid">
                            <div ng-show="shippingForm.nombre.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="apellido" class="espacio pull-right">Apellidos</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="apellido" 
                                id="apellido" 
                                ng-model="address.last_name" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.apellido.$touched && shippingForm.apellido.$invalid">
                            <div ng-show="shippingForm.apellido.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="calle" class="pull-right">Calle</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="calle" 
                                id="calle" 
                                ng-model="address.street" 
                                data-fact="fdireccion" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.calle.$touched && shippingForm.calle.$invalid">
                            <div ng-show="shippingForm.calle.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="numero" class="pull-right">No.</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="numero" 
                                id="numero" 
                                data-fact="fdireccion" 
                                ng-model="address.street_number" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.numero.$touched && shippingForm.numero.$invalid">
                            <div ng-show="shippingForm.numero.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                </div> 
                 <div class="row margentop20">   
                    <div class="col-sm-2">
                        <label for="direccion" class="pull-right">No. Interior</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" name="direccion" id="direccion" data-fact="fdireccion" class="form-control" ng-model="address.suite_number" />
                    </div>
                    <div class="col-sm-2">
                        <label for="colonia" class="pull-right">Colonia</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="colonia" 
                                id="colonia"   
                                data-fact="fcolonia" 
                                class="form-control" 
                                ng-model="address.neighborhood" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.colonia.$touched && shippingForm.colonia.$invalid">
                            <div ng-show="shippingForm.colonia.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                    
                </div>

                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label class="pull-right">País</label>
                    </div>
                    <div class="col-sm-4">
                        <select name="country" 
                                id="country" 
                                ng-change="chooseCountry()"
                                ng-model="selectedCoutry"
                                ng-options="country.name for country in countries track by country.id"
                                 class="form-control"
                        ></select>
                    </div>
                    <div class="col-sm-2">
                        <label for="estado" class="pull-right">Estado</label>
                    </div>
                    <div class="col-sm-4">
                        <select 
                            name="estado"  
                            id="estado" 
                            ng-model="address.relations.state"
                            ng-options="state.name for state in states track by state.id"
                            data-fact="festado"
                            class="form-control"
                            required>
                            <option value="">Estado/Provincia</option>
                        </select>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.estado.$touched && shippingForm.estado.$invalid">
                            <div ng-show="shippingForm.estado.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="ciudad" class="espacio pull-right">Ciudad</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="ciudad" 
                                id="ciudad" 
                                data-fact="fciudad" 
                                class="form-control" 
                                ng-model="address.city"
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.ciudad.$touched && shippingForm.ciudad.$invalid">
                            <div ng-show="shippingForm.ciudad.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="cp" class="espacio pull-right">Código Postal</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="cp" 
                                id="cp" 
                                data-fact="fcp" 
                                class="form-control" 
                                ng-model="address.postal_code" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.cp.$touched && shippingForm.cp.$invalid">
                            <div ng-show="shippingForm.cp.$error.required">Campo obligatorio</div>
                        </div>
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
                    <div  class="col-sm-12 text-right">
                        <button
                            class="btn btn-primary" 
                            ng-hide="address.id"
                            ng-click="saveNewAddress()"
                        >Guardar dirección</button>
                        <button
                            class="btn btn-danger" 
                            ng-click="cancelNewAddress()"
                            ng-show="!address.id && addresses.length>1"
                        >Cancelar</button>
                        
                    </div>
                </div>
            </form>
            <form id="formenvio2" method="post" name="billInfoForm" novalidate>
                <div class="row margentop20">
                    <div class="col-sm-10 col-sm-offset-2">
                        <label class="qfactura">
                            <input type="checkbox" name="factura" id="factura" ng-model="requestBill" /> 
                            <span>¿Requieres factura?</span>
                        </label>
                    </div>
                </div>

                <div class="cajafactura">                    
                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="rfc" class="espacio pull-right">R.F.C.</label>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" 
                                ng-model="billInfo"
                                ng-options="binfo.rfc for binfo in billingInformation track by binfo.rfc"
                                ng-show="!tempNewBillInfo"
                                ng-change="selectBillInfo()"
                            ></select>
                            <input type="text" 
                                class="form-control"
                                ng-model="billInfo.rfc" 
                                ng-show="tempNewBillInfo"
                                id="rfc"
                            />
                        </div>
                        <div class="col-sm-2" ng-show="billInfo.id">
                            <button class="btn btn-primary" ng-click="newBillInfo()"
                            >Nueva</button>
                        </div>
                    </div>
                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="razon" class="pull-right">Razón Social</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" ng-model="billInfo.business_name" name="razon" id="razon" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-4 col-sm-offset-3">
                            <label class="qfactura">
                                <span> Usar la información de la dirección envío:</span>
                            </label>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" 
                                    ng-model="ojbCopyAddres"
                                    ng-change="copyAddress()"
                                    ng-options="address.label for address in addresses track by address.id">
                                <option value="">(Ninguna)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="fdireccion" class="pull-right">Calle</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" ng-model="billInfo.street"  name="fdireccion" id="fdireccion" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <label for="fentrecalles" class="espacio pull-right">No.</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" ng-model="billInfo.street_number" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="fentrecalles" class="espacio pull-right">No. Interior</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" ng-model="billInfo.suite_number" class="form-control" />
                        </div>
                        
                        <div class="col-sm-2">
                            <label for="fcolonia" class="pull-right">Colonia</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" ng-model="billInfo.neighborhood" class="form-control" />
                        </div>
                    </div>

                    <div class="row margentop20">
                        
                        <div class="col-sm-2">
                            <label class="pull-right">País</label>
                        </div>
                        <div class="col-sm-4">
                            <select name="country" 
                                    id="country" 
                                    ng-change="chooseBillInfoCountry()"
                                    ng-model="billInfo.relations.country"
                                    ng-options="country.name for country in countries track by coountry.name"
                                     class="form-control"
                            ></select>
                        </div>
                        <div class="col-sm-2">
                            <label for="festado" class="pull-right">Estado</label>
                        </div>
                        <div class="col-sm-4">
                            <select 
                                name="estado2"  
                                id="estado2" 
                                ng-model="billInfo.relations.state"
                                ng-options="state.name for state in states track by state.name"
                                class="form-control">
                                <option value="">Estado/Provincia</option>
                            </select>
                        </div>
                    </div>
                    <div class="row margentop20">
                        <div class="col-sm-2">
                            <label for="fciudad" class="espacio pull-right">Ciudad</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="fciudad" id="fciudad"  ng-model="billInfo.city"  class="form-control" />
                        </div>
                        
                        
                        <div class="col-sm-2">
                            <label for="fcp" class="espacio pull-right">Código Postal</label>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" ng-model="billInfo.postal_code"  class="form-control" />
                        </div>
                    </div>
                    <div class="row margentop20 text-right" >
                        <div class="col-sm-12"  ng-hide="billInfo.id">
                            <button class="btn btn-primary" ng-click="saveNewBillInfo()">Guardar Información de facturación</button>
                            <button class="btn btn-danger"
                                ng-click="cancelNewBillInfo()"
                                ng-show="!billInfo.id && billingInformation.length>1"
                            >Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
    @if(\Auth::user())
        <div class="botonera margentop50">
            <a href="#" class="transicion" ng-click="nextStep($event)">Continuar</a>
        </div>
    @endif
</div>
@stop
