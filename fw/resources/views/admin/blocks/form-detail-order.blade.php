<h2>Pedido @{{order.id}} <span class="pull-right">@{{order.created_at | date : DATETIME_FORMAT}}</span> </h2>
<div>
    <b>Usuario: </b> @{{order.relations.user.name}} (@{{order.relations.user.email}}) <br>
        <span class="label" ng-class="{
            'label-success' : order.paid(),
            'label-danger' : !order.paid()
        }">Pagado</span>
        <a href="" class="label label-danger" ng-show="order.sent!=1 && order.paid()" ng-click="sendOrder(order)">
            <span class="fa fa-send-o" ></span> Enviar</a>
            <a href="" class="label label-success" ng-show="order.sent==1" ng-click="sendOrder(order)">
            <span class="fa fa-send-o" ></span> Enviado</a> 
        <span ng-show="order.billing_information_id">
            <a href="" class="label label-danger" ng-show="!order.bill_number" ng-click="setBillNumber(order)">
                <span class="fa fa-file-text" ></span> Facturar</a> 
            <a href="" class="label label-success" ng-show="order.bill_number" ng-click="setBillNumber(order)">
                <span class="fa fa-file-text" ></span> Facturada</a>
        </span>
    <div style="margin-top: 20px">
        <img src="img/template/large-paypal.png" height="20" ng-show="order.psp===1">
        <span  ng-show="order.psp===2">(TC)<img src="img/template/large-conekta.png" height="20"></span>
    </div>
</div>
<h3>Detalle</h3>
<div>
    <table class="table table-striped">
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Color</th>
            <th>Tamaño</th>
            <th>Precio C/U</th>
            <th>Total</th>
        </tr>
        <tr ng-repeat="item in order.relations.items">
            <td>@{{item.relations.product.name}}</td>
            <td>@{{item.quantity}}</td>
            <td>@{{item.relations.stock.relations.color.name}}</td>
            <td>@{{item.relations.stock.relations.size.name}}</td>
            <td>@{{item.price|currency}}</td>
            <td>@{{(item.price * item.quantity) | currency : "$"}}</td>
        </tr>
    </table>   
    <table class="table table-striped  pull-right" style="width: auto;">
        <tr><th>Subtotal:</th><td>@{{order.subtotal | currency:"$"}}</td></tr>
        <tr ng-show="order.coupon_id"><th>Descuento: (@{{order.getRelation('coupon').code}})</th><td> - @{{order.discount | currency:"$"}}</td></tr> 
        <tr ng-show="order.billing_information_id"><th>Iva:</th><td>@{{order.tax|currency:"$"}}</td></tr>
        <tr><th>Envio:</th><td>@{{order.shipping|currency:"$"}}</td></tr>
        <tr style="background-color: silver; color:black"><th>Total:</th><td>@{{order.total|currency:"$"}}</td></tr>
    </table>
    <div style="clear: both"></div>
</div>
<h3>Información de envío</h3>
<div>
    <div>
        <b>Calle:</b> @{{order.relations.address.street}} <b>No.</b> @{{order.relations.address.street_number}} 
        <span ng-show="order.relations.address.suite_number"><b>Interior:</b> @{{order.relations.address.suite_number}}</span>
    </div>
    <div>
        <b>Colonia:</b> @{{order.relations.address.neighborhood}} <b>C.P.:</b> @{{order.relations.address.cp}} 
    </div>
    <div>
        <b>Ciudad:</b> @{{order.relations.address.city}}
    </div>
    <div>
        <b>Estado:</b> @{{order.relations.address.relations.state.name}}
    </div>
    <div>
        <b>País:</b> @{{order.relations.address.relations.country.name}}
    </div>
    <div ng-show="order.relations.address.instructions">
        <b>Indicaciones:</b> 
        <div>
            <pre>@{{order.relations.address.instructions}}</pre>
        </div>
    </div>
</div>
<div ng-show="order.billing_information_id">
    <h3>Información de facturación</h3>
    <div>
        <div>
            <b>R.F.C.:</b> @{{order.relations.billing_information.rfc}} <b>No Factura:</b> @{{order.bill_number}} 
            <span ngshow="order.billing_information_id">
            <a href="" class="label label-danger" ng-show="!order.bill_number" ng-click="setBillNumber(order)">
                <span class="fa fa-file-text" ></span> Facturar</a> 
        </span>
        </div>
        <div>
            <b>Razón social:</b> @{{order.relations.billing_information.business_name}}
        </div>
        <h4>Domiciío fiscal:</h4>
        <div>
            <b>Calle:</b> @{{order.relations.billing_information.street}} <b>No.</b> @{{order.relations.billing_information.street_number}} 
            <span ng-show="order.relations.billing_information.suite_number"><b>Interior:</b> @{{order.relations.billing_information.suite_number}}</span>
        </div>
        <div>
            <b>Colonia:</b> @{{order.relations.billing_information.neighborhood}} <b>C.P.:</b> @{{order.relations.billing_information.postal_code}} 
        </div>
        <div>
            <b>Ciudad:</b> @{{order.relations.billing_information.city}}
        </div>
        <div>
            <b>Estado:</b> @{{order.relations.billing_information.relations.state.name}}
        </div>
        <div>
            <b>País:</b> @{{order.relations.billing_information.relations.country.name}}
        </div>
    </div>
</div>



<div class="form-group">
    <div class="col-xs-12 text-right">
        <button class="btn btn-danger btn-sm text-center">
            <span class="fa fa-times"></span> Cancelar Pedido</button>    
    </div>
</div>




<div style="clear: both"></div>