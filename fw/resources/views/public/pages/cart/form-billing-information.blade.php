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
                        name="billInfo"
                        
                    ></select>
                    <input type="text" 
                        class="form-control"
                        ng-model="billInfo.rfc" 
                        ng-show="tempNewBillInfo"
                        id="rfc"
                        name="rfc"
                        required=""
                        pattern="[A-Za-z]{3,4}[0-9]{6}[a-zA-Z0-9]{3}"
                        style="text-transform: uppercase"
                    />
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.rfc.$touched && billInfoForm.rfc.$invalid && tempNewBillInfo">
                        <div ng-show="billInfoForm.rfc.$error.required">Campo obligatorio</div>
                        <div ng-show="billInfoForm.rfc.$error.pattern">-RFC invalido</div>
                    </div>
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
                    <input type="text" ng-model="billInfo.business_name" name="business_name" id="business_name" class="form-control" required=""/>
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.business_name.$touched && billInfoForm.business_name.$invalid">
                        <div ng-show="billInfoForm.business_name.$error.required">Campo obligatorio</div>
                    </div>
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-sm-4 col-sm-offset-3">
                    <label class="qfactura">
                        <span>Copiar la información de la dirección envío:</span>
                    </label>
                </div>
                <div class="col-sm-3">
                    <select class="form-control" 
                            ng-model="objCopyAddres"
                            ng-change="copyAddress()"
                            ng-options="address.label for address in addressesBill track by address.id">
                    </select>
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-sm-2">
                    <label for="fdireccion" class="pull-right">Calle</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" ng-model="billInfo.street"  name="street" id="street_bill" class="form-control"  required=""/>
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.street.$touched && billInfoForm.street.$invalid">
                        <div ng-show="billInfoForm.street.$error.required">Campo obligatorio</div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="fentrecalles" class="espacio pull-right">No.</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" ng-model="billInfo.street_number"  name="street_number" id="street_number_bill" class="form-control" required="" />
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.street_number.$touched && billInfoForm.street_number.$invalid">
                        <div ng-show="billInfoForm.street_number.$error.required">Campo obligatorio</div>
                    </div>
                </div>
            </div>

            <div class="row margentop20">
                <div class="col-sm-2">
                    <label for="fentrecalles" class="espacio pull-right">No. Interior</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" ng-model="billInfo.suite_number" name="suite_number" id="suite_number_bill" class="form-control" required=""/>
                </div>

                <div class="col-sm-2">
                    <label for="fcolonia" class="pull-right">Colonia</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" ng-model="billInfo.neighborhood" name="neighborhood" class="form-control" required=""/>
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.neighborhood.$touched && billInfoForm.neighborhood.$invalid">
                        <div ng-show="billInfoForm.neighborhood.$error.required">Campo obligatorio</div>
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
                            ng-change="chooseBillInfoCountry()"
                            ng-model="selectedBillCoutry"
                            ng-options="country.name for country in countries track by coountry.name"
                            class="form-control"
                            required=""
                    ></select>
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.country.$touched && billInfoForm.country.$invalid">
                        <div ng-show="billInfoForm.country.$error.required">Campo obligatorio</div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="festado" class="pull-right">Estado</label>
                </div>
                <div class="col-sm-4">
                    <select 
                        name="state"  
                        id="state_bill" 
                        ng-model="selectedBillingState"
                        ng-change="chooseBillingState()"
                        ng-options="state.name for state in states track by state.name"
                        class="form-control"
                        required=""
                    >
                    </select>
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.state.$touched && billInfoForm.state.$invalid">
                        <div ng-show="billInfoForm.state.$error.required">Campo obligatorio</div>
                    </div>
                </div>
            </div>
            <div class="row margentop20">
                <div class="col-sm-2">
                    <label for="fciudad" class="espacio pull-right">Ciudad</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="city" id="city_bill"  ng-model="billInfo.city"  class="form-control" required="" />
                </div>


                <div class="col-sm-2">
                    <label for="fcp" class="espacio pull-right">Código Postal</label>
                </div>
                <div class="col-sm-4">
                    <input type="number" ng-model="billInfo.postal_code" name="postal_code"  class="form-control" required=""/>
                    <br>
                    <div class="alert alert-danger" role="alert" ng-show="billInfoForm.postal_code.$touched && billInfoForm.postal_code.$invalid">
                        <div ng-show="billInfoForm.postal_code.$error.required">Campo obligatorio</div>
                    </div>
                </div>
            </div>
            <div class="row margentop20 text-right" >
                <div class="col-sm-12"  ng-hide="billInfo.id">
                    <button class="btn btn-primary" 
                        ng-click="saveNewBillInfo()"
                        ng-class = "{
                            disabled : !validBillInfo(false) 
                        }"                        
                    >Guardar Información de facturación</button>
                    <button class="btn btn-danger"
                        ng-click="cancelNewBillInfo($event)"
                        ng-show="!billInfo.id && billingInformation.length>1"
                    >Cancelar</button>
                </div>
            </div>
        </div>
    </form>