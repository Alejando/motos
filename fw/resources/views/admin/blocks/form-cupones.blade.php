<div  class="cols-md-12 card-box ">
    <h4 class="m-t-0 header-title"><b>Cupon:</b></h4>
    <form class="form-horizontal form-coupons" role="form" ng-submit="saveItem($event)"  name="regForm" novalidate>
        <div class="form-group">
            <label class="col-md-3 control-label">Código:</label>
            <div class="col-md-8">
                <input type="text" ng-model="selectedItem.code" name="code" 
                       class="code form-control" 
                       placeholder=""  
                       pattern="^[#\-a-zA-Z0-9]{1,}$" 
                       required
                       ng-class="{error:regForm.code.$invalid && regForm.code.$touched }"
                       ng-remote-validate="{{\DwSetpoint\Models\Coupon::getValidateUniqueCodeURL()}}"
                >
            </div>
        </div>
        
        <div class="alert alert-danger" role="alert" ng-show="regForm.code.$touched && regForm.code.$invalid">
            <div ng-show="regForm.code.$error.required">* Campo obligatorio</div>
            <div ng-show="regForm.code.$error.pattern">* Un código solo puede incluir letras mayusculas, minusculas y numeros, puedes incluir los caracteres # y -</div>
            <div ng-show="regForm.code.$error.ngRemoteValidate">* Ya existe una cupón con el código "@{{selectedItem.code}}" </div>
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Tipo:</label> 
            <div class="col-md-8">
                <select class="form-control" ng-options="type as type.text for type in types" ng-model="coupontype"></select>
            </div>
        </div> 
        <div></div>
        <div ng-show="coupontype.type == Coupon.types.FREE_PRODUCT_BY_AMOUNT">
            <div class="form-group">
                <label class="col-md-3 control-label">Product</label>
                <div class="col-md-8">
                    <ui-select ng-model="$parent.selectedProduct"  on-select="loadStocks($select.selected)">
                        <ui-select-match >
                            <span style="
                                  background-image: url(@{{$select.selected.getURLCoverSize(20,20)}});
                                      display: block;
                                        margin: 0px;
                                        padding: 0px;
                                        background-repeat: no-repeat;
                                        width: 20px;
                                        height: 20px;
                                        float: left;
                                        margin-right: 10px;"
                            ></span>
                            <span>@{{$select.selected.name}}</span>
                        </ui-select-match>
                        <ui-select-choices repeat="product in products|filter: {'name' : $select.search}">
                            <span style="
                                  background-image: url(@{{product.getURLCoverSize(20,20)}});
                                      display: block;
                                        margin: 0px;
                                        padding: 0px;
                                        background-repeat: no-repeat;
                                        width: 20px;
                                        height: 20px;
                                        float: left;
                                        margin-right: 10px;"
                            ></span><span> @{{product.name}}</span>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>
            <div class="alert alert-danger" role="alert" ng-show="productInvalid">
                <div>Selecciona un producto</div>                
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Stock</label> 
                <div class="col-md-8">
                    <ui-select ng-model="$root.selectedStock">
                        <ui-select-match >      
                            <div ng-show="$select.selected.id">
                                <span style="
                                      background-color:@{{$select.selected.relations.color.rgb}};
                                        display: block;
                                        margin: 0px;
                                        padding: 0px;
                                        width: 20px;
                                        height: 20px;
                                        float: left;
                                        margin-right: 10px;"
                                    ng-show="$select.selected.relations.color"
                                    ></span><span> <b>@{{$select.selected.code}}</b> [Talla: <b>@{{$select.selected.relations.size.name}}</b>][Existencias: <b>@{{$select.selected.quantity}}</b>] </span>
                            </div>
                            <div ng-show="$select.selected.id===null">@{{$select.selected.code}}</div>
                        </ui-select-match>
                        <ui-select-choices repeat="stock in stocks|filter: {'code' : $select.search}">
                            <div ng-show="stock.id==null">
                                <div>@{{stock.code}}</div>
                            </div>
                            <div ng-show="stock.id">
                                    <span style="
                                        background-color:@{{stock.relations.color.rgb}};
                                          display: block;
                                          margin: 0px;
                                          padding: 0px;
                                          width: 20px;
                                          height: 20px;
                                          float: left;
                                          margin-right: 10px;"
                                      ng-show="stock.relations.color"
                                      ></span><span> <b>@{{stock.code}}</b> [Talla: <b>@{{stock.relations.size.name}}</b>][Existensias: <b>@{{stock.quantity}}</b>] </span>
                            </div>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>
        </div>
        <div ng-show="coupontype.type == Coupon.types.PERSENT_BY_AMOUNT">
            <div class="form-group">
                <label class="col-md-3 control-label">Descuento %</label>                
                <div class="col-md-8">
                    <rzslider 
                        
                         rz-slider-model="selectedItem.percent"
                         rz-slider-options="slider.options"
                    ></rzslider>
                </div>
            </div>
            
        </div> 
        <div ng-show="coupontype.type == Coupon.types.DISCOUNT_BY_AMOUNT">
            <div class="form-group"  class="form-control"  >
                <label class="col-md-3 control-label">Descuento $</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon">-$</span>
                        <input  name="discount" 
                            money 
                            ng-model="selectedItem.discount"
                            required precision="2" 
                            require
                            class="form-control ng-pristine ng-untouched ng-valid ng-valid-min"
                            ng-class="{error : regForm.discount.$invalid && regForm.discount.$touched }"
                        >
                    </div>
                </div>
            </div>
            <div class="alert alert-danger" role="alert" ng-show="regForm.discount.$invalid && regForm.discount.$touched ">
                <div>* El campo de descuento es obligatorio</div>
            </div>
            
        </div>
        
        <div class="form-group">
            <label class="col-md-3 control-label">Monto Minimo:</label>
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input  name="min_amount" 
                        money 
                        ng-model="selectedItem.amount_min"
                        required precision="2" 
                        class="form-control ng-pristine ng-untouched ng-valid ng-valid-min"
                        ng-class="{error:regForm.min_amount.$invalid && regForm.min_amount.$touched }"
                    >
                </div>
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="regForm.min_amount.$touched && regForm.min_amount.$error.required">
            <div>* El campo monto es obligatorio</div>
        </div>
           
        <div class="form-group">
            <label class="col-md-3 control-label">Termina el</label>
            <div class="col-md-8">
                <p class="input-group">
                    <input type="text" 
                           name="expreDate"
                           class="form-control"
                           datetime-picker="dd/MM/yyyy HH:mm" 
                           ng-model="selectedItem.expire_date" 
                           is-open="datapickers.expireDate.open"
                           datepicker-options="datapickers.expireDate.datepickerOptions"
                           ng-class="{error:regForm.expreDate.$invalid}"
                    />
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="openCalendar($event, 'expireDate')"><i class="fa fa-calendar"></i></button>
                    </span>
                </p>
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="regForm.expreDate.$invalid">
            <div>* Selecciona una fecha valida</div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Inicia desde el</label>
            <div class="col-md-8">
                <p class="input-group">
                    <input type="text" 
                           name="startDate"
                           class="form-control" 
                           datetime-picker="dd/MM/yyyy HH:mm" 
                           ng-model="selectedItem.start_date" 
                           is-open="datapickers.startDate.open"
                           datepicker-options="datapickers.startDate.datepickerOptions"
                           ng-class="{error : regForm.startDate.$invalid}"
                    />
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default" ng-click="openCalendar($event, 'startDate')"><i class="fa fa-calendar"></i></button>
                    </span>
                </p>
            </div>
        </div>
        <div class="alert alert-danger" role="alert" ng-show="regForm.startDate.$invalid">
            <div>* Selecciona una fecha valida</div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">Limite de usos</label>
            <div class="col-md-8">
                <input type="number" ng-model="selectedItem.uses_limit" class="form-control"  />
            </div>
        </div>
        <div>
            <button class="btn btn-primary waves-effect waves-light">Guardar</button>
            <button class="btn btn-danger waves-effect waves-light"  ng-click="cancel($event)">Cancelar</button>
        </div>
    </form>
</div>
