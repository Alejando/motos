<h2>Pedido @{{order.id}} </h2>
<div>
    <b>Usuario: </b> @{{order.relations.user.name}} (@{{order.relations.user.email}})<br>
        <span class="label" ng-class="{
            'label-success' : order.paid==1,
            'label-danger' : order.paid!=1
        }">Pagado</span>
        <a href="" class="label label-danger" ng-show="order.sent!=1 && order.paid" ng-click="sendOrder(order)">
            <span class="fa fa-send-o" ></span> Enviar</a>
            <a href="" class="label label-success" ng-show="order.sent==1" ng-click="sendOrder(order)">
            <span class="fa fa-send-o" ></span> Enviado</a> 
        <span ngshow="order.billing_information_id">
            <a href="" class="label label-danger" ng-show="!order.bill_number" ng-click="setBillNumber(order)">
                <span class="fa fa-file-text" ></span> Facturar</a> 
            <a href="" class="label label-success" ng-show="order.bill_number" ng-click="setBillNumber(order)">
                <span class="fa fa-file-text" ></span> Facturada (@{{order.bill_number}})</a>
        </span>
    <div style="margin-top: 20px">
        <span  ng-show="order.psp===1">(TC)<img src="img/template/large-conekta.png" height="20"></span>
        <img src="img/template/large-paypal.png" height="20" ng-show="order.psp===2">
    </div>
</div>
<h3>Detalle</h3>
<div>
    <table class="table table-striped">
        <tr>
            <th>Producto</th>
            <th>Catindad</th>
            <th>Color</th>
            <th>Tamaño</th>
            <th>Precio C/U</th>
        </tr>
        <tr ng-repeat="item in order.relations.items">
            <td>@{{item.relations.product.name}}</td>
            <td>@{{item.quantity}}</td>
            <td>@{{item.relations.stock.relations.color.name}}</td>
            <td>@{{item.relations.stock.relations.size.name}}</td>
            <td>@{{item.price|currency}}</td>
        </tr>
    </table>    
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
</div>
<div class="form-group">
    <div class="col-xs-12 text-right">
        <button class="btn btn-danger btn-sm text-center">
            <span class="fa fa-times"></span> Cancelar Pedido</button>    
    </div>
</div>
<div style="clear: both"></div>