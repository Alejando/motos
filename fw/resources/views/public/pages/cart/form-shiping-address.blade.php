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
                        <input  type="text" 
                                ng-model="address.label" 
                                name="label" 
                                id="label" 
                                class="form-control" 
                                placeholder="Ejemplos: Oficina, Casa"
                                required/>
                                <br/>
                        <!-- <i>*Nombre de la dirección, Ejemplos: Oficina, Casa</i> -->
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.label.$touched && shippingForm.label.$invalid">
                            <div ng-show="shippingForm.label.$error.required">Campo obligatorio</div>
                            <!-- <div ng-show="brandForm.name.$error.ngRemoteValidate">* Ya existe la marca" </div> -->
                        </div>
                    </div>
                    <div class="col-sm-2">
                         <button
                            class="btn btn-danger" 
                            ng-click="cancelNewAddress()"
                            ng-show="!address.id && addresses.length>1"
                        >Cancelar</button>
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="nombre" class="pull-right">Nombre</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="first_name" 
                                id="nombre"  
                                ng-model="address.first_name" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.first_name.$touched && shippingForm.first_name.$invalid">
                            <div ng-show="shippingForm.first_name.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="apellido" class="espacio pull-right">Apellidos</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="last_name" 
                                id="last_name" 
                                ng-model="address.last_name" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.last_name.$touched && shippingForm.last_name.$invalid">
                            <div ng-show="shippingForm.last_name.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                </div>

                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="calle" class="pull-right">Calle</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="street" 
                                id="street" 
                                ng-model="address.street" 
                                data-fact="fdireccion" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.street.$touched && shippingForm.street.$invalid">
                            <div ng-show="shippingForm.street.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="numero" class="pull-right">No.</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="street_number" 
                                id="street_number" 
                                data-fact="fdireccion" 
                                ng-model="address.street_number" 
                                class="form-control" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.street_number.$touched && shippingForm.street_number.$invalid">
                            <div ng-show="shippingForm.street_number.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                </div> 
                 <div class="row margentop20">   
                    <div class="col-sm-2">
                        <label for="direccion" class="pull-right">No. Interior</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" name="suite_number" id="suite_number" data-fact="fdireccion" class="form-control" ng-model="address.suite_number" />
                    </div>
                    <div class="col-sm-2">
                        <label for="colonia" class="pull-right">Colonia  @{{shippingForm.colonia.$valid}}</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="neighborhood" 
                                id="neighborhood"   
                                data-fact="fcolonia" 
                                class="form-control" 
                                ng-model="address.neighborhood" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.neighborhood.$touched && shippingForm.neighborhood.$invalid">
                            <div ng-show="shippingForm.neighborhood.$error.required">Campo obligatorio</div>
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
                            name="state"  
                            id="state"
                            ng-change="selectShippingState()"
                            ng-model="selectedShippingState"
                            ng-options="state.name for state in states track by state.id"
                            data-fact="festado"
                            class="form-control"
                            required>
                        </select>
                        <br> 
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.state.$touched && selectedShippingState.id===null">
                            <div>Campo obligatorio</div>
                        </div>
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="ciudad" class="espacio pull-right">Ciudad</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="text" 
                                name="city" 
                                id="city" 
                                data-fact="fciudad" 
                                class="form-control" 
                                ng-model="address.city"
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.city.$touched && shippingForm.city.$invalid">
                            <div ng-show="shippingForm.city.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <label for="cp" class="espacio pull-right">Código Postal</label>
                    </div>
                    <div class="col-sm-4">
                        <input  type="number" 
                                name="pc" 
                                id="pc" 
                                data-fact="fcp" 
                                class="form-control" 
                                ng-model="address.postal_code" 
                                required/>
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.pc.$touched && shippingForm.pc.$invalid">
                            <div ng-show="shippingForm.pc.$error.required">Campo obligatorio</div>
                        </div>
                    </div>
                </div>
                <div class="row margentop20">
                    <div class="col-sm-2">
                        <label for="delegation" class="pull-right">Delegación</label>
                    </div>
                    
                    <div class="col-sm-4">
                        <input type="text" name="delegation" required="" id="delegation" class="form-control" ng-model="address.delegation" />
                        <br>
                    </div>
               
                    <div class="col-sm-2">
                        <label for="telefono" class="pull-right">Teléfono Contacto</label>
                    </div>
                    
                    <div class="col-sm-4">
                        <input type="text" name="tel" required="" id="tel" class="form-control" ng-model="address.tel" />
                        <br>
                        <div class="alert alert-danger" role="alert" ng-show="shippingForm.tel.$touched && shippingForm.tel.$invalid">
                            <div ng-show="shippingForm.tel.$error.required">Campo obligatorio</div>
                        </div>
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
                            ng-class = "{
                                disabled : !validAddress(false) 
                            }"
                        >Guardar dirección</button>
                        <button
                            class="btn btn-danger" 
                            ng-click="cancelNewAddress()"
                            ng-show="!address.id && addresses.length>1"
                        >Cancelar</button>
                        
                    </div>
                </div>
            </form>